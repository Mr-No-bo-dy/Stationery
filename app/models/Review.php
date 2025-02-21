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

    // this function get information about reviews and sort it by id or rating
    public static function getSiteReviews($sortBy = "sort by id"): array
    {
        $sql = "SELECT u.name, r.rating, r.comment, r.id, r.product_id, r.is_active 
                FROM reviews r 
                JOIN users u ON r.user_id = u.id";
        if ($sortBy == "sort by rating") {
            $sql .= " ORDER BY r.rating DESC";
        }
        $stmt = self::builder()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // this function get user id from userName
    public static function getUserId($userName)
    {
        $stmt = self::builder()->prepare("SELECT id FROM users WHERE name = :userName");
        $stmt->bindParam(':userName', $userName);
        $stmt->execute();
        return $stmt->fetch();
    }

    // this function create reviews in data base 
    public static function createSiteReviews($product_id, $user_id, $rating, $comment)
    {
        $stmt = self::builder()->prepare("INSERT INTO `reviews`(`product_id`, `user_id`, `rating`, `comment`, `is_active`) VALUES (:product_id,:user_id,:rating,:comment,'0')");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    } 

    // this function uapdate the value in is_active depending on the specified argument
    public static function approvedReviews($id, $value): void
    {
        $stmt = self::builder()->prepare("UPDATE reviews SET is_active = :value WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':value', $value);
        $stmt->execute();
    } 
}