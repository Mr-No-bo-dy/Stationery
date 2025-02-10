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

    public static function createSiteReviews()
    {
        $stmt = self::builder()->prepare("INSERT INTO `reviews`(`product_id`, `user_id`, `rating`, `comment`, `is_active`) VALUES (1, 1, 5, 'comment', '0')");
        // $stmt->bindParam(":rating", $rating);
        // $stmt->bindParam(":comments", $comments);
        $stmt->execute();
        return $stmt->fetchAll();
    } 
}