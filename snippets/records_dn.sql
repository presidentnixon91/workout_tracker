-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 20, 2020 at 01:51 AM
-- Server version: 5.6.47-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dn_gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `records_dn`
--

CREATE TABLE `records_dn` (
  `ExOrder` tinyint(2) NOT NULL DEFAULT '100',
  `MuscleGroup` varchar(50) NOT NULL,
  `Exercise` varchar(50) NOT NULL,
  `50` tinyint(2) NOT NULL DEFAULT '0',
  `60` tinyint(2) NOT NULL DEFAULT '0',
  `70` tinyint(2) NOT NULL DEFAULT '0',
  `80` tinyint(2) NOT NULL DEFAULT '0',
  `85` tinyint(2) NOT NULL DEFAULT '0',
  `90` tinyint(2) NOT NULL DEFAULT '0',
  `95` tinyint(2) NOT NULL DEFAULT '0',
  `100` tinyint(2) NOT NULL DEFAULT '0',
  `101` tinyint(2) NOT NULL DEFAULT '0',
  `TimesCompleted` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records_dn`
--

INSERT INTO `records_dn` (`ExOrder`, `MuscleGroup`, `Exercise`, `50`, `60`, `70`, `80`, `85`, `90`, `95`, `100`, `101`, `TimesCompleted`) VALUES
(100, 'Legs', 'Back Squat', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Legs', 'Front Squat', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Legs', 'Leg Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Legs', 'Lying Leg Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Legs', 'Calf Raise', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Legs', 'Overhead Barbell Lunges', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Tricep Pull-Downs', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Seated Tricep Extensions', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Ring Dips', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Machine Tricep Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Dumbbell Bicep Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Seated Close-Grip Barbell Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Seated Barbell Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', '21s', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Seated Row Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Cable Bicep Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Machine Bicep Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Behind the Back Wrist Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Seated Palms-Up Wrist Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Barbell Shoulder Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Dumbbell Shoulder Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Arnold Shoulder Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Dumbbell Shrugs', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Machine Shoulder Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Machine Rear Delts', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Front Lateral Raises', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Side Lateral Raises', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Side Cable Raises', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Bent Over Rear Delt Raises', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Upright Row', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Seated Side Dumbbell Raise', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Shoulders', 'Smith Shoulder Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Full Body', 'Cleans', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Full Body', 'Snatch', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Full Body', 'Chest To Bars', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Full Body', 'Toes To Bars', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Full Body', 'Knee Raises', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Full Body', 'Kettlebell Swings', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Full Body', 'Double Unders', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Full Body', 'Handstand Push-Ups', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Full Body', 'Burpees', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Bench Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Incline Bench Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Decline Bench Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Incline Smith Bench Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Incline Dumbbell Flies', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Machine Bench Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Legs', 'Overhead Squat', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Legs', 'Dumbbell Lunges', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Legs', 'Leg Extensions', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Bent Over Barbell Rows', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Chin Ups', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Cable Straight-Arm Pull Downs', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Face Pulls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Seated Dumbbell Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Dips', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Skull Crushers', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'Cose-Grip EZ Bar Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Arms', 'EZ Bar Bicep Curls', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Dumbbell Bench Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Incline Dumbbell Bench Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Decline Smith Bench Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Chest Dips', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Pec Decks', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Cable Flies', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Cable Chest Raises', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Cable Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Cable Crossover', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Decline Smith Bench Press', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Single-Arm Cable Flies', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Push-Ups', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Chest', 'Dumbbell Flies', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Deadlift', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Lat Pull-Downs', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Seated Row', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Wide Grip Chin Ups', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Close Grip Chin Ups', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Stiff-Legged Barbell Good Mornings', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Machine Row', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'Cable Flies', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'One-Arm Dumbbell Row', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 'Back', 'T-Bar Row', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
