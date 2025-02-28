<?php
namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Order;

class OrderController extends Controller
{
    //display all the orders in db
    public function index()
    {
        $orders = Order::findUserOrders();

        return $this->view("admin/orders/orders", compact("orders"));
    }

    // displaying all user's orders by his id
    public function userFiltering()
    {   
        $filters = [];

        if(!empty($_GET['userid'])){
            $filters["userid"] = $_GET['userid'];
        }
        if(!empty($_GET['minPrice'])){
            $filters["minPrice"] = $_GET['minPrice'];
        }

        if(!empty($_GET['maxPrice'])){
            $filters["maxPrice"] = $_GET['maxPrice'];
        }

        if(!empty($_GET['subcategory_id'])){
            $filters["subcategory_id"] = $_GET['subcategory_id'];
        }

        if (isset($_GET["sort"])) {
            $filters["sort"] = $_GET["sort"];
        }

        $orders = Order::findUserOrders($filters);

        return $this->view("admin/orders/orders", compact("orders"));
    }
}