CREATE TABLE users( 
    id INTEGER PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
);

CREATE TABLE pets (
    pet_id INTEGER PRIMARY KEY,
    pet_name VARCHAR,
    pet_type VARCHAR NOT NULL,
    pet_color VARCHAR,
    is_adopted INTEGER NOT NULL CHECK (is_adopted = 0 OR is_adopted = 1)
);

CREATE TABLE adopted_pets (
    adopted_id INTEGER PRIMARY KEY,
    pet_id INTEGER,
    username VARCHAR NOT NULL REFERENCES user
);

CREATE TABLE pets_for_adoption (
    for_adoption_id INTEGER PRIMARY KEY,
    pet_id INTEGER,
    username VARCHAR NOT NULL REFERENCES user
);