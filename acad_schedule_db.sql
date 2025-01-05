SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `curriculum` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `version_label` varchar(100) NOT NULL,
  `effectivity_sy` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `curriculum_subjects` (
  `id` int(11) NOT NULL,
  `curriculum_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `is_lab` tinyint(1) DEFAULT 0,
  `prerequisites` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `faculty_subjects` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `room_type` enum('LAB','LECTURE') NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `school_years` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `program` varchar(50) NOT NULL,
  `year_level` int(11) NOT NULL,
  `section` varchar(10) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `semester_id` int(11) NOT NULL,
  `curriculum_id` int(11) NOT NULL,
  `archived` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `sy_id` int(11) NOT NULL,
  `semester_no` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `program_id` int(11) NOT NULL,
  `year_level` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `curriculum_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_lab` tinyint(1) DEFAULT 0,
  `department` varchar(100) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `units` decimal(4,1) DEFAULT NULL,
  `is_major` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` enum('faculty','student','admin','registrar') NOT NULL DEFAULT 'faculty',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('pending','active','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_curriculum_program` (`program_id`);

ALTER TABLE `curriculum_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `curriculum_id` (`curriculum_id`),
  ADD KEY `subject_id` (`subject_id`);

ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `semester_id` (`semester_id`);

ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculties_user_id_fk` (`user_id`),
  ADD KEY `fk_faculties_department` (`department_id`);

ALTER TABLE `faculty_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fs_faculty` (`faculty_id`),
  ADD KEY `fk_fs_subject` (`subject_id`);

ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_programs_department` (`department_id`);

ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `semester_id` (`semester_id`);

ALTER TABLE `school_years`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `curriculum_id` (`curriculum_id`);

ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sy_id` (`sy_id`);

ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `curriculum_id` (`curriculum_id`),
  ADD KEY `students_user_id_fk` (`user_id`),
  ADD KEY `fk_students_program` (`program_id`);

ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subjects_program` (`program_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `curriculum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `curriculum_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `faculty_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `school_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `curriculum`
  ADD CONSTRAINT `fk_curriculum_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `curriculum_subjects`
  ADD CONSTRAINT `curriculum_subjects_ibfk_1` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`),
  ADD CONSTRAINT `curriculum_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `enrollments_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_faculties_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `faculty_subjects`
  ADD CONSTRAINT `fk_fs_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_fs_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

ALTER TABLE `programs`
  ADD CONSTRAINT `fk_programs_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `schedules_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `schedules_ibfk_4` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `schedules_ibfk_5` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`);

ALTER TABLE `semesters`
  ADD CONSTRAINT `semesters_ibfk_1` FOREIGN KEY (`sy_id`) REFERENCES `school_years` (`id`);

ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`id`),
  ADD CONSTRAINT `students_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `subjects`
  ADD CONSTRAINT `fk_subjects_program` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

COMMIT;
