# Poll Bundle for Symfony2/Doctrine2

This bundle is discontinued, you might want to use the 
[enquiryBundle](https://github.com/Bodaclick/EnquiryBundle)

This bundle provides a poll feature for your web site.

You need to have installed the bundles DoctrineMigrationsBundle and DoctrineFixturesBundle 
if you do not, below you will find detailed installation instructions.

## Installation:

### Get the bundle

Add to your `/deps` file :

```
[PollBundle]
    git=http://github.com/desarrolla2/PollBundle.git
    target=/bundles/Desarrolla2/PollBundle
````
        
And make a 

`php bin/vendors install`


### Register the namespace

``` php
<?php

  // app/autoload.php
  $loader->registerNamespaces(array(
      'Desarrolla2' => __DIR__.'/../vendor/bundles',
      // your other namespaces
      ));
```

### Register the bundle

``` php
<?php

  // app/AppKernel.php
  public function registerBundles()
  {
    return array(
      // ...
      new Desarrolla2\PollBundle\PollBundle(),
      // ...
      );
  }
```

### Configure database

if you havent configured your conection then update options in app/config/parameters.ini and execute

`php app/console doctrine:database:create`

`php app/console doctrine:schema:create`



## Installation note for Database migrations

If you like to update your database automatically you need install 
DoctrineMigrationsBundle, if you have not yet. 

### Get the bundle

Add to your `/deps` file :

```
[doctrine-migrations]
    git=http://github.com/doctrine/migrations.git

[DoctrineMigrationsBundle]
    git=http://github.com/doctrine/DoctrineMigrationsBundle.git
    target=/bundles/Doctrine/Bundle/MigrationsBundle
```

Update vendors

`php bin/vendors install`

### Register namespace

``` php
// app/autoload.php
$loader->registerNamespaces(array(
    //...
    'Doctrine\\DBAL\\Migrations' => __DIR__.'/../vendor/doctrine-migrations/lib',
    'Doctrine\\DBAL'             => __DIR__.'/../vendor/doctrine-dbal/lib',
));
```

### Register bundle

``` php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        //...
        new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
    );
}
```

### Update database

execute

`php app/console doctrine:schema:update --force`

Be careful that this will run SQL statements and you could lose data on your database

You can follow detail install instruction in 
[this link](http://symfony.com/doc/master/bundles/DoctrineMigrationsBundle/index.html)

## Installation note for Database fixtures:

If you like to load example fixtures in database you need install 
DoctrineFixturesBundle, if you have not yet. 

### Get the bundle

Add to your `/deps` file :

```
[doctrine-fixtures]
    git=http://github.com/doctrine/data-fixtures.git

[DoctrineFixturesBundle]
    git=http://github.com/symfony/DoctrineFixturesBundle.git
    target=/bundles/Symfony/Bundle/DoctrineFixturesBundle
```

Update vendors

`php bin/vendors install`

### Register namespace

``` php
// app/autoload.php
$loader->registerNamespaces(array(
    // ...
    'Doctrine\\Common\\DataFixtures' => __DIR__.'/../vendor/doctrine-fixtures/lib',
    'Doctrine\\Common' => __DIR__.'/../vendor/doctrine-common/lib',
    // ...
));
```

### Register bundle

``` php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        //...
        new Symfony\Bundle\DoctrineFixturesBundle\DoctrineFixturesBundle(),
    );
}
```

### Install Fixtures

Execute

`php app/console doctrine:fixtures:load`

Be careful that this will run SQL statements and you could lose data on your database

You can follow detail install instruction in 
[this link](http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html)







