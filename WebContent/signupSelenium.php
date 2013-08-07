<?php
$mailto    = "michael.palotas@gridfusion.net";


$send_msg    = "";
$lastname_err    = "";
$firstname_err    = "";
$street_err    = "";
$email_err   = "";
$city_err   = "";
$plz_err   = "";
$msg_err     = "";
$terms_err = "";



if (!empty($_POST['send'])) {

    $error = 0;
    if (empty($_POST['from_lastname'])) {
        $lastname_err = "Please enter your last name!";
        $error = 1;
    } else {
        $from_lastname = filter($_POST['from_lastname']);
    }
	
    if (empty($_POST['from_firstname'])) {
        $firstname_err = "Please enter your first name!";
        $error = 1;
    } else {
        $from_firstname = filter($_POST['from_firstname']);
    }	
	
    if (empty($_POST['from_street'])) {
        $street_err = "Please enter your street name!";
        $error = 1;
    } else {
        $from_street = filter($_POST['from_street']);
    }		

    if (empty($_POST['from_plz'])) {
        $plz_err = "Please enter your postal code!";
        $error = 1;
    } else {
        $from_plz = filter($_POST['from_plz']);
    }
	
    if (empty($_POST['from_city'])) {
        $city_err = "Please enter your city!";
        $error = 1;
    } else {
        $from_city = filter($_POST['from_city']);
    }
	
    if (empty($_POST['from_email']) || !preg_match("/^[A-z0-9][\w.-]*@[A-z0-9][\w\-\.]+\.[A-z0-9]{2,6}$/", $_POST['from_email'])) {
        $email_err = "Please enter your email address!";
        $error = 1;
    } else {
        $from_email = $_POST['from_email'];
    }

	if (isset($POST['from_terms'])){
		$terms_err ="Please agree to the terms!";
		$error = 1;
	}
	else {
        $from_terms = $_POST['from_terms'];
    }
	
	
	
	$from_msg = preg_replace("/(content-type:|bcc:|cc:|to:|from:)/im", "",  $_POST['from_msg']);
	
	
    if (!$error) {
        if (@mail($mailto, "Selenium Training Registration", "Lastname: $from_lastname\nFirstname: $from_firstname\nStreet: $from_street\nEmail: $from_email\nPLZ: $from_plz\nCity: $from_city\n\nMessage:\n$from_msg\n", "From: <$mailto>")) {
            $send_msg = "Your mail was successfully sent.<br><br>";
            unset($_POST['from_lastname']);
            unset($_POST['from_firstname']);
            unset($_POST['from_street']);
            unset($_POST['from_plz']);
            unset($_POST['from_city']);
            unset($_POST['from_email']);
            unset($_POST['from_msg']);
            unset($_POST['from_terms']);
            header('Location: regconfirmation.html');
			
        } else {
            $send_msg = "There was en error!";
        }
    }
}

function filter($input) {
    $result = preg_replace("/[^a-z0-9äöüß !?:;,.\\/_\\-=+@#$&\\*\\(\\)]/im", "",  $input);
    return preg_replace("/(content-type:|bcc:|cc:|to:|from:)/im", "",  $result);
}

?>

<?=$send_msg ?>
<form action="<?=$_SERVER['PHP_SELF']?>" method=post>
<input type="hidden" name="send" value="1">


<style type="text/css">
    table#contactForm td {
       vertical-align:top;
       padding:5px 0;
       font-size: 10px;
    }
    .error_txt{
       color:#FE2E2E;
       font-weight:bold;
    }
    h3.contactFormHeading{
       color:black;
       font-size:12px;
       font-weight:bold;
    }
    input.contactFormInput{
       border: solid 1px #CCCCCC;
       width: 220px;
       font-size: 12px;
       line-height: 17px;
       padding: 2px 0;
    }
    textarea.contactFormTextarea{
       border: solid 1px #CCCCCC;
       padding:0px 5px;
       width: 300px;
       height:100px;

    }
</style>


<h3 class="contactFormHeading">Selenium Training Registration - 29. November 2012, Zürich Technopark</h3>

<table id="contactForm">
<tr>
    <td style="text-align:right;">Last Name:</td>
    <td><input type="text" name="from_lastname" value="<? if (!empty($_POST['from_lastname'])) echo $_POST['from_lastname']; ?>"> <font color='red' size=-1><?=$lastname_err?></font></td>
</tr>
<tr>
    <td style="text-align:right;">First Name:</td>
    <td><input type="text" name="from_firstname" value="<? if (!empty($_POST['from_firstname'])) echo $_POST['from_firstname']; ?>"> <font color='red' size=-1><?=$firstname_err?></font></td>
</tr>
<tr>
    <td style="text-align:right;">Street Address:</td>
    <td><input type="text" name="from_street" value="<? if (!empty($_POST['from_street'])) echo $_POST['from_street']; ?>"> <font color='red' size=-1><?=$street_err?></font></td>
</tr>
<tr>
    <td style="text-align:right;">PLZ / Postal code:</td>
    <td><input type="text" name="from_plz" value="<? if (!empty($_POST['from_plz'])) echo $_POST['from_plz']; ?>"> <font color='red' size=-1><?=$plz_err?></font></td>
</tr>
<tr>
    <td style="text-align:right;">City:</td>
    <td><input type="text" name="from_city" value="<? if (!empty($_POST['from_city'])) echo $_POST['from_city']; ?>"> <font color='red' size=-1><?=$city_err?></font></td>
</tr>

<tr>
    <td style="text-align:right;">Email:</td>
    <td><input type="text" name="from_email" value="<? if (!empty($_POST['from_email'])) echo $_POST['from_email']; ?>"> <font color='red' size=-1><?=$email_err?></font></td>
</tr>

<tr>
    <td style="text-align:right">Message (optional):</td>
    <td><textarea class="contactFormTextarea" name="from_msg" cols=50 rows=10><? echo $_POST['from_msg']; ?></textarea>
    <br><span class="error_txt"><?=$msg_err?></span></td>
</tr>

<tr>
    <td style="text-align:right;">Terms and Conditions:</td>
    <td><input type="checkbox" name="from_terms" value="terms" checked="yes"><a href="./terms.html" target="_blank">I agree to the Gridfusion Terms and Conditions</a></td>
</tr>

<!--
<tr>
    <td style="text-align:right;">Terms and Conditions:</td>
    <td><input type="checkbox" name="from_terms" value="<? if (isset($_POST['from_terms'])) echo $_POST['from_terms']; ?>"><a href="./terms.html" target="_blank">I agree to the Gridfusion Terms and Conditions</a><font color='red' size=-1><?=$terms_err?></font></td>
</tr>
-->

<tr>
    <td></td>
    <td><input type=submit value="REGISTER"></td>
</tr>
</table>
</form>
