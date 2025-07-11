-- --- USER
-- CREATE TABLE users (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     full_name VARCHAR(50) NOT NULL,
--     username VARCHAR(50) NOT NULL,
--     password VARCHAR(255) NOT NULL,
--     role ENUM('admin', 'employee') NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- CREATE TABLE tasks (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     title VARCHAR(100) NOT NULL,
--     description TEXT,
--     assigned_to INT,
--     status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (assigned_to) REFERENCES users(id)
-- );

-- CREATE TABLE notifications (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     message TEXT NOT NULL,
--     recipient INT NOT NULL,
--     type VARCHAR(50) NOT NULL,
--     date DATE NOT NULL,
--     is_read BOOLEAN DEFAULT FALSE
-- );

-- USERS TABLE
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'employee') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TASKS TABLE
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    assigned_to INT,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
);

-- NOTIFICATIONS TABLE
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    recipient INT NOT NULL,
    type VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (recipient) REFERENCES users(id) ON DELETE CASCADE
);
