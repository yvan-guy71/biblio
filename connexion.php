<?php
$host ='localhost';
$user ='root';
$db = 'book_store';
$con = new mysqli("localhost","root","","book_store");

if ($con->connect_error) {
    die("erreur de connexion: " . $con->connect_error);
}
else {
    //echo "connexion reussi";
}

