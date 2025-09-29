-- MySQL init script
CREATE DATABASE IF NOT EXISTS campus_sign CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE campus_sign;

/* core tables */
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(190) UNIQUE NOT NULL,
password_hash VARCHAR(255) NOT NULL,
full_name VARCHAR(190) NOT NULL,
role ENUM('student','admin','mentor','employer') NOT NULL,
department VARCHAR(100) NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE student_profiles (
user_id INT PRIMARY KEY,
resume_url VARCHAR(255),
cover_letter_url VARCHAR(255),
skills JSON NULL,
semester_lock YEAR NULL,
preferences JSON NULL,
FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE employers (
user_id INT PRIMARY KEY,
company_name VARCHAR(190) NOT NULL,
website VARCHAR(190),
verified TINYINT(1) DEFAULT 0,
FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE internships (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(190) NOT NULL,
description TEXT NOT NULL,
department VARCHAR(100) NOT NULL,
competency_tags JSON NULL,
stipend INT NULL,
placement_potential ENUM('low','medium','high') DEFAULT 'medium',
posted_by INT NOT NULL,
posted_by_role ENUM('admin','employer') NOT NULL,
verified TINYINT(1) DEFAULT 0,
location VARCHAR(120) NULL,
deadline DATE NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (posted_by) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE applications (
id INT AUTO_INCREMENT PRIMARY KEY,
internship_id INT NOT NULL,
student_id INT NOT NULL,
status ENUM('applied','approved','shortlisted','interview','offer','rejected','withdrawn') DEFAULT 'applied',
applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP NULL,
mentor_id INT NULL,
feedback TEXT NULL,
FOREIGN KEY (internship_id) REFERENCES internships(id) ON DELETE CASCADE,
FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
FOREIGN KEY (mentor_id) REFERENCES users(id) ON DELETE SET NULL,
UNIQUE KEY uniq_app (internship_id, student_id)
);

CREATE TABLE interviews (
id INT AUTO_INCREMENT PRIMARY KEY,
application_id INT NOT NULL,
schedule_at DATETIME NOT NULL,
mode ENUM('online','onsite') NOT NULL,
notes TEXT NULL,
FOREIGN KEY (application_id) REFERENCES applications(id) ON DELETE CASCADE
);

CREATE TABLE certificates (
id INT AUTO_INCREMENT PRIMARY KEY,
application_id INT NOT NULL,
issued_at DATETIME NULL,
employer_feedback TEXT NULL,
file_url VARCHAR(255) NULL,
FOREIGN KEY (application_id) REFERENCES applications(id) ON DELETE CASCADE
);

/* analytics helper */
CREATE VIEW v_open_positions AS
SELECT i.id as internship_id, i.title, i.department, i.deadline,
(SELECT COUNT(*) FROM applications a WHERE a.internship_id = i.id) as total_apps
FROM internships i WHERE i.verified = 1;

/* seed admin using SHA2 for prototype */
INSERT INTO users (email, password_hash, full_name, role)
VALUES ('admin@campus.local', SHA2('admin123',256), 'Placement Admin', 'admin');