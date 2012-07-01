<?php

class Default_SignupController extends Developer_Controller_Action
{
	public function indexAction() {
		$form = new Developer_Form_Profile();
		$this->view->form = $form;

		if($this->_request->isPost()) {
			if($form->isValid($this->data)) {
				$model = new Application_Model_User();
				if($model->save($this->data)) 
					$this->view->error = false;
			}
		}
	}
}

