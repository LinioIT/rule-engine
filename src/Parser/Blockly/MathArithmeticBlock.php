<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Ast\MathOperationNode;
use Linio\Component\RuleEngine\Ast\Node;
use SimpleXMLElement;

class MathArithmeticBlock extends Block
{
    public function getType(): string
    {
        return 'math_arithmetic';
    }

    public function getNode(CompileNode $root, SimpleXMLElement $block): Node
    {
        $node = new MathOperationNode(
            (string) $block->field,
            $this->parser->getNodeFromBlockXml($root, $block->value[0]),
            $this->parser->getNodeFromBlockXml($root, $block->value[1])
        );
        $node->setRoot($root);

        return $node;
    }
}
