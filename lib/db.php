<?php

/**
 * db.php - Set up the database connection
 * PHP Version 5.3.+
 * @package spacehotel
 * @author Nicolaas van der Merwe <nicolvandermerwe@gmail.com>
 * @copyright 2013 Nicolaas van der Merwe
 */
require_once 'config.php';
require 'rb.php';
R::setup('mysql:host=localhost;dbname=' . DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD); 
