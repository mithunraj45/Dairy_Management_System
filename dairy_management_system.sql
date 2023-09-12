-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 06:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dairy_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(100) NOT NULL,
  `admin_name` varchar(25) NOT NULL,
  `admin_details` varchar(250) NOT NULL,
  `admin_email_id` varchar(25) NOT NULL,
  `admin_handling_dept` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `tbl_id` int(11) NOT NULL,
  `tbl_email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `dept_id` int(100) NOT NULL,
  `dept_name` varchar(25) NOT NULL,
  `dept_mgr_ssn` varchar(100) DEFAULT NULL,
  `dept_mgr_date` date DEFAULT NULL,
  `dept_admin` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`dept_id`, `dept_name`, `dept_mgr_ssn`, `dept_mgr_date`, `dept_admin`) VALUES
(1, 'Milk Sociey', '120364789', '2023-06-06', 123),
(3, 'cleaning', '2669721248', '2022-11-05', 741),
(4, 'stocks', '3201547896', '2023-01-05', 654),
(7, 'supply', '7788445566', '2022-08-30', 741),
(8, 'Transportation', '1122445566', '2023-01-09', 215);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `emp_fname` varchar(25) NOT NULL,
  `emp_lname` char(1) NOT NULL,
  `emp_bdate` date NOT NULL,
  `emp_sex` char(1) NOT NULL,
  `emp_salary` int(100) NOT NULL,
  `emp_ssn` varchar(100) NOT NULL,
  `emp_joined_date` date DEFAULT NULL,
  `emp_email_id` varchar(25) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_image` varchar(100) NOT NULL,
  `emp_dept_no` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_fname`, `emp_lname`, `emp_bdate`, `emp_sex`, `emp_salary`, `emp_ssn`, `emp_joined_date`, `emp_email_id`, `emp_address`, `emp_image`, `emp_dept_no`) VALUES
('loith', 'h', '2022-12-01', 'm', 145, '1122445566', '2021-10-12', 'abc@gmail.com', 'bangalore', '2.jpg', 8),
('tharun', 'p', '2022-12-31', 'M', 10000, '120364789', '2021-11-30', 'tak@gmail.com', 'karnataka', 'IMG_20220419_122706_897.jpg', 8),
('Shashidar', 'q', '2022-12-01', 'm', 698, '1597536842', '2021-07-27', 'plo@gmail.com', 'banalore', '2.jpg', 8),
('Ashwini', 'h', '2022-12-01', 'm', 174, '2244556611', '2022-10-14', 'pqr@gmail.com', 'bangalore', '8.jpg', 4),
('Mithun', 'P', '2022-12-21', 'M', 125478, '254152478542', '2022-01-31', 'mithun@gmail.co', '2nd main 3cross attur layout yelahanka', '6.jpg', 8),
('Rocky', 'B', '2002-10-03', 'M', 50000, '2669721248', NULL, 'rocky@gmail.com', '2nd main 3cross attur layout yelahanka', '1.jpg', 3),
('ullas', 'n', '2022-12-22', 'M', 2154, '3015642879', '2020-12-17', 'ulas@gmail.com', 'karnataka', '6.jpg', 8),
('lak', 'm', '2022-12-22', 'F', 215487, '3201453698', '2021-05-28', 'lak@gmail.com', 'india', '7.jpg', 4),
('tharun', 'g', '2022-12-22', 'M', 21405, '3201547896', '2021-08-16', 'tk@gmail.com', 'karnataka', '9.jpg', 4),
('Ranganath', 'P', '2002-07-31', 'M', 20000, '6360623747', '2021-08-16', 'rang@gmail.com', 'Karanataka', '2.jpg', 1),
('Ranjitha', 'f', '2022-12-01', 'f', 245, '7788445566', '2022-01-01', 'qwe@gmail.com', 'bangalore', '7.jpg', 7),
('Swetha', 'C', '2022-12-01', 'F', 20124, '8452169370', '2022-01-01', 'sw@gmail.com', 'karnataka', '7.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(100) NOT NULL,
  `login_user_email` varchar(100) NOT NULL,
  `login_user_password` varchar(100) NOT NULL,
  `login_status` varchar(25) NOT NULL,
  `login_role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `login_user_email`, `login_user_password`, `login_status`, `login_role`) VALUES
