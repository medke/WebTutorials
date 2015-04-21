<?php
session_start();
$titre="دكاء الـ css";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">
<p>في الدروس السابقة إستعملت كلمة "من أهم الدروس" لكن  الآن سأستعمل " أهم الدروس" , بإختصار هدا هو أهم الدروس دلك لا يعني أنه درس يصعب فهمه لا على الإطلاق , و ادا قرأت الدرس ستتأكد من دلك .<br/><hr/><br/></p>
<p>Design =html+css<br/>هدا يعني أننا سنستعمل الـ html و الـ css في نفس الوقت</p>
<p>div و span هما وسمان ثنائيين ليس لهما أي تأثير في الـ html <br/><strong>المتعلم :</strong><img alt="c" src="images/smileys/choc.gif"/>إدا لمادا نستعملهما <br/>لتجميع وترتيب العناصر داخل موقعك كما في الصورة (بالنسبة لـ div)</p>
<p><img alt="image" src="images/tuto/div-css.jpg"/></p>
<p>بالنسبة span نفس الشئ الفرق الوحيد بين span و div هو أن div تجمع الوسوم الهيكلية مثل(...p,h1,table) لدلك تكون خارج هده الوسوم  أما span تستخدم داخل الوسوم الهيكلية مثال</p>
<h1 style="color:blue; background-color:grey;text-align:center;">div</h1>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
      <div id="proverbs">
   
   <h2>English proverbs</h2>
  <p>Act today only, tomorrow is too late</p>
  <p>Bad news travels fast</p>
  
     </div>

   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>ننتقل الى الـ css لتغيير الـ div نسبق إسم الـ div الدي كتبناه بين الخاصية id بـ # على النحو التالي :</p>
<p><img alt="image" src="images/tuto/div-css2.png"/></p>
<p>إدن هنا سنكتب</p>
		<?php $text='<code=CSS> 
	#proverbs {
	color:red;
	font-size:80%;
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result" style="color:red;font-size:80%;">
        <h2 style="color:red;">English proverbs</h2>
  <p>Act today only, tomorrow is too late</p>
  <p>Bad news travels fast</p>
</div>
<p>و الآن ادا أردت أن يكون الفقرات داخل الـ div بالون الأسود ,كل ماعليك فعله هو كتابة الـ div كما تعلمنا و بعده اسم الوسم الدي تريده أن يتغير</p>
	<?php $text='<code=CSS> 
	#proverbs {
	color:red;
	font-size:80%;
	}
	#proverbs p {
	color:black;
	
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result" style="font-size:80%;">
        <h2 style="color:red;">English proverbs</h2>
  <p>Act today only, tomorrow is too late</p>
  <p>Bad news travels fast</p>
</div>
<p>تستطيع تغيير أي وسم</p>
	<?php $text='<code=CSS> 

	#proverbs p {
	}
	#proverbs a {
	}
	#proverbs em {
	}
	#proverbs table {
	}
	#proverbs td {
	}
	.
	.
	.
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h2> margin وpadding</h2>
<p>margin وpadding هما خاصيتين في الـ css  , وضعتها مع الوسم div لأنها تستعمل كثيرا معه , لكن يمكن استعمالها في أي وسم آخر خاصتا مع الجداول.</p>
<p><strong>padding : </strong>هو الفراخ نحو الداخل</p>
<p><strong>margin : </strong>هو الفراخ نحو الداخل</p>
<p><img alt="image" src="images/tuto/margin_padd.png"/><br/></p>
<p><strong style="color:blue;"> باللون الأزرق</strong> هو الـ margin <br/><strong style="color:red;">باللون الأحمر </strong> هو الـ padding<br/><strong>المستطيل الأسود </strong>يمكن أن يكون div أو نص أو خانة في الجدول ...</p>
<p>يمكن أن تستعملهما كالآتي </p>
	<?php $text='<code=CSS> 
	#proverbs {
	color:red;
	font-size:80%;
	margin:5px;
	padding:5px;
}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>أو تحدد إتجاه الفراغ</p>
<?php $text='<code=CSS> 
	#proverbs {
	color:red;
	font-size:80%;
	margin-top:5px;
	margin-right:3px;
	margin-bottom:5px;
	margin-left:3px;
	padding-top:5px;
	padding-bottom:5px;
}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h2>الارتفاع والعرض</h2>
<p>الخاصية <code>width</code> تحدد عرضاً معيناً لعنصر محدد.<br/>الخاصية <code>height</code> تحدد طولا معيناً لعنصر محدد.</p>
<p>يكمن أن تكتب القيم كما تعلمنا سابقا بـالنسبة المؤوية (%) أو بـالـpixel<br/> دعنا نجرب هده الخصائص في مثال</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
      <div id="proverbs">
   

  <p>volgus rectum videt, est ubi peccat. Si veteres ita miratur laudatque poetas, ut nihil anteferat, nihil illis comparet, errat. Si quaedam nimis antique, si peraque dure dicere credit eos, ignave multa fatetur, et sapit et mecum facit et Iova iudicat aequo.Non equidem insector delendave carmina Livi esse reor, memini quae plagosum mihi parvo Orbilium </p>

  
     </div>

   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css20.html">جرب المثال</a></h4>
