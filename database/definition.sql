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

DROP TABLE IF EXISTS dog_breeds;
CREATE TABLE dog_breeds (
	id INTEGER PRIMARY KEY,
	breed_name TEXT UNIQUE NOT NULL
);

DROP TABLE IF EXISTS dog_colors;
CREATE TABLE dog_colors (
	id INTEGER PRIMARY KEY,
	color_name TEXT UNIQUE NOT NULL
);

DROP TABLE IF EXISTS dog_ages;
CREATE TABLE dog_ages (
	id INTEGER PRIMARY KEY,
	age_name TEXT UNIQUE NOT NULL
);

DROP TABLE IF EXISTS dog_genders;
CREATE TABLE dog_genders (
	id INTEGER PRIMARY KEY,
	gender_name TEXT UNIQUE NOT NULL
);

DROP TABLE IF EXISTS dogs;
CREATE TABLE dogs (
	id INTEGER PRIMARY KEY,
	user_id INTEGER NOT NULL REFERENCES users(id),
	listing_name TEXT NOT NULL,
	listing_description TEXT NOT NULL,
	listing_picture TEXT NOT NULL,
	is_adopted INTEGER NOT NULL DEFAULT 0 CHECK (is_adopted = 0 OR is_adopted = 1),
	breed_id INTEGER NOT NULL REFERENCES dog_breeds(id),
	color_id INTEGER NOT NULL REFERENCES dog_colors(id),
	age_id INTEGER NOT NULL REFERENCES dog_ages(id),
	gender_id INTEGER NOT NULL REFERENCES dog_genders(id)
);

INSERT INTO dog_breeds(breed_name) VALUES ('Labdrador');
INSERT INTO dog_breeds(breed_name) VALUES ('Pug');

INSERT INTO dog_colors(color_name) VALUES ('White');
INSERT INTO dog_colors(color_name) VALUES ('Black');

INSERT INTO dog_ages(age_name) VALUES ('Puppy');
INSERT INTO dog_ages(age_name) VALUES ('Teen');

INSERT INTO dog_genders(gender_name) VALUES ('Male');
INSERT INTO dog_genders(gender_name) VALUES ('Female');
INSERT INTO dog_genders(gender_name) VALUES ('Non-binary');
