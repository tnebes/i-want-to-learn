<?php declare(strict_types = 1);

   class User
   {
      // Attributes
      private $id;
      private $username;
      private $email;
      private $password;
      private $registrationDate;
      private $active;
      private $role;
      private $lastLogin;
      private $banned;

      // getters and setters
      public function getId(): int
      {
         return $this->id;
      }
      public function setId(int $id): void
      {
         $this->id = $id;
      }
      public function getUsername(): string
      {
         return $this->username;
      }
      public function setUsername(string $username): void
      {
         $this->username = $username;
      }
      public function getEmail(): string
      {
         return $this->email;
      }
      public function setEmail(string $email): void
      {
         $this->email = $email;
      }
      public function getPassword(): string
      {
         return $this->password;
      }
      public function setPassword(string $password): void
      {
         $this->password = $password;
      }
      public function getRegistrationDate(): DateTime
      {
         return $this->registrationDate;
      }
      public function setRegistrationDate(DateTime $registrationDate): void
      {
         $this->registrationDate = $registrationDate;
      }
      public function isActive(): bool
      {
         return $this->active;
      }
      public function setActive(bool $active): void
      {
         $this->active = $active;
      }
      public function getLastLogin(): DateTime
      {
         return $this->lastLogin;
      }
      public function setLastLogin(DateTime $lastLogin): void
      {
         $this->lastLogin = $lastLogin;
      }
      public function getRole()
      {
            return $this->role;
      }
      public function setRole($role)
      {
            $this->role = $role;

            return $this;
      }
      public function isBanned()
      {
            return $this->banned;
      }
      public function setBanned($banned)
      {
            $this->banned = $banned;

            return $this;
      }
   }

?>