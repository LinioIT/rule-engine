<?php

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
    public function setChildren(array $children)
    {
        $this->children = $children;
    }

    /**
     * @param Node $node
     */
    public function addChild(Node $node)
    {
        $this->children[] = $node;
    }

    /**
     * @param Node[] $nodes
     */
    public function addChildren(array $nodes)
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
    public function setContext($context)
    {
        $this->context = $context;
    }

    public function evaluate()
    {
        foreach ($this->children as $child) {
            $child->evaluate();
        }
    }
}
