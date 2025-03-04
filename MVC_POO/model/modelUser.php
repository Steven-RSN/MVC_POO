<?php

    class modelUser{
        
        //ATTRIBUTS:
        private ?int $id;
        private ?string $nickname;
        private ?string $email;
        private ?string $password;
        private ? PDO $bdd;

        //CONSTRUCTEUR:
        public function __construct() {
            $this->bdd = connect(); 
        }
        
        //GETTER & SETTER

        public function getId(): ?int {
                return $this->id;
        }
        public function setId(?int $id): self {
                $this->id = $id;
                return $this;
        }

        public function getNickname(): ?string {
                return $this->nickname;
        }
        public function setNickname(?string $nickname): self {
                $this->nickname = $nickname;
                return $this;
        }


        public function getEmail(): ?string {
                return $this->email;
        }
        public function setEmail(?string $email): self {
                $this->email = $email;
                return $this;
        }

 
        public function getPassword(): ?string {
                return $this->password;
        }
        public function setPassword(?string $password): self {
                $this->password = $password;
                return $this;
        }

     
        public function getBdd() {
                return $this->bdd;
        }
        public function setBdd($bdd): self {
                $this->bdd = $bdd;
                return $this;
        }

        //METHODES:
        
        public function add():string{
            try {
                //REQUETE PREPAREE
                $req=$this->getBdd()->prepare("INSERT INTO users(nickname,email,psswrd) VALUES (?,?,?)");
                
                //Récupération des donnés depuis l'objet:
                $nickname=$this->getNickname();
                $email=$this->getEmail();
                $password=$this->getPassword();


                //BINDPARAM
                $req->bindParam(1,$nickname,PDO::PARAM_STR);
                $req->bindParam(2,$email,PDO::PARAM_STR);
                $req->bindParam(3,$password,PDO::PARAM_STR);
                
                //Execution de la requete
                $req->execute();

                //Renvoi une string 
                return "$nickname a été enregistré avec succes";

            } catch(PDOException $e) {
                return $e->getMessage();
            
            }
        }

        public function getAll():array|string{
            try {
                //Preparer la requete 
                $req=$this->getBdd()->prepare("SELECT id, nickname, email, psswrd FROM users");
                
                //EXECUTER LA REQUETE
                $req->execute();

                //RECUPERATION DE LA REPONSE
                $data=$req->fetchAll(PDO::FETCH_ASSOC);

                //RETOURNER LE TABLEAU D'UTILISATEURS
                return $data;

            } catch(PDOException $e) {
                return $e->getMessage();
            }
        
        }

        public function getByEmail():array|string{
            try{

                //Préparer la requête SELECT
                $req= $this->getBdd()->prepare('SELECT id, nickname, email, psswrd  FROM users WHERE email = ? LIMIT 1');
               
                //Récuperation de l'email de l'objet Model:
                $email=$this->getEmail();

                //BINDING DE PARAM               
                $req->bindParam(1, $email, PDO::PARAM_STR);
                //exécution de la requête

                $req->execute();
        
                //récupérer les données de la BDD
                $data = $req->fetchAll(PDO::FETCH_ASSOC);
        
                //RETOURNER LE TABLEAU D'UTILISATEURS
                return $data;
        
            }catch(EXCEPTION $error) {
                
                return $error->getMessage();
            }
        }
        
    }

?>