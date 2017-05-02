<?php

session_start ();
if ($_SESSION [loginflag] == 1) {
	echo '1';
} else {
	$returnarr = array (
			'hide' => array (
					'main_left',
					'main_right' 
			),
			'show' => array (
					'main_login' 
			) 
	);
}
echo json_encode ( $returnarr );
?>