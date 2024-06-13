-- PostgreSQL SQL Dump
-- Converted from MySQL/MariaDB
-- Database: `todolist`

-- Enable extensions for auto-increment functionality
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

-- Set up the database
BEGIN;

-- Struktur dari tabel `tasks`
CREATE TABLE tasks (
    taskid SERIAL PRIMARY KEY,
    user_id INT,
    tasklabel VARCHAR(255) NOT NULL,
    taskstatus VARCHAR(5) CHECK (taskstatus IN ('open', 'close')) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Struktur dari tabel `users`
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Foreign key constraints
ALTER TABLE tasks
ADD CONSTRAINT fk_user
FOREIGN KEY (user_id) REFERENCES users(id);

COMMIT;
