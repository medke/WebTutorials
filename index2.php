<?session_start()?><?php

function chargerClasse($classname)
    {
        require $classname.'.class.php';
    }
    
 spl_autoload_register('chargerClasse');
 
session_start();
$titre='Index du Forum';
include("includes/identifiants.php");
include("includes/debut.php");
include("./includes/menu.php");
include("./includes/mcode.php");
echo'<p><i>أنت الآن هنا : </i><a href ="./index.php">فايندرز</a>-->بداية</p>';

$sondage = new Sondage(array(),$db);
$sondage->getSondage();
echo'<div id="range">
<div class="bloc">
<form action="./traite_sonadage.php"  method="post">

<div class="line_hor1"><img src="images/design/1_t3.gif" alt=""/></div>

 <p><strong><em>'.  $sondage->getTitre() .'</em></strong>
       <br /><br />
       <input type="radio" name="choix"   value="1"/>'. $sondage->getChoix1() .'<br />
       <input type="radio" name="choix"   value="2"/>'. $sondage->getChoix2() .'<br />
       <input type="radio" name="choix"   value="3"/>'. $sondage->getChoix3() .'<br />
       <input type="radio" name="choix"   value="4"/>'. $sondage->getChoix4() .'<br /> <br /><input type="submit" class="submit"  value="Envoyer" />
     
	   <input type="hidden" name="id" value="'.$sondage->getId().'" />
   </p>

</form>
</div>
';
echo'
<div class="bloc_r">';
include("./demos.php");
echo'</div></div>'
?>
</div>
<div id="footer">
 <p>
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="http://www.w3.org/Icons/valid-xhtml10"
        alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
  </p>
  
<p> Fienders copyright©2011 </p><p><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.0/fr/"><img alt="Contrat Creative 
Commons" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/2.0/fr/88x31.png" /></a><br />
<span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type">
site communautaire de tutoriel</span> de
 <a xmlns:cc="http://creativecommons.org/ns#" href="www.fienders.com" property="cc:attributionName" rel="cc:attributionURL">
 kettouch mohamed</a> est mis à disposition selon les termes de la <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.0/fr/">
 licence Creative Commons Paternité - Pas d'Utilisation Commerciale - Partage à l'Identique 2.0 France</a>.<br />Basé(e) sur une oeuvre à 
 <a xmlns:dct="http://purl.org/dc/terms/" href="www.fienders.com" rel="dct:source">www.fienders.com</a>.<br />Les autorisations au-delà du champ de cette licence 
peuvent être obtenues à <a xmlns:cc="http://creativecommons.org/ns#" href="www.fienders.com" rel="cc:morePermissions">www.fienders.com</a>.</p>
 </div>
 </body>
</html>
