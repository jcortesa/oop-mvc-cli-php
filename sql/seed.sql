-- ==============================
-- Sample data
-- ==============================

-- Locations
INSERT INTO locations (city, state)
VALUES ('Valencia', 'Valencia'),
      ('Almeria', 'Almeria'),
      ('Mojacar', 'Almeria'),
      ('Sanlucar', 'Cadiz'),
      ('Malaga', 'Malaga');

-- Vehicles
INSERT INTO vehicles (name, type, location_id)
VALUES ('Blue Car', 'car', 1),
      ('Speedy Bike', 'motorbike', 2),
      ('Red Car', 'car', 3),
      ('Vintage Bike', 'motorbike', 4),
      ('Family Car', 'car', 5);

-- Cars details
INSERT INTO cars (vehicle_id, doors, fuel)
VALUES (1, 5, 'gasoline'),
      (3, 3, 'electric'),
      (5, 5, 'diesel');

-- Motorbikes details
INSERT INTO motorbikes (vehicle_id, engine_cc, has_trunk)
VALUES (2, 600, 1),
      (4, 125, 0);