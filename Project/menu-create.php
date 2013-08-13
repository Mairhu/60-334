<?php
  if ($_SERVER['REQUEST_METHOD'] != 'GET')
    die;

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
	<h1><a href="takeoutMenu.php" class="notHeader">Click here to place a takeout order!</a></h1>