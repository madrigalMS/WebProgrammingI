<?php

namespace App\Models;

use CodeIgniter\Model;

class News_sources extends Model
{
    protected $table = 'news_sources';
    protected $allowedFields = ['url', 'name', 'category_id', 'user_id'];

    public function getUserNewsSources($userId)
    {
        // Obtener fuentes de noticias específicas para el usuario
        return $this->select('news_sources.id, news_sources.category_id, categories.name AS category_name, news_sources.name')
            ->join('categories', 'news_sources.category_id = categories.id')
            ->where('user_id', $userId)
            ->distinct()
            ->findAll();
    }
    public function insertNewsSource($data)
    {
        return $this->insert($data);
    }
    public function deleteNewsSurces($id)
    {
        return $this->delete($id);
    }

    /*------------------------------------------------------------------------------------------ */
    public function userHasNewsSources($user_id)
    {
        return $this->db->table('news_sources')->where('user_id', $user_id)->countAllResults() > 0;
    }

    public function userHasNews($user_id)
    {
        return $this->db->table('news')->where('user_id', $user_id)->countAllResults() > 0;
    }

    public function getAllNews($user_id)
    {
        return $this->db->query("SELECT news.*, categories.name AS category_name 
            FROM news 
            INNER JOIN categories ON news.category_id = categories.id
            WHERE news.user_id = $user_id 
            ORDER BY news.date DESC")->getResultArray();
    }

    public function getUserCategoriesNews($user_id)
    {
        // SELECT category_id FROM news WHERE user_id = ? GROUP BY category_id
        $query = $this->select('category_id')
            ->where('user_id', $user_id)
            ->groupBy('category_id')
            ->get();

        return $query->getResultArray();
    }

    public function getCategoriesByIds($category_ids)
    {
        return $this->db->table('categories')->whereIn('id', $category_ids)->get()->getResultArray();
    }
    public function getNewsByCategoryId($categoryId, $user_id)
    {
        return $this->db->query("SELECT news.*, categories.name AS category_name 
        FROM news 
        INNER JOIN categories ON news.category_id = categories.id
        WHERE news.category_id = $categoryId AND news.user_id = $user_id 
        ORDER BY news.date DESC")->getResultArray();
    }
    public function searchNewsByKeyword($user_id, $keyword)
    {
        // Escapa el ID de usuario y la palabra clave para prevenir inyecciones SQL
        $user_id = $this->db->escape($user_id);
        $keyword = $this->db->escapeLikeString($keyword);

        // Construye y ejecuta la consulta SQL
        $query = $this->db->query("
            SELECT news.*, categories.name AS category_name
            FROM news
            INNER JOIN categories ON news.category_id = categories.id
            WHERE news.user_id = $user_id 
            AND (news.title LIKE '%$keyword%' OR news.short_description LIKE '%$keyword%')
        ");

        return $query->getResultArray();
    }
    public function buscarNoticiasPorEtiquetas($user_id, $selectedTags)
    {
        // Escapa el ID de usuario y las etiquetas para prevenir inyecciones SQL
        $user_id = $this->db->escape($user_id);
        $etiquetasEscapadas = array_map(function ($tag) {
            return $this->db->escape($tag);
        }, $selectedTags);

        // La consulta utiliza INNER JOIN y DISTINCT
        $consulta = "SELECT DISTINCT news.*, categories.name AS category_name
                     FROM news
                     INNER JOIN labels ON news.id = labels.news_id
                     INNER JOIN categories ON news.category_id = categories.id
                     WHERE news.user_id = $user_id
                     AND labels.name IN (" . implode(', ', $etiquetasEscapadas) . ")";

        $query = $this->db->query($consulta);

        return $query->getResultArray();
    }

    public function obtenerEtiquetasPorCategoriaYUsuario($userId, $categoryId)
    {
        $query = $this->db->query("SELECT
            news.id AS news_id,
            news.category_id AS categoria_id,
            labels.name AS etiqueta
        FROM
            news
        LEFT JOIN
            labels ON news.id = labels.news_id
        WHERE
            news.user_id = ? AND
            news.category_id = ?
        ", [$userId, $categoryId]);

        // Obtiene resultados
        $etiquetasUnicas = array();
        foreach ($query->getResultArray() as $row) {
            $etiquetasUnicas[] = $row['etiqueta'];
        }

        // Eliminar duplicados
        $etiquetasUnicas = array_unique($etiquetasUnicas);

        return $etiquetasUnicas;
    }

}
?>