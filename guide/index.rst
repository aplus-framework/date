Date
====

.. image:: image.png
    :alt: Aplus Framework Date Library

Aplus Framework Date Library.

- `Installation`_
- `Date`_
- `Conclusion`_

Installation
------------

The installation of this library can be done with Composer:

.. code-block::

    composer require aplus/date

Date
----

The Date class adds some functionality to the native **DateTime** class.

It implements the **JsonSerializable** and **Stringable** interfaces,
optimizing work with APIs by transforming the Date object into a string in ATOM
format.

Example using the ``__toString`` method:

.. code-block:: php

    use Framework\Date\Date;

    $date = new Date();
    echo $date; // 2019-11-08T15:40:57-03:00

Humanize
########

With objects of the Date class it is possible to render time spaces that are
easier for humans to understand. For this, use the ``humanize`` method:

.. code-block:: php

    echo $date->humanize(); // 3 days ago

It can also be in another language:

.. code-block:: php

    $language = new Language('pt-br');
    $date->setLanguage($language);
    echo $date->humanize(); // 3 dias atrás

Conclusion
----------

Aplus Date Library is an easy-to-use tool for, beginners and experienced, PHP developers. 
It is perfect for working with APIs that need date manipulation. 
The more you use it, the more you will learn.

.. note::
    Did you find something wrong? 
    Be sure to let us know about it with an
    `issue <https://gitlab.com/aplus-framework/libraries/date/issues>`_. 
    Thank you!
