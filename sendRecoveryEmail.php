<?php 
    require 'database.php';
    session_start();

    function encode_URL_safe($s){
        $search = array('$', '&', '+', ',', '/', ':', ';', '=', '?', '@');
        $replace = array('%24', '%26', '2B', '2C', '2F', '3A', '3B', '3D', '3F', '40');
        return str_replace($search, $replace, $s);
    }
    function decode_URL_safe($s){
        $search = array('%24', '%26', '2B', '2C', '2F', '3A', '3B', '3D', '3F', '40');
        $replace = array('$', '&', '+', ',', '/', ':', ';', '=', '?', '@');
        return str_replace($search, $replace, $s);
    }

    $email = $_POST['email'];

    $sql = "SELECT * FROM students WHERE Email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $userData = $stmt->fetchAll();
    if($stmt->rowCount()>0){
        //Mail password reset link
        // The message
        $message = "You are recieving this email because you requested a password reset for your LPNHS Acount.
        \r\nPlease click the following link or paste it into your web browser to reset your password. http://34.223.226.34/lpnhs/passwordReset.php?hash=".encode_URL_safe($userData[0][4])."&userID=".$userData[0][0]
        ."\r\nIf this does not pertain to you, please ignore this email.";

        // In case any of our lines are larger than 70 characters, we should use wordwrap()
        $message = wordwrap($message, 70, "\r\n");

        $headers = array(
            'From' => 'maintenanceLPNHS@gmail.com'
        );
        // Send
        mail($email, '[LPNHS] Password Reset Request', $message, $headers);
        echo 'email sent to ', $email, ' with message: ', $message;
    }
    else{
        header("location: forgotPassword.php?email=unknown");
    }
?>