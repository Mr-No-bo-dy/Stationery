<?php

namespace app\controllers\admin;

use app\vendor\Controller;
use app\models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $allReviews = Review::getSiteReviews();
        if ($_POST) {
            $post = array_flip($_POST);
            if (isset($post["approved"])) {
                Review::approvedReviews($post["approved"], 1);
            } 
            if (isset($post["not approved"])) {
                Review::approvedReviews($post["not approved"], 0);
            }
            header("location: reviews");
        }
        return $this->view("admin/reviews/index", compact("allReviews"));
    }
}