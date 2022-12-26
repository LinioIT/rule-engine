<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use Linio\Common\Type\Dictionary;

class CompileNode
{
    /**
     * @var Node[]
     */
    protected array $children = [];
    protected Dictionary $context;

    public function __construct()
    {
        $this->context = new Dictionary();
    }

    /**
     * @return Node[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param Node[] $children
     */
    public function setChildren(array $children): void
    {
        $this->children = $children;
    }

    public function addChild(Node $node): void
    {
        $this->children[] = $node;
    }

    /**
     * @param Node[] $nodes
     */
    public function addChildren(array $nodes): void
    {
        $this->children = array_merge($this->children, $nodes);
    }

    public function getContext(): Dictionary
    {
        return $this->context;
    }

    public function setContext(Dictionary $context): void
    {
        $this->context = $context;
    }

    public function evaluate(): mixed
    {
        foreach ($this->children as $child) {
            $child->evaluate();
        }

        return null;
    }
}
