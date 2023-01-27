## STEP 1 | CREATE A DATABASE
create database encuestas;

## STEP2 | CREATE TABLES
use encuestas;

create table encuesta(
id int primary key auto_increment,
idProfesor int,
nota int,
comentario varchar(200),
fecha date,
constraint FK_id foreign key (idProfesor) references encuesta(id));

create table usuarios(
id int primary key auto_increment,
usuario varchar(20),
password varchar(20));

## INSERT WITH COMMAND
insert into encuesta(nota,comentario,idProfesor,fecha) values (5,"Hola que tal","Profesor1",CURRENT_DATE);

insert into usuarios(usuario,password) values ("root","");

## LOCATION
localhost/proyecto_encuentas/php/index
