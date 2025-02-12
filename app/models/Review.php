<?php
namespace app\models;

use app\vendor\Model;

class Review extends Model
{
    public static $table = 'reviews';
    public static $primaryKey = 'id';
    public static $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
        'is_active',
    ];

    public static function getSiteReviews(): array
    {
        $stmt = self::builder()->prepare("SELECT u.name, r.rating, r.comment FROM reviews r JOIN users u ON r.user_id = u.id ORDER BY r.rating");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function createSiteReviews($rating, $comment)
    {
        $stmt = self::builder()->prepare("INSERT INTO `reviews`(`product_id`, `user_id`, `rating`, `comment`, `is_active`) VALUES ('1','1',:rating,:comment,'0')");
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    } 
}