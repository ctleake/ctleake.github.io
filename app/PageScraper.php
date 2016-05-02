<?php

namespace Sainsburys\Application;

class PageScraper
{
	protected $html;
	
	public function __construct()
	{
		$this->html = file_get_contents('http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html');
	}
	
	public function makeFilteredArray()
	{
		$dom = new \DOMDocument();
		@$dom->loadHTML($this->html);
		
		$xPath = new \DOMXPath($dom);
		$lis = $xPath->query('//ul[contains(@class,"productLister")]/li');

		$length = $lis->length;
		$results_array = array();
		$total = 0;
		for($i = 0; $i < $length; $i++) {
			$li = $lis->item($i);
			$a = $li->getElementsByTagName('a');
			$title = trim($a->item(0)->nodeValue);
			$href = $a->item(0)->getAttribute('href');
			$size = strlen(file_get_contents($href)) / 1024;
			$description = $this->getLinkDescription($href);
			$ps = $li->getElementsByTagName('p');
			$unit_price = $ps->item(0)->nodeValue;
			$unit_price = preg_replace("/[^0-9\.]/","",$unit_price);
			$total += $unit_price;
			$result_array = array();
			$result_array['title'] = $title;
			$result_array['size'] = sprintf("%1\$.1f", $size).'kb';
			$result_array['unit_price'] = $unit_price;
			$result_array['description'] = $description;
			$results_array['results'][] = $result_array;
		}
		$results_array['results']['total'] = sprintf("%1\$.2f", $total);
		return $results_array;
	}		
		
	private function getLinkDescription($href) 
	{
		$dom = new \DOMDocument();
		$link = file_get_contents($href);
		@$dom->loadHTML($link);
		
		$xPath = new \DOMXPath($dom);
		$product_texts = $xPath->query('//div[contains(@class,"productText")]/p');
		return $product_texts->item(0)->nodeValue;
	}
}