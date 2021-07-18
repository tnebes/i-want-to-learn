<?php declare(strict_types=1);

   // create a new controller class that will be a base for all controllers
   class BaseController
   {

      // protected methods that can be overridden by child classes
      protected function getData() {}
      protected function create() {}
      protected function delete() {}
      protected function update() {}

      // protected properties
      protected $entity;

      // the constructor
      public function __construct()
      {
         // nothing
      }

      // protected methods 
      public function getEntity() : ?stdClass
      {
         return $this->entity;
      }

      public function setEntity(?stdClass $entity)
      {
         $this->entity = $entity;
      }







   }
