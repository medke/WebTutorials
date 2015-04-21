<?php
class ForumManger
{
private $db;
     public function __construct($db)
	{
	     $this->db = $db ; 
	}
	public function getForum($lvl)
	{    $retour='';
	     $categorie = NULL;
	     $query=$this->db->prepare('SELECT cat_id, cat_nom,forum_forum.forum_id, forum_name, forum_desc, forum_post, 
		                      forum_topic, auth_view, forum_topic.topic_id,  forum_topic.topic_post, post_id,
							  post_time, post_createur, membre_pseudo,membre_id 
                              FROM forum_categorie
                              LEFT JOIN forum_forum ON forum_categorie.cat_id = forum_forum.forum_cat_id
                              LEFT JOIN forum_post ON forum_post.post_id = forum_forum.forum_last_post_id
                              LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
                              LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
                              WHERE auth_view <= :lvl 
                              ORDER BY cat_ordre, forum_ordre DESC');
                              $query->bindValue(':lvl',$lvl,PDO::PARAM_INT);
                              $query->execute();
	     $retour=$retour.'<table>';
         while($data = $query->fetch())
        {
    
             if( $categorie != $data['cat_id'] )
            {
       
                 $categorie = $data['cat_id'];
                 
                 $retour=$retour.'<tr><th></th>
                 <th class="titre"><strong>'; echo stripslashes(htmlspecialchars($data['cat_nom']));  
		         if (verif_auth($data['auth_view']))
                {  
                     $retour=$retour.'</strong></th>             
                     <th class="nombremessages"><strong>Sujets</strong></th>       
                     <th class="nombresujets"><strong>Messages</strong></th>       
                     <th class="derniermessage"><strong>Dernier message</strong></th>   
                     </tr>';
                }
		        else
                {
                     $retour=$retour.'<td class="nombremessages">Pas de message</td></tr>';
                }

               
            }


            $retour=$retour.'<tr><td><img src="./images/icone/forum_img.png" alt="message"  /></td>
            <td class="titre"><strong>
            <a href="./voirforum.php?f='.$data['forum_id'].'">
            '.stripslashes(htmlspecialchars($data['forum_name'])).'</a></strong>
            <br />'.nl2br(stripslashes(htmlspecialchars($data['forum_desc']))).'</td>
            <td class="nombresujets">'.$data['forum_topic'].'</td>
            <td class="nombremessages">'.$data['forum_post'].'</td>';


                if (!empty($data['forum_post']))
                {
         
	                 $nombreDeMessagesParPage = 15;
                     $nbr_post = $data['topic_post'] +1;
	                 $page = ceil($nbr_post / $nombreDeMessagesParPage);
		 
                     $retour=$retour.'<td class="derniermessage">
                     '.date('H\hi \l\e d/M/Y',$data['post_time']).'<br />
                     <a href="./voirprofil.php?m='.stripslashes(htmlspecialchars($data['membre_id'])).'&amp;action=consulter">'.$data['membre_pseudo'].'  </a>
                     <a href="./voirtopic.php?t='.$data['topic_id'].'&amp;page='.$page.'#p_'.$data['post_id'].'">
                     <img src="./images/icone/go.png" alt="go" /></a></td></tr>';

                }
                else
                {
                     $retour=$retour.'<td class="nombremessages">Pas de message</td></tr>';
                }

     
            
	
	          $query->CloseCursor();
              $retour=$retour. '</table></div>';
			  return $retour;
	
	    }



    }
	public function afficherForum(Forum $forum)
	{   
	    $query=$this->db->prepare('SELECT forum_name, forum_topic, auth_view, auth_topic FROM forum_forum WHERE forum_id = :forum');
        $query->bindValue(':forum',$forum->getForum_id(),PDO::PARAM_INT);
        $query->execute();
        $data=$query->fetch();
		$forum->forum_name($data['forum_name']);
		$forum->forum_topic($data['forum_topic']);
		$forum->auth_view($data['auth_view']);
		$forum->auth_topic($data['auth_topic']);
	    $query->CloseCursor();
	}
	

}	
	

?>