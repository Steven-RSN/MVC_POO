<?php

    class ViewAccount {
        //ATTRIBUTS


        //getter et setter 

        
        
        //methodes
        public function displayView():string{
            return ' 
            <body>
                <div class="account-container">
                    <h2>Informations du Compte</h2>
                    <p><strong>Nom:</strong> ' . $this->getClasse1()->getMessage() . '</p>
                    <p><strong>Email:</strong> ' . message() . '</p>
                    <p><strong>Solde:</strong> ' . message() . ' €</p>
                </div>
            </body>';
        }
    }