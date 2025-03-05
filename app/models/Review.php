<?php
namespace app\models;

use app\vendor\Model;

class Review extends Model
{
    public $table = 'reviews';
    public $primaryKey = 'id';
    public $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
        'is_active',
    ];

    // get information about reviews and sort it by id or rating
    public static function getSiteReviews($sortBy = "id", $filters = [], $product_id = NULL): array
    {
        $sql = "SELECT r.user_id, u.name, r.rating, r.comment, r.id, r.product_id, r.is_active 
                FROM reviews r 
                JOIN users u ON r.user_id = u.id
                WHERE 1";
        if (isset($product_id)) {
            $sql .= " AND r.product_id = :product_id";
        }
        if (isset($filters["is_active"]) && $filters["is_active"] == "yes") {
            $sql .= " AND r.is_active = 1";
        }
        if (isset($filters["is_active"]) && $filters["is_active"] == "no") {
            $sql .= " AND r.is_active = 0";
        }
        if (!empty($filters["product_id"])) {
            $sql .= " AND r.product_id = :product_id";
        }
        if ($sortBy == "rating") {
            $sql .= " ORDER BY r.rating DESC";
        }
        if ($sortBy == "product id") {
            $sql .= " ORDER BY r.product_id";
        }
        $stmt = self::builder()->prepare($sql);
        if (!empty($filters["product_id"])) {
            $stmt->bindParam(':product_id', $filters["product_id"]);
        }
        if (isset($product_id)) {
            $stmt->bindParam(':product_id', $product_id);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // get all product_id
    public static function getSiteProducts()
    {
        $stmt = self::builder()->prepare("SELECT r.product_id, p.title FROM reviews r JOIN products p ON r.product_id = p.id");
        $stmt->execute();
        $arr = $stmt->fetchAll();
        $allProducts = []; 
        foreach ($arr as $value) {
            $allProducts[$value["product_id"]] = $value["title"];
        }
        return $allProducts;
    }

    // get user id from userName
    public static function getUserId($userName)
    {
        $stmt = self::builder()->prepare("SELECT id FROM users WHERE name = :userName");
        $stmt->bindParam(':userName', $userName);
        $stmt->execute();
        return $stmt->fetch();
    }

    // create reviews in data base 
    public static function createSiteReviews($product_id, $user_id, $rating, $comment)
    {
        $stmt = self::builder()->prepare("INSERT INTO `reviews`(`product_id`, `user_id`, `rating`, `comment`, `is_active`) VALUES (:product_id,:user_id,:rating,:comment,'0')");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    } 

    // uapdate the value in is_active depending on the specified argument
    public static function approveReview($id, $value): void
    {
        $stmt = self::builder()->prepare("UPDATE reviews SET is_active = :value WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
    } 
}