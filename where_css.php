<?php
session_start();
$titre="البرامج المستعملة";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">
<p>بعد هدا الدرس ستكون جاهز لكي تصمم لوقعك طراز من إبداعك الخاص  فنجهز أدواتنا و نرتب أفكارنا من خلال هدا الدرس.<br/></p>
<hr/>
<h2>في أي جزء أضع الـCSS</h2>
<p>هناك 3 طرق أو أمكنة لوضع كود الـCSS</p>

<p>لكن الطريقة المحبدة والتي أنصح بها والتي سؤواصل باقي الدرس بها, تعتمد هده الطريقة على إنشاء ملف css. ثم نخبر صفحتنا (صفحة html)أننا نستعمل ملفcss. ونضع اسمه</p>
<p>لكن أولا سنتعلم كيف نكتب الـ css في النوتباد++</p>
<img alt="css_in_notpad" src="images/tuto/css_notpad.jpg"/>
<p>الكود الدي يخبر صفحة الـhtml أننا نستعمل ملفcss  هو الكود</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	   <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" /> //هدا هو الكود
   </head>
   <body>
	
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>الكود <code>&lt;/link&gt;</code>هو الدي يسمح لنا بتحدد ملف ال سي اس اس الدي نستعمله<br/>ما يهمنا هو مايتغير غالبا و هو الـhref والدي يحدد اسم و مكان ملف الـcss الدي تستعمله (نفس طريقة تحديد مكان  الروابط و الصور) فإدا كان ملف الـ CSSو ملف الـHTML في نفس الملف واسم ملفdesign.css فهدا الكود يفي بالغرض أما ادا كان اسم ملف الـstyle.css مثلا و موضوع في ملف اسمهmonsite فالكود يصبح</p>
<?php $text='<code=xml> 
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	   <link rel="stylesheet" media="screen" type="text/css" title="Design" href="monsite/style.css" /> //هدا هو الكود
   </head>
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h2>كيف أكتب الـCSS</h2>
<p>بسيط جدا,ستفهمون كل شئ من خلال المثال</p>
<?php $text='<code=css> 
   اسم_التعليمة1
   {
   القيمة : الخاصية;
   القيمة : الخاصية;
   القيمة : الخاصية;
   القيمة : الخاصية;
   }
    اسم_التعليمة2
   {
   القيمة : الخاصية;
   القيمة : الخاصية;
   القيمة : الخاصية;
   القيمة : الخاصية;
   }
    اسم_التعليمة3
   {
   القيمة : الخاصية;
   القيمة : الخاصية;
   القيمة : الخاصية;
   القيمة : الخاصية;
   }
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>طبعا بعدها نعوض اسم_التعليمة و الخاضية و القيمة ,مثلا نريد أن نجعل كل النصوص الموجودة في الموقع دات لون أحمر و كل العناوين h2 دات لو أزرق<br/>طبعا ننزع علامة أصغر و أكبر - > < - في الـCSS</p>

<?php $text='<code=CSS> 
   p
   {
  color:red;
   }
   
   h2
   {
  color:blue;
   }

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>احفظ هدا الملف على شكل ملف.css تحت اسم design مثلا في مجلد</p>
<img alt="enregistrer_css" src="images/tuto/enrg_css.jpg"/>
<p>ثم احفظ مثلا هدا الكود  على شكل صفحةhtml. في نفس المجلد الموجود فيه ملفcss. الـ المسمى design</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	   <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" /> 
   </head>
   <body>
	<h2>معايير الويب</h2>
	<p>معايير الويب هي مجموعة من المعايير تم انشائها من قبل منظمة W3C 
	أو بالعربية: اتحاد شبكة الويب العالمية بهدف تسهيل قابلية الوصول إلى المعلومات، و لتسهيل التعام
	ل معها باستخدام المنتجات المتخصصة في شبكة الويب، كالمتصفحات و برامجح تحرير المواقع و برامج الإدارة.

إزداد الاهتمام بمعايير الويب خاصة في ظل التطور الكبير في
 أدوات تصفح الإنترنت و منها: الهاتف النقال، و الحاسب، و لتلب
 ية حاجات الناس جميعا في تصفح الإنترنت إن كان الإنسان صحيحا أو معقوفا.</p>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<img alt="enregistrer_css" src="images/tuto/enrg_css3.jpg"/>
<img alt="enregistrer_css" src="images/tuto/enrg_css2.jpg"/>
<h1>النتيجة</h1>
<img alt="enregistrer_css" src="images/tuto/enrg_css4.jpg"/>
<p>العنوان h2 تلون بالون الأزرق و النص p بــالون الأحمر<br/></p>
<hr/>
<p>الآن بعد أن تعلمنا ربط ملف الـCSS بملف الـHTML ما بقي لنا إلا أن أزودكم ببعص الخاصيات التي نستعملها في الـCSS و كدا طريقة إستعمالها و طبعا بعد اللقطات الفنية <img alt="rire" src="images/smileys/rire.gif"></p>
</div>
</body>
<html>