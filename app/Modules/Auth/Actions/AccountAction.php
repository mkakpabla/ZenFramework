<?php


namespace App\Modules\Auth\Actions;

use Framework\AbstractAction;

class AccountAction extends AbstractAction
{

    /**
     * @Route('get', '/account', 'account')
     */
    public function account()
    {
        return $this->render('users.account');
    }
}
