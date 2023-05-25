<?php 

namespace App\Entity;

class TypeConge {
    private int $id;
    private string $Label_Type;
    private string $Nbr_Jour;

    public function __construct(int $id, string $Label_Type, $Nbr_Jour) {
    $this->id = $id;
    $this->Label_Type = $Label_Type;
    $this->Nbr_Jour = $Nbr_Jour;
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
     * Get the value of Label_Type
     */
    public function getLabelType(): string
    {
        return $this->Label_Type;
    }

    /**
     * Set the value of Label_Type
     */
    public function setLabelType(string $Label_Type): self
    {
        $this->Label_Type = $Label_Type;

        return $this;
    }

    /**
     * Get the value of Nbr_Jour
     */
    public function getNbrJour(): string
    {
        return $this->Nbr_Jour;
    }

    /**
     * Set the value of Nbr_Jour
     */
    public function setNbrJour(string $Nbr_Jour): self
    {
        $this->Nbr_Jour = $Nbr_Jour;

        return $this;
    }
}