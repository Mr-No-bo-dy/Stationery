<?php

namespace App\models;

use app\vendor\Model;

class Product extends Model
{

    public $fillable = [
        'id',
        'title',
        'description',
        "price",
        "stock",
        "image",
    ];

    public $table;

    public static function getProducts(): array
    {
        $stm = self::builder()->prepare("SELECT * FROM `products`");
        $stm->execute();
        return $stm->fetchAll();
    }

    public function __construct(array $fillable, string $table = "products")
    {

        $this->fillable = $fillable;
        $this->table = $table;
    }
}
