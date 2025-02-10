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
        // $this->dd($allReviews);

        return $this->view("site/products/reviews", compact("allReviews"));
        
        // if (isset($_POST["rating"]) && isset($_POST["comment"])) {
            echo ReviewCreate::createSiteReviews();
        // }
    }
}