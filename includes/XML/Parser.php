<?php
class XML_Parser {
  protected $dom;
  protected $parsed_dom;
  protected $parsed_timestamps;
  protected $timezone;
  

  public function __construct(\DOMDocument $document) {
    $this->dom = $document;
    $this->parsed_dom = clone $this->dom;
    $this->parsed_timestamps = $this->parsed_dom->createElement('timestamps');
  }
  
  public function setTimeZone($timezone) {
    //TODO handle exception.
    $this->timezone = new DateTimeZone($timezone);
  }
  
  public function parseXML($file) {
    if($this->dom->load($file)) {
      $timestamps = $this->dom->getElementsByTagName('timestamp');
      $attributes = array();
      foreach ($timestamps as $timestamp) {
        $attributes[$timestamp->getAttribute('time')] = $timestamp->getAttribute('text');
      }
      krsort($attributes);
      $timezone = new DateTimeZone('PST');
      foreach ($attributes as $time => $text) {
        $date = new DateTime($text, $timezone);
        $timestamp = $this->parsed_dom->createElement('timestamp');
        
        $timestamp->setAttribute( "time", $date->format('U'));
        $timestamp->setAttribute( "text", $date->format('Y-m-d H:i:s'));
        $this->parsed_timestamps->appendChild($timestamp);
      }
      $this->parsed_dom->appendChild($this->parsed_timestamps);
      $this->parsed_dom->save("/tmp/secretsales_parsed.xml");
      echo'Saved file to /tmp/secretsales.xml';
    }
    
  }
  
  
}