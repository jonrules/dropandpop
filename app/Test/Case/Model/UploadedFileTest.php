<?php
App::uses('UploadedFile', 'Model');

/**
 * UploadedFile Test Case
 *
 */
class UploadedFileTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.uploaded_file'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UploadedFile = ClassRegistry::init('UploadedFile');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UploadedFile);

		parent::tearDown();
	}

}
