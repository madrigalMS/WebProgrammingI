<?php

function getConnection()
{
    $connection = new mysqli('localhost', 'root', '', 'proyecto_news_cover2');

    if ($connection->connect_error) {
        die("Error de conexión a la base de datos: " . $connection->connect_error);
    }

    return $connection;
}

function limpiarNoticias($db)
{
    $sql = "DELETE FROM news";

    if ($db->query($sql) === TRUE) {
        echo "Registros de noticias eliminados correctamente.";
    } else {
        echo "Error al intentar eliminar registros de noticias: " . $db->error;
    }
}

function convertDate($dateString)
{
    $datetime = strtotime($dateString);
    $formattedDate = date("Y-m-d H:i:s", $datetime);
    return $formattedDate;
}

function obtenerNoticiasDesdeFuente($fuente, $db)
{
    $rssUrl = $fuente['url'];
    $idNewsSource = $fuente['id'];
    $categoryId = $fuente['category_id'];
    $userId = $fuente['user_id'];

    // Realizar solicitud HTTP para obtener el contenido del RSS
    $rssContenido = file_get_contents($rssUrl);

    // Parsear el XML usando SimpleXML
    $feed = new SimpleXMLElement($rssContenido);

    $noticias = [];

    foreach ($feed->channel->item as $entry) {

        $image_url = obtenerURLImagenDesdeDescripcion((string) $entry->description);

        // Si no se encuentra la imagen en la descripción, intentar obtenerla desde el media group
        if (empty($image_url)) {
            $image_url = obtenerURLImagenDesdeMedia($entry);
        }

        // Si aún no se encuentra la imagen, intentar obtenerla desde enclosure
        if (empty($image_url)) {
            $image_url = obtenerURLImagenDesdeEnclosure($entry);
        }

        // Si aún no se encuentra la imagen, intentar obtenerla desde media:content
        if (empty($image_url)) {
            $image_url = obtenerURLImagenDesdeMediaContent($entry);
        }

        $formattedDate = convertDate((string) $entry->pubDate);

        $description = strip_tags((string) $entry->description);

        $noticia = [
            'title' => (string) $entry->title,
            'short_description' => substr($description, 0, 200),
            'permalink' => (string) $entry->link,
            'date' => $formattedDate,
            'image_url' => $image_url,
            'id_news_sources' => $idNewsSource,
            'category_id' => $categoryId,
            'user_id' => $userId,
            'labels' => obtenerLabels($entry),
        ];

        $noticias[] = $noticia;
    }

    return $noticias;
}

function obtenerLabels($entry)
{
    $labels = [];

    foreach ($entry->category as $label) {
        $labels[] = (string) $label;
    }

    return $labels;
}

function obtenerURLImagenDesdeDescripcion($description)
{

    preg_match('/<img.*?src=["\'](.*?)["\'].*?>/i', $description, $matches);


    return isset($matches[1]) ? $matches[1] : '';
}

function obtenerURLImagenDesdeMedia($entry)
{
    $image_url = '';

    // Verificar si hay un media group presente
    if (isset($entry->children('media', true)->group)) {
        $media_group = $entry->children('media', true)->group;

        // Verificar si hay un media content presente dentro del media group
        if (isset($media_group->content)) {
            foreach ($media_group->content as $content) {
                // Verificar si el tipo de media es una imagen
                if (isset($content->attributes()['type']) && strpos((string) $content->attributes()['type'], 'image') !== false) {
                    // Obtener la URL de la imagen
                    $image_url = (string) $content->attributes()['url'];
                    break; // Romper el bucle una vez que se encuentra la imagen
                }
            }
        }
    }

    return $image_url;
}

function obtenerURLImagenDesdeMediaContent($entry)
{
    $image_url = '';

    // Verificar si hay una etiqueta de media:content presente
    if (isset($entry->children('media', true)->content)) {
        $media_content = $entry->children('media', true)->content;

        // Iterar sobre las etiquetas de media:content
        foreach ($media_content as $content) {
            // Verificar si la etiqueta de media:content tiene una URL de imagen
            if (isset($content->attributes()['url'])) {
                $image_url = (string) $content->attributes()['url'];
                break; // Romper el bucle una vez que se encuentra la URL de la imagen
            }
        }
    }

    return $image_url;
}

function obtenerURLImagenDesdeEnclosure($entry)
{
    $image_url = '';

    // Verificar si hay una etiqueta de enclosure presente
    if (isset($entry->enclosure)) {
        $enclosure = $entry->enclosure;

        // Verificar si la etiqueta de enclosure tiene una URL de imagen
        if (isset($enclosure->attributes()['url'])) {
            $image_url = (string) $enclosure->attributes()['url'];
        }
    }

    return $image_url;
}

function guardarNoticiasEnBD($noticias, $db)
{
    foreach ($noticias as $noticia) {
        $sql = "INSERT INTO news (title, short_description, permanlink, image_url, date, news_source_id, category_id, user_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);

        if ($stmt === false) {
            error_log("Error de preparación de la consulta: " . $db->error);
            continue;
        }
        // Vincular parámetros a la consulta SQL
        $bindResult = $stmt->bind_param("sssssiii", $noticia['title'], $noticia['short_description'], $noticia['permalink'], $noticia['image_url'], $noticia['date'], $noticia['id_news_sources'], $noticia['category_id'], $noticia['user_id']);

        // Verificar si la vinculación de parámetros fue exitosa
        if ($bindResult === false) {
            error_log("Error de vinculación de parámetros: " . $stmt->error);
            $stmt->close();
            insertarEtiquetas($db->insert_id, $noticia['labels'], $db);// Insertar etiquetas después de cerrar la consulta
            continue;
        }

        $executeResult = $stmt->execute();

        if ($executeResult === false) {
            error_log("Error de ejecución de la consulta: " . $stmt->error);
        }

        $stmt->close();

          // Insertar etiquetas asociadas a la noticia
        insertarEtiquetas($db->insert_id, $noticia['labels'], $db);
    }
}

function insertarEtiquetas($newsId, $labels, $db)
{
    foreach ($labels as $label) {
        $sql = "INSERT INTO labels (name, news_id) VALUES (?, ?)";
        $stmt = $db->prepare($sql);

        if ($stmt === false) {
            error_log("Error de preparación de la consulta de etiquetas: " . $db->error);
            continue;
        }

        $bindResult = $stmt->bind_param("si", $label, $newsId);

        if ($bindResult === false) {
            error_log("Error de vinculación de parámetros de etiquetas: " . $stmt->error);
            $stmt->close();
            continue;
        }

        $stmt->execute();
        $stmt->close();
    }
}

$db = getConnection();

limpiarNoticias($db);

// Obtener todas las fuentes de noticias desde la base de datos
$query = $db->query("SELECT * FROM news_sources");
$fuentesDeNoticias = $query->fetch_all(MYSQLI_ASSOC);

// Itera sobre cada fuente de noticias y guardar las noticias en la base de datos
foreach ($fuentesDeNoticias as $fuente) {
    $noticias = obtenerNoticiasDesdeFuente($fuente, $db);
    guardarNoticiasEnBD($noticias, $db);
}

$db->close();
?>
