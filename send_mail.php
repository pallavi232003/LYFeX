<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
require __DIR__ . '/PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'pratiksindhiya103@gmail.com';
        $mail->Password = 'qbns vslv urmj fttb'; // Apna App Password Yahan Daalo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Sender and Recipient
        $mail->setFrom('pratiksindhiya103@gmail.com', 'TheLyfex Form Submission');
        $mail->addAddress('hi@thelyfex.com'); // Change this if needed

        // Identify form type
        $form_type = isset($_POST["form_type"]) ? $_POST["form_type"] : "";

        if ($form_type == "school-form") {
            // School Form Submission
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $role = htmlspecialchars($_POST["role"]);
            $school = htmlspecialchars($_POST["school"]);
            $program = htmlspecialchars($_POST["program"]);
            $location = htmlspecialchars($_POST["location"]);

            if (empty($name) || empty($email) || empty($phone) || empty($role) || empty($school) || empty($program) || empty($location)) {
                die("Error: All fields are required.");
            }

            $mail->Subject = "New Join Form Submission from TheLyfex";
            $mail->Body = "
                <h2>Join Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Role:</strong> $role</p>
                <p><strong>Institute/Company:</strong> $school</p>
                <p><strong>Preferred Program:</strong> $program</p>
                <p><strong>Location:</strong> $location</p>
            ";

        } elseif ($form_type == "insurance_form") {
            // Insurance Form Submission
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $role = htmlspecialchars($_POST["role"]);
            $school = htmlspecialchars($_POST["school"]);
            $program = "Insurance";  // Fixed value from form
            $location = htmlspecialchars($_POST["location"]);

            if (empty($name) || empty($email) || empty($phone) || empty($role) || empty($school) || empty($location)) {
                die("Error: All fields are required.");
            }

            $mail->Subject = "New Insurance Form Submission from TheLyfex";
            $mail->Body = "
                <h2>Insurance Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Role:</strong> $role</p>
                <p><strong>Institute/Company:</strong> $school</p>
                <p><strong>Program:</strong> $program</p>
                <p><strong>Location:</strong> $location</p>
            ";

        } 
         elseif ($form_type == "job_shadowing_form") {
            // Insurance Form Submission
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $role = htmlspecialchars($_POST["role"]);
            $school = htmlspecialchars($_POST["school"]);
            $program = "Job Shadowing";  // Fixed value from form
            $location = htmlspecialchars($_POST["location"]);

            if (empty($name) || empty($email) || empty($phone) || empty($role) || empty($school) || empty($location)) {
                die("Error: All fields are required.");
            }

            $mail->Subject = "New Job Shadowing Form Submission from TheLyfex";
            $mail->Body = "
                <h2>Job Shadowing Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Role:</strong> $role</p>
                <p><strong>Institute/Company:</strong> $school</p>
                <p><strong>Program:</strong> $program</p>
                <p><strong>Location:</strong> $location</p>
            ";

        }
         elseif ($form_type == "longterm-form") {
            // Insurance Form Submission
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $role = htmlspecialchars($_POST["role"]);
            $school = htmlspecialchars($_POST["school"]);
            $program = "LTI with Mentor";  // Fixed value from form
            $location = htmlspecialchars($_POST["location"]);

            if (empty($name) || empty($email) || empty($phone) || empty($role) || empty($school) || empty($location)) {
                die("Error: All fields are required.");
            }

            $mail->Subject = "New LTI with Mentor Form Submission from TheLyfex";
            $mail->Body = "
                <h2>LTI with Mentor Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Role:</strong> $role</p>
                <p><strong>Institute/Company:</strong> $school</p>
                <p><strong>Program:</strong> $program</p>
                <p><strong>Location:</strong> $location</p>
            ";

        } 
         elseif ($form_type == "mentor-form") {
            // Insurance Form Submission
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $role = "Mentor";
            $school = htmlspecialchars($_POST["school"]);
            $program = htmlspecialchars($_POST["program"]);
            $location = htmlspecialchars($_POST["location"]);

            if (empty($name) || empty($email) || empty($phone) || empty($role) || empty($school) || empty($location)) {
                die("Error: All fields are required.");
            }

            $mail->Subject = "New Mentor Form Submission from TheLyfex";
            $mail->Body = "
                <h2>Mentor Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Role:</strong> $role</p>
                <p><strong>Institute/Company:</strong> $school</p>
                <p><strong>Program:</strong> $program</p>
                <p><strong>Location:</strong> $location</p>
            ";

        }
         elseif ($form_type == "home-form") {
            // Insurance Form Submission
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $role = htmlspecialchars($_POST["role"]);
            $school = htmlspecialchars($_POST["school"]);
            $program = htmlspecialchars($_POST["program"]);
            $location = htmlspecialchars($_POST["location"]);

            if (empty($name) || empty($email) || empty($phone) || empty($role) || empty($school) || empty($location)) {
                die("Error: All fields are required.");
            }

            $mail->Subject = "New Join us Form Submission from TheLyfex";
            $mail->Body = "
                <h2>Join us Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Role:</strong> $role</p>
                <p><strong>Institute/Company:</strong> $school</p>
                <p><strong>Program:</strong> $program</p>
                <p><strong>Location:</strong> $location</p>
            ";

        }
        else {
            // Contact Form Submission
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $phone = htmlspecialchars($_POST["phone"]);
            $role = htmlspecialchars($_POST["role"]);
            $location = htmlspecialchars($_POST["location"]);
            $message = htmlspecialchars($_POST["message"]);

            if (empty($name) || empty($email) || empty($phone) || empty($role) || empty($location) || empty($message)) {
                die("Error: All fields are required.");
            }

            $mail->Subject = "New Enquiry from TheLyfex";
            $mail->Body = "
                <h2>Contact Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Role:</strong> $role</p>
                <p><strong>Location:</strong> $location</p>
                <p><strong>Message:</strong><br> $message</p>
            ";
        }

        $mail->isHTML(true);

        if ($mail->send()) {
            echo "<script>
                alert('Form Submitted Successfully!');
                window.location.href = 'index.html';
            </script>";
        } else {
            echo "<script>
                alert('Error: " . $mail->ErrorInfo . "'');
                window.history.back();
            </script>";
        }
    } catch (Exception $e) {
        echo "<script>
            alert('Error: {$mail->ErrorInfo}');
            window.history.back();
        </script>";
    }
}
?>
