<?php

namespace app\models\admin;

use app\vendor\Model;
use Exception;
use PDOException;

class User extends Model
{
    public $tableName = 'users';
    protected $id;
    public $fillable =
        [
            'name',
            'surname',
            'email',
            'phone',
            'role',
            'password'
        ];

//
//
//if will be needed to add new user from admin
//
//
//    //setting user data
//    public function setUser(
//        string $name,
//        string $surname,
//        string $email,
//        string $phone,
//        string $role,
//        string $password
//    )
//    {
//        $this->fillable['name'] = $name;
//        $this->fillable['surname'] = $surname;
//        $this->fillable['email'] = $email;
//        $this->fillable['phone'] = $phone;
//        $this->fillable['role'] = $role;
//        $this->fillable['password'] = $password;
//
//        $pdo = parent::builder();
//        $sql = "SELECT id FROM $this->tableName WHERE name = :name AND password = :password";
//        $stmt = $pdo->prepare($sql);
//        $stmt->execute([
//            'name' => $this->fillable['name'],
//            'password' => $this->fillable['password'],
//        ]);
//        $this->id = $stmt->fetchColumn();
//
//        $_SESSION['user'] = $this;
//    }


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
    public static function edit($id, $name, $surname, $email, $phone, $role): bool
    {
        try {
            $pdo = parent::builder();
            $sql = "UPDATE users SET name = :name, surname = :surname, email = :email, phone = :phone, role = :role WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'surname' => $surname,
                'email' => $email,
                'phone' => $phone,
                'role' => $role,
                'id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
//            throw new Exception($e->getMessage() . 'ERROR');
            return false;

        }
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
//            throw new Exception($e->getMessage() . 'ERROR');
            return false;
        }
        return true;
    }


}