<?php

require_once __DIR__ . '/Database.php';

class SlidesDB extends Database {

	public function find() {
		$statement = $this->pdo->query('SELECT * FROM cv06_slides');
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

}
