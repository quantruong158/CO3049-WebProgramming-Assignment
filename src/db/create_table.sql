CREATE DATABASE doctor_appointment;

CREATE TABLE Time_slot (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slot_date DATE NOT NULL,
    slot_value INT NOT NULL
);

CREATE TABLE User (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(50) NOT NULL,
    email VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(7) NOT NULL,
);


ALTER TABLE Time_slot
ADD COLUMN patient_id INT UNSIGNED DEFAULT NULL,
ADD CONSTRAINT fk_patient
    FOREIGN KEY (patient_id)
    REFERENCES User(id);

ALTER TABLE Time_slot
ADD COLUMN doctor_id INT UNSIGNED NOT NULL,
ADD CONSTRAINT fk_doctorS
    FOREIGN KEY (doctor_id)
    REFERENCES User(id);


ALTER TABLE Time_slot
ADD CONSTRAINT uq_time_slot UNIQUE(slot_date, slot_value, doctor_id);