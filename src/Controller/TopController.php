<?php
/**
 * TopController: 首页用控制器
 * 
 * 
 *
 * @copyright Copyright (c) 2018 syuui.
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;


/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class TopController extends AppController
{
    // var $components = ['WebServiceClient'];
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('PageSpider');
    }

    /**
     * Displays Top Page
     *
     * @param array ...$path
     *            Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory
     *         traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could
     *         not
     *         be found or \Cake\View\Exception\MissingTemplateException in
     *         debug mode.
     */
    public function show(...$path)
    {
        // 查看取得的参数的个数
        $count = count($path);
        if (!$count) {
            // 如果没有参数（未控制控制器及方法）则返回首页
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            // 参数中不能含有 .. 及 . ，否则抛出ForbiddenException异常
            throw new ForbiddenException();
        }
        $page = $subpage = null;
        
        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));
        
        try {
            $this->viewBuilder()->setLayout(false);
            $this->render(implode('/', $path));
        }
        catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function index()
    {}

    public function test()
    {
        $this->loadModel('Terminals');
        $this->loadModel('Airports');
        
        //$result = $this->Terminals->find('fullNameList');
        $result = $this->Terminals->find('list');
        $this->set(compact('result'));
    }
}
