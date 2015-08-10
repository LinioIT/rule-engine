<?php

namespace Linio\Component\RuleEngine\Parser;

use Linio\Component\RuleEngine\Ast\CompileNode;

interface ParserInterface
{
    /**
     * @param string $inputString
     *
     * @return CompileNode
     */
    public function parse($inputString);
}
