<?php

class CRUDFunctions {
    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function fetchAllItems($tableName) {
		$stmt = $this->pdo->query("
            SELECT * 
            FROM .$tableName 
        ");
        return $stmt->fetchAll();
	}

    function AcquireItem($id, $tableName) {
        $sql = "
            UPDATE .$tableName 
            SET
                acquired = 1
            WHERE id = :id
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function NewItem($name, $link, $tableName) {
        if(!$link) {
            $link = "https://eldenring.wiki.fextralife.com/{$name}";
        } else {
            $link = "https://eldenring.wiki.fextralife.com/{$link}";
        }
        $name = ucwords($name);
        $sql = "
            INSERT INTO .$tableName  (
                itemName,
                itemLink)
            VALUES (
                :itemName,
                :itemLink)
            ";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':itemName', $name);
        $stmt->bindParam(':itemLink', $link);
        $stmt->execute();
    }

    function DeleteItem($id, $tableName) {
        $sql = "
            DELETE FROM .$tableName  
            WHERE id = :id;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

$crudFunctions = new CRUDFunctions($pdo);

?>