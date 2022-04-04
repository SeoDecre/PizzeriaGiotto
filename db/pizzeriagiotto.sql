DROP DATABASE IF EXISTS Pizzeria;
CREATE DATABASE IF NOT EXISTS Pizzeria;
USE Pizzeria;

CREATE TABLE Users (
    id INT,
    name VARCHAR(30),
    surname VARCHAR(30),
    tel CHAR(10),
    mail VARCHAR(320),
    password VARCHAR(30),
    PRIMARY KEY (id)
);

CREATE TABLE Orders (
    id INT,
    amount DOUBLE,
    time DATETIME,
    delivery_address VARCHAR(40),
    status VARCHAR(10),
    payment_type VARCHAR(10),
    FK_users INT,
    PRIMARY KEY (id),
    FOREIGN KEY (FK_users) REFERENCES Users(id)
);

CREATE TABLE Products (
    id INT,
    name VARCHAR(40),
    description VARCHAR(50),
    price DOUBLE,
    PRIMARY KEY (id)
);

CREATE TABLE Orders_Products (
    FK_orders INT,
    FK_products INT,
    PRIMARY KEY (FK_orders, FK_products),
    FOREIGN KEY (FK_orders) REFERENCES Orders(id),
    FOREIGN KEY (FK_products) REFERENCES Products(id)
);

INSERT INTO Users (id, name, surname, tel, mail, password) VALUES
(124, "Gino", "Rossi", "3242344324", "ginorossi95@gmail.com", "abcd1234"),
(125, "Pietro", "Verdi", "2142451422", "pietroverdi@gmail.com", "abcd1234"),
(126, "Fabio", "Bianchi", "4214541234", "fabiobianchi@gmail.com", "abcd1234");

INSERT INTO Orders (id, amount, time, delivery_address, status, payment_type, FK_users) VALUES
(0, 30.50, "2020-01-01 15:10:10", "via Roma 65, Livorno", "arrived", "online", 124),
(1, 20.50, "2020-01-01 15:10:10", "via Rossi 65, Firenze", "delivering", "cash", 125),
(2, 1.00, "2020-01-01 15:10:10", "via Roma 65, Livorno", "delivering", "cash", 124),
(3, 10.00, "2020-01-01 15:10:10", "via Verdi 65, Pisa", "arrived", "online", 126);

INSERT INTO Products (id, name, description, price) VALUES
(11, "Pizza margherita", "Buona", 10.00),
(22, "Pizza diavola", "Piccante", 7.00),
(33, "Pizza mascarpone", "Buonina", 6.00),
(44, "Pizza crudo e mozzarella", "Buona sgravata", 15.00),
(55, "Acqua", "Bagnata", 1.00);

INSERT INTO Orders_Products (FK_orders, FK_products) VALUES
(0, 11),
(0, 22),
(0, 33),
(1, 11),
(1, 55),
(2, 22);

SELECT P.name, P.description, P.price
FROM Products P
ORDER BY P.price, P.description, P.name;