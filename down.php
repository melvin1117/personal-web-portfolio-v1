<?php
   

    $to         = 'me@smfelix.com';  
    $email       = strip_tags($_POST['email']);
    $mob     = strip_tags($_POST['mob']);
    $name       = strip_tags($_POST['name']);

    $subject = "Recent download of CV by ".$name;
   


    $headers  = "From: " . $name . ' <' . $email . '>' . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $contents = $email."\n".$mob."\n".$name."\n".$subject;
   
  
        if(mail( $to, $subject, $contents, $headers )){
       echo "Success";
        
    } else {
       echo "Fail";
    }

?>