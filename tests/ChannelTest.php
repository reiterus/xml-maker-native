<?php

namespace Reiterus\XmlMaker\Tests;

use DOMDocument;
use DOMException;
use Reiterus\XmlMaker\Channel;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::Channel
 */
class ChannelTest extends TestCase
{
    private Channel $object;

    /**
     * @covers ::create
     * @expectedException DOMException
     * @return void
     */
    public function testCreate()
    {
        $actual = $this->object->create();
        $this->assertInstanceOf(DOMDocument::class, $actual);
    }

    /**
     * @codeCoverageIgnore
     * @return void
     */
    protected function setUp(): void
    {
        $this->object = new Channel();
    }
}
