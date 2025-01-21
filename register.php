<?php
$uname1 = $_POST['uname1'];
$email  = $_POST['email'];
$upswd1 = $_POST['upswd1'];
$upswd2 = $_POST['upswd2'];

if (!empty($uname1) && !empty($email) && !empty($upswd1) && !empty($upswd2)) {

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        die();
    }

    // Check if passwords match
    if ($upswd1 !== $upswd2) {
        echo "Passwords do not match";
        die();
    }

    // Hash passwords
    $upswd1_hashed = password_hash($upswd1, PASSWORD_DEFAULT);
    $upswd2_hashed = password_hash($upswd2, PASSWORD_DEFAULT);

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = ""; // Use empty password if root has no password, or set the correct password
    $dbname = "project";

    // Create connection  
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    
    if (mysqli_connect_error()) {
        die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT email FROM register WHERE email = ? LIMIT 1";
        $INSERT = "INSERT INTO register (uname1, email, upswd1, upswd2) VALUES (?, ?, ?, ?)";

        // Prepare statement to check if email already exists
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        // Checking if email already exists
        if ($rnum == 0) {
            $stmt->close();

            // Prepare statement to insert new user
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssss", $uname1, $email, $upswd1_hashed, $upswd2_hashed);
            $stmt->execute();
            echo "New record inserted successfully";
        } else {
            echo "Someone is already registered with this email";
        }

        $stmt->close();
        $conn->close();
    }

} else {
    echo "All fields are required";
    die();
}
?>