<?php

class CartShop
{
    public array $products;
    public array $cart = [];
    public float $discount = 0.0;

    public function __construct()
    {
        $this->products = [
            ['id' => 1, 'nome' => 'Camiseta', 'preco' => 59.90, 'estoque' => 10],
            ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
            ['id' => 3, 'nome' => 'Tênis', 'preco' => 199.90, 'estoque' => 3],
        ];
    }

    public function listCart(): string
    {
        if (empty($this->cart)) {
            return 'Carrinho vazio.';
        }

        $output = "Itens no carrinho:<br>";
        foreach ($this->cart as $item) {
            $product = $this->getProductById($item['id_produto']);
            $output .= $product['nome']
                . ' - Quantidade: ' . $item['quantidade']
                . ' - Subtotal: R$' . number_format($item['subtotal'], 2, ',', '.')
                . "<br>";
        }

        $output .= 'Total: R$' . number_format($this->total(), 2, ',', '.') . "<br>";

        if ($this->discount > 0) {
            $output .= 'Desconto: ' . ($this->discount * 100) . "%<br>";
            $output .= 'Total com desconto: R$' . number_format($this->totalWithDiscount(), 2, ',', '.') . "<br>";
        }

        return $output;
    }

    public function applyCoupon(string $coupon): string
    {
        if ($coupon === 'DESCONTO10') {
            $this->discount = 0.10;
            return 'Cupom de desconto aplicado.';
        }
        return 'Cupom inválido.';
    }

    public function total(): float
    {
        $sum = 0.0;
        foreach ($this->cart as $item) {
            $sum += $item['subtotal'];
        }
        return $sum;
    }

    public function totalWithDiscount(): float
    {
        $total = $this->total();
        if ($this->discount <= 0) {
            return $total;
        }
        return $total * (1 - $this->discount);
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

    public function validateAvailableStock(int $productId, int $quantity = 1): bool
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $productId && $product['estoque'] >= $quantity) {
                return true;
            }
        }
        return false;
    }

    private function updateStock(int $productId, int $quantity): void
    {
        foreach ($this->products as &$product) {
            if ($product['id'] === $productId) {
                $product['estoque'] += $quantity;
                return;
            }
        }
    }

    private function getProductPrice(int $productId): float
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $productId) {
                return (float) $product['preco'];
            }
        }
        return 0.0;
    }

    private function getProductById(int $productId): ?array
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $productId) {
                return $product;
            }
        }
        return null;
    }

    public function addProductToCart(int $productId, int $quantity = 1): string
    {
        if ($quantity <= 0) {
            return 'Quantidade inválida.';
        }

        if (!$this->validateProductExists($productId)) {
            return 'Produto não existe.';
        }

        if (!$this->validateAvailableStock($productId, $quantity)) {
            return 'Estoque insuficiente.';
        }

        foreach ($this->cart as &$item) {
            if ($item['id_produto'] === $productId) {

                $item['quantidade'] += $quantity;
                $item['subtotal'] = $this->getProductPrice($productId) * $item['quantidade'];
                $this->updateStock($productId, -$quantity);
                return 'Produto incrementado no carrinho.';
            }
        }

        $price = $this->getProductPrice($productId);
        $this->cart[] = [
            'id_produto' => $productId,
            'quantidade' => $quantity,
            'subtotal' => $price * $quantity,
        ];
        $this->updateStock($productId, -$quantity);

        return 'Produto adicionado ao carrinho.';
    }

    public function removeProductFromCart(int $productId): string
    {
        foreach ($this->cart as $index => &$item) {
            if ($item['id_produto'] === $productId) {
                $this->updateStock($productId, 1);
                $item['quantidade']--;
                if ($item['quantidade'] <= 0) {
                    unset($this->cart[$index]);
                    return 'Produto removido do carrinho.';
                }
                $item['subtotal'] = $this->getProductPrice($productId) * $item['quantidade'];
                return 'Quantidade do produto reduzida em 1.';
            }
        }

        return 'Produto não está no carrinho.';
    }
}
