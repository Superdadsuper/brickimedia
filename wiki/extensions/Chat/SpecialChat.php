<?php
class SpecialChat extends SpecialPage {
        function __construct() {
                parent::__construct( 'Chat' );
        }
	
 
        function execute( $par ) {
				if (  !$this->userCanExecute( $this->getUser() )  ) {
                	$this->displayRestrictionError();
                	return;
      			}
                $request = $this->getRequest();
                $output = $this->getOutput();
                $this->setHeaders();
                $param = $request->getText( 'param' );
                global $bmProject;
                
				$wikitext = '{{#ifexist: MediaWiki:Chat-notice|{{MediaWiki:Chat-notice}}<br />|}}';
				$html = '<iframe width="100%" src="http://dev.brickimedia.org/chat/cometchat/modules/chatrooms/index.php?basedata=null&project=' . $bmProject . 'width="100%" height="600px" style="border:1px solid #888888;"></iframe>';
                $output->addWikiText( $wikitext );
                $output->addHTML( $html );
				function __construct() {
        				parent::__construct( 'Chat', 'chat' );
				}		
        }
}