<p>الآن سنقوم بإضافة هده الخواص له</p>
<?php $text='<code=CSS> 
	#proverbs {
	        
                height: 200px;
		width: 200px;
    }
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css21.html">جرب المثال</a></h4>
<p>نستعمل النسبة المؤوية</p>
<?php $text='<code=CSS> 
	#proverbs {
	        
                height: 60%;
		width: 40%;
    }
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css22.html">جرب المثال</a></h4>
<p>أنصحكم بإستعمال النسبة المؤوية لكي تتأقلم صفحتك مع أي  شاشة كمبيوتر خاصتا أنك ستنشأ موقع ليس لك فقط بل لآلاف الناس . </p>

<h2>وضع الـ div</h2>
<p><strong>المتعلم:</strong> كيف أضع الـ div  في مكان محدد مثلا الـ menu يكون على يسار الشاشة و الـ header  يكون في ألأأعلى</p>
<p>نفس طريقة و ضع صورة خلفية , لا تقل أنك نسيت .</p>
<p><img alt="postion" src="images/tuto/css_pos.gif"/></p>
<p>الفرق هنا أنك ستستعمل خاصية position  لتحديد الطريقة التي تستعملها و التي تأخد 3 قيم ممكنة هم:</p>
<ul>
<li><strong> absolute </strong>وهي أسهلهم حيث نحدد مكان الصندوق( div) من كل الإتجاهات بالبيكسال أو النسبة المؤوية</li>
<li><strong> fixed </strong>كما في الطريقة الأولى الفرق هو أن الصندوق يبقى موجودا في الصفحة (سيتضح لك كل شئ من خلال المثال)</li>
<li><strong> relative </strong>نفس الطريقة الأولى الفرق هو تغيير المعلم في الطريقة الأولى المعلم هو نصف الصفحة أما في هده الطريقة المعلم هو بداية الصفخة كما في الصورة (نقطة البداية)</li>
</ul>
<p><img alt="postion" src="images/tuto/2020.png"/></p>
<h2>absolute</h2>
<?php $text='<code=xml> 
   <body>
  <p>volgus rectum videt, est ubi peccat. Si veteres ita miratur laudatque poetas, ut nihil anteferat, nihil illis comparet, errat. Si quaedam nimis antique, si peraque dure dicere credit eos, ignave multa fatetur, et sapit et mecum facit et Iova iudicat aequo.Non equidem insector delendave carmina Livi esse reor, memini quae plagosum mihi parvo Orbilium </p>
 
     <div id="proverbs">
     <p>صندوق</p>
     </div>

   </body>
</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<?php $text='<code=CSS> 
	#proverbs {
	        
                   height: 200px;
		width: 200px;
		background-color:red;
		position: absolute;
		top:20%;
		right:40%;
		left:10%;
		bottom:60%;
		
    }
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css23.html">جرب المثال</a></h4>
<h2>fixed</h2>
<?php $text='<code=CSS> 
	#proverbs {
	        
                   height: 200px;
		width: 200px;
		background-color:red;
		position: fixed;
		
		left:80%;
		bottom:60%;
		
    }
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css24.html">جرب المثال</a></h4>
<p>ربما لاحظت الفرق جرب انزل الصفحة ستجد أن الصندوق الأحمر يبقى موجودا أي أنه ثابت لا يختفي و هده الطريقة تستعمل كثير لـقائمة بيانات موقعك (Menu).</p>
<h2>relative</h2>
<?php $text='<code=CSS> 
	#proverbs {
	        
                   height: 30px;
		width:80px;
		background-color:red;
		position: relative;
		
		left:60px;
		top:100px;
		
    }
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css25.html">جرب المثال</a></h4>
<img alt="image" src="images/tuto/css25.png"/>
<h1 style="color:blue; background-color:grey;text-align:center;">span</h1>
<p>لن أتحدث عنها كثيرا لأنك لن تستعملها كثيرا لكن سأشرحها كل ما تعلمته في الـdiv هو نفسه في الـ span الفرق هو أن الـdiv هيكلية تستعمل خارج أوسم النصوص و العناوين أما span فنصية تستخدم فقط داخل نص أو عنوان مثال:</p>
<?php $text='<code=xml> 
   <body>
  <p>volgus rectum <span id="test">videt </span>, est ubi peccat. Si veteres ita miratur laudatque poetas, ut nihil anteferat, nihil illis comparet, errat. Si quaedam nimis antique, si peraque dure dicere credit eos, ignave multa fatetur, et sapit et mecum facit et Iova iudicat aequo.Non equidem insector delendave carmina Livi esse reor, memini quae plagosum mihi parvo Orbilium </p>
 

   </body>
</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<?php $text='<code=CSS> 
	#test{
	        
                   height: 30px;
		width:80px;
		background-color:red;
		position: relative;
		
		left:60px;
		top:100px;
		
    }
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css26.html">جرب المثال</a></h4>
<p><hr/><br/>أتمنى أنك فهمت الدرس , لاتنسى أنك هناك منتدى في خدمتك لطرح النقاط التي يصعب استيعابها, الدررس القادم لن يكون درس بل عمل تطبيقي سنقوم من خلاله انشاء موقع بواسطة الوسوم و الخاصيات التي تعلمناها.</p>
</div>
</body>
<html>