<?php

echo'<body>';
include("includes/connecte.php");

?>

<div id="en_tete">
<?php
echo'<div class="header_gauche"><img src="images/design/Founders.png" alt="logo"/></div>';
if($lvl==1) include("includes/bar_conn.php");
if($lvl>1) include("includes/barr_mem.php");
?>
</div>

<ul id="qm0" class="qmmc">


	<li><a href="./contact.html">اتصل بنا</a></li>



	<li><span class="qmdivider qmdividery" ></span></li>
	<li><a class="qmparent" href="javascript:void(0)">الدروس</a>

		<ul>
		<li><span class="qmtitle" >برمجة الويب</span></li>
		<li><a href="./tuto_html.html">الـ Html و الـ Css</a></li>
		<li><a href="./tuto_PHP.html">PHP</a></li>
		<li><a href="./tuto_JavaScripts.html">JavaScripts</a></li>
		<li><a href="./tuto_Autre_w.html">الباقي</a></li>
		<li><span class="qmtitle" >بمجة عامتا</span></li>
		<li><a href="./tuto_Java.html">Java</a></li>
		<li><a href="./tuto_c.html">C  C++</a></li>
		<li><a href="./tuto_Autre_p.html">الباقي</a></li>
		<li><span class="qmtitle" >جرافيك</span></li>
		<li><a href="./tuto_3D.html">3D</a></li>
		<li><a href="./tuto_2D.html">2D</a></li>
		<li><span class="qmdivider qmdividerx" ></span></li>
		<li><a href="./tuto_all.html">كل الدروس</a></li>
		</ul></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><a class="qmparent" href="./forum.html">المنتدى</a>

		<ul>
		<li><span class="qmtitle" >برمجة الويب</span></li>
		<li><a href="./forum-1.html">الـ Html و الـ Css</a></li>
		<li><a href="./forum-2.html">PHP</a></li>
		<li><a href="./forum-3.html">JavaScripts</a></li>
		<li><a href="./forum-4.html">الباقي</a></li>
		<li><span class="qmtitle" >بمجة عامتا</span></li>
		<li><a href="./forum-5.html">Java</a></li>
		<li><a href="./forum-6.html">C  C++</a></li>
		<li><a href="./forum-7.html">الباقي</a></li>
		<li><span class="qmtitle" >جرافيك</span></li>
		<li><a href="./forum-8.html">3D</a></li>
		<li><a href="./forum-9.html">2D</a></li>
		<li><span class="qmtitle" >الباقي</span></li>
		<li><a href="./forum-10.html">إقتراحات </a></li>
		<li><a href="./forum-11.html">توظيف</a></li>
		<li><a href="./forum-12.html">نقاش عام</a></li>
		</ul></li>
	<li><span class="qmdivider qmdividery" ></span></li>
		<li><a href="./">البداية</a></li>

<li class="qmclear">&nbsp;</li></ul>

<!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click ('all' or 'lev2'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
<script type="text/javascript">qm_create(0,false,0,250,false,false,false,false,false);</script>




<p><br/></p>

<div class="sous_menu">


<ul><li><a href="">كيف و لمادا أضيف درس في هدا الموقع ؟</a></li></ul>
<h4>برمجة الويب</h4>
<ul>
<li><a href="./cour_html.php">أنشأ موقعك مع html و الـ css</a><em></em></li>
<li><a href="#"> برامج ويب مع PHP   </a><em> في طور الإنجاز</em></li>
</ul>
<h4>بمجة عامتا </h4>
<ul>
<li><a href="#">Java </a>
<em>في طور الإنجاز</em>
</li>
<li><a href="#">أولى الخطوات مع الـ C </a><em>في طور الإنجاز</em></li>
</ul>
<h4>جرافيك 3D</h4>
<ul>
<li><a href="#">أنشأ صور و فيدويات 3D مع الشهير Maya 3D </a> <em>في طور الإنجاز</em></li>

</ul>
</div>



<?php
echo'<div id="corps_forum">';

?>
