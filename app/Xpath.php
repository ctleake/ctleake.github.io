<?php
/**
 * This class loads html code into DOMXPath for traversal
 *
 * ctleake 1st May 2016
 */
namespace Sainsburys\Application;

class Xpath
{
	protected $xpath;

	/**
	 * Xpath constructor.
	 * @param $html
     */
	public function __construct($html)
	{
		$dom = new \DOMDocument();
		@$dom->loadHTML($html);
		
		$this->xpath = new \DOMXPath($dom);
	}

	/**
	 * @return \DOMXPath
     */
	public function getXpath() 
	{
		return $this->xpath;
	}
		
}