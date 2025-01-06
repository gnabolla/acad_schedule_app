-- Start a transaction (optional but recommended)
START TRANSACTION;

-- =======================================
-- 1) USERS (no dependencies)
-- =======================================
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` enum('faculty','student','admin','registrar') NOT NULL DEFAULT 'faculty',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','active','rejected') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `created_at`, `updated_at`, `status`) VALUES
(1, 'admin', '$2y$10$mg0gQmt1uVYxdyJYEDV3xuIWaQMHA9yWXZmH/uR7vlcsKY3GT8fey', NULL, 'admin', '2025-01-04 09:34:27', '2025-01-04 09:34:27', 'active'),
(10, 'MVD021473', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'mavalendammay613@gmail.com', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(11, 'CVB029292', '$2y$10$yTh0ZzGwzgkrni2fHLG7IuqsDHb5CM3rV62CENcNn.915PGvbt01O', 'carlo.v.baltazar@isu.edu.ph', 'faculty', '2025-01-06 02:55:12', '2025-01-06 03:25:24', 'active'),
(12, 'MCB062179', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'maryjane.baniqued@gmail.com', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(13, 'ARB100488', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'audelon.r.benito@isu.edu.ph', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(14, 'JCC090582', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'joey.c.cereno@isu.edu.ph', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(15, 'JPC062278', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'janetcunanan242@gmail.com', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(16, 'VBPD122992', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'ghielaurel28@gmail.com', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(17, 'JTG090983', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'domingo.m.ramos@isu.edu.ph', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(18, 'JEL012888', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'striffe0970@gmail.com', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(19, 'YRM041297', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'jayson.t.guillermo@isu.edu.ph', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(20, 'JBN051881', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'yumptisolle@gmail.com', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(21, 'MVQ071991', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'njunesther@gmail.com', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(22, 'DMR013175', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'macjohnq19@gmail.com', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active'),
(23, 'JCT033090', '$2y$10$aXtrtozRo1frIBD125xJsOdkPiuP7GXxYfWCCwXfhlAcGnMd2Znp.', 'joem033090@gmail.com', 'faculty', '2025-01-06 02:55:12', '2025-01-06 02:55:12', 'active');


-- =======================================
-- 2) DEPARTMENTS (no dependencies)
-- =======================================
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'IICT', 'Institute of Information and Communication Technology', '2025-01-04 22:07:16', '2025-01-04 22:07:16'),
(2, 'SAA', 'School of Agriculture and Agribusiness', '2025-01-04 23:00:27', '2025-01-04 23:00:27');


-- =======================================
-- 3) PROGRAMS (references departments)
-- =======================================
CREATE TABLE `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_programs_department` (`department_id`),
  CONSTRAINT `fk_programs_department` FOREIGN KEY (`department_id`) 
    REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

INSERT INTO `programs` (`id`, `department_id`, `name`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'BSIT', 'BSIT', 'Bachelor of Science in Information Technology', '2025-01-04 22:08:51', '2025-01-04 23:01:06'),
(2, 2, 'BSA', '', 'Bachelor of Science in Agriculture', '2025-01-04 23:00:43', '2025-01-04 23:00:43');


-- =======================================
-- 4) CURRICULUM (references programs)
-- =======================================
CREATE TABLE `curriculum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) DEFAULT NULL,
  `version_label` varchar(100) NOT NULL,
  `effectivity_sy` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_curriculum_program` (`program_id`),
  CONSTRAINT `fk_curriculum_program` FOREIGN KEY (`program_id`)
    REFERENCES `programs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_general_ci;

INSERT INTO `curriculum` (`id`, `program_id`, `version_label`, `effectivity_sy`, `notes`, `created_at`, `updated_at`) VALUES
(1, NULL, '2024 Revision', '2024-2025', 'Updated curriculum for CS', '2025-01-04 14:59:25', '2025-01-04 14:59:25'),
(2, NULL, '2024 Revision', '2024-2025', 'Updated curriculum for IT', '2025-01-04 14:59:25', '2025-01-04 14:59:25'),
(3, NULL, '2024 Revision', '2024-2025', 'Updated curriculum for SE', '2025-01-04 14:59:25', '2025-01-04 14:59:25');


