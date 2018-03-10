<?php namespace furkankadioglu\Permacon;

/************************
*
*	Rys - Furkan Kadıoğlu
*	July - 2016	
*	http://github.com/furkankadioglu
*
*************************/

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;

use furkankadioglu\Permacon\Permacon;

class PermaconServiceProvider extends ServiceProvider {

	protected $files;

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */

	// Publish - Folders
	public $publishFolders = [
		'permacon',
	];


	public function boot() {

		//	Publish Folders Generate
		foreach((array)$this->publishFolders as $pf)
		{
			if (!file_exists(storage_path($pf))) 
			{
		    	mkdir(storage_path($pf), 0777, true);
			}
		}
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->files = new Filesystem;
		$this->registerScanCommand();

		$method = "singleton";
		// Bind the manager as a singleton on the container.
		$this->app->$method('permacon', function($app) {
			
			/**
			 * Construct the actual manager.
			 */
			return new Permacon($app);
		});
	}

	/**
	 * Register the "permacon:scan" console command.
	 *
	 * @return Console\PermaconScanCommand
	 */
	protected function registerScanCommand() {
		
		$this->commands('permacon.scan');
		$bind_method = method_exists($this->app, 'bindShared') ? 'bindShared' : 'singleton';
		$this->app->{$bind_method}('permacon.scan', function($app) {
			return new Console\PermaconScanCommand($this->files);
		});
	}


}
