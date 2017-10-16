create database ShopSmart;

use ShopSmart;

create table Account (
	userName varchar(255) not null,
	password varchar(255) not null,
	firstName varchar(255) not null,
	lastName varchar (255) not null,
	email varchar(255) not null,
	primary key(userName)
);

create table Store (
	storeID int(11) not null auto_increment,
	storeName varchar(255) not null,
	address varchar(255),
	primary key(storeID)
);

create table Category (
	categoryID int(11) not null auto_increment,
	categoryName varchar(255),
	primary key(categoryID)
);

create table Product (
	productID int(11) not null auto_increment,
	productName varchar(255),
	price decimal(9,2),
	numberInStock int(5),
	storeID int(11),
	categoryID int(11),
	primary key(productID),
	foreign key(storeID) references Store(storeID),
	foreign key(categoryID) references Category(categoryID)
);