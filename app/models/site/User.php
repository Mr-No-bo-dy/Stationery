<?php

namespace app\models\site;

use app\vendor\Model;
use Exception;
use PDOException;

class User extends Model
{
    protected $id;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $role;
    private $password;

    public function setUser(
        string $name,
        string $surname,
        string $email,
        string $phone,
        string $role,
        string $password
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
        $this->password = $password;

        $pdo = parent::builder();
        $sql = "SELECT id FROM users WHERE name = :name AND password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name' => $this->name,
            'password' => $this->password,
        ]);
        $this->id = $stmt->fetchColumn();

        $_SESSION['user'] = $this;
    }

    public function register(
        string $name,
        string $surname,
        string $email,
        string $phone,
        string $role,
        string $password
    ) : void
    {
        $this->setUser($name, $surname, $email, $phone, $role, $password);

        $pdo = parent::builder();
        $sql = "INSERT INTO users (name, surname, email, phone, role, password) VALUES (:name, :surname, :email, :phone, :role, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'password' => $this->password,
        ]);
    }

    /**
     * @throws Exception
     */
   public function login($name, $password): bool
        {
            try {
                $pdo = parent::builder();
                $sql = "SELECT * FROM users WHERE name = :name AND password = :password";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'name' => $name,
                    'password' => $password,
                ]);

                $user = $stmt->fetch();

                if ($user) {
                    $this->setUser($user['name'], $user['surname'], $user['email'], $user['phone'], $user['role'], $user['password']);
                    $_SESSION['user'] = $this;
                    return true;
                }

                return false;

            } catch (PDOException $e) {
                throw new Exception($e->getMessage());
            }
        }
}