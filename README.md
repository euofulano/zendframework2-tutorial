ZendSkeletonApplication
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2.


Installation
------------
Clone project in web server document root

    git clone https://github.com/yuchih/zendframework2-tutorial.git

apache, nginx config
----------------------------

/etc/hosts add this line
    
    127.0.0.1   zf2.com

apache2

    <VirtualHost *:80>
        ServerAdmin yuchih@facebook.com
        DocumentRoot "/usr/local/zend/apache2/htdocs/zendframework2-tutorial/public"
        SetEnv APPLICATION_ENV "development"
        ServerName zf2.com
        #ServerAlias example.com
        <Directory "/usr/local/zend/apache2/htdocs/zendframework2-tutorial/public">
            DirectoryIndex index.php
            Options All
            AllowOverride FileInfo
            Order allow,deny
            Allow from all
        </Directory>
        ErrorLog "logs/zf2.com-error_log"
        CustomLog "logs/zf2.com-access_log" common
    </VirtualHost>

nginx & php-fpm
    
    server {

        root /usr/share/nginx/www/zendframework2-tutorial/public;
        index index.html index.htm index.php;

        server_name zf2.com;

        location / {
            try_files $uri $uri/ /index.php$is_args$args;
        }

        location ~ .*\.(php|phtml)?$ {
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param APPLICATION_ENV development;
            fastcgi_pass unix:/var/run/php5-fpm.sock;
            fastcgi_index index.php;
        }

        location ~ .*\.(git|jpg|jpeg|png|bmp|swf|ico)?$ {
            expires 30d;
        }

        location ~ .*\.(js|css)?$ {
            expires 1h;
        }

        location ~ /\.ht {
            deny all;
        }
    }

Create Database Table
---------------------

Run SQL 

    CREATE TABLE album (
      id int(11) NOT NULL auto_increment,
      artist varchar(100) NOT NULL,
      title varchar(100) NOT NULL,
      PRIMARY KEY (id)
    );

    INSERT INTO album (artist, title) VALUES ('The  Military  Wives',  'In  My  Dreams');
    INSERT INTO album (artist, title) VALUES ('Adele',  '21');
    INSERT INTO album (artist, title) VALUES ('Bruce  Springsteen',  'Wrecking Ball (Deluxe)');
    INSERT INTO album (artist, title) VALUES ('Lana  Del  Rey',  'Born  To  Die');
    INSERT INTO album (artist, title) VALUES ('Gotye',  'Making  Mirrors');

modify database config

    zendframework2-tutorial/config/autoload/global.php -> 'dsn' => 'mysql:dbname=test;host=db.facebook.com',
    zendframework2-tutorial/config/autoload/local.php -> username and password

PHPUnit test
-------------------

    # cd zendframework2-tutorial/tests
    # phpunit

PHPUnit 3.7.7 by Sebastian Bergmann.

Configuration read from /usr/local/zend/apache2/htdocs/ZendSkeletonApplication/tests/phpunit.xml

..............

Time: 1 second, Memory: 11.25Mb

OK (14 tests, 28 assertions)

Better Reference
--------------------

* http://juriansluiman.nl/en/article/120/using-zend-framework-service-managers-in-your-application - Using Zend Framework service managers in your application
* http://mwop.net/blog/266-Using-the-ZF2-EventManager.html - Using the ZF2 EventManager
* http://avnpc.com/pages/zf2-summary - Zend Framework 2.0资料汇总
* http://framework.zend.com/wiki/display/ZFDEV2/Zend+DI+QuickStart - Zend DI QuickStart
* http://avnpc.com/pages/zf2-new-changes-of-servicemanager - ZF2重大变更：在MVC中去除Bootstrap，引入ServiceManager
* http://avnpc.com/pages/zf2-mvc-process - Zend Framework 2.0的Mvc结构及启动流程分析
* http://dongbeta.com/2012/02/workflow-of-zend-skeleton-application-entry-file/ - ZendSkeletonApplication入口文件运行流程分析
* http://dongbeta.com/2012/02/eventmanager-in-zend-framework-2/ - Zend Framework 2 中的EventManager的使用方法

Other
------------------
https://www.facebook.com/groups/295728233858567/

Happy PHPing
