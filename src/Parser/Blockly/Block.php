<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Parser\ParserInterface;

abstract class Block
{
    /**
     * @var ParserInterface
     */
    protected $parser;

    public function setParser(ParserInterface $parser): void
    {
        $this->parser = $parser;
    }

    abstract public function getNode($root, \SimpleXMLElement $block);

    /**
     * @return string
     */
    abstract public function getType();
}
