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

    public function getAllCategoriesTitle(): array {
        $stmt = self::builder()->prepare("select title from categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAllSubcategories(): array
    {
        $stmt = self::builder()->prepare("SELECT subcategories.id, subcategories.title AS subcategory_title, subcategories.description, categories.title AS category_title FROM subcategories JOIN categories ON subcategories.category_id = categories.id;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getSubcategoryById($id): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM subcategories WHERE id = :id LIMIT 1;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getSubcategoriesByCategoryId($id): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM subcategories WHERE category_id = :id;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createSubcategory($categoryTitle, $title, $description) {
        $stmt = self::builder()->prepare("INSERT INTO subcategories (title, description, category_id) VALUES (:title, :description, (SELECT id FROM categories WHERE title = :categoryTitle LIMIT 1));");
        $stmt->execute([
            ":categoryTitle" => $categoryTitle,
            ":title" => $title,
            ":description" => $description
        ]);
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