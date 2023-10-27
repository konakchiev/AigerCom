<?php
/*
Template name: Mailer
*/
get_header();

$mail_sentto = $_POST['youremail'];

$to = $mail_sentto;
$subject = "VocalTel Quote";

$date = date('d-m-Y');

$message = "<b><h2>Thank you for your interest in the Centrex5 PBX.</h2></b>";
$message .= "<p>The following quote is valid for <strong>30</strong> days from: " . $date . "</p>";
$message .= "<p>If you require more information or have any questions please reply to this email or call 01375 820090.</p>";
$message .= "<br>";
$message .= "<br>";
$message .= "<br>";
$message .= "<p>Full feature 7 line 14 extension VoIP PBX : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $_POST['inputfeature'] . "</p>";
$message .= "<p>Inclusive VoIP desktop featurephones : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $_POST['inputvoip'] . "</p>";
$message .= "<p>Additional VoIP desktop featurephones : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $_POST['inputadd'] . "</p>";
$message .= "<p>Inclusive UK minutes : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $_POST['inputuk'] . "</p>";
$message .= "<p>Installation, subject to survey : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Free</p>";
$message .= "<p>Maintenance : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $_POST['inputmaintenance'] . "</p>";
$message .= "<p>Monthly line rental : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $_POST['inputmrental'] . "</p>";
$message .= "<p><strong>Total monthly cost :</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><b>" . $_POST['inputtotal'] . "</b></strong></p>";

$header = "From:webmaster@chris.siberiareal.com \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$retval = wp_mail($to,$subject,$message,$header);


?>

    <section class="about--section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="/wp-content/uploads/2023/02/SmallLogo-1-1.png" alt="">
                    <h2>    Your Quote
                    </h2>
                </div>
            </div>
        </div>
    </section>

<?php

if($retval === true) { ?>
    <section class="handset--section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Your Message Was Successfully Sent.</h1>
                    <h4><strong>Thank you for your interest in the Centrex5 PBX.</strong></h4>
                    <p>The following quote is valid for 30 days from: <strong><?php echo date('d-m-Y');?></strong></p>
                    <p>If you require more information or have any questions please reply to this email or call 01375 820090.</p>
                </div>
            </div>
        </div>
    </section>
<?php }else { ?>
    <section class="handset--section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Something went wrong. Please try again.</h1>
                    <h4><strong>Thank you for your interest in the Centrex5 PBX.</strong></h4>
                    <p>If you require more information or have any questions please reply to this email or call 01375 820090.</p>
                </div>
            </div>
        </div>
    </section>
<?php }
?>


<?php
get_footer();
?>