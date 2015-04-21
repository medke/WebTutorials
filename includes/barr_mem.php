<div id="bar_du_membre">
<?php 
 $query=$db->prepare('SELECT  membre_pseudo,membre_avatar
        FROM forum_membres WHERE membre_id = :id');
		$query->bindValue(':id',htmlspecialchars($_SESSION['id']), PDO::PARAM_STR);
        $query->execute();
		$data=$query->fetch();

echo('<table> <td><img src="./images/avatars/'.htmlspecialchars($data['membre_avatar']).'" alt="membre  " /></td><td><a href="./voirprofil.php?m='.stripslashes(htmlspecialchars(  $_SESSION['id'] )).'&amp;action=consulter">'.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a><br/><a href="./deconnexion.php">خروج</a> 
 <br/><strong><a href="messagesprives.php">رسائل</a></strong><br/><strong><a href="./mes_tuto.html">دروسي</a></strong>
<div id="liste">
<ul>
    <li>
       <p>تعديل<p> 
	   
     <ul>
          <li>
            <a href="./voirprofil.php?m='.htmlspecialchars($_SESSION['id']).'&amp;action=modifier">الملف الشخصي</a>
          </li>
          <li>
            <a href="./voirprofil.php?m='.htmlspecialchars($_SESSION['id']).'&amp;action=modifier_mdp">كلمة السر</a>
          </li>
     </ul>
    </li>
</ul>
</div>
</td></table> ');
 
$query=$db->prepare('SELECT mp_lu
    FROM forum_mp
    LEFT JOIN forum_membres ON forum_mp.mp_expediteur = forum_membres.membre_id
    WHERE mp_receveur = :id ORDER BY mp_id DESC');
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();

	
    while ($data = $query->fetch())
        {
            //Mp jamais lu, on affiche l'icone en question
            if($data['mp_lu'] == 0)echo('<p><strong><a href="messagesprives.php">(رسالة جديدة)--></a></strong></p>'); 
            }
$query->CloseCursor();
?>
</div>