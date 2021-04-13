<?php

namespace Source\Model;

use Source\Repository\ProductRepository;
use Source\Repository\SupplierRepository;

/**
 * Class ProductModel
 * @package Source\Model
 *
 * @property SupplierModel $supplier
 */
class ProductModel
{
    /** @var ProductRepository */
    private $ProductRepository;

    /** @var SupplierRepository */
    private $SupplierRepository;

    private $id;
    private $code;
    private $brand;
    private $model;
    private $color;
    private $price;
    private $manufacturingDate;
    private $dateRegistration;
    private $idSupplier;

    public function __construct()
    {
        $this->ProductRepository = new ProductRepository();
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

    public function save()
    {
        $product = false;
        if (! empty($this->id)) {
            if ($this->ProductRepository->update($this)) {
                $product = $this->ProductRepository->findFirst([
                    'where' => [
                        'product.id' => $this->id
                    ]
                ]);

                $this->idSupplier = $product->idSupplier;
            }
        } else {
            $this->ProductRepository->create($this);
            $product = $this->ProductRepository->findFirst([
                'where' => [
                    'product.id' => "[LAST_INSERT_ID()]"
                ]
            ]);

            $this->id = $product->id;
        }

        return $product;
    }

    public function delete($idProduct = null)
    {
        if (empty($idProduct) && ! empty($this->id)) {
            $idProduct = $this->id;
        }

        if (empty($idProduct)) {
            return false;
        }

        $product = $this->findByIdProduct($idProduct);

        if ($this->ProductRepository->delete($product->product->id)) {
            return $product->supplier->delete();
        }

        return false;
    }

    public function listAllInfoProduct($filter = [])
    {
        $queryOptions = [
            'where' => [],
            'join' => [
                'supplier' => [
                    'supplier.id' => 'product.idSupplier'
                ]
            ]
        ];

        if (! empty($filter)) {
            $queryOptions['where'] = array_merge($queryOptions['where'], $filter);
        }

        $response = [];
        $products = $this->ProductRepository->findAll($queryOptions);

        if (! empty($products)) {
            foreach ($products as $index => $product) {
                $supplier = $this->SupplierRepository->findFirst([
                    'where' => [
                        'id' => $product->idSupplier
                    ]
                ]);

                if (!empty($supplier)) {
                    $stdClass = new \stdClass();
                    $stdClass->product = $product;
                    $stdClass->supplier = $supplier;
                    $response[] = $stdClass;
                }
            }
        }

        return $response;
    }

    public function findByIdProduct($idProduct)
    {
        $queryOptions = [
            'where' => [
                'product.id' => $idProduct
            ],
            'join' => [
                'supplier' => [
                    'supplier.id' => 'product.idSupplier'
                ]
            ]
        ];

        $product = $this->ProductRepository->findFirst($queryOptions);

        $response = false;
        if (! empty($product)) {
            $supplier = $this->SupplierRepository->findFirst([
                'where' => [
                    'id' => $product->idSupplier
                ]
            ]);

            if (!empty($supplier)) {
                $stdClass = new \stdClass();
                $stdClass->product = $product;
                $stdClass->supplier = $supplier;
                $response = $stdClass;
            }
        }

        return $response;
    }

    public function __toString()
    {
        return nl2br("
            id: $this->id,
            Código: $this->code,
            Marca: $this->brand,
            Modelo: $this->model,
            Cor: $this->color,
            Preço: $this->price,
            Data de fabricação: $this->manufacturingDate,
            Data de cadastro: $this->dateRegistration,
            idSupplier: $this->idSupplier
        ");
    }
}
