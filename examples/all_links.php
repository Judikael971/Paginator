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

$linesPerPages = $paginator->__get('linesPerPages');
$index = $linesPerPages*$activePage-$linesPerPages;

echo '<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Date</th>
				<th>Titre</th>
			</tr>
		</thead>
		<tbody>';
for ($i = $index; $i<($index+$linesPerPages); $i++)
{
	if(array_key_exists($i, $results))
	{
		echo '<tr>
				<td>'.$results[$i]['id'].'</td>
				<td>'.$results[$i]['date'].'</td>
				<td>'.$results[$i]['title'].'</td>
			</tr>';
	}
}
echo '
		</tbody>
	</table>';
echo $paginator->generateHtml();