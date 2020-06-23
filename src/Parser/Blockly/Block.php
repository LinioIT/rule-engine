<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Ast\Node;
use Linio\Component\RuleEngine\Parser\ParserInterface;
use SimpleXMLElement;

abstract class Block
{
    protected ?ParserInterface $parser;

    public function setParser(ParserInterface $parser): void
    {
        $this->parser = $parser;
    }

    abstract public function getNode(CompileNode $root, SimpleXMLElement $block): Node;

    abstract public function getType(): string;
}
