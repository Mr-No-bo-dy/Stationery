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

    public static function getSiteReviews(): array
    {
        $stmt = self::builder()->prepare("SELECT u.name, r.rating, r.comment FROM reviews r JOIN users u ON r.user_id = u.id ORDER BY r.rating");
        $stmt->execute();
        return $stmt->fetchAll();
    } 
}