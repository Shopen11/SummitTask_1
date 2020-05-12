<?php
require "libs/rb-mysql.php";
R::setup( 'mysql:host=localhost;dbname=mybase', 'root', '');
session_start();