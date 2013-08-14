<?php
  //Ensure server is requesting via GET
  if ($_SERVER['REQUEST_METHOD'] != 'GET')
    die;

  //Code for the sorting for the menu - credit to Paul Preney, Assignment 6
  $sortByDB = array(
    'ds' => array('tag' => 'dish',        'type' => 'text'   ),
    'pr' => array('tag' => 'price',        'type' => 'text'   )
  );

  $sortBy = null;
  if (array_key_exists('s', $_GET))
  {
    $sortBy = $_GET['s'];
    if ($sortBy == 'i')
      $sortBy = null;
    elseif (array_key_exists($sortBy, $sortByDB))
      $sortBy = $sortByDB[$sortBy];
    else
      $sortBy = null;
  }

  ?>

	<!--code to output the menu in the window - note that full html code not required,
	as this window is opened within the main page-->
	<h1><center>Tantalizing Asian Cuisine Menu</center></h1>
	<?php
		$xml = new DOMDocument;
		$xml->load('menu-data.xml');

		$xsl = new DOMDocument;
		$xsl->load('menu.xsl');
		$proc = new XSLTProcessor();
		$proc->importStylesheet($xsl);		
		if ($sortBy != null)
		{
			$proc->setParameter(null, 'sortby', $sortBy['tag']);
			$proc->setParameter(null, 'type', $sortBy['type']);
			$proc->setParameter(null, 'order', 'ascending');
		}
		echo $proc->transformToXML($xml);
	?>
	<!--link, takes you to the takeout order placing page-->
	<h1><a href="takeoutMenu.php" class="notHeader">Click here to place a takeout order!</a></h1>