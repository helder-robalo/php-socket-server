<?php
/**
* Socket server - run this software as a service
* @author Bargão Robalo <bargaorobalo@gmail.com>
* @copyright Creative Commons Attribution-ShareAlike 3.0 Unported License. [CC BY SA]
*
*/

class ServerSocket{
	function __construct(){
		set_time_limit(0);
		$this->ip 		= "192.168.1.101"; //your  server IP address
		$this->port 	= 25001; // the port
		$this->sock 	= null;
	}
	private function service(){
		if(!($this->sock = socket_create(AF_INET, SOCK_STREAM, 0))){
			$errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		    die("Couldn't create socket: [$errorcode] $errormsg \n");
		}
		echo "\nSocket created \n";
		if( !socket_bind($this->sock, $this->ip , $this->port)){
			$errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		    die("Could not bind socket : [$errorcode] $errormsg \n");
		}
		echo "Socket bind OK \n";
		if(!socket_listen ($this->sock , 10)){
			$errorcode = socket_last_error();
		    $errormsg = socket_strerror($errorcode);
		    die("Could not listen on socket : [$errorcode] $errormsg \n");
		}
		echo "Socket listen OK \n";
		echo "Waiting for incoming connection... \n";
	}

	private function client($client){
		echo "Client is now connected to us. \n";
		while($input = socket_read($client, 2048)){
			echo date('d.m.Y H:i:s').' = '.$input."\n";
			// Here you can to do whatever you want with the input
			// .
			// .
			// .
		}
		socket_close($client);
		socket_close($this->sock);

	}

	public function run(){
		while(true){
			$this->service();
			$this->client(socket_accept($this->sock));
		}

	}
}
?>