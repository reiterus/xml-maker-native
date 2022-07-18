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

use DOMDocument;
use DOMException;
use Reiterus\XmlMaker\Sitemap;
use PHPUnit\Framework\TestCase;

/**
 * @covers ::Sitemap
 * Class SitemapTest
 *
 * @package Reiterus\XmlMaker\Tests
 * @author Pavel Vasin <reiterus@yandex.ru>
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
