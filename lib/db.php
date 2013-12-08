<?php
require_once 'config.php';
require 'rb.php';
R::setup('mysql:host=localhost;dbname=' . DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD); 
