<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\LogicalOperationNode;

class LogicOperationBlock extends Block
{
    public function getType()
    {
        return 'logic_operation';
    }

    /**
     * {@inheritdoc}
     */
    public function getNode($root, \SimpleXmlElement $block)
    {
        $node = new LogicalOperationNode(
            (string) $block->field,
            $this->parser->getNodeFromBlockXml($root, $block->value[0]),
            $this->parser->getNodeFromBlockXml($root, $block->value[1])
        );
        $node->setRoot($root);

        return $node;
    }
}
