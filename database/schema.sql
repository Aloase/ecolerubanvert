-- ============================================================
-- Ecole Ruban Vert — Schema base de donnees
-- Modules: Admin, Admissions, Location d'espaces
-- ============================================================
CREATE DATABASE IF NOT EXISTS ecolerubanvert
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ecolerubanvert;

-- ------------------------------------------------------------
-- ADMIN
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS admin_users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('super_admin','admissions','rentals') NOT NULL DEFAULT 'super_admin',
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  last_login_at DATETIME NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- ADMISSIONS
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS admission_levels (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  slug VARCHAR(120) NOT NULL UNIQUE,
  min_age INT NULL,
  max_age INT NULL,
  sort_order INT NOT NULL DEFAULT 0
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS admission_applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reference_code VARCHAR(20) NOT NULL UNIQUE,
  level_id INT NULL,
  child_first_name VARCHAR(100) NOT NULL,
  child_last_name VARCHAR(100) NOT NULL,
  child_dob DATE NOT NULL,
  child_gender ENUM('M','F','O') NOT NULL DEFAULT 'O',
  current_school VARCHAR(190) NULL,
  parent_name VARCHAR(190) NOT NULL,
  parent_email VARCHAR(190) NOT NULL,
  parent_phone VARCHAR(40) NOT NULL,
  parent_address TEXT NULL,
  entry_school_year VARCHAR(20) NULL,
  message TEXT NULL,
  status ENUM('recu','en_cours','entretien_planifie','accepte','liste_attente','refuse') NOT NULL DEFAULT 'recu',
  access_token VARCHAR(64) NOT NULL,
  consent_rgpd TINYINT(1) NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (level_id) REFERENCES admission_levels(id) ON DELETE SET NULL,
  INDEX idx_status (status),
  INDEX idx_parent_email (parent_email)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS admission_documents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  application_id INT NOT NULL,
  doc_type ENUM('etat_civil','bulletin','photo','vaccin','autre') NOT NULL,
  original_name VARCHAR(255) NOT NULL,
  stored_path VARCHAR(255) NOT NULL,
  file_size INT NOT NULL DEFAULT 0,
  uploaded_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (application_id) REFERENCES admission_applications(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS admission_status_history (
  id INT AUTO_INCREMENT PRIMARY KEY,
  application_id INT NOT NULL,
  status ENUM('recu','en_cours','entretien_planifie','accepte','liste_attente','refuse') NOT NULL,
  note TEXT NULL,
  changed_by INT NULL,
  changed_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (application_id) REFERENCES admission_applications(id) ON DELETE CASCADE,
  FOREIGN KEY (changed_by) REFERENCES admin_users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS appointment_slots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slot_date DATE NOT NULL,
  start_time TIME NOT NULL,
  end_time TIME NOT NULL,
  type ENUM('visite','entretien') NOT NULL DEFAULT 'visite',
  capacity INT NOT NULL DEFAULT 1,
  is_open TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uniq_slot (slot_date, start_time, type)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS appointments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slot_id INT NOT NULL,
  application_id INT NULL,
  full_name VARCHAR(190) NOT NULL,
  email VARCHAR(190) NOT NULL,
  phone VARCHAR(40) NOT NULL,
  status ENUM('confirme','annule','honore','absent') NOT NULL DEFAULT 'confirme',
  reminder_sent TINYINT(1) NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (slot_id) REFERENCES appointment_slots(id) ON DELETE CASCADE,
  FOREIGN KEY (application_id) REFERENCES admission_applications(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- LOCATION D'ESPACES (rentals) — schema prepared now, built in phase 2
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS rental_spaces (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(190) NOT NULL,
  slug VARCHAR(190) NOT NULL UNIQUE,
  description TEXT NULL,
  capacity INT NOT NULL DEFAULT 0,
  equipment TEXT NULL,
  price_per_hour DECIMAL(10,2) NULL,
  price_per_day DECIMAL(10,2) NULL,
  cover_image VARCHAR(255) NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS rental_space_images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  space_id INT NOT NULL,
  image_path VARCHAR(255) NOT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  FOREIGN KEY (space_id) REFERENCES rental_spaces(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS rental_recurring_slots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  space_id INT NOT NULL,
  weekday TINYINT NOT NULL COMMENT '0=Sunday..6=Saturday',
  start_time TIME NOT NULL,
  end_time TIME NOT NULL,
  FOREIGN KEY (space_id) REFERENCES rental_spaces(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS rental_exclusions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  space_id INT NULL COMMENT 'NULL = applies to all spaces (e.g. school holidays)',
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  reason VARCHAR(255) NULL,
  FOREIGN KEY (space_id) REFERENCES rental_spaces(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS rental_bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reference_code VARCHAR(20) NOT NULL UNIQUE,
  space_id INT NOT NULL,
  booking_date DATE NOT NULL,
  start_time TIME NOT NULL,
  end_time TIME NOT NULL,
  renter_name VARCHAR(190) NOT NULL,
  renter_org VARCHAR(190) NULL,
  renter_email VARCHAR(190) NOT NULL,
  renter_phone VARCHAR(40) NOT NULL,
  purpose TEXT NULL,
  status ENUM('en_attente','confirmee','refusee','annulee') NOT NULL DEFAULT 'en_attente',
  quote_amount DECIMAL(10,2) NULL,
  invoice_path VARCHAR(255) NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (space_id) REFERENCES rental_spaces(id) ON DELETE CASCADE,
  INDEX idx_booking_date (booking_date)
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- NOTIFICATIONS LOG (shared)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS notifications_log (
  id INT AUTO_INCREMENT PRIMARY KEY,
  channel ENUM('email') NOT NULL DEFAULT 'email',
  recipient VARCHAR(190) NOT NULL,
  subject VARCHAR(255) NOT NULL,
  related_type VARCHAR(50) NULL,
  related_id INT NULL,
  status ENUM('sent','failed') NOT NULL DEFAULT 'sent',
  error_message TEXT NULL,
  sent_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- SEED DATA
-- ------------------------------------------------------------
INSERT IGNORE INTO admission_levels (name, slug, min_age, max_age, sort_order) VALUES
('Early Years', 'early-years', 3, 5, 1),
('Primary Years Programme (PYP)', 'pyp', 3, 12, 2),
('IMYC', 'imyc', 11, 14, 3),
('IGCSE', 'igcse', 14, 16, 4),
('IB Diploma', 'ib-diploma', 16, 19, 5);

-- Default admin user: email admin@ecolerubanvert.com / password ChangeMe!2024
-- (hash generated with PHP password_hash, bcrypt) — MUST be changed after first login.
INSERT IGNORE INTO admin_users (name, email, password_hash, role) VALUES
('Administrateur ERV', 'admin@ecolerubanvert.com', '$2y$10$RuqzrKnpuB.IetVOTg5HM.onnI8DQZ2lkJQm7bw4Rf1LU7rVZpdWa', 'super_admin');
