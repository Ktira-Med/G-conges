<?php 

namespace App\Controller;


// Importing classes

use App\Model\DemandeModel;


class DemandeController {

    public function index()
    {
        $DemandeModel = new DemandeModel();
        $demandes = $DemandeModel->getDemandeByProfil($_SESSION['id_user'],$_SESSION['role']);
        $types = $DemandeModel->getTypeConge();
        if($_SESSION['role'] == 'Administrateur')
        {
            // Display: Template inclusion
            include '../templates/header.phtml';
            include '../templates/menu_Administration.phtml';
            include '../templates/liste_des_demandes.phtml';
        }
    elseif($_SESSION['role'] == 'employe')
    {
        // Display: Template inclusion
        include '../templates/header.phtml';
        include '../templates/menu_employe.phtml';
        include '../templates/liste_des_demandes.phtml';

        }
        else
        {
            // Display: Template inclusion
        include '../templates/header.phtml';
        include '../templates/menu_ChefProjet.phtml';
        include '../templates/liste_des_demandes.phtml';

        }
    }

    public function AddDemande(){
        $DemandeModel = new DemandeModel();
        $result= $DemandeModel->AddDemande( 
            $_SESSION['id_user'],
            $_POST['debutmod'],
            $_POST['finmod'],  
            $_POST['typeconge'],
            $_POST['commentaire'],
            'non'
        );
        
       echo json_encode('<p>Les informations d\'employe ont bien été ajoutées.</p>');
    }

    public function GetDemandeById()
    {
        $DemandeModel = new DemandeModel();
        $result=$DemandeModel->GetDemandeById($_POST['demande_id']);
        
            $json[0]=$result[0]->getId();
            $json[1]=$result[0]->getDateDebut();
            $json[2]=$result[0]->getDateFin();
            $json[3]=$result[0]->getTypeId();
            $json[4]=$result[0]->getComment();
            echo json_encode($json);      
    }

    public function UpdateDemande()
        {

            $DemandeModel = new DemandeModel();
            $result= $DemandeModel->updateDemande(
                $_POST['id_connecte'], 
                $_POST['debutmod'], 
                $_POST['finmod'], 
                $_POST['typeconge'], 
                $_POST['commentaire'], 
            );

            echo json_encode('<p>Les informations d\'employe ont bien été modifiées.</p>');
        }

    public function DeleteDemande()
        {
            $DemandeModel = new DemandeModel();
            $result= $DemandeModel->deleteDemande($_POST['demande_id']);
            return json_encode(true);
        }

    public function GetDemandeNonValdide()
    {
        $DemandeModel = new DemandeModel();
        $demandes = $DemandeModel->getDemandeNonValide();
        if($_SESSION['role'] == 'Administrateur' )
        {
            // Display: Template inclusion
            include '../templates/header.phtml';
            include '../templates/menu_Administration.phtml';
            include '../templates/conge_validation.phtml';
        }
        elseif($_SESSION['role'] == 'Chef de projet' )
        {
            // Display: Template inclusion
            include '../templates/header.phtml';
            include '../templates/menu_ChefProjet.phtml';
            include '../templates/conge_validation.phtml';
        }

    }
    public function ValidateConge()
    {
        $DemandeModel = new DemandeModel();
        $result = $DemandeModel->ValidateConge($_POST['demande_conge']);
        echo json_encode('<p>Congé validé.</p>');

    }
    
    // public function CalendarConge()
    // {
    //     $DemandeModel = new DemandeModel();
    //     $demandes = $DemandeModel->getDemandeById($_SESSION['id_user'],$_SESSION['role']);
    //     $_SESSION["demandes"]=$demandes;
    //     $events = array();
    // foreach ($_SESSION["demandes"] as $cal) {
    // $date1= new \DateTime($cal->getDateDebut());
    // $date2= new \DateTime($cal->getDateFin());
    // $diff = $date1->diff($date2);
    //     if($cal->getValide()=='oui')
    //     {
    //         $event = array(
    //         "title" => str_replace("'"," ",$cal->getLabelType()),
    //         "debut"=>$cal->getDateDebut(),
	// 	  	"fin"=>$cal->getDateFin(),
    //         "id"=>$cal->getId(),
    //         "start" => $cal->getDateDebut(),
    //         "end" => $cal->getDateFin(),
    //         "commentaire"=>$cal->getComment(),
    //         "allDay" => true,
    //         "className" => "label-success"
    //     );
    //     array_push($events, $event); 
    //     }
    //     else
    //     {
    //         $event = array(
                
    //             "title" => str_replace("'"," ",$cal->getLabelType()),
    //             "debut"=>$cal->getDateDebut(),
    //             "fin"=>$cal->getDateFin(),
    //             "id"=>$cal->getId(),
    //             "start" => $cal->getDateDebut(),
    //             "end" => $cal->getDateFin(),
    //             "commentaire"=>$cal->getComment(),
    //             "allDay" => true,
    //                 "className" => "label-danger"
    //             );
            
    //         array_push($events, $event);  
    //     }
       
    // }
    //     //var_dump($_SESSION["demandes"]);
    //     //exit;
    //     if($_SESSION['role'] == 'Administrateur')
    //     {
    //         // Display: Template inclusion
    //         include '../templates/header.phtml';
    //         include '../templates/menu_Administration.phtml';
    //         include '../templates/visualisation_conge.phtml';
    //     }
    // elseif($_SESSION['role'] == 'employe')
    // {
    //     // Display: Template inclusion
    //     include '../templates/header.phtml';
    //     include '../templates/menu_employe.phtml';
    //     include '../templates/visualisation_conge.phtml';

    //     }
    //     else
    //     {
    //         // Display: Template inclusion
    //     include '../templates/header.phtml';
    //     include '../templates/menu_ChefProjet.phtml';
    //     include '../templates/visualisation_conge.phtml';

    //     }
    // }
}
