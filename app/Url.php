<?php
/**
 * This class extracts the html code corresponding to a url
 *
 * ctleake 1st May 2016
 */

namespace Sainsburys\Application;

class Url
{
	protected $html;

	/**
	 * Url constructor.
	 * @param $url
     */
	public function __construct($url)
	{
		try {
			$this->html = file_get_contents($url);
		} catch (\Exception $e) {
			echo 'Unable to find '.$url.'<br>Error message '.$e->getMessage().'<br>';
		}
	}

	/**
	 * @return mixed
     */
	public function getHtml()
	{
		return $this->html;
	}
		
}