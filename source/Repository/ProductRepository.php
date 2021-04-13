<?php

namespace Source\Repository;

use PDOException;
use Source\Model\ProductModel;

class ProductRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('product', ProductModel::class);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function create(ProductModel $Product)
    {
        try {
            $statement = $this->connection->prepare("
                insert into product
                    (code, brand, model, color, price, manufacturingDate, dateRegistration, idSupplier) 
                values
                    (?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $statement->bindValue(1, $Product->code);
            $statement->bindValue(2, $Product->brand);
            $statement->bindValue(3, $Product->model);
            $statement->bindValue(4, $Product->color);
            $statement->bindValue(5, $Product->price);
            $statement->bindValue(6, $Product->manufacturingDate);
            $statement->bindValue(7, $Product->dateRegistration);
            $statement->bindValue(8, $Product->idSupplier);

            return $statement->execute();
        } catch (PDOException $error) {
            return false;
        }
    }

    public function update(ProductModel $Product)
    {
        try {
            $statement = $this->connection->prepare("
                update product 
                set code=?, brand=?, model=?, color=?, price=?, manufacturingDate=?, dateRegistration=? 
                where id=?
            ");

            $statement->bindValue(1, $Product->code);
            $statement->bindValue(2, $Product->brand);
            $statement->bindValue(3, $Product->model);
            $statement->bindValue(4, $Product->color);
            $statement->bindValue(5, $Product->price);
            $statement->bindValue(6, $Product->manufacturingDate);
            $statement->bindValue(7, $Product->dateRegistration);

            $statement->bindValue(8, $Product->id);
            return $statement->execute();
        } catch (PDOException $error) {
            return false;
        }
    }
}
