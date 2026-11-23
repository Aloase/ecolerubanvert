-- Migration: extra columns needed for the rental booking admin workflow
ALTER TABLE rental_bookings
  ADD COLUMN IF NOT EXISTS invoice_number VARCHAR(30) NULL UNIQUE AFTER invoice_path,
  ADD COLUMN IF NOT EXISTS admin_note TEXT NULL AFTER invoice_number,
  ADD COLUMN IF NOT EXISTS decided_by INT NULL AFTER admin_note,
  ADD COLUMN IF NOT EXISTS decided_at DATETIME NULL AFTER decided_by;

CREATE TABLE IF NOT EXISTS rental_booking_history (
  id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT NOT NULL,
  status ENUM('en_attente','confirmee','refusee','annulee') NOT NULL,
  note TEXT NULL,
  admin_id INT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (booking_id) REFERENCES rental_bookings(id) ON DELETE CASCADE
) ENGINE=InnoDB;
