<?php
namespace app\models;

use app\vendor\Model;

class Categories extends Model
{
    public $table = 'categories';
    public $primaryKey = 'id';
    public $fillable = [
        'id',
        'name',
        'description',
    ];

    public function getAllCategories(): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCategoryById($id): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function createCategory($name, $description) {
        $stmt = self::builder()->prepare("INSERT INTO categories (title, description) VALUES (:name, :description)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->execute();
    }
}