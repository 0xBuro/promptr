<?php

class UserService
{
    private $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function registerUser($username, $password)
    {
        $checkDuplicate = $this->getUserByUsername($username);
        $hashedPassword = $this->hashAndSaltPassword($password);

        if ($hashedPassword !== null && $checkDuplicate == null) {
            $hash = strtok($hashedPassword, ':');
            $salt = substr($hashedPassword, strpos($hashedPassword, ':') + 1);

            $query = "INSERT INTO user (user_username, user_password, user_salt) VALUES (:user_username, :user_password, :user_salt)";

            try {
                $stmt = $this->db->prepare($query);
                $stmt->bindValue(':user_username', $username);
                $stmt->bindValue(':user_password', $hash);
                $stmt->bindValue(':user_salt', $salt);

                $stmt->execute();

                return $this->db->lastInsertId();
            } catch (PDOException $e) {
                die("User retrieval error: " - $e->getMessage());
            }
        }
        return null;
    }

    private function hashAndSaltPassword($password, $salt = null)
    {
        if ($salt === null) {
            $salt = $this->randomizedSalt();
        }
        $hashedPassword = hash('sha256', $salt . $password);
        return $hashedPassword . ':' . $salt;
    }

    private function randomizedSalt()
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $saltLength = 16;
        $salt = '';

        for ($i = 0; $i < $saltLength; $i++) {
            $salt .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $salt;
    }

    public function generateAvatar($username)
    {
        $avatarURL = "https://robohash.org/{$username}";
        $query = "UPDATE user SET user_avatar = :avatar WHERE user_username = :username";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':avatar', $avatarURL);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Could not generate user avatar: " . $e->getMessage());
        }
    }

    public function loginUser($username, $password)
    {
        $user = $this->getUserByUsername($username);

        if ($user !== null) {
            $storedHashedPassword = $user['user_password'];
            $storedSalt = $user['user_salt'];

            $hashedPassword = $this->hashAndSaltPassword($password, $storedSalt);
            if (strtok($hashedPassword, ':') === $storedHashedPassword) {
                return true;
            }
        }
    }

    private function getUserByUsername($username)
    {
        $query = "SELECT * FROM user WHERE user_username = :username";

        if (!empty($username)) {
            try {
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user === false) {
                    return null;
                }

                return $user;
            } catch (PDOException $e) {
                die("User retrieval error: " - $e->getMessage());
            }
        }
        return null;
    }

    public function getUserById($userId)
    {
        $query = "SELECT * FROM user WHERE user_id = :userId";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':userId', $userId);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user === false) {
                return null;
            }

            return $user;
        } catch (PDOException $e) {
            die("User retrieval error: " . $e->getMessage());
        }
    }

    public function updateUserInfo($username, $info) {
        $query = "UPDATE user SET user_info = :info WHERE user_username = :username";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':info', $info);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("User info update failed: " . $e->getMessage());
        }
    }

    public function updateUserAvatar($username, $avatarURL) {
        $query = "UPDATE user SET user_avatar = :avatarURL WHERE user_username = :username";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':avatarURL', $avatarURL);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            die("User avatar update failed: " . $e->getMessage());
        }
    }

}
