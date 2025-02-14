<?php
namespace App\models;
use app\vendor\Model;


class Order extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'id';

    public $fillable = [
        'product_id', 
        'user_id', 
        'count', 
        'total'
    ];

    

    public static function getProductById($productId)
    {
        $db = Order::builder();
        $sql = "SELECT id, subcategory_id, title, description, price, stock, image FROM products WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(["id" => $productId]);
        $data = $stmt->fetch();
        // self::dd($data);

        return $data;
    }


    public static function addToCart($productId)
    {
        $product = Order::getProductById($productId);

        if ($product) {
            $cart = $_SESSION['cart'] ?? [];

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
            } else {
                $cart[$productId] = [
                    'id' => $productId,
                    'title' => $product['title'],
                    'price' => $product['price'],
                    'quantity' => 1,
                    'image' => $product['image'],
                ];
            }

            $_SESSION['cart'] = $cart;
            
        }
    }

    public static function removeFromCart($productId)
    {

        $product = Order::getProductById($productId);

        if ($product) {
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

            if (isset($cart[$productId])) {
                unset($cart[$productId]);
            }

            $_SESSION['cart'] = $cart;
            
        }
    }

    public static function minusItemFromCart($productId)
    {

        $product = Order::getProductById($productId);

        if ($product) {
            $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

            if (isset($cart[$productId])) {
                if ($cart[$productId]['quantity'] > 1) {
                    $cart[$productId]['quantity']--;
                }
            }

            $_SESSION['cart'] = $cart;                
        } else {
            echo 'Товар не знайдений';
        }

    }

    public function plusItemFromCart()
    {
        if (true) {
            $productId = 21;
            $product = Order::getProductById($productId);

            if ($product) {
                $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity']++;
                }

                $_SESSION['cart'] = $cart;       
            } else {
                echo 'Товар не знайдений';
            }
        }
    }
}
