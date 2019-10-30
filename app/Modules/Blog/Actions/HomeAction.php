<?php


namespace App\Modules\Blog\Actions;


use Framework\AbstractAction;

class HomeAction extends AbstractAction
{

    /**
     * @Route('get', '/', 'test')
     */
    public function index()
    {
        return $this->render('welcome');
    }

}