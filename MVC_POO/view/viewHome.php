<?php

    class ViewHome{

        //ATTRIBUTS
        private ?string $message="";
        private ?string $userList="";
 
        //GETTER & SETTER
        public function getMessage(): ?string {
                return $this->message;
        }
        public function setMessage(?string $message): self {
                $this->message = $message;
                return $this;
        }
   
        public function getUsersList(): ?string {
                return $this->userList;
        }
        public function setUsersList(?string $userList): self {
                $this->userList = $userList;
                return $this;
        }

        //METHODES

        public function displayView():string {
          return '
            <main>
                <section>
                    <h2>Formulaire d\'inscription</h2>

                    <form method="POST" action="">
                        <label for="nickname">Nom d\'utilisateur :</label>
                        <input type="text" id="nickname" name="nickname" required><br><br>

                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" required><br><br>

                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" name="password" required><br><br>

                        <input name="submit" type="submit" value="S\'inscrire">
                    </form>

                    <p>' .$this->getMessage().'</p>
                </section>

                <section>
                    <ul>' .$this->getUsersList().'</ul>

                </section>
            </main>';
        
        }
    }

    