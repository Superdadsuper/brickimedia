<?php

//$wgReadOnly = "Sorry, setup is currently being done. Any actions that will modify the database have been disabled";
$wgSitename      = "LEGO CUUSOO Wiki";
$wgMetaNamespace = "LEGO CUUSOO Wiki";

$wgDBprefix         = "";
$wgLogo             = "http://meta.brickimedia.org/images/c/ca/LEGO-CUUSOO-Wiki-Logo.png";
//$wgFavicon			= "$wgScriptPath/favicon-cuusoo.ico"; # favicon needs to be re-added to server

$wgLanguageCode = "en";

$wgDefaultSkin = 'deepsea';

$wgEnableUploads  = true;

//uploading
$wgEnableUploads = false;
$wgUploadNavigationUrl = "http://meta.brickimedia.org/wiki/Special:Upload";
$wgUploadMissingFileUrl= "http://meta.brickimedia.org/wiki/Special:Upload";

#SocialProfile
require_once("$IP/extensions/SocialProfile/SocialProfile.php");
require_once("$IP/extensions/SocialProfile/UserStats/EditCount.php"); // Necessary edit counter
$wgUserStatsPointValues['edit'] = 5; // Points awarded on a mainspace edit
$wgUserStatsPointValues['vote'] = 1; // Points awarded for voting for an article
$wgUserStatsPointValues['comment'] = 1; // Points awarded for leaving a comment
$wgUserStatsPointValues['comment_plus'] = 2; // Points awarded if your comment gets a thumbs up
$wgUserStatsPointValues['comment_ignored'] = 0; // Points awarded if another user ignores your comments
$wgUserStatsPointValues['opinions_created'] = 5; // Points awarded for writing a blog article
$wgUserStatsPointValues['opinions_pub'] = 10; // Points awarded for having that article hit the "Blogs" page
$wgUserStatsPointValues['referral_complete'] = 0; // Points awarded for recruiting a new user
$wgUserStatsPointValues['friend'] = 1; // Points awarded for adding a friend
$wgUserStatsPointValues['foe'] = 0; // Points awarded for adding a foe
$wgUserStatsPointValues['gift_rec'] = 10; // Points awarded for receiving a gift
$wgUserStatsPointValues['gift_sent'] = 0; // Points awarded for giving a gift
$wgUserStatsPointValues['points_winner_weekly'] = 20; // Points awarded for having the most points for a week
$wgUserStatsPointValues['points_winner_monthly'] = 50; // Points awarded for having the most points for a month
$wgUserStatsPointValues['user_image'] = 5; // Points awarded for adding your first avatar
$wgUserStatsPointValues['poll_vote'] = 0; // Points awarded for taking a poll
$wgUserStatsPointValues['quiz_points'] = 0; // Points awarded for answering a quiz question
$wgUserStatsPointValues['quiz_created'] = 0; // Points awarded for creating a quiz question
$wgNamespacesForEditPoints = array( 0, 4 ); // Array of namespaces that can earn you points. Use numerical keys. 0 is mainspace, 4 is project
// The actual user level definitions -- key is simple: 'Level name' => points needed
$wgUserLevels = array(
        'Newcomer' => 0,
        'Beginner' => 500,
        'Novice' => 1000,
        'Amateur' => 1500,
        'Thinking With Bricks' => 2000,
        'Bricktastic' => 2500,
        'Building Bigger' => 5000,
        'Brick Master' => 7500,
        'Master Builder' => 10000,
        'LEGO Wizard' => 12500,
        'Outstanding Brickimedian' => 15000,
        'Honorable Brickimedian' => 20000,
        'Legendary Brickimedian' => 25000,
);
$wgUserProfileDisplay['stats'] = true;

#global file descriptors
require_once("$IP/extensions/GlobalUsage/GlobalUsage.php");

#TEMPORARY
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['autoconfirmed']['edit'] = false;
$wgGroupPermissions['sysadmin']['edit'] = true;
$wgGroupPermissions['sysop']['edit'] = true;