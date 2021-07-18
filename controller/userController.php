<?php declare(strict_types = 1);

   class userController extends BaseController
   {
      public function __construct(?stdClass $entity)
      {
         $this->setEntity($entity);
      }

      // implement protected methods 
      
      public function getData() : array
      {
         return [];
      }

      public function create() : void
      {
         // empty
      }

      public function delete() : void
      {
         //empty
      }

      public function update() : void
      {
         //empty
      }
      
   }