<?php

class CartShop
{
    public $products;
    public array $cart = []; // carrinho sempre começa vazio

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

    public function validateProductExists(int $productId): bool
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $productId) {
                return true;
            }
        }
        return false;
    }

    public function validateAvailableStock(int $productId): bool
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $productId && $product['estoque'] > 0) {
                return true;
            }
        }
        return false;
    }

    public function addProductInCart(int $productId): string
    {
        if (!$this->validateProductExists($productId)) {
            return "Produto não existe.";
        }

        if (!$this->validateAvailableStock($productId)) {
            return "Estoque indisponível.";
        }

        foreach ($this->cart as &$item) {
            if ($item['id_produto'] === $productId) {
                $item['quantidade']++;
                $item['subtotal'] = $this->getProductPrice($productId) * $item['quantidade'];
                $this->updateStock($productId, -1);
                return "Produto incrementado no carrinho. <br>";
            }
        }

        $price = $this->getProductPrice($productId);
        $this->cart[] = [
            'id_produto' => $productId,
            'quantidade' => 1,
            'subtotal' => $price
        ];
        $this->updateStock($productId, -1);

        return "Produto adicionado ao carrinho. <br>";
    }

    public function validateItemInCart(int $productId): bool
    {
        foreach ($this->cart as $item) {
            if ($item['id_produto'] === $productId) {
                return true;
            }
        }
        return false;
    }

    public function removeProductInCart(int $productId)
    {
        if (!$this->validateItemInCart($productId)) {
            return "Produto não está no carrinho.";
        }

        foreach ($this->cart as $index => &$item) {
            if ($item['id_produto'] === $productId) {
                $item['quantidade']--;

                if ($item['quantidade'] <= 0) {
                    unset($this->cart[$index]);
                } else {
                    $item['subtotal'] = $this->getProductPrice($productId) * $item['quantidade'];
                }

                $this->updateStock($productId, 1);
                return "Produto removido do carrinho.";
            }
        }
    }

    private function updateStock(int $productId, int $quantity): void
    {
        foreach ($this->products as &$product) {
            if ($product['id'] === $productId) {
                $product['estoque'] += $quantity;
                break;
            }
        }
    }

    private function getProductPrice(int $productId): float
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $productId) {
                return $product['preco'];
            }
        }
        return 0;
    }
}

?>