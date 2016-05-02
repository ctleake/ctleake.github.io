<?php
/**
 * This class extracts html via DOMXNodeList via an XPath query
 *
 * ctleake 2nd May 2016
 */
namespace Sainsburys\Application;

class NodeList
{
	protected $nodelist;

	/**
	 * NodeList constructor.
	 * @param \DOMXPath $xpath
	 * @param $pathstring
     */
	public function __construct(\DOMXPath $xpath, $pathstring)
	{
		$this->nodelist = $xpath->query($pathstring);
	}

	/**
	 * @return \DOMNodeList
     */
	public function getNodeList() 
	{
		return $this->nodelist;
	}
		
}