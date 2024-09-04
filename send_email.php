<?php

$errors = [];

if (!empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $option = isset($_POST['taskOption']) ? $_POST['taskOption'] : false;
   if ($option) {
      echo htmlentities($_POST['taskOption'], ENT_QUOTES, "UTF-8");
   } else {
     echo "task option is required";
     exit; 
   }
 
  if (empty($name)) {
      $errors[] = 'Name is empty';
  }

  if (empty($email)) {
      $errors[] = 'Email is empty';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Email is invalid';
  }

  if (empty($mobile)) {
      $errors[] = 'Phone number is empty';
  }
}
if (empty($errors)) {
        // Recipient email address (replace with your own)
        $recipient = "kalyaan@revgo.xyz";

        // Additional headers
        $headers = "From: $name <$email>";

        // Send email
        if (mail($recipient, $message, $headers)) {
            echo "Email sent successfully!";
        } else {
            echo "Failed to send email. Please try again later.";
        }
    } else {
        // Display errors
        echo "The form contains the following errors:<br>";
        foreach ($errors as $error) {
            echo "- $error<br>";
        }
    }
} else {
    // Not a POST request, display a 403 forbidden error
    header("HTTP/1.1 403 Forbidden");
    echo "You are not allowed to access this page.";
}
?>
