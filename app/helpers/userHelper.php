<?php declare(strict_types=1);
   function getActionsOnUser(int $id): string
   {
      // echo icon with link to the deletion page
      $returnString = '<a href="' . URLROOT . '/users/profile/' . $id . '"><img id="user-profile" src=' . URLROOT . '/images/icons/fi-magnifying-glass.svg></a>';
      $returnString .= '<a href="' . URLROOT . '/users/update/' . $id . '"><img id="user-update" src=' . URLROOT . '/images/icons/fi-wrench.svg></a>';
      $returnString .= '<a href="' . URLROOT . '/users/delete/' . $id . '"><img id="user-delete" src=' . URLROOT . '/images/icons/fi-minus.svg></a>';
      $returnString .= '<a href="' . URLROOT . '/users/ban/' . $id . '"><img id="user-ban" src=' . URLROOT . '/images/icons/fi-prohibited.svg></a>';
      return $returnString;
   }
