# Setup CakePHP App using Composer and Grunt

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

`define(`

`	'CAKE_CORE_INCLUDE_PATH',`

`	ROOT . DS . 'lib' . DS . 'pear-pear.cakephp.org' . DS . 'CakePHP'`

`);`

* Edit app/Config/bootstrap.php. Add the following

`//Enable Plugins`

`CakePlugin::loadAll();`

`// Load Composer autoload.`

`require ROOT . DS . 'lib' . DS . 'autoload.php';`

`// Remove and re-prepend CakePHP's autoloader as Composer thinks it is the`

`// most important.`

`// See: http://goo.gl/kKVJO7`

`spl_autoload_unregister(array('App', 'load'));`

`spl_autoload_register(array('App', 'load'), true, true);`

* Edit AppController class in app/Controller/AppController.php

`class AppController extends Controller {`

`	public $components = array('DebugKit.Toolbar');`

`}`

* Your base CakePHP app is setup.

* Create the database and configure app/Config/database.php

* Setup BoostCake: Edit /app/controllers/AppController.php. Add the following in the AppController class:

`	public $helpers = array(`

`		'Session',`

`		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),`

`		'Form' => array('className' => 'BoostCake.BoostCakeForm'),`

`		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),`

`	);`

### Grunt


* `npm install`

    * This should setup Grunt and all of the grunt modules. You should see a node_modules directory created

* `grunt`

    * This will run grunt for the first time.

* `grunt less`

    * Compile less files for the first time