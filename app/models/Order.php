<?php
namespace App\models;
use app\vendor\Model;
use app\vendor\Database;
use PDO;


class Order extends Model{
    private $id;
    private $product_id;
    private $user_id;
    private $count;
    private $total;

    public function __construct($id, $product_id, $user_id, $count, $total) {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->count = $count;
        $this->total = $total;
    }

    public function getId() {
        return $this->id;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getCount() {
        return $this->count;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setProductId($product_id) {
        $this->product_id = $product_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setCount($count) {
        $this->count = $count;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function calculateTotal($price) {
        $this->total = $this->count * $price;
    }

    public static function getProductById($productId)
    {
        $productId = (int) $productId;
        $db = Database::connection();
        $sql = "SELECT id, subcategory_id, title, description, price, stock, image FROM products WHERE id = ?";
        $stmt = $db->prepare($sql);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }


    public function addToCart()
    {
        if (true) {
            $productId = 21;
            $product = Order::getProductById($productId);

            if ($product) {
                $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

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

                echo 'Товар додано в кошик';
                
            } else {
                echo 'Товар не знайдений';
            }
        }
    }
}
