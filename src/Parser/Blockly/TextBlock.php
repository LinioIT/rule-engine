<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\ScalarNode;

class TextBlock extends Block
{
    public function getType()
    {
        return 'text';
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
