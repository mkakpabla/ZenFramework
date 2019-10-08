<?php
namespace Framework;

use GuzzleHttp\Psr7\MessageTrait;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Zen\Validation\UndifedRuleException;

trait Validator
{
    /***
     * Permet de faire la validation
     * @param ServerRequestInterface $request
     * @return MessageTrait|Response
     * @throws UndifedRuleException
     */
    public function validate(ServerRequestInterface $request)
    {
        $validator = (new \Zen\Validation\Validator($request->getParsedBody(), $this->rules))
                        ->validate();
        if (!$validator->isValid()){
            return (new Response())
                ->withStatus(302)
                ->withHeader('Location', $request->getServerParams()['HTTP_REFERER']);
        }
    }

}