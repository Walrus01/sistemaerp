CREATE DATABASE Lojinha;

USE Lojinha;

-- ------------------------------------------------------------------------------------------------

CREATE TABLE PRODUTOS
(

CodProduto			INT(5) PRIMARY KEY,
DescProduto			VARCHAR(50),
ValProduto			VARCHAR(50),
VenctoProduto		DATE,
Images_txt			VARCHAR(150),
Images				BLOB

);


select DescProduto, Images from PRODUTOS ORDER BY CodProduto DESC LIMIT 3;

select * from PRODUTOS;

# Inserir manualmente

INSERT INTO PRODUTOS VALUES

    (1, 'Wine - Rioja Campo Viejo', '$7.01', '2023/08/09'),
    (2, 'Compound - Raspberry', '$16.27', '2023/07/16'),
    (3, 'Pineapple - Regular', '$25.62', '2023/08/12'),
    (4, 'Sprouts - Brussel', '$20.97', '2023/06/18'),
    (5, 'Energy - Boo - Koo', '$19.50', '2023/07/10'),
    (6, 'Mushroom - White Button', '$25.43', '2023/08/14'),
    (7, 'Puree - Raspberry', '$28.72', '2023/07/27'),
    (8, 'Miso - Soy Bean Paste', '$29.16', '2023/06/01'),
    (9, 'Yukon Jack', '$16.12', '2023/08/04'),
    (10, 'Yogurt - Strawberry, 175 Gr', '$15.81', '2023/06/05'),
    (11, 'Icecream - Dstk Strw Chseck', '$18.65', '2023/07/18'),
    (12, 'Potatoes - Peeled', '$13.98', '2023/06/24'),
    (13, 'Sprite, Diet - 355ml', '$19.43', '2023/05/20'),
    (14, 'Wine - Mondavi Coastal Private', '$17.67', '2023/06/16'),
    (15, 'Bouq All Italian - Primerba', '$1.14', '2023/08/15'),
    (16, 'Pepper - Black, Whole', '$28.90', '2023/07/15'),
    (17, 'Cheese - Pont Couvert', '$3.92', '2023/08/04'),
    (18, 'Shrimp - 150 - 250', '$4.94', '2023/07/09'),
    (19, 'Pheasants - Whole', '$21.31', '2023/07/06'),
    (20, 'Coconut Milk - Unsweetened', '$23.61', '2023/07/06'),
    (21, 'Flour - Corn, Fine', '$15.27', '2023/06/01'),
    (22, 'Beef - Ground Medium', '$9.30', '2023/06/26'),
    (23, 'Seedlings - Clamshell', '$21.41', '2023/05/29'),
    (24, 'Bay Leaf Fresh', '$8.65', '2023/08/03'),
    (25, 'Clams - Canned', '$1.60', '2023/06/12'),
    (26, 'Latex Rubber Gloves Size 9', '$21.12', '2023/05/18'),
    (27, 'Garlic Powder', '$5.46', '2023/08/08'),
    (28, 'Doilies - 12, Paper', '$9.06', '2023/07/05'),
    (29, 'Crab Brie In Phyllo', '$26.81', '2023/06/28'),
    (30, 'Pepper - Yellow Bell', '$17.57', '2023/06/07'),
    (31, 'Bread - Sticks, Thin, Plain', '$6.84', '2023/06/05'),
    (32, 'Sauce - Roasted Red Pepper', '$26.77', '2023/07/11'),
    (33, 'Cheese - Bakers Cream Cheese', '$14.19', '2023/06/21'),
    (34, 'Langers - Cranberry Cocktail', '$12.91', '2023/08/02'),
    (35, 'Sour Puss - Tangerine', '$29.60', '2023/06/30'),
    (36, 'Pasta - Rotini, Dry', '$29.24', '2023/06/30'),
    (37, 'Oil - Pumpkinseed', '$20.60', '2023/08/13'),
    (38, 'Soup Campbells - Tomato Bisque', '$19.67', '2023/06/26'),
    (39, 'Cranberries - Fresh', '$3.12', '2023/07/31'),
    (40, 'Juice - V8, Tomato', '$17.25', '2023/06/12'),
    (41, 'Tomatoes - Grape', '$12.83', '2023/08/10'),
    (42, 'Squeeze Bottle', '$14.94', '2023/06/10'),
    (43, 'Sterno - Chafing Dish Fuel', '$10.91', '2023/06/09'),
    (44, 'Veal - Kidney', '$15.25', '2023/07/20'),
    (45, 'Roe - Flying Fish', '$25.71', '2023/05/29'),
    (46, 'Beer - True North Lager', '$14.20', '2023/06/01'),
    (47, 'Lettuce - Baby Salad Greens', '$15.72', '2023/06/20'),
    (48, 'Longos - Chicken Caeser Salad', '$9.25', '2023/06/17'),
    (49, 'Juice - Orange', '$14.17', '2023/05/31'),
    (50, 'Wine - Penfolds Koonuga Hill', '$6.25', '2023/08/13');

