<p align="center"><img src="https://github.com/pacojaez/ourwedding/blob/master/public/img/olgapaco.png?raw=true" width="400"></p>

<p align="center">
BIBLIOTECA APP
</p>

## About OurWeddingApp

BIBLIOTECA APP is a web application developed using the FASTLIGHT PHP framework developed by Robert Sallent. 

It´s an App with three levels of privileges: Guest, Privilege 300 and Privilege 1000.

The Guest CAN:
* -Watch book list.
* -Watch Themes
* -Watch book details


The Privilege 300 User CAN:
* -CRUD on Libro model.
* -CRUD on Ejemplar model
* -CRUD on Tema model
* -Crud on Socio model


The Privilege 1000 as ADMIN CAN also:
* -CRUD on Usuario model.


## Some images of the App:
<p align="center">
  <img src="https://github.com/pacojaez/ourwedding/blob/master/public/img/screenshots/ourWedding1.png?raw=true" alt="Americana Portada" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/ourwedding/blob/master/public/img/screenshots/ourWedding2.png?raw=true" alt="Americana Portada" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/ourwedding/blob/master/public/img/screenshots/ourWedding3.png?raw=true" alt="Americana Portada" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/ourwedding/blob/master/public/img/screenshots/ourWedding4.png?raw=true" alt="Americana Portada" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/ourwedding/blob/master/public/img/screenshots/ourWedding5.png?raw=true" alt="Americana Portada" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/ourwedding/blob/master/public/img/screenshots/ourWedding6.png?raw=true" alt="Americana Portada" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/ourwedding/blob/master/public/img/screenshots/ourWedding7.png?raw=true" alt="Americana Portada" width="500">
</p>

## Installation

Clone the repo or download ZIP and extract it.

```php
composer install
```

```js
npm install && npm run dev
```

You need to config your database .env file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ourwedding
DB_USERNAME=root
DB_PASSWORD=
```

run to get dummy data

```php
php artisan migrate:refresh --seed
```
And you need to config your mail smtp

```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```

Once you´ve the Database log in with:

# USER: admin@admin.com
# PASSWORD: password


That´s all.

## Contributing

Thank you for considering contributing to OurWeddingApp!

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Security Vulnerabilities

If you discover a security vulnerability within OurWeddingApp, please send an e-mail to PacoJaez via [pacojaez@gmail.com](mailto:pacojaez@gmail.com). All security vulnerabilities will be promptly addressed.

## License

[MIT license](https://opensource.org/licenses/MIT).

## Thanks to:
Robert Sallent for all his lessons.
A lot of people I´m already learning with.
All Laravel Ecosystem