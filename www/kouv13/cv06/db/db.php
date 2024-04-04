<?php
const DB_HOSTNAME = 'localhost';
const DB_NAME = 'kouv13';
const DB_USERNAME = 'kouv13';
const DB_PASSWORD = '';


class DatabaseConnection
{
    private static $pdo;
    public static function getPDOConnection()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO(
                'mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_NAME,
                DB_USERNAME,
                DB_PASSWORD
            );
        }
        return self::$pdo;
    }
}



abstract class Database
{
    protected $pdo;
    public function __construct()
    {
        $this->pdo = DatabaseConnection::getPDOConnection();
    }
}


class ProductsDB extends Database
{
    public function getProducts()
    {
        $statement = $this->pdo->prepare('SELECT * FROM cv06_products');
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public function getCategoryProducts($category)
    {
        $statement = $this->pdo->prepare('SELECT * FROM cv06_products WHERE category_id = :category');

        $statement->bindParam(':category', $category);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}

class CategoriesDB extends Database
{
    public function getCategories()
    {
        $statement = $this->pdo->prepare('SELECT * FROM cv06_categories');
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}

class SlidesDB extends Database
{
    public function getSlides()
    {
        $statement = $this->pdo->prepare('SELECT * FROM cv06_slides');
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}

$productsDB = new ProductsDB;
$categoriesDB = new CategoriesDB;
$slidesDB = new SlidesDB;