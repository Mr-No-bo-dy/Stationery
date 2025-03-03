<?php

namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Review;

class ReviewController extends Controller
{

    // show and actions with reviews
    public function index()
    {   
        $title = "Stationery admin rewiews";

        // writes to SESSION
        if (!isset($_SESSION["reviews"]["sortBy"])) {
            $_SESSION["reviews"]["sortBy"] = "id";
        }
        if (!isset($_SESSION["reviews"]["filters"])) {
            $_SESSION["reviews"]["filters"] = [];
        }
        if (isset($_POST["sortBy"])) {
            $_SESSION["reviews"]["sortBy"] = $_POST["sortBy"];
        }
        if (isset($_POST["is_active"])) {
            $_SESSION["reviews"]["filters"]["is_active"] = $_POST["is_active"];
        }
        if (isset($_POST["product_id"])) {
            $_SESSION["reviews"]["filters"]["product_id"] = $_POST["product_id"];
        }

        // checking are selected filters/sorts
        $allReviews = Review::getSiteReviews($_SESSION["reviews"]["sortBy"], $_SESSION["reviews"]["filters"]);
        
        // providing a value for the variable $isOnlyActive depending on $_SESSION["reviews"]["is_active"]
        if (isset($_POST["is_active"]) || isset($_SESSION["reviews"]["is_active"])) {
            if ($_SESSION["reviews"]["filters"]["is_active"] == "yes") {
                $isOnlyActive = 1;
            }
            if ($_SESSION["reviews"]["filters"]["is_active"] == "no") {
                $isOnlyActive = 0;
            }
            if ($_SESSION["reviews"]["filters"]["is_active"] == "all") {
                unset($_SESSION["reviews"]["filters"]["is_active"]);
            }
        }

        // approve/not approve
        $post = array_flip($_POST);
        if (isset($post["approve"])) {
            Review::approveReview($post["approve"], 1);
            $this->redirect("reviews");
        }
        if (isset($post["not approve"])) {
            Review::approveReview($post["not approve"], 0);
            $this->redirect("reviews");
        }
        
        // 
        $allProductsWithReviews = Review::getSiteProducts();

        // checking if isset $_SESSION["reviews"]["is_active"]
        if (isset($_SESSION["reviews"]["is_active"])) {
            return $this->view("admin/reviews/index", compact("allReviews", "title", "allProductsWithReviews", "isOnlyActive"));
        }
        return $this->view("admin/reviews/index", compact("allReviews", "title", "allProductsWithReviews"));
    }
}