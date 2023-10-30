<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $phonenumber = $_POST["phonenumber"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  // Customize the recipient email address
  $recipient_email = "rdigininja@gmail.com";

  // Send the email to the recipient
  $to = $recipient_email;
  $subject = "New Contact Form Submission from $name";
  $headers = "From: $email";
  $message_body = "Name: $name\nPhonenumber: $phonenumber\nEmail: $email\nMessage: $message";
  
  // Send the email to the recipient
  mail($to, $subject, $message_body, $headers);

  // Send an auto-reply email to the user
  $user_subject = "Thank you for contacting us";
  $auto_reply_template = file_get_contents("auto_reply_template.html");

  // Replace placeholders in the template with actual data
  $auto_reply_template = str_replace("[USER_NAME]", $name, $auto_reply_template);
  $auto_reply_template = str_replace("[USER_EMAIL]", $email, $auto_reply_template);
  $auto_reply_template = str_replace("[USER_MESSAGE]", $message, $auto_reply_template);

  // Set the content type and headers for HTML email
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
  $headers .= "From: Your Company Name <yourcompany@example.com>\r\n";

  mail($email, $user_subject, $auto_reply_template, $headers);

  // You can also perform other actions here, like saving data to a database.

  http_response_code(200); // Set a success status code
} else {
  http_response_code(400); // Set a bad request status code
}

?>
