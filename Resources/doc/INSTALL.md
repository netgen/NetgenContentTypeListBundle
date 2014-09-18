Netgen ContentType List Bundle installation instructions
========================================================

Requirements
------------

* Recent version of eZ Publish 5

Installation steps
------------------

### Use Composer

Add the following to your composer.json and run `php composer.phar update netgen/content-type-list-bundle` to refresh dependencies:

```json
"require": {
    "netgen/content-type-list-bundle": "~1.0",
    "netgen/ngclasslist": "*"
}
```

### Activate the bundle

Activate the bundle in `ezpublish\EzPublishKernel.php` file.

```php
use Netgen\Bundle\ContentTypeListBundle\NetgenContentTypeListBundle;

...

public function registerBundles()
{
   $bundles = array(
       new FrameworkBundle(),
       ...
       new NetgenContentTypeListBundle()
   );

   ...
}
```

### Edit configuration

Put the following config in your `ezpublish/config/config.yml` file to be able to load `ngclasslist` content field template.

```yml
parameters:
   ezsettings.YOUR_SITEACCESS_NAME.field_templates:
       - {template: EzPublishCoreBundle::content_fields.html.twig, priority: 0}
       - {template: NetgenContentTypeListBundle::ngclasslist_content_field.html.twig, priority: 0}
```

Be sure to replace `YOUR_SITEACCESS_NAME` text with the name of your frontend siteaccess.

### Clear the caches

Clear eZ Publish 5 caches.

```bash
php ezpublish/console cache:clear
```

### Use the bundle

You can now load and create content with `ngclasslist` field type.
