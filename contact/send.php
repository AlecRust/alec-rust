<?
	session_start();
	$mailto = 'me@alecrust.com' ;
	$subject = "Alec Rust Contact" ;
	$formurl = "http://www.alecrust.com/contact/index.php" ;
	$errorurl = "http://www.alecrust.com/contact/error.htm" ;
	$thankyouurl = "http://www.alecrust.com/contact/done.htm" ;
	$name = $_POST['name'] ;
	$email = $_POST['email'] ;
	$subj = $_POST['subj'] ;
	$message = $_POST['message'] ;
	$http_referrer = getenv( "HTTP_REFERER" );
	if (!isset($_POST['email'])) {
		header( "Location: $formurl" );
		exit ;
	}
	if (empty($name) || empty($email) || empty($subj) || empty($message) || $_SESSION['answer'] != $_POST['answer']) {
	   header( "Location: $errorurl" );
	   exit ;
	}
	$name = strtok( $name, "\r\n" );
	$email = strtok( $email, "\r\n" );
	$subj = strtok( $subj, "\r\n" );
	if (get_magic_quotes_gpc()) {
		$message = stripslashes( $message );
	}
	$messageproper =
		"Name: " . $name ."\n" .
		"Email: " . $email ."\n" .
		"Subject: " . $subj ."\n\n" .
		"Message: " . $message ."\n" ;
	mail($mailto, $subject, $messageproper, "From: \"$name\" <$email>\r\nReply-To: \"$name\" <$email>\r\n" );
	header( "Location: $thankyouurl" );
	exit ;
?>