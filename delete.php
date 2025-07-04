<?php
require 'setup.php';

if(isset($_GET['id'])){
	$id=$_GET['id'];

	$sq=$db->prepare("DELETE FROM `patient_records` WHERE id = ?");
	$sq->execute([$id]);
}

header('location:index.php');
?>