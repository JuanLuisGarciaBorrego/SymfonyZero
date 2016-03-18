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
 
 SymfonyZero helps you to develop build your web applications quickly. SymfonyZero is made up of several bundles (Symfony Standard Edition bundles and Third party bundles) and usual features and sections which appears in a wide range of websites. In this section you can read what is included in each of these parts.
 
**Third Party Bundles**

SymfonyZero has available a pre-configured third party bundles to give a solution for the most common needs of the web projects. In this list you can discover what bundles are installed and the link to access to their official repositories.

*  [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle) - FOSUserBundle provides a flexible framework for user management that aims to handle common tasks such as user registration and password retrieval.
*  [EasyAdminBundle](https://github.com/javiereguiluz/EasyAdminBundle) - EasyAdminBundle lets you create administration backends for Symfony applications with unprecedented simplicity.
*  [KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle) - KnpPaginatorBundle is a friendly Symfony paginator to paginate everything.
*  [WhiteOctoberBreadcrumbsBundle](https://github.com/whiteoctober/BreadcrumbsBundle) - WhiteOctoberBreadcrumbsBundle provides a easy way to create bread crumbs.
*  [StfalconTinymceBundle](https://github.com/stfalcon/TinymceBundle) - StfalconTinymceBundle makes it very easy to add the TinyMCE WYSIWYG editor to your Symfony project.
*  [RaulFraileLadybugBundle](https://github.com/raulfraile/LadybugBundle) - RaulFraileLadybugBundle provides an easy and extensible var_dump/print_r replacement for Symfony projects, both in controllers or Twig templates.
*  [XsolveCookieAcknowledgementBundle](https://github.com/xsolve-pl/xsolve-cookie-acknowledgement-bundle) - XsolveCookieAcknowledgementBundle provides information about an cookies usage, which is forced by European Union by so-called EU cookie law.
  

**Common Sections and Funcionallity**
 
 * Landing page with slider
 * Private section to manage entities
 * Contacto form with email service pre-configured
 * Login, register and password change
 * Newsletter form integrated with Mialchimp service
 * About me section
 * Terms & Conditions section
 * Demo page with paged registered users list
 * Header section with company's logo and dynamic menu
 * Footer section with common links

  
**Symfony Standard Edition**
 
Extracted of the [official repository of Symfony](https://github.com/symfony/symfony-standard), here we have the pre-configured bundles we have available because they are in the Symfony Standard Edition:

*  FrameworkBundle - The core Symfony framework bundle
*  SensioFrameworkExtraBundle - Adds several enhancements, including template and routing annotation capability
*  DoctrineBundle - Adds support for the Doctrine ORM
*  TwigBundle - Adds support for the Twig templating engine
*  SecurityBundle - Adds security by integrating Symfony's security component
*  SwiftmailerBundle - Adds support for Swiftmailer, a library for sending emails
*  MonologBundle - Adds support for Monolog, a logging library
*  WebProfilerBundle (in dev/test env) - Adds profiling functionality and the web debug toolbar
*  SensioDistributionBundle (in dev/test env) - Adds functionality for configuring and working with Symfony distributions
*  SensioGeneratorBundle (in dev/test env) - Adds code generation capabilities
*  DebugBundle (in dev/test env) - Adds Debug and VarDumper component integration
 
# Config
 
 Work in progress
 
# Improvements and contact
 
This is an open source project to contribute with the community and we are delighted to be helped by you, so if you have an idea to improve SymfonyZero or you find a bug, please create an issue and explain us clearly and with details your idea or the bug you have found.

In case you are able to patch any bug or add a new feature, don't hesitate and make a pull request. First, fork the repository and clone it locally. Then, create a branch for your edits. When you end your contribution, open a pull request and we'll discuss your changes.

If you have any doubt arount how to contribute using GitHub, you can read the official guide [to contribute to open source project](https://guides.github.com/activities/contributing-to-open-source/).

Also, you can contact with developers in [symfony@emergya.com](symfony@emergya.com). We'll be glad to talk with you :)
