<?php

abstract class Application_Model_Abstract {

	protected $_dbTable;

	public function find($id) {
		return $this->_dbTable->find($id)->current();
	}

	public function save(array $data) {
		if (isset($data['id'])) {
			return $this->_update($data);
		} else {
			return $this->_insert($data);
		}
	}

	public function delete($id) {
		return $this->_dbTable->delete(array('id', $id));
	}

	public function fetchAll($params=null) {
		$page = isset($params['page']) ? (int) $params['page'] : 1;
		$perage = isset($params['perpage']) ? (int) $params['perpage'] : 10;

		$paginator = Zend_Paginator::factory($this->_dbTable->fetchAll());
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($perage);
		return $paginator;
	}

	public function search(array $params) {
		$str = isset($params['str']) ? $params['str'] : "";
		$filtro = isset($params['filtro']) ? $params['filtro'] : "";
		$page = isset($params['page']) ? (int) $params['page'] : 1;
		$perPage = isset($params['perpage']) 
			? (int) $params['perpage'] : Zend_Registry::get('config')->paginator->totalItemPerPage;
		$limit = ( $page - 1 ) * $perPage;
		$where = null;
		$select = $this->_dbTable->select();

		if (!empty($str)) {
			$select->where($filtro . " like '%" . $str . "%'" );
		}

		if( !is_null($limit) || $limit != 0 )
			$select->limit( $perPage, $limit );

		$paginator = Zend_Paginator::factory( $select );
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($perPage);

		return $paginator;
	}

	abstract public function _insert(array $data);

	abstract public function _update(array $data);
}
