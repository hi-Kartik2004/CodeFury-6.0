<?php
error_reporting(E_ALL);
session_start();
require_once("config.php");
require_once("sendmail.php");
require_once '../vendor/autoload.php';

use Pj8912\PhpBardApi\Bard;

$mail->SMTPDebug = 0; // Disable debug output

// This is a actions page.
// echo "actions page";
$conn = mysqli_connect(server, host, password, db_name);

// ============= Logout ============

if (isset($_GET['logout'])) {
    global $conn;
    $email = $_SESSION["login"]["data"]["email"];
    $setLoginQuery = "UPDATE `users` SET `connect` = '0' WHERE `users`.`email` = '$email';";
    $run2 = mysqli_query($conn, $setLoginQuery);
    if ($run2) {
        // Handling the logout for details_table

        // Select the maximum `updated_at` value for the given email
        $subQuery = "SELECT MAX(`updated_at`) FROM `user_details` WHERE `email` = '$email'";
        $subResult = mysqli_query($conn, $subQuery);

        if ($subResult && mysqli_num_rows($subResult) > 0) {
            // Fetch the maximum updated_at value
            $row = mysqli_fetch_assoc($subResult);
            $maxUpdatedAt = $row['MAX(`updated_at`)'];

            // Update the status column to 0 for the rows that match the email and have the maximum updated_at value
            $updateQuery = "UPDATE `user_details` SET `status` = 0 WHERE `email` = '$email';";
            $updateResult = mysqli_query($conn, $updateQuery);

            if ($updateResult) {
                // echo "Account status updated successfully for the most recent record.";
                // echo "inside";
                unset($_SESSION);
                session_destroy();
                header("location: ../../?home");
            } else {
                $_SESSION["err"]["err_msg"] = "Could not update Login History!";
                unset($_SESSION);
                session_destroy();
                header("location: ../../?login");
            }
        } else {
            $_SESSION["err"]["err_msg"] = "No login history found!";
            unset($_SESSION);
            session_destroy();
            header("location: ../../?login");
        }
    }
}



//=============== Handling register ================

else if (isset($_GET['register'])) {
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $email = $_POST["email"];
    $_SESSION["prev_firstname"] = $firstName;
    $_SESSION["prev_lastname"] = $lastName;
    $_SESSION["prev_password"] = $password;
    $_SESSION["prev_email"] = $email;
    // $_SESSION["prev_firstname"] = $firstName;


    $conn = mysqli_connect(server, host, password, db_name);

    if ($conn) {
        if ($cpassword == $password) {
            $selectQuery = "SELECT * FROM `users` WHERE email = '$email';";
            $run = mysqli_query($conn, $selectQuery);
            if (mysqli_num_rows($run) > 0) {
                // echo "User exists";
                $_SESSION["err"] = array();
                $_SESSION["err"]["err_msg"] = "User already exists!, Kindly Login!";
                header("location: ../?register");
            } else {
                sendVerificationMail($email);
            }
        } else {
            $_SESSION["err"]["err_msg"] = "Password Mismatch";
            header("location: ../?register");
        }
    } else {
        echo "no";
    }
}

// ============ Verification =============

