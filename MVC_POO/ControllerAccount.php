<?php 
    include "GenericController.php"
    include 'view/viewAccount.php'
    class ControllerAccount extends GenericContoller{
        
        //attributs
        private ?ViewAccount $viewAccount;
        

        //constructeur
        public function __construct(?ViewAccount $viewAccount){
            parent::__construc()
            $this->viewAccount = new ViewAccount();
        }


        //getter et setter
        public function getViewAccount(): ViewAccount{
            return $this->viewAccount;
        }
        public function setViewAccount (ViewAccount $newViewAccount): self{
            $this->viewAccount = $newViewAccount; 
            return $this;
        }


        public function render(): void{
            $this->ViewAccount->displayView()

        }

    }

?>    