<?php declare(strict_types = 1);

   class User
   {
      private $id;
      private $userName;
      private $password;
      private $email;
      private $registrationDate;
      private $active;
      private $role;
      private $lastLogin; // TODO: change in DB from last_online to last_login
      private $db;

      public function __construct()
      {
         $this->db = new Database();
      }

      public function getUsers()
      {
         $this->db->query("SELECT * FROM user");
         $result = $this->db->resultSet();
         return $result;
      }

   }