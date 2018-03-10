### Permacon

![Permacon](https://s31.postimg.org/slm1fxauz/Screen_Shot_2016_07_06_at_23_48_22.png)

Kalıcı config değişkenleri tanımlamak için Laravel 5.x paketi

### Installation

Tavsiye edilen yükleme yöntemi, composer aracılığıyla bu işlemi yapmanız.

Aşağıdaki satırı `composer.json` dosyasına ekledikten sonra consoledan `composer update` yazmalısınız.

```
"furkankadioglu/permacon": "dev-master"
```

Laravel entegrasyonu için provider ve alias tanımlıyoruz.

###### Service Provider
```
        furkankadioglu\Permacon\PermaconServiceProvider::class,
```

###### Aliases
```
        'Permacon'  => 'furkankadioglu\Permacon\Facade',

```

### Kullanım


###### Veri Alma

```
use Permacon;

return Permacon::get("app", "locale");
// returns "en"

```

Config bölümünde bulunan veriyi getirir tıpkı Config:get("app.locale") gibi.

###### Veri Kaydetme

```
use Permacon;

Permacon::set("config", "locale", "tr");
return Permacon::get("app", "locale");
//returns "tr"
```

Varolan değişkenlerin değerlerini bu şekilde değiştirebilirsiniz, zaten config.php'nin içinde bulunmayan bir değişken tanımlayamazsınız(!).

###### Tekli Tarama

```
use Permacon;
Permacon::scan("database");
```

Bu işlem sayesinde config/database.php taranır (veya belirttiğiniz dosya) ve storage/permacon klasörüne bir kopyası taşınır, aksaklık durumunda veri kaybı yaşamamanız için. Eğer scan edilmemiş ise Permacon çalışmayacaktır.

###### Çoklu Tarama

```
use Permacon;
Permacon::scanAll();
```

Bu işlem sayesinde config klasörü taranır ve storage/permacon klasörüne bir her bir dosyanın kopyası taşınır, aksaklık durumunda veri kaybı yaşamamanız için. Eğer scan edilmemiş değişkeniniz veya dosyası ise Permacon çalışmayacaktır.


### Commands

```
php artisan permacon:scan
```

Bu komut sayesinde config klasörü taranır ve storage/permacon klasörüne bir her bir dosyanın kopyası taşınır, aksaklık durumunda veri kaybı yaşamamanız için. Eğer scan edilmemiş değişkeniniz veya dosyası ise Permacon çalışmayacaktır.