-- =======================================
-- 5) SUBJECTS (references departments, programs)
-- =======================================
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_lab` tinyint(1) DEFAULT 0,
  `department_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `units` decimal(4,1) DEFAULT NULL,
  `is_major` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_subjects_department` (`department_id`),
  KEY `fk_subjects_program` (`program_id`),
  CONSTRAINT `fk_subjects_department` FOREIGN KEY (`department_id`)
    REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_subjects_program` FOREIGN KEY (`program_id`)
    REFERENCES `programs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- (No initial INSERTs for `subjects` were given in the sample)


-- =======================================
-- 6) CURRICULUM_SUBJECTS (references curriculum, subjects)
-- =======================================
CREATE TABLE `curriculum_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curriculum_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `is_lab` tinyint(1) DEFAULT 0,
  `prerequisites` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `curriculum_id` (`curriculum_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `curriculum_subjects_ibfk_1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`),
  CONSTRAINT `curriculum_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;


-- =======================================
-- 7) FACULTIES (references users, departments)
-- =======================================
CREATE TABLE `faculties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `prefix` varchar(50) DEFAULT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  `position_rank` varchar(100) DEFAULT NULL,
  `employment_status` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_number` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faculties_user_id_fk` (`user_id`),
  KEY `fk_faculties_department` (`department_id`),
  CONSTRAINT `faculties_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
  CONSTRAINT `fk_faculties_department` FOREIGN KEY (`department_id`) REFERENCES `departments`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

