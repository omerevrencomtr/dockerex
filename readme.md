## Installation

### Server Requirements

However, if you are not using Homestead, you will need to make sure your server meets the following requirements:

- PHP >= 7.1.3
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

#### Local Development Server

If you have PHP installed locally and you would like to use PHP's built-in development server to serve your application, you may use the `serve` Artisan command. This command will start a development server at `http://localhost:8000`:

    php artisan serve

More robust local development options are available via [Homestead](/docs/{{version}}/homestead) and [Valet](/docs/{{version}}/valet).

### Configuration



#### Public Directory

After installing Laravel, you should configure your web server's document / web root to be the `public` directory. The `index.php` in this directory serves as the front controller for all HTTP requests entering your application.

#### Configuration Files

All of the configuration files for the Laravel framework are stored in the `config` directory. Each option is documented, so feel free to look through the files and get familiar with the options available to you.

#### Directory Permissions

After installing Laravel, you may need to configure some permissions. Directories within the `storage` and the `bootstrap/cache` directories should be writable by your web server or Laravel will not run. If you are using the [Homestead](/docs/{{version}}/homestead) virtual machine, these permissions should already be set.

#### Application Key

The next thing you should do after installing Laravel is set your application key to a random string. If you installed Laravel via Composer or the Laravel installer, this key has already been set for you by the `php artisan key:generate` command.

Typically, this string should be 32 characters long. The key can be set in the `.env` environment file. If you have not renamed the `.env.example` file to `.env`, you should do that now. **If the application key is not set, your user sessions and other encrypted data will not be secure!**

#### Additional Configuration

Laravel needs almost no other configuration out of the box. You are free to get started developing! However, you may wish to review the `config/app.php` file and its documentation. It contains several options such as `timezone` and `locale` that you may wish to change according to your application.

You may also want to configure a few additional components of Laravel, such as:


## Web Server Configuration


### Pretty URLs

#### Apache

includes a `public/.htaccess` file that is used to provide URLs without the `index.php` front controller in the path. Before serving Laravel with Apache, be sure to enable the `mod_rewrite` module so the `.htaccess` file will be honored by the server.

If the `.htaccess` file that ships with Laravel does not work with your Apache installation, try this alternative:

    Options +FollowSymLinks -Indexes
    RewriteEngine On

    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]

#### Nginx

If you are using Nginx, the following directive in your site configuration will direct all requests to the `index.php` front controller:

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

When using [Homestead](/docs/{{version}}/homestead) or [Valet](/docs/{{version}}/valet), pretty URLs will be automatically configured.

## About DockerEx
DockerEx project when configuring the primary objective of Turkey's fastest processing performance and customer support services have accounted for clearing platforms. The entire design was configured accordingly to the software and hardware.

------
Supports the combined parity of Turkish Lira, Bitcoin, Litecoin, Ethereum, Neo, EOS, GAS platforms and tokens.

------

The main purpose of developing this project is to build Turkey's fastest performance and swap transactions with a customer support system platform. All design, software and equipment elements are prepared accordingly. The integrated online support system is designed as fast and solution-oriented modules. Designed with a simple and simple interface, the system is designed to meet the most demanding requirements with its framework and advanced cache structure.
It will also be positioned behind advanced firewall software, hardware firewalls and some blocking services against possible malicious attacks.

------
The system processes block chain records and balances with data from the RPC server.
Our stock software is designed with a built-in control system. This system supports block chain API integrations as well as bank APIs.
The current crypto asset input or output can be displayed in the user accounts immediately after the block has been served to the chain, and the transaction approval numbers can be updated at the same time as the time chain of the respective chain.
Towing and tilting operations can be monitored and intervened by active operator teams 24/7.

