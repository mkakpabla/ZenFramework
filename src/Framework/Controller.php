<?php
namespace Framework;

use Framework\Helpers\Redirect;
use Framework\Renderer\RendererInterface;
use Psr\Container\ContainerInterface;
use Rakit\Validation\Validation;
use Rakit\Validation\Validator;

class Controller
{
    use Redirect;
    /**
     * @var ContainerInterface
     */
    protected $container;

    /***
     * Controller constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /***
     * Permet de rendre une vue
     * @param string $view
     * @param array|null $data
     * @return string
     */
    protected function render(string  $view, ?array $data = [])
    {
        return $this->container->get(RendererInterface::class)->render($view, $data);
    }

    protected function validation(array $inputs, array $rules, array $messages = []): Validation
    {
        return $this->container->get(Validator::class)->validate($inputs, $rules, $messages);
    }
}
