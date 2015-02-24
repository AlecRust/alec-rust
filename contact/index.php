<?php

session_start();
$int1 = rand(1,10);
$int2 = rand(1,10);

while(($int1 - $int2) < 0) {
	$int1 = rand(1,10);
	$int2 = rand(1,10);
	if(($int1 - $int2) > 0) break;
}

if($int1 > $int2) {
	$method = 'plus';
}
else $method = 'subtract';

switch($method) {
	case 'plus':
	$answer = $int1 + $int2;
	break;
	case 'subtract':
	$answer = $int1 - $int2;
	break;
}

$question = 'What is '.$int1.' '.$method.' '.$int2.'?';

$_SESSION['answer'] = (string) $answer;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Alec Rust - Contact</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="alec rust" />
<meta name="description" content="Alec Rust is an experienced, UK based front end web developer available for short term projects." />
<meta name="robots" content="index,follow" />
<meta name="author" content="Alec Rust" />
<link href="../css/global-min.css" rel="stylesheet" type="text/css" />
<script src="../js/form-validation.js" type="text/javascript"></script>
</head>
<body>
	<div id="wrap">
  	<div id="head">
    	<h1><a href="http://www.alecrust.com/" title="Alec Rust">Alec Rust</a></h1>
      <ul>
      	<li><a href="../contact/" title="Contact me with a specification" class="current">Contact</a></li>
        <li><a href="../work/" title="See some of my work">Work</a></li>
        <li><a href="../about/" title="About me and what I do">About</a></li>
        <li><a href="http://www.alecrust.com/" title="Back to the home page">Home</a></li>
      </ul>
    </div>
    <div id="slogan">
    	<h2>I design and build creative sites that are practical and easy to use. I can help you engage your viewers, build traffic, sell more and control your content. Simple as that.</h2>
    </div>
    <div id="content">
    	<h3>Email Me</h3>
      <p>Use the form below to email me, and I'll respond as soon as I can.</p>
      <form method="post" action="send.php" onsubmit="return validate(this)">
      	<p><label for="name"><b>Name</b></label><input type="text" name="name" id="name" class="input" /></p>
        <p><label for="email"><b>Email Address</b></label><input type="text" name="email" id="email" class="input" /></p>
        <p><label for="subj"><b>Subject</b></label><input type="text" name="subj" id="subj" class="input" /></p>
        <p class="no-padding"><label for="message"><b>Message</b></label></p>
        <p><textarea name="message" id="message" cols="10" rows="10" class="input"></textarea></p>
        <p><label for="answer"><b><?=$question?></b></label><input type="text" name="answer" id="answer" class="input" /></p>
        <input type="submit" name="Send_message" id="Send_message" value="Send Message" class="send" />
      </form>
      <h3>Call Me</h3>
      <p>Feel free to call me during the day on <strong>07738 255 500</strong></p>
      <h3>Write to Me</h3>
      I can receive mail at where my company, Alec Rust Ltd is registered:
      <div id="address">
      9, Coldershaw Road<br />
      West Ealing<br />
      London<br />
      W13 9EA
      </div>
    </div>
    <div id="foot">
    	<div id="foot-l">&copy; 2010 Alec Rust</div>
      <div id="foot-r">Registered Company No. 06665387</div>
      <div class="clear">&nbsp;</div>
    </div>
  </div>
<script>
    var _gaq=[['_setAccount','UA-3217267-1'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
</body>
</html>
