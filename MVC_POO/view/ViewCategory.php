<?php

    class ViewCategory {
         
        //ATTRIBUTS
        private ?string $message;
        private ?string $categoriesList;


        //getter et setter 
        public function getMessage(): ?string {
                return $this->message;
        }
        public function setMessage(?string $message): self {
                $this->message = $message;
                return $this;
        }

  
        public function getCategoriesList(): ?string {
                return $this->categoriesList;
        }
        public function setCategoriesList(?string $categoriesList): self {
                $this->categoriesList = $categoriesList;
                return $this;
        }


        // Méthodes 
        public function displayView(): string {
            return '<main>
                <section>
                    <h2>Ajouter une catégorie</h2>
                    <form method="POST" action="">
                        <label for="category">Nom de la catégorie :</label>
                        <input type="text" id="category" name="category" required>
                        <input type="submit" name="submitCategory" value="Ajouter">
                    </form>
                    <p>' . $this->getMessage() . '</p>
                </section>
                <section>
                    <h2>Liste des catégories</h2>
                    <ul>' . $this->getCategoriesList() . '</ul>
                </section>
            </main>';
        }

    }

?>