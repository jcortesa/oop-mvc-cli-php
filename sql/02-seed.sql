-- ==============================
-- Sample data
-- ==============================

-- ==============================
-- Locations
-- ==============================
INSERT INTO locations (city, state) VALUES
('Valencia', 'Valencia'),         -- Latin
('Almería', 'Almería'),           -- Latin
('Mojácar', 'Almería'),           -- Latin
('Sanlúcar', 'Cadiz'),            -- Latin
('Málaga', 'Málaga'),             -- Latin
('Dubai', 'United Arab Emirates'),    -- Arabic
('Beijing', 'China'),                 -- Chinese
('Tokyo', 'Japan'),                   -- Japanese
('Seoul', 'South Korea'),             -- Korean
('Mumbai', 'India');                  -- Hindi

-- ==============================
-- Vehicles (base)
-- ==============================
INSERT INTO vehicles (name, type, location_id) VALUES
-- Latin vehicles
('Blue Car', 'car', 1),
('Speedy Bike', 'motorbike', 2),
('Red Car', 'car', 3),
('Vintage Bike', 'motorbike', 4),
('Family Car', 'car', 5),
-- International vehicles
('فان الأزرق', 'car', 6),           -- Arabic
('北京极速', 'motorbike', 7),       -- Chinese
('東京スポーツカー', 'car', 8),     -- Japanese
('서울 스쿠터', 'motorbike', 9),    -- Korean
('ताज परिवार', 'car', 10);          -- Hindi

-- ==============================
-- Cars details
-- ==============================
INSERT INTO cars (vehicle_id, doors, fuel) VALUES
-- Latin cars
(1, 5, 'gasoline'),
(3, 3, 'electric'),
(5, 5, 'diesel'),
-- International cars
(6, 4, 'gasoline'),  -- Arabic car
(8, 2, 'electric'),  -- Japanese car
(10, 4, 'diesel');   -- Hindi car

-- ==============================
-- Motorbikes details
-- ==============================
INSERT INTO motorbikes (vehicle_id, engine_cc, has_trunk) VALUES
-- Latin motorbikes
(2, 600, 1),
(4, 125, 0),
-- International motorbikes
(7, 600, 1),  -- Chinese motorbike
(9, 125, 0);  -- Korean motorbike