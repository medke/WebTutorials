<?php
session_start();
$titre="عمل تطبيقي";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">
<p>و أخييرا, ستنشأ أول موقع لك بالـ xhtml , هنا لن تتعلم أي وسم جديد أو خاصية ,هنا ستطبق ما تعلمته من قبل وفق منهجية (لست مطالبا بإتباع منهجيتي ادا كانت منهجيتك أفضل) ,لدلك إدا كنت قد قرأت كل الدروس بترتيبها الخاص فأظن أنك لن تجد صعوبات في طريقك ,كفانا كلاما إلى العمل.<br/><hr/><br/>
أول شئ سأطلب منكم أن تنشؤوا صفحة css و html وتضعهما مع في مجلد ,ضع اسم design لـملف الـ css, ثم افتحهما في notpad++ (أو المدكرة notpad) .بهدا الشكل:<br/><br/>
<img alt="image" src="images/tuto/tp-html.png"/><br/>
سنبدأ مع الـ xhtml سنضع كود البداية
</p>
<h2>XHTML</h2>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" /> 
   </head>
   <body>
   

	
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>ثم نقسم الصفحة إلى 4 أقسام كما في الصورة</p>
<p><img alt="image" src="images/tuto/div-css.jpg"/></p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" /> 
   </head>
   <body>
   
   <div id="header">
 
   </div>
   
   
   <div id="menu">
   
   </div>
   
   
   <div id="body">
   
   </div>
   
   
   <div id="bottom">
   
   </div>

	
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>ضع عنوان لموقعك في الصندوق الأول (الـ div الأول ),مثلا أنا أريد أن أنشأ موقع لألعاب الفيديو .</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="design.css" /> 
   </head>
   <body>
   
   <div id="header">
   <h1>موقع ألعاب الفيديو</h1>
   </div>
   
   
   <div id="menu">
   
   </div>
   
   
   <div id="body">
   
   </div>
   
   
   <div id="bottom">
   
   </div>

	
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>ثم سنضع جدول في الـ menu </p>
<?php $text='<code=xml> 
   <body>
   
   <div id="header">
   <h1>موقع ألعاب الفيديو</h1>
   </div>
   
   
   <div id="menu">
   <table>
   <th>Menue</th>
   <tr><td><a href="#">  ألعاب الأكشن </a></td></tr>
   <tr><td><a href="#">  ألعاب السترتيجيات </a></td></tr>
   <tr><td><a href="#">  ألعاب ال 3D </a></td></tr>
   <tr><td><a href="#">  ألعاب المغامرات</a></td></tr>
   </table>
   </div>
   
   
   <div id="body">
   
   </div>
   
   
   <div id="bottom">
   
   </div>

	
   </body>
</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>سنضع في body نص يتحدث و يصف موقعك (ضع ما شأت) ,وفي bottom سنضع مثلا (جميع الحقوق محفوظة )<img alt="image" src="images/smileys/rire.gif"/></p>
<?php $text='<code=xml> 
   <body>
   
   <div id="header">
   <h1>موقع ألعاب الفيديو</h1>
   </div>
   
   
   <div id="menu">
   <table>
   <th>Menue</th>
   <tr><td><a href="#">  ألعاب الأكشن </a></td></tr>
   <tr><td><a href="#">  ألعاب السترتيجيات </a></td></tr>
   <tr><td><a href="#">  ألعاب ال 3D </a></td></tr>
   <tr><td><a href="#">  ألعاب المغامرات</a></td></tr>
   </table>
   </div>
   
   
   <div id="body">
   <h2>مرحبا بكم</h2>
   <p>مرحبا بكم في موقعي المتميز الدي يدور حول ألعاب الفيديو ,ستجد هنا كل أنواع الألعاب : مغامرات ,أكشن,3d ,بلا أن أنسى ألعاب الستراتيجيات العسكرية .</p>
   <p>وستكتشف في زيارتك للموقع أنه لايقتصر فقط عى ألعاب الـ PC بل هناك ألعاب ps2  و xbox و   ps3 و  xbox 360 و Nitendo ds  و PsP .</p>
   <p>واجهتك أي مشكلة في تثبيت اللعبة أو في حل مرحلة من مراحل لعبتك لا تتردد في تفقد هدا الموقع</p>
   <h2>تاريخ الألعاب</h2>
   <p>يعود تاريخ ألعاب الفيديو إلى سنة 1947، حينما اخترع البروفسور الأمريكي توماس ت. جولدسميث الابن لعبة أطلق عليها "أداة أنبوب الأشعة المهبطية المسلية". العقد التالي شهد اختراع عدة ألعاب بسيطة مثل: نيمرود (سنة 1951) في بريطانيا، و OXO (سنة 1952) بواسطة البروفسور البريطاني ألكساندر س. دوغلاس، وتنس فور تو (سنة 1958)، ولعبة سبيسوور! (سنة 1961) بواسطة معهد ماساتشوستس للتقنية.
      أول لعبة اخترعت لغرض تجاري هي لعبة الآركيد "كمبيوتر سبيس" سنة 1971، وقد كانت تعمل عن طريق وضع القطعة النقدية كما في بعض أجهزة الآركيد الحالية. احتوت على شاشة تلفزيون بدون ألوان. في نهاية الستينات ابتكر المخترع الأمريكي ذو الأصول الألمانية رالف ه. باير أول جهاز ألعاب فيديو ماغنافوكس أوديسي الذي أطلق في سنة 1972، وكان أول جهاز ألعاب فيديو يتصل بالتلفزيون لعرض الصور.
	  </p>
   </div>
   
   
   <div id="bottom">
   <p>جميع الحقوق محفوظة  copyright 2011</p>
   </div>

	
   </body>
