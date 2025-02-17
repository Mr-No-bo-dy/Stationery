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


    // adding products to the cart / increasing the quantity of goods in the cart
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

    // removing products from the cart
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


    // decreasing the quantity of goods in the cart
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


    // check out
    public static function makeOrder ($id, $name, $phone) {
        $cart = $_SESSION['cart'];
        $total = 0;
        $message = "🛍 Нове замовлення!\n\n";
    
        foreach ($cart as $product) {
            $total += $product['price'] * $product['quantity'];
            $message .= "📦 " . $product['title'] . "\n";
            $message .= "Кількість: " . $product['quantity'] . "\n";
            $message .= "Ціна за одиницю: " . $product['price'] . "\n";
            $message .= "Загальна ціна продуктів: " . $product['price'] * $product['quantity'] . " грн\n\n";
        }

        $message .= "Ім'я замовника: " . $name . "\n";
        $message .= "Телефон замовника: " . $phone . "\n";
    
        $message .= "💰 Загальна сума замовлення: " . $total . " грн";



    
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
    }
}
