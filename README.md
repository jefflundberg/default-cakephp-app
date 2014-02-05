# Setup CakePHP App using Composer and Grunt

This repo is a starting point for a CakePHP app. Here’s what you get:

* CakePHP
* BoostCake for Bootstrap integration
* Bootstrap
* Font Awesome
* jQuery
* Underscore
* Backbone
* Grunt
    * jshint & uglify for JavaScript debugging, compression, and optimization
    * LESS with Source Maps (see [Tuts+ Tutorial](http://net.tutsplus.com/tutorials/tools-and-tips/working-with-less-and-the-chrome-devtools/)) for Chrome Dev Tools debugging and CSS compression
    * Image compression with smushit
    * Watch with PHP hinting


## Prerequisites

* Install [node.js](http://nodejs.org/)

* Install [composer](http://getcomposer.org/)

## Setup

### Composer

* `composer install`

    * You should now have an app and lib directory

### CakePHP

Refer to [http://book.cakephp.org/2.0/en/installation/advanced-installation.html](http://book.cakephp.org/2.0/en/installation/advanced-installation.html)

* Bake the project

    * Windows: `lib/bin/cake bake project app`

    * Look okay? (y/n/q) [y] > `y`

    * You should now have the complete CakePHP structure under app

* Edit app/webroot/index.php. Replace CAKE_CORE_INCLUDE_PATH (around line 55)

```php
define('CAKE_CORE_INCLUDE_PATH', ROOT . DS . 'lib' . DS . 'pear-pear.cakephp.org' . DS . 'CakePHP');
```

* Edit app/Config/bootstrap.php. Add the following

```php
//Enable Plugins
CakePlugin::loadAll();

// Load Composer autoload.
require ROOT . DS . 'lib' . DS . 'autoload.php';

// Remove and re-prepend CakePHP's autoloader as Composer thinks it is the
// most important.
// See: http://goo.gl/kKVJO7
spl_autoload_unregister(array('App', 'load'));
spl_autoload_register(array('App', 'load'), true, true);
```

* Edit AppController class in app/Controller/AppController.php

```php
class AppController extends Controller {
	public $components = array('DebugKit.Toolbar');
}
```

* Your base CakePHP app is setup.

* Create the database and configure app/Config/database.php

* Setup BoostCake: Edit /app/controllers/AppController.php. Add the following in the AppController class:

```php
	public $helpers = array(
		'Session',
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);
```

* Set the bootstrap template as the default: Edit /app/controllers/AppController.php. Add the following in the AppController class

```php
    function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'bootstrap';
    }
```

### Grunt


* `npm install`

    * This should setup Grunt and all of the grunt modules. You should see a node_modules directory created

* `grunt`

    * This will run grunt for the first time.

* `grunt less`

    * Compile less files for the first time