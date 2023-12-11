<?php

namespace App\Models;

use CodeIgniter\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $allowedFields = ['name'];
    public function getCategories()
    {
        return $this->findAll();
    }
    public function saveCategory($name)
    {
        // Guarda la nueva categoría
        $this->insert(['name' => $name]);
    }
    public function updateCategory($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
    public function getCategoriesByIds($category_ids)
    {
        $inClause = implode(',', array_fill(0, count($category_ids), '?'));

        $query = "SELECT DISTINCT id, name FROM categories WHERE id IN ($inClause)";
        $result = $this->db->query($query, $category_ids);

        return $result->getResultArray();
    }
}
?>