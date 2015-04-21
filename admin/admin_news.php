<?php

function chargerClasse($classname)
    {
        require '../'.$classname.'.class.php';
    }
    
    spl_autoload_register('chargerClasse');
    $balises = true;


    $db = DBFactory::getMysqlConnexionWithPDO();
    $manager = new NewsManager_PDO($db);
    
    if (isset ($_GET['modifier']))
        $news = $manager->getUnique ((int) $_GET['modifier']);
    
    if (isset ($_GET['supprimer']))
    {
        $manager->delete((int) $_GET['supprimer']);
        $message = 'La news a bien été supprimée !';
    }
    
    if (isset ($_POST['auteur']))
    {
        $news = new News (
            array (
                'auteur' => $_POST['auteur'],
                'titre' => $_POST['titre'],
                'contenu' => $_POST['contenu']
            )
        );
        
        if (isset ($_POST['id']))
            $news->setId($_POST['id']);
        
        if ($news->isValid())
        {
            $manager->save($news);
            
            $message = $news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !';
        }
        else
            $erreurs = $news->erreurs();
			
    }
include("../includes/debut.php");


include("../includes/mcode.php");
?>

    
    <body>
	


 

 


        <p><a href=".">Accéder à l'accueil du site</a></p>
        <div id="bbcode">
        <form action="admin_news.php" method="post" name="formulaire">
            <p style="text-align: center">
<?php
    if (isset ($message))
        echo $message, '<br />';
?>
                <?php if (isset($erreurs) && in_array(News::AUTEUR_INVALIDE, $erreurs)) echo 'L\'auteur est invalide.<br />'; ?>
                Auteur : <input type="text" name="auteur" value="<?php if (isset($news)) echo $news->auteur(); ?>" /><br />
                
                <?php if (isset($erreurs) && in_array(News::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
                Titre : <input type="text" name="titre" value="<?php if (isset($news)) echo $news->titre(); ?>" /><br />
                <fieldset><legend>Mise en forme</legend>
<input type="button" id="gras" name="gras" value="Gras" onClick="javascript:bbcode('[g]', '[/g]');return(false)" />
<input type="button" id="italic" name="italic" value="Italic" onClick="javascript:bbcode('[i]', '[/i]');return(false)" />
<input type="button" id="souligné" name="souligné" value="Souligné" onClick="javascript:bbcode('[s]', '[/s]');return(false)" />
<input type="button" id="lien" name="lien" value="Lien" onClick="javascript:bbcode('[url]', '[/url]');return(false)" />
<input type="button" id="image" name="image" value="image" onClick="javascript:bbcode('<image>', '</image>');return(false)" />

<select id="choix_code">
<option id="code_selected" name="code_selected">code</option>
<option  id="php" name="php" value="php" onClick="javascript:bbcode('<code=php>', '</code>');return(false)">php</option>
<option  id="java" name="java" value="java" onClick="javascript:bbcode('<code=java>', '</code>');return(false)">java</option>
<option  id="html" name="html" value="html" onClick="javascript:bbcode('<code=xhtml>', '</code>');return(false)">(x)html</option>
<option  id="css" name="css" value="css" onClick="javascript:bbcode('<code=css>', '</code>');return(false)">css</option>
<option  id="sql" name="sql" value="sql" onClick="javascript:bbcode('<code=sql>', '</code>');return(false)">sql</option>
<option  id="C" name="C" value="C" onClick="javascript:bbcode('<code=c>', '</code>');return(false)">C</option>
<option  id="C++" name="C++" value="C++" onClick="javascript:bbcode('<code=c++>', '</code>');return(false)">C++</option>

</select>
<select id="choix_color">
<option id="code_selected" name="code_selected">color</option>
<option style="color:red" id="red" name="red" value="red" onClick="javascript:bbcode('[color=red]', '[/color]');return(false)">red</option>
<option  style="color:blue" id="bleu" name="bleu" value="bleu" onClick="javascript:bbcode('[color=blue]', '[/color]');return(false)">blue</option>
<option  id="black" name="black" value="black" onClick="javascript:bbcode('[color=black]', '[/color]');return(false)">black</option>
<option  style="color:green" id="green" name="green" value="green" onClick="javascript:bbcode('[color=green]', '[/color]');return(false)">green</option>
<option  style="color:orange" id="orange" name="orange" value="orange" onClick="javascript:bbcode('[color=orange]', '[/color]');return(false)">orange</option>

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
                <?php if (isset($erreurs) && in_array(News::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
                Contenu :<br /><textarea rows="8" cols="60" name="contenu" id="message"><?php if (isset($news)) echo $news->contenu(); ?></textarea><br />
<?php
    if(isset($news) && !$news->isNew())
    {
?>
                <input type="hidden" name="id" value="<?php echo $news->id(); ?>" />
                <input type="submit" value="Modifier" name="modifier" />
<?php
    }
    else
    {
?>
                <input type="submit" value="Ajouter" />
<?php
    }
?>
            </p>
        </form>
        </div>
        <p style="text-align: center">Il y a actuellement <?php echo $manager->count(); ?> news. En voici la liste :</p>
        
        <table>
            <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
<?php
    foreach ($manager->getList() as $news)
        echo '<tr><td>', $news->auteur(), '</td><td>', $news->titre(), '</td><td>', $news->date_ajout(), '</td><td>', ($news->date_ajout() == $news->date_modif() ? '-' : $news->date_modif()), '</td><td><a href="?modifier=', $news->id(), '">Modifier</a> | <a href="?supprimer=', $news->id(), '">Supprimer</a></td></tr>', "\n";
?>
        </table>
    </body>
</html>
