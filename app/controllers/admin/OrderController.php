<?php
namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Order;

class OrderController extends Controller
{
    //display all the orders in db
    public function index()
    {
        $order = new Order();
        $orders = $order->findAll();

        return $this->view("admin/orders/orders", compact("orders"));
    }

    //sorting orders by id, price desc, price asc
    public function sorting()
    {
        $order = new Order();
        
        if (isset($_GET["sort"])) {
            $sort = $_GET["sort"];
            $orders = $order->findAll($sort);
        }

        return $this->view("admin/orders/orders", compact("orders"));
    }
}