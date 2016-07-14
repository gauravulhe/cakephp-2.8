<?php 
	/**
	* 
	*/
	class ContactsController extends ContactManagerAppController{
		public $uses = array('ContactManager.Contact');
		public $components = array('Search.Prg');
		public function index(){		
			$contact = $this->Contact->find('all');
			//$contact = $this->Contact->find('first', array('conditions' => array('Contact.id' => 1)));
			//$contact = $this->Contact->find('count');		
			//$contact = $this->Contact->find('list');	
			//$contact = $this->Contact->query("select * from contacts AS Contact ");	
			
			// $this->Contact->id = 11;
			// $contact = $this->Contact->field('name');
			//debug($contact);exit;
			$this->set('contacts', $contact);
		}

		

		public function view($id = null){
			$options = array('conditions' => array('Contact.'.$this->Contact->primaryKey => $id));
			$result = $this->Contact->find('first', $options);
			$this->set('contact', $result);
			//debug($result);exit;
		}

		public function add(){
			if ($this->request->is('post')) {
				//debug($this->request);exit;
				$this->Contact->create();
				if ($this->Contact->save($this->request->data)) {	
				$this->Session->setFlash('Contact has been added');				
					return $this->redirect(array('action' => 'index'));					
				}				
				$this->Session->setFlash('Failed to add contact');	
			}
		}

		public function edit($id = null){
			if ($this->request->is(array('post','put'))) {
				$this->Contact->id = $id;
				if ($this->Contact->save($this->request->data)) {
					$this->Session->setFlash('Contact has been updated.');
					return $this->redirect(array('action' => 'index'));
				}
					$this->Session->setFlash('Failed to update contact');
			}
			$options = array('conditions' => array('Contact.'.$this->Contact->primaryKey => $id));
			$this->request->data = $this->Contact->find('first', $options);
		}
	}
?>