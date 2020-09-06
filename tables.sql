

-- users table--
CREATE TABLE users(
    id int PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(16) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pass VARCHAR(64) NOT NULL
);
-- admins table --
CREATE TABLE admins(
    int(8) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(16) NOT NULL,
    pass VARCHAR(64) NOT NULL,
    email VARCHAR(100) NOT NULL
);
-- products table --
CREATE TABLE products(
    p_code VARCHAR(15) PRIMARY KEY,
    P_name VARCHAR(15) NOT NULL,
    p_info VARCHAR(100) NOT NULL,
    p_price double(18,2) NOT NULL
);

-- addresses table --
CREATE TABLE addresses(
    id int,
    town VARCHAR(30) NOT NULL,
    postal_address VARCHAR(30) NOT NULL
);

-- orders table --
CREATE TABLE orders(
    o_id INT(8) PRIMARY KEY AUTO_INCREMENT,
    o_email VARCHAR(100) NOT NULL,
    o_items int NOT NULL,
    o_price double(18,2),
    o_date datetime default CURRENT_TIMESTAMP
);


