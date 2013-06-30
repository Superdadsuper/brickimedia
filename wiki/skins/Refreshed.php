<?php
require_once( dirname( dirname( __FILE__ ) ) . '/includes/SkinTemplate.php');

//FORCE TOC
$wgHooks['InternalParseBeforeLinks'][] = 'ForceTocOnEveryPage_renderForceToc';
function ForceTocOnEveryPage_renderForceToc( &$parser, &$text ) {
	global $mediaWiki;
	if( !isset($mediaWiki) ) return true;
	if( $parser->getTitle()->getNamespace() != 0 ) return true;
	if( $parser->getTitle()->equals(Title::newMainPage()) ) return true;
	$text .= "__FORCETOC__";
	return true;
}
$wgExtensionCredits['parserhook'][] = array(
		'name' => 'ForceTocOnEveryPage',
		'version' => '1.0.4',
		'description' => 'Force TOC On Every Page Extension',
		'author' => '[http://www.jmkim.com Jmkim dot com]',
		'url' => 'https://www.mediawiki.org/wiki/Extension:ForceTocOnEveryPage'
);

$wgResourceModules['skins.refreshed'] = array(
		'styles' => array(
				//"$IP/skins/common/commonElements.css" => array( 'media' => 'screen' ),
				"$IP/skins/common/commonContent.css" => array( 'media' => 'screen' ),
				//"$IP/skins/common/commonInterface.css" => array( 'media' => 'screen' ),
				"$IP/skins/refreshed/main.css" => array( 'media' => 'screen' ),
				//"$flexiblestylesheet" => array( 'media' => 'screen' ),
				//"$IP/skins/deepsea/big.css" => array( 'media' => 'only screen and (min-width: 800px), only screen and (min-device-width: 800px)' ),
				//"$IP/skins/deepsea/small.css" => array( 'media' => 'only screen and (max-width: 800px), only screen and (max-device-width: 800px)' ),
				//"$IP/skins/deepsea/interactive.css" => array( 'media' => 'screen' ),
				//"$IP/skins/common/forums.css" => array( 'media' => 'screen' ),
				//"$globalcss" => array( 'media' => 'screen' )
				//"$IP/skins/deepsea/projects/$bmProject.css" => array( 'media' => 'screen' ),
				//"$globalcss" => array( 'media' => 'screen' )
		),
		'scripts' => array(
				"$IP/skins/refreshed/refreshed.js",
				//"$IP/skins/common/foes.js"
		),
		'remoteBasePath' => $GLOBALS['wgStylePath'],
		'localBasePath' => $GLOBALS['wgStyleDirectory']
);



// inherit main code from SkinTemplate, set the CSS and template filter
class SkinRefreshed extends SkinTemplate {
	var $useHeadElement = true;

	function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$this->skinname  = 'refreshed';
		$this->stylename = 'refreshed';
		$this->template  = 'RefreshedTemplate';

		//$out->addModules( 'skins.refrehsed' );
		//$out->addModuleScripts( 'skins.refreshed' );

		//$out->addScriptFile( "$IP/skins/refreshed/refreshed.js" );
		$out->addScriptFile( "http://adams-site.x10.mx/nxtest/load.php?debug=false&lang=en&modules=skins.refreshed&only=scripts&skin=deepsea&*" );
	}
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
		// Append to the default screen common & print styles...
		$out->addStyle( 'refreshed/main.css', 'screen' );
		
		$out->addModuleStyles( 'skins.refreshed' );
	}
}

class RefreshedTemplate extends QuickTemplate {
	
	public function execute() {
		global $wgRequest, $refreshedTOC;
	
		$skin = $this->data['skin'];
	
		// suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();
	
		$this->html( 'headelement' );
		
		//TOC processing
		$allHTML = $this -> data['bodycontent'];
		$parts = explode( '<table id="toc"', $allHTML, 2 );
		$HTMLbefore = $parts[0];
		$restHTML = $parts[1];
		$parts = explode( '</table>', $restHTML, 2 );
		$toc = $parts[0];
		$HTMLafter = $parts[1];
		$this -> data['bodytext'] = $HTMLbefore . $HTMLafter;
		
		$tocparts = explode( "<ul>", $toc );
		$tocparts = explode( "</ul>", $tocparts[1] );
		$tocHTML = $tocparts[0];
		
		$tocHTML = preg_replace( '|<li class="toclevel-[0-9] tocsection-[0-9]+">(.+)<\/li>|', '$1', $tocHTML );
		
?>

	<div id="header"></div>
	<div id="fullwrapper">
		<div id="leftbar">
			<div id="leftbar-top">
				<div id="maintitle2">
					<?php $this->html('title'); ?>
				</div>
				<div id="pagelinks">
					<?php foreach ( $this->data['content_actions'] as $action ){
				 		echo "<a class='" . $action['class'] . "' " .
				 			"id='" . $action['id'] . "' " .
				 			"href='" . htmlspecialchars( $action['href'] ) . "'>" . 
				 			htmlspecialchars( $action['text'] ) . "</a>";
					} ?>
				</div>
			</div>
			<div id="leftbar-bottom">
				<div id="refreshed-toc">
					<div id="toc-box"></div>
					<?php echo $tocHTML; ?>
				</div>
			</div>
		</div>
		<div id="contentwrapper">
			<!-- <div id="titlearea">
				<span id="maintitle">
					<?php $this->html('title'); ?>
				</span>
				<div id="subtitle">
					<?php $this->html('subtitle') ?>
				</div>
				<span id="editbutton">edit article</span>
			</div> -->
			<div id="content">
				<?php $this->html('bodytext') ?>
			</div>
		</div>
		<div id="rightbar">
			<div id="rightbar-top">
				<div id="siteactions">
					<?php foreach ( $this->data['sidebar']['top'] as $action ){
				 		echo "<a id='" . $action['id'] . "' " .
				 			"href='" . htmlspecialchars( $action['href'] ) . "'>" . 
				 			htmlspecialchars( $action['text'] ) . "</a>";
					} ?>
				</div>
			</div>
			<div id="rightbar-bottom">
				<div id="sitelinks">
					<?php foreach ( $this->data['sidebar']['bottom'] as $action ){
				 		echo "<a id='" . $action['id'] . "' " .
				 			"href='" . htmlspecialchars( $action['href'] ) . "'>" . 
				 			htmlspecialchars( $action['text'] ) . "</a>";
					} ?>
				</div>
			</div>
		</div>
	</div>
	<div style="display:none;"> <?php var_dump( $this ); ?> </div>
	<?php $this->html('bottomscripts');;?>
		
		
		
<?php 		
	}
}