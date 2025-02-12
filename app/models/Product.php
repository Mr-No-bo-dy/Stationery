<?php

namespace App\models;

use app\vendor\Model;

class Product extends Model
{
    protected $id = "0";
    public $fillable = [
        'title',
        'description',
        "price",
        "stock",
        "image",
    ];
    public $table = "products";


    public static function getProducts(): array
    {
        $stm = self::builder()->prepare("SELECT * FROM `products`");
        $stm->execute();
        return $stm->fetchAll();
    }
}
