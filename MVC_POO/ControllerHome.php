<?php
 
    class ControllerHome extends GenericController {
        
        //ATTRIBUTS
        private ?ViewHome $viewHome;
        private ?modelUser $modelUser;

        //CONSTRUCTEUR
        public function __construct(ViewHome $viewHome,modelUser $modelUser ) {
            $this->viewHome = $viewHome;
            $this->modelUser = $modelUser;
        }

        //GETTER & SETTER
        public function getVeiwHome():ViewHome {
            return $this->viewHome;
        }
        public function setVeiwHome(ViewHome $newViewHome) {
            $this->viewHome = $newViewHome;
            return $this;
        }

        public function getModelUser(): ModelUser {
            return $this->modelUser;
        }
        public function setModelUser(ModelUser $newViewUser) {
            $this->modelUser = $newViewUser;
            return $this;
        }

        //METHODES

        public function signIn():string{
            //1) verifier qu'on reçoit le formulaire
            if(isset($_POST["submit"])){

                // 2) Vérifier les champs vides
                if(empty($_POST["email"]) ||empty($_POST['password']) || empty($_POST['nickname'])){

                    return 'Remplissez tous les champs';
                }

                // 3) Vérifier le format des données
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    return 'Email au mauvais format';
                }

                // 4) Nettoyer les données
                $nickname=sanitize($_POST['nickname']);
                $password=sanitize($_POST['password']);
                $email=sanitize($_POST['email']);

                // 5) Hasher le mot de passe
                $password=password_hash($password, PASSWORD_BCRYPT);
                

                // 6) Vérifier que l'utilisateur n'existe pas déjà en BDD
                // 6.1) Donner l'email au Model
                $this->getModelUser()->setEmail($email);

                // 6.2) Demander au model d'utiliser getByEmai1()
                $data=$this->getModelUser()->getByEmail();

                // 6.3) Vérifier si les données sont vide ou pas
                if(!empty($data)){
                    return "Cet email est déja utilisé par un utilisateur";
                }

                // 7) Enregistrer l'utilisateur en BDD
                // 7.1) Donner le pseudo et le mot de passe au Model
                $this->getModelUser()->setNickname($nickname)->setPassword($password);

                // 7.2) Demander au model d'utiliser add()
                $data=$this->getModelUser()->add();

                // 8) Retourne un message de confirmation
                return $data;
            }
            return '';
        }


        public function readUsers(){
            //1)demander au Model d'utiliser getAll()
            $data=$this->getModelUser()->getAll();

            //2)Boucler sur le tableau d'utilisateur
            $userList = '';
            foreach($data as $user){
                $userList = $userList."<li>{$user['nickname']} - {$user['email']}</li>";
            }
            return $userList;
        }


        public function render():void{
            //LANCEMENT DU TRAITEMENT DES DONNEES
            $message = $this->signIn();
          
            $userList=$this->readUsers();

            echo $this->getVeiwHome()->setMessage($message)->setUsersList($userList)->displayView();
        
        }
    
        public function signUp():string{
            
            if(isset($_POST["submitSignUp"])){

                // 2) Vérifier les champs vides
                if(empty($_POST['password']) || empty($_POST['email'])){

                    return 'Remplissez tous les champs';
                }

                // 3) Vérifier le format des données
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    return 'Email au mauvais format';
                }
                // 4) Nettoyer les données
                $password=clean($_POST['password']);
                $email=clean($_POST['email']);

                // 5) Hasher le mot de passe
                $password=password_hash($password, PASSWORD_BCRYPT);

                // 6) Vérifier que l'utilisateur existe déjà en BDD
                // 6.1) Donner l'email au Model
                $data = $this->getModelUser()->getByEmail();

                if(empty($data)){
                    return "Ce compte n'existe pas";
                }else if(!empty($data))  {
                    return "Bienvenue";
                }


            
                
            
            }
        }
    
    }

    

    // Inclusion des fichiers nécessaires dans le bon ordre
    include "utils/utils.php";
    include "view/viewHome.php";
    include "model/modelUser.php";
    // include "controllerHome.php";

    // Instanciation des objets nécessaires
    $home = new ControllerHome ();
    // Lancement de la méthode render()
    $home->render();
?>