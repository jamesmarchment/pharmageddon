<?php 
// TAGLINE


// moved from arrays.php because it needs to run in order, after $drug and $indication exist

$tagline_contents = array(
// Fight -- these are middles of sentences, more aggressive-sounding
'fight' => array (
"in the fight against",
"to help you overcome",
"to help beat",
"for a world without",
"to struggle with",
"to conquer",
"to defeat"
),
// {$fight_start[1]} for {$aspire2[1]}
// {$fight_start[1]} {$fight[1]} {$indicatedfor}
// fight_start -- these are beginnings of sentences and can apply to aspire as well
'fight_start' => array (
"Take the first steps",
"Fight",
"Step forward",
"Make a difference",
"Take action",
"Don't wait",
"Today is the day",
"It's the first step",
"Making strides",
"Move forward",
"Do what you have to",
"Raise the standard",
"Take a step"
),
// Aspire -- these are very similar but occasionally have different verb agreements
//"Don't let {$indicatedfor} keep you from {$aspire[1]}."
'aspire' => array (
"doing what you love",
"tomorrow",
"loving yourself",
"enjoying life",
"being content",
"what matters",
"what you are",
"who you are",
"the life you want",
"the things you love",
"the life you deserve",
"the world you want to see",
"experiencing your dreams",
"what really matters",
"what truly matters",
"a life you love"
),
// "You deserve {$aspire2[1]}."
'aspire2' => array (
"what you love",
"tomorrow",
"a brighter world",
"a good life",
"the good stuff",
"nothing less than the best",
"a life you love"
),
'slowdown' => array (
"slow you down",
"hold you back",
"change who you are",
"define you",
"bring you down",
"stop you",
"keep you down",
"hold you up"
),

'supported' => array (
"Proven",
"Supported",
"Established",
"Researched",
"Built",
"Trusted",
"Known",
"Believed",
"Loved",
"Confirmed",
"Demonstrated",
"Upheld",
"Relied upon",
),
'bywhom' => array (
"evidence",
"intuition",
"science",
"doctors",
"results",
"you",
"moms",
"millions",
"data",
"information"),

);



// OKAY, these functions are a friggin' MESS, but it works
// I think the second one isn't needed, strtoupper could be inside of init, just as long as the array is defined with extant values... it just sets in stone whatever the stuff is when it's defined

function init_tagline($init_drugname = "DRUG", $init_indication = "COND"){
	global $tagline_contents;
	
if (!isset($indication)){$indication = NULL;} else {}
if (!isset($drug)){$drug = NULL;} else {}
// $indicatedfor = NULL; //not sure how to make this properly self-referential... it seems like it will need to be in a function or something, or just have NULL values to start
$drug = $init_drugname;
$indication = $init_indication;
// the keys need to be random, or we could shuffle the arrays.. yeah, gonna do that

//shuffle everything
shuffle($tagline_contents['fight_start']);
shuffle($tagline_contents['fight']);
shuffle($tagline_contents['aspire']);
shuffle($tagline_contents['aspire2']);
shuffle($tagline_contents['slowdown']);
shuffle($tagline_contents['supported']);
shuffle($tagline_contents['bywhom']);

$tagline_structures = array(   
 "{$tagline_contents['fight_start'][0]} {$tagline_contents['fight'][1]} {$indication}.",
 "A new ally {$tagline_contents['fight'][1]} {$indication}: {$drug}.",
 "Don't let {$indication} keep you from {$tagline_contents['aspire'][1]}.",
 "Don't let {$indication} {$tagline_contents['slowdown'][1]}.",
 "It's {$drug} time.",
 "Get back to {$tagline_contents['aspire'][1]}. Get {$drug}.",
 "{$tagline_contents['fight_start'][1]} for {$tagline_contents['aspire2'][1]}. Get {$drug}.",
 "{$tagline_contents['fight_start'][1]} to get back to {$tagline_contents['aspire'][1]}.",
 "You deserve {$tagline_contents['aspire2'][1]}. Get {$drug}.",
 "Step forward for {$drug}.",
 "Stand up to {$indication}.",
 "Today is " . vowelsense($drug) . " {$drug} day.",
 ucfirst($indication) . " today. " . ucfirst($drug) . " tomorrow.",
 "It's time for {$tagline_contents['aspire'][1]}. {$drug}.",
 "It's for {$tagline_contents['aspire'][1]}. {$drug}.",
 "{$tagline_contents['supported'][1]} by {$tagline_contents['bywhom'][1]}. {$tagline_contents['supported'][2]} by {$tagline_contents['bywhom'][2]}.",
 "Finally, " . vowelsense($drug) . " {$indication} treatment that won't {$tagline_contents['slowdown'][1]}.",
 ucfirst($drug) . " cares about {$tagline_contents['aspire'][1]} as much as you do."
);
 return $tagline_structures[mt_rand(0, (count($tagline_structures)-1))];
 
}



function create_tagline($given_drugname, $given_indication) {
//	global $given_drugname, $given_indication;
	//$drug = $given_drugname;
	// $indication = $given_indication;

	
$the_tagline_structure = init_tagline(strtoupper($given_drugname), $given_indication);
	return $the_tagline_structure;
}


?>