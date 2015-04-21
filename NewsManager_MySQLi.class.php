<?php
    class NewsManager_MySQLi extends NewsManager
    {
        /**
         * Attribut contenant l'instance représentant la BDD
         * @type MySQLi
         */
        protected $db;
        
        /**
         * Constructeur étant chargé d'enregistrer l'instance de MySQLi dans l'attribut $db
         * @param $db MySQLi Le DAO
         * @return void
         */
        public function __construct(MySQLi $db)
        {
            $this->db = $db;
        }
        
        /**
         * @see NewsManager::add()
         */
        protected function add(News $news)
        {
            $requete = $this->db->prepare('INSERT INTO news SET auteur = ?, titre = ?, contenu = ?, date_ajout = NOW(), date_modif = NOW()');
            
            $requete->bind_param('sss', $news->auteur(), $news->titre(), $news->contenu());
            
            $requete->execute();
        }
        
        /**
         * @see NewsManager::count()
         */
        public function count()
        {
            return $this->db->query('SELECT id FROM news')->num_rows;
        }
        
        /**
         * @see NewsManager::delete()
         */
        public function delete($id)
        {
            $id = (int) $id;
            
            $requete = $this->db->prepare('DELETE FROM news WHERE id = ?');
            
            $requete->bind_param('i', $id);
            
            $requete->execute();
        }
        
        /**
         * @see NewsManager::getList()
         */
        public function getList($debut = -1, $limite = -1)
        {
            $listeNews = array();
            
            $sql = 'SELECT id, auteur, titre, contenu, DATE_FORMAT (date_ajout, \'le %d/%m/%Y à %Hh%i\') AS date_ajout, DATE_FORMAT (date_modif, \'le %d/%m/%Y à %Hh%i\') AS date_modif FROM news ORDER BY id DESC';
            
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }
            
            $requete = $this->db->query($sql);
            
            while ($news = $requete->fetch_assoc())
            {
                $listeNews[] = new News($news);
            }
            
            return $listeNews;
        }
        
        /**
         * @see NewsManager::getUnique()
         */
        public function getUnique($id)
        {
            $id = (int) $id;
            
            $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, DATE_FORMAT (date_ajout, \'le %d/%m/%Y à %Hh%i\') AS date_ajout, DATE_FORMAT (date_modif, \'le %d/%m/%Y à %Hh%i\') AS date_modif FROM news WHERE id = ?');
            $requete->bind_param('i', $id);
            $requete->execute();
            
            $requete->bind_result($id, $auteur, $titre, $contenu, $date_ajout, $date_modif);
            
            $requete->fetch();
            
            return new News(array(
                'id' => $id,
                'auteur' => $auteur,
                'titre' => $titre,
                'contenu' => $contenu,
                'date_ajout' => $date_ajout,
                'date_modif' => $date_modif
            ));
        }
        
        /**
         * @see NewsManager::update()
         */
        protected function update(News $news)
        {
            $requete = $this->db->prepare('UPDATE news SET auteur = ?, titre = ?, contenu = ?, date_modif = NOW() WHERE id = ?');
            
            $requete->bind_param('sssi', $news->auteur(), $news->titre(), $news->contenu(), $news->id());
            
            $requete->execute();
        }
    }
