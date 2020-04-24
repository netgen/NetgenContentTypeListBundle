Netgen Content Type List Bundle installation instructions
=========================================================

Requirements
------------

* eZ Platform 3+

Installation steps
------------------

### Use Composer

Run the following command from your project root to install the bundle:

```bash
$ composer require netgen/content-type-list-bundle
```

### Activate the bundle

Activate the bundle in `config/bundles.php` file.

```php
<?php

return [
    ...,

    Netgen\Bundle\ContentTypeListBundle\NetgenContentTypeListBundle::class => ['all' => true],

    ...
];
```

### Clear the caches

Clear eZ Platform caches.

```bash
php bin/console cache:clear
```

### Use the bundle

You can now load and create content with `ngclasslist` field type.
