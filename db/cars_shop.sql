CREATE TABLE IF NOT EXISTS `feedbacks` (
    id INTEGER PRIMARY KEY,
    fio TEXT,
    email TEXT,
    message TEXT
);

CREATE TABLE IF NOT EXISTS `orders` (
    id INTEGER PRIMARY KEY,
    name TEXT,
    email TEXT,
    phone TEXT,
    model TEXT
);

CREATE TABLE IF NOT EXISTS `posts` (
    id INTEGER PRIMARY KEY,
    title TEXT,
    body TEXT,
    image TEXT
);

CREATE TABLE IF NOT EXISTS `users` (
    id INTEGER PRIMARY KEY,
    login TEXT,
    password TEXT
);