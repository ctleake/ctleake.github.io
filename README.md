Sainsburys Test - Product Page Scraper  
======================================

This Application captures the HTML of a test web page of products from  [the test web page](http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html) and extracts Titles, Sizes, Unit Prices, and Descriptions; it outputs the results in JSON.

Installation / Usage
--------------------

1. Ensure PHP 5,5.12 is loaded together with composer.
2. Download the Application into server home directory.
3. ``` server/homedir> composer install ```  
4. To run the application type 
	``` server/homedir/bin> php appliaction.php scrape ```

In linux amend the first line of application.php in the bin directory to read: ``` #!/user/bin/env php ```. Also execute
 
``` server/homedir? chmod +x application.php ``` 
  



Author
------

Chris Leake - <ctleake@sky.com><br />

Acknowledgments
---------------

- Sainsbury's Technical Team for inspiring me to review SOLID principles."# ctleake.github.io" 
