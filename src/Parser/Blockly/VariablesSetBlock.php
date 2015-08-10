<?php

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
    public function getNode($root, \SimpleXmlElement $block)
    {
        $node = new SetVariableExpressionNode((string) $block->field, $this->parser->getNodeFromBlockXml($root, $block->value));
        $node->setRoot($root);

        return $node;
    }
}
