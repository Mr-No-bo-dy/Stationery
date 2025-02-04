<?php 


namespace app\controllers\site;

use app\vendor\Controller;

class Product extends Controller
{
    protected $id;
    protected $subcategory_id;
    public $title;
    public $description;
    public $price;
    public $stock;
    public $image;

    public function __construct(int $id, int $subcategory_id, string $title, string $description, float $price, float $stock) {
        $this->id = $id;
        $this->subcategory_id = $subcategory_id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
    }
}