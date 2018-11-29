# CodeIgniter Web Installer | A Web Installer

- [About](#about)
- [Requirements](#requirements)
- [Installation](#installation)
- [Routes](#routes)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## About

Do you want your clients to be able to install a CodeIgniter project just like they do with WordPress or any other CMS?
This CodeIgniter package allows users who don't use Composer, SSH etc to install your application just by following the setup wizard.
The current features are :

- Check For Server Requirements.
- Check For Folders and Files Permissions.
- Ability to set database information.
- Seed The Tables.

## Requirements

* [CodeIgniter 3.0+](https://codeigniter.com)

## Installation

1. Download zip file.
2. Backups file `autload.php`, `config.php`, `database.php`, `routes.php`
3. and then, rename file
	- `autload.php.install` => `autload.php`
	- `config.php.install` => `config.php`
	- `database.php.install` => `database.php`
	- `routes.php.install` => `routes.php`
4. configure before install `config/installer.php`

## Routes

* `/install`

## Usage

* **Install Routes Notes**
	* In order to install your application, go to the `/install` route and follow the instructions.
	* Once the installation has ran the empty file `installed` will be placed into the `/application` directory. If this file is present the route `/install` will abort to the default page.

## Contributing

* If you have any suggestions please let me know : https://github.com/zhiephie/ci-instller/pulls.
* Please help us provide more languages for this awesome package please send a pull request https://github.com/zhiephie/ci-instller/pulls.

## License

CodeIgniter Web Installer is licensed under the MIT license. Enjoy!
