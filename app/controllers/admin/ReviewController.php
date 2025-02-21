<?php

namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Review;

class ReviewController extends Controller
{
    public function index()
    {   
        if (isset($_POST["sortBy"])) {
            $_SESSION["reviews"]["sortBy"] = $_POST["sortBy"];
        }
        if (isset($_POST["sortBy"]) || isset($_SESSION["reviews"]["sortBy"])) {
            $allReviews = Review::getSiteReviews($_SESSION["reviews"]["sortBy"]);
        } else {
            $allReviews = Review::getSiteReviews();
        }
        if (isset($_POST["is_active"])) {
            $_SESSION["reviews"]["is_active"] = $_POST["is_active"];
        }
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
        $post = array_flip($_POST);
        if (isset($post["approved"])) {
            Review::approvedReviews($post["approved"], 1);
            $this->redirect("reviews");
        }
        if (isset($post["not approved"])) {
            Review::approvedReviews($post["not approved"], 0);
            $this->redirect("reviews");
        }
        if (isset($_POST["is_active"]) || isset($_SESSION["reviews"]["is_active"])) {
            return $this->view("admin/reviews/index", compact("allReviews", "isOnlyActive"));
        }
        return $this->view("admin/reviews/index", compact("allReviews"));
    }
}