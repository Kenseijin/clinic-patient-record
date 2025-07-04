<?php

require 'setup.php';
$id=$_GET['id'] ?? null;

if(!$id){
	header('location:index.php');
	exit();
}
//get the current patient records.

	$sq= $db->prepare("SELECT * FROM `patient_records` WHERE id = ?");
	$sq->execute([$id]);
	$pt=$sq->fetch();

	if (!$pt){
		echo "no patient record found.";
		exit();
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Patient Record</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="edit-form-wrapper">
        <h1>Update Patient Record</h1>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($pt['id']) ?>" />

            <label>
                Name:
                <input type="text" name="name" value="<?= htmlspecialchars($pt['name']) ?>" required />
            </label>

            <label>
                Age:
                <input type="number" name="age" value="<?= htmlspecialchars($pt['age']) ?>" required />
            </label>

            <label>
                Medical Condition:
                <input type="text" name="condition" value="<?= htmlspecialchars($pt['condition']) ?>" required />
            </label>

            <label>
                Visit Date:
                <input type="text" name="visit_date" value="<?= htmlspecialchars($pt['visit_date']) ?>" required />
            </label>

            <label>
                Medication Prescribed:
                <input type="text" name="prescribed" value="<?= htmlspecialchars($pt['prescribed']) ?>" required />
            </label>

            <button type="submit">Update Record</button>
        </form>
        <p style="text-align:center; margin-top:15px;">
            <a href="index.php">← Back to Patient Visit List</a>
        </p>
    </div>
</body>
</html>

