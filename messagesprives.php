<?php
session_start();
$titre="Messages Privés";
$balises = true;
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("./includes/mcode.php");

$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';
switch($action) //On switch sur $action
{
case "consulter": //Si on veut lire un message
 
    echo'<p><i>أنت الآن هنا :</i> : <a href="./forum.php">المنتدى</a> --> <a href="./messagesprives.php">رسالة خاصة</a> --> قراءة رسالة</p>';
    $id_mess = (int) $_GET['id']; //On récupère la valeur de l'id
    echo '<h1>قراءة رسالة</h1><br /><br />';

    //La requête nous permet d'obtenir les infos sur ce message :
    $query = $db->prepare('SELECT  mp_expediteur, mp_receveur, mp_titre,               
    mp_time, mp_text, mp_lu, membre_id, membre_pseudo, membre_avatar,
    membre_localisation, membre_inscrit, membre_post, membre_signature
    FROM forum_mp
    LEFT JOIN forum_membres ON membre_id = mp_expediteur
    WHERE mp_id = :id');
    $query->bindValue(':id',$id_mess,PDO::PARAM_INT);
    $query->execute();
    $data=$query->fetch();

    // Attention ! Seul le receveur du mp peut le lire !
    if ($id != $data['mp_receveur']) erreur(ERR_WRONG_USER);
       
    //bouton de réponse
    echo'<p><a href="./messagesprives.php?action=repondre&amp;dest='.$data['mp_expediteur'].'">
    <img src="./images/repondre.gif" alt="Répondre" 
    title="الرد على هده الرسالة" /></a></p>'; 
?>
<table>     
    <tr>
    <th class="vt_auteur"><strong>الكاتب</strong></th>             
    <th class="vt_mess"><strong>الرسالة</strong></th>       
    </tr>
    <tr>
    <td>
    <?php echo'<strong>
    <a href="./voirprofil.php?m='.$data['membre_id'].'&amp;action=consulter">
    '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></strong></td>
    <td>أضيف في '.date('H\hi  d M Y',$data['mp_time']).'</td>';
    ?>
    </tr>
    <tr>
    <td>
    <?php
        
    //Ici des infos sur le membre qui a envoyé le mp
    echo'<p><img src="./images/avatars/'.$data['membre_avatar'].'" alt="" />
    <br />عضو مند '.date('d/m/Y',$data['membre_inscrit']).'
    <br />المشاركات : '.$data['membre_post'].'
    <br />العنوان : '.stripslashes(htmlspecialchars($data['membre_localisation'])).'</p>
    </td><td>';
        
    echo zcode(stripslashes(htmlspecialchars($data['mp_text']))).'
    <hr />'.zcode(stripslashes(htmlspecialchars($data['membre_signature']))).'
    </td></tr></table>';


  if ($data['mp_lu'] == 0) //Si le message n'a jamais été lu
    {
        $query->CloseCursor();
        $query=$db->prepare('UPDATE forum_mp 
        SET mp_lu = :lu
        WHERE mp_id= :id');
        $query->bindValue(':id',$id_mess, PDO::PARAM_INT);
        $query->bindValue(':lu','1', PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();
    }
        
break; //La fin !

case "nouveau": //Nouveau mp
       
   echo'<p><i>أنت الآن هنا :</i> : <a href="./forum.php">المنتدى</a> --> <a href="./messagesprives.php">الرسائل الخاصة</a> --> كتابة رسالة</p>';
   echo '<h1>رسالة خاصة جديدة</h1><br /><br />';
   ?>
   <div id="bbcode">
   <form method="post" action="postok.php?action=nouveaump" name="formulaire">
   <p>
     <label for="to">إلى : </label>
   <input type="text" size="30" id="to" name="to" />
   <br />
   <label for="titre">العنوان</label>
   <input type="text" size="80" id="titre" name="titre" />
   <br /><br />

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
 
<fieldset><legend>الرسالة</legend><textarea cols="80" rows="8" id="message" name="message"></textarea></fieldset>
 
<input type="submit" id="submit" name="submit" value="إرسال" />
<input type="reset" name = "Effacer" value = "حذف"/>
</p></form></div>
   <?php   
break;


case "repondre": //On veut répondre
   echo'<p><i>أنت الآن هنا :</i> : <a href="./forum.php">المنتدى</a> --> <a href="./messagesprives.php">الرسائل الخاصة</a> --> كتابة رسالة</p>';
   echo '<h1>الرد على رسالة خاصة</h1><br /><br />';

   $dest = (int) $_GET['dest'];
   ?>
   <form method="post" action="postok.php?action=repondremp&amp;dest=<?php echo $dest ?>" name="formulaire">
   <p>
   <label for="titre">عنوان : </label><input type="text" size="80" id="titre" name="titre" />
   <br /><br />
   <<fieldset><legend>التنسيق</legend>
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
 
<fieldset><legend>الرسالة</legend>
   <br /><br />
   <textarea cols="80" rows="8" id="message" name="message"></textarea></fieldset>
   <br />
   <input type="submit" name="submit" value="إرسال" />
   <input type="reset" name="Effacer" value="حذف"/>
   </p></form>
   <?php
break;


 case "supprimer":
       
    //On récupère la valeur de l'id
    $id_mess = (int) $_GET['id'];
    //Il faut vérifier que le membre est bien celui qui a reçu le message
    $query=$db->prepare('SELECT mp_receveur
    FROM forum_mp WHERE mp_id = :id');
    $query->bindValue(':id',$id_mess,PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();
    //Sinon la sanction est terrible :p
    if ($id != $data['mp_receveur']) erreur(ERR_WRONG_USER);
    $query->CloseCursor(); 

    //2 cas pour cette partie : on est sûr de supprimer ou alors on ne l'est pas
    $sur = (int) $_GET['sur'];
    //Pas encore certain
    if ($sur == 0)
    {
    echo'<p>هل أنت متأكد من حذف هده الرسالة ؟<br />
    <a href="./messagesprives.php?action=supprimer&amp;id='.$id_mess.'&amp;sur=1">
    نعم</a> - <a href="./messagesprives.php">لا</a></p>';
    }
    //Certain
    else
    {
        $query=$db->prepare('DELETE from forum_mp WHERE mp_id = :id');
        $query->bindValue(':id',$id_mess,PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor(); 
        echo'<p>الرسالة حذفت بنجاح.<br />
        اضغط  <a href="./messagesprives.php">هنا</a> للرجوع الى بريد السائل
        </p>';
    }

    break;
//Si rien n'est demandé ou s'il y a une erreur dans l'url 
//On affiche la boite de mp.
default;
    
    echo'<p><i>أنت الآن هنا :</i> : <a href="./forum.php">المنتدى</a> --> <a href="./messagesprives.php">الرسائل الخاصة</a>';
    echo '<h1>الرسائل الخاصة</h1><br /><br />';

    $query=$db->prepare('SELECT mp_lu, mp_id, mp_expediteur, mp_titre, mp_time, membre_id, membre_pseudo
    FROM forum_mp
    LEFT JOIN forum_membres ON forum_mp.mp_expediteur = forum_membres.membre_id
    WHERE mp_receveur = :id ORDER BY mp_id DESC');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    echo'<p><a href="./messagesprives.php?action=nouveau">
    <img src="./images/nouveau.gif" alt="جديد" title="رسالة جديدة" />
    </a></p>';
    if ($query->rowCount()>0)
    {
        ?>
        <table>
        <tr>
        <th></th>
        <th class="mp_titre"><strong>العنوان</strong></th>
        <th class="mp_expediteur"><strong>المرسل</strong></th>
        <th class="mp_time"><strong>التاريخ</strong></th>
        <th><strong>العملية</strong></th>
        </tr>

        <?php
        //On boucle et on remplit le tableau
        while ($data = $query->fetch())
        {
            echo'<tr>';
            //Mp jamais lu, on affiche l'icone en question
            if($data['mp_lu'] == 0)
            {
            echo'<td><img src="./images/icone/message_non_lu.png" alt="غير مقروء" /></td>';
            }
            else //sinon une autre icone
            {
            echo'<td><img src="./images/icone/message.png" alt="تم قرائته" /></td>';
            }
            echo'<td id="mp_titre">
            <a href="./messagesprives.php?action=consulter&amp;id='.$data['mp_id'].'">
            '.stripslashes(htmlspecialchars($data['mp_titre'])).'</a></td>
            <td id="mp_expediteur">
            <a href="./voirprofil.php?action=consulter&amp;m='.$data['membre_id'].'">
            '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></td>
            <td id="mp_time">'.date('H\hi  d M Y',$data['mp_time']).'</td>
            <td>
            <a href="./messagesprives.php?action=supprimer&amp;id='.$data['mp_id'].'&amp;sur=0">حذف</a></td></tr>';
        } //Fin de la boucle
        $query->CloseCursor();
        echo '</table>';

    } //Fin du if
    else
    {
        echo'<p>لاتملك أي رسالة اضغط 
        <a href="./forum.php">هنا</a> للرجوع لصفحة البداية</p>';
    }
} //Fin du switch
?>
</div>
</body>
</html>



