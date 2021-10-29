<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=50)
     */
    private $nsc;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Classroom::class, inversedBy="students")
     */
    private $classroom;

    

    public function getNsc(): ?string
    {
        return $this->nsc;
    }

    public function setNsc(string $nsc): self
    {
        $this->nsc = $nsc;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClassroom(): ?classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }
}
