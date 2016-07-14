<?php
App::uses('AppController', 'Controller');
/**
 * Members Controller
 *
 * @property Member $Member
 * @property PaginatorComponent $Paginator
 */
class MembersController extends AppController {

	public $uses = array('Member', 'Education');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('add', 'logout');
		$this->set('user_id', $this->Auth->user('id'));		
		$this->set('user_role', $this->Auth->user('role'));
	}

	public function isAuthorized($user){
		if (in_array($this->action, array('add', 'view'))) {
			return true;
		}

		if (in_array($this->action, array('edit', 'delete'))) {
			//debug($this->action);exit;
			$memId = (int) $this->request->params['pass'][0];
			//debug($memId == $this->Auth->user('id'));exit;

			if ($memId == $this->Auth->user('id')) {
				return true;
			}
			$this->Session->setFlash('Not allowed.');
		}

		return parent::isAuthorized($user);
	}

	public function login(){
		if ($this->request->is('post')) {
			if($this->Auth->login()){
				return $this->redirect($this->Auth->redirectUrl());
			}

			$this->Session->setFlash('Invalid username or password.');
		}
	}

	public function logout(){
		return $this->redirect($this->Auth->logout());
	}

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


/**
 * index method
 *
 * @return void
 */
	public function index() {		
		if ($this->request->is('post'))
		{
			//debug($this->request->data);exit; 
			$search = $this->request->data['Member']['search'];
			$type = $this->request->data['Member']['type'];
			//debug($search);exit;
			
			$options = array('conditions' => array('Member.'.$type. ' LIKE' . $this->Member => '%'.$search.'%'));
			//debug($options);exit;
			//debug($this->Member->find('first', $options));exit;
			$this->set('members', $this->Member->find('all', $options), $this->Paginator->paginate());
		}
		else
		{
			$this->Member->recursive = 0;
			$this->set('members', $this->Paginator->paginate());
		}
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Member->exists($id)) {
			throw new NotFoundException(__('Invalid member'));
		}
		$options = array('conditions' => array('Member.' . $this->Member->primaryKey => $id));
		$this->set('member', $this->Member->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->helpers = array('TinyMCE.TinyMCE');
		if ($this->request->is('post')) {
			for ($i=1; $i < 5 ; $i++) { 
				$fileName = $this->fileName($i);				
				$tmpName = $this->tmpName($i);
				$uploadFile = $this->uploadFile($i, $fileName);
				$this->moveFile($tmpName, $uploadFile);
				$this->request->data['Member']['avatar'.$i] = $fileName;
			}
				$this->Member->create();
				if ($this->Member->save($this->request->data)) {
					$this->Session->setFlash(__('The member has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The member could not be saved. Please, try again.'));
				}
		}
		// passing options for gender field
		$gender = array('Male' => 'Male', 'Female' => 'Female');
		$this->set('genders', $gender);
		// passing options for education field
		$education = $this->Education->find('list', array(
			'fields' => array('Education.education', 'Education.education')
		));
		//debug($education);exit;
		$this->set('educations', $education);
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Member->exists($id)) {
			throw new NotFoundException(__('Invalid member'));
		}
		if ($this->request->is(array('post', 'put'))) {			
			$uploadPath = WWW_ROOT.'uploads/';	
			for ($i=1; $i < 5 ; $i++) { 
				$fileNameOld = $this->request->data['Member']['avatar'.$i.'_old'];
				if (!empty($this->request->data['Member']['avatar'.$i]['name'])) {
						$fileName = $this->fileName($i);				
						$tmpName = $this->tmpName($i);
						$uploadFile = $this->uploadFile($i, $fileName);
						$removeFile = $uploadPath.$fileNameOld;
						unlink($removeFile);
						$this->moveFile($tmpName, $uploadFile);
						$this->request->data['Member']['avatar'.$i] = $fileName;
				}else{	
					$this->request->data['Member']['avatar'.$i] = $fileNameOld;
				}
			}
			$this->Member->create();
			if ($this->Member->save($this->request->data)) {
				$this->Session->setFlash(__('The member has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The member could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Member.' . $this->Member->primaryKey => $id));
			$this->request->data = $this->Member->find('first', $options);
			for ($i=1; $i < 5; $i++) { 
				$this->set('avatar'.$i, $this->getName($i));
			}
			// passing options for gender field
			$gender_data = $this->request->data['Member']['gender'];
			$gender = array(
				'Male' => 'Male',
				'Female' => 'Female'
			);			
			$this->set('genders', $gender);
			// passing options for education field
			$education = $this->Education->find('list', array(
				'fields' => array('Education.education', 'Education.education')
			));
			$this->set('educations', $education);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Member->id = $id;
		if (!$this->Member->exists()) {
			throw new NotFoundException(__('Invalid member'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Member->delete()) {
			$this->Session->setFlash(__('The member has been deleted.'));
		} else {
			$this->Session->setFlash(__('The member could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function fileName($i){
		return rand(000000, 999999).'_'.$this->request->data['Member']['avatar'.$i]['name'];
	}

	public function tmpName($i){
		return $this->request->data['Member']['avatar'.$i]['tmp_name'];
	}

	public function uploadFile($i, $fileName){					
		$uploadPath = WWW_ROOT.'uploads/';
		return $uploadPath.$fileName;
	}

	public function moveFile($tmpName, $uploadFile){
		return move_uploaded_file($tmpName, $uploadFile);
	}

	public function getName($i){
		return $this->request->data['Member']['avatar'.$i];
	}
}
