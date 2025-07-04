<?php
try {
  // Connect to SQLite
    $db = new PDO('sqlite:clinic_records.db');

    // Create table if it doesn't exist
    $db->exec("CREATE TABLE IF NOT EXISTS patient_records (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT, 
        age INTEGER, 
        condition TEXT,
        visit_date TEXT,
        prescribed TEXT
    )");
} catch (PDOException $er) {
    echo "Database error: " . $er->getMessage();
    exit();
}
?>
