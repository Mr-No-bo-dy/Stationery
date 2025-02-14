<?php
namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Order;

class OrderController extends Controller
{
    public function cart() {
        $this->view('site/products/cart');
    }

    public function addToCart() {
        Order::addToCart($this->getPost("id"));
        $this->redirect("productCard?id=" . $this->getPost("id"));
    }
    public function removeFromCart() {
        Order::removeFromCart($this->getPost("id"));
        $this->redirect("cart");
    }

    public function plusItemToCart() {
        Order::addToCart($this->getPost("id"));
        $this->redirect("cart");
    }

    public function minusItemFromCart() {
        Order::minusItemFromCart($this->getPost("id"));
        $this->redirect("cart");
    }

}