<?php

declare(strict_types=1);

namespace Linio\Component\RuleEngine\Parser;

use Linio\Component\RuleEngine\Ast\CompileNode;
use Linio\Component\RuleEngine\Ast\Node;
use SimpleXMLElement;

interface ParserInterface
{
    public function parse(string $inputString): CompileNode;

    public function getNodeFromBlockXml(CompileNode $root, SimpleXMLElement $element): Node;
}
