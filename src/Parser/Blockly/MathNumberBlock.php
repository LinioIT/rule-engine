<?php

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\ScalarNode;

class MathNumberBlock extends Block
{
    public function getType()
    {
        return 'math_number';
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($root, \SimpleXmlElement $block)
    {
        $node = new ScalarNode((string) $block->field);
        $node->setRoot($root);

        return $node;
    }
}
