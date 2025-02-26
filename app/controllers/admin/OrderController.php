<?php
namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Order;

class OrderController extends Controller
{
    //display all the orders in db
    public function index()
    {
        $orders = Order::findAll("id");

        return $this->view("admin/orders/orders", compact("orders"));
    }

    //sorting orders by id, price desc, price asc
    public function sorting()
    {   
        if (isset($_GET["sort"])) {
            $orders = Order::findAll($_GET["sort"]);
        }

        return $this->view("admin/orders/orders", compact("orders"));
    }

    // displaying all user's orders by his id
    public function userFiltering()
    {   
        if (isset($_GET["userid"])) {
            $orders = Order::findUserOrders($_GET["userid"]);
        }

        return $this->view("admin/orders/orders", compact("orders"));
    }
}