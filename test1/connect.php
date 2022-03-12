<?php
$servername = "localhost";
$username = "postgres";
$password = "1";
$dbname = "Project_real";

// Create connection
$conn = pg_connect("host=$servername port=5432 dbname=$dbname user=$username password=$password")
    or die('Could not connect: ' . pg_last_error());
?>