<?php
namespace Components;

use Components\Helpers\Redirect;
use Components\Renderer\RendererInterface;

class Controller
{
    use Redirect;

    /***
     * @var RendererInterface
     */
    public $renderer;

    /***
     * Controller constructor.
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {

        $this->renderer = $renderer;
    }

    /***
     * Permet de rendre une vue
     * @param string $view
     * @param array|null $data
     * @return string
     */
    protected function render(string  $view, ?array $data = [])
    {

        return $this->renderer->render($view, $data);
    }
}