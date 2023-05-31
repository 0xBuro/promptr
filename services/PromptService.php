<?php

/* 

    PromptService - genereller Prompt Service, welches mit der Datenbank kommuniziert.
    Funktionen:
    - Prompt Objekt generieren
    - Prompt in der Datenbank ablegen
    - Prompts JOIN nach Usernamen zum Anzeigen im Feed

*/


class PromptService
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function generatePromptObject($username, $promptInput) {
        $promptObject = (object) [
            'user_username' => $username,
            'promptInput' => $promptInput,
        ];

        return $promptObject;
    }

    public function insertPrompt($promptText, $promptImage, $user_id) {    
        $query = "INSERT INTO prompt (prompt_text, prompt_img_src, prompt_owner) VALUES (:promptText, :promptImage, :user_id)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':promptText', $promptText);
            $stmt->bindParam(':promptImage', $promptImage);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) { 
            die("Profile retrieval erro: " . $e->getMessage());
        }
    }

    public function getPromptFeed() {
        $query = "SELECT prompt.prompt_text, prompt.prompt_img_src, prompt.prompt_date, user.user_username, user.user_avatar 
                  FROM prompt 
                  INNER JOIN user ON prompt.prompt_owner = user.user_id 
                  WHERE user.user_id = prompt.prompt_owner 
                  ORDER BY prompt.prompt_date DESC";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $prompts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $prompts;
        } catch (PDOException $e) {
            die("feed retrieving error: " . $e->getMessage());
        }                   
    }

}

