<?php 
    require 'database.php';
    session_start();

    include 'loading.html';

    function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

    function generateToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
        }
        return $token;
    }

    $email = $_POST['email'];

    $sql = "SELECT * FROM students WHERE Email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $userData = $stmt->fetchAll();
    $userCount = $stmt->rowCount();

    if($userCount>0){
        //Generate token and ensure it is unique
        $token = "";
        $tokenCopies = 0;
        do{
            $token = generateToken(16);
            $sql = "SELECT * FROM passrecovertokens WHERE Token = :token";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['token'=>$token]);
            $tokenCopies = $stmt->rowCount();
        }while($tokenCopies>0);

        $expiration = date('Y-m-d', strtotime("+1 day")); //date 1 day in the future

        $sql = "INSERT INTO passrecovertokens VALUES (:token, :studentID, :expiration)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['token' => $token, 'studentID'=>$userData[0][0], 'expiration'=>$expiration]);

        //Mail password reset link
        // The message
        $message = "You are recieving this email because you requested a password reset for your LPNHS Acount.
        \r\nPlease click the following link or paste it into your web browser to reset your password. http://34.223.226.34/lpnhs/passwordReset.php?token=".$token."&userID=".$userData[0][0]."&emailLink=true"
        ."\r\nThis link will only function for the next two days.
        \r\nIf this does not pertain to you, please ignore this email.";

        // In case any of our lines are larger than 70 characters, we should use wordwrap()
        $message = wordwrap($message, 70, "\r\n");

        $headers = array(
            'From' => 'maintenanceLPNHS@gmail.com'
        );
        // Send
        if(mail($email, '[LPNHS] Password Reset Request', $message, $headers)){
            echo '<script>if(confirm("Password reset email sent"))
            header.location("index.php");</script>';
        }
        else{
            echo '<script>if(confirm("An error occurred. Please try again later."))
            header.location("forgotPassword.php");</script>';
        }
    }
    else{
        header("location: forgotPassword.php?email=unknown");
    }
?>