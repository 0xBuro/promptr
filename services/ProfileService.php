<?php

/* 

    ProfileService - genereller Profil Service, welches mit der Datenbank kommuniziert.
    Funktionen:
    - Benutzerprofil mit allen wesentlichen Angaben auswählen
    - aktuellste Prompts eines Nutzers auswählen

*/

class ProfileService
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getUserProfile($username) {    
        $query = "SELECT user_username, user_avatar, user_info FROM user WHERE user_username = :username";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $profile = $stmt->fetch(PDO::FETCH_ASSOC);

            return $profile;
        } catch (PDOException $e) { 
            die("Profile retrieval erro: " . $e->getMessage());
        }
        return null;
    }

    public function getLatestPrompts($username) {
        $query = "SELECT prompt_text, prompt_img_src, prompt_date 
                  FROM prompt JOIN user ON prompt_owner = user_id
                  WHERE user_username = :username
                  ORDER BY prompt_date DESC";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $prompts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $prompts;
        } catch (PDOException $e) {
            die("Prompt retrieving error: " . $e->getMessage());
        }          
    }

    public function followUser($username, $authUser) {
        $query = "INSERT INTO follower (user_id, follower_id) VALUES (:user_id, :follower_id)";

        $profileUserId = $this->getProfileUserId($username);
        $following = $this->checkFollowStatus($username, $authUser);

        if($profileUserId !== null && !$following) {
            try {
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':user_id', $profileUserId);
                $stmt->bindParam(':follower_id', $authUser['user_id']);
                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                die("error during follower update: " - $e->getMessage());
            }
        }  
    }

    public function unfollowUser($username, $authUser) {
        $query = "DELETE FROM follower WHERE user_id = :user_id AND follower_id = :follower_id";

        $profileUserId = $this->getProfileUserId($username);
        $following = $this->checkFollowStatus($username, $authUser);

        if($profileUserId !== null && $following) {
            try {
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':user_id', $profileUserId);
                $stmt->bindParam(':follower_id', $authUser['user_id']);
                $stmt->execute();

                return true;
            } catch (PDOException $e) {
                die("error during follower delete: " - $e->getMessage());
            }
        }
    }

    public function checkFollowStatus($username, $authUser) {
        $query = "SELECT * FROM follower WHERE user_id = :user_id AND follower_id = :follower_id";

        $profileUserId = $this->getProfileUserId($username);

        if($profileUserId !== null) {
            try {
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':user_id', $profileUserId);
                $stmt->bindParam(':follower_id', $authUser['user_id']);
                $stmt->execute();

                $following = $stmt->fetch(PDO::FETCH_ASSOC);

                if($following === false) {
                    return false;
                }

                return true;
            } catch (PDOException $e) {
                die("error during follower status check: " - $e->getMessage());
            }
        }
    }

    private function getProfileUserId($profileUsername) {
        $query = "SELECT user_id FROM user WHERE user_username = :profile_username";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':profile_username', $profileUsername);
            $stmt->execute();

            $profileUserId = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($profileUserId === false) {
                return null;
            }

            return $profileUserId['user_id'];
        } catch (PDOException $e) {
            die("id retrieval error: " - $e->getMessage());
        }
        return null;
    }

    public function getFollowerCount($username) {
        $query = "SELECT count(follower.user_id) as followers
                  FROM follower JOIN user ON follower.user_id = user.user_id
                  WHERE user_username = :username";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $followerCount = $stmt->fetch(PDO::FETCH_ASSOC);

            if($followerCount === false) {
                return null;
            }

            return $followerCount;
        } catch (PDOException $e) { 
            die("follower count retrieval error: " - $e->getMessage());
        }         
    }

}

