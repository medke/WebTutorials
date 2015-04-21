<?php

	
    $DBFactory = new DBFactory();
    $db = $DBFactory::getMysqlConnexionWithPDO();
    $manager = new NewsManager_PDO($db);
?>

 <div id="demo2">

  <!-- AnythingSlider #1 -->
  <ul id="slider1">
<?php
    if (isset ($_GET['id']))
    {
	
        $news = $manager->getUnique((int) $_GET['id']);
        
        echo '<p>Par <em>', $news->auteur(), '</em>, ', $news->date_ajout(), '</p>', "\n",
             '<h2>', $news->titre(), '</h2>', "\n",
             '<p>', ($news->contenu()), '</p>', "\n";
        
        if ($news->date_ajout() != $news->date_modif())
            echo '<p ><small><em>Modifiée ', $news->date_modif(), '</em></small></p>';
			
    }
    
    else
    {
        
        
        foreach ($manager->getList(0, 5) as $news)
        {?><li><?php
            if (strlen($news->contenu()) <= 200)
                $contenu = $news->contenu();
            
            else
            {
                $debut = substr($news->contenu(), 0, 200);
                $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
                
                $contenu = $debut;
            }
            
            echo '<h4><a href="#">', $news->titre(), '</a></h4>', "\n",
                 '<p>',zcode(stripslashes(htmlspecialchars($contenu))), '</p>';
			?></li><?php	 
        }
    }
?>
</ul>


 </div>
