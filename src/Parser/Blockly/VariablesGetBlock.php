<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Ast\GetVariableExpressionNode;
use Linio\Component\RuleEngine\Ast\Node;
use SimpleXMLElement;

class VariablesGetBlock extends Block
{
    public function getType(): string
    {
        return 'variables_get';
    }

    public function getNode(CompileNode $root, SimpleXMLElement $block): Node
    {
        $node = new GetVariableExpressionNode((string) $block->field);
        $node->setRoot($root);

        return $node;
    }
}
