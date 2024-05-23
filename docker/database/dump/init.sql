CREATE USER docker;
CREATE DATABASE docker;
GRANT ALL PRIVILEGES ON DATABASE docker TO docker;

create table "users"(
                        id SERIAL PRIMARY KEY,
                        name VARCHAR(100) NOT NULL,
                        email VARCHAR(100) NOT NULL UNIQUE,
                        password VARCHAR(255) NOT NULL,
                        session_token VARCHAR(64) DEFAULT NULL
);

create table "product_type"(
                                   id SERIAL PRIMARY KEY,
                                   name VARCHAR(100) NOT NULL
);

create table "products"(
                          id SERIAL PRIMARY KEY,
                          name VARCHAR(100) NOT NULL,
                          description VARCHAR(255) NOT NULL,
                          price NUMERIC(15, 5) NOT NULL,
                          id_type_product INT,
                          FOREIGN KEY (id_type_product) REFERENCES type_product(id) ON DELETE SET NULL
);


--INSERT INTO "users" (name, email, password) VALUES ('Anderson', 'anderson@email.com', '!senha!');
