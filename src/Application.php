<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\I18n\Middleware\LocaleSelectorMiddleware;
use Cake\Database\Type;


/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication
{

    /**
     *
     * {@inheritdoc}
     *
     */
    public function bootstrap()
    {
        $this->addPlugin('DebugKit');
        
        // Call parent to load bootstrap from files.
        parent::bootstrap();
        
        if (PHP_SAPI === 'cli') {
            try {
                $this->addPlugin('Bake');
            }
            catch (MissingPluginException $e) {
                // Do not halt if the plugin is missing
            }
            
            $this->addPlugin('Migrations');
        }
        
        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            $this->addPlugin(\DebugKit\Plugin::class);
        }
        
        Type::build('datetime')->useLocaleParser()->setLocaleFormat('YYYY/mm/dd HH:MM:SS');
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue
     *            The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware($middlewareQueue)
    {
        $middlewareQueue->add(ErrorHandlerMiddleware::class)
            ->add(new AssetMiddleware([
            'cacheTime' => Configure::read('Asset.cacheTime')
        ]))
            ->add(new RoutingMiddleware($this, '_cake_routes_'))

         //->add(new CsrfProtectionMiddleware([
         //'httpOnly' => true ] ))
        // 不加载这里的CSRF中间件，避免在SOAP中引起错误
        
         ->add(new LocaleSelectorMiddleware([
            'zh_CN',
            'zh_CN'
        ]));
        
        return $middlewareQueue;
    }
}
