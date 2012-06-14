<?php
$mailto    = "michael.palotas@gridfusion.net";


$send_msg    = "";
$name_err    = "";
$email_err   = "";
$msg_err     = "";
$betreff_err = "";
$wedding_err = "";

if (!empty($_POST['send'])) {

    $error = 0;
    if (empty($_POST['from_name'])) {
        $name_err = "Please enter your name!";
        $error = 1;
    } else {
        $from_name = filter($_POST['from_name']);
    }
    if (empty($_POST['from_email']) || !preg_match("/^[A-z0-9][\w.-]*@[A-z0-9][\w\-\.]+\.[A-z0-9]{2,6}$/", $_POST['from_email'])) {
        $email_err = "Please enter your email address!";
        $error = 1;
    } else {
        $from_email = $_POST['from_email'];
    }
    if (empty($_POST['from_betreff'])) {
        $betreff_err = "Please enter a subject!";
        $error = 1;
    } else {
        $from_betreff = filter($_POST['from_betreff']);
    }
    if (empty($_POST['from_msg'])) {
        $msg_err = "Please enter a message!";
        $error = 1;
    } 
	
	/*
    if (isset($_POST['from_wedding'])) {
        $from_wedding = "yes";
    } 
	 */   
    
    
    
    else {
        $from_msg = preg_replace("/(content-type:|bcc:|cc:|to:|from:)/im", "",  $_POST['from_msg']);
    }

    if (!$error) {
        if (@mail($mailto, "Contact form", "Sender: $from_name <$from_email>\nSubject: $from_betreff\n\nMessage:\n$from_msg\n\nWedding: $from_wedding", "From: <$mailto>")) {
            $send_msg = "Your mail was successfully sent.<br><br>";
            unset($_POST['from_name']);
            unset($_POST['from_email']);
            unset($_POST['from_betreff']);
            unset($_POST['from_msg']);
            unset($_POST['from_wedding']);
            			//+header('Location: index.html');
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
       color:white;
       font-size:16px;
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


<h3 class="contactFormHeading">Contact me directly</h3>

<table id="contactForm">
<tr>
    <td style="text-align:right;"><b>Name:</b></td>
    <td><input type="text" name="from_name" value="<? if (!empty($_POST['from_name'])) echo $_POST['from_name']; ?>"> <font color='red' size=-1><?=$name_err?></font></td>
</tr>
<tr>
    <td style="text-align:right;"><b>E-Mail:</b></td>
    <td><input type="text" name="from_email" value="<? if (!empty($_POST['from_email'])) echo $_POST['from_email']; ?>"> <font color='red' size=-1><?=$email_err?></font></td>
</tr>
<tr>
    <td style="text-align:right;"><b>Subject:</b></td>
    <td><input type="text" name="from_betreff" value="<? if (!empty($_POST['from_betreff'])) echo $_POST['from_betreff']; ?>"> <font color='red' size=-1><?=$betreff_err?></font></td>
</tr>

<!-- michaels creation
<tr>
    <td style="text-align:right;"><b>Wedding:</b></td>
    <td><input type="checkbox" name="from_wedding" value="<? if (!empty($_POST['from_wedding'])) echo $_POST['from_wedding']; ?>"> <font color='red' size=-1><?=$wedding_err?></font></td>
</tr>
-->

<tr>
    <td><b>Message:</b></td>
    <td><textarea class="contactFormTextarea" name="from_msg" cols=50 rows=10><? if (!empty($_POST['from_msg'])) echo $_POST['from_msg']; ?></textarea>
    <br><span class="error_txt"><?=$msg_err?></span></td>
</tr>
<tr>
    <td></td>
    <td><input type=submit value="Send"></td>
</tr>
</table>
</form>
