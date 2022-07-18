<?php

/*
 * This file is part of the Reiterus package.
 *
 * (c) Pavel Vasin <reiterus@yandex.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Reiterus\XmlMaker\Tests;

use DOMElement;
use DOMException;
use Reiterus\XmlMaker\AbstractMaker;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::AbstractMaker
 * Class AbstractMakerTest
 *
 * @package Reiterus\XmlMaker\Tests
 * @author Pavel Vasin <reiterus@yandex.ru>
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
