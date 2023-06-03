<?php 

namespace App\Controller;


// Importing classes

use App\Model\LoginModel;
use App\Model\DemandeModel;

class LoginController {

    public function index() 
    {
        if(!isset($_SESSION['nom'])){
        // Display: Template inclusion
        include '../templates/loginpage.phtml';
        }else{
            header('Location: ' . constructUrl('home'));
            exit;
        }
    }

    public function logout()
    {
        // Delete all session variables
        $_SESSION = [];

        session_destroy();
        // Redirection to login page
        header('Location: ' . constructUrl('login'));
        exit;
    }

    public function register() 
    { 
        if(!isset($_SESSION['nom'])){
        // Display: Template inclusion
        include '../templates/register.phtml';
        }
    }
    public function forget() 
    {
        if(!isset($_SESSION['nom'])){
        // Display: Template inclusion
        include '../templates/forgetpass.phtml';
        }
    }
    public function home() 
    {
        if(isset($_SESSION['nom'])){
            $loginModel = new LoginModel();
            $employes = $loginModel->getEmployes();
            $profils = $loginModel->getProfil();
            if($_SESSION['role'] == 'Administrateur')
            {
                // Display: Template inclusion
                include '../templates/header.phtml';
                include '../templates/menu_Administration.phtml';
                include '../templates/Liste_Employes.phtml';
            }elseif($_SESSION['role'] == 'Employe')
            {
                $DemandeModel = new DemandeModel();
                $demandes = $DemandeModel->getDemandeByProfil($_SESSION['id_user'],$_SESSION['role']);
                $types = $DemandeModel->getTypeConge();
                // Display: Template inclusion
                include '../templates/header.phtml';
                include '../templates/menu_employe.phtml';
                include '../templates/liste_des_demandes.phtml';
            }
            else
            {
                $DemandeModel = new DemandeModel();
                $demandes = $DemandeModel->getDemandeByProfil($_SESSION['id_user'],$_SESSION['role']);
                $types = $DemandeModel->getTypeConge();
                // Display: Template inclusion
                include '../templates/header.phtml';
                include '../templates/menu_ChefProjet.phtml';
                include '../templates/liste_des_demandes.phtml'; 
            }
            
            
        
        
        }else{
            header('Location: ' . constructUrl('login'));
            exit;
        }
        
    }


    public function addacount()
    {
         // Add user
         $errors = [];

        // Instantiating Model Classes
        
        $loginModel = new LoginModel();

        // Processing the Add Account Form
        if (!empty($_POST)) {

            // 1. Retrieving form data
            $Nom = $_POST['nom'];
            $Sexe = $_POST['sexe'];
            $GSM = $_POST['gsm'];
            $Email = $_POST['email'];
            $Password = $_POST['password'];

        
        if ($loginModel->mailExists($Email) == true) 
        {
            // message flash
            $_SESSION['flashbag'] = '<div style="color: red;"> Il y a déjà un compte associé à cette adresse e-mail';
            // Redirect to Article page
            header('Location: ' . constructUrl('register'));
            exit;
        }

            // 2. Hashing the password
            $hashedPassword = $this->encryptPassword($Password, $Email);
            // $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);


        // 3. Data processing
        if(empty($errors)) {

            // Inserting data
            $loginModel->addUser($Nom, $Sexe, $GSM, $Email, $hashedPassword,);

            // message flash
            $_SESSION['flashbag'] = '<div style="color: green;"> Votre compte a bien été ajouté';

            // Redirect to Article page
            header('Location: ' . constructUrl('register'));
            exit;
        }
        }
    }

    // Function to encrypt a password
        public function encryptPassword($password, $key)
    {
            $method = 'aes-256-cbc';
            $ivLength = openssl_cipher_iv_length($method);
            $iv = openssl_random_pseudo_bytes($ivLength);
            $encrypted = openssl_encrypt($password, $method, $key, OPENSSL_RAW_DATA, $iv);
            $encryptedPassword = base64_encode($iv . $encrypted);
            return $encryptedPassword;
    }
    
    // Function to decrypt a password
        public function decryptPassword($encryptedPassword, $key)
    {
            $method = 'aes-256-cbc';
            $encryptedPassword = base64_decode($encryptedPassword);
            $ivLength = openssl_cipher_iv_length($method);
            $iv = substr($encryptedPassword, 0, $ivLength);
            $encrypted = substr($encryptedPassword, $ivLength);
            $password = openssl_decrypt($encrypted, $method, $key, OPENSSL_RAW_DATA, $iv);
            return $password;
    }
    
