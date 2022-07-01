<?php

class CRUDFunctions {
    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function fetchAllItems() {
		$stmt = $this->pdo->query("
            SELECT * 
            FROM items 
        ");
        return $stmt->fetchAll();
	}

    function Acquired($id) {
        $sql = "
            UPDATE items
            SET
                Acquired = 1
            WHERE id = :id
        ";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

$crudFunctions = new CRUDFunctions($pdo);

?>