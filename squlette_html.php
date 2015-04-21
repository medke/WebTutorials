<?php
session_start();
$titre="الهيكل العام";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">
<p>الآن أنت جاهز لتعلم جوهر لغة HTML وهي العناصر.<br/>
دائما في الـHTML  البداية هي الجزء الأصعب ,من خلال هدا الدرس سأشرح أن معظم الأعمال التي نقوم بها في تكون بين الوسوم body  ,المهم أن تفهم هدا أما الباقي فهو عبارة عن نظري يجب الإطلاع عليه (لكن  إدا لم تفهمه جيدا ليس مهم  لا تقل : الـ  html صعب لايمكنني تعلمه)
<br/>
العناصر تعطي لوثائق HTML هيكلية محددة وتخبر المتصفح عن كيفية عرض الصفحة، بشكل عام العناصر أو الأوامر عبارة عن وسم  "tag" بالفرنسية "balise" للبداية ثم بعض المحتويات ثم وسم الإغلاق.</p>
<hr/>
<br/>
<h2>"وسوم"؟</h2>
<p>الوسوم هي توصيفات تستخدمها لكي تضعها في بداية العنصر وعند نهايته ,لكي تبين طبيعة الشئ الدي ستضيفه (هل هي عبارة عن صورة  أو نص أو عنوان ..الخ).</p>
<p>كل الوسوم لها نفس نفس الشكل، تبدأ مع علامة أصغر من <span dir="ltr">"&lt;"</span> وتنتهي مع علامة أكبر من <span dir="ltr">"&gt;"</span>.</p>
<p>بشكل عام هناك نوعين من الوسوم: </p>
<p><span style="color:green;">الوسوم الأحادية</span> : تتكون من طرف أو قطعة واحدة شكلها العام هو كالآتي:(هدا مثال فقط لاتو جد تعليمة إسمها هكدا)</p>
<?php $text="<code=exemple><tag/></code>";echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p><span style="color:green;">الوسوم الثنائية</span> تتكون من بداية و نهاية أي من طرفين ,الشكل العام للوسوم الثنائية هو:</p>

<?php $text="<code=exemple><tag>  نـــص  </tag></code>";echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>   الفرق الوحيد بين البداية و النهاية هو "/"</p>
<p>  سنرى كل الوسوم التي قد تحتاجها في وقتها المناسب أما الآن فنحن نلقي نظرة عن الهيكل العظمي فقط ,و بعدها نملأه بالحم والعضلات <img alt="rire" src="images/smileys/rire.gif"/>
</p>
<h2>هل تكتب الوسوم بأحرف كبيرة أم صغيرة؟</h2>
<p>معظم المتصفحات لن تهتم إذا كتبت الوسوم بأحرف كبيرة أو صغيرة أو خليط بين الإثنين، &lt;HTML&gt;، &lt;html&gt; أو &lt;HtMl&gt; كلها ستعطي نفس النتائج، مع ذلك الأسلوب <strong>الصحيح</strong> هو كتابة الوسوم بالأحرف الصغيرة، لذلك عليك أن  <strong>تعتاد على كتابة الوسوم بالأحرف الصغيرة</strong>.</p>
<h2>أين أضع كل هذه الوسوم؟</h2>
<p>هنا يوجد لب الدرس ,كل صفحات xhtml قائمة على نفس الهيكل :</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>أنقل هدا الكود في برنامجك النصي واحفظه على شكل ملف html</p>
<p><img alt="كيف تجد برنامج المفكرة" src="images/tuto/enr_html.png"></p>
<p>ستتحصل على الصفحة التالية</p>
<p><img alt="كيف تجد برنامج المفكرة" src="images/tuto/com_html.png"></p>
<p>أنا من عادتي أن أقوم بإستعمال (copy/coller)لهدا الكود لأنه مايهمنا هو مايحصل داخل:</p>
<?php $text='<code=xml>
   <body>
   //هنا نصع الوسوم
   </body>
</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>لكننا سنقوم بشرحه طبعا :<br/>السطر الأول عبارة عن تعليمة لتحدد الإصدار الدي تستعملونه و هي تعليمة ضرورية لكي يكون موقعك معترف به من طرف  <a href="http://ar.wikipedia.org/wiki/%D9%85%D8%B9%D8%A7%D9%8A%D9%8A%D8%B1_%D8%A7%D9%84%D9%88%D9%8A%D8%A8">w3c</a> </p>
<p>المتعلم: ماهي الـ W3c <br/> ستجد الإجابة في الملحقات بأدق التفاصيل</p>
<p>أما باقي الأسطر :</p>
<p><img alt="كيف تجد برنامج المفكرة" src="images/tuto/corp_html.gif"></p>
<?php $text='<code=xml> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>dir=rtl تعنني أننا نكتب من اليمين إلى اليسار (Right To Lefth) إدا أردت إستعمال الفرنسية أو الإنخليزية غيرها إلى dir=ltr <br/> lang=ar تعنني أننا نستعمل الغة العربية ادا أردت تغيير اللغة غير  fr,en,ge..) ar)</p>
<?php $text='<code=xml> 
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
 </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>title لكتابة عنوان الصفحة <br/>charset=UTF-8" لتحديد تشفير النص</p>
<p>ادا كنتم ستستعملون اللغة العربية فالكود الدي أعطيتكم إياه مناسب جدا أما بالنسبة للفرنسية أو الإنخليزية فالكود التالي مناسب :</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >//en for english
   <head>
       <title>ma premiere page</title>
       
   </head>
   <body>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<hr/>
<p>ادا مازلت تجد غموض في فهم هدا الدرس فلا تغضب و تحكم على أن ال html صعب لأن ما يهمنا هو مايحدث في التعليمة body</p>
<p>كما قلت داخل الدرس أنا أستعمل(copy|coller) أغير فقط العنوان لأن مايتغير عادتا هو ما بداخل body .اذا كنت ستستعمل العربية ,هاهو الكود</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>باقي اللغات</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
   <head>
       <title>ma premiere page</title>
       
   </head>
   <body>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
</div>
</body>
<html>