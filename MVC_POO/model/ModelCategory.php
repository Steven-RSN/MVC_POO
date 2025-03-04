<?php

    class ModelCategory{
        private ?int $id;
        private ?string $name;
        private ? PDO $bdd;

        //CONSTRUCTEUR:
        public function __construct() {
            $this->bdd = connect(); 
        }


        //setter et getter
        public function getId(): ?int {
                return $this->id;
        }
        public function setId(?int $newId): self{
                $this->id = $newId;
                return $this;
        }


        public function getName() {
                return $this->name;
        }
        public function setName($name):self {
                $this->name = $name;
                return $this;
        }


        public function getBdd() {
                return $this->bdd;
        }

        public function setBdd($bdd): self {
                $this->bdd = $bdd;
                return $this;
        }


        //methode

        public function add():string {
            try{
                //REQUETE PREPAREE
                $req=$this->getBdd()->prepare("INSERT INTO category(name_category) VALUES (?) ");


                //Récupération des donnés depuis l'objet
                $name=$this->getName();
                
                
                //BINDPARAM
                $req->bindParam(1,$name,PDO::PARAM_STR);

                //execute la req

                $req->execute();

                return "$name a été enregistré avec succes";
            }catch(EXCEPTION $e){
                return $e->getMessage();

            }

        }


        public function getAll():string|array{
            try{
                //REQUETE PREPAREE
                $req=$this->getBdd()->prepar("SELECT id, name_category FROM category");


                //executer la requete

                $req->execute();
                
                //On recupere la reponse 
                $data=$req->fetchAll(PDO::FETCH_ASSOC);


                return $data;

            }catch(EXCEPTION $e){
                return $e->getMessage();
            }
        }

        public function getByName():array|string{
            try{
                //Preparer la requete
                $req=$this->getBdd()->prepar("SELECT id name_category FROM category where name_category = ? LIMIT 1");
            
                //Récuperation de nom l'objet ModelCat:
                $name=$this->getName();

                $req->bindParam(1, $name, PDO::PARAM_STR);
                
                $req->execute();
                
                $data=$req->fetchAll(PDO::FETCH_ASSOC);
                return $data;


            }catch(EXCEPTION $e){
                return $e->getMessage();

            }
        }
    }



?>