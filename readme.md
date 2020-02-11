Sphinx Search for Laravel 6 - Custom build with snippets support 
=======================
Simple Laravel 6 package for make queries to Sphinx Search.
Forked from by sngrl/sphinxsearch package for Laravel 5.

This package was created to import to the site packagist.org and allow installation through Composer (https://getcomposer.org/).

Installation
=======================

Require this package in your composer.json:
 
```php
	"require": {
        /*** Some others packages ***/
		"ptand/sphinxsearch": "dev-master",
	},
```

Run in your console `composer update` command to pull down the latest version of Sphinx Search.


Or just run this in console:

```php
composer require ptand/sphinxsearch:dev-master
```

After updating composer, add the ServiceProvider to the "providers" array in config/app.php:

```php
	'providers' => array(
        /*** Some others providers ***/
        ptand\SphinxSearch\SphinxSearchServiceProvider::class,
    ),
```

You can add this line to the files, where you may use SphinxSearch:

```php
use ptand\SphinxSearch\SphinxSearch;
```

Configuration
=======================

To use Sphinx Search, you need to configure your indexes and what model it should query. To do so, publish the configuration into your app.

```php
php artisan vendor:publish --provider=ptand\SphinxSearch\SphinxSearchServiceProvider --force
```

This will create the file `config/sphinxsearch.php`. Modify as needed the host and port, and configure the indexes, binding them to a table and id column.

```php
return array (
	'host'    => '127.0.0.1',
	'port'    => 9312,
	'indexes' => array (
		'my_index_name' => array ( 'table' => 'my_keywords_table', 'column' => 'id' ),
	)
);
```
Or disable the model querying to just get a list of result id's.
```php
return array (
	'host'    => '127.0.0.1',
	'port'    => 9312,
	'indexes' => array (
		'my_index_name' => FALSE,
	)
);
```


Usage
=======================

Basic query (raw sphinx results)
```php
$sphinx = new SphinxSearch();
$results = $sphinx->search('my query', 'index_name')->query();
```

Basic query (with Eloquent)
```php
$results = $sphinx->search('my query', 'index_name')->get();
```

Query another Sphinx index with limit and filters.
```php
$results = $sphinx->search('my query', 'index_name')
	->limit(30)
	->filter('attribute', array(1, 2))
	->range('int_attribute', 1, 10)
	->get();
```

Query with match and sort type specified.
```php
$result = $sphinx->search('my query', 'index_name')
	->setFieldWeights(
		array(
			'partno'  => 10,
			'name'    => 8,
			'details' => 1
		)
	)
	->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
	->setSortMode(\Sphinx\SphinxClient::SPH_SORT_EXTENDED, "@weight DESC")
	->get(true);  //passing true causes get() to respect returned sort order
```


License
=======================

Sngrl Sphinx Search is open-sourced software licensed under the MIT license
