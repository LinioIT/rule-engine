<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use Linio\Common\Type\Dictionary;

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

    public function setRoot(CompileNode $root): void
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
