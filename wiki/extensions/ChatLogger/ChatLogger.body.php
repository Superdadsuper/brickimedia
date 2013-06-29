<?php
	$logpath = dirname(__FILE__) . '/log-lmbw';
$lines = file($logpath, FILE_IGNORE_NEW_LINES);
foreach( $lines as $log ){
	$data = explode("/", $log);
		$time = $data[0];
		$username = $data[1];
		$user = User::newFromName($username);
		$cid = $data[2];
		$mid = $data[3];
		$type = $data[4];
			$logEntry = new ManualLogEntry( 'chat', 'message' ); // Action bar in log foo
			$logEntry->setPerformer( $user ); // User object, the user who did this action
			$logEntry->setTarget( Title::newFromText('Special:Chat') ); // The page that this log entry affects
			$logEntry->setComment( $msg ); // User provided comment, optional
			$logEntry->setParameters( array(
				// Parameter numbering should start from 4.
				// These can be used in the messages as $4, $5 and so on
				// If you want to store stuff that should not be available in messages,
				// just don't prefix with a number and don't use the colons.
				// The format is index:format specifier:name. Indexes from 1 to 3 are reserved
				// and provide the username and target page parameters for the messages.
				'4::msg' => $msg,
				//'hiddenparam' => 'ugly stuff',
			) );
}
//finished, blank log
file_put_contents($logpath, '');