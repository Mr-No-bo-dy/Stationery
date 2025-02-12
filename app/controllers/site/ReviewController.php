<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Review;
use app\models\ReviewCreate;

class ReviewController extends Controller
{
    public function index()
    {
        $allReviews = Review::getSiteReviews();
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        if (isset($_POST["rating"]) && isset($_POST["comment"])) {
            Review::createSiteReviews($_POST["rating"], $_POST["comment"]);
        }
        return $this->view("site/products/reviews", compact("allReviews"));
    }
}