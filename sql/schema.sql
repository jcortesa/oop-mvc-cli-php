-- =======================================
-- Database: vehicle_catalog
-- =======================================

CREATE DATABASE IF NOT EXISTS vehicle_catalog
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE vehicle_catalog;

-- ==============================
-- Locations
-- ==============================
CREATE TABLE locations (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           city VARCHAR(100) NOT NULL,
                           state VARCHAR(100) NOT NULL
);

-- ==============================
-- Vehicles (base entity)
-- ==============================
CREATE TABLE vehicles (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(150) NOT NULL,
                          type ENUM('car','motorbike') NOT NULL,
                          location_id INT NOT NULL,
                          FOREIGN KEY (location_id) REFERENCES locations(id)
);

-- ==============================
-- Cars
-- ==============================
CREATE TABLE cars (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      vehicle_id INT NOT NULL UNIQUE,
                      doors TINYINT NOT NULL,
                      fuel ENUM('gasoline','diesel','electric','hybrid') NOT NULL,
                      FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE
);

-- ==============================
-- Motorbikes
-- ==============================
CREATE TABLE motorbikes (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            vehicle_id INT NOT NULL UNIQUE,
                            engine_cc INT NOT NULL,
                            has_trunk BOOLEAN NOT NULL DEFAULT 0,
                            FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE
);