ArcanixBootstrapBundle
======================

Minimal configuration Symfony 2 bundle for Twitter Bootstrap 3

This bundle is compatible with Symfony 2.4.*.

The goal of this bundle was to allow very easy usage of all Bootstrap features in a Symfony bundle without any configuration headache.


# Includes
* Twitter Bootstrap version 3.0.0
* jQuery and Twitter Bootstrap components
* Bootstrap icons are available out the box without any need for voodoo magic
* Custom form extensions

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
```

## Twig functions
### Icon
To display an icon, please use the "icon" function. Available icons are listed [on the official Twitter Bootstrap website](http://getbootstrap.com/components/#glyphicons)
```
{{ icon("search") }}
```

## Form extensions
### Legend
If you wish to attach a form legend to a form, simply set the "legend" option:
```
public function setDefaultOptions(OptionsResolverInterface $resolver) {
    	$resolver->setDefaults(array(
        'legend' => 'my.form.legend',
    ));
}
```
Value for "legend" will be automatically translated if i18n is activated for your application.

If "legend" is not set in the form options, no &lt;legend&gt; tag will be rendered.