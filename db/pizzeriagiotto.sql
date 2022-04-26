DROP DATABASE IF EXISTS Pizzeria;
CREATE DATABASE IF NOT EXISTS Pizzeria;
USE Pizzeria;

CREATE TABLE Users (
    id INT AUTO_INCREMENT,
    name VARCHAR(30),
    surname VARCHAR(30),
    tel CHAR(10),
    email VARCHAR(254),
    password CHAR(60),
    PRIMARY KEY (id)
) AUTO_INCREMENT = 1;

CREATE TABLE Orders
(
    id INT AUTO_INCREMENT,
    dollar_amount DOUBLE,
    delivery_time DATETIME,
    delivery_address VARCHAR(40),
    FK_users INT,
    PRIMARY KEY (id),
    FOREIGN KEY (FK_users) REFERENCES Users (id)
) AUTO_INCREMENT = 1;

CREATE TABLE Products (
    id INT AUTO_INCREMENT,
    name VARCHAR(40),
    description VARCHAR(60),
    price DOUBLE,
    img_dir VARCHAR(50),
    PRIMARY KEY (id)
) AUTO_INCREMENT = 1;

CREATE TABLE Orders_Products (
    FK_orders INT,
    FK_products INT,
    amount INT,
    PRIMARY KEY (FK_orders, FK_products),
    FOREIGN KEY (FK_orders) REFERENCES Orders (id),
    FOREIGN KEY (FK_products) REFERENCES Products (id)
);

INSERT INTO Products (name, description, price, img_dir) VALUES
("Margherita", "Tomato, mozzarella, basil", 10.00, "resources/products/margherita.png"),
("Vesuvio", "Tomato, mozzarella, basil", 7.00, "resources/products/vesuvio.png"),
("Bianca", "Tomato, mascarpone, raw ham", 6.00, "resources/products/bianca.png"),
("Maradona", "Tomato, mozzarella, salami", 15.00, "resources/products/maradona.png");