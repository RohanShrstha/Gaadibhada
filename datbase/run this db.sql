-- Table for sign up
CREATE TABLE customer_tbl (
customer_id int(11) NOT NULL auto_increment,
cutomer_uname varchar(255) NOT NULL,
cutomer_uemail varchar(255),
custoemr_upass varchar(255),
PRIMARY KEY (customer_id)
);

-- Table for suggestion in contact us
CREATE TABLE suggestion (
customer_id int(11) NOT NULL,
cname varchar(255) NOT NULL,
email varchar(255) NOT NULL UNIQUE,
phone varchar(255) NOT NULL,
message varchar(9999999),
PostingDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`status` int(11) DEFAULT NULL
);

ALTER TABLE `suggestion`
ADD PRIMARY KEY (customer_id);

ALTER TABLE `suggestion`
MODIFY customer_id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

-- Table for admin login
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

ALTER TABLE `tbl_admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
  
INSERT INTO `tbl_admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '5c428d8875d2948607f3e3fe134d71b4', '2017-06-18 12:22:38');

-- Table for brands 
CREATE TABLE tbl_brands (
	brand_id int(11) NOT NULL AUTO_INCREMENT,
	brandname varchar(255) NOT NULL,
	creationdate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updationdate timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`brand_id`)
);