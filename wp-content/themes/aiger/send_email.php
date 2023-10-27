<?php
wp_head();


// the message

$to = "iliyan.konakchiev@gmail.com";
$subject = "This is subject";

$message = "<b>This is HTML message.</b>";
$message .= "<h1>This is headline.</h1>";

$header = "From:webmaster@chris.siberiareal.com \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$retval = wp_mail($to,$subject,$message,$header);

if($retval === true) {
    echo "Message sent successfully...";
}else {
    echo "Message could not be sent...";
}

?>