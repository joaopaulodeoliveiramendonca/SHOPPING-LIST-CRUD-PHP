CREATE TABLE `itens_compras` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `quantidade` INT NOT NULL,
  `preco` DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (`id`)
);
