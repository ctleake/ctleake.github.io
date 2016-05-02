<?php
/**
 * This class extracts all Unit Prices from a NodeList of html
 *
 * ctleake 1st May 2016
 */
namespace Sainsburys\Application;

class UnitPrices
{
	protected $unit_prices = [];

	/**
	 * UnitPrices constructor.
	 * @param \DOMNodeList $nodelist
     */
	public function __construct(\DOMNodeList $nodelist)
	{
		$length = $nodelist->length;
		for($i = 0; $i < $length; $i++) {
			$li = $nodelist->item($i);
			$ps = $li->getElementsByTagName('p');
			$unit_price = $ps->item(0)->nodeValue;
			$unit_price = preg_replace("/[^0-9\.]/","",$unit_price);
			$this->unit_prices[] = $unit_price;
		}
	}

	/**
	 * @return array
     */
	public function getUnitPrices() 
	{
		return $this->unit_prices;
	}
		
}
