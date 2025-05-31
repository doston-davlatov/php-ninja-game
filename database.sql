/* 
 * ======================================================
 *                    DATABASE YARATISH                  
 * ======================================================
 */

-- 1. Avvalgi mavjud database bo‘lsa, uni o‘chirish
DROP DATABASE IF EXISTS ninja_db;

-- 2. Yangi database yaratish
CREATE DATABASE ninja_db;

-- 3. Yaratilgan database'ni aktivlashtirish
USE ninja_db;

-- Foydalanuvchilar jadvali: foydalanuvchi ma'lumotlari saqlanadi
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Demo maqsadida 4 ta foydalanuvchi qo‘shilmoqda
INSERT INTO users (name, username, password)
VALUES 
('Iqbolshoh Ilhomjonov', 'iqbolshoh', '$2y$10$gIKUrsLRB.U7ee9Fv9nib.di2NgMYvAeqqWGoB5aFXpHoxIv/igkW'),
('Doston Davlatov', 'doston', '$2y$10$gIKUrsLRB.U7ee9Fv9nib.di2NgMYvAeqqWGoB5aFXpHoxIv/igkW');
