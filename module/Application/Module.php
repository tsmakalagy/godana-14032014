<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\I18n\Translator\Translator;
use Zend\Validator\AbstractValidator;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        
        $eventManager->attach(MvcEvent::EVENT_ROUTE, function($e) { 
            $routeMatch = $e->getRouteMatch(); 
            $language = $routeMatch->getParam('lang', 'en');
            $translator = $e->getApplication()->getServiceManager()->get('translator');
            $translator->addTranslationFile(
		        'phpArray',
		        './vendor/zendframework/zendframework/resources/languages/'.$language.'/Zend_Validate.php'
		
			);
			AbstractValidator::setDefaultTranslator($translator);
        }); 
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