## Basic Essence
- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).
- Multiple currencies
- Built-in high performance order matching engine.
- Built-in ticket system for customer support.
- Built-in announcement and blog systems for customer questions.
- High volume traffic support with WebSocket.
- Diverse regional support. (Language, history).
- Adapt to multiple crypto currencies. (Ex: Bitcoin, Litecoin, Ethereum, Dash, etc.).
- Adapt to multiple token units. (Ex: ERC20, QTUM, NEP5, etc.).
- Support for multiple local currencies. (Ex: TL, USD, EUR, etc.).
- Mail token, SMS and Google two-factor authentication support. (Options can be customized by customer)
- Verification steps in multiple digits (KYC) can be customized.
- Advanced admin control panel and management tools.
- Security in banking standards.
- Instant graphic system: Line, candle and bar shapes, minimum 1 minute precision can be monitored instantly integrated graphics system.
- Api support: Restful Api extension to support all transactions such as entry, order creation, withdrawal and deposit.
- Mobile application: IOS & Android supported mobile application that will be designed completely native.
- Multi-language support: Unlimited number of add-ons, design structure can be customized multi-language support.

------

Platform has a working principle that can be explained with 4 layers. The system consists of 3 main modules. These modules allow processing, transferring and saving of data between MySQL, Redis and Websocket.

1 - Application Layer;
Frotend: Provides visual interaction to the user by exchanging data. (Ex .: Graphical and web interface)
Third Party: Communicates with various programming interfaces and transfers relevant data. (Json transmits the inputs / outputs to the user in accordance with certain rules and authorizations. (Eg 3rd party account integrations. Electronic billing service)
Router: Forward future requests to sections such as controller, view, or model and forward the code snippets that will work for the request. Allows queries to reach related modules. (Ex: Interpretation of purchase orders entered as market buyers in matching module.)

2 - Access Layer;
Web: Creates services that can be consumed by numerous users (Browser, mobile phones, tablets, PC, etc.) and communicate over HTTP protocol. This is a framework element used for the creation steps.
API (Application Programming Interface): This is the interface provided by the application that shares its capabilities so that the capabilities of one application can be used in another application. (Arbitrage software, trading robots, etc.)
WebSocket: HTTP stateless request / response protocol. It is a one-way protocol. The request direction is always from server to user. It enables real-time service of instant price updates without the need for page refresh. (Ex .: Change of current price after last order.)

3 - Service Layer;
Match module: This module is used to process market buyer orders entered by users. Price module: This module is used for matching the market maker orders entered by the users.
Data module: It is the module where data stored after user inputs and system outputs are presented to the user again.

4 - Storage Layer;
MySQL: Database that stores all data on the system.
Redis: A data structure server where public and open system outputs are distributed to users. (Price, volume, chart etc.)

## Application Layer;

Provides visual interaction to the user by exchanging data. (Ex .: Graphical and web interface)
Third Party: Communicates with various programming interfaces and transfers relevant data. (Json transmits the inputs / outputs to the user in accordance with certain rules and authorizations. (Eg: 3rd party accounting integrations. Electronic billing service)

## Relationship between platform and block chains
In no case will a crypto communicate with the wallet software unless the transaction records and confirmation information are served to the user. In addition, all balancing, drawing and depositing operations are performed automatically. Due to the security principles related to these transactions, no integration has been implemented and can be customized upon request.

## User interface and features
Crypto money balance control is carried out with online hot wallets. The platform software contains wallet addresses that make it easy to store and transfer different crypto currencies. The addresses are found in the pools that were previously created by means of crypto currency kernel software. In addition, cold wallets secure all crypto currencies, allowing balances to be locked and blocking external access. In accordance with the security policy, cold wallet management is carried out only by the authorized personnel of the company in multi-signed wallets within the upper limits.

## Note
The software engine instantly matches orders between buyers and sellers for the best available price.
Our integrated wallet software automatically manages all crypto currency transactions with software approval if requested by the operator.
Adding any new currency is facilitated by administrative tools.

## Security Vulnerabilities
If you discover a security vulnerability within DockerEx, please send an e-mail to Ömer EVREN via [info@omerevren.com.tr](mailto:info@omerevren.com.tr). All security vulnerabilities will be promptly addressed.

## License
Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
