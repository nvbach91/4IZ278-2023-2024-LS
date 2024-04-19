<?php

require_once __DIR__ . '/Database.php';

class ProductsDB extends Database {

	public function find() {
		$statement = $this->pdo->query('SELECT * FROM cv06_products');
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public function findByCategory($category_id) {
		$statement = $this->pdo->prepare('SELECT * FROM cv06_products WHERE category_id=?');
		$statement->execute([$category_id]);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

}
