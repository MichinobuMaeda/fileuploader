File Uploader for my dev. server
=========

```shell script
$ git clone git@github.com:MichinobuMaeda/fileuploader.git
$ composer install
$ npm install && npm run production
$ cp .env.local .env
$ php artisan key:generate
$ touch storage/database.sqlite
$ php artisan migrate:refresh --seed
$ php artisan serve
```

```shell script
$ php --version 
PHP 7.4.5 (cli) (built: Apr 23 2020 02:25:56) ( NTS )
$ composer --version
  Composer version 1.10.6 2020-05-06 10:28:10
$ composer create-project --prefer-dist laravel/laravel  fileuploader
$ cd fileuploader
$ composer require laravel/ui
$ php artisan ui vue --auth
$ npm install && npm run production
$ git init
$ git add .
$ git commit -m "first commit"
$ git remote add origin git@github.com:MichinobuMaeda/fileuploader.git
$ git push -u origin master
$ touch 
```
