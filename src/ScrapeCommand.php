<?php

namespace Sainsburys\Command;

//use Sainsburys\Application\PageScraper;
use Sainsburys\Application\Url;
use Sainsburys\Application\Xpath;
use Sainsburys\Application\NodeList;
use Sainsburys\Application\Titles;
use Sainsburys\Application\Sizes;
use Sainsburys\Application\UnitPrices;
use Sainsburys\Application\Descriptions;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScrapeCommand extends Command
{
	/**
	 * put an explanation of teh scrape command in command console help
     */
	protected function configure()
	{
		$this
			->setName('scrape')
			->setDescription('Scrape Sainsbury\'s grocery site')
		;
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
     */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('I\'m scraping...');
		//$array = new PageScraper();
		//$results_array = $array->makeFilteredArray();

		// extract specifivally the NodeList of Procucts from 5_products.html
		$url = new Url('http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html');
		$html = $url->getHtml();
		$xp = new Xpath($html);
		$xpath = $xp->getXpath();
		$nl = new NodeList($xpath, '//ul[contains(@class,"productLister")]/li');
		$nodelist = $nl->getNodeList();

		// build arrays of Titles, Sizes, Unit Prices, and Descriptions for each product on 5_products.html
		$titles_obj = new Titles($nodelist);
		$titles = $titles_obj->getTitles();
		$sizes_obj = new Sizes($nodelist);
		$sizes = $sizes_obj->getSizes();
		$unit_prices_obj = new UnitPrices($nodelist);
		$unit_prices = $unit_prices_obj->getUnitPrices();
		$descriptions_obj = new Descriptions($nodelist);
		$descriptions = $descriptions_obj->getDescriptions();
		
		// redistribute the Product details into quartets of Title, Size, Unit Price, and Description
		// in a single results_array preliminary to conversion to any data exchange format
		$length = count($titles);
		$results_array = array();
		$total = 0;
		for($i = 0; $i < $length; $i++) {
			$total += $unit_prices[$i];
			$result_array = array();
			$result_array['title'] = $titles[$i];
			$result_array['size'] = sprintf("%1\$.1f", $sizes[$i]).'kb';
			$result_array['unit_price'] = $unit_prices[$i];
			$result_array['description'] = $descriptions[$i];
			$results_array['results'][] = $result_array;
		}
		$results_array['results']['total'] = sprintf("%1\$.2f", $total);

		// convert the array of results, in this case to JSON
		$json_results = json_encode($results_array);

		// display the converted results array on STDOUT
		$output->writeln($json_results);
	}
}
		
		