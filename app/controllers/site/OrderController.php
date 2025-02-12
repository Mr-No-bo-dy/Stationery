<?php
namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Order;

class OrderController extends Controller
{
    public function cart() {
        $this->view('site/products/cart');
    }
}