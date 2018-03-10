<?php namespace furkankadioglu\Permacon;
use Illuminate\Filesystem\Filesystem;

use ArrayAccess;
use Illuminate\Cache\CacheManager as Cache;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Config\Repository as ConfigContract;

class Permacon {

	protected $data = [];
	protected $items = [];
	protected $loaded = false;

	public static function scan($file)
	{	
		$content = file_get_contents(config_path()."/".$file.".php");
		$save = file_put_contents(storage_path()."/permacon/".$file.".php", $content);
	}

	public static function scanAll()
	{
		$files = array_slice(scandir(config_path()), 2);

		foreach($files as $file)
		{
			$content = file_get_contents(config_path()."/".$file);
			$save = file_put_contents(storage_path()."/permacon/".$file, $content);
		}
	}

	public static function get($file, $variable = null)
	{
			$path = storage_path()."/".$file.".php";
			if(!file_exists(storage_path()."/permacon/".$file.".php"))
			{
				throw new \InvalidArgumentException("File reading problem in get function: $path");
			}
		  $realPath = storage_path()."/permacon/".$file.".php";
		  $data =  include $realPath;
		  if(is_null($variable))
		  {
		  	return $data;
		  }
		  else
		  {
		  	return $data[$variable];
		  }
	}

	public static function set($file, $variable, $newValue)
	{
		$oldValue = Permacon::get($file, $variable);
		$path = config_path()."/".$file;
		if(!file_exists(config_path()."/".$file.".php"))
		{
			throw new \InvalidArgumentException("File reading problem in set function: $path");
		}
		$content = file_get_contents(config_path()."/".$file.".php");


		if(!is_array($newValue) || !is_array($oldValue))
		{
			$bul = "'".$variable."' => '".$oldValue."'";
			$yeni = "'".$variable."' => '".$newValue."'";
		}

		$content = str_replace($bul, $yeni, $content);

	  	file_put_contents(storage_path()."/permacon/".$file.".php", $content);
	  	file_put_contents(config_path()."/".$file.".php", $content);
	}
}