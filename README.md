<p align="center"><img src="https://github.com/pacojaez/biblioteca/blob/master/screenshots/portada_noidentificado.png?raw=true" width="400"></p>

<p align="center">
BIBLIOTECA APP
</p>

## About BiblioAPP

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
  <img src="https://github.com/pacojaez/biblioteca/blob/master/screenshots/Listado_libros_usuario_identificado_privilegio_300.png?raw=true" alt="BiblioAPP" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/biblioteca/blob/master/screenshots/detalle_socio_prestamos_sin_devolver_historico_prestamos.png?raw=true" alt="BiblioAPP" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/biblioteca/blob/master/screenshots/exito_edicion_socio.png?raw=true" alt="BiblioAPP" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/biblioteca/blob/master/screenshots/listado_usuarios_solo_admin.png?raw=true" alt="BiblioAPP" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/biblioteca/blob/master/screenshots/modal_a%C3%B1adir_tema.png?raw=true" alt="BiblioAPP" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/biblioteca/blob/master/screenshots/toast_actualizacion_usuario_solo_admin.png?raw=true" alt="BiblioAPP" width="500">
</p>
<p align="center">
  <img src="https://github.com/pacojaez/biblioteca/blob/master/screenshots/nav_con_select_dinamico.png?raw=true" alt="BiblioAPP" width="500">
</p>

## Installation

Clone the repo or download ZIP and extract it.

You need to config your database .env file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yourDatabase
DB_USERNAME= yourUser
DB_PASSWORD= yourPassw
```

You need to configure the database with the tables and columns needed in this project:

run the SQL script biblioteca.sql in the project root to get dummy data.

That´s all.

## Contributing

Thank you for considering contributing to FastLight FRAMEWORK!

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