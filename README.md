# E-Sangu Laravel
project untuk final project mata kuliah Web Programming. E-Sangu merupakan aplikasi untuk menulis pengeluran dan membuat budgeting. Yang membedakan dari aplikasi lainnya adalah fitur relasi antara `Wali` dan `Beban`, dengan fitur ini si `wali` dapat memantau pengeluran atau pemakaian uang saku yang dilakukan oleh si `beban`.

## Library used
- Bootstrap
- Sanctum

## Installation
1. run command `composer install`
2. create database on your phpMyAdmin
3. change database value in file `.env`
4. run migration command `php artisan migrate`
5. run seeding command `php artisan db:see --class=CategorySeeder`
6. run `php artisan serve` and enjoy the response~

### License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
