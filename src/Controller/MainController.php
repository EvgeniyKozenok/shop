<?php

namespace Shop\Controller;

use John\Frame\Controller\BaseController;
use John\Frame\Router\Route;
use Shop\Model\MainModel;

class MainController extends BaseController
{
    /**
     * @var this route
     */
    protected $route;

    /**
     * @var array data fo this view
     */
    protected $data = [];

    /**
     * set  this route for controller
     * @param Route $route
     */
    public function setRoute(Route $route){
        $this->route = $route;
    }

    /**
     * Function for render data
     *
     * @param array $data
     * @param string $view
     * @param string $controller
     * @param MainModel $model
     * @return \John\Frame\Response\Response
     */
    protected function getRenderer(array $data = [], MainModel $model = null, string $view = '', string $controller = '')
    {
        $user['name'] = 'гость';
        if(isset($_SESSION['logged_user'])){
            $user = $model->getUser($_SESSION['logged_user']);
        }
        $name = compact( 'name', 'user');
        $view = $view ? : $this->route->getMethod();
        $controller = $controller ? : $this->route->getController();
        $this->data = array_merge($this->getSidebarData(), $name, $data);
        $this->renderer->rend($this->injector, $view, $controller, $this->data);
        $this->response->setContent($this->renderer->getRendered());
        return $this->response;
    }

    /**
     * Function that get sidebar data for site
     * @return array
     */
    private function getSidebarData(): array {
        $model = $this->injector->get('Shop\\Model\\CategoryModel');
        $goods = $model->getGoods();
        $categories = $model->getCategories();
        return compact('goods', 'categories');
    }

}