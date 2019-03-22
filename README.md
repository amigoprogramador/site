<!-- <p align="center">
    <img src="https://github.com/octobercms/october/blob/master/themes/demo/assets/images/october.png?raw=true" alt="Amigo Programador" width="25%" height="25%" />
</p> -->

[Amigo Programador](https://amigoprogramador.com.br)

### Learning Amigo Programador

The best place to learn Amigo Programador is by reading the framework documentation](https://octobercms.com/docs) or [following some tutorials](https://octobercms.com/support/articles/tutorials).

You may also watch these introductory videos for [beginners](https://vimeo.com/79963873) and [advanced users](https://vimeo.com/172202661).

### Installing Amigo Programador

Instructions on how to install Amigo Programador can be found at the [installation guide](https://octobercms.com/docs/setup/installation).

Run this commands:

```shell
php artisan october:install
```

### Directory Permissions
```shell
sudo chmod -R 775 .
```

If you can't edit files after running the command above (needs to logout and login again):
```shell
sudo chown $USER:www-data -R .
sudo usermod -aG www-data $USER
```

### Development Team

Amigo Programador was created by [Allan Brito](https://linkedin.com/in/allan-brito) and [Pablo Henrique](https://www.linkedin.com/in/pablo-henrique-999960101/).

### Foundation library

The Amigo Programador uses [October CMS](https://octobercms.com) that runs [Laravel](https://laravel.com) as a foundation PHP framework.

### Contact

You can communicate with us using the following mediums:

* [Join us on Slack](https://amigoprogramador.slack.com) to chat with us.

### License

The Amigo Programador platform is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

### Contributing

Before sending a Pull Request, be sure to review the [Contributing Guidelines](.github/CONTRIBUTING.md) first.

### Coding standards

Please follow the following guides and code standards:

* [PSR 4 Coding Standards](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md)
* [PSR 2 Coding Style Guide](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
* [PSR 1 Coding Standards](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
