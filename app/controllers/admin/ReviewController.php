<?php

namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Review;

class ReviewController extends Controller
{

    // show and actions with reviews
    public function index()
    {   
        // writes to SESSION
        if (isset($_POST["sortBy"])) {
            $_SESSION["reviews"]["sortBy"] = $_POST["sortBy"];
        }
        if (isset($_POST["is_active"])) {
            $_SESSION["reviews"]["is_active"] = $_POST["is_active"];
        }
        // checking are selected filters/sorts
        if (isset($_SESSION["reviews"]["sortBy"]) && isset($_SESSION["reviews"]["is_active"])) {
            $allReviews = Review::getSiteReviews($_SESSION["reviews"]["sortBy"], $_SESSION["reviews"]["is_active"]);
        } else if (isset($_SESSION["reviews"]["is_active"])) {
            $allReviews = Review::getSiteReviews("sort by id", $_SESSION["reviews"]["is_active"]);
        } else if (isset($_SESSION["reviews"]["sortBy"])) {
            $allReviews = Review::getSiteReviews($_SESSION["reviews"]["sortBy"]);
        } else {
            $allReviews = Review::getSiteReviews();
        }
        
        // providing a value for the variable $isOnlyActive depending on $_SESSION["reviews"]["is_active"]
        if (isset($_POST["is_active"]) || isset($_SESSION["reviews"]["is_active"])) {
            if ($_SESSION["reviews"]["is_active"] == "reviews only active") {
                $isOnlyActive = 1;
            }
            if ($_SESSION["reviews"]["is_active"] == "reviews only not active") {
                $isOnlyActive = 0;
            }
            if ($_SESSION["reviews"]["is_active"] == "all reviews") {
                unset($_SESSION["reviews"]["is_active"]);
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
        // checking if isset $_SESSION["reviews"]["is_active"]
        if (isset($_SESSION["reviews"]["is_active"])) {
            return $this->view("admin/reviews/index", compact("allReviews", "isOnlyActive"));
        }
        return $this->view("admin/reviews/index", compact("allReviews"));
    }
}