<?php
/**
 * This class extracts all Titles from a NodeList of html
 *
 * ctleake 1st May 2016
 */
namespace Sainsburys\Application;

class Titles
{
	protected $titles = [];

	/**
	 * Titles constructor.
	 * @param \DOMNodeList $nodelist
     */
	public function __construct(\DOMNodeList $nodelist)
	{
		$length = $nodelist->length;
		$total = 0;
		for($i = 0; $i < $length; $i++) {
			$li = $nodelist->item($i);
			$a = $li->getElementsByTagName('a');
			$title = trim($a->item(0)->nodeValue);

			$this->titles[] = $title;
		}
	}

	/**
	 * @return array
     */
	public function getTitles() 
	{
		return $this->titles;
	}
		
}
