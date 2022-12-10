## Sistem Klaim Ban

Sistem Klaim Ban Application develop by using Laravel 9 Framework.


## ⚙ Prerequisites
- PHP >= 8.1.10
- XAMPP Control Panel v3.3.0
- npm >= 8.19.2
- Composer >= 2.4.1

## 🛠 Installation
- Create db name db_sistemklaim
- Create imgKlaim folder and imgProduk folder inside sistemklaim public folder (..\sistemklaim\public)
- Use cmd/terminal/gitbash
- Copy and Paste .env.example then rename to .env

```bash
#install composer package
composer install

php artisan key:generate

#insert table database
php artisan migrate

#insert dummy data
php artisan db:seed --class=CreateUsersSeeder
php artisan db:seed --class=CreateDamagesSeeder
```

## 🚀 Usage
- use cmd/terminal/gitbash
```bash
cd ../../sistemklaim
php artisan serve
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

