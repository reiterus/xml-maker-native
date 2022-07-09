<?php

/*
 * This file is part of the Reiterus package.
 *
 * (c) Pavel Vasin <reiterus@yandex.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Reiterus\XmlMaker;

use DOMDocument;
use DOMException;

/**
 * Generate sitemap
 *
 * @package Reiterus\XmlMaker
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
class Sitemap extends AbstractMaker
{
    /**
     * Document root node name
     *
     * @var string
     */
    protected string $rootName = 'urlset';

    /**
     * Item nodes name
     * @var string
     */
    protected string $itemName = 'url';

    /**
     * Create sitemap document
     *
     * @return DOMDocument
     * @throws DOMException
     */
    public function create(): DOMDocument
    {
        $dom = $this->getDOMDocument();
        $root = $this->makeRoot($dom);

        $itemName = $this->getItemName();
        $items = $this->getDocItems();

        foreach ($items as $item) {
            $node = $this->makeNestedNodes($itemName, $item, $dom);
            $root->appendChild($node);
        }

        $dom->appendChild($root);

        return $dom;
    }
}
