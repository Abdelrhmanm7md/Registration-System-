<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Mail configuration
    $to = "admin@pictogram.com"; // Replace with your email address
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $mailBody = "Name: $name\nEmail: $email\n\nSubject: $subject\n\nMessage:\n$message";

    // Attempt to send email
    if (mail($to, $subject, $mailBody, $headers)) {
        echo "<script>alert('Thank you for contacting us! We will get back to you soon.');</script>";
        echo "<script>window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Thank you for contacting us! We will get back to you soon.');</script>";
        echo "<script>window.location.href='contact.php';</script>";
    }
} else {
    header('Location: contact.php');
    exit;
}
?>
