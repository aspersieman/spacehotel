CREATE DATABASE spacehotel;

USE `spacehotel`;

CREATE USER 'spacehotel'@'localhost' IDENTIFIED BY  'spacehotel';

GRANT ALL PRIVILEGES ON * . * TO  'spacehotel'@'localhost' IDENTIFIED BY  'spacehotel' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

GRANT ALL PRIVILEGES ON `spacehotel` . * TO  'spacehotel'@'localhost';

CREATE TABLE `room` (
    `id` int(11) NOT NULL auto_increment,
    `type` varchar(30) NOT NULL,
    `rate` int(11) NOT NULL,
    `description` varchar(300) NOT NULL,
    `quantity` int(11) NOT NULL,
    `max_adult` int(11) NOT NULL,
    `max_child` int(11) NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

INSERT INTO `room` (`id`, `type`, `rate`, `description`, `quantity`, `max_adult`, `max_child`) VALUES
(1, "Double AC", 1500, "Fully air conditioned with double bed with a view of the equator", 8, 1, 1),
(2, "Single AC Capsule", 1300, "Fully air conditioned with single bed inside a spacious 2m X 1m X 1m capsule", 5, 1, 1),
(3, "Standard Single ", 950, "Fan with single bed. Includes complimentary regeneration chamber treatment - perfect for those allergic to space cats or death", 3, 1, 1),
(4, "Standard Double", 1100, "Fan with double bed, digital computer and analog toaster. This room has the works!", 3, 1, 1);

CREATE TABLE `reservation` (
    `id` int(11) NOT NULL auto_increment,
    `firstname` varchar(30) NOT NULL,
    `lastname` varchar(30) NOT NULL,
    `address` varchar(200) NOT NULL,
    `city` varchar(30) NOT NULL,
    `zip` int(11) NOT NULL,
    `country` varchar(30) NOT NULL,
    `email` varchar(50) NOT NULL,
    `contact` int(20) NOT NULL,
    `username` varchar(30) NOT NULL,
    `password` varchar(30) NOT NULL,
    `arrival_date` varchar(30) NOT NULL,
    `departure_date` varchar(30) NOT NULL,
    `number_adults` int(11) NOT NULL,
    `number_children` int(11) NOT NULL,
    `number_days` int(11) NOT NULL,
    `number_rooms` int(11) NOT NULL,
    `amount_payable` int(11) NOT NULL,
    `status` varchar(10) NOT NULL,
    `confirmation_code` varchar(20) NOT NULL,
    `room_id` int(11) NOT NULL,
    PRIMARY KEY  (`id`),
    FOREIGN KEY fk_room(room_id) REFERENCES room(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO `reservation` (`firstname`, `lastname`, `address`, `city`, `zip`, `country`, `email`, `contact`, `username`, `password`, `arrival_date`, `departure_date`, `number_adults`, `number_children`, `number_days`, `number_rooms`, `amount_payable`, `status`, `confirmation_code`, `room_id`) VALUES
('Pony', 'Mcbroger', '122 asd', 'Whoville', 2, 'Wonkalia', 'test@gmail.com', 1234567890, '', '1', '08/12/2013', '12/12/2013', 1, 0, 4, 2, 10400, '', 'k44wiic3', 1),
('Bab', 'Babba', 'bbbb', 'bbbbb', 12312, 'bbbbbb', 'person@gmail.com', 1234567890, '', '1', '13/12/2013', '14/12/2013', 1, 0, 1, 2, 1900, 'Out', 'owxqpzcb', 2),
('No', 'Mo', 'Any', 'Fing', 123, 'Land', 'hey@gmail.com', 1111111111, '', '1', '12/12/2013', '15/12/2013', 1, 0, 3, 2, 6600, '', 'st4yz562', 3),
('Wlala', 'Laalal', 'Lolla', 'Lilla', 123, 'Lalal', 'how@gmail.com', 1111111111, '', '1', '12/12/2013', '15/12/2013', 1, 0, 3, 2, 6600, 'Out', 'kveu4ram', 4),
('Wakka', 'Krakka', '123 Lollaeria', 'Cityplace', 123, 'Village', 'thing@gmail.com', 1234567890, 'ooops@gmail.com', '1', '20/12/2013', '28/12/2013', 2, 0, 8, 2, 24000, 'Out', 'tym6pdz6', 1),
('Person', 'Ality', '123 Lollaria', 'Lollville', 123, 'Lolland', 'ality@gmail.com', 1234556778, 'plaaan@gmail.com', '1', '14/12/2013', '20/12/2013', 1, 0, 6, 2, 18000, 'Active', '0eym8ogv', 2),
('Mr', 'E', '123 asdad', 'asdasd', 123123, 'asdasd', 'astasra@gmail.com', 1234565778, 'sksksk@gmail.com', '1', '11/12/2013', '20/12/2013', 1, 0, 9, 2, 27000, 'Active', 'hccr8n0p', 3);


CREATE TABLE `room_inventory` (
    `id` int(11) NOT NULL auto_increment,
    `arrival_date` varchar(30) NOT NULL,
    `departure_date` varchar(30) NOT NULL,
    `quantity_reserve` int(11) NOT NULL,
    `room_id` int(11) NOT NULL,
    `confirmation_code` varchar(10) NOT NULL,
    `status` varchar(30) NOT NULL,
    PRIMARY KEY  (`id`),
    FOREIGN KEY fk_room(room_id) REFERENCES room(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


INSERT INTO `room_inventory` (`arrival_date`, `departure_date`, `quantity_reserve`, `room_id`, `confirmation_code`, `status`) VALUES
('08/12/2013', '12/12/2013', 2, 1, 'k44wiic3', 'Active'),
('13/12/2013', '14/12/2013', 2, 2, 'owxqpzcb', 'Out'),
('12/12/2013', '15/12/2013', 2, 3, 'st4yz562', 'Active'),
('12/12/2013', '15/12/2013', 2, 3, 'kveu4ram', 'Out'),
('12/12/2013', '15/12/2013', 2, 1, '4awbcszh', 'Active'),
('20/12/2013', '28/12/2013', 2, 1, 'tym6pdz6', 'Out'),
('20/12/2013', '28/12/2013', 2, 1, 'bnnttoat', 'Out'),
('12/12/2013', '15/12/2013', 4, 1, 'd06otipx', 'Out'),
('14/12/2013', '20/12/2013', 2, 2, '0eym8ogv', 'Active'),
('14/12/2013', '20/12/2013', 2, 3, 'mdzvb7m4', 'Out'),
('14/12/2013', '20/12/2013', 1, 4, 'adwecix3', 'Active'),
('11/12/2013', '20/12/2013', 2, 2, 'hccr8n0p', 'Active');

CREATE TABLE `user` (
    `id` int(11) NOT NULL auto_increment,
    `username` varchar(30) NOT NULL,
    `password` varchar(30) NOT NULL,
    `role` varchar(45) NOT NULL,
    PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;

INSERT INTO `user` (`username`, `password`, `role`) VALUES
("admin", "admin", "admin"),
("user1", "user1", "clerk");
