<?php

include 'arrays.php';

// I've noticed that the same names come up again and again. 'array_rand' is flawed, we'll probably need to look into that and write a new function to do it right. 
// for now I'll just shuffle everything and see if that at least helps. 
	shuffle($chemical["starts_with"]);
	shuffle($chemical["contains"]);
	shuffle($chemical["second"]);
	shuffle($chemical["ends_with"]);
	shuffle($brand["start"]);
	shuffle($brand["middle"]);
	shuffle($brand["end"]);

// BRAND NAME
function create_brandname($arr) {
	
	$brand_var = NULL;
	
	$variations = array(
	$arr["start"][array_rand($arr["start"])] . $arr["middle"][array_rand($arr["middle"])] . $arr["end"][array_rand($arr["end"])],
	$arr["start"][array_rand($arr["start"])] . $arr["middle"][array_rand($arr["middle"])],
	$arr["start"][array_rand($arr["start"])] . $arr["vowels"][array_rand($arr["vowels"])] . $arr["middle"][array_rand($arr["middle"])],
	);
	
	do {		
	shuffle($arr['start']);
	shuffle($arr['middle']);
	shuffle($arr['end']);
	shuffle($arr['vowels']);
		$brand_var = $variations[array_rand($variations)];
	} while (strlen($brand_var) < 5);
	
	// this is to add a copyright symbol of some sort
/* 	switch(mt_rand(0,3)){
		case 0:
		$copy = "<sup>®</sup>";
		break;
		case 1:
		$copy = "<sup>™</sup>";
		break;
		default:
		$copy = "";
		break;
	} */	
//	return ucfirst($brand_var) . $copy;

	return ucfirst($brand_var);
}

// CHEMICAL NAME
function create_chemname($chemical) {
	
	$variations = array(
	$chemical["starts_with"][array_rand($chemical["starts_with"])] . $chemical["contains"][array_rand($chemical["contains"])] . $chemical["ends_with"][array_rand($chemical["ends_with"])],
	$chemical["starts_with"][array_rand($chemical["starts_with"])] . $chemical["contains"][array_rand($chemical["contains"])] . $chemical["ends_with"][array_rand($chemical["ends_with"])]. ' ' . $chemical["second"][array_rand($chemical["second"])],	
	$chemical["starts_with"][array_rand($chemical["starts_with"])] . $chemical["ends_with"][array_rand($chemical["ends_with"])] . ' ' . $chemical["second"][array_rand($chemical["second"])], 
	$chemical['monoclonal']['prefix'][array_rand($chemical['monoclonal']['prefix'])] . $chemical['monoclonal']['mid'][array_rand($chemical['monoclonal']['mid'])] . $chemical['monoclonal']['dle'][array_rand($chemical['monoclonal']['dle'])] . $chemical['monoclonal']['end'][array_rand($chemical['monoclonal']['end'])] . $chemical['monoclonal']['req']
	);
	
	return $variations[array_rand($variations)];
}

// TAGLINE / SLOGAN
// moved to tagline.php


//INDICATION -- what disease does it treat
// $diseases contains these arrays: 'mental', 'infection', 'syndrome', 'neuro', 'cancer'

function choose_category($arr){
	$var = $arr[array_rand($arr)];
	return $var;
}
// choose category also works as a stock 'random from array' technique... the name looks funny in that context, though

function name_indication($arr) {
	$var = choose_category($arr);
	shuffle($var);
	$sick = $var[1];
	return $sick;
}

// create_indication($diseases);
// right now it is super basic, offering only a short statement. Qualifiers need to be added, such as comorbidities or associated symptoms.
// it won't be smart enough to accurately choose correlated items (i.e. chronic bleeding associated with treatment with anticoagulants), but maybe that's funny (i.e. chronic bleeding associated with obsessive masturbation)
function verbose_indication($brand, $chem, $indic, $disease_index){
	$symptom = name_indication($disease_index);
	$indic_start = strtoupper($brand) . " ({$chem}) is indicated ";
	$possible_indications = array(
	"for the treatment of {$indic}.",
	"for the treatment of {$indic} with comorbid {$symptom}.",
	"for the treatment of persistent {$symptom} associated with {$indic}.",
	"for the treatment of emergent {$symptom} associated with late-stage {$indic}.",
	"for the treatment of {$symptom} caused by untreated {$indic}.",
	"for the treatment of occasional {$symptom} associated with treatments for {$indic}.",
	"for the prevention of {$indic} in patients with pre-identified risk factors.",
	"for the treatment of emergent {$indic} in patients being treated for {$symptom}.",
	"for the treatment of {$indic} in patients for whom {$symptom} is a concern.",
	"as a second-line therapy for treatment of {$indic} in patients with a hypersensitivity to other drugs.",
	"as a second-line therapy for treatment of {$indic} in patients nonresponsive to treatment with other drugs.",
	
	);
	return $indic_start . $possible_indications[array_rand($possible_indications)];
}


//CONTRAINDICATIONS -- who shouldn't use it
// the biggest problem right here is that I've conflated contraindication with the other categories, and these are wrong

