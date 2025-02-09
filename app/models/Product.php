<?php 

namespace App\models;


class Product
{
    public $table = "product";
    public $fillable = [
        'id',
        'title',
        'description',
        "price",
        "stock",
        "image",
    ];


    public function __construct(string $table, array $fillable) {
        
            $this->table = $table;
            $this->fillable = $fillable;
    }
}