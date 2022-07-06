<?php

class CRUDFunctions {
    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function fetchAllLegendaryArmaments() {
		$stmt = $this->pdo->query("
            SELECT * 
            FROM elden_ring_legendary_armaments_acquired_items_tracker 
        ");
        return $stmt->fetchAll();
	}

    function AcquiredLegendaryArmaments($id) {
        $sql = "
            UPDATE elden_ring_legendary_armaments_acquired_items_tracker 
            SET
                acquired = 1
            WHERE id = :id
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function NewLegendaryArmaments($name, $link) {
        if(!$link) {
            echo "no link";
            $link = "https://eldenring.wiki.fextralife.com/{$name}";
        } else {
            echo "link";
            $link = "https://eldenring.wiki.fextralife.com/{$link}";
        }
        $name = ucwords($name);
        $sql = "
            INSERT INTO elden_ring_legendary_armaments_acquired_items_tracker  (
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

    function DeleteLegendaryArmaments($id) {
        $sql = "
            DELETE FROM elden_ring_legendary_armaments_acquired_items_tracker  
            WHERE id = :id;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function fetchAllLegendaryAshenRemains() {
		$stmt = $this->pdo->query("
            SELECT * 
            FROM elden_ring_legendary_ashen_remains_acquired_items_tracker 
        ");
        return $stmt->fetchAll();
	}

    function AcquiredLegendaryAshenRemains($id) {
        $sql = "
            UPDATE elden_ring_legendary_ashen_remains_acquired_items_tracker 
            SET
                acquired = 1
            WHERE id = :id
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function NewLegendaryAshenRemains($input) {
        $input = ucwords($input);
        $sql = "
            INSERT INTO elden_ring_legendary_ashen_remains_acquired_items_tracker  (
                itemName)
            VALUES (
                :itemName)
            ";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':itemName', $input);
        $stmt->execute();
    }

    function DeleteLegendaryAshenRemains($id) {
        $sql = "
            DELETE FROM elden_ring_legendary_ashen_remains_acquired_items_tracker  
            WHERE id = :id;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

$crudFunctions = new CRUDFunctions($pdo);

?>