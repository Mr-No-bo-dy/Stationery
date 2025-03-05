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

    // returns the name of the category we are updating
    public static function getPresentCategoriesTitle($id): array
    {
        $stmt = self::builder()->prepare("select title from categories WHERE id = (SELECT category_id FROM subcategories WHERE id = :id)");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // return subcategories
    public static function getAllSubcategories(): array
    {
        $stmt = self::builder()->prepare("
            SELECT subcategories.id, subcategories.title AS subcategory_title, subcategories.description, categories.title AS category_title 
            FROM subcategories 
            JOIN categories ON subcategories.category_id = categories.id;
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // return all subcategories sort by column and check filter
    public static function getSubcategories($sort, $filter = null)
    {
        $sql = "
            SELECT subcategories.id, 
                   subcategories.title AS subcategory_title, 
                   subcategories.description, 
                   categories.title AS category_title 
            FROM subcategories 
            JOIN categories ON subcategories.category_id = categories.id
            WHERE 1
        ";

        if (!empty($filter)) {
            $sql .= " AND (subcategories.title LIKE :filterTitle OR subcategories.description LIKE :filterDescription OR categories.title LIKE :filterCategory)";
        }

        if ("id" == $sort) {
            $sql .= " ORDER BY id";
        } else if ("title" == $sort) {
            $sql .= " ORDER BY subcategories.title";
        } else if ("category" == $sort) {
            $sql .= " ORDER BY categories.title";
        }

        $stmt = self::builder()->prepare($sql);
        if (!empty($filter)) {
            $filter = "%" . $filter . "%";
            $stmt->bindParam(":filterTitle", $filter);
            $stmt->bindParam(":filterDescription", $filter);
            $stmt->bindParam(":filterCategory", $filter);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // return subcategories by id
    public static function getSubcategoryById($id): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM subcategories WHERE id = :id LIMIT 1;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // return subcategories by category id
    public static function getSubcategoriesByCategoryId($id): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM subcategories WHERE category_id = :id;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // create subcategories
    public static function createSubcategory($categoryId, $title, $description)
    {
        $stmt = self::builder()->prepare("
            INSERT INTO subcategories (title, description, category_id)
            VALUES (:title, :description, :categoryId);
        ");
        $stmt->bindParam(":categoryId", $categoryId);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->execute();
    }

    // update subcategories
    public static function updateSubcategory($name, $description, $id, $categoryId)
    {
        $stmt = self::builder()->prepare("
            UPDATE subcategories SET title = :name,
            description = :description, 
            category_id = :categoryId
            WHERE id = :id
        ");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":categoryId", $categoryId);
        $stmt->execute();
    }

    // delete categories
    public static function deleteSubcategory($id)
    {
        $stmt = self::builder()->prepare("DELETE FROM subcategories WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}