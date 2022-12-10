<p align="center">SISTEM KLAIM BAN</p>

## About Sistem Klaim ban

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## ⚙ Prerequisites
- PHP >= 8.1.10
- XAMPP Control Panel v3.3.0
- npm >= 8.19.2
- Composer >= 2.4.1

## 🛠 Installation
- Create db name db_sistemklaim
- Create imgKlaim folder and imgProduk folder inside public folder
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

