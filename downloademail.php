<?php
   

    session_cache_limiter( 'nocache' );
    header( 'Expires: ' . gmdate( 'r', 0 ) );
    header( 'Content-type: application/json' );


    $to         = 'me@smfelix.com';  
    $email_template = 'simple.html';
    $email_template_resp = 'simple_resp.html';

    $email       = strip_tags($_POST['email']);
    $mob     = strip_tags($_POST['mob']);
    $name       = strip_tags($_POST['name']);

    $response_msg = "Thank you for downloading my CV. Hope you like it! :)";
    $response_sub ="Response to your download";
    $response_name = "Shubham Melvin Felix";
    $subject = "Recent download of CV by ".$name;
    $date = date_create();
    $ip=$_SERVER['REMOTE_ADDR'];
    $message ="The CV was downloaded on ".date_format($date, 'Y-m-d H:i:s') . "\n This is the IP of the user : ".$ip;
    if(empty($name)){

        $result = array( 'response' => 'error', 'empty'=>'name', 'message'=>'<strong>Error!</strong>&nbsp; Name is empty.' );
        echo json_encode($result );
        die;
    } 

    if(empty($email)){

        $result = array( 'response' => 'error', 'empty'=>'email', 'message'=>'<strong>Error!</strong>&nbsp; Email is empty.' );
        echo json_encode($result );
        die;
    } 
    if($email==$to){

        $result = array( 'response' => 'error', 'empty'=>'email', 'message'=>'<strong>Error!</strong>&nbsp; Sorry you have to use your email id not my. :)' );
        echo json_encode($result );
        die;
    } 
    if(empty($mob)){

        $result = array( 'response' => 'error', 'empty'=>'mobile', 'message'=>'<strong>Error!</strong>&nbsp; Mobile is empty.' );
        echo json_encode($result );
        die;
    }
    
     if(!(preg_match('/^\d{10}$/', $mob))){

        $result = array( 'response' => 'error', 'empty'=>'mobile', 'message'=>'<strong>Error!</strong>&nbsp; Mobile must be 10 digit. Try Again.' );
        echo json_encode($result );
        die;
    } 
   
   // echo '<script type="text/javascript">
   //          window.open(\'index.php','_blank\');
   //          </script>';


    $headers  = "From: " . $name . ' <' . $email . '>' . "\r\n";
    $headers .= "Reply-To: ". $email . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $headers_resp  = "From: " . $response_name . ' <' . $to . '>' . "\r\n";
    $headers_resp .= "Reply-To: ". $to . "\r\n";
    $headers_resp .= "MIME-Version: 1.0\r\n";
    $headers_resp .= "Content-Type: text/html; charset=UTF-8\r\n";

    $templateTags =  array(
        '{{subject}}' => $subject,
        '{{email}}'=>$email,
        '{{mob}}'=>$mob,
        '{{message}}'=>$message,
        '{{name}}'=>$name
        );
    $templateTags_resp =  array(
        '{{subject}}' => $response_sub,
        '{{email}}'=>$to,
        '{{message}}'=>$response_msg,
        '{{name}}'=>$response_name
        );


    $templateContents = file_get_contents( dirname(__FILE__) . '/email-templates/'.$email_template);
    $templateContents_resp = file_get_contents( dirname(__FILE__) . '/email-templates/'.$email_template_resp);

    $contents =  strtr($templateContents, $templateTags);
    $contents_resp =  strtr($templateContents_resp, $templateTags_resp);

  
     echo $contents_resp."\n".$contents;
    if ( mail( $email, $response_sub, $contents_resp, $headers_resp )) {
        if(mail( $to, $subject, $contents, $headers )){
        $result = array( 'response' => 'success', 'message'=>'<strong style="text-transform:none;">Thank You for downloading.</strong>' );
        
    }
        
    } else {
        $result = array( 'response' => 'error', 'message'=>'<strong>Error!</strong>&nbsp; Cann\'t downloading the CV.Please try Again.'  );
    }

    echo json_encode( $result );

    die;