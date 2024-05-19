CREATE USER docker;
CREATE DATABASE docker;
GRANT ALL PRIVILEGES ON DATABASE docker TO docker;

create table "users"(
    id serial primary key not null,
    name text not null,
    email char(100) not null,
    password text
);

INSERT INTO "users" (name, email, password) VALUES ('Anderson', 'anderson@email.com', '!senha!');
