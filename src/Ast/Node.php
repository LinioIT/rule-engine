<?php

namespace Linio\Component\RuleEngine\Ast;

abstract class Node
{
    /**
     * @var CompileNode
     */
    protected $root;

    /**
     * @return CompileNode
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param CompileNode $root
     */
    public function setRoot(CompileNode $root)
    {
        $this->root = $root;
    }

    /**
     * @return Dictionary
     */
    public function getContext()
    {
        return $this->root->getContext();
    }

    abstract public function evaluate();
}