</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/tp1.html">جرب المثال</a></h4>
<p>لا أعتقد أن هنام شئ جديد عليكم كل مافعلناه هو ملئ الصفحة لكي نقوم بتطبيق كود الـcss</p>
<h2>CSS</h2>
<p>في هده المرحلة سنستعمل صورتان  (لأعلى اموقع و لخلفية الموقع) لدى سأطلب منك إنشاء صور أو حفظ  هده الصور.</p>
<p><img style="width:70%;" alt="image" src="images/tuto/header.png"/><img alt="image" src="images/tuto/metal.gif"/></p>
<p>أول شئ سنضع صورة كخلفية للموقع و نجعلها تتكرر .و  كل النصوص  بخط  Arial     والروابط بالون الأحمر و بخط tahoma ونضيف لهم بعض التأثيرات بإسنعمال hover: , وبعض التغييرات في العناوين</p>
	<?php $text='<code=CSS> 
	body
{
background:url("./metal.gif") repeat ;
font-family:arial,,Verdana,Tahoma,sans-serif;
}
p
{

font-family:arial,,Verdana,Tahoma,sans-serif;
font-size:120%;
}
h1
{
color:blue;

}
h2
{
color:green;


}
a
{
color:#fd0a00;
font-family:Tahoma,sans-serifarial,Verdana,arial;
}
a:hover
{
color:#ffffff;
background-color:#fd0a00;

}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/tp2.html">جرب المثال</a></h4>
<p>سنقوم الآن بوضع كل صندوق(div) في مكانه الصحيح ,ونضع الصورة header في أعلى الموقع. ون سنستعمل خاصية margin التي تحدد البعد بين صندوق وآخر و ربما لاحظت أنني أستعمل دائما النسبة المؤوية (%) لأننا سنقوم بديزاين متمدد (design extensible) يتمدد و يتقلص حسب حجم شاشة الزائر.<br/>ضف للكود السابق هدا الكود</p>
<?php $text='<code=CSS> 
#header
{
height:25%;
width:100%;
background:url("./header.png") no-repeat ;
margin-bottom:10%;

}
#menu
{
position:absolute;
left:90%;

}
#body
{
position:absolute;
margin-right:20%;
top:50%;
margin-left:5%;
}
#bottom
{
position:absolute;
top:110%;
margin-right:20%;
margin-left:5%;
margin-top:20px;
}


  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/tp3.html">جرب المثال</a></h4>
<p>سنقوم ببعض التعديلات بإضافة ألون للخلفيات و حدود للصناديق(div) </p>
<?php $text='<code=CSS> 
#header
{
height:25%;
width:100%;
margin-bottom:10%;
background:url("./header.png") no-repeat ;
border: 3px ridge #375ab3;

}
#menu
{
position:absolute;
left:90%;

border: 3px ridge #375ab3;
background-color:#eae5ec;
}
#menu table
{

border-collapse:collapse;
padding:2px;
}
#menu td
{
border: 3px ridge #375ab3;
padding:2px;
background-color:#b2a6a0;
}
#menu th
{
background-color:#8ea6a5;
}
#body
{
position:absolute;
margin-right:20%;
top:50%;
margin-left:5%;
border: 3px ridge #375ab3;
background-color:#eae5ec;
padding:5px;

}
#bottom
{
position:absolute;
top:110%;
margin-right:20%;
margin-left:5%;
margin-top:20px;
}


  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/tp4.html">جرب المثال</a></h4>
<p>سأنهي هدا العمل التطبيقي هنا لأترك لكم المجال للإبداع و لأن كل مايأتي بعده هو تكرار فقط ,أنا أردت إيصال الطريقة و أظن أنها وصلت (إدا لم تصل نحن بإنتظارك في المنتدى) .<br/><hr/><br/>أتمنى لكم التوفيق في إنشاء موقعك , أنت الآن جاهز .</p>
</div>
</body>
<html>