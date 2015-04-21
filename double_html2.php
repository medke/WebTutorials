<?php
session_start();
$titre="البرامج المستعملة";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">
<p>هل أنت مستعد , إدا كان الجواب نعم فلنواصل<br/></p>
<hr/>
<h2>الجـــداول</h2>
<p><strong>الجداول تستخدم لعرض بيانات مجدولة</strong> مثل المعلومات التي تعرض بشكل منطقي من خلال أعمدة وصفوف.</p>
<p>إنشاء الجداول في HTML قد يكون في البداية معقداً، لكن إذا بقيت هادئاً وراقبت ما تقوم به جيداً سترى أن الجداول بسيطة ومنطقية، تماماً كما هو كل شيء في HTML.</p>
<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
   
    <table>
	  <tr>
		<td>خلية 1</td>
		<td>خلية 2</td>
	  </tr>
	  <tr>
		<td>خلية 3</td>
		<td>خلية 4</td>
	  </tr>
	</table>
	
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
         <table>
	  <tr>
		<td>خلية 1</td>
		<td>خلية 2</td>
	  </tr>
	  <tr>
		<td>خلية 3</td>
		<td>خلية 4</td>
	  </tr>
	</table>
</div>
<h3>ما الفرق بين <code dir="ltr">&lt;tr&gt;</code> و<code dir="ltr">&lt;td&gt;</code>؟</h3>
<p>كما ترى في المثال أعلاه، هذا هو أكثر أمثلة HTML تعقيداً قمنا بعرضه في هذا الدرس حتى الآن، لنقم بتفكيك المثال وشرح كل وسم:</p>
<p><strong>هناك ثلاث عناصر تستخدم لإنشاء أي جدول:</strong></p>
<ul>
		<li>وسم البداية <code dir="ltr">&lt;table&gt;</code> ووسم الإغلاق <code dir="ltr">&lt;/table&gt;</code> يبدأ من بينهما الجدول وينتهي، منطقي.</li>
		<li><code dir="ltr">&lt;tr&gt;</code> تعني "<strong>t</strong>able <strong>r</strong>ow" وهي العنصر الذي تبدأ من خلاله الصفوف وتنتهي، لا زال الأمر منطقياً.</li>
		<li><code dir="ltr">&lt;td&gt;</code> هي اختصار "<strong>t</strong>able <strong>d</strong>ata". هذا الوسم يبدأ وينهي كل خلية في صفوف الجدول، كل هذا بسيط ومنطقي.</li>
	</ul>
	<p>هذا ما يحدث في المثال الأول، الجدول يبدأ بوسم <code dir="ltr">&lt;table&gt;</code>، يتبعه وسم <code dir="ltr">&lt;tr&gt;</code> الذي يدل على بداية صف جديد، وهناك خليتان في هذا السطر: <code dir="ltr">&lt;td&gt;</code>خلية 1<code dir="ltr">&lt;/td&gt;</code> و<code dir="ltr">&lt;td&gt;</code>خلية 2<code dir="ltr">&lt;/td&gt;</code>، ثم نغلق الصف بوسم الإغلاق <code dir="ltr">&lt;/tr&gt;</code> ونبدأ آخر <code dir="ltr">&lt;tr&gt;</code> الذي يحوي أيضاً خليتين، ثم نغلق الجدول <code dir="ltr">&lt;/table&gt;</code>.</p>
		<p><img alt="tableau" src="images/tuto/tableau_html.png"></p>
		<p>طبعا سنرى كيف تسطر حدود للجدول من خلال الـ CSS<p>
		<p> <code dir="ltr">&lt;th&gt;</code>  هو عنوان الخانة مثال<p>
		<?php $text='<code=xml> <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar" >
   <head>
       <title>أهلا بكم في موقعي</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   </head>
   <body>
   
    <table>
	  <tr>
	    <th> الإسم</th>
	      <td>مصطفى</td>
		  <td>عمر</td>
	  </tr>
	  <tr>
	    <th>العمر</th>
		  <td>19</td>
		  <td>28</td>
	  </tr>
	</table>
	
   </body>
</html></code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
   <table>
	  <tr>
	 <th> الإسم</th>
	  <td>مصطفى</td>
		<td>عمر</td>
	  </tr>
	  <tr>
	  <th>العمر</th>
		<td>19</td>
		<td>28</td>
	  </tr>
	</table>
</div>
<p> بطريقة أخرى ,عندما تريد أن يكون عنوان الخانة من الأعلى</p>
	<?php $text='<code=xml>
  <table>
	<th> الإسم</th>
	<th>العمر</th>
	   <tr>
	     <td>مصطفى</td>
	     <td>19</td>
	   </tr>
	   <tr>
		 <td>عمر</td>
		 <td>28</td>
	   </tr>
	</table>
</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
  <table>
	<th> الإسم</th>
	 <th>العمر</th>
	  <tr>
	  <td>مصطفى</td>
	  <td>19</td>
	  </tr>
	  <tr>
		<td>عمر</td>
		<td>28</td>
	  </tr>
	</table>
</div>
<h2>القوائم</h2>
<p>هناك عناصر أخرى تحتاج إلى وسمي البداية والإغلاق - كما هو حال معظم العناصر - مثل <code>ul</code> و<code>ol</code> و<code>li</code>. هذه العناصر تستخدم عندما تريد إنشاء القوائم.</p>
<p><code>ul</code> هي اختصار "unordered list" وهو عنصر يقوم بوضع نقاط لكل بند في القائمة، أما <code>ol</code> فهي اختصار "ordered list" أو قائمة مرتبة فهو يضع رقماً لكل بند في القائمة، ولكي نضع البنود في القائمة علينا أن نستخدم الوسم <code>li</code> أو "list item"، هل أصبت بالحيرة، شاهد هذا المثال:</p>
	<?php $text='<code=xml>
    <ul>
	  <li>list item 1</li>
	  <li>list item 2</li>
	</ul>

</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
    <ul dir="ltr">
	  <li>list item 1</li>
	  <li>list item 2</li>
	</ul>
</div>
<?php $text='<code=xml>
    
	<ol>
	  <li>First list item</li>
	  <li>Second list item</li>
	</ol>


</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
   
	<ol dir="ltr">
	  <li>First list item</li>
	  <li>Second list item</li>
	</ol>

</div>
<hr/>
<p>هدا كل شئ بالنسبة للوسوم الثنائية هناك العديد العديد من الوسوم الثنائية التي لم نتحدث عنها</p>
<p><strong>المتعلم:</strong>لقد غدرت بي أيها الوغد لمادا لم تعلمني كل شئ</p>
<p>باختصار لمادا أعلمك شئ قد لن تستعمله أبدا ,من خلال هدا الدرس ستتمكن من انشاء موقعك بمعنى أن التعليمات الموجودة في هده الدروس تكفيك لإنشاء أغلب أنواع المواقع ,ننتقل لنرى مادا تخبئ لنا الوسوم الأحادية</p>
</div>
</body>
<html>