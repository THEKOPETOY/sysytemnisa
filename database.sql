-- Database: tingog
-- Create database if not exists
CREATE DATABASE IF NOT EXISTS tingog;
USE tingog;

-- Table: suggestions
CREATE TABLE IF NOT EXISTS suggestions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(255),
  contact VARCHAR(20),
  category ENUM('Public Services', 'Facilities', 'Safety', 'Cleanliness', 'Others'),
  suggestion TEXT NOT NULL,
  anonymous BOOLEAN DEFAULT FALSE,
  status ENUM('pending', 'ongoing', 'resolved', 'not_feasible') DEFAULT 'pending',
  response TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Sample data (optional)
INSERT INTO suggestions (full_name, category, suggestion, status) VALUES 
('Sample User', 'Facilities', 'Fix streetlight', 'resolved');
