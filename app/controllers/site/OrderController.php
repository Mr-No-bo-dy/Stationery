<?php
namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Order;

class OrderController extends Controller
{
    public function cart() {
        return $this->view('site/products/cart');
    }

    public function checkout() {
        return $this->view('site/products/checkout');
    }
    // adding products to the cart
    public function addToCart() {
        $id = $this->getPost("id");
        Order::addToCart($id);
        return $this->redirect("card?id=" . $id);
    }

    // removing products from the cart
    public function removeFromCart() {
        Order::removeFromCart($this->getPost("id"));
        return $this->redirect("cart");
    }

    // increasing the quantity of goods in the cart
    public function plusItemToCart() {
        Order::addToCart($this->getPost("id"));
        return $this->redirect("cart");
    }

    // decreasing the quantity of goods in the cart
    public function minusItemFromCart() {
        Order::minusItemFromCart($this->getPost("id"));
        return $this->redirect("cart");
    }

    // check out
    public function makeOrder() {
        Order::makeOrder($this->getPost("id"), $this->getPost("name"), $this->getPost("phone"));
        return $this->redirect("cart");
    }

}