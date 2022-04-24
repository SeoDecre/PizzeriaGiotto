DROP DATABASE IF EXISTS Pizzeria;
CREATE DATABASE IF NOT EXISTS Pizzeria;
USE Pizzeria;

CREATE TABLE Users (
    id INT AUTO_INCREMENT ,
    name VARCHAR(30),
    surname VARCHAR(30),
    tel CHAR(10),
    mail VARCHAR(320),
    password CHAR(60),
    PRIMARY KEY (id)
)AUTO_INCREMENT=1;

CREATE TABLE Orders (
    id INT AUTO_INCREMENT,
    amount DOUBLE,
    time DATETIME,
    delivery_address VARCHAR(40),
    status VARCHAR(10),
    payment_type VARCHAR(10),
    FK_users INT,
    PRIMARY KEY (id),
    FOREIGN KEY (FK_users) REFERENCES Users(id)
)AUTO_INCREMENT=1;

CREATE TABLE Products (
    id INT AUTO_INCREMENT,
    name VARCHAR(40),
    description VARCHAR(50),
    price DOUBLE,
    img_dir VARCHAR(50),
    PRIMARY KEY (id)
) AUTO_INCREMENT=1;

CREATE TABLE Orders_Products (
    FK_orders INT,
    FK_products INT,
    quantity INT,
    PRIMARY KEY (FK_orders, FK_products),
    FOREIGN KEY (FK_orders) REFERENCES Orders(id),
    FOREIGN KEY (FK_products) REFERENCES Products(id)
);

INSERT INTO Users (name, surname, tel, mail, password) VALUES
("Gino", "Rossi", "3242344324", "ginorossi95@gmail.com", "abcd1234"),
("Pietro", "Verdi", "2142451422", "pietroverdi@gmail.com", "abcd1234"),
("Fabio", "Bianchi", "4214541234", "fabiobianchi@gmail.com", "abcd1234");

INSERT INTO Orders (amount, time, delivery_address, status, payment_type, FK_users) VALUES
(30.50, "2020-01-01 15:10:10", "via Roma 65, Livorno", "arrived", "online", 1),
(20.50, "2020-01-01 15:10:10", "via Rossi 65, Firenze", "delivering", "cash", 1),
(1.00, "2020-01-01 15:10:10", "via Roma 65, Livorno", "delivering", "cash", 1),
(10.00, "2020-01-01 15:10:10", "via Verdi 65, Pisa", "arrived", "online", 2);

INSERT INTO Products (name, description, price,img_dir) VALUES
( "Margherita", "Tomato, mozzarella, basil", 10.00, "resources/products/margherita.png"),
( "Vesuvio", "Tomato, mozzarella, basil", 7.00, "resources/products/vesuvio.png"),
( "Bianca", "Pomodoro, mascarpone, crudo", 6.00, "resources/products/bianca.png"),
( "Maradona", "Pomodoro, mozzarella, salame", 15.00, "resources/products/maradona.png");


SELECT P.name, P.description, P.price
FROM Products P
ORDER BY P.price, P.description, P.name;
