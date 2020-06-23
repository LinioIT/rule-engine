<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine;

use Linio\Common\Type\Dictionary;
use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Parser\ParserInterface;

class Interpreter
{
    protected ?ParserInterface $parser;

    public function parse(string $inputString): CompileNode
    {
        return $this->parser->parse($inputString);
    }

    public function evaluate(string $inputString, Dictionary $context)
    {
        $node = $this->parser->parse($inputString);
        $node->setContext($context);

        return $node->evaluate();
    }

    public function setParser(ParserInterface $parser): void
    {
        $this->parser = $parser;
    }
}
