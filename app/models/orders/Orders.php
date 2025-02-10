<?php
namespace app\models\orders\Orders;
use app\vendor\Model;
class Order {
    private $id;
    private $product_id;
    private $user_id;
    private $count;
    private $total;

    public function __construct($id, $product_id, $user_id, $count, $total) {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->count = $count;
        $this->total = $total;
    }

    public function getId() {
        return $this->id;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getCount() {
        return $this->count;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setProductId($product_id) {
        $this->product_id = $product_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setCount($count) {
        $this->count = $count;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function calculateTotal($price) {
        $this->total = $this->count * $price;
    }
}
