<?php
require 'setup.php';

// Get search query if any
$search = $_GET['search'] ?? '';

if ($search) {
    // Prepare and execute search query safely
    $stmt = $db->prepare("SELECT * FROM patient_records WHERE name LIKE ? ORDER BY id DESC");
    $stmt->execute(['%' . $search . '%']);
    $pt_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Get all records if no search
    $pt_records = $db->query("SELECT * FROM patient_records ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
}

// Optional: $message from session or elsewhere if you implement messages
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);  // clear after showing, if using session for messages
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Clinic Patient Records</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>Clinic Visit Records</h1>

    <!-- Toggle Add Patient Modal Button -->
    <button class="toggle-btn" onclick="toggleForm()">➕ Add Patient</button>

    <!-- Floating Modal Add Patient Form -->
    <div class="modal-form-wrapper" id="patientFormModal">
        <form action="insert.php" method="POST" class="entry-form">
            <h3>Add Patient Record</h3>
            <label>
                Name:
                <input type="text" name="name" required />
            </label>
            <label>
                Age:
                <input type="number" name="age" required />
            </label>
            <label>
                Condition:
                <input type="text" name="condition" required />
            </label>
            <label>
                Visit Date:
                <input type="text" name="visit_date" required />
            </label>
            <label>
                Medication:
                <input type="text" name="prescribed" required />
            </label>
            <div class="form-actions">
                <button type="submit">Save</button>
                <button type="button" onclick="toggleForm()">Cancel</button>
            </div>
        </form>
    </div>

    <!-- Optional message box -->
    <?php if (!empty($message)): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <h2>Patient Records</h2>

    <!-- Search bar -->
    <form method="GET" action="index.php" class="search-bar">
        <input
            type="text"
            name="search"
            placeholder="Search by Name..."
            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
        />
        <button type="submit">Search</button>
    </form>

    <!-- Patient Records Table -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Medical Condition</th>
                <th>Visit Date</th>
                <th>Medication</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pt_records as $pt): ?>
            <tr>
                <td><?= htmlspecialchars($pt['name']) ?></td>
                <td><?= htmlspecialchars($pt['age']) ?></td>
                <td><?= htmlspecialchars($pt['condition']) ?></td>
                <td><?= htmlspecialchars($pt['visit_date']) ?></td>
                <td><?= htmlspecialchars($pt['prescribed']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $pt['id'] ?>" class="edit">Edit</a>
                    <a href="delete.php?id=<?= $pt['id'] ?>" class="delete" onclick="return confirm('Delete this record?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function toggleForm() {
            const modal = document.getElementById('patientFormModal');
            modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
