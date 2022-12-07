-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 01:08 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handicraft`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `Area_id` int(11) NOT NULL,
  `Area_name` varchar(45) NOT NULL,
  `City_City_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`Area_id`, `Area_name`, `City_City_id`) VALUES
(1, 'hirawadi', 1),
(2, 'surendranagar', 1),
(3, 'hirabag', 2),
(4, 'vesu', 2),
(5, 'mira road', 6),
(6, 'gota', 1),
(7, 'visnunagar', 8),
(8, 'hiravadi', 1),
(9, 'hirabaug', 2),
(10, 'bapunagar', 1),
(11, 'mira road', 5),
(12, 'pritampura', 4),
(13, 'bandra', 5),
(14, 'lakshaminagar', 7);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `User_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_id` int(11) NOT NULL,
  `Category_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_id`, `Category_name`) VALUES
(1, 'wall piece'),
(2, 'cover'),
(3, 'panel'),
(4, 'toran'),
(5, 'chakla');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `City_id` int(11) NOT NULL,
  `City_name` varchar(45) NOT NULL,
  `State_State_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`City_id`, `City_name`, `State_State_id`) VALUES
(1, 'Ahmedabad', 1),
(2, 'Surat', 1),
(3, 'mumbai', 4),
(4, 'jodhpur', 3),
(5, 'jaipur', 3),
(6, 'pune', 4),
(7, 'gurugram', 2),
(8, 'gandhinagar', 1),
(9, 'Vishakhapatnam', 5),
(10, 'Vijaywada', 5),
(11, 'Guntur', 5),
(12, 'patna', 6);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address` varchar(11) NOT NULL,
  `DOJ` date NOT NULL,
  `Contact` bigint(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Salary` int(11) NOT NULL,
  `Area_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_id`, `Name`, `Address`, `DOJ`, `Contact`, `Email`, `Salary`, `Area_id`, `Product_id`) VALUES
(1, 'bablubhai', '209,sarita ', '2020-03-04', 8460303389, 'babalu9999@gmail.com', 15000, 6, 2),
(2, 'Gitaben', '45,krusnaku', '2020-02-01', 9898058028, 'gitaben1975@gmail.com', 12000, 12, 4),
(3, 'Jagrutiben', 'A-45,vrunda', '2019-12-01', 9909825460, 'jagruti0000@gmail.com', 15000, 13, 1),
(4, 'Prashantbhai', '10,dhanlaks', '2019-10-01', 7285021125, 'pmk1997@gmail.com', 16000, 14, 3),
(5, 'gauravbhai', '425, nilkan', '2020-05-19', 9826276688, 'gauravpatel123@gmail.com', 200000, 6, 5),
(6, 'nitinbhai', '220, pramuk', '2020-03-04', 7328222278, 'nitinpanchal67@gmail.com', 15000, 5, 5),
(7, 'kartikbhai', '67, crystal', '2020-07-15', 8652967887, 'kartikrabari234@gmail.com', 10000, 4, 5),
(8, 'kuldeep', '24, vasundh', '2020-08-19', 9876546745, 'kuldeepvasoya45@gmail.com', 5000, 12, 2),
(9, 'yurajbhai', '60, krish r', '2020-07-28', 9876543782, 'yurajmehta35@gmail.com', 15000, 14, 2),
(10, 'jigarbhai', '54,amarnath', '2020-07-15', 9756348788, 'jigarbarot555@gmail.com', 20000, 9, 1),
(11, 'pradipbhai', '401, sagar ', '2020-01-01', 9712687922, 'pradippatel546@gmail.com', 20000, 7, 1),
(12, 'kaushikbhai', '667', '2020-04-16', 9789765438, 'kaushikrajput78@gmail.com', 7000, 2, 1),
(13, 'anilbhai', '65, krishvi', '2020-07-22', 9756038777, 'anilbhatt24@gmail.com', 10000, 1, 1),
(14, 'sureshbhai', '67, rajratn', '2019-09-12', 9567834647, 'suresmakwana546@gmail.com', 20000, 5, 3),
(15, 'amitbhai', '43, pritam ', '2020-07-09', 9567893564, 'amitrajput234@gmail.com', 20000, 6, 2),
(16, 'krunalbhai', '22, narayan', '2020-06-25', 9673902637, 'krunalmakwana67@gmail.com', 15000, 4, 3),
(17, 'vijaybhai', '45, rahulpa', '2020-05-28', 9847503840, 'vijayvaghela56@gmail.com', 15000, 12, 3),
(18, 'maheshbhai', '435, anjall', '2020-08-31', 7589304829, 'maheshsolanki53@gmail.com', 10000, 7, 4),
(19, 'laljibhai', '245, lucky ', '2020-08-03', 9738028476, 'laljisolanki65@gmail.com', 15000, 11, 5),
(20, 'hirenbhai', '34, mayur a', '2020-09-07', 9476830927, 'hirenmakwana54@gmail.com', 10000, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_id` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Feedback_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Feedback_id`, `Description`, `Product_id`, `User_id`, `Feedback_date`) VALUES
(8, 'good product.', 3, 1, '2020-03-15'),
(9, 'Good Quality', 4, 16, '2020-09-29'),
(10, 'Good Quality', 4, 16, '2020-09-29'),
(11, 'Good Quality of cover', 5, 16, '2020-09-29'),
(12, 'Good Quality', 2, 16, '2020-09-29');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `Image_id` int(11) NOT NULL,
  `Path` varchar(45) NOT NULL,
  `Product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`Image_id`, `Path`, `Product_id`) VALUES
