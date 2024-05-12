<?php
require_once __DIR__ . '/Database.php';

class ProductsDatabase extends Database
{
    protected $tableName = 'Product';
    protected $tableNameType = 'ProductTypes';
    protected $tableNameRelationType = 'ProductType';

    // public function readAllProducts()
    // {
    //     $sql = "SELECT * FROM $this->tableProduct";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function readAllProducts()
    {
        //return $this->readAll($this->tableProduct);
        return $this->readAll($this->tableName);
    }

    public function readAllProductTypes()
    {
        $sql = "SELECT * FROM $this->tableNameType";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function readProductsByType($idProductType)
    {
        $sqlKey = 'idProduct';
        $sqlId = 'idProductType';
        $sql = "SELECT * FROM $this->tableName JOIN $this->tableNameRelationType ON $this->tableName.$sqlKey = $this->tableNameRelationType.$sqlKey WHERE $this->tableNameRelationType.$sqlId = :idProductType";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':idProductType' => $idProductType]);
        return $statement->fetchAll();
    }
}
