<?php
/**
 * This class calculates all link sizes from a NodeList of html
 *
 * ctleake 1st May 2016
 */
namespace Sainsburys\Application;

class Sizes
{
	protected $sizes = [];

	/**
	 * Sizes constructor.
	 * @param \DOMNodeList $nodelist
     */
	public function __construct(\DOMNodeList $nodelist)
	{
		$length = $nodelist->length;
		for($i = 0; $i < $length; $i++) {
			$li = $nodelist->item($i);
			$a = $li->getElementsByTagName('a');
			$href = $a->item(0)->getAttribute('href');
			try {
				$link = file_get_contents($href);
			} catch (\Exception $e) {
				echo 'Unable to find '.$href.'<br>Error message '.$e->$e->getMessage().'<br>';
			}
			$size = strlen(file_get_contents($href)) / 1024;
			$this->sizes[] = $size;
		}
	}

	/**
	 * @return array
     */
	public function getSizes() 
	{
		return $this->sizes;
	}
		
}