function refresh_contra($brand, $chem, $indic, $disease_index){
	$possible_contra = array(
	"Do not use {$brand} with comorbid " . name_indication($disease_index) . " or " . name_indication($disease_index) . ". ",
	"Patients with " . name_indication($disease_index) . ", " . name_indication($disease_index) . ", and " . name_indication($disease_index) . " should not take {$brand}. ",
	"{$brand} is contraindicated in patients who have experienced symptoms of " . name_indication($disease_index) . " within " . mt_rand(2, 128) . " days prior to beginning of treatment. ",
	"Patients currently undergoing treatment for " . name_indication($disease_index) . " should not take {$brand}. ",
	"Persons who have experienced or are experiencing " . name_indication($disease_index) . " should avoid taking {$brand}. ",
	"Patients experiencing symptoms of " . name_indication($disease_index) . " should discontinue use of {$brand} until symptoms have resolved. ",
	"{$brand} is contraindicated in patients with a family history of " . name_indication($disease_index) . ". ",
	"Because {$brand} may be a factor in the childhood development of " . name_indication($disease_index) . ", it is not advised for use in women who are pregnant or planning to become pregnant. ",
	);
	return $possible_contra[array_rand($possible_contra)];
}

function contraindicate($num, $brand, $chem, $indic, $disease_index){
	
	$brand = strtoupper($brand);
	
	echo $brand . " is contraindicated in patients who are hypersensitive to {$chem} or to any ingredient in the formulation, including any non-medicinal ingredient, or component of the container. ";
	echo 	"Persons with a known sensitivity to {$chem} should not take {$brand}. ";
	for(; $num != 0; $num--){ 
	$var = refresh_contra($brand, $chem, $indic, $disease_index);
		echo $var;
		
		
	}
}

//ADVERSE EVENTS

function adverse($brand, $chem, $indic, $adverse_index){
	$possible_adverse=array(
	"{$brand} is a known factor in the development of " . choose_category($adverse_index) . ". ",
//	"Don't take {$brand} if you don't want " . choose_category($adverse_index) . ". ",
	"In clinical trials, " . mt_rand(1,100) . "% of patients experienced " . choose_category($adverse_index) . " during treatment with {$brand}. " ,
	"While it is not known if {$brand} is a factor in the development of " . choose_category($adverse_index) . ", the possibility should be weighed against the benefits of treatment. ",
	"Clinical trials suggest a correlation between pre-existing " . choose_category($adverse_index) . " and emergent " . choose_category($adverse_index) . " while taking {$brand}. ",
	"As a side effect of {$brand}, patients may experience symptoms similar to " . choose_category($adverse_index) . ". This is temporary and typically resolves with discontinuation of {$brand}. ",
	"Treatment with {$brand} may interfere with common laboratory tests for " . choose_category($adverse_index) . ". The metabolites of {$brand} may cause the test results to return a false positive. ",
	"Treatment with {$brand} may interfere with common laboratory tests for " . choose_category($adverse_index) . ". Residual {$brand} in bodily fluids may cause the test results to return a false negative. ",
	"In placebo-controlled studies, patients taking {$brand} reported " . choose_category($adverse_index) . " at a higher rate than in the control condition. ",
	"A dose-dependent effect of " . choose_category($adverse_index) . " is a common side effect of {$brand} therapy, and may be managed by dose titration or temporary discontinuation. ",
	"Transient " . choose_category($adverse_index) . " may occur early in {$brand} therapy, and typically resolves within one to two weeks of continued treatment. ",
	);
	return $possible_adverse[array_rand($possible_adverse)];
}; // WRITE SOME MORE OF THESE... also, it would appear the contraindications section contains many things that ought to be warnings or adverse

function adverse_events($num, $brand, $chem, $indic, $adverse_index){
	$brand = strtoupper($brand);	
	echo "Do not take {$brand} except under the supervision of a healthcare professional. Any adverse events experienced by patients taking {$brand} should be reported to the appropriate regulatory body. ";
	for(; $num != 0; $num--){ 
	$var = adverse($brand, $chem, $indic, $adverse_index);
		echo $var;
		
		
	}
}

//WARNINGS AND PRECAUTIONS 


function warning($brand, $chem, $indic, $adverse_index){
	$possible_adverse=array(
//	"{$brand} can cause " . choose_category($adverse_index) . ". ",
//	"Don't take {$brand} if you don't want " . choose_category($adverse_index) . ". ",
	"{$brand} may cause " . choose_category($adverse_index) . " in sensitive individuals. ",
	"Symptoms of " . choose_category($adverse_index) . " may temporarily worsen while taking {$brand}. ",
	"In animal tests, {$brand} appeared to correlate with the onset of " . choose_category($adverse_index) . ". It is not known if similar effects occur in human usage. ",
	"Although the effect has not been observed in humans, animal data raise substantial concern about the potential for {$brand} to cause severe " . choose_category($adverse_index) . " in humans. ",
//	"Always wash hands after handling {$brand} or materials that may have come in contact with {$brand}. ",
	);
	return $possible_adverse[array_rand($possible_adverse)];
};

function warning_precaution($num, $brand, $chem, $indic, $adverse_index){
	$brand = strtoupper($brand);	
	echo "{$brand} is not for everyone. Consult your doctor before taking {$brand}. ";
	for(; $num != 0; $num--){ 
	$var = warning($brand, $chem, $indic, $adverse_index);
		echo $var;
		
		;
	}
}


/// VOWEL SENSITIVITY
function vowelsense($target) {
	$vowels = array("a","e","i","o","u");
$firstletter = substr($target, 0, 1);
$firstletter = strtolower($firstletter);
if (in_array($firstletter, $vowels)) {
return "an";
} else {
return "a";
}
}

// SETTING MAXIMUM OF 100 

function maxout($value){
	if($value>100){
		$value = 100;
	}else{}
	return $value;
}

?>