<?php
require_once __DIR__ . '/Database.php';

class ProductsDatabase extends Database
{
    protected $tableName = 'Product';
    protected $tableId = 'idProduct';
    protected $tablePrice = 'price';
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

    public function readCountAllProducts()
    {
        //return $this->readAll($this->tableProduct);
        return $this->readCountAll($this->tableName, $this->tableId);
    }

    public function readAllProductsPage($offset, $nItemsPerPagination)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY $this->tablePrice DESC LIMIT $nItemsPerPagination OFFSET ?;");
        $statement->bindValue(1, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function readAllProductTypes()
    {
        $sql = "SELECT * FROM $this->tableNameType";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function readAllProductTypesByName($newType)
    {
        $name = "typeName";
        $sqlTypeId = 'idProductType';

        $sql = "SELECT COUNT($sqlTypeId) FROM $this->tableNameType WHERE $name = :newTypeName";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':newTypeName', $newType);
        $statement->execute();
        return (int) $statement->fetchColumn();
    }

    public function readProductById($idProduct)
    {
        $sqlKey = 'idProduct';

        $sql = "SELECT * FROM $this->tableName WHERE $sqlKey = :idProduct";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':idProduct' => $idProduct]);
        return $statement->fetchAll();
    }

    public function readProductsByType($idProductType)
    {
        $sqlKey = 'idProduct';
        $sqlId = 'idProductType';
        $sql = "SELECT * FROM $this->tableName JOIN $this->tableNameRelationType ON $this->tableName.$sqlKey = $this->tableNameRelationType.$sqlKey WHERE $this->tableNameRelationType.$sqlId = :idProductType;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':idProductType' => $idProductType]);
        return $statement->fetchAll();
    }

    public function readProcutsByQuerryString($filterItems, $offset)
    {
        $productTypeIds = [];
        $caffeinFree = false;
        $giftSet = false;
        $caffeinFreeVar = 'false';
        $giftSetVar = 'false';
        $productTypeString = "*";
        for ($i = 0; $i < count($filterItems); $i++) {
            if (str_contains($filterItems[$i], "productType")) {
                $strArr = explode("=", $filterItems[$i]);
                array_push($productTypeIds, $strArr[1]);

                continue;
            }
            if (str_contains($filterItems[$i], "isGiftSet")) {
                $giftSet = true;
                $giftSetVar = 'true';
                continue;
            }
            if (str_contains($filterItems[$i], "isCaffeineFree")) {
                $caffeinFree = true;
                $caffeinFreeVar = 'true';
                continue;
            }
        }

        $integerValues = array_map('intval', $productTypeIds);
        $ids = implode(', ', $integerValues);

        $sqlKey = 'idProduct';
        $sqlTypeId = 'idProductType';
        $sqlGift = 'isGiftSet';
        $sqlCaff = 'isCaffeineFree';




        //$sql = "SELECT * FROM $this->tableNameRelationType";
        if (($giftSet || $caffeinFree) && isset($ids)) {
            $sql = "SELECT * FROM $this->tableName WHERE $sqlGift IN (true, :giftSet) AND $sqlCaff IN (true, :caffeineFree);";
        }
        if (count($productTypeIds) > 0) {
            $sql = ('SELECT DISTINCT p.* FROM ' . $this->tableName . ' p 
            JOIN producttype prt ON p.idProduct = prt.idProduct
            JOIN producttypes pt ON prt.idProductType = pt.idProductType
            WHERE pt.idProductType IN (' . $ids . ')');
        }

        if (count($productTypeIds) > 0 && (($giftSet || $caffeinFree) && isset($ids))) {
            $sql = ('SELECT DISTINCT p.* FROM ' . $this->tableName . ' p 
            JOIN producttype prt ON p.idProduct = prt.idProduct
            JOIN producttypes pt ON prt.idProductType = pt.idProductType
            WHERE pt.idProductType IN (' . $ids . ')
            AND ' . $sqlGift . ' IN (true, ' . $giftSetVar . ') AND ' . $sqlCaff . ' IN (true, ' . $caffeinFreeVar . ')');
        }

        $statement = $this->pdo->prepare($sql);

        // Bind the giftSet and caffeineFree parameters
        if (($giftSet || $caffeinFree) && count($productTypeIds) == 0) {
            $statement->bindValue(':giftSet', $giftSet); // Assuming $giftSet is defined elsewhere
            $statement->bindValue(':caffeineFree', $caffeinFree); // Assuming $caffeineFree is defined elsewher
        }



        // Bind the offset parameter
        // $offset = $currentPage * $nItemsPerPagination; // Assuming $currentPage is defined elsewhere

        // Execute the statement
        $statement->execute();

        // Fetch the results
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readProcutsByQuerryStringPage($filterItems, $offset, $nItemsPerPagination)
    {
        $productTypeIds = [];
        $caffeinFree = false;
        $giftSet = false;
        $productTypeString = "*";
        for ($i = 0; $i < count($filterItems); $i++) {
            if (str_contains($filterItems[$i], "productType")) {
                $strArr = explode("=", $filterItems[$i]);
                array_push($productTypeIds, $strArr[1]);

                continue;
            }
            if (str_contains($filterItems[$i], "isGiftSet")) {
                $giftSet = true;
                continue;
            }
            if (str_contains($filterItems[$i], "isCaffeineFree")) {
                $caffeinFree = true;
                continue;
            }
        }

        if ($giftSet) {
        }

        $placeholders = implode(',', array_fill(0, count($productTypeIds), '?'));

        $sqlKey = 'idProduct';
        $sqlTypeId = 'idProductType';
        $sqlGift = 'isGiftSet';
        $sqlCaff = 'isCaffeineFree';

        //$sql = "SELECT * FROM $this->tableNameRelationType";
        if (($giftSet || $caffeinFree) && count($productTypeIds) == 0) {
            $sql = "SELECT * FROM $this->tableName WHERE $sqlGift IN (true, :giftSet) AND $sqlCaff IN (true, :caffeineFree)
            ORDER BY $this->tablePrice DESC LIMIT $nItemsPerPagination OFFSET ?;";
        }
        if (count($productTypeIds) > 0) {
            // PROBLEM
            $sql = "SELECT p.* FROM $this->tableName p 
            JOIN ( SELECT DISTINCT prt.$sqlKey FROM $this->tableNameRelationType prt WHERE prt.$sqlTypeId IN ($placeholders))
            distinct_prt ON p.$sqlKey = distinct_prt.$sqlKey
            WHERE p.$sqlGift IN (true, :giftSet) AND p.$sqlCaff IN (true, :caffeineFree)
            ORDER BY p.$this->tablePrice DESC LIMIT $nItemsPerPagination OFFSET ?;;";
        }

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $offset, PDO::PARAM_INT);
        $statement->execute([':giftSet' => $giftSet, ':caffeineFree' => $caffeinFree]);
        return $statement->fetchAll();
    }

    public function readCountProcutsByQuerryString($filterItems)
    {
        $productTypeIds = [];
        $caffeinFree = false;
        $giftSet = false;
        $productTypeString = "*";
        for ($i = 0; $i < count($filterItems); $i++) {
            if (str_contains($filterItems[$i], "productType")) {
                $strArr = explode("=", $filterItems[$i]);
                array_push($productTypeIds, $strArr[1]);

                continue;
            }
            if (str_contains($filterItems[$i], "isGiftSet")) {
                $giftSet = true;
                continue;
            }
            if (str_contains($filterItems[$i], "isCaffeineFree")) {
                $caffeinFree = true;
                continue;
            }
        }

        if ($giftSet) {
        }

        for ($i = 0; $i < count($productTypeIds); $i++) {
            if ($i == count($productTypeIds) - 1) {
                $productTypeString .= $productTypeIds[$i] . ', ';
            } else {
                $productTypeString .= $productTypeIds[$i];
            }
        }

        $sqlKey = 'idProduct';
        $sqlTypeId = 'idProductType';
        $sqlGift = 'isGiftSet';
        $sqlCaff = 'isCaffeineFree';

        //$sql = "SELECT * FROM $this->tableNameRelationType";
        if (($giftSet || $caffeinFree) && count($productTypeIds) == 0) {
            $sql = "SELECT COUNT($this->tableId) FROM $this->tableName WHERE $sqlGift IN (true, :giftSet) AND $sqlCaff IN (true, :caffeineFree);";
        }
        if (count($productTypeIds) > 0) {
            $sql = "SELECT COUNT(p.$this->tableId) FROM $this->tableName p 
            JOIN ( SELECT DISTINCT prt.$sqlKey FROM $this->tableNameRelationType prt WHERE prt.$sqlTypeId IN (1,2,3,4))
            distinct_prt ON p.$sqlKey = distinct_prt.$sqlKey
            WHERE p.$sqlGift IN (true, :giftSet) AND p.$sqlCaff IN (true, :caffeineFree);";
        }

        $statement = $this->pdo->prepare($sql);
        $statement->execute([':giftSet' => $giftSet, ':caffeineFree' => $caffeinFree]);
        return $statement->fetchAll();
    }

    public function readProductTypes($idProduct)
    {
        $name = "typeName";
        $sqlKey = 'idProductType';
        $sqlProductId = "idProduct";
        $sql = "SELECT $this->tableNameType.$name FROM $this->tableNameType JOIN $this->tableNameRelationType ON $this->tableNameType.$sqlKey = $this->tableNameRelationType.$sqlKey WHERE $this->tableNameRelationType.$sqlProductId = :idProduct;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':idProduct' => $idProduct]);
        return $statement->fetchAll();
    }

    public function readProductTypesAll()
    {
        $name = "typeName";
        $sqlKey = 'idProductType';
        $sql = "SELECT $this->tableNameType.$name FROM $this->tableNameType JOIN $this->tableNameRelationType ON $this->tableNameType.$sqlKey = $this->tableNameRelationType.$sqlKey;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function createProductType($newType)
    {
        try {
            $this->pdo->beginTransaction();

            $name = "typeName";
            $sqlKey = 'idProductType';

            $sql = "INSERT INTO $this->tableNameType ($name) VALUES (:newTypeName);";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':newTypeName', $newType);
            $statement->execute();

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            // Rollback transaction if there is an error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function createProduct($name, $price, $discount, $isAvailable, $isCaffeineFree, $isGiftSet, $image, $description, $types)
    {
        try {
            // Begin transaction
            $this->pdo->beginTransaction();

            // Insert product
            $sql = "INSERT INTO `product` (`idProduct`, `name`, `price`, `discount`, `isAvailable`, `isCaffeineFree`, `isGiftSet`, `image`, `description`)
                    VALUES (NULL, :name, :price, :discount, :isAvailable, :isCaffeineFree, :isGiftSet, :image, :description)";

            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':price', $price, PDO::PARAM_INT);
            $statement->bindParam(':discount', $discount, PDO::PARAM_INT);
            $statement->bindParam(':isAvailable', $isAvailable, PDO::PARAM_BOOL);
            $statement->bindParam(':isCaffeineFree', $isCaffeineFree, PDO::PARAM_BOOL);
            $statement->bindParam(':isGiftSet', $isGiftSet, PDO::PARAM_BOOL);
            $statement->bindParam(':image', $image);
            $statement->bindParam(':description', $description);
            $statement->execute();

            // Get the last inserted product ID
            $productId = $this->pdo->lastInsertId();

            // Insert product-type relationships
            $sql = "INSERT INTO `producttype` (`idProductTypeRelation`, `idProductType`, `idProduct`) VALUES (NULL, :idProductType, :idProduct)";
            $statement = $this->pdo->prepare($sql);

            foreach ($types as $typeId) {
                $statement->bindParam(':idProductType', $typeId, PDO::PARAM_INT);
                $statement->bindParam(':idProduct', $productId, PDO::PARAM_INT);
                $statement->execute();
            }

            // Commit transaction
            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            // Rollback transaction if there is an error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateProduct($id, $name, $price, $discount, $isAvailable, $isCaffeineFree, $isGiftSet, $image, $description, $types)
    {
        try {
            // Begin transaction
            $this->pdo->beginTransaction();

            // Update product
            $sql = "UPDATE `product` SET `name` = :name, `price` = :price, `discount` = :discount, `isAvailable` = :isAvailable,
                    `isCaffeineFree` = :isCaffeineFree, `isGiftSet` = :isGiftSet, `image` = :image, `description` = :description
                    WHERE `idProduct` = :id";

            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':price', $price, PDO::PARAM_INT);
            $statement->bindParam(':discount', $discount, PDO::PARAM_INT);
            $statement->bindParam(':isAvailable', $isAvailable, PDO::PARAM_BOOL);
            $statement->bindParam(':isCaffeineFree', $isCaffeineFree, PDO::PARAM_BOOL);
            $statement->bindParam(':isGiftSet', $isGiftSet, PDO::PARAM_BOOL);
            $statement->bindParam(':image', $image);
            $statement->bindParam(':description', $description);
            $statement->execute();

            // Delete existing product-type relationships
            $sql = "DELETE FROM `producttype` WHERE `idProduct` = :id";
            $statement = $this->pdo->prepare($sql);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            // Insert updated product-type relationships
            $sql = "INSERT INTO `producttype` (`idProductType`, `idProduct`) VALUES (:idProductType, :idProduct)";
            $statement = $this->pdo->prepare($sql);

            foreach ($types as $typeId) {
                $statement->bindParam(':idProductType', $typeId, PDO::PARAM_INT);
                $statement->bindParam(':idProduct', $id, PDO::PARAM_INT);
                $statement->execute();
            }

            // Commit transaction
            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            // Rollback transaction if there is an error
            $this->pdo->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateProductAvailable($idProduct, $isAvailable)
    {
        $sqlKey = 'idProduct';
        $sqlProductAvailability = "isAvailable";
        $newAvailability = true;

        if ($isAvailable == true) {
            $newAvailability = false;
        }

        $sql = "UPDATE `$this->tableName` SET $sqlProductAvailability = :productAvailability WHERE $sqlKey = :idProduct;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':idProduct' => $idProduct, ':productAvailability' => $newAvailability]);
        return $statement->fetchAll();
    }


    public function deleteProduct($idProduct)
    {
        $sqlKey = 'idProduct';

        // Delete existing product-type relationships
        $sqlType = "DELETE FROM `producttype` WHERE $sqlKey = :idProduct";
        $statement = $this->pdo->prepare($sqlType);
        $statement->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
        $statement->execute();

        $sql = "DELETE FROM $this->tableName WHERE $sqlKey = :idProduct";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':idProduct', $idProduct, PDO::PARAM_INT);
        $statement->execute();
        return $statement->rowCount();
    }

    public function deleteProductTypeById($typeId){
        $sqlKey = 'idProductType';

        $sqlRelation = "DELETE FROM $this->tableNameRelationType WHERE $sqlKey = :typeId";
        $statementRelation = $this->pdo->prepare($sqlRelation);
        $statementRelation->bindParam(':typeId', $typeId);
        $statementRelation->execute();

        $sql = "DELETE FROM $this->tableNameType WHERE $sqlKey = :typeId";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':typeId', $typeId);
        $statement->execute();
        return true;
    }
}
