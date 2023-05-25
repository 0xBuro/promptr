<?php

class AuthService
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function authUser($username) {    
        $user = $this->getAuthUser($username);
        
        if($user !== null) {
           return $_SESSION['authUser'] = $user;
        }
        
    }

    private function getAuthUser($username) {
        $query = "SELECT user_id, user_username, user_avatar, user_info FROM user WHERE user_username = :username";

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
            die("User retrieval error: " . $e->getMessage());
        }
    }
}

