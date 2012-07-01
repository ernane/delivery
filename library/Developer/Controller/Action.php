<?php

abstract class Developer_Controller_Action extends Zend_Controller_Action
{
	protected $data;
	
	public function init()
	{
		if ($this->_request->isPost()) {
			$this->data = $this->_request->getPost();
      if (isset($this->data['submit']))
          unset($this->data['submit']);
		}
	}
}