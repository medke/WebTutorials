<?php
session_start();
$titre='sondage';

include("includes/debut.php");


include("includes/identifiants.php");


include("./includes/menu.php");

echo'<i>Vous êtes ici : </i><a href ="./index.php">Index du forum</a>-->sondage';

//debut de la page comme d habitude
if(isset($_POST['choix']))
{
$fchoix=NULL;
$fchoix=htmlspecialchars($_POST['choix']);
$ipchoix=htmlspecialchars($_SERVER['REMOTE_ADDR']);
$idchoix=stripslashes(htmlspecialchars($_POST['id']));
$query=$db->query('SELECT id,vchoix1,vchoix2,vchoix3,vchoix4,tchoix FROM vote WHERE id=\'' . $idchoix . '\'');
$data=$query->fetch();
$vchoix1=(int) htmlspecialchars($data['vchoix1']);
$vchoix2=(int) htmlspecialchars($data['vchoix2']);
$vchoix3=(int) htmlspecialchars($data['vchoix3']);
$vchoix4=(int) htmlspecialchars($data['vchoix4']);
$tchoix =(int)$data['tchoix'];
$query=$db->query('SELECT ip FROM dvote WHERE ip=\'' . $ipchoix . '\' AND id=\'' . $idchoix . '\'');
$data2=$query->rowCount();


if($data2==0){
	$reqt= $db->prepare('INSERT INTO dvote SET id=:id,ip=:ip ');
	$reqt->bindValue(':id', $idchoix);
	$reqt->bindValue(':ip', $ipchoix);
	$reqt->execute();
	$reqt->CloseCursor();
if($tchoix==0){
$requete = $db->prepare('INSERT INTO vote(vchoix1, vchoix2,vchoix3,vchoix4,tchoix,id) VALUES(:choix1,:choix2,:choix3,:choix4,:tchoix,:id)');
$requete->execute(array(
	'choix1' => $vchoix1,
	'choix2' => $vchoix2,
	'choix3' => $vchoix3,
	'choix4' => $vchoix4,
	'tchoix' => $tchoix ,
	'id' => $idchoix
	));
	

}

if(isset($fchoix)){
$tchoix =$tchoix+1;
switch($fchoix)
{
case 1 :
$vchoix1=$vchoix1+1;
break;
case 2 :
$vchoix2=$vchoix2+1;
break;
case 3 :
$vchoix3=$vchoix3+1;
break;
case 4 :
$vchoix4=$vchoix4+1;
break;
}


}
$req = $db->prepare('UPDATE vote SET vchoix1 =:choix1, vchoix2= :choix2, vchoix3= :choix3, vchoix4= :choix4 ,tchoix= :tchoix WHERE id =:id');
$req->execute(array(
	'choix1' => $vchoix1,
	'choix2' => $vchoix2,
	'choix3' => $vchoix3,
	'choix4' => $vchoix4,
	'tchoix' => $tchoix ,
	'id' => $idchoix
	));
	$req->CloseCursor();
	

    $query=$db->query('SELECT id,titre,choix1,choix2,choix3,choix4 FROM sondage ORDER BY id DESC');
    $data=$query->fetch();
	$mvchoix1=(int)(($vchoix1/$tchoix)*100);
    $mvchoix2=(int)(($vchoix2/$tchoix)*100);
	$mvchoix3=(int)(($vchoix3/$tchoix)*100);
	$mvchoix4=(int)(($vchoix4/$tchoix)*100);
	?>
<div class="bloc_s">
		<form>
   <table>
       <h4><strong><?php echo  $data['titre'] ?></strong><?php echo(' <em style="color:blue; font-size:80%;"> =>'.$tchoix.'  sont voté dans ce sondage  </em>'); ?></strong></h4>
   <tr> <th>sondage</th><th>vote</th><th>moyenne</th></tr>

       
       <tr> <td><?php echo $data['choix1']  ;?></td><td><?php echo(''.$vchoix1.'   </td><td>'.$mvchoix1.'%');   ?></em></td></tr>
       <tr> <td> <?php echo $data['choix2']  ;?></td><td><?php echo(''.$vchoix2.' </td><td>'.$mvchoix2.'%');   ?></em></td></tr>
       <tr> <td><?php echo $data['choix3']  ;?></td><td><?php echo(''.$vchoix3.'   </td><td>'.$mvchoix3.'%');   ?></em></td></tr>
       <tr> <td><?php echo $data['choix4']  ;?></td><td><?php echo(''.$vchoix4.'  </td><td> '.$mvchoix4.'%');   ?></em></td></tr><td><em style="color:red; font-size:85%;">merci pour ton vote</em> <br /><td></td><td></td></td></td></tr>
      
	   <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
   
   </table>
   </form>
   </div>
	<?php
	}else{ 
	$query=$db->query('SELECT id,titre,choix1,choix2,choix3,choix4 FROM sondage ORDER BY id DESC');
    $data=$query->fetch();
	$mvchoix1=(int)(($vchoix1/$tchoix)*100);
    $mvchoix2=(int)(($vchoix2/$tchoix)*100);
	$mvchoix3=(int)(($vchoix3/$tchoix)*100);
	$mvchoix4=(int)(($vchoix4/$tchoix)*100);
?>
<div class="bloc_s">
		
		<div class="line_hor1"><img src="images/design/1_t3.gif" alt=""></div>
   <table>
  
    <h4><strong><?php echo  $data['titre'] ?></strong><?php echo(' <em style="color:blue; font-size:80%;"> =>'.$tchoix.'  sont voté dans ce sondage  </em>'); ?></strong></h4>
       <th >sondage</th><th> nombre de vote </th><th>pourcentage</th>
       <tr> <td><?php echo $data['choix1']  ;?></td><td><?php echo(''.$vchoix1.'   </td><td>'.$mvchoix1.'%');   ?></em></td></tr>
       <tr> <td> <?php echo $data['choix2']  ;?></td><td><?php echo(''.$vchoix2.' </td><td>'.$mvchoix2.'%');   ?></em></td></tr>
       <tr> <td><?php echo $data['choix3']  ;?></td><td><?php echo(''.$vchoix3.'   </td><td>'.$mvchoix3.'%');   ?></em></td></tr>
       <tr> <td><?php echo $data['choix4']  ;?></td><td><?php echo(''.$vchoix4.'  </td><td> '.$mvchoix4.'%');   ?></em></td></tr><td><em style="color:red; font-size:85%;">tu as dejas voté</em> </td>
      
	   <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
   
   </table>
  
   </div>
<?php
    }}else{echo'<p><br/><br/>impossible</p>';}	

?>

</body>
</html>

