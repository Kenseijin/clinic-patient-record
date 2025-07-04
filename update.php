<?php
	require 'setup.php';

	if($_SERVER['REQUEST_METHOD']==='POST'){
		$id=$_POST['id'];
		$name=$_POST['name'];
	    $age=$_POST['age'];
	    $condition=$_POST['condition'];
	    $visit_date=$_POST['visit_date'];
	    $prescribed=$_POST['prescribed'];

	    $sq=$db->prepare("UPDATE `patient_records` SET name=?,age=?,condition=?,visit_date=?,prescribed=? WHERE id=?");
	    $sq->execute([$name,$age,$condition,$visit_date,$prescribed,$id]);

	    header('Location:index.php');
	    exit();
	}
?>