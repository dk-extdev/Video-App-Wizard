-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2018 at 06:01 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketing_wizard`
--

-- --------------------------------------------------------

--
-- Table structure for table `template_videos`
--

CREATE TABLE `template_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_videos`
--

INSERT INTO `template_videos` (`id`, `category_id`, `tags`, `name`, `url`, `image`, `created_at`, `updated_at`) VALUES
(1, 7, '', 'YouTube_Preview_AC Installation', 'https://www.youtube.com/watch?v=32GGKL87PJk', '', '2018-01-08 21:00:00', NULL),
(2, 9, '', 'YouTube_Preview_AccidentAttorney', 'https://www.youtube.com/watch?v=KlLj_Joaszc', '', NULL, NULL),
(3, 10, '', 'YouTube_Preview_Acupuncture', 'https://www.youtube.com/watch?v=YRZI_T05EDk', '', NULL, NULL),
(4, 7, '', 'YouTube_Preview_AirDuctCleaning', 'https://www.youtube.com/watch?v=2I6Ua7M4jyU\r\n', '', NULL, NULL),
(5, 19, '', 'YouTube_Preview_AirportTransportation', 'https://www.youtube.com/watch?v=4AP_VOJVQq0\r\n', '', NULL, NULL),
(6, 7, '', 'YouTube_Preview_AlarmInstallationCompany', 'https://www.youtube.com/watch?v=8oXZGdNygF8\r\n', '', NULL, NULL),
(7, 10, '', 'YouTube_Preview_Allergist', 'https://www.youtube.com/watch?v=gZIomDatk_I\r\n', '', NULL, NULL),
(8, 7, '', 'YouTube_Preview_AnimalTraining', 'https://www.youtube.com/watch?v=udWYLLQk_po\r\n', '', NULL, NULL),
(9, 9, '', 'YouTube_Preview_ApplianceRepair', 'https://www.youtube.com/watch?v=bdq_d8CpUkE\r\n', '', NULL, NULL),
(10, 8, '', 'YouTube_Preview_Architect', 'https://www.youtube.com/watch?v=bIRtkjJP0bM\r\n', '', NULL, NULL),
(11, 8, '', 'YouTube_Preview_AsbestosRemoval', 'https://www.youtube.com/watch?v=WtOhTYW5fY0\r\n', '', '2017-12-18 21:00:00', NULL),
(12, 8, '', 'YouTube_Preview_AsbestosRemoval2', 'https://www.youtube.com/watch?v=OV_bNduMt5A\r\n', '', NULL, NULL),
(13, 1, '', 'YouTube_Preview_Auditor', 'https://www.youtube.com/watch?v=qxrTWE_wD6M\r\n', '', NULL, NULL),
(14, 15, '', 'YouTube_Preview_AutobodyShop', 'https://www.youtube.com/watch?v=svzL0Ec7Ry0\r\n', '', NULL, NULL),
(15, 15, '', 'YouTube_Preview_AutoDetailing', 'https://www.youtube.com/watch?v=WW8GOi7oMJY\r\n', '', NULL, NULL),
(16, 15, '', 'YouTube_Preview_AutoPartsStore', 'https://www.youtube.com/watch?v=wjHJ-g_rJ3M\r\n', '', NULL, NULL),
(17, 1, '', 'YouTube_Preview_BailBonds', 'https://www.youtube.com/watch?v=aUfL5rCxLq8\r\n', '', NULL, NULL),
(18, 16, '', 'YouTube_Preview_Bakery', 'https://www.youtube.com/watch?v=N2jFu9c4N8k\r\n', '', NULL, NULL),
(19, 4, '', 'YouTube_Preview_BankruptcyAttorney', 'https://www.youtube.com/watch?v=BsOZWaC5dVk\r\n', '', NULL, NULL),
(20, 4, '', 'YouTube_Preview_BankruptcyLawyer2', 'https://www.youtube.com/watch?v=Ovgac0ACQcQ\r\n', '', NULL, NULL),
(21, 7, '', 'YouTube_Preview_BasementFinishing', 'https://www.youtube.com/watch?v=Tx6xH71yQqs\r\n', '', NULL, NULL),
(22, 7, '', 'YouTube_Preview_BathroomRemodeling', 'https://www.youtube.com/watch?v=RAJxc5TbDAE\r\n', '', NULL, NULL),
(23, 10, '', 'YouTube_Preview_BeautySalon', 'https://www.youtube.com/watch?v=jy0R3oKJhPg\r\n', '', NULL, NULL),
(24, 7, '', 'YouTube_Preview_Blinds', 'https://www.youtube.com/watch?v=QWVvzpPCnok\r\n', '', NULL, NULL),
(25, 17, '', 'YouTube_Preview_BrakeShop', 'https://www.youtube.com/watch?v=1KbxDLkrqf0\r\n', '', NULL, NULL),
(26, 17, '', 'YouTube_Preview_BusinessLending', 'https://www.youtube.com/watch?v=PCcPELYD3TM\r\n', '', NULL, NULL),
(27, 17, '', 'YouTube_Preview_BusinessServices', 'https://www.youtube.com/watch?v=H2nxkVmCObY\r\n', '', NULL, NULL),
(28, 3, '', 'YouTube_Preview_CarDealer', 'https://www.youtube.com/watch?v=-sCXwcOCBXc-\r\n', '', NULL, NULL),
(29, 10, '', 'YouTube_Preview_Cardiologist', 'https://www.youtube.com/watch?v=-6gzN_rw6Bs-\r\n', '', NULL, NULL),
(30, 4, '', 'YouTube_Preview_CarFinance', 'https://www.youtube.com/watch?v=9llcB7dzTf4\r\n', '', NULL, NULL),
(31, 4, '', 'YouTube_Preview_CarInsurance', 'https://www.youtube.com/watch?v=ID2ARdzR2oI\r\n', '', NULL, NULL),
(32, 7, '', 'YouTube_Preview_Carpet Installation', 'https://www.youtube.com/watch?v=KIM0LECaFng\r\n', '', NULL, NULL),
(33, 7, '', 'YouTube_Preview_Carpet-Flooring', 'https://www.youtube.com/watch?v=rDnVWR1az6M\r\n', '', NULL, NULL),
(34, 7, '', 'YouTube_Preview_CarpetCleaning', 'https://www.youtube.com/watch?v=Q_d8KH3krCg\r\n', '', NULL, NULL),
(35, 7, '', 'YouTube_Preview_CarpetInstallation', 'https://www.youtube.com/watch?v=rMCj_e44cKc\r\n', '', NULL, NULL),
(36, 3, '', 'YouTube_Preview_CarRental', 'https://www.youtube.com/watch?v=6KfHLoLk830\r\n', '', NULL, NULL),
(37, 5, '', 'YouTube_Preview_Catering', 'https://www.youtube.com/watch?v=NzASydYytI8\r\n', '', NULL, NULL),
(38, 12, '', 'YouTube_Preview_ChildCare', 'https://www.youtube.com/watch?v=ipfRf7xIhvM\r\n', '', NULL, NULL),
(39, 10, '', 'YouTube_Preview_Chiropractor', 'https://www.youtube.com/watch?v=cYzPJbC3j9o\r\n', '', NULL, NULL),
(40, 10, '', 'YouTube_Preview_Chiropractor2', 'https://www.youtube.com/watch?v=S-YRttfNo3U\r\n', '', NULL, NULL),
(41, 7, '', 'YouTube_Preview_ChristmasLightInstallation', 'https://www.youtube.com/watch?v=En8SmUHRpWU\r\n', '', NULL, NULL),
(42, 7, '', 'YouTube_Preview_CleaningService', 'https://www.youtube.com/watch?v=0LJ0CVQSLuk\r\n', '', NULL, NULL),
(43, 6, '', 'YouTube_Preview_CommercialContractor', 'https://www.youtube.com/watch?v=5Tv82V2HQT4\r\n', '', NULL, NULL),
(44, 13, '', 'YouTube_Preview_ComputerRepair', 'https://www.youtube.com/watch?v=IfdqEky9vBA\r\n', '', NULL, NULL),
(45, 5, '', 'YouTube_Preview_ConcreteCompany', 'https://www.youtube.com/watch?v=ciRnThu-OPU\r\n', '', NULL, NULL),
(46, 8, '', 'YouTube_Preview_ConstructionContractor', 'https://www.youtube.com/watch?v=3hLAdZW_OkM\r\n', '', NULL, NULL),
(47, 10, '', 'YouTube_Preview_Cosmetic Dentist', 'https://www.youtube.com/watch?v=BjGjWo8GTCQ\r\n', '', NULL, NULL),
(48, 4, '', 'YouTube_Preview_CPA', 'https://www.youtube.com/watch?v=a-t8pD3owzg\r\n', '', NULL, NULL),
(49, 4, '', 'YouTube_Preview_CreditRepair', 'https://www.youtube.com/watch?v=3pc0OqqDNZI\r\n', '', NULL, NULL),
(50, 4, '', 'YouTube_Preview_CreditRepair2', 'https://www.youtube.com/watch?v=Yv7tU0S4LYI\r\n', '', NULL, NULL),
(51, 7, '', 'YouTube_Preview_Curbing', 'https://www.youtube.com/watch?v=dRT2Kcm68qA\r\n', '', NULL, NULL),
(52, 9, '', 'YouTube_Preview_CustodyAttorney', 'https://www.youtube.com/watch?v=UOvICdGsWtc\r\n', '', NULL, NULL),
(53, 7, '', 'YouTube_Preview_CustomHomeUpgrades', 'https://www.youtube.com/watch?v=BuBCmlgWE1g\r\n', '', NULL, NULL),
(54, 10, '', 'YouTube_Preview_DanceClasses', 'https://www.youtube.com/watch?v=eFvpHFbUZ6Q\r\n', '', NULL, NULL),
(55, 12, '', 'YouTube_Preview_DatingService', 'https://www.youtube.com/watch?v=Z1uDV2BE59M\r\n', '', NULL, NULL),
(56, 10, '', 'YouTube_Preview_DaySpa', 'https://www.youtube.com/watch?v=QAbdwUtfva8\r\n', '', NULL, NULL),
(57, 8, '', 'YouTube_Preview_DeckCompany', 'https://www.youtube.com/watch?v=DntEkHQcPC8\r\n', '', NULL, NULL),
(58, 9, '', 'YouTube_Preview_DentalInsurance', 'https://www.youtube.com/watch?v=QbrBuEL_FCY\r\n', '', NULL, NULL),
(59, 10, '', 'YouTube_Preview_Dentist', 'https://www.youtube.com/watch?v=VioZJ2gNVoU\r\n', '', NULL, NULL),
(60, 10, '', 'YouTube_Preview_Dentist2', 'https://www.youtube.com/watch?v=7XVDZWGwm8E\r\n', '', NULL, NULL),
(61, 10, '', 'YouTube_Preview_DentRepair', 'https://www.youtube.com/watch?v=Cu5p5QRYzvc\r\n', '', NULL, NULL),
(62, 10, '', 'YouTube_Preview_Dermatologist', 'https://www.youtube.com/watch?v=aFFejBLZi-I\r\n', '', NULL, NULL),
(63, 5, '', 'YouTube_Preview_DigitalMediaAttorney', 'https://www.youtube.com/watch?v=s5Y-e22v_xU\r\n', '', NULL, NULL),
(64, 9, '', 'YouTube_Preview_DisasterRecovery', 'https://www.youtube.com/watch?v=dytJGZv8Atw\r\n', '', NULL, NULL),
(65, 9, '', 'YouTube_Preview_DivorceAttorney', 'https://www.youtube.com/watch?v=P7vI93SziVg\r\n', '', NULL, NULL),
(66, 5, '', 'YouTube_Preview_DJ', 'https://www.youtube.com/watch?v=NXW0DANl10w\r\n', '', NULL, NULL),
(67, 5, '', 'YouTube_Preview_DogTraining', 'https://www.youtube.com/watch?v=ZdrA5qRV2QY\r\n', '', NULL, NULL),
(68, 7, '', 'YouTube_Preview_DryCleaners', 'https://www.youtube.com/watch?v=p5-k65htmqs\r\n', '', NULL, NULL),
(69, 7, '', 'YouTube_Preview_DryCleaning', 'https://www.youtube.com/watch?v=FCwnm2Lhv7g\r\n', '', NULL, NULL),
(70, 7, '', 'YouTube_Preview_DryCleaning2', 'https://www.youtube.com/watch?v=5LwsfMNk0HQ\r\n', '', NULL, NULL),
(71, 7, '', 'YouTube_Preview_DrywalInstallation', 'https://www.youtube.com/watch?v=Z268AZM0JnI\r\n', '', NULL, NULL),
(72, 7, '', 'YouTube_Preview_DuctCleaning', 'https://www.youtube.com/watch?v=a4R4xOBfuO4\r\n', '', NULL, NULL),
(73, 9, '', 'YouTube_Preview_DUI', 'https://www.youtube.com/watch?v=dY7m9vrWnL4\r\n', '', NULL, NULL),
(74, 9, '', 'YouTube_Preview_DUIAttorney', 'https://www.youtube.com/watch?v=qwHzUsfnhr8\r\n', '', NULL, NULL),
(75, 9, '', 'YouTube_Preview_DumpsterRental', 'https://www.youtube.com/watch?v=kH1Euqz46vM\r\n', '', NULL, NULL),
(76, 8, '', 'YouTube_Preview_Electrician', 'https://www.youtube.com/watch?v=ZuVVppK9TH0\r\n', '', NULL, NULL),
(77, 8, '', 'YouTube_Preview_Electrician2', 'https://www.youtube.com/watch?v=-xgfSd9GcEw-\r\n', '', NULL, NULL),
(78, 5, '', 'YouTube_Preview_EquipmentRental', 'https://www.youtube.com/watch?v=P4fy_DDXXNg\r\n', '', NULL, NULL),
(79, 8, '', 'YouTube_Preview_EstatePlanning', 'https://www.youtube.com/watch?v=zetpiMMD01Q\r\n', '', NULL, NULL),
(80, 12, '', 'YouTube_Preview_EventManagement', 'https://www.youtube.com/watch?v=B_NOeBQUc7M\r\n', '', NULL, NULL),
(81, 12, '', 'YouTube_Preview_EventPlanner', 'https://www.youtube.com/watch?v=T3xTr1Z2Qv_\r\n', '', NULL, NULL),
(82, 5, '', 'YouTube_Preview_EyeBrowThreading', 'https://www.youtube.com/watch?v=91QtFSC21wQ\r\n', '', NULL, NULL),
(83, 5, '', 'YouTube_Preview_EyelashExtensions', 'https://www.youtube.com/watch?v=SqPmXofa2ws\r\n', '', NULL, NULL),
(84, 4, '', 'YouTube_Preview_FencingCompany', 'https://www.youtube.com/watch?v=3DHZqYnpw9A\r\n', '', NULL, NULL),
(85, 4, '', 'YouTube_Preview_FinancialPlanner', 'https://www.youtube.com/watch?v=EJIOeLoJsSQ\r\n', '', NULL, NULL),
(86, 7, '', 'YouTube_Preview_FireRestoration', 'https://www.youtube.com/watch?v=eciBjD_KLKU\r\n', '', NULL, NULL),
(87, 7, '', 'YouTube_Preview_FloodRestoration', 'https://www.youtube.com/watch?v=kdEK8bXAVBM\r\n', '', NULL, NULL),
(88, 7, '', 'YouTube_Preview_Florist', 'https://www.youtube.com/watch?v=9Vaa8oLqiXY\r\n', '', NULL, NULL),
(89, 7, '', 'YouTube_Preview_ForeclosureDefense', 'https://www.youtube.com/watch?v=3WDzIPgXq2A\r\n', '', NULL, NULL),
(90, 7, '', 'YouTube_Preview_FreightServices', 'https://www.youtube.com/watch?v=3bsgwn1WUrA\r\n', '', NULL, NULL),
(91, 7, '', 'YouTube_Preview_FuneralServices', 'https://www.youtube.com/watch?v=2w44Pw3rjTM\r\n', '', NULL, NULL),
(92, 7, '', 'YouTube_Preview_FurnaceRepair', 'https://www.youtube.com/watch?v=CVvBS9POv1w\r\n', '', NULL, NULL),
(93, 7, '', 'YouTube_Preview_GarageDoorCompany', 'https://www.youtube.com/watch?v=N6DS7SOQxIU\r\n', '', NULL, NULL),
(94, 7, '', 'YouTube_Preview_GolfInstruction', 'https://www.youtube.com/watch?v=EDSlGTwPjKA\r\n', '', NULL, NULL),
(95, 5, '', 'YouTube_Preview_GolfShop', 'https://www.youtube.com/watch?v=3GnR7PcmybE\r\n', '', NULL, NULL),
(96, 13, '', 'YouTube_Preview_GoogleMaps', 'https://www.youtube.com/watch?v=nyXl_alsXlc\r\n', '', NULL, NULL),
(97, 6, '', 'YouTube_Preview_GraphicDesigner', 'https://www.youtube.com/watch?v=fV5HWne7MXU\r\n', '', NULL, NULL),
(98, 7, '', 'YouTube_Preview_GutterCleaning', 'https://www.youtube.com/watch?v=oXj3PVIxC8Q\r\n', '', NULL, NULL),
(99, 10, '', 'YouTube_Preview_Gym-Female', 'https://www.youtube.com/watch?v=mSFLSli4jr8\r\n', '', NULL, NULL),
(100, 10, '', 'YouTube_Preview_Gym', 'https://www.youtube.com/watch?v=SNg1d0Tys7g', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `template_videos`
--
ALTER TABLE `template_videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `template_videos`
--
ALTER TABLE `template_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
