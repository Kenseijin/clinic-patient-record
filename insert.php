<?php

require 'setup.php';

IF ($_SERVER['REQUEST_METHOD']==='POST'){
	$name=$_POST['name'];
	$age=$_POST['age'];
	$condition=$_POST['condition'];
	$visit_date=$_POST['visit_date'];
	$prescribed=$_POST['prescribed'];


						//insert data into the database
			$sq=$db->prepare("INSERT INTO `patient_records`(name,age,condition,visit_date,prescribed) VALUES (?,?,?,?,?)");
			$sq->execute([$name,$age,$condition,$visit_date,$prescribed]);
			
						//get back to the index page
			header('location:index.php');
}

?>