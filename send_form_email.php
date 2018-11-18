<?php
/**
*	Ontvangen formulier per mail doorsturen
*	Formulier wordt met Ajax verzonden
*	HTMl antwoord geven zonder <html> tag

*/ 
if(isset($_POST['contact'])) {
 
     
 
    // EDIT THE 3 LINES BELOW AS REQUIRED
	$email_from = "contact@tomfrantzen.be";
    $email_to = "wim.stevens@gmail.com, tom.frantzen@telenet.be";
    $email_subject = "Contactformulier Tom Frantzen";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
		exit ("we stoppen ermee");
        die();
    }
 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href"); 
      return str_replace($bad,"",$string);
    }   
 
    // validation expected data exists
 
    if(!isset($_POST['contact']) ||
        !isset($_POST['mail']) ) {
        died('We are sorry, but there appears to be a problem with the form you submitted (missing fields).');       
    }  
	// extract data from the post
	
    $contact = $_POST['contact']; // required
	$mail = $_POST['mail'];
	$tel = $_POST['tel'];
	$formule = $_POST['formule'];
	$aantal = $_POST['aantal'];
	$autocar = $_POST['autocar'];
	$startplaats = $_POST['startplaats'];
	$aantalTaart = $_POST['aantalTaart'];
	$datum1 = $_POST['datum1'];
	$datum2 = $_POST['datum2'];
	$datum3 = $_POST['datum3'];
	$comment = $_POST['comment'];
	$taal = $_POST['taal'];
 
	// Create body of the mail
 
    $email_message = "Er werd een webformulier ingevuld.\r\n\r\n";
	$email_message .= "Contact: ".clean_string($contact)."\r\n";
	$email_message .= "eMail: ".clean_string($mail)."\r\n";	
	$email_message .= "Telefoon: ".clean_string($tel)."\r\n";	
	$email_message .= "Gewenste formule: ".clean_string($formule)."\r\n";
	$email_message .= "Taal van het formulier: ".clean_string($taal)."\r\n";

	if ( ($formule=='Dagtrip') or ($formule=='Groepsbezoek') )  {
		$email_message .= "\r\nGegevens relevant voor dagtrip of groepsbezoek\r\n";
		$email_message .= "Aantal mensen in groep: ".clean_string($aantal)."\r\n\r\n";
		$email_message .= "Datum 1 (DD/MM/YYYY h:m): ".clean_string($datum1)."\r\n";		
		$email_message .= "Datum 2 (DD/MM/YYYY h:m): ".clean_string($datum2)."\r\n";	
		$email_message .= "Datum 3 (DD/MM/YYYY h:m): ".clean_string($datum3)."\r\n";		
	}
	
	if ($formule=='Dagtrip') {
		$email_message .= "\r\nGegevens relevant voor dagtrip\r\n";
		$email_message .= "Wie zorgt voor de autocar: ".clean_string($autocar)."\r\n";
		$email_message .= "Startplaats bus: ".clean_string($startplaats)."\r\n";
		$email_message .= "#Porties Brueghel taart: ".clean_string($aantalTaart)."\r\n";
	}
	
	$email_message .= "\r\nBijkomende opmerkingen/vragen/commentaar\r\n";
	$email_message .= clean_string($comment)."\r\n";	
 
	// create email headers
	$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
 	@mail($email_to, $email_subject, $email_message, $headers);  
 

	
	//  Succes antwoord naar browser sturen in juiste taal 
	if ($taal=='nl') {
?>
	<h1>Dank voor uw bericht</h1>
	<p>We hebben uw bericht goed ontvangen.  We zullen dit spoedig verwerken en U zo nodig terug contacteren op het opgegeven e-mail adres.  Tot binnenkort.</p>
<?php	
	}
	if ($taal=='fr') {
?>
	<h1>Merci pour votre message</h1>
	<p>Nous avons bien reçu votre message . Nous allons le traiter rapidement et vous contacter si nécessaire sur l'adresse e-mail fournie. A bientôt.</p>
<?php	
	}
	if ($taal=='en') {
?>
	<h1>We thank you for your message</h1>
	<p>We have received your message well. We will process it promptly and contact you if necessary on the mail address provided. See you soon.</p>
<?php	
	}
?>

 
<?php
 
}
 
?>
