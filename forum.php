<?php
session_start();
$titre='Index du Forum';
include("includes/identifiants.php");
include("includes/debut.php");



include("./includes/menu.php");


echo'<i>أنت الآن هنا : </i><a href ="./forum.php">المنتدى</a>';

//debut de la page comme d habitude
?> 


<?php 
$totaldesmessages = 0;
$categorie = NULL;






//Cette requete permet d'obtenir tout sur le forum
$query=$db->prepare('SELECT cat_id, cat_nom, 
forum_forum.forum_id, forum_name, forum_desc,  auth_view, forum_topic.topic_id,  forum_topic.topic_post, post_id, post_time, post_createur, membre_pseudo, 
membre_id 
FROM forum_categorie
LEFT JOIN forum_forum ON forum_categorie.cat_id = forum_forum.forum_cat_id
LEFT JOIN forum_post ON forum_post.post_id = forum_forum.forum_last_post_id
LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
WHERE auth_view <= :lvl 
ORDER BY cat_ordre, forum_ordre DESC');
$query->bindValue(':lvl',$lvl,PDO::PARAM_INT);
$query->execute();

?>
<table>
<?php
//Début de la boucle
while($data = $query->fetch())
{
    //On affiche chaque catégorie
    if( $categorie != $data['cat_id'] )
    {
        //Si c'est une nouvelle catégorie on l'affiche
       
        $categorie = $data['cat_id'];
        ?>
        <tr>
        <th></th>
        <th class="titre"><strong><?php echo stripslashes(htmlspecialchars($data['cat_nom']));  if (verif_auth($data['auth_view']))
{  ?>
        </strong></th>             
        <th class="nombremessages"><strong>المواضيع</strong></th>       
        <th class="nombresujets"><strong>المشاركات</strong></th>       
        <th class="derniermessage"><strong>آخر مشاركة</strong></th>   
        </tr>
        <?php }
		else
{
echo'<td class="nombremessages">بدون مشاركة</td></tr>';
}

               
    }
	$forum_name=stripslashes(htmlspecialchars($data['forum_name']));
	$forum_id=stripslashes(htmlspecialchars($data['forum_id']));
	$forum_desc=nl2br(stripslashes(htmlspecialchars($data['forum_desc'])));
	$post_time=$data['post_time'];
	$membre_id=stripslashes(htmlspecialchars($data['membre_id']));
	$membre_pseudo=stripslashes(htmlspecialchars($data['membre_pseudo']));
	$topic_id=stripslashes(htmlspecialchars($data['topic_id']));
	$post_id=stripslashes(htmlspecialchars($data['post_id']));
	
	$forum_topic=$db->query('SELECT COUNT(topic_id) FROM forum_topic t  INNER JOIN forum_forum f ON f.forum_id = t.forum_id WHERE t.forum_id ="'.$forum_id.'"')->fetchColumn();
    $forum_post =$db->query('SELECT COUNT(post_id) FROM forum_post t  INNER JOIN forum_forum f ON f.forum_id = t.post_forum_id WHERE t.post_forum_id ="'.$forum_id.'"')->fetchColumn();
    //Ici, on met le contenu de chaque catégorie
    ?>
<?php
    // Ce super echo de la mort affiche tous
    // les forums en détail : description, nombre de réponses etc...
   
    echo'<tr><td><img src="./images/icone/forum_img.png" alt="message"  /></td>
    <td class="titre"><strong>
    <a href="./forum-'.$forum_id.'.html">
    '.$forum_name.'</a></strong>
    <br />'.$forum_desc.'</td>
    <td class="nombresujets">'.$forum_topic.'</td>
    <td class="nombremessages">'.$forum_post.'</td>';

    // Deux cas possibles :
    // Soit il y a un nouveau message, soit le forum est vide
    if (!empty($forum_post))
    {
         //Selection dernier message
	 $nombreDeMessagesParPage = 15;
         $nbr_post = $forum_post +1;
	 $page = ceil($nbr_post / $nombreDeMessagesParPage);
		 
         echo'<td class="derniermessage">
         '.date('H\hi  d/M/Y',$post_time).'<br />
         <a href="./voirprofil.php?m='.$membre_id.'&amp;action=consulter">'.$membre_pseudo.'  </a>
         <a href="./voirtopic.php?t='.$topic_id.'&amp;page='.$page.'#p_'.$post_id.'">
         <img src="./images/icone/go.png" alt="go" /></a></td></tr>';

     }
     else
     {
         echo'<td class="nombremessages">Pas de message</td></tr>';
     }

     //Cette variable stock le nombre de message, on la met à jour
     $totaldesmessages += $forum_post;

     //On ferme notre boucle et nos balises
} //fin de la boucle
$query->CloseCursor();
echo '</table></div>';


?>
<?php
//Le pied de page ici :
echo'<div id="footer">

';

//On compte les membres
$TotalDesMembres = $db->query('SELECT COUNT(*) FROM forum_membres')->fetchColumn();


$query = $db->query('SELECT membre_pseudo, membre_id FROM forum_membres ORDER BY membre_id DESC LIMIT 0, 1');
$data = $query->fetch();
$derniermembre = stripslashes(htmlspecialchars($data['membre_pseudo']));

echo'<p> العدد الإجمالي للمشاركات هو  <strong>'.$totaldesmessages.'</strong>.<br />';
echo'الموقع يحتوي على <strong>'.$TotalDesMembres.'</strong> عضو.<br />';
echo'آخر عضو هو  <a href="./voirprofil.php?m='.$data['membre_id'].'&amp;action=consulter">'.$derniermembre.'</a>.</p>';
$query->CloseCursor();

?>
 <p>
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10"
        alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
  </p>
</div>

</body>
</html>
