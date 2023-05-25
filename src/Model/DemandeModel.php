<?php 

namespace App\Model;

use App\Core\AbstractModel;
use App\Entity\DemandeConge;
use App\Entity\TypeConge;

class DemandeModel extends AbstractModel {

    

    function getDemandeByProfil(int $user_id,string $profil)
    {
        $results="";
        $demandes = [];
        if($profil=="Utilisateur"||$profil=="Chef de projet")
        {
            $sql = 'SELECT demande_conge.*, 
                            type_conge.label_type
                    FROM demande_conge 
                    INNER JOIN type_conge ON demande_conge.type_id=type_conge.id
                    WHERE demande_conge.user_id = ?
                    ORDER BY valide ASC';

            $results = $this->db->getAllResults($sql, [$user_id]);
            foreach ($results as $result) {
                $demandes[] = new DemandeConge($result['id'], $result['dateDebut'],  $result['dateFin'], $result['comment'], $result['valide'], $result['type_id'], $result['label_type'], $result['user_id'],'');
            }
        }
        else
        {
            $sql = 'SELECT demande_conge.*, 
                            users.nom,
                            type_conge.label_type 
                            FROM demande_conge 
                            INNER JOIN users ON demande_conge.user_id=users.id 
                            INNER JOIN type_conge ON demande_conge.type_id=type_conge.id
                            ORDER BY valide ASC';

            $results = $this->db->getAllResults($sql);
            foreach ($results as $result) {
                $demandes[] = new DemandeConge($result['id'], $result['dateDebut'],  $result['dateFin'], $result['comment'], $result['valide'], $result['type_id'], $result['label_type'], $result['user_id'], $result['nom']);
            }
        }
      
            
    
            

            return $demandes;
    }

    function getTypeConge()
    {
        $sql = 'SELECT*
                    FROM type_conge';

        $results = $this->db->getAllResults($sql);
        $types = [];
        foreach ($results as $result) {

            $types[] = new TypeConge($result['id'], $result['label_type'], $result['nbr_jour']);
        }

        return $types;
    }

    function AddDemande(int $User_Id, string $Date_Debut, string $Date_Fin, int $Type_Id, string $Comment, string $Valide)

    {
        $sql = 'INSERT INTO demande_conge
                        (user_id, dateDebut, dateFin, type_id, comment, valide)
                        VALUES (?, ?, ?, ?, ?, ?)';
                        
        return $this->db->prepareAndExecute($sql, [$User_Id, $Date_Debut, $Date_Fin, $Type_Id, $Comment, $Valide]);
    }

    function getDemandeNonValide()
    {
        $sql = "SELECT demande_conge.*, 
                        users.nom,
                        type_conge.label_type 
                FROM demande_conge 
                INNER JOIN users ON demande_conge.user_id=users.id 
                INNER JOIN type_conge ON demande_conge.type_id=type_conge.id 
                WHERE demande_conge.valide='non'";

        $results = $this->db->getAllResults($sql);
        $demandes = [];
    
            foreach ($results as $result) {
                $demandes[] = new DemandeConge($result['id'], $result['dateDebut'],  $result['dateFin'], $result['comment'], $result['valide'], $result['type_id'], $result['label_type'], $result['user_id'],$result['nom']);
            }

            return $demandes;
    }

    function GetDemandeById(int $Id)
    {
        $sql = 'SELECT demande_conge.*, 
                        type_conge.label_type
                        FROM demande_conge 
                        INNER JOIN type_conge ON demande_conge.type_id=type_conge.id
                        WHERE demande_conge.id = ?';

        $results = $this->db->getOneResult($sql, [$Id]);
        
            $demandes = [];
    
                $demandes[] = new DemandeConge($results['id'],  $results['dateDebut'],  $results['dateFin'],  $results['comment'], $results['valide'], $results['type_id'], $results['label_type'],  $results['user_id'], '');
           
            return $demandes;
    }

    function updateDemande(int $User_Id, string $Date_Debut, string $Date_Fin, int $Type_Id, string $Comment)
    {
        $sql = 'UPDATE demande_conge 
                    SET dateDebut=?, dateFin=?, type_id=?, comment=?
                    WHERE id = ? ';

        $this->db->prepareAndExecute($sql, [$Date_Debut, $Date_Fin, $Type_Id, $Comment, $User_Id]);
    }

    function deleteDemande(int $Demande_id)
    {
        $sql = 'DELETE FROM demande_conge 
                    WHERE id = ?';

        $this->db->prepareAndExecute($sql, [$Demande_id]);
    }

    function ValidateConge($id_conge)
    {
        $sql = "UPDATE demande_conge 
        SET valide='oui' 
        WHERE id = ? ";

        $this->db->prepareAndExecute($sql, [$id_conge]);
    }
    
}