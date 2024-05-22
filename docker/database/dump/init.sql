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

--INSERT INTO "users" (name, email, password) VALUES ('Anderson', 'anderson@email.com', '!senha!');
