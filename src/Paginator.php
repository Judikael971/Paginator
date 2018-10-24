<?php
/**
 * Paginator - PHP pagination class.
 *
 * @see       https://github.com/Judikael971/Paginator Projet GitHub pour une pagination simple
 *
 * @author    Judikaël AUCAGOS
 * @copyright 2018 Judikaël AUCAGOS
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
namespace Paginator;

class Paginator
{
	/**
	 * Tableau contenant dans l'ordre les informations pour créer une pagination
	 *
	 * @var array
	 */
	protected $paginator = [];

	/**
	 * Nom de la class css pour la balise <ul>
	 *
	 * @var string
	 */
	protected $classNameUl = "";

	/**
	 * Nom de la class css pour la balise <li>
	 *
	 * @var string
	 */
	protected $classNameLi = "paginate_button";

	/**
	 * Nom de la class css pour indiquer que l'élément de la liste (<li>) est la page en cours
	 *
	 * @var string
	 */
	protected $classNameActive = "active";

	/**
	 * Nom de la class css pour indiquer que l'élément de la liste (<li>) est désactivé
	 *
	 * @var string
	 */
	protected $classNameDisabled = "disabled";

	/**
	 * Nom de la class css pour indiquer que l'élément de la liste (<li>) est le lien "Next" (Suivant)
	 *
	 * @var string
	 */
	protected $classNameNext = "next";

	/**
	 * Nom de la class css pour indiquer que l'élément de la liste (<li>) est le lien "Previous" (Précédent)
	 *
	 * @var string
	 */
	protected $classNamePrevious = "previous";

	/**
	 * Nom de la class css pour indiquer que l'élément de la liste (<li>) est le lien "First" (Premier)
	 *
	 * @var string
	 */
	protected $classNameFirst = "first";

	/**
	 * Nom de la class css pour indiquer que l'élément de la liste (<li>) est le lien "Last" (Dernier)
	 *
	 * @var string
	 */
	protected $classNameLast = "last";

	/**
	 * Numéro de la page active (en cours)
	 * Par défaut, on le met à 1
	 *
	 * @var int
	 */
	public $activePage = 1;

	/**
	 * Nombre de page Total pour la pagination
	 * Par défaut, on le met à 1
	 *
	 * @var int
	 */
	public $maxPage = 1;

	/**
	 * Nombre de lignes de résultat à afficher par page
	 * Par défaut, on le met à 10
	 *
	 * @var int
	 */
	public $linesPerPages = 10;

	/**
	 * Nombre de liens (hors "Next", "Previous", "First" et "Last") à afficher dans la pagination
	 * Par défaut, on le met à 7
	 *
	 * @var int
	 */
	public $linksPerPage = 7;

	/**
	 * Ajouter le lien "First" dans la pagination
	 * Par défaut, on le met à false (désacivé)
	 *
	 * @var boolean
	 */
	protected $addFirstPageLink = false;

	/**
	 * Ajouter le lien "Last" dans la pagination
	 * Par défaut, on le met à false (désacivé)
	 *
	 * @var boolean
	 */
	protected $addLastPageLink = false;

	/**
	 * Ajouter le lien "Next" dans la pagination
	 * Par défaut, on le met à false (désacivé)
	 *
	 * @var boolean
	 */
	protected $addNextPageLink = false;

	/**
	 * Ajouter le lien "Previous" dans la pagination
	 * Par défaut, on le met à false (désacivé)
	 *
	 * @var boolean
	 */
	protected $addPreviousPageLink = false;

	/**
	 * Ajouter le lien "Empty" dans la pagination
	 * Par défaut, on le met à false (désacivé)
	 *
	 * @var boolean
	 */
	protected $addEmptyPageLink = false;

	/**
	 * Url générique à utiliser pour les liens de la pagination
	 *
	 * @var string
	 */
	protected $url = "?page=";

	/**
	 * Texte à afficher pour le lien "Previous"
	 *
	 * @var string
	 */
	protected $textPrevious = "Previous";

	/**
	 * Texte à afficher pour le lien "Next"
	 *
	 * @var string
	 */
	protected $textNext = "Next";

	/**
	 * Texte à afficher pour le lien "First"
	 *
	 * @var string
	 */
	protected $textFirst = "First";

	/**
	 * Texte à afficher pour le lien "Last"
	 *
	 * @var string
	 */
	protected $textLast = "Last";

	/**
	 * Texte à afficher pour le lien "Empty"
	 *
	 * @var string
	 */
	protected $textEmpty = "...";


	/**
	 * Constructor.
	 *
	 * @param array $params Paramètres pour le génération de la pagination
	 */
	public function __construct($params = [])
	{
		if(array_key_exists('url', $params))
		{
			$this->__set('url', $params['url']);
		}
		if(array_key_exists('activePage', $params))
		{
			$this->__set('activePage', intval($params['activePage']));
		}
		if(array_key_exists('linesPerPages', $params) && $params['linesPerPages'] > 0)
		{
			$this->__set('linesPerPages', intval($params['linesPerPages']));
		}
		if(array_key_exists('maxPage', $params) && intval($params['maxPage']) > 0)
		{
			$this->__set('maxPage', intval($params['maxPage']));
		}
		if(array_key_exists('activeButton', $params))
		{
			$this->activeButton($params['activeButton']);
		}
		if(array_key_exists('linksPerPage', $params))
		{
			$this->setLinksPerPage(intval($params['linksPerPage']));
		}
		if(array_key_exists('textPrevious', $params))
		{
			$this->__set('textPrevious', $params['textPrevious']);
		}
		if(array_key_exists('textNext', $params))
		{
			$this->__set('textNext', $params['textNext']);
		}
		if(array_key_exists('textFirst', $params))
		{
			$this->__set('textFirst', $params['textFirst']);
		}
		if(array_key_exists('textLast', $params))
		{
			$this->__set('textLast', $params['textLast']);
		}
		if(array_key_exists('textEmpty', $params))
		{
			$this->__set('textEmpty', $params['textEmpty']);
		}
		if(array_key_exists('classNameUl', $params))
		{
			$this->__set('classNameUl', $params['classNameUl']);
		}
		if(array_key_exists('classNameLi', $params))
		{
			$this->__set('classNameLi', $params['classNameLi']);
		}
		if(array_key_exists('classNameActive', $params))
		{
			$this->__set('classNameActive', $params['classNameActive']);
		}
		if(array_key_exists('classNameNext', $params))
		{
			$this->__set('classNameNext', $params['classNameNext']);
		}
		if(array_key_exists('classNamePrevious', $params))
		{
			$this->__set('classNamePrevious', $params['classNamePrevious']);
		}
		if(array_key_exists('classNameDisabled', $params))
		{
			$this->__set('classNameDisabled', $params['classNameDisabled']);
		}
		$this->generate();
	}

	/**
	 * Calculer le nombre de page total pour la pagination
	 * @param int $nbRequestLines Nombre de résultat total de disponible
	 * @param null $nbLinesPerPage Nombre de lignes de résultat à afficher par page
	 */
	public function calculMaxPage($nbRequestLines, $nbLinesPerPage = null)
	{
		$LinesPerPage = intval($nbLinesPerPage);
		if(!is_null($LinesPerPage) && $LinesPerPage > 0)
		{
			$this->__set('linesPerPages', $LinesPerPage);
		}
		else
			{
			$LinesPerPage = $this->__get('linesPerPages');
		}
		$this->__set('maxPage', ceil($nbRequestLines/$LinesPerPage));
	}

	/**
	 * Permet d'activer la liste des liens "First', "Next", "Previous", "Last" et "Empty"
	 * @param array $buttonsActive Liste des liens à activer ou désactiver
	 */
	public function activeButton($buttonsActive = []){
		if(array_key_exists('FirstPageLink', $buttonsActive) && ($buttonsActive['FirstPageLink'] === true || $buttonsActive['FirstPageLink'] === false) )
		{
			$this->__set('addFirstPageLink', $buttonsActive['FirstPageLink']);
		}
		if(array_key_exists('LastPageLink', $buttonsActive) && ($buttonsActive['LastPageLink'] === true || $buttonsActive['LastPageLink'] === false) )
		{
			$this->__set('addLastPageLink', $buttonsActive['LastPageLink']);
		}
		if(array_key_exists('NextPageLink', $buttonsActive) && ($buttonsActive['NextPageLink'] === true || $buttonsActive['NextPageLink'] === false) )
		{
			$this->__set('addNextPageLink', $buttonsActive['NextPageLink']);
		}
		if(array_key_exists('PreviousPageLink', $buttonsActive) && ($buttonsActive['PreviousPageLink'] === true || $buttonsActive['PreviousPageLink'] === false) )
		{
			$this->__set('addPreviousPageLink', $buttonsActive['PreviousPageLink']);
		}
		if(array_key_exists('EmptyPageLink', $buttonsActive) && ($buttonsActive['EmptyPageLink'] === true || $buttonsActive['EmptyPageLink'] === false) )
		{
			$this->__set('addEmptyPageLink', $buttonsActive['EmptyPageLink']);
		}
	}

	/**
	 * Définir le nombre de liens (hors "Next", "Previous", "First" et "Last") à afficher dans la pagination
	 * @param int $LinksPerPage Nombre de liens
	 */
	public function setLinksPerPage($LinksPerPage)
	{
		if(!is_null($LinksPerPage) && $LinksPerPage > 0) {
			$this->__set('linksPerPage', intval($LinksPerPage));
		}
	}

	/**
	 * Génération de la pagination en HTML
	 * @return string
	 */
	public function generateHtml()
	{
		$html = '<ul class="'.$this->__get('classNameUl').'">';
		foreach ($this->generate() as $link)
		{
			$html .='<li class="'.$link['className'].'"><a href="'.$link['link'].'">'.$link['text'].'</a></li>';
		}
		return $html.'</ul>';
	}

	/**
	 * Gérérer la pagination dans un tableau
	 * @return array Tableau contenant la pagination
	 */
	protected function generate()
	{
		$this->__set('paginator',[]);
		$this->addFirstPageLink();
		$this->addPreviousPageLink();

		$maxPage = ($this->__get('linksPerPage')<$this->__get('maxPage')) ? $this->__get('linksPerPage')-(($this->__get('addLastPageLink')) ? 1 : 0)-(($this->__get('addEmptyPageLink')) ? 1 : 0) : $this->__get('maxPage');
		$minPage = ($this->__get('maxPage')> $this->__get('linksPerPage')+2) ? ($this->__get('maxPage')-$this->__get('linksPerPage')+2) : 1;

		if($this->__get('maxPage') == 1)
		{
			$className = $this->__get('classNameLi').' '.$this->__get('classNameActive').' '.$this->__get('classNameFirst').' '.$this->__get('classNameLast');

			$this->addLink("#",true,false,1,$className);
		}
		elseif($this->__get('activePage') < $maxPage)
		{
			for ($index = 1; $index <= $maxPage; $index++)
			{
				$active = ($this->__get('activePage') === $index) ? true : false;
				$link = ($this->__get('activePage') === $index) ? "#" : $this->__get('url').$index;
				$className = $this->__get('classNameLi').(($this->__get('activePage') === $index) ? ' '.$this->__get('classNameActive') : '').(($index === 1 && $this->__get('activePage') === $index && ((!$this->__get('addFirstPageLink') && !$this->__get('addPreviousPageLink')) || $this->__get('addFirstPageLink') || $this->__get('addPreviousPageLink'))) ? ' '.$this->__get('classNameFirst') : '');

				$this->addLink($link,$active,$active,$index,$className);
			}

			$this->addLastAndEmptyLink();
		}
		elseif($this->__get('activePage') > $minPage)
		{
			$this->addFirstAndEmptyLink();
			for ($index = $minPage; $index <= $this->__get('maxPage'); $index++)
			{
				$active = ($this->__get('activePage') === $index) ? true : false;
				$link = ($this->__get('activePage') === $index) ? "#" : $this->__get('url').$index;
				$className = $this->__get('classNameLi').(($this->__get('activePage') === $index) ? ' '.$this->__get('classNameActive') : '').(($index == $this->__get('maxPage') && $this->__get('activePage') === $index && ((!$this->__get('addLastPageLink') && !$this->__get('addNextPageLink')) || $this->__get('addLastPageLink') || $this->__get('addNextPageLink'))) ? ' '.$this->__get('classNameLast') : '');

				$this->addLink($link,$active,$active,$index,$className);
			}
		}
		else
		{
			$this->addFirstAndEmptyLink();
			for ($index = ($this->__get('activePage') == 1) ? 1 : $this->__get('activePage')-1; $index <= $this->__get('activePage')+1; $index++)
			{
				$active = ($this->__get('activePage') === $index) ? true : false;
				$link = ($this->__get('activePage') === $index) ? "#" : $this->__get('url').$index;
				$className = $this->__get('classNameLi').(($this->__get('activePage') === $index) ? ' '.$this->__get('classNameActive') : '');

				$this->addLink($link,$active,$active,$index,$className);
			}
			$this->addLastAndEmptyLink();
		}

		$this->addNextPageLink();
		$this->addLastPageLink();
		return $this->__get('paginator');
	}

	/**
	 * Ajouter le lien "Next" (si celui-ci est activé) dans la pagination
	 */
	protected function addNextPageLink(){
		if($this->__get('addNextPageLink') && $this->__get('activePage') > 0 && $this->__get('maxPage') > 1)
		{
			$disabled = (($this->__get('activePage')+1) > $this->__get('maxPage')) ? true : false;
			if(!$disabled)
			{
				$link = (($disabled) ? "#" : $this->__get('url') . ($this->__get('activePage') + 1));
				$className = $this->__get('classNameLi') . (!$this->__get('addLastPageLink') ? ' ' . $this->__get('classNameLast') : '') . ' ' . $this->__get('classNameNext') . (($disabled) ? ' ' . $this->__get('classNameDisabled') : '');

				$this->addLink($link,false,false,$this->__get('textNext'),$className);
			}
		}
	}

	/**
	 * Ajouter le lien "Previous" (si celui-ci est activé) dans la pagination
	 */
	protected function addPreviousPageLink(){
		if($this->__get('addPreviousPageLink') && $this->__get('activePage') > 0 && $this->__get('maxPage') > 1)
		{
			$disabled = (($this->__get('activePage')-1) <= 0 ) ? true : false;
			if(!$disabled)
			{
				$link = (($disabled) ? "#" : $this->__get('url').($this->__get('activePage')-1));
				$className =  $this->__get('classNameLi').(!$this->__get('addFirstPageLink') ? ' '.$this->__get('classNameFirst') : '').' '.$this->__get('classNamePrevious').(($disabled) ? ' '.$this->__get('classNameDisabled') : '');

				$this->addLink($link,false,$disabled,$this->__get('textPrevious'),$className);
			}
		}
	}

	/**
	 * Ajouter le lien "First" (si celui-ci est activé) dans la pagination
	 * @param string $text Texte à afficher dans le lien
	 */
	protected function addFirstPageLink($text=""){
		if($this->__get('addFirstPageLink') && $this->__get('activePage') > 0 && $this->__get('maxPage') > 1)
		{
			$disabled = ($this->__get('activePage')===1 ) ? true : false;
			if(!$disabled) {
				$link = (($disabled) ? "#" : $this->__get('url') . "1");
				$text = (empty($text) ? $this->__get('textFirst') : $text);
				$className = $this->__get('classNameLi') . ((empty($text)) ? ' ' . $this->__get('classNameFirst') : '') . (($disabled) ? ' ' . $this->__get('classNameDisabled') : '');

				$this->addLink($link,$disabled,$disabled,$text,$className);
			}
		}
	}

	/**
	 * Ajouter le lien "Last" (si celui-ci est activé) dans la pagination
	 * @param string $text Texte à afficher dans le lien
	 */
	protected function addLastPageLink($text=""){
		if($this->__get('addLastPageLink') && $this->__get('activePage') > 0 && $this->__get('maxPage') > 1)
		{
			$disabled = ($this->__get('activePage') >= $this->__get('maxPage') ) ? true : false;
			if(!$disabled) {
				$link = (($disabled) ? "#" : $this->__get('url') . $this->__get('maxPage'));
				$text = (empty($text) ? $this->__get('textLast') : $text);
				$className = $this->__get('classNameLi') . ((empty($text)) ? ' ' . $this->__get('classNameLast') : '') . (($disabled) ? ' ' . $this->__get('classNameDisabled') : '');

				$this->addLink($link,$disabled,$disabled,$text,$className);
			}
		}
	}

	/**
	 * Ajouter le lien "Empty" (si celui-ci est activé) dans la pagination
	 */
	protected function addEmptyPageLink(){
		if($this->__get('addEmptyPageLink'))
		{
			$className = $this->__get('classNameLi').' ' .$this->__get('classNameDisabled');

			$this->addLink("#",false,true,$this->__get('textEmpty'),$className);
		}
	}

	protected function addFirstAndEmptyLink()
	{
		if($this->__get('maxPage') > 1 && $this->__get('activePage')-1 > 1 && $this->__get('maxPage') > $this->__get('linesPerPages')) {
			$this->addFirstPageLink(1);
			if ($this->__get('activePage') > 2) {
				$this->addEmptyPageLink();
			}
		}
	}

	protected function addLastAndEmptyLink()
	{
		if($this->__get('maxPage') > 1) {
			if($this->__get('activePage') < $this->__get('maxPage')-1 && $this->__get('activePage')+1 > $this->__get('maxPage'))
			{
				$this->addEmptyPageLink();
			}
			$this->addLastPageLink($this->__get('maxPage'));
		}
	}

	/**
	 * Ajout d'un lien à la pagination
	 * @param string $link Lien
	 * @param boolean $active True s'il s'agit de la page active
	 * @param boolean $disabled True si le lien est désactivé
	 * @param string $text Texte a afficher dans le lien
	 * @param string $classname Nom de la class css pour l'élément de la liste (<li>)
	 */
	protected function addLink($link,$active,$disabled,$text,$classname)
	{
		$this->paginator[] = array(
			'link' => $link,
			'active' => $active,
			'disabled' => $disabled,
			'text'=> $text,
			'className' =>  $classname
		);
	}

	/**
	 * Desctuctor
	 */
	public function __destruct(){}

	/**
	 * Getter
	 * @param string $var Nom de la variable à récupérer
	 * @return mixed
	 */
	public function __get($var)
	{
		return $this->$var;
	}

	/**
	 * Setter
	 * @param string $var Nom de la variable à setter
	 * @param string $value Valeur à attribuer à la variable
	 */
	public function __set($var,$value="")
	{
		$this->$var = $value;
	}

	/**
	 * Debug
	 * @param mixed $var Variable à débugger
	 * @param string $title Titre à mettre au debug
	 */
	public function debug($var, $title = "Debug")
	{
		echo "<h4>$title</h4><pre>";
		var_dump($var);
		echo "</pre><<<<<<END $title>>>>><br/>";
	}
}