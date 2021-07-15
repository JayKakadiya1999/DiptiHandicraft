<?php
    echo "\n\n\n\n\n";
	echo "User Name : ".session()->get('name')."\n\n";
	echo "User Email : ".session()->get('email')."\n\n";
	echo "Subject : ".session()->get('subject')."\n\n";
	echo "Message : ".session()->get('message')."\n\n";

?>