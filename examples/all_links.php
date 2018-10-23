<?php
require_once '../src/Paginator.php';
include_once 'results.php';

$activePage = 1;
if(isset($_GET['page']) && preg_match('/^[0-9]*$/', $_GET['page'], $match))
{
	$activePage = ($_GET['page']>0) ? $_GET['page'] : 1;
}
$nombreDeResultats = count($results);

$param = array(
	'url' => 'all_links.php?page=',
	'activeButton' => array(
		'PreviousPageLink' => true,
		'NextPageLink' => true,
		'LastPageLink' => true,
		'FirstPageLink' => true,
		'EmptyPageLink' => true
	),
	'classNameUl' => 'pagination',
	'activePage' => $activePage,
	'linksPerPage' => 5
);
$paginator = new \Paginator\Paginator($param);
$paginator->calculMaxPage($nombreDeResultats);
echo $paginator->generateHtml();