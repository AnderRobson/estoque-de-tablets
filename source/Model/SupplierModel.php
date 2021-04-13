<?php

namespace Source\Model;

use Source\Repository\SupplierRepository;

class SupplierModel
{
    /** @var SupplierRepository */
    private $SupplierRepository;

    private $id;
    private $name;
    private $phone;
    private $email;
    private $zioCode;
    private $street;
    private $number;
    private $city;
    private $state;
    private $updated_at;
    private $created_at;

    public function __construct()
    {
        $this->SupplierRepository = new SupplierRepository();
    }

    public function __destruct()
    {
    }

    public function __GET($atributo)
    {
        return $this->$atributo;
    }

    public function __SET($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function delete($idSupplier = null)
    {
        if (empty($idSupplier) && ! empty($this->id)) {
            $idSupplier = $this->id;
        }

        if (empty($idSupplier)) {
            return false;
        }

        return $this->SupplierRepository->delete($idSupplier);
    }

    public function save()
    {
        $supplier = false;
        if (! empty($this->id)) {
            if ($this->SupplierRepository->update($this)) {
                $supplier = $this->SupplierRepository->findFirst([
                    'where' => [
                        'supplier.id' => $this->id
                    ]
                ]);
            }
        } else {
            $this->SupplierRepository->create($this);
            $supplier = $this->SupplierRepository->findFirst([
                'where' => [
                    'supplier.id' => "[LAST_INSERT_ID()]"
                ]
            ]);
        }

        return $supplier;
    }

    public function __toString()
    {
        return nl2br("");
    }
}