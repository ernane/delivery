<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

	protected $_logger;

	protected function _initAutoloader() {
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->registerNamespace("Developer");
		return $autoloader;
	}

	protected function _initPlugins() {
		$bootstrap = $this->getApplication();

		if ($bootstrap instanceof Zend_Application)
			$bootstrap = $this;

		$bootstrap->bootstrap("FrontController");
		$front = $bootstrap->getResource("FrontController");

		$front->registerPlugin(new Developer_Plugins_Layout());
	}

	protected function _initC() {
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
		Zend_Registry::set('config', $config);

		$db = Zend_Db_Table::getDefaultAdapter();
		Zend_Registry::set('db', $db);
	}

	protected function _initViews() {
		$this->bootstrap("view");
		$view = $this->getResource("view");

		$view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');

		$view->doctype('HTML5');
		$view->headTitle('SON Delivery')->setSeparator(' | ');
		$view->headMeta()->appendHttpEquiv('Content-type', 'text/html; charset=UTF-8');

		Zend_Registry::set('view', $view);
	}

	protected function _initConfig() {
		Zend_Registry::set('config', new Zend_Config($this->getOptions()));
	}

/*
protected function _initLogger() {
$this->bootstrap(array('frontController', 'config'));
$config = Zend_Registry::get('config');

$mongoDbServer = $config->log->mongodb->get('server', '127.0.0.1');
$mongoDbName = $config->log->mongodb->get('db', "zf_logs");
$mongoDbCollection = $config->log->mongodb->get('collection', 'entries');

$logger = new Zend_Log();
$writer = new SON_Log_Writer_MongoDb(new Mongo($mongoDbServer),
$mongoDbName, $mongoDbCollection);

if ('production' === $this->getEnvironment()) {
$priority = constant($config->log->get('priority', Zend_Log::CRIT));
$filter = new Zend_Log_Filter_Priority($priority);
$logger->addFilter($filter);
}
$logger->addWriter($writer);
$this->_logger = $logger;
Zend_Registry::set('log', $logger);
}
*/

protected function _initZFDebug() {
	$autoloader = Zend_Loader_Autoloader::getInstance();
	$autoloader->registerNamespace('ZFDebug');
	$this->bootstrap('db');
	$db = $this->getPluginResource('db')->getDbAdapter();

	$config = Zend_Registry::get('config');
	$ZFDebugConfig = $config->ZFDebug;

	if ($ZFDebugConfig->enabled) {
		$options = array(
			'plugins' => array('Variables',
			'Database' => array('adapter' => $db),
			'File' => array('basePath' => '/'),
			'Memory',
			'Time',
			'Registry',
			#'Cache' => array('backend' => Zend_Registry::get('cache')->getBackend()),
		'Exception')
			);
		$debug = new ZFDebug_Controller_Plugin_Debug($options);

		$this->bootstrap('frontController');
		$frontController = $this->getResource('frontController');
		$frontController->registerPlugin($debug);
	}
}

}

