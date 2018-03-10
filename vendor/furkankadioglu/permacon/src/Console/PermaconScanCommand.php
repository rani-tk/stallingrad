<?php namespace furkankadioglu\Permacon\Console;

/************************
*
*	Rys - Furkan Kadıoğlu
*	July - 2016	
*	http://github.com/furkankadioglu
*
*************************/

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PermaconScanCommand extends Command {

	protected $name = 'permacon:scan';
	protected $description = 'Return all configration files and generating stubs for each.';
	protected $type = 'Module';


	public function fire()
	{
		$this->info('+ Scanning configration files');

		$files = array_slice(scandir(config_path()), 2);


		foreach($files as $file)
		{
			$this->info("Scanned and Generated Copy: ".$file);
			$content = file_get_contents(config_path()."/".$file);
			$save = file_put_contents(storage_path()."/permacon/".$file, $content);
		}
		
	}


}
