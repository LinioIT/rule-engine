<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\GetVariableExpressionNode;

class VariablesGetBlock extends Block
{
    public function getType()
    {
        return 'variables_get';
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($root, \SimpleXMLElement $block)
    {
        $node = new GetVariableExpressionNode((string) $block->field);
        $node->setRoot($root);

        return $node;
    }
}