SELECT * FROM PRODUTOS;
DROP TABLE PRODUTOS;

SELECT CodProduto, DescProduto FROM PRODUTOS
ORDER BY CodProduto;

SELECT CodProduto, DescProduto FROM PRODUTOS
ORDER BY DescProduto;

SELECT * FROM PRODUTOS
WHERE VenctoProduto BETWEEN '2005-10-01' AND '2005-10-10';

-- ------------------------------------------------------------------------------------------------

CREATE TABLE VENDAS
(

CodVenda			INT(10) auto_increment PRIMARY KEY,
CodCliente			INT(10),
CodProduto			INT(5),
QuantVenda			INT(4),
DataVenda			DATE,
FormaPagto			CHAR(1)

);


# Funcionando
INSERT INTO VENDAS VALUES


(1, 150, 38, 1, '2023/05/13', 'P'),
(2, 149, 16, 12, '2023/05/02', 'V'),
(3, 148, 44, 17, '2023/05/24', 'P'),
(4, 147, 13, 6, '2023/05/27', 'P'),
(5, 146, 18, 9, '2023/05/12', 'P'),
(6, 145, 6, 18, '2023/05/21', 'P'),
(7, 144, 26, 5, '2023/04/29', 'P'),
(8, 143, 8, 14, '2023/05/06', 'P'),
(9, 142, 34, 10, '2023/05/31', 'P'),
(10, 141, 46, 3, '2023/05/26', 'P'),
(11, 140, 50, 7, '2023/05/29', 'V'),
(12, 139, 45, 11, '2023/04/20', 'V'),
(13, 138, 45, 16, '2023/05/15', 'V'),
(14, 137, 23, 4, '2023/05/24', 'V'),
(15, 136, 35, 8, '2023/05/20', 'V'),
(16, 135, 10, 20, '2023/05/17', 'P'),
(17, 134, 27, 2, '2023/04/28', 'P'),
(18, 133, 17, 15, '2023/05/10', 'V'),
(19, 132, 26, 19, '2023/05/29', 'P'),
(20, 131, 20, 13, '2023/05/28', 'P'),
(21, 130, 16, 20, '2023/05/08', 'V'),
(22, 129, 47, 15, '2023/05/30', 'P'),
(23, 128, 25, 1, '2023/05/09', 'P'),
(24, 127, 13, 11, '2023/05/09', 'V'),
(25, 126, 9, 4, '2023/06/01', 'V'),
(26, 125, 16, 2, '2023/04/20', 'V'),
(27, 124, 39, 7, '2023/04/30', 'V'),
(28, 123, 46, 16, '2023/05/31', 'P'),
(29, 122, 28, 20, '2023/05/03', 'V'),
(30, 121, 46, 18, '2023/05/21', 'V'),
(31, 120, 2, 9, '2023/05/14', 'P'),
(32, 119, 48, 4, '2023/05/30', 'P'),
(33, 118, 39, 14, '2023/06/03', 'P'),
(34, 117, 35, 2, '2023/05/10', 'P'),
(35, 116, 44, 20, '2023/05/26', 'V'),
(36, 115, 30, 12, '2023/05/02', 'P'),
(37, 114, 3, 10, '2023/05/02', 'V'),
(38, 113, 45, 17, '2023/04/19', 'P'),
(39, 112, 37, 5, '2023/05/15', 'P'),
(40, 111, 26, 1, '2023/04/20', 'V'),
(41, 110, 13, 18, '2023/04/25', 'P'),
(42, 109, 47, 16, '2023/04/26', 'V'),
(43, 108, 17, 19, '2023/04/21', 'P'),
(44, 107, 38, 8, '2023/04/22', 'P'),
(45, 106, 1, 10, '2023/05/03', 'V'),
(46, 105, 35, 9, '2023/04/25', 'V'),
(47, 104, 33, 4, '2023/05/05', 'V'),
(48, 103, 46, 12, '2023/04/23', 'V'),
(49, 102, 18, 2, '2023/05/22', 'V'),
(50, 101, 15, 19, '2023/04/25', 'V');

