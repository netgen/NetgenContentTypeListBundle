Netgen Content Type List Bundle installation instructions
=========================================================

Requirements
------------

* Recent version of eZ Platform

Installation steps
------------------

### Use Composer

Add the following to your `composer.json` and run `php composer.phar update` to refresh dependencies:

```json
"require": {
    "netgen/content-type-list-bundle": "~1.0",
    "netgen/ngclasslist": "*"
}
```

### Activate the bundle

Activate the bundle in `app/AppKernel.php` file.

```php
public function registerBundles()
{
   $bundles = array(
       new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
       ...
       new Netgen\Bundle\ContentTypeListBundle\NetgenContentTypeListBundle()
   );

   ...
}
```

### Clear the caches

Clear eZ Platform caches.

```bash
php bin/console cache:clear
```

### Use the bundle

You can now load and create content with `ngclasslist` field type.
