<?php

require 'vendor/autoload.php';
use PhpParser\Node;
use PhpParser\Comment;
use PhpParser\Serializer;

class AstToJson implements Serializer
{
    public function serialize(array $nodes) {
        $res = $this->_serialize($nodes);
        return $res; 
    }

    protected function _serialize($node) {
        if ($node instanceof Node) { 
            $data = [];
            foreach ($node->getAttributes() as $name => $value) {
                $data[$name] = $this->_serialize($value);
            }

            $data["children"] = [];
            foreach ($node as $name => $subNode) {
                $data["children"][] = ["type" => $name, "value" => $this->_serialize($subNode)];
            }

            return $data;
        } elseif ($node instanceof Comment) {
            return ["type" => "Comment", "value" => $node->getText()];
        } elseif (is_array($node)) {
            $items = [];
            foreach ($node as $subNode) {
                $items[] = $this->_serialize($subNode);
            }
            return $items;
        } elseif (is_string($node)) {
            return ["type" => 'string', "value" => $node];
        } elseif (is_int($node)) {
            return ["type" => 'int', "value" =>(string) $node];
        } elseif (is_float($node)) {
            return ["type" => 'float', "value" => (string) $node];
        } elseif (true === $node) {
            return ["type" => 'true'];
        } elseif (false === $node) {
            return ["type" => 'false'];
        } elseif (null === $node) {
            return ["type" => 'null'];
        } else {
            throw new \InvalidArgumentException('Unexpected node type');
        } 
    }
}

$parser = new PhpParser\Parser(new PhpParser\Lexer);
$code = stream_get_contents(STDIN);
$ast = $parser->parse($code);
$serializer = new AstToJson;

echo json_encode($serializer->serialize($ast));
