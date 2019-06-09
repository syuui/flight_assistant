<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\View\Helper\UrlHelper;
use Cake\Http\Exception\InternalErrorException;
const COMPONENT_PATH = APP . 'Controller' . DS . 'Component' . DS;
const SOAP_DISCOVERY_PATH = COMPONENT_PATH . 'SoapDiscovery.class.php';

/**
 * Ws Controller.
 *
 * WebService provider.
 *
 * @property \App\Model\Table\AirportsTable $Airports
 *
 * @method \App\Model\Entity\Airport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
const SERVICE_PORTS = [
    'hello',
    'getSum',
    'getRegisters'
];

/**
 * @deprecated
 * @author Administrator
 *
 */
class WsController extends AppController
{
    
    public function initialize(){
        throw new InternalErrorException('This class has already been deprecated.');
    }

    public function index()
    {
        $this->autoRender = false;
        
        $ser = new \SoapServer('http://localhost/ws/wsdl', [
            'soap_version' => SOAP_1_2
        ]);
        $ser->setClass(__CLASS__);
        $ser->handle();
    }

    public function wsdl()
    {
        $this->layout = false;
        
        $UrlHelper = new UrlHelper(new \Cake\view\view());
        
        $url = $UrlHelper->build([
            'controller' => 'ws',
            'action' => 'index'
        ], true);
        
        if (file_exists(SOAP_DISCOVERY_PATH)) {
            require_once SOAP_DISCOVERY_PATH;
        } else {
            $this->log(__('File {0} not found', SOAP_DISCOVERY_PATH));
            throw new InternalErrorException(__('File {0} not found', SOAP_DISCOVERY_PATH));
        }
        
        $service_uri = env('SERVER_NAME') . str_replace(__FUNCTION__, '', env('REQUEST_URI'));
        $disc = new SoapDiscovery(__CLASS__, $service_uri);
        $disc->setServicePortMethods(SERVICE_PORTS);
        $wsdl = $disc->getWSDL();
        $this->set(compact('wsdl'));
    }

    public function getRegisters()
    {
        $this->autoRender = false;
        $this->layout = false;
        $this->response = $this->response->withHeader('Content-Type', 'application/xml');
        $this->response = $this->response->withHeader('Connection', 'close');
        
        return "Hello,world";
    }

    /**
     *
     * @todo : WebService已经搭建完成，接下来需要通过WebService提供数据的增删改查功能。
     *      
     * @todo : \vendor\cakephp\cakephp\src\Http\Middleware\CsrfProtectionMiddleware.php
     *       以及
     *       \vendor\cakephp\cakephp\src\Controller\Component\CsrfComponent.php
     *       中，抛出 InvalidCsrfTokenException 之处都被注释掉了。需要找到正确的禁止 verder 的方法，
     *       避免加载这两个Component.
     */
    
    /**
     *
     * @deprecated
     *
     * @return string
     */
    public function hello()
    {
        $this->autoRender = false;
        $this->layout = false;
        $this->response = $this->response->withHeader('Content-Type', 'application/xml');
        $this->response = $this->response->withHeader('Connection', 'close');
        
        
        $this->loadModel('Registers');
        $result = $this->Registers->find('list');
        return $result->toArray();
        return 'Hello,world';
    }

    /**
     *
     * @deprecated
     *
     * @param unknown $a            
     * @param unknown $b            
     * @return number
     */
    public function getSum($a, $b)
    {
        return $a + $b;
    }
}
