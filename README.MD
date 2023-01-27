## STEP 1 | CREATE A DATABASE
create database encuestas;

## STEP2 | CREATE TABLES
use encuestas;

create table encuesta(
id int primary key auto_increment,
nota int,
comentario varchar(200),
fecha date);

create table usuarios(
id int primary key auto_increment,
usuario varchar(20),
idProfesor int,
password varchar(20),
constraint FK_id foreign key (idProfesor) references encuesta(id));

## INSERT WITH COMMAND
insert into encuesta(nota,comentario,fecha) values (5,"Hola que tal",CURRENT_DATE);

insert into usuarios(usuario,password) values ("root","");

## LOCATION
localhost/proyecto_encuentas/php/index
