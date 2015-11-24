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


  interface IInvoiceCommiterDao{
    function getInvoice($invoice_id);
    function saveInvoice($invoice);
    function getCommiter();
  }


  class InvoiceCommiterDao {
    function __construct(IDocumetDao $documentDao, IUserDao $userDao)
    {
      $this->documentDao = $documentDao;
      $this->userDao = userDao;
    }
    function getInvoice($invoice_id){
      return $this->documentDao->getDocument($invoice_id);
    }
    function saveInvoice($invoice){
      $this->documentDao->updateDocument($invoice);
    }
    function getCommiter(){
      return $this->userDao->getCurrentLoggedUser();
    }
  }

  class InvoiceCommiter {
    function __construct(IInvoiceCommiterDao $invoiceCommiterDao)
    {
      $this->invoiceCommiterDao = $invoiceCommiterDao;
    }

    function Commit($invoice_id)
    {
      $invoice = $this->invoiceCommiterDao->getInvoice($invoice_id);
      $invoice->commiter = $this->invoiceCommiterDao->getCommiter();
      $invoice->is_commited = true;
      $this->invoiceCommiterDao->saveInvoice($invoice);
    }
  }
