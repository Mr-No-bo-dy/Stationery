<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $allReviews = Review::getSiteReviews("sort by rating", "reviews only active");
        if (isset($_POST["rating"]) && isset($_POST["comment"])) {
            Review::createSiteReviews($_GET["id"], $_SESSION["user"]["id"], $_POST["rating"], $_POST["comment"]);
            $this->redirect("reviews?id=".$_GET["id"]);
        }
        return $this->view("site/products/reviews", compact("allReviews"));
    }
}