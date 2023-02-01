create database encuestas;
use encuestas;

create table usuarios(
    id int primary key auto_increment,
    usuario varchar(20),
    password varchar(20)
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
);

insert into usuarios(usuario,password) values ("root","");
insert into encuesta(nota,comentario,idProfesor,fecha) values (5,"Hola que tal",1,CURRENT_DATE);
