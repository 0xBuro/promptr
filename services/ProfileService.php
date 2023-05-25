<?php

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

}

