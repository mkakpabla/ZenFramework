[![Build Status](https://travis-ci.org/mkakpabla/zenframework.svg?branch=master)](https://travis-ci.org/mkakpabla/zenframework)
# ZenFramework
ZenFramework est un framework simple pour le developpement de vos projects profetionelles et personels

## Get Starting
Pour debuter il faut tout d'abord creer un controlleur en tapant la commande:
 * Etape 1: Creer un controlleur
```console
php console make:controller PostsController
```
* Etape 2: Définir les routes du controlleur. Les routes sont des annoations comme decrite dans le code qui suit.
```php
<?php
namespace App\Controllers;

use Components\Controller;

/**
 * @BaseRoute /posts
 */
class PostsController extends Controller
{


    /**
     * @Route [GET] / (posts.index)
     * @return string
     */
    public function index()
    {
        //
    }



    /**
     * @Route [GET] /{id} (posts.show)
     * @param $id
     * @return string
     */
    public function show($id)
    {
        //
    }
}

```
* Etape 2: 