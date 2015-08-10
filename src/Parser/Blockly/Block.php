<?php

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Parser\ParserInterface;

abstract class Block
{
    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @param ParserInterface $parser
     */
    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param mixed             $root
     * @param \SimpleXmlElement $block
     */
    abstract public function getNode($root, \SimpleXmlElement $block);

    /**
     * @return string
     */
    abstract public function getType();
}
