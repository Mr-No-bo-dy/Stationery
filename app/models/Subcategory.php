<?php
namespace app\models;

use app\vendor\Model;

class Subcategory extends Model
{
    public $table = 'subcategories';
    public $primaryKey = 'id';
    public $fillable = [
        'id',
        'category_id',
        'name',
        'description',
    ];

    public function getAllSubcategories(): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM subcategories WHERE category_id = :categoryId");
        $stmt->bindParam(":categoryId", $_POST['categoryId']);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createSubcategory($categoryId, $name, $description) {
        $stmt = self::builder()->prepare("INSERT INTO subcategories (category_id, title, description) VALUES (:categoryId, :name, :description)");
        $stmt->bindParam(":categoryId", $categoryId);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->execute();
    }

    public function updateSubcategory($name, $description, $id) {
        $stmt = self::builder()->prepare("UPDATE subcategories SET title = :name, description = :description WHERE id = :id");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function deleteSubcategory($id) {
        $stmt = self::builder()->prepare("DELETE FROM subcategories WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}