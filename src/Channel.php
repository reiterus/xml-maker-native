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
 * Generate RSS channel
 *
 * @package Reiterus\XmlMaker
 * @author Pavel Vasin <reiterus@yandex.ru>
 */
class Channel extends AbstractMaker
{
    /**
     * Document root node name
     *
     * @var string
     */
    protected string $rootName = 'rss';

    /**
     * Item nodes name
     * @var string
     */
    protected string $itemName = 'item';

    /**
     * Channel node name
     * @var string
     */
    protected string $channelName = 'channel';

    /**
     * Channel properties: title, link, etc
     * @var array
     */
    protected array $channelProperties = [];

    /**
     * Create channel document
     *
     * @return DOMDocument
     * @throws DOMException
     */
    public function create(): DOMDocument
    {
        $dom = $this->getDOMDocument();
        $root = $this->makeRoot($dom);

        $channel = $this->makeNodeChannel($dom);

        $itemName = $this->getItemName();
        $items = $this->getDocItems();

        foreach ($items as $item) {
            $node = $this->makeNestedNodes($itemName, $item, $dom);
            $channel->appendChild($node);
        }

        $root->appendChild($channel);
        $dom->appendChild($root);

        return $dom;
    }

    /**
     * Get channel node
     *
     * @param DOMDocument $dom
     *
     * @return DOMElement|false
     * @throws DOMException
     */
    protected function makeNodeChannel(DOMDocument $dom)
    {
        $nameChannel = $this->getChannelName();
        $channel = $dom->createElement($nameChannel);

        foreach ($this->getChannelProperties() as $key => $value) {
            if (is_array($value)) {
                $node = $this->makeNestedNodes($key, $value, $dom);
            } else {
                $node = $dom->createElement($key, $value);
            }

            $channel->appendChild($node);
        }

        return $channel;
    }

    /**
     * @return string
     */
    public function getChannelName(): string
    {
        return $this->channelName;
    }

    /**
     * @param string $channelName
     * @return $this
     */
    public function setChannelName(string $channelName): Channel
    {
        $this->channelName = $channelName;
        return $this;
    }

    /**
     * @return array
     */
    public function getChannelProperties(): array
    {
        return $this->channelProperties;
    }

    /**
     * @param array $channelProperties
     * @return $this
     */
    public function setChannelProperties(array $channelProperties): Channel
    {
        $this->channelProperties = $channelProperties;
        return $this;
    }
}
