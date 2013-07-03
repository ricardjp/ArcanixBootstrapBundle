ArcanixBootstrapBundle
======================

Minimal configuration Symfony 2 bundle for Twitter Bootstrap

This bundle is compatible with Symfony 2.3.*.

This bundle is based on the MopaBootstrapBundle.

The goal of this bundle was to allow very easy usage of all Bootstrap features in a Symfony bundle without any configuration headache.


Includes
* Twitter Bootstrap version 2.3.2
* jQuery via SonatajQueryBundle (https://github.com/sonata-project/SonatajQueryBundle)
* Less assets are already configured on bundle
* Less compiler provided via the lessphp library to prevent the need to install Node.js.
* Bootstrap icons are available out the box without any need for voodoo magic
* Form extensions from the MopaBootstrapBundle

Installation

First add the dependency in your composer.json:
```json
"require": {
    "arcanix/bootstrap-bundle": "dev-master"
},
"repositories": [
    {
        "type": "vcs",
        "url": "git://github.com/ricardjp/ArcanixBootstrapBundle.git"
    }
]
```

You must also register the bundle in app/AppKernel.php:
```php
public function registerBundles() {
    $bundles = array(
        new Arcanix\BootstrapBundle\ArcanixBootstrapBundle(),
    );
}
```

You are good to go, simple as that.
