### Gabriel Flazão Poletti - 1990590
### José Fuji - 1994006
____________________________________________________________
# Passo a passo para executar o projeto em PHP com XAMPP


1. Instalação

• Baixe o XAMPP no site oficial: https://www.apachefriends.org

• Instale normalmente (próximo, próximo...).


2. Abrindo o painel de controle

• Execute o XAMPP Control Panel (atalho criado após a instalação).

• Clique em Start no Apache


3. Organizando os arquivos PHP

• Dentro da pasta de instalação, existe o diretório htdocs.

• Exemplo: C:\xampp\htdocs\

• Coloque o projeto dentro dessa pasta.

• Por exemplo: C:\xampp\htdocs\projeto


4. Acessando no navegador

• Para abrir o projeto, acesse no navegador:

• C:\xampp\htdocs\ShopCart
_______________________________________________________________

## __construct
Inicializa o carrinho de compras, criando uma lista fixa de produtos, cada um com seu id, nome, preço e estoque atual. Prepara o ambiente para utilização do sistema, deixando o carrinho vazio.

## addProductToCart
Adiciona um produto ao carrinho após validar se o item existe e se há estoque suficiente para a quantidade solicitada. Caso já exista o produto no carrinho, incrementa a quantidade e atualiza o subtotal. Também reduz o estoque do produto correspondente.

## removeProductFromCart
Remove uma unidade do produto do carrinho. Caso a quantidade do item chegue a zero, elimina o produto por completo do carrinho. A função também devolve uma unidade ao estoque e recalcula o subtotal quando necessário.

## listCart
Retorna uma visão detalhada dos itens presentes no carrinho, exibindo nome, quantidade e subtotal de cada produto. Mostra o valor total das compras e, se houver desconto aplicado, apresenta o total final com desconto.

## applyCoupon
Verifica se o código informado corresponde ao cupom válido ("DESCONTO10"). Se for válido, aplica 10% de desconto ao total do carrinho. Caso contrário, informa que o cupom é inválido.

## total
Calcula e retorna o valor total dos produtos atualmente presentes no carrinho, sem considerar descontos.

## totalWithDiscount
Retorna o valor total do carrinho com desconto aplicado, se houver. Se não existir cupom ativo, retorna o total tradicional.

## validateProductExists
Confirma se o produto informado existe na lista de produtos do sistema antes de realizar qualquer operação.

## validateAvailableStock
Garante que a quantidade solicitada do produto é compatível com o estoque disponível, evitando inconsistências.

## updateStock
Modifica a quantidade em estoque do produto envolvido, somando ou subtraindo as unidades conforme a operação realizada no carrinho.

## getProductPrice
Obtém e retorna o preço unitário referente ao produto identificado pelo id informado.

## getProductById
Localiza e retorna as informações completas do produto a partir do id, facilitando exibição de dados e cálculos nos métodos do carrinho.