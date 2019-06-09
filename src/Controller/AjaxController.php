<?php
namespace App\Controller;

use App\Controller\AppController;


/**
 * Airports Controller
 *
 * @property \App\Model\Table\AirportsTable $Airports
 *
 * @method \App\Model\Entity\Airport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AjaxController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('PageSpider');
        $this->layout = 'ajax';
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function getFlightInfo($flight = null)
    {
        if (empty($flight)) return null;
        
        $flightInfo = $this->PageSpider->getFlightInfoFromWebPage($flight);
        $this->set(compact('flightInfo'));
        $this->set('_serialize', [
            'flightInfo'
        ]);
    }

    public function getRealFlightInfo($flight = null, $date = null)
    {
        if (empty($flight) || empty($date)) return null;
        
        $flightInfo = $this->PageSpider->getRealFlightInfoFromWebPage($flight, $date);
        $this->set(compact('flightInfo'));
        $this->set('_serialize', [
            'flightInfo'
        ]);
    }
}
