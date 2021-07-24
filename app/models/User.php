<?php declare(strict_types = 1);

   class User
   {
      public $id;
      public $username;
      public $password;
      public $email;
      public $registrationDate;
      public $role;
      public $lastLogin;
      public $banned;
      public $dateBanned;
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

      public function login(string $username, string $password)
      {
         $this->db->query('SELECT * FROM user WHERE username = :username');
         $this->db->bind(':username', $username);
         $row = $this->db->single();

         if ($row == null)
         {
            return null;
         }
         if ($row->banned)
         {
            return null;
         }
         
         $hashedPassword = $row->password;
         if (password_verify($password, $hashedPassword))
         {
            return $row;
         }
         else
         {
            return null;
         }
      }

      public function getUsersPrivate() : array
      {
         $this->db->query("SELECT " . PRIVATE_SQL_DATA . " FROM user");
         $result = $this->db->resultSet();
         return $result;
      }

      public function getUsersPublic() : array
      {
         $this->db->query("SELECT " . PUBLIC_SQL_DATA . " FROM user");
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

      public function getSingleUserById(int $id) : stdClass
      {
         $this->db->query("SELECT " . PRIVATE_SQL_DATA . " FROM user WHERE id = :id");
         $this->db->bind(":id", $id);
         $result = $this->db->single();
         return $result;
      }

   }