<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Parser\ParserInterface;
use Linio\Type\Dictionary;

class Interpreter
{
    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @param string $inputString
     *
     * @return CompileNode
     */
    public function parse($inputString)
    {
        return $this->parser->parse($inputString);
    }

    /**
     * @param string     $inputString
     */
    public function evaluate($inputString, Dictionary $context)
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
