<?php
// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass:"App\Repository\UserRepository")]
 
class User
{
    
     #[ORM\Id]
     #[ORM\GeneratedValue]
     #[ORM\Column(type:"integer")]
     
    public $id;

    #[ORM\Column(type:"string", length:100)]
     
    public $name;

    #[ORM\Column(type:"string", length:100)]

    public $job;

    
     #[ORM\Column(type:"string", length:100)]
     
    public $email;

    
     #[ORM\Column(type:"string", length:20)]
     
    public $phoneNumber;

    // Getters and setters...
}
