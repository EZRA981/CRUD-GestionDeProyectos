
# Gestión de Usuarios - Laravel

Proyecto CRUD desarrollado en Laravel.

##  Requisitos

- PHP 8.1 o superior
- Composer
- MySQL
- XAMPP o servidor local

## Instalacion

1. Clonar repositorio:

bash
git clone https://github.com/EZRA981/CRUD-GestionDeProyectos

2. Entrar al proyecto

cd GestionDeProyectos

3. Instalar dependencias

composer install

4. Copiar el archivo .env

cp .env.example .env

5. Configurar la base de datos

Hay que modificar el archivo hhtpd-vhost

C:\xampp\apache\conf\extra

Y agregar estas dependencias para que nuetra base de datos del Xampp inicie con nuestro proyecto de Gestion De Proyectos

##<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs"
    ServerName localhost
##</VirtualHost>

##<VirtualHost *:80>
    DocumentRoot "C:\xampp\htdocs\laravel\GestionDeProyectos\public"
    ServerName GestionDeProyectos.test
##</VirtualHost>

y el archivo host de nuestro equipo de computo, su direccion es:

C:\Windows\System32\drivers\etc

Donde tenemos que agregar las siguiente dirrecion IP y dirrecion que usara nuestro equipo
para direccionar al proyecto.:
# localhost name resolution is handled within DNS itself.
#	127.0.0.1       localhost
#	::1             localhost
127.0.0.1 GestionDeProyectos.test

5. Generacion de claves

php artisan key:generate

6. Migracion con los seeder:

php artisan migrate --seed

7. Iniciar el servidor

php artisan serve

Funcionalidades del sistema:
---------------------------------------
Proyectos
---------------------------------------
-Crear proyectos

-Editar proyectos

-Eliminar proyectoss

-Ver estado del proyecto

-Filtro por: estado del proyecto
---------------------------------------
Tareas
---------------------------------------
-Crear tareas

-Editar tareas

-Eliminar tareas

-Ver estado de las tareas

-Filtro por: Estado y prioridad 

















<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
