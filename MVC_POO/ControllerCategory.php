<?php

    class ControllerCategory extends GenericController{

        //attributs
        private ?ViewCategory $viewCategory;
        private ?ModelCategory $modelCategory;
    
        //constructeur
        public function __construct(ViewCategory $viewCategory, ModelCategory $modelCategory) {
            $this->viewCategory = $viewCategory;
            $this->modelCategory = $modelCategory;
        }
        //getter et setter
        public function getViewCategory(): ?ViewCategory {
                return $this->viewCategory;
        }
        public function setViewCategory(?ViewCategory $newViewCategory): self {
            $this->viewCategory = $newViewCategory;
            return $this;
        }

        public function getModelCategory(): ?ModelCategory {
                return $this->modelCategory;
        }
        public function setModelCategory(?ModelCategory $newModelCategory): self {
                $this->modelCategory = $newModelCategory;
                return $this;
        }


        //methode
        public function addCategory():string{
            if (isset($_POST["submitCategory"])) {


                if (empty($_POST["category"])) {

                    return "le champ catégorie est vide";
                }
    
                $categoryName = sanitize($_POST["category"]);
                $this->modelCategory->setName($categoryName);
    
                $existCategory = $this->modelCategory->getByName();
                if (!empty($existCategory)) {
                    return "Cette catégorie existe déjà";
                
                }
    
                return $this->modelCategory->add();
            }
            return "";
        }

        public function readCategories(): string {

            $categories = $this->modelCategory->getAll();

            $categoryList ="";

            foreach ($categories as $category) {
                $categoryList = $categoryList. "<li>{$category['name_category']}</li>";
            }
            return $categoryList;
        }
    
        public function render(): void{
            $message = $this->addCategory();
            $categoryList = $this->readCategory();
            echo $this->viewCategory->setMessage($message)->setCategoryList($categoryList)->displayView();
        }

    }





?>