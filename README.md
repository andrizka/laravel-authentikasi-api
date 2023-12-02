# Laravel Authentikasi Api

1. Aplikasi ini menggunakan laravel v10.10
2. REST API authentikasi dengan laravel sanctum
3. Database seeds user email: `admin@admin.com` password: `password`
4. Database migration
5. Basic laravel resource, controller dengan default method index, create, store dll
6. Datatables untuk menampilkan data, dengan server-side rendering
7. CRUD melalui REST API

## Installation

Masuk direktori localhost.

```bash
#windows
cd c:/xampp/htdocs

#linux
cd /var/www/html
```

Unduh file.

```bash
git clone https://github.com/andrizka/laravel-authentikasi-api.git
```

Konfigurasi file .env sesuai pengaturan database anda.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Seeder database.

```bash
 php artisan db:seed
```

Buka aplikasi.

```
http://localhot/laravel-authentikasi-api
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
