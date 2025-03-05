<?php

namespace app\controllers\site;

use app\vendor\Controller;
use app\models\Review;
use app\models\traits\Pagination;

class ReviewController extends Controller
{
    public function index()
    {
        $allReviews = Review::getSiteReviews("rating", ["is_active" => "yes"], $_GET["id"]);

        $pagination = new Pagination(count($allReviews), 10);
        $pageNumber = $_GET['page'] ?? 1;
        $allReviews = $pagination->getItemsPerPage($allReviews, $pageNumber);
        $links = $pagination->getLinks($pageNumber);

        if (isset($_POST["rating"]) && isset($_POST["comment"])) {
            Review::createSiteReviews($_GET["id"], $_SESSION["user"]["id"], $_POST["rating"], $_POST["comment"]);
            $this->redirect("reviews?id=".$_GET["id"]);
        }
        return $this->view("site/products/reviews", compact("allReviews", "links"));
    }
}