<?php 

namespace App\Entity;

class Profil {
    private int $id;
    private string $role;

    public function __construct(int $id, string $role) {
    $this->id = $id;
    $this->role = $role;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Libell
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set the value of Libell
     */
    public function setRole(string $role): self
    {
        $this->Libell = $role;

        return $this;
    }
}

