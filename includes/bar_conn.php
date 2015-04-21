
<?php

if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
{
	 echo '<div id="bar_de_con"><form method="post" action="connexion.php">
	 
	 
	 <p>
	 Connexion
	 <label for="pseudo">اسم المستعار :</label><input name="pseudo" type="text" id="pseudo" /><br />
	 <label for="password">كلمة السر :</label><input type="password" name="password" id="password" /><br/>
	  <a href="./register.php">تسجيل</a><br/>
	 <input type="submit" class="submit"  value="Connexion" /></p>
	 
	</form>
	
	 
    	</div>
    	';
}

?>