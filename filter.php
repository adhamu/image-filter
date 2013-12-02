<?php

	/* Parameters */
	$path   = $_GET["img"];
	$type  	= $_GET["type"];

	include 'GDFilters.class.php';

	$filter = new GDFilters($path, $type);
  	echo $filter->getImg();

?>