    public function checkCredentials()
    {
        $Email = '';
        $Password = '';
        $_SESSION['flashbag'] ='';
        $loginModel = new LoginModel();
        if (!empty($_POST)) {
            $Email = $_POST['email'];
            $Password = $_POST['password'];
        }
        // 1. Does the user (email) exist?
        $user = $loginModel->getUser($Email);

        
        if (!empty($user)) {
            $hashedPassword = $user->getM_passe();
            // $hashedPassword = $user->getM_passe();
            // if (password_verify($Password, $hashedPassword)) {

            // 2. Verify the password
            if ($this->decryptPassword($hashedPassword, $Email) === $Password) {
                //Remplire la session
                $result = $loginModel->GetEmployerByEmail($Email);
                $_SESSION['role'] = $result->getRole();
                $_SESSION['id_user'] = $result->getIdUser();
                $_SESSION['nom'] = $result->getNom();
                $_SESSION['sexe'] = $result->getSexe();
                $_SESSION['email'] = $result->getEmail();
                $_SESSION['M_Passe'] = $this->decryptPassword($hashedPassword, $result->getEmail());
                // $_SESSION['M_Passe'] = $hashedPassword;
                $_SESSION['gsm'] = $result->getGSM();
    
                // Redirect to home page
                header('Location: ' . constructUrl('home'));
                exit;
            }
        }
        
        // If the user does not exist or the password is incorrect...
        $_SESSION['flashbag'] = '<div style="color: red;"> Merci de vérifier les informations de connexion saisies</div>';
        header('Location: ' . constructUrl('login'));
        exit;
    }
    
    
    public function GetEmployerById()
    {
        $loginModel = new loginModel();
        $result=$loginModel->GetEmployerById($_POST['employe_id']);
        
            $json[0]=$result[0]->getIdUser();
            $json[1]=$result[0]->getNom();
            $json[2]=$result[0]->getSexe();
            $json[3]=$result[0]->getEmail();
            $json[4]=$this->decryptPassword($result[0]->getM_passe(),$result[0]->getEmail());
            // $json[4] = $result[0]->getM_passe();
            $json[5]=$result[0]->getGSM();
            $json[6]=$result[0]->getCreatedAt();
            $json[7]=$result[0]->getDateMAJ();
            $json[8]=$result[0]->getCodeSS();
            $json[9]=$result[0]->getCNE();
            $json[10]=$result[0]->getDateIntegration();
            $json[11]=$result[0]->getPreavis();
            $json[12]=$result[0]->getDateDepart();
            $json[13]=$result[0]->getProfil();
            echo json_encode($json);      
    }

    public function MAJEmploye()
        {

            $loginModel = new LoginModel();
            $passwordhash=$this->encryptPassword($_POST['M_Passe'], $_POST['email']);
            // $passwordhash = password_hash($_POST['M_Passe'], PASSWORD_DEFAULT);

            $result= $loginModel->updateUser(
                $_POST['id_user'], 
                $_POST['nom'], 
                $_POST['gsm'], 
                $_POST['email'], 
                $_POST['cne'], 
                $_POST['codeSS'], 
                $passwordhash, 
                $_POST['dateDepart'], 
                $_POST['dateIntegration'], 
                $_POST['sexe'], 
                $_POST['preavis'],
                $_POST['profil']
            );

            echo json_encode(true);
        }

        public function DeleteEmploye()
        {
            $loginModel = new LoginModel();
            $result= $loginModel->deleteUser($_POST['employe_id']);
            return json_encode(true);
        }

        public function AddEmploye()
        {
            $loginModel = new LoginModel();
            $passwordhash=$this->encryptPassword($_POST['M_Passe'], $_POST['email']);
            // $passwordhash = password_hash($_POST['M_Passe'], PASSWORD_DEFAULT);

            $result= $loginModel->AddEmploye( 
                $_POST['nom'],
                $_POST['sexe'],  
                $_POST['email'],
                $passwordhash,
                $_POST['gsm'], 
                $_POST['codeSS'], 
                $_POST['cne'], 
                $_POST['dateIntegration'], 
                $_POST['preavis'], 
                $_POST['dateDepart'],
                $_POST['profil']
            );
            echo json_encode(true);
        }

        public function UpdateSettings()
        {
           
            $loginModel = new LoginModel();
            $passwordhash=$this->encryptPassword($_POST['motDePasse'], $_POST['email']);
            // $passwordhash = password_hash($_POST['motDePasse'], PASSWORD_DEFAULT);

            $result= $loginModel->UpdateSettings(
                $_POST['iduser'], 
                $_POST['flname'],
                $_POST['seexe'], 
                $_POST['phone'],
                $passwordhash
            );
            
            $_SESSION['id_user']=$_POST['iduser']; 
            $_SESSION['nom']=$_POST['flname'];
            $_SESSION['sexe']=$_POST['seexe'];
            $_SESSION['gsm']=$_POST['phone'];
            $_SESSION['M_Passe']=$_POST['motDePasse'];
            $json[0]=$_POST['iduser']; 
            $json[1]=$_POST['flname'];
            $json[2]=$_POST['seexe'];
            $json[3]=$_POST['phone'];
            $json[4]=$_POST['motDePasse'];
            echo json_encode($json);
        }

      
}