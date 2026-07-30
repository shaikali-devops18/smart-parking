CREATE DATABASE smart_parking;
USE smart_parking;

-- Table for users
CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(100)
);

-- Table for parking slots
CREATE TABLE parking_slots (
  slot_id INT AUTO_INCREMENT PRIMARY KEY,
  location_name VARCHAR(100),
  latitude DOUBLE,
  longitude DOUBLE,
  status ENUM('available', 'occupied') DEFAULT 'available'
);

-- Table for reservations
CREATE TABLE reservations (
  reservation_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  slot_id INT,
  reservation_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id),
  FOREIGN KEY (slot_id) REFERENCES parking_slots(slot_id)
);

-- Insert sample parking slots
INSERT INTO parking_slots (location_name, latitude, longitude, status) VALUES
('Parking Lot 1', 17.385044, 78.486671, 'available'),
('Parking Lot 2', 17.391044, 78.481671, 'available'),
('Parking Lot 3', 17.380044, 78.490671, 'occupied');