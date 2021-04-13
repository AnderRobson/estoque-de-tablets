<?php

namespace Source\Repository;

use PDOException;
use Source\Model\SupplierModel;

class SupplierRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('supplier', SupplierModel::class);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function create(SupplierModel $Supplier)
    {
        try {
            $statement = $this->connection->prepare("
                insert into supplier
                    (name, phone, email, zioCode, street, number, city, state) 
                values 
                    (?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $statement->bindValue(1, $Supplier->name);
            $statement->bindValue(2, $Supplier->phone);
            $statement->bindValue(3, $Supplier->email);
            $statement->bindValue(4, $Supplier->zioCode);
            $statement->bindValue(5, $Supplier->street);
            $statement->bindValue(6, $Supplier->number);
            $statement->bindValue(7, $Supplier->city);
            $statement->bindValue(8, $Supplier->state);

            return $statement->execute();
        } catch (PDOException $error) {
            return false;
        }
    }

    public function update(SupplierModel $Supplier)
    {
        try {
            $statement = $this->connection->prepare("
                update supplier 
                set name=?, phone=?, email=?, zioCode=?, street=?, number=?, city=? , state=? 
                where id=?");

            $statement->bindValue(1,$Supplier->name);
            $statement->bindValue(2,$Supplier->phone);
            $statement->bindValue(3,$Supplier->email);
            $statement->bindValue(4,$Supplier->zioCode);
            $statement->bindValue(5,$Supplier->street);
            $statement->bindValue(6,$Supplier->number);
            $statement->bindValue(7,$Supplier->city);
            $statement->bindValue(8,$Supplier->state);

            $statement->bindValue(9,$Supplier->id);
            return $statement->execute();
        } catch (PDOException $error) {
            return false;
        }
    }
}
