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

    // return categories title
    public function getAllCategoriesTitle(): array
    {
        $stmt = self::builder()->prepare("select title from categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // returns the name of the category we are updating
    public function getPresentCategoriesTitle($id):array
    {
        $stmt = self::builder()->prepare("select title from categories WHERE id = (SELECT category_id FROM subcategories WHERE id = :id)");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // return subcategories
    public function getAllSubcategories(): array
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
    public function sortBy($col, $filter = null) {
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

        $sql .= " ORDER BY $col ASC"; // Додано пробіл перед ORDER

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
    public function getSubcategoryById($id): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM subcategories WHERE id = :id LIMIT 1;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // return subcategories by category id
    public function getSubcategoriesByCategoryId($id): array
    {
        $stmt = self::builder()->prepare("SELECT * FROM subcategories WHERE category_id = :id;");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // create subcategories
    public function createSubcategory($categoryTitle, $title, $description) {
        $stmt = self::builder()->prepare("
            INSERT INTO subcategories (title, description, category_id)
            VALUES (:title, :description, (SELECT id FROM categories WHERE title = :categoryTitle LIMIT 1));
        ");
        $stmt->execute([
            ":categoryTitle" => $categoryTitle,
            ":title" => $title,
            ":description" => $description
        ]);
    }

    // update subcategories
    public function updateSubcategory($name, $description, $id, $categoryTitle) {
        $stmt = self::builder()->prepare("
            UPDATE subcategories SET title = :name, description = :description, category_id = 
            (SELECT id FROM categories WHERE title = :categoryTitle) 
            WHERE id = :id
        ");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":categoryTitle", $categoryTitle);
        $stmt->execute();
    }

    // delete categories
    public function deleteSubcategory($id) {
        $stmt = self::builder()->prepare("DELETE FROM subcategories WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}