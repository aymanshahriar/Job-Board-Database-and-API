-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2020 at 04:36 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_Applied` (IN `JID` INT, IN `SID` INT)  INSERT INTO applied
SET job_id = JID, student_id = SID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_Bio` (IN `SID` INT, IN `statement` VARCHAR(256), IN `interest` VARCHAR(256))  INSERT INTO bio
SET student_id = SID, bio_stmt = statement, bio_interest= interest$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_Degree` (IN `s_id` INT, IN `d_type` VARCHAR(256), IN `d_subject` VARCHAR(256), IN `d_special` VARCHAR(256), IN `u_name` VARCHAR(256), IN `u_location` VARCHAR(256))  NO SQL
INSERT INTO degree
SET student_id = s_id, degree_type = d_type, degree_subject= d_subject, degree_special = d_special, uni_name = u_name, uni_location = u_location$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_Employer` (IN `e_name` VARCHAR(256), IN `e_email` VARCHAR(256), IN `c_name` VARCHAR(256), IN `j_title` VARCHAR(256))  INSERT INTO employer
SET employer_name = e_name, employer_email = e_email, company_name = c_name, job_title = j_title$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_Event` (IN `e_id` INT, IN `e_title` VARCHAR(256), IN `e_date` DATE, IN `e_desc` VARCHAR(256))  INSERT INTO events
SET employer_id = e_id, event_title = e_title, event_date= e_date, event_desc = e_desc$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_Has_Experience` (IN `c_name` VARCHAR(256), IN `s_id` INT)  INSERT INTO has_experience
SET company_name = c_name, student_id = s_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_Jobpost` (IN `j_title` VARCHAR(256), IN `e_id` INT, IN `j_desc` VARCHAR(256), IN `j_pdate` DATE, IN `j_edate` DATE, IN `j_catg` VARCHAR(256))  INSERT INTO jobpost
SET job_title = j_title, employer_id = e_id, job_desc = j_desc, job_pdate= j_pdate, job_edate = j_edate, job_catg = j_catg$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_Resume` (IN `s_id` INT, IN `r_name` VARCHAR(256), IN `r_education` VARCHAR(256), IN `r_vexp` VARCHAR(256), IN `r_wexp` VARCHAR(256))  INSERT INTO resume
SET student_id = s_id, resume_name = r_name, resume_education = r_education, resume_vexp= r_vexp, resume_wexp = r_wexp$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_Shortlist` (IN `e_id` INT, IN `s_id` INT)  INSERT INTO shortlists
SET employer_id = e_id, student_id = s_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_Student` (IN `s_name` VARCHAR(256), IN `s_email` VARCHAR(256))  INSERT INTO student
SET student_name = s_name, student_email = s_email$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_Jobpost` ()  SELECT * FROM jobpost$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `read_single_Bio` (IN `id` INT)  SELECT * FROM bio WHERE bio_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_Event` (IN `e_id` INT, IN `emp_id` INT, IN `e_title` VARCHAR(256), IN `e_date` DATE, IN `e_desc` VARCHAR(256))  UPDATE events
SET employer_id = emp_id, event_title = e_title, event_date= e_date, event_desc = e_desc
WHERE event_id = e_id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `applied`
--

CREATE TABLE `applied` (
  `job_id` int(16) NOT NULL,
  `student_id` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bio`
--

CREATE TABLE `bio` (
  `bio_id` int(16) NOT NULL,
  `student_id` int(16) NOT NULL,
  `bio_stmt` varchar(1000) NOT NULL,
  `bio_interest` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bio`
--

INSERT INTO `bio` (`bio_id`, `student_id`, `bio_stmt`, `bio_interest`) VALUES
(222222222, 111111111, 'I am currently a student in Calgary', 'Databases, API\'s'),
(333333333, 222222222, 'I love databases', 'ASP.net core API development');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_name` varchar(256) NOT NULL,
  `company_location` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_name`, `company_location`) VALUES
('Apple ', 'Silicon Valley, California, United States of America'),
('Google', 'San Francisco, California, United States');

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `degree_id` int(16) NOT NULL,
  `student_id` int(16) NOT NULL,
  `degree_type` varchar(256) NOT NULL,
  `degree_subject` varchar(256) NOT NULL,
  `degree_special` varchar(256) NOT NULL,
  `uni_name` varchar(256) NOT NULL,
  `uni_location` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`degree_id`, `student_id`, `degree_type`, `degree_subject`, `degree_special`, `uni_name`, `uni_location`) VALUES
(8, 111111111, 'Bachelors', 'Computer Science', 'Specialization in Databases', 'University of Calgary', 'Calgary, Alberta, Canada');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `user_id` int(16) NOT NULL,
  `employer_name` varchar(256) NOT NULL,
  `employer_email` varchar(256) NOT NULL,
  `company_name` varchar(256) NOT NULL,
  `job_title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`user_id`, `employer_name`, `employer_email`, `company_name`, `job_title`) VALUES
(111111111, 'Joanne Reeves', 'jreeves@gmail.com', 'Apple ', 'Senior Recruiter'),
(111111114, 'Jane Doe', 'jdoe@gmail.com', 'Google', 'Senior Recruiter'),
(111111127, 'JR', 'blah@gmail.com', 'Microsoft', 'Senior Recruiter');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(16) NOT NULL,
  `employer_id` int(16) NOT NULL,
  `event_title` varchar(256) NOT NULL,
  `event_date` datetime NOT NULL,
  `event_desc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `employer_id`, `event_title`, `event_date`, `event_desc`) VALUES
