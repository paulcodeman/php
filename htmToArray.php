<?php

class htmlArray
{
    private $htmlData;

    function __construct ($html)
    {
        $this->htmlData = $html;
    }

    public function getArray ($html = null)
    {
        if ($html) {
            $this->htmlData = $html;
        } else {
            $html = $this->htmlData;
        }

        $dom = new DOMDocument;

        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);

        return $this->xml_to_array($dom->documentElement);
    }

    private function xml_to_array ($root)
    {
        $result = array();

        if ($root->hasChildNodes()) {
            $children = $root->childNodes;
            foreach ($children as $child) {
                $attributes = null;
                if ($child->hasAttributes()) {
                    $attributes = [];
                    $attrs = $child->attributes;
                    foreach ($attrs as $attr) {
                        $attributes[$attr->name] = $attr->value;
                    }
                }
                $data = null;
                if ($child->nodeType == XML_TEXT_NODE) {
                    $data = trim($child->nodeValue);
                } elseif ($child->nodeType == XML_CDATA_SECTION_NODE) {
                    $data = trim($child->nodeValue);
                }

                $children = null;
                if ($child->hasChildNodes()) {
                    $children = $this->xml_to_array($child);
                }
                $item = [
                    'tagName' => $child->nodeName
                ];
                if ($attributes) $item['attributes'] = $attributes;
                if (@strlen($data)) $item['data'] = $data;
                if ($children) $item['children'] = $children;
                $result[] = $item;
            }
        }

        return $result;
    }
}

?>
