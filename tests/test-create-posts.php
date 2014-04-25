<?php

require_once "../classes/create-posts-class.php";
require_once("../config/local.config");

class TestCreatePosts extends PHPUnit_Framework_TestCase {
	protected function setUp() {
		$this->username = RPCXML_USER;
		$this->password = RPCXML_PASS;
		$this->blogId = RPCXML_BLOGID;
		$this->endpoint = RPCXML_ENDPOINT;
	
		$this->cp = new CreatePosts($this->username, $this->password, $this->blogId, $this->endpoint);
	}
	
	public function testObjectExists() {
		$this->assertEquals("CreatePosts", get_class($this->cp));
	}
	
	public function testWritePostReturnsPostId() {
		echo "testWritePostReturnsPostId" . PHP_EOL;
		$postId = xmlrpc_decode($this->cp->writePost());
		echo "postId: $postId" . PHP_EOL;
		$this->assertTrue(intval($postId) > 0, "Tested that writePost returns positive integer.");
		
	}

	// title, content, taxonomy, post type
	// custom fields
	
}

?>

