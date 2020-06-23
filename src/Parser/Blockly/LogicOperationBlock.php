<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Ast\LogicalOperationNode;
use Linio\Component\RuleEngine\Ast\Node;
use SimpleXMLElement;

class LogicOperationBlock extends Block
{
    public function getType(): string
    {
        return 'logic_operation';
    }

    public function getNode(CompileNode $root, SimpleXMLElement $block): Node
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
