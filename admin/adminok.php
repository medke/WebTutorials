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
if (!verif_auth(ADMIN)) erreur("<h1>vous etes pas mon admisnitrateur</h1>");
switch($cat) //1er switch
{
case "config":


echo'<h1>Configuration du forum</h1>';
    //On r�cup�re les valeurs et le nom de chaque entr�e de la table
    $query=$db->query('SELECT config_nom, config_valeur FROM forum_config');
    //Avec cette boucle, on va pouvoir contr�ler le r�sultat pour voir s'il a chang�
    while($data = $query->fetch())
    {
        if ($data['config_valeur'] != $_POST[$data['config_nom']])
	{
            //On met ensuite � jour
            $valeur = htmlspecialchars($_POST[$data['config_nom']]);
	        $query=$db->prepare('UPDATE forum_config SET config_valeur = :valeur
            WHERE config_nom = :nom');
            $query->bindValue(':valeur', $valeur, PDO::PARAM_STR);
            $query->bindValue(':nom', $data['config_nom'],PDO::PARAM_STR);
            $query->execute();
	}
    }
    $query->CloseCursor();
    //Et le message !
    echo'<br /><br />Les nouvelles configurations ont �t� mises � jour !<br />  
    Cliquez <a href="./admin.php">ici</a> pour revenir � l administration';

	
	
break;
 
case "forum":

$action = htmlspecialchars($_GET['action']); //On r�cup�re la valeur de action
        switch($action) //2eme switch
        {
        case "creer":
        if ($_GET['c'] == "f")
	   {
	    $titre = htmlspecialchars($_POST['nom']);
	    $desc = htmlspecialchars($_POST['desc']);
	    $cat = (int) htmlspecialchars($_POST['cat']);

	
	    $query=$db->prepare('INSERT INTO forum_forum (forum_cat_id, forum_name, forum_desc) 
	    VALUES (:cat, :titre, :desc)');
            $query->bindValue(':cat',$cat,PDO::PARAM_INT);
            $query->bindValue(':titre',$titre, PDO::PARAM_STR);
            $query->bindValue(':desc',$desc,PDO::PARAM_STR);
            $query->execute();
	    echo'<br /><br />Le forum a �t� cr�� !<br />
	    Cliquez <a href="./admin.php">ici</a> pour revenir � l administration';
	    $query->CloseCursor();
        }
        //Puis par les cat�gories
        elseif ($_GET['c'] == "c")
        {
            $titre = htmlspecialchars($_POST['nom']);
            $titre = $_POST['nom'];
            $query=$db->prepare('INSERT INTO forum_categorie (cat_nom,cat_ordre) VALUES (:titre,:cat)');
            $query->bindValue(':titre',$titre, PDO::PARAM_STR); 
			$query->bindValue(':cat',20, PDO::PARAM_INT); 
            $query->execute();          
            echo'<p>La cat�gorie a �t� cr��e !<br /> Cliquez <a href="admin.php">ici</a> 
            pour revenir � l administration</p>';
			echo $titre;
	         $query->CloseCursor();
        }

        break;
        
        case "edit":
       echo'<h1>Edition d un forum</h1>';
        
        if($_GET['e'] == "editf")
        {
            //R�cup�ration d'informations

	    $titre = $_POST['nom'];
	    $desc = $_POST['desc'];
	    $cat = (int) $_POST['depl'];       

            //V�rification
            $query=$db->prepare('SELECT COUNT(*) 
            FROM forum_forum WHERE forum_id = :id');
            $query->bindValue(':id',(int) $_POST['forum_id'],PDO::PARAM_INT);
            $query->execute();
            $forum_existe=$query->fetchColumn();
            $query->CloseCursor();
            if ($forum_existe == 0) erreur(ERR_FOR_EXIST);

            
            //Mise � jour
            $query=$db->prepare('UPDATE forum_forum 
            SET forum_cat_id = :cat, forum_name = :name, forum_desc = :desc 
            WHERE forum_id = :id');
            $query->bindValue(':cat',$cat,PDO::PARAM_INT);  
            $query->bindValue(':name',$titre,PDO::PARAM_STR);
            $query->bindValue(':desc',$desc,PDO::PARAM_STR);
            $query->bindValue(':id',(int) $_POST['forum_id'],PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();
            //Message
            echo'<p>Le forum a �t� modifi� !<br />Cliquez <a href="./admin.php">ici</a> 
            pour revenir � l administration</p>';
        
        }
elseif($_GET['e'] == "editc")
        {
            //R�cup�ration d'informations
            $titre = $_POST['nom'];

            //V�rification
            $query=$db->prepare('SELECT COUNT(*) 
            FROM forum_categorie WHERE cat_id = :cat');
            $query->bindValue(':cat',(int) $_POST['cat'],PDO::PARAM_INT);
            $query->execute();
            $cat_existe=$query->fetchColumn();
            $query->CloseCursor();
            if ($cat_existe == 0) erreur(ERR_CAT_EXIST);
            
            //Mise � jour
            $query=$db->prepare('UPDATE forum_categorie
            SET cat_nom = :name WHERE cat_id = :cat');
            $query->bindValue(':name',$titre,PDO::PARAM_STR);
            $query->bindValue(':cat',(int) $_POST['cat'],PDO::PARAM_INT);
            $query->execute();
            $query->CloseCursor();

            //Message
            echo'<p>La cat�gorie a �t� modifi�e !<br />
            Cliquez <a href="./admin.php">ici</a> 
            pour revenir � l administration</p>';
        
        }
elseif($_GET['e'] == "ordref")
        {
            //On r�cup�re les id et l'ordre de tous les forums
            $query=$db->query('SELECT forum_id, forum_ordre FROM forum_forum');
            
            //On boucle les r�sultats
            while($data= $query->fetch())
            {
                $ordre = (int) $_POST[$data['forum_id']]; 
        
                //Si et seulement si l'ordre est diff�rent de l'ancien, on le met � jour
                if ($data['forum_ordre'] != $ordre)
                {
                    $query=$db->prepare('UPDATE forum_forum SET forum_ordre = :ordre
                    WHERE forum_id = :id');
                    $query->bindValue(':ordre',$ordre,PDO::PARAM_INT);
                    $query->bindValue(':id',$data['forum_id'],PDO::PARAM_INT);
                    $query->execute();
                    $query->CloseCursor();
                }
            } 
        $query->CloseCursor();
        //Message
        echo'<p>L ordre a �t� modifi� !<br /> 
        Cliquez <a href="./admin.php">ici</a> pour revenir � l administration</p>';
        }

        break;
        
        case "droits":
     //R�cup�ration d'informations
        $auth_view = (int) $_POST['auth_view'];
        $auth_post = (int) $_POST['auth_post'];
        $auth_topic = (int) $_POST['auth_topic'];
        $auth_annonce = (int) $_POST['auth_annonce'];
        $auth_modo = (int) $_POST['auth_modo'];
        
        //Mise � jour
        $query=$db->prepare('UPDATE forum_forum
        SET auth_view = :view, auth_post = :post, auth_topic = :topic,
        auth_annonce = :annonce, auth_modo = :modo WHERE forum_id = :id');
        $query->bindValue(':view',$auth_view,PDO::PARAM_INT);
        $query->bindValue(':post',$auth_post,PDO::PARAM_INT);
        $query->bindValue(':topic',$auth_topic,PDO::PARAM_INT);
        $query->bindValue(':annonce',$auth_annonce,PDO::PARAM_INT);
        $query->bindValue(':modo',$auth_modo,PDO::PARAM_INT);
        $query->bindValue(':id',(int) $_POST['forum_id'],PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();
      
        //Message
        echo'<p>Les droits ont �t� modifi�s !<br />
        Cliquez <a href="./admin.php">ici</a> pour revenir � l administration</p>';

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

$action = htmlspecialchars($_GET['action']); //On r�cup�re la valeur de action
        switch($action) //2eme switch
        {
        case "edit":
        //Edition d'un membre
        break;
        
        case "droits":
        $membre =$_POST['pseudo'];
	$rang = (int) $_POST['droits'];
	$query=$db->prepare('UPDATE forum_membres SET membre_rang = :rang
	WHERE LOWER(membre_pseudo) = :pseudo');
        $query->bindValue(':rang',$rang,PDO::PARAM_INT);
        $query->bindValue(':pseudo',strtolower($membre), PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();
	echo'<p>Le niveau du membre a �t� modifi� !<br />
	Cliquez <a href="./admin.php">ici</a> pour revenir � l administration</p>';

        break;
        
        case "ban":
        if (isset($_POST['membre']) AND !empty($_POST['membre']))
        {
            $membre = $_POST['membre'];
            $query=$db->prepare('SELECT membre_id 
            FROM forum_membres WHERE LOWER(membre_pseudo) = :pseudo');    
            $query->bindValue(':pseudo',strtolower($membre), PDO::PARAM_STR);
            $query->execute();
            //Si le membre existe
            if ($data = $query->fetch())
            {
                //On le bannit
                $query=$db->prepare('UPDATE forum_membres SET membre_rang = 0 
                WHERE membre_id = :id');
                $query->bindValue(':id',$data['membre_id'], PDO::PARAM_INT);
                $query->execute();
                $query->CloseCursor();
                echo'<br /><br />
                Le membre '.stripslashes(htmlspecialchars($membre)).' a bien �t� banni !<br />';
            }
            else 
            {
                echo'<p>D�sol�, le membre '.stripslashes(htmlspecialchars($membre)).' n existe pas !
                <br />
                Cliquez <a href="./admin.php?cat=membres&action=ban">ici</a> 
                pour r�essayer</p>';
            }
        }
        //Debannissement ici        
        $query = $db->query('SELECT membre_id FROM forum_membres 
        WHERE membre_rang = 0');
        //Si on veut d�bannir au moins un membre
        if ($query->rowCount() > 0)
        {
	    $i=0;
            while($data= $query->fetch())
            {
                if(isset($_POST[$data['membre_id']]))
                {
	            $i++;
                    //On remet son rang � 2
                    $query=$db->prepare('UPDATE forum_membres SET membre_rang = 2 
                    WHERE membre_id = :id');
                    $query->bindValue(':id',$data['membre_id'],PDO::PARAM_INT);
                    $query->execute();
                    $query->CloseCursor();
                }
            }
	    if ($i!=0)
            echo'<p>Les membres ont �t� d�bannis<br />
            Cliquez <a href="./admin.php">ici</a> pour retourner � l administration</p>';
        }

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
echo'<p>Bienvenue sur la page d administration.<br />
<a href="./admin.php?cat=config">Configuration du forum</a><br />
<a href="./admin.php?cat=forum">Administration des forums</a><br />
<a href="./admin.php?cat=membres">Administration des membres</a><br /></p>';
break;
}
?>