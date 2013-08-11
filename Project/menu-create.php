<?php
  if ($_SERVER['REQUEST_METHOD'] != 'GET')
    die;

  $sortByDB = array(
    'ds' => array('tag' => 'dish',        'type' => 'text'   ),
    'pr' => array('tag' => 'price',        'type' => 'text'   )
  );

  // Process the sort by request...
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

<html>
	<head>
		<title>Tantalizing Asian Cuisine Menu</title>
        <!-- TODO: Write a <link> tag to refer to the a06.css stylesheet 
                   here. -->
		<link rel="stylesheet" style="text/css" href="a06.css" />
	</head>
	<body>
	<h1><center>Tantalizing Asian Cuisine Menu</center><h1>
		<?php
			// Process the XML document...
			$xml = new DOMDocument;
			$xml->load('menu-data.xml');
	
			$xsl = new DOMDocument;
			$xsl->load('menu.xsl');

			$proc = new XSLTProcessor();
			$proc->importStylesheet($xsl);		

			// Set the sorting parameters if $sortBy is not null...
			if ($sortBy != null)
			{
				$proc->setParameter(null, 'sortby', $sortBy['tag']);
				$proc->setParameter(null, 'type', $sortBy['type']);
				$proc->setParameter(null, 'order', 'ascending');
			}

			echo $proc->transformToXML($xml);
		?>
	</body>
</html>
