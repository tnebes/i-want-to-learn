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

      public function register(array $data) : bool
      {
         $this->db->query('INSERT INTO user (username, password, email)
            VALUES (:username, :password, :email)');
         $this->db->bind(':username', $data['username']);
         $this->db->bind(':email', $data['email']);
         $this->db->bind(':password', $data['password']);

         if ($this->db->execute())
         {
            return true;
         }
         else
         {
            return false;
         }
      }

      public function getUsers()
      {
         $this->db->query("SELECT * FROM user");
         $result = $this->db->resultSet();
         return $result;
      }

      public function findUserByEmail(string $email) : bool
      {
         $this->db->query("SELECT * FROM user WHERE email = :email");
         $this->db->bind(":email", $email);
         if ($this->db->rowCount() > 0)
         {
            return true;
         }
         return false;
      }

   }