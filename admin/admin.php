<?php
session_start();
$titre="Administration";
$balises = true;
include("../includes/identifiants.php");
include("../includes/debut.php");
//menu normal masslohche
echo'<body>';
echo'<div id="corps_forum">';


//---------------------
include("../includes/mcode.php"); 

$cat = (isset($_GET['cat']))?htmlspecialchars($_GET['cat']):'';

echo'<p><i>Vous �tes ici</i> : <a href="./index.php">Index du forum</a> -->  <a href="./admin.php">Administration du forum</a>';
if (!verif_auth(ADMIN))  erreur("<h1>vous etes pas mon admisnitrateur</h1>");

switch($cat) //1er switch
{
case "config":

	echo'<h1>Configuration du forum</h1>';
	echo '<form method="post" action="adminok.php?cat=config">';

	//Le tableau associatif
	$config_name = array(
	"avatar_maxsize" => "Taille maximale de l avatar",
	"avatar_maxh" => "Hauteur maximale de l avatar",
	"avatar_maxl" => "Largeur maximale de l avatar",
	"sign_maxl" => "Taille maximale de la signature",
	"auth_bbcode_sign" => "Autoriser le bbcode dans la signature",
	"pseudo_maxsize" => "Taille maximale du pseudo",
	"pseudo_minsize" => "Taille minimale du pseudo",
	"topic_par_page" => "Nombre de topics par page",
	"post_par_page" => "Nombre de posts par page",
	"forum_titre" => "Titre du forum"
	);
	$query = $db->query('SELECT config_nom, config_valeur FROM forum_config');
	
	while($data=$query->fetch())
	{
           echo '<p><label for='.$data['config_nom'].'>'.$config_name[$data['config_nom']].' </label> :
           <input type="text" id="'.$data['config_nom'].'" value="'.$data['config_valeur'].'" name="'.$data['config_nom'].'"></p>';
	}
	echo '<p><input type="submit" value="Envoyer" /></p></form>';
	$query->CloseCursor();

break;
 
case "forum":
//Ici forum
if (isset($_GET['action'])){
$action = htmlspecialchars($_GET['action']); //On r�cup�re la valeur de action
}else{
$action ='';
}
        switch($action) //2eme switch
        {
        case "creer":
         if(empty($_GET['c']))
        {
                echo'<br /><br /><br />Que voulez-vous faire?<br />
                <a href="./admin.php?cat=forum&action=creer&c=f">Cr�er un forum</a><br />
                <a href="./admin.php?cat=forum&action=creer&c=c">Cr�er une cat�gorie</a></br>';
        }

        //2�me cas : on cherche � cr�er un forum (c=f)
        elseif($_GET['c'] == "f")
        {
                $query=$db->query('SELECT cat_id, cat_nom FROM forum_categorie
                ORDER BY cat_ordre DESC');
                echo'<h1>Cr�ation d un forum</h1>';
                echo'<form method="post" action="./adminok.php?cat=forum&action=creer&c=f">';
                echo'<label>Nom :</label><input type="text" id="nom" name="nom" /><br /><br />
                <label>Description :</label>
                <textarea cols=40 rows=4 name="desc" id="desc"></textarea>
                <br /><br />
                <label>Cat�gorie : </label><select name="cat">';
                while($data = $query->fetch())
                {
		    echo'<option value="'.$data['cat_id'].'">'.$data['cat_nom'].'</option>';
                }
                echo'</select><br /><br />
                <input type="submit" value="Envoyer"></form>';
		$query->CloseCursor();
        }       
        //3�me cas : on cherche � cr�er une cat�gorie (c=c)
        elseif($_GET['c'] == "c")
        {
                echo'<h1>Cr�ation d une cat�gorie</h1>';
                echo'<form method="post" action="adminok.php?cat=forum&action=creer&c=c">';
                echo'<label> Indiquez le nom de la cat�gorie :</label>
                <input type="text" id="nom" name="nom" /><br /><br />   
                <input type="submit" value="Envoyer"></form>';
        }

        break;
        
		
        case "edit":
        echo'<h1>Edition d un forum</h1>';
       
        if(!isset($_GET['e']))
        {
                echo'<p>Que voulez vous faire ?<br />
                <a href="./admin.php?cat=forum&action=edit&amp;e=editf">
                Editer un forum</a><br />
                <a href="./admin.php?cat=forum&action=edit&amp;e=editc">
                Editer une cat�gorie</a><br />
                <a href="./admin.php?cat=forum&action=edit&amp;e=ordref">
                Changer l ordre des forums</a><br />
                <a href="./admin.php?cat=forum&action=edit&amp;e=ordrec">
                Changer l ordre des cat�gories</a>
                <br /></p>';
        }
elseif($_GET['e'] == "editf")
        {
            //On affiche dans un premier temps la liste des forums
            if(!isset($_POST['forum']))
            {
		$query=$db->query('SELECT forum_id, forum_name
		FROM forum_forum ORDER BY forum_ordre DESC');
			   
		echo'<form method="post" action="admin.php?cat=forum&amp;action=edit&amp;e=editf">';
		echo'<p>Choisir un forum :</br /></h2>
		<select name="forum">';
				   
		while($data = $query->fetch())
		{
		    echo'<option value="'.$data['forum_id'].'">
		    '.stripslashes(htmlspecialchars($data['forum_name'])).'</option>';
		}
		echo'<input type="submit" value="Envoyer"></p></form>';
		$query->CloseCursor();

            }               
            //Ensuite, on affiche les renseignements sur le forum choisi
            else
            {
	        $query = $db->prepare('SELECT forum_id, forum_name, forum_desc,
		forum_cat_id
		FROM forum_forum
		WHERE forum_id = :forum');
		$query->bindValue(':forum',(int) $_POST['forum'],PDO::PARAM_INT);
		$query->execute();
				
		$data1 = $query->fetch();

		echo'<p>Edition du forum
		<strong>'.stripslashes(htmlspecialchars($data1['forum_name'])).'</strong></p>';
				   
		echo'<form method="post" action="adminok.php?cat=forum&amp;action=edit&amp;e=editf">
		<label>Nom du forum : </label><input type="text" id="nom"
		name="nom" value="'.$data1['forum_name'].'" />
		<br />
				   
		<label>Description :</label><textarea cols=40 rows=4 name="desc"
		id="desc">'.$data1['forum_desc'].'</textarea><br /><br />';
		$query->CloseCursor();				  
		//A partir d'ici, on boucle toutes les cat�gories,
		//On affichera en premier celle du forum

		$query = $db->query('SELECT cat_id, cat_nom
		FROM forum_categorie ORDER BY cat_ordre DESC');
		echo'<label>D�placer le forum vers : </label>
		<select name="depl">';
		while($data2 = $query->fetch())
		{
		    if($data2['cat_id'] == $data1['forum_cat_id'])
		    {
		    echo'<option value="'.$data2['cat_id'].'" 
                    selected="selected">'.stripslashes(htmlspecialchars($data2['cat_nom'])).' 
                    </option>';
		    }
		    else
		    {
		        echo'<option value="'.$data2['cat_id'].'">'.$data2['cat_nom'].'</option>';
		    }
	        }
	        echo'</select><input type="hidden" name="forum_id" value="'.$data1['forum_id'].'">';
	        echo'<p><input type="submit" value="Envoyer"></p></form>';
	        $query->CloseCursor();				  
				
            }
        }
		elseif($_GET['e'] == "editc")
        {
            //On commence par afficher la liste des cat�gories
            if(!isset($_POST['cat']))
            {
	        $query = $db->query('SELECT cat_id, cat_nom
		FROM forum_categorie ORDER BY cat_ordre DESC');
		echo'<form method="post" action="admin.php?cat=forum&amp;action=edit&amp;e=editc">';
		echo'<p>Choisir une cat�gorie :</br />
		<select name="cat">';
		while($data = $query->fetch())
		{
		    echo'<option value="'.$data['cat_id'].'">'.$data['cat_nom'].'</option>';
		}
		echo'<input type="submit" value="Envoyer"></p></form>';		
                $query->CloseCursor();				  					
            }         
            //Puis le formulaire
            else
            {
	        $query = $db->prepare('SELECT cat_nom FROM forum_categorie
	        WHERE cat_id = :cat');
		$query->bindValue(':cat',(int) $_POST['cat'],PDO::PARAM_INT);
		$query->execute();
		$data = $query->fetch();
		echo'<form method="post" action="./adminok.php?cat=forum&amp;action=edit&amp;e=editc">';

		echo'<label> Indiquez le nom de la cat�gorie :</label>
		<input type="text" id="nom" name="nom"
		value="'.stripslashes(htmlspecialchars($data['cat_nom'])).'" />
		<br /><br />   
		<input type="hidden" name="cat" value="'.$_POST['cat'].'" />
		<input type="submit" value="Envoyer" /></p></form>';
		$query->CloseCursor();				  
				
            }
        }
		elseif($_GET['e'] == "ordref")
        {
            $categorie="";
            $query = $db->query('SELECT forum_id, forum_name, forum_ordre,
            forum_cat_id, cat_id, cat_nom
            FROM forum_categorie
            LEFT JOIN forum_forum ON cat_id = forum_cat_id
            ORDER BY cat_ordre DESC');

            echo'<form method="post"
            action="adminok.php?cat=forum&amp;action=edit&amp;e=ordref">';
               
            echo '<table>';

            while($data = $query->fetch())
            {
	        if( $categorie !== $data['cat_id'] )
		{
		    $categorie = $data['cat_id'];
		    echo'
		    <tr>       
	            <th><strong>'.stripslashes(htmlspecialchars($data['cat_nom'])).'</strong></th>
		    <th><strong>Ordre</strong></th>
		    </tr>';
		}
		echo'<tr><td>
                <a href="./voirforum.php?f='.$data['forum_id'].'">'.$data['forum_name'].'</a></td>
		<td><input type="text" value="'.$data['forum_ordre'].'" name="'.$data['forum_id'].'" />
                </td></tr>';
            }
            echo'</table>
            <p><input type="submit" value="Envoyer" /></p></form>';
				
        }elseif($_GET['e'] == "ordrec")
        {
            $query = $db->query('SELECT cat_id, cat_nom, cat_ordre
            FROM forum_categorie
            ORDER BY cat_ordre DESC');
 
            echo'<form method="post" action="adminok.php?cat=forum&amp;action=edit&amp;e=ordrec">';
            while($data = $query->fetch())
            {
		echo'<label>'.stripslashes(htmlspecialchars($data['cat_nom'])).' :</label>
		<input type="text" value="'.$data['cat_ordre'].'"name="'.$data['cat_id'].'" /><br /><br />';
            }
            echo '<input type="submit" value="Envoyer" /></form>';
            $query->CloseCursor();				  					
        }
  




        break;
        
        case "droits":
         //Gestion des droits
        echo'<h1>Edition des droits</h1>';     
       
        if(!isset($_POST['forum']))
        {
            $query=$db->query('SELECT forum_id, forum_name
            FROM forum_forum ORDER BY forum_ordre DESC');
            echo'<form method="post" action="admin.php?cat=forum&action=droits">';
            echo'<p>Choisir un forum :</br />
            <select name="forum">';
            while($data = $query->fetch())
            {
                echo'<option value="'.$data['forum_id'].'">'.$data['forum_name'].'</option>';
            }
            echo'<input type="submit" value="Envoyer"></p></form>';
            $query->CloseCursor();				  					
        }
        else
        {
	    $query = $db->prepare('SELECT forum_id, forum_name, auth_view,
	    auth_post, auth_topic, auth_annonce, auth_modo
	    FROM forum_forum WHERE forum_id = :forum');
	    $query->bindValue(':forum',(int) $_POST['forum'], PDO::PARAM_INT);
	    $query->execute();
 
            echo '<form method="post" action="adminok.php?cat=forum&action=droits"><p><table><tr>
	    <th>Lire</th>
	    <th>R�pondre</th>
	    <th>Poster</th>
	    <th>Annonce</th>
	    <th>Mod�rer</th>
	    </tr>';
	    $data = $query->fetch();
		   
	    //Ces deux tableaux vont permettre d'afficher les r�sultats
	    $rang = array(
            VISITEUR=>"Visiteur",
            INSCRIT=>"Membre", 
            MODO=>"Mod�rateur",
            ADMIN=>"Administrateur");
	    $list_champ = array("auth_view", "auth_post", "auth_topic","auth_annonce", "auth_modo");
	 
	    //On boucle
	    foreach($list_champ as $champ)
	    {
	        echo'<td><select name="'.$champ.'">';
		for($i=1;$i<5;$i++)
		{
		    if ($i == $data[$champ])
		    {
		        echo'<option value="'.$i.'" selected="selected">'.$rang[$i].'</option>';
		    }	
		    else
		    {
		        echo'<option value="'.$i.'">'.$rang[$i].'</option>';
		    }
		}
		echo'</td></select>';
	    }	
	    echo'<br /><input type="hidden" name="forum_id" value="'.$data['forum_id'].'" />
	    <input type="submit" value="Envoyer"></p></form>';			          

            $query->CloseCursor();				  					

        }
        echo '</table>';

        break;
        
        default; //action n'est pas remplie, on affiche le menu
        echo'<h1>Administration des forums</h1>';
        echo'<p>Bonjour, cher administrateur :p, que veux tu faire ?
        <br />
        <a href="./admin.php?cat=forum&amp;action=creer">Cr�er un forum</a>
        <br />
        <a href="./admin.php?cat=forum&amp;action=edit">Modifier un forum</a>
        <br />
        <a href="./admin.php?cat=forum&amp;action=droits">
        Modifier les droits d un forum</a><br /></p>';
        break;
        }
break;
 
case "membres":


if (isset($_GET['action'])){
$action = htmlspecialchars($_GET['action']); //On r�cup�re la valeur de action
}else{
$action ='';
}
        switch($action) //2eme switch
        {
        case "edit":
        //hna ta3 les membre 
    $action = htmlspecialchars($_GET['action']); 
    switch($action) //2�me switch
    {
        case "edit":
            echo'<h1>Edition du profil d un membre</h1>';   

            if(!isset($_POST['membre'])) 
            {
                echo'De quel membre voulez-vous �diter le profil ?<br />';
                echo'<br /><form method="post" action="./admin.php?cat=membres&amp;action=edit">
                <p><label for="membre">Inscrivez le pseudo : </label> 
                <input type="text" id="membre" name="membre"><input type="submit" name="Chercher">
                </p></form>';
            }
			else //sinon
        {
            $pseudo_d = $_POST['membre'];

            //Requ�te qui ram�ne des info sur le membre � 
            //Partir de son pseudo
            $query = $db->prepare('SELECT membre_id, 
            membre_pseudo, membre_email,
            membre_siteweb, membre_signature, 
            membre_msn, membre_localisation, membre_avatar
            FROM forum_membres WHERE LOWER(membre_pseudo)=:pseudo');
	    $query->bindValue(':pseudo',strtolower($pseudo_d),PDO::PARAM_STR);
            $query->execute();    
            //Si la requ�te retourne un truc, le membre existe
            if ($data = $query->fetch()) 
            {
		?>
	        <form method="post" action="adminok.php?cat=membres&amp;action=edit" enctype="multipart/form-data">
		<fieldset><legend>Identifiants</legend>
		<label for="pseudo">Pseudo :</label>
		<input type="text" name="pseudo" id="pseudo" 
		value="<?php echo stripslashes(htmlspecialchars($data['membre_pseudo'])) ?>" /><br />
		</fieldset>

		<fieldset><legend>Contacts</legend>
		<label for="email">Adresse E_Mail :</label>
		<input type = "text" name="email" id="email"
		value="<?php echo stripslashes(htmlspecialchars($data['membre_email'])) ?>" /><br />
		<label for="msn">Adresse MSN :</label>
		<input type = "text" name="msn" id="msn"
		value="<?php echo stripslashes(htmlspecialchars($data['membre_msn'])) ?>" /><br />
		<label for="website">Site web :</label>
		<input type = "text" name="website" id="website"
		value="<?php echo stripslashes(htmlspecialchars($data['membre_siteweb'])) ?>"/><br />
		</fieldset>

		<fieldset><legend>Informations suppl�mentaire</legend>
		<label for="localisation">Localisation :</label>
		<input type = "text" name="localisation" id="localisation"
		value="<?php echo stripslashes(htmlspecialchars($data['membre_localisation'])) ?>" />
		<br />
		</fieldset>
			   
		<fieldset><legend>Profil sur le forum</legend>
		<label for="avatar">Changer l avatar :</label>
		<input type="file" name="avatar" id="avatar" />
		<br /><br />
		<label><input type="checkbox" name="delete" value="Delete" /> Supprimer l avatar</label>
		Avatar actuel :
		<?php echo'
		<img src="./images/avatars/'.$data['membre_avatar'].'" alt="pas d avatar" />' ?>
		 
		<br /><br />
		<label for="signature">Signature :</label>
		<textarea cols=40 rows=4 name="signature" id="signature">
		<?php echo $data['membre_signature'] ?></textarea>
		
		<br /></h2>
		<fieldset>
		<?php
		echo'<input type="hidden" value="'.stripslashes($pseudo_d).'" name="pseudo_d">
		<input type="submit" value="Modifier le profil" /></form>';
                $query->CloseCursor();

            }
            else echo' <p>Erreur : Ce membre n existe pas, <br />
            cliquez <a href="./admin.php?cat=membres&amp;action=edit">ici</a> pour r�essayez</p>';
        }}
        break;
        
        case "droits":
         echo'<h1>Edition des droits d un membre</h1>';  

        if(!isset($_POST['membre']))
        {
                echo'De quel membre voulez-vous modifier les droits ?<br />';
                echo'<br /><form method="post" action="./admin.php?cat=membres&action=droits">
                <p><label for="membre">Inscrivez le pseudo : </label> 
                <input type="text" id="membre" name="membre">
                <input type="submit" value="Chercher"></p></form>';
        }
        else
        {
            $pseudo_d = $_POST['membre'];
            $query = $db->prepare('SELECT membre_pseudo,membre_rang
            FROM forum_membres WHERE LOWER(membre_pseudo) = :pseudo');
	    $query->bindValue(':pseudo',strtolower($pseudo_d),PDO::PARAM_STR);
            $query->execute();
	    if ($data = $query->fetch())
            {       
                echo'<form action="./adminok.php?cat=membres&amp;action=droits" method="post">';
         $rang = array
                (0 => "Bannis",
                1 => "Visiteur", 
                2 => "Membre", 
                3 => "Mod�rateur", 
                4 => "Administrateur"); //Ce tableau associe num�ro de droit et nom
                echo'<label>'.$data['membre_pseudo'].'</label>';
                echo'<select name="droits">';
                for($i=0;$i<5;$i++)
                {
		    if ($i == $data['membre_rang'])
		        {
			    echo'<option value="'.$i.'" selected="selected">'.$rang[$i].'</option>';
			}
			else
			{
			    echo'<option value="'.$i.'">'.$rang[$i].'</option>';
			}
                }
		echo'</select>
		<input type="hidden" value="'.stripslashes($pseudo_d).'" name="pseudo">               
		<input type="submit" value="Envoyer"></form>';
                $query->CloseCursor();
            }				  					
            else echo' <p>Erreur : Ce membre n existe pas, <br />
            cliquez <a href="./admin.php?cat=membres&amp;action=edit">ici</a> pour r�essayer</p>';
        }

        break;
        
        case "ban":
        echo'<h1>Gestion du bannissement</h1>'; 

        //Zone de texte pour bannir le membre
        echo'Quel membre voulez-vous bannir ?<br />';
        echo'<br />
        <form method="post" action="./adminok.php?cat=membres&amp;action=ban">
        <label for="membre">Inscrivez le pseudo : </label> 
        <input type="text" id="membre" name="membre">
        <input type="submit" value="Envoyer"><br />';

        //Ici, on boucle : pour chaque membre banni, on affiche une checkbox
        //Qui propose de le d�bannir
        $query = $db->query('SELECT membre_id, membre_pseudo 
        FROM forum_membres WHERE membre_rang = 0');
        
        //Bien sur, on ne lance la suite que s'il y a des membres bannis !
        if ($query->rowCount() > 0)
        {
        
	    while($data = $query->fetch())
            {
                echo'<br /><label><a href="./voirprofil.php?action=consulter&amp;m='.$data['membre_id'].'">
                '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></label>
                <input type="checkbox" name="'.$data['membre_id'].'" />
                D�bannir<br />';
            }
            echo'<p><input type="submit" value="Go !" /></p></form>';
        }
        else echo' <p>Aucun membre banni pour le moment :p</p>';
        $query->CloseCursor();

        break;
        
        default; //action n'est pas remplie, on affiche le menu 
        echo'<h1>Administration des membres</h1>';
        echo'<p>Salut mon ptit, alors tu veux faire quoi ?<br />
        <a href="./admin.php?cat=membres&amp;action=edit">
        Editer le profil d un membre</a><br />
        <a href="./admin.php?cat=membres&amp;action=droits">
        Modifier les droits d un membre</a><br />
        <a href="./admin.php?cat=membres&amp;action=ban">
        Bannir / Debannir un membre</a><br /></p>';
        break;
        }
break;
default; //cat n'est pas remplie, on affiche le menu g�n�ral
echo'<h1>Index de l administration</h1>';
 echo($_SESSION['level']);
echo'<p>Bienvenue sur la page d administration.<br />
<a href="./admin.php?cat=config">Configuration du forum</a><br />
<a href="./admin.php?cat=forum">Administration des forums</a><br />
<a href="./admin.php?cat=membres">Administration des membres</a><br /></p>';
break;
}
?>
</body>
</html>