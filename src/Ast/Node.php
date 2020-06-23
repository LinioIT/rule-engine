<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Ast;

use Linio\Common\Type\Dictionary;

abstract class Node
{
    protected CompileNode $root;

    public function getRoot(): CompileNode
    {
        return $this->root;
    }

    public function setRoot(CompileNode $root): void
    {
        $this->root = $root;
    }

    public function getContext(): Dictionary
    {
        return $this->root->getContext();
    }

    abstract public function evaluate();
}
