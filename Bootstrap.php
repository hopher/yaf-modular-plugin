<?php

use Yaf\Dispatcher;
use Yaf\Config_Abstract;
/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf\Bootstrap_Abstract
{

    public function _initAutoload()
    {
        // composer 自动加载
        Yaf\Loader::import(__DIR__ . '/vendor/autoload.php');
    }

    public function _initConfig()
    {
        $this->config = Yaf\Application::app()->getConfig(); //把配置保存起来
        Yaf\Registry::set('config', $this->config);
    }

    public function _initPlugin(Dispatcher $dispatcher)
    {
        $modular = new ModularPlugin();
        $dispatcher->registerPlugin($modular);
    }

    public function _initRoute(Dispatcher $dispatcher)
    {

        $router = $dispatcher->getRouter();
        $routes = $this->config->routes;
        
        if ($routes instanceof Config_Abstract || is_array($routes)) {
            // 添加配置中的路由            
            $router->addConfig($routes);            
        }

    }
    
}
