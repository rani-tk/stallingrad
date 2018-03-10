### Permacon

![Permacon](https://s31.postimg.org/slm1fxauz/Screen_Shot_2016_07_06_at_23_48_22.png)

Permanently Save and Set Config Variables For Laravel 5

### Installation

The best way to install this package is through your terminal via Composer.

Add the following line to the `composer.json` file and fire `composer update`

```
"furkankadioglu/permacon": "dev-master"
```

Once this operation is complete, simply add the service provider to your project's `config/app.php`

###### Service Provider
```
        furkankadioglu\Permacon\PermaconServiceProvider::class,
```

###### Aliases
```
        'Permacon'  => 'furkankadioglu\Permacon\Facade',

```

### Usage


###### Get Data

```
use Permacon;

return Permacon::get("app", "locale");
// returns "en"

```

Getting your config variables like Config:get("app.locale")

###### Set Data

```
use Permacon;

Permacon::set("config", "locale", "tr");
return Permacon::get("app", "locale");
//returns "tr"
```

Update config variables

###### Scan Data

```
use Permacon;
Permacon::scan("database");
```

Scans config/database.php for making a copy.

###### Scan All

```
use Permacon;
Permacon::scanAll();
```

Scans config folder and generating copies for edit.


### Commands

```
php artisan permacon:scan
```

Scans config folder and generating copies for edit.

