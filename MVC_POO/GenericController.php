<?php

    class GenericController {

        //ATTRIBUTS
        private ?ViewHeader $viewHeader;
        private ?ViewFooter $viewFooter;

        //Constructeur
        public function __construct(ViewHeader $viewHeader, ViewFooter $viewFooter) {
                $this->ViewHeader = $viewHeader;
                $this->ViewFooter = $viewFooter;
        }



        //GETTER & SETTER
        public function getViewHeader(): ?ViewHeader {
                return $this->viewHeader;
        }
        public function setViewHeader(?ViewHeader $viewHeader): self {
                $this->viewHeader = $viewHeader;
                return $this;
        }


        public function getViewFooter(): ?ViewFooter {
                return $this->viewFooter;
        }
        public function setViewFooter(?ViewFooter $viewFooter): self {
                $this->viewFooter = $viewFooter;
                return $this;
        }


        //METHODES


    }
