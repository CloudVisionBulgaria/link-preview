<?php

namespace LinkPreview\Reader;

use Guzzle\Http\Client;
use LinkPreview\Model\LinkInterface;

class GeneralReader implements ReaderInterface
{
    /**
     * @inheritdoc
     */
    private $link;

    /**
     * @inheritdoc
     */
    public function setLink(LinkInterface $link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @inheritdoc
     */
    public function readLink()
    {
        $link = $this->getLink();

        $client = new Client($link->getUrl());
        $response = $client->get()->send();

        $link->setContent($response->getBody(true))
            ->setContentType($response->getContentType())
            ->setRealUrl($response->getEffectiveUrl());

        return $this;
    }
} 