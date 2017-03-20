<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;


/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 */
class ClientsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $clients = $this->paginate($this->Clients);

        $this->set(compact('clients'));
        $this->set('_serialize', ['clients']);
    }

	public function luckydraw()
	{
		$t = $this->request->data['started'];
		$eventStart = new Time(vsprintf('%s-%s-%s %s:%s', $t));
		$clients = $this->Clients->find()->applyOptions(['contain' => 'ClientMetadatas'])->leftJoinWith('ClientMetadatas')->where(['Clients.anonymous' => 0, 'Clients.created >' => $eventStart]);
		$clientsA = $clients->toArray();
		$clientsF = $clients->where(['ClientMetadatas.name' => 'gender', 'ClientMetadatas.value' => 'F'])->toArray();
		$clients = $this->Clients->find()->applyOptions(['contain' => 'ClientMetadatas'])->leftJoinWith('ClientMetadatas')->where(['Clients.anonymous' => 0, 'Clients.created >' => $eventStart]);
		$clientsM = $clients->where(['ClientMetadatas.name' => 'gender', 'ClientMetadatas.value' => 'M'])->toArray();
		$winners = ['all' => $clientsA, 'male' => $clientsM, 'female' => $clientsF];
		foreach ($winners as $key => $winner) {
			$r = rand(0, sizeof($winner)-1);
			$w = $winner[$r];
			foreach($w['client_metadatas'] as $meta) {
				if ($meta['name'] == 'phone')
					$w['phone'] = $meta['value'];
			}
			$winners[$key] = ['firstname' => $w['firstname'], 'lastname' => $w['lastname'], 'phone' => $w['phone'], 'email' => $w['email']];
		}
		$this->set(compact('winners'));
		$this->set('_serialize', ['winners']);
		
	}

}
