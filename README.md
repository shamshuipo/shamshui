## About ShamShui・心水

Built for hobbyists to share tips

## Installation
```bash
git clone git@github.com:shamshuipo/shamshui.git shamshui

cd shamshui
cp .env.example .env
# create database
# setup .env:
# DB_DATABASE=shamshui
# DB_USERNAME=
# DB_PASSWORD=
# APP_URL=

composer install
npm install && npm run dev

php artisan key:generate
php artisan migrate
php artisan serve
```
## Running with localhost
```bash
open http://127.0.0.1:8000/
```

## Running with Valet
```bash
valet link shamshui
valet link web.shamshui
valet secure
open https://web.shamshui.`valet tld`
```

## Import racing days
```
php artisan import:days resources/data/2020-ch-racing-days.tsv
```
## Import results of a racing day
```
php artisan import:results
```
## Copyright

&copy; 2020 [Horace Ho](https://github.com/horaceho)

## License

Under the [MIT license](https://opensource.org/licenses/MIT)
