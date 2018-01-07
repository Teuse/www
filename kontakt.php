<h1>Kontakt</h1>
<p>Du willst mir etwas mitteilen? Dann lass hören:</p>

<?php
	function curPageURL() {
 		return  'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	
	if(isset($_POST['message'])) 
	{
		$pyString = 'python cgi-bin/emailForm.py ' . $_POST['message'];
		
		if (isset($_POST['name'])) {
			$pyString .= $_POST['name'];
		} else {
			$pyString .= '-';
		}
		$pyString .= ' ';
		
		if (isset($_POST['email'])) {
			$pyString .= $_POST['email'];
		} else {
			$pyString .= '-';
		}
		
		$output = shell_exec($pyString);
		/*
		if ($output) {
			echo "<p>Ein fehler ist beim senden aufgetreten. Sorry...</p>"
		} else {
			echo "<p>Email erfolgreich übermittelt.</p>"
		}*/
	}
	else
	{
		echo "<form action='" . curPageURL() . "' method='post'>"; 
   	echo "	<div class='form_settings'>";
   	echo "		<p><span>Name</span>          <input    class='contact' type='text' name='name' value='' /></p>";
   	echo "		<p><span>Email Adresse</span> <input    class='contact' type='text' name='email' value='' /></p>";
   	echo "		<p><span>Message</span>       <textarea class='contact textarea' rows='8' cols='50' name='message'></textarea></p>";
   	echo "		<p style='padding-top: 15px'><span>&nbsp;</span><input class='submit' type='submit' name='contact_submitted' value='submit' /></p>";
   	echo "	</div>";
   	echo "</form>";
   }
?>        

<h1>Impressum</h1>
<p>Mathi Radler</p>
      