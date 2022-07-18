<?php

namespace Reiterus\XmlMaker\Tests;

use DOMElement;
use DOMException;
use Reiterus\XmlMaker\AbstractMaker;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::AbstractMaker
 */
class AbstractMakerTest extends TestCase
{
    private $stub;

    /**
     * @covers ::makeRoot
     * @expectedException DOMException
     * @return void
     */
    public function testMakeRoot()
    {
        $dom = $this->stub->getDOMDocument();
        $this->stub->setRootAttributes(['key' => 'value']);
        $actual = $this->stub->makeRoot($dom);
        $this->assertInstanceOf(DOMElement::class, $actual);
    }

    /**
     * @covers ::makeNestedNodes
     * @dataProvider dataNodesProvider
     * @expectedException DOMException
     * @return void
     */
    public function testMakeNestedNodes(array $items)
    {
        $dom = $this->stub->getDOMDocument();
        $actual = $this->stub->makeNestedNodes('name', $items, $dom);
        $this->assertInstanceOf(DOMElement::class, $actual);
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function dataNodesProvider(): array
    {
        return [
            [['items' => ['key' => 'value']]],
            [['key' => 'value']],
        ];
    }

    /**
     * @codeCoverageIgnore
     * @return void
     */
    protected function setUp(): void
    {
        $this->stub = $this->getMockForAbstractClass(AbstractMaker::class);
    }
}
