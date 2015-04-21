<?php
session_start();
$titre="البرامج المستعملة";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">
<h2>لون المقدمة: خاصية 'color'</h2>
<p>خاصية <code>color</code> تصف لون عنصر HTML.</p>
<p>فمثلاً تصور أنك تريد أن تكون كل العناوين في الصفحة ملونة بلون أحمر داكن، كل العناوين رمزت باستخدام وسم <code>&lt;h1&gt;</code>، المثال أدناه سيقوم بتوضيح كيفية تحويل كل <code>&lt;h1&gt;</code> إلى اللون الأحمر:</p>
<?php $text='<code=CSS> 

   h1
   {
  color: #ff0000;
   }

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css1.html">جرب المثال</a></h4>
<p>طبعا يمكنك أن تكتبو اللون إما بـهده الـطريقة أو بتحديد كمية الون الأحمر و الأخضر و الأزرق أو بواسطة اسم اللون بالإنخليزية</p>
<?php $text='<code=CSS> 

   h1
   {
  color:rgb(255,0,0);
   }

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css1.html">جرب المثال</a></h4>
<?php $text='<code=CSS> 

   h1
   {
  color: red;
   }

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css1.html">جرب المثال</a></h4>
<p><strong>المتعلم</strong>و كيف أعرف كود اللون أو كمية الألون <br/>ببساطة من خلال الرسام أو من الخلال برنامج بسيط كـ:</p>
<h3><a href="http://www.siteduzero.com/uploads/fr/ftp/mateo21/boite_a_couleurs.exe">تحميل برنامج الألوان</a></h3>
<p><img alt="boite_couleur" src="images/tuto/boite_couleur.png"/><br/>  حدد اللون ثم أنقل الكود ببساطة طبعا أشكر  <a href="http://siteduzero.com">siteduzero</a>  على هدا البرنامج  </p>
<h2>خاصية 'background-color'</h2>
<p>خاصية <code>background-color</code> تحدد لون خلفية أي عنصر.</p>
<p>العنصر <code>&lt;body&gt;</code> يضم كل محتويات وثيقة HTML، لذلك لتغيير خلفية الصفحة بأكملها يجب أن نفعل خاصية background-color على العنصر <code>&lt;body&gt;</code>.</p>
<p>يمكنك أيضاً تفعيل خاصية لون الخلفية على عناصر أخرى مثل العناوين والنصوص، في المثال أدناه قمنا باختيار ألوان خلفية لعنصري <code>&lt;body&gt;</code> و<code>&lt;h1&gt;</code>.</p>
<?php $text='<code=CSS> 

  body {
		background-color: #FFCC66;
	}

	h1 {
		color: #990000;
		background-color: #FC9804;
	}


  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css2.html">جرب المثال</a></h4>
<h2>الصورة كخلفية "background-image"</h2>
<p>خاصية <code>background-image</code> تستخدم لوضع صورة كخلفية لأي عنصر.</p>
<p>فمثلاً قمنا باستخدم صورة فراشة في المثال أدناه، يمكنك إنزال الصورة لتجرب بنفسك على حاسةبك، قم بالضغط على الصورة بالزر الأيمن واحفظها في جهازك، أو يمكنك استخدام أي صورة تناسبك.</p>
<img alt="butterfly" src="images/tuto/butterfly.gif"/>
<?php $text='<code=CSS> 

  body {
		background-color: #FFCC66;
     	background-image: url("butterfly.gif");
	}

	h1 {
		color: #990000;
		background-color: #FC9804;
	}


  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css3.html">جرب المثال</a></h4>
<p>انتبه: لاحظ كيف حددنا مسار الصورة بهذا الشكل <strong dir="ltr">url("butterfly.gif")</strong>، هذا يعني أن الصورة وضعت في نفس المجلد مع ملف التصميم، يمكنك أن تحدد مسار الصور في مجلدات أخرى باستخدام <strong dir="ltr">url("../images/butterfly.gif")</strong> أو حتى العنوان الكامل للملف: <strong dir="ltr">url("http://www.finders-ar.com/butterfly.gif")</strong>.</p>
<h2>تكرار صورة الخلفية "background-repeat"</h2>
<p>هل لاحظت في المثال أعلاه أن صورة الفراشة تتكرر رأسياً وأفقياً لتغطي كامل الصفحة؟ الخاصية <code>background-repeat</code> تتحكم بتكرار الصورة.</p>
<p>في الجدول أدناه ملخص لأربع قيم يمكن أن تضعها للخاصية <code>background-repeat</code>.</p>
<table border="1">
	<tbody><tr><th>القيمة</th><th>الوصف</th><th>مثال</th></tr>
	<tr><td><code>Background-repeat: repeat-x</code></td><td>الصورة ستتكرر أفقياً</td><td><a href="test/css4.html">شاهد المثال</a></td></tr>
	<tr><td><code>background-repeat: repeat-y</code></td><td>الصورة ستتكرر عمودياً</td><td><a href="test/css5.html">شاهد المثال</a></td></tr>
	<tr><td><code>background-repeat: repeat</code></td><td>الصورة ستتكرر أفقياً وعمودياً</td><td><a href="test/css6.html">شاهد المثال</a></td></tr>
	<tr><td><code>background-repeat: no-repeat</code></td><td>لن تتكرر بأي شكل</td><td><a href="test/css7.html">شاهد المثال</a></td></tr>
	</tbody></table>
	<p>مثلاً لتجنب تكرار صورة الخلفية يجب أن تكتب الأوامر بهذا الشكل::</p>
	<?php $text='<code=CSS> 

  body {
		background-color: #FFCC66;
        	background-image: url("butterfly.gif");
		background-repeat: no-repeat;
	}

	h1 {
		color: #990000;
		background-color: #FC9804;
	}


  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css7.html">جرب المثال</a></h4>