(2, 'mithun@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Active', 'Admin'),
(3, '7892492891', '81dc9bdb52d04dc20036dbd8313ed055', 'Active', 'Store'),
(4, '6360623747', '81dc9bdb52d04dc20036dbd8313ed055', 'Active', 'Supplier'),
(5, '8553670702', '81dc9bdb52d04dc20036dbd8313ed055', 'Active', 'Store'),
(6, '6361544569', '81dc9bdb52d04dc20036dbd8313ed055', 'Active', 'Supplier'),
(7, 'ulas@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Active', 'Stocks Mgr'),
(8, 'tak@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Active', 'Delivery'),
(9, 'plo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Active', 'Delivery'),
(10, '6363028217', '81dc9bdb52d04dc20036dbd8313ed055', 'Active', 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_record`
--

CREATE TABLE `tbl_record` (
  `record_date` date NOT NULL,
  `record_month` varchar(25) NOT NULL,
  `daily_quantity` int(255) NOT NULL,
  `total_quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_record`
--

INSERT INTO `tbl_record` (`record_date`, `record_month`, `daily_quantity`, `total_quantity`) VALUES
('2023-01-02', 'Jan', 150, 150),
('2023-01-03', 'Jan', 250, 400),
('2023-01-04', 'Jan', 200, 455),
('2023-01-09', 'Jan', 105, 510);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report`
--

CREATE TABLE `tbl_report` (
  `report_id` int(11) NOT NULL,
  `report_name` varchar(25) NOT NULL,
  `report_information` varchar(1000) NOT NULL,
  `report_added` date NOT NULL,
  `report_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_report`
--

INSERT INTO `tbl_report` (`report_id`, `report_name`, `report_information`, `report_added`, `report_status`) VALUES
(1, 'Mithun', 'Delivery was not proper', '2023-01-04', 1),
(2, 'Ullas', 'Delivery was not proper', '2023-01-04', 0),
(3, 'Anjineeya', 'Delivery was not proper', '2023-01-04', 0),
(4, 'Mithun', 'cvdvsdfsdf', '2023-01-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_from_users`
--

CREATE TABLE `tbl_request_from_users` (
  `request_id` int(11) NOT NULL,
  `request_user_name` varchar(25) NOT NULL,
  `request_user_email` varchar(25) NOT NULL,
  `request_user_pno` int(250) NOT NULL,
  `request_user_address` varchar(35) NOT NULL,
  `request_user_subject` varchar(100) NOT NULL,
  `request_user_message` varchar(300) NOT NULL,
  `request_date_time` datetime DEFAULT NULL,
  `request_status` varchar(25) NOT NULL,
  `request_veiwed_by_mgr` varchar(100) DEFAULT NULL,
  `request_veiwed_date_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_request_from_users`
--

INSERT INTO `tbl_request_from_users` (`request_id`, `request_user_name`, `request_user_email`, `request_user_pno`, `request_user_address`, `request_user_subject`, `request_user_message`, `request_date_time`, `request_status`, `request_veiwed_by_mgr`, `request_veiwed_date_time`) VALUES
(2, 'Rakesh', 'rak@gmail.com', 2147483647, 'Karnataka', 'Requesting for products', 'I am a Farmer..I am not able to go for city and load to store...So i am thinking that i can have a good deal with u guys...', '2022-12-27 07:07:02', 'Active', 'Admin', '2023-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `tbl_slider_id` int(11) NOT NULL,
  `tbl_slider_value` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store`
--

CREATE TABLE `tbl_store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(25) NOT NULL,
  `store_address` varchar(250) NOT NULL,
  `store_pno` varchar(255) NOT NULL,
  `delivering_emp_ssn` varchar(100) DEFAULT NULL,
  `required_milk` int(100) NOT NULL,
  `added_mgr_ssn` varchar(100) DEFAULT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_store`
--

INSERT INTO `tbl_store` (`store_id`, `store_name`, `store_address`, `store_pno`, `delivering_emp_ssn`, `required_milk`, `added_mgr_ssn`, `added_date`) VALUES
(1, 'Ragavendra Condiments', '2nd main,3rd cross,attur layout ,yelahanka,bangalore-560064', '7892492891', '120364789', 25, 'Admin', '2022-12-27'),
(2, 'Thirumala Stores', 'store no-441,1st block,rajajinagar, bangalore', '8553670702', '1597536842', 50, 'Admin', '2022-12-27'),
(3, 'Sai Provissional Stores', 'St no-321,near vidya sagar school,vidyaranyapura,bangalore-560064', '6360623747', '120364789', 40, 'Admin', '2022-12-27'),
(4, 'Food Mart', 'st no-7,opposite to post office,nagasandra post,bangalore', '8754120369', '3015642879', 15, 'Admin', '2022-12-27'),
(5, 'Green Grocery', '2nd main,3rd cross thirumalla dabba,bangalore-560064', '8741520369', '1122445566', 30, 'Admin', '2022-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_transaction`
--

CREATE TABLE `tbl_store_transaction` (
  `trans_id` int(100) NOT NULL,
  `store_id` int(100) DEFAULT NULL,
  `deliverd_emp_ssn` varchar(100) DEFAULT NULL,
  `milk_quantity` int(100) NOT NULL,
  `trans_date` date NOT NULL,
  `store_verification` int(1) NOT NULL,
  `delivered_emp_verification` int(1) NOT NULL,
  `approved` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_store_transaction`
--

INSERT INTO `tbl_store_transaction` (`trans_id`, `store_id`, `deliverd_emp_ssn`, `milk_quantity`, `trans_date`, `store_verification`, `delivered_emp_verification`, `approved`) VALUES
(1, 1, '120364789', 25, '2023-01-01', 1, 1, 1),
(2, 1, '120364789', 25, '2023-01-02', 1, 1, 1),
(3, 1, '120364789', 25, '2022-12-15', 1, 1, 1),
(4, 2, '1597536842', 25, '2023-01-03', 1, 1, 1),
(5, 2, '1597536842', 25, '2023-01-03', 1, 1, 1),
(6, 1, '120364789', 25, '2023-01-03', 1, 1, 1),
(7, 2, '1597536842', 30, '2023-01-04', 1, 1, 1),
(8, 3, '120364789', 40, '2023-01-04', 0, 1, 0),
(9, 3, '120364789', 40, '2023-01-04', 0, 1, 0),
(10, 3, '120364789', 40, '2023-01-04', 0, 1, 0),
(11, 1, '120364789', 25, '2023-01-04', 1, 1, 1),
(12, 3, '120364789', 40, '2023-01-04', 0, 1, 0),
(13, 2, '1597536842', 50, '2023-01-09', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(25) NOT NULL,
  `supplier_pno` varchar(100) NOT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `supplier_added_date` date DEFAULT NULL,
  `mgr_ssn_supplier` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `supplier_name`, `supplier_pno`, `supplier_address`, `supplier_added_date`, `mgr_ssn_supplier`) VALUES
(1, 'Srinivas', '6360623747', '#248 2nd main,3rd cross,Attur Layout Yelahanka,Bangalore-560064', '2022-10-05', '3015642879'),
(2, 'Ashwini', '6361544569', '#128 1st block,near vidyaranyapura post office,bangalore', '2022-07-20', '3015642879'),
(3, 'Vasanth Gowda', '6363028217', '#435 ,d-block, porvankara apartment Yelahanka Bangalore-560064', '2022-03-25', '3015642879'),
(4, 'Venu Gopal', '7676111734', '#135 ,b-block, porvankara apartment Yelahanka Bangalore-560064', '2023-01-01', '3015642879'),
(5, 'Abhishek Rathod', '9587412106', '#128 1st block,near vijaynagar metro station,bangalore', '2023-02-10', '3015642879');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier_transaction`
--

CREATE TABLE `tbl_supplier_transaction` (
  `trans_id` int(100) NOT NULL,
  `supplier_id` int(100) DEFAULT NULL,
  `mgr_supplier_ssn` varchar(20) NOT NULL,
  `supplier_qty` int(100) NOT NULL,
  `trans_date` date NOT NULL,
  `supplier_verification` int(1) NOT NULL,
  `mgr_verification` int(1) NOT NULL,
  `approved` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier_transaction`
--

INSERT INTO `tbl_supplier_transaction` (`trans_id`, `supplier_id`, `mgr_supplier_ssn`, `supplier_qty`, `trans_date`, `supplier_verification`, `mgr_verification`, `approved`) VALUES
(1, 1, '3015642879', 50, '2023-01-03', 1, 1, 1),
(2, 1, '3015642879', 45, '2022-12-31', 1, 1, 1),
(3, 1, '3015642879', 40, '2022-12-15', 1, 1, 1),
(4, 1, '3015642879', 80, '2023-01-02', 1, 1, 1),
(5, 2, '3015642879', 20, '2023-01-03', 1, 1, 1),
(6, 1, '3015642879', 60, '2023-01-01', 1, 1, 1),
(7, 1, '3015642879', 50, '2023-01-04', 1, 1, 1),
(8, 2, '3015642879', 50, '2023-01-04', 1, 1, 1),
(9, 1, '3015642879', 80, '2023-01-04', 1, 1, 1),
(10, 3, '3015642879', 110, '2023-01-04', 1, 1, 1),
(13, 2, '3015642879', 100, '2023-01-04', 1, 1, 1),
(14, 1, '3015642879', 50, '2023-01-04', 1, 1, 1),
(15, 2, '3015642879', 250, '2023-01-04', 1, 1, 1),
(16, 1, '3015642879', 100, '2023-01-04', 1, 1, 1),
(17, 2, '3015642879', 100, '2023-01-04', 1, 1, 1),
(18, 1, '3015642879', 35, '2023-01-09', 1, 1, 1),
(19, 1, '3015642879', 70, '2023-01-09', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_website_setting`
--

CREATE TABLE `tbl_website_setting` (
  `tbl_id` int(11) NOT NULL,
  `tbl_slider` int(11) NOT NULL,
  `tbl_about_us` int(11) NOT NULL,
  `tbl_service` int(11) NOT NULL,
  `tbl_features` int(11) NOT NULL,
  `tbl_comments` int(11) NOT NULL,
  `tbl_blogs` int(11) NOT NULL,
  `tbl_header_head` varchar(3000) NOT NULL,
  `tbl_header_body` varchar(8000) NOT NULL,
  `tbl_footer_head` varchar(5000) NOT NULL,
  `tbl_footer_body` varchar(100) NOT NULL,
  `cost_store` int(100) NOT NULL,
  `cost_supplier` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_website_setting`
--

INSERT INTO `tbl_website_setting` (`tbl_id`, `tbl_slider`, `tbl_about_us`, `tbl_service`, `tbl_features`, `tbl_comments`, `tbl_blogs`, `tbl_header_head`, `tbl_header_body`, `tbl_footer_head`, `tbl_footer_body`, `cost_store`, `cost_supplier`) VALUES
(1, 1, 1, 1, 1, 1, 1, '                      <pre>\n<!DOCTYPE html>\n<html lang=\"en\">\n\n<head>\n    <meta charset=\"utf-8\">\n    <title>Dairy Management System</title>\n    <meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\">\n    <meta content=\"Free HTML Templates\" name=\"keywords\">\n    <meta content=\"Free HTML Templates\" name=\"description\">\n\n    <!-- Favicon -->\n    <link href=\"img/favicon.ico\" rel=\"icon\">\n\n    <!-- Google Web Fonts -->\n    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\">\n    <link href=\"https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap\" rel=\"stylesheet\">\n\n    <!-- Icon Font Stylesheet -->\n    <link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css\" rel=\"stylesheet\">\n    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css\" rel=\"stylesheet\">\n\n    <!-- Libraries Stylesheet -->\n    <link href=\"lib/owlcarousel/assets/owl.carousel.min.css\" rel=\"stylesheet\">\n\n    <!-- Customized Bootstrap Stylesheet -->\n    <link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">\n\n    <!-- Template Stylesheet -->\n    <link href=\"./css/style.css\" rel=\"stylesheet\">\n</head>\n</pre>\n                      ', '                                                                                                                                                                                                                                                                    <pre>\r\n<body>\r\n    <!-- Topbar Start -->\r\n    <div class=\"container-fluid px-5 d-none d-lg-block\">\r\n        <div class=\"row gx-5 py-3 align-items-center\">\r\n            <div class=\"col-lg-3\">\r\n                <div class=\"d-flex align-items-center justify-content-start\">\r\n                    <i class=\"bi bi-envelope-open fs-1 me-2\" style=\"color:rgb(48,60,84);\"></i>\r\n                    <h2 class=\"mb-0\">amog@gmail.com</h2>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-6\">\r\n                <div class=\"d-flex align-items-center justify-content-center\">\r\n                    <a href=\"index.html\" class=\"navbar-brand ms-lg-5\">\r\n                        <h1 class=\"m-0 display-4 text-secondary\" ><span style=\"color:rgb(48,60,84);\">Amog</span>Milk</h1>\r\n                    </a>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-3\">\r\n                <div class=\"d-flex align-items-center justify-content-end\">\r\n                    <a class=\"btn btn-primary btn-square rounded-circle me-2\" href=\"#\" style=\"background-color:rgb(48,60,84);\"><i class=\"fab fa-twitter\"></i></a>\r\n                    <a class=\"btn btn-primary btn-square rounded-circle me-2\" href=\"#\" style=\"background-color:rgb(48,60,84);\"><i class=\"fab fa-facebook-f\"></i></a>\r\n                    <a class=\"btn btn-primary btn-square rounded-circle me-2\" href=\"#\" style=\"background-color:rgb(48,60,84);\"><i class=\"fab fa-linkedin-in\"></i></a>\r\n                    <a class=\"btn btn-primary btn-square rounded-circle\" href=\"#\" style=\"background-color:rgb(48,60,84);\"><i class=\"fab fa-instagram\"></i></a>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <!-- Topbar End -->\r\n\r\n\r\n    <!-- Navbar Start -->\r\n    <nav class=\"navbar navbar-expand-lg navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5\" style=\"background-color:rgb(48,60,84);\">\r\n        <a href=\"index.html\" class=\"navbar-brand d-flex d-lg-none\">\r\n            <h1 class=\"m-0 display-4 text-secondary\"><span class=\"text-white\">Amog</span>Milk</h1>\r\n        </a>\r\n        <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarCollapse\">\r\n            <span class=\"navbar-toggler-icon\"></span>\r\n        </button>\r\n        <div class=\"collapse navbar-collapse text-white\" id=\"navbarCollapse\"><h2 class=\"mb-0 text-white\">Login:</h2>\r\n\r\n            <a href=\"dist/login.php\" class=\"btn py-md-3 px-md-5\">Store</a>\r\n            <a href=\"dist/login.php\" class=\"btn py-md-3 px-md-5\">Supplier</a>\r\n            <div class=\"navbar-nav py-0\" style=\"margin-left:55%;\">\r\n                <a href=\"index.php\" class=\"nav-item nav-link active\"><i class=\"fa\"></i>Home</a>\r\n                <a href=\"contact.php\" class=\"nav-item nav-link\"><i class=\"fab fa-call\"></i>Contact</a>\r\n            </div>\r\n        </div>\r\n    </nav>\r\n    <!-- Navbar End -->\r\n    </pre>                                                                                                                                                                                                                                                ', '                                                                                                                <pre>\r\n<!-- Footer Start -->\r\n\r\n    <div class=\"container-fluid text-white mt-5\" style=\"background-color:rgb(48,60,84);\">\r\n        <div class=\"container\">\r\n            <div class=\"row gx-5\">\r\n                <div class=\"col-lg-8 col-md-6\">\r\n                    <div class=\"row gx-5\">\r\n                        <div class=\"col-lg-4 col-md-12 pt-5 mb-5\">\r\n                            <h4 class=\"text-white mb-4\">Get in Touch</h4>\r\n                            <div class=\"d-flex mb-2\">\r\n                                <i class=\"bi bi-geo-alt text-white me-2\"></i>\r\n                                <p class=\"text-white mb-0\">123 Street, Yelahanka , Banaglore, Karnataka</p>\r\n                            </div>\r\n                            <div class=\"d-flex mb-2\">\r\n                                <i class=\"bi bi-envelope-open text-white me-2\"></i>\r\n                                <p class=\"text-white mb-0\">amog@example.com</p>\r\n                            </div>\r\n                            <div class=\"d-flex mb-2\">\r\n                                <i class=\"bi bi-telephone text-white me-2\"></i>\r\n                                <p class=\"text-white mb-0\">+012 345 67890</p>\r\n                            </div>\r\n                            <div class=\"d-flex mt-4\">\r\n                                <a class=\"btn btn-secondary btn-square rounded-circle me-2\" href=\"#\"><i class=\"fab fa-twitter\"></i></a>\r\n                                <a class=\"btn btn-secondary btn-square rounded-circle me-2\" href=\"#\"><i class=\"fab fa-facebook-f\"></i></a>\r\n                                <a class=\"btn btn-secondary btn-square rounded-circle me-2\" href=\"#\"><i class=\"fab fa-linkedin-in\"></i></a>\r\n                                <a class=\"btn btn-secondary btn-square rounded-circle\" href=\"#\"><i class=\"fab fa-instagram\"></i></a>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5\">\r\n                            <h4 class=\"text-white mb-4\">Quick Links</h4>\r\n                            <div class=\"d-flex flex-column justify-content-start\">\r\n                                <a class=\"text-white mb-2\" href=\"#\"><i class=\"bi bi-arrow-right text-white me-2\"></i>Home</a>\r\n                                <a class=\"text-white\" href=\"#\"><i class=\"bi bi-arrow-right text-white me-2\"></i>Contact Us</a>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-lg-4 col-md-6 mt-lg-n5\">\r\n                    <div class=\"d-flex flex-column align-items-center justify-content-center text-center h-100 bg-secondary p-5\">\r\n                        <h4 class=\"text-white\">Suggestions/Comments</h4>\r\n                        <h6 class=\"text-white\"></h6>\r\n                        <p>Gmail Us</p>\r\n                        <form action=\"\">\r\n                            <div class=\"input-group\">\r\n                                <input type=\"text\" class=\"form-control border-white p-3\" placeholder=\"Your Email\">\r\n                                <button class=\"text-white btn\" style=\"background-color:rgb(48,60,84);\">Mail Us</button>\r\n                            </div>\r\n                        </form>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <div class=\"container-fluid bg-dark text-white py-4\">\r\n        <div class=\"container text-center\">\r\n            <p class=\"mb-0\">© <a class=\"text-secondary fw-bold\" href=\"#\">Amog Milk</a>. All Rights Reserved. Designed by <a class=\"text-secondary fw-bold\" href=\"#\">Raj</a></p>\r\n        </div>\r\n    </div>\r\n    <!-- Footer End -->\r\n\r\n\r\n    <!-- Back to Top -->\r\n    <a href=\"#\" class=\"btn btn-secondary py-3 fs-4 back-to-top\"><i class=\"bi bi-arrow-up\"></i></a>\r\n\r\n\r\n    <!-- JavaScript Libraries -->\r\n    <script src=\"https://code.jquery.com/jquery-3.4.1.min.js\"></script>\r\n    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js\"></script>\r\n    <script src=\"lib/easing/easing.min.js\"></script>\r\n    <script src=\"lib/waypoints/waypoints.min.js\"></script>\r\n    <script src=\"lib/counterup/counterup.min.js\"></script>\r\n    <script src=\"lib/owlcarousel/owl.carousel.min.js\"></script>\r\n\r\n    <!-- Template Javascript -->\r\n    <script src=\"js/main.js\"></script>\r\n</body>\r\n\r\n</html>\r\n\r\n</pre>                                                                                                                ', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email_address` (`admin_email_id`) USING BTREE;

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`tbl_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`dept_id`),
  ADD KEY `MANAGER_SSN` (`dept_mgr_ssn`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`emp_ssn`),
  ADD UNIQUE KEY `email_address` (`emp_email_id`),
  ADD KEY `department_id` (`emp_dept_no`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tbl_record`
--
ALTER TABLE `tbl_record`
  ADD PRIMARY KEY (`record_date`);

--
-- Indexes for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `tbl_request_from_users`
--
ALTER TABLE `tbl_request_from_users`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `request_veiwed_by_mgr` (`request_veiwed_by_mgr`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`tbl_slider_id`);

--
-- Indexes for table `tbl_store`
--
ALTER TABLE `tbl_store`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `delivering_emp_ssn` (`delivering_emp_ssn`),
  ADD KEY `added_mgr_snn` (`added_mgr_ssn`);

--
-- Indexes for table `tbl_store_transaction`
--
ALTER TABLE `tbl_store_transaction`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `store_id_trans` (`store_id`),
  ADD KEY `store_delivered_emp_ssn` (`deliverd_emp_ssn`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `supplier_manager_ssn` (`mgr_ssn_supplier`);

--
-- Indexes for table `tbl_supplier_transaction`
--
ALTER TABLE `tbl_supplier_transaction`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `tbl_website_setting`
--
ALTER TABLE `tbl_website_setting`
  ADD PRIMARY KEY (`tbl_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `tbl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `dept_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_request_from_users`
--
ALTER TABLE `tbl_request_from_users`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `tbl_slider_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_store`
--
ALTER TABLE `tbl_store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_store_transaction`
--
ALTER TABLE `tbl_store_transaction`
  MODIFY `trans_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_supplier_transaction`
--
ALTER TABLE `tbl_supplier_transaction`
  MODIFY `trans_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_website_setting`
--
ALTER TABLE `tbl_website_setting`
  MODIFY `tbl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD CONSTRAINT `MANAGER_SSN` FOREIGN KEY (`dept_mgr_ssn`) REFERENCES `tbl_employee` (`emp_ssn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD CONSTRAINT `department_id` FOREIGN KEY (`emp_dept_no`) REFERENCES `tbl_department` (`dept_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `tbl_store`
--
ALTER TABLE `tbl_store`
  ADD CONSTRAINT `delivering_emp_ssn` FOREIGN KEY (`delivering_emp_ssn`) REFERENCES `tbl_employee` (`emp_ssn`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_store_transaction`
--
ALTER TABLE `tbl_store_transaction`
  ADD CONSTRAINT `store_delivered_emp_ssn` FOREIGN KEY (`deliverd_emp_ssn`) REFERENCES `tbl_employee` (`emp_ssn`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `store_id_trans` FOREIGN KEY (`store_id`) REFERENCES `tbl_store` (`store_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD CONSTRAINT `supplier_manager_ssn` FOREIGN KEY (`mgr_ssn_supplier`) REFERENCES `tbl_employee` (`emp_ssn`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_supplier_transaction`
--
ALTER TABLE `tbl_supplier_transaction`
  ADD CONSTRAINT `supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
