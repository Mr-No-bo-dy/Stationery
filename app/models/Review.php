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
    public static function getSiteReviews($sortBy = "sort by id", $is_active = NULL): array
    {
        $sql = "SELECT r.user_id, u.name, r.rating, r.comment, r.id, r.product_id, r.is_active 
                FROM reviews r 
                JOIN users u ON r.user_id = u.id";
        if ($is_active == "yes") {
            $sql .= " WHERE r.is_active = 1";
        }
        if ($is_active == "no") {
            $sql .= " WHERE r.is_active = 0";
        }
        if ($sortBy == "rating") {
            $sql .= " ORDER BY r.rating DESC";
        }
        if ($sortBy == "product id") {
            $sql .= " ORDER BY r.product_id DESC";
        }
        $stmt = self::builder()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
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