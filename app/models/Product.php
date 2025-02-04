<?php 

namespace App\models;


class Product
{
    protected $id;
    protected $subcategory_id;
    public $title;
    public $description;
    public $price;
    public $stock;
    public $image;

    public function __construct(int $id, string $title, string $description, float $price, float $stock, string $image) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->image = $image;
    }
}