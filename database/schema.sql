CREATE DATABASE IF NOT EXISTS cvhub_pro;
USE cvhub_pro;

CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    full_name VARCHAR(100) NOT NULL,

    email VARCHAR(150) UNIQUE NOT NULL,

    password VARCHAR(255) NOT NULL,

    profile_image VARCHAR(255) DEFAULT 'default.png',

    headline VARCHAR(255),

    bio TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);