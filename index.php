<?php

include_once(__DIR__ . '/includes/XML/Builder.php');
include_once(__DIR__ . '/includes/XML/Parser.php');
if (isset($argv[1]) && $argv[1] == 'build') {
  $xml_builder = new XML_Builder(new \DOMDocument('1.0', 'UTF-8'));
  $xml_builder->buildXML();
}
else if (isset($argv[1]) && $argv[1] == 'parse') {
  $xml_parser = new XML_Parser(new \DOMDocument('1.0', 'UTF-8'));
  
  $xml_parser->parseXML('/tmp/secretsales.xml');
}



/*
namespace SecretSalesTest;





class XML {
  
  protected $xml;
  
  public function __construct(DOMDocument $document) {
    // get 
  }
  
  public function buildXML(DOMDocument $document) {
    $this->xml = $document;
  }
  
}
*/
