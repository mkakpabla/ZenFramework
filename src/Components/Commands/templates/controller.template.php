<?php
namespace App\Controllers;

use Components\Controller;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @BaseRoute /baseroute
 */
class PregReplace extends Controller
{


    /**
     * @Route [GET] / (baseroute.index)
     * @return string
     */
    public function index()
    {
        //
    }

    /**
     * @Route [GET] /{id} (baseroute.show)
     * @param $id
     * @return string
     */
    public function show($id)
    {
        //
    }
}
