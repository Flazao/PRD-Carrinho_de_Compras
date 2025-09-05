<?php

require_once "CarrinhoDeCompra.php";

$cart = new CartShop();

echo $cart->addProductToCart(1, 2) . "<br>";
echo $cart->addProductToCart(2) . "<br>";
echo $cart->addProductToCart(3, 2) . "<br>";
echo $cart->addProductToCart(99) . "<br>"; 
echo $cart->addProductToCart(3, 10) . "<br>"; 

echo "<hr>";
echo $cart->listCart();

echo "<hr>";
echo $cart->applyCoupon("DESCONTO10") . "<br>";
echo $cart->listCart();

echo "<hr>";
echo $cart->removeProductFromCart(1) . "<br>";
echo $cart->removeProductFromCart(1) . "<br>";
echo $cart->listCart();
