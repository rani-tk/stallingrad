<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

use Artisan;
use App\User;

class ConfigController extends Controller {

	public function getInstallation()
	{
		return view("installation");
	}

	public function createDatabase()
	{
		$data = Request::all();

		$username = $data["username"];
		$password = $data["password"];
		$name = $data["name"];
		$prefix = $data["prefix"];

		self::updateDotEnv("DB_DATABASE",$name);
		self::updateDotEnv("DB_USERNAME",$username);
		self::updateDotEnv("DB_PASSWORD",$password);
		self::updateDotEnv("DB_PREFIX",$prefix);
		self::updateDotEnv("INSTALLED","1");

		$path = "database.bash";
		copy("../scripts/database.bash", $path);
		$text = file_get_contents($path);
		$newtext = str_replace("DATABASENAME", $name, $text);
		$newtext = str_replace("USERNAME", $username, $newtext);
		$newtext = str_replace("PASSWORD", $password, $newtext);
		file_put_contents($path, $newtext);
		$commande = "bash database.bash";
		$result = exec($commande);
		unlink("database.bash");

		// create all tables
		Artisan::call('migrate', array('--force' => true));
		return redirect("/");
		
	}

	protected function updateDotEnv($key, $newValue, $delim='')
	{
	    $path = base_path('.env');
	    // get old value from current env
	    $oldValue = env($key);

	    // was there any change?
	    if ($oldValue === $newValue) {
	        return;
	    }

	    // rewrite file content with changed data
	    if (file_exists($path)) {
	        // replace current value with new value 
	        file_put_contents(
	            $path, str_replace(
	                $key.'='.$delim.$oldValue.$delim, 
	                $key.'='.$delim.$newValue.$delim, 
	                file_get_contents($path)
	            )
	        );
	    }
	}

}