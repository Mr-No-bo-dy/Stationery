<?php

namespace app\models\site;

use app\vendor\Model;
use Exception;
use PDOException;

class User extends Model
{
    public $tableName = 'users';
    protected $id;
    public $fillable =
        [
            'name' => '',
            'surname' => '',
            'email' => '',
            'phone' => '',
            'role' => '',
            'password' => '',
            'photo' => '',
        ];

    public function setUser(
        string $name,
        string $surname,
        string $email,
        string $phone,
        string $password,
        ?string $role = 'user',
        ?string $photo = 'default.png'

    )
    {
        $this->fillable['name'] = $name;
        $this->fillable['surname'] = $surname;
        $this->fillable['email'] = $email;
        $this->fillable['phone'] = $phone;
        $this->fillable['role'] = $role;
        $this->fillable['photo'] = $photo;
        $this->fillable['password'] = $password;

        $pdo = parent::builder();
        $sql = "SELECT id FROM $this->tableName WHERE name = :name AND password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'name' => $this->fillable['name'],
            'password' => $this->fillable['password'],
        ]);
        $this->id = $stmt->fetchColumn();


    }

    /**
     * @throws Exception
     */

    // User registration
    public function register(
        string $name,
        string $surname,
        string $email,
        string $phone,
        string $password
    ): void
    {
        // validation
        try {
            if (strlen($name) < 2) {

                throw new Exception('Name must be at least 2 characters');

            } else if (strlen($surname) < 2) {

                throw new Exception('Surname must be at least 2 characters');

            } else if (!preg_match('/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/', $email)) {

                throw new Exception('Email is invalid');

            } else if (strlen($phone) < 9) {

                throw new Exception('Phone number must be at least 9 characters');

            } else if (strlen($password) < 4) {

                throw new Exception('Password must be at least 4 characters');

            }
            try {
                $pdo = parent::builder();
                $sql = "SELECT email, phone FROM $this->tableName where email = :email or phone = :phone";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'email' => $email,
                    'phone' => $phone,
                ]);

                if ($stmt->fetch()) {
                    throw new Exception('User`s email or phone already exists');
                }

            } catch (PDOException $e) {
                throw new Exception($e->getMessage());
            }

            // seting user to db
            $this->setUser($name, $surname, $email, $phone, $password);

            $pdo = parent::builder();
            $sql = "INSERT INTO $this->tableName (name, surname, email, phone, role, password, photo) VALUES (:name, :surname, :email, :phone, :role, :password, :photo)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'name' => $this->fillable['name'],
                'surname' => $this->fillable['surname'],
                'email' => $this->fillable['email'],
                'phone' => $this->fillable['phone'],
                'role' => $this->fillable['role'],
                'password' => password_hash( $this->fillable['password'],  PASSWORD_BCRYPT, ['cost' => 12]),
                'photo' => $this->fillable['photo']
            ]);
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }

    }

    /**
     * @throws Exception
     */

    // User login
    public function login($name, $password): bool
    {
        try {
            $pdo = parent::builder();
            $sql = "SELECT * FROM $this->tableName WHERE name = :name";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'name' => $name
            ]);

            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $this->setUser($user['name'], $user['surname'], $user['email'], $user['phone'], $user['password'], $user['role']);
                $_SESSION['user'] = $this;
                return true;
            }

        } catch (PDOException $e) {
            throw new Exception($e->getMessage() . 'ERROR');

        }
        return false;
    }

    public function update(
        string $name,
        string $surname,
        string $email,
        string $phone,
        string $password
    ): void
    {
        // validation
        try {
            if (strlen($name) < 2) {

                throw new Exception('Name must be at least 2 characters');

            } else if (strlen($surname) < 2) {

                throw new Exception('Surname must be at least 2 characters');

            } else if (!preg_match('/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/', $email)) {

                throw new Exception('Email is invalid');

            } else if (strlen($phone) < 9) {

                throw new Exception('Phone number must be at least 9 characters');

            }  else if (strlen($password) < 4) {

                throw new Exception('Password must be at least 4 characters');
            }
            try {
                $pdo = parent::builder();
                $sql = "SELECT email, phone FROM $this->tableName where (email = :email or phone = :phone) and id != :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'email' => $email,
                    'phone' => $phone,
                    'id' => $this->id
                ]);

                if ($stmt->fetch()) {
                    throw new Exception('User`s email or phone already exists');
                }

            } catch (PDOException $e) {
                throw new Exception($e->getMessage());
            }

            // seting user to db
            $this->setUser($name, $surname, $email, $phone, $password);

            $pdo = parent::builder();
            $sql = "UPDATE $this->tableName SET name = :name, surname = :surname, email = :email, phone = :phone, role = :role, password = :password, photo = :photo WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'name' => $this->fillable['name'],
                'surname' => $this->fillable['surname'],
                'email' => $this->fillable['email'],
                'phone' => $this->fillable['phone'],
                'role' => $this->fillable['role'],
                'password' => password_hash( $this->fillable['password'],  PASSWORD_BCRYPT, ['cost' => 12]),
                'photo' => $this->fillable['photo'],
                'id' => $this->id
            ]);
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }

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
}