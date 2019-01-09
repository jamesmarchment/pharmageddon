
		<?php
		include './includes/functions.php';
		$brandname = create_brandname($brand);
		$chemicalname = create_chemname($chemical);
		$indication = name_indication($diseases);
		include './includes/tagline.php';
		$tagline = create_tagline($brandname, $indication);
		include './includes/header.php';

		?>
		
		<h2><?php echo $brandname; ?></h2>
		<h5>(<?php echo $chemicalname; ?>)</h5>
		<h6><?php echo $tagline;?></h6>	
		
<h3>Important Safety Information</h3>

<h4>Indication</h4>
<p><?php echo verbose_indication($brandname, $chemicalname, $indication, $diseases);?></p>

<h4>Contraindications</h4>
<p> <?php contraindicate($num_contra, $brandname, $chemicalname, $indication, $diseases); ?></p>

<h4>Adverse Events</h4>

<p> <?php adverse_events($num_adverse, $brandname, $chemicalname, $indication, $adverse_symptoms); ?></p>

<h4>Warnings and Precautions</h4>

<p> <?php warning_precaution($num_warn, $brandname, $chemicalname, $indication, $adverse_symptoms); ?></p>

<?php
		include './includes/footer.php';
	
		?>		