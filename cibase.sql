-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 11:05 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cibase`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_code`
--

CREATE TABLE `accounts_code` (
  `accounts_code_id` int(11) NOT NULL,
  `accounts_code_name` varchar(100) NOT NULL COMMENT 'Accounts Code',
  `ref_accounts_transaction_category_id` int(11) NOT NULL COMMENT 'Accounts Group',
  `ref_accounts_group_id` int(11) NOT NULL COMMENT 'Account Group',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts_code`
--

INSERT INTO `accounts_code` (`accounts_code_id`, `accounts_code_name`, `ref_accounts_transaction_category_id`, `ref_accounts_group_id`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Product Commission', 1, 1, 1, 0, 0, '2016-12-20 11:40:29'),
(2, 'Consulting Fee Commission', 1, 1, 1, 0, 0, '2016-12-20 11:40:48'),
(3, 'Office Expenses', 1, 2, 1, 0, 0, '2016-12-20 11:41:10'),
(4, 'Doctor Expenses', 2, 2, 1, 0, 0, '2016-12-20 11:41:33'),
(10, 'Employee', 0, 2, 1, 0, 0, '2020-08-12 21:42:07'),
(11, 'Other Expenses', 0, 2, 1, 0, 0, '2020-08-12 21:48:50'),
(12, 'Miscellaneous', 0, 2, 1, 0, 0, '2020-08-12 21:50:09'),
(13, 'Other Income', 0, 1, 1, 0, 0, '2020-08-12 22:00:51'),
(14, 'Advertisement ', 0, 2, 3, 0, 0, '2020-08-20 12:03:29'),
(15, 'Printing Expenses', 0, 2, 3, 0, 0, '2020-08-20 12:06:17'),
(16, 'Courier', 0, 2, 3, 0, 0, '2020-08-27 11:22:21'),
(17, 'Medicine Purchase', 0, 2, 3, 0, 0, '2020-08-29 10:32:26'),
(18, 'Petrol/Diesel', 0, 2, 3, 0, 0, '2020-09-15 20:22:23'),
(19, 'Therapist', 0, 2, 3, 0, 0, '2020-11-13 19:31:20'),
(20, 'Medicine - Treatments', 0, 2, 3, 0, 0, '2020-12-01 15:15:27'),
(21, 'Treatment Room', 0, 2, 3, 0, 0, '2020-12-28 17:01:13'),
(22, 'Treatment Room Renovation', 0, 2, 3, 0, 0, '2020-12-28 17:01:31'),
(23, 'Employee - Treatment', 0, 2, 3, 0, 0, '2021-01-13 16:45:47'),
(24, 'Treatment Expenses', 0, 2, 3, 0, 0, '2021-01-24 14:49:11'),
(25, 'Rent', 0, 2, 3, 0, 0, '2021-04-03 18:12:34'),
(26, 'Tea & Coffee', 0, 2, 3, 0, 0, '2021-04-05 16:06:42'),
(27, 'Staff Welfare', 0, 2, 3, 0, 0, '2021-04-20 19:24:25'),
(28, 'Tax ', 0, 2, 3, 0, 0, '2021-06-01 08:18:09'),
(29, 'Finance', 0, 2, 3, 0, 0, '2021-06-05 12:10:06'),
(30, 'Pooja expenses', 0, 2, 3, 0, 0, '2021-06-30 16:44:05'),
(31, 'Telephone', 0, 2, 3, 0, 0, '2021-06-30 19:03:29'),
(32, 'Bank', 0, 2, 3, 0, 0, '2021-06-30 19:14:19'),
(33, 'Electricity', 0, 2, 3, 0, 0, '2021-06-30 19:46:28'),
(34, 'Stationary', 0, 2, 3, 0, 0, '2021-07-01 07:12:27'),
(35, 'Consulting Fee', 0, 2, 3, 0, 0, '2021-07-01 07:37:43'),
(36, 'Maintenance', 0, 2, 3, 0, 0, '2021-07-31 11:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_group`
--

CREATE TABLE `accounts_group` (
  `accounts_group_id` int(11) NOT NULL,
  `accounts_group_name` varchar(20) NOT NULL COMMENT 'Accounts Group',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts_group`
--

INSERT INTO `accounts_group` (`accounts_group_id`, `accounts_group_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Income', 1, 0, 0, '2016-02-11 15:53:17'),
(2, 'Expenses', 1, 0, 0, '2016-02-11 15:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_transaction`
--

CREATE TABLE `accounts_transaction` (
  `accounts_transaction_id` int(11) NOT NULL,
  `voucher_no` varchar(10) DEFAULT NULL,
  `voucher_name` varchar(20) DEFAULT NULL,
  `accounts_transaction_date` datetime NOT NULL COMMENT 'Transaction Date',
  `ref_accounts_code_id` int(11) NOT NULL COMMENT 'Accounts Code',
  `ref_patient_id` int(11) NOT NULL COMMENT 'Patient',
  `ref_employee_id` int(11) NOT NULL COMMENT 'Doctor',
  `ref_invoice_id` int(11) NOT NULL COMMENT 'Invoice',
  `ref_accounts_transaction_category_id` int(11) NOT NULL COMMENT 'Transaction Category',
  `ref_accounts_transaction_type_id` int(11) NOT NULL,
  `accounts_transaction_reference` varchar(20) NOT NULL,
  `accounts_transaction_particulars` varchar(200) NOT NULL,
  `accounts_transaction_credit` int(10) NOT NULL COMMENT 'Income',
  `accounts_transaction_debit` int(10) NOT NULL COMMENT 'Expense',
  `transaction_type` int(1) NOT NULL,
  `cheque_ref_number` varchar(255) NOT NULL,
  `cheque_date` date NOT NULL,
  `ref_bank_id` int(11) NOT NULL,
  `cheque_clearance_status` int(11) NOT NULL,
  `cheque_realisation_date` date NOT NULL,
  `received_from` varchar(255) NOT NULL,
  `paid_to` varchar(255) NOT NULL,
  `voucher_file` varchar(255) DEFAULT NULL,
  `delete_status` int(1) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_transaction_category`
--

CREATE TABLE `accounts_transaction_category` (
  `accounts_transaction_category_id` int(11) NOT NULL,
  `accounts_transaction_category_name` varchar(20) NOT NULL COMMENT 'Accounts Transaction Category',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts_transaction_category`
--

INSERT INTO `accounts_transaction_category` (`accounts_transaction_category_id`, `accounts_transaction_category_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Client', 20, 0, 0, '2016-12-20 11:16:39'),
(2, 'Bank', 20, 0, 0, '2016-12-20 11:16:49'),
(3, 'Employee', 1, 0, 0, '2017-08-22 18:56:48'),
(4, 'Employee Expenses', 1, 0, 0, '2020-08-12 21:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_transaction_type`
--

CREATE TABLE `accounts_transaction_type` (
  `accounts_transaction_type_id` int(11) NOT NULL,
  `accounts_transaction_type_name` varchar(20) NOT NULL COMMENT 'Accounts Transaction Type',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts_transaction_type`
--

INSERT INTO `accounts_transaction_type` (`accounts_transaction_type_id`, `accounts_transaction_type_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Cash', 1, 0, 0, '2016-02-11 15:50:34'),
(2, 'Cheque', 1, 0, 0, '2016-02-11 15:50:46'),
(3, 'NEFT', 1, 0, 0, '2016-02-11 15:50:55'),
(4, 'DD', 1, 0, 0, '2016-02-11 15:51:07'),
(5, 'Credit', 1, 0, 0, '2016-02-11 15:51:18'),
(6, 'Card', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `action`) VALUES
(1, 'view'),
(2, 'add'),
(3, 'edit'),
(4, 'delete'),
(5, 'excel'),
(6, 'pdf'),
(7, 'backup');

-- --------------------------------------------------------

--
-- Table structure for table `active_status`
--

CREATE TABLE `active_status` (
  `active_status_id` int(11) NOT NULL,
  `active_status_name` varchar(20) NOT NULL COMMENT 'Status',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_status`
--

INSERT INTO `active_status` (`active_status_id`, `active_status_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Active', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'In Active', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin_setting`
--

CREATE TABLE `admin_setting` (
  `admin_setting_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1-Admin,2-Client',
  `admin_setting_key` varchar(50) NOT NULL,
  `admin_setting_value` text NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_setting`
--

INSERT INTO `admin_setting` (`admin_setting_id`, `type`, `admin_setting_key`, `admin_setting_value`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(3531, 1, 'ADMIN_USER_GROUP_ID', '1,2,3', 0, 0, 0, '0000-00-00 00:00:00'),
(3529, 1, 'UG_ID_SADMIN', '', 0, 0, 0, '0000-00-00 00:00:00'),
(3530, 1, 'UG_ID_ADMIN', '', 0, 0, 0, '0000-00-00 00:00:00'),
(3528, 1, 'APP_TITLE', 'Ayurveda Clinic', 0, 0, 0, '0000-00-00 00:00:00'),
(3527, 1, 'HIDE_USER', '1,2', 0, 0, 0, '0000-00-00 00:00:00'),
(3526, 1, 'GST_PERCENTAGE', '18', 0, 0, 0, '0000-00-00 00:00:00'),
(3525, 1, 'BTN_WARNING_BORDER_COLOR', '#eea236', 0, 0, 0, '0000-00-00 00:00:00'),
(3524, 1, 'BTN_WARNING_BG_COLOR', '#f0ad4e', 0, 0, 0, '0000-00-00 00:00:00'),
(3522, 1, 'BTN_INFO_BG_COLOR', '#5bc0de;', 0, 0, 0, '0000-00-00 00:00:00'),
(3523, 1, 'BTN_INFO_BORDER_COLOR', '#46b8da;', 0, 0, 0, '0000-00-00 00:00:00'),
(3519, 1, 'BTN_SUCCESS_BORDER_COLOR', '#4cae4c', 0, 0, 0, '0000-00-00 00:00:00'),
(3520, 1, 'BTN_DANGER_BG_COLOR', '#d9534f', 0, 0, 0, '0000-00-00 00:00:00'),
(3521, 1, 'BTN_DANGER_BORDER_COLOR', '#d43f3a', 0, 0, 0, '0000-00-00 00:00:00'),
(3517, 1, 'CARD_HEADER_BORDER_COLOR', '', 0, 0, 0, '0000-00-00 00:00:00'),
(3518, 1, 'BTN_SUCCESS_BG_COLOR', '#5cb85c', 0, 0, 0, '0000-00-00 00:00:00'),
(3516, 1, 'CARD_HEADER_BG_COLOR', '#1976D2', 0, 0, 0, '0000-00-00 00:00:00'),
(3515, 1, 'LIST_TH_CLASS', 'table color-table muted-table', 0, 0, 0, '0000-00-00 00:00:00'),
(3514, 1, 'DASH_TH_CLASS', 'color-table muted-table', 0, 0, 0, '0000-00-00 00:00:00'),
(3513, 1, 'DEFAULT_COUNTRY', '99', 0, 0, 0, '0000-00-00 00:00:00'),
(3512, 1, 'RPP', '30', 0, 0, 0, '0000-00-00 00:00:00'),
(3511, 1, 'THUMB_HEIGHT', '200', 0, 0, 0, '0000-00-00 00:00:00'),
(3510, 1, 'THUMB_WIDTH', '200', 0, 0, 0, '0000-00-00 00:00:00'),
(3509, 1, 'SMTP_TIMEOUT', '7', 0, 0, 0, '0000-00-00 00:00:00'),
(3508, 1, 'SMTP_PORT', '587', 0, 0, 0, '0000-00-00 00:00:00'),
(3507, 1, 'SMTP_PASSWORD', 'Priyar@05', 0, 0, 0, '0000-00-00 00:00:00'),
(3506, 1, 'SMTP_USERNAME', 'dhanasekarans94@gmail.com', 0, 0, 0, '0000-00-00 00:00:00'),
(3505, 1, 'SMTP_HOSTNAME', 'ssl://smtp.gmail.com', 0, 0, 0, '0000-00-00 00:00:00'),
(3504, 1, 'MAIL_PROTOCOL', 'smtp', 0, 0, 0, '0000-00-00 00:00:00'),
(3503, 1, 'MAIL_FROM_NAME', 'KOTTAKKAL ARYA VAIDYA SALA', 0, 0, 0, '0000-00-00 00:00:00'),
(3502, 1, 'BCC_ADDRESS', 'dhanasekarans94@gmail.com', 0, 0, 0, '0000-00-00 00:00:00'),
(3500, 1, 'TO_ADDRESS', 'dhanasekarans94@gmail.com', 0, 0, 0, '0000-00-00 00:00:00'),
(3501, 1, 'CC_ADDRESS', 'dhanasekarans94@gmail.com', 0, 0, 0, '0000-00-00 00:00:00'),
(3499, 1, 'FROM_ADDRESS', 'dhanasekarans94@gmail.com', 0, 0, 0, '0000-00-00 00:00:00'),
(3498, 1, 'SMS_TEST_MOBILE_NO', '7904809253', 0, 0, 0, '0000-00-00 00:00:00'),
(3497, 1, 'SMS_API_REMOTE_LINK', 'http://localhost/workouts/SMS_API.php', 0, 0, 0, '0000-00-00 00:00:00'),
(3496, 1, 'SMS_API_THROUGH', '2', 0, 0, 0, '0000-00-00 00:00:00'),
(3495, 1, 'SMS_CURL_METHOD', '1', 0, 0, 0, '0000-00-00 00:00:00'),
(3493, 1, 'SMS_API_URL_TEMPLATE_3', '', 0, 0, 0, '0000-00-00 00:00:00'),
(3494, 1, 'SMS_API_URL_TEMPLATE_4', '', 0, 0, 0, '0000-00-00 00:00:00'),
(3492, 1, 'SMS_API_URL_TEMPLATE_2', '', 0, 0, 0, '0000-00-00 00:00:00'),
(3491, 1, 'SMS_API_URL_TEMPLATE_1', 'https://2factor.in/API/V1/1656a766-ec35-11ea-9fa5-0200cd936042/SMS/{MOBILE}/AUTOGEN/Register OTP', 0, 0, 0, '0000-00-00 00:00:00'),
(3490, 1, 'SMS_ACTIVE_API', '1', 0, 0, 0, '0000-00-00 00:00:00'),
(3532, 1, 'HABASIT_SUPPLIER_ID', '30', 0, 0, 0, '0000-00-00 00:00:00'),
(3533, 1, 'AUTO_USER', '', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `announcement_from_date` datetime NOT NULL COMMENT 'From Date',
  `announcement_to_date` datetime NOT NULL,
  `announcement_details` varchar(350) NOT NULL COMMENT 'Details',
  `announcement_visible_status` int(2) NOT NULL,
  `announcement_public` int(1) NOT NULL,
  `announcement_to_employee` varchar(255) NOT NULL,
  `ref_active_status_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `announcement_from_date`, `announcement_to_date`, `announcement_details`, `announcement_visible_status`, `announcement_public`, `announcement_to_employee`, `ref_active_status_id`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(4, '2018-11-14 00:00:00', '2018-11-15 00:00:00', 'Welcome To STS Internal software...', 0, 0, '112', 1, 1, 1, 0, '2018-11-14 13:49:35'),
(5, '2018-11-14 00:00:00', '2018-11-15 00:00:00', 'welcome To STS Organization...', 0, 0, '110,112,111', 1, 1, 3, 0, '2018-11-14 15:07:08'),
(6, '2018-11-14 00:00:00', '2018-11-30 00:00:00', 'Send me demo Video of Autotex Fluff Cleaner spindle rod mounting and demounting  ', 0, 0, '113,110', 1, 1, 16, 0, '2018-11-14 15:48:15'),
(7, '2018-11-14 00:00:00', '2018-11-30 00:00:00', 'Seetha spg mills can problem. Discuss with Jumac and sort it out. ', 0, 0, '110', 1, 1, 16, 0, '2018-11-14 16:26:24'),
(8, '2018-11-21 00:00:00', '2019-05-31 00:00:00', 'Yesterday visit report. Change KKP spg mill svisit as KKP textiles. U have mentioned KKP spg twice. ', 0, 0, '110', 1, 1, 1, 0, '2019-05-26 15:18:27'),
(9, '2019-05-26 00:00:00', '2019-12-31 00:00:00', '. * Application Providing - Closed. * Application Receiving Last Date - November 30th * Announcement of scholarship - between December 15th, 2019 - December 20, 2019.', 0, 0, '', 1, 0, 3, 0, '2019-11-22 17:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `application_segment_type`
--

CREATE TABLE `application_segment_type` (
  `application_segment_type_id` int(11) NOT NULL,
  `application_segment_type_name` varchar(25) NOT NULL COMMENT 'Application Segment type',
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application_segment_type`
--

INSERT INTO `application_segment_type` (`application_segment_type_id`, `application_segment_type_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'SPINNING', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'SIMPLEX', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'DRAWING', 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'COMBER', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_feedback`
--

CREATE TABLE `appointment_feedback` (
  `appointment_feedback_id` int(11) NOT NULL,
  `appointment_feedback_name` varchar(50) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_feedback`
--

INSERT INTO `appointment_feedback` (`appointment_feedback_id`, `appointment_feedback_name`, `delete_status`, `user_id`, `transaction_id`, `added_date`) VALUES
(1, 'confirm', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'not confirm', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_reject_reason`
--

CREATE TABLE `appointment_reject_reason` (
  `appointment_reject_reason_id` int(11) NOT NULL,
  `appointment_reject_reason_name` varchar(50) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment_reject_reason`
--

INSERT INTO `appointment_reject_reason` (`appointment_reject_reason_id`, `appointment_reject_reason_name`, `delete_status`, `user_id`, `transaction_id`, `added_date`) VALUES
(1, 'Have other work', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Feeling better now', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `approve_status`
--

CREATE TABLE `approve_status` (
  `approve_status_id` int(11) NOT NULL,
  `approve_status_name` varchar(20) NOT NULL COMMENT 'Approve Status',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approve_status`
--

INSERT INTO `approve_status` (`approve_status_id`, `approve_status_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Approved', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Not Approved', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area_id` int(11) NOT NULL,
  `area_name` varchar(100) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL COMMENT 'Bank / Branch Name',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `bank_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Aditya Birla Idea Payments Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Airtel Payments Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'Andhra Pradesh GVB', 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'Andhra Pragathi Grameena Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(5, 'Arunachal Pradesh Rural Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(6, 'Aryavart Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(7, 'Assam Gramin Vikash Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(8, 'Au Small Finance Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(9, 'Axis Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(10, 'Bandhan Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(11, 'Bangiya Gramin Vikash Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(12, 'Bank of Baroda', 0, 0, 0, '0000-00-00 00:00:00'),
(13, 'Bank of India', 0, 0, 0, '0000-00-00 00:00:00'),
(14, 'Bank of Maharashtra', 0, 0, 0, '0000-00-00 00:00:00'),
(15, 'Baroda Gujarat Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(16, 'Baroda Rajasthan Kshetriya Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(17, 'Baroda Uttar Pradesh Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(18, 'Canara Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(19, 'Capital Small Finance Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(20, 'Central Bank of India', 0, 0, 0, '0000-00-00 00:00:00'),
(21, 'Chaitanya Godavari GB', 0, 0, 0, '0000-00-00 00:00:00'),
(22, 'Chhattisgarh Rajya Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(23, 'City Union Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(24, 'Coastal Local Area Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(25, 'CSB Bank Limited', 0, 0, 0, '0000-00-00 00:00:00'),
(26, 'Dakshin Bihar Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(27, 'DCB Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(28, 'Dhanlaxmi Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(29, 'Ellaquai Dehati Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(30, 'Equitas Small Finance Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(31, 'ESAF Small Finance Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(32, 'Export-Import Bank of India', 0, 0, 0, '0000-00-00 00:00:00'),
(33, 'Federal Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(34, 'Fincare Small Finance Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(35, 'FINO Payments Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(36, 'HDFC Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(37, 'Himachal Pradesh Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(38, 'ICICI Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(39, 'IDBI Bank Limited', 0, 0, 0, '0000-00-00 00:00:00'),
(40, 'IDFC FIRST Bank Limited', 0, 0, 0, '0000-00-00 00:00:00'),
(41, 'India Post Payments Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(42, 'Indian Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(43, 'Indian Overseas Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(44, 'IndusInd Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(45, 'J&K Grameen Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(46, 'Jammu & Kashmir Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(47, 'Jana Small Finance Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(48, 'Jharkhand Rajya Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(49, 'Jio Payments Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(50, 'Karnataka Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(51, 'Karnataka Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(52, 'Karnataka Vikas Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(53, 'Karur Vysya Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(54, 'Kashi Gomti Samyut Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(55, 'Kerala Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(56, 'Kotak Mahindra Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(57, 'Krishna Bhima Samruddhi LAB Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(58, 'Lakshmi Vilas Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(59, 'Madhya Pradesh Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(60, 'Madhyanchal Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(61, 'Maharashtra GB', 0, 0, 0, '0000-00-00 00:00:00'),
(62, 'Manipur Rural Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(63, 'Meghalaya Rural Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(64, 'Mizoram Rural Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(65, 'Nagaland Rural Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(66, 'Nainital bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(67, 'National Bank for Agriculture and Rural Developmen', 0, 0, 0, '0000-00-00 00:00:00'),
(68, 'National Housing Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(69, 'North East Small finance Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(70, 'NSDL Payments Bank Limited', 0, 0, 0, '0000-00-00 00:00:00'),
(71, 'Odisha Gramya Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(72, 'Paschim Banga Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(73, 'Paytm Payments Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(74, 'Prathama U.P. Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(75, 'Puduvai Bharathiar Grama Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(76, 'Punjab & Sind Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(77, 'Punjab Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(78, 'Punjab National Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(79, 'Purvanchal Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(80, 'Rajasthan Marudhara Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(81, 'RBL Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(82, 'Saptagiri Grameena Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(83, 'Sarva Haryana Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(84, 'Saurashtra Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(85, 'Small Industries Development Bank of India', 0, 0, 0, '0000-00-00 00:00:00'),
(86, 'South Indian Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(87, 'State Bank of India', 0, 0, 0, '0000-00-00 00:00:00'),
(88, 'Subhadra Local Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(89, 'Suryoday Small Finance Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(90, 'Tamil Nadu Grama Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(91, 'Tamilnad Mercantile Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(92, 'Telengana Grameena Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(93, 'Tripura Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(94, 'UCO Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(95, 'Ujjivan Small Finance Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(96, 'Union Bank of India', 0, 0, 0, '0000-00-00 00:00:00'),
(97, 'Utkal Grameen Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(98, 'Utkarsh Small Finance Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00'),
(99, 'Uttar Bihar Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(100, 'Uttarakhand Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(101, 'UttarBanga Kshetriya Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(102, 'Vidharbha Konkan Gramin Bank', 0, 0, 0, '0000-00-00 00:00:00'),
(103, 'YES Bank Ltd', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(25) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Branch 1', 0, 0, 0, '2021-10-01 07:52:46'),
(2, 'Branch 2', 0, 0, 0, '2021-10-01 07:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `business_category`
--

CREATE TABLE `business_category` (
  `business_category_id` int(11) NOT NULL,
  `business_category_parent_id` int(11) NOT NULL,
  `business_category_name` varchar(100) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `old_sub_category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_category`
--

INSERT INTO `business_category` (`business_category_id`, `business_category_parent_id`, `business_category_name`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`, `old_sub_category_id`) VALUES
(3, 0, 'TEXTILE MACHINERY', 0, 3, 0, '2018-09-17 11:16:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL COMMENT 'Category',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Allergy & Cold', 1, 1, 0, '2020-07-31 17:42:43'),
(2, 'Body & Joint Pain', 1, 1, 0, '2020-07-31 17:42:58'),
(3, 'Breathing Problems', 1, 1, 0, '2020-07-31 17:43:12'),
(4, 'Test Category', 1, 1, 0, '2020-08-10 12:37:29'),
(5, 'ARISHTAS & ASAVAS', 25, 0, 0, '2020-08-11 17:38:48'),
(6, 'BHASMAS', 25, 0, 0, '2020-08-11 17:39:05'),
(7, 'BHASMAM CAPSULES', 25, 0, 0, '2020-08-11 17:40:20'),
(8, 'CHURNAMS', 25, 0, 0, '2020-08-11 17:40:49'),
(9, 'GHRITHAM OR MEDICATED GHEE', 25, 0, 0, '2020-08-11 17:41:43'),
(10, 'KASHAYAM TABLET', 25, 0, 0, '2020-08-11 17:41:59'),
(11, 'KASHAYAM OR DECOCTIONS', 25, 0, 0, '2020-08-11 17:42:15'),
(12, 'LEHAMS OR ELECTURIES', 25, 0, 0, '2020-08-11 17:42:32'),
(13, 'MEDICATED OILS', 25, 0, 0, '2020-08-11 17:42:41'),
(14, 'SOFTGEL CAPSUES', 25, 0, 0, '2020-08-11 17:42:54'),
(15, 'RASAKRIYAS OR COLLYRIUMS', 25, 0, 0, '2020-08-11 17:43:18'),
(16, 'GULIKA OR PILLS', 25, 0, 0, '2020-08-11 17:43:31'),
(17, 'OTHER P&P PRODUCTS', 3, 0, 0, '2021-09-13 13:35:59'),
(18, 'NANJANGUD FACTORY PRODUCTS', 3, 0, 0, '2021-09-13 13:37:36'),
(19, 'OTHERS', 25, 0, 0, '2020-08-11 17:44:05'),
(20, 'SAFETY', 3, 0, 0, '2020-09-01 12:34:43'),
(21, 'Books', 3, 1, 0, '2021-07-17 13:38:10'),
(22, 'NANJANGUD FACTORY PRODUCTS', 3, 1, 0, '2021-09-13 13:34:58'),
(23, 'OTC PRODUCTS', 3, 0, 0, '2021-09-13 13:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_from` int(11) NOT NULL,
  `member_to` int(11) NOT NULL,
  `from` varchar(25) NOT NULL,
  `to` varchar(25) NOT NULL,
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `delete_status` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL COMMENT 'City',
  `ref_district_id` int(11) NOT NULL COMMENT 'District',
  `ref_state_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `ref_district_id`, `ref_state_id`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(2, 'Aragalur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'Arasiramani', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'Attayampatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(5, 'Attur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(6, 'Avadattur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(7, 'Ayothiapattinam', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(8, 'Bukkampatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(9, 'Dalavaipatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(10, 'Edaganasalai', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(11, 'Edappadi', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(12, 'Elampillai', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(13, 'Ethapur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(14, 'Gangavalli', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(15, 'Jalakandapuram', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(16, 'Kadayampatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(17, 'Kannankurichi', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(18, 'Karuppur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(19, 'Keeripatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(20, 'Kolathur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(21, 'Kondalampatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(22, 'Konganapuram', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(23, 'Mallamooppampatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(24, 'Mallur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(25, 'Maramangalathupatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(26, 'Mecheri', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(27, 'Mettur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(28, 'Nangavalli', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(29, 'Narasingapuram', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(30, 'Neykkarappatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(31, 'Omalur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(32, 'P. N. Patti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(33, 'Panaimarathupatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(34, 'Papparapatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(35, 'Pethanaickenpalayam', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(36, 'Poolampatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(37, 'Ramanaickenpalayam', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(38, 'Sankagiri', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(39, 'Sentharapatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(40, 'Siruvachchur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(41, 'Thammampatti', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(42, 'Tharamangalam', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(43, 'Thedavur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(44, 'Thevur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(45, 'Vanavasi', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(46, 'Vazhapadi', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(47, 'Veeraganur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(48, 'Veerakkalpudur', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(49, 'Yercaud', 533, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(50, 'Salem', 533, 0, 0, 68, 0, '2016-07-28 18:41:49'),
(51, 'Adambakkam', 516, 0, 0, 7, 0, '2017-12-04 11:28:40'),
(52, 'Adyar', 516, 0, 0, 7, 0, '2017-12-04 11:28:54'),
(53, 'Alandur', 516, 0, 0, 7, 0, '2017-12-04 11:29:04'),
(54, 'Chidambaram', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(55, 'Cuddalore', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(56, 'Dharmapuri', 519, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(57, 'Karaikal', 452, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(58, 'Pondicherry', 454, 0, 0, 0, 0, '2017-12-25 17:08:17'),
(59, 'Jayankondam', 515, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(60, 'Ariyalur', 515, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(61, 'Chennai', 516, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(62, 'Coimbatore', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(63, 'Kurichi', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(64, 'Kuniyamuthur', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(65, 'Pollachi', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(66, 'Goundampalayam', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(67, 'Valparai', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(68, 'Mettupalayam', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(69, 'Cuddalore', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(70, 'Virudhachalam', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(71, 'Chidambaram', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(72, 'Panruti', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(73, 'Nellikuppam', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(74, 'Dharmapuri', 519, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(75, 'Dindigul', 520, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(76, 'Palani', 520, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(77, 'Kodaikanal', 520, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(78, 'Oddanchatram', 520, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(79, 'Erode', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(80, 'Veerappanchatram', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(81, 'Kasipalayam', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(82, 'Gobichettipalayam', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(83, 'Periyasemur', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(84, 'Surampatti', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(85, 'Bhavani', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(86, 'Sathyamangalam', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(87, 'Punjaipuliampatti', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(88, 'Pallavapuram', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(89, 'Tambaram', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(90, 'Alandur', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(91, 'Kancheepuram', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(92, 'Maraimalainagar', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(93, 'Pammal', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(94, 'Chengalpattu', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(95, 'Puzhuthivakkam', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(96, 'Anakaputhur', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(97, 'Maduranthakam', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(98, 'Nagercoil', 523, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(99, 'Colachel', 523, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(100, 'Padmanabhapuram', 523, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(101, 'Kuzhithurai', 523, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(102, 'Karur', 524, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(103, 'Inam Karur', 524, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(104, 'Thanthoni', 524, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(105, 'Kulithalai', 524, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(106, 'Hosur', 525, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(107, 'Krishnagiri', 525, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(108, 'Madurai', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(109, 'Avaniapuram', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(110, 'Anaiyur', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(111, 'Tirumangalam', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(112, 'Thirupparankundram', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(113, 'Melur', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(114, 'Usilampatti', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(115, 'Nagapattinam', 527, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(116, 'Mayiladuthurai', 527, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(117, 'Sirkazhi', 527, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(118, 'Vedaranyam', 527, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(119, 'Tiruchengode', 528, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(120, 'Komarapalayam', 528, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(121, 'Namakkal', 528, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(122, 'Rasipuram', 528, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(123, 'Pallipalayam', 528, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(124, 'Udhagamandalam', 529, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(125, 'Gudalur', 529, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(126, 'Coonoor', 529, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(127, 'Nelliyalam', 529, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(128, 'Perambalur', 530, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(129, 'Pudukkottai', 531, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(130, 'Aranthangi', 531, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(131, 'Paramakudi', 532, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(132, 'Ramanathapuram', 532, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(133, 'Rameswaram', 532, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(134, 'Keelakarai', 532, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(135, 'Karaikudi', 534, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(136, 'Devakottai', 534, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(137, 'Sivagangai', 534, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(138, 'Thanjavur', 535, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(139, 'Kumbakonam', 535, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(140, 'Pattukkottai', 535, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(141, 'Theni Allinagaram', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(142, 'Bodinayakanur', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(143, 'Kambam', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(144, 'Periyakulam', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(145, 'Chinnamanur', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(146, 'Gudalur', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(147, 'Thiruvannamalai', 542, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(148, 'Arani', 542, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(149, 'Cheyyar', 542, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(150, 'Vandavasi', 542, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(151, 'Mannargudi', 543, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(152, 'Tiruvarur', 543, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(153, 'Koothanallur', 543, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(154, 'Thiruthuraipoondi', 543, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(155, 'Thoothukudi', 537, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(156, 'Tiruchirappalli', 538, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(157, 'Manapparai', 538, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(158, 'Thuvakudi', 538, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(159, 'Thuraiyur', 538, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(160, 'Tirunelveli', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(161, 'Kadayanallur', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(162, 'Tenkasi', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(163, 'Puliyankudi', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(164, 'Sankarankoil', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(165, 'Vikramasingapuram', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(166, 'Ambasamudram', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(167, 'Sengottai', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(168, 'Tiruppur', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(169, 'Velampalayam', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(170, 'Nallur', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(171, 'Udumalaipettai', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(172, 'Dharapuram', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(173, 'Palladam', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(174, 'Vellakoil', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(175, 'Kangeyam', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(176, 'Ambattur', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(177, 'Avadi', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(178, 'Tiruvottiyur', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(179, 'Madhavaram', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(180, 'Maduravoyal', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(181, 'Thiruverkadu', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(182, 'Poonamallee', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(183, 'Tiruvallur', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(184, 'Valasaravakkam', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(185, 'Thiruthani', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(186, 'Kathivakkam', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(187, 'Manali', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(188, 'Kovilpatti', 537, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(189, 'Kayalpattinam', 537, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(190, 'Vellore', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(191, 'Ambur', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(192, 'Vaniyambadi', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(193, 'Gudiyatham', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(194, 'Arakkonam', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(195, 'Tiruppattur', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(196, 'Arcot', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(197, 'Pernampattu', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(198, 'Ranipet', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(199, 'Melvisharam', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(200, 'Walajapettai', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(201, 'Jolarpet', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(202, 'Sattur', 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(203, 'Jayankondam', 515, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(204, 'Ariyalur', 515, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(205, 'Chennai', 516, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(206, 'Coimbatore', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(207, 'Kurichi', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(208, 'Kuniyamuthur', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(209, 'Pollachi', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(210, 'Goundampalayam', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(211, 'Valparai', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(212, 'Mettupalayam', 517, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(213, 'Cuddalore', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(214, 'Virudhachalam', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(215, 'Chidambaram', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(216, 'Panruti', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(217, 'Nellikuppam', 518, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(218, 'Dharmapuri', 519, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(219, 'Dindigul', 520, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(220, 'Palani', 520, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(221, 'Kodaikanal', 520, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(222, 'Oddanchatram', 520, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(223, 'Erode', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(224, 'Veerappanchatram', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(225, 'Kasipalayam', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(226, 'Gobichettipalayam', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(227, 'Periyasemur', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(228, 'Surampatti', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(229, 'Bhavani', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(230, 'Sathyamangalam', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(231, 'Punjaipuliampatti', 521, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(232, 'Pallavapuram', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(233, 'Tambaram', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(234, 'Alandur', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(235, 'Kancheepuram', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(236, 'Maraimalainagar', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(237, 'Pammal', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(238, 'Chengalpattu', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(239, 'Puzhuthivakkam', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(240, 'Anakaputhur', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(241, 'Maduranthakam', 522, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(242, 'Nagercoil', 523, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(243, 'Colachel', 523, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(244, 'Padmanabhapuram', 523, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(245, 'Kuzhithurai', 523, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(246, 'Karur', 524, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(247, 'Inam Karur', 524, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(248, 'Thanthoni', 524, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(249, 'Kulithalai', 524, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(250, 'Hosur', 525, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(251, 'Krishnagiri', 525, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(252, 'Madurai', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(253, 'Avaniapuram', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(254, 'Anaiyur', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(255, 'Tirumangalam', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(256, 'Thirupparankundram', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(257, 'Melur', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(258, 'Usilampatti', 526, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(259, 'Nagapattinam', 527, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(260, 'Mayiladuthurai', 527, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(261, 'Sirkazhi', 527, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(262, 'Vedaranyam', 527, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(263, 'Tiruchengode', 528, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(264, 'Komarapalayam', 528, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(265, 'Namakkal', 528, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(266, 'Rasipuram', 528, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(267, 'Pallipalayam', 528, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(268, 'Udhagamandalam', 529, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(269, 'Gudalur', 529, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(270, 'Coonoor', 529, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(271, 'Nelliyalam', 529, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(272, 'Perambalur', 530, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(273, 'Pudukkottai', 531, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(274, 'Aranthangi', 531, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(275, 'Paramakudi', 532, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(276, 'Ramanathapuram', 532, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(277, 'Rameswaram', 532, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(278, 'Keelakarai', 532, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(279, 'Karaikudi', 534, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(280, 'Devakottai', 534, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(281, 'Sivagangai', 534, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(282, 'Thanjavur', 535, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(283, 'Kumbakonam', 535, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(284, 'Pattukkottai', 535, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(285, 'Theni Allinagaram', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(286, 'Bodinayakanur', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(287, 'Kambam', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(288, 'Periyakulam', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(289, 'Chinnamanur', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(290, 'Gudalur', 536, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(291, 'Thiruvannamalai', 542, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(292, 'Arani', 542, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(293, 'Cheyyar', 542, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(294, 'Vandavasi', 542, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(295, 'Mannargudi', 543, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(296, 'Tiruvarur', 543, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(297, 'Koothanallur', 543, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(298, 'Thiruthuraipoondi', 543, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(299, 'Thoothukudi', 537, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(300, 'Tiruchirappalli', 538, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(301, 'Manapparai', 538, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(302, 'Thuvakudi', 538, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(303, 'Thuraiyur', 538, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(304, 'Tirunelveli', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(305, 'Kadayanallur', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(306, 'Tenkasi', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(307, 'Puliyankudi', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(308, 'Sankarankoil', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(309, 'Vikramasingapuram', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(310, 'Ambasamudram', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(311, 'Sengottai', 539, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(312, 'Tiruppur', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(313, 'Velampalayam', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(314, 'Nallur', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(315, 'Udumalaipettai', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(316, 'Dharapuram', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(317, 'Palladam', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(318, 'Vellakoil', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(319, 'Kangeyam', 540, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(320, 'Ambattur', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(321, 'Avadi', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(322, 'Tiruvottiyur', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(323, 'Madhavaram', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(324, 'Maduravoyal', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(325, 'Thiruverkadu', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(326, 'Poonamallee', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(327, 'Tiruvallur', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(328, 'Valasaravakkam', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(329, 'Thiruthani', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(330, 'Kathivakkam', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(331, 'Manali', 541, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(332, 'Kovilpatti', 537, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(333, 'Kayalpattinam', 537, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(334, 'Vellore', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(335, 'Ambur', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(336, 'Vaniyambadi', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(337, 'Gudiyatham', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(338, 'Arakkonam', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(339, 'Tiruppattur', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(340, 'Arcot', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(341, 'Pernampattu', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(342, 'Ranipet', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(343, 'Melvisharam', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(344, 'Walajapettai', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(345, 'Jolarpet', 544, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(346, 'Sattur', 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `consultant_fees`
--

CREATE TABLE `consultant_fees` (
  `consultant_fees_id` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `ref_patient_id` int(11) NOT NULL,
  `ref_patient_visit_id` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_number_type`
--

CREATE TABLE `contact_number_type` (
  `contact_number_type_id` int(11) NOT NULL,
  `contact_number_type_name` varchar(20) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_number_type`
--

INSERT INTO `contact_number_type` (`contact_number_type_id`, `contact_number_type_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Mobile', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Phone', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'Whatsapp', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(128) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_status` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `iso_code_2`, `iso_code_3`, `status`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Albania', 'AL', 'ALB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'Algeria', 'DZ', 'DZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'American Samoa', 'AS', 'ASM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(5, 'Andorra', 'AD', 'AND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(6, 'Angola', 'AO', 'AGO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(7, 'Anguilla', 'AI', 'AIA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(8, 'Antarctica', 'AQ', 'ATA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(9, 'Antigua and Barbuda', 'AG', 'ATG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(10, 'Argentina', 'AR', 'ARG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(11, 'Armenia', 'AM', 'ARM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(12, 'Aruba', 'AW', 'ABW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(13, 'Australia', 'AU', 'AUS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(14, 'Austria', 'AT', 'AUT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(15, 'Azerbaijan', 'AZ', 'AZE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(16, 'Bahamas', 'BS', 'BHS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(17, 'Bahrain', 'BH', 'BHR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(18, 'Bangladesh', 'BD', 'BGD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(19, 'Barbados', 'BB', 'BRB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(20, 'Belarus', 'BY', 'BLR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(21, 'Belgium', 'BE', 'BEL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(22, 'Belize', 'BZ', 'BLZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(23, 'Benin', 'BJ', 'BEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(24, 'Bermuda', 'BM', 'BMU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(25, 'Bhutan', 'BT', 'BTN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(26, 'Bolivia', 'BO', 'BOL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(28, 'Botswana', 'BW', 'BWA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(29, 'Bouvet Island', 'BV', 'BVT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(30, 'Brazil', 'BR', 'BRA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(32, 'Brunei Darussalam', 'BN', 'BRN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(33, 'Bulgaria', 'BG', 'BGR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(34, 'Burkina Faso', 'BF', 'BFA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(35, 'Burundi', 'BI', 'BDI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(36, 'Cambodia', 'KH', 'KHM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(37, 'Cameroon', 'CM', 'CMR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(38, 'Canada', 'CA', 'CAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(39, 'Cape Verde', 'CV', 'CPV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(40, 'Cayman Islands', 'KY', 'CYM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(41, 'Central African Republic', 'CF', 'CAF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(42, 'Chad', 'TD', 'TCD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(43, 'Chile', 'CL', 'CHL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(44, 'China', 'CN', 'CHN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(45, 'Christmas Island', 'CX', 'CXR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(47, 'Colombia', 'CO', 'COL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(48, 'Comoros', 'KM', 'COM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(49, 'Congo', 'CG', 'COG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(50, 'Cook Islands', 'CK', 'COK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(51, 'Costa Rica', 'CR', 'CRI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(52, 'Cote D\'Ivoire', 'CI', 'CIV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(53, 'Croatia', 'HR', 'HRV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(54, 'Cuba', 'CU', 'CUB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(55, 'Cyprus', 'CY', 'CYP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(56, 'Czech Republic', 'CZ', 'CZE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(57, 'Denmark', 'DK', 'DNK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(58, 'Djibouti', 'DJ', 'DJI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(59, 'Dominica', 'DM', 'DMA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(60, 'Dominican Republic', 'DO', 'DOM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(61, 'East Timor', 'TL', 'TLS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(62, 'Ecuador', 'EC', 'ECU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(63, 'Egypt', 'EG', 'EGY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(64, 'El Salvador', 'SV', 'SLV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(66, 'Eritrea', 'ER', 'ERI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(67, 'Estonia', 'EE', 'EST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(68, 'Ethiopia', 'ET', 'ETH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(70, 'Faroe Islands', 'FO', 'FRO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(71, 'Fiji', 'FJ', 'FJI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(72, 'Finland', 'FI', 'FIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(74, 'France, Metropolitan', 'FR', 'FRA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(75, 'French Guiana', 'GF', 'GUF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(76, 'French Polynesia', 'PF', 'PYF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(77, 'French Southern Territories', 'TF', 'ATF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(78, 'Gabon', 'GA', 'GAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(79, 'Gambia', 'GM', 'GMB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(80, 'Georgia', 'GE', 'GEO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(81, 'Germany', 'DE', 'DEU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(82, 'Ghana', 'GH', 'GHA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(83, 'Gibraltar', 'GI', 'GIB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(84, 'Greece', 'GR', 'GRC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(85, 'Greenland', 'GL', 'GRL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(86, 'Grenada', 'GD', 'GRD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(87, 'Guadeloupe', 'GP', 'GLP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(88, 'Guam', 'GU', 'GUM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(89, 'Guatemala', 'GT', 'GTM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(90, 'Guinea', 'GN', 'GIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(91, 'Guinea-Bissau', 'GW', 'GNB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(92, 'Guyana', 'GY', 'GUY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(93, 'Haiti', 'HT', 'HTI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(95, 'Honduras', 'HN', 'HND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(96, 'Hong Kong', 'HK', 'HKG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(97, 'Hungary', 'HU', 'HUN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(98, 'Iceland', 'IS', 'ISL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(99, 'India', 'IN', 'IND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(100, 'Indonesia', 'ID', 'IDN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(102, 'Iraq', 'IQ', 'IRQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(103, 'Ireland', 'IE', 'IRL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(104, 'Israel', 'IL', 'ISR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(105, 'Italy', 'IT', 'ITA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(106, 'Jamaica', 'JM', 'JAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(107, 'Japan', 'JP', 'JPN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(108, 'Jordan', 'JO', 'JOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(109, 'Kazakhstan', 'KZ', 'KAZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(110, 'Kenya', 'KE', 'KEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(111, 'Kiribati', 'KI', 'KIR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(112, 'North Korea', 'KP', 'PRK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(113, 'Korea, Republic of', 'KR', 'KOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(114, 'Kuwait', 'KW', 'KWT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(115, 'Kyrgyzstan', 'KG', 'KGZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(116, 'Lao People\'s Democratic Republic', 'LA', 'LAO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(117, 'Latvia', 'LV', 'LVA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(118, 'Lebanon', 'LB', 'LBN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(119, 'Lesotho', 'LS', 'LSO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(120, 'Liberia', 'LR', 'LBR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(122, 'Liechtenstein', 'LI', 'LIE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(123, 'Lithuania', 'LT', 'LTU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(124, 'Luxembourg', 'LU', 'LUX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(125, 'Macau', 'MO', 'MAC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(126, 'FYROM', 'MK', 'MKD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(127, 'Madagascar', 'MG', 'MDG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(128, 'Malawi', 'MW', 'MWI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(129, 'Malaysia', 'MY', 'MYS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(130, 'Maldives', 'MV', 'MDV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(131, 'Mali', 'ML', 'MLI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(132, 'Malta', 'MT', 'MLT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(133, 'Marshall Islands', 'MH', 'MHL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(134, 'Martinique', 'MQ', 'MTQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(135, 'Mauritania', 'MR', 'MRT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(136, 'Mauritius', 'MU', 'MUS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(137, 'Mayotte', 'YT', 'MYT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(138, 'Mexico', 'MX', 'MEX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(140, 'Moldova, Republic of', 'MD', 'MDA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(141, 'Monaco', 'MC', 'MCO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(142, 'Mongolia', 'MN', 'MNG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(143, 'Montserrat', 'MS', 'MSR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(144, 'Morocco', 'MA', 'MAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(145, 'Mozambique', 'MZ', 'MOZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(146, 'Myanmar', 'MM', 'MMR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(147, 'Namibia', 'NA', 'NAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(148, 'Nauru', 'NR', 'NRU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(149, 'Nepal', 'NP', 'NPL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(150, 'Netherlands', 'NL', 'NLD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(151, 'Netherlands Antilles', 'AN', 'ANT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(152, 'New Caledonia', 'NC', 'NCL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(153, 'New Zealand', 'NZ', 'NZL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(154, 'Nicaragua', 'NI', 'NIC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(155, 'Niger', 'NE', 'NER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(156, 'Nigeria', 'NG', 'NGA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(157, 'Niue', 'NU', 'NIU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(158, 'Norfolk Island', 'NF', 'NFK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(159, 'Northern Mariana Islands', 'MP', 'MNP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(160, 'Norway', 'NO', 'NOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(161, 'Oman', 'OM', 'OMN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(162, 'Pakistan', 'PK', 'PAK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(163, 'Palau', 'PW', 'PLW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(164, 'Panama', 'PA', 'PAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(165, 'Papua New Guinea', 'PG', 'PNG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(166, 'Paraguay', 'PY', 'PRY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(167, 'Peru', 'PE', 'PER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(168, 'Philippines', 'PH', 'PHL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(169, 'Pitcairn', 'PN', 'PCN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(170, 'Poland', 'PL', 'POL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(171, 'Portugal', 'PT', 'PRT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(172, 'Puerto Rico', 'PR', 'PRI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(173, 'Qatar', 'QA', 'QAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(174, 'Reunion', 'RE', 'REU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(175, 'Romania', 'RO', 'ROM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(176, 'Russian Federation', 'RU', 'RUS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(177, 'Rwanda', 'RW', 'RWA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(179, 'Saint Lucia', 'LC', 'LCA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(181, 'Samoa', 'WS', 'WSM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(182, 'San Marino', 'SM', 'SMR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(183, 'Sao Tome and Principe', 'ST', 'STP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(184, 'Saudi Arabia', 'SA', 'SAU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(185, 'Senegal', 'SN', 'SEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(186, 'Seychelles', 'SC', 'SYC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(187, 'Sierra Leone', 'SL', 'SLE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(188, 'Singapore', 'SG', 'SGP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(189, 'Slovak Republic', 'SK', 'SVK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(190, 'Slovenia', 'SI', 'SVN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(191, 'Solomon Islands', 'SB', 'SLB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(192, 'Somalia', 'SO', 'SOM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(193, 'South Africa', 'ZA', 'ZAF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(194, 'South Georgia &amp; South Sandwich Islands', 'GS', 'SGS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(195, 'Spain', 'ES', 'ESP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(196, 'Sri Lanka', 'LK', 'LKA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(197, 'St. Helena', 'SH', 'SHN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(199, 'Sudan', 'SD', 'SDN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(200, 'Suriname', 'SR', 'SUR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(202, 'Swaziland', 'SZ', 'SWZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(203, 'Sweden', 'SE', 'SWE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(204, 'Switzerland', 'CH', 'CHE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(205, 'Syrian Arab Republic', 'SY', 'SYR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(206, 'Taiwan', 'TW', 'TWN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(207, 'Tajikistan', 'TJ', 'TJK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(209, 'Thailand', 'TH', 'THA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(210, 'Togo', 'TG', 'TGO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(211, 'Tokelau', 'TK', 'TKL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(212, 'Tonga', 'TO', 'TON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(213, 'Trinidad and Tobago', 'TT', 'TTO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(214, 'Tunisia', 'TN', 'TUN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(215, 'Turkey', 'TR', 'TUR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(216, 'Turkmenistan', 'TM', 'TKM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(218, 'Tuvalu', 'TV', 'TUV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(219, 'Uganda', 'UG', 'UGA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(220, 'Ukraine', 'UA', 'UKR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(221, 'United Arab Emirates', 'AE', 'ARE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(222, 'United Kingdom', 'GB', 'GBR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(223, 'United States', 'US', 'USA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(225, 'Uruguay', 'UY', 'URY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(226, 'Uzbekistan', 'UZ', 'UZB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(227, 'Vanuatu', 'VU', 'VUT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(229, 'Venezuela', 'VE', 'VEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(230, 'Viet Nam', 'VN', 'VNM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(231, 'Virgin Islands (British)', 'VG', 'VGB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(234, 'Western Sahara', 'EH', 'ESH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(235, 'Yemen', 'YE', 'YEM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(237, 'Democratic Republic of Congo', 'CD', 'COD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(238, 'Zambia', 'ZM', 'ZMB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(239, 'Zimbabwe', 'ZW', 'ZWE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(242, 'Montenegro', 'ME', 'MNE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(243, 'Serbia', 'RS', 'SRB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(244, 'Aaland Islands', 'AX', 'ALA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(245, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(246, 'Curacao', 'CW', 'CUW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(247, 'Palestinian Territory, Occupied', 'PS', 'PSE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(248, 'South Sudan', 'SS', 'SSD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(249, 'St. Barthelemy', 'BL', 'BLM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(250, 'St. Martin (French part)', 'MF', 'MAF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(251, 'Canary Islands', 'IC', 'ICA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(252, 'Ascension Island (British)', 'AC', 'ASC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(253, 'Kosovo, Republic of', 'XK', 'UNK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(254, 'Isle of Man', 'IM', 'IMN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(255, 'Tristan da Cunha', 'TA', 'SHN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(256, 'Guernsey', 'GG', 'GGY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(257, 'Jersey', 'JE', 'JEY', 1, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `ref_branch_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL COMMENT 'Customer',
  `mobile` varchar(15) NOT NULL COMMENT 'Mobile',
  `email` varchar(50) NOT NULL COMMENT 'Email',
  `password` varchar(255) DEFAULT NULL,
  `address` longtext NOT NULL,
  `pincode` int(11) NOT NULL,
  `ref_district_id` int(11) NOT NULL COMMENT 'District',
  `ref_country_id` int(11) NOT NULL,
  `ref_state_id` int(11) NOT NULL,
  `payment_method` varchar(10) NOT NULL,
  `customer_gst_no` varchar(25) NOT NULL,
  `customer_gst_file` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '1-user, 2- Guest User',
  `customer_description` varchar(255) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `ref_branch_id`, `customer_name`, `mobile`, `email`, `password`, `address`, `pincode`, `ref_district_id`, `ref_country_id`, `ref_state_id`, `payment_method`, `customer_gst_no`, `customer_gst_file`, `user_type`, `customer_description`, `ref_user_id`, `added_date`, `transaction_id`, `delete_status`) VALUES
(2, 0, 'Balaji', '7904809253', 'bala@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '#23,Test', 636122, 516, 99, 1503, '', '', '', 1, '0', 0, '2020-10-07 20:54:52', 0, 1),
(4, 0, 'Balaji', '9789711420', 'bala@gmail.com', '', '#23,Test', 636122, 516, 99, 1503, 'cod', '', '', 2, 'Test', 3, '2020-10-08 16:37:40', 0, 1),
(5, 0, 'Dinesh', '67434534534', '', '', 'Salem', 0, 516, 0, 1503, '', 'TN234234234', '', 0, '', 3, '2020-10-12 21:18:16', 0, 1),
(6, 0, 'Hathija', '9444075189', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-13 13:25:13', 0, 0),
(7, 0, 'Kishore', '8940002098', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-13 13:30:49', 0, 0),
(8, 0, 'Deepthy', '9884044076', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-13 13:49:27', 0, 0),
(9, 0, 'Dhanya', '9884025644', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-13 13:51:24', 0, 0),
(10, 0, 'Bhuvaneswari', '7010130761', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-13 14:18:48', 0, 0),
(11, 0, 'senthamizal selvan', '8807381675', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-13 16:27:38', 0, 0),
(12, 0, 'Ramesh', '984152995', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-13 16:52:40', 0, 0),
(13, 0, 'Srimathi', '9842811265', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-13 17:26:19', 0, 0),
(14, 0, 'Sathish', '9380576631', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-13 17:53:09', 0, 0),
(15, 0, 'Suryanarayanan', '9940129780', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-13 18:41:37', 0, 0),
(16, 0, 'Govindhan', '9940261682', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 10:25:12', 0, 0),
(17, 0, 'Venkatesh', '8939551661', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 11:29:40', 0, 0),
(18, 0, 'Somasundaram', '9791804354', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 11:33:07', 0, 0),
(19, 0, 'Vasikar', '9840466570', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 11:42:34', 0, 0),
(20, 0, 'Nikil', '7092526249', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 11:44:26', 0, 0),
(21, 0, 'Williams', '9884452597', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 11:55:31', 0, 0),
(22, 0, 'diya', '9094475574', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 12:03:12', 0, 0),
(23, 0, 'Krishnadas', '0', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 12:13:48', 0, 0),
(24, 0, 'Abilash', '0', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 12:15:38', 0, 0),
(25, 0, 'Nandhini', '0', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 12:17:45', 0, 0),
(26, 0, 'Jayabalakrishan', '0', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 12:21:02', 0, 0),
(27, 0, 'Vinod Kumar', '8608874147', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 15:19:33', 0, 0),
(28, 0, 'Dr.sunthareshan', '9962858927', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 16:02:25', 0, 0),
(29, 0, 'Sankar', '0', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 16:18:13', 0, 0),
(30, 0, 'Priya', '9094475574', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 16:33:46', 0, 0),
(31, 0, 'Saravanan', '9444333180', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 16:34:57', 0, 0),
(32, 0, 'Karthikeyan R', '9962132999', '', '', 'Plot No.876, Syndicate Bank Colony, Annanagar West', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 16:53:27', 0, 0),
(33, 0, 'Latha', '9940176636', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 16:56:20', 0, 0),
(34, 0, 'Vasanthi', '955171950', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-15 19:47:07', 0, 0),
(35, 0, 'Suresh Babu', '9884412272', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-16 10:24:14', 0, 0),
(36, 0, 'Syamala', '9710287253', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-16 13:00:23', 0, 0),
(37, 0, 'Padmashri', '9841119747', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-16 13:07:03', 0, 0),
(38, 0, 'Shravan', '9841169629', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-16 16:19:55', 0, 0),
(39, 0, 'Singaravelu', '8095929295', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-16 16:31:27', 0, 0),
(40, 0, 'Manikandan', '9080569141', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-16 17:20:18', 0, 0),
(41, 0, 'Rithanya', '9841566444', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-16 18:04:02', 0, 0),
(42, 0, 'Santhosh', '7358063904', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-16 19:41:29', 0, 0),
(43, 0, 'Sreekanth', '9444046689', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-16 19:50:15', 0, 0),
(44, 0, 'Murali', '9282241255', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-17 08:52:33', 0, 0),
(45, 0, 'Sasi', '9444219959', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-17 09:12:07', 0, 0),
(46, 0, 'Susheela', '9003182102', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-17 09:46:56', 0, 0),
(47, 0, 'Sethumadhavan', '9444262284', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-17 15:29:36', 0, 0),
(48, 0, 'Priya', '9003079965', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-17 17:23:51', 0, 0),
(49, 0, 'Surya', '9841790069', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-17 17:27:56', 0, 0),
(50, 0, 'Athmanathan', '9445295455', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-17 17:37:05', 0, 0),
(51, 0, 'Sivaprasad', '9500341235', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-17 17:43:03', 0, 0),
(52, 0, 'A S Menon', '9884810101', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-17 18:50:09', 0, 0),
(53, 0, 'Sandra', '9840048122', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-17 19:29:46', 0, 0),
(54, 0, 'Arun', '9791123054', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-18 10:47:25', 0, 0),
(55, 0, 'Ramesh', '8608434350', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-18 10:52:58', 0, 0),
(56, 0, 'Aravind', '9884002824', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-18 11:07:32', 0, 0),
(57, 0, 'Ashwin', '8903946023', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-18 11:12:51', 0, 0),
(58, 0, 'Malathy', '9940335050', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-18 12:23:23', 0, 0),
(59, 0, 'Sudha', '9884094968', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-18 15:35:57', 0, 0),
(60, 0, 'Lakshmipathi', '9840682417', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-18 18:24:53', 0, 0),
(61, 0, 'Azhagiri', '9994633378', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-19 10:19:51', 0, 0),
(62, 0, 'Vasantha', '9840402480', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-19 10:37:07', 0, 0),
(63, 0, 'Singh', '9884614181', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-19 15:21:30', 0, 0),
(64, 0, 'Saravanan', '9884046845', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-19 16:33:42', 0, 0),
(65, 0, 'Veeraraghavan', '9940078333', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-19 17:37:02', 0, 0),
(66, 0, 'Subhashree', '9940303403', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-19 19:46:03', 0, 0),
(67, 0, 'Haridas', '9962108506', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-19 19:47:48', 0, 0),
(68, 0, 'Prakash', '9500053656', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-19 20:17:06', 0, 0),
(69, 0, 'Unnikrishan', '9444908854', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-20 12:09:37', 0, 0),
(70, 0, 'Ashok', '9940299932', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-20 12:23:44', 0, 0),
(71, 0, 'Srilekha', '9566175584', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-20 12:37:28', 0, 0),
(72, 0, 'Sundhar', '9840131311', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-20 13:37:51', 0, 0),
(73, 0, 'Saranya', '7092280762', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-20 13:41:15', 0, 0),
(74, 0, 'Dhinakaran', '9444211811', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-20 17:20:28', 0, 0),
(75, 0, 'Ashwathy', '9962170107', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-20 18:00:10', 0, 0),
(76, 0, 'Sathyanarayanan', '9444384671', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-20 19:02:24', 0, 0),
(77, 0, 'Revathy', '7092707373', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-20 19:59:31', 0, 0),
(78, 0, 'Peethambaran', '9381902377', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-21 09:46:29', 0, 0),
(79, 0, 'Vijaya', '9940278655', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-21 11:20:56', 0, 0),
(80, 0, 'Sambasivam', '9500035869', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-21 11:39:30', 0, 0),
(81, 0, 'Vidhya', '9841276367', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-21 11:47:30', 0, 0),
(82, 0, 'Abdul Khader', '9840164010', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-21 16:42:44', 0, 0),
(83, 0, 'Jeevanandam', '8122870133', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-22 12:37:42', 0, 0),
(84, 0, 'Durga', '8778827373', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-22 18:57:01', 0, 0),
(85, 0, 'Rekha Krishna', '9382584880', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 12:23:38', 0, 0),
(86, 0, 'Elumalai', '9841073149', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 12:27:17', 0, 0),
(87, 0, 'Jayabharathi', '8681074533', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 14:22:49', 0, 0),
(88, 0, 'Venugopal', '9176676618', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 15:30:14', 0, 0),
(89, 0, 'Ramachandran', '9444129208', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 15:42:19', 0, 0),
(90, 0, 'Ajith kumar', '9944309804', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 17:28:30', 0, 0),
(91, 0, 'S Sundhar Ram', '9600017823', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 17:35:49', 0, 0),
(92, 0, 'Padmanabhan', '8438974680', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 17:48:40', 0, 0),
(93, 0, 'Subramanian', '9962212236', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 18:04:34', 0, 0),
(94, 0, 'Tulasi mala', '9884089644', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 18:28:43', 0, 0),
(95, 0, 'RUTHIBU ANATH', '9884774777', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 18:33:40', 0, 0),
(96, 0, 'Ganesh', '988440277', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 18:52:24', 0, 0),
(97, 0, 'MARY', '9444257774', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 19:34:47', 0, 0),
(98, 0, 'Deepa', '8148641285', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-23 19:52:31', 0, 0),
(99, 0, 'M Ramanathan', '9444402818', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-24 09:43:46', 0, 0),
(100, 0, 'M.Prasanth', '9949205478', '', '', '', 0, 516, 0, 1503, '', '', '', 0, '', 3, '2020-10-24 13:16:44', 0, 0),
(2656, 1, 'Dhana', '', '', NULL, 'test', 1234, 533, 99, 1503, '', '', '', 0, '', 1, '2022-06-13 13:28:44', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `customer_order_id` int(11) NOT NULL,
  `customer_order_name` varchar(25) NOT NULL,
  `ref_customer_id` int(11) NOT NULL,
  `sub_total` float(10,2) NOT NULL,
  `gst` float(10,2) NOT NULL,
  `shipping_charge` float(10,2) NOT NULL,
  `convenience_fees` float(10,2) NOT NULL,
  `final_total` float(10,2) NOT NULL,
  `payment_method` varchar(15) NOT NULL,
  `ref_status_id` int(11) NOT NULL DEFAULT 1,
  `shipping_method` int(11) DEFAULT NULL,
  `ref_invoice_id` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL DEFAULT 0,
  `delete_status` int(1) NOT NULL DEFAULT 0,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`customer_order_id`, `customer_order_name`, `ref_customer_id`, `sub_total`, `gst`, `shipping_charge`, `convenience_fees`, `final_total`, `payment_method`, `ref_status_id`, `shipping_method`, `ref_invoice_id`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(6, 'KM/20-21/0006', 2, 218.75, 26.25, 100.00, 0.00, 345.00, 'cod', 1, 0, 0, 0, 0, 0, '2020-10-07 21:06:36'),
(7, 'KM/20-21/0007', 2, 508.90, 87.32, 100.00, 0.00, 696.22, 'razorpay', 1, 0, 0, 0, 0, 0, '2020-10-08 11:04:57'),
(8, 'KM/20-21/0008', 2, 2243.73, 912.76, 0.00, 0.00, 3156.49, 'cod', 1, 0, 0, 0, 0, 0, '2020-10-08 16:30:28'),
(9, 'KM/20-21/0009', 2, 357.10, 77.67, 0.00, 0.00, 434.77, 'cod', 1, 0, 0, 0, 0, 0, '2020-10-08 16:44:45'),
(10, 'KM/20-21/0010', 23, 178.55, 21.43, 0.00, 0.00, 199.98, 'cod', 1, 0, 0, 0, 0, 0, '2020-10-15 17:14:08'),
(11, 'KM/20-21/0011', 23, 290.15, 34.82, 0.00, 0.00, 324.97, 'cod', 1, 0, 0, 0, 0, 0, '2020-10-15 17:43:03'),
(12, 'KM/20-21/0012', 23, 104.60, 5.23, 0.00, 0.00, 109.83, 'cod', 1, 0, 0, 0, 0, 0, '2020-12-21 23:38:07'),
(13, 'KM/21-22/0013', 1702, 199.45, 45.36, 0.00, 0.00, 244.81, 'cod', 1, 0, 0, 0, 0, 0, '2021-05-19 19:10:48'),
(14, 'KM/21-22/0014', 1782, 105.30, 16.21, 0.00, 0.00, 121.51, 'cod', 1, 0, 0, 0, 0, 0, '2021-05-26 13:33:35'),
(15, 'KM/21-22/0015', 1882, 71.50, 8.58, 0.00, 0.00, 80.08, 'cod', 1, 0, 0, 0, 0, 0, '2021-06-13 20:51:51'),
(16, 'KM/21-22/0016', 1887, 761.50, 38.08, 0.00, 0.00, 799.58, 'cod', 1, 0, 0, 0, 0, 0, '2021-06-14 18:29:58'),
(17, 'KM/21-22/0017', 1702, 0.00, 0.00, 0.00, 0.00, 0.00, 'cod', 1, 0, 0, 0, 0, 0, '2021-07-05 18:01:13'),
(18, 'KM/21-22/0018', 1887, 152.30, 7.62, 0.00, 0.00, 159.91, 'cod', 1, 0, 0, 0, 0, 0, '2021-07-23 17:26:44'),
(19, 'KM/21-22/0019', 337, 297.71, 44.36, 0.00, 0.00, 342.07, 'cod', 1, 0, 0, 0, 0, 0, '2021-09-03 19:01:39'),
(20, 'KM/21-22/0020', 337, 297.71, 44.36, 0.00, 0.00, 342.07, 'cod', 1, 0, 0, 0, 0, 0, '2021-09-03 19:02:53'),
(21, 'KM/21-22/0021', 337, 297.71, 44.36, 0.00, 0.00, 342.07, 'cod', 3, 0, 10619, 3, 0, 0, '2021-09-03 19:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_product`
--

CREATE TABLE `customer_order_product` (
  `customer_order_product_id` int(11) NOT NULL,
  `ref_product_id` int(11) NOT NULL,
  `ref_customer_order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `product_total` float(10,2) NOT NULL,
  `gst_percentage` float(10,2) NOT NULL,
  `gst_amount` float(10,2) NOT NULL,
  `ref_user_id` int(11) NOT NULL DEFAULT 0,
  `delete_status` int(1) NOT NULL DEFAULT 0,
  `transaction_id` int(11) NOT NULL DEFAULT 0,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_order_product`
--

INSERT INTO `customer_order_product` (`customer_order_product_id`, `ref_product_id`, `ref_customer_order_id`, `quantity`, `price`, `product_total`, `gst_percentage`, `gst_amount`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 560, 1, 8, 290.15, 324.97, 12.00, 34.82, 0, 0, 0, '2020-08-19 15:40:43'),
(2, 560, 2, 1, 290.15, 324.97, 12.00, 34.82, 0, 0, 0, '2020-08-22 08:05:21'),
(3, 561, 2, 5, 218.75, 245.00, 12.00, 26.25, 0, 0, 0, '2020-08-22 08:05:21'),
(4, 554, 3, 2, 209.00, 234.08, 12.00, 25.08, 0, 0, 0, '2020-08-23 06:47:13'),
(5, 555, 3, 1, 49.10, 54.99, 12.00, 5.89, 0, 0, 0, '2020-08-23 06:47:13'),
(6, 558, 3, 1, 66.95, 74.98, 12.00, 8.03, 0, 0, 0, '2020-08-23 06:47:13'),
(7, 557, 3, 1, 52.30, 58.58, 12.00, 6.28, 0, 0, 0, '2020-08-23 06:47:13'),
(8, 562, 4, 2, 218.75, 245.00, 12.00, 26.25, 0, 0, 0, '2020-10-07 20:32:44'),
(9, 561, 4, 1, 218.75, 245.00, 12.00, 26.25, 0, 0, 0, '2020-10-07 20:32:44'),
(10, 561, 5, 2, 218.75, 245.00, 12.00, 26.25, 0, 0, 0, '2020-10-07 20:47:52'),
(11, 562, 6, 1, 218.75, 245.00, 12.00, 26.25, 0, 0, 0, '2020-10-07 21:06:36'),
(12, 561, 7, 1, 218.75, 245.00, 12.00, 26.25, 0, 0, 0, '2020-10-08 11:04:57'),
(13, 560, 7, 1, 290.15, 324.97, 12.00, 34.82, 0, 0, 0, '2020-10-08 11:04:57'),
(14, 561, 8, 10, 218.75, 245.00, 12.00, 26.25, 0, 0, 0, '2020-10-08 16:30:28'),
(15, 557, 8, 1, 52.30, 54.91, 5.00, 2.62, 0, 0, 0, '2020-10-08 16:30:28'),
(16, 554, 8, 1, 2.09, 2.34, 12.00, 0.25, 0, 0, 0, '2020-10-08 16:30:28'),
(17, 553, 8, 1, 1.84, 2.06, 12.00, 0.22, 0, 0, 0, '2020-10-08 16:30:28'),
(18, 560, 9, 1, 290.15, 324.97, 12.00, 34.82, 0, 0, 0, '2020-10-08 16:44:45'),
(19, 558, 9, 1, 66.95, 74.98, 12.00, 8.03, 0, 0, 0, '2020-10-08 16:44:45'),
(20, 559, 10, 1, 178.55, 199.98, 12.00, 21.43, 0, 0, 0, '2020-10-15 17:14:08'),
(21, 560, 11, 1, 290.15, 324.97, 12.00, 34.82, 0, 0, 0, '2020-10-15 17:43:03'),
(22, 557, 12, 2, 52.30, 54.91, 5.00, 2.62, 0, 0, 0, '2020-12-21 23:38:07'),
(23, 559, 13, 1, 178.55, 199.98, 12.00, 21.43, 0, 0, 0, '2021-05-19 19:10:48'),
(24, 554, 13, 10, 2.09, 2.34, 12.00, 0.25, 0, 0, 0, '2021-05-19 19:10:48'),
(25, 1, 14, 1, 71.40, 74.97, 5.00, 3.57, 0, 0, 0, '2021-05-26 13:33:35'),
(26, 281, 14, 10, 3.39, 3.80, 12.00, 0.41, 0, 0, 0, '2021-05-26 13:33:35'),
(27, 522, 15, 50, 1.43, 1.60, 12.00, 0.17, 0, 0, 0, '2021-06-13 20:51:51'),
(28, 121, 16, 10, 76.15, 79.96, 5.00, 3.81, 0, 0, 0, '2021-06-14 18:29:58'),
(29, 121, 18, 2, 76.15, 79.96, 5.00, 3.81, 0, 0, 0, '2021-07-23 17:26:44'),
(30, 527, 19, 101, 1.71, 1.80, 5.00, 0.09, 0, 0, 0, '2021-09-03 19:01:39'),
(31, 130, 19, 2, 62.50, 70.00, 12.00, 7.50, 0, 0, 0, '2021-09-03 19:01:39'),
(32, 527, 20, 101, 1.71, 1.80, 5.00, 0.09, 0, 0, 0, '2021-09-03 19:02:53'),
(33, 130, 20, 2, 62.50, 70.00, 12.00, 7.50, 0, 0, 0, '2021-09-03 19:02:53'),
(34, 527, 21, 101, 1.71, 1.80, 5.00, 0.09, 0, 0, 0, '2021-09-03 19:02:57'),
(35, 130, 21, 2, 62.50, 70.00, 12.00, 7.50, 0, 0, 0, '2021-09-03 19:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `customer_product`
--

CREATE TABLE `customer_product` (
  `customer_product_id` int(11) NOT NULL,
  `products` longtext NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `shipping_amount` int(11) NOT NULL,
  `ref_customer_id` int(11) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `added_date` datetime NOT NULL,
  `transaction_id` int(11) NOT NULL DEFAULT 0,
  `delete_status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_product`
--

INSERT INTO `customer_product` (`customer_product_id`, `products`, `order_id`, `shipping_amount`, `ref_customer_id`, `payment_type`, `added_date`, `transaction_id`, `delete_status`) VALUES
(1, 'YToxOntpOjA7YTo0OntzOjEwOiJwcm9kdWN0X2lkIjtzOjM6IjU2MiI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjI2OiJDLUhlYWx0aCBTdWdhciBGcmVlR3JhbnVsZSI7czo1OiJwcmljZSI7czozOiIyNTAiO3M6MzoiR1NUIjtzOjI6IjEyIjt9fQ==', '', 0, 2, 'cod', '2020-08-18 17:39:12', 0, 0),
(2, 'YToxOntpOjA7YTo0OntzOjEwOiJwcm9kdWN0X2lkIjtzOjM6IjU2MiI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjI2OiJDLUhlYWx0aCBTdWdhciBGcmVlR3JhbnVsZSI7czo1OiJwcmljZSI7czozOiIyNTAiO3M6MzoiR1NUIjtzOjI6IjEyIjt9fQ==', '', 0, 4, 'cod', '2020-08-18 17:44:28', 0, 0),
(3, 'YToyOntpOjA7YTo0OntzOjEwOiJwcm9kdWN0X2lkIjtzOjM6IjU2MSI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjE2OiJDLUhlYWx0aCBHcmFudWxlIjtzOjU6InByaWNlIjtzOjM6IjI1MCI7czozOiJHU1QiO3M6MjoiMTIiO31pOjE7YTo0OntzOjEwOiJwcm9kdWN0X2lkIjtzOjM6IjU2MiI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjI2OiJDLUhlYWx0aCBTdWdhciBGcmVlR3JhbnVsZSI7czo1OiJwcmljZSI7czozOiIyNTAiO3M6MzoiR1NUIjtzOjI6IjEyIjt9fQ==', '', 0, 3, 'cod', '2020-08-18 18:39:06', 0, 0),
(4, 'YTowOnt9', '', 0, 5, 'cod', '2020-08-18 20:23:55', 0, 0),
(5, 'YToxOntpOjA7YTo0OntzOjEwOiJwcm9kdWN0X2lkIjtzOjM6IjU2MiI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjI2OiJDLUhlYWx0aCBTdWdhciBGcmVlR3JhbnVsZSI7czo1OiJwcmljZSI7czozOiIyNTAiO3M6MzoiR1NUIjtzOjI6IjEyIjt9fQ==', '', 0, 6, 'cod', '2020-08-18 23:21:35', 0, 0),
(6, 'YToxOntpOjA7YTo0OntzOjEwOiJwcm9kdWN0X2lkIjtzOjM6IjU1OCI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjE2OiJUYWxpc3VsZSBHcmFudWxlIjtzOjU6InByaWNlIjtzOjM6IjEwMCI7czozOiJHU1QiO3M6MjoiMTIiO319', '', 0, 7, 'cod', '2020-08-18 23:27:48', 0, 0),
(7, 'YTozOntpOjA7YTo1OntzOjEwOiJwcm9kdWN0X2lkIjtzOjM6IjU2MCI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjE3OiJTcGVybWFrb3QgR3JhbnVsZSI7czo4OiJxdWFudGl0eSI7czoxOiIzIjtzOjU6InByaWNlIjtzOjY6IjI5MC4xNSI7czozOiJHU1QiO3M6MjoiMTIiO31pOjE7YTo1OntzOjEwOiJwcm9kdWN0X2lkIjtzOjM6IjU1NCI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjMwOiJMYWtzaG1pdmlsYXNhcmFzYW0gKE5hcmFkaXlhbSkiO3M6ODoicXVhbnRpdHkiO3M6MToiMiI7czo1OiJwcmljZSI7czo2OiIyMDkuMDAiO3M6MzoiR1NUIjtzOjI6IjEyIjt9aToyO2E6NTp7czoxMDoicHJvZHVjdF9pZCI7czozOiI1NTUiO3M6MTI6InByb2R1Y3RfbmFtZSI7czoyMToiUmFqYWhwcmF2YXJ0aGluaSBWYXRpIjtzOjg6InF1YW50aXR5IjtzOjE6IjEiO3M6NToicHJpY2UiO3M6NToiNDkuMTAiO3M6MzoiR1NUIjtzOjI6IjEyIjt9fQ==', '989015081905', 100, 8, 'cod', '2020-08-19 05:06:05', 0, 0),
(8, 'YToxOntpOjA7YTo1OntzOjEwOiJwcm9kdWN0X2lkIjtzOjM6IjU2MSI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjE2OiJDLUhlYWx0aCBHcmFudWxlIjtzOjg6InF1YW50aXR5IjtzOjI6IjEwIjtzOjU6InByaWNlIjtzOjY6IjIxOC43NSI7czozOiJHU1QiO3M6MjoiMTIiO319', '166171081950', 100, 10, 'cod', '2020-08-19 10:59:50', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_block`
--

CREATE TABLE `dashboard_block` (
  `dashboard_block_id` int(11) NOT NULL,
  `dashboard_block_name` varchar(200) NOT NULL COMMENT 'Block Name',
  `dashboard_block_key` varchar(50) NOT NULL COMMENT 'Block Key',
  `column_width` int(11) NOT NULL COMMENT 'Cloumn',
  `sort_order` int(11) NOT NULL COMMENT 'Sort Order',
  `ref_active_status_id` int(11) NOT NULL COMMENT 'Status',
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dashboard_block`
--

INSERT INTO `dashboard_block` (`dashboard_block_id`, `dashboard_block_name`, `dashboard_block_key`, `column_width`, `sort_order`, `ref_active_status_id`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(5, 'general_reminder', 'reminder', 12, 6, 1, 0, 0, 0, '0000-00-00 00:00:00'),
(9, 'user_activity', 'useractivity', 6, 11, 1, 0, 0, 0, '0000-00-00 00:00:00'),
(10, 'user_online', 'useronline', 6, 12, 1, 0, 0, 0, '0000-00-00 00:00:00'),
(13, 'reminder_calendar', 'reminder', 12, 1, 2, 1, 0, 0, '2018-11-14 17:11:32'),
(19, 'lead_reminder', 'lead_reminder', 12, 1, 1, 1, 1, 0, '2018-07-05 18:14:36'),
(20, 'client_reminder', 'client_reminder', 12, 1, 1, 1, 0, 0, '2018-07-05 18:14:30'),
(21, 'client_visit_reminder', 'client_visit_reminder', 12, 1, 1, 1, 0, 0, '2018-07-06 15:55:40'),
(22, 'client_visit_comment', 'client_visit_comment', 8, 2, 1, 1, 0, 0, '2018-08-02 06:12:12'),
(23, 'product_feedback_reminder', 'product_feedback_reminder', 12, 1, 1, 1, 0, 0, '2018-07-31 09:31:21'),
(24, 'client_outstanding_reminder', 'client_outstanding_reminder', 12, 1, 1, 1, 0, 0, '2018-08-20 16:41:03'),
(25, 'pending_proforma', 'pending_proforma', 12, 2, 1, 1, 0, 0, '2018-11-22 13:31:45');

-- --------------------------------------------------------

--
-- Table structure for table `data_source`
--

CREATE TABLE `data_source` (
  `data_source_id` int(11) NOT NULL,
  `data_source_name` varchar(50) NOT NULL COMMENT 'Data Source',
  `delete_status` int(1) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User Name',
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_source`
--

INSERT INTO `data_source` (`data_source_id`, `data_source_name`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(1, 'Social Media', 0, 1, 0, '2018-06-23 18:26:47'),
(2, 'Mobile', 0, 1, 0, '2018-07-05 18:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_challan`
--

CREATE TABLE `delivery_challan` (
  `delivery_challan_id` int(11) NOT NULL,
  `delivery_challan_name` varchar(50) NOT NULL,
  `ref_product_sample_request_id` int(11) NOT NULL,
  `ref_client_id` int(11) NOT NULL COMMENT 'Client',
  `ref_supplier_id` int(11) NOT NULL COMMENT 'Supplier',
  `delivery_challan_date` date NOT NULL COMMENT 'Date',
  `delivery_challan_no` varchar(25) NOT NULL,
  `delivery_challan_code` varchar(25) NOT NULL COMMENT 'DC No',
  `ref_despatch_mode_id` int(11) NOT NULL COMMENT 'Despatch',
  `ref_delivery_point_id` int(11) NOT NULL COMMENT 'Delivery To',
  `delivery_challan_file` varchar(255) NOT NULL,
  `delivery_challan_details` text NOT NULL,
  `delivery_challan_additional_details` text NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `supplier_email` text NOT NULL,
  `email_additional` text NOT NULL,
  `customer_delivery_challan` int(1) NOT NULL,
  `customer_delivery_challan_date` date NOT NULL,
  `customer_delivery_challan_code` varchar(15) NOT NULL,
  `customer_despatch_mode_id` int(11) NOT NULL,
  `customer_delivery_point_id` int(11) NOT NULL,
  `customer_delivery_challan_file` varchar(255) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_challan`
--

INSERT INTO `delivery_challan` (`delivery_challan_id`, `delivery_challan_name`, `ref_product_sample_request_id`, `ref_client_id`, `ref_supplier_id`, `delivery_challan_date`, `delivery_challan_no`, `delivery_challan_code`, `ref_despatch_mode_id`, `ref_delivery_point_id`, `delivery_challan_file`, `delivery_challan_details`, `delivery_challan_additional_details`, `email_subject`, `supplier_email`, `email_additional`, `customer_delivery_challan`, `customer_delivery_challan_date`, `customer_delivery_challan_code`, `customer_despatch_mode_id`, `customer_delivery_point_id`, `customer_delivery_challan_file`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(11, '', 13, 8, 28, '2018-12-11', '', '5', 3, 1, 'uploads/delivery_challan/5_1545715651.pdf', 'Dear Sir,\n\nRe:AUTOTEX Make Autoclean Roller BTA -Samples-Reg:-\n\nRef: Discussion had with our Mr.K.Ragavendran -Sales Manager\n\n\n\nWith reference to the above, we are sending herewith the following samples for youe trial and approval.\n\n\n\n', '', '', '', '', 0, '0000-00-00', '', 0, 0, '', 3, 0, 0, '2018-12-25 10:57:31'),
(41, '', 37, 3, 22, '2019-01-18', '', '80', 3, 2, 'uploads/delivery_challan/S_80_1547904356.pdf', 'Dear Sir,\n\nRE: PRECITEX SYNTHETIC RUBBER COTS -SAMPLES -REG:-\n\n                            ***************\n\nWith reference to the above, we are sending herewith the following samples for your trail and approval.\n\n', '', '', '', '', 1, '2019-01-18', '80', 3, 2, 'uploads/delivery_challan/80_1547904357.pdf', 3, 0, 0, '2019-01-19 18:55:56'),
(45, '', 37, 3, 22, '2019-01-19', '', '80', 3, 2, 'uploads/delivery_challan/S_80_1547905069.pdf', 'Dear Sir,\n\nRE: PRECITEX SYNTHETIC RUBBER COTS -SAMPLES -REG:-\n\n***************\n\nWith reference to the above, we are sending herewith the following samples for your trail and approval.\n\n', '', '', '', '', 1, '2019-01-19', '80', 3, 2, 'uploads/delivery_challan/80_1547905069.pdf', 3, 0, 0, '2019-01-19 19:07:48'),
(64, '', 42, 3, 22, '2019-02-15', '', '12547', 3, 2, 'uploads/delivery_challan/S_12547_1550236958.pdf', 'Kind Attn: Sri. A.S. Senthilkumar - ED\n\n\n\nDear Sir,\n\nRe: PRECITEX SYNTHETICSRUBBER APRONS -SAMPLE-REG:-\n\nRef: Discussion had with our Mr.B.S.Selvaraj - Sales Manager.\n\n                                       **************\n\nWith reference to the above, we are sending herewith the following samples for your trail and approval\n\n', '', '', '', '', 1, '2019-02-15', '1257', 3, 2, 'uploads/delivery_challan/1257_1550236959.pdf', 3, 0, 0, '2019-02-15 18:52:38'),
(65, '', 42, 3, 22, '2019-02-15', '', '1257', 3, 2, 'uploads/delivery_challan/S_1257_1550237519.pdf', 'Kind Attn: Sri. A.S. Senthilkumar - ED\n\n\n\nDear Sir,\n\nRe: PRECITEX SYNTHETICSRUBBER APRONS & COTS -SAMPLE-REG:-\n\nRef: Discussion had with our Mr.B.S.Selvaraj - Sales Manager.\n\n**************\n\nWith reference to the above, we are sending herewith the following samples for your trail and approval\n\n', '', '', '', '', 1, '2019-02-15', '1257', 3, 2, 'uploads/delivery_challan/1257_1550237520.pdf', 3, 0, 0, '2019-02-15 19:01:59'),
(74, '', 59, 2, 38, '2019-03-18', '', '546', 3, 2, 'uploads/delivery_challan/S_546_1552914257.pdf', 'Kind Attn: Mr.Ganeshan -GM\n\n\n\nDear Sir,\n\nRe: VXL MAKE RINGS BLACKJET -SAMPLE-REG:-\n\nRef: Discussion had with our MD  Mr. S.Kuppuswami \n\n                                 *************\n\nWith reference to the above, we are sending herewith the following samples for your trail and approval.\n\n\n\n', '', '', '', '', 1, '2019-03-18', '546', 3, 2, 'uploads/delivery_challan/546_1552914260.pdf', 3, 0, 0, '2019-03-18 18:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_challan_particulars`
--

CREATE TABLE `delivery_challan_particulars` (
  `delivery_challan_particulars_id` int(11) NOT NULL,
  `ref_delivery_challan_id` int(11) NOT NULL,
  `ref_product_id` int(11) NOT NULL,
  `ref_product_quality_id` int(11) NOT NULL,
  `ref_product_quality_size_id` int(11) NOT NULL,
  `ref_product_variety_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_challan_particulars`
--

INSERT INTO `delivery_challan_particulars` (`delivery_challan_particulars_id`, `ref_delivery_challan_id`, `ref_product_id`, `ref_product_quality_id`, `ref_product_quality_size_id`, `ref_product_variety_id`, `qty`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 1, 23, 245, 184, 0, 100, 0, 0, 0, '2018-11-12 12:10:52'),
(2, 2, 35, 0, 745, 0, 150, 0, 0, 0, '2018-11-26 18:06:34'),
(3, 3, 35, 0, 745, 0, 150, 0, 0, 0, '2018-11-27 15:56:36'),
(4, 4, 21, 218, 31, 0, 50, 0, 1, 0, '2018-12-06 18:47:26'),
(5, 4, 21, 219, 31, 0, 50, 0, 1, 0, '2018-12-06 18:47:26'),
(6, 4, 21, 218, 54, 0, 50, 0, 1, 0, '2018-12-06 18:47:26'),
(7, 4, 21, 218, 16, 0, 50, 0, 1, 0, '2018-12-06 18:47:26'),
(8, 5, 21, 218, 31, 0, 50, 0, 1, 0, '2018-12-06 18:54:51'),
(9, 5, 21, 219, 31, 0, 50, 0, 1, 0, '2018-12-06 18:54:51'),
(10, 5, 21, 218, 54, 0, 50, 0, 1, 0, '2018-12-06 18:54:51'),
(11, 5, 21, 218, 16, 0, 50, 0, 1, 0, '2018-12-06 18:54:51'),
(12, 6, 21, 218, 31, 0, 50, 0, 0, 0, '2018-12-06 18:58:01'),
(13, 6, 21, 219, 31, 0, 50, 0, 0, 0, '2018-12-06 18:58:01'),
(14, 6, 21, 218, 54, 0, 50, 0, 0, 0, '2018-12-06 18:58:01'),
(15, 6, 21, 218, 16, 0, 50, 0, 0, 0, '2018-12-06 18:58:01'),
(16, 7, 21, 226, 31, 0, 24, 0, 0, 0, '2018-12-07 17:43:32'),
(17, 7, 21, 219, 31, 0, 24, 0, 0, 0, '2018-12-07 17:43:32'),
(18, 8, 47, 321, 0, 0, 50, 0, 0, 0, '2018-12-24 17:49:13'),
(19, 8, 47, 322, 0, 0, 50, 0, 0, 0, '2018-12-24 17:49:13'),
(20, 9, 47, 322, 0, 0, 5, 0, 0, 0, '2018-12-25 10:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(50) NOT NULL COMMENT 'Designation',
  `delete_status` int(1) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User Name',
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(1, 'HR', 1, 3, 0, '2015-10-30 12:16:55'),
(2, 'MD', 0, 3, 0, '2015-10-30 12:17:12'),
(3, 'Secretary', 1, 3, 0, '2015-11-17 14:51:48'),
(5, 'Office Staff', 1, 3, 0, '2015-11-19 16:49:39'),
(13, 'FACTORY MANAGER', 0, 3, 0, '2018-11-19 15:46:35'),
(14, 'Marketing', 1, 3, 0, '2018-09-03 12:48:52'),
(15, 'STORE KEEPER', 0, 3, 0, '2018-09-19 17:24:51'),
(16, 'PURCHASE MANAGER', 0, 3, 0, '2018-09-22 18:02:02'),
(17, 'DIRECTOR', 0, 3, 0, '2018-11-19 15:45:57'),
(18, 'VP', 0, 3, 0, '2018-11-17 11:44:20'),
(19, 'SPINNING MASTER', 0, 3, 0, '2018-11-19 15:46:49'),
(20, 'MAINTENANCE INCHARGE', 0, 3, 0, '2018-11-19 15:49:03'),
(21, 'ADVISOR', 0, 3, 0, '2018-11-19 15:59:25'),
(22, 'GENERAL MANAGER', 0, 3, 0, '2018-11-19 16:21:40'),
(23, 'JMD', 0, 3, 0, '2018-11-23 17:06:04'),
(24, 'AMD', 0, 3, 0, '2018-11-23 17:06:11'),
(25, 'DGM', 0, 3, 0, '2018-11-23 17:06:15'),
(26, 'GM', 0, 3, 0, '2018-11-23 18:24:52'),
(27, 'ED', 0, 3, 0, '2018-11-23 18:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `despatch_mode`
--

CREATE TABLE `despatch_mode` (
  `despatch_mode_id` int(11) NOT NULL,
  `despatch_mode_name` varchar(100) NOT NULL COMMENT 'Despatch Mode',
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `despatch_mode`
--

INSERT INTO `despatch_mode` (`despatch_mode_id`, `despatch_mode_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'SMT', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'SVT', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'COURIER', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `discount_type`
--

CREATE TABLE `discount_type` (
  `discount_type_id` int(11) NOT NULL,
  `discount_type_name` varchar(10) NOT NULL COMMENT 'Discount Type',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount_type`
--

INSERT INTO `discount_type` (`discount_type_id`, `discount_type_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, '%', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Flat', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `ref_state_id` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_name`, `ref_state_id`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Nicobar', 1475, 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'North and Middle Andaman', 1475, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'South Andaman', 1475, 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'Anantapur', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(5, 'Chittoor', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(6, 'Cuddapah', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(7, 'East Godavari', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(8, 'Guntur', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(9, 'Krishna', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(10, 'Kurnool', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(11, 'Nellore', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(12, 'Prakasam', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(13, 'Srikakulam', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(14, 'Visakhapatnam', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(15, 'Vizianagaram', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(16, 'West Godavari', 1476, 0, 0, 0, '0000-00-00 00:00:00'),
(17, 'Anjaw', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(18, 'Changlang', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(19, 'Dibang Valley', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(20, 'East Kameng', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(21, 'East Siang', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(22, 'Kurung Kumey', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(23, 'Lohit', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(24, 'Longding', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(25, 'Lower Dibang Valley', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(26, 'Lower Subansiri', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(27, 'Papum Pare', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(28, 'Tawang', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(29, 'Tirap', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(30, 'Upper Siang', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(31, 'Upper Subansiri', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(32, 'West Kameng', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(33, 'West Siang', 1477, 0, 0, 0, '0000-00-00 00:00:00'),
(34, 'Baksa', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(35, 'Barpeta', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(36, 'Bongaigaon', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(37, 'Cachar', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(38, 'Chirang', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(39, 'Darrang', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(40, 'Dhemaji', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(41, 'Dhubri', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(42, 'Dibrugarh', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(43, 'Dima Hasao', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(44, 'Goalpara', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(45, 'Golaghat', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(46, 'Hailakandi', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(47, 'Jorhat', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(48, 'Kamrup Metropolitan', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(49, 'Kamrup', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(50, 'Karbi Anglong', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(51, 'Karimganj', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(52, 'Kokrajhar', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(53, 'Lakhimpur', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(54, 'Morigaon', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(55, 'Nagaon', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(56, 'Nalbari', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(57, 'Sivasagar', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(58, 'Sonitpur', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(59, 'Tinsukia', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(60, 'Udalguri', 1478, 0, 0, 0, '0000-00-00 00:00:00'),
(61, 'Araria', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(62, 'Arwal', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(63, 'Aurangabad', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(64, 'Banka', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(65, 'Begusarai', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(66, 'Bhagalpur', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(67, 'Bhojpur', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(68, 'Buxar', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(69, 'Darbhanga', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(70, 'East Champaran (Motihari)', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(71, 'Gaya', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(72, 'Gopalganj', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(73, 'Jamui', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(74, 'Jehanabad', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(75, 'Kaimur (Bhabua)', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(76, 'Katihar', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(77, 'Khagaria', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(78, 'Kishanganj', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(79, 'Lakhisarai', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(80, 'Madhepura', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(81, 'Madhubani', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(82, 'Munger (Monghyr)', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(83, 'Muzaffarpur', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(84, 'Nalanda', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(85, 'Nawada', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(86, 'Patna', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(87, 'Purnia (Purnea)', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(88, 'Rohtas', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(89, 'Saharsa', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(90, 'Samastipur', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(91, 'Saran', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(92, 'Sheikhpura', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(93, 'Sheohar', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(94, 'Sitamarhi', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(95, 'Siwan', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(96, 'Supaul', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(97, 'Vaishali', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(98, 'West Champaran', 1479, 0, 0, 0, '0000-00-00 00:00:00'),
(99, 'Chandigarh', 1480, 0, 0, 0, '0000-00-00 00:00:00'),
(100, 'Balod', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(101, 'Baloda Bazar', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(102, 'Balrampur', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(103, 'Bastar', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(104, 'Bemetara', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(105, 'Bijapur', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(106, 'Bilaspur', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(107, 'Dantewada (South Bastar)', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(108, 'Dhamtari', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(109, 'Durg', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(110, 'Gariaband', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(111, 'Janjgir-Champa', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(112, 'Jashpur', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(113, 'Kabirdham (Kawardha)', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(114, 'Kanker (North Bastar)', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(115, 'Kondagaon', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(116, 'Korba', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(117, 'Korea (Koriya)', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(118, 'Mahasamund', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(119, 'Mungeli', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(120, 'Narayanpur', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(121, 'Raigarh', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(122, 'Raipur', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(123, 'Rajnandgaon', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(124, 'Sukma', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(125, 'Surajpur', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(126, 'Surguja', 7, 0, 0, 0, '0000-00-00 00:00:00'),
(127, 'Dadra & Nagar Haveli', 1481, 0, 0, 0, '0000-00-00 00:00:00'),
(128, 'Daman', 1482, 0, 0, 0, '0000-00-00 00:00:00'),
(129, 'Diu', 1482, 0, 0, 0, '0000-00-00 00:00:00'),
(130, 'Central Delhi', 1483, 0, 0, 0, '0000-00-00 00:00:00'),
(131, 'East Delhi', 1483, 0, 0, 0, '0000-00-00 00:00:00'),
(132, 'New Delhi', 1483, 0, 0, 0, '0000-00-00 00:00:00'),
(133, 'North Delhi', 1483, 0, 0, 0, '0000-00-00 00:00:00'),
(134, 'North East Delhi', 1483, 0, 0, 0, '0000-00-00 00:00:00'),
(135, 'North West Delhi', 1483, 0, 0, 0, '0000-00-00 00:00:00'),
(136, 'South Delhi', 1483, 0, 0, 0, '0000-00-00 00:00:00'),
(137, 'South West Delhi', 1483, 0, 0, 0, '0000-00-00 00:00:00'),
(138, 'West Delhi', 1483, 0, 0, 0, '0000-00-00 00:00:00'),
(139, 'North Goa', 1484, 0, 0, 0, '0000-00-00 00:00:00'),
(140, 'South Goa', 1484, 0, 0, 0, '0000-00-00 00:00:00'),
(141, 'Ahmedabad', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(142, 'Amreli', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(143, 'Anand', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(144, 'Aravalli', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(145, 'Banaskantha (Palanpur)', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(146, 'Bharuch', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(147, 'Bhavnagar', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(148, 'Botad', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(149, 'Chhota Udepur', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(150, 'Dahod', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(151, 'Dangs (Ahwa)', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(152, 'Devbhoomi Dwarka', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(153, 'Gandhinagar', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(154, 'Gir Somnath', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(155, 'Jamnagar', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(156, 'Junagadh', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(157, 'Kachchh', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(158, 'Kheda (Nadiad)', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(159, 'Mahisagar', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(160, 'Mehsana', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(161, 'Morbi', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(162, 'Narmada (Rajpipla)', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(163, 'Navsari', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(164, 'Panchmahal (Godhra)', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(165, 'Patan', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(166, 'Porbandar', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(167, 'Rajkot', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(168, 'Sabarkantha (Himmatnagar)', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(169, 'Surat', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(170, 'Surendranagar', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(171, 'Tapi (Vyara)', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(172, 'Vadodara', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(173, 'Valsad', 1485, 0, 0, 0, '0000-00-00 00:00:00'),
(174, 'Ambala', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(175, 'Bhiwani', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(176, 'Faridabad', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(177, 'Fatehabad', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(178, 'Gurgaon', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(179, 'Hisar', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(180, 'Jhajjar', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(181, 'Jind', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(182, 'Kaithal', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(183, 'Karnal', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(184, 'Kurukshetra', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(185, 'Mahendragarh', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(186, 'Mewat', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(187, 'Palwal', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(188, 'Panchkula', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(189, 'Panipat', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(190, 'Rewari', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(191, 'Rohtak', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(192, 'Sirsa', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(193, 'Sonipat', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(194, 'Yamunanagar', 1486, 0, 0, 0, '0000-00-00 00:00:00'),
(195, 'Bilaspur', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(196, 'Chamba', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(197, 'Hamirpur', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(198, 'Kangra', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(199, 'Kinnaur', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(200, 'Kullu', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(201, 'Lahaul & Spiti', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(202, 'Mandi', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(203, 'Shimla', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(204, 'Sirmaur (Sirmour)', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(205, 'Solan', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(206, 'Una', 1487, 0, 0, 0, '0000-00-00 00:00:00'),
(207, 'Anantnag', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(208, 'Bandipora', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(209, 'Baramulla', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(210, 'Budgam', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(211, 'Doda', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(212, 'Ganderbal', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(213, 'Jammu', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(214, 'Kargil', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(215, 'Kathua', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(216, 'Kishtwar', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(217, 'Kulgam', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(218, 'Kupwara', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(219, 'Leh', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(220, 'Poonch', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(221, 'Pulwama', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(222, 'Rajouri', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(223, 'Ramban', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(224, 'Reasi', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(225, 'Samba', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(226, 'Shopian', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(227, 'Srinagar', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(228, 'Udhampur', 1488, 0, 0, 0, '0000-00-00 00:00:00'),
(229, 'Bokaro', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(230, 'Chatra', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(231, 'Deoghar', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(232, 'Dhanbad', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(233, 'Dumka', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(234, 'East Singhbhum', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(235, 'Garhwa', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(236, 'Giridih', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(237, 'Godda', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(238, 'Gumla', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(239, 'Hazaribag', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(240, 'Jamtara', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(241, 'Khunti', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(242, 'Koderma', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(243, 'Latehar', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(244, 'Lohardaga', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(245, 'Pakur', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(246, 'Palamu', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(247, 'Ramgarh', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(248, 'Ranchi', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(249, 'Sahibganj', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(250, 'Seraikela-Kharsawan', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(251, 'Simdega', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(252, 'West Singhbhum', 16, 0, 0, 0, '0000-00-00 00:00:00'),
(253, 'Bagalkot', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(254, 'Bangalore Rural', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(255, 'Bangalore Urban', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(256, 'Belgaum', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(257, 'Bellary', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(258, 'Bidar', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(259, 'Bijapur', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(260, 'Chamarajanagar', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(261, 'Chickmagalur', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(262, 'Chikballapur', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(263, 'Chitradurga', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(264, 'Dakshina Kannada', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(265, 'Davangere', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(266, 'Dharwad', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(267, 'Gadag', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(268, 'Gulbarga', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(269, 'Hassan', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(270, 'Haveri', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(271, 'Kodagu', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(272, 'Kolar', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(273, 'Koppal', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(274, 'Mandya', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(275, 'Mysore', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(276, 'Raichur', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(277, 'Ramnagara', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(278, 'Shimoga', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(279, 'Tumkur', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(280, 'Udupi', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(281, 'Uttara Kannada (Karwar)', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(282, 'Yadgir', 1489, 0, 0, 0, '0000-00-00 00:00:00'),
(283, 'Alappuzha', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(284, 'Ernakulam', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(285, 'Idukki', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(286, 'Kannur', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(287, 'Kasaragod', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(288, 'Kollam', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(289, 'Kottayam', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(290, 'Kozhikode', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(291, 'Malappuram', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(292, 'Palakkad', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(293, 'Pathanamthitta', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(294, 'Thiruvananthapuram', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(295, 'Thrissur', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(296, 'Wayanad', 1490, 0, 0, 0, '0000-00-00 00:00:00'),
(297, 'Lakshadweep', 1491, 0, 0, 0, '0000-00-00 00:00:00'),
(298, 'Alirajpur', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(299, 'Anuppur', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(300, 'Ashoknagar', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(301, 'Balaghat', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(302, 'Barwani', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(303, 'Betul', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(304, 'Bhind', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(305, 'Bhopal', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(306, 'Burhanpur', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(307, 'Chhatarpur', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(308, 'Chhindwara', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(309, 'Damoh', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(310, 'Datia', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(311, 'Dewas', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(312, 'Dhar', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(313, 'Dindori', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(314, 'Guna', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(315, 'Gwalior', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(316, 'Harda', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(317, 'Hoshangabad', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(318, 'Indore', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(319, 'Jabalpur', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(320, 'Jhabua', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(321, 'Katni', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(322, 'Khandwa', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(323, 'Khargone', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(324, 'Mandla', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(325, 'Mandsaur', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(326, 'Morena', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(327, 'Narsinghpur', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(328, 'Neemuch', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(329, 'Panna', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(330, 'Raisen', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(331, 'Rajgarh', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(332, 'Ratlam', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(333, 'Rewa', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(334, 'Sagar', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(335, 'Satna', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(336, 'Sehore', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(337, 'Seoni', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(338, 'Shahdol', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(339, 'Shajapur', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(340, 'Sheopur', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(341, 'Shivpuri', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(342, 'Sidhi', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(343, 'Singrauli', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(344, 'Tikamgarh', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(345, 'Ujjain', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(346, 'Umaria', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(347, 'Vidisha', 1492, 0, 0, 0, '0000-00-00 00:00:00'),
(348, 'Ahmednagar', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(349, 'Akola', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(350, 'Amravati', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(351, 'Aurangabad', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(352, 'Beed', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(353, 'Bhandara', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(354, 'Buldhana', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(355, 'Chandrapur', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(356, 'Dhule', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(357, 'Gadchiroli', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(358, 'Gondia', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(359, 'Hingoli', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(360, 'Jalgaon', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(361, 'Jalna', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(362, 'Kolhapur', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(363, 'Latur', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(364, 'Mumbai City', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(365, 'Mumbai Suburban', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(366, 'Nagpur', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(367, 'Nanded', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(368, 'Nandurbar', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(369, 'Nashik', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(370, 'Osmanabad', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(371, 'Parbhani', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(372, 'Pune', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(373, 'Raigad', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(374, 'Ratnagiri', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(375, 'Sangli', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(376, 'Satara', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(377, 'Sindhudurg', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(378, 'Solapur', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(379, 'Thane', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(380, 'Wardha', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(381, 'Washim', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(382, 'Yavatmal', 1493, 0, 0, 0, '0000-00-00 00:00:00'),
(383, 'Bishnupur', 1494, 0, 0, 0, '0000-00-00 00:00:00'),
(384, 'Chandel', 1494, 0, 0, 0, '0000-00-00 00:00:00'),
(385, 'Churachandpur', 1494, 0, 0, 0, '0000-00-00 00:00:00'),
(386, 'Imphal East', 1494, 0, 0, 0, '0000-00-00 00:00:00'),
(387, 'Imphal West', 1494, 0, 0, 0, '0000-00-00 00:00:00'),
(388, 'Senapati', 1494, 0, 0, 0, '0000-00-00 00:00:00'),
(389, 'Tamenglong', 1494, 0, 0, 0, '0000-00-00 00:00:00'),
(390, 'Thoubal', 1494, 0, 0, 0, '0000-00-00 00:00:00'),
(391, 'Ukhrul', 1494, 0, 0, 0, '0000-00-00 00:00:00'),
(392, 'East Garo Hills', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(393, 'East Jaintia Hills', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(394, 'East Khasi Hills', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(395, 'North Garo Hills', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(396, 'Ri Bhoi', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(397, 'South Garo Hills', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(398, 'South West Garo Hills', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(399, 'South West Khasi Hills', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(400, 'West Garo Hills', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(401, 'West Jaintia Hills', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(402, 'West Khasi Hills', 1495, 0, 0, 0, '0000-00-00 00:00:00'),
(403, 'Aizawl', 1496, 0, 0, 0, '0000-00-00 00:00:00'),
(404, 'Champhai', 1496, 0, 0, 0, '0000-00-00 00:00:00'),
(405, 'Kolasib', 1496, 0, 0, 0, '0000-00-00 00:00:00'),
(406, 'Lawngtlai', 1496, 0, 0, 0, '0000-00-00 00:00:00'),
(407, 'Lunglei', 1496, 0, 0, 0, '0000-00-00 00:00:00'),
(408, 'Mamit', 1496, 0, 0, 0, '0000-00-00 00:00:00'),
(409, 'Saiha', 1496, 0, 0, 0, '0000-00-00 00:00:00'),
(410, 'Serchhip', 1496, 0, 0, 0, '0000-00-00 00:00:00'),
(411, 'Dimapur', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(412, 'Kiphire', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(413, 'Kohima', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(414, 'Longleng', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(415, 'Mokokchung', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(416, 'Mon', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(417, 'Peren', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(418, 'Phek', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(419, 'Tuensang', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(420, 'Wokha', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(421, 'Zunheboto', 1497, 0, 0, 0, '0000-00-00 00:00:00'),
(422, 'Angul', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(423, 'Balangir', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(424, 'Balasore', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(425, 'Bargarh', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(426, 'Bhadrak', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(427, 'Boudh', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(428, 'Cuttack', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(429, 'Deogarh', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(430, 'Dhenkanal', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(431, 'Gajapati', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(432, 'Ganjam', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(433, 'Jagatsinghapur', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(434, 'Jajpur', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(435, 'Jharsuguda', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(436, 'Kalahandi', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(437, 'Kandhamal', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(438, 'Kendrapara', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(439, 'Kendujhar (Keonjhar)', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(440, 'Khordha', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(441, 'Koraput', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(442, 'Malkangiri', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(443, 'Mayurbhanj', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(444, 'Nabarangpur', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(445, 'Nayagarh', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(446, 'Nuapada', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(447, 'Puri', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(448, 'Rayagada', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(449, 'Sambalpur', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(450, 'Sonepur', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(451, 'Sundargarh', 1498, 0, 0, 0, '0000-00-00 00:00:00'),
(452, 'Karaikal', 1499, 0, 0, 0, '0000-00-00 00:00:00'),
(453, 'Mahe', 1499, 0, 0, 0, '0000-00-00 00:00:00'),
(454, 'Pondicherry', 1499, 0, 0, 0, '0000-00-00 00:00:00'),
(455, 'Yanam', 1499, 0, 0, 0, '0000-00-00 00:00:00'),
(456, 'Amritsar', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(457, 'Barnala', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(458, 'Bathinda', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(459, 'Faridkot', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(460, 'Fatehgarh Sahib', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(461, 'Fazilka', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(462, 'Ferozepur', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(463, 'Gurdaspur', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(464, 'Hoshiarpur', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(465, 'Jalandhar', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(466, 'Kapurthala', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(467, 'Ludhiana', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(468, 'Mansa', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(469, 'Moga', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(470, 'Muktsar', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(471, 'Nawanshahr', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(472, 'Pathankot', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(473, 'Patiala', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(474, 'Rupnagar', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(475, 'Sangrur', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(476, 'SAS Nagar (Mohali)', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(477, 'Tarn Taran', 1500, 0, 0, 0, '0000-00-00 00:00:00'),
(478, 'Ajmer', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(479, 'Alwar', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(480, 'Banswara', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(481, 'Baran', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(482, 'Barmer', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(483, 'Bharatpur', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(484, 'Bhilwara', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(485, 'Bikaner', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(486, 'Bundi', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(487, 'Chittorgarh', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(488, 'Churu', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(489, 'Dausa', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(490, 'Dholpur', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(491, 'Dungarpur', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(492, 'Hanumangarh', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(493, 'Jaipur', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(494, 'Jaisalmer', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(495, 'Jalore', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(496, 'Jhalawar', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(497, 'Jhunjhunu', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(498, 'Jodhpur', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(499, 'Karauli', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(500, 'Kota', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(501, 'Nagaur', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(502, 'Pali', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(503, 'Pratapgarh', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(504, 'Rajsamand', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(505, 'Sawai Madhopur', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(506, 'Sikar', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(507, 'Sirohi', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(508, 'Sri Ganganagar', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(509, 'Tonk', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(510, 'Udaipur', 1501, 0, 0, 0, '0000-00-00 00:00:00'),
(511, 'East Sikkim', 1502, 0, 0, 0, '0000-00-00 00:00:00'),
(512, 'North Sikkim', 1502, 0, 0, 0, '0000-00-00 00:00:00'),
(513, 'South Sikkim', 1502, 0, 0, 0, '0000-00-00 00:00:00'),
(514, 'West Sikkim', 1502, 0, 0, 0, '0000-00-00 00:00:00'),
(515, 'Ariyalur', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(516, 'Chennai', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(517, 'Coimbatore', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(518, 'Cuddalore', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(519, 'Dharmapuri', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(520, 'Dindigul', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(521, 'Erode', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(522, 'Kanchipuram', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(523, 'Kanyakumari', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(524, 'Karur', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(525, 'Krishnagiri', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(526, 'Madurai', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(527, 'Nagapattinam', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(528, 'Namakkal', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(529, 'Nilgiris', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(530, 'Perambalur', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(531, 'Pudukkottai', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(532, 'Ramanathapuram', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(533, 'Salem', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(534, 'Sivaganga', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(535, 'Thanjavur', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(536, 'Theni', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(537, 'Thoothukudi (Tuticorin)', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(538, 'Tiruchirappalli', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(539, 'Tirunelveli', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(540, 'Tiruppur', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(541, 'Tiruvallur', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(542, 'Tiruvannamalai', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(543, 'Tiruvarur', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(544, 'Vellore', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(545, 'Viluppuram', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(546, 'Virudhunagar', 1503, 0, 0, 0, '0000-00-00 00:00:00'),
(547, 'Adilabad', 32, 0, 0, 0, '0000-00-00 00:00:00'),
(548, 'Hyderabad', 32, 0, 0, 0, '0000-00-00 00:00:00'),
(549, 'Karimnagar', 32, 0, 0, 0, '0000-00-00 00:00:00'),
(550, 'Khammam', 32, 0, 0, 0, '0000-00-00 00:00:00'),
(551, 'Mahabubnagar', 32, 0, 0, 0, '0000-00-00 00:00:00'),
(552, 'Medak', 32, 0, 0, 0, '0000-00-00 00:00:00'),
(553, 'Nalgonda', 32, 0, 0, 0, '0000-00-00 00:00:00'),
(554, 'Nizamabad', 32, 0, 0, 0, '0000-00-00 00:00:00'),
(555, 'Rangareddy', 32, 0, 0, 0, '0000-00-00 00:00:00'),
(556, 'Warangal', 32, 0, 0, 0, '0000-00-00 00:00:00'),
(557, 'Dhalai', 1504, 0, 0, 0, '0000-00-00 00:00:00'),
(558, 'Gomati', 1504, 0, 0, 0, '0000-00-00 00:00:00'),
(559, 'Khowai', 1504, 0, 0, 0, '0000-00-00 00:00:00'),
(560, 'North Tripura', 1504, 0, 0, 0, '0000-00-00 00:00:00'),
(561, 'Sepahijala', 1504, 0, 0, 0, '0000-00-00 00:00:00'),
(562, 'South Tripura', 1504, 0, 0, 0, '0000-00-00 00:00:00'),
(563, 'Unakoti', 1504, 0, 0, 0, '0000-00-00 00:00:00'),
(564, 'West Tripura', 1504, 0, 0, 0, '0000-00-00 00:00:00'),
(565, 'Agra', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(566, 'Aligarh', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(567, 'Allahabad', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(568, 'Ambedkar Nagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(569, 'Auraiya', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(570, 'Azamgarh', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(571, 'Baghpat', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(572, 'Bahraich', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(573, 'Ballia', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(574, 'Balrampur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(575, 'Banda', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(576, 'Barabanki', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(577, 'Bareilly', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(578, 'Basti', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(579, 'Bhim Nagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(580, 'Bijnor', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(581, 'Budaun', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(582, 'Bulandshahr', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(583, 'Chandauli', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(584, 'Chatrapati Sahuji Mahraj Nagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(585, 'Chitrakoot', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(586, 'Deoria', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(587, 'Etah', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(588, 'Etawah', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(589, 'Faizabad', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(590, 'Farrukhabad', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(591, 'Fatehpur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(592, 'Firozabad', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(593, 'Gautam Buddha Nagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(594, 'Ghaziabad', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(595, 'Ghazipur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(596, 'Gonda', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(597, 'Gorakhpur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(598, 'Hamirpur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(599, 'Hardoi', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(600, 'Hathras', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(601, 'Jalaun', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(602, 'Jaunpur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(603, 'Jhansi', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(604, 'Jyotiba Phule Nagar (J.P. Nagar)', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(605, 'Kannauj', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(606, 'Kanpur Dehat', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(607, 'Kanpur Nagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(608, 'Kanshiram Nagar (Kasganj)', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(609, 'Kaushambi', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(610, 'Kushinagar (Padrauna)', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(611, 'Lakhimpur - Kheri', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(612, 'Lalitpur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(613, 'Lucknow', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(614, 'Maharajganj', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(615, 'Mahoba', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(616, 'Mainpuri', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(617, 'Mathura', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(618, 'Mau', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(619, 'Meerut', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(620, 'Mirzapur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(621, 'Moradabad', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(622, 'Muzaffarnagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(623, 'Panchsheel Nagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(624, 'Pilibhit', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(625, 'Prabuddh Nagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(626, 'Pratapgarh', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(627, 'RaeBareli', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(628, 'Rampur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(629, 'Saharanpur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(630, 'Sant Kabir Nagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(631, 'Sant Ravidas Nagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(632, 'Shahjahanpur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(633, 'Shravasti', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(634, 'Siddharth Nagar', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(635, 'Sitapur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(636, 'Sonbhadra', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(637, 'Sultanpur', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(638, 'Unnao', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(639, 'Varanasi', 1505, 0, 0, 0, '0000-00-00 00:00:00'),
(640, 'Almora', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(641, 'Bageshwar', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(642, 'Chamoli', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(643, 'Champawat', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(644, 'Dehradun', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(645, 'Haridwar', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(646, 'Nainital', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(647, 'Pauri Garhwal', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(648, 'Pithoragarh', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(649, 'Rudraprayag', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(650, 'Tehri Garhwal', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(651, 'Udham Singh Nagar', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(652, 'Uttarkashi', 35, 0, 0, 0, '0000-00-00 00:00:00'),
(653, 'Bankura', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(654, 'Birbhum', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(655, 'Burdwan (Bardhaman)', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(656, 'Cooch Behar', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(657, 'Dakshin Dinajpur (South Dinajpur)', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(658, 'Darjeeling', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(659, 'Hooghly', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(660, 'Howrah', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(661, 'Jalpaiguri', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(662, 'Kolkata', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(663, 'Malda', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(664, 'Murshidabad', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(665, 'Nadia', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(666, 'North 24 Parganas', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(667, 'Paschim Medinipur (West Medinipur)', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(668, 'Purba Medinipur (East Medinipur)', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(669, 'Purulia', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(670, 'South 24 Parganas', 1506, 0, 0, 0, '0000-00-00 00:00:00'),
(671, 'Uttar Dinajpur (North Dinajpur)', 1506, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `enquiry_id` int(11) NOT NULL,
  `enquiry_type` enum('Website','Mobile') NOT NULL,
  `name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `course_interested` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`enquiry_id`, `enquiry_type`, `name`, `father_name`, `mobile`, `email`, `address`, `course_interested`, `subject`, `message`, `added_date`) VALUES
(1, '', 'asd', '', 0, 'asdasd@sadasd.com', '', '', '0', '', '2020-07-18 12:23:35'),
(2, '', 'asd', '', 98789678678678, 'asdasd@sadasd.com', '', '', 'asdas', 'asda', '2020-07-18 12:24:55'),
(3, 'Website', 'asd', '', 98789678678678, 'asdasd@sadasd.com', '', '', 'asdas', 'asda', '2020-07-18 12:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `filter_opration`
--

CREATE TABLE `filter_opration` (
  `filter_opration_id` int(11) NOT NULL,
  `filter_operation_details` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filter_opration`
--

INSERT INTO `filter_opration` (`filter_opration_id`, `filter_operation_details`) VALUES
(1, 'LIKE %...%'),
(2, 'LIKE'),
(3, 'NOT LIKE'),
(4, '!='),
(5, '=');

-- --------------------------------------------------------

--
-- Table structure for table `general_reminder`
--

CREATE TABLE `general_reminder` (
  `general_reminder_id` int(11) NOT NULL,
  `general_reminder_name` varchar(50) NOT NULL,
  `general_reminder_details` varchar(255) NOT NULL COMMENT 'Reminder Details',
  `assigned_user_id` int(11) NOT NULL,
  `ref_priority_id` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `ref_status_id` int(1) NOT NULL,
  `added_date` datetime NOT NULL,
  `assigned_date` datetime NOT NULL,
  `completed_date` datetime NOT NULL,
  `reference_link` varchar(255) NOT NULL,
  `reference_file` varchar(255) NOT NULL,
  `file_update_status` varchar(10) NOT NULL,
  `view_status` int(1) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_reminder`
--

INSERT INTO `general_reminder` (`general_reminder_id`, `general_reminder_name`, `general_reminder_details`, `assigned_user_id`, `ref_priority_id`, `ref_user_id`, `ref_status_id`, `added_date`, `assigned_date`, `completed_date`, `reference_link`, `reference_file`, `file_update_status`, `view_status`, `delete_status`, `transaction_id`) VALUES
(1, '', 'Test Reminder', 19, 3, 19, 2, '2018-12-20 10:31:51', '2017-09-14 07:21:00', '2017-09-14 11:51:00', '', '', '', 1, 1, 0),
(2, '', 'Test Reminder', 25, 3, 1, 1, '2017-09-14 07:23:18', '2017-09-14 07:21:43', '2017-09-14 11:51:00', '', '', '1', 1, 0, 1),
(3, '', 'Test File', 25, 2, 25, 1, '2017-09-14 07:26:14', '2017-09-14 07:24:12', '2017-09-15 11:54:00', '', '14-09-2017_pdf.pdf', '1', 1, 1, 0),
(4, '', 'Test Reminder', 25, 3, 1, 1, '2017-09-14 07:25:05', '2017-09-14 07:21:00', '2017-09-14 11:51:00', '', '', '1', 1, 0, 1),
(5, '', 'Reminder To Admin Test', 28, 2, 1, 3, '2018-04-03 12:52:06', '2017-09-14 07:27:31', '2017-09-15 11:57:00', 'www.fabriclore.com/pages/fab-look-book', '14-09-2017_suucess_story_2.jpg', '1', 1, 1, 0),
(6, '', 'test', 3, 2, 1, 1, '2018-07-17 14:23:32', '2018-07-18 18:52:00', '2018-07-19 18:52:00', 'link', '17-07-2018_3551845.jpg', '1', 1, 1, 0),
(7, '', 'Test Reminder', 25, 3, 1, 1, '2018-11-14 17:12:32', '2017-09-14 07:21:00', '2017-09-14 11:51:00', '', '14-09-2017_suucess_story_1.jpg', '1', 1, 0, 1),
(8, '', 'Sri spinning mill order and payment ,received', 21, 3, 21, 3, '2019-01-07 17:59:17', '2018-11-19 10:00:00', '2018-11-19 10:00:00', '', '', '', 1, 1, 0),
(9, '', 'Rajaguru Cots Order', 17, 3, 1, 3, '2018-12-13 13:36:43', '2018-11-19 12:20:19', '2018-11-30 12:20:00', '', '', '', 1, 1, 0),
(10, '', 'Pl follow \n\nHarikrishna\n\nNallathal \n\nSankari spintex for Arons and cots order', 17, 3, 17, 1, '2018-11-30 14:35:30', '2018-11-20 11:15:16', '2018-11-30 11:15:00', '', '', '', 1, 1, 0),
(11, '', 'Kutti spg mills compact cots schedule ', 17, 3, 16, 1, '2019-02-08 13:42:46', '2018-12-19 14:57:00', '2019-04-01 14:57:00', '', '', '', 1, 1, 0),
(12, '', 'Sri spinning mill order and payment ', 21, 3, 21, 3, '2019-01-07 17:59:17', '2018-11-19 10:00:00', '2018-11-19 10:00:00', '', '', '', 1, 0, 8),
(13, '', 'Kumaragiri Spg mills Spg Bobbin Order', 17, 3, 16, 1, '2019-02-08 14:18:50', '2019-02-08 14:17:00', '2019-02-10 14:17:00', '', '', '', 1, 1, 0),
(14, '', 'Spg Bobbin Order', 17, 3, 16, 1, '2019-02-08 14:18:50', '2019-02-08 14:17:22', '2019-02-10 14:17:00', '', '', '', 1, 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `gst_type`
--

CREATE TABLE `gst_type` (
  `gst_type_id` int(11) NOT NULL,
  `gst_type_name` varchar(10) NOT NULL,
  `gst_perc` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gst_type`
--

INSERT INTO `gst_type` (`gst_type_id`, `gst_type_name`, `gst_perc`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, '5', 5, 0, 0, 0, '0000-00-00 00:00:00'),
(2, '18', 18, 0, 0, 0, '0000-00-00 00:00:00'),
(3, '12', 12, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `login_user_logs`
--

CREATE TABLE `login_user_logs` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `logged_in_date` datetime NOT NULL,
  `logged_out_date` datetime NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alias_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master`
--

INSERT INTO `master` (`id`, `name`, `alias_name`) VALUES
(1, 'appointment_feedback', 'AppFeedback'),
(2, 'area', 'Area'),
(3, 'business_category', 'BusinessCategory'),
(4, 'business_sub_category', 'BusinessSubCategory'),
(6, 'country', 'Country'),
(7, 'data_source', 'DataSource'),
(8, 'designation', 'Designation'),
(9, 'district', 'District'),
(10, 'employee', 'Employee'),
(11, 'lead_call_feedback', 'CallFeedback'),
(12, 'lead_call_not_connected', 'CallNotConnected'),
(13, 'pages', 'Page'),
(14, 'salutation', 'Salutation'),
(15, 'state', 'State'),
(16, 'product', 'Product'),
(17, 'proposal_basic_type', 'ProposalTemplate'),
(18, 'bug_status', 'BugStatus'),
(19, 'bug_category', 'BugCategory'),
(20, 'accounts_code', 'AccountsSubcategory'),
(21, 'service', 'Service'),
(22, 'service_rate', 'ServiceRate'),
(23, 'domain_type', 'DomainType'),
(24, 'server_type', 'ServerType'),
(25, 'server', 'Server'),
(26, 'email_type', 'EmailType');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL COMMENT 'Menu Name',
  `menu_link` varchar(255) NOT NULL,
  `menu_access_key` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `alt_text` varchar(200) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_alias_name` varchar(100) NOT NULL,
  `menu_table_name` varchar(100) NOT NULL,
  `status_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_link`, `menu_access_key`, `icon`, `alt_text`, `parent_id`, `menu_alias_name`, `menu_table_name`, `status_id`, `sort_order`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(42, 'Home', 'dashboard', 'dashboard', 'fa fa-home fa-fw', 'Dashboard', 0, '', '', 1, 1, 1, 0, 0, '2016-03-09 12:06:41'),
(60, 'Reminder', 'reminder', 'reminder', 'fa fa-commenting-o', 'Reminder', 0, '', '', 1, 14, 1, 1, 0, '2016-03-09 13:21:21'),
(61, 'Admin Setting', 'adminsetting', 'adminsetting', '', 'Admin Setting', 63, '', '', 1, 1, 0, 1, 0, '2017-09-14 06:56:20'),
(195, 'Admin Setting', 'adminsetting', 'adminsetting', '', 'Admin Setting', 63, '', '', 1, 6, 1, 0, 61, '2017-09-14 06:56:20'),
(63, 'Admin', 'adminsetting', 'adminsetting', 'fa fa-user-secret', 'Admin', 0, '', '', 1, 16, 0, 1, 0, '2020-07-29 22:32:26'),
(66, 'Backup List', 'adminsetting/backupList', 'adminsetting', '', 'Backup List', 63, '', '', 1, 2, 1, 1, 0, '2016-03-09 13:10:10'),
(67, 'Update Table', 'adminsetting/updateTable', 'adminsetting', '', 'Update Table', 63, '', '', 1, 3, 1, 1, 0, '2016-03-09 13:10:46'),
(68, 'Error Logs', 'adminsetting/errorLog', 'adminsetting', '', 'Error Logs', 63, '', '', 1, 4, 1, 0, 0, '2016-03-09 13:11:23'),
(69, 'User Activity', 'adminsetting/userActivity', 'adminsetting', '', 'User Activity', 63, '', '', 1, 6, 1, 0, 0, '2016-03-09 13:11:56'),
(70, 'User', 'user', 'user', 'fa fa-users', 'User', 0, '', '', 1, 17, 0, 0, 0, '2020-07-29 22:32:38'),
(71, 'User', 'user', 'user', '', 'User', 70, '', '', 1, 1, 1, 0, 0, '2016-03-09 13:13:42'),
(72, 'User Logs', 'user/logs', 'userlog', '', 'User Logs', 70, '', '', 1, 2, 0, 0, 0, '2017-09-14 07:41:45'),
(73, 'User Group', 'usergroup', 'usergroup', '', 'User Group', 70, '', '', 1, 3, 1, 0, 0, '2016-03-09 13:17:01'),
(79, 'Create Menu', 'adminsetting/menulist', 'adminsetting', '', 'Create New Menu', 63, '', '', 1, 0, 14, 0, 0, '2016-12-15 18:36:32'),
(81, 'Masters', ' ', 'master', 'fa fa-database', 'Masters', 0, '', '', 1, 15, 0, 1, 0, '2020-07-29 22:32:16'),
(196, 'User Logs', 'user/logs', 'user', '', 'User Logs', 70, '', '', 1, 2, 1, 0, 72, '2017-09-14 07:35:33'),
(197, 'User Logs', 'user/logs', 'user_logs', '', 'User Logs', 70, '', '', 1, 2, 1, 0, 72, '2017-09-14 07:41:45'),
(199, 'Advertisement', 'advertisement', 'advertisement', 'fa fa-bullhorn', 'Advertisment', 0, '', '', 1, 3, 0, 1, 0, '2018-05-19 11:15:36'),
(200, 'Client', 'client', 'client', 'fa fa-user', 'Client', 0, '', '', 1, 2, 1, 1, 0, '2018-05-19 11:08:50'),
(201, 'Advertisement', 'advertisment', 'advertisment', '', 'Advertisment', 0, '', '', 1, 2, 1, 0, 199, '2018-05-19 11:09:37'),
(202, 'Advertisement', 'advertisment', 'advertisment', 'fa fa-bulhorn', 'Advertisment', 0, '', '', 1, 2, 1, 0, 199, '2018-05-19 11:15:05'),
(203, 'Advertisement', 'advertisement', 'advertisement', 'fa fa-bulhorn', 'Advertisment', 0, '', '', 1, 2, 1, 0, 199, '2018-05-19 11:15:36'),
(170, 'Module Key', 'master/getlist/ModuleKey', 'module_key', '', 'Module Key', 81, 'ModuleKey', 'module_key', 1, 2, 0, 0, 0, '2017-06-30 11:17:17'),
(181, 'Dashboard Block', 'master/getlist/DashboardBlock', 'dashboard_block', '', 'Dashboard Block', 81, 'DashboardBlock', 'dashboard_block', 1, 3, 0, 1, 0, '2018-08-04 12:41:25'),
(204, 'Supplier', 'supplier', 'supplier', 'fa fa-user', 'Lead', 0, '', '', 1, 4, 0, 1, 0, '2020-08-05 19:45:21'),
(205, 'Client', 'client', 'client', 'fa fa-user', 'Client', 0, '', '', 1, 3, 1, 1, 0, '2018-07-05 18:18:53'),
(206, 'Supplier List', 'supplier', 'supplier', '', 'Supplier List', 204, '', '', 1, 2, 0, 1, 0, '2020-08-05 19:46:37'),
(207, 'New Supplier', 'supplier/add', 'supplier', '', 'New Supplier', 204, '', '', 1, 1, 0, 1, 0, '2020-08-05 19:46:05'),
(208, 'New Employee', 'employee/add', 'employee', '', 'New Employee', 212, '', '', 1, 1, 0, 1, 0, '2020-08-05 19:48:23'),
(209, 'Employee List', 'employee', 'employee', '', '', 212, '', '', 1, 2, 0, 1, 0, '2020-08-05 19:49:09'),
(210, 'Mill List', 'client', 'client', 'fa fa-users', 'Clients', 251, '', '', 1, 2, 0, 1, 0, '2018-11-08 16:41:52'),
(211, 'New Customer', 'client/add', 'client', 'fa fa-user-plus', 'New Customer', 251, '', '', 1, 1, 0, 1, 0, '2018-08-04 15:29:07'),
(212, 'Employee', 'employee', 'employee', 'fa fa-user', 'employee', 0, '', '', 1, 6, 0, 1, 0, '2020-08-05 19:49:54'),
(213, 'Appointments', 'client/appointments', 'clientapp', 'fa fa-copy', 'Appointments', 251, '', '', 1, 4, 0, 1, 0, '2018-09-03 13:26:48'),
(214, 'Visit Report', 'client/visits', 'clientvisit', 'fa fa-user', 'Client Visits', 251, '', '', 1, 3, 0, 1, 0, '2018-11-08 16:42:32'),
(215, 'Visits', 'client/visits', 'clientvisit', '', 'Client Visits', 205, '', '', 1, 5, 1, 0, 214, '2018-07-06 19:07:07'),
(216, 'Visits', 'client/visits', 'clientvisit', '', 'Client Visits', 0, '', '', 1, 5, 1, 0, 214, '2018-07-06 19:07:32'),
(217, 'Appointments', 'client/appointments', 'clientapp', '', 'Appointments', 205, '', '', 1, 4, 1, 0, 213, '2018-07-06 19:08:06'),
(218, 'Appointments', 'client/appointments', 'clientapp', 'fa fa-copy', 'Appointments', 205, '', '', 1, 4, 1, 0, 213, '2018-07-06 19:08:51'),
(219, 'Calls', 'client/calls', 'clientcall', '', 'Client Calls', 205, '', '', 1, 3, 1, 0, 212, '2018-07-06 19:09:19'),
(220, 'New Client', 'client/add', 'client', '', 'New Client', 205, '', '', 1, 2, 1, 0, 211, '2018-07-06 19:09:42'),
(221, 'Client List', 'client', 'client', '', 'Clients', 205, '', '', 1, 1, 1, 0, 210, '2018-07-06 19:10:04'),
(222, 'New Client', 'client/add', 'client', 'fa fa-user-plus', 'New Client', 0, '', '', 1, 2, 1, 0, 211, '2018-07-11 17:32:06'),
(223, 'Supplier', 'supplier', 'supplier', 'fa fa-users', 'Supplier', 204, '', '', 1, 3, 0, 1, 0, '2018-07-28 12:40:25'),
(224, 'Supplier', 'supplier', 'supplier', 'fa fa-users', 'Supplier', 42, '', '', 1, 3, 1, 0, 223, '2018-07-28 12:40:25'),
(225, 'Supplier', 'supplier', 'supplier', 'fa fa-user', 'Supplier', 42, '', '', 1, 3, 0, 1, 0, '2018-07-28 14:31:34'),
(226, 'Supplier', 'supplier', 'supplier', 'fa fa-users', 'Supplier', 0, '', '', 1, 3, 1, 0, 225, '2018-07-28 14:31:34'),
(227, 'Supplier', 'supplier', 'supplier', 'fa fa-shopping-cart', 'Supplier', 0, '', '', 1, 10, 0, 1, 0, '2018-08-04 13:28:30'),
(228, 'STS Company', 'company', 'company', 'fa fa-building', 'Company', 0, '', '', 1, 11, 0, 1, 0, '2018-08-04 15:27:44'),
(229, 'Product Quality', 'master/getlist/ProductQuality', 'product_quality', '', 'Product Quality', 81, 'ProductQuality', 'product_quality', 1, 7, 0, 1, 0, '2018-07-30 09:08:38'),
(230, 'Product Quality', 'product_quality', 'product_quality', '', 'Product Quality', 81, '', '', 1, 2, 1, 0, 229, '2018-07-30 08:58:32'),
(231, 'Product Quality', 'master/getlist/ProductQuality', 'product_quality', '', 'Product Quality', 81, 'ProductQuality', 'Product Quality', 1, 2, 1, 0, 229, '2018-07-30 09:01:09'),
(232, 'Product Quality', 'master/getlist/ProductQuality', 'product_quality', '', 'Product Quality', 81, 'ProductQuality', 'product_quality', 1, 2, 1, 0, 229, '2018-07-30 09:01:59'),
(234, 'Product Quality', 'master/getlist/ProductQuality', 'product_quality', '', 'Product Quality', 81, '', 'product_quality', 1, 2, 1, 0, 229, '2018-07-30 09:03:55'),
(233, 'Product Quality', 'master/getlist/Product Quality', 'product_quality', '', 'Product Quality', 81, 'Product Quality', 'product_quality', 1, 2, 1, 0, 229, '2018-07-30 09:02:40'),
(235, 'Product Quality', 'master/getlist/ProductQuality', 'product_quality', '', 'Product Quality', 81, 'ProductQuality', 'product_quality', 1, 2, 1, 0, 229, '2018-07-30 09:08:38'),
(236, 'Product Size', 'master/getlist/ProductQualitySize', 'product_quality_size', '', 'Product Quality Size', 81, 'ProductQualitySize', 'product_quality_size', 1, 8, 0, 1, 0, '2018-09-01 12:16:34'),
(237, 'Quantity Type', 'master/getlist/QuantityType', 'quantity_type', '', 'Quantity Type', 81, 'QuantityType', 'quantity_type', 1, 10, 1, 1, 0, '2018-07-30 09:26:41'),
(238, 'Product', 'product', 'product', 'fa fa-file', 'Product', 0, 'Product', 'product', 1, 5, 0, 0, 0, '2022-06-13 13:36:48'),
(239, 'Category', 'master/getlist/category', 'master', '', 'Category', 81, 'category', 'category', 1, 4, 0, 0, 0, '2020-07-31 17:42:06'),
(240, 'Product Request Status', 'master/getlist/ProductRequestStatus', 'product_request_status', '', 'Product Request  Status', 81, 'ProductRequestStatus', 'product_request_status', 2, 5, 0, 1, 0, '2020-08-06 21:19:28'),
(241, 'Product Request Status', 'master/getlist/ProductRequestStatus', 'product_request_status', '', 'Product Request  Status', 81, 'ProductRequestStatus', 'product_request_status', 1, 3, 1, 0, 240, '2018-07-30 14:13:51'),
(242, 'Product Request Status', 'master/getlist/ProductRequestStatus', 'product_request_status', '', 'Product Request  Status', 0, 'ProductRequestStatus', 'product_request_status', 1, 3, 1, 0, 240, '2018-07-30 14:14:35'),
(243, 'Purchase Order', 'purchase_order', 'purchase_order', 'fa fa-sticky-note', 'Purchase Order', 0, '', '', 1, 5, 0, 0, 0, '2020-08-01 20:03:19'),
(363, 'List', 'product_sample_request', 'product_sample_request', '', 'Product Sample Request', 243, '', '', 1, 2, 1, 0, 270, '2019-05-26 15:41:18'),
(244, 'Sample Request', 'master/getlist/SampleRequest', 'product_sample_request', '', 'Sample Request', 0, 'SampleRequest', 'product_sample_request', 1, 1, 1, 0, 243, '2018-07-30 14:17:28'),
(246, 'Sample Request', 'product_sample_request', 'product_sample_request', 'fa fa-user', 'Sample Request', 0, 'SampleRequest', 'product_sample_request', 1, 1, 1, 0, 243, '2018-07-30 15:10:53'),
(245, 'Sample Request', 'master/getlist/SampleRequest', 'product_sample_request', 'fa fa-user', 'Sample Request', 0, 'SampleRequest', 'product_sample_request', 1, 1, 1, 0, 243, '2018-07-30 14:18:51'),
(247, 'Sample Request', 'product_sample_request', 'Product Sample Request', 'fa fa-user', 'Sample Request', 0, 'SampleRequest', 'product_sample_request', 1, 1, 1, 0, 243, '2018-07-30 15:11:31'),
(248, 'Sample Request', 'product_sample_request', 'product_sample_request', 'fa fa-user', 'Sample Request', 0, 'SampleRequest', 'product_sample_request', 1, 1, 1, 0, 243, '2018-07-30 15:12:03'),
(249, 'Sample Request', 'product_sample_request', 'product_sample_request', 'fa fa-user', 'Sample Request', 0, 'Sample Request', 'product_sample_request', 1, 1, 1, 0, 243, '2018-07-30 15:14:37'),
(250, 'Product Sample Request', 'product_sample_request', 'product_sample_request', 'fa fa-user', 'Product Sample Request', 0, 'Product Sample Request', 'product_sample_request', 1, 1, 1, 0, 243, '2018-07-30 15:15:21'),
(251, 'Customers', ' ', 'client', 'fa fa-users', 'Client', 0, '', '', 1, 9, 0, 1, 0, '2018-08-04 15:29:09'),
(252, 'Client List', 'client', 'client', 'fa fa-users', 'Clients', 0, '', '', 1, 6, 1, 0, 210, '2018-08-04 12:15:05'),
(253, 'Calls', 'client/calls', 'clientcall', 'fa fa-phone', 'Client Calls', 0, '', '', 1, 8, 1, 0, 212, '2018-08-04 12:15:25'),
(254, 'Appointments', 'client/appointments', 'clientapp', 'fa fa-copy', 'Appointments', 0, '', '', 1, 9, 1, 0, 213, '2018-08-04 12:15:47'),
(255, 'New Client', 'client/add', 'client', '', 'New Client', 251, '', '', 1, 2, 1, 1, 0, '2018-08-04 12:16:23'),
(256, 'List', 'client', 'client', 'fa fa-users', 'Clients', 251, '', '', 1, 6, 1, 0, 210, '2018-08-04 12:16:55'),
(257, 'Calls', 'client/calls', 'clientcall', 'fa fa-phone', 'Client Calls', 251, '', '', 1, 8, 1, 0, 212, '2018-08-04 12:17:41'),
(258, 'Add New Client', 'client/add', 'client', 'fa fa-user-plus', 'New Client', 0, '', '', 1, 5, 1, 0, 211, '2018-08-04 12:20:20'),
(264, 'New Company', 'company/add', 'company', '', 'Add New Company', 228, '', '', 1, 1, 1, 1, 0, '2018-08-04 12:24:40'),
(259, 'Add New Client', 'client/add', 'client', 'fa fa-user-plus', 'New Client', 251, '', '', 1, 5, 1, 0, 211, '2018-08-04 12:21:18'),
(260, 'Visits', 'client/visits', 'clientvisit', 'fa fa-user', 'Client Visits', 0, '', '', 1, 7, 1, 0, 214, '2018-08-04 12:21:34'),
(261, 'New Lead', 'lead/add', 'lead', '', 'New Lead', 204, '', '', 1, 2, 1, 0, 207, '2018-08-04 12:22:02'),
(262, 'Lead List', 'lead', 'lead', '', 'Lead', 204, '', '', 1, 1, 1, 0, 206, '2018-08-04 12:22:14'),
(263, 'Add New Client', 'client/add', 'client', 'fa fa-user-plus', 'New Client', 251, '', '', 1, 1, 1, 0, 211, '2018-08-04 12:23:48'),
(265, 'List', 'company', 'company', '', 'List', 228, '', '', 1, 2, 1, 1, 0, '2018-08-04 12:25:05'),
(266, 'New Supplier', 'supplier/add', 'supplier', '', 'New Supplier', 227, '', '', 1, 1, 1, 0, 0, '2018-08-04 12:25:45'),
(267, 'List', 'supplier', 'supplier', '', 'List', 227, '', '', 1, 2, 1, 0, 0, '2018-08-04 12:26:08'),
(268, 'Sample Request', 'product_sample_request', 'product_sample_request', 'fa fa-user', 'Product Sample Request', 0, 'Product Sample Request', 'product_sample_request', 1, 4, 1, 0, 243, '2018-08-04 12:26:38'),
(269, 'New Request', 'product_sample_request/add', 'product_sample_request', '', 'New Product Sample Request', 243, '', '', 1, 1, 1, 1, 0, '2018-08-04 12:27:44'),
(270, 'PO List', 'purchase_order', 'purchase_order', '', 'purchase_order', 243, '', '', 1, 2, 0, 0, 0, '2020-08-05 19:44:01'),
(271, 'Dashboard Block', 'master/getlist/DashboardBlock', 'master', '', 'Dashboard Block', 81, 'DashboardBlock', 'dashboard_block', 1, 4, 1, 0, 181, '2018-08-04 12:41:25'),
(272, 'Email Template', 'master/getlist/product_request_email_template', 'product_request_email_template', '', 'Product Request Email Template', 81, 'product_request_email_template', 'product_request_email_template', 1, 1, 0, 1, 0, '2018-09-17 18:53:26'),
(273, 'Request Sample', 'product_sample_request', 'product_sample_request', 'fa fa-user', 'Product Sample Request', 0, 'Product Sample Request', 'product_sample_request', 1, 4, 1, 0, 243, '2018-08-04 13:23:58'),
(274, 'Company', 'company', 'company', 'fa fa-user', 'Company', 0, '', '', 1, 2, 1, 0, 228, '2018-08-04 13:24:41'),
(275, 'Supplier', 'supplier', 'supplier', 'fa fa-user', 'Supplier', 0, '', '', 1, 3, 1, 0, 227, '2018-08-04 13:26:38'),
(276, 'Supplier', 'supplier', 'supplier', 'fa fa-user-tie', 'Supplier', 0, '', '', 1, 3, 1, 0, 227, '2018-08-04 13:27:26'),
(277, 'Supplier', 'supplier', 'supplier', 'fa fa-cart', 'Supplier', 0, '', '', 1, 3, 1, 0, 227, '2018-08-04 13:28:10'),
(278, 'Supplier', 'supplier', 'supplier', 'fa fa-users', 'Supplier', 0, '', '', 1, 3, 0, 0, 0, '2022-06-13 13:26:15'),
(279, 'Company', 'company', 'company', 'fa fa-building', 'Company', 0, '', '', 1, 2, 1, 0, 228, '2018-08-04 15:27:44'),
(280, 'New Client', 'client/add', 'client', 'fa fa-user-plus', 'New Client', 251, '', '', 1, 1, 1, 0, 211, '2018-08-04 15:29:07'),
(281, 'Clients', ' ', 'client', 'fa fa-users', 'Client', 0, '', '', 1, 4, 1, 0, 251, '2018-08-04 15:29:09'),
(282, 'Delivery Challan', 'product_sample_request/add_dc', 'product_sample_request', 'fa fa-file-pdf-o', 'Delivery Challan', 0, '', '', 1, 3, 0, 1, 0, '2018-08-13 15:25:38'),
(283, 'Delivery Challan', ' ', ' ', '', 'Delivery Challan', 0, '', '', 1, 5, 1, 0, 282, '2018-08-13 15:22:46'),
(284, 'Delivery Challan', 'product_sample_request/generate_dc', 'product_sample_request', '', 'Delivery Challan', 0, '', '', 1, 5, 1, 0, 282, '2018-08-13 15:23:06'),
(285, 'Delivery Challan', 'product_sample_request/generate_dc', 'product_sample_request', 'fa fa-file-pdf-o', 'Delivery Challan', 0, '', '', 1, 5, 1, 0, 282, '2018-08-13 15:25:38'),
(286, 'New DC', 'product_sample_request/add_dc', 'product_sample_request', '', 'New DC', 282, '', '', 1, 1, 0, 1, 0, '2019-01-13 17:47:22'),
(287, 'Supplier DC List', 'product_sample_request/get_delivery_challan_list', 'product_sample_request', '', 'List', 282, '', '', 1, 2, 0, 1, 0, '2019-01-13 17:46:55'),
(288, 'List', 'product_sample_request/get_dc_list', 'product_sample_request', '', 'List', 282, '', '', 1, 2, 1, 0, 287, '2018-08-13 16:50:09'),
(289, 'Import Outstanding', 'client/import_client_outstanding', 'import_client_outstanding', '', 'Import Outstanding', 251, '', '', 1, 3, 0, 1, 0, '2018-08-20 17:06:49'),
(290, 'Outstanding List', 'client/get_client_outstanding_list', 'import_client_outstanding', '', 'Outstanding List', 251, '', '', 1, 4, 0, 1, 0, '2018-10-08 15:59:02'),
(291, 'Order', 'purchase_order', 'purchase_order', 'fa fa-shopping-cart', 'Order', 0, '', '', 1, 5, 0, 1, 0, '2018-08-16 12:19:17'),
(292, 'New Order', 'purchase_order/add', 'purchase_order', '', 'New Order', 291, '', '', 1, 1, 0, 0, 0, '2018-08-14 11:29:59'),
(293, 'List', 'purchase_order', 'purchase_order', '', 'Order List', 291, '', '', 1, 2, 0, 0, 0, '2018-08-14 11:29:51'),
(294, 'List', 'order', 'order', '', 'Order List', 291, '', '', 1, 2, 1, 0, 293, '2018-08-14 11:18:25'),
(295, 'New Order', 'order/add', 'order', '', 'New Order', 291, '', '', 1, 1, 1, 0, 292, '2018-08-14 11:18:36'),
(296, 'Order', 'order', 'order', 'fa fa-cart', 'Order', 0, '', '', 1, 5, 1, 0, 291, '2018-08-14 11:19:14'),
(297, 'List', 'product_order', 'product_order', '', 'Order List', 291, '', '', 1, 2, 1, 0, 293, '2018-08-14 11:29:51'),
(298, 'New Order', 'product_order/add', 'product_order', '', 'New Order', 291, '', '', 1, 1, 1, 0, 292, '2018-08-14 11:29:59'),
(299, 'Order', 'product_order', 'product_order', 'fa fa-cart', 'Order', 0, '', '', 1, 5, 1, 0, 291, '2018-08-14 11:30:07'),
(300, 'Order', 'purchase_order', 'purchase_order', 'fa fa-cart', 'Order', 0, '', '', 1, 5, 1, 0, 291, '2018-08-16 12:19:17'),
(301, 'Proforma Invoice', ' ', 'proforma_invoice', 'fa fa-sticky-note', 'Proforma Invoice', 0, '', '', 1, 4, 0, 1, 0, '2018-09-01 12:01:16'),
(302, 'New Proforma Invoice', 'product_sample_request/add_proforma_invoice', 'proforma_invoice', '', 'New Proforma Invoice', 301, '', '', 1, 1, 1, 1, 0, '2018-08-16 13:50:15'),
(303, 'List', 'product_sample_request/get_proforma_invoice_list', 'proforma_invoice', '', 'Proforma Invoice List', 301, '', '', 1, 2, 1, 1, 0, '2018-08-16 13:51:01'),
(304, 'Import Outstanding', 'client/import_client_outstanding', 'client', '', 'Import Outstanding', 251, '', '', 1, 3, 1, 0, 289, '2018-08-20 17:06:49'),
(305, 'Complaint', 'complaint', 'complaint', 'fa fa-pencil', 'complaint', 0, '', '', 1, 6, 1, 1, 0, '2018-08-30 11:44:17'),
(306, 'New Complaint', 'complaint/add', 'complaint', '', '', 305, '', '', 1, 1, 1, 1, 0, '2018-08-30 11:44:53'),
(307, 'List', 'complaint', 'complaint', '', '', 305, '', '', 1, 2, 0, 1, 0, '2018-08-31 10:51:13'),
(308, 'List', 'complaint/list', 'complaint', '', '', 305, '', '', 1, 2, 1, 0, 307, '2018-08-31 10:51:13'),
(309, 'Make', 'master/getlist/Make', 'make', '', 'Make', 81, 'Make', 'make', 1, 13, 1, 1, 0, '2018-08-29 07:32:44'),
(310, 'Model', 'master/getlist/Model', 'model', '', 'Model', 81, 'Model', 'model', 1, 14, 1, 1, 0, '2018-08-29 07:50:21'),
(311, 'Tape Size', 'master/getlist/TapeSize', 'tape_size', '', 'Tape Size', 81, 'TapeSize', 'tape_size', 1, 15, 1, 1, 0, '2018-08-29 07:55:45'),
(312, 'Top Apron', 'master/getlist/TopApron', 'top_apron', '', 'Top Apron', 81, 'TopApron', 'top_apron', 1, 18, 1, 1, 0, '2018-08-29 08:31:39'),
(313, 'Front Cot', 'master/getlist/FrontCot', 'front_cot', '', 'Front Cot', 81, 'FrontCot', 'front_cot', 1, 17, 1, 1, 0, '2018-08-29 08:50:33'),
(314, 'Back Cot', 'master/getlist/BackCot', 'back_cot', '', 'Back Cot', 81, 'BackCot', 'back_cot', 1, 16, 1, 1, 0, '2018-08-29 09:01:52'),
(315, 'Bottom Apron', 'master/getlist/BottomApron', 'bottom_apron', '', 'Bottom Apron', 81, 'BottomApron', 'bottom_apron', 1, 19, 1, 1, 0, '2018-08-29 09:24:54'),
(316, 'Machine', 'machine', 'machine', 'fa fa-cargo', 'Machine', 0, '', '', 1, 4, 0, 1, 0, '2018-09-01 12:08:54'),
(317, 'Machine To Client', 'client', 'machine', '', 'Machine To client', 319, '', '', 1, 3, 0, 1, 0, '2018-11-09 16:07:06'),
(318, 'Machine', 'machine', 'machine', 'fa fa-file', 'Machine', 0, '', '', 1, 4, 1, 0, 312, '2018-08-29 12:28:36'),
(319, 'Machine', 'machine', 'machine', 'fa fa-cog', 'Machine', 0, '', '', 1, 13, 0, 1, 0, '2018-09-01 12:13:52'),
(320, 'Machine', 'machine', 'machine', 'fa fa-file', 'Machine', 312, '', '', 1, 4, 1, 0, 312, '2018-08-29 12:29:23'),
(321, 'Machine', 'machine', 'machine', 'fa fa-file', 'Machine', 0, '', '', 1, 4, 1, 0, 315, '2018-08-29 12:31:09'),
(322, 'Machine', 'machine', 'machine', '', 'Machine', 0, '', '', 1, 4, 1, 0, 312, '2018-08-29 12:31:29'),
(323, 'Machine', 'machine', 'machine', 'fa fa-file', 'Machine', 312, '', '', 1, 4, 1, 0, 315, '2018-08-29 12:32:07'),
(324, 'Machine To Client', 'machine/machine_to_client', 'machine', '', 'Machine To client', 312, '', '', 1, 1, 1, 0, 313, '2018-08-29 12:32:14'),
(325, 'Area Manager', 'employee/getlist', 'employee', 'fa fa-user', 'Emloyee', 0, '', '', 1, 12, 0, 1, 0, '2018-09-20 11:17:27'),
(326, 'New Area Manager', 'employee/add', 'employee', '', '', 325, '', '', 1, 1, 0, 1, 0, '2018-09-20 11:17:11'),
(327, 'List', 'employee', 'employee', '', '', 325, '', '', 1, 2, 1, 1, 0, '2018-09-01 11:57:15'),
(328, 'Proforma Invoice', ' ', 'proforma_invoice', 'fa fa-file-pdf-o', 'Proforma Invoice', 0, '', '', 1, 8, 1, 0, 301, '2018-09-01 12:01:16'),
(329, 'New Machine', 'machine/add', 'machine', '', '', 316, '', '', 1, 1, 1, 1, 0, '2018-09-01 12:07:57'),
(330, 'List', 'machine', 'machine', '', '', 316, '', '', 1, 2, 1, 1, 0, '2018-09-01 12:08:40'),
(331, 'Machine', 'machine', 'machine', 'fa fa-file', 'Machine', 0, '', '', 1, 4, 1, 0, 316, '2018-09-01 12:08:54'),
(332, 'Machine', 'machine', 'machine', 'fa fa-file', 'Machine', 312, '', '', 1, 1, 1, 0, 319, '2018-09-01 12:09:28'),
(333, 'Machine', 'machine', 'machine', 'fa fa-cogs', 'Machine', 0, '', '', 1, 1, 1, 0, 319, '2018-09-01 12:10:34'),
(334, 'Machine', 'machine', 'machine', 'fa fa-cog', 'Machine', 0, '', '', 1, 1, 1, 0, 319, '2018-09-01 12:11:54'),
(335, 'Machine', 'machine', 'machine', 'fa fa-cog', 'Machine', 319, '', '', 1, 1, 1, 0, 319, '2018-09-01 12:13:52'),
(336, 'Product Quality Size', 'master/getlist/ProductQualitySize', 'product_quality_size', '', 'Product Quality Size', 81, 'ProductQualitySize', 'product_quality_size', 1, 3, 1, 0, 236, '2018-09-01 12:16:34'),
(337, 'Appointments', 'client/appointments', 'clientapp', 'fa fa-copy', 'Appointments', 251, '', '', 1, 4, 1, 0, 213, '2018-09-03 13:26:48'),
(338, 'Visits', 'client/visits', 'clientvisit', 'fa fa-user', 'Client Visits', 251, '', '', 1, 5, 1, 0, 214, '2018-09-03 13:27:07'),
(339, 'Supplier Email Template', 'master/getlist/product_request_email_template', 'product_request_email_template', '', 'Product Request Email Template', 81, 'product_request_email_template', 'product_request_email_template', 1, 1, 1, 0, 272, '2018-09-17 18:53:26'),
(340, 'New Employee', 'employee/add', 'employee', '', '', 325, '', '', 1, 1, 1, 0, 326, '2018-09-20 11:17:11'),
(341, 'Employee', 'employee/getlist', 'employee', 'fa fa-user', 'Emloyee', 0, '', '', 1, 12, 1, 0, 325, '2018-09-20 11:17:27'),
(342, 'Outstanding List', 'client/get_client_outstanding_list', 'client', '', 'Outstanding List', 251, '', '', 1, 4, 1, 0, 290, '2018-10-08 15:59:02'),
(343, 'Lead', 'lead', 'lead', 'fa fa-user', 'Lead', 0, '', '', 1, 7, 1, 0, 204, '2018-10-08 16:44:15'),
(344, 'List', 'client', 'client', 'fa fa-users', 'Clients', 251, '', '', 1, 2, 1, 0, 210, '2018-11-08 16:41:52'),
(345, 'Visits', 'client/visits', 'clientvisit', 'fa fa-user', 'Client Visits', 251, '', '', 1, 3, 1, 0, 214, '2018-11-08 16:42:32'),
(346, 'Visit Entry', 'client/add_client_visit', 'client', '', 'Visit Entry', 251, '', '', 1, 3, 1, 1, 0, '2018-11-08 19:10:35'),
(347, 'Machine To Client', 'machine/machine_to_client', 'machine', '', 'Machine To client', 312, '', '', 1, 2, 1, 0, 317, '2018-11-09 16:05:37'),
(348, 'Machine To Client', 'machine/machine_to_client', 'machine', '', 'Machine To client', 319, '', '', 1, 2, 1, 0, 317, '2018-11-09 16:06:00'),
(349, 'New PO', 'purchase_order/add', 'purchase_order', '', '', 243, '', '', 1, 1, 0, 0, 0, '2020-08-06 21:58:57'),
(350, 'Machine To Client', 'machine/client', 'machine', '', 'Machine To client', 319, '', '', 1, 2, 1, 0, 317, '2018-11-09 16:07:06'),
(351, 'List', 'machine', 'machine', '', '', 319, '', '', 1, 2, 1, 1, 0, '2018-11-09 16:07:28'),
(352, 'Stock In', 'purchase_order/stockin_po_list', 'purchase_order', '', '', 243, '', '', 1, 3, 0, 0, 0, '2020-08-07 21:38:03'),
(353, 'Belt', 'master/getlist/Master', 'belt', '', '', 81, 'Belt', 'belt', 1, 10, 1, 0, 352, '2018-11-10 16:35:25'),
(354, 'Sales List', 'invoice', 'invoice', '', '', 356, '', '', 1, 2, 0, 1, 0, '2020-08-05 19:43:10'),
(355, 'New Sale', 'invoice/add', 'product_variety', 'New Sale', '', 356, '', '', 1, 1, 0, 0, 0, '2020-08-05 19:42:39'),
(356, 'Sales', 'Sales', 'invoice', 'fa fa-sticky-note', 'invoice', 0, '', '', 1, 9, 0, 1, 0, '2020-08-05 19:41:50'),
(357, 'Designation', 'master/getlist/Designation', 'designation', '', 'Designation', 81, 'Designation', 'designation', 1, 5, 1, 0, 0, '2018-11-19 15:21:30'),
(358, 'Customer DC List', 'product_sample_request/get_customer_delivery_challan_list', 'product_sample_request', '', 'Customer DC List', 282, '', '', 1, 2, 1, 1, 0, '2019-01-13 17:46:28'),
(359, 'List', 'product_sample_request/get_delivery_challan_list', 'product_sample_request', '', 'List', 282, '', '', 1, 2, 1, 0, 287, '2019-01-13 17:46:55'),
(360, 'New DC', 'product_sample_request/add_dc', 'product_sample_request', '', 'New DC', 282, '', '', 1, 1, 1, 0, 286, '2019-01-13 17:47:22'),
(361, 'Request Sample', 'product_sample_request', 'product_sample_request', 'fa fa-sticky-note', 'Product Sample Request', 0, 'Product Sample Request', 'product_sample_request', 1, 2, 1, 0, 243, '2019-05-26 15:40:09'),
(362, 'scholarship', 'product_sample_request', 'product_sample_request', 'fa fa-sticky-note', 'Product Sample Request', 0, 'Product Sample Request', 'product_sample_request', 1, 2, 1, 0, 243, '2019-05-26 15:40:45'),
(364, 'Scholarship', 'scholarship', 'scholarship', 'fa fa-sticky-note', 'scholarship', 0, '', '', 1, 2, 1, 0, 243, '2019-06-01 11:15:35'),
(365, 'Announcement', 'announcement', 'announcement', 'fa fa-bullhorn', 'Announcement', 0, '', '', 1, 2, 1, 0, 356, '2020-07-29 22:31:49'),
(366, 'Scholarship', 'scholarship', 'scholarship', 'fa fa-sticky-note', 'scholarship', 0, '', '', 1, 3, 1, 0, 243, '2020-07-29 22:31:59'),
(367, 'Masters', '', 'master', 'fa fa-database', 'Masters', 0, '', '', 1, 14, 1, 0, 81, '2020-07-29 22:32:16'),
(368, 'Admin', 'adminsetting', 'adminsetting', 'fa fa-user-secret', 'Admin', 0, '', '', 1, 15, 1, 0, 63, '2020-07-29 22:32:26'),
(369, 'User', 'user', 'user', 'fa fa-users', 'User', 0, '', '', 1, 16, 1, 0, 70, '2020-07-29 22:32:38'),
(370, 'Delivery Point', 'master/getlist/DeliveryPoint', 'delivery_point', '', 'Delivery Point', 81, 'DeliveryPoint', 'delivery_point', 1, 4, 1, 0, 239, '2020-07-31 17:42:06'),
(371, 'Scholarship', 'scholarship', 'scholarship', 'fa fa-sticky-note', 'scholarship', 0, '', '', 1, 3, 1, 0, 243, '2020-08-01 20:02:28'),
(372, 'Purchase Order', 'purchase_order', 'purchase_order', 'fa fa-sticky-note', 'Purchase Order', 0, '', '', 1, 3, 1, 0, 243, '2020-08-01 20:03:19'),
(373, 'List', 'scholarship', 'scholarship', '', 'scholarship', 243, '', '', 1, 2, 1, 0, 270, '2020-08-01 20:11:12'),
(374, 'Announcement', 'announcement', 'announcement', 'fa fa-bullhorn', 'Announcement', 0, '', '', 1, 2, 1, 0, 356, '2020-08-05 19:41:50'),
(375, 'Variety', 'master/getlist/ProductVariety', 'product_variety', '', '', 81, 'ProductVariety', 'product_variety', 1, 9, 1, 0, 355, '2020-08-05 19:42:39'),
(376, 'Grade', 'master/getlist/Grade', 'grade', '', '', 81, 'Grade', 'grade', 1, 11, 1, 0, 354, '2020-08-05 19:43:10'),
(377, 'List', 'purchase_order', 'purchase_order', '', 'purchase_order', 243, '', '', 1, 2, 1, 0, 270, '2020-08-05 19:44:01'),
(378, 'New Machine', 'machine/add', 'machine', '', '', 319, '', '', 1, 1, 1, 0, 349, '2020-08-05 19:44:42'),
(379, 'Lead', 'lead', 'lead', 'fa fa-user', 'Lead', 0, '', '', 1, 7, 1, 0, 204, '2020-08-05 19:45:21'),
(380, 'New Lead', 'lead/add', 'lead', '', 'New Lead', 204, '', '', 1, 1, 1, 0, 207, '2020-08-05 19:46:05'),
(381, 'Lead List', 'lead', 'lead', '', 'Lead', 204, '', '', 1, 2, 1, 0, 206, '2020-08-05 19:46:37'),
(382, 'Calls', 'client/calls', 'clientcall', 'fa fa-phone', 'Client Calls', 251, '', '', 1, 3, 1, 0, 212, '2020-08-05 19:47:28'),
(383, 'Calls', 'lead/calls', 'leadcall', '', 'Lead Calls', 204, '', '', 1, 3, 1, 0, 208, '2020-08-05 19:48:23'),
(384, 'Appointments', 'lead/appointments', 'leadapp', '', 'Appointments', 204, '', '', 1, 5, 1, 0, 209, '2020-08-05 19:49:09'),
(385, 'Employee', 'employee', 'employee', 'fa fa-users', 'employee', 0, '', '', 1, 3, 1, 0, 212, '2020-08-05 19:49:54'),
(386, 'Belt', 'master/getlist/Belt', 'belt', '', '', 81, 'Belt', 'belt', 1, 12, 1, 0, 352, '2020-08-05 19:54:55'),
(387, 'Stock In', 'purchase_order', 'purchase_order', '', '', 243, '', '', 1, 3, 1, 0, 352, '2020-08-05 19:55:59'),
(388, 'Product Request Status', 'master/getlist/ProductRequestStatus', 'product_request_status', '', 'Product Request  Status', 81, 'ProductRequestStatus', 'product_request_status', 1, 5, 1, 0, 240, '2020-08-06 21:19:28'),
(389, 'Product', 'master/getlist/Product', 'product', '', 'Product', 81, 'Product', 'product', 1, 6, 1, 0, 238, '2020-08-06 21:26:19'),
(390, 'Product', 'product', 'product', '', 'Product', 0, 'Product', 'product', 1, 6, 1, 0, 238, '2020-08-06 21:26:45'),
(391, 'New PO', 'purchase_order', 'purchase_order', '', '', 243, '', '', 1, 1, 1, 0, 349, '2020-08-06 21:58:57'),
(392, 'Stock In', 'purchase_order/stockin_po_list', 'purchase_order', '', '', 243, '', '', 1, 3, 1, 0, 352, '2020-08-06 22:00:45'),
(393, 'New Sales', 'invoice/add', 'invoice', '', 'New Sales', 356, '', '', 1, 1, 1, 1, 0, '2020-08-06 22:01:48'),
(394, 'Stock In', 'purchase_order/stockin_po_list', 'purchase_order', '', '', 243, '', '', 2, 3, 1, 0, 352, '2020-08-07 21:38:03'),
(395, 'Patient', 'patient', 'patient', 'fa fa-user', 'Patient', 0, '', '', 1, 7, 1, 1, 0, '2020-08-07 21:55:34'),
(396, 'New Patient', 'patient/add', 'patient', '', 'New Patient', 395, '', '', 1, 1, 1, 1, 0, '2020-08-07 21:56:09'),
(397, 'List', 'patient', 'patient', '', 'List', 395, '', '', 1, 2, 1, 1, 0, '2020-08-07 21:56:31'),
(398, 'Doctor Prescription List', 'invoice/get_patient_pending_prescription_list', 'invoice', 'fa fa-sticky-note', 'Doctor Prescription List', 0, '', '', 1, 8, 1, 1, 0, '2020-08-08 21:28:24'),
(399, 'Payment Collection', 'invoice/payment_collection', 'payment_collection', 'fa fa-rupee', 'Payment Collection', 0, '', '', 1, 10, 0, 1, 0, '2020-12-22 17:29:39'),
(400, 'Payment  Report', 'invoice/get_payment_history_list', 'payment_report', 'fa fa-rupee', 'Payment  Report', 0, '', '', 1, 13, 0, 1, 0, '2020-12-22 17:29:26'),
(401, 'Analytics Report', ' ', 'report', 'fa fa-sticky-note', 'Analytics Report', 0, '', '', 1, 11, 1, 1, 0, '2020-08-10 21:44:55'),
(402, 'Gender Wise', 'report/chart_patient_by_gender', 'gender_report', '', 'Gender Wise', 401, '', '', 1, 1, 0, 1, 0, '2020-12-22 17:51:56'),
(403, 'Age Group Wise', 'report/chart_patient_by_age_group', 'age_report', '', 'Age Group Wise', 401, '', '', 1, 1, 0, 1, 0, '2020-12-22 17:51:24'),
(404, 'Diagnosis Wise', 'report/chart_patient_by_diagnosis', 'diagnosis_report', '', 'Diagnosis Wise', 401, '', '', 1, 1, 0, 1, 0, '2020-12-22 17:52:23'),
(405, 'Modern Diagnosis Wise', 'report/chart_patient_by_m_diagnosis', 'm_diagnosis_report', '', 'Modern Diagnosis Wise', 401, '', '', 1, 1, 0, 1, 0, '2020-12-22 17:52:33'),
(406, 'Modern system Wise', 'report/chart_patient_by_modern_system', 'm_system_report', '', 'Modern system Wise', 401, '', '', 1, 1, 0, 1, 0, '2020-12-22 17:52:59'),
(407, 'Suggested Treatment Wise', 'report/chart_patient_by_treatment', 'treatment_report', '', 'Suggested Treatment Wise', 401, '', '', 1, 1, 0, 1, 0, '2020-12-22 17:53:25'),
(408, 'Reference Wise', 'report/chart_patient_by_refence', 'reference_report', '', 'Reference Wise', 401, '', '', 1, 1, 0, 1, 0, '2020-12-22 17:53:44'),
(409, 'List', 'accounts', 'accounts', '', 'List', 412, '', '', 1, 3, 0, 1, 0, '2020-08-12 22:36:06'),
(410, 'Add Expenses', 'accounts/add_expense', 'accounts', '', 'Add Expenses', 412, '', '', 1, 2, 0, 1, 0, '2020-08-12 22:36:03'),
(411, 'Add Income', 'accounts/add_income', 'accounts', '', 'Income', 412, '', '', 1, 1, 0, 1, 0, '2020-08-12 22:35:49'),
(412, 'Accounts', ' ', 'accounts', 'fa fa-rupee', 'Accounts', 0, '', '', 1, 12, 1, 1, 0, '2020-08-12 22:12:00'),
(413, 'Add Income', 'accounts/add_income', 'accounts', '', 'Income', 409, '', '', 1, 1, 1, 0, 411, '2020-08-12 22:35:49'),
(414, 'Add Expenses', 'accounts/add_expense', 'accounts', '', 'Add Expenses', 409, '', '', 1, 2, 1, 0, 410, '2020-08-12 22:36:03'),
(415, 'List', 'accounts', 'accounts', '', 'List', 409, '', '', 1, 3, 1, 0, 409, '2020-08-12 22:36:06'),
(416, 'Profit And Loss', 'accounts/profit_loss_report', 'accounts', '', 'Profit And Loss', 401, '', '', 1, 9, 1, 1, 0, '2020-08-13 22:29:09'),
(417, 'Customer', 'customer', 'customer', 'fa fa-user', 'Customer', 0, '', '', 1, 2, 0, 0, 0, '2020-10-12 21:36:56'),
(418, 'B2C Orders', 'customer_order', 'customer_order', 'fa fa-file', 'B2C Orders', 0, '', '', 1, 3, 0, 1, 0, '2020-10-12 14:54:47'),
(419, 'Product Sales Report', 'accounts/product_sales_report', 'sales_report', '', 'Product Sales Report', 401, '', '', 1, 9, 0, 1, 0, '2020-12-22 17:54:47'),
(420, 'Product Stock Report', 'product/product_stock_list', 'product_stock_report', '', 'Product Stock Report', 401, '', '', 1, 10, 0, 1, 0, '2020-12-22 18:43:54'),
(421, 'Patient Visit', 'patient/get_patient_visit_list', 'patient', '', 'Patient Visit', 395, '', '', 1, 3, 1, 1, 0, '2020-09-01 23:25:23'),
(422, 'Product wise Sales Report', 'accounts/product_wise_sales_report', 'product_wise_sales_report', '', 'Product wise Sales Report', 401, '', '', 1, 11, 0, 1, 0, '2020-12-22 17:54:57'),
(423, 'Patient Invoice Report', 'accounts/patient_invoice_report', 'patient_wise_sales_report', '', 'Patient Invoice Report', 401, '', '', 1, 12, 0, 1, 0, '2020-12-22 17:55:06'),
(424, 'Product Avg Sales Report', 'accounts/get_product_avg_sales_report', 'accounts', '', 'Product Avg Sales', 401, '', '', 1, 10, 3, 1, 0, '2020-09-24 18:39:25'),
(425, 'Doctor Sales Report', 'accounts/doctor_invoice_report', 'accounts', '', 'Doctor Sales Report', 401, '', '', 1, 10, 1, 1, 0, '2020-10-01 19:43:14'),
(426, 'B2C Orders', 'order', 'order', 'fa fa-file', 'B2C Orders', 0, '', '', 1, 0, 1, 0, 418, '2020-10-12 14:54:47'),
(427, 'B2C Customer', 'customer', 'customer', 'fa fa-user', 'Customer', 0, '', '', 1, 0, 1, 0, 417, '2020-10-12 21:36:56'),
(428, 'New Customer', 'customer/add', 'customer', '', 'customer', 417, '', '', 1, 1, 1, 0, 0, '2020-10-12 21:37:23'),
(429, 'Customer List', 'customer', 'customer', '', 'customer', 417, '', '', 1, 2, 1, 0, 0, '2020-10-12 21:37:43'),
(430, 'Payment  Report', 'invoice/get_payment_history_list', 'invoice', 'fa fa-rupee', 'Payment  Report', 0, '', '', 1, 13, 1, 0, 400, '2020-12-22 17:29:26'),
(431, 'Payment Collection', 'invoice/payment_collection', 'invoice', 'fa fa-rupee', 'Payment Collection', 0, '', '', 1, 10, 1, 0, 399, '2020-12-22 17:29:39'),
(432, 'Age Group Wise', 'report/chart_patient_by_age_group', 'report', '', 'Age Group Wise', 401, '', '', 1, 1, 1, 0, 403, '2020-12-22 17:51:24'),
(433, 'Gender Wise', 'report/chart_patient_by_gender', 'report', '', 'Gender Wise', 401, '', '', 1, 1, 1, 0, 402, '2020-12-22 17:51:56'),
(434, 'Diagnosis Wise', 'report/chart_patient_by_diagnosis', 'report', '', 'Diagnosis Wise', 401, '', '', 1, 1, 1, 0, 404, '2020-12-22 17:52:23'),
(435, 'Modern Diagnosis Wise', 'report/chart_patient_by_m_diagnosis', 'report', '', 'Modern Diagnosis Wise', 401, '', '', 1, 1, 1, 0, 405, '2020-12-22 17:52:33'),
(436, 'Modern system Wise', 'report/chart_patient_by_modern_system', 'report', '', 'Modern system Wise', 401, '', '', 1, 1, 1, 0, 406, '2020-12-22 17:52:59'),
(437, 'Suggested Treatment Wise', 'report/chart_patient_by_treatment', 'report', '', 'Suggested Treatment Wise', 401, '', '', 1, 1, 1, 0, 407, '2020-12-22 17:53:25'),
(438, 'Reference Wise', 'report/chart_patient_by_refence', 'report', '', 'Reference Wise', 401, '', '', 1, 1, 1, 0, 408, '2020-12-22 17:53:44'),
(439, 'Product Sales Report', 'accounts/product_sales_report', 'report', '', 'Product Sales Report', 401, '', '', 1, 9, 1, 0, 419, '2020-12-22 17:54:47'),
(440, 'Product wise Sales Report', 'accounts/product_wise_sales_report', 'report', '', 'Product wise Sales Report', 401, '', '', 1, 11, 1, 0, 422, '2020-12-22 17:54:57'),
(441, 'Patient Invoice Report', 'accounts/patient_invoice_report', 'report', '', 'Patient Invoice Report', 401, '', '', 1, 12, 1, 0, 423, '2020-12-22 17:55:06'),
(442, 'Product Stock Report', 'product/product_stock_list', 'product', '', 'Product Stock Report', 401, '', '', 1, 10, 1, 0, 420, '2020-12-22 18:43:54'),
(443, 'Accounts Category', 'master/getlist/accounts_code', 'master', '', '', 81, 'accounts_code', 'accounts_code', 1, 1, 0, 1, 0, '2021-04-04 11:43:36'),
(444, 'Expenses Category', 'master/getlist/accounts_code', 'accounts_code', '', '', 81, 'accounts_code', 'accounts_code', 1, 1, 1, 0, 443, '2021-04-04 11:37:58'),
(445, 'Expenses Category', 'master/getlist/accounts_code', 'master', '', '', 81, 'accounts_code', 'accounts_code', 1, 1, 1, 0, 443, '2021-04-04 11:43:36'),
(446, 'Supplier', 'supplier', 'supplier', 'fa fa-shoping-cart', 'Supplier', 0, '', '', 1, 3, 1, 0, 278, '2022-06-13 13:26:15'),
(447, 'Product', 'product', 'product', '', 'Product', 81, 'Product', 'product', 1, 1, 1, 0, 238, '2022-06-13 13:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(25) NOT NULL COMMENT 'Model Name',
  `delete_status` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`model_id`, `model_name`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(1, 'Model 1', 0, 3, 0, '2018-08-29 07:51:17'),
(2, 'Model 2', 0, 3, 0, '2018-08-29 07:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `module_key`
--

CREATE TABLE `module_key` (
  `module_key_id` int(11) NOT NULL,
  `module_key_name` varchar(100) NOT NULL COMMENT 'Key Name',
  `module_key_display_name` varchar(100) NOT NULL COMMENT 'Display Name',
  `delete_status` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_key`
--

INSERT INTO `module_key` (`module_key_id`, `module_key_name`, `module_key_display_name`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(16, 'backuptable', 'Backup Table', 0, 1, 0, '2017-06-30 09:26:24'),
(17, 'updatetable', 'Update Table', 0, 0, 0, '0000-00-00 00:00:00'),
(19, 'userlog', 'User Logs', 0, 0, 0, '0000-00-00 00:00:00'),
(20, 'errorlog', 'Error Logs', 0, 0, 0, '0000-00-00 00:00:00'),
(21, 'useractivity', 'User Activity', 0, 0, 0, '0000-00-00 00:00:00'),
(22, 'menu', 'Menu', 0, 0, 0, '0000-00-00 00:00:00'),
(40, 'lead_reminder', 'Lead Reminder', 0, 1, 0, '2018-07-05 18:07:14'),
(41, 'client_reminder', 'Client Reminder', 0, 1, 0, '2018-07-05 18:07:34'),
(42, 'leadcall', 'Lead Call', 0, 1, 0, '2018-07-05 18:40:30'),
(43, 'leadapp', 'Lead App', 0, 1, 0, '2018-07-05 18:40:47'),
(44, 'clientcall', 'Client Call', 0, 1, 0, '2018-07-05 18:40:58'),
(45, 'clientapp', 'Client App', 0, 1, 0, '2018-07-05 18:41:14'),
(46, 'clientvisit', 'Client Visit', 0, 1, 0, '2018-07-06 13:08:06'),
(47, 'client_visit_reminder', 'Client Visit Reminder', 0, 1, 0, '2018-07-06 15:55:12'),
(48, 'client_visit_comment', 'Client Visit Comments', 0, 1, 0, '2018-07-07 11:19:18'),
(49, 'product_quality', 'Product Quality', 0, 1, 0, '2018-07-30 08:54:52'),
(50, 'product_quality_size', 'Product Quality Size', 0, 1, 0, '2018-07-30 09:15:34'),
(51, 'quantity_type', 'Quantity Type', 0, 1, 0, '2018-07-30 09:27:34'),
(52, 'product', 'Product', 0, 1, 0, '2018-07-30 10:22:44'),
(53, 'delivery_point', 'Delivery Point', 0, 1, 0, '2018-07-30 12:28:50'),
(54, 'product_request_status', 'Product Request Status', 0, 1, 0, '2018-07-30 12:46:31'),
(55, 'product_sample_request', 'Product Sample Request', 0, 1, 0, '2018-07-30 15:12:58'),
(56, 'product_feedback_reminder', 'Product Feedback Reminder', 0, 1, 0, '2018-07-31 09:32:14'),
(57, 'overall_summary', 'Overall Summary', 0, 1, 0, '2018-08-04 16:10:40'),
(58, 'delivery_challan', 'Delivery Challan', 0, 1, 0, '2018-08-13 16:55:23'),
(59, 'proforma_invoice', 'Proforma Invoice', 0, 1, 0, '2018-08-16 13:51:33'),
(60, 'client_outstanding_reminder', 'client_outstanding_reminder', 0, 1, 0, '2018-08-20 16:40:39'),
(61, 'import_client_outstanding', 'Import Client Outstanding', 0, 1, 0, '2018-08-20 16:42:18'),
(62, 'pending_proforma', 'Pending Proforma', 0, 1, 0, '2018-11-22 13:31:51'),
(63, 'payment_report', 'Payment Report', 0, 1, 0, '2020-12-22 17:29:18'),
(64, 'payment_collection', 'Payment Collection', 0, 1, 0, '2020-12-22 17:29:53'),
(65, 'gender_report', 'Gender Report', 0, 1, 0, '2020-12-22 17:38:18'),
(66, 'age_report', 'Age Report', 0, 1, 0, '2020-12-22 17:38:33'),
(67, 'diagnosis_report', 'diagnosis_report', 0, 1, 0, '2020-12-22 17:39:08'),
(68, 'm_diagnosis_report', 'm_diagnosis_report', 0, 1, 0, '2020-12-22 17:39:19'),
(69, 'm_system_report', 'm_system_report', 0, 1, 0, '2020-12-22 17:39:31'),
(70, 'treatment_report', 'treatment_report', 0, 1, 0, '2020-12-22 17:39:43'),
(71, 'reference_report', 'reference_report', 0, 1, 0, '2020-12-22 17:41:00'),
(72, 'sales_report', 'sales_report', 0, 1, 0, '2020-12-22 17:41:20'),
(73, 'product_wise_sales_report', 'product_wise_sales_report', 0, 1, 0, '2020-12-22 17:41:30'),
(74, 'patient_wise_sales_report', 'patient_wise_sales_report', 0, 1, 0, '2020-12-22 17:41:42'),
(75, 'product_stock_report', 'product_stock_report', 0, 1, 0, '2020-12-22 18:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `payment_history_id` int(11) NOT NULL,
  `payment_history_no` int(11) NOT NULL,
  `payment_history_name` varchar(20) NOT NULL COMMENT 'Receipt No',
  `ref_invoice_id` int(11) NOT NULL COMMENT 'Invoice No',
  `invoice_payment_date` date NOT NULL,
  `ref_payment_type_id` int(11) NOT NULL,
  `invoice_payment_amount` int(11) NOT NULL,
  `invoice_payment_details` varchar(255) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`payment_history_id`, `payment_history_no`, `payment_history_name`, `ref_invoice_id`, `invoice_payment_date`, `ref_payment_type_id`, `invoice_payment_amount`, `invoice_payment_details`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(9, 1, 'IN-09082020-0001', 32, '2020-08-09', 1, 1100, 'Amount received', 1, 0, 0, '2020-08-09 22:02:22'),
(10, 2, 'IN-25082020-0002', 1, '2020-08-11', 3, 7500, 'NEFT', 3, 0, 0, '2020-08-25 18:53:02'),
(11, 3, 'IN-25082020-0003', 2, '2020-08-03', 1, 505, '', 3, 0, 0, '2020-08-25 18:53:49'),
(12, 4, 'IN-25082020-0004', 3, '2020-08-03', 1, 655, '', 3, 0, 0, '2020-08-25 18:54:49'),
(13, 5, 'IN-25082020-0005', 4, '2020-08-03', 1, 505, '', 3, 0, 0, '2020-08-25 18:55:43'),
(14, 6, 'IN-25082020-0006', 5, '2020-08-04', 1, 964, '', 3, 0, 0, '2020-08-25 19:03:17'),
(15, 7, 'IN-25082020-0007', 6, '2020-08-06', 1, 295, '', 3, 0, 0, '2020-08-25 19:03:45'),
(16, 8, 'IN-25082020-0008', 7, '2020-08-11', 1, 624, '', 3, 0, 0, '2020-08-25 19:04:04'),
(17, 9, 'IN-25082020-0009', 8, '2020-08-11', 1, 4057, '', 3, 0, 0, '2020-08-25 19:04:38'),
(18, 10, 'IN-25082020-0010', 9, '2020-08-11', 1, 270, '', 3, 0, 0, '2020-08-25 19:05:34'),
(19, 11, 'IN-25082020-0011', 10, '2020-08-12', 1, 445, '', 3, 0, 0, '2020-08-25 19:08:14'),
(20, 12, 'IN-25082020-0012', 11, '2020-08-12', 1, 595, '', 3, 0, 0, '2020-08-25 19:08:27'),
(21, 13, 'IN-25082020-0013', 12, '2020-08-12', 1, 595, '', 3, 0, 0, '2020-08-25 19:11:51'),
(22, 14, 'IN-25082020-0014', 13, '2020-08-13', 1, 320, '', 3, 0, 0, '2020-08-25 19:12:28'),
(23, 15, 'IN-25082020-0015', 14, '2020-08-13', 1, 65, '', 3, 0, 0, '2020-08-25 19:12:40'),
(24, 16, 'IN-25082020-0016', 15, '2020-08-14', 1, 1029, '', 3, 0, 0, '2020-08-25 19:12:57'),
(25, 17, 'IN-25082020-0017', 16, '2020-08-14', 1, 250, '', 3, 0, 0, '2020-08-25 19:13:12'),
(26, 18, 'IN-25082020-0018', 17, '2020-08-17', 1, 320, '', 3, 0, 0, '2020-08-25 19:13:26'),
(27, 19, 'IN-25082020-0019', 18, '2020-08-17', 1, 165, '', 3, 0, 0, '2020-08-25 19:13:41'),
(28, 20, 'IN-26082020-0020', 95, '2020-08-26', 1, 205, '', 3, 0, 0, '2020-08-26 11:38:58'),
(29, 21, 'IN-26082020-0021', 94, '2020-08-26', 1, 1267, '', 3, 0, 0, '2020-08-26 11:39:12'),
(30, 22, 'IN-26082020-0022', 93, '2020-08-25', 1, 185, '', 3, 0, 0, '2020-08-26 11:39:36'),
(31, 23, 'IN-26082020-0023', 92, '2020-08-25', 1, 95, '', 3, 0, 0, '2020-08-26 11:39:53'),
(32, 24, 'IN-26082020-0024', 91, '2020-08-25', 1, 442, '', 3, 0, 0, '2020-08-26 11:40:12'),
(33, 25, 'IN-26082020-0025', 90, '2020-08-25', 1, 240, '', 3, 0, 0, '2020-08-26 11:40:26'),
(34, 26, 'IN-26082020-0026', 89, '2020-08-25', 1, 150, '', 3, 0, 0, '2020-08-26 11:40:49'),
(35, 27, 'IN-26082020-0027', 88, '2020-08-25', 2, 395, '000027', 3, 0, 0, '2020-08-26 11:42:12'),
(36, 28, 'IN-26082020-0028', 87, '2020-08-25', 1, 15, '', 3, 0, 0, '2020-08-26 11:43:38'),
(37, 29, 'IN-26082020-0029', 86, '2020-08-25', 1, 479, '', 3, 0, 0, '2020-08-26 11:43:53'),
(38, 30, 'IN-26082020-0030', 85, '2020-08-25', 2, 330, '000026', 3, 0, 0, '2020-08-26 11:44:43'),
(39, 31, 'IN-26082020-0031', 84, '2020-08-25', 1, 575, '', 3, 0, 0, '2020-08-26 11:44:59'),
(40, 32, 'IN-26082020-0032', 83, '2020-08-25', 1, 1014, '', 3, 0, 0, '2020-08-26 11:45:15'),
(41, 33, 'IN-26082020-0033', 82, '2020-08-25', 1, 717, '', 3, 0, 0, '2020-08-26 11:45:29'),
(42, 34, 'IN-26082020-0034', 81, '2020-08-25', 2, 1165, '000025', 3, 0, 0, '2020-08-26 11:46:23'),
(43, 35, 'IN-26082020-0035', 80, '2020-08-25', 1, 948, '', 3, 0, 0, '2020-08-26 11:46:37'),
(44, 36, 'IN-26082020-0036', 79, '2020-08-25', 1, 1033, '', 3, 0, 0, '2020-08-26 11:47:44'),
(45, 37, 'IN-26082020-0037', 78, '2020-08-26', 1, 65, '', 3, 0, 0, '2020-08-26 11:48:01'),
(46, 38, 'IN-26082020-0038', 76, '2020-08-25', 1, 642, '', 3, 0, 0, '2020-08-26 11:49:02'),
(47, 39, 'IN-26082020-0039', 75, '2020-08-25', 1, 470, '', 3, 0, 0, '2020-08-26 11:49:22'),
(48, 40, 'IN-26082020-0040', 74, '2020-08-25', 1, 160, '', 3, 0, 0, '2020-08-26 11:49:36'),
(49, 41, 'IN-26082020-0041', 73, '2020-08-24', 1, 640, '', 3, 0, 0, '2020-08-26 11:49:51'),
(50, 42, 'IN-26082020-0042', 72, '2020-08-24', 1, 714, '', 3, 0, 0, '2020-08-26 11:50:08'),
(51, 43, 'IN-26082020-0043', 71, '2020-08-24', 1, 230, '', 3, 0, 0, '2020-08-26 11:50:27'),
(52, 44, 'IN-26082020-0044', 70, '2020-08-24', 1, 145, '', 3, 0, 0, '2020-08-26 11:50:49'),
(53, 45, 'IN-26082020-0045', 69, '2020-08-24', 1, 316, '', 3, 0, 0, '2020-08-26 11:51:06'),
(54, 46, 'IN-26082020-0046', 68, '2020-08-24', 1, 40, '', 3, 0, 0, '2020-08-26 11:51:29'),
(55, 47, 'IN-26082020-0047', 67, '2020-08-24', 1, 185, '', 3, 0, 0, '2020-08-26 11:51:40'),
(56, 48, 'IN-26082020-0048', 66, '2020-08-24', 1, 345, '', 3, 0, 0, '2020-08-26 11:51:52'),
(57, 49, 'IN-26082020-0049', 65, '2020-08-24', 1, 170, '', 3, 0, 0, '2020-08-26 11:52:07'),
(58, 50, 'IN-26082020-0050', 64, '2020-08-24', 1, 910, '', 3, 0, 0, '2020-08-26 11:52:21'),
(59, 51, 'IN-26082020-0051', 63, '2020-08-24', 1, 1224, '', 3, 0, 0, '2020-08-26 11:53:13'),
(60, 52, 'IN-26082020-0052', 62, '2020-08-24', 1, 2290, '', 3, 0, 0, '2020-08-26 11:53:27'),
(61, 53, 'IN-26082020-0053', 61, '2020-08-24', 1, 605, '', 3, 0, 0, '2020-08-26 11:54:18'),
(62, 54, 'IN-26082020-0054', 60, '2020-08-24', 1, 150, '', 3, 0, 0, '2020-08-26 11:54:31'),
(63, 55, 'IN-26082020-0055', 59, '2020-08-24', 1, 165, '', 3, 0, 0, '2020-08-26 11:54:44'),
(64, 56, 'IN-26082020-0056', 58, '2020-08-22', 1, 225, '', 3, 0, 0, '2020-08-26 11:55:02'),
(65, 57, 'IN-26082020-0057', 57, '2020-08-22', 1, 85, '', 3, 0, 0, '2020-08-26 11:55:15'),
(66, 58, 'IN-26082020-0058', 56, '2020-08-22', 1, 135, '', 3, 0, 0, '2020-08-26 12:00:48'),
(67, 59, 'IN-26082020-0059', 55, '2020-08-21', 1, 55, '', 3, 0, 0, '2020-08-26 12:02:33'),
(68, 60, 'IN-26082020-0060', 54, '2020-08-21', 1, 90, '', 3, 0, 0, '2020-08-26 12:02:46'),
(69, 61, 'IN-26082020-0061', 53, '2020-08-21', 1, 370, '', 3, 0, 0, '2020-08-26 12:03:01'),
(70, 62, 'IN-26082020-0062', 52, '2020-08-21', 1, 295, '', 3, 0, 0, '2020-08-26 12:03:18'),
(71, 63, 'IN-26082020-0063', 51, '2020-08-21', 1, 200, '', 3, 0, 0, '2020-08-26 12:03:43'),
(72, 64, 'IN-26082020-0064', 50, '2020-08-21', 1, 730, '', 3, 0, 0, '2020-08-26 12:04:01'),
(73, 65, 'IN-26082020-0065', 49, '2020-08-21', 1, 210, '', 3, 0, 0, '2020-08-26 12:05:07'),
(74, 66, 'IN-26082020-0066', 48, '2020-08-21', 1, 260, '', 3, 0, 0, '2020-08-26 12:05:22'),
(75, 67, 'IN-26082020-0067', 47, '2020-08-21', 1, 210, '', 3, 0, 0, '2020-08-26 12:05:55'),
(76, 68, 'IN-26082020-0068', 46, '2020-08-21', 1, 130, '', 3, 0, 0, '2020-08-26 12:06:09'),
(77, 69, 'IN-26082020-0069', 45, '2020-08-21', 1, 185, '', 3, 0, 0, '2020-08-26 12:06:43'),
(78, 70, 'IN-26082020-0070', 44, '2020-08-21', 1, 65, '', 3, 0, 0, '2020-08-26 12:06:58'),
(79, 71, 'IN-26082020-0071', 43, '2020-08-21', 1, 60, '', 3, 0, 0, '2020-08-26 12:07:15'),
(80, 72, 'IN-26082020-0072', 42, '2020-08-21', 1, 295, '', 3, 0, 0, '2020-08-26 12:07:30'),
(81, 73, 'IN-26082020-0073', 41, '2020-08-21', 1, 292, '', 3, 0, 0, '2020-08-26 12:07:48'),
(82, 74, 'IN-26082020-0074', 40, '2020-08-21', 1, 280, '', 3, 0, 0, '2020-08-26 12:08:01'),
(83, 75, 'IN-26082020-0075', 39, '2020-08-21', 1, 675, '', 3, 0, 0, '2020-08-26 12:08:12'),
(84, 76, 'IN-26082020-0076', 38, '2020-08-20', 1, 127, '', 3, 0, 0, '2020-08-26 12:08:33'),
(85, 77, 'IN-26082020-0077', 37, '2020-08-20', 1, 155, '', 3, 0, 0, '2020-08-26 12:08:47'),
(86, 78, 'IN-26082020-0078', 36, '2020-08-20', 2, 4519, '000016', 3, 0, 0, '2020-08-26 12:09:22'),
(87, 79, 'IN-26082020-0079', 35, '2020-08-20', 2, 545, '000015', 3, 0, 0, '2020-08-26 12:09:52'),
(88, 80, 'IN-26082020-0080', 34, '2020-08-19', 1, 135, '', 3, 0, 0, '2020-08-26 12:10:06'),
(89, 81, 'IN-26082020-0081', 33, '2020-08-19', 1, 200, '', 3, 0, 0, '2020-08-26 12:10:19'),
(90, 82, 'IN-26082020-0082', 32, '2020-08-19', 1, 320, '', 3, 0, 0, '2020-08-26 12:10:33'),
(91, 83, 'IN-26082020-0083', 31, '2020-08-19', 1, 120, '', 3, 0, 0, '2020-08-26 12:10:46'),
(92, 84, 'IN-26082020-0084', 30, '2020-08-19', 1, 125, '', 3, 0, 0, '2020-08-26 12:10:59'),
(93, 85, 'IN-26082020-0085', 29, '2020-08-19', 2, 1143, '', 3, 0, 0, '2020-08-26 12:12:00'),
(94, 86, 'IN-26082020-0086', 28, '2020-08-19', 1, 15, '', 3, 0, 0, '2020-08-26 12:12:17'),
(95, 87, 'IN-26082020-0087', 27, '2020-08-19', 1, 490, '', 3, 0, 0, '2020-08-26 12:12:32'),
(96, 88, 'IN-26082020-0088', 26, '2020-08-19', 1, 150, '', 3, 0, 0, '2020-08-26 12:12:50'),
(97, 89, 'IN-26082020-0089', 25, '2020-08-19', 1, 595, '', 3, 0, 0, '2020-08-26 12:13:05'),
(98, 90, 'IN-26082020-0090', 24, '2020-08-18', 1, 125, '', 3, 0, 0, '2020-08-26 12:13:24'),
(99, 91, 'IN-26082020-0091', 23, '2020-08-18', 1, 130, '', 3, 0, 0, '2020-08-26 12:13:39'),
(100, 92, 'IN-26082020-0092', 22, '2020-08-18', 1, 16, '', 3, 0, 0, '2020-08-26 12:13:53'),
(101, 93, 'IN-26082020-0093', 21, '2020-08-18', 1, 325, '', 3, 0, 0, '2020-08-26 12:14:06'),
(102, 94, 'IN-26082020-0094', 20, '2020-08-18', 1, 1415, '', 3, 0, 0, '2020-08-26 12:14:49'),
(103, 95, 'IN-26082020-0095', 19, '2020-08-17', 1, 460, '', 3, 0, 0, '2020-08-26 12:15:05'),
(104, 96, 'IN-29082020-0096', 96, '2020-08-26', 1, 130, '', 3, 0, 0, '2020-08-29 09:52:17'),
(105, 97, 'IN-29082020-0097', 97, '2020-08-26', 1, 996, '', 3, 0, 0, '2020-08-29 09:52:38'),
(106, 98, 'IN-29082020-0098', 98, '2020-08-26', 1, 770, '', 3, 0, 0, '2020-08-29 09:52:53'),
(107, 99, 'IN-29082020-0099', 99, '2020-08-26', 2, 765, '000028', 3, 0, 0, '2020-08-29 09:53:41'),
(108, 100, 'IN-29082020-0100', 100, '2020-08-26', 1, 300, '', 3, 0, 0, '2020-08-29 09:53:55'),
(109, 101, 'IN-29082020-0101', 101, '2020-08-26', 1, 250, '', 3, 0, 0, '2020-08-29 09:54:07'),
(110, 102, 'IN-29082020-0102', 102, '2020-08-26', 1, 1410, '', 3, 0, 0, '2020-08-29 09:54:18'),
(111, 103, 'IN-29082020-0103', 103, '2020-08-26', 1, 210, '', 3, 0, 0, '2020-08-29 09:54:38'),
(112, 104, 'IN-29082020-0104', 104, '2020-08-26', 1, 410, '', 3, 0, 0, '2020-08-29 09:54:50'),
(113, 105, 'IN-29082020-0105', 105, '2020-08-26', 1, 324, '', 3, 0, 0, '2020-08-29 09:55:04'),
(114, 106, 'IN-29082020-0106', 106, '2020-08-26', 1, 1434, '', 3, 0, 0, '2020-08-29 09:55:21'),
(115, 107, 'IN-29082020-0107', 107, '2020-08-26', 1, 110, '', 3, 0, 0, '2020-08-29 09:55:32'),
(116, 108, 'IN-29082020-0108', 108, '2020-08-27', 1, 850, '', 3, 0, 0, '2020-08-29 09:55:49'),
(117, 109, 'IN-29082020-0109', 109, '2020-08-27', 1, 435, '', 3, 0, 0, '2020-08-29 09:56:01'),
(118, 110, 'IN-29082020-0110', 110, '2020-08-27', 1, 1360, '', 3, 0, 0, '2020-08-29 09:56:13'),
(119, 111, 'IN-29082020-0111', 111, '2020-08-27', 2, 594, '000029', 3, 0, 0, '2020-08-29 09:56:47'),
(120, 112, 'IN-29082020-0112', 112, '2020-08-27', 2, 809, '000029', 3, 0, 0, '2020-08-29 09:57:02'),
(121, 113, 'IN-29082020-0113', 113, '2020-08-27', 1, 80, '', 3, 0, 0, '2020-08-29 09:57:20'),
(122, 114, 'IN-29082020-0114', 114, '2020-08-27', 1, 115, '', 3, 0, 0, '2020-08-29 09:57:34'),
(123, 115, 'IN-29082020-0115', 115, '2020-08-27', 2, 475, '', 3, 0, 0, '2020-08-29 09:59:30'),
(124, 116, 'IN-29082020-0116', 116, '2020-08-27', 1, 360, '', 3, 0, 0, '2020-08-29 09:59:49'),
(125, 117, 'IN-29082020-0117', 117, '2020-08-27', 1, 120, '', 3, 0, 0, '2020-08-29 10:00:06'),
(126, 118, 'IN-29082020-0118', 118, '2020-08-27', 1, 87, '', 3, 0, 0, '2020-08-29 10:00:15'),
(127, 119, 'IN-29082020-0119', 119, '2020-08-27', 2, 300, '000032', 3, 0, 0, '2020-08-29 10:01:01'),
(128, 120, 'IN-29082020-0120', 120, '2020-08-27', 2, 1293, '', 3, 0, 0, '2020-08-29 10:01:15'),
(129, 121, 'IN-29082020-0121', 121, '2020-08-27', 1, 145, '', 3, 0, 0, '2020-08-29 10:01:40'),
(130, 122, 'IN-29082020-0122', 122, '2020-08-28', 1, 205, '', 3, 0, 0, '2020-08-29 10:01:58'),
(131, 123, 'IN-29082020-0123', 123, '2020-08-28', 2, 843, '000034', 3, 0, 0, '2020-08-29 10:02:36'),
(132, 124, 'IN-29082020-0124', 124, '2020-08-28', 1, 150, '', 3, 0, 0, '2020-08-29 10:02:46'),
(133, 125, 'IN-29082020-0125', 125, '2020-08-28', 1, 911, '', 3, 0, 0, '2020-08-29 10:03:03'),
(134, 126, 'IN-29082020-0126', 126, '2020-08-28', 1, 655, '', 3, 0, 0, '2020-08-29 10:03:15'),
(135, 127, 'IN-29082020-0127', 127, '2020-08-28', 1, 239, '', 3, 0, 0, '2020-08-29 10:03:26'),
(136, 128, 'IN-29082020-0128', 128, '2020-08-28', 1, 516, '', 3, 0, 0, '2020-08-29 10:03:38'),
(137, 129, 'IN-29082020-0129', 129, '2020-08-28', 1, 483, '', 3, 0, 0, '2020-08-29 10:03:51'),
(138, 130, 'IN-29082020-0130', 130, '2020-08-28', 1, 619, '', 3, 0, 0, '2020-08-29 10:04:13'),
(139, 131, 'IN-29082020-0131', 131, '2020-08-28', 1, 430, '', 3, 0, 0, '2020-08-29 10:04:27'),
(140, 132, 'IN-29082020-0132', 132, '2020-08-28', 2, 202, '000036', 3, 0, 0, '2020-08-29 10:04:53'),
(141, 133, 'IN-29082020-0133', 133, '2020-08-28', 2, 480, '000037', 3, 0, 0, '2020-08-29 10:05:16'),
(142, 134, 'IN-29082020-0134', 134, '2020-08-28', 2, 745, '000038', 3, 0, 0, '2020-08-29 10:05:35'),
(143, 135, 'IN-29082020-0135', 135, '2020-08-28', 1, 110, '', 3, 0, 0, '2020-08-29 10:05:49'),
(144, 136, 'IN-29082020-0136', 136, '2020-08-28', 1, 1259, '', 3, 0, 0, '2020-08-29 10:06:06'),
(145, 137, 'IN-29082020-0137', 137, '2020-08-28', 2, 3240, '', 3, 0, 0, '2020-08-29 10:06:20'),
(146, 138, 'IN-29082020-0138', 77, '2020-08-28', 2, 1255, '', 3, 0, 0, '2020-08-29 11:32:20'),
(147, 139, 'IN-19122020-0139', 2731, '2020-12-19', 1, 2899, 'Not paid', 3, 0, 0, '2020-12-19 12:20:38'),
(148, 140, 'IN-19122020-0140', 2256, '2020-12-19', 5, 340, 'Paid', 3, 0, 0, '2020-12-19 14:55:47'),
(149, 141, 'IN-19122020-0141', 2257, '2020-12-19', 1, 215, 'Paid', 3, 0, 0, '2020-12-19 14:56:11'),
(150, 142, 'IN-19122020-0142', 2258, '2020-12-19', 1, 635, 'Paid', 3, 0, 0, '2020-12-19 14:56:37'),
(151, 143, 'IN-19122020-0143', 2259, '2020-12-19', 1, 978, 'Paid', 3, 0, 0, '2020-12-19 14:57:08'),
(152, 144, 'IN-19122020-0144', 2260, '2020-12-01', 1, 236, 'Paid', 3, 0, 0, '2020-12-19 14:58:06'),
(153, 145, 'IN-19122020-0145', 2261, '2020-12-01', 1, 130, 'Paid', 3, 0, 0, '2020-12-19 15:05:24'),
(154, 146, 'IN-19122020-0146', 2262, '2020-12-01', 1, 70, 'Paid', 3, 0, 0, '2020-12-19 15:06:08'),
(155, 147, 'IN-19122020-0147', 2263, '2020-12-01', 1, 130, 'Paid', 3, 0, 0, '2020-12-19 15:07:28'),
(156, 148, 'IN-19122020-0148', 2264, '2020-12-01', 1, 120, 'Paid', 3, 0, 0, '2020-12-19 15:07:57'),
(157, 149, 'IN-19122020-0149', 2265, '2020-12-01', 2, 414, 'Received', 3, 0, 0, '2020-12-19 15:08:25'),
(158, 150, 'IN-19122020-0150', 2266, '2020-12-01', 1, 110, 'Received', 3, 0, 0, '2020-12-19 15:08:46'),
(159, 151, 'IN-19122020-0151', 2267, '2020-12-01', 5, 345, 'Received', 3, 0, 0, '2020-12-19 15:28:09'),
(160, 152, 'IN-19122020-0152', 2268, '2020-12-01', 5, 395, '', 3, 0, 0, '2020-12-19 15:30:10'),
(161, 153, 'IN-19122020-0153', 2269, '2020-12-01', 1, 97, 'Paid', 3, 0, 0, '2020-12-19 15:30:55'),
(162, 154, 'IN-19122020-0154', 2270, '2020-12-01', 1, 40, 'Received', 3, 0, 0, '2020-12-19 15:31:38'),
(163, 155, 'IN-19122020-0155', 2271, '2020-12-01', 1, 100, 'Received', 3, 0, 0, '2020-12-19 15:32:11'),
(164, 156, 'IN-19122020-0156', 2272, '2020-12-01', 1, 480, 'Received', 3, 0, 0, '2020-12-19 15:34:25'),
(165, 157, 'IN-19122020-0157', 2273, '2020-12-01', 1, 1493, 'Received', 3, 0, 0, '2020-12-19 15:38:25'),
(166, 158, 'IN-19122020-0158', 2274, '2020-12-01', 5, 120, '', 3, 0, 0, '2020-12-19 15:39:05'),
(167, 159, 'IN-19122020-0159', 2275, '2020-12-01', 1, 1885, 'Received', 3, 0, 0, '2020-12-19 15:51:36'),
(168, 160, 'IN-19122020-0160', 2276, '2020-12-01', 1, 1095, 'Received', 3, 0, 0, '2020-12-19 15:52:19'),
(169, 161, 'IN-19122020-0161', 2277, '2020-12-01', 1, 120, 'Received', 3, 0, 0, '2020-12-19 15:52:50'),
(170, 162, 'IN-19122020-0162', 2278, '2020-12-02', 2, 230, 'Received', 3, 0, 0, '2020-12-19 15:54:08'),
(171, 163, 'IN-19122020-0163', 2279, '2020-12-02', 1, 160, 'Received\n\n', 3, 0, 0, '2020-12-19 15:54:49'),
(172, 164, 'IN-19122020-0164', 2280, '2020-12-02', 1, 1222, 'Received', 3, 0, 0, '2020-12-19 15:55:29'),
(173, 165, 'IN-19122020-0165', 2281, '2020-12-02', 1, 310, 'Received', 3, 0, 0, '2020-12-19 15:55:59'),
(174, 166, 'IN-19122020-0166', 2282, '2020-12-02', 5, 1091, '', 3, 0, 0, '2020-12-19 15:57:01'),
(175, 167, 'IN-19122020-0167', 2283, '2020-12-02', 2, 485, '', 3, 0, 0, '2020-12-19 15:59:00'),
(176, 168, 'IN-19122020-0168', 2284, '2020-12-02', 5, 300, '', 3, 0, 0, '2020-12-19 16:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `payment_status_id` int(11) NOT NULL,
  `payment_status_name` varchar(25) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`payment_status_id`, `payment_status_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Pending', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Paid', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL,
  `payment_type_name` varchar(25) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`payment_type_id`, `payment_type_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Cash', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Card', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'BTC', 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'Credit', 0, 0, 0, '0000-00-00 00:00:00'),
(5, 'GPay', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prescribed_products`
--

CREATE TABLE `prescribed_products` (
  `prescribed_products_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `ref_product_id` int(11) NOT NULL,
  `ref_product_batch_id` int(11) NOT NULL,
  `available_quantity` varchar(50) NOT NULL,
  `selected_quantity` int(11) NOT NULL,
  `type` enum('NOS','ML','Drop') NOT NULL,
  `time` enum('Before Food','After Food','To Apply') NOT NULL,
  `morning` varchar(10) NOT NULL,
  `afternoon` varchar(10) NOT NULL,
  `evening` varchar(10) NOT NULL,
  `night` varchar(10) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `ref_patient_id` int(11) NOT NULL,
  `ref_patient_visit_id` int(11) NOT NULL,
  `invoice_status` int(1) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `priority_id` int(11) NOT NULL,
  `priority_name` varchar(20) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`priority_id`, `priority_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Low', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Medium', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'High', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `ref_branch_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL COMMENT 'Product',
  `product_size` int(11) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `schedule` varchar(25) NOT NULL,
  `ref_category_id` int(11) NOT NULL COMMENT 'Category',
  `ref_gst_type_id` int(11) NOT NULL COMMENT 'GST',
  `product_price` float(10,2) NOT NULL COMMENT 'Price',
  `sku` varchar(15) NOT NULL COMMENT 'SKU',
  `ref_stock_room_id` int(11) NOT NULL,
  `ref_stock_slot_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'Quantity',
  `ref_quantity_type_id` int(11) NOT NULL,
  `product_image_file` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ref_star_rating_id` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `reorder_status` int(1) NOT NULL COMMENT '0-Pending,1-Processing,3-Completed',
  `featured_product` tinyint(1) NOT NULL,
  `display_homepage` int(11) NOT NULL,
  `supplier_comm_perc` decimal(10,0) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `ref_branch_id`, `product_name`, `product_size`, `unit`, `schedule`, `ref_category_id`, `ref_gst_type_id`, `product_price`, `sku`, `ref_stock_room_id`, `ref_stock_slot_id`, `quantity`, `ref_quantity_type_id`, `product_image_file`, `description`, `ref_star_rating_id`, `expiry_date`, `reorder_level`, `reorder_status`, `featured_product`, `display_homepage`, `supplier_comm_perc`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(1, 0, 'test', 0, '234', '', 7, 3, 100.00, '32423', 2, 20, 33, 2, '', '', 1, '0000-00-00', 100, 1, 0, 0, '0', 0, 1, 0, '2022-06-13 13:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_batch`
--

CREATE TABLE `product_batch` (
  `product_batch_id` int(11) NOT NULL,
  `ref_branch_id` int(11) NOT NULL,
  `ref_purchase_order_id` int(11) NOT NULL,
  `ref_product_id` int(11) NOT NULL,
  `product_batch_name` varchar(25) NOT NULL,
  `quantity` int(11) NOT NULL,
  `avail_quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `manufacture_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_batch`
--

INSERT INTO `product_batch` (`product_batch_id`, `ref_branch_id`, `ref_purchase_order_id`, `ref_product_id`, `product_batch_name`, `quantity`, `avail_quantity`, `price`, `manufacture_date`, `expiry_date`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 1, 0, 1, '', 0, 0, 0.00, '1970-01-01', '1970-01-01', 1, 0, 0, '2022-06-13 13:34:11'),
(2, 0, 1, 1, '123', 10, 10, 100.00, '2022-06-13', '2022-06-30', 1, 0, 0, '2022-06-13 14:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_group`
--

CREATE TABLE `product_group` (
  `product_group_id` int(11) NOT NULL,
  `product_group_name` varchar(50) NOT NULL COMMENT 'Product Group',
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_group`
--

INSERT INTO `product_group` (`product_group_id`, `product_group_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Spindle Tape', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Power Transmission', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'Conveyor', 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'Printing Blanket', 0, 0, 0, '0000-00-00 00:00:00'),
(5, 'Timing Belt', 0, 0, 0, '0000-00-00 00:00:00'),
(6, 'Plastic Modular / Modules', 0, 0, 0, '0000-00-00 00:00:00'),
(7, 'Chain Drive / Modules', 0, 0, 0, '0000-00-00 00:00:00'),
(8, 'Clean Drive', 0, 0, 0, '0000-00-00 00:00:00'),
(9, 'Tools & Accessories', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_quality_size`
--

CREATE TABLE `product_quality_size` (
  `product_quality_size_id` int(11) NOT NULL,
  `product_quality_size_name` varchar(50) NOT NULL COMMENT 'Product Size',
  `ref_product_id` int(11) NOT NULL COMMENT 'Product',
  `ref_supplier_id` int(11) NOT NULL COMMENT 'Supplier',
  `delete_status` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_request_document`
--

CREATE TABLE `product_request_document` (
  `product_request_document_id` int(11) NOT NULL,
  `ref_product_sample_request_id` int(11) NOT NULL,
  `product_request_document_name` varchar(100) NOT NULL,
  `product_request_document_file` varchar(255) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_request_document`
--

INSERT INTO `product_request_document` (`product_request_document_id`, `ref_product_sample_request_id`, `product_request_document_name`, `product_request_document_file`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 1, 'AAAAAAAA', 'uploads/product_docs/1534167569_744_AAAAAAAA.pdf', 1, 1, 0, '2018-08-13 19:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_request_status`
--

CREATE TABLE `product_request_status` (
  `product_request_status_id` int(11) NOT NULL,
  `product_request_status_name` varchar(50) NOT NULL COMMENT 'Product Request Status',
  `delete_status` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_request_status`
--

INSERT INTO `product_request_status` (`product_request_status_id`, `product_request_status_name`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(1, 'Yet To Receive', 0, 3, 0, '2018-07-30 12:49:32'),
(2, 'Waiting For Feedback', 0, 3, 0, '2018-07-30 12:49:43'),
(3, 'Closed', 0, 3, 0, '2018-07-31 07:08:07'),
(4, 'Material Received & Waiting for Installation', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_sample_request`
--

CREATE TABLE `product_sample_request` (
  `product_sample_request_id` int(11) NOT NULL,
  `product_sample_request_code` varchar(20) NOT NULL COMMENT 'SOF No',
  `product_sample_request_no` varchar(4) NOT NULL,
  `product_sample_request_date` datetime NOT NULL COMMENT 'Date',
  `ref_client_id` int(11) NOT NULL COMMENT 'Customer',
  `ref_sample_request_category_id` int(11) NOT NULL COMMENT 'Category',
  `ref_supplier_id` int(11) NOT NULL COMMENT 'Supplier',
  `product_sample_request_details` varchar(100) NOT NULL,
  `ref_delivery_point_id` int(11) NOT NULL,
  `ref_despatch_mode_id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `schedule_date` date NOT NULL,
  `special_instruction` text NOT NULL,
  `dispatch_date` date NOT NULL,
  `delivered_date` date NOT NULL,
  `installation_date` date NOT NULL,
  `reminder_date` date NOT NULL,
  `ref_feedback_id` int(11) NOT NULL,
  `client_feedback` varchar(150) NOT NULL,
  `ref_product_request_status_id` int(11) NOT NULL,
  `mail_status` int(11) NOT NULL,
  `product_sample_request_name` varchar(25) NOT NULL,
  `product_sample_request_file` varchar(255) NOT NULL,
  `delivery_challan_status` int(1) NOT NULL,
  `inward_status` int(1) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_sample_request`
--

INSERT INTO `product_sample_request` (`product_sample_request_id`, `product_sample_request_code`, `product_sample_request_no`, `product_sample_request_date`, `ref_client_id`, `ref_sample_request_category_id`, `ref_supplier_id`, `product_sample_request_details`, `ref_delivery_point_id`, `ref_despatch_mode_id`, `tag`, `schedule_date`, `special_instruction`, `dispatch_date`, `delivered_date`, `installation_date`, `reminder_date`, `ref_feedback_id`, `client_feedback`, `ref_product_request_status_id`, `mail_status`, `product_sample_request_name`, `product_sample_request_file`, `delivery_challan_status`, `inward_status`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(1, 'STS/PRIP/0001/2018', '0001', '2018-10-02 00:00:00', 10, 1, 22, 'most urgennt', 0, 3, '', '2018-10-10', '', '1970-01-01', '2018-10-17', '2018-10-18', '2018-10-25', 0, '', 2, 0, '', 'uploads/product_sample_request/STS_PRIP_0001_2018_1540617319.pdf', 0, 0, 1, 3, 0, 2018),
(2, 'STS/PRIP/0002/2018', '0002', '2018-11-03 00:00:00', 103, 2, 22, 'URGENT', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0002_2018_1541827428.pdf', 1, 0, 0, 3, 0, 2018),
(3, 'STS/PRIP/0003/2018', '0003', '2018-11-03 00:00:00', 16, 4, 22, 'Against Aprons Buckling Cut Complaint', 0, 3, '', '1970-01-01', '', '1970-01-01', '2018-11-08', '2018-12-20', '2019-01-12', 0, '', 2, 0, '', 'uploads/product_sample_request/STS_PRIP_0003_2018_1541828516.pdf', 1, 0, 0, 3, 0, 2019),
(4, 'STSM/AGMA/0004/2018', '0004', '2018-11-22 00:00:00', 103, 1, 31, 'SUESSEN COMPACT RING FRAME (25MM  TOP ROLLER DIA)  (For 300 Spindles With Used Aprons)', 0, 3, '', '2018-11-25', '', '1970-01-01', '2018-11-28', '2018-12-06', '2019-01-10', 3, 'Not Satisfied \n\n', 3, 0, '', 'uploads/product_sample_request/STSM_AGMA_0004_2018_1542887758.pdf', 1, 0, 0, 3, 0, 2019),
(5, 'STS/PRIP/0005/2018', '0005', '2018-11-24 00:00:00', 64, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0005_2018_1544012045.pdf', 1, 0, 0, 3, 0, 2018),
(6, 'STS/PRIP/0006/2018', '0006', '2018-11-26 00:00:00', 64, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0006_2018_1544012129.pdf', 1, 0, 0, 3, 0, 2018),
(7, 'STS/PRIP/0007/2018', '0007', '2018-12-03 00:00:00', 68, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0007_2018_1544012204.pdf', 1, 0, 0, 3, 0, 2018),
(8, 'STS/PRIP/0008/2018', '0008', '2018-12-04 00:00:00', 68, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0008_2018_1544012318.pdf', 1, 0, 0, 3, 0, 2018),
(9, 'STSA/AAAPL/0009/2018', '0009', '1970-01-01 05:30:00', 237, 1, 28, 'SL.NO.1 SUITABLE FOR  KTTM RING FRAME                       \n\nSL.NO.2 SUITABLE FOR LMW RING FRAME', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 1, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0009_2018_1544013412.pdf', 0, 0, 1, 3, 0, 2018),
(10, 'STSA/AAAPL/0010/2018', '0010', '2018-12-05 00:00:00', 237, 1, 28, 'SL.NO. 1 SUITABLE FOE KTTM RING FRAME                       SL.NO.2  SUITABLE FOR LMW RING FRAME ', 1, 2, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0010_2018_1544076884.pdf', 1, 0, 0, 3, 0, 2018),
(11, 'STSA/AAAPL/0011/2018', '0011', '2018-12-05 00:00:00', 30, 1, 28, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0011_2018_1545653355.pdf', 1, 0, 0, 3, 0, 2018),
(12, 'STSA/AAAPL/0012/2018', '0012', '2018-12-05 00:00:00', 64, 1, 28, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0012_2018_1545653421.pdf', 1, 0, 0, 3, 0, 2018),
(13, 'STSA/AAAPL/0013/2018', '0013', '2018-12-05 00:00:00', 8, 1, 28, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0013_2018_1545653473.pdf', 1, 0, 0, 3, 0, 2018),
(14, 'STSA/AAAPL/0014/2018', '0014', '2018-12-05 00:00:00', 56, 1, 28, '', 1, 2, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0014_2018_1545653518.pdf', 1, 0, 0, 3, 0, 2018),
(15, 'STSA/AAAPL/0015/2018', '0015', '2018-12-05 00:00:00', 164, 1, 28, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0015_2018_1545653581.pdf', 1, 0, 0, 3, 0, 2018),
(16, 'STSA/AAAPL/0016/2018', '0016', '2018-12-05 00:00:00', 28, 1, 28, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0016_2018_1545653618.pdf', 1, 0, 0, 3, 0, 2018),
(17, 'STSA/AAAPL/0017/2018', '0017', '2018-12-05 00:00:00', 55, 1, 28, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0017_2018_1545653660.pdf', 1, 0, 0, 3, 0, 2018),
(18, 'STSA/AAAPL/0018/2018', '0018', '2018-12-05 00:00:00', 128, 1, 28, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0018_2018_1545653712.pdf', 1, 0, 0, 3, 0, 2018),
(19, 'STSA/AAAPL/0019/2018', '0019', '2018-12-05 00:00:00', 189, 1, 28, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 1, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0019_2018_1545653770.pdf', 0, 0, 1, 3, 0, 2018),
(20, 'STSA/AAAPL/0020/2018', '0020', '2018-12-05 00:00:00', 62, 1, 28, '', 0, 3, '', '1970-01-01', '', '1970-01-01', '2018-12-18', '2019-01-04', '2019-02-05', 1, 'Labour says working performance ok. MI   says i will check Quality and update.', 3, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0020_2018_1545653856.pdf', 1, 0, 0, 3, 0, 2019),
(21, 'STS/PRIP/0021/2018', '0021', '2018-11-23 00:00:00', 37, 1, 22, '', 0, 3, '', '1970-01-01', '', '1970-01-01', '2018-11-25', '2018-11-27', '2019-01-18', 1, 'They will place order during next schedule ', 3, 0, '', 'uploads/product_sample_request/STS_PRIP_0021_2018_1545725027.pdf', 1, 0, 0, 3, 0, 2019),
(22, 'STS/PRIP/0022/2018', '0022', '2018-12-13 00:00:00', 12, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 1, 0, '', 'uploads/product_sample_request/STS_PRIP_0022_2018_1545725125.pdf', 0, 0, 0, 3, 0, 2018),
(23, 'STS/PRIP/0023/2018', '0023', '2018-12-17 00:00:00', 43, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 1, 0, '', 'uploads/product_sample_request/STS_PRIP_0023_2018_1545807996.pdf', 0, 0, 0, 3, 0, 2018),
(24, 'STS/PRIP/0024/2018', '0024', '2018-12-17 00:00:00', 43, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0024_2018_1545814723.pdf', 1, 0, 0, 3, 0, 2018),
(25, 'STS/PRIP/0025/2018', '0025', '2018-12-18 00:00:00', 56, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0025_2018_1545814622.pdf', 1, 0, 0, 3, 0, 2019),
(26, 'STS/PRIP/0026/2018', '0026', '2018-12-18 00:00:00', 64, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 1, 0, '', 'uploads/product_sample_request/STS_PRIP_0026_2018_1545814597.pdf', 0, 0, 0, 3, 0, 2018),
(27, 'STS/PRIP/0027/2018', '0027', '2018-12-20 00:00:00', 64, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0027_2018_1545814552.pdf', 1, 0, 0, 3, 0, 2018),
(28, 'STS/PRIP/0028/2018', '0028', '2018-12-26 00:00:00', 23, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0028_2018_1546263534.pdf', 1, 0, 0, 3, 0, 2018),
(29, 'STSA/AAAPL/0029/2019', '0029', '2018-12-28 00:00:00', 60, 1, 28, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0029_2019_1546432643.pdf', 1, 0, 0, 3, 0, 2019),
(30, 'STSA/AAAPL/0030/2019', '0030', '2018-12-28 00:00:00', 94, 1, 28, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0030_2019_1546432703.pdf', 1, 0, 0, 3, 0, 2019),
(31, 'STS/PRIP/0031/2019', '0031', '2018-12-22 00:00:00', 182, 1, 22, '', 0, 3, '', '1970-01-01', '', '1970-01-01', '2018-12-27', '2019-01-04', '2019-01-10', 0, '', 2, 0, '', 'uploads/product_sample_request/STS_PRIP_0031_2019_1547276639.pdf', 1, 0, 0, 3, 0, 2019),
(32, 'STS/PRIP/0032/2019', '0032', '2018-12-28 00:00:00', 43, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0032_2019_1548132742.pdf', 1, 0, 0, 3, 0, 2019),
(33, 'STS/PRIP/0033/2019', '0033', '2019-01-07 00:00:00', 82, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0033_2019_1548132719.pdf', 1, 0, 0, 3, 0, 2019),
(34, 'STS/PRIP/0034/2019', '0034', '2019-01-11 00:00:00', 122, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0034_2019_1547276851.pdf', 1, 0, 0, 3, 0, 2019),
(35, 'STS/PRIP/0035/2019', '0035', '2019-01-12 00:00:00', 98, 1, 22, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0035_2019_1547803294.pdf', 1, 0, 0, 3, 0, 2019),
(36, 'STS/PRIP/0036/2019', '0036', '2019-01-12 00:00:00', 18, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0036_2019_1547803195.pdf', 1, 0, 0, 3, 0, 2019),
(37, 'STS/PRIP/0037/2019', '0037', '2019-01-18 00:00:00', 3, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0037_2019_1548132681.pdf', 1, 0, 0, 3, 0, 2019),
(38, 'STSA/AAAPL/0038/2019', '0038', '1970-01-01 05:30:00', 229, 1, 28, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0038_2019_1548164469.pdf', 1, 0, 0, 3, 0, 2019),
(39, 'STSM/VP/0039/2019', '0039', '1970-01-01 05:30:00', 55, 1, 47, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSM_VP_0039_2019_1548423313.pdf', 1, 0, 0, 3, 0, 2019),
(40, 'STS/PRIP/0040/2019', '0040', '2019-01-28 00:00:00', 105, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0040_2019_1549286215.pdf', 1, 0, 0, 3, 0, 2019),
(41, 'STSA/AAAPL/0041/2019', '0041', '2019-02-03 00:00:00', 57, 1, 28, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0041_2019_1549459742.pdf', 1, 0, 0, 3, 0, 2019),
(42, 'STS/PRIP/0042/2019', '0042', '1970-01-01 05:30:00', 3, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0042_2019_1550237395.pdf', 1, 0, 0, 3, 0, 2019),
(43, 'STS/PRIP/0043/2019', '0043', '2019-02-12 00:00:00', 182, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0043_2019_1549977638.pdf', 1, 0, 0, 3, 0, 2019),
(44, 'STS/PRIP/0044/2019', '0044', '2019-02-01 00:00:00', 46, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 1, 0, '', 'uploads/product_sample_request/STS_PRIP_0044_2019_1550147686.pdf', 0, 0, 0, 3, 0, 2019),
(45, 'STS/PRIP/0045/2019', '0045', '2019-02-01 00:00:00', 46, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 1, 0, '', 'uploads/product_sample_request/STS_PRIP_0045_2019_1550147781.pdf', 0, 0, 0, 3, 0, 2019),
(46, 'STS/PRIP/0046/2019', '0046', '2019-02-05 00:00:00', 28, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0046_2019_1550148083.pdf', 1, 0, 0, 3, 0, 2019),
(47, 'STS/PRIP/0047/2019', '0047', '2019-02-14 00:00:00', 165, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 1, 0, '', 'uploads/product_sample_request/STS_PRIP_0047_2019_1550148512.pdf', 0, 0, 0, 3, 0, 2019),
(48, 'STS/PRIP/0048/2019', '0048', '2019-02-14 00:00:00', 23, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0048_2019_1550148647.pdf', 1, 0, 0, 3, 0, 2019),
(49, 'STS/PRIP/0049/2019', '0049', '2019-02-13 00:00:00', 204, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 1, 0, '', 'uploads/product_sample_request/STS_PRIP_0049_2019_1550148767.pdf', 0, 0, 0, 3, 0, 2019),
(50, 'STSA/VXL/0050/2019', '0050', '2019-02-13 00:00:00', 11, 1, 37, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_VXL_0050_2019_1550233894.pdf', 1, 0, 1, 3, 0, 2019),
(51, 'STSA/VXL/0051/2019', '0051', '1970-01-01 05:30:00', 11, 1, 37, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_VXL_0051_2019_1550236196.pdf', 1, 0, 0, 3, 0, 2019),
(52, 'STSA/VXL/0052/2019', '0052', '1970-01-01 05:30:00', 139, 1, 37, '', 0, 3, '', '1970-01-01', '', '1970-01-01', '2019-02-15', '2019-02-19', '2019-02-25', 0, '', 2, 0, '', 'uploads/product_sample_request/STSA_VXL_0052_2019_1550236049.pdf', 1, 0, 0, 3, 0, 2019),
(53, 'STSA/AAAPL/0053/2019', '0053', '2019-02-13 00:00:00', 188, 1, 28, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0053_2019_1551360529.pdf', 1, 0, 0, 3, 0, 2019),
(54, 'STSA/AAAPL/0054/2019', '0054', '2019-03-13 00:00:00', 98, 1, 28, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0054_2019_1552637179.pdf', 1, 0, 0, 3, 0, 2019),
(55, 'STSA/AAAPL/0055/2019', '0055', '2019-03-01 00:00:00', 31, 1, 28, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0055_2019_1551789904.pdf', 1, 0, 0, 3, 0, 2019),
(56, 'STSA/AAAPL/0056/2019', '0056', '2019-03-01 00:00:00', 134, 1, 28, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0056_2019_1551790188.pdf', 1, 0, 0, 3, 0, 2019),
(57, 'STSA/AAAPL/0057/2019', '0057', '2019-03-01 00:00:00', 69, 1, 28, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0057_2019_1551793315.pdf', 1, 0, 0, 3, 0, 2019),
(58, 'STSA/AAAPL/0058/2019', '0058', '2019-03-13 00:00:00', 98, 1, 28, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_AAAPL_0058_2019_1552726767.pdf', 1, 0, 0, 3, 0, 2019),
(59, 'STSA/VXL-II/0059/201', '0059', '2019-03-15 00:00:00', 2, 1, 38, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_VXL-II_0059_201_1552913821.pdf', 1, 0, 0, 3, 0, 2019),
(60, 'STS/PRIP/0060/2019', '0060', '1970-01-01 05:30:00', 96, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0060_2019_1554724568.pdf', 1, 0, 0, 3, 0, 2019),
(61, 'STS/PRIP/0061/2019', '0061', '2019-03-04 00:00:00', 234, 1, 22, '', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0061_2019_1554723471.pdf', 1, 0, 0, 3, 0, 2019),
(62, 'STS/PRIP/0062/2019', '0062', '2019-03-25 00:00:00', 224, 1, 22, 'STRAIGHT  EGDE  - FINISH', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0062_2019_1554724915.pdf', 1, 0, 0, 3, 0, 2019),
(63, 'STS/PRIP/0063/2019', '0063', '1970-01-01 05:30:00', 91, 1, 22, 'STRAIGHT EDGE', 2, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STS_PRIP_0063_2019_1554817543.pdf', 1, 0, 0, 3, 0, 2019),
(64, 'STSA/VXL-II/0064/201', '0064', '2019-04-13 00:00:00', 98, 1, 38, '', 1, 3, '', '1970-01-01', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, '', 4, 0, '', 'uploads/product_sample_request/STSA_VXL-II_0064_201_1555132938.pdf', 1, 0, 0, 3, 0, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `product_sample_request_particulars`
--

CREATE TABLE `product_sample_request_particulars` (
  `product_sample_request_particulars_id` int(11) NOT NULL,
  `ref_product_sample_request_id` int(11) NOT NULL,
  `ref_product_id` int(11) NOT NULL,
  `ref_product_quality_id` int(11) NOT NULL,
  `ref_product_quality_size_id` int(11) NOT NULL,
  `ref_product_variety_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `delivered_qty` int(11) NOT NULL,
  `damaged_qty` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_sample_request_particulars`
--

INSERT INTO `product_sample_request_particulars` (`product_sample_request_particulars_id`, `ref_product_sample_request_id`, `ref_product_id`, `ref_product_quality_id`, `ref_product_quality_size_id`, `ref_product_variety_id`, `qty`, `delivered_qty`, `damaged_qty`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 1, 21, 223, 12, 3, 10, 0, 0, 0, 0, 0, '2018-10-27 10:45:19'),
(2, 2, 21, 226, 29, 1, 24, 0, 0, 0, 0, 0, '2018-11-10 10:53:48'),
(3, 2, 21, 226, 56, 1, 24, 0, 0, 0, 0, 0, '2018-11-10 10:53:48'),
(4, 2, 21, 228, 29, 1, 24, 0, 0, 0, 0, 0, '2018-11-10 10:53:48'),
(5, 2, 21, 228, 56, 1, 24, 0, 0, 0, 0, 0, '2018-11-10 10:53:48'),
(6, 2, 21, 219, 31, 1, 48, 0, 0, 0, 0, 0, '2018-11-10 10:53:48'),
(7, 3, 23, 245, 184, 9, 100, 0, 0, 0, 0, 0, '2018-11-10 11:11:56'),
(8, 4, 35, 0, 745, 0, 150, 0, 0, 0, 0, 0, '2018-11-22 17:25:58'),
(9, 5, 21, 218, 31, 2, 50, 0, 0, 0, 0, 0, '2018-12-05 17:44:04'),
(10, 5, 21, 219, 31, 1, 50, 0, 0, 0, 0, 0, '2018-12-05 17:44:04'),
(11, 5, 21, 218, 54, 1, 50, 0, 0, 0, 0, 0, '2018-12-05 17:44:04'),
(12, 5, 21, 218, 16, 1, 50, 0, 0, 0, 0, 0, '2018-12-05 17:44:04'),
(13, 6, 21, 226, 31, 2, 24, 0, 0, 0, 0, 0, '2018-12-05 17:45:28'),
(14, 6, 21, 219, 31, 1, 24, 0, 0, 0, 0, 0, '2018-12-05 17:45:28'),
(15, 7, 21, 224, 34, 1, 10, 0, 0, 0, 0, 0, '2018-12-05 17:46:44'),
(16, 8, 21, 226, 34, 1, 10, 0, 0, 0, 0, 0, '2018-12-05 17:48:38'),
(19, 9, 47, 321, 0, 0, 50, 0, 0, 0, 0, 0, '2018-12-05 18:06:52'),
(20, 9, 47, 322, 0, 0, 50, 0, 0, 0, 0, 0, '2018-12-05 18:06:52'),
(23, 10, 47, 321, 0, 0, 50, 0, 0, 0, 0, 0, '2018-12-06 11:44:43'),
(24, 10, 47, 322, 0, 0, 50, 0, 0, 0, 0, 0, '2018-12-06 11:44:43'),
(25, 11, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:39:15'),
(26, 11, 47, 321, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:39:15'),
(27, 12, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:40:21'),
(28, 13, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:41:13'),
(29, 14, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:41:58'),
(30, 15, 47, 321, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:43:01'),
(31, 15, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:43:01'),
(32, 16, 47, 321, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:43:38'),
(33, 17, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:44:20'),
(34, 18, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:45:12'),
(35, 18, 47, 321, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:45:12'),
(36, 19, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:46:10'),
(37, 20, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2018-12-24 17:47:36'),
(40, 21, 23, 241, 193, 0, 4, 0, 0, 0, 0, 0, '2018-12-25 13:33:47'),
(41, 21, 23, 242, 136, 0, 4, 0, 0, 0, 0, 0, '2018-12-25 13:33:47'),
(42, 22, 21, 228, 31, 1, 24, 0, 0, 0, 0, 0, '2018-12-25 13:35:25'),
(43, 22, 21, 219, 31, 3, 24, 0, 0, 0, 0, 0, '2018-12-25 13:35:25'),
(44, 23, 23, 239, 151, 9, 10, 0, 0, 0, 0, 0, '2018-12-26 12:36:35'),
(58, 27, 21, 323, 27, 0, 24, 0, 0, 0, 0, 0, '2018-12-26 14:25:52'),
(59, 27, 21, 223, 27, 0, 24, 0, 0, 0, 0, 0, '2018-12-26 14:25:52'),
(60, 27, 21, 323, 58, 0, 24, 0, 0, 0, 0, 0, '2018-12-26 14:25:52'),
(61, 27, 21, 223, 58, 0, 24, 0, 0, 0, 0, 0, '2018-12-26 14:25:52'),
(62, 27, 21, 219, 31, 0, 24, 0, 0, 0, 0, 0, '2018-12-26 14:25:52'),
(63, 26, 21, 223, 31, 0, 25, 0, 0, 0, 0, 0, '2018-12-26 14:26:37'),
(64, 25, 21, 228, 37, 0, 100, 0, 0, 0, 0, 0, '2018-12-26 14:27:02'),
(65, 25, 21, 219, 37, 0, 100, 0, 0, 0, 0, 0, '2018-12-26 14:27:02'),
(66, 25, 23, 241, 192, 0, 50, 0, 0, 0, 0, 0, '2018-12-26 14:27:02'),
(67, 25, 23, 244, 192, 0, 50, 0, 0, 0, 0, 0, '2018-12-26 14:27:02'),
(68, 25, 23, 239, 144, 0, 100, 0, 0, 0, 0, 0, '2018-12-26 14:27:02'),
(69, 24, 23, 242, 151, 0, 10, 0, 0, 0, 0, 0, '2018-12-26 14:28:43'),
(70, 24, 23, 234, 151, 0, 10, 0, 0, 0, 0, 0, '2018-12-26 14:28:43'),
(71, 28, 21, 224, 31, 2, 40, 0, 0, 0, 0, 0, '2018-12-31 19:08:54'),
(72, 29, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2019-01-02 18:07:23'),
(73, 30, 47, 322, 0, 0, 5, 0, 0, 0, 0, 0, '2019-01-02 18:08:23'),
(74, 31, 23, 244, 195, 9, 24, 48, 0, 0, 0, 0, '2019-01-12 12:33:59'),
(75, 31, 23, 238, 136, 9, 24, 48, 0, 0, 0, 0, '2019-01-12 12:33:59'),
(78, 34, 21, 225, 31, 3, 12, 0, 0, 0, 0, 0, '2019-01-12 12:37:31'),
(79, 34, 21, 225, 31, 1, 12, 0, 0, 0, 0, 0, '2019-01-12 12:37:31'),
(82, 36, 23, 239, 136, 9, 270, 270, 0, 0, 0, 0, '2019-01-18 14:49:55'),
(83, 35, 23, 242, 136, 9, 210, 210, 0, 0, 0, 0, '2019-01-18 14:51:34'),
(93, 37, 21, 224, 34, 1, 12, 0, 0, 0, 0, 0, '2019-01-22 10:21:21'),
(94, 37, 21, 230, 34, 1, 12, 0, 0, 0, 0, 0, '2019-01-22 10:21:21'),
(95, 33, 23, 236, 192, 9, 10, 0, 0, 0, 0, 0, '2019-01-22 10:21:59'),
(96, 32, 23, 237, 842, 9, 2, 0, 0, 0, 0, 0, '2019-01-22 10:22:22'),
(98, 38, 47, 321, 0, 81, 5, 5, 0, 0, 0, 0, '2019-01-22 19:11:09'),
(104, 39, 98, 0, 1019, 0, 2, 2, 0, 0, 0, 0, '2019-01-25 19:05:13'),
(105, 40, 21, 218, 31, 2, 24, 48, 0, 0, 0, 0, '2019-02-04 18:46:55'),
(106, 40, 21, 223, 31, 2, 24, 48, 0, 0, 0, 0, '2019-02-04 18:46:55'),
(107, 41, 47, 322, 0, 88, 5, 5, 0, 0, 0, 0, '2019-02-06 18:59:02'),
(112, 43, 21, 228, 18, 3, 12, 36, 0, 0, 0, 0, '2019-02-12 18:50:37'),
(113, 43, 21, 219, 18, 3, 12, 36, 0, 0, 0, 0, '2019-02-12 18:50:37'),
(114, 43, 21, 230, 18, 3, 12, 36, 0, 0, 0, 0, '2019-02-12 18:50:37'),
(115, 44, 23, 240, 199, 9, 10, 0, 0, 0, 0, 0, '2019-02-14 18:04:46'),
(117, 45, 23, 244, 195, 9, 20, 0, 0, 0, 0, 0, '2019-02-14 18:06:20'),
(118, 46, 23, 241, 1087, 9, 50, 150, 0, 0, 0, 0, '2019-02-14 18:11:23'),
(119, 46, 23, 242, 1087, 9, 50, 150, 0, 0, 0, 0, '2019-02-14 18:11:23'),
(120, 46, 23, 241, 1088, 9, 50, 150, 0, 0, 0, 0, '2019-02-14 18:11:23'),
(121, 46, 23, 242, 1089, 9, 50, 150, 0, 0, 0, 0, '2019-02-14 18:11:23'),
(122, 47, 23, 244, 195, 9, 800, 0, 0, 0, 0, 0, '2019-02-14 18:18:31'),
(123, 47, 23, 240, 192, 9, 100, 0, 0, 0, 0, 0, '2019-02-14 18:18:31'),
(124, 48, 21, 224, 31, 2, 40, 40, 0, 0, 0, 0, '2019-02-14 18:20:47'),
(125, 49, 21, 218, 29, 1, 410, 0, 0, 0, 0, 0, '2019-02-14 18:22:46'),
(126, 49, 21, 218, 29, 2, 410, 0, 0, 0, 0, 0, '2019-02-14 18:22:46'),
(127, 49, 21, 218, 56, 1, 820, 0, 0, 0, 0, 0, '2019-02-14 18:22:46'),
(128, 50, 45, 291, 693, 37, 1, 2, 0, 0, 0, 0, '2019-02-15 18:01:34'),
(129, 50, 45, 291, 694, 37, 1, 2, 0, 0, 0, 0, '2019-02-15 18:01:34'),
(140, 52, 45, 291, 700, 27, 3, 6, 0, 0, 0, 0, '2019-02-15 18:37:29'),
(141, 52, 45, 291, 696, 36, 3, 6, 0, 0, 0, 0, '2019-02-15 18:37:29'),
(142, 51, 45, 291, 693, 37, 3, 6, 0, 0, 0, 0, '2019-02-15 18:39:56'),
(143, 51, 45, 291, 694, 37, 3, 6, 0, 0, 0, 0, '2019-02-15 18:39:56'),
(148, 42, 23, 241, 192, 9, 25, 50, 0, 0, 0, 0, '2019-02-15 18:59:55'),
(149, 42, 23, 239, 144, 9, 25, 50, 0, 0, 0, 0, '2019-02-15 18:59:55'),
(150, 42, 21, 228, 16, 1, 25, 50, 0, 0, 0, 0, '2019-02-15 18:59:55'),
(151, 42, 21, 226, 54, 1, 25, 50, 0, 0, 0, 0, '2019-02-15 18:59:55'),
(152, 53, 47, 322, 0, 79, 10, 10, 0, 0, 0, 0, '2019-02-28 18:58:49'),
(160, 55, 47, 322, 0, 79, 5, 5, 0, 0, 0, 0, '2019-03-05 18:15:02'),
(161, 56, 47, 322, 0, 79, 10, 10, 0, 0, 0, 0, '2019-03-05 18:19:48'),
(162, 57, 40, 362, 0, 79, 1, 1, 0, 0, 0, 0, '2019-03-05 19:11:55'),
(168, 54, 40, 282, 0, 13, 1, 0, 0, 0, 0, 0, '2019-03-15 13:36:19'),
(169, 54, 40, 359, 0, 13, 1, 0, 0, 0, 0, 0, '2019-03-15 13:36:19'),
(170, 54, 40, 360, 0, 13, 1, 0, 0, 0, 0, 0, '2019-03-15 13:36:19'),
(171, 54, 40, 361, 0, 13, 1, 0, 0, 0, 0, 0, '2019-03-15 13:36:19'),
(172, 54, 40, 362, 0, 13, 1, 0, 0, 0, 0, 0, '2019-03-15 13:36:19'),
(173, 58, 40, 362, 0, 79, 10, 10, 0, 0, 0, 0, '2019-03-16 14:29:26'),
(174, 59, 46, 292, 721, 73, 2, 2, 0, 0, 0, 0, '2019-03-18 18:27:01'),
(183, 61, 21, 336, 31, 2, 12, 24, 0, 0, 0, 0, '2019-04-08 17:07:51'),
(184, 61, 21, 228, 31, 2, 12, 24, 0, 0, 0, 0, '2019-04-08 17:07:51'),
(193, 60, 23, 241, 194, 9, 12, 48, 0, 0, 0, 0, '2019-04-08 17:26:08'),
(194, 60, 23, 242, 155, 9, 12, 48, 0, 0, 0, 0, '2019-04-08 17:26:08'),
(195, 60, 23, 236, 194, 9, 12, 48, 0, 0, 0, 0, '2019-04-08 17:26:08'),
(196, 60, 23, 237, 155, 9, 12, 48, 0, 0, 0, 0, '2019-04-08 17:26:08'),
(197, 60, 21, 229, 31, 2, 12, 24, 0, 0, 0, 0, '2019-04-08 17:26:08'),
(198, 60, 21, 219, 31, 3, 12, 24, 0, 0, 0, 0, '2019-04-08 17:26:08'),
(199, 62, 21, 228, 27, 1, 10, 10, 0, 0, 0, 0, '2019-04-08 17:31:55'),
(200, 63, 21, 336, 27, 1, 10, 10, 0, 0, 0, 0, '2019-04-09 19:15:43'),
(210, 64, 46, 292, 720, 73, 5, 15, 0, 0, 0, 0, '2019-04-13 10:52:18'),
(211, 64, 46, 293, 720, 73, 5, 15, 0, 0, 0, 0, '2019-04-13 10:52:18'),
(212, 64, 46, 293, 720, 73, 5, 15, 0, 0, 0, 0, '2019-04-13 10:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `property_name` varchar(100) NOT NULL COMMENT 'Property Name',
  `property_installation_date` date NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `ref_property_object_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `purchase_order_id` int(11) NOT NULL,
  `purchase_order_code` varchar(20) NOT NULL COMMENT 'PO No',
  `purchase_order_no` varchar(4) NOT NULL,
  `purchase_order_date` date NOT NULL COMMENT 'Date',
  `ref_supplier_id` int(11) NOT NULL COMMENT 'Supplier',
  `purchase_order_details` text NOT NULL,
  `terms_and_conditions` text NOT NULL,
  `ref_despatch_mode_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `special_instruction` text NOT NULL,
  `mail_status` int(11) NOT NULL,
  `purchase_order_file` varchar(255) NOT NULL,
  `sub_total` float(10,2) NOT NULL,
  `supp_discount_total` decimal(10,0) NOT NULL,
  `ref_discount_type_id` int(11) NOT NULL,
  `discount_value` int(11) NOT NULL,
  `discount_total` float(10,2) NOT NULL,
  `gst_total` float(10,2) NOT NULL,
  `extra_total` int(11) NOT NULL,
  `p_and_f_total` int(11) NOT NULL,
  `round_off_type` varchar(1) NOT NULL,
  `round_off` decimal(10,0) NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `invoice_status` int(1) NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_no` varchar(25) NOT NULL,
  `invoice_total` float(10,2) NOT NULL,
  `invoice_file` varchar(255) NOT NULL,
  `invoice_payment_status` int(11) NOT NULL,
  `invoice_payment_date` date NOT NULL,
  `invoice_payment_details` varchar(255) NOT NULL,
  `invoice_commission_status` int(11) NOT NULL,
  `invoice_commission_date` date NOT NULL,
  `invoice_commission_details` varchar(255) NOT NULL,
  `purchase_order_name` varchar(100) NOT NULL,
  `purchase_order_complete_status` int(1) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`purchase_order_id`, `purchase_order_code`, `purchase_order_no`, `purchase_order_date`, `ref_supplier_id`, `purchase_order_details`, `terms_and_conditions`, `ref_despatch_mode_id`, `schedule_date`, `special_instruction`, `mail_status`, `purchase_order_file`, `sub_total`, `supp_discount_total`, `ref_discount_type_id`, `discount_value`, `discount_total`, `gst_total`, `extra_total`, `p_and_f_total`, `round_off_type`, `round_off`, `grand_total`, `invoice_status`, `invoice_date`, `invoice_no`, `invoice_total`, `invoice_file`, `invoice_payment_status`, `invoice_payment_date`, `invoice_payment_details`, `invoice_commission_status`, `invoice_commission_date`, `invoice_commission_details`, `purchase_order_name`, `purchase_order_complete_status`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(1, 'PO-D-13062022-0001', '0001', '2022-06-13', 36, '', '', 0, '0000-00-00', '', 0, 'uploads/purchase_order/PO-D-13062022-0001_1655110770.pdf', 1000.00, '0', 0, 0, 0.00, 120.00, 0, 0, '', '0', 1120.00, 0, '0000-00-00', '', 0.00, '', 0, '0000-00-00', '', 0, '0000-00-00', '', '', 0, 0, 1, 0, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_particulars`
--

CREATE TABLE `purchase_order_particulars` (
  `order_particulars_id` int(11) NOT NULL,
  `ref_purchase_order_id` int(11) NOT NULL,
  `ref_product_id` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `full_qty` int(11) NOT NULL,
  `supplier_comm_perc` decimal(10,0) NOT NULL,
  `supplier_comm_total` decimal(10,0) NOT NULL,
  `sub_total` float(10,2) NOT NULL,
  `gst_perc` float(10,2) NOT NULL,
  `gst` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `delivered_qty` int(11) NOT NULL,
  `damaged_qty` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order_particulars`
--

INSERT INTO `purchase_order_particulars` (`order_particulars_id`, `ref_purchase_order_id`, `ref_product_id`, `price`, `qty`, `full_qty`, `supplier_comm_perc`, `supplier_comm_total`, `sub_total`, `gst_perc`, `gst`, `total`, `delivered_qty`, `damaged_qty`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 1, 1, 100.00, 10, 0, '0', '0', 1000.00, 12.00, 120.00, 1120.00, 0, 0, 1, 0, 0, '2022-06-13 14:29:30');

-- --------------------------------------------------------

--
-- Table structure for table `quantity_type`
--

CREATE TABLE `quantity_type` (
  `quantity_type_id` int(11) NOT NULL,
  `quantity_type_name` varchar(50) NOT NULL COMMENT 'Quantity Type',
  `delete_status` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quantity_type`
--

INSERT INTO `quantity_type` (`quantity_type_id`, `quantity_type_name`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(1, 'Ml', 0, 3, 0, '2021-06-20 12:04:51'),
(2, 'Nos', 0, 3, 0, '2021-06-20 12:04:44'),
(3, 'Gm', 0, 3, 0, '2021-06-20 12:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `registration_id` int(11) NOT NULL,
  `memership_type` int(11) NOT NULL,
  `registration_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `designation` varchar(25) NOT NULL,
  `registration_no` varchar(25) NOT NULL,
  `state_ccim_certificate_file` varchar(255) NOT NULL,
  `photo_file` varchar(255) NOT NULL,
  `residence_address` varchar(255) NOT NULL,
  `residence_city` varchar(25) NOT NULL,
  `residence_state` varchar(25) NOT NULL,
  `residence_pincode` int(11) NOT NULL,
  `residence_phone` varchar(12) NOT NULL,
  `residence_mobile` bigint(20) NOT NULL,
  `residence_email` varchar(50) NOT NULL,
  `hospital_address` varchar(255) NOT NULL,
  `hospital_city` varchar(25) NOT NULL,
  `hospital_state` varchar(25) NOT NULL,
  `hospital_pincode` int(11) NOT NULL,
  `hospital_phone` varchar(12) NOT NULL,
  `hospital_mobile` bigint(20) NOT NULL,
  `hospital_email` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `practice_clinical_expertise` varchar(100) NOT NULL,
  `refered_by_1` varchar(50) NOT NULL,
  `refered_by_2` varchar(50) NOT NULL,
  `bams_year` varchar(10) NOT NULL,
  `bams_college` varchar(10) NOT NULL,
  `bams_university` varchar(255) NOT NULL,
  `bams_certificate_file` varchar(255) NOT NULL,
  `mdms_year` varchar(10) NOT NULL,
  `mdms_college` varchar(100) NOT NULL,
  `mdms_university` varchar(255) NOT NULL,
  `mdms_certificate_file` varchar(255) NOT NULL,
  `phd_year` varchar(10) NOT NULL,
  `phd_college` varchar(100) NOT NULL,
  `phd_university` varchar(100) NOT NULL,
  `phd_certificate_file` varchar(255) NOT NULL,
  `others_year` varchar(10) NOT NULL,
  `others_college` varchar(100) NOT NULL,
  `others_university` varchar(255) NOT NULL,
  `others_certificate_file` varchar(255) NOT NULL,
  `payment_status` int(1) NOT NULL,
  `payment_id` varchar(100) NOT NULL,
  `ref_user_id` int(11) DEFAULT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`registration_id`, `memership_type`, `registration_name`, `father_name`, `dob`, `blood_group`, `qualification`, `designation`, `registration_no`, `state_ccim_certificate_file`, `photo_file`, `residence_address`, `residence_city`, `residence_state`, `residence_pincode`, `residence_phone`, `residence_mobile`, `residence_email`, `hospital_address`, `hospital_city`, `hospital_state`, `hospital_pincode`, `hospital_phone`, `hospital_mobile`, `hospital_email`, `website`, `practice_clinical_expertise`, `refered_by_1`, `refered_by_2`, `bams_year`, `bams_college`, `bams_university`, `bams_certificate_file`, `mdms_year`, `mdms_college`, `mdms_university`, `mdms_certificate_file`, `phd_year`, `phd_college`, `phd_university`, `phd_certificate_file`, `others_year`, `others_college`, `others_university`, `others_certificate_file`, `payment_status`, `payment_id`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 1, 'rah', '', '0000-00-00', 'a', 'asdasd', 'mec', '2312312', '', '', 'asdasd', 'asdas', 'dasd', 2312, '234234', 3453445345, 'sadas@dasd.com', 'asdasd', 'asdasd', '2323423', 0, '23423423', 686774534, 'asdas@dasd.com', 'www.google.com', 'Tesat', 'sdfsdf', 'sdf', '1988', 'asdasd', 'asdasd', '', '6763', 'aaaaa', 'ssssss', '', '1233', '4344444', 'ddddddd', '', '45454', 'eeeeeee', 'fffffffff', '', 0, '', 1, 0, 0, '2020-07-01 22:28:01'),
(2, 1, 'rah', '', '1918-12-20', 'a', 'asdasd', 'mec', '2312312', '', '', 'asdasd', 'asdas', 'dasd', 2312, '234234', 3453445345, 'sadas@dasd.com', 'asdasd', 'asdasd', '2323423', 0, '23423423', 686774534, 'asdas@dasd.com', 'www.google.com', 'Tesat', 'sdfsdf', 'sdf', '1988', 'asdasd', 'asdasd', '', '6763', 'aaaaa', 'ssssss', '', '1233', '4344444', 'ddddddd', '', '45454', 'eeeeeee', 'fffffffff', '', 0, '', 1, 0, 0, '2020-07-01 22:31:24'),
(3, 1, 'TEst', 'TEst', '1970-01-01', 'TEst', 'TEst', 'TEst', 'TEst', '', '', 'TEst', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', 'Test', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', '', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 0, '', 1, 0, 0, '2020-07-01 22:46:17'),
(4, 1, 'TEst', 'TEst', '1970-01-01', 'TEst', 'TEst', 'TEst', 'TEst', '', '', 'TEst', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', 'Test', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', '', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 0, '', 1, 0, 0, '2020-07-01 22:46:43'),
(5, 1, 'TEst', 'TEst', '1970-01-01', 'TEst', 'TEst', 'TEst', 'TEst', '', '', 'TEst', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', 'Test', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', '', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 0, '', 1, 0, 0, '2020-07-01 22:47:06'),
(6, 1, 'TEst', 'TEst', '1970-01-01', 'TEst', 'TEst', 'TEst', 'TEst', '', '', 'TEst', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', 'Test', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', '', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 0, '', 1, 0, 0, '2020-07-01 22:47:21'),
(7, 1, 'TEst', 'TEst', '1970-01-01', 'TEst', 'TEst', 'TEst', 'TEst', '', '', 'TEst', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', 'Test', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', '', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 0, '', 1, 0, 0, '2020-07-01 22:48:32'),
(8, 1, 'TEst', 'TEst', '1970-01-01', 'TEst', 'TEst', 'TEst', 'TEst', '', '', 'TEst', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', 'Test', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', '', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 'TEst', 'TEst', 'TEst', '', 1, 'pay_F9JfF79g2VbWkc', 1, 0, 0, '2020-07-01 23:06:56'),
(9, 1, 'TEst', 'TEst', '1970-01-01', 'TEst', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593683832_277_test-image.jpg', 'uploads/ccim_cert/1593683832_500_', 'TEst', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', 'Test', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', '', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593683832_748_', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593683832_320_', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593683832_724_', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593683832_830_', 0, '', 0, 0, 0, '2020-07-02 15:27:12'),
(10, 1, 'TEst', 'TEst', '1970-01-01', 'TEst', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593683869_897_test-image.jpg', 'uploads/ccim_cert/1593683869_262_', 'TEst', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', 'Test', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', '', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593683869_690_', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593683869_160_', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593683869_982_', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593683869_180_', 0, '', 0, 0, 0, '2020-07-02 15:27:49'),
(11, 1, 'TEst', 'TEst', '1970-01-01', 'TEst', 'TEst', 'TEst', 'TEst', 'uploads/ccim_cert/1593684310_886_test-image.jpg', 'uploads/photo/1593684311_811_test-image.jpg', 'TEst', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', 'Test', 'TEst', 'TEst', 0, 'TEst', 0, 'TEst', '', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'TEst', 'uploads/bams_cert/1593684311_477_test-image.jpg', 'TEst', 'TEst', 'TEst', 'uploads/mdms_cert/1593684311_164_test-image.jpg', 'TEst', 'TEst', 'TEst', 'uploads/phd_cert/1593684311_539_test-image.jpg', 'TEst', 'TEst', 'TEst', 'uploads/other_cert/1593684311_648_test-image.jpg', 1, 'pay_F9bKdk3TqxwtsH', 1, 0, 0, '2020-07-02 16:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `reminder_history`
--

CREATE TABLE `reminder_history` (
  `reminder_history_id` int(11) NOT NULL,
  `ref_general_reminder_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `stop_time` datetime NOT NULL,
  `total_minutes` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `reference_file` varchar(255) NOT NULL,
  `reference_link` varchar(255) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `added_date` datetime NOT NULL,
  `file_update_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder_history`
--

INSERT INTO `reminder_history` (`reminder_history_id`, `ref_general_reminder_id`, `start_time`, `stop_time`, `total_minutes`, `details`, `reference_file`, `reference_link`, `ref_user_id`, `transaction_id`, `delete_status`, `added_date`, `file_update_status`) VALUES
(1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Reply To this reminder', '14-09-2017_invitation.jpg', 'www.fabriclore.com/pages/fab-look-book', 28, 0, 0, '2017-09-14 07:29:53', 2),
(2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Test Comments', '14-11-2018_bird.jpeg', 'www.fabriclore.com/pages/fab-look-book', 19, 0, 0, '2018-11-14 17:23:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `reset_password_id` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `hash_key` varchar(50) NOT NULL,
  `reset_password_status` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`reset_password_id`, `ref_user_id`, `hash_key`, `reset_password_status`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 25, 'z3vu617frmitqt76sef2aycb1kob6w', 0, 0, 0, '2017-09-14 07:00:56'),
(2, 25, '50izv4cfxcw1nx1w9sa0tqdubk7sxa', 0, 0, 0, '2017-09-14 07:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `salutation`
--

CREATE TABLE `salutation` (
  `salutation_id` int(11) NOT NULL,
  `salutation_name` varchar(20) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salutation`
--

INSERT INTO `salutation` (`salutation_id`, `salutation_name`, `delete_status`, `user_id`, `transaction_id`, `added_date`) VALUES
(1, 'Mr', 0, 1, 0, '2015-11-12 17:14:20'),
(2, 'Miss', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'Mrs', 0, 1, 0, '2015-11-12 18:39:05'),
(6, 'Father', 0, 1, 0, '2015-11-16 15:58:29'),
(7, 'M/s', 0, 13, 0, '2015-12-18 04:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `sample_request_category`
--

CREATE TABLE `sample_request_category` (
  `sample_request_category_id` int(11) NOT NULL,
  `sample_request_category_name` varchar(100) NOT NULL COMMENT 'Category',
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Added Date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample_request_category`
--

INSERT INTO `sample_request_category` (`sample_request_category_id`, `sample_request_category_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Trail', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Fitment / Size Checking', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'Quality Checking', 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'Replacement', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `specialization_id` int(11) NOT NULL,
  `specialization_name` varchar(50) NOT NULL COMMENT 'Specialization Name',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specialization_id`, `specialization_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'ENT', 1, 0, 0, '2020-07-31 04:50:41'),
(2, 'Heart Specialist', 1, 0, 0, '2020-07-31 04:50:56'),
(3, 'General', 1, 0, 0, '2020-07-31 04:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `star_rating`
--

CREATE TABLE `star_rating` (
  `star_rating_id` int(11) NOT NULL,
  `star_rating_name` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `star_rating`
--

INSERT INTO `star_rating` (`star_rating_id`, `star_rating_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2, 2, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 3, 0, 0, 0, '0000-00-00 00:00:00'),
(4, 4, 0, 0, 0, '0000-00-00 00:00:00'),
(5, 5, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `ref_country_id` int(11) NOT NULL,
  `state_name` varchar(128) NOT NULL,
  `code` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_status` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `ref_country_id`, `state_name`, `code`, `status`, `delete_status`, `user_id`, `transaction_id`, `added_date`) VALUES
(1, 1, 'Badakhshan', 'BDS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2, 1, 'Badghis', 'BDG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 1, 'Baghlan', 'BGL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4, 1, 'Balkh', 'BAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(5, 1, 'Bamian', 'BAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(6, 1, 'Farah', 'FRA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(7, 1, 'Faryab', 'FYB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(8, 1, 'Ghazni', 'GHA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(9, 1, 'Ghowr', 'GHO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(10, 1, 'Helmand', 'HEL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(11, 1, 'Herat', 'HER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(12, 1, 'Jowzjan', 'JOW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(13, 1, 'Kabul', 'KAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(14, 1, 'Kandahar', 'KAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(15, 1, 'Kapisa', 'KAP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(16, 1, 'Khost', 'KHO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(17, 1, 'Konar', 'KNR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(18, 1, 'Kondoz', 'KDZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(19, 1, 'Laghman', 'LAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(20, 1, 'Lowgar', 'LOW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(21, 1, 'Nangrahar', 'NAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(22, 1, 'Nimruz', 'NIM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(23, 1, 'Nurestan', 'NUR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(24, 1, 'Oruzgan', 'ORU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(25, 1, 'Paktia', 'PIA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(26, 1, 'Paktika', 'PKA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(27, 1, 'Parwan', 'PAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(28, 1, 'Samangan', 'SAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(29, 1, 'Sar-e Pol', 'SAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(30, 1, 'Takhar', 'TAK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(31, 1, 'Wardak', 'WAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(32, 1, 'Zabol', 'ZAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(33, 2, 'Berat', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(34, 2, 'Bulqize', 'BU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(35, 2, 'Delvine', 'DL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(36, 2, 'Devoll', 'DV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(37, 2, 'Diber', 'DI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(38, 2, 'Durres', 'DR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(39, 2, 'Elbasan', 'EL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(40, 2, 'Kolonje', 'ER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(41, 2, 'Fier', 'FR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(42, 2, 'Gjirokaster', 'GJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(43, 2, 'Gramsh', 'GR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(44, 2, 'Has', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(45, 2, 'Kavaje', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(46, 2, 'Kurbin', 'KB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(47, 2, 'Kucove', 'KC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(48, 2, 'Korce', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(49, 2, 'Kruje', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(50, 2, 'Kukes', 'KU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(51, 2, 'Librazhd', 'LB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(52, 2, 'Lezhe', 'LE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(53, 2, 'Lushnje', 'LU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(54, 2, 'Malesi e Madhe', 'MM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(55, 2, 'Mallakaster', 'MK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(56, 2, 'Mat', 'MT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(57, 2, 'Mirdite', 'MR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(58, 2, 'Peqin', 'PQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(59, 2, 'Permet', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(60, 2, 'Pogradec', 'PG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(61, 2, 'Puke', 'PU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(62, 2, 'Shkoder', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(63, 2, 'Skrapar', 'SK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(64, 2, 'Sarande', 'SR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(65, 2, 'Tepelene', 'TE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(66, 2, 'Tropoje', 'TP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(67, 2, 'Tirane', 'TR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(68, 2, 'Vlore', 'VL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(69, 3, 'Adrar', 'ADR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(70, 3, 'Ain Defla', 'ADE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(71, 3, 'Ain Temouchent', 'ATE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(72, 3, 'Alger', 'ALG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(73, 3, 'Annaba', 'ANN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(74, 3, 'Batna', 'BAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(75, 3, 'Bechar', 'BEC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(76, 3, 'Bejaia', 'BEJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(77, 3, 'Biskra', 'BIS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(78, 3, 'Blida', 'BLI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(79, 3, 'Bordj Bou Arreridj', 'BBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(80, 3, 'Bouira', 'BOA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(81, 3, 'Boumerdes', 'BMD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(82, 3, 'Chlef', 'CHL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(83, 3, 'Constantine', 'CON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(84, 3, 'Djelfa', 'DJE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(85, 3, 'El Bayadh', 'EBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(86, 3, 'El Oued', 'EOU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(87, 3, 'El Tarf', 'ETA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(88, 3, 'Ghardaia', 'GHA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(89, 3, 'Guelma', 'GUE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(90, 3, 'Illizi', 'ILL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(91, 3, 'Jijel', 'JIJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(92, 3, 'Khenchela', 'KHE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(93, 3, 'Laghouat', 'LAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(94, 3, 'Muaskar', 'MUA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(95, 3, 'Medea', 'MED', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(96, 3, 'Mila', 'MIL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(97, 3, 'Mostaganem', 'MOS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(98, 3, 'M\'Sila', 'MSI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(99, 3, 'Naama', 'NAA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(100, 3, 'Oran', 'ORA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(101, 3, 'Ouargla', 'OUA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(102, 3, 'Oum el-Bouaghi', 'OEB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(103, 3, 'Relizane', 'REL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(104, 3, 'Saida', 'SAI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(105, 3, 'Setif', 'SET', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(106, 3, 'Sidi Bel Abbes', 'SBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(107, 3, 'Skikda', 'SKI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(108, 3, 'Souk Ahras', 'SAH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(109, 3, 'Tamanghasset', 'TAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(110, 3, 'Tebessa', 'TEB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(111, 3, 'Tiaret', 'TIA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(112, 3, 'Tindouf', 'TIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(113, 3, 'Tipaza', 'TIP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(114, 3, 'Tissemsilt', 'TIS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(115, 3, 'Tizi Ouzou', 'TOU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(116, 3, 'Tlemcen', 'TLE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(117, 4, 'Eastern', 'E', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(118, 4, 'Manu\'a', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(119, 4, 'Rose Island', 'R', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(120, 4, 'Swains Island', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(121, 4, 'Western', 'W', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(122, 5, 'Andorra la Vella', 'ALV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(123, 5, 'Canillo', 'CAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(124, 5, 'Encamp', 'ENC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(125, 5, 'Escaldes-Engordany', 'ESE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(126, 5, 'La Massana', 'LMA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(127, 5, 'Ordino', 'ORD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(128, 5, 'Sant Julia de Loria', 'SJL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(129, 6, 'Bengo', 'BGO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(130, 6, 'Benguela', 'BGU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(131, 6, 'Bie', 'BIE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(132, 6, 'Cabinda', 'CAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(133, 6, 'Cuando-Cubango', 'CCU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(134, 6, 'Cuanza Norte', 'CNO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(135, 6, 'Cuanza Sul', 'CUS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(136, 6, 'Cunene', 'CNN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(137, 6, 'Huambo', 'HUA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(138, 6, 'Huila', 'HUI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(139, 6, 'Luanda', 'LUA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(140, 6, 'Lunda Norte', 'LNO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(141, 6, 'Lunda Sul', 'LSU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(142, 6, 'Malange', 'MAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(143, 6, 'Moxico', 'MOX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(144, 6, 'Namibe', 'NAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(145, 6, 'Uige', 'UIG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(146, 6, 'Zaire', 'ZAI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(147, 9, 'Saint George', 'ASG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(148, 9, 'Saint John', 'ASJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(149, 9, 'Saint Mary', 'ASM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(150, 9, 'Saint Paul', 'ASL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(151, 9, 'Saint Peter', 'ASR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(152, 9, 'Saint Philip', 'ASH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(153, 9, 'Barbuda', 'BAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(154, 9, 'Redonda', 'RED', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(155, 10, 'Antartida e Islas del Atlantico', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(156, 10, 'Buenos Aires', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(157, 10, 'Catamarca', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(158, 10, 'Chaco', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(159, 10, 'Chubut', 'CU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(160, 10, 'Cordoba', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(161, 10, 'Corrientes', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(162, 10, 'Distrito Federal', 'DF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(163, 10, 'Entre Rios', 'ER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(164, 10, 'Formosa', 'FO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(165, 10, 'Jujuy', 'JU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(166, 10, 'La Pampa', 'LP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(167, 10, 'La Rioja', 'LR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(168, 10, 'Mendoza', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(169, 10, 'Misiones', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(170, 10, 'Neuquen', 'NE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(171, 10, 'Rio Negro', 'RN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(172, 10, 'Salta', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(173, 10, 'San Juan', 'SJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(174, 10, 'San Luis', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(175, 10, 'Santa Cruz', 'SC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(176, 10, 'Santa Fe', 'SF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(177, 10, 'Santiago del Estero', 'SD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(178, 10, 'Tierra del Fuego', 'TF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(179, 10, 'Tucuman', 'TU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(180, 11, 'Aragatsotn', 'AGT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(181, 11, 'Ararat', 'ARR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(182, 11, 'Armavir', 'ARM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(183, 11, 'Geghark\'unik\'', 'GEG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(184, 11, 'Kotayk\'', 'KOT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(185, 11, 'Lorri', 'LOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(186, 11, 'Shirak', 'SHI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(187, 11, 'Syunik\'', 'SYU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(188, 11, 'Tavush', 'TAV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(189, 11, 'Vayots\' Dzor', 'VAY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(190, 11, 'Yerevan', 'YER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(191, 13, 'Australian Capital Territory', 'ACT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(192, 13, 'New South Wales', 'NSW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(193, 13, 'Northern Territory', 'NT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(194, 13, 'Queensland', 'QLD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(195, 13, 'South Australia', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(196, 13, 'Tasmania', 'TAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(197, 13, 'Victoria', 'VIC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(198, 13, 'Western Australia', 'WA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(199, 14, 'Burgenland', 'BUR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(200, 14, 'KÃƒÂ¤rnten', 'KAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(201, 14, 'Nieder&ouml;sterreich', 'NOS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(202, 14, 'Ober&ouml;sterreich', 'OOS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(203, 14, 'Salzburg', 'SAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(204, 14, 'Steiermark', 'STE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(205, 14, 'Tirol', 'TIR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(206, 14, 'Vorarlberg', 'VOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(207, 14, 'Wien', 'WIE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(208, 15, 'Ali Bayramli', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(209, 15, 'Abseron', 'ABS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(210, 15, 'AgcabAdi', 'AGC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(211, 15, 'Agdam', 'AGM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(212, 15, 'Agdas', 'AGS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(213, 15, 'Agstafa', 'AGA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(214, 15, 'Agsu', 'AGU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(215, 15, 'Astara', 'AST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(216, 15, 'Baki', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(217, 15, 'BabAk', 'BAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(218, 15, 'BalakAn', 'BAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(219, 15, 'BArdA', 'BAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(220, 15, 'Beylaqan', 'BEY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(221, 15, 'Bilasuvar', 'BIL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(222, 15, 'Cabrayil', 'CAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(223, 15, 'Calilabab', 'CAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(224, 15, 'Culfa', 'CUL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(225, 15, 'Daskasan', 'DAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(226, 15, 'Davaci', 'DAV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(227, 15, 'Fuzuli', 'FUZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(228, 15, 'Ganca', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(229, 15, 'Gadabay', 'GAD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(230, 15, 'Goranboy', 'GOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(231, 15, 'Goycay', 'GOY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(232, 15, 'Haciqabul', 'HAC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(233, 15, 'Imisli', 'IMI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(234, 15, 'Ismayilli', 'ISM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(235, 15, 'Kalbacar', 'KAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(236, 15, 'Kurdamir', 'KUR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(237, 15, 'Lankaran', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(238, 15, 'Lacin', 'LAC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(239, 15, 'Lankaran', 'LAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(240, 15, 'Lerik', 'LER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(241, 15, 'Masalli', 'MAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(242, 15, 'Mingacevir', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(243, 15, 'Naftalan', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(244, 15, 'Neftcala', 'NEF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(245, 15, 'Oguz', 'OGU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(246, 15, 'Ordubad', 'ORD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(247, 15, 'Qabala', 'QAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(248, 15, 'Qax', 'QAX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(249, 15, 'Qazax', 'QAZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(250, 15, 'Qobustan', 'QOB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(251, 15, 'Quba', 'QBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(252, 15, 'Qubadli', 'QBI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(253, 15, 'Qusar', 'QUS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(254, 15, 'Saki', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(255, 15, 'Saatli', 'SAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(256, 15, 'Sabirabad', 'SAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(257, 15, 'Sadarak', 'SAD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(258, 15, 'Sahbuz', 'SAH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(259, 15, 'Saki', 'SAK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(260, 15, 'Salyan', 'SAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(261, 15, 'Sumqayit', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(262, 15, 'Samaxi', 'SMI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(263, 15, 'Samkir', 'SKR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(264, 15, 'Samux', 'SMX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(265, 15, 'Sarur', 'SAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(266, 15, 'Siyazan', 'SIY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(267, 15, 'Susa', 'SS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(268, 15, 'Susa', 'SUS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(269, 15, 'Tartar', 'TAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(270, 15, 'Tovuz', 'TOV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(271, 15, 'Ucar', 'UCA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(272, 15, 'Xankandi', 'XA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(273, 15, 'Xacmaz', 'XAC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(274, 15, 'Xanlar', 'XAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(275, 15, 'Xizi', 'XIZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(276, 15, 'Xocali', 'XCI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(277, 15, 'Xocavand', 'XVD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(278, 15, 'Yardimli', 'YAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(279, 15, 'Yevlax', 'YEV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(280, 15, 'Zangilan', 'ZAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(281, 15, 'Zaqatala', 'ZAQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(282, 15, 'Zardab', 'ZAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(283, 15, 'Naxcivan', 'NX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(284, 16, 'Acklins', 'ACK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(285, 16, 'Berry Islands', 'BER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(286, 16, 'Bimini', 'BIM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(287, 16, 'Black Point', 'BLK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(288, 16, 'Cat Island', 'CAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(289, 16, 'Central Abaco', 'CAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(290, 16, 'Central Andros', 'CAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(291, 16, 'Central Eleuthera', 'CEL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(292, 16, 'City of Freeport', 'FRE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(293, 16, 'Crooked Island', 'CRO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(294, 16, 'East Grand Bahama', 'EGB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(295, 16, 'Exuma', 'EXU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(296, 16, 'Grand Cay', 'GRD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(297, 16, 'Harbour Island', 'HAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(298, 16, 'Hope Town', 'HOP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(299, 16, 'Inagua', 'INA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(300, 16, 'Long Island', 'LNG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(301, 16, 'Mangrove Cay', 'MAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(302, 16, 'Mayaguana', 'MAY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(303, 16, 'Moore\'s Island', 'MOO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(304, 16, 'North Abaco', 'NAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(305, 16, 'North Andros', 'NAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(306, 16, 'North Eleuthera', 'NEL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(307, 16, 'Ragged Island', 'RAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(308, 16, 'Rum Cay', 'RUM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(309, 16, 'San Salvador', 'SAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(310, 16, 'South Abaco', 'SAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(311, 16, 'South Andros', 'SAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(312, 16, 'South Eleuthera', 'SEL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(313, 16, 'Spanish Wells', 'SWE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(314, 16, 'West Grand Bahama', 'WGB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(315, 17, 'Capital', 'CAP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(316, 17, 'Central', 'CEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(317, 17, 'Muharraq', 'MUH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(318, 17, 'Northern', 'NOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(319, 17, 'Southern', 'SOU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(320, 18, 'Barisal', 'BAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(321, 18, 'Chittagong', 'CHI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(322, 18, 'Dhaka', 'DHA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(323, 18, 'Khulna', 'KHU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(324, 18, 'Rajshahi', 'RAJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(325, 18, 'Sylhet', 'SYL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(326, 19, 'Christ Church', 'CC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(327, 19, 'Saint Andrew', 'AND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(328, 19, 'Saint George', 'GEO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(329, 19, 'Saint James', 'JAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(330, 19, 'Saint John', 'JOH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(331, 19, 'Saint Joseph', 'JOS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(332, 19, 'Saint Lucy', 'LUC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(333, 19, 'Saint Michael', 'MIC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(334, 19, 'Saint Peter', 'PET', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(335, 19, 'Saint Philip', 'PHI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(336, 19, 'Saint Thomas', 'THO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(337, 20, 'Brestskaya (Brest)', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(338, 20, 'Homyel\'skaya (Homyel\')', 'HO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(339, 20, 'Horad Minsk', 'HM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(340, 20, 'Hrodzyenskaya (Hrodna)', 'HR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(341, 20, 'Mahilyowskaya (Mahilyow)', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(342, 20, 'Minskaya', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(343, 20, 'Vitsyebskaya (Vitsyebsk)', 'VI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(344, 21, 'Antwerpen', 'VAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(345, 21, 'Brabant Wallon', 'WBR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(346, 21, 'Hainaut', 'WHT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(347, 21, 'LiÃƒÂ¨ge', 'WLG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(348, 21, 'Limburg', 'VLI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(349, 21, 'Luxembourg', 'WLX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(350, 21, 'Namur', 'WNA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(351, 21, 'Oost-Vlaanderen', 'VOV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(352, 21, 'Vlaams Brabant', 'VBR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(353, 21, 'West-Vlaanderen', 'VWV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(354, 22, 'Belize', 'BZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(355, 22, 'Cayo', 'CY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(356, 22, 'Corozal', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(357, 22, 'Orange Walk', 'OW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(358, 22, 'Stann Creek', 'SC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(359, 22, 'Toledo', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(360, 23, 'Alibori', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(361, 23, 'Atakora', 'AK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(362, 23, 'Atlantique', 'AQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(363, 23, 'Borgou', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(364, 23, 'Collines', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(365, 23, 'Donga', 'DO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(366, 23, 'Kouffo', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(367, 23, 'Littoral', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(368, 23, 'Mono', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(369, 23, 'Oueme', 'OU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(370, 23, 'Plateau', 'PL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(371, 23, 'Zou', 'ZO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(372, 24, 'Devonshire', 'DS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(373, 24, 'Hamilton City', 'HC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(374, 24, 'Hamilton', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(375, 24, 'Paget', 'PG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(376, 24, 'Pembroke', 'PB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(377, 24, 'Saint George City', 'GC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(378, 24, 'Saint George\'s', 'SG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(379, 24, 'Sandys', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(380, 24, 'Smith\'s', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(381, 24, 'Southampton', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(382, 24, 'Warwick', 'WA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(383, 25, 'Bumthang', 'BUM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(384, 25, 'Chukha', 'CHU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(385, 25, 'Dagana', 'DAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(386, 25, 'Gasa', 'GAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(387, 25, 'Haa', 'HAA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(388, 25, 'Lhuntse', 'LHU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(389, 25, 'Mongar', 'MON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(390, 25, 'Paro', 'PAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(391, 25, 'Pemagatshel', 'PEM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(392, 25, 'Punakha', 'PUN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(393, 25, 'Samdrup Jongkhar', 'SJO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(394, 25, 'Samtse', 'SAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(395, 25, 'Sarpang', 'SAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(396, 25, 'Thimphu', 'THI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(397, 25, 'Trashigang', 'TRG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(398, 25, 'Trashiyangste', 'TRY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(399, 25, 'Trongsa', 'TRO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(400, 25, 'Tsirang', 'TSI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(401, 25, 'Wangdue Phodrang', 'WPH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(402, 25, 'Zhemgang', 'ZHE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(403, 26, 'Beni', 'BEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(404, 26, 'Chuquisaca', 'CHU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(405, 26, 'Cochabamba', 'COC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(406, 26, 'La Paz', 'LPZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(407, 26, 'Oruro', 'ORU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(408, 26, 'Pando', 'PAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(409, 26, 'Potosi', 'POT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(410, 26, 'Santa Cruz', 'SCZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(411, 26, 'Tarija', 'TAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(412, 27, 'Brcko district', 'BRO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(413, 27, 'Unsko-Sanski Kanton', 'FUS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(414, 27, 'Posavski Kanton', 'FPO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(415, 27, 'Tuzlanski Kanton', 'FTU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(416, 27, 'Zenicko-Dobojski Kanton', 'FZE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(417, 27, 'Bosanskopodrinjski Kanton', 'FBP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(418, 27, 'Srednjebosanski Kanton', 'FSB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(419, 27, 'Hercegovacko-neretvanski Kanton', 'FHN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(420, 27, 'Zapadnohercegovacka Zupanija', 'FZH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(421, 27, 'Kanton Sarajevo', 'FSA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(422, 27, 'Zapadnobosanska', 'FZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(423, 27, 'Banja Luka', 'SBL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(424, 27, 'Doboj', 'SDO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(425, 27, 'Bijeljina', 'SBI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(426, 27, 'Vlasenica', 'SVL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(427, 27, 'Sarajevo-Romanija or Sokolac', 'SSR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(428, 27, 'Foca', 'SFO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(429, 27, 'Trebinje', 'STR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(430, 28, 'Central', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(431, 28, 'Ghanzi', 'GH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(432, 28, 'Kgalagadi', 'KD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(433, 28, 'Kgatleng', 'KT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(434, 28, 'Kweneng', 'KW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(435, 28, 'Ngamiland', 'NG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(436, 28, 'North East', 'NE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(437, 28, 'North West', 'NW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(438, 28, 'South East', 'SE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(439, 28, 'Southern', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(440, 30, 'Acre', 'AC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(441, 30, 'Alagoas', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(442, 30, 'AmapÃƒÂ¡', 'AP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(443, 30, 'Amazonas', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(444, 30, 'Bahia', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(445, 30, 'CearÃƒÂ¡', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(446, 30, 'Distrito Federal', 'DF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(447, 30, 'EspÃƒÂ­rito Santo', 'ES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(448, 30, 'GoiÃƒÂ¡s', 'GO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(449, 30, 'MaranhÃƒÂ£o', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(450, 30, 'Mato Grosso', 'MT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(451, 30, 'Mato Grosso do Sul', 'MS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(452, 30, 'Minas Gerais', 'MG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(453, 30, 'ParÃƒÂ¡', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(454, 30, 'ParaÃƒÂ­ba', 'PB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(455, 30, 'ParanÃƒÂ¡', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(456, 30, 'Pernambuco', 'PE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(457, 30, 'PiauÃƒÂ­', 'PI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(458, 30, 'Rio de Janeiro', 'RJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(459, 30, 'Rio Grande do Norte', 'RN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(460, 30, 'Rio Grande do Sul', 'RS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(461, 30, 'RondÃƒÂ´nia', 'RO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(462, 30, 'Roraima', 'RR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(463, 30, 'Santa Catarina', 'SC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(464, 30, 'SÃƒÂ£o Paulo', 'SP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(465, 30, 'Sergipe', 'SE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(466, 30, 'Tocantins', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(467, 31, 'Peros Banhos', 'PB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(468, 31, 'Salomon Islands', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(469, 31, 'Nelsons Island', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(470, 31, 'Three Brothers', 'TB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(471, 31, 'Eagle Islands', 'EA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(472, 31, 'Danger Island', 'DI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(473, 31, 'Egmont Islands', 'EG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(474, 31, 'Diego Garcia', 'DG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(475, 32, 'Belait', 'BEL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(476, 32, 'Brunei and Muara', 'BRM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(477, 32, 'Temburong', 'TEM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(478, 32, 'Tutong', 'TUT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(479, 33, 'Blagoevgrad', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(480, 33, 'Burgas', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(481, 33, 'Dobrich', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(482, 33, 'Gabrovo', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(483, 33, 'Haskovo', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(484, 33, 'Kardjali', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(485, 33, 'Kyustendil', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(486, 33, 'Lovech', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(487, 33, 'Montana', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(488, 33, 'Pazardjik', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(489, 33, 'Pernik', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(490, 33, 'Pleven', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(491, 33, 'Plovdiv', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(492, 33, 'Razgrad', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(493, 33, 'Shumen', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(494, 33, 'Silistra', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(495, 33, 'Sliven', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(496, 33, 'Smolyan', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(497, 33, 'Sofia', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(498, 33, 'Sofia - town', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(499, 33, 'Stara Zagora', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(500, 33, 'Targovishte', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(501, 33, 'Varna', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(502, 33, 'Veliko Tarnovo', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(503, 33, 'Vidin', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(504, 33, 'Vratza', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(505, 33, 'Yambol', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(506, 34, 'Bale', 'BAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(507, 34, 'Bam', 'BAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(508, 34, 'Banwa', 'BAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(509, 34, 'Bazega', 'BAZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(510, 34, 'Bougouriba', 'BOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(511, 34, 'Boulgou', 'BLG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(512, 34, 'Boulkiemde', 'BOK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(513, 34, 'Comoe', 'COM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(514, 34, 'Ganzourgou', 'GAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(515, 34, 'Gnagna', 'GNA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(516, 34, 'Gourma', 'GOU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(517, 34, 'Houet', 'HOU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(518, 34, 'Ioba', 'IOA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(519, 34, 'Kadiogo', 'KAD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(520, 34, 'Kenedougou', 'KEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(521, 34, 'Komondjari', 'KOD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(522, 34, 'Kompienga', 'KOP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(523, 34, 'Kossi', 'KOS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(524, 34, 'Koulpelogo', 'KOL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(525, 34, 'Kouritenga', 'KOT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(526, 34, 'Kourweogo', 'KOW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(527, 34, 'Leraba', 'LER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(528, 34, 'Loroum', 'LOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(529, 34, 'Mouhoun', 'MOU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(530, 34, 'Nahouri', 'NAH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(531, 34, 'Namentenga', 'NAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(532, 34, 'Nayala', 'NAY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(533, 34, 'Noumbiel', 'NOU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(534, 34, 'Oubritenga', 'OUB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(535, 34, 'Oudalan', 'OUD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(536, 34, 'Passore', 'PAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(537, 34, 'Poni', 'PON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(538, 34, 'Sanguie', 'SAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(539, 34, 'Sanmatenga', 'SAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(540, 34, 'Seno', 'SEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(541, 34, 'Sissili', 'SIS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(542, 34, 'Soum', 'SOM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(543, 34, 'Sourou', 'SOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(544, 34, 'Tapoa', 'TAP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(545, 34, 'Tuy', 'TUY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(546, 34, 'Yagha', 'YAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(547, 34, 'Yatenga', 'YAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(548, 34, 'Ziro', 'ZIR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(549, 34, 'Zondoma', 'ZOD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(550, 34, 'Zoundweogo', 'ZOW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(551, 35, 'Bubanza', 'BB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(552, 35, 'Bujumbura', 'BJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(553, 35, 'Bururi', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(554, 35, 'Cankuzo', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(555, 35, 'Cibitoke', 'CI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(556, 35, 'Gitega', 'GI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(557, 35, 'Karuzi', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(558, 35, 'Kayanza', 'KY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(559, 35, 'Kirundo', 'KI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(560, 35, 'Makamba', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(561, 35, 'Muramvya', 'MU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(562, 35, 'Muyinga', 'MY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(563, 35, 'Mwaro', 'MW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(564, 35, 'Ngozi', 'NG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(565, 35, 'Rutana', 'RT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(566, 35, 'Ruyigi', 'RY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(567, 36, 'Phnom Penh', 'PP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(568, 36, 'Preah Seihanu (Kompong Som or Sihanoukville)', 'PS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(569, 36, 'Pailin', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(570, 36, 'Keb', 'KB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(571, 36, 'Banteay Meanchey', 'BM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(572, 36, 'Battambang', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(573, 36, 'Kampong Cham', 'KM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(574, 36, 'Kampong Chhnang', 'KN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(575, 36, 'Kampong Speu', 'KU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(576, 36, 'Kampong Som', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(577, 36, 'Kampong Thom', 'KT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(578, 36, 'Kampot', 'KP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(579, 36, 'Kandal', 'KL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(580, 36, 'Kaoh Kong', 'KK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(581, 36, 'Kratie', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(582, 36, 'Mondul Kiri', 'MK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(583, 36, 'Oddar Meancheay', 'OM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(584, 36, 'Pursat', 'PU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(585, 36, 'Preah Vihear', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(586, 36, 'Prey Veng', 'PG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(587, 36, 'Ratanak Kiri', 'RK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(588, 36, 'Siemreap', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(589, 36, 'Stung Treng', 'ST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(590, 36, 'Svay Rieng', 'SR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(591, 36, 'Takeo', 'TK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(592, 37, 'Adamawa (Adamaoua)', 'ADA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(593, 37, 'Centre', 'CEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(594, 37, 'East (Est)', 'EST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(595, 37, 'Extreme North (Extreme-Nord)', 'EXN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(596, 37, 'Littoral', 'LIT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(597, 37, 'North (Nord)', 'NOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(598, 37, 'Northwest (Nord-Ouest)', 'NOT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(599, 37, 'West (Ouest)', 'OUE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(600, 37, 'South (Sud)', 'SUD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(601, 37, 'Southwest (Sud-Ouest).', 'SOU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(602, 38, 'Alberta', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(603, 38, 'British Columbia', 'BC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(604, 38, 'Manitoba', 'MB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(605, 38, 'New Brunswick', 'NB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(606, 38, 'Newfoundland and Labrador', 'NL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(607, 38, 'Northwest Territories', 'NT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(608, 38, 'Nova Scotia', 'NS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(609, 38, 'Nunavut', 'NU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(610, 38, 'Ontario', 'ON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(611, 38, 'Prince Edward Island', 'PE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(612, 38, 'Qu&eacute;bec', 'QC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(613, 38, 'Saskatchewan', 'SK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(614, 38, 'Yukon Territory', 'YT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(615, 39, 'Boa Vista', 'BV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(616, 39, 'Brava', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(617, 39, 'Calheta de Sao Miguel', 'CS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(618, 39, 'Maio', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(619, 39, 'Mosteiros', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(620, 39, 'Paul', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(621, 39, 'Porto Novo', 'PN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(622, 39, 'Praia', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(623, 39, 'Ribeira Grande', 'RG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(624, 39, 'Sal', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(625, 39, 'Santa Catarina', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(626, 39, 'Santa Cruz', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(627, 39, 'Sao Domingos', 'SD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(628, 39, 'Sao Filipe', 'SF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(629, 39, 'Sao Nicolau', 'SN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(630, 39, 'Sao Vicente', 'SV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(631, 39, 'Tarrafal', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(632, 40, 'Creek', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(633, 40, 'Eastern', 'EA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(634, 40, 'Midland', 'ML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(635, 40, 'South Town', 'ST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(636, 40, 'Spot Bay', 'SP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(637, 40, 'Stake Bay', 'SK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(638, 40, 'West End', 'WD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(639, 40, 'Western', 'WN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(640, 41, 'Bamingui-Bangoran', 'BBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(641, 41, 'Basse-Kotto', 'BKO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(642, 41, 'Haute-Kotto', 'HKO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(643, 41, 'Haut-Mbomou', 'HMB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(644, 41, 'Kemo', 'KEM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(645, 41, 'Lobaye', 'LOB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(646, 41, 'Mambere-KadeÃƒâ€', 'MKD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(647, 41, 'Mbomou', 'MBO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(648, 41, 'Nana-Mambere', 'NMM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(649, 41, 'Ombella-M\'Poko', 'OMP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(650, 41, 'Ouaka', 'OUK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(651, 41, 'Ouham', 'OUH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(652, 41, 'Ouham-Pende', 'OPE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(653, 41, 'Vakaga', 'VAK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(654, 41, 'Nana-Grebizi', 'NGR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(655, 41, 'Sangha-Mbaere', 'SMB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(656, 41, 'Bangui', 'BAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(657, 42, 'Batha', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(658, 42, 'Biltine', 'BI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(659, 42, 'Borkou-Ennedi-Tibesti', 'BE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(660, 42, 'Chari-Baguirmi', 'CB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(661, 42, 'Guera', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(662, 42, 'Kanem', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(663, 42, 'Lac', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(664, 42, 'Logone Occidental', 'LC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(665, 42, 'Logone Oriental', 'LR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(666, 42, 'Mayo-Kebbi', 'MK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(667, 42, 'Moyen-Chari', 'MC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(668, 42, 'Ouaddai', 'OU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(669, 42, 'Salamat', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(670, 42, 'Tandjile', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(671, 43, 'Aisen del General Carlos Ibanez', 'AI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(672, 43, 'Antofagasta', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(673, 43, 'Araucania', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(674, 43, 'Atacama', 'AT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(675, 43, 'Bio-Bio', 'BI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(676, 43, 'Coquimbo', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(677, 43, 'Libertador General Bernardo O\'Higgins', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(678, 43, 'Los Lagos', 'LL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(679, 43, 'Magallanes y de la Antartica Chilena', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(680, 43, 'Maule', 'ML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(681, 43, 'Region Metropolitana', 'RM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(682, 43, 'Tarapaca', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(683, 43, 'Valparaiso', 'VS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(684, 44, 'Anhui', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(685, 44, 'Beijing', 'BE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(686, 44, 'Chongqing', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(687, 44, 'Fujian', 'FU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(688, 44, 'Gansu', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(689, 44, 'Guangdong', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(690, 44, 'Guangxi', 'GX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(691, 44, 'Guizhou', 'GZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(692, 44, 'Hainan', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(693, 44, 'Hebei', 'HB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(694, 44, 'Heilongjiang', 'HL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(695, 44, 'Henan', 'HE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(696, 44, 'Hong Kong', 'HK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(697, 44, 'Hubei', 'HU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(698, 44, 'Hunan', 'HN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(699, 44, 'Inner Mongolia', 'IM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(700, 44, 'Jiangsu', 'JI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(701, 44, 'Jiangxi', 'JX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(702, 44, 'Jilin', 'JL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(703, 44, 'Liaoning', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(704, 44, 'Macau', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(705, 44, 'Ningxia', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(706, 44, 'Shaanxi', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(707, 44, 'Shandong', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(708, 44, 'Shanghai', 'SG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(709, 44, 'Shanxi', 'SX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(710, 44, 'Sichuan', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(711, 44, 'Tianjin', 'TI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(712, 44, 'Xinjiang', 'XI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(713, 44, 'Yunnan', 'YU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(714, 44, 'Zhejiang', 'ZH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(715, 46, 'Direction Island', 'D', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(716, 46, 'Home Island', 'H', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(717, 46, 'Horsburgh Island', 'O', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(718, 46, 'South Island', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(719, 46, 'West Island', 'W', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(720, 47, 'Amazonas', 'AMZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(721, 47, 'Antioquia', 'ANT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(722, 47, 'Arauca', 'ARA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(723, 47, 'Atlantico', 'ATL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(724, 47, 'Bogota D.C.', 'BDC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(725, 47, 'Bolivar', 'BOL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(726, 47, 'Boyaca', 'BOY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(727, 47, 'Caldas', 'CAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(728, 47, 'Caqueta', 'CAQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(729, 47, 'Casanare', 'CAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(730, 47, 'Cauca', 'CAU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(731, 47, 'Cesar', 'CES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(732, 47, 'Choco', 'CHO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(733, 47, 'Cordoba', 'COR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(734, 47, 'Cundinamarca', 'CAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(735, 47, 'Guainia', 'GNA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(736, 47, 'Guajira', 'GJR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(737, 47, 'Guaviare', 'GVR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(738, 47, 'Huila', 'HUI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(739, 47, 'Magdalena', 'MAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(740, 47, 'Meta', 'MET', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(741, 47, 'Narino', 'NAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(742, 47, 'Norte de Santander', 'NDS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(743, 47, 'Putumayo', 'PUT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(744, 47, 'Quindio', 'QUI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(745, 47, 'Risaralda', 'RIS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(746, 47, 'San Andres y Providencia', 'SAP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(747, 47, 'Santander', 'SAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(748, 47, 'Sucre', 'SUC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(749, 47, 'Tolima', 'TOL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(750, 47, 'Valle del Cauca', 'VDC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(751, 47, 'Vaupes', 'VAU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(752, 47, 'Vichada', 'VIC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(753, 48, 'Grande Comore', 'G', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(754, 48, 'Anjouan', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(755, 48, 'Moheli', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(756, 49, 'Bouenza', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(757, 49, 'Brazzaville', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(758, 49, 'Cuvette', 'CU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(759, 49, 'Cuvette-Ouest', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(760, 49, 'Kouilou', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(761, 49, 'Lekoumou', 'LE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(762, 49, 'Likouala', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(763, 49, 'Niari', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(764, 49, 'Plateaux', 'PL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(765, 49, 'Pool', 'PO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(766, 49, 'Sangha', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(767, 50, 'Pukapuka', 'PU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(768, 50, 'Rakahanga', 'RK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(769, 50, 'Manihiki', 'MK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(770, 50, 'Penrhyn', 'PE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(771, 50, 'Nassau Island', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(772, 50, 'Surwarrow', 'SU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(773, 50, 'Palmerston', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(774, 50, 'Aitutaki', 'AI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(775, 50, 'Manuae', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(776, 50, 'Takutea', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(777, 50, 'Mitiaro', 'MT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(778, 50, 'Atiu', 'AT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(779, 50, 'Mauke', 'MU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(780, 50, 'Rarotonga', 'RR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(781, 50, 'Mangaia', 'MG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(782, 51, 'Alajuela', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(783, 51, 'Cartago', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(784, 51, 'Guanacaste', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(785, 51, 'Heredia', 'HE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(786, 51, 'Limon', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(787, 51, 'Puntarenas', 'PU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(788, 51, 'San Jose', 'SJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(789, 52, 'Abengourou', 'ABE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(790, 52, 'Abidjan', 'ABI', 1, 0, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `state` (`state_id`, `ref_country_id`, `state_name`, `code`, `status`, `delete_status`, `user_id`, `transaction_id`, `added_date`) VALUES
(791, 52, 'Aboisso', 'ABO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(792, 52, 'Adiake', 'ADI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(793, 52, 'Adzope', 'ADZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(794, 52, 'Agboville', 'AGB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(795, 52, 'Agnibilekrou', 'AGN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(796, 52, 'Alepe', 'ALE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(797, 52, 'Bocanda', 'BOC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(798, 52, 'Bangolo', 'BAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(799, 52, 'Beoumi', 'BEO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(800, 52, 'Biankouma', 'BIA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(801, 52, 'Bondoukou', 'BDK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(802, 52, 'Bongouanou', 'BGN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(803, 52, 'Bouafle', 'BFL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(804, 52, 'Bouake', 'BKE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(805, 52, 'Bouna', 'BNA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(806, 52, 'Boundiali', 'BDL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(807, 52, 'Dabakala', 'DKL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(808, 52, 'Dabou', 'DBU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(809, 52, 'Daloa', 'DAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(810, 52, 'Danane', 'DAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(811, 52, 'Daoukro', 'DAO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(812, 52, 'Dimbokro', 'DIM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(813, 52, 'Divo', 'DIV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(814, 52, 'Duekoue', 'DUE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(815, 52, 'Ferkessedougou', 'FER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(816, 52, 'Gagnoa', 'GAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(817, 52, 'Grand-Bassam', 'GBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(818, 52, 'Grand-Lahou', 'GLA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(819, 52, 'Guiglo', 'GUI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(820, 52, 'Issia', 'ISS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(821, 52, 'Jacqueville', 'JAC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(822, 52, 'Katiola', 'KAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(823, 52, 'Korhogo', 'KOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(824, 52, 'Lakota', 'LAK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(825, 52, 'Man', 'MAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(826, 52, 'Mankono', 'MKN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(827, 52, 'Mbahiakro', 'MBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(828, 52, 'Odienne', 'ODI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(829, 52, 'Oume', 'OUM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(830, 52, 'Sakassou', 'SAK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(831, 52, 'San-Pedro', 'SPE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(832, 52, 'Sassandra', 'SAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(833, 52, 'Seguela', 'SEG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(834, 52, 'Sinfra', 'SIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(835, 52, 'Soubre', 'SOU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(836, 52, 'Tabou', 'TAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(837, 52, 'Tanda', 'TAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(838, 52, 'Tiebissou', 'TIE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(839, 52, 'Tingrela', 'TIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(840, 52, 'Tiassale', 'TIA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(841, 52, 'Touba', 'TBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(842, 52, 'Toulepleu', 'TLP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(843, 52, 'Toumodi', 'TMD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(844, 52, 'Vavoua', 'VAV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(845, 52, 'Yamoussoukro', 'YAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(846, 52, 'Zuenoula', 'ZUE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(847, 53, 'Bjelovarsko-bilogorska', 'BB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(848, 53, 'Grad Zagreb', 'GZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(849, 53, 'DubrovaÃ„Âko-neretvanska', 'DN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(850, 53, 'Istarska', 'IS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(851, 53, 'KarlovaÃ„Âka', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(852, 53, 'KoprivniÃ„Âko-kriÃ…Â¾evaÃ„Âka', 'KK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(853, 53, 'Krapinsko-zagorska', 'KZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(854, 53, 'LiÃ„Âko-senjska', 'LS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(855, 53, 'MeÃ„â€˜imurska', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(856, 53, 'OsjeÃ„Âko-baranjska', 'OB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(857, 53, 'PoÃ…Â¾eÃ…Â¡ko-slavonska', 'PS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(858, 53, 'Primorsko-goranska', 'PG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(859, 53, 'Ã…Â ibensko-kninska', 'SK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(860, 53, 'SisaÃ„Âko-moslavaÃ„Âka', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(861, 53, 'Brodsko-posavska', 'BP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(862, 53, 'Splitsko-dalmatinska', 'SD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(863, 53, 'VaraÃ…Â¾dinska', 'VA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(864, 53, 'VirovitiÃ„Âko-podravska', 'VP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(865, 53, 'Vukovarsko-srijemska', 'VS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(866, 53, 'Zadarska', 'ZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(867, 53, 'ZagrebaÃ„Âka', 'ZG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(868, 54, 'Camaguey', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(869, 54, 'Ciego de Avila', 'CD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(870, 54, 'Cienfuegos', 'CI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(871, 54, 'Ciudad de La Habana', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(872, 54, 'Granma', 'GR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(873, 54, 'Guantanamo', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(874, 54, 'Holguin', 'HO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(875, 54, 'Isla de la Juventud', 'IJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(876, 54, 'La Habana', 'LH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(877, 54, 'Las Tunas', 'LT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(878, 54, 'Matanzas', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(879, 54, 'Pinar del Rio', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(880, 54, 'Sancti Spiritus', 'SS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(881, 54, 'Santiago de Cuba', 'SC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(882, 54, 'Villa Clara', 'VC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(883, 55, 'Famagusta', 'F', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(884, 55, 'Kyrenia', 'K', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(885, 55, 'Larnaca', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(886, 55, 'Limassol', 'I', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(887, 55, 'Nicosia', 'N', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(888, 55, 'Paphos', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(889, 56, 'ÃƒÅ¡steckÃƒÂ½', 'U', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(890, 56, 'JihoÃ„ÂeskÃƒÂ½', 'C', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(891, 56, 'JihomoravskÃƒÂ½', 'B', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(892, 56, 'KarlovarskÃƒÂ½', 'K', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(893, 56, 'KrÃƒÂ¡lovehradeckÃƒÂ½', 'H', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(894, 56, 'LibereckÃƒÂ½', 'L', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(895, 56, 'MoravskoslezskÃƒÂ½', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(896, 56, 'OlomouckÃƒÂ½', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(897, 56, 'PardubickÃƒÂ½', 'E', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(898, 56, 'PlzeÃ…Ë†skÃƒÂ½', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(899, 56, 'Praha', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(900, 56, 'StÃ…â„¢edoÃ„ÂeskÃƒÂ½', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(901, 56, 'VysoÃ„Âina', 'J', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(902, 56, 'ZlÃƒÂ­nskÃƒÂ½', 'Z', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(903, 57, 'Arhus', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(904, 57, 'Bornholm', 'BH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(905, 57, 'Copenhagen', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(906, 57, 'Faroe Islands', 'FO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(907, 57, 'Frederiksborg', 'FR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(908, 57, 'Fyn', 'FY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(909, 57, 'Kobenhavn', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(910, 57, 'Nordjylland', 'NO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(911, 57, 'Ribe', 'RI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(912, 57, 'Ringkobing', 'RK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(913, 57, 'Roskilde', 'RO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(914, 57, 'Sonderjylland', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(915, 57, 'Storstrom', 'ST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(916, 57, 'Vejle', 'VK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(917, 57, 'Vestj&aelig;lland', 'VJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(918, 57, 'Viborg', 'VB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(919, 58, '\'Ali Sabih', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(920, 58, 'Dikhil', 'K', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(921, 58, 'Djibouti', 'J', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(922, 58, 'Obock', 'O', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(923, 58, 'Tadjoura', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(924, 59, 'Saint Andrew Parish', 'AND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(925, 59, 'Saint David Parish', 'DAV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(926, 59, 'Saint George Parish', 'GEO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(927, 59, 'Saint John Parish', 'JOH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(928, 59, 'Saint Joseph Parish', 'JOS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(929, 59, 'Saint Luke Parish', 'LUK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(930, 59, 'Saint Mark Parish', 'MAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(931, 59, 'Saint Patrick Parish', 'PAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(932, 59, 'Saint Paul Parish', 'PAU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(933, 59, 'Saint Peter Parish', 'PET', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(934, 60, 'Distrito Nacional', 'DN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(935, 60, 'Azua', 'AZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(936, 60, 'Baoruco', 'BC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(937, 60, 'Barahona', 'BH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(938, 60, 'Dajabon', 'DJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(939, 60, 'Duarte', 'DU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(940, 60, 'Elias Pina', 'EL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(941, 60, 'El Seybo', 'SY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(942, 60, 'Espaillat', 'ET', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(943, 60, 'Hato Mayor', 'HM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(944, 60, 'Independencia', 'IN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(945, 60, 'La Altagracia', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(946, 60, 'La Romana', 'RO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(947, 60, 'La Vega', 'VE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(948, 60, 'Maria Trinidad Sanchez', 'MT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(949, 60, 'Monsenor Nouel', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(950, 60, 'Monte Cristi', 'MC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(951, 60, 'Monte Plata', 'MP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(952, 60, 'Pedernales', 'PD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(953, 60, 'Peravia (Bani)', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(954, 60, 'Puerto Plata', 'PP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(955, 60, 'Salcedo', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(956, 60, 'Samana', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(957, 60, 'Sanchez Ramirez', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(958, 60, 'San Cristobal', 'SC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(959, 60, 'San Jose de Ocoa', 'JO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(960, 60, 'San Juan', 'SJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(961, 60, 'San Pedro de Macoris', 'PM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(962, 60, 'Santiago', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(963, 60, 'Santiago Rodriguez', 'ST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(964, 60, 'Santo Domingo', 'SD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(965, 60, 'Valverde', 'VA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(966, 61, 'Aileu', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(967, 61, 'Ainaro', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(968, 61, 'Baucau', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(969, 61, 'Bobonaro', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(970, 61, 'Cova Lima', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(971, 61, 'Dili', 'DI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(972, 61, 'Ermera', 'ER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(973, 61, 'Lautem', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(974, 61, 'Liquica', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(975, 61, 'Manatuto', 'MT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(976, 61, 'Manufahi', 'MF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(977, 61, 'Oecussi', 'OE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(978, 61, 'Viqueque', 'VI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(979, 62, 'Azuay', 'AZU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(980, 62, 'Bolivar', 'BOL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(981, 62, 'Ca&ntilde;ar', 'CAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(982, 62, 'Carchi', 'CAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(983, 62, 'Chimborazo', 'CHI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(984, 62, 'Cotopaxi', 'COT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(985, 62, 'El Oro', 'EOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(986, 62, 'Esmeraldas', 'ESM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(987, 62, 'Gal&aacute;pagos', 'GPS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(988, 62, 'Guayas', 'GUA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(989, 62, 'Imbabura', 'IMB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(990, 62, 'Loja', 'LOJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(991, 62, 'Los Rios', 'LRO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(992, 62, 'Manab&iacute;', 'MAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(993, 62, 'Morona Santiago', 'MSA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(994, 62, 'Napo', 'NAP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(995, 62, 'Orellana', 'ORE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(996, 62, 'Pastaza', 'PAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(997, 62, 'Pichincha', 'PIC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(998, 62, 'Sucumb&iacute;os', 'SUC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(999, 62, 'Tungurahua', 'TUN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1000, 62, 'Zamora Chinchipe', 'ZCH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1001, 63, 'Ad Daqahliyah', 'DHY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1002, 63, 'Al Bahr al Ahmar', 'BAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1003, 63, 'Al Buhayrah', 'BHY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1004, 63, 'Al Fayyum', 'FYM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1005, 63, 'Al Gharbiyah', 'GBY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1006, 63, 'Al Iskandariyah', 'IDR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1007, 63, 'Al Isma\'iliyah', 'IML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1008, 63, 'Al Jizah', 'JZH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1009, 63, 'Al Minufiyah', 'MFY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1010, 63, 'Al Minya', 'MNY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1011, 63, 'Al Qahirah', 'QHR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1012, 63, 'Al Qalyubiyah', 'QLY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1013, 63, 'Al Wadi al Jadid', 'WJD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1014, 63, 'Ash Sharqiyah', 'SHQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1015, 63, 'As Suways', 'SWY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1016, 63, 'Aswan', 'ASW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1017, 63, 'Asyut', 'ASY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1018, 63, 'Bani Suwayf', 'BSW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1019, 63, 'Bur Sa\'id', 'BSD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1020, 63, 'Dumyat', 'DMY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1021, 63, 'Janub Sina\'', 'JNS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1022, 63, 'Kafr ash Shaykh', 'KSH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1023, 63, 'Matruh', 'MAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1024, 63, 'Qina', 'QIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1025, 63, 'Shamal Sina\'', 'SHS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1026, 63, 'Suhaj', 'SUH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1027, 64, 'Ahuachapan', 'AH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1028, 64, 'Cabanas', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1029, 64, 'Chalatenango', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1030, 64, 'Cuscatlan', 'CU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1031, 64, 'La Libertad', 'LB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1032, 64, 'La Paz', 'PZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1033, 64, 'La Union', 'UN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1034, 64, 'Morazan', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1035, 64, 'San Miguel', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1036, 64, 'San Salvador', 'SS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1037, 64, 'San Vicente', 'SV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1038, 64, 'Santa Ana', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1039, 64, 'Sonsonate', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1040, 64, 'Usulutan', 'US', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1041, 65, 'Provincia Annobon', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1042, 65, 'Provincia Bioko Norte', 'BN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1043, 65, 'Provincia Bioko Sur', 'BS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1044, 65, 'Provincia Centro Sur', 'CS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1045, 65, 'Provincia Kie-Ntem', 'KN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1046, 65, 'Provincia Litoral', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1047, 65, 'Provincia Wele-Nzas', 'WN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1048, 66, 'Central (Maekel)', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1049, 66, 'Anseba (Keren)', 'KE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1050, 66, 'Southern Red Sea (Debub-Keih-Bahri)', 'DK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1051, 66, 'Northern Red Sea (Semien-Keih-Bahri)', 'SK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1052, 66, 'Southern (Debub)', 'DE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1053, 66, 'Gash-Barka (Barentu)', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1054, 67, 'Harjumaa (Tallinn)', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1055, 67, 'Hiiumaa (Kardla)', 'HI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1056, 67, 'Ida-Virumaa (Johvi)', 'IV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1057, 67, 'Jarvamaa (Paide)', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1058, 67, 'Jogevamaa (Jogeva)', 'JO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1059, 67, 'Laane-Virumaa (Rakvere)', 'LV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1060, 67, 'Laanemaa (Haapsalu)', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1061, 67, 'Parnumaa (Parnu)', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1062, 67, 'Polvamaa (Polva)', 'PO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1063, 67, 'Raplamaa (Rapla)', 'RA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1064, 67, 'Saaremaa (Kuessaare)', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1065, 67, 'Tartumaa (Tartu)', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1066, 67, 'Valgamaa (Valga)', 'VA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1067, 67, 'Viljandimaa (Viljandi)', 'VI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1068, 67, 'Vorumaa (Voru)', 'VO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1069, 68, 'Afar', 'AF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1070, 68, 'Amhara', 'AH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1071, 68, 'Benishangul-Gumaz', 'BG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1072, 68, 'Gambela', 'GB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1073, 68, 'Hariai', 'HR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1074, 68, 'Oromia', 'OR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1075, 68, 'Somali', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1076, 68, 'Southern Nations - Nationalities and Peoples Region', 'SN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1077, 68, 'Tigray', 'TG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1078, 68, 'Addis Ababa', 'AA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1079, 68, 'Dire Dawa', 'DD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1080, 71, 'Central Division', 'C', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1081, 71, 'Northern Division', 'N', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1082, 71, 'Eastern Division', 'E', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1083, 71, 'Western Division', 'W', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1084, 71, 'Rotuma', 'R', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1085, 72, 'Ahvenanmaan lÃƒÂ¤ÃƒÂ¤ni', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1086, 72, 'EtelÃƒÂ¤-Suomen lÃƒÂ¤ÃƒÂ¤ni', 'ES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1087, 72, 'ItÃƒÂ¤-Suomen lÃƒÂ¤ÃƒÂ¤ni', 'IS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1088, 72, 'LÃƒÂ¤nsi-Suomen lÃƒÂ¤ÃƒÂ¤ni', 'LS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1089, 72, 'Lapin lÃƒÂ¤ÃƒÂ¤ni', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1090, 72, 'Oulun lÃƒÂ¤ÃƒÂ¤ni', 'OU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1114, 74, 'Ain', '01', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1115, 74, 'Aisne', '02', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1116, 74, 'Allier', '03', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1117, 74, 'Alpes de Haute Provence', '04', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1118, 74, 'Hautes-Alpes', '05', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1119, 74, 'Alpes Maritimes', '06', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1120, 74, 'Ard&egrave;che', '07', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1121, 74, 'Ardennes', '08', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1122, 74, 'Ari&egrave;ge', '09', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1123, 74, 'Aube', '10', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1124, 74, 'Aude', '11', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1125, 74, 'Aveyron', '12', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1126, 74, 'Bouches du Rh&ocirc;ne', '13', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1127, 74, 'Calvados', '14', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1128, 74, 'Cantal', '15', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1129, 74, 'Charente', '16', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1130, 74, 'Charente Maritime', '17', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1131, 74, 'Cher', '18', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1132, 74, 'Corr&egrave;ze', '19', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1133, 74, 'Corse du Sud', '2A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1134, 74, 'Haute Corse', '2B', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1135, 74, 'C&ocirc;te d&#039;or', '21', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1136, 74, 'C&ocirc;tes d&#039;Armor', '22', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1137, 74, 'Creuse', '23', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1138, 74, 'Dordogne', '24', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1139, 74, 'Doubs', '25', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1140, 74, 'Dr&ocirc;me', '26', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1141, 74, 'Eure', '27', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1142, 74, 'Eure et Loir', '28', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1143, 74, 'Finist&egrave;re', '29', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1144, 74, 'Gard', '30', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1145, 74, 'Haute Garonne', '31', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1146, 74, 'Gers', '32', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1147, 74, 'Gironde', '33', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1148, 74, 'H&eacute;rault', '34', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1149, 74, 'Ille et Vilaine', '35', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1150, 74, 'Indre', '36', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1151, 74, 'Indre et Loire', '37', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1152, 74, 'Is&eacute;re', '38', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1153, 74, 'Jura', '39', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1154, 74, 'Landes', '40', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1155, 74, 'Loir et Cher', '41', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1156, 74, 'Loire', '42', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1157, 74, 'Haute Loire', '43', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1158, 74, 'Loire Atlantique', '44', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1159, 74, 'Loiret', '45', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1160, 74, 'Lot', '46', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1161, 74, 'Lot et Garonne', '47', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1162, 74, 'Loz&egrave;re', '48', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1163, 74, 'Maine et Loire', '49', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1164, 74, 'Manche', '50', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1165, 74, 'Marne', '51', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1166, 74, 'Haute Marne', '52', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1167, 74, 'Mayenne', '53', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1168, 74, 'Meurthe et Moselle', '54', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1169, 74, 'Meuse', '55', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1170, 74, 'Morbihan', '56', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1171, 74, 'Moselle', '57', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1172, 74, 'Ni&egrave;vre', '58', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1173, 74, 'Nord', '59', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1174, 74, 'Oise', '60', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1175, 74, 'Orne', '61', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1176, 74, 'Pas de Calais', '62', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1177, 74, 'Puy de D&ocirc;me', '63', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1178, 74, 'Pyr&eacute;n&eacute;es Atlantiques', '64', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1179, 74, 'Hautes Pyr&eacute;n&eacute;es', '65', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1180, 74, 'Pyr&eacute;n&eacute;es Orientales', '66', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1181, 74, 'Bas Rhin', '67', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1182, 74, 'Haut Rhin', '68', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1183, 74, 'Rh&ocirc;ne', '69', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1184, 74, 'Haute Sa&ocirc;ne', '70', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1185, 74, 'Sa&ocirc;ne et Loire', '71', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1186, 74, 'Sarthe', '72', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1187, 74, 'Savoie', '73', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1188, 74, 'Haute Savoie', '74', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1189, 74, 'Paris', '75', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1190, 74, 'Seine Maritime', '76', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1191, 74, 'Seine et Marne', '77', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1192, 74, 'Yvelines', '78', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1193, 74, 'Deux S&egrave;vres', '79', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1194, 74, 'Somme', '80', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1195, 74, 'Tarn', '81', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1196, 74, 'Tarn et Garonne', '82', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1197, 74, 'Var', '83', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1198, 74, 'Vaucluse', '84', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1199, 74, 'Vend&eacute;e', '85', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1200, 74, 'Vienne', '86', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1201, 74, 'Haute Vienne', '87', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1202, 74, 'Vosges', '88', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1203, 74, 'Yonne', '89', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1204, 74, 'Territoire de Belfort', '90', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1205, 74, 'Essonne', '91', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1206, 74, 'Hauts de Seine', '92', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1207, 74, 'Seine St-Denis', '93', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1208, 74, 'Val de Marne', '94', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1209, 74, 'Val d\'Oise', '95', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1210, 76, 'Archipel des Marquises', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1211, 76, 'Archipel des Tuamotu', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1212, 76, 'Archipel des Tubuai', 'I', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1213, 76, 'Iles du Vent', 'V', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1214, 76, 'Iles Sous-le-Vent', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1215, 77, 'Iles Crozet', 'C', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1216, 77, 'Iles Kerguelen', 'K', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1217, 77, 'Ile Amsterdam', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1218, 77, 'Ile Saint-Paul', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1219, 77, 'Adelie Land', 'D', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1220, 78, 'Estuaire', 'ES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1221, 78, 'Haut-Ogooue', 'HO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1222, 78, 'Moyen-Ogooue', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1223, 78, 'Ngounie', 'NG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1224, 78, 'Nyanga', 'NY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1225, 78, 'Ogooue-Ivindo', 'OI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1226, 78, 'Ogooue-Lolo', 'OL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1227, 78, 'Ogooue-Maritime', 'OM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1228, 78, 'Woleu-Ntem', 'WN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1229, 79, 'Banjul', 'BJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1230, 79, 'Basse', 'BS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1231, 79, 'Brikama', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1232, 79, 'Janjangbure', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1233, 79, 'Kanifeng', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1234, 79, 'Kerewan', 'KE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1235, 79, 'Kuntaur', 'KU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1236, 79, 'Mansakonko', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1237, 79, 'Lower River', 'LR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1238, 79, 'Central River', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1239, 79, 'North Bank', 'NB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1240, 79, 'Upper River', 'UR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1241, 79, 'Western', 'WE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1242, 80, 'Abkhazia', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1243, 80, 'Ajaria', 'AJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1244, 80, 'Tbilisi', 'TB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1245, 80, 'Guria', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1246, 80, 'Imereti', 'IM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1247, 80, 'Kakheti', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1248, 80, 'Kvemo Kartli', 'KK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1249, 80, 'Mtskheta-Mtianeti', 'MM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1250, 80, 'Racha Lechkhumi and Kvemo Svanet', 'RL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1251, 80, 'Samegrelo-Zemo Svaneti', 'SZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1252, 80, 'Samtskhe-Javakheti', 'SJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1253, 80, 'Shida Kartli', 'SK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1254, 81, 'Baden-W&uuml;rttemberg', 'BAW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1255, 81, 'Bayern', 'BAY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1256, 81, 'Berlin', 'BER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1257, 81, 'Brandenburg', 'BRG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1258, 81, 'Bremen', 'BRE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1259, 81, 'Hamburg', 'HAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1260, 81, 'Hessen', 'HES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1261, 81, 'Mecklenburg-Vorpommern', 'MEC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1262, 81, 'Niedersachsen', 'NDS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1263, 81, 'Nordrhein-Westfalen', 'NRW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1264, 81, 'Rheinland-Pfalz', 'RHE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1265, 81, 'Saarland', 'SAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1266, 81, 'Sachsen', 'SAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1267, 81, 'Sachsen-Anhalt', 'SAC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1268, 81, 'Schleswig-Holstein', 'SCN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1269, 81, 'Th&uuml;ringen', 'THE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1270, 82, 'Ashanti Region', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1271, 82, 'Brong-Ahafo Region', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1272, 82, 'Central Region', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1273, 82, 'Eastern Region', 'EA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1274, 82, 'Greater Accra Region', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1275, 82, 'Northern Region', 'NO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1276, 82, 'Upper East Region', 'UE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1277, 82, 'Upper West Region', 'UW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1278, 82, 'Volta Region', 'VO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1279, 82, 'Western Region', 'WE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1280, 84, 'Attica', 'AT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1281, 84, 'Central Greece', 'CN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1282, 84, 'Central Macedonia', 'CM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1283, 84, 'Crete', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1284, 84, 'East Macedonia and Thrace', 'EM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1285, 84, 'Epirus', 'EP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1286, 84, 'Ionian Islands', 'II', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1287, 84, 'North Aegean', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1288, 84, 'Peloponnesos', 'PP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1289, 84, 'South Aegean', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1290, 84, 'Thessaly', 'TH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1291, 84, 'West Greece', 'WG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1292, 84, 'West Macedonia', 'WM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1293, 85, 'Avannaa', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1294, 85, 'Tunu', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1295, 85, 'Kitaa', 'K', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1296, 86, 'Saint Andrew', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1297, 86, 'Saint David', 'D', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1298, 86, 'Saint George', 'G', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1299, 86, 'Saint John', 'J', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1300, 86, 'Saint Mark', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1301, 86, 'Saint Patrick', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1302, 86, 'Carriacou', 'C', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1303, 86, 'Petit Martinique', 'Q', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1304, 89, 'Alta Verapaz', 'AV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1305, 89, 'Baja Verapaz', 'BV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1306, 89, 'Chimaltenango', 'CM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1307, 89, 'Chiquimula', 'CQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1308, 89, 'El Peten', 'PE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1309, 89, 'El Progreso', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1310, 89, 'El Quiche', 'QC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1311, 89, 'Escuintla', 'ES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1312, 89, 'Guatemala', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1313, 89, 'Huehuetenango', 'HU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1314, 89, 'Izabal', 'IZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1315, 89, 'Jalapa', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1316, 89, 'Jutiapa', 'JU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1317, 89, 'Quetzaltenango', 'QZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1318, 89, 'Retalhuleu', 'RE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1319, 89, 'Sacatepequez', 'ST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1320, 89, 'San Marcos', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1321, 89, 'Santa Rosa', 'SR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1322, 89, 'Solola', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1323, 89, 'Suchitepequez', 'SU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1324, 89, 'Totonicapan', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1325, 89, 'Zacapa', 'ZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1326, 90, 'Conakry', 'CNK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1327, 90, 'Beyla', 'BYL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1328, 90, 'Boffa', 'BFA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1329, 90, 'Boke', 'BOK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1330, 90, 'Coyah', 'COY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1331, 90, 'Dabola', 'DBL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1332, 90, 'Dalaba', 'DLB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1333, 90, 'Dinguiraye', 'DGR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1334, 90, 'Dubreka', 'DBR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1335, 90, 'Faranah', 'FRN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1336, 90, 'Forecariah', 'FRC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1337, 90, 'Fria', 'FRI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1338, 90, 'Gaoual', 'GAO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1339, 90, 'Gueckedou', 'GCD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1340, 90, 'Kankan', 'KNK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1341, 90, 'Kerouane', 'KRN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1342, 90, 'Kindia', 'KND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1343, 90, 'Kissidougou', 'KSD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1344, 90, 'Koubia', 'KBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1345, 90, 'Koundara', 'KDA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1346, 90, 'Kouroussa', 'KRA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1347, 90, 'Labe', 'LAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1348, 90, 'Lelouma', 'LLM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1349, 90, 'Lola', 'LOL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1350, 90, 'Macenta', 'MCT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1351, 90, 'Mali', 'MAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1352, 90, 'Mamou', 'MAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1353, 90, 'Mandiana', 'MAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1354, 90, 'Nzerekore', 'NZR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1355, 90, 'Pita', 'PIT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1356, 90, 'Siguiri', 'SIG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1357, 90, 'Telimele', 'TLM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1358, 90, 'Tougue', 'TOG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1359, 90, 'Yomou', 'YOM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1360, 91, 'Bafata Region', 'BF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1361, 91, 'Biombo Region', 'BB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1362, 91, 'Bissau Region', 'BS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1363, 91, 'Bolama Region', 'BL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1364, 91, 'Cacheu Region', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1365, 91, 'Gabu Region', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1366, 91, 'Oio Region', 'OI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1367, 91, 'Quinara Region', 'QU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1368, 91, 'Tombali Region', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1369, 92, 'Barima-Waini', 'BW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1370, 92, 'Cuyuni-Mazaruni', 'CM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1371, 92, 'Demerara-Mahaica', 'DM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1372, 92, 'East Berbice-Corentyne', 'EC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1373, 92, 'Essequibo Islands-West Demerara', 'EW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1374, 92, 'Mahaica-Berbice', 'MB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1375, 92, 'Pomeroon-Supenaam', 'PM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1376, 92, 'Potaro-Siparuni', 'PI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1377, 92, 'Upper Demerara-Berbice', 'UD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1378, 92, 'Upper Takutu-Upper Essequibo', 'UT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1379, 93, 'Artibonite', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1380, 93, 'Centre', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1381, 93, 'Grand\'Anse', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1382, 93, 'Nord', 'ND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1383, 93, 'Nord-Est', 'NE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1384, 93, 'Nord-Ouest', 'NO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1385, 93, 'Ouest', 'OU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1386, 93, 'Sud', 'SD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1387, 93, 'Sud-Est', 'SE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1388, 94, 'Flat Island', 'F', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1389, 94, 'McDonald Island', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1390, 94, 'Shag Island', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1391, 94, 'Heard Island', 'H', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1392, 95, 'Atlantida', 'AT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1393, 95, 'Choluteca', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1394, 95, 'Colon', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1395, 95, 'Comayagua', 'CM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1396, 95, 'Copan', 'CP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1397, 95, 'Cortes', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1398, 95, 'El Paraiso', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1399, 95, 'Francisco Morazan', 'FM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1400, 95, 'Gracias a Dios', 'GD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1401, 95, 'Intibuca', 'IN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1402, 95, 'Islas de la Bahia (Bay Islands)', 'IB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1403, 95, 'La Paz', 'PZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1404, 95, 'Lempira', 'LE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1405, 95, 'Ocotepeque', 'OC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1406, 95, 'Olancho', 'OL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1407, 95, 'Santa Barbara', 'SB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1408, 95, 'Valle', 'VA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1409, 95, 'Yoro', 'YO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1410, 96, 'Central and Western Hong Kong Island', 'HCW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1411, 96, 'Eastern Hong Kong Island', 'HEA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1412, 96, 'Southern Hong Kong Island', 'HSO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1413, 96, 'Wan Chai Hong Kong Island', 'HWC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1414, 96, 'Kowloon City Kowloon', 'KKC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1415, 96, 'Kwun Tong Kowloon', 'KKT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1416, 96, 'Sham Shui Po Kowloon', 'KSS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1417, 96, 'Wong Tai Sin Kowloon', 'KWT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1418, 96, 'Yau Tsim Mong Kowloon', 'KYT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1419, 96, 'Islands New Territories', 'NIS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1420, 96, 'Kwai Tsing New Territories', 'NKT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1421, 96, 'North New Territories', 'NNO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1422, 96, 'Sai Kung New Territories', 'NSK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1423, 96, 'Sha Tin New Territories', 'NST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1424, 96, 'Tai Po New Territories', 'NTP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1425, 96, 'Tsuen Wan New Territories', 'NTW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1426, 96, 'Tuen Mun New Territories', 'NTM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1427, 96, 'Yuen Long New Territories', 'NYL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1467, 98, 'Austurland', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1468, 98, 'Hofuoborgarsvaeoi', 'HF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1469, 98, 'Norourland eystra', 'NE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1470, 98, 'Norourland vestra', 'NV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1471, 98, 'Suourland', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1472, 98, 'Suournes', 'SN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1473, 98, 'Vestfiroir', 'VF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1474, 98, 'Vesturland', 'VL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1475, 99, 'Andaman and Nicobar Islands', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1476, 99, 'Andhra Pradesh', 'AP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1477, 99, 'Arunachal Pradesh', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1478, 99, 'Assam', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1479, 99, 'Bihar', 'BI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1480, 99, 'Chandigarh', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1481, 99, 'Dadra and Nagar Haveli', 'DA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1482, 99, 'Daman and Diu', 'DM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1483, 99, 'Delhi', 'DE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1484, 99, 'Goa', 'GO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1485, 99, 'Gujarat', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1486, 99, 'Haryana', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1487, 99, 'Himachal Pradesh', 'HP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1488, 99, 'Jammu and Kashmir', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1489, 99, 'Karnataka', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1490, 99, 'Kerala', 'KE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1491, 99, 'Lakshadweep Islands', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1492, 99, 'Madhya Pradesh', 'MP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1493, 99, 'Maharashtra', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1494, 99, 'Manipur', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1495, 99, 'Meghalaya', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1496, 99, 'Mizoram', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1497, 99, 'Nagaland', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1498, 99, 'Orissa', 'OR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1499, 99, 'Pondicherry', 'PO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1500, 99, 'Punjab', 'PU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1501, 99, 'Rajasthan', 'RA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1502, 99, 'Sikkim', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1503, 99, 'Tamil Nadu', 'TN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1504, 99, 'Tripura', 'TR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1505, 99, 'Uttar Pradesh', 'UP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1506, 99, 'West Bengal', 'WB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1507, 100, 'Aceh', 'AC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1508, 100, 'Bali', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1509, 100, 'Banten', 'BT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1510, 100, 'Bengkulu', 'BE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1511, 100, 'BoDeTaBek', 'BD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1512, 100, 'Gorontalo', 'GO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1513, 100, 'Jakarta Raya', 'JK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1514, 100, 'Jambi', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1515, 100, 'Jawa Barat', 'JB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1516, 100, 'Jawa Tengah', 'JT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1517, 100, 'Jawa Timur', 'JI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1518, 100, 'Kalimantan Barat', 'KB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1519, 100, 'Kalimantan Selatan', 'KS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1520, 100, 'Kalimantan Tengah', 'KT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1521, 100, 'Kalimantan Timur', 'KI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1522, 100, 'Kepulauan Bangka Belitung', 'BB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1523, 100, 'Lampung', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1524, 100, 'Maluku', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1525, 100, 'Maluku Utara', 'MU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1526, 100, 'Nusa Tenggara Barat', 'NB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1527, 100, 'Nusa Tenggara Timur', 'NT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1528, 100, 'Papua', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1529, 100, 'Riau', 'RI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1530, 100, 'Sulawesi Selatan', 'SN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1531, 100, 'Sulawesi Tengah', 'ST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1532, 100, 'Sulawesi Tenggara', 'SG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1533, 100, 'Sulawesi Utara', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1534, 100, 'Sumatera Barat', 'SB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1535, 100, 'Sumatera Selatan', 'SS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1536, 100, 'Sumatera Utara', 'SU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1537, 100, 'Yogyakarta', 'YO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1538, 101, 'Tehran', 'TEH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1539, 101, 'Qom', 'QOM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1540, 101, 'Markazi', 'MKZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1541, 101, 'Qazvin', 'QAZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1542, 101, 'Gilan', 'GIL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1543, 101, 'Ardabil', 'ARD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1544, 101, 'Zanjan', 'ZAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1545, 101, 'East Azarbaijan', 'EAZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1546, 101, 'West Azarbaijan', 'WEZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1547, 101, 'Kurdistan', 'KRD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1548, 101, 'Hamadan', 'HMD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1549, 101, 'Kermanshah', 'KRM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1550, 101, 'Ilam', 'ILM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1551, 101, 'Lorestan', 'LRS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1552, 101, 'Khuzestan', 'KZT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1553, 101, 'Chahar Mahaal and Bakhtiari', 'CMB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1554, 101, 'Kohkiluyeh and Buyer Ahmad', 'KBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1555, 101, 'Bushehr', 'BSH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1556, 101, 'Fars', 'FAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1557, 101, 'Hormozgan', 'HRM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1558, 101, 'Sistan and Baluchistan', 'SBL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1559, 101, 'Kerman', 'KRB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1560, 101, 'Yazd', 'YZD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1561, 101, 'Esfahan', 'EFH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1562, 101, 'Semnan', 'SMN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1563, 101, 'Mazandaran', 'MZD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1564, 101, 'Golestan', 'GLS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1565, 101, 'North Khorasan', 'NKH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1566, 101, 'Razavi Khorasan', 'RKH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1567, 101, 'South Khorasan', 'SKH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1568, 102, 'Baghdad', 'BD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1569, 102, 'Salah ad Din', 'SD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1570, 102, 'Diyala', 'DY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1571, 102, 'Wasit', 'WS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1572, 102, 'Maysan', 'MY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1573, 102, 'Al Basrah', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1574, 102, 'Dhi Qar', 'DQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1575, 102, 'Al Muthanna', 'MU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1576, 102, 'Al Qadisyah', 'QA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1577, 102, 'Babil', 'BB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1578, 102, 'Al Karbala', 'KB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1579, 102, 'An Najaf', 'NJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1580, 102, 'Al Anbar', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1581, 102, 'Ninawa', 'NN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1582, 102, 'Dahuk', 'DH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1583, 102, 'Arbil', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1584, 102, 'At Ta\'mim', 'TM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1585, 102, 'As Sulaymaniyah', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1586, 103, 'Carlow', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1587, 103, 'Cavan', 'CV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1588, 103, 'Clare', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1589, 103, 'Cork', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1590, 103, 'Donegal', 'DO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1591, 103, 'Dublin', 'DU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1592, 103, 'Galway', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1593, 103, 'Kerry', 'KE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1594, 103, 'Kildare', 'KI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1595, 103, 'Kilkenny', 'KL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1596, 103, 'Laois', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1597, 103, 'Leitrim', 'LE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1598, 103, 'Limerick', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1599, 103, 'Longford', 'LO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1600, 103, 'Louth', 'LU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1601, 103, 'Mayo', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1602, 103, 'Meath', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1603, 103, 'Monaghan', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `state` (`state_id`, `ref_country_id`, `state_name`, `code`, `status`, `delete_status`, `user_id`, `transaction_id`, `added_date`) VALUES
(1604, 103, 'Offaly', 'OF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1605, 103, 'Roscommon', 'RO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1606, 103, 'Sligo', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1607, 103, 'Tipperary', 'TI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1608, 103, 'Waterford', 'WA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1609, 103, 'Westmeath', 'WE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1610, 103, 'Wexford', 'WX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1611, 103, 'Wicklow', 'WI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1612, 104, 'Be\'er Sheva', 'BS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1613, 104, 'Bika\'at Hayarden', 'BH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1614, 104, 'Eilat and Arava', 'EA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1615, 104, 'Galil', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1616, 104, 'Haifa', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1617, 104, 'Jehuda Mountains', 'JM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1618, 104, 'Jerusalem', 'JE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1619, 104, 'Negev', 'NE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1620, 104, 'Semaria', 'SE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1621, 104, 'Sharon', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1622, 104, 'Tel Aviv (Gosh Dan)', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1643, 106, 'Clarendon Parish', 'CLA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1644, 106, 'Hanover Parish', 'HAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1645, 106, 'Kingston Parish', 'KIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1646, 106, 'Manchester Parish', 'MAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1647, 106, 'Portland Parish', 'POR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1648, 106, 'Saint Andrew Parish', 'AND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1649, 106, 'Saint Ann Parish', 'ANN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1650, 106, 'Saint Catherine Parish', 'CAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1651, 106, 'Saint Elizabeth Parish', 'ELI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1652, 106, 'Saint James Parish', 'JAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1653, 106, 'Saint Mary Parish', 'MAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1654, 106, 'Saint Thomas Parish', 'THO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1655, 106, 'Trelawny Parish', 'TRL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1656, 106, 'Westmoreland Parish', 'WML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1657, 107, 'Aichi', 'AI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1658, 107, 'Akita', 'AK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1659, 107, 'Aomori', 'AO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1660, 107, 'Chiba', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1661, 107, 'Ehime', 'EH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1662, 107, 'Fukui', 'FK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1663, 107, 'Fukuoka', 'FU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1664, 107, 'Fukushima', 'FS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1665, 107, 'Gifu', 'GI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1666, 107, 'Gumma', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1667, 107, 'Hiroshima', 'HI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1668, 107, 'Hokkaido', 'HO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1669, 107, 'Hyogo', 'HY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1670, 107, 'Ibaraki', 'IB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1671, 107, 'Ishikawa', 'IS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1672, 107, 'Iwate', 'IW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1673, 107, 'Kagawa', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1674, 107, 'Kagoshima', 'KG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1675, 107, 'Kanagawa', 'KN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1676, 107, 'Kochi', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1677, 107, 'Kumamoto', 'KU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1678, 107, 'Kyoto', 'KY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1679, 107, 'Mie', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1680, 107, 'Miyagi', 'MY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1681, 107, 'Miyazaki', 'MZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1682, 107, 'Nagano', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1683, 107, 'Nagasaki', 'NG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1684, 107, 'Nara', 'NR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1685, 107, 'Niigata', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1686, 107, 'Oita', 'OI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1687, 107, 'Okayama', 'OK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1688, 107, 'Okinawa', 'ON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1689, 107, 'Osaka', 'OS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1690, 107, 'Saga', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1691, 107, 'Saitama', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1692, 107, 'Shiga', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1693, 107, 'Shimane', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1694, 107, 'Shizuoka', 'SZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1695, 107, 'Tochigi', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1696, 107, 'Tokushima', 'TS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1697, 107, 'Tokyo', 'TK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1698, 107, 'Tottori', 'TT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1699, 107, 'Toyama', 'TY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1700, 107, 'Wakayama', 'WA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1701, 107, 'Yamagata', 'YA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1702, 107, 'Yamaguchi', 'YM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1703, 107, 'Yamanashi', 'YN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1704, 108, '\'Amman', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1705, 108, 'Ajlun', 'AJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1706, 108, 'Al \'Aqabah', 'AA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1707, 108, 'Al Balqa\'', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1708, 108, 'Al Karak', 'AK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1709, 108, 'Al Mafraq', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1710, 108, 'At Tafilah', 'AT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1711, 108, 'Az Zarqa\'', 'AZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1712, 108, 'Irbid', 'IR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1713, 108, 'Jarash', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1714, 108, 'Ma\'an', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1715, 108, 'Madaba', 'MD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1716, 109, 'Almaty', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1717, 109, 'Almaty City', 'AC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1718, 109, 'Aqmola', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1719, 109, 'Aqtobe', 'AQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1720, 109, 'Astana City', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1721, 109, 'Atyrau', 'AT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1722, 109, 'Batys Qazaqstan', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1723, 109, 'Bayqongyr City', 'BY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1724, 109, 'Mangghystau', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1725, 109, 'Ongtustik Qazaqstan', 'ON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1726, 109, 'Pavlodar', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1727, 109, 'Qaraghandy', 'QA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1728, 109, 'Qostanay', 'QO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1729, 109, 'Qyzylorda', 'QY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1730, 109, 'Shyghys Qazaqstan', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1731, 109, 'Soltustik Qazaqstan', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1732, 109, 'Zhambyl', 'ZH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1733, 110, 'Central', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1734, 110, 'Coast', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1735, 110, 'Eastern', 'EA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1736, 110, 'Nairobi Area', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1737, 110, 'North Eastern', 'NE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1738, 110, 'Nyanza', 'NY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1739, 110, 'Rift Valley', 'RV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1740, 110, 'Western', 'WE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1741, 111, 'Abaiang', 'AG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1742, 111, 'Abemama', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1743, 111, 'Aranuka', 'AK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1744, 111, 'Arorae', 'AO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1745, 111, 'Banaba', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1746, 111, 'Beru', 'BE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1747, 111, 'Butaritari', 'bT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1748, 111, 'Kanton', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1749, 111, 'Kiritimati', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1750, 111, 'Kuria', 'KU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1751, 111, 'Maiana', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1752, 111, 'Makin', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1753, 111, 'Marakei', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1754, 111, 'Nikunau', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1755, 111, 'Nonouti', 'NO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1756, 111, 'Onotoa', 'ON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1757, 111, 'Tabiteuea', 'TT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1758, 111, 'Tabuaeran', 'TR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1759, 111, 'Tamana', 'TM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1760, 111, 'Tarawa', 'TW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1761, 111, 'Teraina', 'TE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1762, 112, 'Chagang-do', 'CHA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1763, 112, 'Hamgyong-bukto', 'HAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1764, 112, 'Hamgyong-namdo', 'HAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1765, 112, 'Hwanghae-bukto', 'HWB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1766, 112, 'Hwanghae-namdo', 'HWN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1767, 112, 'Kangwon-do', 'KAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1768, 112, 'P\'yongan-bukto', 'PYB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1769, 112, 'P\'yongan-namdo', 'PYN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1770, 112, 'Ryanggang-do (Yanggang-do)', 'YAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1771, 112, 'Rason Directly Governed City', 'NAJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1772, 112, 'P\'yongyang Special City', 'PYO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1773, 113, 'Ch\'ungch\'ong-bukto', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1774, 113, 'Ch\'ungch\'ong-namdo', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1775, 113, 'Cheju-do', 'CD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1776, 113, 'Cholla-bukto', 'CB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1777, 113, 'Cholla-namdo', 'CN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1778, 113, 'Inch\'on-gwangyoksi', 'IG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1779, 113, 'Kangwon-do', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1780, 113, 'Kwangju-gwangyoksi', 'KG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1781, 113, 'Kyonggi-do', 'KD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1782, 113, 'Kyongsang-bukto', 'KB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1783, 113, 'Kyongsang-namdo', 'KN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1784, 113, 'Pusan-gwangyoksi', 'PG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1785, 113, 'Soul-t\'ukpyolsi', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1786, 113, 'Taegu-gwangyoksi', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1787, 113, 'Taejon-gwangyoksi', 'TG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1788, 114, 'Al \'Asimah', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1789, 114, 'Al Ahmadi', 'AA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1790, 114, 'Al Farwaniyah', 'AF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1791, 114, 'Al Jahra\'', 'AJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1792, 114, 'Hawalli', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1793, 115, 'Bishkek', 'GB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1794, 115, 'Batken', 'B', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1795, 115, 'Chu', 'C', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1796, 115, 'Jalal-Abad', 'J', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1797, 115, 'Naryn', 'N', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1798, 115, 'Osh', 'O', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1799, 115, 'Talas', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1800, 115, 'Ysyk-Kol', 'Y', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1801, 116, 'Vientiane', 'VT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1802, 116, 'Attapu', 'AT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1803, 116, 'Bokeo', 'BK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1804, 116, 'Bolikhamxai', 'BL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1805, 116, 'Champasak', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1806, 116, 'Houaphan', 'HO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1807, 116, 'Khammouan', 'KH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1808, 116, 'Louang Namtha', 'LM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1809, 116, 'Louangphabang', 'LP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1810, 116, 'Oudomxai', 'OU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1811, 116, 'Phongsali', 'PH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1812, 116, 'Salavan', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1813, 116, 'Savannakhet', 'SV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1814, 116, 'Vientiane', 'VI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1815, 116, 'Xaignabouli', 'XA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1816, 116, 'Xekong', 'XE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1817, 116, 'Xiangkhoang', 'XI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1818, 116, 'Xaisomboun', 'XN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1852, 119, 'Berea', 'BE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1853, 119, 'Butha-Buthe', 'BB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1854, 119, 'Leribe', 'LE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1855, 119, 'Mafeteng', 'MF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1856, 119, 'Maseru', 'MS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1857, 119, 'Mohale\'s Hoek', 'MH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1858, 119, 'Mokhotlong', 'MK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1859, 119, 'Qacha\'s Nek', 'QN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1860, 119, 'Quthing', 'QT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1861, 119, 'Thaba-Tseka', 'TT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1862, 120, 'Bomi', 'BI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1863, 120, 'Bong', 'BG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1864, 120, 'Grand Bassa', 'GB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1865, 120, 'Grand Cape Mount', 'CM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1866, 120, 'Grand Gedeh', 'GG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1867, 120, 'Grand Kru', 'GK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1868, 120, 'Lofa', 'LO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1869, 120, 'Margibi', 'MG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1870, 120, 'Maryland', 'ML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1871, 120, 'Montserrado', 'MS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1872, 120, 'Nimba', 'NB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1873, 120, 'River Cess', 'RC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1874, 120, 'Sinoe', 'SN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1875, 121, 'Ajdabiya', 'AJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1876, 121, 'Al \'Aziziyah', 'AZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1877, 121, 'Al Fatih', 'FA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1878, 121, 'Al Jabal al Akhdar', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1879, 121, 'Al Jufrah', 'JU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1880, 121, 'Al Khums', 'KH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1881, 121, 'Al Kufrah', 'KU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1882, 121, 'An Nuqat al Khams', 'NK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1883, 121, 'Ash Shati\'', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1884, 121, 'Awbari', 'AW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1885, 121, 'Az Zawiyah', 'ZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1886, 121, 'Banghazi', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1887, 121, 'Darnah', 'DA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1888, 121, 'Ghadamis', 'GD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1889, 121, 'Gharyan', 'GY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1890, 121, 'Misratah', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1891, 121, 'Murzuq', 'MZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1892, 121, 'Sabha', 'SB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1893, 121, 'Sawfajjin', 'SW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1894, 121, 'Surt', 'SU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1895, 121, 'Tarabulus (Tripoli)', 'TL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1896, 121, 'Tarhunah', 'TH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1897, 121, 'Tubruq', 'TU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1898, 121, 'Yafran', 'YA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1899, 121, 'Zlitan', 'ZL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1900, 122, 'Vaduz', 'V', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1901, 122, 'Schaan', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1902, 122, 'Balzers', 'B', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1903, 122, 'Triesen', 'N', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1904, 122, 'Eschen', 'E', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1905, 122, 'Mauren', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1906, 122, 'Triesenberg', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1907, 122, 'Ruggell', 'R', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1908, 122, 'Gamprin', 'G', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1909, 122, 'Schellenberg', 'L', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1910, 122, 'Planken', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1911, 123, 'Alytus', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1912, 123, 'Kaunas', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1913, 123, 'Klaipeda', 'KL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1914, 123, 'Marijampole', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1915, 123, 'Panevezys', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1916, 123, 'Siauliai', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1917, 123, 'Taurage', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1918, 123, 'Telsiai', 'TE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1919, 123, 'Utena', 'UT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1920, 123, 'Vilnius', 'VI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1921, 124, 'Diekirch', 'DD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1922, 124, 'Clervaux', 'DC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1923, 124, 'Redange', 'DR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1924, 124, 'Vianden', 'DV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1925, 124, 'Wiltz', 'DW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1926, 124, 'Grevenmacher', 'GG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1927, 124, 'Echternach', 'GE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1928, 124, 'Remich', 'GR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1929, 124, 'Luxembourg', 'LL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1930, 124, 'Capellen', 'LC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1931, 124, 'Esch-sur-Alzette', 'LE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1932, 124, 'Mersch', 'LM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1933, 125, 'Our Lady Fatima Parish', 'OLF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1934, 125, 'St. Anthony Parish', 'ANT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1935, 125, 'St. Lazarus Parish', 'LAZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1936, 125, 'Cathedral Parish', 'CAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1937, 125, 'St. Lawrence Parish', 'LAW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1938, 127, 'Antananarivo', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1939, 127, 'Antsiranana', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1940, 127, 'Fianarantsoa', 'FN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1941, 127, 'Mahajanga', 'MJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1942, 127, 'Toamasina', 'TM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1943, 127, 'Toliara', 'TL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1944, 128, 'Balaka', 'BLK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1945, 128, 'Blantyre', 'BLT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1946, 128, 'Chikwawa', 'CKW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1947, 128, 'Chiradzulu', 'CRD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1948, 128, 'Chitipa', 'CTP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1949, 128, 'Dedza', 'DDZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1950, 128, 'Dowa', 'DWA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1951, 128, 'Karonga', 'KRG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1952, 128, 'Kasungu', 'KSG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1953, 128, 'Likoma', 'LKM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1954, 128, 'Lilongwe', 'LLG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1955, 128, 'Machinga', 'MCG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1956, 128, 'Mangochi', 'MGC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1957, 128, 'Mchinji', 'MCH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1958, 128, 'Mulanje', 'MLJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1959, 128, 'Mwanza', 'MWZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1960, 128, 'Mzimba', 'MZM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1961, 128, 'Ntcheu', 'NTU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1962, 128, 'Nkhata Bay', 'NKB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1963, 128, 'Nkhotakota', 'NKH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1964, 128, 'Nsanje', 'NSJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1965, 128, 'Ntchisi', 'NTI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1966, 128, 'Phalombe', 'PHL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1967, 128, 'Rumphi', 'RMP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1968, 128, 'Salima', 'SLM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1969, 128, 'Thyolo', 'THY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1970, 128, 'Zomba', 'ZBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1971, 129, 'Johor', 'MY-01', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1972, 129, 'Kedah', 'MY-02', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1973, 129, 'Kelantan', 'MY-03', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1974, 129, 'Labuan', 'MY-15', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1975, 129, 'Melaka', 'MY-04', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1976, 129, 'Negeri Sembilan', 'MY-05', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1977, 129, 'Pahang', 'MY-06', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1978, 129, 'Perak', 'MY-08', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1979, 129, 'Perlis', 'MY-09', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1980, 129, 'Pulau Pinang', 'MY-07', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1981, 129, 'Sabah', 'MY-12', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1982, 129, 'Sarawak', 'MY-13', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1983, 129, 'Selangor', 'MY-10', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1984, 129, 'Terengganu', 'MY-11', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1985, 129, 'Kuala Lumpur', 'MY-14', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1986, 130, 'Thiladhunmathi Uthuru', 'THU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1987, 130, 'Thiladhunmathi Dhekunu', 'THD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1988, 130, 'Miladhunmadulu Uthuru', 'MLU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1989, 130, 'Miladhunmadulu Dhekunu', 'MLD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1990, 130, 'Maalhosmadulu Uthuru', 'MAU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1991, 130, 'Maalhosmadulu Dhekunu', 'MAD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1992, 130, 'Faadhippolhu', 'FAA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1993, 130, 'Male Atoll', 'MAA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1994, 130, 'Ari Atoll Uthuru', 'AAU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1995, 130, 'Ari Atoll Dheknu', 'AAD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1996, 130, 'Felidhe Atoll', 'FEA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1997, 130, 'Mulaku Atoll', 'MUA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1998, 130, 'Nilandhe Atoll Uthuru', 'NAU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(1999, 130, 'Nilandhe Atoll Dhekunu', 'NAD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2000, 130, 'Kolhumadulu', 'KLH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2001, 130, 'Hadhdhunmathi', 'HDH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2002, 130, 'Huvadhu Atoll Uthuru', 'HAU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2003, 130, 'Huvadhu Atoll Dhekunu', 'HAD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2004, 130, 'Fua Mulaku', 'FMU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2005, 130, 'Addu', 'ADD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2006, 131, 'Gao', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2007, 131, 'Kayes', 'KY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2008, 131, 'Kidal', 'KD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2009, 131, 'Koulikoro', 'KL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2010, 131, 'Mopti', 'MP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2011, 131, 'Segou', 'SG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2012, 131, 'Sikasso', 'SK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2013, 131, 'Tombouctou', 'TB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2014, 131, 'Bamako Capital District', 'CD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2015, 132, 'Attard', 'ATT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2016, 132, 'Balzan', 'BAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2017, 132, 'Birgu', 'BGU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2018, 132, 'Birkirkara', 'BKK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2019, 132, 'Birzebbuga', 'BRZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2020, 132, 'Bormla', 'BOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2021, 132, 'Dingli', 'DIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2022, 132, 'Fgura', 'FGU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2023, 132, 'Floriana', 'FLO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2024, 132, 'Gudja', 'GDJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2025, 132, 'Gzira', 'GZR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2026, 132, 'Gargur', 'GRG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2027, 132, 'Gaxaq', 'GXQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2028, 132, 'Hamrun', 'HMR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2029, 132, 'Iklin', 'IKL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2030, 132, 'Isla', 'ISL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2031, 132, 'Kalkara', 'KLK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2032, 132, 'Kirkop', 'KRK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2033, 132, 'Lija', 'LIJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2034, 132, 'Luqa', 'LUQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2035, 132, 'Marsa', 'MRS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2036, 132, 'Marsaskala', 'MKL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2037, 132, 'Marsaxlokk', 'MXL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2038, 132, 'Mdina', 'MDN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2039, 132, 'Melliea', 'MEL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2040, 132, 'Mgarr', 'MGR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2041, 132, 'Mosta', 'MST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2042, 132, 'Mqabba', 'MQA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2043, 132, 'Msida', 'MSI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2044, 132, 'Mtarfa', 'MTF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2045, 132, 'Naxxar', 'NAX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2046, 132, 'Paola', 'PAO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2047, 132, 'Pembroke', 'PEM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2048, 132, 'Pieta', 'PIE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2049, 132, 'Qormi', 'QOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2050, 132, 'Qrendi', 'QRE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2051, 132, 'Rabat', 'RAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2052, 132, 'Safi', 'SAF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2053, 132, 'San Giljan', 'SGI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2054, 132, 'Santa Lucija', 'SLU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2055, 132, 'San Pawl il-Bahar', 'SPB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2056, 132, 'San Gwann', 'SGW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2057, 132, 'Santa Venera', 'SVE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2058, 132, 'Siggiewi', 'SIG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2059, 132, 'Sliema', 'SLM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2060, 132, 'Swieqi', 'SWQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2061, 132, 'Ta Xbiex', 'TXB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2062, 132, 'Tarxien', 'TRX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2063, 132, 'Valletta', 'VLT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2064, 132, 'Xgajra', 'XGJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2065, 132, 'Zabbar', 'ZBR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2066, 132, 'Zebbug', 'ZBG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2067, 132, 'Zejtun', 'ZJT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2068, 132, 'Zurrieq', 'ZRQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2069, 132, 'Fontana', 'FNT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2070, 132, 'Ghajnsielem', 'GHJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2071, 132, 'Gharb', 'GHR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2072, 132, 'Ghasri', 'GHS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2073, 132, 'Kercem', 'KRC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2074, 132, 'Munxar', 'MUN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2075, 132, 'Nadur', 'NAD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2076, 132, 'Qala', 'QAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2077, 132, 'Victoria', 'VIC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2078, 132, 'San Lawrenz', 'SLA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2079, 132, 'Sannat', 'SNT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2080, 132, 'Xagra', 'ZAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2081, 132, 'Xewkija', 'XEW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2082, 132, 'Zebbug', 'ZEB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2083, 133, 'Ailinginae', 'ALG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2084, 133, 'Ailinglaplap', 'ALL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2085, 133, 'Ailuk', 'ALK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2086, 133, 'Arno', 'ARN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2087, 133, 'Aur', 'AUR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2088, 133, 'Bikar', 'BKR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2089, 133, 'Bikini', 'BKN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2090, 133, 'Bokak', 'BKK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2091, 133, 'Ebon', 'EBN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2092, 133, 'Enewetak', 'ENT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2093, 133, 'Erikub', 'EKB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2094, 133, 'Jabat', 'JBT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2095, 133, 'Jaluit', 'JLT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2096, 133, 'Jemo', 'JEM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2097, 133, 'Kili', 'KIL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2098, 133, 'Kwajalein', 'KWJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2099, 133, 'Lae', 'LAE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2100, 133, 'Lib', 'LIB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2101, 133, 'Likiep', 'LKP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2102, 133, 'Majuro', 'MJR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2103, 133, 'Maloelap', 'MLP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2104, 133, 'Mejit', 'MJT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2105, 133, 'Mili', 'MIL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2106, 133, 'Namorik', 'NMK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2107, 133, 'Namu', 'NAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2108, 133, 'Rongelap', 'RGL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2109, 133, 'Rongrik', 'RGK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2110, 133, 'Toke', 'TOK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2111, 133, 'Ujae', 'UJA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2112, 133, 'Ujelang', 'UJL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2113, 133, 'Utirik', 'UTK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2114, 133, 'Wotho', 'WTH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2115, 133, 'Wotje', 'WTJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2116, 135, 'Adrar', 'AD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2117, 135, 'Assaba', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2118, 135, 'Brakna', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2119, 135, 'Dakhlet Nouadhibou', 'DN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2120, 135, 'Gorgol', 'GO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2121, 135, 'Guidimaka', 'GM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2122, 135, 'Hodh Ech Chargui', 'HC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2123, 135, 'Hodh El Gharbi', 'HG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2124, 135, 'Inchiri', 'IN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2125, 135, 'Tagant', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2126, 135, 'Tiris Zemmour', 'TZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2127, 135, 'Trarza', 'TR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2128, 135, 'Nouakchott', 'NO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2129, 136, 'Beau Bassin-Rose Hill', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2130, 136, 'Curepipe', 'CU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2131, 136, 'Port Louis', 'PU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2132, 136, 'Quatre Bornes', 'QB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2133, 136, 'Vacoas-Phoenix', 'VP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2134, 136, 'Agalega Islands', 'AG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2135, 136, 'Cargados Carajos Shoals (Saint Brandon Islands)', 'CC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2136, 136, 'Rodrigues', 'RO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2137, 136, 'Black River', 'BL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2138, 136, 'Flacq', 'FL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2139, 136, 'Grand Port', 'GP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2140, 136, 'Moka', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2141, 136, 'Pamplemousses', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2142, 136, 'Plaines Wilhems', 'PW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2143, 136, 'Port Louis', 'PL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2144, 136, 'Riviere du Rempart', 'RR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2145, 136, 'Savanne', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2146, 138, 'Baja California Norte', 'BN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2147, 138, 'Baja California Sur', 'BS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2148, 138, 'Campeche', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2149, 138, 'Chiapas', 'CI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2150, 138, 'Chihuahua', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2151, 138, 'Coahuila de Zaragoza', 'CZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2152, 138, 'Colima', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2153, 138, 'Distrito Federal', 'DF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2154, 138, 'Durango', 'DU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2155, 138, 'Guanajuato', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2156, 138, 'Guerrero', 'GE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2157, 138, 'Hidalgo', 'HI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2158, 138, 'Jalisco', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2159, 138, 'Mexico', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2160, 138, 'Michoacan de Ocampo', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2161, 138, 'Morelos', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2162, 138, 'Nayarit', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2163, 138, 'Nuevo Leon', 'NL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2164, 138, 'Oaxaca', 'OA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2165, 138, 'Puebla', 'PU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2166, 138, 'Queretaro de Arteaga', 'QA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2167, 138, 'Quintana Roo', 'QR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2168, 138, 'San Luis Potosi', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2169, 138, 'Sinaloa', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2170, 138, 'Sonora', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2171, 138, 'Tabasco', 'TB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2172, 138, 'Tamaulipas', 'TM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2173, 138, 'Tlaxcala', 'TL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2174, 138, 'Veracruz-Llave', 'VE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2175, 138, 'Yucatan', 'YU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2176, 138, 'Zacatecas', 'ZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2177, 139, 'Chuuk', 'C', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2178, 139, 'Kosrae', 'K', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2179, 139, 'Pohnpei', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2180, 139, 'Yap', 'Y', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2181, 140, 'Gagauzia', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2182, 140, 'Chisinau', 'CU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2183, 140, 'Balti', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2184, 140, 'Cahul', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2185, 140, 'Edinet', 'ED', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2186, 140, 'Lapusna', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2187, 140, 'Orhei', 'OR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2188, 140, 'Soroca', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2189, 140, 'Tighina', 'TI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2190, 140, 'Ungheni', 'UN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2191, 140, 'StÃ¢â‚¬Å¡nga Nistrului', 'SN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2192, 141, 'Fontvieille', 'FV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2193, 141, 'La Condamine', 'LC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2194, 141, 'Monaco-Ville', 'MV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2195, 141, 'Monte-Carlo', 'MC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2196, 142, 'Ulanbaatar', '1', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2197, 142, 'Orhon', '035', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2198, 142, 'Darhan uul', '037', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2199, 142, 'Hentiy', '039', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2200, 142, 'Hovsgol', '041', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2201, 142, 'Hovd', '043', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2202, 142, 'Uvs', '046', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2203, 142, 'Tov', '047', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2204, 142, 'Selenge', '049', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2205, 142, 'Suhbaatar', '051', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2206, 142, 'Omnogovi', '053', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2207, 142, 'Ovorhangay', '055', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2208, 142, 'Dzavhan', '057', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2209, 142, 'DundgovL', '059', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2210, 142, 'Dornod', '061', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2211, 142, 'Dornogov', '063', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2212, 142, 'Govi-Sumber', '064', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2213, 142, 'Govi-Altay', '065', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2214, 142, 'Bulgan', '067', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2215, 142, 'Bayanhongor', '069', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2216, 142, 'Bayan-Olgiy', '071', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2217, 142, 'Arhangay', '073', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2218, 143, 'Saint Anthony', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2219, 143, 'Saint Georges', 'G', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2220, 143, 'Saint Peter', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2221, 144, 'Agadir', 'AGD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2222, 144, 'Al Hoceima', 'HOC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2223, 144, 'Azilal', 'AZI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2224, 144, 'Beni Mellal', 'BME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2225, 144, 'Ben Slimane', 'BSL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2226, 144, 'Boulemane', 'BLM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2227, 144, 'Casablanca', 'CBL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2228, 144, 'Chaouen', 'CHA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2229, 144, 'El Jadida', 'EJA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2230, 144, 'El Kelaa des Sraghna', 'EKS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2231, 144, 'Er Rachidia', 'ERA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2232, 144, 'Essaouira', 'ESS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2233, 144, 'Fes', 'FES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2234, 144, 'Figuig', 'FIG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2235, 144, 'Guelmim', 'GLM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2236, 144, 'Ifrane', 'IFR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2237, 144, 'Kenitra', 'KEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2238, 144, 'Khemisset', 'KHM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2239, 144, 'Khenifra', 'KHN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2240, 144, 'Khouribga', 'KHO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2241, 144, 'Laayoune', 'LYN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2242, 144, 'Larache', 'LAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2243, 144, 'Marrakech', 'MRK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2244, 144, 'Meknes', 'MKN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2245, 144, 'Nador', 'NAD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2246, 144, 'Ouarzazate', 'ORZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2247, 144, 'Oujda', 'OUJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2248, 144, 'Rabat-Sale', 'RSA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2249, 144, 'Safi', 'SAF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2250, 144, 'Settat', 'SET', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2251, 144, 'Sidi Kacem', 'SKA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2252, 144, 'Tangier', 'TGR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2253, 144, 'Tan-Tan', 'TAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2254, 144, 'Taounate', 'TAO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2255, 144, 'Taroudannt', 'TRD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2256, 144, 'Tata', 'TAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2257, 144, 'Taza', 'TAZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2258, 144, 'Tetouan', 'TET', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2259, 144, 'Tiznit', 'TIZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2260, 144, 'Ad Dakhla', 'ADK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2261, 144, 'Boujdour', 'BJD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2262, 144, 'Es Smara', 'ESM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2263, 145, 'Cabo Delgado', 'CD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2264, 145, 'Gaza', 'GZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2265, 145, 'Inhambane', 'IN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2266, 145, 'Manica', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2267, 145, 'Maputo (city)', 'MC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2268, 145, 'Maputo', 'MP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2269, 145, 'Nampula', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2270, 145, 'Niassa', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2271, 145, 'Sofala', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2272, 145, 'Tete', 'TE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2273, 145, 'Zambezia', 'ZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2274, 146, 'Ayeyarwady', 'AY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2275, 146, 'Bago', 'BG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2276, 146, 'Magway', 'MG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2277, 146, 'Mandalay', 'MD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2278, 146, 'Sagaing', 'SG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2279, 146, 'Tanintharyi', 'TN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2280, 146, 'Yangon', 'YG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2281, 146, 'Chin State', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2282, 146, 'Kachin State', 'KC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2283, 146, 'Kayah State', 'KH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2284, 146, 'Kayin State', 'KN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2285, 146, 'Mon State', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2286, 146, 'Rakhine State', 'RK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2287, 146, 'Shan State', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2288, 147, 'Caprivi', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2289, 147, 'Erongo', 'ER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2290, 147, 'Hardap', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2291, 147, 'Karas', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2292, 147, 'Kavango', 'KV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2293, 147, 'Khomas', 'KH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2294, 147, 'Kunene', 'KU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2295, 147, 'Ohangwena', 'OW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2296, 147, 'Omaheke', 'OK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2297, 147, 'Omusati', 'OT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2298, 147, 'Oshana', 'ON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2299, 147, 'Oshikoto', 'OO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2300, 147, 'Otjozondjupa', 'OJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2301, 148, 'Aiwo', 'AO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2302, 148, 'Anabar', 'AA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2303, 148, 'Anetan', 'AT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2304, 148, 'Anibare', 'AI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2305, 148, 'Baiti', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2306, 148, 'Boe', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2307, 148, 'Buada', 'BU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2308, 148, 'Denigomodu', 'DE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2309, 148, 'Ewa', 'EW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2310, 148, 'Ijuw', 'IJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2311, 148, 'Meneng', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2312, 148, 'Nibok', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2313, 148, 'Uaboe', 'UA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2314, 148, 'Yaren', 'YA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2315, 149, 'Bagmati', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2316, 149, 'Bheri', 'BH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2317, 149, 'Dhawalagiri', 'DH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2318, 149, 'Gandaki', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2319, 149, 'Janakpur', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2320, 149, 'Karnali', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2321, 149, 'Kosi', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2322, 149, 'Lumbini', 'LU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2323, 149, 'Mahakali', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2324, 149, 'Mechi', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2325, 149, 'Narayani', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2326, 149, 'Rapti', 'RA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2327, 149, 'Sagarmatha', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2328, 149, 'Seti', 'SE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2329, 150, 'Drenthe', 'DR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2330, 150, 'Flevoland', 'FL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2331, 150, 'Friesland', 'FR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2332, 150, 'Gelderland', 'GE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2333, 150, 'Groningen', 'GR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2334, 150, 'Limburg', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2335, 150, 'Noord Brabant', 'NB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2336, 150, 'Noord Holland', 'NH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2337, 150, 'Overijssel', 'OV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2338, 150, 'Utrecht', 'UT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2339, 150, 'Zeeland', 'ZE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2340, 150, 'Zuid Holland', 'ZH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2341, 152, 'Iles Loyaute', 'L', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2342, 152, 'Nord', 'N', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2343, 152, 'Sud', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2344, 153, 'Auckland', 'AUK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2345, 153, 'Bay of Plenty', 'BOP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2346, 153, 'Canterbury', 'CAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2347, 153, 'Coromandel', 'COR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2348, 153, 'Gisborne', 'GIS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2349, 153, 'Fiordland', 'FIO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2350, 153, 'Hawke\'s Bay', 'HKB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2351, 153, 'Marlborough', 'MBH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2352, 153, 'Manawatu-Wanganui', 'MWT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2353, 153, 'Mt Cook-Mackenzie', 'MCM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2354, 153, 'Nelson', 'NSN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2355, 153, 'Northland', 'NTL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2356, 153, 'Otago', 'OTA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2357, 153, 'Southland', 'STL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2358, 153, 'Taranaki', 'TKI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2359, 153, 'Wellington', 'WGN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2360, 153, 'Waikato', 'WKO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2361, 153, 'Wairarapa', 'WAI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2362, 153, 'West Coast', 'WTC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2363, 154, 'Atlantico Norte', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2364, 154, 'Atlantico Sur', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2365, 154, 'Boaco', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2366, 154, 'Carazo', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2367, 154, 'Chinandega', 'CI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2368, 154, 'Chontales', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2369, 154, 'Esteli', 'ES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2370, 154, 'Granada', 'GR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2371, 154, 'Jinotega', 'JI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2372, 154, 'Leon', 'LE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2373, 154, 'Madriz', 'MD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2374, 154, 'Managua', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2375, 154, 'Masaya', 'MS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2376, 154, 'Matagalpa', 'MT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2377, 154, 'Nuevo Segovia', 'NS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2378, 154, 'Rio San Juan', 'RS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2379, 154, 'Rivas', 'RI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2380, 155, 'Agadez', 'AG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2381, 155, 'Diffa', 'DF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2382, 155, 'Dosso', 'DS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2383, 155, 'Maradi', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2384, 155, 'Niamey', 'NM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2385, 155, 'Tahoua', 'TH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2386, 155, 'Tillaberi', 'TL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2387, 155, 'Zinder', 'ZD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2388, 156, 'Abia', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2389, 156, 'Abuja Federal Capital Territory', 'CT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2390, 156, 'Adamawa', 'AD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2391, 156, 'Akwa Ibom', 'AK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2392, 156, 'Anambra', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2393, 156, 'Bauchi', 'BC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2394, 156, 'Bayelsa', 'BY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2395, 156, 'Benue', 'BN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2396, 156, 'Borno', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2397, 156, 'Cross River', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2398, 156, 'Delta', 'DE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2399, 156, 'Ebonyi', 'EB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2400, 156, 'Edo', 'ED', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2401, 156, 'Ekiti', 'EK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2402, 156, 'Enugu', 'EN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2403, 156, 'Gombe', 'GO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2404, 156, 'Imo', 'IM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2405, 156, 'Jigawa', 'JI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2406, 156, 'Kaduna', 'KD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2407, 156, 'Kano', 'KN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2408, 156, 'Katsina', 'KT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2409, 156, 'Kebbi', 'KE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2410, 156, 'Kogi', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2411, 156, 'Kwara', 'KW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2412, 156, 'Lagos', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2413, 156, 'Nassarawa', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2414, 156, 'Niger', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2415, 156, 'Ogun', 'OG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2416, 156, 'Ondo', 'ONG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2417, 156, 'Osun', 'OS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2418, 156, 'Oyo', 'OY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2419, 156, 'Plateau', 'PL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2420, 156, 'Rivers', 'RI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2421, 156, 'Sokoto', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2422, 156, 'Taraba', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `state` (`state_id`, `ref_country_id`, `state_name`, `code`, `status`, `delete_status`, `user_id`, `transaction_id`, `added_date`) VALUES
(2423, 156, 'Yobe', 'YO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2424, 156, 'Zamfara', 'ZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2425, 159, 'Northern Islands', 'N', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2426, 159, 'Rota', 'R', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2427, 159, 'Saipan', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2428, 159, 'Tinian', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2429, 160, 'Akershus', 'AK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2430, 160, 'Aust-Agder', 'AA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2431, 160, 'Buskerud', 'BU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2432, 160, 'Finnmark', 'FM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2433, 160, 'Hedmark', 'HM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2434, 160, 'Hordaland', 'HL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2435, 160, 'More og Romdal', 'MR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2436, 160, 'Nord-Trondelag', 'NT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2437, 160, 'Nordland', 'NL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2438, 160, 'Ostfold', 'OF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2439, 160, 'Oppland', 'OP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2440, 160, 'Oslo', 'OL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2441, 160, 'Rogaland', 'RL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2442, 160, 'Sor-Trondelag', 'ST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2443, 160, 'Sogn og Fjordane', 'SJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2444, 160, 'Svalbard', 'SV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2445, 160, 'Telemark', 'TM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2446, 160, 'Troms', 'TR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2447, 160, 'Vest-Agder', 'VA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2448, 160, 'Vestfold', 'VF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2449, 161, 'Ad Dakhiliyah', 'DA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2450, 161, 'Al Batinah', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2451, 161, 'Al Wusta', 'WU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2452, 161, 'Ash Sharqiyah', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2453, 161, 'Az Zahirah', 'ZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2454, 161, 'Masqat', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2455, 161, 'Musandam', 'MU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2456, 161, 'Zufar', 'ZU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2457, 162, 'Balochistan', 'B', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2458, 162, 'Federally Administered Tribal Areas', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2459, 162, 'Islamabad Capital Territory', 'I', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2460, 162, 'North-West Frontier', 'N', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2461, 162, 'Punjab', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2462, 162, 'Sindh', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2463, 163, 'Aimeliik', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2464, 163, 'Airai', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2465, 163, 'Angaur', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2466, 163, 'Hatohobei', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2467, 163, 'Kayangel', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2468, 163, 'Koror', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2469, 163, 'Melekeok', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2470, 163, 'Ngaraard', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2471, 163, 'Ngarchelong', 'NG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2472, 163, 'Ngardmau', 'ND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2473, 163, 'Ngatpang', 'NT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2474, 163, 'Ngchesar', 'NC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2475, 163, 'Ngeremlengui', 'NR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2476, 163, 'Ngiwal', 'NW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2477, 163, 'Peleliu', 'PE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2478, 163, 'Sonsorol', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2479, 164, 'Bocas del Toro', 'BT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2480, 164, 'Chiriqui', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2481, 164, 'Cocle', 'CC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2482, 164, 'Colon', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2483, 164, 'Darien', 'DA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2484, 164, 'Herrera', 'HE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2485, 164, 'Los Santos', 'LS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2486, 164, 'Panama', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2487, 164, 'San Blas', 'SB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2488, 164, 'Veraguas', 'VG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2489, 165, 'Bougainville', 'BV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2490, 165, 'Central', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2491, 165, 'Chimbu', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2492, 165, 'Eastern Highlands', 'EH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2493, 165, 'East New Britain', 'EB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2494, 165, 'East Sepik', 'ES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2495, 165, 'Enga', 'EN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2496, 165, 'Gulf', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2497, 165, 'Madang', 'MD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2498, 165, 'Manus', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2499, 165, 'Milne Bay', 'MB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2500, 165, 'Morobe', 'MR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2501, 165, 'National Capital', 'NC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2502, 165, 'New Ireland', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2503, 165, 'Northern', 'NO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2504, 165, 'Sandaun', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2505, 165, 'Southern Highlands', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2506, 165, 'Western', 'WE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2507, 165, 'Western Highlands', 'WH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2508, 165, 'West New Britain', 'WB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2509, 166, 'Alto Paraguay', 'AG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2510, 166, 'Alto Parana', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2511, 166, 'Amambay', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2512, 166, 'Asuncion', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2513, 166, 'Boqueron', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2514, 166, 'Caaguazu', 'CG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2515, 166, 'Caazapa', 'CZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2516, 166, 'Canindeyu', 'CN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2517, 166, 'Central', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2518, 166, 'Concepcion', 'CC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2519, 166, 'Cordillera', 'CD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2520, 166, 'Guaira', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2521, 166, 'Itapua', 'IT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2522, 166, 'Misiones', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2523, 166, 'Neembucu', 'NE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2524, 166, 'Paraguari', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2525, 166, 'Presidente Hayes', 'PH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2526, 166, 'San Pedro', 'SP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2527, 167, 'Amazonas', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2528, 167, 'Ancash', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2529, 167, 'Apurimac', 'AP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2530, 167, 'Arequipa', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2531, 167, 'Ayacucho', 'AY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2532, 167, 'Cajamarca', 'CJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2533, 167, 'Callao', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2534, 167, 'Cusco', 'CU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2535, 167, 'Huancavelica', 'HV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2536, 167, 'Huanuco', 'HO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2537, 167, 'Ica', 'IC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2538, 167, 'Junin', 'JU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2539, 167, 'La Libertad', 'LD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2540, 167, 'Lambayeque', 'LY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2541, 167, 'Lima', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2542, 167, 'Loreto', 'LO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2543, 167, 'Madre de Dios', 'MD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2544, 167, 'Moquegua', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2545, 167, 'Pasco', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2546, 167, 'Piura', 'PI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2547, 167, 'Puno', 'PU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2548, 167, 'San Martin', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2549, 167, 'Tacna', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2550, 167, 'Tumbes', 'TU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2551, 167, 'Ucayali', 'UC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2552, 168, 'Abra', 'ABR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2553, 168, 'Agusan del Norte', 'ANO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2554, 168, 'Agusan del Sur', 'ASU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2555, 168, 'Aklan', 'AKL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2556, 168, 'Albay', 'ALB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2557, 168, 'Antique', 'ANT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2558, 168, 'Apayao', 'APY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2559, 168, 'Aurora', 'AUR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2560, 168, 'Basilan', 'BAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2561, 168, 'Bataan', 'BTA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2562, 168, 'Batanes', 'BTE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2563, 168, 'Batangas', 'BTG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2564, 168, 'Biliran', 'BLR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2565, 168, 'Benguet', 'BEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2566, 168, 'Bohol', 'BOL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2567, 168, 'Bukidnon', 'BUK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2568, 168, 'Bulacan', 'BUL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2569, 168, 'Cagayan', 'CAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2570, 168, 'Camarines Norte', 'CNO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2571, 168, 'Camarines Sur', 'CSU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2572, 168, 'Camiguin', 'CAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2573, 168, 'Capiz', 'CAP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2574, 168, 'Catanduanes', 'CAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2575, 168, 'Cavite', 'CAV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2576, 168, 'Cebu', 'CEB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2577, 168, 'Compostela', 'CMP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2578, 168, 'Davao del Norte', 'DNO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2579, 168, 'Davao del Sur', 'DSU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2580, 168, 'Davao Oriental', 'DOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2581, 168, 'Eastern Samar', 'ESA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2582, 168, 'Guimaras', 'GUI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2583, 168, 'Ifugao', 'IFU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2584, 168, 'Ilocos Norte', 'INO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2585, 168, 'Ilocos Sur', 'ISU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2586, 168, 'Iloilo', 'ILO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2587, 168, 'Isabela', 'ISA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2588, 168, 'Kalinga', 'KAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2589, 168, 'Laguna', 'LAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2590, 168, 'Lanao del Norte', 'LNO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2591, 168, 'Lanao del Sur', 'LSU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2592, 168, 'La Union', 'UNI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2593, 168, 'Leyte', 'LEY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2594, 168, 'Maguindanao', 'MAG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2595, 168, 'Marinduque', 'MRN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2596, 168, 'Masbate', 'MSB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2597, 168, 'Mindoro Occidental', 'MIC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2598, 168, 'Mindoro Oriental', 'MIR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2599, 168, 'Misamis Occidental', 'MSC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2600, 168, 'Misamis Oriental', 'MOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2601, 168, 'Mountain', 'MOP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2602, 168, 'Negros Occidental', 'NOC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2603, 168, 'Negros Oriental', 'NOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2604, 168, 'North Cotabato', 'NCT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2605, 168, 'Northern Samar', 'NSM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2606, 168, 'Nueva Ecija', 'NEC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2607, 168, 'Nueva Vizcaya', 'NVZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2608, 168, 'Palawan', 'PLW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2609, 168, 'Pampanga', 'PMP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2610, 168, 'Pangasinan', 'PNG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2611, 168, 'Quezon', 'QZN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2612, 168, 'Quirino', 'QRN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2613, 168, 'Rizal', 'RIZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2614, 168, 'Romblon', 'ROM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2615, 168, 'Samar', 'SMR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2616, 168, 'Sarangani', 'SRG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2617, 168, 'Siquijor', 'SQJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2618, 168, 'Sorsogon', 'SRS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2619, 168, 'South Cotabato', 'SCO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2620, 168, 'Southern Leyte', 'SLE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2621, 168, 'Sultan Kudarat', 'SKU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2622, 168, 'Sulu', 'SLU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2623, 168, 'Surigao del Norte', 'SNO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2624, 168, 'Surigao del Sur', 'SSU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2625, 168, 'Tarlac', 'TAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2626, 168, 'Tawi-Tawi', 'TAW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2627, 168, 'Zambales', 'ZBL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2628, 168, 'Zamboanga del Norte', 'ZNO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2629, 168, 'Zamboanga del Sur', 'ZSU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2630, 168, 'Zamboanga Sibugay', 'ZSI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2631, 170, 'Dolnoslaskie', 'DO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2632, 170, 'Kujawsko-Pomorskie', 'KP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2633, 170, 'Lodzkie', 'LO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2634, 170, 'Lubelskie', 'LL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2635, 170, 'Lubuskie', 'LU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2636, 170, 'Malopolskie', 'ML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2637, 170, 'Mazowieckie', 'MZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2638, 170, 'Opolskie', 'OP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2639, 170, 'Podkarpackie', 'PP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2640, 170, 'Podlaskie', 'PL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2641, 170, 'Pomorskie', 'PM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2642, 170, 'Slaskie', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2643, 170, 'Swietokrzyskie', 'SW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2644, 170, 'Warminsko-Mazurskie', 'WM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2645, 170, 'Wielkopolskie', 'WP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2646, 170, 'Zachodniopomorskie', 'ZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2647, 198, 'Saint Pierre', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2648, 198, 'Miquelon', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2649, 171, 'A&ccedil;ores', 'AC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2650, 171, 'Aveiro', 'AV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2651, 171, 'Beja', 'BE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2652, 171, 'Braga', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2653, 171, 'Bragan&ccedil;a', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2654, 171, 'Castelo Branco', 'CB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2655, 171, 'Coimbra', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2656, 171, '&Eacute;vora', 'EV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2657, 171, 'Faro', 'FA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2658, 171, 'Guarda', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2659, 171, 'Leiria', 'LE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2660, 171, 'Lisboa', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2661, 171, 'Madeira', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2662, 171, 'Portalegre', 'PO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2663, 171, 'Porto', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2664, 171, 'Santar&eacute;m', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2665, 171, 'Set&uacute;bal', 'SE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2666, 171, 'Viana do Castelo', 'VC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2667, 171, 'Vila Real', 'VR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2668, 171, 'Viseu', 'VI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2669, 173, 'Ad Dawhah', 'DW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2670, 173, 'Al Ghuwayriyah', 'GW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2671, 173, 'Al Jumayliyah', 'JM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2672, 173, 'Al Khawr', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2673, 173, 'Al Wakrah', 'WK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2674, 173, 'Ar Rayyan', 'RN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2675, 173, 'Jarayan al Batinah', 'JB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2676, 173, 'Madinat ash Shamal', 'MS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2677, 173, 'Umm Sa\'id', 'UD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2678, 173, 'Umm Salal', 'UL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2679, 175, 'Alba', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2680, 175, 'Arad', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2681, 175, 'Arges', 'AG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2682, 175, 'Bacau', 'BC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2683, 175, 'Bihor', 'BH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2684, 175, 'Bistrita-Nasaud', 'BN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2685, 175, 'Botosani', 'BT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2686, 175, 'Brasov', 'BV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2687, 175, 'Braila', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2688, 175, 'Bucuresti', 'B', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2689, 175, 'Buzau', 'BZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2690, 175, 'Caras-Severin', 'CS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2691, 175, 'Calarasi', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2692, 175, 'Cluj', 'CJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2693, 175, 'Constanta', 'CT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2694, 175, 'Covasna', 'CV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2695, 175, 'Dimbovita', 'DB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2696, 175, 'Dolj', 'DJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2697, 175, 'Galati', 'GL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2698, 175, 'Giurgiu', 'GR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2699, 175, 'Gorj', 'GJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2700, 175, 'Harghita', 'HR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2701, 175, 'Hunedoara', 'HD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2702, 175, 'Ialomita', 'IL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2703, 175, 'Iasi', 'IS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2704, 175, 'Ilfov', 'IF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2705, 175, 'Maramures', 'MM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2706, 175, 'Mehedinti', 'MH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2707, 175, 'Mures', 'MS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2708, 175, 'Neamt', 'NT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2709, 175, 'Olt', 'OT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2710, 175, 'Prahova', 'PH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2711, 175, 'Satu-Mare', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2712, 175, 'Salaj', 'SJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2713, 175, 'Sibiu', 'SB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2714, 175, 'Suceava', 'SV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2715, 175, 'Teleorman', 'TR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2716, 175, 'Timis', 'TM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2717, 175, 'Tulcea', 'TL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2718, 175, 'Vaslui', 'VS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2719, 175, 'Valcea', 'VL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2720, 175, 'Vrancea', 'VN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2721, 176, 'Abakan', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2722, 176, 'Aginskoye', 'AG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2723, 176, 'Anadyr', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2724, 176, 'Arkahangelsk', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2725, 176, 'Astrakhan', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2726, 176, 'Barnaul', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2727, 176, 'Belgorod', 'BE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2728, 176, 'Birobidzhan', 'BI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2729, 176, 'Blagoveshchensk', 'BL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2730, 176, 'Bryansk', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2731, 176, 'Cheboksary', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2732, 176, 'Chelyabinsk', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2733, 176, 'Cherkessk', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2734, 176, 'Chita', 'CI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2735, 176, 'Dudinka', 'DU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2736, 176, 'Elista', 'EL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2737, 176, 'Gomo-Altaysk', 'GO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2738, 176, 'Gorno-Altaysk', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2739, 176, 'Groznyy', 'GR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2740, 176, 'Irkutsk', 'IR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2741, 176, 'Ivanovo', 'IV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2742, 176, 'Izhevsk', 'IZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2743, 176, 'Kalinigrad', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2744, 176, 'Kaluga', 'KL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2745, 176, 'Kasnodar', 'KS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2746, 176, 'Kazan', 'KZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2747, 176, 'Kemerovo', 'KE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2748, 176, 'Khabarovsk', 'KH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2749, 176, 'Khanty-Mansiysk', 'KM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2750, 176, 'Kostroma', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2751, 176, 'Krasnodar', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2752, 176, 'Krasnoyarsk', 'KN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2753, 176, 'Kudymkar', 'KU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2754, 176, 'Kurgan', 'KG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2755, 176, 'Kursk', 'KK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2756, 176, 'Kyzyl', 'KY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2757, 176, 'Lipetsk', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2758, 176, 'Magadan', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2759, 176, 'Makhachkala', 'MK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2760, 176, 'Maykop', 'MY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2761, 176, 'Moscow', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2762, 176, 'Murmansk', 'MU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2763, 176, 'Nalchik', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2764, 176, 'Naryan Mar', 'NR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2765, 176, 'Nazran', 'NZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2766, 176, 'Nizhniy Novgorod', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2767, 176, 'Novgorod', 'NO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2768, 176, 'Novosibirsk', 'NV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2769, 176, 'Omsk', 'OM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2770, 176, 'Orel', 'OR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2771, 176, 'Orenburg', 'OE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2772, 176, 'Palana', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2773, 176, 'Penza', 'PE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2774, 176, 'Perm', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2775, 176, 'Petropavlovsk-Kamchatskiy', 'PK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2776, 176, 'Petrozavodsk', 'PT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2777, 176, 'Pskov', 'PS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2778, 176, 'Rostov-na-Donu', 'RO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2779, 176, 'Ryazan', 'RY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2780, 176, 'Salekhard', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2781, 176, 'Samara', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2782, 176, 'Saransk', 'SR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2783, 176, 'Saratov', 'SV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2784, 176, 'Smolensk', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2785, 176, 'St. Petersburg', 'SP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2786, 176, 'Stavropol', 'ST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2787, 176, 'Syktyvkar', 'SY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2788, 176, 'Tambov', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2789, 176, 'Tomsk', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2790, 176, 'Tula', 'TU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2791, 176, 'Tura', 'TR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2792, 176, 'Tver', 'TV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2793, 176, 'Tyumen', 'TY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2794, 176, 'Ufa', 'UF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2795, 176, 'Ul\'yanovsk', 'UL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2796, 176, 'Ulan-Ude', 'UU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2797, 176, 'Ust\'-Ordynskiy', 'US', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2798, 176, 'Vladikavkaz', 'VL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2799, 176, 'Vladimir', 'VA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2800, 176, 'Vladivostok', 'VV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2801, 176, 'Volgograd', 'VG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2802, 176, 'Vologda', 'VD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2803, 176, 'Voronezh', 'VO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2804, 176, 'Vyatka', 'VY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2805, 176, 'Yakutsk', 'YA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2806, 176, 'Yaroslavl', 'YR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2807, 176, 'Yekaterinburg', 'YE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2808, 176, 'Yoshkar-Ola', 'YO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2809, 177, 'Butare', 'BU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2810, 177, 'Byumba', 'BY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2811, 177, 'Cyangugu', 'CY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2812, 177, 'Gikongoro', 'GK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2813, 177, 'Gisenyi', 'GS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2814, 177, 'Gitarama', 'GT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2815, 177, 'Kibungo', 'KG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2816, 177, 'Kibuye', 'KY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2817, 177, 'Kigali Rurale', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2818, 177, 'Kigali-ville', 'KV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2819, 177, 'Ruhengeri', 'RU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2820, 177, 'Umutara', 'UM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2821, 178, 'Christ Church Nichola Town', 'CCN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2822, 178, 'Saint Anne Sandy Point', 'SAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2823, 178, 'Saint George Basseterre', 'SGB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2824, 178, 'Saint George Gingerland', 'SGG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2825, 178, 'Saint James Windward', 'SJW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2826, 178, 'Saint John Capesterre', 'SJC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2827, 178, 'Saint John Figtree', 'SJF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2828, 178, 'Saint Mary Cayon', 'SMC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2829, 178, 'Saint Paul Capesterre', 'CAP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2830, 178, 'Saint Paul Charlestown', 'CHA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2831, 178, 'Saint Peter Basseterre', 'SPB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2832, 178, 'Saint Thomas Lowland', 'STL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2833, 178, 'Saint Thomas Middle Island', 'STM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2834, 178, 'Trinity Palmetto Point', 'TPP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2835, 179, 'Anse-la-Raye', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2836, 179, 'Castries', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2837, 179, 'Choiseul', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2838, 179, 'Dauphin', 'DA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2839, 179, 'Dennery', 'DE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2840, 179, 'Gros-Islet', 'GI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2841, 179, 'Laborie', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2842, 179, 'Micoud', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2843, 179, 'Praslin', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2844, 179, 'Soufriere', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2845, 179, 'Vieux-Fort', 'VF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2846, 180, 'Charlotte', 'C', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2847, 180, 'Grenadines', 'R', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2848, 180, 'Saint Andrew', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2849, 180, 'Saint David', 'D', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2850, 180, 'Saint George', 'G', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2851, 180, 'Saint Patrick', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2852, 181, 'A\'ana', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2853, 181, 'Aiga-i-le-Tai', 'AI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2854, 181, 'Atua', 'AT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2855, 181, 'Fa\'asaleleaga', 'FA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2856, 181, 'Gaga\'emauga', 'GE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2857, 181, 'Gagaifomauga', 'GF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2858, 181, 'Palauli', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2859, 181, 'Satupa\'itea', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2860, 181, 'Tuamasaga', 'TU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2861, 181, 'Va\'a-o-Fonoti', 'VF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2862, 181, 'Vaisigano', 'VS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2863, 182, 'Acquaviva', 'AC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2864, 182, 'Borgo Maggiore', 'BM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2865, 182, 'Chiesanuova', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2866, 182, 'Domagnano', 'DO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2867, 182, 'Faetano', 'FA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2868, 182, 'Fiorentino', 'FI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2869, 182, 'Montegiardino', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2870, 182, 'Citta di San Marino', 'SM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2871, 182, 'Serravalle', 'SE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2872, 183, 'Sao Tome', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2873, 183, 'Principe', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2874, 184, 'Al Bahah', 'BH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2875, 184, 'Al Hudud ash Shamaliyah', 'HS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2876, 184, 'Al Jawf', 'JF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2877, 184, 'Al Madinah', 'MD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2878, 184, 'Al Qasim', 'QS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2879, 184, 'Ar Riyad', 'RD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2880, 184, 'Ash Sharqiyah (Eastern)', 'AQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2881, 184, '\'Asir', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2882, 184, 'Ha\'il', 'HL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2883, 184, 'Jizan', 'JZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2884, 184, 'Makkah', 'ML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2885, 184, 'Najran', 'NR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2886, 184, 'Tabuk', 'TB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2887, 185, 'Dakar', 'DA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2888, 185, 'Diourbel', 'DI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2889, 185, 'Fatick', 'FA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2890, 185, 'Kaolack', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2891, 185, 'Kolda', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2892, 185, 'Louga', 'LO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2893, 185, 'Matam', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2894, 185, 'Saint-Louis', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2895, 185, 'Tambacounda', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2896, 185, 'Thies', 'TH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2897, 185, 'Ziguinchor', 'ZI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2898, 186, 'Anse aux Pins', 'AP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2899, 186, 'Anse Boileau', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2900, 186, 'Anse Etoile', 'AE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2901, 186, 'Anse Louis', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2902, 186, 'Anse Royale', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2903, 186, 'Baie Lazare', 'BL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2904, 186, 'Baie Sainte Anne', 'BS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2905, 186, 'Beau Vallon', 'BV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2906, 186, 'Bel Air', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2907, 186, 'Bel Ombre', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2908, 186, 'Cascade', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2909, 186, 'Glacis', 'GL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2910, 186, 'Grand\' Anse (on Mahe)', 'GM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2911, 186, 'Grand\' Anse (on Praslin)', 'GP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2912, 186, 'La Digue', 'DG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2913, 186, 'La Riviere Anglaise', 'RA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2914, 186, 'Mont Buxton', 'MB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2915, 186, 'Mont Fleuri', 'MF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2916, 186, 'Plaisance', 'PL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2917, 186, 'Pointe La Rue', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2918, 186, 'Port Glaud', 'PG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2919, 186, 'Saint Louis', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2920, 186, 'Takamaka', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2921, 187, 'Eastern', 'E', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2922, 187, 'Northern', 'N', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2923, 187, 'Southern', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2924, 187, 'Western', 'W', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2925, 189, 'BanskobystrickÃƒÂ½', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2926, 189, 'BratislavskÃƒÂ½', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2927, 189, 'KoÃ…Â¡ickÃƒÂ½', 'KO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2928, 189, 'Nitriansky', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2929, 189, 'PreÃ…Â¡ovskÃƒÂ½', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2930, 189, 'TrenÃ„Âiansky', 'TC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2931, 189, 'TrnavskÃƒÂ½', 'TV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2932, 189, 'Ã…Â½ilinskÃƒÂ½', 'ZI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2933, 191, 'Central', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2934, 191, 'Choiseul', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2935, 191, 'Guadalcanal', 'GC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2936, 191, 'Honiara', 'HO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2937, 191, 'Isabel', 'IS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2938, 191, 'Makira', 'MK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2939, 191, 'Malaita', 'ML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2940, 191, 'Rennell and Bellona', 'RB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2941, 191, 'Temotu', 'TM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2942, 191, 'Western', 'WE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2943, 192, 'Awdal', 'AW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2944, 192, 'Bakool', 'BK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2945, 192, 'Banaadir', 'BN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2946, 192, 'Bari', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2947, 192, 'Bay', 'BY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2948, 192, 'Galguduud', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2949, 192, 'Gedo', 'GE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2950, 192, 'Hiiraan', 'HI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2951, 192, 'Jubbada Dhexe', 'JD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2952, 192, 'Jubbada Hoose', 'JH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2953, 192, 'Mudug', 'MU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2954, 192, 'Nugaal', 'NU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2955, 192, 'Sanaag', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2956, 192, 'Shabeellaha Dhexe', 'SD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2957, 192, 'Shabeellaha Hoose', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2958, 192, 'Sool', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2959, 192, 'Togdheer', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2960, 192, 'Woqooyi Galbeed', 'WG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2961, 193, 'Eastern Cape', 'EC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2962, 193, 'Free State', 'FS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2963, 193, 'Gauteng', 'GT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2964, 193, 'KwaZulu-Natal', 'KN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2965, 193, 'Limpopo', 'LP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2966, 193, 'Mpumalanga', 'MP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2967, 193, 'North West', 'NW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2968, 193, 'Northern Cape', 'NC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2969, 193, 'Western Cape', 'WC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2970, 195, 'La Coru&ntilde;a', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2971, 195, '&Aacute;lava', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2972, 195, 'Albacete', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2973, 195, 'Alicante', 'AC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2974, 195, 'Almeria', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2975, 195, 'Asturias', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2976, 195, '&Aacute;vila', 'AV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2977, 195, 'Badajoz', 'BJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2978, 195, 'Baleares', 'IB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2979, 195, 'Barcelona', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2980, 195, 'Burgos', 'BU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2981, 195, 'C&aacute;ceres', 'CC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2982, 195, 'C&aacute;diz', 'CZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2983, 195, 'Cantabria', 'CT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2984, 195, 'Castell&oacute;n', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2985, 195, 'Ceuta', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2986, 195, 'Ciudad Real', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2987, 195, 'C&oacute;rdoba', 'CD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2988, 195, 'Cuenca', 'CU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2989, 195, 'Girona', 'GI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2990, 195, 'Granada', 'GD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2991, 195, 'Guadalajara', 'GJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2992, 195, 'Guip&uacute;zcoa', 'GP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2993, 195, 'Huelva', 'HL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2994, 195, 'Huesca', 'HS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2995, 195, 'Ja&eacute;n', 'JN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2996, 195, 'La Rioja', 'RJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2997, 195, 'Las Palmas', 'PM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2998, 195, 'Leon', 'LE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(2999, 195, 'Lleida', 'LL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3000, 195, 'Lugo', 'LG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3001, 195, 'Madrid', 'MD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3002, 195, 'Malaga', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3003, 195, 'Melilla', 'ML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3004, 195, 'Murcia', 'MU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3005, 195, 'Navarra', 'NV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3006, 195, 'Ourense', 'OU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3007, 195, 'Palencia', 'PL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3008, 195, 'Pontevedra', 'PO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3009, 195, 'Salamanca', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3010, 195, 'Santa Cruz de Tenerife', 'SC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3011, 195, 'Segovia', 'SG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3012, 195, 'Sevilla', 'SV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3013, 195, 'Soria', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3014, 195, 'Tarragona', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3015, 195, 'Teruel', 'TE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3016, 195, 'Toledo', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3017, 195, 'Valencia', 'VC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3018, 195, 'Valladolid', 'VD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3019, 195, 'Vizcaya', 'VZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3020, 195, 'Zamora', 'ZM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3021, 195, 'Zaragoza', 'ZR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3022, 196, 'Central', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3023, 196, 'Eastern', 'EA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3024, 196, 'North Central', 'NC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3025, 196, 'Northern', 'NO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3026, 196, 'North Western', 'NW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3027, 196, 'Sabaragamuwa', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3028, 196, 'Southern', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3029, 196, 'Uva', 'UV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3030, 196, 'Western', 'WE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3032, 197, 'Saint Helena', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3034, 199, 'A\'ali an Nil', 'ANL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3035, 199, 'Al Bahr al Ahmar', 'BAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3036, 199, 'Al Buhayrat', 'BRT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3037, 199, 'Al Jazirah', 'JZR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3038, 199, 'Al Khartum', 'KRT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3039, 199, 'Al Qadarif', 'QDR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3040, 199, 'Al Wahdah', 'WDH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3041, 199, 'An Nil al Abyad', 'ANB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3042, 199, 'An Nil al Azraq', 'ANZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3043, 199, 'Ash Shamaliyah', 'ASH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3044, 199, 'Bahr al Jabal', 'BJA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3045, 199, 'Gharb al Istiwa\'iyah', 'GIS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3046, 199, 'Gharb Bahr al Ghazal', 'GBG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3047, 199, 'Gharb Darfur', 'GDA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3048, 199, 'Gharb Kurdufan', 'GKU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3049, 199, 'Janub Darfur', 'JDA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3050, 199, 'Janub Kurdufan', 'JKU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3051, 199, 'Junqali', 'JQL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3052, 199, 'Kassala', 'KSL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3053, 199, 'Nahr an Nil', 'NNL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3054, 199, 'Shamal Bahr al Ghazal', 'SBG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3055, 199, 'Shamal Darfur', 'SDA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3056, 199, 'Shamal Kurdufan', 'SKU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3057, 199, 'Sharq al Istiwa\'iyah', 'SIS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3058, 199, 'Sinnar', 'SNR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3059, 199, 'Warab', 'WRB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3060, 200, 'Brokopondo', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3061, 200, 'Commewijne', 'CM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3062, 200, 'Coronie', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3063, 200, 'Marowijne', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3064, 200, 'Nickerie', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3065, 200, 'Para', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3066, 200, 'Paramaribo', 'PM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3067, 200, 'Saramacca', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3068, 200, 'Sipaliwini', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3069, 200, 'Wanica', 'WA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3070, 202, 'Hhohho', 'H', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3071, 202, 'Lubombo', 'L', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3072, 202, 'Manzini', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3073, 202, 'Shishelweni', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3074, 203, 'Blekinge', 'K', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3075, 203, 'Dalarna', 'W', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3076, 203, 'G&auml;vleborg', 'X', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3077, 203, 'Gotland', 'I', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3078, 203, 'Halland', 'N', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3079, 203, 'J&auml;mtland', 'Z', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3080, 203, 'J&ouml;nk&ouml;ping', 'F', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3081, 203, 'Kalmar', 'H', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3082, 203, 'Kronoberg', 'G', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3083, 203, 'Norrbotten', 'BD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3084, 203, '&Ouml;rebro', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3085, 203, '&Ouml;sterg&ouml;tland', 'E', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3086, 203, 'Sk&aring;ne', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3087, 203, 'S&ouml;dermanland', 'D', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3088, 203, 'Stockholm', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3089, 203, 'Uppsala', 'C', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3090, 203, 'V&auml;rmland', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3091, 203, 'V&auml;sterbotten', 'AC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3092, 203, 'V&auml;sternorrland', 'Y', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3093, 203, 'V&auml;stmanland', 'U', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3094, 203, 'V&auml;stra G&ouml;taland', 'O', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3095, 204, 'Aargau', 'AG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3096, 204, 'Appenzell Ausserrhoden', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3097, 204, 'Appenzell Innerrhoden', 'AI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3098, 204, 'Basel-Stadt', 'BS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3099, 204, 'Basel-Landschaft', 'BL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3100, 204, 'Bern', 'BE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3101, 204, 'Fribourg', 'FR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3102, 204, 'Gen&egrave;ve', 'GE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3103, 204, 'Glarus', 'GL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3104, 204, 'Graub&uuml;nden', 'GR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3105, 204, 'Jura', 'JU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3106, 204, 'Luzern', 'LU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3107, 204, 'Neuch&acirc;tel', 'NE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3108, 204, 'Nidwald', 'NW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3109, 204, 'Obwald', 'OW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3110, 204, 'St. Gallen', 'SG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3111, 204, 'Schaffhausen', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3112, 204, 'Schwyz', 'SZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3113, 204, 'Solothurn', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3114, 204, 'Thurgau', 'TG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3115, 204, 'Ticino', 'TI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3116, 204, 'Uri', 'UR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3117, 204, 'Valais', 'VS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3118, 204, 'Vaud', 'VD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3119, 204, 'Zug', 'ZG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3120, 204, 'Z&uuml;rich', 'ZH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3121, 205, 'Al Hasakah', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3122, 205, 'Al Ladhiqiyah', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3123, 205, 'Al Qunaytirah', 'QU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3124, 205, 'Ar Raqqah', 'RQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3125, 205, 'As Suwayda', 'SU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3126, 205, 'Dara', 'DA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3127, 205, 'Dayr az Zawr', 'DZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3128, 205, 'Dimashq', 'DI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3129, 205, 'Halab', 'HL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3130, 205, 'Hamah', 'HM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3131, 205, 'Hims', 'HI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3132, 205, 'Idlib', 'ID', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3133, 205, 'Rif Dimashq', 'RD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3134, 205, 'Tartus', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3135, 206, 'Chang-hua', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3136, 206, 'Chia-i', 'CI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3137, 206, 'Hsin-chu', 'HS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3138, 206, 'Hua-lien', 'HL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3139, 206, 'I-lan', 'IL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3140, 206, 'Kao-hsiung county', 'KH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3141, 206, 'Kin-men', 'KM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3142, 206, 'Lien-chiang', 'LC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3143, 206, 'Miao-li', 'ML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3144, 206, 'Nan-t\'ou', 'NT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3145, 206, 'P\'eng-hu', 'PH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3146, 206, 'P\'ing-tung', 'PT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3147, 206, 'T\'ai-chung', 'TG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3148, 206, 'T\'ai-nan', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3149, 206, 'T\'ai-pei county', 'TP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3150, 206, 'T\'ai-tung', 'TT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3151, 206, 'T\'ao-yuan', 'TY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3152, 206, 'Yun-lin', 'YL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3153, 206, 'Chia-i city', 'CC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3154, 206, 'Chi-lung', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3155, 206, 'Hsin-chu', 'HC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3156, 206, 'T\'ai-chung', 'TH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3157, 206, 'T\'ai-nan', 'TN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3158, 206, 'Kao-hsiung city', 'KC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3159, 206, 'T\'ai-pei city', 'TC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3160, 207, 'Gorno-Badakhstan', 'GB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3161, 207, 'Khatlon', 'KT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3162, 207, 'Sughd', 'SU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3163, 208, 'Arusha', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3164, 208, 'Dar es Salaam', 'DS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3165, 208, 'Dodoma', 'DO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3166, 208, 'Iringa', 'IR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3167, 208, 'Kagera', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3168, 208, 'Kigoma', 'KI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3169, 208, 'Kilimanjaro', 'KJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3170, 208, 'Lindi', 'LN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3171, 208, 'Manyara', 'MY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3172, 208, 'Mara', 'MR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3173, 208, 'Mbeya', 'MB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3174, 208, 'Morogoro', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3175, 208, 'Mtwara', 'MT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3176, 208, 'Mwanza', 'MW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3177, 208, 'Pemba North', 'PN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3178, 208, 'Pemba South', 'PS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3179, 208, 'Pwani', 'PW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3180, 208, 'Rukwa', 'RK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3181, 208, 'Ruvuma', 'RV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3182, 208, 'Shinyanga', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3183, 208, 'Singida', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3184, 208, 'Tabora', 'TB', 1, 0, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `state` (`state_id`, `ref_country_id`, `state_name`, `code`, `status`, `delete_status`, `user_id`, `transaction_id`, `added_date`) VALUES
(3185, 208, 'Tanga', 'TN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3186, 208, 'Zanzibar Central/South', 'ZC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3187, 208, 'Zanzibar North', 'ZN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3188, 208, 'Zanzibar Urban/West', 'ZU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3189, 209, 'Amnat Charoen', 'Amnat Charoen', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3190, 209, 'Ang Thong', 'Ang Thong', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3191, 209, 'Ayutthaya', 'Ayutthaya', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3192, 209, 'Bangkok', 'Bangkok', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3193, 209, 'Buriram', 'Buriram', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3194, 209, 'Chachoengsao', 'Chachoengsao', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3195, 209, 'Chai Nat', 'Chai Nat', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3196, 209, 'Chaiyaphum', 'Chaiyaphum', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3197, 209, 'Chanthaburi', 'Chanthaburi', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3198, 209, 'Chiang Mai', 'Chiang Mai', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3199, 209, 'Chiang Rai', 'Chiang Rai', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3200, 209, 'Chon Buri', 'Chon Buri', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3201, 209, 'Chumphon', 'Chumphon', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3202, 209, 'Kalasin', 'Kalasin', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3203, 209, 'Kamphaeng Phet', 'Kamphaeng Phet', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3204, 209, 'Kanchanaburi', 'Kanchanaburi', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3205, 209, 'Khon Kaen', 'Khon Kaen', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3206, 209, 'Krabi', 'Krabi', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3207, 209, 'Lampang', 'Lampang', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3208, 209, 'Lamphun', 'Lamphun', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3209, 209, 'Loei', 'Loei', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3210, 209, 'Lop Buri', 'Lop Buri', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3211, 209, 'Mae Hong Son', 'Mae Hong Son', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3212, 209, 'Maha Sarakham', 'Maha Sarakham', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3213, 209, 'Mukdahan', 'Mukdahan', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3214, 209, 'Nakhon Nayok', 'Nakhon Nayok', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3215, 209, 'Nakhon Pathom', 'Nakhon Pathom', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3216, 209, 'Nakhon Phanom', 'Nakhon Phanom', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3217, 209, 'Nakhon Ratchasima', 'Nakhon Ratchasima', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3218, 209, 'Nakhon Sawan', 'Nakhon Sawan', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3219, 209, 'Nakhon Si Thammarat', 'Nakhon Si Thammarat', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3220, 209, 'Nan', 'Nan', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3221, 209, 'Narathiwat', 'Narathiwat', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3222, 209, 'Nong Bua Lamphu', 'Nong Bua Lamphu', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3223, 209, 'Nong Khai', 'Nong Khai', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3224, 209, 'Nonthaburi', 'Nonthaburi', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3225, 209, 'Pathum Thani', 'Pathum Thani', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3226, 209, 'Pattani', 'Pattani', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3227, 209, 'Phangnga', 'Phangnga', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3228, 209, 'Phatthalung', 'Phatthalung', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3229, 209, 'Phayao', 'Phayao', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3230, 209, 'Phetchabun', 'Phetchabun', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3231, 209, 'Phetchaburi', 'Phetchaburi', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3232, 209, 'Phichit', 'Phichit', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3233, 209, 'Phitsanulok', 'Phitsanulok', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3234, 209, 'Phrae', 'Phrae', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3235, 209, 'Phuket', 'Phuket', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3236, 209, 'Prachin Buri', 'Prachin Buri', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3237, 209, 'Prachuap Khiri Khan', 'Prachuap Khiri Khan', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3238, 209, 'Ranong', 'Ranong', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3239, 209, 'Ratchaburi', 'Ratchaburi', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3240, 209, 'Rayong', 'Rayong', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3241, 209, 'Roi Et', 'Roi Et', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3242, 209, 'Sa Kaeo', 'Sa Kaeo', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3243, 209, 'Sakon Nakhon', 'Sakon Nakhon', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3244, 209, 'Samut Prakan', 'Samut Prakan', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3245, 209, 'Samut Sakhon', 'Samut Sakhon', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3246, 209, 'Samut Songkhram', 'Samut Songkhram', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3247, 209, 'Sara Buri', 'Sara Buri', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3248, 209, 'Satun', 'Satun', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3249, 209, 'Sing Buri', 'Sing Buri', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3250, 209, 'Sisaket', 'Sisaket', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3251, 209, 'Songkhla', 'Songkhla', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3252, 209, 'Sukhothai', 'Sukhothai', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3253, 209, 'Suphan Buri', 'Suphan Buri', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3254, 209, 'Surat Thani', 'Surat Thani', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3255, 209, 'Surin', 'Surin', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3256, 209, 'Tak', 'Tak', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3257, 209, 'Trang', 'Trang', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3258, 209, 'Trat', 'Trat', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3259, 209, 'Ubon Ratchathani', 'Ubon Ratchathani', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3260, 209, 'Udon Thani', 'Udon Thani', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3261, 209, 'Uthai Thani', 'Uthai Thani', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3262, 209, 'Uttaradit', 'Uttaradit', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3263, 209, 'Yala', 'Yala', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3264, 209, 'Yasothon', 'Yasothon', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3265, 210, 'Kara', 'K', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3266, 210, 'Plateaux', 'P', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3267, 210, 'Savanes', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3268, 210, 'Centrale', 'C', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3269, 210, 'Maritime', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3270, 211, 'Atafu', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3271, 211, 'Fakaofo', 'F', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3272, 211, 'Nukunonu', 'N', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3273, 212, 'Ha\'apai', 'H', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3274, 212, 'Tongatapu', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3275, 212, 'Vava\'u', 'V', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3276, 213, 'Couva/Tabaquite/Talparo', 'CT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3277, 213, 'Diego Martin', 'DM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3278, 213, 'Mayaro/Rio Claro', 'MR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3279, 213, 'Penal/Debe', 'PD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3280, 213, 'Princes Town', 'PT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3281, 213, 'Sangre Grande', 'SG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3282, 213, 'San Juan/Laventille', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3283, 213, 'Siparia', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3284, 213, 'Tunapuna/Piarco', 'TP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3285, 213, 'Port of Spain', 'PS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3286, 213, 'San Fernando', 'SF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3287, 213, 'Arima', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3288, 213, 'Point Fortin', 'PF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3289, 213, 'Chaguanas', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3290, 213, 'Tobago', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3291, 214, 'Ariana', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3292, 214, 'Beja', 'BJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3293, 214, 'Ben Arous', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3294, 214, 'Bizerte', 'BI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3295, 214, 'Gabes', 'GB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3296, 214, 'Gafsa', 'GF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3297, 214, 'Jendouba', 'JE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3298, 214, 'Kairouan', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3299, 214, 'Kasserine', 'KS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3300, 214, 'Kebili', 'KB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3301, 214, 'Kef', 'KF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3302, 214, 'Mahdia', 'MH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3303, 214, 'Manouba', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3304, 214, 'Medenine', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3305, 214, 'Monastir', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3306, 214, 'Nabeul', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3307, 214, 'Sfax', 'SF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3308, 214, 'Sidi', 'SD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3309, 214, 'Siliana', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3310, 214, 'Sousse', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3311, 214, 'Tataouine', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3312, 214, 'Tozeur', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3313, 214, 'Tunis', 'TU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3314, 214, 'Zaghouan', 'ZA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3315, 215, 'Adana', 'ADA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3316, 215, 'AdÃ„Â±yaman', 'ADI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3317, 215, 'Afyonkarahisar', 'AFY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3318, 215, 'AÃ„Å¸rÃ„Â±', 'AGR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3319, 215, 'Aksaray', 'AKS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3320, 215, 'Amasya', 'AMA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3321, 215, 'Ankara', 'ANK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3322, 215, 'Antalya', 'ANT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3323, 215, 'Ardahan', 'ARD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3324, 215, 'Artvin', 'ART', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3325, 215, 'AydÃ„Â±n', 'AYI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3326, 215, 'BalÃ„Â±kesir', 'BAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3327, 215, 'BartÃ„Â±n', 'BAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3328, 215, 'Batman', 'BAT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3329, 215, 'Bayburt', 'BAY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3330, 215, 'Bilecik', 'BIL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3331, 215, 'BingÃƒÂ¶l', 'BIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3332, 215, 'Bitlis', 'BIT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3333, 215, 'Bolu', 'BOL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3334, 215, 'Burdur', 'BRD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3335, 215, 'Bursa', 'BRS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3336, 215, 'Ãƒâ€¡anakkale', 'CKL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3337, 215, 'Ãƒâ€¡ankÃ„Â±rÃ„Â±', 'CKR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3338, 215, 'Ãƒâ€¡orum', 'COR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3339, 215, 'Denizli', 'DEN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3340, 215, 'DiyarbakÃ„Â±r', 'DIY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3341, 215, 'DÃƒÂ¼zce', 'DUZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3342, 215, 'Edirne', 'EDI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3343, 215, 'ElazÃ„Â±Ã„Å¸', 'ELA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3344, 215, 'Erzincan', 'EZC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3345, 215, 'Erzurum', 'EZR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3346, 215, 'EskiÃ…Å¸ehir', 'ESK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3347, 215, 'Gaziantep', 'GAZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3348, 215, 'Giresun', 'GIR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3349, 215, 'GÃƒÂ¼mÃƒÂ¼Ã…Å¸hane', 'GMS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3350, 215, 'Hakkari', 'HKR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3351, 215, 'Hatay', 'HTY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3352, 215, 'IÃ„Å¸dÃ„Â±r', 'IGD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3353, 215, 'Isparta', 'ISP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3354, 215, 'Ã„Â°stanbul', 'IST', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3355, 215, 'Ã„Â°zmir', 'IZM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3356, 215, 'KahramanmaraÃ…Å¸', 'KAH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3357, 215, 'KarabÃƒÂ¼k', 'KRB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3358, 215, 'Karaman', 'KRM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3359, 215, 'Kars', 'KRS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3360, 215, 'Kastamonu', 'KAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3361, 215, 'Kayseri', 'KAY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3362, 215, 'Kilis', 'KLS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3363, 215, 'KÃ„Â±rÃ„Â±kkale', 'KRK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3364, 215, 'KÃ„Â±rklareli', 'KLR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3365, 215, 'KÃ„Â±rÃ…Å¸ehir', 'KRH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3366, 215, 'Kocaeli', 'KOC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3367, 215, 'Konya', 'KON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3368, 215, 'KÃƒÂ¼tahya', 'KUT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3369, 215, 'Malatya', 'MAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3370, 215, 'Manisa', 'MAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3371, 215, 'Mardin', 'MAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3372, 215, 'Mersin', 'MER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3373, 215, 'MuÃ„Å¸la', 'MUG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3374, 215, 'MuÃ…Å¸', 'MUS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3375, 215, 'NevÃ…Å¸ehir', 'NEV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3376, 215, 'NiÃ„Å¸de', 'NIG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3377, 215, 'Ordu', 'ORD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3378, 215, 'Osmaniye', 'OSM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3379, 215, 'Rize', 'RIZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3380, 215, 'Sakarya', 'SAK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3381, 215, 'Samsun', 'SAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3382, 215, 'Ã…Å¾anlÃ„Â±urfa', 'SAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3383, 215, 'Siirt', 'SII', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3384, 215, 'Sinop', 'SIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3385, 215, 'Ã…Å¾Ã„Â±rnak', 'SIR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3386, 215, 'Sivas', 'SIV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3387, 215, 'TekirdaÃ„Å¸', 'TEL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3388, 215, 'Tokat', 'TOK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3389, 215, 'Trabzon', 'TRA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3390, 215, 'Tunceli', 'TUN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3391, 215, 'UÃ…Å¸ak', 'USK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3392, 215, 'Van', 'VAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3393, 215, 'Yalova', 'YAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3394, 215, 'Yozgat', 'YOZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3395, 215, 'Zonguldak', 'ZON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3396, 216, 'Ahal Welayaty', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3397, 216, 'Balkan Welayaty', 'B', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3398, 216, 'Dashhowuz Welayaty', 'D', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3399, 216, 'Lebap Welayaty', 'L', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3400, 216, 'Mary Welayaty', 'M', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3401, 217, 'Ambergris Cays', 'AC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3402, 217, 'Dellis Cay', 'DC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3403, 217, 'French Cay', 'FC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3404, 217, 'Little Water Cay', 'LW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3405, 217, 'Parrot Cay', 'RC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3406, 217, 'Pine Cay', 'PN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3407, 217, 'Salt Cay', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3408, 217, 'Grand Turk', 'GT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3409, 217, 'South Caicos', 'SC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3410, 217, 'East Caicos', 'EC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3411, 217, 'Middle Caicos', 'MC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3412, 217, 'North Caicos', 'NC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3413, 217, 'Providenciales', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3414, 217, 'West Caicos', 'WC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3415, 218, 'Nanumanga', 'NMG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3416, 218, 'Niulakita', 'NLK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3417, 218, 'Niutao', 'NTO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3418, 218, 'Funafuti', 'FUN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3419, 218, 'Nanumea', 'NME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3420, 218, 'Nui', 'NUI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3421, 218, 'Nukufetau', 'NFT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3422, 218, 'Nukulaelae', 'NLL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3423, 218, 'Vaitupu', 'VAI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3424, 219, 'Kalangala', 'KAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3425, 219, 'Kampala', 'KMP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3426, 219, 'Kayunga', 'KAY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3427, 219, 'Kiboga', 'KIB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3428, 219, 'Luwero', 'LUW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3429, 219, 'Masaka', 'MAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3430, 219, 'Mpigi', 'MPI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3431, 219, 'Mubende', 'MUB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3432, 219, 'Mukono', 'MUK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3433, 219, 'Nakasongola', 'NKS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3434, 219, 'Rakai', 'RAK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3435, 219, 'Sembabule', 'SEM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3436, 219, 'Wakiso', 'WAK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3437, 219, 'Bugiri', 'BUG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3438, 219, 'Busia', 'BUS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3439, 219, 'Iganga', 'IGA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3440, 219, 'Jinja', 'JIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3441, 219, 'Kaberamaido', 'KAB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3442, 219, 'Kamuli', 'KML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3443, 219, 'Kapchorwa', 'KPC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3444, 219, 'Katakwi', 'KTK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3445, 219, 'Kumi', 'KUM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3446, 219, 'Mayuge', 'MAY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3447, 219, 'Mbale', 'MBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3448, 219, 'Pallisa', 'PAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3449, 219, 'Sironko', 'SIR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3450, 219, 'Soroti', 'SOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3451, 219, 'Tororo', 'TOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3452, 219, 'Adjumani', 'ADJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3453, 219, 'Apac', 'APC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3454, 219, 'Arua', 'ARU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3455, 219, 'Gulu', 'GUL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3456, 219, 'Kitgum', 'KIT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3457, 219, 'Kotido', 'KOT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3458, 219, 'Lira', 'LIR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3459, 219, 'Moroto', 'MRT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3460, 219, 'Moyo', 'MOY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3461, 219, 'Nakapiripirit', 'NAK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3462, 219, 'Nebbi', 'NEB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3463, 219, 'Pader', 'PAD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3464, 219, 'Yumbe', 'YUM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3465, 219, 'Bundibugyo', 'BUN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3466, 219, 'Bushenyi', 'BSH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3467, 219, 'Hoima', 'HOI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3468, 219, 'Kabale', 'KBL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3469, 219, 'Kabarole', 'KAR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3470, 219, 'Kamwenge', 'KAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3471, 219, 'Kanungu', 'KAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3472, 219, 'Kasese', 'KAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3473, 219, 'Kibaale', 'KBA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3474, 219, 'Kisoro', 'KIS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3475, 219, 'Kyenjojo', 'KYE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3476, 219, 'Masindi', 'MSN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3477, 219, 'Mbarara', 'MBR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3478, 219, 'Ntungamo', 'NTU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3479, 219, 'Rukungiri', 'RUK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3480, 220, 'Cherkas\'ka Oblast\'', '71', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3481, 220, 'Chernihivs\'ka Oblast\'', '74', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3482, 220, 'Chernivets\'ka Oblast\'', '77', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3483, 220, 'Crimea', '43', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3484, 220, 'Dnipropetrovs\'ka Oblast\'', '12', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3485, 220, 'Donets\'ka Oblast\'', '14', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3486, 220, 'Ivano-Frankivs\'ka Oblast\'', '26', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3487, 220, 'Khersons\'ka Oblast\'', '65', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3488, 220, 'Khmel\'nyts\'ka Oblast\'', '68', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3489, 220, 'Kirovohrads\'ka Oblast\'', '35', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3490, 220, 'Kyiv', '30', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3491, 220, 'Kyivs\'ka Oblast\'', '32', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3492, 220, 'Luhans\'ka Oblast\'', '09', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3493, 220, 'L\'vivs\'ka Oblast\'', '46', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3494, 220, 'Mykolayivs\'ka Oblast\'', '48', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3495, 220, 'Odes\'ka Oblast\'', '51', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3496, 220, 'Poltavs\'ka Oblast\'', '53', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3497, 220, 'Rivnens\'ka Oblast\'', '56', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3498, 220, 'Sevastopol\'', '40', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3499, 220, 'Sums\'ka Oblast\'', '59', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3500, 220, 'Ternopil\'s\'ka Oblast\'', '61', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3501, 220, 'Vinnyts\'ka Oblast\'', '05', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3502, 220, 'Volyns\'ka Oblast\'', '07', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3503, 220, 'Zakarpats\'ka Oblast\'', '21', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3504, 220, 'Zaporiz\'ka Oblast\'', '23', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3505, 220, 'Zhytomyrs\'ka oblast\'', '18', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3506, 221, 'Abu Zaby', 'AZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3507, 221, '\'Ajman', 'AJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3508, 221, 'Al Fujayrah', 'FU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3509, 221, 'Ash Shariqah', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3510, 221, 'Dubayy', 'DU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3511, 221, 'R\'as al Khaymah', 'RK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3512, 221, 'Umm al Qaywayn', 'UQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3513, 222, 'Aberdeen', 'ABN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3514, 222, 'Aberdeenshire', 'ABNS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3515, 222, 'Anglesey', 'ANG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3516, 222, 'Angus', 'AGS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3517, 222, 'Argyll and Bute', 'ARY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3518, 222, 'Bedfordshire', 'BEDS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3519, 222, 'Berkshire', 'BERKS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3520, 222, 'Blaenau Gwent', 'BLA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3521, 222, 'Bridgend', 'BRI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3522, 222, 'Bristol', 'BSTL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3523, 222, 'Buckinghamshire', 'BUCKS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3524, 222, 'Caerphilly', 'CAE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3525, 222, 'Cambridgeshire', 'CAMBS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3526, 222, 'Cardiff', 'CDF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3527, 222, 'Carmarthenshire', 'CARM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3528, 222, 'Ceredigion', 'CDGN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3529, 222, 'Cheshire', 'CHES', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3530, 222, 'Clackmannanshire', 'CLACK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3531, 222, 'Conwy', 'CON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3532, 222, 'Cornwall', 'CORN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3533, 222, 'Denbighshire', 'DNBG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3534, 222, 'Derbyshire', 'DERBY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3535, 222, 'Devon', 'DVN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3536, 222, 'Dorset', 'DOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3537, 222, 'Dumfries and Galloway', 'DGL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3538, 222, 'Dundee', 'DUND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3539, 222, 'Durham', 'DHM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3540, 222, 'East Ayrshire', 'ARYE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3541, 222, 'East Dunbartonshire', 'DUNBE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3542, 222, 'East Lothian', 'LOTE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3543, 222, 'East Renfrewshire', 'RENE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3544, 222, 'East Riding of Yorkshire', 'ERYS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3545, 222, 'East Sussex', 'SXE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3546, 222, 'Edinburgh', 'EDIN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3547, 222, 'Essex', 'ESX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3548, 222, 'Falkirk', 'FALK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3549, 222, 'Fife', 'FFE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3550, 222, 'Flintshire', 'FLINT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3551, 222, 'Glasgow', 'GLAS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3552, 222, 'Gloucestershire', 'GLOS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3553, 222, 'Greater London', 'LDN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3554, 222, 'Greater Manchester', 'MCH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3555, 222, 'Gwynedd', 'GDD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3556, 222, 'Hampshire', 'HANTS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3557, 222, 'Herefordshire', 'HWR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3558, 222, 'Hertfordshire', 'HERTS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3559, 222, 'Highlands', 'HLD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3560, 222, 'Inverclyde', 'IVER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3561, 222, 'Isle of Wight', 'IOW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3562, 222, 'Kent', 'KNT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3563, 222, 'Lancashire', 'LANCS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3564, 222, 'Leicestershire', 'LEICS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3565, 222, 'Lincolnshire', 'LINCS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3566, 222, 'Merseyside', 'MSY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3567, 222, 'Merthyr Tydfil', 'MERT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3568, 222, 'Midlothian', 'MLOT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3569, 222, 'Monmouthshire', 'MMOUTH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3570, 222, 'Moray', 'MORAY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3571, 222, 'Neath Port Talbot', 'NPRTAL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3572, 222, 'Newport', 'NEWPT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3573, 222, 'Norfolk', 'NOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3574, 222, 'North Ayrshire', 'ARYN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3575, 222, 'North Lanarkshire', 'LANN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3576, 222, 'North Yorkshire', 'YSN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3577, 222, 'Northamptonshire', 'NHM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3578, 222, 'Northumberland', 'NLD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3579, 222, 'Nottinghamshire', 'NOT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3580, 222, 'Orkney Islands', 'ORK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3581, 222, 'Oxfordshire', 'OFE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3582, 222, 'Pembrokeshire', 'PEM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3583, 222, 'Perth and Kinross', 'PERTH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3584, 222, 'Powys', 'PWS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3585, 222, 'Renfrewshire', 'REN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3586, 222, 'Rhondda Cynon Taff', 'RHON', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3587, 222, 'Rutland', 'RUT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3588, 222, 'Scottish Borders', 'BOR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3589, 222, 'Shetland Islands', 'SHET', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3590, 222, 'Shropshire', 'SPE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3591, 222, 'Somerset', 'SOM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3592, 222, 'South Ayrshire', 'ARYS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3593, 222, 'South Lanarkshire', 'LANS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3594, 222, 'South Yorkshire', 'YSS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3595, 222, 'Staffordshire', 'SFD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3596, 222, 'Stirling', 'STIR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3597, 222, 'Suffolk', 'SFK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3598, 222, 'Surrey', 'SRY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3599, 222, 'Swansea', 'SWAN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3600, 222, 'Torfaen', 'TORF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3601, 222, 'Tyne and Wear', 'TWR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3602, 222, 'Vale of Glamorgan', 'VGLAM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3603, 222, 'Warwickshire', 'WARKS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3604, 222, 'West Dunbartonshire', 'WDUN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3605, 222, 'West Lothian', 'WLOT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3606, 222, 'West Midlands', 'WMD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3607, 222, 'West Sussex', 'SXW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3608, 222, 'West Yorkshire', 'YSW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3609, 222, 'Western Isles', 'WIL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3610, 222, 'Wiltshire', 'WLT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3611, 222, 'Worcestershire', 'WORCS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3612, 222, 'Wrexham', 'WRX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3613, 223, 'Alabama', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3614, 223, 'Alaska', 'AK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3615, 223, 'American Samoa', 'AS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3616, 223, 'Arizona', 'AZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3617, 223, 'Arkansas', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3618, 223, 'Armed Forces Africa', 'AF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3619, 223, 'Armed Forces Americas', 'AA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3620, 223, 'Armed Forces Canada', 'AC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3621, 223, 'Armed Forces Europe', 'AE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3622, 223, 'Armed Forces Middle East', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3623, 223, 'Armed Forces Pacific', 'AP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3624, 223, 'California', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3625, 223, 'Colorado', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3626, 223, 'Connecticut', 'CT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3627, 223, 'Delaware', 'DE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3628, 223, 'District of Columbia', 'DC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3629, 223, 'Federated States Of Micronesia', 'FM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3630, 223, 'Florida', 'FL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3631, 223, 'Georgia', 'GA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3632, 223, 'Guam', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3633, 223, 'Hawaii', 'HI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3634, 223, 'Idaho', 'ID', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3635, 223, 'Illinois', 'IL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3636, 223, 'Indiana', 'IN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3637, 223, 'Iowa', 'IA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3638, 223, 'Kansas', 'KS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3639, 223, 'Kentucky', 'KY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3640, 223, 'Louisiana', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3641, 223, 'Maine', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3642, 223, 'Marshall Islands', 'MH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3643, 223, 'Maryland', 'MD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3644, 223, 'Massachusetts', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3645, 223, 'Michigan', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3646, 223, 'Minnesota', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3647, 223, 'Mississippi', 'MS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3648, 223, 'Missouri', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3649, 223, 'Montana', 'MT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3650, 223, 'Nebraska', 'NE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3651, 223, 'Nevada', 'NV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3652, 223, 'New Hampshire', 'NH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3653, 223, 'New Jersey', 'NJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3654, 223, 'New Mexico', 'NM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3655, 223, 'New York', 'NY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3656, 223, 'North Carolina', 'NC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3657, 223, 'North Dakota', 'ND', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3658, 223, 'Northern Mariana Islands', 'MP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3659, 223, 'Ohio', 'OH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3660, 223, 'Oklahoma', 'OK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3661, 223, 'Oregon', 'OR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3662, 223, 'Palau', 'PW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3663, 223, 'Pennsylvania', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3664, 223, 'Puerto Rico', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3665, 223, 'Rhode Island', 'RI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3666, 223, 'South Carolina', 'SC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3667, 223, 'South Dakota', 'SD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3668, 223, 'Tennessee', 'TN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3669, 223, 'Texas', 'TX', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3670, 223, 'Utah', 'UT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3671, 223, 'Vermont', 'VT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3672, 223, 'Virgin Islands', 'VI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3673, 223, 'Virginia', 'VA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3674, 223, 'Washington', 'WA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3675, 223, 'West Virginia', 'WV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3676, 223, 'Wisconsin', 'WI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3677, 223, 'Wyoming', 'WY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3678, 224, 'Baker Island', 'BI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3679, 224, 'Howland Island', 'HI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3680, 224, 'Jarvis Island', 'JI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3681, 224, 'Johnston Atoll', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3682, 224, 'Kingman Reef', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3683, 224, 'Midway Atoll', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3684, 224, 'Navassa Island', 'NI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3685, 224, 'Palmyra Atoll', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3686, 224, 'Wake Island', 'WI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3687, 225, 'Artigas', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3688, 225, 'Canelones', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3689, 225, 'Cerro Largo', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3690, 225, 'Colonia', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3691, 225, 'Durazno', 'DU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3692, 225, 'Flores', 'FS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3693, 225, 'Florida', 'FA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3694, 225, 'Lavalleja', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3695, 225, 'Maldonado', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3696, 225, 'Montevideo', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3697, 225, 'Paysandu', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3698, 225, 'Rio Negro', 'RN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3699, 225, 'Rivera', 'RV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3700, 225, 'Rocha', 'RO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3701, 225, 'Salto', 'SL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3702, 225, 'San Jose', 'SJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3703, 225, 'Soriano', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3704, 225, 'Tacuarembo', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3705, 225, 'Treinta y Tres', 'TT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3706, 226, 'Andijon', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3707, 226, 'Buxoro', 'BU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3708, 226, 'Farg\'ona', 'FA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3709, 226, 'Jizzax', 'JI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3710, 226, 'Namangan', 'NG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3711, 226, 'Navoiy', 'NW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3712, 226, 'Qashqadaryo', 'QA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3713, 226, 'Qoraqalpog\'iston Republikasi', 'QR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3714, 226, 'Samarqand', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3715, 226, 'Sirdaryo', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3716, 226, 'Surxondaryo', 'SU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3717, 226, 'Toshkent City', 'TK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3718, 226, 'Toshkent Region', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3719, 226, 'Xorazm', 'XO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3720, 227, 'Malampa', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3721, 227, 'Penama', 'PE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3722, 227, 'Sanma', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3723, 227, 'Shefa', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3724, 227, 'Tafea', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3725, 227, 'Torba', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3726, 229, 'Amazonas', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3727, 229, 'Anzoategui', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3728, 229, 'Apure', 'AP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3729, 229, 'Aragua', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3730, 229, 'Barinas', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3731, 229, 'Bolivar', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3732, 229, 'Carabobo', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3733, 229, 'Cojedes', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3734, 229, 'Delta Amacuro', 'DA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3735, 229, 'Dependencias Federales', 'DF', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3736, 229, 'Distrito Federal', 'DI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3737, 229, 'Falcon', 'FA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3738, 229, 'Guarico', 'GU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3739, 229, 'Lara', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3740, 229, 'Merida', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3741, 229, 'Miranda', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3742, 229, 'Monagas', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3743, 229, 'Nueva Esparta', 'NE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3744, 229, 'Portuguesa', 'PO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3745, 229, 'Sucre', 'SU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3746, 229, 'Tachira', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3747, 229, 'Trujillo', 'TR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3748, 229, 'Vargas', 'VA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3749, 229, 'Yaracuy', 'YA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3750, 229, 'Zulia', 'ZU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3751, 230, 'An Giang', 'AG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3752, 230, 'Bac Giang', 'BG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3753, 230, 'Bac Kan', 'BK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3754, 230, 'Bac Lieu', 'BL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3755, 230, 'Bac Ninh', 'BC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3756, 230, 'Ba Ria-Vung Tau', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3757, 230, 'Ben Tre', 'BN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3758, 230, 'Binh Dinh', 'BH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3759, 230, 'Binh Duong', 'BU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3760, 230, 'Binh Phuoc', 'BP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3761, 230, 'Binh Thuan', 'BT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3762, 230, 'Ca Mau', 'CM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3763, 230, 'Can Tho', 'CT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3764, 230, 'Cao Bang', 'CB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3765, 230, 'Dak Lak', 'DL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3766, 230, 'Dak Nong', 'DG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3767, 230, 'Da Nang', 'DN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3768, 230, 'Dien Bien', 'DB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3769, 230, 'Dong Nai', 'DI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3770, 230, 'Dong Thap', 'DT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3771, 230, 'Gia Lai', 'GL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3772, 230, 'Ha Giang', 'HG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3773, 230, 'Hai Duong', 'HD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3774, 230, 'Hai Phong', 'HP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3775, 230, 'Ha Nam', 'HM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3776, 230, 'Ha Noi', 'HI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3777, 230, 'Ha Tay', 'HT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3778, 230, 'Ha Tinh', 'HH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3779, 230, 'Hoa Binh', 'HB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3780, 230, 'Ho Chi Minh City', 'HC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3781, 230, 'Hau Giang', 'HU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3782, 230, 'Hung Yen', 'HY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3783, 232, 'Saint Croix', 'C', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3784, 232, 'Saint John', 'J', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3785, 232, 'Saint Thomas', 'T', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3786, 233, 'Alo', 'A', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3787, 233, 'Sigave', 'S', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3788, 233, 'Wallis', 'W', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3789, 235, 'Abyan', 'AB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3790, 235, 'Adan', 'AD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3791, 235, 'Amran', 'AM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3792, 235, 'Al Bayda', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3793, 235, 'Ad Dali', 'DA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3794, 235, 'Dhamar', 'DH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3795, 235, 'Hadramawt', 'HD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3796, 235, 'Hajjah', 'HJ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3797, 235, 'Al Hudaydah', 'HU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3798, 235, 'Ibb', 'IB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3799, 235, 'Al Jawf', 'JA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3800, 235, 'Lahij', 'LA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3801, 235, 'Ma\'rib', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3802, 235, 'Al Mahrah', 'MR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3803, 235, 'Al Mahwit', 'MW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3804, 235, 'Sa\'dah', 'SD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3805, 235, 'San\'a', 'SN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3806, 235, 'Shabwah', 'SH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3807, 235, 'Ta\'izz', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3812, 237, 'Bas-Congo', 'BC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3813, 237, 'Bandundu', 'BN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3814, 237, 'Equateur', 'EQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3815, 237, 'Katanga', 'KA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3816, 237, 'Kasai-Oriental', 'KE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3817, 237, 'Kinshasa', 'KN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3818, 237, 'Kasai-Occidental', 'KW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3819, 237, 'Maniema', 'MA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3820, 237, 'Nord-Kivu', 'NK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3821, 237, 'Orientale', 'OR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3822, 237, 'Sud-Kivu', 'SK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3823, 238, 'Central', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3824, 238, 'Copperbelt', 'CB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3825, 238, 'Eastern', 'EA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3826, 238, 'Luapula', 'LP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3827, 238, 'Lusaka', 'LK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3828, 238, 'Northern', 'NO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3829, 238, 'North-Western', 'NW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3830, 238, 'Southern', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3831, 238, 'Western', 'WE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3832, 239, 'Bulawayo', 'BU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3833, 239, 'Harare', 'HA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3834, 239, 'Manicaland', 'ML', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3835, 239, 'Mashonaland Central', 'MC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3836, 239, 'Mashonaland East', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3837, 239, 'Mashonaland West', 'MW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3838, 239, 'Masvingo', 'MV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3839, 239, 'Matabeleland North', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3840, 239, 'Matabeleland South', 'MS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3841, 239, 'Midlands', 'MD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3842, 105, 'Agrigento', 'AG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3843, 105, 'Alessandria', 'AL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3844, 105, 'Ancona', 'AN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3845, 105, 'Aosta', 'AO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3846, 105, 'Arezzo', 'AR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3847, 105, 'Ascoli Piceno', 'AP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3848, 105, 'Asti', 'AT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3849, 105, 'Avellino', 'AV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3850, 105, 'Bari', 'BA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3851, 105, 'Belluno', 'BL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3852, 105, 'Benevento', 'BN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3853, 105, 'Bergamo', 'BG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3854, 105, 'Biella', 'BI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3855, 105, 'Bologna', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3856, 105, 'Bolzano', 'BZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3857, 105, 'Brescia', 'BS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3858, 105, 'Brindisi', 'BR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3859, 105, 'Cagliari', 'CA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3860, 105, 'Caltanissetta', 'CL', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3861, 105, 'Campobasso', 'CB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3862, 105, 'Carbonia-Iglesias', 'CI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3863, 105, 'Caserta', 'CE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3864, 105, 'Catania', 'CT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3865, 105, 'Catanzaro', 'CZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3866, 105, 'Chieti', 'CH', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3867, 105, 'Como', 'CO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3868, 105, 'Cosenza', 'CS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3869, 105, 'Cremona', 'CR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3870, 105, 'Crotone', 'KR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3871, 105, 'Cuneo', 'CN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3872, 105, 'Enna', 'EN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3873, 105, 'Ferrara', 'FE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3874, 105, 'Firenze', 'FI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3875, 105, 'Foggia', 'FG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3876, 105, 'Forli-Cesena', 'FC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3877, 105, 'Frosinone', 'FR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3878, 105, 'Genova', 'GE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3879, 105, 'Gorizia', 'GO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3880, 105, 'Grosseto', 'GR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3881, 105, 'Imperia', 'IM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3882, 105, 'Isernia', 'IS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3883, 105, 'L&#39;Aquila', 'AQ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3884, 105, 'La Spezia', 'SP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3885, 105, 'Latina', 'LT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3886, 105, 'Lecce', 'LE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3887, 105, 'Lecco', 'LC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3888, 105, 'Livorno', 'LI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3889, 105, 'Lodi', 'LO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3890, 105, 'Lucca', 'LU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3891, 105, 'Macerata', 'MC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3892, 105, 'Mantova', 'MN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3893, 105, 'Massa-Carrara', 'MS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3894, 105, 'Matera', 'MT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3895, 105, 'Medio Campidano', 'VS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3896, 105, 'Messina', 'ME', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3897, 105, 'Milano', 'MI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3898, 105, 'Modena', 'MO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3899, 105, 'Napoli', 'NA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3900, 105, 'Novara', 'NO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3901, 105, 'Nuoro', 'NU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3902, 105, 'Ogliastra', 'OG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3903, 105, 'Olbia-Tempio', 'OT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3904, 105, 'Oristano', 'OR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3905, 105, 'Padova', 'PD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3906, 105, 'Palermo', 'PA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3907, 105, 'Parma', 'PR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3908, 105, 'Pavia', 'PV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3909, 105, 'Perugia', 'PG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3910, 105, 'Pesaro e Urbino', 'PU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3911, 105, 'Pescara', 'PE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3912, 105, 'Piacenza', 'PC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3913, 105, 'Pisa', 'PI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3914, 105, 'Pistoia', 'PT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3915, 105, 'Pordenone', 'PN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3916, 105, 'Potenza', 'PZ', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3917, 105, 'Prato', 'PO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3918, 105, 'Ragusa', 'RG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3919, 105, 'Ravenna', 'RA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3920, 105, 'Reggio Calabria', 'RC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3921, 105, 'Reggio Emilia', 'RE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3922, 105, 'Rieti', 'RI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3923, 105, 'Rimini', 'RN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3924, 105, 'Roma', 'RM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3925, 105, 'Rovigo', 'RO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3926, 105, 'Salerno', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3927, 105, 'Sassari', 'SS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3928, 105, 'Savona', 'SV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3929, 105, 'Siena', 'SI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3930, 105, 'Siracusa', 'SR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3931, 105, 'Sondrio', 'SO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3932, 105, 'Taranto', 'TA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3933, 105, 'Teramo', 'TE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3934, 105, 'Terni', 'TR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3935, 105, 'Torino', 'TO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3936, 105, 'Trapani', 'TP', 1, 0, 0, 0, '0000-00-00 00:00:00');
INSERT INTO `state` (`state_id`, `ref_country_id`, `state_name`, `code`, `status`, `delete_status`, `user_id`, `transaction_id`, `added_date`) VALUES
(3937, 105, 'Trento', 'TN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3938, 105, 'Treviso', 'TV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3939, 105, 'Trieste', 'TS', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3940, 105, 'Udine', 'UD', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3941, 105, 'Varese', 'VA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3942, 105, 'Venezia', 'VE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3943, 105, 'Verbano-Cusio-Ossola', 'VB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3944, 105, 'Vercelli', 'VC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3945, 105, 'Verona', 'VR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3946, 105, 'Vibo Valentia', 'VV', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3947, 105, 'Vicenza', 'VI', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3948, 105, 'Viterbo', 'VT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3949, 222, 'County Antrim', 'ANT', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3950, 222, 'County Armagh', 'ARM', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3951, 222, 'County Down', 'DOW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3952, 222, 'County Fermanagh', 'FER', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3953, 222, 'County Londonderry', 'LDY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3954, 222, 'County Tyrone', 'TYR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3955, 222, 'Cumbria', 'CMA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3956, 190, 'Pomurska', '1', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3957, 190, 'Podravska', '2', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3958, 190, 'KoroÃ…Â¡ka', '3', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3959, 190, 'Savinjska', '4', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3960, 190, 'Zasavska', '5', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3961, 190, 'Spodnjeposavska', '6', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3962, 190, 'Jugovzhodna Slovenija', '7', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3963, 190, 'Osrednjeslovenska', '8', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3964, 190, 'Gorenjska', '9', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3965, 190, 'Notranjsko-kraÃ…Â¡ka', '10', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3966, 190, 'GoriÃ…Â¡ka', '11', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3967, 190, 'Obalno-kraÃ…Â¡ka', '12', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3968, 33, 'Ruse', '', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3969, 101, 'Alborz', 'ALB', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3970, 21, 'Brussels-Capital Region', 'BRU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3971, 138, 'Aguascalientes', 'AG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3973, 242, 'Andrijevica', '01', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3974, 242, 'Bar', '02', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3975, 242, 'Berane', '03', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3976, 242, 'Bijelo Polje', '04', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3977, 242, 'Budva', '05', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3978, 242, 'Cetinje', '06', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3979, 242, 'Danilovgrad', '07', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3980, 242, 'Herceg-Novi', '08', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3981, 242, 'KolaÃ…Â¡in', '09', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3982, 242, 'Kotor', '10', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3983, 242, 'Mojkovac', '11', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3984, 242, 'NikÃ…Â¡iÃ„â€¡', '12', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3985, 242, 'Plav', '13', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3986, 242, 'Pljevlja', '14', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3987, 242, 'PluÃ…Â¾ine', '15', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3988, 242, 'Podgorica', '16', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3989, 242, 'RoÃ…Â¾aje', '17', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3990, 242, 'Ã…Â avnik', '18', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3991, 242, 'Tivat', '19', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3992, 242, 'Ulcinj', '20', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3993, 242, 'Ã…Â½abljak', '21', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3994, 243, 'Belgrade', '00', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3995, 243, 'North BaÃ„Âka', '01', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3996, 243, 'Central Banat', '02', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3997, 243, 'North Banat', '03', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3998, 243, 'South Banat', '04', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(3999, 243, 'West BaÃ„Âka', '05', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4000, 243, 'South BaÃ„Âka', '06', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4001, 243, 'Srem', '07', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4002, 243, 'MaÃ„Âva', '08', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4003, 243, 'Kolubara', '09', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4004, 243, 'Podunavlje', '10', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4005, 243, 'BraniÃ„Âevo', '11', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4006, 243, 'Ã…Â umadija', '12', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4007, 243, 'Pomoravlje', '13', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4008, 243, 'Bor', '14', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4009, 243, 'ZajeÃ„Âar', '15', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4010, 243, 'Zlatibor', '16', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4011, 243, 'Moravica', '17', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4012, 243, 'RaÃ…Â¡ka', '18', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4013, 243, 'Rasina', '19', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4014, 243, 'NiÃ…Â¡ava', '20', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4015, 243, 'Toplica', '21', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4016, 243, 'Pirot', '22', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4017, 243, 'Jablanica', '23', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4018, 243, 'PÃ„Âinja', '24', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4020, 245, 'Bonaire', 'BO', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4021, 245, 'Saba', 'SA', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4022, 245, 'Sint Eustatius', 'SE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4023, 248, 'Central Equatoria', 'EC', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4024, 248, 'Eastern Equatoria', 'EE', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4025, 248, 'Jonglei', 'JG', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4026, 248, 'Lakes', 'LK', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4027, 248, 'Northern Bahr el-Ghazal', 'BN', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4028, 248, 'Unity', 'UY', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4029, 248, 'Upper Nile', 'NU', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4030, 248, 'Warrap', 'WR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4031, 248, 'Western Bahr el-Ghazal', 'BW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4032, 248, 'Western Equatoria', 'EW', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4035, 129, 'Putrajaya', 'MY-16', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4036, 117, 'AinaÃ…Â¾i, SalacgrÃ„Â«vas novads', '0661405', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4037, 117, 'Aizkraukle, Aizkraukles novads', '0320201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4038, 117, 'Aizkraukles novads', '0320200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4039, 117, 'Aizpute, Aizputes novads', '0640605', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4040, 117, 'Aizputes novads', '0640600', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4041, 117, 'AknÃ„Â«ste, AknÃ„Â«stes novads', '0560805', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4042, 117, 'AknÃ„Â«stes novads', '0560800', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4043, 117, 'Aloja, Alojas novads', '0661007', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4044, 117, 'Alojas novads', '0661000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4045, 117, 'Alsungas novads', '0624200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4046, 117, 'AlÃ…Â«ksne, AlÃ…Â«ksnes novads', '0360201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4047, 117, 'AlÃ…Â«ksnes novads', '0360200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4048, 117, 'Amatas novads', '0424701', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4049, 117, 'Ape, Apes novads', '0360805', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4050, 117, 'Apes novads', '0360800', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4051, 117, 'Auce, Auces novads', '0460805', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4052, 117, 'Auces novads', '0460800', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4053, 117, 'Ã„â‚¬daÃ…Â¾u novads', '0804400', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4054, 117, 'BabÃ„Â«tes novads', '0804900', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4055, 117, 'Baldone, Baldones novads', '0800605', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4056, 117, 'Baldones novads', '0800600', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4057, 117, 'BaloÃ…Â¾i, Ã„Â¶ekavas novads', '0800807', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4058, 117, 'Baltinavas novads', '0384400', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4059, 117, 'Balvi, Balvu novads', '0380201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4060, 117, 'Balvu novads', '0380200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4061, 117, 'Bauska, Bauskas novads', '0400201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4062, 117, 'Bauskas novads', '0400200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4063, 117, 'BeverÃ„Â«nas novads', '0964700', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4064, 117, 'BrocÃ„â€œni, BrocÃ„â€œnu novads', '0840605', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4065, 117, 'BrocÃ„â€œnu novads', '0840601', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4066, 117, 'Burtnieku novads', '0967101', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4067, 117, 'Carnikavas novads', '0805200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4068, 117, 'Cesvaine, Cesvaines novads', '0700807', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4069, 117, 'Cesvaines novads', '0700800', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4070, 117, 'CÃ„â€œsis, CÃ„â€œsu novads', '0420201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4071, 117, 'CÃ„â€œsu novads', '0420200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4072, 117, 'Ciblas novads', '0684901', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4073, 117, 'Dagda, Dagdas novads', '0601009', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4074, 117, 'Dagdas novads', '0601000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4075, 117, 'Daugavpils', '0050000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4076, 117, 'Daugavpils novads', '0440200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4077, 117, 'Dobele, Dobeles novads', '0460201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4078, 117, 'Dobeles novads', '0460200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4079, 117, 'Dundagas novads', '0885100', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4080, 117, 'Durbe, Durbes novads', '0640807', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4081, 117, 'Durbes novads', '0640801', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4082, 117, 'Engures novads', '0905100', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4083, 117, 'Ã„â€™rgÃ„Â¼u novads', '0705500', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4084, 117, 'Garkalnes novads', '0806000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4085, 117, 'GrobiÃ…â€ a, GrobiÃ…â€ as novads', '0641009', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4086, 117, 'GrobiÃ…â€ as novads', '0641000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4087, 117, 'Gulbene, Gulbenes novads', '0500201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4088, 117, 'Gulbenes novads', '0500200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4089, 117, 'Iecavas novads', '0406400', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4090, 117, 'IkÃ…Â¡Ã„Â·ile, IkÃ…Â¡Ã„Â·iles novads', '0740605', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4091, 117, 'IkÃ…Â¡Ã„Â·iles novads', '0740600', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4092, 117, 'IlÃ…Â«kste, IlÃ…Â«kstes novads', '0440807', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4093, 117, 'IlÃ…Â«kstes novads', '0440801', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4094, 117, 'InÃ„Âukalna novads', '0801800', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4095, 117, 'Jaunjelgava, Jaunjelgavas novads', '0321007', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4096, 117, 'Jaunjelgavas novads', '0321000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4097, 117, 'Jaunpiebalgas novads', '0425700', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4098, 117, 'Jaunpils novads', '0905700', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4099, 117, 'Jelgava', '0090000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4100, 117, 'Jelgavas novads', '0540200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4101, 117, 'JÃ„â€œkabpils', '0110000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4102, 117, 'JÃ„â€œkabpils novads', '0560200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4103, 117, 'JÃ…Â«rmala', '0130000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4104, 117, 'Kalnciems, Jelgavas novads', '0540211', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4105, 117, 'Kandava, Kandavas novads', '0901211', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4106, 117, 'Kandavas novads', '0901201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4107, 117, 'KÃ„Ârsava, KÃ„Ârsavas novads', '0681009', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4108, 117, 'KÃ„Ârsavas novads', '0681000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4109, 117, 'KocÃ„â€œnu novads ,bij. Valmieras)', '0960200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4110, 117, 'Kokneses novads', '0326100', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4111, 117, 'KrÃ„Âslava, KrÃ„Âslavas novads', '0600201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4112, 117, 'KrÃ„Âslavas novads', '0600202', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4113, 117, 'Krimuldas novads', '0806900', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4114, 117, 'Krustpils novads', '0566900', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4115, 117, 'KuldÃ„Â«ga, KuldÃ„Â«gas novads', '0620201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4116, 117, 'KuldÃ„Â«gas novads', '0620200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4117, 117, 'Ã„Â¶eguma novads', '0741001', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4118, 117, 'Ã„Â¶egums, Ã„Â¶eguma novads', '0741009', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4119, 117, 'Ã„Â¶ekavas novads', '0800800', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4120, 117, 'LielvÃ„Ârde, LielvÃ„Ârdes novads', '0741413', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4121, 117, 'LielvÃ„Ârdes novads', '0741401', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4122, 117, 'LiepÃ„Âja', '0170000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4123, 117, 'LimbaÃ…Â¾i, LimbaÃ…Â¾u novads', '0660201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4124, 117, 'LimbaÃ…Â¾u novads', '0660200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4125, 117, 'LÃ„Â«gatne, LÃ„Â«gatnes novads', '0421211', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4126, 117, 'LÃ„Â«gatnes novads', '0421200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4127, 117, 'LÃ„Â«vÃ„Âni, LÃ„Â«vÃ„Ânu novads', '0761211', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4128, 117, 'LÃ„Â«vÃ„Ânu novads', '0761201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4129, 117, 'LubÃ„Âna, LubÃ„Ânas novads', '0701413', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4130, 117, 'LubÃ„Ânas novads', '0701400', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4131, 117, 'Ludza, Ludzas novads', '0680201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4132, 117, 'Ludzas novads', '0680200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4133, 117, 'Madona, Madonas novads', '0700201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4134, 117, 'Madonas novads', '0700200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4135, 117, 'Mazsalaca, Mazsalacas novads', '0961011', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4136, 117, 'Mazsalacas novads', '0961000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4137, 117, 'MÃ„Âlpils novads', '0807400', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4138, 117, 'MÃ„Ârupes novads', '0807600', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4139, 117, 'MÃ„â€œrsraga novads', '0887600', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4140, 117, 'NaukÃ…Â¡Ã„â€œnu novads', '0967300', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4141, 117, 'Neretas novads', '0327100', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4142, 117, 'NÃ„Â«cas novads', '0647900', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4143, 117, 'Ogre, Ogres novads', '0740201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4144, 117, 'Ogres novads', '0740202', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4145, 117, 'Olaine, Olaines novads', '0801009', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4146, 117, 'Olaines novads', '0801000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4147, 117, 'Ozolnieku novads', '0546701', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4148, 117, 'PÃ„Ârgaujas novads', '0427500', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4149, 117, 'PÃ„Âvilosta, PÃ„Âvilostas novads', '0641413', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4150, 117, 'PÃ„Âvilostas novads', '0641401', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4151, 117, 'Piltene, Ventspils novads', '0980213', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4152, 117, 'PÃ„Â¼aviÃ…â€ as, PÃ„Â¼aviÃ…â€ u novads', '0321413', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4153, 117, 'PÃ„Â¼aviÃ…â€ u novads', '0321400', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4154, 117, 'PreiÃ„Â¼i, PreiÃ„Â¼u novads', '0760201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4155, 117, 'PreiÃ„Â¼u novads', '0760202', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4156, 117, 'Priekule, Priekules novads', '0641615', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4157, 117, 'Priekules novads', '0641600', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4158, 117, 'PriekuÃ„Â¼u novads', '0427300', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4159, 117, 'Raunas novads', '0427700', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4160, 117, 'RÃ„â€œzekne', '0210000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4161, 117, 'RÃ„â€œzeknes novads', '0780200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4162, 117, 'RiebiÃ…â€ u novads', '0766300', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4163, 117, 'RÃ„Â«ga', '0010000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4164, 117, 'Rojas novads', '0888300', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4165, 117, 'RopaÃ…Â¾u novads', '0808400', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4166, 117, 'Rucavas novads', '0648500', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4167, 117, 'RugÃ„Âju novads', '0387500', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4168, 117, 'RundÃ„Âles novads', '0407700', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4169, 117, 'RÃ…Â«jiena, RÃ…Â«jienas novads', '0961615', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4170, 117, 'RÃ…Â«jienas novads', '0961600', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4171, 117, 'Sabile, Talsu novads', '0880213', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4172, 117, 'SalacgrÃ„Â«va, SalacgrÃ„Â«vas novads', '0661415', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4173, 117, 'SalacgrÃ„Â«vas novads', '0661400', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4174, 117, 'Salas novads', '0568700', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4175, 117, 'Salaspils novads', '0801200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4176, 117, 'Salaspils, Salaspils novads', '0801211', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4177, 117, 'Saldus novads', '0840200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4178, 117, 'Saldus, Saldus novads', '0840201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4179, 117, 'Saulkrasti, Saulkrastu novads', '0801413', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4180, 117, 'Saulkrastu novads', '0801400', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4181, 117, 'Seda, StrenÃ„Âu novads', '0941813', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4182, 117, 'SÃ„â€œjas novads', '0809200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4183, 117, 'Sigulda, Siguldas novads', '0801615', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4184, 117, 'Siguldas novads', '0801601', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4185, 117, 'SkrÃ„Â«veru novads', '0328200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4186, 117, 'Skrunda, Skrundas novads', '0621209', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4187, 117, 'Skrundas novads', '0621200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4188, 117, 'Smiltene, Smiltenes novads', '0941615', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4189, 117, 'Smiltenes novads', '0941600', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4190, 117, 'Staicele, Alojas novads', '0661017', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4191, 117, 'Stende, Talsu novads', '0880215', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4192, 117, 'StopiÃ…â€ u novads', '0809600', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4193, 117, 'StrenÃ„Âi, StrenÃ„Âu novads', '0941817', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4194, 117, 'StrenÃ„Âu novads', '0941800', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4195, 117, 'Subate, IlÃ…Â«kstes novads', '0440815', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4196, 117, 'Talsi, Talsu novads', '0880201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4197, 117, 'Talsu novads', '0880200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4198, 117, 'TÃ„â€œrvetes novads', '0468900', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4199, 117, 'Tukuma novads', '0900200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4200, 117, 'Tukums, Tukuma novads', '0900201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4201, 117, 'VaiÃ…â€ odes novads', '0649300', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4202, 117, 'ValdemÃ„Ârpils, Talsu novads', '0880217', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4203, 117, 'Valka, Valkas novads', '0940201', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4204, 117, 'Valkas novads', '0940200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4205, 117, 'Valmiera', '0250000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4206, 117, 'VangaÃ…Â¾i, InÃ„Âukalna novads', '0801817', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4207, 117, 'VarakÃ„Â¼Ã„Âni, VarakÃ„Â¼Ã„Ânu novads', '0701817', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4208, 117, 'VarakÃ„Â¼Ã„Ânu novads', '0701800', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4209, 117, 'VÃ„Ârkavas novads', '0769101', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4210, 117, 'Vecpiebalgas novads', '0429300', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4211, 117, 'Vecumnieku novads', '0409500', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4212, 117, 'Ventspils', '0270000', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4213, 117, 'Ventspils novads', '0980200', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4214, 117, 'ViesÃ„Â«te, ViesÃ„Â«tes novads', '0561815', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4215, 117, 'ViesÃ„Â«tes novads', '0561800', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4216, 117, 'ViÃ„Â¼aka, ViÃ„Â¼akas novads', '0381615', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4217, 117, 'ViÃ„Â¼akas novads', '0381600', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4218, 117, 'ViÃ„Â¼Ã„Âni, ViÃ„Â¼Ã„Ânu novads', '0781817', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4219, 117, 'ViÃ„Â¼Ã„Ânu novads', '0781800', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4220, 117, 'Zilupe, Zilupes novads', '0681817', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4221, 117, 'Zilupes novads', '0681801', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4222, 43, 'Arica y Parinacota', 'AP', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4223, 43, 'Los Rios', 'LR', 1, 0, 0, 0, '0000-00-00 00:00:00'),
(4224, 220, 'Kharkivs\'ka Oblast\'', '63', 1, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(15) NOT NULL COMMENT 'Status',
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Pending', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Processing', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'Completed', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_room`
--

CREATE TABLE `stock_room` (
  `stock_room_id` int(11) NOT NULL,
  `stock_room_name` varchar(25) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_room`
--

INSERT INTO `stock_room` (`stock_room_id`, `stock_room_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'Main Room', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'Store Room', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_slot`
--

CREATE TABLE `stock_slot` (
  `stock_slot_id` int(11) NOT NULL,
  `stock_slot_name` varchar(25) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_slot`
--

INSERT INTO `stock_slot` (`stock_slot_id`, `stock_slot_name`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 'T1', 0, 0, 0, '0000-00-00 00:00:00'),
(2, 'T2', 0, 0, 0, '0000-00-00 00:00:00'),
(3, 'T3', 0, 0, 0, '0000-00-00 00:00:00'),
(4, 'T4', 0, 0, 0, '0000-00-00 00:00:00'),
(5, 'T5', 0, 0, 0, '0000-00-00 00:00:00'),
(6, 'T6', 0, 0, 0, '0000-00-00 00:00:00'),
(7, 'T7', 0, 0, 0, '0000-00-00 00:00:00'),
(8, 'T8', 0, 0, 0, '0000-00-00 00:00:00'),
(9, 'T9', 0, 0, 0, '0000-00-00 00:00:00'),
(10, 'T10', 0, 0, 0, '0000-00-00 00:00:00'),
(11, 'T11', 0, 0, 0, '0000-00-00 00:00:00'),
(12, 'T12', 0, 0, 0, '0000-00-00 00:00:00'),
(13, 'T13', 0, 0, 0, '0000-00-00 00:00:00'),
(14, 'T14', 0, 0, 0, '0000-00-00 00:00:00'),
(15, 'T15', 0, 0, 0, '0000-00-00 00:00:00'),
(16, 'T16', 0, 0, 0, '0000-00-00 00:00:00'),
(17, 'R1', 0, 0, 0, '0000-00-00 00:00:00'),
(18, 'R2', 0, 0, 0, '0000-00-00 00:00:00'),
(19, 'R3', 0, 0, 0, '0000-00-00 00:00:00'),
(20, 'C1', 0, 0, 0, '0000-00-00 00:00:00'),
(21, 'C2', 0, 0, 0, '0000-00-00 00:00:00'),
(22, 'C3', 0, 0, 0, '0000-00-00 00:00:00'),
(23, 'C4', 0, 0, 0, '0000-00-00 00:00:00'),
(24, 'C5', 0, 0, 0, '0000-00-00 00:00:00'),
(25, 'C6', 0, 0, 0, '0000-00-00 00:00:00'),
(26, 'L1', 0, 0, 0, '0000-00-00 00:00:00'),
(27, 'L2', 0, 0, 0, '0000-00-00 00:00:00'),
(28, 'L3', 0, 0, 0, '0000-00-00 00:00:00'),
(29, 'L4', 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_no` varchar(10) NOT NULL,
  `supplier_code` varchar(25) NOT NULL,
  `ref_data_source_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL COMMENT 'Supplier Name',
  `supplier_from_date` date NOT NULL COMMENT 'From Date',
  `supplier_address_line1` varchar(255) NOT NULL,
  `supplier_address_line2` varchar(255) NOT NULL,
  `supplier_address_line3` varchar(255) NOT NULL,
  `ref_district_id` int(11) NOT NULL COMMENT 'District',
  `ref_state_id` int(11) NOT NULL COMMENT 'State',
  `ref_country_id` int(11) NOT NULL,
  `supplier_pincode` varchar(10) NOT NULL,
  `contact_number_1` bigint(20) NOT NULL,
  `contact_number_2` bigint(20) NOT NULL,
  `contact_email_1` varchar(100) NOT NULL,
  `contact_email_2` varchar(100) NOT NULL,
  `supplier_gst_no` varchar(25) NOT NULL,
  `supplier_gst_file` varchar(255) NOT NULL,
  `supplier_pan_no` varchar(25) NOT NULL,
  `supplier_pan_file` varchar(255) NOT NULL,
  `supplier_description` text NOT NULL,
  `direct_to_customer` int(1) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_no`, `supplier_code`, `ref_data_source_id`, `supplier_name`, `supplier_from_date`, `supplier_address_line1`, `supplier_address_line2`, `supplier_address_line3`, `ref_district_id`, `ref_state_id`, `ref_country_id`, `supplier_pincode`, `contact_number_1`, `contact_number_2`, `contact_email_1`, `contact_email_2`, `supplier_gst_no`, `supplier_gst_file`, `supplier_pan_no`, `supplier_pan_file`, `supplier_description`, `direct_to_customer`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(31, '0031', '12345', 0, 'Club7 Holidays Pvt Ltd', '0000-00-00', '#34', 'Cherry Raod', 'Salem', 533, 1503, 99, '636122', 4272255663, 7904809253, 'dhanasekaran.provab@gmail.com', '', '', '', '', '', 'Test', 0, 1, 1, 0, '2020-08-01 21:10:45'),
(32, '0032', '1234', 0, 'Dhanaskearan', '0000-00-00', '#34', 'salem', '', 533, 1503, 99, '636122', 7904809253, 0, 'dhana@gmail.com', '', 'TN31443534534', 'uploads/gst/1596786538_69_test-image.jpg', 'SD235FHS', 'uploads/pan/1596786538_877_test-image.jpg', 'Test', 0, 1, 1, 0, '2020-08-07 13:18:58'),
(33, '0033', 'AVSCBE', 0, 'Arya Vaidya Sala Kottakkal, Coimbatore', '0000-00-00', 'Br. : 320, Dr. Rajendra Prasad Road (100Ft)', 'Tatabad', 'Coimbatore', 517, 1503, 99, '641012', 4222491594, 0, 'coimbatorebr@aryavaidyasala.com', 'unnikrishnanzhc@gmail.com', '33AAATA3631P1ZS', '', '', '', '', 0, 1, 3, 0, '2020-08-29 10:21:38'),
(34, '0034', 'AVSCHE', 0, 'Arya Vaidya Sala Kottakkal, Chennai', '0000-00-00', 'Br, : Old No. 27, New No. 57', 'Nungambakkam High Road', 'Nungambakkam', 516, 1503, 99, '600034', 4428251246, 0, 'chennaibr@aryavaidyasala.com', 'unnikrishnanzhc@gmail.com', '33AAATA3631P1ZS', '', '', '', '', 0, 1, 3, 0, '2020-08-29 10:58:13'),
(35, '0035', 'SUP-17092020-0035', 0, 'Supplier 2', '0000-00-00', '', 'test', 'Alapakkam', 516, 1503, 99, '600116', 45345345, 0, 'test@gmail.com', '', '3343534', '', '', '', '', 0, 0, 1, 0, '2020-09-17 13:45:21'),
(36, '0036', 'SUP-23092020-0036', 0, 'Supplier 1', '0000-00-00', 'test', 'tet', '', 516, 1503, 99, '600024', 23423423, 34234234, '', '', 'erwerw', '', '', '', '', 0, 0, 1, 0, '2020-09-23 15:01:38'),
(37, '0037', 'SUP-13062022-0037', 0, 'Test', '0000-00-00', '', '', '', 533, 1503, 99, '', 0, 0, '', '', '', '', '', '', '', 0, 0, 1, 0, '2022-06-13 14:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_contact_numbers`
--

CREATE TABLE `supplier_contact_numbers` (
  `supplier_contact_id` int(11) NOT NULL,
  `ref_supplier_id` int(11) NOT NULL,
  `primary_contact` int(11) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `ref_designation_id` int(11) NOT NULL,
  `ref_contact_number_type_id` int(11) NOT NULL,
  `std_code` int(11) NOT NULL,
  `contact_number` bigint(11) NOT NULL COMMENT 'Mobile',
  `contact_extension` int(11) NOT NULL,
  `contact_timing_from` varchar(15) NOT NULL,
  `contact_timing_to` varchar(15) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_contact_numbers`
--

INSERT INTO `supplier_contact_numbers` (`supplier_contact_id`, `ref_supplier_id`, `primary_contact`, `contact_person`, `ref_designation_id`, `ref_contact_number_type_id`, `std_code`, `contact_number`, `contact_extension`, `contact_timing_from`, `contact_timing_to`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(47, 21, 1, 'Chandru', 16, 2, 0, 9791560032, 345, '2:00am', '1:30am', 1, 0, 0, '2018-07-28 13:02:42'),
(87, 22, 0, 'Chandru', 17, 3, 0, 9791560032, 345, '12:30am', '12:30am', 0, 0, 0, '2018-08-29 16:58:38'),
(88, 22, 0, 'Chandru 123', 26, 3, 0, 97956985698, 654, '1:00am', '1:30am', 0, 0, 0, '2018-08-29 16:58:38'),
(92, 23, 1, 'Bala', 19, 2, 0, 0, 0, '', '', 1, 0, 0, '2018-08-30 12:40:06'),
(93, 23, 0, 'Bala 1', 22, 3, 0, 97956985698, 91, '2:00am', '1:00am', 1, 0, 0, '2018-08-30 12:40:06'),
(94, 24, 1, 'Banu 2', 20, 3, 0, 9791560032, 345, '1:30am', '2:30am', 1, 0, 0, '2018-08-31 13:59:26'),
(95, 25, 1, 'Sigma Supplier', 0, 1, 0, 978979878, 0, '', '', 1, 0, 0, '2018-09-01 12:04:32'),
(107, 39, 1, 'UNISPIN CARD CLOTHING INDIA P LTD.,', 13, 1, 0, 0, 0, '', '', 0, 0, 0, '2018-11-14 15:00:48'),
(108, 29, 1, 'SRINIVASA TEXTILE EQUIPMENT COMPANY', 13, 1, 0, 0, 0, '', '', 0, 0, 0, '2018-11-14 15:00:59'),
(109, 27, 1, 'DHANSU ENGINEERING P LTD.,', 13, 1, 0, 0, 0, '', '', 0, 0, 0, '2018-11-14 15:01:11'),
(110, 26, 1, 'VENKATESA TEXTILE SPARES PRODUCTS', 13, 2, 0, 4222460708, 0, '', '', 0, 0, 0, '2018-11-14 15:01:27'),
(113, 40, 1, 'ANISH  EQUIPTMENTS', 0, 1, 0, 0, 0, '', '', 0, 0, 0, '2018-11-23 11:29:48'),
(115, 31, 1, '', 21, 1, 0, 0, 0, '', '', 1, 0, 0, '2018-11-26 18:01:39'),
(116, 38, 1, 'VXL RING TRAVELLERS P LTD,  UNIT-II', 22, 1, 0, 9443067701, 0, '', '', 0, 0, 0, '2018-11-27 10:45:34'),
(117, 37, 1, '', 0, 1, 0, 0, 0, '', '', 0, 0, 0, '2018-11-27 10:47:44'),
(118, 36, 1, 'SELVAKUMAR', 0, 1, 0, 9787074017, 0, '', '', 0, 0, 0, '2018-11-27 10:56:33'),
(119, 30, 1, 'HABASIT', 13, 1, 0, 0, 0, '', '', 0, 0, 0, '2018-11-27 11:12:00'),
(121, 41, 1, 'MEGASTAR BELTING', 0, 1, 0, 0, 0, '', '', 0, 0, 0, '2018-12-05 15:38:22'),
(122, 28, 1, 'SIVAKUMAR', 21, 1, 0, 9362281515, 0, '', '', 0, 0, 0, '2018-12-05 18:09:59'),
(123, 42, 1, 'UNIROLS AIRTEX', 0, 1, 0, 0, 0, '', '', 0, 0, 0, '2018-12-29 15:08:37'),
(124, 43, 1, 'DHWANI INDUSTRIES', 0, 1, 0, 0, 0, '', '', 0, 0, 0, '2019-01-02 15:17:04'),
(125, 44, 1, 'SRI BANASHANKARI INDUSTRIES ', 0, 1, 0, 0, 0, '', '', 0, 0, 0, '2019-01-02 17:32:45'),
(126, 45, 1, 'STARK INDUTRIES', 0, 1, 0, 0, 0, '', '', 0, 0, 0, '2019-01-04 12:32:06'),
(127, 46, 1, 'SUJINI MACHINES', 0, 1, 0, 0, 0, '', '', 0, 0, 0, '2019-01-04 15:34:08'),
(129, 47, 1, 'WHITE PLAAST', 21, 1, 0, 0, 0, '', '', 0, 0, 0, '2019-01-08 13:25:08'),
(130, 34, 1, '', 21, 1, 0, 0, 0, '', '', 1, 0, 0, '2019-01-30 16:29:56'),
(131, 48, 1, 'JUMAC MANUFACTURING P LTD.,', 0, 1, 0, 0, 0, '', '', 0, 0, 0, '2019-02-01 13:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_email_ids`
--

CREATE TABLE `supplier_email_ids` (
  `supplier_email_id` int(11) NOT NULL,
  `ref_supplier_id` int(11) NOT NULL,
  `primary_contact` int(1) NOT NULL,
  `email_id` varchar(100) NOT NULL COMMENT 'Email ID',
  `contact_person` varchar(50) NOT NULL,
  `ref_designation_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_email_ids`
--

INSERT INTO `supplier_email_ids` (`supplier_email_id`, `ref_supplier_id`, `primary_contact`, `email_id`, `contact_person`, `ref_designation_id`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(39, 21, 1, 'test@gmail.com', 'Chandru', 26, 1, 0, 0, '2018-07-28 13:02:42'),
(79, 22, 1, 'sigmatestacct@gmail.com', 'Chandru', 2, 0, 0, 0, '2018-08-29 16:58:38'),
(80, 22, 0, 'sigmatestacct@gmail.com', 'vani', 5, 0, 0, 0, '2018-08-29 16:58:38'),
(84, 23, 1, 'sigmatestacct@gmail.com', 'Chandru', 5, 1, 0, 0, '2018-08-30 12:40:06'),
(85, 23, 0, 'sigmatestacct@gmail.com', 'Chandru 123', 4, 1, 0, 0, '2018-08-30 12:40:06'),
(86, 24, 1, 'sigmatestacct@gmail.com', 'Banu', 24, 1, 0, 0, '2018-08-31 13:59:26'),
(87, 25, 1, 'sundhar@sundhar.com', 'S', 1, 1, 0, 0, '2018-09-01 12:04:32'),
(99, 39, 1, '', '', 13, 0, 0, 0, '2018-11-14 15:00:48'),
(100, 29, 1, '', '', 13, 0, 0, 0, '2018-11-14 15:00:59'),
(101, 27, 1, '', '', 13, 0, 0, 0, '2018-11-14 15:01:11'),
(102, 26, 1, '', '', 13, 0, 0, 0, '2018-11-14 15:01:27'),
(105, 40, 1, '', '', 21, 0, 0, 0, '2018-11-23 11:29:48'),
(107, 31, 1, '', '', 21, 1, 0, 0, '2018-11-26 18:01:39'),
(108, 38, 1, '', '', 21, 0, 0, 0, '2018-11-27 10:45:34'),
(109, 37, 1, '', '', 21, 0, 0, 0, '2018-11-27 10:47:44'),
(110, 36, 1, 'nagaamarketings@gmail.com', '', 21, 0, 0, 0, '2018-11-27 10:56:33'),
(111, 30, 1, 'customercare.india@habasit.com', '', 13, 0, 0, 0, '2018-11-27 11:12:00'),
(113, 41, 1, '', '', 21, 0, 0, 0, '2018-12-05 15:38:22'),
(114, 28, 1, 'sales@autotex.net', '', 13, 0, 0, 0, '2018-12-05 18:09:59'),
(115, 42, 1, 'accounts@unirolstex.com', '', 21, 0, 0, 0, '2018-12-29 15:08:37'),
(116, 43, 1, '', '', 21, 0, 0, 0, '2019-01-02 15:17:04'),
(117, 44, 1, '', '', 21, 0, 0, 0, '2019-01-02 17:32:45'),
(118, 45, 1, '', '', 21, 0, 0, 0, '2019-01-04 12:32:06'),
(119, 46, 1, '', '', 21, 0, 0, 0, '2019-01-04 15:34:08'),
(121, 47, 1, '', '', 21, 0, 0, 0, '2019-01-08 13:25:08'),
(122, 34, 1, 'jumac@foglagroup.com', '', 21, 1, 0, 0, '2019-01-30 16:29:56'),
(123, 48, 1, '', '', 21, 0, 0, 0, '2019-02-01 13:19:36');

-- --------------------------------------------------------

--
-- Table structure for table `table_backup`
--

CREATE TABLE `table_backup` (
  `table_backup_id` int(11) NOT NULL,
  `table_backup_name` varchar(200) NOT NULL COMMENT 'File Name',
  `delete_status` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'Date'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_backup`
--

INSERT INTO `table_backup` (`table_backup_id`, `table_backup_name`, `delete_status`, `ref_user_id`, `transaction_id`, `added_date`) VALUES
(1, 'avcef_ci_1568098949.gz', 0, 1, 0, '2019-09-10 12:32:29'),
(2, 'avcef_ci_1574138997.gz', 0, 1, 0, '2019-11-19 10:19:57'),
(3, 'zetta_ayurveda_1597640626.gz', 0, 1, 0, '2020-08-17 10:33:46'),
(4, 'zetta_ayurveda_1597641227.gz', 0, 1, 0, '2020-08-17 10:43:47'),
(5, 'zetta_ayurveda_1599630149.gz', 0, 1, 0, '2020-09-09 11:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `temp_product`
--

CREATE TABLE `temp_product` (
  `temp_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL DEFAULT 0,
  `ref_user_id` int(11) NOT NULL DEFAULT 0,
  `delete_status` int(1) NOT NULL DEFAULT 0,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_product`
--

INSERT INTO `temp_product` (`temp_product_id`, `product_id`, `quantity`, `customer_id`, `transaction_id`, `ref_user_id`, `delete_status`, `added_date`) VALUES
(1, 554, 2, 11, 0, 0, 0, '0000-00-00 00:00:00'),
(2, 557, 1, 11, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 562, 1, 11, 0, 0, 0, '0000-00-00 00:00:00'),
(4, 561, 1, 11, 0, 0, 0, '0000-00-00 00:00:00'),
(5, 560, 1, 11, 0, 0, 0, '0000-00-00 00:00:00'),
(6, 561, 10, 12, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` tinyint(4) NOT NULL,
  `ref_branch_id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL COMMENT 'User Name',
  `full_name` varchar(100) NOT NULL,
  `nick_name` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `original_password` varchar(25) NOT NULL,
  `imei_no` varchar(50) NOT NULL,
  `ref_user_group_id` int(11) NOT NULL,
  `audit_record` int(1) NOT NULL,
  `session_time_limit` int(11) NOT NULL,
  `reminder_interval_time` int(11) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL,
  `last_login_time` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `ref_branch_id`, `user_name`, `full_name`, `nick_name`, `email`, `password`, `original_password`, `imei_no`, `ref_user_group_id`, `audit_record`, `session_time_limit`, `reminder_interval_time`, `user_image`, `login_time`, `last_login_time`, `status`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 1, 'sadmin', 'Super Admin', 'sadmin', 'sigmatestacct@gmail.com', 'c5edac1b8c1d58bad90a246d8f08f53b', '', '', 0, 0, 0, 0, 'uploads/profile_images/1596042096_11_random-avatar7.jpg', '2022-06-13 13:45:01', '2022-06-13 13:18:12', 1, 0, 0, '2020-07-29 22:31:36'),
(2, 1, 'webadmin', 'Web Admin', 'Web Admin', '', 'add6bb58e139be103324d04d82d8f545', '', '', 0, 0, 0, 0, '', '2019-09-11 15:20:11', '2017-09-14 07:44:44', 1, 0, 0, '2017-09-14 06:57:53'),
(3, 1, 'admin', 'Admininstrator', 'admin', 'ayurveda@gmail.com', 'eb22b719d4fecdcaed0da8fd033c4089', '', '868143027705895', 0, 0, 0, 0, 'uploads/profile_images/1596731404_187_random-avatar7.jpg', '2021-09-18 21:49:09', '2021-09-18 15:40:39', 1, 0, 0, '2020-08-06 22:00:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `user_activity_id` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL COMMENT 'User',
  `user_activity_key` varchar(20) NOT NULL COMMENT 'Activity Key',
  `user_activity_data` text NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`user_activity_id`, `ref_user_id`, `user_activity_key`, `user_activity_data`, `delete_status`, `transaction_id`, `added_date`) VALUES
(1, 1, 'supplier_add', '37', 0, 0, '2022-06-13 14:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_dashboard_block`
--

CREATE TABLE `user_dashboard_block` (
  `user_dashboard_block_id` int(11) NOT NULL,
  `ref_dashboard_block_id` int(11) NOT NULL,
  `column_width` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `ref_active_status_id` int(11) NOT NULL DEFAULT 1,
  `ref_user_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_dashboard_block`
--

INSERT INTO `user_dashboard_block` (`user_dashboard_block_id`, `ref_dashboard_block_id`, `column_width`, `sort_order`, `ref_active_status_id`, `ref_user_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(168, 9, 6, 11, 1, 28, 0, 0, '0000-00-00 00:00:00'),
(167, 5, 12, 6, 1, 28, 0, 0, '0000-00-00 00:00:00'),
(334, 20, 12, 1, 1, 27, 0, 0, '0000-00-00 00:00:00'),
(333, 10, 6, 12, 1, 27, 0, 0, '0000-00-00 00:00:00'),
(332, 9, 6, 11, 1, 27, 0, 0, '0000-00-00 00:00:00'),
(331, 5, 12, 6, 1, 27, 0, 0, '0000-00-00 00:00:00'),
(324, 20, 12, 1, 1, 25, 0, 0, '0000-00-00 00:00:00'),
(323, 10, 6, 12, 1, 25, 0, 0, '0000-00-00 00:00:00'),
(322, 9, 6, 11, 1, 25, 0, 0, '0000-00-00 00:00:00'),
(321, 5, 12, 6, 1, 25, 0, 0, '0000-00-00 00:00:00'),
(158, 0, 12, 4, 1, 1, 0, 0, '2018-07-07 11:21:13'),
(157, 10, 12, 3, 1, 1, 0, 0, '0000-00-00 00:00:00'),
(156, 9, 6, 7, 1, 1, 0, 0, '2018-11-19 18:41:18'),
(155, 5, 12, 1, 1, 1, 0, 0, '2018-11-14 16:26:16'),
(170, 0, 12, 1, 1, 28, 0, 0, '0000-00-00 00:00:00'),
(169, 10, 6, 12, 1, 28, 0, 0, '0000-00-00 00:00:00'),
(171, 0, 12, 1, 1, 1, 0, 0, '2018-07-05 18:06:30'),
(172, 0, 12, 1, 1, 2, 0, 0, '2018-07-05 18:06:30'),
(320, 10, 6, 12, 1, 3, 0, 0, '0000-00-00 00:00:00'),
(174, 20, 12, 6, 1, 1, 0, 0, '2018-11-14 16:26:16'),
(175, 20, 12, 1, 1, 2, 0, 0, '2018-07-05 18:06:48'),
(319, 9, 6, 11, 1, 3, 0, 0, '0000-00-00 00:00:00'),
(177, 5, 12, 6, 1, 4, 0, 0, '0000-00-00 00:00:00'),
(178, 9, 6, 11, 1, 4, 0, 0, '0000-00-00 00:00:00'),
(179, 10, 6, 12, 1, 4, 0, 0, '0000-00-00 00:00:00'),
(180, 0, 12, 1, 1, 4, 0, 0, '0000-00-00 00:00:00'),
(181, 0, 12, 1, 1, 4, 0, 0, '0000-00-00 00:00:00'),
(182, 20, 12, 1, 1, 4, 0, 0, '0000-00-00 00:00:00'),
(183, 21, 12, 3, 1, 1, 0, 0, '2018-11-14 16:26:16'),
(184, 21, 12, 1, 1, 2, 0, 0, '2018-07-06 15:55:40'),
(318, 5, 12, 6, 1, 3, 0, 0, '0000-00-00 00:00:00'),
(186, 21, 12, 1, 1, 4, 0, 0, '2018-07-06 15:55:40'),
(187, 22, 12, 5, 1, 1, 0, 0, '2018-11-14 16:26:16'),
(188, 22, 12, 2, 1, 2, 0, 0, '2018-07-07 11:19:53'),
(317, 13, 12, 1, 1, 3, 0, 0, '0000-00-00 00:00:00'),
(190, 22, 12, 2, 1, 4, 0, 0, '2018-07-07 11:19:53'),
(191, 23, 12, 2, 1, 1, 0, 0, '2018-11-14 16:26:16'),
(192, 23, 12, 1, 1, 2, 0, 0, '2018-07-31 09:29:29'),
(316, 25, 12, 2, 1, 3, 0, 0, '0000-00-00 00:00:00'),
(194, 23, 12, 1, 1, 4, 0, 0, '2018-07-31 09:29:29'),
(195, 24, 12, 4, 1, 1, 0, 0, '2018-11-14 16:26:16'),
(196, 24, 12, 1, 1, 2, 0, 0, '2018-08-20 16:41:03'),
(315, 24, 12, 1, 1, 3, 0, 0, '0000-00-00 00:00:00'),
(198, 24, 12, 1, 1, 4, 0, 0, '2018-08-20 16:41:03'),
(199, 5, 12, 6, 1, 5, 0, 0, '0000-00-00 00:00:00'),
(200, 9, 6, 11, 1, 5, 0, 0, '0000-00-00 00:00:00'),
(201, 10, 6, 12, 1, 5, 0, 0, '0000-00-00 00:00:00'),
(202, 13, 12, 1, 1, 5, 0, 0, '0000-00-00 00:00:00'),
(203, 20, 12, 3, 1, 5, 0, 0, '2018-08-20 16:51:40'),
(204, 21, 12, 4, 1, 5, 0, 0, '2018-08-20 16:51:40'),
(205, 22, 12, 2, 1, 5, 0, 0, '2018-08-20 16:51:40'),
(206, 23, 12, 1, 1, 5, 0, 0, '0000-00-00 00:00:00'),
(207, 24, 12, 1, 1, 5, 0, 0, '2018-08-20 16:51:40'),
(208, 5, 12, 7, 1, 16, 0, 0, '2019-02-08 13:00:41'),
(209, 9, 6, 8, 1, 16, 0, 0, '2019-02-08 13:00:41'),
(210, 10, 6, 12, 1, 16, 0, 0, '0000-00-00 00:00:00'),
(211, 13, 12, 4, 1, 16, 0, 0, '2019-02-08 13:00:41'),
(212, 20, 12, 5, 1, 16, 0, 0, '2019-02-08 13:00:41'),
(213, 21, 12, 2, 2, 16, 0, 0, '2018-11-22 10:53:00'),
(214, 22, 12, 1, 1, 16, 0, 0, '2019-02-08 13:00:41'),
(215, 23, 12, 6, 1, 16, 0, 0, '2019-02-08 13:00:41'),
(216, 24, 12, 3, 1, 16, 0, 0, '2019-02-08 13:00:41'),
(217, 5, 12, 6, 1, 17, 0, 0, '0000-00-00 00:00:00'),
(218, 9, 6, 11, 1, 17, 0, 0, '0000-00-00 00:00:00'),
(219, 10, 6, 12, 1, 17, 0, 0, '0000-00-00 00:00:00'),
(220, 13, 12, 1, 1, 17, 0, 0, '0000-00-00 00:00:00'),
(221, 20, 12, 1, 1, 17, 0, 0, '0000-00-00 00:00:00'),
(222, 21, 12, 1, 1, 17, 0, 0, '0000-00-00 00:00:00'),
(223, 22, 12, 2, 1, 17, 0, 0, '2018-10-08 16:51:23'),
(224, 23, 12, 1, 1, 17, 0, 0, '0000-00-00 00:00:00'),
(225, 24, 12, 1, 1, 17, 0, 0, '0000-00-00 00:00:00'),
(226, 5, 12, 6, 1, 18, 0, 0, '0000-00-00 00:00:00'),
(227, 9, 6, 11, 1, 18, 0, 0, '0000-00-00 00:00:00'),
(228, 10, 6, 12, 1, 18, 0, 0, '0000-00-00 00:00:00'),
(229, 13, 12, 1, 1, 18, 0, 0, '0000-00-00 00:00:00'),
(230, 20, 12, 1, 1, 18, 0, 0, '0000-00-00 00:00:00'),
(231, 21, 12, 1, 1, 18, 0, 0, '0000-00-00 00:00:00'),
(232, 22, 8, 2, 1, 18, 0, 0, '0000-00-00 00:00:00'),
(233, 23, 12, 1, 1, 18, 0, 0, '0000-00-00 00:00:00'),
(234, 24, 12, 1, 1, 18, 0, 0, '0000-00-00 00:00:00'),
(235, 5, 12, 1, 1, 19, 0, 0, '2018-11-14 17:12:05'),
(236, 9, 6, 11, 1, 19, 0, 0, '0000-00-00 00:00:00'),
(237, 10, 6, 12, 1, 19, 0, 0, '0000-00-00 00:00:00'),
(238, 13, 12, 4, 1, 19, 0, 0, '2018-11-14 17:12:05'),
(239, 20, 12, 5, 1, 19, 0, 0, '2018-11-14 17:12:05'),
(240, 21, 12, 2, 1, 19, 0, 0, '2018-11-14 17:12:05'),
(241, 22, 8, 2, 1, 19, 0, 0, '0000-00-00 00:00:00'),
(242, 23, 12, 1, 1, 19, 0, 0, '0000-00-00 00:00:00'),
(243, 24, 12, 3, 1, 19, 0, 0, '2018-11-14 17:12:05'),
(244, 5, 12, 6, 1, 20, 0, 0, '0000-00-00 00:00:00'),
(245, 9, 6, 11, 1, 20, 0, 0, '0000-00-00 00:00:00'),
(246, 10, 6, 12, 1, 20, 0, 0, '0000-00-00 00:00:00'),
(247, 13, 12, 1, 1, 20, 0, 0, '0000-00-00 00:00:00'),
(248, 20, 12, 1, 1, 20, 0, 0, '0000-00-00 00:00:00'),
(249, 21, 12, 1, 1, 20, 0, 0, '0000-00-00 00:00:00'),
(250, 22, 8, 2, 1, 20, 0, 0, '0000-00-00 00:00:00'),
(251, 23, 12, 1, 1, 20, 0, 0, '0000-00-00 00:00:00'),
(252, 24, 12, 1, 1, 20, 0, 0, '0000-00-00 00:00:00'),
(253, 5, 12, 6, 1, 21, 0, 0, '0000-00-00 00:00:00'),
(254, 9, 6, 11, 1, 21, 0, 0, '0000-00-00 00:00:00'),
(255, 10, 6, 12, 1, 21, 0, 0, '0000-00-00 00:00:00'),
(256, 13, 12, 1, 1, 21, 0, 0, '0000-00-00 00:00:00'),
(257, 20, 12, 1, 1, 21, 0, 0, '0000-00-00 00:00:00'),
(258, 21, 12, 1, 1, 21, 0, 0, '0000-00-00 00:00:00'),
(259, 22, 8, 2, 1, 21, 0, 0, '0000-00-00 00:00:00'),
(260, 23, 12, 1, 1, 21, 0, 0, '0000-00-00 00:00:00'),
(261, 24, 12, 1, 1, 21, 0, 0, '0000-00-00 00:00:00'),
(262, 25, 12, 2, 1, 16, 0, 0, '2019-02-08 13:00:41'),
(263, 25, 12, 2, 1, 17, 0, 0, '2018-11-22 13:27:41'),
(264, 25, 12, 2, 1, 18, 0, 0, '2018-11-22 13:27:41'),
(265, 25, 12, 2, 1, 19, 0, 0, '2018-11-22 13:27:41'),
(266, 25, 12, 2, 1, 20, 0, 0, '2018-11-22 13:27:41'),
(267, 25, 12, 2, 1, 21, 0, 0, '2018-11-22 13:27:41'),
(268, 25, 12, 2, 1, 1, 0, 0, '2018-11-22 13:27:41'),
(269, 25, 12, 2, 1, 2, 0, 0, '2018-11-22 13:27:41'),
(314, 23, 12, 1, 1, 3, 0, 0, '0000-00-00 00:00:00'),
(300, 13, 12, 1, 1, 22, 0, 0, '0000-00-00 00:00:00'),
(299, 25, 12, 2, 1, 22, 0, 0, '0000-00-00 00:00:00'),
(298, 24, 12, 1, 1, 22, 0, 0, '0000-00-00 00:00:00'),
(297, 23, 12, 1, 1, 22, 0, 0, '0000-00-00 00:00:00'),
(296, 22, 8, 2, 1, 22, 0, 0, '0000-00-00 00:00:00'),
(295, 21, 12, 1, 1, 22, 0, 0, '0000-00-00 00:00:00'),
(294, 20, 12, 1, 1, 22, 0, 0, '0000-00-00 00:00:00'),
(293, 10, 6, 12, 1, 22, 0, 0, '0000-00-00 00:00:00'),
(292, 9, 6, 11, 1, 22, 0, 0, '0000-00-00 00:00:00'),
(291, 5, 12, 6, 1, 22, 0, 0, '0000-00-00 00:00:00'),
(313, 22, 8, 2, 1, 3, 0, 0, '0000-00-00 00:00:00'),
(312, 21, 12, 1, 1, 3, 0, 0, '0000-00-00 00:00:00'),
(311, 20, 12, 1, 1, 3, 0, 0, '0000-00-00 00:00:00'),
(325, 21, 12, 1, 1, 25, 0, 0, '0000-00-00 00:00:00'),
(326, 22, 8, 2, 1, 25, 0, 0, '0000-00-00 00:00:00'),
(327, 23, 12, 1, 1, 25, 0, 0, '0000-00-00 00:00:00'),
(328, 24, 12, 1, 1, 25, 0, 0, '0000-00-00 00:00:00'),
(329, 25, 12, 2, 1, 25, 0, 0, '0000-00-00 00:00:00'),
(330, 13, 12, 1, 1, 25, 0, 0, '0000-00-00 00:00:00'),
(335, 21, 12, 1, 1, 27, 0, 0, '0000-00-00 00:00:00'),
(336, 22, 8, 2, 1, 27, 0, 0, '0000-00-00 00:00:00'),
(337, 23, 12, 1, 1, 27, 0, 0, '0000-00-00 00:00:00'),
(338, 24, 12, 1, 1, 27, 0, 0, '0000-00-00 00:00:00'),
(339, 25, 12, 2, 1, 27, 0, 0, '0000-00-00 00:00:00'),
(340, 13, 12, 1, 1, 27, 0, 0, '0000-00-00 00:00:00'),
(341, 5, 12, 6, 1, 42, 0, 0, '0000-00-00 00:00:00'),
(342, 9, 6, 11, 1, 42, 0, 0, '0000-00-00 00:00:00'),
(343, 10, 6, 12, 1, 42, 0, 0, '0000-00-00 00:00:00'),
(344, 20, 12, 1, 1, 42, 0, 0, '0000-00-00 00:00:00'),
(345, 21, 12, 1, 1, 42, 0, 0, '0000-00-00 00:00:00'),
(346, 22, 8, 2, 1, 42, 0, 0, '0000-00-00 00:00:00'),
(347, 23, 12, 1, 1, 42, 0, 0, '0000-00-00 00:00:00'),
(348, 24, 12, 1, 1, 42, 0, 0, '0000-00-00 00:00:00'),
(349, 25, 12, 2, 1, 42, 0, 0, '0000-00-00 00:00:00'),
(350, 13, 12, 1, 1, 42, 0, 0, '0000-00-00 00:00:00'),
(351, 5, 12, 6, 1, 43, 0, 0, '0000-00-00 00:00:00'),
(352, 9, 6, 11, 1, 43, 0, 0, '0000-00-00 00:00:00'),
(353, 10, 6, 12, 1, 43, 0, 0, '0000-00-00 00:00:00'),
(354, 20, 12, 1, 1, 43, 0, 0, '0000-00-00 00:00:00'),
(355, 21, 12, 1, 1, 43, 0, 0, '0000-00-00 00:00:00'),
(356, 22, 8, 2, 1, 43, 0, 0, '0000-00-00 00:00:00'),
(357, 23, 12, 1, 1, 43, 0, 0, '0000-00-00 00:00:00'),
(358, 24, 12, 1, 1, 43, 0, 0, '0000-00-00 00:00:00'),
(359, 25, 12, 2, 1, 43, 0, 0, '0000-00-00 00:00:00'),
(360, 13, 12, 1, 1, 43, 0, 0, '0000-00-00 00:00:00'),
(400, 13, 12, 1, 1, 44, 0, 0, '0000-00-00 00:00:00'),
(399, 25, 12, 2, 1, 44, 0, 0, '0000-00-00 00:00:00'),
(398, 24, 12, 1, 1, 44, 0, 0, '0000-00-00 00:00:00'),
(397, 23, 12, 1, 1, 44, 0, 0, '0000-00-00 00:00:00'),
(396, 22, 8, 2, 1, 44, 0, 0, '0000-00-00 00:00:00'),
(395, 21, 12, 1, 1, 44, 0, 0, '0000-00-00 00:00:00'),
(394, 20, 12, 1, 1, 44, 0, 0, '0000-00-00 00:00:00'),
(393, 10, 6, 12, 1, 44, 0, 0, '0000-00-00 00:00:00'),
(392, 9, 6, 11, 1, 44, 0, 0, '0000-00-00 00:00:00'),
(391, 5, 12, 6, 1, 44, 0, 0, '0000-00-00 00:00:00'),
(371, 5, 12, 6, 1, 47, 0, 0, '0000-00-00 00:00:00'),
(372, 9, 6, 11, 1, 47, 0, 0, '0000-00-00 00:00:00'),
(373, 10, 6, 12, 1, 47, 0, 0, '0000-00-00 00:00:00'),
(374, 20, 12, 1, 1, 47, 0, 0, '0000-00-00 00:00:00'),
(375, 21, 12, 1, 1, 47, 0, 0, '0000-00-00 00:00:00'),
(376, 22, 8, 2, 1, 47, 0, 0, '0000-00-00 00:00:00'),
(377, 23, 12, 1, 1, 47, 0, 0, '0000-00-00 00:00:00'),
(378, 24, 12, 1, 1, 47, 0, 0, '0000-00-00 00:00:00'),
(379, 25, 12, 2, 1, 47, 0, 0, '0000-00-00 00:00:00'),
(380, 13, 12, 1, 1, 47, 0, 0, '0000-00-00 00:00:00'),
(381, 5, 12, 6, 1, 52, 0, 0, '0000-00-00 00:00:00'),
(382, 9, 6, 11, 1, 52, 0, 0, '0000-00-00 00:00:00'),
(383, 10, 6, 12, 1, 52, 0, 0, '0000-00-00 00:00:00'),
(384, 20, 12, 1, 1, 52, 0, 0, '0000-00-00 00:00:00'),
(385, 21, 12, 1, 1, 52, 0, 0, '0000-00-00 00:00:00'),
(386, 22, 8, 2, 1, 52, 0, 0, '0000-00-00 00:00:00'),
(387, 23, 12, 1, 1, 52, 0, 0, '0000-00-00 00:00:00'),
(388, 24, 12, 1, 1, 52, 0, 0, '0000-00-00 00:00:00'),
(389, 25, 12, 2, 1, 52, 0, 0, '0000-00-00 00:00:00'),
(390, 13, 12, 1, 1, 52, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `user_group_id` int(11) NOT NULL,
  `user_group_name` varchar(100) NOT NULL,
  `permission` text NOT NULL,
  `delete_status` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_group_id`, `user_group_name`, `permission`, `delete_status`, `user_id`, `transaction_id`, `added_date`) VALUES
(1, 'Sadmin', 'a:70:{s:8:\"accounts\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:12:\"adminsetting\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:12:\"announcement\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:6:\"client\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:7:\"company\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:8:\"customer\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:14:\"customer_order\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:9:\"dashboard\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:8:\"employee\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:12:\"employee_old\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:4:\"home\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:7:\"invoice\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:4:\"lead\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:5:\"login\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:6:\"master\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:7:\"patient\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:7:\"product\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:22:\"product_sample_request\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:23:\"product_sample_request1\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:14:\"purchase_order\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:8:\"reminder\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:6:\"report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:8:\"supplier\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:4:\"user\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:9:\"usergroup\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:10:\"module_key\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:15:\"dashboard_block\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:13:\"quantity_type\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:8:\"category\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:30:\"product_request_email_template\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:11:\"designation\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:11:\"backuptable\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:11:\"updatetable\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:7:\"userlog\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:8:\"errorlog\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:12:\"useractivity\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:4:\"menu\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:13:\"lead_reminder\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:15:\"client_reminder\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:8:\"leadcall\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:7:\"leadapp\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:10:\"clientcall\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:9:\"clientapp\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:11:\"clientvisit\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:21:\"client_visit_reminder\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:20:\"client_visit_comment\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:15:\"product_quality\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:20:\"product_quality_size\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:14:\"delivery_point\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:22:\"product_request_status\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:25:\"product_feedback_reminder\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:15:\"overall_summary\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:16:\"delivery_challan\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:16:\"proforma_invoice\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:27:\"client_outstanding_reminder\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:25:\"import_client_outstanding\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:16:\"pending_proforma\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:14:\"payment_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:18:\"payment_collection\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:13:\"gender_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:10:\"age_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:16:\"diagnosis_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:18:\"m_diagnosis_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:15:\"m_system_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:16:\"treatment_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:16:\"reference_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:12:\"sales_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:25:\"product_wise_sales_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:25:\"patient_wise_sales_report\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";}s:20:\"product_stock_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}}', 0, 1, 0, '0000-00-00 00:00:00'),
(7, 'Accounts', 'a:2:{s:8:\"accounts\";a:6:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:9:\"dashboard\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}}', 0, 1, 0, '2020-08-27 22:14:52'),
(3, 'Admin', 'a:57:{s:8:\"accounts\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:12:\"announcement\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:6:\"client\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:7:\"company\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:8:\"customer\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:14:\"customer_order\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:9:\"dashboard\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:8:\"employee\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:4:\"home\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:7:\"invoice\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:4:\"lead\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:5:\"login\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:6:\"master\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:7:\"patient\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:7:\"product\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:22:\"product_sample_request\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:14:\"purchase_order\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:6:\"report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:8:\"supplier\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:13:\"quantity_type\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:11:\"backuptable\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:11:\"updatetable\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:7:\"userlog\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:8:\"errorlog\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:12:\"useractivity\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:4:\"menu\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:13:\"lead_reminder\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:15:\"client_reminder\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:8:\"leadcall\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:7:\"leadapp\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:10:\"clientcall\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:9:\"clientapp\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:11:\"clientvisit\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:21:\"client_visit_reminder\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:20:\"client_visit_comment\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:15:\"product_quality\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:20:\"product_quality_size\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:14:\"delivery_point\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:22:\"product_request_status\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:25:\"product_feedback_reminder\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:15:\"overall_summary\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:16:\"delivery_challan\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:16:\"proforma_invoice\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:27:\"client_outstanding_reminder\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:25:\"import_client_outstanding\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:16:\"pending_proforma\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:13:\"gender_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:10:\"age_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:16:\"diagnosis_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:18:\"m_diagnosis_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:15:\"m_system_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:16:\"treatment_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:16:\"reference_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:12:\"sales_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:25:\"product_wise_sales_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:25:\"patient_wise_sales_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:20:\"product_stock_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}}', 0, 1, 0, '2017-09-14 07:14:59'),
(2, 'Web Admin', 'a:3:{s:13:\"advertisement\";a:4:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";}s:9:\"dashboard\";a:3:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";}s:8:\"reminder\";a:3:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";}}', 0, 1, 0, '2015-12-07 18:54:58'),
(8, 'Purchase Order', 'a:56:{s:8:\"accounts\";a:1:{s:6:\"delete\";s:1:\"1\";}s:12:\"adminsetting\";a:1:{s:6:\"delete\";s:1:\"1\";}s:12:\"announcement\";a:1:{s:6:\"delete\";s:1:\"1\";}s:6:\"client\";a:1:{s:6:\"delete\";s:1:\"1\";}s:7:\"company\";a:1:{s:6:\"delete\";s:1:\"1\";}s:8:\"customer\";a:1:{s:6:\"delete\";s:1:\"1\";}s:9:\"dashboard\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:8:\"employee\";a:1:{s:6:\"delete\";s:1:\"1\";}s:12:\"employee_old\";a:1:{s:6:\"delete\";s:1:\"1\";}s:4:\"home\";a:1:{s:6:\"delete\";s:1:\"1\";}s:7:\"invoice\";a:1:{s:6:\"delete\";s:1:\"1\";}s:4:\"lead\";a:1:{s:6:\"delete\";s:1:\"1\";}s:5:\"login\";a:1:{s:6:\"delete\";s:1:\"1\";}s:6:\"master\";a:1:{s:6:\"delete\";s:1:\"1\";}s:5:\"order\";a:1:{s:6:\"delete\";s:1:\"1\";}s:7:\"patient\";a:1:{s:6:\"delete\";s:1:\"1\";}s:7:\"product\";a:1:{s:6:\"delete\";s:1:\"1\";}s:22:\"product_sample_request\";a:1:{s:6:\"delete\";s:1:\"1\";}s:14:\"purchase_order\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:8:\"reminder\";a:1:{s:6:\"delete\";s:1:\"1\";}s:6:\"report\";a:1:{s:6:\"delete\";s:1:\"1\";}s:8:\"supplier\";a:1:{s:6:\"delete\";s:1:\"1\";}s:4:\"user\";a:1:{s:6:\"delete\";s:1:\"1\";}s:9:\"usergroup\";a:1:{s:6:\"delete\";s:1:\"1\";}s:10:\"module_key\";a:1:{s:6:\"delete\";s:1:\"1\";}s:15:\"dashboard_block\";a:1:{s:6:\"delete\";s:1:\"1\";}s:13:\"quantity_type\";a:1:{s:6:\"delete\";s:1:\"1\";}s:8:\"category\";a:1:{s:6:\"delete\";s:1:\"1\";}s:30:\"product_request_email_template\";a:1:{s:6:\"delete\";s:1:\"1\";}s:11:\"designation\";a:1:{s:6:\"delete\";s:1:\"1\";}s:11:\"backuptable\";a:1:{s:6:\"delete\";s:1:\"1\";}s:11:\"updatetable\";a:1:{s:6:\"delete\";s:1:\"1\";}s:7:\"userlog\";a:1:{s:6:\"delete\";s:1:\"1\";}s:8:\"errorlog\";a:1:{s:6:\"delete\";s:1:\"1\";}s:12:\"useractivity\";a:1:{s:6:\"delete\";s:1:\"1\";}s:4:\"menu\";a:1:{s:6:\"delete\";s:1:\"1\";}s:13:\"lead_reminder\";a:1:{s:6:\"delete\";s:1:\"1\";}s:15:\"client_reminder\";a:1:{s:6:\"delete\";s:1:\"1\";}s:8:\"leadcall\";a:1:{s:6:\"delete\";s:1:\"1\";}s:7:\"leadapp\";a:1:{s:6:\"delete\";s:1:\"1\";}s:10:\"clientcall\";a:1:{s:6:\"delete\";s:1:\"1\";}s:9:\"clientapp\";a:1:{s:6:\"delete\";s:1:\"1\";}s:11:\"clientvisit\";a:1:{s:6:\"delete\";s:1:\"1\";}s:21:\"client_visit_reminder\";a:1:{s:6:\"delete\";s:1:\"1\";}s:20:\"client_visit_comment\";a:1:{s:6:\"delete\";s:1:\"1\";}s:15:\"product_quality\";a:1:{s:6:\"delete\";s:1:\"1\";}s:20:\"product_quality_size\";a:1:{s:6:\"delete\";s:1:\"1\";}s:14:\"delivery_point\";a:1:{s:6:\"delete\";s:1:\"1\";}s:22:\"product_request_status\";a:1:{s:6:\"delete\";s:1:\"1\";}s:25:\"product_feedback_reminder\";a:1:{s:6:\"delete\";s:1:\"1\";}s:15:\"overall_summary\";a:1:{s:6:\"delete\";s:1:\"1\";}s:16:\"delivery_challan\";a:1:{s:6:\"delete\";s:1:\"1\";}s:16:\"proforma_invoice\";a:1:{s:6:\"delete\";s:1:\"1\";}s:27:\"client_outstanding_reminder\";a:1:{s:6:\"delete\";s:1:\"1\";}s:25:\"import_client_outstanding\";a:1:{s:6:\"delete\";s:1:\"1\";}s:16:\"pending_proforma\";a:1:{s:6:\"delete\";s:1:\"1\";}}', 0, 1, 0, '2020-08-27 22:15:42'),
(9, 'Sales', 'a:7:{s:9:\"dashboard\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:7:\"invoice\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:7:\"patient\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:6:\"report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:12:\"sales_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:25:\"product_wise_sales_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}s:20:\"product_stock_report\";a:7:{s:4:\"view\";s:1:\"1\";s:3:\"add\";s:1:\"1\";s:4:\"edit\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:5:\"excel\";s:1:\"1\";s:3:\"pdf\";s:1:\"1\";s:6:\"backup\";s:1:\"1\";}}', 0, 1, 0, '2020-08-27 22:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `user_to_group`
--

CREATE TABLE `user_to_group` (
  `user_to_group_id` int(11) NOT NULL,
  `ref_user_id` int(11) NOT NULL,
  `ref_user_group_id` int(11) NOT NULL,
  `delete_status` int(1) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_to_group`
--

INSERT INTO `user_to_group` (`user_to_group_id`, `ref_user_id`, `ref_user_group_id`, `delete_status`, `transaction_id`, `added_date`) VALUES
(27, 1, 1, 0, 0, '2016-03-22 18:06:08'),
(100, 3, 3, 0, 0, '2020-08-06 21:09:57'),
(71, 4, 4, 0, 0, '2018-08-30 18:52:07'),
(69, 5, 4, 0, 0, '2018-08-20 16:44:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts_code`
--
ALTER TABLE `accounts_code`
  ADD PRIMARY KEY (`accounts_code_id`),
  ADD UNIQUE KEY `accounts_code_id` (`accounts_code_id`);

--
-- Indexes for table `accounts_group`
--
ALTER TABLE `accounts_group`
  ADD PRIMARY KEY (`accounts_group_id`);

--
-- Indexes for table `accounts_transaction`
--
ALTER TABLE `accounts_transaction`
  ADD PRIMARY KEY (`accounts_transaction_id`);

--
-- Indexes for table `accounts_transaction_category`
--
ALTER TABLE `accounts_transaction_category`
  ADD PRIMARY KEY (`accounts_transaction_category_id`);

--
-- Indexes for table `accounts_transaction_type`
--
ALTER TABLE `accounts_transaction_type`
  ADD PRIMARY KEY (`accounts_transaction_type_id`);

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `active_status`
--
ALTER TABLE `active_status`
  ADD PRIMARY KEY (`active_status_id`);

--
-- Indexes for table `admin_setting`
--
ALTER TABLE `admin_setting`
  ADD PRIMARY KEY (`admin_setting_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `application_segment_type`
--
ALTER TABLE `application_segment_type`
  ADD PRIMARY KEY (`application_segment_type_id`);

--
-- Indexes for table `appointment_feedback`
--
ALTER TABLE `appointment_feedback`
  ADD PRIMARY KEY (`appointment_feedback_id`);

--
-- Indexes for table `appointment_reject_reason`
--
ALTER TABLE `appointment_reject_reason`
  ADD PRIMARY KEY (`appointment_reject_reason_id`);

--
-- Indexes for table `approve_status`
--
ALTER TABLE `approve_status`
  ADD PRIMARY KEY (`approve_status_id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `business_category`
--
ALTER TABLE `business_category`
  ADD PRIMARY KEY (`business_category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `consultant_fees`
--
ALTER TABLE `consultant_fees`
  ADD PRIMARY KEY (`consultant_fees_id`);

--
-- Indexes for table `contact_number_type`
--
ALTER TABLE `contact_number_type`
  ADD PRIMARY KEY (`contact_number_type_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`customer_order_id`);

--
-- Indexes for table `customer_order_product`
--
ALTER TABLE `customer_order_product`
  ADD PRIMARY KEY (`customer_order_product_id`);

--
-- Indexes for table `customer_product`
--
ALTER TABLE `customer_product`
  ADD PRIMARY KEY (`customer_product_id`);

--
-- Indexes for table `dashboard_block`
--
ALTER TABLE `dashboard_block`
  ADD PRIMARY KEY (`dashboard_block_id`);

--
-- Indexes for table `data_source`
--
ALTER TABLE `data_source`
  ADD PRIMARY KEY (`data_source_id`);

--
-- Indexes for table `delivery_challan`
--
ALTER TABLE `delivery_challan`
  ADD PRIMARY KEY (`delivery_challan_id`);

--
-- Indexes for table `delivery_challan_particulars`
--
ALTER TABLE `delivery_challan_particulars`
  ADD PRIMARY KEY (`delivery_challan_particulars_id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `despatch_mode`
--
ALTER TABLE `despatch_mode`
  ADD PRIMARY KEY (`despatch_mode_id`);

--
-- Indexes for table `discount_type`
--
ALTER TABLE `discount_type`
  ADD PRIMARY KEY (`discount_type_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indexes for table `filter_opration`
--
ALTER TABLE `filter_opration`
  ADD PRIMARY KEY (`filter_opration_id`);

--
-- Indexes for table `general_reminder`
--
ALTER TABLE `general_reminder`
  ADD PRIMARY KEY (`general_reminder_id`);

--
-- Indexes for table `gst_type`
--
ALTER TABLE `gst_type`
  ADD PRIMARY KEY (`gst_type_id`);

--
-- Indexes for table `login_user_logs`
--
ALTER TABLE `login_user_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `module_key`
--
ALTER TABLE `module_key`
  ADD PRIMARY KEY (`module_key_id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`payment_history_id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`payment_status_id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `prescribed_products`
--
ALTER TABLE `prescribed_products`
  ADD PRIMARY KEY (`prescribed_products_id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`priority_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_batch`
--
ALTER TABLE `product_batch`
  ADD PRIMARY KEY (`product_batch_id`);

--
-- Indexes for table `product_group`
--
ALTER TABLE `product_group`
  ADD PRIMARY KEY (`product_group_id`);

--
-- Indexes for table `product_quality_size`
--
ALTER TABLE `product_quality_size`
  ADD PRIMARY KEY (`product_quality_size_id`);

--
-- Indexes for table `product_request_document`
--
ALTER TABLE `product_request_document`
  ADD PRIMARY KEY (`product_request_document_id`);

--
-- Indexes for table `product_request_status`
--
ALTER TABLE `product_request_status`
  ADD PRIMARY KEY (`product_request_status_id`);

--
-- Indexes for table `product_sample_request`
--
ALTER TABLE `product_sample_request`
  ADD PRIMARY KEY (`product_sample_request_id`);

--
-- Indexes for table `product_sample_request_particulars`
--
ALTER TABLE `product_sample_request_particulars`
  ADD PRIMARY KEY (`product_sample_request_particulars_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`purchase_order_id`);

--
-- Indexes for table `purchase_order_particulars`
--
ALTER TABLE `purchase_order_particulars`
  ADD PRIMARY KEY (`order_particulars_id`);

--
-- Indexes for table `quantity_type`
--
ALTER TABLE `quantity_type`
  ADD PRIMARY KEY (`quantity_type_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `reminder_history`
--
ALTER TABLE `reminder_history`
  ADD PRIMARY KEY (`reminder_history_id`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`reset_password_id`);

--
-- Indexes for table `salutation`
--
ALTER TABLE `salutation`
  ADD PRIMARY KEY (`salutation_id`);

--
-- Indexes for table `sample_request_category`
--
ALTER TABLE `sample_request_category`
  ADD PRIMARY KEY (`sample_request_category_id`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`specialization_id`);

--
-- Indexes for table `star_rating`
--
ALTER TABLE `star_rating`
  ADD PRIMARY KEY (`star_rating_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `stock_room`
--
ALTER TABLE `stock_room`
  ADD PRIMARY KEY (`stock_room_id`);

--
-- Indexes for table `stock_slot`
--
ALTER TABLE `stock_slot`
  ADD PRIMARY KEY (`stock_slot_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supplier_contact_numbers`
--
ALTER TABLE `supplier_contact_numbers`
  ADD PRIMARY KEY (`supplier_contact_id`);

--
-- Indexes for table `supplier_email_ids`
--
ALTER TABLE `supplier_email_ids`
  ADD PRIMARY KEY (`supplier_email_id`);

--
-- Indexes for table `table_backup`
--
ALTER TABLE `table_backup`
  ADD PRIMARY KEY (`table_backup_id`);

--
-- Indexes for table `temp_product`
--
ALTER TABLE `temp_product`
  ADD PRIMARY KEY (`temp_product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`user_activity_id`);

--
-- Indexes for table `user_dashboard_block`
--
ALTER TABLE `user_dashboard_block`
  ADD PRIMARY KEY (`user_dashboard_block_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- Indexes for table `user_to_group`
--
ALTER TABLE `user_to_group`
  ADD PRIMARY KEY (`user_to_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts_code`
--
ALTER TABLE `accounts_code`
  MODIFY `accounts_code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `accounts_group`
--
ALTER TABLE `accounts_group`
  MODIFY `accounts_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accounts_transaction`
--
ALTER TABLE `accounts_transaction`
  MODIFY `accounts_transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts_transaction_category`
--
ALTER TABLE `accounts_transaction_category`
  MODIFY `accounts_transaction_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `accounts_transaction_type`
--
ALTER TABLE `accounts_transaction_type`
  MODIFY `accounts_transaction_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `active_status`
--
ALTER TABLE `active_status`
  MODIFY `active_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_setting`
--
ALTER TABLE `admin_setting`
  MODIFY `admin_setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3534;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `application_segment_type`
--
ALTER TABLE `application_segment_type`
  MODIFY `application_segment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointment_feedback`
--
ALTER TABLE `appointment_feedback`
  MODIFY `appointment_feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointment_reject_reason`
--
ALTER TABLE `appointment_reject_reason`
  MODIFY `appointment_reject_reason_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `approve_status`
--
ALTER TABLE `approve_status`
  MODIFY `approve_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business_category`
--
ALTER TABLE `business_category`
  MODIFY `business_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT for table `consultant_fees`
--
ALTER TABLE `consultant_fees`
  MODIFY `consultant_fees_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_number_type`
--
ALTER TABLE `contact_number_type`
  MODIFY `contact_number_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2657;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `customer_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customer_order_product`
--
ALTER TABLE `customer_order_product`
  MODIFY `customer_order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `customer_product`
--
ALTER TABLE `customer_product`
  MODIFY `customer_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dashboard_block`
--
ALTER TABLE `dashboard_block`
  MODIFY `dashboard_block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `data_source`
--
ALTER TABLE `data_source`
  MODIFY `data_source_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_challan`
--
ALTER TABLE `delivery_challan`
  MODIFY `delivery_challan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `delivery_challan_particulars`
--
ALTER TABLE `delivery_challan_particulars`
  MODIFY `delivery_challan_particulars_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `despatch_mode`
--
ALTER TABLE `despatch_mode`
  MODIFY `despatch_mode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discount_type`
--
ALTER TABLE `discount_type`
  MODIFY `discount_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=672;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `filter_opration`
--
ALTER TABLE `filter_opration`
  MODIFY `filter_opration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `general_reminder`
--
ALTER TABLE `general_reminder`
  MODIFY `general_reminder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `gst_type`
--
ALTER TABLE `gst_type`
  MODIFY `gst_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_user_logs`
--
ALTER TABLE `login_user_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=448;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `module_key`
--
ALTER TABLE `module_key`
  MODIFY `module_key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `payment_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `payment_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prescribed_products`
--
ALTER TABLE `prescribed_products`
  MODIFY `prescribed_products_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `priority_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_batch`
--
ALTER TABLE `product_batch`
  MODIFY `product_batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_group`
--
ALTER TABLE `product_group`
  MODIFY `product_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_quality_size`
--
ALTER TABLE `product_quality_size`
  MODIFY `product_quality_size_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_request_document`
--
ALTER TABLE `product_request_document`
  MODIFY `product_request_document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_request_status`
--
ALTER TABLE `product_request_status`
  MODIFY `product_request_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_sample_request`
--
ALTER TABLE `product_sample_request`
  MODIFY `product_sample_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `product_sample_request_particulars`
--
ALTER TABLE `product_sample_request_particulars`
  MODIFY `product_sample_request_particulars_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_order_particulars`
--
ALTER TABLE `purchase_order_particulars`
  MODIFY `order_particulars_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quantity_type`
--
ALTER TABLE `quantity_type`
  MODIFY `quantity_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reminder_history`
--
ALTER TABLE `reminder_history`
  MODIFY `reminder_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `reset_password_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salutation`
--
ALTER TABLE `salutation`
  MODIFY `salutation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sample_request_category`
--
ALTER TABLE `sample_request_category`
  MODIFY `sample_request_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `specialization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `star_rating`
--
ALTER TABLE `star_rating`
  MODIFY `star_rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4225;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock_room`
--
ALTER TABLE `stock_room`
  MODIFY `stock_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_slot`
--
ALTER TABLE `stock_slot`
  MODIFY `stock_slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `supplier_contact_numbers`
--
ALTER TABLE `supplier_contact_numbers`
  MODIFY `supplier_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `supplier_email_ids`
--
ALTER TABLE `supplier_email_ids`
  MODIFY `supplier_email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `table_backup`
--
ALTER TABLE `table_backup`
  MODIFY `table_backup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `temp_product`
--
ALTER TABLE `temp_product`
  MODIFY `temp_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `user_activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_dashboard_block`
--
ALTER TABLE `user_dashboard_block`
  MODIFY `user_dashboard_block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_to_group`
--
ALTER TABLE `user_to_group`
  MODIFY `user_to_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
