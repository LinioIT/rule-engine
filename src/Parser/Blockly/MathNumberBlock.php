<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Ast\Node;
use Linio\Component\RuleEngine\Ast\ScalarNode;
use SimpleXMLElement;

class MathNumberBlock extends Block
{
    public function getType(): string
    {
        return 'math_number';
    }

    public function getNode(CompileNode $root, SimpleXMLElement $block): Node
    {
        $node = new ScalarNode((string) $block->field);
        $node->setRoot($root);

        return $node;
    }
}
