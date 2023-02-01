## STEP 1 | CREATE A DATABASE
create database encuestas;

## STEP 2 | CREATE TABLES
use encuestas;

create table usuarios(
id int primary key auto_increment,
usuario varchar(20),
password varchar(20));

create table encuesta(
id int primary key auto_increment,
idProfesor int,
nota int,
comentario varchar(200),
satifaccion enum("si","no"),
tareas int,
examen int,
fecha date,
constraint FK_id foreign key (idProfesor) references usuarios(id));


## INSERT WITH COMMAND
insert into encuesta(nota,comentario,idProfesor,fecha) values (5,"Hola que tal","Profesor1",CURRENT_DATE);

insert into usuarios(usuario,password) values ("root","");

## LOCATION
localhost/proyecto_encuentas/index
