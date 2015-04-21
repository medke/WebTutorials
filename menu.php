<?php

echo'<body>';
include("includes/connecte.php");

?>

<div id="en_tete">
<?php
echo'<div class="header_gauche"><img src="http://www.fienders.com/images/design/Founders.png" alt="logo"/></div>';
if($lvl==1) include("includes/bar_conn.php");
if($lvl>1) include("includes/barr_mem.php");
?>
<div id="annonce_google"><script type="text/javascript" src="http://ads.clicmanager.fr/exe.php?c=26138&s=41689&t=1&q="></script></div>
</div>

<ul id="qm0" class="qmmc">

	<li><a href="./">ACCUEIL</a></li>
	<li><span class="qmdivider qmdividery" ></span></li>
	<li><a class="qmparent" href="javascript:void(0)">TUTORIEL</a>

		<ul>
		<li><span class="qmtitle" >Programmation web</span></li>
		<li><a href="./tuto_html.html">Xhtml &amp; css</a></li>
		<li><a href="./tuto_PHP.html">PHP</a></li>
		<li><a href="./tuto_JavaScripts.html">JavaScripts</a></li>
		<li><a href="./tuto_Autre_w.html">Autre</a></li>
		<li><span class="qmtitle" >Programmation</span></li>
		<li><a href="./tuto_Java.html">Java</a></li>
		<li><a href="./tuto_c.html">C &amp; C++</a></li>
		<li><a href="./tuto_Autre_p.html">Autre</a></li>
		<li><span class="qmtitle" >Infographie</span></li>
		<li><a href="./tuto_3D.html">3D</a></li>
		<li><a href="./tuto_2D.html">2D</a></li>
		<li><span class="qmdivider qmdividerx" ></span></li>
		<li><a href="./tuto_all.html">Tous les tutoriels</a></li>
		</ul></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><a class="qmparent" href="./forum.html">FORUM</a>

		<ul>
		<li><span class="qmtitle" >Programmation web</span></li>
		<li><a href="./forum-1.html">Xhtml &amp; css</a></li>
		<li><a href="./forum-2.html">PHP</a></li>
		<li><a href="./forum-3.html">JavaScripts</a></li>
		<li><a href="./forum-4.html">Autre</a></li>
		<li><span class="qmtitle" >Programmation</span></li>
		<li><a href="./forum-5.html">Java</a></li>
		<li><a href="./forum-6.html">C &amp; C++</a></li>
		<li><a href="./forum-7.html">Autre</a></li>
		<li><span class="qmtitle" >Infographie</span></li>
		<li><a href="./forum-8.html">3D</a></li>
		<li><a href="./forum-9.html">2D</a></li>
		<li><span class="qmtitle" >Autre</span></li>
		<li><a href="./forum-10.html">Suggestion </a></li>
		<li><a href="./forum-11.html">Recrutement</a></li>
		<li><a href="./forum-12.html">Discussion Generale</a></li>
		</ul></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><a href="./contact.html">CONTACT</a></li>
<li class="qmclear">&nbsp;</li></ul>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<script type="text/javascript">qm_create(0,false,0,250,false,false,false,false,false);</script>
<div id="research"> 
 
<form action="http://fienders.com/recherche.php" id="cse-search-box">
  <div>
    <input type="hidden" name="cx" value="partner-pub-5364608356984543:3l9ydb7in5e" />
    <input type="hidden" name="cof" value="FORID:10" />
    <input type="hidden" name="ie" value="ISO-8859-1" />
    <input type="text" name="q" size="31" />
    <input type="submit" name="sa" value="Rechercher" />
  </div>
</form>
<script type="text/javascript" src="http://www.google.dz/cse/brand?form=cse-search-box&amp;lang=fr"></script> 
 </div>



<p><br/></p>

<div class="sous_menu">


<ul><li><a href="http://www.fienders.com/tuto.php?co=comment%20ajouter%20un%20tutoriel%20?&c=1">comment ajouter un tutoriel ?</a></li></ul>
<h4>Prgog web</h4>
<ul>
<li><a href="http://www.fienders.com/tuto.php?co=creer%20votre%20site%20avec%20l%27HTML/CSS&c=3">creer votre site avec l'HTML/CSS</a></li>
<li><a href="#">Aplication web avec PHP  </a><em>(en cour de construction)</em></li>
</ul>
<h4>Prgogrammation </h4>
<ul>
<li><a href="#">L'oriente objet avec Java </a>
<em>(en cour de construction)</em>
</li>
<li><a href="#">debuter avec le C </a><em>(en cour de construction)</em></li>
</ul>
<h4>infographie 3D</h4>
<ul>
<li><a href="#">modelisation et animation avec autodesk Maya </a> <em>(en cour de construction)</em></li>

</ul>
</div>



<?php
echo'<div id="corps_forum">';

?>
