<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Ast\Node;
use Linio\Component\RuleEngine\Ast\SetVariableExpressionNode;
use SimpleXMLElement;

class VariablesSetBlock extends Block
{
    public function getType(): string
    {
        return 'variables_set';
    }

    public function getNode(CompileNode $root, SimpleXMLElement $block): Node
    {
        $node = new SetVariableExpressionNode((string) $block->field, $this->parser->getNodeFromBlockXml($root, $block->value));
        $node->setRoot($root);

        return $node;
    }
}