SELECT * FROM VENDAS;
DROP TABLE VENDAS;

SELECT VENDAS.CodVenda, VENDAS.CodCliente, CLIENTES.NomeCliente, VENDAS.CodProduto, PRODUTOS.DescProduto, VENDAS.QuantVenda, VENDAS.DataVenda, VENDAS.FormaPagto
	from VENDAS
    INNER JOIN PRODUTOS on VENDAS.CodProduto = PRODUTOS.CodProduto
    INNER JOIN CLIENTES on VENDAS.CodCliente = CLIENTES.CodCliente
	WHERE FormaPagto = 'V'
    order by CodVenda;

SELECT VENDAS.CodVenda, VENDAS.CodCliente, CLIENTES.NomeCliente, VENDAS.CodProduto, PRODUTOS.DescProduto, VENDAS.QuantVenda, VENDAS.DataVenda, VENDAS.FormaPagto
	from VENDAS
    INNER JOIN PRODUTOS on VENDAS.CodProduto = PRODUTOS.CodProduto
    INNER JOIN CLIENTES on VENDAS.CodCliente = CLIENTES.CodCliente
    order by CodVenda;

-- ------------------------------------------------------------------------------------------------

CREATE TABLE CLIENTES
(

CodCliente			INT(5) PRIMARY KEY,
NomeCliente			VARCHAR(50),
CelCliente			VARCHAR(50),
CPFCliente			VARCHAR(50),
CEPCliente			VARCHAR(50)
);

#Inserir Manualmente
INSERT INTO CLIENTES VALUES

