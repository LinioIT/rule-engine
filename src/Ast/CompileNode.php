<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use Linio\Type\Dictionary;

class CompileNode
{
    /**
     * @var array
     */
    protected $children;

    /**
     * @var Dictionary
     */
    protected $context;

    public function __construct()
    {
        $this->context = new Dictionary();
    }

    /**
     * @return Node[]
     */
    public function getChildren()
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

    /**
     * @return Dictionary
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param Dictionary $context
     */
    public function setContext($context): void
    {
        $this->context = $context;
    }

    public function evaluate(): void
    {
        foreach ($this->children as $child) {
            $child->evaluate();
        }
    }
}
