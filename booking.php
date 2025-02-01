<?php
// Përfshirja e skedarit për lidhjen me bazën e të dhënave
include 'include/db.php';
include 'include/header.php';

// Kontrollo nëse lidhja është krijuar me sukses
$database = new Database();
$conn = $database->getConnection();

// Kontrollo nëse formulari është dërguar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Merr të dhënat nga formulari
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $appointment_date = $_POST['appointment_date'];
    $service_type = $_POST['service_type'];  // Individual, Group, or Couple
    $notes = $_POST['notes'];
    $status = 'pending';  // Default status

    // Pregatisim pyetjen për të futur të dhënat në bazën e të dhënave
    $sql = "INSERT INTO appointment (first_name, last_name, phone_number, appointment_date, service_type, notes, status) 
            VALUES (:first_name, :last_name, :phone_number, :appointment_date, :service_type, :notes, :status)";

    // Ekzekuto pyetjen SQL dhe kontrollo nëse është ekzekutuar me sukses
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':appointment_date', $appointment_date);
    $stmt->bindParam(':service_type', $service_type);
    $stmt->bindParam(':notes', $notes);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        // Kur rezervimi bëhet me sukses, shfaq alert në JavaScript
        echo "<script>alert('Rezervimi është bërë me sukses!');</script>";
    } else {
        echo "Gabim: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervimi i Takimeve</title>
    <link rel="stylesheet" href="assets/css/booking.css">
</head>
<body>
<br><br>
    <div class="container">
        <h2>Rezervoni një Takim</h2><br>
        <form method="POST" action="booking.php">
            <div class="form-group">
                <label for="first_name">Emri</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Mbiemri</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Numri i Telefonit</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>

            <div class="form-group">
                <label for="appointment_date">Data e Takimit</label>
                <input type="datetime-local" id="appointment_date" name="appointment_date" required>
            </div>

            <div class="form-group">
                <label for="service_type">Lloji i Shërbimit</label>
                <select id="service_type" name="service_type" required>
                    <option value="individual">Individual</option>
                    <option value="group">Grup</option>
                    <option value="couple">Çift</option>
                </select>
            </div>

            <div class="form-group">
                <label for="notes">Shënime</label>
                <textarea id="notes" name="notes" rows="4" placeholder="Shkruani shënime (opsionale)"></textarea>
            </div>

            <button type="submit" class="cta-button">Dërgo Rezervimin</button>
        </form>
    </div>

</body>
</html>
