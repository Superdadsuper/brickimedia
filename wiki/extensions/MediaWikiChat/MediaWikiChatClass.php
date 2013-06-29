<?php 
				$pageTitle = Title::newFromID( $this->PageID );
				$message = wfMsgForContent(
					'comments-create-text',
					$pageTitle->getPrefixedText() . "#comment-{$commentId}",
					$text
				);
		
				$log = new LogPage( 'comments', true /* show in RecentChanges?  );
				$log->addEntry( '+ comment', $wgUser->getUserPage(), $message );
		
				wfRunHooks( 'Comment::add', array( $this, $commentId, $this->PageID ) );*/
	function sendPM( $message, $toname, $toid ){
		global $wgUser;
		if( $wgUser -> isAllowed('chat') ){
			global $wgUser;
	
			$dbw = wfGetDB( DB_MASTER );
	
			$fromid = $wgUser -> getID();
			$fromname = $wgUser -> getName();
			$timestamp = MediaWikiChat::now();
			//$fromid = $wgUser -> getID();
			//$fromname = $wgUser -> getName();
	
			$dbw -> insert(
					'chat',
					array(
					)
			);
	
			return $timestamp;
		} else {
			return false;
		}
	}
	function getOnline(){
	
			$dbr = wfGetDB( DB_SLAVE );
	
			$timestamp = MediaWikiChat::now() - 2 * 60 * 100;//minus 2 mins
	
			$res = $dbr -> select(
				'chat_users',
				array( 'cu_user_name', 'cu_user_id' ),
				array( "cu_timestamp > $timestamp", "cu_user_id != {$wgUser -> getId()}" )
			);
	
			$data = array();
	
			foreach( $res as $row ){
					
				$id = $row -> cu_user_id;
				$name = $row -> cu_user_name;
				//$avatar = MediaWikiChat::getAvatar( $id );
	
				$data[] = array($name, $id);
			}
			//return array_unique($data);
	
	}
			)
				'chat',
				'chat_timestamp',
				'',
				__METHOD__,
				array(
						'LIMIT' => 5,
						'ORDER BY' => '`chat_timestamp` DESC'
				)
		);
					$image = "[[!File:$filename|x20px|alt=$chars|link=|$chars]]";
					
					$smileys -> $chars = $image;
			foreach( $smileys as $chars => $image ){
				//$message = preg_replace( '( |\n)'.$chars.'( |\n)', ' '.$image.' ', '\n'.$message.'\n' );
				//$match = preg_match( '( |\n)'.$chars.'( |\n)', '\n'.$message.'\n', $matches);
			}
		$message = str_ireplace( '[[File:', '[[:File:', $message );
		$fO = $resT -> fetchObject();
		 	),
		 	)
		$res = $dbr -> select(
			'chat',
			array( 'chat_user_name', 'chat_user_id', 'chat_message', 'chat_timestamp' ),
			array( "chat_timestamp > $lastCheck", "chat_type = 'message'" ),
			__METHOD__,
			array(
				'LIMIT' => 20,
			)
		);
		$this -> data['debug']['log'][] = $lastCheck;
		$this -> data['debug']['log'][] = 'test';
			$this -> data['users'][$name][1] = $avatar;
		$this -> data['debug']['lastcheck'] = $lastCheck;
				'chat',
				array( 'chat_user_name', 'chat_user_id', 'chat_message', 'chat_timestamp', 'chat_to_id', 'chat_to_name' ),
				array( "chat_timestamp > $lastCheck", "chat_type = 'private message'", "chat_to_name = '{$wgUser -> getName()}' OR chat_user_name = '{$wgUser -> getName()}'" ),
				'',
				__METHOD__,
				array(
						'LIMIT' => 20,
				)
		);
		//);
		//$data['log'][] = $resPM;

			$fromid = $row -> chat_user_id;
			$fromname = $row -> chat_user_name;
				
			$message = MediaWikiChat::parseMessage( $message );
		
			$this -> data['pms'][] = array(
					'message' => $message,
					'timestamp' => $timestamp,
			);

			$this -> data['users'][$fromname][1] = $fromavatar;
			$this -> data['users'][$toname][1] = $toavatar;
		}
		);
		//$this -> data['onlinetext'] = MediaWikiChat::getOnlineText();

		$this -> data['interval'] = MediaWikiChat::getInterval();