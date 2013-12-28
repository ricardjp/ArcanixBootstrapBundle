ArcanixBootstrapBundle
======================

Minimal configuration Symfony 2 bundle for Twitter Bootstrap

This bundle is compatible with Symfony 2.4.*.

This bundle is based on the MopaBootstrapBundle.

The goal of this bundle was to allow very easy usage of all Bootstrap features in a Symfony bundle without any configuration headache.


# Includes
* Twitter Bootstrap version 3.0.0
* jQuery via SonatajQueryBundle (https://github.com/sonata-project/SonatajQueryBundle)
* Less assets are already configured on bundle
* Less compiler provided via the lessphp library to prevent the need to install Node.js.
* Bootstrap icons are available out the box without any need for voodoo magic
* Form extensions from the MopaBootstrapBundle

# Installation

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

Since this bundle is an assets provider, you will need to tell assetic to include this bundle in your configuration:
```
# app/config/config.yml
assetic:
    debug:          "%kernel.debug%"
    use_controller: false
    bundles:        [ ArcanixBootstrapBundle ]
```

You are good to go, simple as that.

# Usage

If you want to easily use all utilities provided by this bundle, simply use the extends directive in your own templates and put your html in the block "content":

```
{% extends 'ArcanixBootstrapBundle::layout.html.twig' %}

{% block content %}
	<p>My custom content</p>
{% endblock %}
