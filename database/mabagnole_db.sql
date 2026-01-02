-- 1. Création et sélection de la base
CREATE DATABASE IF NOT EXISTS mabagnole_db;
USE mabagnole_db;

-- 2. Table des Catégories (Citadines, SUV, Luxe, etc.)
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Table des Véhicules (Version Premium avec specs techniques)
CREATE TABLE vehicules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modele VARCHAR(150) NOT NULL,
    immatriculation VARCHAR(20) UNIQUE NOT NULL,
    prix_par_jour DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255),
    categorie_id INT,
    transmission ENUM('Manuelle', 'Automatique') DEFAULT 'Manuelle',
    carburant ENUM('Diesel', 'Essence', 'Electrique', 'Hybride') DEFAULT 'Diesel',
    nb_places INT DEFAULT 5,
    description TEXT,
    is_active BOOLEAN DEFAULT TRUE, -- Maintenance/Soft Delete
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 4. Table des Utilisateurs (Gestion Admin/Client & Statut)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'client') DEFAULT 'client',
    is_active BOOLEAN DEFAULT TRUE, -- Bannissement/Activation
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 5. Table des Réservations (Logistique complète)
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    vehicule_id INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    lieu_prise VARCHAR(255) NOT NULL,
    lieu_retour VARCHAR(255) NOT NULL,
    statut ENUM('en_attente', 'confirmee', 'annulee', 'terminee') DEFAULT 'en_attente',
    total_prix DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 6. Table des Avis (Modération avec Soft Delete)
CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    vehicule_id INT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    is_deleted BOOLEAN DEFAULT FALSE, -- Soft Delete pour la modération
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(id) ON DELETE CASCADE
) ENGINE=InnoDB;



INSERT INTO category (category_name, category_description) VALUES 
('SUV', 'Spacious vehicles suitable for families and off-road trips'),
('Sedan', 'Comfortable cars for city driving and long distances'),
('Luxury', 'High-end vehicles for special occasions'),
('Economy', 'Fuel-efficient and affordable small cars');



INSERT INTO vehicle (brand, model, price_per_day, image, is_available, category_id) VALUES
('Toyota', 'RAV4', 95.00, 'https://pressroom.toyota.com/wp-content/uploads/2025/05/2026-Toyota-RAV4-PHEV_GRSport_Studio_002-1500x1005.jpg', 1, 1),
('Honda', 'CR-V', 90.00, 'https://di-uploads-pod14.dealerinspire.com/hondaeastcincy/uploads/2025/06/Honda-CR-V-LX.jpg', 1, 1),
('Ford', 'Explorer', 110.00, 'https://vehi.b-cdn.net/models/2025/Ford/Explorer/2025-explorer-st-line.png', 1, 1),
('Nissan', 'Rogue', 85.00, 'https://di-uploads-pod18.dealerinspire.com/walserautomotivegroup/uploads/2023/10/DSC06130.jpg', 1, 1);


INSERT INTO vehicle (brand, model, price_per_day, image, is_available, category_id) VALUES
('Honda', 'Civic', 70.00, 'https://www.bellevuehonda.com/blogs/5487/wp-content/uploads/2024/07/2024-Honda-Civic.png', 1, 2),
('Toyota', 'Camry', 80.00, 'https://hips.hearstapps.com/mtg-prod/65a4c41dadb8a4000836453c/2025-toyota-camry-hybrid-sedan-13.png', 1, 2),
('BMW', '3 Series', 95.00, 'https://images.prestigeonline.com/content/uploads/2018/10/08083509/P90323664_highRes_the-all-new-bmw-3-se.jpg', 1, 2),
('Volkswagen', 'Jetta', 65.00, 'https://di-uploads-pod25.dealerinspire.com/saffordvolkswagen/uploads/2024/05/image-1500x1000-3.png', 1, 2);

INSERT INTO vehicle (brand, model, price_per_day, image, is_available, category_id) VALUES
('Mercedes-Benz', 'S-Class', 250.00, 'https://cdn.motor1.com/images/mgl/LZYyW/s1/2021-mercedes-benz-s-class-feature.webp', 1, 3),
('Audi', 'A8', 220.00, 'https://images.hgmsites.net/med/2025-audi-a8-l-55-tfsi-quattro-angular-front-exterior-view_100962236_m.webp', 1, 3),
('BMW', '7 Series', 280.00, 'https://www.topgear.com/sites/default/files/2023/08/P90492179_highRes_bmw-i7-xdrive60-m-sp%20%281%29.jpg', 1, 3);

INSERT INTO vehicle (brand, model, price_per_day, image, is_available, category_id) VALUES
('Toyota', 'Corolla', 50.00, 'https://toyota-cms-media.s3.amazonaws.com/wp-content/uploads/2020/07/2021-Toyota-Corolla-Apex_008.jpg', 1, 4),
('Hyundai', 'Accent', 45.00, 'https://m.psecn.photoshelter.com/img-get2/I0000ZWSA8CHNZok/fit=700', 1, 4),
('Kia', 'Rio', 48.00, 'https://cimg2.ibsrv.net/ibimg/hgm/1920x1080-1/100/562/new-kia-rio_100562958.jpg', 1, 4),
('Ford', 'Fiesta', 52.00, 'https://cdn.motor1.com/images/mgl/28rKM/s1/ford-fiesta-st-2022.jpg', 1, 4);


-- adding admin account

INSERT INTO users(full_name,email,password,role) VALUES('ilyas','admin@gmail.com','$2y$10$V/w4Kt75wQuzokW9HqsRR.8oDRFZCRR7Rzv1AOlLwEBb2KdJyuF5u','admin');