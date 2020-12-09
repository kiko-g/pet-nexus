DROP TABLE IF EXISTS users;
CREATE TABLE users(
    id INTEGER PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
);

DROP TABLE IF EXISTS  auth_tokens;
CREATE TABLE auth_tokens(
        id INTEGER PRIMARY KEY,
        selector TEXT UNIQUE NOT NULL,
        hashed_validator TEXT NOT NULL,
        user_id INTEGER NOT NULL REFERENCES users(id),
        expires DATETIME NOT NULL DEFAULT (DATETIME('now', '+1 month'))
);

DROP TABLE IF EXISTS  pets;
CREATE TABLE pets (
    pet_id INTEGER PRIMARY KEY,
    pet_name VARCHAR,
    pet_type VARCHAR NOT NULL,
    pet_color VARCHAR,
    pet_description VARCHAR,
    is_adopted INTEGER NOT NULL CHECK (is_adopted = 0 OR is_adopted = 1),
    pet_photo VARCHAR
);

DROP TABLE IF EXISTS  adopted_pets;
CREATE TABLE adopted_pets (
    adopted_id INTEGER PRIMARY KEY,
    pet_id INTEGER,
    user_id VARCHAR NOT NULL REFERENCES users(id)
);

DROP TABLE IF EXISTS  pets_for_adoption;
CREATE TABLE pets_for_adoption (
    for_adoption_id INTEGER PRIMARY KEY,
    pet_id INTEGER,
    user_id VARCHAR NOT NULL REFERENCES users(id)
);

DROP TABLE IF EXISTS  likes;
CREATE TABLE likes (
    like_id INTEGER PRIMARY KEY,
    for_adoption_id INTEGER NOT NULL,
    user_id VARCHAR NOT NULL REFERENCES users(id)
);

DROP TABLE IF EXISTS  comments;
CREATE TABLE comments (
    comments_id INTEGER PRIMARY KEY,
    for_adoption_id INTEGER NOT NULL,
    content VARCHAR NOT NULL,
    user_id VARCHAR NOT NULL REFERENCES users(id)
);