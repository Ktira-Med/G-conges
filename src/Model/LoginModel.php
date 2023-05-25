<?php 

namespace App\Model;

use App\Core\AbstractModel;
use App\Entity\Login;
use App\Entity\Profil;

class LoginModel extends AbstractModel {
    
    function addUser(string $Nom, string $Sexe, string $GSM, string $Email, string $M_passe)
    {
        $sql = 'INSERT INTO users 
                (nom, sexe , gsm, email, password, dateCreation, id_profil)
                VALUES (?, ?, ?, ?, ?, NOW(),3)';

        $this->db->prepareAndExecute($sql, [$Nom, $Sexe, $GSM, $Email, $M_passe]);
    }

    function updateUser(int $id_user, string $Nom, string $GSM, string $Email, string $CNE, string $CodeSS, string $M_Passe, string $Date_Depart, string $Date_Integration, string $Sexe, string $Preavis, string $Id_Profil)
    {
        if($Preavis=='oui')
        {
            $sql = 'UPDATE users 
            SET nom=?, gsm=?, email=?, cne=?, codeSS=?, password=? , dateDepart=?, dateIntegration=?, sexe=?, dateMAJ=NOW(), preavis=?, id_profil=?
            WHERE id = ? ';

        $this->db->prepareAndExecute($sql, [$Nom, $GSM, $Email, $CNE, $CodeSS, $M_Passe, $Date_Depart, $Date_Integration, $Sexe, $Preavis, $Id_Profil, $id_user]);
        }else{
            $sql = 'UPDATE users 
            SET nom=?, gsm=?, email=?, cne=?, codeSS=?, password=?, dateIntegration=?, sexe=?, dateMAJ=NOW(), preavis=?, id_profil=?
            WHERE id = ? ';

        $this->db->prepareAndExecute($sql, [$Nom, $GSM, $Email, $CNE, $CodeSS, $M_Passe, $Date_Integration, $Sexe, $Preavis, $Id_Profil, $id_user]);
        }
       
    }

    function UpdateSettings(int $id_user, string $Nom, string $Sexe, string $GSM, string $MPasse)
    {
        $sql = 'UPDATE users 
        SET nom=?, sexe=?, gsm=?, password=?
        WHERE id = ? ';

        $this->db->prepareAndExecute($sql, [$Nom, $Sexe, $GSM, $MPasse, $id_user]);
    }

    function deleteUser(int $id_user)
    {
        $sql = 'DELETE FROM users 
                    WHERE id = ?';

        $this->db->prepareAndExecute($sql, [$id_user]);
    }

    //Checking the existence of the email
    function mailExists(string $Email)
    {
        $sql = 'SELECT * 
                     FROM users 
                     WHERE email = ?';
    
            $result = $this->db->getOneResult($sql, [$Email]);
            
            if (is_array($result) && count($result) > 0) {
                        return true;
                    } else {
                        return false;
                    }
    }
    function GetEmployerById(int $Id)
    {
        $sql = 'SELECT * 
                     FROM users 
                     WHERE id = ?';
    
            $results = $this->db->getOneResult($sql, [$Id]);
            
            $employes = [];
    
                $employes[] = new Login($results['id'],  $results['nom'],  $results['sexe'],  $results['email'], $results['password'], $results['gsm'],  $results['dateCreation'],  $results['dateMAJ'], $results['codeSS'], $results['cne'], $results['dateIntegration'] , $results['preavis'], $results['dateDepart'], $results['id_profil'],'');
           
            return $employes;
    }
    
    function GetEmployerByEmail(string $Email)
    {
        $sql = 'SELECT users.*,profil.role  
                     FROM users inner join profil on users.id_profil=profil.id 
                     WHERE email = ?';
     
            $results = $this->db->getAllResults($sql, [$Email]);
          
            $employes = [];

            foreach ($results as $result) {
    
                $employes = new Login($result['id'],  $result['nom'],  $result['sexe'],  $result['email'], $result['password'], $result['gsm'],  $result['dateCreation'],  $result['dateMAJ'], $result['codeSS'], $result['cne'], $result['dateIntegration'] , $result['preavis'], $result['dateDepart'], $result['id_profil'],$result['role']);
            }
            return $employes;
    }
    
    /**
    * Checks login credentials
    */
    function getUser(string $email)
{
    $sql = 'SELECT *  
            FROM users   
            WHERE email = ?';

$results = $this->db->getAllResults($sql, [$email]);


$users = [];
foreach ($results as $result) {
        $users = new Login($result['id'],  $result['nom'],  $result['sexe'],  $result['email'], $result['password'], $result['gsm'],  $result['dateCreation'],  $result['dateMAJ'], $result['codeSS'], $result['cne'], $result['dateIntegration'] , $result['preavis'], $result['dateDepart'], $result['id_profil'], '');

}
return $users;
    
}


    // function getUser(string $email)
    // {
    //     $sql = 'SELECT *  
    //                 FROM users   
    //                 WHERE email = ?';

    //     $result = $this->db->getOneResult($sql, [$email]);
    
    //     if (is_array($result) && count($result) > 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
   
    
    function getEmployes()
    {
        $sql = 'SELECT*
                    FROM users';

        $results = $this->db->getAllResults($sql);
        $employes = [];
        foreach ($results as $result) {

            $employes[] = new Login($result['id'],  $result['nom'],  $result['sexe'],  $result['email'], $result['password'], $result['gsm'],  $result['dateCreation'],  $result['dateMAJ'], $result['codeSS'], $result['cne'], $result['dateIntegration'] , $result['preavis'], $result['dateDepart'], $result['id_profil'],'');
        }

        return $employes;
       
    }

    function getProfil()
    {
        $sql = 'SELECT*
                    FROM profil';

        $results = $this->db->getAllResults($sql);
        $profils = [];
        foreach ($results as $result) {

            $profils[] = new Profil($result['id'],  $result['role']);
        }

        return $profils;
    }

    function AddEmploye(string $Nom, string $Sexe, string $Email, string $M_passe, string $GSM, string $CodeSS, string $CNE, string $Date_Integration, string $Preavis, string $Date_Depart, string $Id_Profil)
    {
        if($Preavis == 'non')
        {
            $sql = 'INSERT INTO users
                (nom, sexe, email, password, gsm, codeSS, cne, dateIntegration, preavis, dateCreation, id_profil)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)';

            $this->db->prepareAndExecute($sql, [$Nom, $Sexe, $Email, $M_passe, $GSM, $CodeSS, $CNE, $Date_Integration, $Preavis, $Id_Profil]);
        }else{
            $sql = 'INSERT INTO users
            (nom, sexe, email, password, gsm, codeSS, cne, dateIntegration, preavis, dateDepart, dateCreation, id_profil)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)';

            $this->db->prepareAndExecute($sql, [$Nom, $Sexe, $Email, $M_passe, $GSM, $CodeSS, $CNE, $Date_Integration, $Preavis, $Date_Depart, $Id_Profil]);
        } 
    }

}