INSERT INTO `faculties` (`id`, `user_id`, `department_id`, `firstname`, `middlename`, `lastname`, `created_at`, `updated_at`, `prefix`, `suffix`, `position_rank`, `employment_status`, `birthdate`, `email`, `id_number`) VALUES
(20, 10, 1, 'MA. VALEN', 'DAMMAY', 'ALZATE', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'DR.', 'PhD/DIT', 'ASSOCIATE PROFESSOR II', 'PERMANENT', '1973-02-14', 'mavalendammay613@gmail.com', 'MVD021473'),
(21, 11, 1, 'CARLO', 'VIDAL', 'BALTAZAR', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', 'MIT', 'INSTRUCTOR II', 'PERMANENT', '1992-09-29', 'carlo.v.baltazar@isu.edu.ph', 'CVB029292'),
(22, 12, 1, 'MARY JANE', 'CAGAYAN', 'BANIQUED', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MS.', 'M\'Eng/MIT', 'ASSISTANT PROFESSOR IV', 'PERMANENT', '1979-06-21', 'maryjane.baniqued@gmail.com', 'MCB062179'),
(23, 13, 1, 'AUDELON', 'RAMISCAL', 'BENITO', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', 'DIT', 'ASSISTANT PROFESSOR IV', 'PERMANENT', '1988-10-04', 'audelon.r.benito@isu.edu.ph', 'ARB100488'),
(24, 14, 1, 'CERENO', 'CACAL', 'CERENO', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', 'MSIT', 'ASSISTANT PROFESSOR II', 'PERMANENT', '1982-09-05', 'joey.c.cereno@isu.edu.ph', 'JCC090582'),
(25, 15, 1, 'CUNANAN', 'PASCUA', 'CUNANAN', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MRS.', 'PhD', 'ASSOCIATE PROFESSOR III', 'PERMANENT', '1978-06-22', 'janetcunanan242@gmail.com', 'JPC062278'),
(26, 16, 1, 'JAY', 'LAU REL', 'FLORENTIN', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', 'MIT', 'INSTRUCTOR III', 'PERMANENT', '1988-01-28', 'ghielaurel28@gmail.com', 'VBPD122992'),
(27, 17, 1, 'DOMINGO', 'MANUEL', 'RAMOS', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', 'DIT', 'ASSOCIATE PROFESSOR II', 'PERMANENT', '1975-01-13', 'domingo.m.ramos@isu.edu.ph', 'JTG090983'),
(28, 18, 1, 'VIC BERRY', 'PALOMAR', 'DUQUE', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', NULL, 'INSTRUCTOR I', 'COS', '1992-12-29', 'striffe0970@gmail.com', 'JEL012888'),
(29, 19, 1, 'JAYSON', 'TELAN', 'GUILLERMO', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', NULL, 'INSTRUCTOR I', 'COS', '1983-09-09', 'jayson.t.guillermo@isu.edu.ph', 'YRM041297'),
(30, 20, 1, 'YOSEV', 'RAMEL', 'MARTE', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', NULL, 'INSTRUCTOR I', 'COS', '1997-04-12', 'yumptisolle@gmail.com', 'JBN051881'),
(31, 21, 1, 'JUNESTHER', 'BULAN', 'NATIVIDAD', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', NULL, 'INSTRUCTOR I', 'COS', '1981-05-18', 'njunesther@gmail.com', 'MVQ071991'),
(32, 22, 1, 'MAC JOHN', 'IVERNS', 'QUIMING', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', NULL, 'INSTRUCTOR I', 'COS', '1991-07-19', 'macjohnq19@gmail.com', 'DMR013175'),
(33, 23, 1, 'JOEMAR', 'CASER', 'TISADO', '2025-01-06 02:47:44', '2025-01-06 02:55:12', 'MR.', NULL, 'INSTRUCTOR I', 'COS', '1990-03-30', 'joem033090@gmail.com', 'JCT033090');


-- =======================================
-- 8) FACULTY_SUBJECTS (references faculties, subjects)
-- =======================================
CREATE TABLE `faculty_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_fs_faculty` (`faculty_id`),
  KEY `fk_fs_subject` (`subject_id`),
  CONSTRAINT `fk_fs_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculties`(`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_fs_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- (No initial INSERTs for `faculty_subjects` were given)


-- =======================================
-- 9) SCHOOL_YEARS (no dependencies)
-- =======================================
CREATE TABLE `school_years` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

INSERT INTO `school_years` (`id`, `name`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, '2024-2025', '2024-08-01', '2025-05-31', '2025-01-04 14:59:25', '2025-01-04 14:59:25'),
(2, '2025-2026', '2025-08-01', '2026-05-31', '2025-01-04 14:59:25', '2025-01-04 14:59:25'),
(3, '2026-2027', '2026-08-01', '2027-05-31', '2025-01-04 14:59:25', '2025-01-04 14:59:25');


-- =======================================
-- 10) SEMESTERS (references school_years)
-- =======================================
CREATE TABLE `semesters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sy_id` int(11) NOT NULL,
  `semester_no` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sy_id` (`sy_id`),
  CONSTRAINT `semesters_ibfk_1` FOREIGN KEY (`sy_id`) REFERENCES `school_years`(`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

INSERT INTO `semesters` (`id`, `sy_id`, `semester_no`, `label`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'First Semester', '2024-08-01', '2024-12-15', '2025-01-04 14:59:25', '2025-01-04 14:59:25'),
(2, 1, 2, 'Second Semester', '2025-01-10', '2025-05-31', '2025-01-04 14:59:25', '2025-01-04 14:59:25');


-- =======================================
-- 11) SECTIONS (references programs, semesters, curriculum)
-- =======================================
CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `section` varchar(10) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `curriculum_id` int(11) NOT NULL,
  `archived` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `semester_id` (`semester_id`),
  KEY `curriculum_id` (`curriculum_id`),
  KEY `fk_sections_program` (`program_id`),
  CONSTRAINT `fk_sections_program` FOREIGN KEY (`program_id`) REFERENCES `programs`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semesters`(`id`),
  CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum`(`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- (No initial INSERTs for `sections` were given)


-- =======================================
-- 12) STUDENTS (references programs, sections, curriculum, users)
-- =======================================
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `program_id` int(11) NOT NULL,
  `year_level` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `curriculum_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  KEY `curriculum_id` (`curriculum_id`),
  KEY `students_user_id_fk` (`user_id`),
  KEY `fk_students_program` (`program_id`),
  CONSTRAINT `fk_students_program` FOREIGN KEY (`program_id`) REFERENCES `programs`(`id`) ON UPDATE CASCADE,
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections`(`id`),
  CONSTRAINT `students_ibfk_2` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum`(`id`),
  CONSTRAINT `students_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- (No initial INSERTs for `students` were given)


-- =======================================
-- 13) ROOMS (no dependencies)
-- =======================================
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `room_type` enum('LAB','LECTURE') NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- (No initial INSERTs for `rooms` were given)


-- =======================================
-- 14) SCHEDULES (references faculties, subjects, sections, rooms, semesters)
-- =======================================
CREATE TABLE `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `day` enum('Mon','Tue','Wed','Thu','Fri') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `class_type` enum('lecture','lab') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `faculty_id` (`faculty_id`),
  KEY `subject_id` (`subject_id`),
  KEY `section_id` (`section_id`),
  KEY `room_id` (`room_id`),
  KEY `semester_id` (`semester_id`),
  CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties`(`id`),
  CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`),
  CONSTRAINT `schedules_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections`(`id`),
  CONSTRAINT `schedules_ibfk_4` FOREIGN KEY (`room_id`) REFERENCES `rooms`(`id`),
  CONSTRAINT `schedules_ibfk_5` FOREIGN KEY (`semester_id`) REFERENCES `semesters`(`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- (No initial INSERTs for `schedules` were given)


-- =======================================
-- 15) ENROLLMENTS (references students, subjects, semesters)
-- =======================================
CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `subject_id` (`subject_id`),
  KEY `semester_id` (`semester_id`),
  CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students`(`id`),
  CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`),
  CONSTRAINT `enrollments_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semesters`(`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- (No initial INSERTs for `enrollments` were given)


-- End transaction
COMMIT;
