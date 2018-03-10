<?php namespace furkankadioglu\Permacon;

class Facade extends \Illuminate\Support\Facades\Facade
{
	protected static function getFacadeAccessor()
	{
		return 'permacon';
	}
}