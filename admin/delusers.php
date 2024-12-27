<?php
session_start(); // Start the session

$id = $_GET['id'];
include '../database/db.php';

// Delete the user from the database
$delete = $conn->prepare("DELETE FROM users WHERE id=? ");
$delete->bindValue(1, $id);
$delete->execute();

// Destroy the user session


// Redirect to delusers.php
header('location:users.php');
?>
