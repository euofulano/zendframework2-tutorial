<?php

namespace Album\Controller;

use Album\Controller\AlbumController;
use Zend\Http\Request;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

class AlbumControllerTest extends PHPUnit_Framework_TestCase
{
	protected $controller;
	protected $request;
	protected $response;
	protected $routeMatch;
	protected $event;
	
	protected function setUp()
	{
		$bootstrap = \Zend\Mvc\Application::init(include 'config/application.config.php');
		$this->controller = new AlbumController();
		$this->request = new Request();
		$this->routeMatch = new RouteMatch(array('controller' => 'index'));
		
		$this->event = $bootstrap->getMvcEvent();
		$this->event->setRouteMatch($this->routeMatch);
		
		$this->controller->setEvent($this->event);
		$this->controller->setEventManager($bootstrap->getEventManager());
		$this->controller->setServiceLocator($bootstrap->getServiceManager());
	}
	
	public function testAddActionCanBeAccessed()
	{
		$this->routeMatch->setParam('action', 'add');
		
		$result = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
		
		$this->assertEquals(200, $response->getStatusCode());
		$this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
	}
	
	public function testDeleteActionCanBeAccessed()
	{
		// for inital controller, view testing function
		//$this->routeMatch->setParam('action', 'delete');
		$this->routeMatch->setParam('action', 'delete')->setParam('id', 1);
		
		$result = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
		
		$this->assertEquals(200, $response->getStatusCode());
		$this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
	}
	
	public function testEditActionCanBeAccessed()
	{
		// for inital controller, view testing function
		//$this->routeMatch->setParam('action', 'edit');
		$this->routeMatch->setParam('action', 'edit')->setParam('id', 1);
		
		$result = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
		
		$this->assertEquals(200, $response->getStatusCode());
		$this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
	}	
	
	public function testIndexActionCanBeAccessed()
	{
		$this->routeMatch->setParam('action', 'index');
	
		$result = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
	
		$this->assertEquals(200, $response->getStatusCode());
		$this->assertInstanceOf('Zend\View\Model\ViewModel', $result);
	}
	
	public function testGetAlbumTableReturnsAnInstanceOfAlbumTable()
	{
		$this->assertInstanceOf('Album\Model\AlbumTable', $this->controller->getAlbumTable());
	}
	
	protected function tearDown()
	{
		unset($this->controller, $this->request, $this->response, $this->routeMatch, $this->event);
	}
	
}