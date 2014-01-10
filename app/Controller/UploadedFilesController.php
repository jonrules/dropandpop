<?php
App::uses('AppController', 'Controller');
/**
 * UploadedFiles Controller
 *
 * @property UploadedFile $UploadedFile
 * @property PaginatorComponent $Paginator
 */
class UploadedFilesController extends AppController {

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
		$this->UploadedFile->recursive = 0;
		$this->set('uploadedFiles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UploadedFile->exists($id)) {
			throw new NotFoundException(__('Invalid uploaded file'));
		}
		$options = array('conditions' => array('UploadedFile.' . $this->UploadedFile->primaryKey => $id));
		$this->set('uploadedFile', $this->UploadedFile->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UploadedFile->create();
			if ($this->UploadedFile->save($this->request->data)) {
				$this->Session->setFlash(__('The uploaded file has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The uploaded file could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UploadedFile->exists($id)) {
			throw new NotFoundException(__('Invalid uploaded file'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UploadedFile->save($this->request->data)) {
				$this->Session->setFlash(__('The uploaded file has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The uploaded file could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UploadedFile.' . $this->UploadedFile->primaryKey => $id));
			$this->request->data = $this->UploadedFile->find('first', $options);
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
		$this->UploadedFile->id = $id;
		if (!$this->UploadedFile->exists()) {
			throw new NotFoundException(__('Invalid uploaded file'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UploadedFile->delete()) {
			$this->Session->setFlash(__('The uploaded file has been deleted.'));
		} else {
			$this->Session->setFlash(__('The uploaded file could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
}
