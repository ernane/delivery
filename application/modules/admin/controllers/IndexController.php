<?php

class Admin_IndexController extends Developer_Controller_Action
{

	public function indexAction()
	{

	}

	public function newAction()
	{
		$form = new Developer_Form_Produto;
		$this->view->form = $form;
		
		if($this->_request->isPost()) 
		{
			if($form->isValid($this->data)) 
			{
				$model = new Application_Model_Produto();
				if($model->save($this->data)) 
					$this->view->error = false;
			}
		}
	}
}

