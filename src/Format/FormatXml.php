<?php

namespace App\Format;

class FormatXml extends FormatData
{
  public function formatData()
  {
    header("Content-Type: application/xml; charset=UTF-8");

    $this->xml_data = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');
    $this->arrayToXml($this->data, $this->xml_data);
    return $this->xml_data->asXML();
  }

  private function arrayToXml($data, $xml_data)
  {
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $key = is_numeric($key) ? 'item' . $key : $key;
        $sub_node = $xml_data->addChild($key);
        $this->arrayToXml($value, $sub_node);
      } else {
        $key = is_numeric($key) ? 'item' . $key : $key;
        $xml_data->addChild("$key", htmlspecialchars("$value"));
      }
    }
  }
}

