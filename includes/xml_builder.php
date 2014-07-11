<?php

class XML_Builder {
  protected $dom;
  protected $epoch_date;
  protected $current_date;
  protected $interval;
  
  public function __construct(\DOMDocument $document) {
    $this->dom = $document;
    $timestamps = $this->dom->createElement('timestamps');
    $timezone = new DateTimeZone('GMT');
    // Initialise to 30th of June 1970
    $this->date = new DateTime('1970-06-30 13:00:00', $timezone);
    $this->current_date = new DateTime(NULL, $timezone);
    $this->interval = new DateInterval('P1Y');
    while ($this->date->format('U') < $this->current_date->format('U')) {
      $timestamp = $this->dom->createElement('timestamp');
      $timestamp->setAttribute( "time", $this->date->format('U'));
      $timestamp->setAttribute( "text", $this->date->format('Y-m-d H:i:s'));
      $timestamps->appendChild($timestamp);
      //$this->date->format('Y-m-d') ."\n";
      $this->date->add($this->interval);
    }
    $this->dom->appendChild($timestamps);
    $this->dom->save("/tmp/secretsales.xml");
    echo'Saved file to /tmp/secretsales.xml';
  }
  

}