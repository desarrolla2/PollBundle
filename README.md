PollBundle
==========

# Poll bundle for Symfony2/Doctrine2

This bundle provides a poll feature for your web site

## Installation and configuration:

### Get the bundle

Add to your `/deps` file :

```
[PollBundle]
    git=http://github.com/desarrolla2/PollBundle.git
    target=/bundles/Desarrolla2/PollBundle
````
        
And make a `php bin/vendors install`.

### Register the namespace

``` php
<?php

  // app/autoload.php
  $loader->registerNamespaces(array(
      'Desarrolla2' => __DIR__.'/../vendor/bundles',
      // your other namespaces
      ));
```

### Add PollBundle to your application kernel

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

- Installation note for Database fixtures:
  Also add  
  ```new Symfony\Bundle\DoctrineFixturesBundle\DoctrineFixturesBundle(),```

### Usage