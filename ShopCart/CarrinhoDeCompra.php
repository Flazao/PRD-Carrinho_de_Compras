<?php

class CartShop
{
    public $products;
    public $carts = [];

    public function __construct()
    {
        $this->products = [
            [
                'id' => 1,
                'nome' => 'Camiseta',
                'preco' => 59.90,
                'estoque' => 10
            ],
            [
                'id' => 2,
                'nome' => 'Calça Jeans',
                'preco' => 129.90,
                'estoque' => 5
            ],
            [
                'id' => 3,
                'nome' => 'Tênis',
                'preco' => 199.90,
                'estoque' => 3
            ]
        ];
    }

    public function validateProduct(): void
    {
        foreach ($this->products as $product) {
            if ($product['id'] != $product['id']) {
                throw new Exception(message: 'Não existe o produto');
            }
        }
    }

    public function itsStockEnough(): void {
        foreach ($this->products as $product) {
            if ($product['estoque'] == 0 ){
                throw new Exception(message: 'Produto fora do estoque :(');
            }
        }
    }

    public function addProductInCart(): void
    {
        $this->validateProduct();
        // incompleto
    }
}






?>