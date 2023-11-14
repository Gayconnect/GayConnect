<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = isset($_POST["username"]) ? htmlspecialchars($_POST["username"]) : "";
    $age = isset($_POST["age"]) ? intval($_POST["age"]) : 0;
    $city = isset($_POST["city"]) ? htmlspecialchars($_POST["city"]) : "";
    $interests = isset($_POST["interests"]) ? htmlspecialchars($_POST["interests"]) : "";

    // Validate the data (add more validation as needed)
    if (empty($username) || empty($city) || empty($interests) || $age <= 0) {
        die("Error: All fields are required.");
    }

    // File upload handling
    $avatarDir = "avatars/";
    $avatarPath = $avatarDir . basename($_FILES["avatar"]["name"]);

    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatarPath)) {
        // Save the profile data to a file or database (adjust as needed)
        $profileData = "Username: $username\nAge: $age\nCity: $city\nInterests: $interests\nAvatar: $avatarPath\n\n";
        $filename = "profiles.txt";

        // Open the file for writing (create if not exists)
        $file = fopen($filename, "a");
        if ($file) {
            // Write the profile data to the file
            fwrite($file, $profileData);
            // Close the file
            fclose($file);

            // Redirect to a success page or back to the form
            header("Location: success.html");
            exit();
        } else {
            die("Error: Unable to save profile data.");
        }
    } else {
        die("Error: File upload failed.");
    }
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: zaloz-profil.html");
    exit();
}
?>
