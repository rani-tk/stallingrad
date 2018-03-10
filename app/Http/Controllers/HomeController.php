<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class HomeController extends Controller {

	public function checkInstallation()
	{
		$installed = env("INSTALLED");
		if ($installed == "0") {
			return view("installation");
		} else {
			return redirect("/");
		}
	}
}