<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\SetVariableExpressionNode;

class VariablesSetBlock extends Block
{
    public function getType()
    {
        return 'variables_set';
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($root, \SimpleXMLElement $block)
    {
        $node = new SetVariableExpressionNode((string) $block->field, $this->parser->getNodeFromBlockXml($root, $block->value));
        $node->setRoot($root);

        return $node;
    }
}
