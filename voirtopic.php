<?php
session_start();
$titre="Voir un sujet";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("./includes/mcode.php"); //On verra plus tard ce qu'est ce fichier
 
//On récupère la valeur de t
$topic = (int) $_GET['t'];
 
//A partir d'ici, on va compter le nombre de messages pour n'afficher que les 15 premiers
$query=$db->prepare('SELECT topic_titre, topic_post, forum_topic.forum_id, topic_last_post,
forum_name, auth_view, auth_topic, auth_post 
FROM forum_topic 
LEFT JOIN forum_forum ON forum_topic.forum_id = forum_forum.forum_id 
WHERE topic_id = :topic');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->execute();
$data=$query->fetch();
if (!verif_auth($data['auth_view']))
{
    erreur("tu n a pas le droit");
}
if ($data['topic_titre'] == "")
{
    erreur("le topic n existe pas");
}

 
$totalDesMessages = $data['topic_post'] + 1;
$nombreDeMessagesParPage = 15;
$nombreDePages = ceil($totalDesMessages / $nombreDeMessagesParPage);

echo '<p><i>أنت الآن هنا</i> : <a href="./forum.php">المنتدى</a> --> 
<a href="./voirforum.php?f='.$data['forum_id'].'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
 --> <a href="./voirtopic.php?t='.$topic.'">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a></p>';
echo '<h1>'.stripslashes(htmlspecialchars($data['topic_titre'])).'</h1>';
//Nombre de pages
$page = (isset($_GET['page']))?intval($_GET['page']):1;

//On affiche les pages 1-2-3 etc...
echo '<p>الصفحة : ';
for ($i = 1 ; $i <= $nombreDePages ; $i++)
{
    if ($i == $page) //On affiche pas la page actuelle en lien
    {
    echo $i;
    }
    else
    {
    echo '<a href="voirtopic.php?t='.$topic.'&page='.$i.'">
    ' . $i . '</a> ';
    }
}
echo'</p>';
 
$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;

 if (verif_auth($data['auth_post']))
{

//On affiche l'image répondre
echo'<div id="special"> <a href="./poster.php?action=repondre&amp;t='.$topic.'">
إضافة رد</a>';
 }

if (verif_auth($data['auth_topic']))
{

//On affiche l'image nouveau topic
echo'<a href="./poster.php?action=nouveautopic&amp;f='.$data['forum_id'].'">
إضافة موضوع جديد</a></div>';
}
$query->CloseCursor(); 
//Enfin on commence la boucle !
$query=$db->prepare('SELECT post_id , post_createur , post_texte , post_time ,
membre_id, membre_pseudo, membre_inscrit, membre_avatar, membre_localisation, membre_post, membre_signature,membre_rang
FROM forum_post
LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
WHERE topic_id =:topic
ORDER BY post_id
LIMIT :premier, :nombre');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->bindValue(':premier',(int) $premierMessageAafficher,PDO::PARAM_INT);
$query->bindValue(':nombre',(int) $nombreDeMessagesParPage,PDO::PARAM_INT);
$query->execute();
 
//On vérifie que la requête a bien retourné des messages
if ($query->rowCount()<1)
{
        echo'<p>لايوجد أي مشاركة في هدا الموضوع ,تأكد من الرابط</p>';
}
else
{
        //Si tout roule on affiche notre tableau puis on remplit avec une boucle
        ?>
		<table>
        <tr>
        <th class="vt_auteur"><strong>بواسطة</strong></th>             
        <th class="vt_mess"><strong>المشاركات</strong></th>       
        </tr>
        <?php
        while ($data = $query->fetch())
        {
//On commence à afficher le pseudo du créateur du message :
         //On vérifie les droits du membre
         //(partie du code commentée plus tard)
         echo'<tr><td><div class="_membre"><strong>
         <a href="./voirprofil.php?m='.$data['membre_id'].'&amp;action=consulter">
         '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></strong></div></td>';
           
         /* Si on est l'auteur du message, on affiche des liens pour
         Modérer celui-ci.
         Les modérateurs pourront aussi le faire, il faudra donc revenir sur
         ce code un peu plus tard ! */     
   
         if ($id == $data['post_createur'])
         {
         echo'<td class=p_'.$data['post_id'].'><div class="_membre">أُضيف '.date('H\hi  d M y',$data['post_time']).'<a href="./poster.php?p='.$data['post_id'].'&amp;action=delete">
         <img src="./images/icone/supprimer.gif" alt="حدف"
         title="حدف المشاركة" /></a>   
         <a href="./poster.php?p='.$data['post_id'].'&amp;action=edit">
         <img src="./images/icone/editer.gif" alt="تعديل"
         title="تعديل المشاركة" /></a></div>
         </td></tr>';
         }
         else
         {
         echo'<td><div class="_membre">
         أُضيف '.date('H\hi  d M y',$data['post_time']).'</div>
         </td></tr>';
         }
          switch(htmlspecialchars($data['membre_rang']))
		  {
		      case 0 :
			  $r ="مطرود";
			  break;
			  case 2 :
              $r ="عضو";
  			  break;
		      case 3 :
			  $r ="مشرف";
			  break;
			  case 4 :
              $r ="الإدارة";
  			  break;	
              default :
              $r="مجهول";			  
		  }
         //Détails sur le membre qui a posté
         echo'<tr><td><div class="av_membre">
         <img src="./images/avatars/'.$data['membre_avatar'].'" alt="" /></div>
         <br />عضو مند  '.date('d/m/Y',$data['membre_inscrit']).'
         <br />عدد المشاركات : '.$data['membre_post'].'<br />
         عنوانه : '.stripslashes(htmlspecialchars($data['membre_localisation'])).'<br/>
		 رتبته :'.$r.'
		  
		 </td>';
               
         //Message
         echo'<td>'.zcode(htmlspecialchars($data['post_texte'])).'
         <br /><hr />'.zcode(nl2br(stripslashes(htmlspecialchars($data['membre_signature'])))).'</td></tr>';
         } //Fin de la boucle ! \o/
         $query->CloseCursor();

         ?>
</table>
<?php
        echo '<p>Page : ';
        for ($i = 1 ; $i <= $nombreDePages ; $i++)
        {
                if ($i == $page) //On affiche pas la page actuelle en lien
                {
                echo $i;
                }
                else
                {
                echo '<a href="voirtopic.php?t='.$topic.'&amp;page='.$i.'">
                ' . $i . '</a> ';
                }
        }
        echo'</p>';
       
        //On ajoute 1 au nombre de visites de ce topic
        $query=$db->prepare('UPDATE forum_topic
        SET topic_vu = topic_vu + 1 WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();
		
		$query = $db->prepare('SELECT topic_locked FROM forum_topic WHERE topic_id = :topic');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->execute();
$data=$query->fetch();
if($lvl>=3){
if ($data['topic_locked'] == 1) // Topic verrouillé !
{
    echo'<a href="./postok.php?action=unlock&t='.$topic.'">
    <img src="./images/icone/unlock.gif" alt="deverrouiller" title="Déverrouiller ce sujet" /></a>';
}
else //Sinon le topic est déverrouillé !
{
    echo'<a href="./postok.php?action=lock&amp;t='.$topic.'">
    <img src="./images/icone/lock.gif" alt="verrouiller" title="Verrouiller ce sujet" /></a>';
}
$query->CloseCursor();
$query=$db->prepare('SELECT forum_id FROM forum_topic WHERE topic_id =:topic');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->execute();
$d=$query->fetch();
$forum=$d['forum_id'];
$query->CloseCursor();
$query=$db->prepare('SELECT forum_id, forum_name FROM forum_forum WHERE forum_id <> :forum');
$query->bindValue(':forum',$forum,PDO::PARAM_INT);
$query->execute();

//$forum a été définie tout en haut de la page !
echo'<p>Déplacer vers :</p>
<form method="post" action=postok.php?action=deplacer&amp;t='.$topic.'>
<select name="dest">';               
while($data=$query->fetch())
{
     echo'<option value='.$data['forum_id'].' id='.$data['forum_id'].'>'.$data['forum_name'].'</option>';
}
$query->CloseCursor();
echo'
</select>
<input type="hidden" name="from" value='.$forum.'>
<input type="submit" name="submit" value="إرسال" />
</form>';
} }//Fin du if qui vérifiait si le topic contenait au moins un message
 

?>           
</div>
</body>
</html>