else if (isset($_GET["verify"])) {
    $code = $_GET["verify"];
    // echo $code;
    global $conn;
    if ($code == $_SESSION["verification_code"] && isset($_SESSION["prev_email"])) {
        // echo "inside";
        $firstName = $_SESSION["prev_firstname"];
        $lastName = $_SESSION["prev_lastname"];
        $email = $_SESSION["prev_email"];
        $password = $_SESSION["prev_password"];
        $ip = $_SERVER['REMOTE_ADDR'];
        $query = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`,`auth`, `connect`, `ip`) VALUES ('$firstName', '$lastName', '$email', '$password', 1, 'v', '$ip' );";
        $run = mysqli_query($conn, $query);

        if ($run) {
            // echo "record inserted";
            $_SESSION["err"] = array();
            $_SESSION["err"]["err_msg"] = "SignUp Success, Kindly Login below!";
            unset($_SESSION["verification_code"]);
            header("location: ../../?login");
        } else {
            // echo "Failed to insert";
            $_SESSION["err"] = array();
            $_SESSION["err"]["err_msg"] = "Verfication Failed! Something went wrong!";
            header("location: ../../?login");
        }
    } else {
        $_SESSION["err"] = array();
        $_SESSION["err"]["err_msg"] = "Recheck if you are using the same browser which was used to register!, else Code mismtach!";
        header("location: ../../?login");
    }
}

// ============== Handling login ================
else if (isset($_GET['login'])) {
    $password = $_POST["password"];
    $email = $_POST["email"];

    $conn = mysqli_connect(server, host, password, db_name);

    if ($conn) {
        $selectQuery = "SELECT * FROM `users` WHERE email = '$email';";
        $run = mysqli_query($conn, $selectQuery);
        $data = mysqli_fetch_assoc($run);
        if (mysqli_num_rows($run) > 0) {
            // echo "User exists";
            if ($password == $data["password"]) {
                $ip = $ipAddress = $_SERVER['REMOTE_ADDR'];
                $setLoginQuery = "UPDATE `users` SET `connect` = '1', `ip` = '$ip' WHERE `users`.`email` = '$email';";
                $run2 = mysqli_query($conn, $setLoginQuery);
                if ($run2) {
                    $_SESSION["err"] = array();
                    $_SESSION["err"]["err_msg"] = "Login Success!";
                    $_SESSION["login"]["status"] = 1;
                    $_SESSION["login"]["data"] = $data;
                    global $conn;
                    $setLoginHistoryQuery = "INSERT INTO `user_details` (`email`, `updated_at`, `ip`, `status`) VALUES ('$email', current_timestamp(), '$ip', '1');";
                    $runDetails = mysqli_query($conn, $setLoginHistoryQuery);
                    if ($runDetails) {
                    }
                    if (!$runDetails) {
                        $_SESSION["err"]["err_msg"] = "Could not update Login History!";
                    }

                    // Accessing the user_details for login history;
                    $selectQuery = "SELECT * FROM `user_details` WHERE `email` = '$email';";
                    $result = mysqli_query($conn, $selectQuery);
                    $loginHistory = mysqli_fetch_all($result);
                    $_SESSION["login"]["loginHistory"] = $loginHistory;
                    header("location: ../?profile");
                } else {
                    $_SESSION["err"] = array();
                    $_SESSION["err"]["err_msg"] = "unable to connect with database!";
                    // echo "unable to connect with database";
                    header("location: ../?login");
                }
            } else {
                $_SESSION["err"] = array();
                $_SESSION["err"]["err_msg"] = "Incorrect Password!";
                header("location: ../?login");
            }
        } else {
            // echo "Failed to insert";
            $_SESSION["err"] = array();
            $_SESSION["err"]["err_msg"] = "User does not exist! Register Now";
            header("location: ../?login");
        }
    } else {
        $_SESSION["err"] = array();
        $_SESSION["err"]["err_msg"] = "unable to connect with database!";
        // echo "unable to connect with database";
        header("location: ../?register");
    }
}

// =============== Handling edit profile =============
else if (isset($_GET['edit-profile'])) {
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_SESSION["login"]["data"]["email"];
    $phone = $_POST["phone"];

    // print_r($_POST);
    // echo $email;

    if (isset($firstName) && isset($lastName) && isset($phone)) {
        // echo "inside";
        if (empty(trim($firstName))) {
            $_SESSION["err"]["err_msg"] = "First Name cannot be blank";
            header("location:../?edit-profile");
        }
        if (empty(trim($lastName))) {
            $_SESSION["err"]["err_msg"] = "Last Name cannot be blank";
            header("location:../?edit-profile");
        }
        if (empty(trim($phone))) {
            $_SESSION["err"]["err_msg"] = "Phone number cannot be blank";
            header("location:../?edit-profile");
        }

        $conn = mysqli_connect(server, host, password, db_name);

        if ($conn) {

            $selectQuery = "UPDATE `users` SET `first_name` = '$firstName', `last_name` = '$lastName', `phone` = '$phone' WHERE `users`.`email` = '$email'";

            $run = mysqli_query($conn, $selectQuery);
            if ($run) {
                // echo "User exists";
                $_SESSION["err"]["err_msg"] = "Details Updated Successfully!";
                $selectQuery2 = "SELECT * FROM `users` WHERE email = '$email';";
                $run2 = mysqli_query($conn, $selectQuery2);
                $data = mysqli_fetch_assoc($run2);
                if (mysqli_num_rows($run2) > 0) {
                    $_SESSION["login"]["status"] = 1;
                    $_SESSION["login"]["data"] = $data;
                    header("location: ../?profile");
                } else {
                    $_SESSION["err"]["err_msg"] = "Something went wrong!";
                    header("location: ../?profile");
                }
            } else {
                // echo "failed";
                $_SESSION["err"]["err_msg"] = "Something went wrong! Updating details failed!";
                header("location: ../?profile");
            }
            // } else {
            //     $_SESSION["err"] = array();
            //     $_SESSION["err"]["err_msg"] = "Password Mismatch";
            //     header("location: ../?register");
            // }
        } else {
            echo "db not connected";
        }
    } else {
        $_SESSION["err"]["err_msg"] = "Something was left blank!";
        header("location: ../?edit-profile");
    }
}

// ================ Handling edit password ================

else if (isset($_GET["edit-password"])) {
    $password = $_POST["newPassword"];
    $cpassword = $_POST["cpassword"];
    $oldPassword = $_POST["oldPassword"];
    $email = $_SESSION["login"]["data"]["email"];

    $conn = mysqli_connect(server, host, password, db_name);

    if ($conn) {
        if ($cpassword == $password) {
            $selectQuery = "UPDATE `users` SET `password` = '$password' WHERE `users`.`email` = '$email';";
            $run = mysqli_query($conn, $selectQuery);
            if ($run) {
                $_SESSION["err"]["err_msg"] = "Password Successfully Changed!";
                header("location: ../?profile");
            } else {
                $_SESSION["err"]["err_msg"] = "Something went wrong!";
                header("location: ../?profile");
            }
        } else {
            $_SESSION["err"] = array();
            $_SESSION["err"]["err_msg"] = "Password Mismatch";
            header("location: ../?edit-password");
        }
    } else {
        echo "db not connected!";
    }
}



// ============== Handling forgot Password =========

else if (isset($_GET["forgot"])) {
    $conn = mysqli_connect(server, host, password, db_name);
    $email = $_POST["email"];
    $selectQuery = "SELECT * FROM `users` WHERE email = '$email';";
    $run = mysqli_query($conn, $selectQuery);
    if ($run) {
        if (mysqli_num_rows($run) > 0) {
            $data = mysqli_fetch_assoc($run);
            $password = $data["password"];
            sendForgotMail($email, $password);
        } else {
            $_SESSION["err"]["err_msg"] = "User does not exist!";
            header("location: ../?forgot");
        }
    } else {
        $_SESSION["err"]["err_msg"] = "Unable to send Mails!";
        header("location: ../?forgot");
    }
}

// ========== Handling assessment form ======
else if (isset($_GET["assessment"])) {
    global $conn;
    $email = $_SESSION["login"]["data"]["email"];
    $sum = 0;

    for ($i = 1; $i <= 10; $i++) {
        $questionName = "question" . $i;
        if (isset($_POST[$questionName])) {
            $sum += (int)$_POST[$questionName];
        }
    }



    $sql = "INSERT INTO `assessments` (`email`, `score`) VALUES ('$email', '$sum');";
    $run = mysqli_query($conn, $sql);
    if ($run) {
        $msg = "";
        if ($sum > 25) {
            $msg = "Your score is " . $sum . "/30. You are at high risk of depression. Kindly consult a doctor.";
        } else if ($sum > 15) {
            $msg = "Your score is " . $sum . "/30. You are at moderate risk of depression. Your community is here for you!";
        } else {
            $msg = "Your score is " . $sum . "/30. You are at low risk of depression. Yet you can always help others";
        }

        $_SESSION["err"]["err_msg"] = $msg;
    } else {
        $_SESSION["err"]["err_msg"] = "Unable to insert record in database";
    }

    header("location: ../?assessment");
} else if (isset($_GET["chatgpt"])) {

    $_ENV['BARD_API_KEY_X'] = "bAhwWdgYJseTIeEDDJuAJAY34ovg0SdKSfKRvT_V_BQ9eFaLvjSi5qCCYMVSeEOgjvW2Cw.";
    $_ENV['BARD_API_KEY_Y'] = "sidts-CjIB3e41hajn4AEL9KkWKUS7Fe64ZwAUBg4yo12qETt7v6WwCbQ9oV2dP545kefQTNNJwxAA";
    echo "Hey";
    $bard = new Bard();
    $input_text = "Hello, Bard!";
    $result = $bard->get_answer($input_text);

    if (isset($result['choices'][0]['content'][0])) {
        // Print the Bard's reply
        print($result['choices'][0]['content'][0]);
    } else {
        // Handle the case where there is no valid response
        print("Bard did not provide a response.");
    }
} else if (isset($_GET["addPost"])) {
    $name = $_SESSION["login"]["data"]["first_name"];
    $email = $_SESSION["login"]["data"]["email"];
    $post = $_POST["post"];
    global $conn;

    if ($conn) {
        $query = "INSERT INTO `posts` (`name`, `email`, `post`) VALUES ('$name', '$email', '$post');";
        $run = mysqli_query($conn, $query);
        echo "Inside";
        if ($run) {
            $_SESSION["err"]["err_msg"] = "Post added successfully!";
            header("location: ../?past");
        } else {
            $_SESSION["err"]["err_msg"] = "Something went wrong!";
            header("location: ../?past");
        }
    } else {
        $_SESSION["err"]["err_msg"] = "Unable to connect with database!";
        header("location: ../?past");
    }
} else if (isset($_GET["past"])) {
    global $conn;
    $query = "SELECT * FROM `posts` ORDER BY `id` DESC";
    $result = mysqli_query($conn, $query);

    if ($result) {

        if (mysqli_num_rows($result) > 0) {
            $posts = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $posts[] = $row;
            }

            $_SESSION['posts'] = $posts;
        } else {
            $_SESSION["err"]["err_msg"] = "No posts Found!";
        }
    } else {
        $_SESSION["err"]["err_msg"] = "Error fetching posts: " . mysqli_error($conn);
    }

    header("location: ../?past");
} else {
    $_SESSION["err"]["err_msg"] = "No action found!";
    header("location: ../?profile");
}
