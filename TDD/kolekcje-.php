<?php
  class Document
  {
    /**
     *  @return DocumentPosition[]
    */
    function getPositions();
  }

  class DocumentPosition
  {
    /**
     *  @return Document 
    */
    function getDocument();
  }