<h2>مكان صورة الخلفية "background-position"</h2>
<p>تلقائياً توضع صورة الخلفية في أعلى يسار الصفحة، الخاصية <code>background-position</code> تسمح لك بتغيير هذه القيمة التلقائية ووضع الصورة في أي مكان تريده من الشاشة.</p>
<p>هناك طرق مختلفة لتحديد قيمة <code>background-position</code>، لكن كلها تنظم على نسق واحد، فمثلاً القيمة <span dir="ltr">'100px 200px'</span> تضع الصورة الخلفية على بعد 100 بكسل من يسار نافذة المتصفح و200 بكسل من أعلى نافذة المتصفح.</p>
<p>هذا النسق يمكن تحديده أيضاً بالنسبة المؤية من عرض الشاشة وكذلك مقاييس محددة مثل البكسل والسنتيميتر، أو من خلال استخدام كلمات مثل top وbottom وcenter وleft وright.</p>
<p><img alt="postion" src="images/tuto/css_pos.gif"/></p>
<p><br>الجدول أدناه يوضح بالمزيد من الأمثلة</p>
<table border="1">
	<tbody><tr><th>القيمة</th><th>الوصف</th><th>مثال</th></tr>
	<tr><td><code>background-position: 2cm 2cm</code></td><td>هذه الصورة وضعت على بعد 2 سنتم من يسار الشاشة و2 سنتم من أعلى الشاشة</td><td><a href="test/css8.html">شاهد المثال</a></td></tr>
	<tr><td><code>background-position: 50% 25%</code></td><td>هذه الصورة وضعت في منتصف المسافة من يسار الشاشة وربع المسافة من أعلى الشاشة</td><td><a href="test/css9.html">شاهد المثال</a></td></tr>
	<tr><td><code>background-position: top right</code></td><td>هذه الصورة وضعت في أعلى يمين الصفحة</td><td><a href="test/css10.html">شاهد المثال</a></td></tr>
	</tbody></table>
	<p>المثال أدناه يوضح كيفية وضع صورة الخلفية في أعلى يمين الشاشة:</p>
	<?php $text='<code=CSS> 

  body {
		background-color: #FFCC66;
        	background-image: url("butterfly.gif");
		background-repeat: no-repeat;
		background-position: top right;
	}

	h1 {
		color: #990000;
		background-color: #FC9804;
	}


  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css10.html">جرب المثال</a></h4>
	<h2>جمع كل الخصائص "background"</h2>
	<p>الخاصية <code>background</code> هي اختصار لكل خصائص خلفية العناصر التي قرأتها في هذا الدرس.</p>
	<p>باستخدام <code>background</code> يمكنك جمع عدة خصائص وبالتالي تقليل عدد الأسطر التي تكتبها في ملف التصميم وهذا يجعل الملف أسهل للقراءة.</p>
	<p>فمثلاً يمكن اختصار هذه الأسطر:</p>
		<?php $text='<code=CSS> 
		background-color: #FFCC66;
        	background-image: url("butterfly.gif");
		background-repeat: no-repeat;
		background-position: top right;
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>باستخدام <code>background</code> يمكن تحقيق نفس النتيجة باستخدام سطر واحد فقط:</p>
		<?php $text='<code=CSS> 
		background: #FFCC66 url("butterfly.gif") no-repeat top right;
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>القائمة ترتب بهذا الشكل - من اليسار إلى اليمين:</p>
<p dir="ltr"><code>background-color</code> | <code>background-image</code> | <code>background-repeat</code> | <code>background-attachment</code> | <code>background-position</code></p>
<hr/>
<p>هدا كل شئ للدرس الأول لا يزال العديد من الخصائص التي سنكتشفها من أجل إنشاء Design  لموقعك.</p>
	
</div>
</body>
<html>