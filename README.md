Linio Rule Engine
=================
[![Latest Stable Version](https://poser.pugx.org/linio/rule-engine/v/stable.svg)](https://packagist.org/packages/linio/rule-engine) [![License](https://poser.pugx.org/linio/rule-engine/license.svg)](https://packagist.org/packages/linio/rule-engine) [![Build Status](https://secure.travis-ci.org/LinioIT/rule-engine.png)](http://travis-ci.org/LinioIT/rule-engine) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LinioIT/rule-engine/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LinioIT/rule-engine/?branch=master)

This is a small and versatile rule engine that allows you run conditional logic and
predetermined statements on a given context. It has a Parser that targets a very
simplistic AST. By default, we have included a [Blockly](https://developers.google.com/blockly/) XML
parser, but you can add pretty much anything else.

Install
-------

The recommended way to install Linio Rule Engine is [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "linio/rule-engine": "0.2.*"
    }
}
```

Tests
-----

To run the test suite, you need install the dependencies via composer, then
run PHPUnit.

    $ composer install
    $ phpunit

Usage
-----

The RuleEngine interpreter uses a parser to create the AST tree based on a provided
string, which is the actual rule source. You can create your own parser or use an
existing one, like the `BlocklyXmlParser`. A context must be an instance of a `Dictionary`.

```php
<?php

use Linio\Type\Dictionary;
use Linio\Component\RuleEngine\Interpreter;

$context = new Dictionary(['item' => 11]);
$interpreter = new Interpreter();
$interpreter->setParser(...);
$interpreter->evaluate('rule source', $context);

```

