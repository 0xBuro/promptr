<?php

/* 

    AuthService - genereller Authentifizierungsservice, welches mit der Datenbank kommuniziert.
    Funktionen:
    - Benutzer authentifizieren und Nutzer Objekt als PHP-Server Session zurückgeben
    - vereinfacht die Authentifizierungsprüfung in der gesamten App

*/

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
        } else {
            return null;
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

