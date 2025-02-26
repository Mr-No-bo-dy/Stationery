<?php
namespace app\models;

use app\vendor\Model;

class Category extends Model
{
    public $table = 'categories';
    public $primaryKey = 'id';
    public $fillable = [
        'id',
        'name',
        'description',
    ];

    // return all category
    public function getAllCategories(): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // return category by id
    public function getCategoryById($id): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // create category
    public function createCategory($name, $description) {
        $stmt = self::builder()->prepare("INSERT INTO categories (title, description) VALUES (:name, :description)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->execute();
    }

    // return all category sort by id
    public function sortById() {
        $stmt = self::builder()->prepare("SELECT * FROM categories ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // return all category sort by title
    public function sortByTitle() {
        $stmt = self::builder()->prepare("SELECT * FROM categories ORDER BY title ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // edit category by id
    public function updateCategory($name, $description, $id) {
        $stmt = self::builder()->prepare("UPDATE categories SET title = :name, description = :description WHERE id = :id");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    // delete category in data base
    public function deleteCategory($id) {
        $stmt = self::builder()->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

}