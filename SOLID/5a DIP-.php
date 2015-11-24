<?php
  interface IDocumentDao {
    function createDocument($document);
    function readDocument($document_id);
    function updateDocument($document);
    function deleteDocument($document);
  }

  interface IUserDao {
    function getCurrentLoggedUser();
    function createUser($user);
    function readDocument($document_id);
    function updateDocument($document);
    function deleteDocument($document);
  }

  class InvoiceCommiter {
    function __construct(IDocumetDao $documentDao, IUserDao $userDao)
    {
      $this->documentDao = $documentDao;
      $this->userDao = userDao;
    }

    function Commit($invoice_id)
    {
      $invoice = $this->documentDao->getDocument($invoice_id);
      $invoice->commiter = $this->userDao->getCurrentLoggedUser();
      $invoice->is_commited = true;
      $this->documentDao->updateDocument($invoice);
    }
  }
