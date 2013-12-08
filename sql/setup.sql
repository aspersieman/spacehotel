CREATE DATABASE spacehotel;

USE `spacehotel`;

CREATE USER 'spacehotel'@'localhost' IDENTIFIED BY  'spacehotel';

GRANT ALL PRIVILEGES ON * . * TO  'spacehotel'@'localhost' IDENTIFIED BY  'spacehotel' WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

GRANT ALL PRIVILEGES ON  `spacehotel` . * TO  'spacehotel'@'localhost';

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

INSERT INTO `room` (`type`, `rate`, `description`, `quantity`, `max_adult`, `max_child`) VALUES
("Double AC", 1500, "Fully air conditioned with double bed with a view of the equator", 8, 1, 1),
("Single AC Capsule", 1300, "Fully air conditioned with single bed inside a spacious 2m X 1m X 1m capsule", 5, 1, 1),
("Standard Single ", 950, "Fan with single bed. Includes complimentary regeneration chamber treatment - perfect for those allergic to space cats or death", 3, 1, 1),
("Standard Double", 1100, "Fan with double bed, digital computer and analog toaster. This room has the works!", 3, 1, 1);

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
