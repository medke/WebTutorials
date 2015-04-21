<?php

$query=$db->query('SELECT id,titre,choix1,choix2,choix3,choix4 FROM sondage ORDER BY id DESC');
$data=$query->fetch();
$choix1=htmlspecialchars($data['choix1']);
$choix2=htmlspecialchars($data['choix2']);
$choix3=htmlspecialchars($data['choix3']);
$choix4=htmlspecialchars($data['choix4']);
$titre=htmlspecialchars($data['titre']);
if($titre!=''){
?>

<form action="./traite_sonadage.php"  method="post">
<table id="sondage">
<tr> <th>sondage</th></tr>
 <tr><td><p><strong><em><?php echo  $titre ;?></em></strong>
       <br /><br />
       <input type="radio" name="choix"  id="radio" value="1"/> <?php echo $choix1  ?><br />
       <input type="radio" name="choix"  id="radio" value="2"/> <?php echo $choix2  ?><br />
       <input type="radio" name="choix"  id="radio" value="3"/> <?php echo $choix3 ?><br />
       <input type="radio" name="choix"  id="radio" value="4"/> <?php echo $choix4  ?><br /> <br /><input type="submit" id="submit"  value="Envoyer" /></td></tr>
     
	   <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
   </p>
   </table>
</form>

<?php } ?>

