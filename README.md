# DO-EPIC-SHIT Demo

Refreshed OpenRheinRuhr demo app running on a modern 2026-ready toolchain while keeping the original Slim + Twig + RedBean structure intact.

## Stack

- PHP 8.3+
- Composer 2
- Slim 2
- Twig
- RedBeanPHP
- Node.js 20+ / npm 11+
- Sass + PostCSS + Terser asset pipeline

## Quick start

```bash
git clone https://github.com/voku/DO-EPIC-SHIT-Demo.git
cd DO-EPIC-SHIT-Demo
composer install
cd web
npm install
npm run build
cd ..
composer test
```

## Local requirements

- Apache (or another web server) pointed at `/web`
- `mod_rewrite` enabled when using Apache
- SQLite support enabled for PHP (`pdo_sqlite`)

Example on Ubuntu/Debian:

```bash
sudo a2enmod rewrite
sudo apt-get install php8.3-sqlite3
sudo service apache2 restart
```

The demo stores its sample SQLite database in `app/storage/db/test.s3db`.

## Project layout

- `app/` application code, config, controllers, models, and Twig templates
- `build/` PHPUnit configuration
- `tests/` automated PHP tests
- `web/` public entrypoint and compiled frontend assets

## Frontend workflow

All frontend dependencies now come from npm. Bower, Compass, and the legacy Grunt pipeline are gone.

```bash
cd web
npm run build
```

This rebuilds:

- `web/css/app.css`
- `web/css-min/app.css`
- `web/css/font-awesome.min.css`
- `web/js-min/jquery.min.js`
- `web/js-min/plugins.js`
- `web/js-min/app.js`

## Writable paths

- `app/storage/db/`
- `app/storage/cache/twig/`
- `app/storage/logs/`

## Credits

Inspired by [Tieno/SlimPackage](https://github.com/Tieno/SlimPackage/) and [briankiewel/pagodabox-laravel-4](https://github.com/briankiewel/pagodabox-laravel-4).

## License

Software licensed under the [MIT license](https://opensource.org/licenses/MIT).