<?php 

namespace App\Entity;

class DemandeConge {

    private int $Id;
    private string $Date_Debut;
    private string $Date_Fin;
    private string $Comment;
    private string $Valide;
    private int $Type_Id;
    private string $Label_Type;
    private int $User_Id;
    private string $Nom;
    
    public function __construct(int $Id, string $Date_Debut, string $Date_Fin, string $Comment, string $Valide, int $Type_Id, string $Label_Type, int $User_Id, string $Nom) 
    {
        $this->Id = $Id;
        $this->Date_Debut = $Date_Debut;
        $this->Date_Fin = $Date_Fin;
        $this->Comment = $Comment;
        $this->Valide = $Valide;
        $this->Type_Id = $Type_Id;
        $this->Label_Type = $Label_Type;
        $this->User_Id = $User_Id;
        $this->Nom=$Nom;

    }

    /**
     * Get the value of Id
     */
    public function getId(): int
    {
        return $this->Id;
    }

    /**
     * Set the value of Id
     */
    public function setId(int $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    /**
     * Get the value of Date_Debut
     */
    public function getDateDebut(): string
    {
        return $this->Date_Debut;
    }

    /**
     * Set the value of Date_Debut
     */
    public function setDateDebut(string $Date_Debut): self
    {
        $this->Date_Debut = $Date_Debut;

        return $this;
    }
    /**
     * Get the value of Date_Fin
     */
    public function getDateFin(): string
    {
        return $this->Date_Fin;
    }

    /**
     * Set the value of Date_Fin
     */
    public function setDateFin(string $Date_Fin): self
    {
        $this->Date_Fin = $Date_Fin;

        return $this;
    }

    /**
     * Get the value of Comment
     */
    public function getComment(): string
    {
        return $this->Comment;
    }

    /**
     * Set the value of Comment
     */
    public function setComment(string $Comment): self
    {
        $this->Comment = $Comment;

        return $this;
    }

    /**
     * Get the value of Valide
     */
    public function getValide(): string
    {
        return $this->Valide;
    }

    /**
     * Set the value of Valide
     */
    public function setValide(string $Valide): self
    {
        $this->Valide = $Valide;

        return $this;
    }

    

    /**
     * Get the value of Type_Id
     */
    public function getTypeId(): int
    {
        return $this->Type_Id;
    }

    /**
     * Set the value of Type_Id
     */
    public function setTypeId(int $Type_Id): self
    {
        $this->Type_Id = $Type_Id;

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
     * Get the value of User_Id
     */
    public function getUserId(): int
    {
        return $this->User_Id;
    }

    /**
     * Set the value of User_Id
     */
    public function setUserId(int $User_Id): self
    {
        $this->User_Id = $User_Id;

        return $this;
    }

    /**
     * Get the value of Nom
     */
    public function getNom(): string
    {
        return $this->Nom;
    }

    /**
     * Set the value of Nom
     */
    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }
}