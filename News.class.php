<?php
    /**
     * Classe représentant une news, créée à l'occasion d'un TP du tutoriel « La programmation orientée objet en PHP » disponible sur http://www.siteduzero.com/
     * @author Victor T.
     * @version 2.0
     */
    class News
    {
        protected $erreurs = array(),
                  $id,
                  $auteur,
                  $titre,
                  $contenu,
                  $date_ajout,
                  $date_modif;
        
        /**
         * Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode
         */
        const AUTEUR_INVALIDE = 1;
        const TITRE_INVALIDE = 2;
        const CONTENU_INVALIDE = 3;
        
        
        /**
         * Constructeur de la classe qui assigne les données spécifiées en paramètre aux attributs correspondants
         * @param $valeurs array Les valeurs à assigner
         * @return void
         */
        public function __construct($valeurs = array())
        {
            if (!empty($valeurs)) // Si on a spécifié des valeurs, alors on hydrate l'objet
                $this->hydrate($valeurs);
        }
        
        /**
         * Méthode assignant les valeurs spécifiées aux attributs correspondant
         * @param $donnees array Les données à assigner
         * @return void
         */
        public function hydrate($donnees)
        {
            foreach ($donnees as $attribut => $valeur)
            {
                $methode = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
                
                if (is_callable(array($this, $methode)))
                {
                    $this->$methode($valeur);
                }
            }
        }
        
        /**
         * Méthode permettant de savoir si la news est nouvelle
         * @return bool
         */
        public function isNew()
        {
            return empty($this->id);
        }
        
        /**
         * Méthode permettant de savoir si la news est valide
         * @return bool
         */
        public function isValid()
        {
            return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
        }
        
        
        // SETTERS //
        
        public function setId($id)
        {
            $this->id = (int) $id;
        }
        
        public function setAuteur($auteur)
        {
            if (!is_string($auteur) || empty($auteur))
                $this->erreurs[] = self::AUTEUR_INVALIDE;
            else
                $this->auteur = $auteur;
        }
        
        public function setTitre($titre)
        {
            if (!is_string($titre) || empty($titre))
                $this->erreurs[] = self::TITRE_INVALIDE;
            else
                $this->titre = $titre;
        }
        
        public function setContenu($contenu)
        {
            if (!is_string($contenu) || empty($contenu))
                $this->erreurs[] = self::CONTENU_INVALIDE;
            else
                $this->contenu = $contenu;
        }
        
        public function setDateAjout($dateAjout)
        {
            if (is_string($dateAjout) && preg_match('`le [0-9]{2}/[0-9]{2}/[0-9]{4} à [0-9]{2}h[0-9]{2}`', $dateAjout))
                $this->date_ajout = $dateAjout;
        }
        
        public function setDateModif($dateModif)
        {
            if (is_string($dateModif) && preg_match('`le [0-9]{2}/[0-9]{2}/[0-9]{4} à [0-9]{2}h[0-9]{2}`', $dateModif))
                $this->date_modif = $dateModif;
        }
        
        // GETTERS //
        
        public function erreurs()
        {
            return $this->erreurs;
        }
        
        public function id()
        {
            return $this->id;
        }
        
        public function auteur()
        {
            return $this->auteur;
        }
        
        public function titre()
        {
            return $this->titre;
        }
        
        public function contenu()
        {
            return $this->contenu;
        }
        
        public function date_ajout()
        {
            return $this->date_ajout;
        }
        
        public function date_modif()
        {
            return $this->date_modif;
        }
    }
