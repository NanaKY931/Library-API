-- Contacts CRUD API - Database Setup

CREATE TABLE IF NOT EXISTS contacts (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255) NOT NULL,
    phone      VARCHAR(20)  NOT NULL,
    email      VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data
INSERT INTO contacts (name, phone, email) VALUES
('Kwame Asante',   '0241234567', 'kwame.asante@email.com'),
('Ama Mensah',     '0559876543', 'ama.mensah@email.com');
