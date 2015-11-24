<?php
  interface IDocument
  {
    /**
     *  @return IDocumentPosition
    */
    function getPosition($index);
    /**
     *  @return int
    */
    function count { get; }
    function addPosition(IDocumentPosition position);
    function removePosition(IDocumentPosition position);
  }

  interface IDocumentPosition
  {
    /**
     *  @return IDocument
    */
    function Document { get; }
  }
