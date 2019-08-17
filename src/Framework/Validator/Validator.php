<?php


namespace Framework\Validator;

use Framework\Session\Session;
use Psr\Http\Message\ServerRequestInterface;

class Validator
{


    public static function validate(ServerRequestInterface $request, array $rules, array $messages = [])
    {
        $validator = new \Rakit\Validation\Validator;
        $validate = $validator->validate($request->getParsedBody(), $rules, $messages);
        if ($validate->fails()) {
            (new Session())->set('errors', $validate->errors());
            throw new ValidationException();
        }
    }
}
