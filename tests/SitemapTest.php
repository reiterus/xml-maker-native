<?php

namespace Reiterus\XmlMaker\Tests;

use DOMDocument;
use DOMException;
use Reiterus\XmlMaker\Sitemap;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::Sitemap
 */
class SitemapTest extends TestCase
{
    private Sitemap $object;

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
        $this->object = new Sitemap();
    }
}