(101, 'Armand', '98765-4321', '123.456.789-01', '01001-000'),
(102, 'Man', '98765-4322', '234.567.890-12', '05414-000'),
(103, 'Aprilette', '98765-4323', '345.678.901-23', '20040-005'),
(104, 'Daune', '98765-4324', '456.789.012-34', '30170-001'),
(105, 'Kandace', '98765-4325', '567.890.123-45', '40243-717'),
(106, 'Mickie', '98765-4326', '678.901.234-56', '52041-080'),
(107, 'Orton', '98765-4327', '789.012.345-67', '60150-161'),
(108, 'Cherice', '98765-4328', '890.123.456-78', '70002-900'),
(109, 'Herby', '98765-4329', '901.234.567-89', '80010-030'),
(110, 'Walton', '98765-4330', '012.345.678-90', '90035-003'),
(111, 'Danie', '98765-4331', '123.456.789-01', '01000-200'),
(112, 'Lillis', '98765-4332', '234.567.890-12', '05414-100'),
(113, 'Petronille', '98765-4333', '345.678.901-23', '20040-050'),
(114, 'Deedee', '98765-4334', '456.789.012-34', '30170-020'),
(115, 'Seth', '98765-4335', '567.890.123-45', '40243-710'),
(116, 'Emalee', '98765-4336', '678.901.234-56', '52041-090'),
(117, 'Jobey', '98765-4337', '789.012.345-67', '60150-150'),
(118, 'Gabbi', '98765-4338', '890.123.456-78', '70002-800'),
(119, 'Ingar', '98765-4339', '901.234.567-89', '80010-020'),
(120, 'Kamillah', '98765-4340', '012.345.678-90', '90035-001'),
(121, 'Jesse', '98765-4341', '123.456.789-01', '01000-001'),
(122, 'Pamella', '98765-4342', '234.567.890-12', '05414-010'),
(123, 'Zora', '98765-4343', '345.678.901-23', '20040-001'),
(124, 'Blakeley', '98765-4344', '456.789.012-34', '30170-005'),
(125, 'Evy', '98765-4345', '567.890.123-45', '40243-720'),
(126, 'Marline', '98765-4346', '678.901.234-56', '52041-100'),
(127, 'Germana', '98765-4347', '789.012.345-67', '60150-170'),
(128, 'Zitella', '98765-4348', '890.123.456-78', '70002-700'),
(129, 'Elfrida', '98765-4349', '901.234.567-89', '80010-010'),
(130, 'Esmaria', '98765-4350', '012.345.678-90', '90035-002'),
(131, 'Victor', '98765-4351', '123.456.789-01', '01000-002'),
(132, 'Sadie', '98765-4352', '234.567.890-12', '05414-020'),
(133, 'Reidar', '98765-4353', '345.678.901-23', '20040-002'),
(134, 'Jilli', '98765-4354', '456.789.012-34', '30170-010'),
(135, 'Ardine', '98765-4355', '567.890.123-45', '40243-730'),
(136, 'Shelagh', '98765-4356', '678.901.234-56', '52041-110'),
(137, 'Mathew', '98765-4357', '789.012.345-67', '60150-180'),
(138, 'Tommy', '98765-4358', '890.123.456-78', '70002-600'),
(139, 'Anson', '98765-4359', '901.234.567-89', '80010-100'),
(140, 'Hyatt', '98765-4360', '012.345.678-90', '90035-004'),
(141, 'Alford', '98765-4361', '123.456.789-01', '01000-003'),
(142, 'Emmi', '98765-4362', '234.567.890-12', '05414-030'),
(143, 'Isabel', '98765-4363', '345.678.901-23', '20040-003'),
(144, 'Clay', '98765-4364', '456.789.012-34', '30170-015'),
(145, 'Corty', '98765-4365', '567.890.123-45', '40243-740'),
(146, 'Vanda', '98765-4366', '678.901.234-56', '52041-120'),
(147, 'Darryl', '98765-4367', '789.012.345-67', '60150-190'),
(148, 'Millisent', '98765-4368', '890.123.456-78', '70002-500'),
(149, 'Joice', '98765-4369', '901.234.567-89', '80010-200'),
(150, 'Jennie', '98765-4370', '960.756.972-35', '90035-005');

SELECT * FROM CLIENTES;
DROP TABLE CLIENTES;

select PRODUTOS.DescProduto
from VENDAS
INNER JOIN PRODUTOS on VENDAS.CodProduto = PRODUTOS.CodProduto;


CREATE TABLE LOGIN
(
CodCliente			VARCHAR(50),
EmailCliente		VARCHAR(50),
SenhaCliente		VARCHAR(50)
);

select * from LOGIN;

select *
from CLIENTES
INNER JOIN LOGIN on CLIENTES.CodCliente = LOGIN.CodCliente WHERE CLIENTES.CodCliente = 101;

select NomeCliente, CelCliente, CPFCliente, CEPCliente from CLIENTES where CodCliente = 101;

select EmailCliente, SenhaCliente from LOGIN where EmailCliente = 'Armand@gmail.com' and SenhaCliente = 'Armand';

select * 
from CLIENTES 
INNER JOIN LOGIN on CLIENTES.CodCliente = LOGIN.CodCliente WHERE CLIENTES.CodCliente = 101 order by CLIENTES.CodCliente;

-- ------------------------------------------------------------------------------------------------

CREATE TABLE FC
(
NomeCliente			VARCHAR(50),
EmailCliente		VARCHAR(50),
AssuntoFC			CHAR(1),
DescFC				VARCHAR(300),
DtAtual				DATE
);

select * from FC;

select NomeCliente from CLIENTES INNER JOIN LOGIN on CLIENTES.CodCliente = LOGIN.CodCliente WHERE LOGIN.CodCliente = 101;
select * from LOGIN;