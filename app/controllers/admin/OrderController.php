<?php
namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Order;
use app\models\traits\Pagination;

class OrderController extends Controller
{
    //display all the orders in db
    public function index()
    {
        $title = "User's orders list";
        $cartModel = new Order();
        $ordersItems = Order::findUserOrders();

        $pagination = new Pagination(count($ordersItems), 2);
        $pageNumber = $_GET['page'] ?? 1;
        $ordersItems = $pagination->getItemsPerPage($ordersItems, $pageNumber);
        $links = $pagination->getLinks($pageNumber);

        return $this->view("admin/orders/orders", compact("ordersItems", "title", "links", "filters"));
    }

    // displaying all user's orders by his id
    public function userFiltering()
    {   
        $filters = [];

        if (!empty($_GET['userid'])) {
            $filters["userid"] = $_GET['userid'];
        }
        if (!empty($_GET['minPrice'])) {
            $filters["minPrice"] = $_GET['minPrice'];
        }
        if (!empty($_GET['maxPrice'])) {
            $filters["maxPrice"] = $_GET['maxPrice'];
        }
        if (!empty($_GET['subcategory_id'])) {
            $filters["subcategory_id"] = $_GET['subcategory_id'];
        }
        if (isset($_GET["sort"])) {
            $filters["sort"] = $_GET["sort"];
        }

        $ordersItems = Order::findUserOrders($filters);

        if (!$ordersItems) {
            $ordersItems = [];
        }

        $pagination = new Pagination(count($ordersItems), 2);
        $pageNumber = $_GET['page'] ?? 1;
        $ordersItems = $pagination->getItemsPerPage($ordersItems, $pageNumber);
        $links = $pagination->getLinks($pageNumber);

        return $this->view("admin/orders/orders", compact("ordersItems", "links", "filters"));
    }

}