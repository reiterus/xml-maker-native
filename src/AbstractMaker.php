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
use DOMElement;
use DOMException;

/**
 * Parent of a class family
 *
 * @package Reiterus\XmlMaker
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
abstract class AbstractMaker
{
    /**
     * Pretty output or not
     * @var bool
     */
    public bool $pretty = true;

    /**
     * Document root node name
     *
     * @var string
     */
    protected string $rootName = 'root';

    /**
     * Item nodes name
     * @var string
     */
    protected string $itemName = 'item';

    /**
     * Root namespaces, attributes, etc.
     * @var array
     */
    protected array $rootAttributes = [];

    /**
     * Document items
     * @var array[]
     */
    protected array $docItems = [[]];

    /**
     * Create a ready DOMDocument instance.
     * Start implementation with method "makeRoot".
     *
     * @return DOMDocument
     */
    abstract public function create(): DOMDocument;

    /**
     * Create root node
     *
     * @param DOMDocument $dom
     *
     * @return DOMElement|false
     * @throws DOMException
     */
    public function makeRoot(DOMDocument $dom)
    {
        $rootName = $this->getRootName();
        $root = $dom->createElement($rootName);
        $attributes = $this->getRootAttributes();

        foreach ($attributes as $key => $value) {
            $root->setAttribute($key, $value);
        }

        return $root;
    }

    /**
     * Create nested nodes
     *
     * @param string $localName
     * @param array $items
     * @param DOMDocument $dom
     *
     * @return DOMElement|false
     * @throws DOMException
     */
    public function makeNestedNodes(
        string      $localName,
        array       $items,
        DOMDocument $dom
    )
    {
        $node = $dom->createElement($localName);

        foreach ($items as $key => $value) {
            if (is_array($value)) {
                $nest = $dom->createElement($key);

                foreach ($value as $k => $v) {
                    $inner = $dom->createElement($k, $v);
                    $nest->appendChild($inner);
                }
            } else {
                $nest = $dom->createElement($key, $value);
            }

            $node->appendChild($nest);
        }

        return $node;
    }

    /**
     * Start document
     *
     * @return DOMDocument
     */
    public function getDOMDocument(): DOMDocument
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->formatOutput = $this->pretty;

        return $dom;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public function getRootName(): string
    {
        return $this->rootName;
    }

    /**
     * @codeCoverageIgnore
     * @param string $rootName
     * @return $this
     */
    public function setRootName(string $rootName): AbstractMaker
    {
        $this->rootName = $rootName;
        return $this;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     * @codeCoverageIgnore
     * @param string $itemName
     * @return $this
     */
    public function setItemName(string $itemName): AbstractMaker
    {
        $this->itemName = $itemName;
        return $this;
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getRootAttributes(): array
    {
        return $this->rootAttributes;
    }

    /**
     * @codeCoverageIgnore
     * @param array $rootAttributes
     * @return $this
     */
    public function setRootAttributes(array $rootAttributes): AbstractMaker
    {
        $this->rootAttributes = $rootAttributes;
        return $this;
    }

    /**
     * @codeCoverageIgnore
     * @return array[]
     */
    public function getDocItems(): array
    {
        return $this->docItems;
    }

    /**
     * @codeCoverageIgnore
     * @param array $docItems
     * @return $this
     */
    public function setDocItems(array $docItems): AbstractMaker
    {
        $this->docItems = $docItems;
        return $this;
    }
}
