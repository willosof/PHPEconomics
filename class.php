<?php

class ecw {

	public $client;
	public $access_granted;

	function __construct() {    


		try {
			$settings = parse_ini_file(realpath(dirname(__FILE__) .'/economics.ini'));

			if (is_array($settings) && count($settings) > 0) {

				$this->client = new SoapClient($settings['wsdl_endpoint'], array("trace" => 1, "exceptions" => 1));

				$this->client->Connect(
					array(
						'agreementNumber' => $settings['agreement_number'],
						'userName' => $settings['user_name'],
						'password' => $settings['password']
					)
				);

				$this->access_granted = true;

			} else {

				$this->access_granted = false;
				throw new Exception('INI file could not be found');

			}      

		} catch (Exception $e) {

			$this->access_granted = false;
			throw new Exception("Access not granted!");

		}
	}

	function disconnect() {
		$this->client->Disconnect();
	}

	function test_access_credentials () {
		return $this->access_granted;
	}

	function api($call,$params=array()) {
		$x = $this->client->$call($params);
		$rc = $call."Result";
		return $x->$rc;
	}



}
