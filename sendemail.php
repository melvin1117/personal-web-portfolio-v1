<?php
   

    session_cache_limiter( 'nocache' );
    header( 'Expires: ' . gmdate( 'r', 0 ) );
    header( 'Content-type: application/json' );


    $to         = 'me@smfelix.com';  
    $email_template = 'simple.html';
    $email_template_resp = 'simple_resp.html';

    $subject    = strip_tags($_POST['subject']);
    $email       = strip_tags($_POST['email']);
    $mob     = strip_tags($_POST['mob']);
    $name       = strip_tags($_POST['name']);
    $message    = nl2br( htmlspecialchars($_POST['message'], ENT_QUOTES) );
    $result     = array();
    $response_msg = "Thank you for contacting me. Will respond to you shortly.";
    $response_sub ="Response to your submission";
    $response_name = "Shubham Melvin Felix";

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
    if(empty($message)){

         $result = array( 'response' => 'error', 'empty'=>'message', 'message'=>'<strong>Error!</strong>&nbsp; Message body is empty.' );
         echo json_encode($result );
         die;
    }
    


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

    if ( mail( $email, $response_sub, $contents_resp, $headers_resp ) && mail( $to, $subject, $contents, $headers )) {
        $result = array( 'response' => 'success', 'message'=>'<strong style="text-transform:none;">Thank You for showing interest.</strong>&nbsp; Your email has been delivered.' );
    } else {
        $result = array( 'response' => 'error', 'message'=>'<strong>Error!</strong>&nbsp; Cann\'t Send Mail. Please Try Again.'  );
    }

    echo json_encode( $result );

    die;
    ?>