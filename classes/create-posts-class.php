<?php



class CreatePosts {
	private $username;
	private $password;
	private $blogId;
	private $endpoint;
	private $xmlrpcRequest;
	
	public function __construct($username, $password, $blogId, $endpoint) {


		$this->username = $username;
		$this->password = $password;
		$this->blogId = $blogId;
		$this->endpoint = $endpoint;



$customFields = array(
    		array(
    			"key" 	=> "code",
    			"value"	=> "abcdef",
    		),
    		array(
    			"key"	=> "expires",
    			"value"	=> "20131231" // YYYYMMDD
    		),
    		array(
    			"key"	=>	"url",
    			"value"	=> "http://merchant.com",
    		),
    		array(
    			"key"	=> "offer_id",
    			"value"	=> "1234567890",
    		),
    	);
		
		$this->postContent = [
			'post_content'	=> "A bunch of content",
			'post_name'		=> "Post Name",
			'post_title'	=> "Post Title",
			'post_status'	=> "publish",
			'post_type'		=> "post",
			'custom_fields'	=> [
				[
					'key'	=> "_deal_expiration",
					'value'	=> "field_526c28fddb7cc",
				],
				[
					'key'	=> "deal_expiration",
					'value'	=> "20131231", // YYYYMMDD
				],
				[
					'key'	=> "_url",
					'value'	=> "field_526440b01e452",
				],
				[
	    			"key"	=> "url",
	    			"value"	=> "http://merchant.com",
				],
				[
					"key"	=> "offer_id",
					"value"	=> "1234567890",
				],
			],
/*
			'tax_input'		=> [
				=> [
					=>,
				],
			],
*/
		];
		$this->postParams = [
			$this->blogId,
			$this->username,
			$this->password,
			$this->postContent,
			true
		];
		$this->xmlrpcRequest = xmlrpc_encode_request("wp.newPost", $this->postParams, array("encoding" => "UTF-8"));
	}
	
	public function writePost() {
		return $this->sendRequest();
	}



	public function sendRequest() {
	    $ch = curl_init();
	    $curlOptsArray = array(
	    	CURLOPT_POSTFIELDS		=> $this->xmlrpcRequest,
	    	CURLOPT_URL				=> $this->endpoint,
	    	CURLOPT_RETURNTRANSFER	=> TRUE,
	    	CURLOPT_TIMEOUT			=> TRUE,
	    );
	    	    
	    curl_setopt_array($ch, $curlOptsArray);
	    $response = curl_exec($ch);
	    curl_close($ch);
	    return $response;
	}



}

?>