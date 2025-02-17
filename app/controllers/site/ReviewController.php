<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $allReviews = Review::getSiteReviews();
        if (isset($_GET["id"])) {
            $url = "reviews?id=".$_GET["id"];
            if (isset($_POST["rating"]) && isset($_POST["comment"])) {
                Review::createSiteReviews($_GET["id"], $_SESSION["user"]["id"], $_POST["rating"], $_POST["comment"]);
                header("location: ".$url);
            }
            return $this->view("site/products/reviews", compact("allReviews", "url"));
        }
        return $this->view("site/products/reviews", compact("allReviews"));
    }
}