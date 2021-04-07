Системные требования
==

* Console (UBUNTU BASH)
* Composer
* PHP 7.x (8.0.1)
* MySQL 5.x (8.0.23) | MariaDB 10.x (10.2)
* Apache 2.x (Apache/2.4.41) | LiteSpeed | Nginx

Установка
==
*С помощью GIT*
```
git clone https://github.com/lithesome/original.git ./
```

*С помощью WGET*
```
wget https://github.com/lithesome/original/archive/refs/heads/master.tar.gz
tar -xvf master.tar.gz --strip-components 1
rm master.tar.gz
```

1.  выполнить в консоле

        php engine/install

2.  в интерактивном диалоге ввести всю нужную информацию:
    - название сайта
    - основная тема сайта
    - протокол сайта
    - хост сайта
    - база данных сайта: 
        - хост базы данных
        - порт базы данных
        - пользователь базы данных
        - пароль пользователя базы данных
    
Создать контроллер
-
    php cli make:controller [controller short name]

Посмотреть справку по консольным командам
-
    php cli help
Посмотреть справку с деталями
-
    php cli help -p
    
Посмотреть справку по конкретной команде
-
    php cli help:cmd [controller short name]


Для обновления системы
-
выполнить 
	
	php engine/update

Более подробная информация
-

на сайте [https://lithesome.tech](https://lithesome.tech)
