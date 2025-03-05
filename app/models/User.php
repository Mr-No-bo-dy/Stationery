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
            'name',
            'surname',
            'email',
            'phone',
            'role',
            'password',
            'photo'
        ];

    /** User registration
     * @throws Exception
     */
    public static function register(array $array): null|string
    {
        // validation
        try {
            if (strlen($array['name']) < 2) {

                throw new Exception('Name must be at least 2 characters');

            } else if (strlen($array['surname']) < 2) {

                throw new Exception('Surname must be at least 2 characters');

            } else if (!preg_match('#^[a-zA-Z][a-zA-Z0-9._%+-]*[a-zA-Z0-9]@[a-zA-Z0-9-]*[a-zA-Z0-9](\.[a-zA-Z]{2,}){1,2}$#', $array['email'])) {

                throw new Exception('Email is invalid');

            } else if (!preg_match('#^\+[0-9]{1,4}[ -]?(( [0-9]{1,3} )|\([0-9]{1,3}\)|[0-9]{1,3})[ -]?([0-9][ -]?){6}[0-9]$#', $array['phone'])) {

                throw new Exception('Phone number must be at least 9 characters');

            } else if ($array['password'] != $array['repeatPassword']) {

                throw new Exception('Passwords do not match');

            } elseif (strlen($array['password']) < 8) {
                throw new Exception ('Your Password Must Contain At Least 8 Characters!');
            } elseif (!preg_match("#[a-zA-Z]+#", $array['password'])) {
                throw new Exception('Your Password Must Contain At Least 1 Letter!');
            } elseif (!preg_match("#[0-9]+#", $array['password'])) {
                throw new Exception('Your Password Must Contain At Least 1 Number!');
            }
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


            // seting user to db
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

            return $e->getMessage();
        }
        return null;
    }


    /** User login
     * @throws Exception
     */
    public static function login(string $login, string $password): null|string
    {
        try {

            if (empty($login)) {

                throw new Exception('Login must be not empty');
            } else if (empty($password)) {

                throw new Exception('Password must be not empty');
            }

            if (str_contains($login, '@')) {
                $sql = "SELECT * FROM users WHERE email = :login";
            } else {
                $sql = "SELECT * FROM users WHERE phone = :login";
            }
            $stmt = self::builder()->prepare($sql);
            $stmt->execute(['login' => $login]);

            $user = $stmt->fetch();

            if (!$user) {
                throw new Exception('User not found');
            }
            if (!password_verify($password, $user['password'])) {

                throw new Exception('Password is incorrect');
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }

        $_SESSION['user'] = $user;
        return null;
    }


    //user self update data
    public static function update(array $array): null|string
    {
        try {
            if (strlen($array['name']) < 2) {

                throw new Exception('Name must be at least 2 characters');

            } else if (strlen($array['surname']) < 2) {

                throw new Exception('Surname must be at least 2 characters');

            } else if (!preg_match('#^[a-zA-Z][a-zA-Z0-9._%+-]*[a-zA-Z0-9]@[a-zA-Z0-9-]*[a-zA-Z0-9](\.[a-zA-Z]{2,}){1,2}$#', $array['email'])) {

                throw new Exception('Email is invalid');

            } else if (!preg_match('#^\+[0-9]{1,4}[ -]?(( [0-9]{1,3} )|\([0-9]{1,3}\)|[0-9]{1,3})[ -]?([0-9][ -]?){6}[0-9]$#', $array['phone'])) {

                throw new Exception('Phone number must be at least 9 characters');

            }
            $pdo = parent::builder();

            $sql = "SELECT email, phone FROM users WHERE (email = :email OR phone = :phone) AND id != :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':email' => $array['email'],
                ':phone' => $array['phone'],
                ':id' => $array['id']
            ]);

            $result = $stmt->fetch();
            if ($result) {
                if ($result['email'] === $array['email']) {

                    throw new Exception('Email is already registered');

                } elseif ($result['phone'] === $array['phone']) {

                    throw new Exception('Phone number is already registered');
                }
            }

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

            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $array['id']]);
            $_SESSION['user'] = $stmt->fetch();

        } catch (Exception $e) {
            return 'Error updating user: ' . $e->getMessage();
        }
        return null;
    }

    //password change
    public static function passwordChange($oldPassword, $repeatPassword, $newPassword): null|string
    {
        try {
            if ($oldPassword != $repeatPassword) {
                throw new Exception('Passwords do not match');

            } else if (!password_verify($oldPassword, $_SESSION['user']['password'])) {
                throw new Exception('Old password is incorrect');

            } else if (strlen($newPassword < 8)) {
                throw new Exception ('Your Password Must Contain At Least 8 Characters!');

            } else if (!preg_match("#[a-zA-Z]+#", $newPassword)) {
                throw new Exception('Your Password Must Contain At Least 1 Letter!');

            } else if (!preg_match("#[0-9]+#", $newPassword)) {
                throw new Exception('Your Password Must Contain At Least 1 Number!');

            }
            $sql = "UPDATE users SET password = :password WHERE id = :id";
            $stmt = self::builder()->prepare($sql);
            $stmt->execute([
                'password' => password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]),
                'id' => $_SESSION['user']['id']
            ]);

            $_SESSION['user']['password'] = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);

        } catch (Exception $e) {
            return $e->getMessage();
        }

        return null;
    }


    // setting profile photo
    public static function setProfilePhoto($file): null|string
    {
        try {
            if (!isset($_SESSION['user']['id'])) {
                return throw new Exception("User not authenticated!");
            }

            $uploadDir = "app/resources/img/users/";
            $fileName = basename($file["name"]);
            $fileTmpName = $file["tmp_name"];
            $fileSize = $file["size"];
            $fileError = $file["error"];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowed = ["jpg", "jpeg", "png", "gif"];

            if ($fileError !== 0) {
                throw new Exception("Error uploading file!");
            }

            if (!in_array($fileExt, $allowed)) {
                throw new Exception("Invalid file type! Only JPG, JPEG, PNG, and GIF are allowed.");
            }

            if ($fileSize > 5 * 1024 * 1024) {
                throw new Exception("File size too large! Maximum allowed is 5MB.");
            }

            $newFileName = $_SESSION['user']['id'] . "." . $fileExt;
            $targetFilePath = $uploadDir . $newFileName;

            if ($_SESSION['user']['photo'] !== 'default.png') {
                unlink($uploadDir . $_SESSION['user']['photo']);
            }
            if (!move_uploaded_file($fileTmpName, $targetFilePath)) {
                throw new Exception("Failed to move uploaded file!");
            }

            $sql = "UPDATE users SET photo = :photo WHERE id = :id";
            $stmt = self::builder()->prepare($sql);
            $stmt->execute([
                'photo' => $newFileName,
                'id' => $_SESSION['user']['id']
            ]);

            $_SESSION['user']['photo'] = $newFileName;

        } catch (Exception $e) {

            return $e->getMessage();
        }
        return null;
    }

    //delete users photo
    public static function deleteProfilePhoto(): string
    {
        $sql = "UPDATE users SET photo = 'default.png' WHERE id = :id";
        $stmt = self::builder()->prepare($sql);
        $stmt->execute([
            'id' => $_SESSION['user']['id']
        ]);

        if ($stmt) {
            unlink("app/resources/img/users/" . $_SESSION['user']['photo']);

            $_SESSION['user']['photo'] = 'default.png';

            return 'photo deleted successfully';
        }
        return 'Error deleting photo';
    }


