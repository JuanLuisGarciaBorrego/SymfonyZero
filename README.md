SymfonyZero
================

# What is?
 
SymfonyZero is a free fully functional kickstarter edition. You can use it as a base for your Symfony web projects with a typical architecture. SymfonyZero includes the most common bundles preconfigured and the usual sections of a website. SymfonyZero helps you to build web projects more quiclky, saving time in the early stages of the development. Also, you can enable or disable any feature easily, and also, SymfonyZero is fully configurable to adapt it to the needs of your project.

In this documentation you can learn about how to install, configure, what bundles and sections are availables and how you can help to imporove it. SymfonyZero is an alive project and we'll be adding new features and improvements, so stay tuned for new updates.

If you detect an error, you know how to improve it or you have an idea about this edition, please, fix it, do it or write us!

# Requirements

SymfonyZero uses Symfony 3.0.2 version (although you can change it easily), so you need to keep in your mind these requirements:

**Mandatory**
 ```
* PHP needs to be a minimum version of PHP 5.5.9
* JSON needs to be enabled
* ctype needs to be enabled
* Your php.ini needs to have the date.timezone setting
 ```
 
 **Optional**
  ```
*  You need to have the PHP-XML module installed
*  You need to have at least version 2.6.21 of libxml
*  PHP tokenizer needs to be enabled
*  mbstring functions need to be enabled
*  iconv needs to be enabled
POSIX needs to be enabled (only on *nix)
*  Intl needs to be installed with ICU 4+
*  APC 3.0.17+ (or another opcode cache needs to be installed)
*  php.ini recommended settings
        - short_open_tag = Off
        - magic_quotes_gpc = Off
        - register_globals = Off
        - session.auto_start = Off
 ```
 
 If you change the Symfony version, these requirements could change. In this case you must visit the [oficial site] to check them.

# Setup
 
  Install SymfonyZero as base of your projects is very easy. First, you have to clone this repository in your web root directory:
 
 ```sh
$ git clone https://github.com/Emergya/book-a-look-back.git
```

Then, you have to install vendors using Composer. If you don't have Composer installed, follow the instructions that you can find in [his web site](https://getcomposer.org/). Once you have Composer installed you'll can install vendors:

 ```sh
$ composer install
```

Make sure you set up right permission to run correctly the application. To do this, you can follow the instructions you can find in the [official book](http://symfony.com/doc/current/book/installation.html#book-installation-permissions).

To run the application you have to configure your web server correctly. You can see how to configure it in the [official guide](http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html). When you have your server running and configured, you can check the installation in your browser:
```
http://localhost:8000/config.php
```
Now you can build your own project using SymfonyZero by yourself. You have available differents bundles and sections. To enable or disable these options, and to know how to configure all the posibilities of SymfonyZero, read next chapters about the current features availables and how you can configure them.
 
# Features
 
 Work in progress
 
# Config
 
 Work in progress
 
# Improvements and contact
 
This is an open source project to contribute with the community and we are delighted to be helped by you, so if you have an idea to improve SymfonyZero or you find a bug, please create an issue and explain us clearly and with details your idea or the bug you have found.

In case you are able to patch any bug or add a new feature, don't hesitate and make a pull request. First, fork the repository and clone it locally. Then, create a branch for your edits. When you end your contribution, open a pull request and we'll discuss your changes.

If you have any doubt arount how to contribute using GitHub, you can read the official guide [to contribute to open source project].

Also, you can contact with developers in [symfony@emergya.com]. We'll be glad to talk with you :)
 

[//]: # 
   [oficial site]: <http://symfony.com/doc/current/reference/requirements.html>
   [to contribute to open source project]: <https://guides.github.com/activities/contributing-to-open-source/>
   [symfony@emergya.com]: <symfony@emergya.com>
