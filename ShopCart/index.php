<?php

require_once "CarrinhoDeCompra.php"; 

$cart = new CartShop(); 

echo $cart->addProductInCart(1);
echo $cart->addProductInCart(2);
echo $cart->addProductInCart(3);

echo "-------------------------------------";

$cart->removeProductInCart(3);

echo "=====================================";

$cart->validateProductExists(3);
$cart->validateAvailableStock(2);

echo "-------------------------------------";
?>
