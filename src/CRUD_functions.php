<?php

class CRUDFunctions {
    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function fetchAllItems() {
		$stmt = $this->pdo->query("
            SELECT * 
            FROM elden_ring_acquired_items_tracker 
        ");
        return $stmt->fetchAll();
	}

    function AcquiredItem($id) {
        $sql = "
            UPDATE elden_ring_acquired_items_tracker
            SET
                acquired = 1
            WHERE id = :id
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function NewItem($input) {
        $input = ucwords($input);
        $sql = "
            INSERT INTO elden_ring_acquired_items_tracker (
                itemName)
            VALUES (
                :itemName)
            ";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':itemName', $input);
        $stmt->execute();
    }

    function DeleteItem($id) {
        $sql = "
            DELETE FROM elden_ring_acquired_items_tracker 
            WHERE id = :id;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

$crudFunctions = new CRUDFunctions($pdo);

?>