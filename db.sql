create database qi;

use qi;

create table if not exists user(
    id int auto_increment not null,
    name varchar(250) not null,
    login varchar(100) not null,
    password varchar(250) not null,
    primary key (id)
);

create table if not exists supplier(
    id int auto_increment not null,
    name varchar(250) not null,
    phone varchar(250) not null,
    email varchar(250) not null,
    zioCode varchar(250) not null,
    street varchar(250) not null,
    number varchar(250) not null,
    city varchar(250) not null,
    state varchar(250) not null,
    primary key (id)
);

create table if not exists product(
    id int auto_increment not null,
    code varchar(250) not null,
    brand varchar(250) not null,
    model varchar(250) not null,
    color varchar(250) not null,
    price varchar(250) not null,
    manufacturingDate varchar(250) not null,
    dateRegistration varchar(250) not null,
    idSupplier int not null,
    primary key (id),
    foreign key (idSupplier) references supplier(id)
);