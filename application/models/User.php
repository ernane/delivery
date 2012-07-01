<?php

class Application_Model_User extends Application_Model_Abstract {

	public function __construct() {
		$this->_dbTable = new Application_Model_DbTable_User();
	}

	public function _insert(array $data) {
		$data['password'] = sha1($data['passowrd']);
		return $this->_dbTable->insert($data);
	}

	public function _update(array $data) {
		if (isset($data['password']))
			$data['password'] = sha1($data['passowrd']);

		return $this->_dbTable->update($data, array('id=?'=>$data['id']));
	}

}

