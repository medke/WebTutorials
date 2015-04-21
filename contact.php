<?php
session_start();
$titre='اتصل بنا ';
include("includes/identifiants.php");
include("includes/debut.php");
include("./includes/menu.php");
include("./includes/mcode.php");
echo'<p><i>أنت الآن هنا : </i><a href ="./index.php">فايندرز</a>-->اتصل بنا</p>';?>
<form id="contact" method="post" action="traitement_formulaire.php">
	<fieldset><legend>معلوماتك</legend>
		<p><label for="nom">اسمك :</label><input type="text" id="nom" name="nom" tabindex="1" /></p>
		<p><label for="email">بريدك الإلكتروني :</label><input type="text" id="email" name="email" tabindex="2" /></p>
	</fieldset>

	<fieldset><legend>رسالتك :</legend>
		<p><label for="objet">الموضوع :</label><input type="text" id="objet" name="objet" tabindex="3" /></p>
		<p><label for="message">الرسالة :</label><textarea id="message" name="message" tabindex="4" cols="30" rows="8"></textarea></p>
	</fieldset>

	<div style="text-align:center;"><input type="submit" name="envoi" value="إرسال !" /></div>
</form>
</div></body></html>