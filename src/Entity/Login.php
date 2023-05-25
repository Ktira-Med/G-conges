<?php 

namespace App\Entity;

class Login {

    private int $Id;
    private string $Nom;
    private string $Sexe;
    private string $Email;
    private string $M_passe;
    private string $GSM;
    private string $createdAt;
    private ?string $Date_MAJ;
    private ?string $CodeSS;
    private ?string $CNE;
    private ?string $Date_Integration;
    private ?string $Preavis;
    private ?string $Date_Depart;
    private ?string $profil;
    private ?string $role;
    
    public function __construct(int $Id, string $Nom, string $Sexe, string $Email, string $M_passe, string $GSM,  string $createdAt, 
    ?string $Date_MAJ, ?string $CodeSS, ?string $CNE, ?string $Date_Integration, ?string $Preavis, ?string $Date_Depart, ?string $profil,?string $role) {
        
        $this->Id = $Id;
        $this->Nom = $Nom;
        $this->Sexe = $Sexe;
        $this->Email = $Email;
        $this->M_passe = $M_passe;
        $this->GSM = $GSM;
        $this->createdAt = $createdAt;
        $this->Date_MAJ = $Date_MAJ;
        $this->CodeSS = $CodeSS;
        $this->CNE = $CNE;
        $this->Date_Integration =  $Date_Integration;
        $this->Preavis = $Preavis;
        $this->Date_Depart = $Date_Depart;
        $this->profil = $profil;
        $this->role=$role;
    }
    


    /**
     * Get the value of idUser
     */
    public function getIdUser(): int
    {
        return $this->Id;
    }

    /**
     * Set the value of idUser
     */
    public function setIdUser(int $Id): self
    {
        $this->Id = $Id;

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

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     */
    public function setCreatedAt(string $createdAt): self
    {
        if (is_string($createdAt)) {
            $createdAt = new string($createdAt);
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of Sexe
     */
    public function getSexe(): string
    {
        return $this->Sexe;
    }

    /**
     * Set the value of Sexe
     */
    public function setSexe(string $Sexe): self
    {
        $this->Sexe = $Sexe;

        return $this;
    }

    /**
     * Get the value of GSM
     */
    public function getGSM(): int
    {
        return $this->GSM;
    }

    /**
     * Set the value of GSM
     */
    public function setGSM(int $GSM): self
    {
        $this->GSM = $GSM;

        return $this;
    }

    /**
     * Get the value of Email
     */
    public function getEmail(): string
    {
        return $this->Email;
    }

    /**
     * Set the value of Email
     */
    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * Get the value of M_passe
     */
    public function getM_passe(): string
    {
        return $this->M_passe;
    }

    /**
     * Set the value of M_passe
     */
    public function setM_passe(string $M_passe): self
    {
        $this->M_passe = $M_passe;

        return $this;
    }

    /**
     * Get the value of CNE
     */
    public function getCNE(): ?string
    {
        return $this->CNE;
    }

    /**
     * Set the value of CNE
     */
    public function setCNE(?string $CNE): self
    {
        $this->CNE = $CNE;

        return $this;
    }

    /**
     * Get the value of CodeSS
     */
    public function getCodeSS(): ?string
    {
        return $this->CodeSS;
    }

    /**
     * Set the value of CodeSS
     */
    public function setCodeSS(?string $CodeSS): self
    {
        $this->CodeSS = $CodeSS;

        return $this;
    }

   
    /**
     * Get the value of Date_Depart
     */
    public function getDateDepart(): ?string
    {
        return $this->Date_Depart;
    }

    /**
     * Set the value of Date_Depart
     */
    public function setDateDepart(?string $Date_Depart): self
    {
        $this->Date_Depart = $Date_Depart;

        return $this;
    }

    /**
     * Get the value of Date_Integration
     */
    public function getDateIntegration(): ?string
    {

        return $this->Date_Integration;
    }

    /**
     * Set the value of Date_Integration
     */
    public function setDateIntegration(?string $Date_Integration): self
    {
        
        $this->Date_Integration = $Date_Integration;
        
        return $this;
    }


    /**
     * Get the value of Date_MAJ
     */
    public function getDateMAJ(): ?string
    {
        return $this->Date_MAJ;
    }

    /**
     * Set the value of Date_MAJ
     */
    public function setDateMAJ(?string $Date_MAJ): self
    {
        $this->Date_MAJ = $Date_MAJ;

        return $this;
    }

    /**
     * Get the value of Preavis
     */
    public function getPreavis(): ?string
    {
        return $this->Preavis;
    }

    /**
     * Set the value of Preavis
     */
    public function setPreavis(?string $Preavis): self
    {
        $this->Preavis = $Preavis;

        return $this;
    }

    /**
     * Get the value of profil
     */
    public function getProfil(): ?string
    {
        return $this->profil;
    }

    /**
     * Set the value of profil
     */
    public function setProfil(?string $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     */
    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }
}