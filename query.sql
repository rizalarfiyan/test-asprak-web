CREATE DATABASE IF NOT EXISTS students;

DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS study_programs;

CREATE TABLE study_programs
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100)           NOT NULL
);

CREATE TABLE students
(
    nim               INT PRIMARY KEY UNIQUE NOT NULL,
    name              VARCHAR(100)           NOT NULL,
    gender            ENUM ('L', 'P')        NOT NULL,
    date_of_birth     DATE                   NOT NULL,
    location_of_birth VARCHAR(30)            NOT NULL,
    address           VARCHAR(255)           NOT NULL,
    study_program_id  INT                    NOT NULL,
    hobby             VARCHAR(255)           NOT NULL,
    FOREIGN KEY (study_program_id) REFERENCES study_programs (id)
);

INSERT INTO study_programs (name)
VALUES ('D3 - Manajemen Informatika'),
       ('D3 - Teknik Informatika'),
       ('S1 - Akuntansi'),
       ('S1 - Arsitektur'),
       ('S1 - Bachelor Communication Science'),
       ('S1 - Bachelor Informatics'),
       ('S1 - Bachelor Information System'),
       ('S1 - Bachelor Information Technology'),
       ('S1 - Computer Science Student Exchange'),
       ('S1 - Ekonomi'),
       ('S1 - Geografi'),
       ('S1 - Hubungan Internasional'),
       ('S1 - Ilmu Komunikasi'),
       ('S1 - Ilmu Pemerintahan'),
       ('S1 - Informatika'),
       ('S1 - Kewirausahaan'),
       ('S1 - Perencanaan Wilayah dan kota'),
       ('S1 - Sistem Informasi'),
       ('S1 - Teknik Komputer'),
       ('S1 - Teknologi Informasi');
