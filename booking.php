<?php
// Include the database connection file
// Include the database connection file
include 'include/db.php';
include 'include/header.php';

// Check if the connection was successful
$database = new Database();
$conn = $database->getConnection();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_email = $_POST['user_email']; // Fetch email from the form
    $phone_number = $_POST['phone_number'];
    $appointment_date = $_POST['appointment_date'];
    $service_type = $_POST['service_type'];  // Individual, Group, or Couple
    $notes = $_POST['notes'];
    $status = 'pending';  // Default status

    // Prepare the SQL query to insert the data into the database
    $sql = "INSERT INTO appointment (first_name, last_name, user_email, phone_number, appointment_date, service_type, notes, status) 
            VALUES (:first_name, :last_name, :user_email, :phone_number, :appointment_date, :service_type, :notes, :status)";

    // Execute the query and check if it was successful
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':user_email', $user_email); // Bind email to the SQL query
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':appointment_date', $appointment_date);
    $stmt->bindParam(':service_type', $service_type);
    $stmt->bindParam(':notes', $notes);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        // If the booking is successful, show a JavaScript alert
        echo "<script>alert('Your booking was successful!');</script>";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
    <link rel="stylesheet" href="assets/css/booking.css">
    <link rel="stylesheet" href="assets/css/header.css">

</head>
<body>
    <div class="container">
        <h2 class="page-title">Book an Appointment</h2>
        <form method="POST" action="booking.php">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            
            <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" id="user_email" name="user_email" required>
        </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>

            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="datetime-local" id="appointment_date" name="appointment_date" required>
            </div>

            <div class="form-group">
                <label for="service_type">Service Type</label>
                <select id="service_type" name="service_type" required>
                    <option value="individual">Individual</option>
                    <option value="group">Group</option>
                    <option value="couple">Couple</option>
                </select>
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes" rows="4" placeholder="Optional: Any notes"></textarea>
            </div>

            <button type="submit" class="cta-button">Submit Booking</button>
        </form>
    </div>
</body>
</html>
<style>
/* Global styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #f9f9f9;
    
    font-size: 16px;
}

/* Container for form */
.container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 40px;
    max-width: 600px;
    margin: 0 auto;
}

.page-title {
    text-align: center;
    font-size: 24px;
    margin-bottom: 30px;
    color: #333;
}

/* Form group */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-size: 18px;
    color: #333;
    display: block;
    margin-bottom: 8px;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 16px;
}

.form-group textarea {
    resize: vertical;
}

/* Submit button */
.cta-button {
    background-color: #7A8A6A;
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 18px;
    cursor: pointer;
    border-radius: 5px;
    width: 100%;
    transition: background-color 0.3s ease;
}

.cta-button:hover {
    background-color: #0056b3;
}

/* Responsiveness for mobile */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }

    .page-title {
        font-size: 20px;
    }
}

</style>