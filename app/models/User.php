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
    public static function register(array $array): void
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

        //temp password check
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


    /** User login
     * @throws Exception
     */
    public static function login(string $login, string $password): bool
    {
        try {

            if (str_contains($login, '@')) {
                $sql = "SELECT * FROM users WHERE email = :login";
            } else {
                $sql = "SELECT * FROM users WHERE phone = :login";
            }
            $stmt = self::builder()->prepare($sql);
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


    //user self update data
    public static function update(array $array)
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

        $sql = "select * from users where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $array['id']]);
        $_SESSION['user'] = $stmt->fetch();

        return null;
    }

    //password change
    public static function passwordChange($oldPassword, $repeatPassword, $newPassword)
    {
        try {
            if ($oldPassword != $repeatPassword) {
                throw new Exception('Passwords do not match');
            } else if (strlen($newPassword) < 4) {

                throw new Exception('Password must be at least 4 characters');

            } else if (!password_verify($oldPassword, $_SESSION['user']['password'])) {
                throw new Exception('Old password is incorrect');
            }
// CORRECT PASSWORD CHECK
//            }elseif (strlen($newPassword <= 8) {
//                throw new Exception ( 'Your Password Must Contain At Least 8 Characters!');
//            }
//            elseif(!preg_match("#[a-zA-Z]+#", $newPassword) {
//                throw new Exception( 'Your Password Must Contain At Least 1 Letter!');
//            }
//            elseif(!preg_match("#[0-9]+#", $newPassword) {
//                throw new Exception('Your Password Must Contain At Least 1 Number!');
//            }
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

            $uploadDir = "app/resources/img/users/"; // Directory where files will be stored
            $fileName = basename($file["name"]);
            $fileTmpName = $file["tmp_name"];
            $fileSize = $file["size"];
            $fileError = $file["error"];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Allowed file types
            $allowed = ["jpg", "jpeg", "png", "gif"];

            // Check for errors
            if ($fileError !== 0) {
                return throw new Exception("Error uploading file!");
            }

            // Validate file type
            if (!in_array($fileExt, $allowed)) {
                return throw new Exception("Invalid file type! Only JPG, JPEG, PNG, and GIF are allowed.");
            }

            // Validate file size (max 5MB)
            if ($fileSize > 5 * 1024 * 1024) {
                return throw new Exception("File size too large! Maximum allowed is 5MB.");
            }

            // Generate a unique name to prevent overwriting
            $newFileName = $_SESSION['user']['id'] . "." . $fileExt;
            $targetFilePath = $uploadDir . $newFileName;

            // Move file to the uploads directory
            if ($_SESSION['user']['photo'] !== 'default.png') {
                unlink($uploadDir . $_SESSION['user']['photo']);
            }
            if (!move_uploaded_file($fileTmpName, $targetFilePath)) {
                return throw new Exception("Failed to move uploaded file!");
            }

            // Update database with new photo name
            $sql = "UPDATE users SET photo = :photo WHERE id = :id";
            $stmt = self::builder()->prepare($sql);
            $stmt->execute([
                'photo' => $newFileName,
                'id' => $_SESSION['user']['id']
            ]);

            // Update session photo
            $_SESSION['user']['photo'] = $newFileName;

            return null;
        } catch (Exception $e) {

            return $e->getMessage();
        }
    }

    public static function deleteProfilePhoto()
    {
        $sql = "UPDATE users SET photo = 'default.png' WHERE id = :id";
        $stmt = self::builder()->prepare($sql);
        $stmt->execute([
            'id' => $_SESSION['user']['id']
        ]);

        // Update session photo
        $_SESSION['user']['photo'] = 'default.png';

        return 'photo deleted successfully';
    }

// admin methods

    /** Getting all Users
     * @throws Exception
     */
    public static function getAll(): array
    {
        try {
            if ($_SESSION['user']['role'] == 'admin') {
                $sql = "SELECT * FROM `users` WHERE id != :id and role = 'user';";
            } else if ($_SESSION['user']['role'] == 'SuperAdmin') {
                $sql = "SELECT * FROM `users` WHERE id != :id ORDER BY CASE WHEN role = 'admin' THEN 1 ELSE 2 END, role;";
            }

            $stmt = self::builder()->prepare($sql);
            $stmt->execute([
                'id' => $_SESSION['user']['id']
            ]);
            return $stmt->fetchAll();

        } catch (PDOException $e) {

            throw new Exception($e->getMessage() . 'ERROR');
        }
    }


    //Getting user by id
    public static function getById($id): array
    {
        try {
            $sql = "SELECT * FROM users where id = :id";
            $stmt = self::builder()->prepare($sql);
            $stmt->execute([
                'id' => $id]);
            return $stmt->fetch();

        } catch (PDOException $e) {

            throw new Exception($e->getMessage() . 'ERROR');
        }
    }


    // Save edited user
    public static function edit(array $array)
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


        } catch (Exception $e) {

            return $e->getMessage();
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
        return null;

    }


    // Delete user
    public static function delete($id): bool
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = self::builder()->prepare($sql);
            $stmt->execute([
                'id' => $id
            ]);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

}