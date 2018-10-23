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
	'url' => 'simple.php?page=',
	'classNameUl' => 'pagination',
	'activePage' => $activePage,
	'linksPerPage' => 5
);

$paginator = new \Paginator\Paginator($param);
//--Calcul du nombre de page total en fonction du nombre de résultats disponible
$paginator->calculMaxPage($nombreDeResultats);
echo $paginator->generateHtml();