DROP TABLE IF EXISTS users;
CREATE TABLE users(
	id INTEGER PRIMARY KEY,
	username TEXT UNIQUE NOT NULL,
	password TEXT NOT NULL
);

DROP TABLE IF EXISTS auth_tokens;
CREATE TABLE auth_tokens (
        id INTEGER PRIMARY KEY,
        selector TEXT UNIQUE NOT NULL,
        hashed_validator TEXT NOT NULL,
        user_id INTEGER NOT NULL REFERENCES users(id),
        expires DATETIME NOT NULL DEFAULT (DATETIME('now', '+1 month'))
);

DROP TABLE IF EXISTS dogs;
CREATE TABLE dogs (
	id INTEGER PRIMARY KEY,
	user_id INTEGER NOT NULL REFERENCES users(id),
	listing_name TEXT NOT NULL,
	listing_description TEXT NOT NULL,
	listing_picture TEXT NOT NULL,
	is_adopted INTEGER NOT NULL DEFAULT 0 CHECK (is_adopted = 0 OR is_adopted = 1)
);

DROP TABLE IF EXISTS dog_breed;
CREATE TABLE dog_breed (
	id INTEGER PRIMARY KEY,
	breed_name TEXT UNIQUE NOT NULL,
	dog_id INTEGER NOT NULL REFERENCES dogs(id)
);

DROP TABLE IF EXISTS dog_colors;
CREATE TABLE dog_colors (
	id INTEGER PRIMARY KEY,
	color_name TEXT UNIQUE NOT NULL,
	dog_id INTEGER NOT NULL REFERENCES dogs(id)
);

DROP TABLE IF EXISTS dog_ages;
CREATE TABLE dog_ages (
	id INTEGER PRIMARY KEY,
	age_name TEXT UNIQUE NOT NULL,
	dog_id INTEGER NOT NULL REFERENCES dogs(id)
);

DROP TABLE IF EXISTS dog_genders;
CREATE TABLE dog_genders (
	id INTEGER PRIMARY KEY,
	gender_name TEXT UNIQUE NOT NULL,
	dog_id INTEGER NOT NULL REFERENCES dogs(id)
);
