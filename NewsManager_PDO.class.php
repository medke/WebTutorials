<?php
    class NewsManager_PDO extends NewsManager
    {
        /**
         * Attribut contenant l'instance représentant la BDD
         * @type PDO
         */
        protected $db;
        
        /**
         * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db
         * @param $db PDO Le DAO
         * @return void
         */
        public function __construct(PDO $db)
        {
            $this->db = $db;
        }
        
        /**
         * @see NewsManager::add()
         */
        protected function add(News $news)
        {
            $requete = $this->db->prepare('INSERT INTO news SET auteur = :auteur, titre = :titre, contenu = :contenu, date_ajout = NOW(), date_modif = NOW()');
            
            $requete->bindValue(':titre', $news->titre());
            $requete->bindValue(':auteur', $news->auteur());
            $requete->bindValue(':contenu', $news->contenu());
            
            $requete->execute();
        }
        
        /**
         * @see NewsManager::count()
         */
        public function count()
        {
            return $this->db->query('SELECT COUNT(*) FROM news')->fetchColumn();
        }
        
        /**
         * @see NewsManager::delete()
         */
        public function delete($id)
        {
            $this->db->exec('DELETE FROM news WHERE id = '.(int) $id);
        }
        
        /**
         * @see NewsManager::getList()
         */
        public function getList($debut = -1, $limite = -1)
        {
            $listeNews = array();
            
            $sql = 'SELECT id, auteur, titre, contenu,date_ajout,date_modif FROM news ORDER BY id DESC';
            
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }
            
            $requete = $this->db->query($sql);
            
            while ($news = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $listeNews[] = new News($news);
            }
            
            $requete->closeCursor();
            
            return $listeNews;
        }
        
        /**
         * @see NewsManager::getUnique()
         */
        public function getUnique($id)
        {
            $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, DATE_FORMAT (date_ajout, \'le %d/%m/%Y à %Hh%i\') AS date_ajout, DATE_FORMAT (date_modif, \'le %d/%m/%Y à %Hh%i\') AS date_modif FROM news WHERE id = :id');
            $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
            $requete->execute();
            
            return new News($requete->fetch(PDO::FETCH_ASSOC));
        }
        
        /**
         * @see NewsManager::update()
         */
        protected function update(News $news)
        {
            $requete = $this->db->prepare('UPDATE news SET auteur = :auteur, titre = :titre, contenu = :contenu, date_modif = NOW() WHERE id = :id');
            
            $requete->bindValue(':titre', $news->titre());
            $requete->bindValue(':auteur', $news->auteur());
            $requete->bindValue(':contenu', $news->contenu());
            $requete->bindValue(':id', $news->id(), PDO::PARAM_INT);
            
            $requete->execute();
        }
    }
