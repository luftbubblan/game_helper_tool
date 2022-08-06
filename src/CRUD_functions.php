<?php

class CRUDFunctions {
    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function fetchAllItemsWhere($tableName, $typeOfTrackerNumber) {
		$sql = "
            SELECT * 
            FROM .$tableName
            WHERE typeOfTrackerNumber = :typeOfTrackerNumber
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':typeOfTrackerNumber', $typeOfTrackerNumber);
        $stmt->execute();
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

    function NewItem($name, $link, $tableName, $trackerNumber) {
        if(!$link) {
            $link = "https://eldenring.wiki.fextralife.com/{$name}";
        } else {
            $link = "https://eldenring.wiki.fextralife.com/{$link}";
        }
        $name = ucwords($name);
        $sql = "
            INSERT INTO .$tableName  (
                itemName,
                itemLink,
                typeOfTrackerNumber)
            VALUES (
                :itemName,
                :itemLink,
                :typeOfTrackerNumber)
            ";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':itemName', $name);
        $stmt->bindParam(':itemLink', $link);
        $stmt->bindParam(':typeOfTrackerNumber', $trackerNumber);
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