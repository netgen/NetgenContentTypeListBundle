Netgen Content Type List Bundle installation instructions
=========================================================

Requirements
------------

* Recent version of eZ Publish 5 or eZ Platform

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

Clear eZ Publish caches.

```bash
php app/console cache:clear
```

### Use the bundle

You can now load and create content with `ngclasslist` field type.
