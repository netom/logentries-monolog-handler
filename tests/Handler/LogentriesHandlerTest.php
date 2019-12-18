<?php 

use Mockery as m;
use Monolog\Logger;
use Logentries\Handler\LogentriesHandler;

class LogentriesHandlerTest extends \PHPUnit\Framework\TestCase
{
	private $log;
	private $socketMock;

	public function setUp(): void
	{
		$this->socketMock = m::mock('Logentries\Socket');

		$this->log = new Logger('TestLog');
		$this->log->pushHandler(new LogentriesHandler('testToken', Logger::DEBUG, true, $this->socketMock));
	}

	public function tearDown(): void
	{
		m::close();
	}

	public function testWarning()
	{
		$this->socketMock->shouldReceive('write')->once();

		$this->log->warning('Foo');

        $this->addToAssertionCount(1);
	}

}
