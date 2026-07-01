CREATE TABLE IF NOT EXISTS movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    score INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO movies (title, year, score) VALUES 
('Ready Player One', 2020, 9),
('The Matrix', 2000, 10),
('Godzilla', 2020, 8);