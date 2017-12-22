<?php
//can use this to redirect to anything
function redirect_to($location){
	if($location != NULL) {
		//this is the method that redirects
		header("Location: {$location}");
		exit;
	}

}



function submitMessage($name, $email, $message, $direct) {
//VERY IMPORTANT that these variables are in the same order becasue this is the order they will be enteredintop the database
	//MAMP not locally set p fpor email so you have to test live
	$to = "admin@nataliemastracci.com"; //who the email is going to ALWAYS hosting
	$subj = "Message from Portfolio Form"; //this prevents it from looking like spam
	$extra = "Reply-To: ".$email; //gives you the email to respond to. Click it in the body of the email to be able to respond to the person and not to yourself. Do not click reply it will email yourself.
	$msg = "name: ".$name."\n\nEmail: ".$email."\n\nComments: ".$message;
	//\n\n is a line break <br>
	// mail($to, $subj, $msg, $extra); //order matters $extra does not matter
	$direct = $direct."?name={$name}";
	redirect_to($direct);
}





?>