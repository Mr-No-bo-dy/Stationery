<?php

namespace App\models;

use app\vendor\Model;
use Exception;
use PDOException;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'name' => '',
            'surname' => '',
            'email' => '',
            'phone' => '',
            'role' => '',
            'password' => '',
            'photo' => '',
        ];

    /**
     * @throws Exception
     */

    // User registration
    public static function register(
        array $array
    ): void
    {
        // validation
        try {
            if (strlen($array['name']) < 2) {

                throw new Exception('Name must be at least 2 characters');

            } else if (strlen($array['surname']) < 2) {

                throw new Exception('Surname must be at least 2 characters');

            } else if (!preg_match('#^[a-zA-Z][a-zA-Z0-9._%+-]*[a-zA-Z0-9]@[a-zA-Z0-9-]*[a-zA-Z0-9](\.[a-zA-Z]{2,}){1,2}$#', $array['email'])) {

                throw new Exception('Email is invalid');

//            } else if (!preg_match('#^\+[0-9]{1,4}[ -]?(( [0-9]{1,3} )|\([0-9]{1,3}\)|[0-9]{1,3})[ -]?([0-9][ -]?){6}[0-9]$#', $array['phone'])) {
//
//                throw new Exception('Phone number must be at least 9 characters');

            } else if (strlen($array['password']) < 4) {

                throw new Exception('Password must be at least 4 characters');

            }

// CORRECT PASSWORD CHECK
//            }elseif (strlen($array['password']) <= 8) {
//                throw new Exception ( 'Your Password Must Contain At Least 8 Characters!');
//            }
//            elseif(!preg_match("#[a-zA-Z]+#",$array['password'])) {
//                throw new Exception( 'Your Password Must Contain At Least 1 Letter!');
//            }
//            elseif(!preg_match("#[0-9]+#",$array['password'])) {
//                throw new Exception('Your Password Must Contain At Least 1 Number!');
//            }
            try {
                $pdo = parent::builder();
                $sql = "SELECT * FROM users WHERE email = :email OR phone = :phone";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':email' => $array['email'],
                    ':phone' => $array['phone']
                ]);

                if ($stmt->fetch()) {
                    throw new Exception('User`s email or phone already exists');
                }

            } catch (PDOException $e) {
                throw new Exception($e->getMessage());
            }

            // seting user to db
            $pdo = parent::builder();
            $sql = "INSERT INTO users (name, surname, email, phone, role, password, photo) VALUES (:name, :surname, :email, :phone, :role, :password, :photo)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'name' => $array['name'],
                'surname' => $array['surname'],
                'email' => $array['email'],
                'phone' => $array['phone'],
                'role' => 'user',
                'password' => password_hash($array['password'], PASSWORD_BCRYPT, ['cost' => 12]),
                'photo' => 'default.png'
            ]);
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }

    }

    /**
     * @throws Exception
     */

    // User login
    public static function login(string $login, string $password): bool
    {
        try {

            $pdo = parent::builder();
            if (str_contains($login, '@')) {
                $sql = "SELECT * FROM users WHERE email = :login";
            } else {
                $sql = "SELECT * FROM users WHERE phone = :login";
            }
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['login' => $login]);

            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                return true;
            }
            return false;

        } catch (PDOException $e) {
            throw new Exception('Authentication failed');
        }
    }

    public static function update(
        array $array

    )
    {
        try {
            $pdo = parent::builder();

            $sql = "SELECT id FROM users WHERE (email = :email OR phone = :phone) AND id != :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':email' => $array['email'],
                ':phone' => $array['phone'],
                ':id' => $array['id']
            ]);

            if ($stmt->fetch()) {
                throw new Exception('Email or phone number is already registered');
            }


        } catch (PDOException $e) {

            throw new Exception('Error checking user information');
        }


        // seting user to db

        $sql = "UPDATE users SET name = :name, surname = :surname, email = :email, phone = :phone, role = :role, password = :password WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name' => $array['name'],
            'surname' => $array['surname'],
            'email' => $array['email'],
            'phone' => $array['phone'],
            'role' => $array['role'],
            'password' => password_hash($array['password'], PASSWORD_BCRYPT, ['cost' => 12]),
            'id' => $array['id']
        ]);

        $sql = "select * from users where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $array['id']]);
        $_SESSION['user'] = $stmt->fetch();
        return null;


    }

    public static function setProfilePhoto($id, $photo): bool
    {
        try {
            $pdo = parent::builder();
            $sql = "UPDATE users SET photo = :photo WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'photo' => $photo,
                'id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage() . 'ERROR');
            return false;
        }
    }


    // admin

    /**
     * @throws Exception
     */

    //Getting all Users
    public static function getAll(): array
    {
        try {
            $pdo = parent::builder();
            $sql = "SELECT * FROM users";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();

        } catch (PDOException $e) {

            throw new Exception($e->getMessage() . 'ERROR');
        }
    }


    //Getting user by id
    public static function getById($id): array
    {
        try {
            $pdo = parent::builder();
            $sql = "SELECT * FROM users where id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id' => $id]);
            return $stmt->fetch();

        } catch (PDOException $e) {

            throw new Exception($e->getMessage() . 'ERROR');
        }
    }


    // Save edited user
    public static function edit(array $array): bool
    {
        try {
            $pdo = parent::builder();

            $sql = "SELECT id FROM users WHERE (email = :email OR phone = :phone) AND id != :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':email' => $array['email'],
                ':phone' => $array['phone'],
                ':id' => $array['id']
            ]);

            if ($stmt->fetch()) {
                throw new Exception('Email or phone number is already registered');
            }


        } catch (PDOException $e) {

            throw new Exception('Error checking user information');
        }
        $pdo = parent::builder();
        $sql = "UPDATE users SET name = :name, surname = :surname, email = :email, phone = :phone, role = :role WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name' => $array['name'],
            'surname' => $array['surname'],
            'email' => $array['email'],
            'phone' => $array['phone'],
            'role' => $array['role'],
            'id' => $array['id']
        ]);
        return true;

    }


    // Delete user
    public static function delete($id): bool
    {
        try {
            $pdo = parent::builder();
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id' => $id
            ]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

}