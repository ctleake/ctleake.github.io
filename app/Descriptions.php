<?php
/**
 * This class extracts all Descriptions from a NodeList of html
 * which is itself extracted from the Product link
 *
 * ctleake 1st May 2016
 */
namespace Sainsburys\Application;

use Sainsburys\Application\Url;
use Sainsburys\Application\Xpath;
use Sainsburys\Application\NodeList;

class Descriptions
{
	protected $descriptions = [];

	/**
	 * Descriptions constructor.
	 * @param \DOMNodeList $nodelist
     */
	public function __construct(\DOMNodeList $nodelist)
	{
		$length = $nodelist->length;
		$total = 0;
		for($i = 0; $i < $length; $i++) {
			$li = $nodelist->item($i);
			$a = $li->getElementsByTagName('a');
			$link = $a->item(0)->getAttribute('href');
			$nl = $this->getNl($link);
			$description = $nl->item(0)->nodeValue;
			$this->descriptions[] = $description;
		}
	}

	/**
	 * @return array
     */
	public function getDescriptions() 
	{
		return $this->descriptions;
	}

	/**
	 * @param $link
	 * @return \DOMNodeList
     */
	private function getNl($link)
	{
		$url = new Url($link);
		$html = $url->getHtml();
		$xp = new Xpath($html);
		$xpath = $xp->getXpath();
		$nl = new NodeList($xpath, '//div[contains(@class,"productText")]/p');
		return $nl->getNodeList();
	}
	
}