(1, 'images/1581489138.jpg', 1),
(2, 'images/1581489153.jpg', 2),
(3, 'images/1581489202.jpg', 3),
(4, 'images/1581489223.jpg', 4),
(5, 'images/1581489331.jpg', 5),
(6, 'images/1628318794.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Payment_type` varchar(45) NOT NULL,
  `user_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` int(11) NOT NULL,
  `Product_name` varchar(45) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Discription` varchar(150) NOT NULL,
  `Discount_rate` int(4) NOT NULL,
  `Discount` int(11) NOT NULL,
  `Category_id` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Product_name`, `Qty`, `Discription`, `Discount_rate`, `Discount`, `Category_id`, `Price`) VALUES
(1, 'rangila', 750, 'Description of the product.....', 20, 100, 4, 500),
(2, 'cuison cover', 1500, 'Description of the product.....', 10, 500, 2, 5000),
(3, 'sofa panel', 670, 'Description of the product.....', 10, 100, 3, 1000),
(4, 'kachchi wallpiece', 1020, 'Description of the product.....', 5, 50, 1, 1000),
(5, 'kachchi cover', 500, 'Description of the product.....', 10, 100, 2, 1000),
(6, 'chakla', 400, 'This is use for home decoration.', 10, 150, 5, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `Production_id` int(11) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date NOT NULL,
  `Employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`Production_id`, `Start_date`, `End_date`, `Employee_id`) VALUES
(1, '2020-03-01', '2020-04-01', 1),
(2, '2020-03-01', '2020-04-01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `production_details`
--

CREATE TABLE `production_details` (
  `Production_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `QUANTITY` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `production_details`
--

INSERT INTO `production_details` (`Production_id`, `Product_id`, `QUANTITY`) VALUES
(1, 2, 500),
(1, 3, 600),
(2, 1, 50),
(2, 2, 300),
(2, 4, 500);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `Purchase_order_id` int(11) NOT NULL,
  `Order_date` date NOT NULL,
  `Total_amt` int(20) NOT NULL,
  `Supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`Purchase_order_id`, `Order_date`, `Total_amt`, `Supplier_id`) VALUES
(1, '2020-03-19', 22000, 5),
(2, '2020-03-20', 56000, 3),
(3, '2020-03-21', 14000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_details`
--

CREATE TABLE `purchase_order_details` (
  `Purchase_order_id` int(11) NOT NULL,
  `Raw_material_id` int(11) NOT NULL,
  `QTY` int(11) NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_order_details`
--

INSERT INTO `purchase_order_details` (`Purchase_order_id`, `Raw_material_id`, `QTY`, `Price`) VALUES
(1, 1, 100, 100),
(1, 2, 100, 120),
(2, 3, 200, 80),
(2, 4, 400, 100),
(3, 1, 100, 100),
(3, 3, 40, 100);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_raw_details`
--

CREATE TABLE `purchase_raw_details` (
  `Purchase_order_id` int(11) NOT NULL,
  `Raw_material_id` int(11) NOT NULL,
  `Supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

CREATE TABLE `purchase_return` (
  `Purchase_return_id` int(11) NOT NULL,
  `Return_date` date NOT NULL,
  `Purchase_order_id` int(11) NOT NULL,
  `AMT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_details`
--

CREATE TABLE `purchase_return_details` (
  `Raw_material_id` int(11) NOT NULL,
  `Purchase_return_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `Reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `User_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Rating_value` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`User_id`, `Product_id`, `Rating_value`) VALUES
(2, 1, 5),
(2, 2, 3),
(5, 2, 5),
(16, 2, 3),
(16, 4, 5),
(16, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `raw_material`
--

CREATE TABLE `raw_material` (
  `Raw_material_id` int(11) NOT NULL,
  `Raw_material_name` varchar(45) NOT NULL,
  `QOH` int(5) NOT NULL,
  `Path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `raw_material`
--

INSERT INTO `raw_material` (`Raw_material_id`, `Raw_material_name`, `QOH`, `Path`) VALUES
(1, 'hathi', 740, 'images/1581134004.jpg'),
(2, 'chakla', 300, 'images/1581134014.jpg'),
(3, 'golden moti', 1240, 'images/1584515346.jpg'),
(4, 'pearl moti', 650, 'images/1584515592.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `Sales_order_id` int(11) NOT NULL,
  `Dis` float NOT NULL,
  `Order_date` date NOT NULL,
  `Total_amount` float NOT NULL,
  `User_id` int(11) NOT NULL,
  `CGST` float NOT NULL,
  `SGST` float NOT NULL,
  `Order_status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`Sales_order_id`, `Dis`, `Order_date`, `Total_amount`, `User_id`, `CGST`, `SGST`, `Order_status`) VALUES
(1, 75, '2020-03-11', 3071.25, 2, 73.125, 73.125, 'Cancelled'),
(2, 150, '2020-03-11', 2992.5, 2, 71.25, 71.25, 'Processing'),
(3, 160, '2020-03-11', 11907, 2, 283.5, 283.5, 'Complete'),
(4, 100, '2020-03-13', 10395, 2, 247.5, 247.5, 'Pending'),
(5, 300, '2020-03-14', 14385, 5, 342.5, 342.5, 'Complete'),
(6, 25, '2020-03-15', 1023.75, 5, 24.375, 24.375, 'Pending'),
(7, 125, '2020-03-16', 5118.75, 2, 121.875, 121.875, 'Complete'),
(8, 250, '2020-09-29', 17587.5, 16, 418.75, 418.75, 'Complete'),
(9, 125, '2020-09-29', 5118.75, 16, 121.875, 121.875, 'Complete'),
(10, 150, '2021-01-31', 6142.5, 16, 146.25, 146.25, 'Cancelled'),
(11, 200, '2021-06-05', 3990, 16, 95, 95, 'Complete'),
(12, 150, '2021-07-02', 2992.5, 21, 71.25, 71.25, 'Cancelled'),
(13, 75, '2021-07-02', 3071.25, 21, 73.125, 73.125, 'Pending'),
(14, 75, '2021-07-02', 3071.25, 21, 73.125, 73.125, 'Cancelled'),
(15, 100, '2022-05-21', 945, 22, 22.5, 22.5, 'Cancelled'),
(16, 300, '2022-05-21', 4935, 22, 117.5, 117.5, 'Cancelled'),
(17, 300, '2022-08-09', 2835, 22, 67.5, 67.5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_details`
--

CREATE TABLE `sales_order_details` (
  `Sales_order_id` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Qty_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_order_details`
--

INSERT INTO `sales_order_details` (`Sales_order_id`, `Product_id`, `Quantity`, `Qty_price`) VALUES
(1, 4, 3, 3000),
(2, 3, 3, 3000),
(3, 1, 3, 1500),
(3, 2, 2, 10000),
(4, 2, 2, 10000),
(5, 2, 2, 10000),
(5, 3, 4, 4000),
(6, 4, 1, 1000),
(7, 4, 5, 5000),
(8, 2, 3, 15000),
(8, 5, 2, 2000),
(9, 4, 5, 5000),
(10, 4, 6, 6000),
(11, 5, 4, 4000),
(12, 5, 3, 3000),
(13, 4, 3, 3000),
(14, 4, 3, 3000),
(15, 3, 1, 900),
(16, 4, 4, 3800),
(17, 3, 3, 2700);

-- --------------------------------------------------------

--
-- Table structure for table `sales_return`
--

CREATE TABLE `sales_return` (
  `Sales_return_id` int(11) NOT NULL,
  `Return_date` date DEFAULT NULL,
  `Amt` int(11) NOT NULL,
  `Pro_dis` int(11) NOT NULL,
  `Sales_order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_return`
--

INSERT INTO `sales_return` (`Sales_return_id`, `Return_date`, `Amt`, `Pro_dis`, `Sales_order_id`) VALUES
(1, '2020-03-27', 6000, 0, 3),
(2, '2020-03-27', 7000, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sales_return_details`
--

CREATE TABLE `sales_return_details` (
  `Qty_return` int(11) NOT NULL,
  `Product_id` int(11) NOT NULL,
  `Sales_return_id` int(11) NOT NULL,
  `Reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_return_details`
--

INSERT INTO `sales_return_details` (`Qty_return`, `Product_id`, `Sales_return_id`, `Reason`) VALUES
(2, 1, 1, ''),
(1, 2, 1, ''),
(1, 2, 2, ''),
(2, 3, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `State_id` int(11) NOT NULL,
  `State_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`State_id`, `State_name`) VALUES
(1, 'Gujarat'),
(2, 'Dehli'),
(3, 'Rajasthan'),
(4, 'Maharatra'),
(5, 'Andhrpradesh'),
(6, 'Bihar'),
(7, 'Uttar Pradesh'),
(8, 'Punjab');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Supplier_id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Contact` bigint(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Area_id` int(11) NOT NULL,
  `Raw_material_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Supplier_id`, `Name`, `Email`, `Contact`, `Address`, `Area_id`, `Raw_material_id`) VALUES
(1, 'Asvinbhai', 'asvin1920@gmail.com', 8460303383, '22,vandanapark society', 1, 2),
(2, 'Popatbhai', 'popatbhai1980@gmail.com', 7359777747, '209,modi mohallo', 9, 3),
(3, 'Narendrabhai', 'narendrabhai1990@gmail.com', 9909825460, '59/691,gayatri nagar', 1, 4),
(4, 'Prafulbhai', 'prafulmiyani2020@gmail.com', 7878087999, '5,nilkanth society', 10, 3),
(5, 'Pratikbhai', 'pratikpatel2020@gmail.com', 9913369946, '99,tapovan flate', 11, 1),
(6, 'neelbhai', 'neel123@gmail.com', 7878908870, '132,vijayratna society', 6, 2),
(7, 'tarunbhai', 'tarunvekariya90@gmail.com', 7359777675, '511,saritanagar apartment', 1, 4),
(8, 'rushabhbhai', 'rushabhpatel11@gmail.com', 7956224261, '132,vijaypark society', 10, 3),
(9, 'manubhai', 'manubhai22@gmail.com', 7878056699, '110,lakshami-narayan society', 4, 1),
(10, 'bharatbhai', 'bharat9999@gmail.com', 7359657147, '55,akash banglow', 3, 1),
(11, 'manojbhai', 'manojahir1@gmail.com', 7026624119, '405,drishti apartment', 4, 1),
(13, 'dipikaben', 'dipika55@gmail.com', 7236624119, '45,anjanapark apartment', 11, 3),
(14, 'bhagavatiben', 'bhagavatibk@gmail.com', 7345677147, '110,madhuvan society', 13, 4),
(15, 'govindbhai', 'govind12@gmail.com', 7312589054, '78,vikrampark society', 12, 2),
(16, 'vijaybhai', 'vijayjadeja@gmail.com', 9913369935, 'A/22,saritanagar society', 12, 2),
(17, 'jayrajsingh', 'jayrajbapu@gmail.com', 9998959594, '9,bhaya ni haveli', 12, 1),
(18, 'yuvarajbhai', 'yuvaraj1888@gmail.com', 9926574839, '50,vrundavan apartment', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Password` varchar(16) DEFAULT NULL,
  `Address` varchar(45) NOT NULL,
  `Contact` bigint(10) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `User_type_id` int(11) NOT NULL,
  `Seq_que` varchar(50) DEFAULT NULL,
  `Seq_ans` varchar(30) DEFAULT NULL,
  `Area_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Name`, `Password`, `Address`, `Contact`, `Email`, `User_type_id`, `Seq_que`, `Seq_ans`, `Area_id`) VALUES
(1, 'Hardev valdoriya', 'Hardev@1997', '8,Madhuvan flat,hirawadi,bapunagar,Ahemdabad.', 7433804880, 'Hardevvaldoriya00@gmail.com', 1, 'what is fav food?', 'Pav bhaji', 1),
(2, 'Vinay bhuva', 'Vinay@1998', '22,shivshakti society,hirwadi,bapunagar,ahemd', 9876541287, 'Vinaybhuva00@gmail.com', 1, 'what is fav food?', 'bhajiya', 1),
(3, 'Ankit sorthiya', 'Ankit@1997', '25,Anjna park,hirawadi road,bapunagar,Ahemdab', 9857469547, 'Ankitsorthiya00@gmail.com', 1, 'what is fav food?', 'bhaji', 1),
(4, 'Mayur bhuva', 'Mayur@1992', '45,kailash park,hirawadi,bapunagar,ahemdabad.', 9879165420, 'mayurbhuva00@gmail.com', 1, 'what is fav food?', 'pizza', 1),
(5, 'nikuj vekriya', 'Nikujvekriya@457', '245,apple evenue,hirawadi. ', 7069102609, 'nikujvekriya00@gmail.com', 1, 'what is fav food?', 'meggi', 4),
(6, 'sahil', 'Sahil@123', 'surendranagar', 9714053993, 'sahilmalek00@gmail.com', 1, 'who is Your best friend?', 'jay', 2),
(7, 'jay gogdani', 'Jay@1465', '89,shivnagar society,jaktnaka,surendrnagar.', 7046537071, 'jaygogdani00@gmail.com', 1, 'what is fav food?', 'burger', 2),
(8, 'sagar surani', 'Sagar@456', '87,shubham row-house,jaktnaka,surendrnagar.', 9723580932, 'sagarsurani00@gmail.com', 1, 'what is fav food?', 'bhaji', 2),
(9, 'parth rajani', 'Parth@1356', '101,shivshkati society,surendnagar.', 9913821450, 'parthrajani00@gmail.com', 1, 'what is fav food?', 'chips', 2),
(10, 'vivek akbari', 'Vivekakbari@7452', '210,mirabuag,surendnagar.', 9723456125, 'vivekakbari00@gmail.com', 1, 'what is fav food?', 'chicken', 2),
(11, 'Vijay', 'Vijay@123', '59/691, sarita society,hirabag,surat.', 8160577308, 'vijaypanchal00@gmail.com', 1, 'who is your best friend?', 'meet', 3),
(12, 'parth akbari', 'Parth@1456', '209, himmatnagar,hirabag,surat.', 8980307192, 'parthakbari@00gmail.com', 1, 'what is fav food?', 'pudla', 3),
(13, 'kuldip savaliya', 'Kuldip$456', '216,p.p savani nagar,hirabag,surat.', 8469756271, 'kuldipsavaliya00@gmail.com', 1, 'what is fav food?', 'kajukari', 3),
(14, 'shubham gajera', 'Shubham$478', '372,ruksmani society,hirabag,surat.', 8530191265, 'shubhamgajera00@gmail.com', 1, 'what is fav food?', 'bhel', 3),
(15, 'parimal koladiya', 'Parimal@4785', '209,purvi society,hirabag,surat.', 7069238399, 'parimalkoladiya00@gmail.com', 1, 'what is fav food?', 'sev mamra', 3),
(16, 'meet', 'Meet@123', '6/156,bhaktinagar society,vesu.', 9712672710, 'meetshaileshk00@gmail.com', 1, 'who is your best friend?', 'vijay', 4),
(17, 'dhurv savaliya', 'Dhurv@1997', '372,shrinathji society,vesu,surat.', 7622834951, 'dhurvsavaliya00@gmail.com', 1, 'what is fav food?', 'pizza', 4),
(18, 'jaydip savaliya', 'Jaydip@7857', '232,arjun nagar,vesu,surat.', 9737727113, 'jaydipsavaliya00@gmail.com', 1, 'what is fav food?', 'thepla', 4),
(19, 'vivek ghodhani', 'Vivekghodani@199', '300,suryvandna society,vesu.', 8160076332, 'vivekghodhani00@gmail.com', 1, '', 'coffee', 4),
(20, 'dhaval bhalani', 'Dhavalbhlani@145', '29,kaxminarayan society,vesu.', 9773296172, 'dhavalbhalani00@gmail.com', 1, 'what is fav food?', 'dal bati', 4),
(21, 'piyush', 'Piyush@123', '11,saritanagar society', 7359777147, 'piyushkoladiya00@gmail.com', 2, 'who is your best friend?', 'jay', 1),
(22, 'jay', 'Jay@1234', '45,anjanapark society', 7016624119, 'jaykakadiya00@gmail.com', 1, 'who is your best friend?', 'piyush', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `User_type_id` int(11) NOT NULL,
  `User_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`User_type_id`, `User_type`) VALUES
(1, 'customer'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view2`
-- (See below for the actual view)
--
CREATE TABLE `view2` (
`User_id` int(11)
,`Name` varchar(45)
,`Password` varchar(16)
,`Address` varchar(45)
,`Contact` bigint(10)
,`Email` varchar(45)
,`Seq_que` varchar(50)
,`Seq_ans` varchar(30)
,`User_type` varchar(45)
);

-- --------------------------------------------------------

--
-- Structure for view `view2`
--
DROP TABLE IF EXISTS `view2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view2`  AS  select `user`.`User_id` AS `User_id`,`user`.`Name` AS `Name`,`user`.`Password` AS `Password`,`user`.`Address` AS `Address`,`user`.`Contact` AS `Contact`,`user`.`Email` AS `Email`,`user`.`Seq_que` AS `Seq_que`,`user`.`Seq_ans` AS `Seq_ans`,`user_type`.`User_type` AS `User_type` from (`user` join `user_type` on((`user_type`.`User_type_id` = `user`.`User_type_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`Area_id`),
  ADD KEY `fk_Area_City1_idx` (`City_City_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Product_id`,`User_id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`City_id`),
  ADD KEY `fk_City_State_idx` (`State_State_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Employee_id`),
  ADD KEY `Area_id` (`Area_id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_id`),
  ADD KEY `fk_FeedBack_Product1_idx` (`Product_id`),
  ADD KEY `fk_FeedBack_user1_idx` (`User_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`Image_id`),
  ADD KEY `fk_Image_Product1_idx` (`Product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_id`),
  ADD KEY `fk_Payment_user1_idx` (`user_user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`),
  ADD KEY `category_id` (`Category_id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
  ADD PRIMARY KEY (`Production_id`,`Employee_id`),
  ADD KEY `fk_Employee_Employee1_idx` (`Employee_id`) USING BTREE;

--
-- Indexes for table `production_details`
--
ALTER TABLE `production_details`
  ADD PRIMARY KEY (`Production_id`,`Product_id`),
  ADD KEY `fk_Production_has_Product_Product1_idx` (`Product_id`) USING BTREE,
  ADD KEY `fk_Production_has_Product_Production1_idx` (`Production_id`) USING BTREE;

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`Purchase_order_id`),
  ADD KEY `fk_Purchase_order_Supplier1_idx` (`Supplier_id`);

--
-- Indexes for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD PRIMARY KEY (`Purchase_order_id`,`Raw_material_id`),
  ADD KEY `Raw_material_id` (`Raw_material_id`);

--
-- Indexes for table `purchase_raw_details`
--
ALTER TABLE `purchase_raw_details`
  ADD PRIMARY KEY (`Purchase_order_id`,`Raw_material_id`,`Supplier_id`),
  ADD KEY `Raw_material_id` (`Raw_material_id`),
  ADD KEY `Supplier_id` (`Supplier_id`);

--
-- Indexes for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD PRIMARY KEY (`Purchase_return_id`),
  ADD KEY `fk_Purchase_return_Purchase_order1_idx` (`Purchase_order_id`);

--
-- Indexes for table `purchase_return_details`
--
ALTER TABLE `purchase_return_details`
  ADD PRIMARY KEY (`Raw_material_id`,`Purchase_return_id`),
  ADD KEY `fk_Purchase_return_Detail_Product1_idx` (`Raw_material_id`),
  ADD KEY `fk_Purchase_return_Detail_Purchase_return1_idx` (`Purchase_return_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`User_id`,`Product_id`),
  ADD KEY `fk_user_has_product_product2_idx` (`Product_id`),
  ADD KEY `fk_user_has_product_user2_idx` (`User_id`);

--
-- Indexes for table `raw_material`
--
ALTER TABLE `raw_material`
  ADD PRIMARY KEY (`Raw_material_id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`Sales_order_id`),
  ADD KEY `fk_Sales_order_user1_idx` (`User_id`);

--
-- Indexes for table `sales_order_details`
--
ALTER TABLE `sales_order_details`
  ADD PRIMARY KEY (`Sales_order_id`,`Product_id`),
  ADD KEY `fk_Sales_order_has_Product_Product1_idx` (`Product_id`),
  ADD KEY `fk_Sales_order_has_Product_Sales_order1_idx` (`Sales_order_id`);

--
-- Indexes for table `sales_return`
--
ALTER TABLE `sales_return`
  ADD PRIMARY KEY (`Sales_return_id`),
  ADD KEY `fk_Product_sales_return_Sales_order1_idx` (`Sales_order_id`);

--
-- Indexes for table `sales_return_details`
--
ALTER TABLE `sales_return_details`
  ADD PRIMARY KEY (`Product_id`,`Sales_return_id`),
  ADD KEY `fk_sales_return_Detail_Product1_idx` (`Product_id`),
  ADD KEY `fk_sales_return_Detail_sales_return1_idx` (`Sales_return_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`State_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Supplier_id`),
  ADD KEY `Area_id` (`Area_id`),
  ADD KEY `Raw_material_id` (`Raw_material_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`),
  ADD KEY `fk_user_user_type1_idx` (`User_type_id`),
  ADD KEY `area_id` (`Area_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`User_type_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `fk_Area_City1` FOREIGN KEY (`City_City_id`) REFERENCES `city` (`City_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_City_State` FOREIGN KEY (`State_State_id`) REFERENCES `state` (`State_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`Area_id`) REFERENCES `area` (`Area_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_FeedBack_Product1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FeedBack_user1` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_Image_Product1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`Product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_Payment_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`User_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Category_id`) REFERENCES `category` (`Category_id`);

--
-- Constraints for table `production`
--
ALTER TABLE `production`
  ADD CONSTRAINT `fk_Production_Product1` FOREIGN KEY (`Employee_id`) REFERENCES `product` (`Product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `production_details`
--
ALTER TABLE `production_details`
  ADD CONSTRAINT `fk_Production_has_Raw_material_Production1` FOREIGN KEY (`Production_id`) REFERENCES `production` (`Production_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Production_has_Raw_material_Raw_material1` FOREIGN KEY (`Product_id`) REFERENCES `raw_material` (`Raw_material_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `fk_Purchase_order_Supplier1` FOREIGN KEY (`Supplier_id`) REFERENCES `supplier` (`Supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchase_raw_details`
--
ALTER TABLE `purchase_raw_details`
  ADD CONSTRAINT `purchase_raw_details_ibfk_1` FOREIGN KEY (`Purchase_order_id`) REFERENCES `purchase_order` (`Purchase_order_id`),
  ADD CONSTRAINT `purchase_raw_details_ibfk_2` FOREIGN KEY (`Raw_material_id`) REFERENCES `raw_material` (`Raw_material_id`),
  ADD CONSTRAINT `purchase_raw_details_ibfk_3` FOREIGN KEY (`Supplier_id`) REFERENCES `supplier` (`Supplier_id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`Area_id`) REFERENCES `area` (`Area_id`),
  ADD CONSTRAINT `supplier_ibfk_2` FOREIGN KEY (`Raw_material_id`) REFERENCES `raw_material` (`Raw_material_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
