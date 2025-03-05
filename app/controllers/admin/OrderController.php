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
        $filters = [];
        
        foreach (["userid", "minPrice", "maxPrice", "subcategory_id", "sort"] as $filter) {
            if (!empty($_GET[$filter])) {
                $filters[$filter] = $_GET[$filter];
            }
        }
        
        $ordersItems = Order::findUserOrders($filters);
        $ordersItems = $ordersItems ?: [];
        
        $pagination = new Pagination(count($ordersItems), 2);
        $pageNumber = $_GET['page'] ?? 1;
        $ordersItems = $pagination->getItemsPerPage($ordersItems, $pageNumber);
        $links = $pagination->getLinks($pageNumber);
        
        return $this->view("admin/orders/orders", compact("ordersItems", "title", "links", "filters"));
    }


}