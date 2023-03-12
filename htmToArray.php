<?php

class HtmlArray
{
    private $htmlData;

    public function __construct($html)
    {
        $this->htmlData = $html;
    }

    public function getArray($html = null)
    {
        if ($html) {
            $this->htmlData = $html;
        } else {
            $html = $this->htmlData;
        }

        $dom = new DOMDocument;

        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);

        return $this->xmlToArray($dom->documentElement);
    }

    private function xmlToArray($node)
    {
        $result = [];

        if ($node->hasChildNodes()) {
            $children = $node->childNodes;

            foreach ($children as $child) {
                $attributes = null;
                if ($child->hasAttributes()) {
                    $attributes = [];

                    foreach ($child->attributes as $attr) {
                        $attributes[$attr->name] = $attr->value;
                    }
                }

                $data = null;
                if ($child->nodeType == XML_TEXT_NODE || $child->nodeType == XML_CDATA_SECTION_NODE) {
                    $data = trim($child->nodeValue);
                }

                $childrenArray = null;
                if ($child->hasChildNodes()) {
                    $childrenArray = $this->xmlToArray($child);
                }

                $item = [
                    'tagName' => $child->nodeName,
                    'attributes' => $attributes,
                    'data' => $data,
                    'children' => $childrenArray
                ];

                $result[] = $item;
            }
        }

        return $result;
    }
}

$html = '<div class="example"><h1>Title</h1><p>Some text</p></div>';
$htmlArray = new HtmlArray($html);
$array = $htmlArray->getArray();

print_r($array);


?>
