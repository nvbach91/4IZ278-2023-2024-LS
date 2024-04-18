<?php

require_once __DIR__ . '/Database.php';

class CategoriesDB extends Database {

	public function find() {
		$statement = $this->pdo->query('SELECT * FROM cv06_categories');
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

}
