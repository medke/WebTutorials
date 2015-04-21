<?php
session_start();
$titre="Poster";
$balises = true;
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
//Qu'est ce qu'on veut faire ? poster, répondre ou éditer ?
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';

//Il faut être connecté pour poster !
if ($id==0) erreur("آسف لكن غير مسموح لك");

//Si on veut poster un nouveau topic, la variable f se trouve dans l'url,
//On récupère certaines valeurs
if (isset($_GET['f']))
{
    $forum = (int) $_GET['f'];
    $query= $db->prepare('SELECT forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_forum WHERE forum_id =:forum');
    $query->bindValue(':forum',$forum,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();
	if (!verif_auth($data['auth_view']))
{
    erreur("آسف لكن غير مسموح لك");
}

    echo '<p><i>أنت الآن هنا : </i> : <a href="./forum.php">المنتدى</a> --> 
    <a href="./voirforum.php?f='.$forum.'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    --> إضافة موضوع جديد</p>';

 
}
 
//Sinon c'est un nouveau message, on a la variable t et
//On récupère f grâce à une requête
elseif (isset($_GET['t']))
{
    $topic = (int) $_GET['t'];
    $query=$db->prepare('SELECT topic_titre, forum_topic.forum_id,
    forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_topic
    LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id
    WHERE topic_id =:topic');
    $query->bindValue(':topic',$topic,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();
    $forum = $data['forum_id'];  

    echo '<p><i>أنت الآن هنا :</i> : <a href="./forum.php">المنتدى</a> --> 
    <a href="./voirforum.php?f='.$data['forum_id'].'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    --> <a href="./voirtopic.php?t='.$topic.'">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>
    --> الرد على هدا الموضوع</p>';
}
 
//Enfin sinon c'est au sujet de la modération(on verra plus tard en détail)
//On ne connait que le post, il faut chercher le reste
elseif (isset ($_GET['p']))
{
    $post = (int) $_GET['p'];
    $query=$db->prepare('SELECT post_createur, forum_post.topic_id, topic_titre, forum_topic.forum_id,
    forum_name, auth_view, auth_post, auth_topic, auth_annonce, auth_modo
    FROM forum_post
    LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
    LEFT JOIN forum_forum ON forum_forum.forum_id = forum_topic.forum_id
    WHERE forum_post.post_id =:post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();

    $topic = $data['topic_id'];
    $forum = $data['forum_id'];
 
    echo '<p><i>أنت الآن هنا :</i> : <a href="./forum.php">Index du forum</a> --> 
    <a href="./voirforum.php?f='.$data['forum_id'].'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
    --> <a href="./voirtopic.php?t='.$topic.'">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>
    --> تعديل المشاركة</p>';
}
$query->CloseCursor();  
switch($action)
{
case "repondre": //Premier cas on souhaite répondre
if (verif_auth($data['auth_post']))
{
?>
<h1>إضافة رد</h1>
  <div id="bbcode">
<form method="post" action="postok.php?action=repondre&amp;t=<?php echo $topic ?>" name="formulaire">

<fieldset><legend>التنسيق</legend>
<input type="button" id="gras" name="gras" value="غليظ" onClick="javascript:bbcode('[g]', '[/g]');return(false)" />
<input type="button" id="italic" name="italic" value="مائل" onClick="javascript:bbcode('[i]', '[/i]');return(false)" />
<input type="button" class="choix" name="souligne" value="مسطر" onClick="javascript:bbcode('[s]', '[/s]');return(false)" />
<input type="button" id="lien" name="lien" value="رابط" onClick="javascript:bbcode('[url]', '[/url]');return(false)" />
<input type="button" id="image" name="image" value="صورة" onClick="javascript:bbcode('[img]', '[/img]');return(false)" />

<select class="choix">
<option  >كود</option>
<option  id="php" name="php" value="php" onClick="javascript:bbcode('<code=php>', '</code>');return(false)">php</option>
<option  id="java" name="java" value="java" onClick="javascript:bbcode('<code=java>', '</code>');return(false)">java</option>
<option  id="html" name="html" value="html" onClick="javascript:bbcode('<code=xhtml>', '</code>');return(false)">(x)html</option>
<option  id="css" name="css" value="css" onClick="javascript:bbcode('<code=css>', '</code>');return(false)">css</option>
<option  id="sql" name="sql" value="sql" onClick="javascript:bbcode('<code=sql>', '</code>');return(false)">sql</option>
<option  id="C" name="C" value="C" onClick="javascript:bbcode('<code=c>', '</code>');return(false)">C</option>
<option  id="C++" name="C++" value="C++" onClick="javascript:bbcode('<code=c++>', '</code>');return(false)">C++</option>

</select>
<select class="choix">
<option  >لون</option>
<option style="color:red" id="red" name="red" value="أحمر" onClick="javascript:bbcode('[color=red]', '[/color]');return(false)">أحمر</option>
<option  style="color:blue" id="bleu" name="bleu" value="أزرق" onClick="javascript:bbcode('[color=blue]', '[/color]');return(false)">أزرق</option>
<option  id="black" name="black" value="أسود" onClick="javascript:bbcode('[color=black]', '[/color]');return(false)">أسود</option>
<option  style="color:green" id="green" name="أخضر" value="green" onClick="javascript:bbcode('[color=green]', '[/color]');return(false)">أخضر</option>
<option  style="color:orange" id="orange" name="برتقالي" value="orange" onClick="javascript:bbcode('[color=orange]', '[/color]');return(false)">برتقالي</option>

</select>
</select>
<select class="choix">
<option >حجم</option>
<option  style="font-size:80%"    value="petit" onClick="javascript:bbcode('[size=6]', '[/size]');return(false)">صغير جدا</option>
<option  style="font-size:90%"    value="tres petit" onClick="javascript:bbcode('[size=5]', '[/size]');return(false)">صغير</option>
<option  style="font-size:110%"   value="grand" onClick="javascript:bbcode('[size=4]', '[/size]');return(false)">عادي</option>
<option  style="font-size:120%"    value="tres grand" onClick="javascript:bbcode('[size=3]', '[/size]');return(false)">كبير</option>
<option  style="font-size:140%"    value="tres tres grand" onClick="javascript:bbcode('[size=2]', '[/size]');return(false)">كبير جدا</option>


</select>


<br /><br />
<img src="./images/smileys/heureux.gif" title="heureux" alt="heureux" onClick="javascript:smilies(' :D ');return(false)" />
<img src="./images/smileys/lol.gif" title="lol" alt="lol" onClick="javascript:smilies(' :lol: ');return(false)" />
<img src="./images/smileys/triste.gif" title="triste" alt="triste" onClick="javascript:smilies(' :triste: ');return(false)" />
<img src="./images/smileys/cool.gif" title="cool" alt="cool" onClick="javascript:smilies(' :frime: ');return(false)" />
<img src="./images/smileys/rire.gif" title="rire" alt="rire" onClick="javascript:smilies(' :rire:');return(false)" />
<img src="./images/smileys/confus.gif" title="confus" alt="confus" onClick="javascript:smilies(' :s ');return(false)" />
<img src="./images/smileys/choc.gif" title="choc" alt="choc" onClick="javascript:smilies(' :o ');return(false)" />
<img src="./images/smileys/question.gif" title="?" alt="?" onClick="javascript:smilies(' :interrogation: ');return(false)" />
<img src="./images/smileys/exclamation.gif" title="!" alt="!" onClick="javascript:smilies(' :exclamation: ');return(false)" />
</fieldset>
 
<fieldset><legend>المشاركة</legend><textarea cols="80" rows="8" id="message" name="message"></textarea></fieldset>
 
<input type="submit" id="submit" name="submit" value="إرسال " />
<input type="reset"  id="submit" name = "Effacer" value = "حذف"/>
</p></form></div>

<?php
break;
 }
case "nouveautopic":
if (verif_auth($data['auth_topic']))
{

?>
 
<h1>موضوع جديد</h1>
<form method="post" action="postok.php?action=nouveautopic&amp;f=<?php echo $forum ?>" name="formulaire">
 <div id="bbcode">
<fieldset><legend>العنوان</legend>
<input type="text" size="80" id="titre" name="titre" /></fieldset>
 
<fieldset><legend>التنسيق</legend>
<input type="button" id="gras" name="gras" value="غليظ" onClick="javascript:bbcode('[g]', '[/g]');return(false)" />
<input type="button" id="italic" name="italic" value="مائل" onClick="javascript:bbcode('[i]', '[/i]');return(false)" />
<input type="button" class="choix" name="souligne" value="مسطر" onClick="javascript:bbcode('[s]', '[/s]');return(false)" />
<input type="button" id="lien" name="lien" value="رابط" onClick="javascript:bbcode('[url]', '[/url]');return(false)" />
<input type="button" id="image" name="image" value="صورة" onClick="javascript:bbcode('[img]', '[/img]');return(false)" />

<select class="choix">
<option  >كود</option>
<option  id="php" name="php" value="php" onClick="javascript:bbcode('<code=php>', '</code>');return(false)">php</option>
<option  id="java" name="java" value="java" onClick="javascript:bbcode('<code=java>', '</code>');return(false)">java</option>
<option  id="html" name="html" value="html" onClick="javascript:bbcode('<code=xhtml>', '</code>');return(false)">(x)html</option>
<option  id="css" name="css" value="css" onClick="javascript:bbcode('<code=css>', '</code>');return(false)">css</option>
<option  id="sql" name="sql" value="sql" onClick="javascript:bbcode('<code=sql>', '</code>');return(false)">sql</option>
<option  id="C" name="C" value="C" onClick="javascript:bbcode('<code=c>', '</code>');return(false)">C</option>
<option  id="C++" name="C++" value="C++" onClick="javascript:bbcode('<code=c++>', '</code>');return(false)">C++</option>

</select>
<select class="choix">
<option  >لون</option>
<option style="color:red" id="red" name="red" value="أحمر" onClick="javascript:bbcode('[color=red]', '[/color]');return(false)">red</option>
<option  style="color:blue" id="bleu" name="bleu" value="أزرق" onClick="javascript:bbcode('[color=blue]', '[/color]');return(false)">blue</option>
<option  id="black" name="black" value="أسود" onClick="javascript:bbcode('[color=black]', '[/color]');return(false)">black</option>
<option  style="color:green" id="green" name="أخضر" value="green" onClick="javascript:bbcode('[color=green]', '[/color]');return(false)">green</option>
<option  style="color:orange" id="orange" name="برتقالي" value="orange" onClick="javascript:bbcode('[color=orange]', '[/color]');return(false)">orange</option>

</select>
</select>
<select class="choix">
<option >حجم</option>
<option  style="font-size:80%"    value="petit" onClick="javascript:bbcode('[size=6]', '[/size]');return(false)">صغير جدا</option>
<option  style="font-size:90%"    value="tres petit" onClick="javascript:bbcode('[size=5]', '[/size]');return(false)">صغير</option>
<option  style="font-size:110%"   value="grand" onClick="javascript:bbcode('[size=4]', '[/size]');return(false)">عادي</option>
<option  style="font-size:120%"    value="tres grand" onClick="javascript:bbcode('[size=3]', '[/size]');return(false)">كبير</option>
<option  style="font-size:140%"    value="tres tres grand" onClick="javascript:bbcode('[size=2]', '[/size]');return(false)">كبير جدا</option>


</select>


<br /><br />
<img src="./images/smileys/heureux.gif" title="heureux" alt="heureux" onClick="javascript:smilies(' :D ');return(false)" />
<img src="./images/smileys/lol.gif" title="lol" alt="lol" onClick="javascript:smilies(' :lol: ');return(false)" />
<img src="./images/smileys/triste.gif" title="triste" alt="triste" onClick="javascript:smilies(' :triste: ');return(false)" />
<img src="./images/smileys/cool.gif" title="cool" alt="cool" onClick="javascript:smilies(' :frime: ');return(false)" />
<img src="./images/smileys/rire.gif" title="rire" alt="rire" onClick="javascript:smilies(' :rire:');return(false)" />
<img src="./images/smileys/confus.gif" title="confus" alt="confus" onClick="javascript:smilies(' :s ');return(false)" />
<img src="./images/smileys/choc.gif" title="choc" alt="choc" onClick="javascript:smilies(' :o ');return(false)" />
<img src="./images/smileys/question.gif" title="?" alt="?" onClick="javascript:smilies(' :interrogation: ');return(false)" />
<img src="./images/smileys/exclamation.gif" title="!" alt="!" onClick="javascript:smilies(' :exclamation: ');return(false)" />
</fieldset>
 
<fieldset><legend>المشاركة</legend>
<textarea cols="80" rows="8" id="message" name="message"></textarea>
<?php
if (verif_auth($data['auth_annonce']))
{
    ?>

<label><input type="radio" name="mess" value="Annonce" />بيان</label>
<label><input type="radio" name="mess" value="Message" checked="checked" />موضوع</label>
 <?php
}
?>

</fieldset>
<p>
<input type="submit"id="submit" name="submit" value="إرسال" />
<input type="reset" name = "Effacer" value = "حذف" /></p></div>
</form>
<?php
break;
include("mcode.php");
}
?>
<?php
case "edit": //Si on veut éditer le post
    //On récupère la valeur de p
    $post = (int) $_GET['p'];
    echo'<h1>تعديل</h1>';
 
    //On lance enfin notre requête
 
    $query=$db->prepare('SELECT post_createur, post_texte, auth_modo FROM forum_post
    LEFT JOIN forum_forum ON forum_post.post_forum_id = forum_forum.forum_id
    WHERE post_id=:post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();

    $text_edit = $data['post_texte']; //On récupère le message

    //Ensuite on vérifie que le membre a le droit d'être ici (soit le créateur soit un modo/admin) 
    if (!verif_auth($data['auth_modo']) && $data['post_createur'] != $id)
    {
        // Si cette condition n'est pas remplie ça va barder :o
        erreur(ERR_AUTH_EDIT);
    }
    else //Sinon ça roule et on affiche la suite
    {
        //Le formulaire de postage
        ?>
        <form method="post" action="postok.php?action=edit&amp;p=<?php echo $post ?>" name="formulaire">
<fieldset><legend>التنسيق</legend>
<input type="button" id="gras" name="gras" value="غليظ" onClick="javascript:bbcode('[g]', '[/g]');return(false)" />
<input type="button" id="italic" name="italic" value="مائل" onClick="javascript:bbcode('[i]', '[/i]');return(false)" />
<input type="button" class="choix" name="souligne" value="مسطر" onClick="javascript:bbcode('[s]', '[/s]');return(false)" />
<input type="button" id="lien" name="lien" value="رابط" onClick="javascript:bbcode('[url]', '[/url]');return(false)" />
<input type="button" id="image" name="image" value="صورة" onClick="javascript:bbcode('[img]', '[/img]');return(false)" />

<select class="choix">
<option  >كود</option>
<option  id="php" name="php" value="php" onClick="javascript:bbcode('<code=php>', '</code>');return(false)">php</option>
<option  id="java" name="java" value="java" onClick="javascript:bbcode('<code=java>', '</code>');return(false)">java</option>
<option  id="html" name="html" value="html" onClick="javascript:bbcode('<code=xhtml>', '</code>');return(false)">(x)html</option>
<option  id="css" name="css" value="css" onClick="javascript:bbcode('<code=css>', '</code>');return(false)">css</option>
<option  id="sql" name="sql" value="sql" onClick="javascript:bbcode('<code=sql>', '</code>');return(false)">sql</option>
<option  id="C" name="C" value="C" onClick="javascript:bbcode('<code=c>', '</code>');return(false)">C</option>
<option  id="C++" name="C++" value="C++" onClick="javascript:bbcode('<code=c++>', '</code>');return(false)">C++</option>

</select>
<select class="choix">
<option  >لون</option>
<option style="color:red" id="red" name="red" value="أحمر" onClick="javascript:bbcode('[color=red]', '[/color]');return(false)">red</option>
<option  style="color:blue" id="bleu" name="bleu" value="أزرق" onClick="javascript:bbcode('[color=blue]', '[/color]');return(false)">blue</option>
<option  id="black" name="black" value="أسود" onClick="javascript:bbcode('[color=black]', '[/color]');return(false)">black</option>
<option  style="color:green" id="green" name="أخضر" value="green" onClick="javascript:bbcode('[color=green]', '[/color]');return(false)">green</option>
<option  style="color:orange" id="orange" name="برتقالي" value="orange" onClick="javascript:bbcode('[color=orange]', '[/color]');return(false)">orange</option>

</select>
</select>
<select class="choix">
<option >حجم</option>
<option  style="font-size:80%"    value="petit" onClick="javascript:bbcode('[size=6]', '[/size]');return(false)">صغير جدا</option>
<option  style="font-size:90%"    value="tres petit" onClick="javascript:bbcode('[size=5]', '[/size]');return(false)">صغير</option>
<option  style="font-size:110%"   value="grand" onClick="javascript:bbcode('[size=4]', '[/size]');return(false)">عادي</option>
<option  style="font-size:120%"    value="tres grand" onClick="javascript:bbcode('[size=3]', '[/size]');return(false)">كبير</option>
<option  style="font-size:140%"    value="tres tres grand" onClick="javascript:bbcode('[size=2]', '[/size]');return(false)">كبير جدا</option>


</select>


<br /><br />
<img src="./images/smileys/heureux.gif" title="heureux" alt="heureux" onClick="javascript:smilies(' :D ');return(false)" />
<img src="./images/smileys/lol.gif" title="lol" alt="lol" onClick="javascript:smilies(' :lol: ');return(false)" />
<img src="./images/smileys/triste.gif" title="triste" alt="triste" onClick="javascript:smilies(' :triste: ');return(false)" />
<img src="./images/smileys/cool.gif" title="cool" alt="cool" onClick="javascript:smilies(' :frime: ');return(false)" />
<img src="./images/smileys/rire.gif" title="rire" alt="rire" onClick="javascript:smilies(' :rire:');return(false)" />
<img src="./images/smileys/confus.gif" title="confus" alt="confus" onClick="javascript:smilies(' :s ');return(false)" />
<img src="./images/smileys/choc.gif" title="choc" alt="choc" onClick="javascript:smilies(' :o ');return(false)" />
<img src="./images/smileys/question.gif" title="?" alt="?" onClick="javascript:smilies(' :interrogation: ');return(false)" />
<img src="./images/smileys/exclamation.gif" title="!" alt="!" onClick="javascript:smilies(' :exclamation: ');return(false)" />
</fieldset>
 
<fieldset><legend>المشاركة</legend><textarea cols="80" rows="8" id="message" name="message"><?php echo $text_edit ?>
        </textarea>
        </fieldset>
        <p>
        <input type="submit" id="submit" name="submit" value="تعديل !" />
        <input type="reset" name = "Effacer" value = "حذف"/></p>
        </form>
        <?php
    }
break; //Fin de ce cas :o
case "delete": //Si on veut supprimer le post
    //On récupère la valeur de p
    $post = (int) $_GET['p'];
    //Ensuite on vérifie que le membre a le droit d'être ici
    echo'<h1>Suppression</h1>';
    $query=$db->prepare('SELECT post_createur, auth_modo
    FROM forum_post
    LEFT JOIN forum_forum ON forum_post.post_forum_id = forum_forum.forum_id
    WHERE post_id= :post');
    $query->bindValue(':post',$post,PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
 
    if (!verif_auth($data['auth_modo']) && $data['post_createur'] != $id)
    {
        // Si cette condition n'est pas remplie ça va barder :o
        erreur(ERR_AUTH_DELETE); 
    }
    else //Sinon ça roule et on affiche la suite
    {
        echo'<p>هل أنت متأكد من أنك تريد حدفه ؟</p>';
        echo'<p><a href="./postok.php?action=delete&amp;p='.$post.'">نعم</a> ou <a href="./forum.php">لا</a></p>';
    }
    $query->CloseCursor();
break;

default: //Si jamais c'est aucun de ceux là c'est qu'il y a eu un problème :o
echo'<p>هده العملية مستحيلة</p>';
} //Fin du switch
?>
</div>
</body>
</html>
