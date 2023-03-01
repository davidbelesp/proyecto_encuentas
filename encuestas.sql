create database encuestas;
use encuestas;

create table usuarios(
    id int primary key auto_increment,
    tipo enum("Usuario","Admin"),
    usuario varchar(20) NOT NULL UNIQUE,
    password varchar(72),
    encActivada bit not null
);

create table encuesta(
    id int primary key auto_increment,
    idProfesor int,
    nota int,
    comentario varchar(200),
    satifaccion enum("si","no"),
    tareas int,
    examenes int,
    fecha date,
    constraint FK_id foreign key (idProfesor) references usuarios(id)
    ON UPDATE CASCADE ON DELETE CASCADE
);

insert into usuarios(usuario,password,tipo) values ("root","$2y$10$zERWpBYk3oYD2svlaoG8eu5iN8U/XLp8CfMaWkxxk8zYFA64vDPuq","Admin");
insert into usuarios(usuario,password,tipo) values ("Adelaida","$2y$10$EbBLNTGNdNTYL7bVznQosulMG.dz0HQpkRC5R4gBrq8HxpvkwqhCO","Usuario");
insert into encuesta(nota,comentario,idProfesor,tareas,examenes,satifaccion,fecha) values (5,"Hola que tal",2,8,9,"si",CURRENT_DATE);
