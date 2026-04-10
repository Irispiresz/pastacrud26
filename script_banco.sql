CREATE DATABASE wda_crud;
USE wda_crud;

  
  CREATE TABLE IF NOT EXISTS tabelaplantas (
    `id` INT NOT NULL AUTO_INCREMENT,
    `especie` VARCHAR(50) NOT NULL,
    `tipo` VARCHAR(40) NOT NULL,
    `porte` INT NOT NULL,
    `descricao` VARCHAR(250) NOT NULL,
    `datacad` DATETIME NOT NULL,
    `foto` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
  -- Inserção de dados na tabela `tabelaplantas`
  
  INSERT INTO tabelaplantas (`especie`, `tipo`, `porte`, `descricao`, `datacad`, `foto`) VALUES
  ('Rosa Vermelha', 'Flor', 30, 'Planta ornamental com flores vermelhas intensas.', '2025-06-17', 'rosa.png'),
  ('Samambaia', 'Folhagem', 60, 'Planta pendente ideal para ambientes internos.', '2025-06-17', 'samambaia.jpg'),
  ('Cacto Mandacaru', 'Suculenta', 80, 'Cacto típico do sertão, resistente e decorativo.', '2025-06-17', 'mandacaru.png'),
  ('Orquídea Phalaenopsis', 'Flor', 40, 'Flor tropical muito usada em decoração.', '2025-06-17', 'orquidea.jpg'),
  ('Lavanda', 'Aromática', 45, 'Planta conhecida por seu perfume relaxante.', '2025-06-17', 'lavanda.jpg');



  CREATE TABLE `customers` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `cpf_cnpj` varchar(15) NOT NULL,
    `birthdate` datetime NOT NULL,
    `address` varchar(255) NOT NULL,
    `hood` varchar(100) NOT NULL,
    `zip_code` varchar(8) NOT NULL,
    `city` varchar(100) NOT NULL,
    `state` varchar(2) NOT NULL,
    `phone` varchar(13) NOT NULL,
    `mobile` varchar(13) NOT NULL,
    `ie` varchar(15) NOT NULL,
    `created` datetime NOT NULL,
    `modified` datetime NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  --
  -- Extraindo dados da tabela `customers`
  --

  INSERT INTO `customers` (`id`, `name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
  (1, 'Fulano de Tal', '123.456.789-00', '1989-01-01 00:00:00', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'Te', '15 12345678', '15987654321', '123456', '2016-05-24 00:00:00', '2016-05-24 00:00:00'),
  (2, 'Ciclano de Tal', '123.456.789-00', '1989-01-01 00:00:00', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'Te', '15 12345678', '15987654321', '123456', '2016-05-24 00:00:00', '2016-05-24 00:00:00');


  ALTER TABLE `customers`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  -- Script para criar e cadastrar na tabela usuários (execute no banco do projeto):
  CREATE TABLE usuarios(
      id int AUTO_INCREMENT not null PRIMARY KEY,
      nome varchar(50) not null,
      user varchar(50) not null,
      password varchar(100) not null,
      foto varchar(50),
      
  );


INSERT INTO `usuarios` (`nome`, `user`, `password`, `tipo`) 
VALUES 
('Administrador do site', 'admin', '$2y$10$Y4fIjlU6cNKWVUhnigOcYOnJi.R4em.7i5GwO6CP9NoAnpwsQJgqS', 'admin'),
('Zé Lele', 'zelele', '5243897562837456982', 'user'),
('Mary Zica', 'mazi', '786098767869', 'user'),
('Fugiru Nakombi', 'fugina', '623485634753234', 'user');



 