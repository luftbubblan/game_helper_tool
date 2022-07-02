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

    function Acquired($id) {
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
        $name = $input;
        $link = str_replace(' ', '+', $input);
        $link = "https://eldenring.wiki.fextralife.com/{$link}";
        $sql = "
            INSERT INTO elden_ring_acquired_items_tracker (
                name,
                link)
            VALUES (
                :name,
                :link)
            ";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':link', $link);
        $stmt->execute();
    }
}

$crudFunctions = new CRUDFunctions($pdo);

?>