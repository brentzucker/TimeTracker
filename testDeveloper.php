<?php
require_once(__DIR__.'/include.php');
require_once(__DIR__.'/simpletest/autorun.php');

class testDeveloper extends UnitTestCase
{
	function testDeveloperClientsLoaded()
	{
		//Call the Developer constructor: loads the client list from the database
		$dev = new Developer('b.zucker');

		//The Clients assigned to the Developer in the database
		$expected_list = array("The Business", "CocaCola", "Home Depot");
		sort($expected_list);

		/*
		 * The function being tested: getClientList returns a list of client Objects
		 */ 
		$dev_client_objs = $dev->getClientList();
		$dev_clients = array();
		//get the client names from the client object list
		foreach($dev_client_objs as $client)
			array_push($dev_clients, $client->getClientname());
		
		sort($dev_clients);

		$this->assertEqual($expected_list, $dev_clients);
	}
}
?>