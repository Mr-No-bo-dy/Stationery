<?php
namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Order;

class OrderController extends Controller
{
    // displaying the shopping cart page
    public function cart() {
        return $this->view('site/products/cart');
    }

    // displaying the checkout page
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

    // check out with phone number check
    public function makeOrder() {
        if ($this->getPost("phone")) {
            if (!preg_match('#^\+[0-9]{1,4}[ -()]?(( [0-9]{1,3} )|\([0-9]{1,3}\)|[0-9]{1,3})[ -]?([0-9][ -]?){6}[0-9]$#', $this->getPost("phone"))) {
                $error = "Invalid phone number";
                return $this->view("site/products/checkout", compact("error"));
            }
        }
        Order::makeOrder($this->getPost("name"), $this->getPost("phone"));
        return $this->redirect("cart");
    }

}