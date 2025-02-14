<?php
namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Order;

class OrderController extends Controller
{
    public function cart() {
        return $this->view('site/products/cart');
    }
    // добавлення товару в кошик
    public function addToCart() {
        Order::addToCart($this->getPost("id"));
        return $this->redirect("productCard?id=" . $this->getPost("id"));
    }

    // видалення товару з кошика
    public function removeFromCart() {
        Order::removeFromCart($this->getPost("id"));
        return $this->redirect("cart");
    }

    // збільшення кількості товару в кошику
    public function plusItemToCart() {
        Order::addToCart($this->getPost("id"));
        return $this->redirect("cart");
    }

    // зменшення кількості товару в кошику
    public function minusItemFromCart() {
        Order::minusItemFromCart($this->getPost("id"));
        return $this->redirect("cart");
    }

    // оформлення замовлення та відправка в тг
    public function makeOrder() {
        Order::makeOrder($this->getPost("id"), $this->getPost("name"), $this->getPost("phone"));
        return $this->redirect("cart");
    }

}