// Admin Methods

    /** Getting all Users with filters or without
     * @throws Exception
     */
    public static function getAll($role = null, $search = null): array
    {
        try {
            $sql = "SELECT * FROM `users` WHERE id != :id";
            $params = [
                'id' => $_SESSION['user']['id']
            ];

            if ($role && $role !== 'all') {
                $sql .= " AND role = :role";
                $params['role'] = $role;
            } else if ($_SESSION['user']['role'] == 'admin') {
                // Admins can only see users by default
                $sql .= " AND role = 'user'";
            }

            if ($search) {
                $searchPattern = "%{$search}%";
                $sql .= " AND (id LIKE :search_id OR name LIKE :search_name OR 
                     surname LIKE :search_surname OR email LIKE :search_email OR 
                     phone LIKE :search_phone)";

                $params['search_id'] = $searchPattern;
                $params['search_name'] = $searchPattern;
                $params['search_surname'] = $searchPattern;
                $params['search_email'] = $searchPattern;
                $params['search_phone'] = $searchPattern;
            }

            $stmt = self::builder()->prepare($sql);
            $stmt->execute($params);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage() . ' ERROR');
        }
    }


    //Getting user by id for editing
    public static function getById($id): array
    {
        try {
            $sql = "SELECT * FROM users where id = :id";
            $stmt = self::builder()->prepare($sql);
            $stmt->execute([
                'id' => $id]);
            return $stmt->fetch();

        } catch (Exception $e) {

            throw new Exception($e->getMessage() . 'ERROR');
        }
    }


    // Save edited user
    public static function edit(array $array): null|string
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
            // seting user to db
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

        } catch (Exception $e) {

            return $e->getMessage();
        }

        return null;
    }


    // Delete user
    public static function delete($id): null|string
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = self::builder()->prepare($sql);
            $stmt->execute([
                'id' => $id
            ]);
            if (!$stmt->rowCount()) {
                throw new Exception('User not found');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return null;
    }

}