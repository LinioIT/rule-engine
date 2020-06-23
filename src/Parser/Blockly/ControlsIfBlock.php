<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser\Blockly;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Ast\IfControlNode;
use Linio\Component\RuleEngine\Ast\IfElseControlNode;
use Linio\Component\RuleEngine\Ast\Node;
use Linio\Component\RuleEngine\Ast\StackedExpressionNode;
use SimpleXMLElement;

class ControlsIfBlock extends Block
{
    public function getType(): string
    {
        return 'controls_if';
    }

    public function getNode(CompileNode $root, SimpleXMLElement $block): Node
    {
        $conditionalExpressions = [];
        $elseStatement = null;

        for ($i = 0; $i <= $block->statement->count() - 1; $i++) {
            if (!isset($block->value[$i])) {
                $elseStatement = $this->parser->getNodeFromBlockXml($root, $block->statement[$i]);

                continue;
            }

            $node = new IfControlNode($this->parser->getNodeFromBlockXml($root, $block->value[$i]), $this->parser->getNodeFromBlockXml($root, $block->statement[$i]));
            $node->setRoot($root);
            $conditionalExpressions[] = $node;
        }

        $node = new IfElseControlNode($conditionalExpressions, $elseStatement);
        $node->setRoot($root);
        $stack[] = $node;

        if (isset($block->next)) {
            $stack[] = $this->parser->getNodeFromBlockXml($root, $block->next);
        }

        return new StackedExpressionNode($stack);
    }
}
