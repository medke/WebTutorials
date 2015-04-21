<?php
session_start();
$titre="Voir un forum";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");


//On récupère la valeur de f
$forum = (int) $_GET['f'];
$forum_topic=$db->query('SELECT COUNT(topic_id) FROM forum_topic t  INNER JOIN forum_forum f ON f.forum_id = t.forum_id WHERE t.forum_id ="'.$forum.'"')->fetchColumn();
//A partir d'ici, on va compter le nombre de messages
//pour n'afficher que les 25 premiers
$query=$db->prepare('SELECT forum_name,  auth_view, auth_topic FROM forum_forum WHERE forum_id = :forum');
$query->bindValue(':forum',$forum,PDO::PARAM_INT);
$query->execute();
$data=$query->fetch();
if (!verif_auth($data['auth_view']))
{
erreur("tu na pas le droit");
}
if ($data['forum_name'] == "")
{
    erreur("le forum n existe pas");
}


$totalDesMessages = $forum_topic + 1;
$nombreDeMessagesParPage = 25;
$nombreDePages = ceil($totalDesMessages / $nombreDeMessagesParPage);
echo '<p><i>أنت الآن هنا</i> : <a href="./forum.php">المنتدى</a> --> 
<a href="./voirforum.php?f='.$forum.'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a></p>';

//Nombre de pages


$page = (isset($_GET['page']))?intval($_GET['page']):1;

//On affiche les pages 1-2-3, etc.
echo '<p>الصفحة : ';
for ($i = 1 ; $i <= $nombreDePages ; $i++)
{
    if ($i == $page) //On ne met pas de lien sur la page actuelle
    {
    echo $i;
    }
    else
    {
    echo '
    <a href="voirforum.php?f='.$forum.'&amp;page='.$i.'">'.$i.'</a>';
    }
}
echo '</p>';


$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;

//Le titre du forum
echo '<h2>'.stripslashes(htmlspecialchars($data['forum_name'])).'</h2>';


if (verif_auth($data['auth_topic']))
{
if($lvl>=2)
{
//Et le bouton pour poster
echo'<a href="./poster.php?action=nouveautopic&amp;f='.$forum.'">
<img src="./images/icone/nouveau.png" alt="Nouveau topic" title="فتح موضوع جديد" /></a>';
}}