(8, 111111111, 'Updated', '2020-04-20 00:00:00', 'This is a chance for you to learn about how you can land that database dream internship'),
(10, 111111111, 'Info Session on Internship opportunities UPDATE2', '2020-04-20 00:00:00', 'This is a chance for you to learn about how you can land that database dream internship'),
(14, 111111111, 'Info Session on Internship opportunities', '2020-04-20 00:00:00', 'This is a chance for you to learn about how you can land that database dream internship');

-- --------------------------------------------------------

--
-- Table structure for table `has_experience`
--

CREATE TABLE `has_experience` (
  `company_name` varchar(256) NOT NULL,
  `student_id` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jobpost`
--

CREATE TABLE `jobpost` (
  `job_id` int(16) NOT NULL,
  `employer_id` int(16) NOT NULL,
  `job_title` varchar(256) NOT NULL,
  `job_desc` varchar(1000) NOT NULL,
  `job_pdate` datetime NOT NULL,
  `job_edate` datetime NOT NULL,
  `job_catg` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobpost`
--

INSERT INTO `jobpost` (`job_id`, `employer_id`, `job_title`, `job_desc`, `job_pdate`, `job_edate`, `job_catg`) VALUES
(111111111, 111111111, 'Database Architect', 'You will design databases', '2020-04-13 18:07:41', '2020-06-16 18:07:41', 'Database development'),
(222222222, 111111111, 'Database Manager', 'You will manage the databases of our company', '2020-04-22 18:07:41', '2020-04-23 18:07:41', 'Database management'),
(222222229, 111111111, 'Junior Database Intern', 'Help Maintain Databases', '2020-04-15 00:00:00', '2020-05-15 00:00:00', 'Database Management');

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE `resume` (
  `student_id` int(16) NOT NULL,
  `resume_name` varchar(256) NOT NULL,
  `resume_education` varchar(1000) NOT NULL,
  `resume_vexp` varchar(1000) NOT NULL,
  `resume_wexp` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resume`
--

INSERT INTO `resume` (`student_id`, `resume_name`, `resume_education`, `resume_vexp`, `resume_wexp`) VALUES
(222222222, 'computer science resume', 'BSc. Computer Science, University of Calgary', 'Community Basketball coach, 2019-2020', 'Intern, Cloud Computing Solutions inc, 2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `shortlists`
--

CREATE TABLE `shortlists` (
  `employer_id` int(16) NOT NULL,
  `student_id` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `user_id` int(16) NOT NULL,
  `student_name` varchar(256) NOT NULL,
  `student_email` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`user_id`, `student_name`, `student_email`) VALUES
(111111111, 'Ayman Shahriar', 'ayman.shahriar@google.com'),
(222222222, 'John Smith', 'JohnSmith@outlook.com'),
(333333333, 'Joe Smith', 'j_smith@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applied`
--
ALTER TABLE `applied`
  ADD PRIMARY KEY (`job_id`,`student_id`),
  ADD KEY `student_id Foreign Key` (`student_id`);

--
-- Indexes for table `bio`
--
ALTER TABLE `bio`
  ADD PRIMARY KEY (`bio_id`),
  ADD KEY `FK` (`student_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_name`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`degree_id`),
  ADD KEY `FK2` (`student_id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `FK4` (`employer_id`);

--
-- Indexes for table `has_experience`
--
ALTER TABLE `has_experience`
  ADD PRIMARY KEY (`company_name`,`student_id`),
  ADD KEY `FK5` (`student_id`);

--
-- Indexes for table `jobpost`
--
ALTER TABLE `jobpost`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `FK6` (`employer_id`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`student_id`,`resume_name`);

--
-- Indexes for table `shortlists`
--
ALTER TABLE `shortlists`
  ADD PRIMARY KEY (`employer_id`,`student_id`),
  ADD KEY `FK9` (`student_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bio`
--
ALTER TABLE `bio`
  MODIFY `bio_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333333346;

--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `degree_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `user_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111111128;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobpost`
--
ALTER TABLE `jobpost`
  MODIFY `job_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222222232;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `user_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333333342;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applied`
--
ALTER TABLE `applied`
  ADD CONSTRAINT `job_id Foreign Key` FOREIGN KEY (`job_id`) REFERENCES `jobpost` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_id Foreign Key` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`);

--
-- Constraints for table `bio`
--
ALTER TABLE `bio`
  ADD CONSTRAINT `FK` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `degree`
--
ALTER TABLE `degree`
  ADD CONSTRAINT `FK2` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK4` FOREIGN KEY (`employer_id`) REFERENCES `employer` (`user_id`);

--
-- Constraints for table `has_experience`
--
ALTER TABLE `has_experience`
  ADD CONSTRAINT `FK5` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `has_experience foreign key` FOREIGN KEY (`company_name`) REFERENCES `company` (`company_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobpost`
--
ALTER TABLE `jobpost`
  ADD CONSTRAINT `FK6` FOREIGN KEY (`employer_id`) REFERENCES `employer` (`user_id`);

--
-- Constraints for table `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `FK7` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shortlists`
--
ALTER TABLE `shortlists`
  ADD CONSTRAINT `FK8` FOREIGN KEY (`employer_id`) REFERENCES `employer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK9` FOREIGN KEY (`student_id`) REFERENCES `student` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
