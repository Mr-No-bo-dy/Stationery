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
        $sql = "SELECT id, subcategory_id, title, description, price, stock, image FROM products WHERE id = :id";
        $stmt = Order::builder()->prepare($sql);
        $stmt->execute(["id" => $productId]);
        return $stmt->fetch();
    }

    public function getCartItems () {
        $cart = $_SESSION["cart"] ?? [];
        $cartItems = [];
        foreach ($cart as $item) {
            $product = Order::getProductById($item["id"]);
            $cartItems[] = [
                'id' => $item["id"],
                'title' => $product["title"],
                'price' => $product["price"],
                'quantity' => $item["quantity"],
                'image' => $product["image"],
            ];
        }
        return $cartItems;
    }

    // adding products to the cart / increasing the quantity of goods in the cart
    public static function addToCart($productId)
    {
        $product = Order::getProductById($productId);
        if ($product) {
            $cart = $_SESSION["cart"] ?? [];

            if (isset($cart[$productId])) {
                $cart[$productId]["quantity"]++;
            } else {
                $cart[$productId] = [
                    'id' => $productId,
                    'title' => $product["title"],
                    'price' => $product["price"],
                    'quantity' => 1,
                    'image' => $product["image"],
                ];
            }
            $_SESSION["cart"] = $cart;
        }
    }

    // removing products from the cart
    public static function removeFromCart($productId)
    {
        if (Order::getProductById($productId)) {
            $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
            }
            $_SESSION["cart"] = $cart;
        }
    }

    // decreasing the quantity of goods in the cart
    public static function minusItemFromCart($productId)
    {
        $product = Order::getProductById($productId);
        if ($product) {
            $cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];
            if (isset($cart[$productId])) {
                if ($cart[$productId]["quantity"] > 1) {
                    $cart[$productId]["quantity"]--;
                }
            }
            $_SESSION["cart"] = $cart;                
        }
    }

    // check out
    public static function makeOrder($name, $phone) {
        $cart = $_SESSION["cart"];
        $total = 0;
        $message = "Нове замовлення!\n\n";
    
        foreach ($cart as $product) {
            $total += $product["price"] * $product["quantity"];
            $message .= $product["title"] . "\n";
            $message .= "Кількість: " . $product["quantity"] . "\n";
            $message .= "Ціна за одиницю: " . $product["price"] . "\n";
            $message .= "Загальна ціна продуктів: " . ($product["price"] * $product["quantity"]) . " грн\n\n";
        }
    
        $message .= "Ім'я замовника: " . $name . "\n";
        $message .= "Телефон замовника: " . $phone . "\n";
        $message .= "Загальна сума замовлення: " . $total . " грн";
    
        $botToken = '7727218769:AAHjqc3u7BDMPGjinedYWTQx-nT8_1Yz3zE';
        $chatId = '-1002392193600';
        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        file_get_contents($url, false, $context);

        foreach ($cart as $product) {
            $productId = $product["id"];
            $quantity = $product["quantity"];
            $sql = "INSERT INTO orders (product_id, user_id, count, total) VALUES (:product_id, :user_id, :count, :total)";
            $stmt = Order::builder()->prepare($sql);
            $stmt->execute([
                ':product_id' => $productId,
                ':user_id' => $_SESSION["user"]["id"],
                ':count' => $quantity,
                ':total' => $product["price"] * $quantity
            ]);
        }
    
        unset($_SESSION["cart"]);
    }
    
    // // get all user's orders and sorting them
    public static function findUserOrders($filters = []) {
        $sql = "SELECT * FROM orders WHERE 1";

        if (isset($filters["sort"]) && $filters["sort"] === "id") {
            $sql .= " ORDER BY id ASC";
            $filters = [];
            $_GET['minPrice'] = $_GET['minPrice'] !== "" ? "" : "";
            $_GET['maxPrice'] = $_GET['maxPrice'] !== "" ? "" : "";
            $_GET['userid'] = $_GET['userid'] !== "" ? "" : "";
        } else {
            if (isset($filters["userid"])) {
                $sql .= " AND user_id = :userid";
            }
            if (isset($filters["minPrice"])) {
                $sql .= " AND total >= :minPrice";
            }
            if (isset($filters["maxPrice"])) {
                $sql .= " AND total <= :maxPrice";
            }
            
            $sorting = $filters["sort"] ?? "total";
            $sortingOrder = (isset($filters["sort"]) && strtoupper($filters["sort"]) === "DESC") ? "DESC" : "ASC";
            
            switch ($sorting) {
                case "id":
                    $sql .= " ORDER BY id ASC";
                    break;
                case "userId":
                    $sql .= " ORDER BY user_id ASC";
                    break;
                default:
                    $sql .= " ORDER BY total $sortingOrder";
                    break;
            }
        }
        
        $stm = self::builder()->prepare($sql);
            
        if (isset($filters["userid"])) {
            $stm->bindValue(":userid", $filters["userid"]);
        }
        if (isset($filters["minPrice"])) {
            $stm->bindValue(":minPrice", $filters["minPrice"]);
        }
        if (isset($filters["maxPrice"])) {
            $stm->bindValue(":maxPrice", $filters["maxPrice"]);
        }
        $stm->execute();
        return $stm->fetchAll();
    }
    

}
