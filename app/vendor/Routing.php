<?php

namespace app\vendor;

class Routing
{
    private $uri;
    private $route;
    private $dirController = 'app/controllers/';
    private $controllerName;
    private $controllerNamespace;
    private $methodName;

    // Start application
    public function startApp(): void
    {
        $this->setUri();
        $this->setRoute();
        $this->setRouteParams();
        $this->redirect();
    }

    // Clean URI from project name: /stationery
    public function setUri(): void
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        if (preg_match('#^/?stationery#', $this->uri)) {
            $this->uri = preg_replace('#^/?[^/]+?/#', '', $_SERVER['REQUEST_URI']);
        }
    }

    // Clean URI from GET-parameters
    public function setRoute(): void
    {
        $this->route = explode('?', $this->uri)[0];
    }

    // Set Controller class name
    public function setControllerName($name): void
    {
        $this->controllerName = ucfirst($name) . 'Controller';
    }

    // Set Controller class namespace
    public function setControllerNamespace(): void
    {
        $this->controllerNamespace = preg_replace('#/#', '\\', $this->dirController . $this->controllerName);
    }

    // Set Method name
    public function setMethodName($name): void
    {
        $this->methodName = $name;
    }

    // Set route parameters
    public function setRouteParams(): void
    {
        global $urlRoutes;
        if (isset($urlRoutes[$this->route])) {
            $routePath = explode('/', $urlRoutes[$this->route]);
            if (isset($routePath[0]) && isset($routePath[1]) && isset($routePath[2])) {
                $this->dirController .= $routePath[0] . '/';
                $this->setControllerName($routePath[1]);
                $this->setControllerNamespace();
                $this->setMethodName($routePath[2]);
            }
        }
    }

    // Redirect to specified URI
    public function redirect(): void
    {
        $file = $this->dirController . $this->controllerName . '.php';
        if (is_null($this->checkExistance('file', $file))) {
            // require_once($file);
            if (is_null($this->checkExistance('class', $this->controllerNamespace))) {
                $controller = new $this->controllerNamespace();
                if (is_null($this->checkExistance('method', $this->controllerNamespace, $this->methodName))) {
                    $method = $this->methodName;
                    $controller->$method();
                }
            }
        }
    }

    // Check if specified entity exists
    public function checkExistance($entityType, $entity, $method = null): null|string
    {
        $error = null;
        switch ($entityType) {
            case 'file':
                if (!file_exists($entity)) {
                    $error = 'No such file: ' . $entity;
                }
                break;
            case 'class':
                if (!class_exists($entity)) {
                    $error = 'No such class: ' . $entity;
                }
                break;
            case 'method':
                if (!method_exists($entity, $method)) {
                    $error = 'No such method: <b>' . $method . '</b> in class: <b>' . $entity . '</b>';
                }
                break;
        }
        if (!is_null($error)) {
            $baseController = new Controller();
            $baseController->view('templates/404', compact('error'));
        }

        return $error;
    }
}