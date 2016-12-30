<?php

use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

/**
 * 模块化辅助插件
 */
class ModularPlugin extends Plugin_Abstract
{

    /**
     * 实现模块化处理
     * @param Request_Abstract $request
     * @param Response_Abstract $response
     */
    public function routerStartup(Request_Abstract $request, Response_Abstract $response)
    {
        $uri = $request->getRequestUri();
        $uris = explode('/', trim($uri, '/'));

        // API 接口
        if (preg_match('#^/api/(.+)#', $uri)) {
            array_shift($uris);
            Yaf\Dispatcher::getInstance()->autoRender(false);
            $controller = sprintf('Api\%s', (empty($uris[1]) ? 'Index' : $uris[1]));
        } else {
            $controller = sprintf('\Web\%s', (empty($uris[1]) ? 'Index' : $uris[1]));
        }

        $router = Yaf\Dispatcher::getInstance()->getRouter();        
        $config = Yaf\Application::app()->getConfig();        
        $moduleRegex = str_replace(',', '|', $config->application->modules);

        // 模块|控制器|动作
        $route = new Yaf\Route\Regex('#^/('.$moduleRegex.')(/[^/]*)?(/[^/]*)?#i', [
            'module' => $uris[0],
            'controller' => $controller,
            'action' => empty($uris[2]) ? 'index' : $uris[2],
        ]);

        $router->addRoute("module", $route);        
    }

    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        // TODO...
    }

    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {
        // TODO...
    }

    public function preDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        // TODO...
    }

    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        // TODO...
    }

    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        // TODO...
    }
    


}
