create schema ifc;

create table carro(
id int not null auto_increment,
nome varchar(45),
valor double,
km double,
dataFabricacao date,
primary key (id));

INSERT INTO carro VALUES (1234, 'Gol', '65590', '80000', '2010-08-27');
INSERT INTO carro VALUES (4321, 'Fusca', '240000', '250000', '1995-12-06');
INSERT INTO carro VALUES (7256, 'Jetta', '47900', '95000', '2012-06-14');
INSERT INTO carro VALUES (1469, 'Camaro', '377000', '64000', '2020-01-31');
INSERT INTO carro VALUES (4670, 'Uno', '40000', '198000', '2005-03-17');