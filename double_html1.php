<?php
session_start();
$titre="البرامج المستعملة";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">
<p>سوف نرى اليوم أهم الوسوم الثنائية التي قد تحتاجها في إنشاء موقعك ,هناك العديد من المعلومات لدلك فضلت أن أقسم الدرس إلى قسمين ,ليس المهم أن تحفظ كل التعليمات ,بل أن تعرف أنها موجودة و أن تعرف كيف تعمل , ويمكنك الرجوع إلى الموقع إدا نسيتها إلى أن تعتاد عليها,و أؤكد لكم أن الـ html مسألة وقت فقط .  </p>
<hr/>
<h2 id="heading1">كتابة نص</h2>
<p>لكتابة نص ,نقوم بكتابة نص <img alt ="rire"src="images/smileys/rire.gif"/> ثم نضعه بين وسم البداية <code dir="ltr">&lt;p&gt;</code> و وسم النهاية <code dir="ltr">&lt;/p&gt;</code></p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
   <p>إذا رأيت نيوب الليث بارزة فلا تظنن أن الليث يبتسم.</p>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result" >
   <p>إذا رأيت نيوب الليث بارزة فلا تظنن أن الليث يبتسم.</p>
</div>
<p> <strong>ملاحظة</strong> :إدا أردتم أن تعودو إلى السطر فهناك طريقتين <br/>-الأولى هي فتح وسوم النص من جديد مثل:</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
 <p>
  هل تعلم أن الشخص الموهوب يتجاوز  ذكائه 130 درجة
   وأن 95 بالمائة من الناس يتراوح حاصل ذكائهم بين 70 - 130درجة
    أما المغفّلين فيتراوح ذكائهم ما بين 50 -70 درجة 
  
   </p>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
 <p>
  هل تعلم أن الشخص الموهوب يتجاوز  ذكائه 130 درجة
   وأن 95 بالمائة من الناس يتراوح حاصل ذكائهم بين 70 - 130درجة
    أما المغفّلين فيتراوح ذكائهم ما بين 50 -70 درجة 
  
   </p>
</div>
<p>الكتابة الصحيحة</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
 
    <p> هل تعلم أن الشخص الموهوب يتجاوز  ذكائه 130 درجة   </p>
    <p>  وأن 95 بالمائة من الناس يتراوح حاصل ذكائهم بين 70 - 130درجة  </p>
    <p> أما المغفّلين فيتراوح ذكائهم ما بين 50 -70 درجة  </p>
  
   </p>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
    <p> هل تعلم أن الشخص الموهوب يتجاوز  ذكائه 130 درجة   </p>
    <p>  وأن 95 بالمائة من الناس يتراوح حاصل ذكائهم بين 70 - 130درجة  </p>
    <p> أما المغفّلين فيتراوح ذكائهم ما بين 50 -70 درجة  </p>
</div>
<p>أما الطريقة الثانية و هي بلإستعمال الوسم الأحادي <code dir="ltr">&lt;br/&gt;</code> و هي الطريقة الأسهل -سنرى هدا لاحقا-</p>
<h2>العنوان</h2>
<p>العناصر <code>h1</code>، <code>h2</code>، <code>h3</code>، <code>h4</code>، <code>h5</code> و<code>h6</code> تستخدم للعناوين (حرف h هو اختصار "heading"), حيث <code>h1</code> هو المستوى الأول من العناوين وبالتالي الأكبر حجماً، <code>h2</code> يستخدم للمستوى الثاني من العناوين وهو أصغر حجماً بقليل، و<code>h6</code> هو المستوى السادس والأخير من هيكلية العناوين وهو الأصغر.</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
    <h1> كبير هذا عنوان</h1>
	<h2>هذا عنوان فرعي</h2>
	<h3>عنوان صغير</h3>
	<h6> عنوان صغير جدا</h6

   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<div id="result">
   <h1> كبير هذا عنوان</h1>
	<h2>هذا عنوان فرعي</h2>
	<h3>عنوان صغير</h3>
	<h6> عنوان صغير جدا</h6
</div>


<h2>italic مائل</h2>
<p>حسناً، العنصر <code>em</code>يميل النص "يجعله مائلاً" وكل النصوص بين وسم البداية <code dir="ltr">&lt;em&gt;</code> ووسم الإغلاق <code dir="ltr">&lt;/em&gt;</code> ستظهر بشكل مائل في المتصفح. ("em" هي اختصار "emphasis".)</p>
<p>لكن يجب وضعها داخل وسوم النص لأنه من الوسوم النصية يعني التي تكون داخل وسوم النص</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
   <p>  <em> مائلة  </em>    </p>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
     <p>  <em> مائلة  </em>    </p>
</div>

<h2>strong شديد</h2>
<p> العنصر <code>strong</code>  يشدد النص "يجعله غليظاً" وكل النصوص بين وسم البداية  <code dir="ltr">&lt;strong&gt;</code> ووسم الإغلاق <code dir="ltr">&lt;/strong&gt;</code> ستظهر بشكل شديد في المتصفح . </p>
<p>لكن يجب وضعها داخل وسوم النص لأنه من الوسوم النصية يعني التي تكون داخل وسوم النص</p>

