<?php
namespace app\services;
use app\models\Product;
use app\models\traits\Pagination;

class ProductOrganizing 
{
    // Get the information you need for catalog and admin/products
    public static function organizing() 
    {
        $filters = [];
        $sortBy = "id";

        if(!empty($_GET['title'])){
            $filters["title"] = $_GET['title'];
        }
        if(!empty($_GET['minPrice'])){
            $filters["minPrice"] = $_GET['minPrice'];
        }

        if(!empty($_GET['maxPrice'])){
            $filters["maxPrice"] = $_GET['maxPrice'];
        }

        if(!empty($_GET['subcategory_id']) && $_GET['subcategory_id'] != 'All'){
            $filters["subcategory_id"] = $_GET['subcategory_id'];
        }

        if(isset($_GET["sort"]) && $_GET["sort"] != "id") {
            $sortBy = $_GET["sort"];
        }

        
        $products = Product::getProducts($filters, $sortBy);
        $subCategories = Product::getSubcategoryTitle();
        
        $pagination = new Pagination(count($products), 12);
        $pageNumber = $_GET['page'] ?? 1;
        $products =  $pagination->getItemsPerPage($products, $pageNumber);
        $links = $pagination->getLinks($pageNumber);


        return compact("filters", "sortBy", "products", "links", "pageNumber", "subCategories");
    }

}



