<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate form fields
    $errors = array();
    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $mobile = trim($_POST["mobile"]);
    $dob = trim($_POST["dob"]);
    $age = trim($_POST["age"]);
    $gender = trim($_POST["gender"]);

    // Validate Fullname (text only and characters like comma and period)
    if (!preg_match('/^[a-zA-Z\s,.]+$/', $fullname)) {
        $errors[] = "Invalid Fullname. Only letters, spaces, commas, and periods are allowed.";
    }

    // Validate Email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email Address. Please enter a valid email format.";
    }

    // Validate Mobile Number (must be in the right format for Philippines mobile number)
    if (!preg_match('/^09\d{9}$/', $mobile)) {
        $errors[] = "Invalid Mobile Number. Please enter a valid Philippines mobile number (e.g., 0917456789).";
    }

    // Validate Date of Birth
    $dobDateTime = DateTime::createFromFormat('Y-m-d', $dob);
    if (!$dobDateTime) {
        $errors[] = "Invalid Date of Birth. Please select a valid date using the date picker.";
    } else {
        // Calculate Age
        $today = new DateTime();
        $ageDateTime = $today->diff($dobDateTime);
        $age = $ageDateTime->y;
    }

    // Validate Gender
    if (empty($gender)) {
        $errors[] = "Please select a gender.";
    }

    // If there are validation errors, return the error messages
    if (!empty($errors)) {
        $response = array("status" => "error", "message" => $errors);
        echo json_encode($response);
    } else {
        // If there are no errors, insert the data into the database using PDO
        try {
            require('DatabaseConnection.php');
            $connection = new DatabaseConnection();
            $pdo = $connection->getConnection();
           
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("INSERT INTO profiles (fullname, email, mobile, dob, age, gender) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$fullname, $email, $mobile, $dob, $age, $gender]);

            $response = array("status" => "success", "message" => "Form submitted successfully!");
            echo json_encode($response);
        } catch (PDOException $e) {
            $response = array("status" => "error", "message" => "Database Error: " . $e->getMessage());
            echo json_encode($response);
        }
    }
}
?>