<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
   <p>  <strong> شديد  </strong>    </p>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
      <p>  <strong> شديد  </strong>    </p>
</div>
<h2> Acronyms المختصرات </h2>
<p>وهي كدلك من التعليمات النصية , والتي تعمل كالآتي:<br/>سيتظح المقال من خلال المثال.</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
  <p>أنا أحب الــ <acronym title="Hyper Text Markup Language">HTML.</acronym> </p>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
         <p>أنا أحب الــ <acronym title="Hyper Text Markup Language">HTML.</acronym> </p>
</div>
<p>ضع مؤشر الماوس والنتظر 3 ثوان ,سيظهر لك شرح للكلمة المسطر عليها <br/>كل ما عليك فعله هو تحديد المختصر (وهي الكلمة المسطر عليها في النتيجة) و التوضيع (الجملة التي تظهر بعد 3 ثواني)  من خلال الخاصية " "=title</p>
<h2>  الروابط</h2>
<p>لإنشاء رابط ستستخدم ما تستخدمه دائماً عندم كتابة HTML: عنصر، عنصر بسيط مع خاصية واحدة وستتمكن من إنشاء رابط لأي شيء وكل شيء، إليك هذا المثال لرابط لموقع finders-ar.com وكيف سيكون شكله:</p>

<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
  <p>pour aller au finders clique <a href="http://www.finders-ar.com">ici</a> </p>
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
        <p>pour aller au finders clique <a href="http://www.finders-ar.com">ici</a> </p>
</div>
<p>في المثال أعلاه الخاصية <code>href</code> تحوي القيمة "http://www.finders-ar.com"، وهي العنوان الكامل لموقع finders.com ويسمى العنوان URL وهي اختصار "Uniform Resource Locator"، لاحظ أن <span dir="ltr">"http://"</span> يجب أن تضاف في أي عنوان، أما الجملة "Here is a link to HTML.net" فهي النص الذي سيظهر في المتصفح على شكل رابط، تذكر أن تقوم بإغلاق العنصر بوسم الإعلاق <code dir="ltr">&lt;/a&gt;</code>.</p>
<h3>ماذا عن الروابط بين الصفحات في موقعي؟</h3>
<p>إذا أردت إنشاء رابط بين صفحتين في نفس الموقع فلا تحتاج إلى أن تضع كامل العنوان للصفحة، فمثلاً إذا قمت بإنشاء صفحتين ولنسمهما page1.htm وpage2.htm وقمت بحفظهما في نفس المجلد فيمكنك أن تربط من صفحة إلى أخرى بكتابة اسم الملف في الرابط، فمثلاً رابط من صفحة page1.htm يشير إلى page2.htm سيظهر بهذا الشكل:</p>
<?php $text='<code=xml> 
 <a href="page2.htm">Click here to go to page 2</a>
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>إذا كانت الصفحة 2 وضعت في مجلد فرعي ولنسمه "subfolder" فالرابط سيظهر بهذا الشكل:</p>
<?php $text='<code=xml> 
<a href="subfolder/page2.htm">Click here to go to page 2</a>
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>لو أردنا أن نضع رابطاً معاكساً من الصفحة 2 في المجلد الفرعي إلى الصفحة 1 سيكون شكل الرابط هكذا:</p>
<?php $text='<code=xml> 
<a href="../page1.htm">A link to page 1</a>
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>هل فهمت هذا النظام؟ بإمكانك دائماً أن تكتب العنوان الكامل للملف إذا وجدت هذا النظام معقداً.</p>
<h3>ماذا عن الروابط الداخلية في نفس الصفحة؟</h3>
<p>بإمكانك إنشاء روابط داخلية ضمن الصفحة، فمثلاً يمكنك إنشاء جدول بالمحتويات اعلى الصفحة ويحوي روابط تشير إلى كل فصل في الصفحة، كل ما تحتاجه هي خاصية تسمى <code>id</code> أو "identification" والعلامة "#".</p>
<p>استخدم خاصية <code>id</code> لتضع إشارة للعنصر الذي تريد وضع رابط له، مثال:</p>
<?php $text='<code=xml> 
<h1 id="heading1">heading 1</h1>

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>بإمكانك الآن إنشاء رابط لهذا العنصر باستخدام علامة "#" في خاصية الرابط، العلامة "#" يجب أن تتبع بقيمة  <code>id</code> للعنصر الذي تريد الربط له،  مثال:</p>
<?php $text='<code=xml> 
<a href="#heading1">Link to heading 1</a>

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>كل هذا سيتضح مع هذا المثال:<br/>سأقوم بإنشاء رابط إلى العنوان الأول للدرس</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
   <h2 id="heading1">كتابة نص</h2>		
   <a href="#heading1">Link to heading 1</a></p>
	
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>

        <p><a href="#heading1">Link to heading 1</a></p>
	
<br/>
<hr/>
<p>هدا كل شئ بالنسبة إلى الجزء الأول من الوسوم الثنائية ,أعلم أن هناك كم كبير من المعلومات لكن كما قلت في أول الدرس المهم ليس حفظها لكن المهم هو أن تتدكر أن هناك تعليمة تسمح لك بـ كدا و كدا .</p><br/>

</div>
</body>
<html>