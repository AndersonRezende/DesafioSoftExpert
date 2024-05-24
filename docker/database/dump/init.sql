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
                           id              SERIAL PRIMARY KEY,
                           sku             VARCHAR(10)  NOT NULL,
                           name            VARCHAR(100)   NOT NULL,
                           description     TEXT   NOT NULL,
                           price           NUMERIC(15, 5) NOT NULL,
                           id_product_type INT,
                           image           BYTEA,
                           FOREIGN KEY (id_product_type) REFERENCES product_type (id) ON DELETE CASCADE
);

create table "taxes"(
                           id              SERIAL PRIMARY KEY,
                           name            VARCHAR(100)   NOT NULL,
                           value           NUMERIC(15, 5) NOT NULL
);

create table "tax_product"(
                        id              SERIAL PRIMARY KEY,
                        id_tax INT,
                        id_product_type INT,
                        FOREIGN KEY (id_tax) REFERENCES taxes (id) ON DELETE CASCADE ,
                        FOREIGN KEY (id_product_type) REFERENCES product_type (id) ON DELETE CASCADE
);

create table "sales"(
                        id                      SERIAL PRIMARY KEY,
                        total_base_value        NUMERIC(15, 5) NOT NULL,
                        total_value_with_tax    NUMERIC(15, 5) NOT NULL,
                        items_count             INT,
                        products_count          INT,
                        finished                TIMESTAMP,
                        created_at              TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        updated_at              TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table "product_sale"(
                        id                      SERIAL PRIMARY KEY,
                        id_sale                 INT,
                        id_product              INT,
                        quantity                INT,
                        product_price           NUMERIC(15, 5) NOT NULL,
                        product_price_with_tax  NUMERIC(15, 5) NOT NULL,
                        FOREIGN KEY (id_sale) REFERENCES sales (id) ON DELETE CASCADE,
                        FOREIGN KEY (id_product) REFERENCES products (id) ON DELETE CASCADE
);

CREATE OR REPLACE FUNCTION update_updated_at()
    RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = CURRENT_TIMESTAMP;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER update_updated_at
    BEFORE UPDATE ON sales
    FOR EACH ROW
EXECUTE FUNCTION update_updated_at();
--INSERT INTO "users" (name, email, password) VALUES ('Anderson', 'anderson@email.com', '!senha!');