$query->CloseCursor();
$query=$db->prepare('SELECT forum_topic.topic_id, topic_titre, topic_createur, topic_vu, topic_post, topic_time, topic_last_post,
Mb.membre_pseudo AS membre_pseudo_createur, post_createur, post_time, Ma.membre_pseudo AS membre_pseudo_last_posteur, post_id FROM forum_topic 
LEFT JOIN forum_membres Mb ON Mb.membre_id = forum_topic.topic_createur
LEFT JOIN forum_post ON forum_topic.topic_last_post = forum_post.post_id
LEFT JOIN forum_membres Ma ON Ma.membre_id = forum_post.post_createur    
WHERE topic_genre = "Annonce" AND forum_topic.forum_id = :forum 
ORDER BY topic_last_post DESC');
$query->bindValue(':forum',$forum,PDO::PARAM_INT);
$query->execute();
if ($query->rowCount()>0)
{
        ?>
        <table>   
        <tr>
        <th>بيان</th>
        <th class="titre"><strong>عنوان</strong></th>             
        <th class="nombremessages"><strong>المشاركات</strong></th>
        <th class="nombrevu"><strong>شوهِد</strong></th>
        <th class="auteur"><strong>بواسطة</strong></th>                       
        <th class="derniermessage"><strong>آخر مشاركة</strong></th>
        </tr>   
       
        <?php
        //On commence la boucle
        while ($data=$query->fetch())
        {
                //Pour chaque topic :
                //Si le topic est une annonce on l'affiche en haut
                //mega echo de bourrain pour tout remplir
               
                echo'<tr><td><img src="./images/icone/annonce.png" alt="Annonce" /></td>

                <td id="titre"><strong>بيان : </strong>
                <strong><a href="./voirtopic.php?t='.$data['topic_id'].'"                 
                title=" موضوع بدأ 
                '.date('H\hi \l\e d M,y',$data['topic_time']).'">
                '.stripslashes(htmlspecialchars($data['topic_titre'])).'</a></strong></td>

                <td class="nombremessages">'.$data['topic_post'].'</td>

                <td class="nombrevu">'.$data['topic_vu'].'</td>

                <td><a href="./voirprofil.php?m='.$data['topic_createur'].'
                &amp;action=consulter">
                '.stripslashes(htmlspecialchars($data['membre_pseudo_createur'])).'</a></td>';

               	//Selection dernier message
		$nombreDeMessagesParPage = 15;
		$nbr_post = $data['topic_post'] +1;
		$page = ceil($nbr_post / $nombreDeMessagesParPage);

                echo '<td class="derniermessage"> بواسطة
                <a href="./voirprofil.php?m='.$data['post_createur'].'
                &amp;action=consulter">
                '.stripslashes(htmlspecialchars($data['membre_pseudo_last_posteur'])).'</a><br />
                على <a href="./voirtopic.php?t='.$data['topic_id'].'&amp;page='.$page.'#p_'.$data['post_id'].'">'.date('H\hi  d M y',$data['post_time']).'</a></td></tr>';
        }
        ?>
        </table>
        <?php
}
$query->CloseCursor();
$query=$db->prepare('SELECT forum_topic.topic_id, topic_titre, topic_createur, topic_vu, topic_post, topic_time, topic_last_post,
Mb.membre_pseudo AS membre_pseudo_createur, post_id, post_createur, post_time, Ma.membre_pseudo AS membre_pseudo_last_posteur FROM forum_topic
LEFT JOIN forum_membres Mb ON Mb.membre_id = forum_topic.topic_createur
LEFT JOIN forum_post ON forum_topic.topic_last_post = forum_post.post_id
LEFT JOIN forum_membres Ma ON Ma.membre_id = forum_post.post_createur   
WHERE topic_genre <> "Annonce" AND forum_topic.forum_id = :forum
ORDER BY topic_last_post DESC
LIMIT :premier ,:nombre');
$query->bindValue(':forum',$forum,PDO::PARAM_INT);
$query->bindValue(':premier',(int) $premierMessageAafficher,PDO::PARAM_INT);
$query->bindValue(':nombre',(int) $nombreDeMessagesParPage,PDO::PARAM_INT);
$query->execute();

if ($query->rowCount()>0)
{
?>
        <table>
        <tr>
        <th>موضوع</th>
        <th class="titre"><strong>عنوان</strong></th>             
        <th class="nombremessages"><strong>المشاركات</strong></th>
        <th class="nombrevu"><strong>شوهِد</strong></th>
        <th class="auteur"><strong>بواسطة</strong></th>                       
        <th class="derniermessage"><strong>آخر مشاركة  </strong></th>
        </tr>
        <?php
        //On lance la boucle
       
        while ($data = $query->fetch())
        {
                //Ah bah tiens... re vla l'echo de fou
                echo'<tr><td><img src="./images/icone/message2.png" alt="Message" /></td>

                <td class="titre">
                <strong><a href="./voirtopic.php?t='.$data['topic_id'].'"                 
                title=" موضوع بدأ
                '.date('H\hi \l\e d M,y',$data['topic_time']).'">
                '.stripslashes(htmlspecialchars($data['topic_titre'])).'</a></strong></td>

                <td class="nombremessages">'.$data['topic_post'].'</td>

                <td class="nombrevu">'.$data['topic_vu'].'</td>

                <td><a href="./voirprofil.php?m='.$data['topic_createur'].'
                &amp;action=consulter">
                '.stripslashes(htmlspecialchars($data['membre_pseudo_createur'])).'</a></td>';

               	//Selection dernier message
		$nombreDeMessagesParPage = 15;
		$nbr_post = $data['topic_post'] +1;
		$page = ceil($nbr_post / $nombreDeMessagesParPage);

                echo '<td class="derniermessage"> بواسطة
                <a href="./voirprofil.php?m='.$data['post_createur'].'
                &amp;action=consulter">
                '.stripslashes(htmlspecialchars($data['membre_pseudo_last_posteur'])).'</a><br />
                على <a href="./voirtopic.php?t='.$data['topic_id'].'&amp;page='.$page.'#p_'.$data['post_id'].'">'.date('H\hi  d M y',$data['post_time']).'</a></td></tr>';

        }
        ?>
        </table>
        <?php
}
else //S'il n'y a pas de message
{
        echo'<p>هدا المنتدى لا يحتوي على أي موضوع حاليا</p>';
}
$query->CloseCursor();


?>
</div>
</body></html>

