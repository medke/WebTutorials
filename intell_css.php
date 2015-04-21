<?php
session_start();
$titre="دكاء الـ css";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">
<p>ربما لاحظتم خاصة في الروابط عندا تضعون مؤشر الفأرة فوق رابط يتبدل لونه أو عندما تنقرون فوق رابط يتبدل لونه و يبقي لعدة ثواني . هنا ستتعلمون كيفية القيام بدلك (لا تخافو درس سهل)<br/><hr/></p>

<p><strong>تدكير :</strong>في درس الـ html استطعنا إنشاء روابط كالآتي ,طبعا و الدي لم يقرأ الدرس سأطلب منه قراءة درس الروابط ثم الرجوع.</p>
<?php $text='<code=xml> 
<a href="page2.htm">Click here to go to page 2</a>
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result_h" >
        <p><a style="color:blue;" href="page2.htm">Click here to go to page 2</a> </p>
</div>
<p>سنغير لون الرابط ( أعلم أنك كبرت على مثل هده الأشياء لكن لتدكير فقط) </p>
		<?php $text='<code=CSS> 
	a {
	color:green;
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result_h" >
        <p><a href="page2.htm" style="color:green;">Click here to go to page 2</a> </p>
</div>
<h2>:hover</h2>
<p>الفئة  <code>:hover</code> تستخدم عندما يكون مؤشر الفأرة فوق الرابط.</p>
<p>يمكن استخدام هذه الفئة لإنشاء مؤثرات جميلة، فمثلاً إذا أردنا أن تكون الروابط ملونة بالبرتقالي ومائلة عندما نضع مؤشرة الفأرة عليها فعلينا أن نكتب CSS بهذا الشكل:</p>
	<?php $text='<code=CSS> 
	a {
	color:green;
	}
	a:hover {
		color: orange;
		font-style: italic;
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result_h" >
        <p><a href="#" >Click here to go to page 2</a> </p>
</div>
<h2>الفئة المزيفة: link</h2>
<p>الفئة المزيفة <code>:link</code> تستخدم للروابط التي تقود المستخدم إلى صفحات لم يزرها.</p>
<p>في المثال أدناه الروابط التي لم يزرها المستخدم ستظهر بلون أزرق فاتح.</p>
	<?php $text='<code=CSS> 
	
	a:link {
		color: #6699CC;
	}
	

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h2>الفئة المزيفة: visited</h2>
<p>الفئة المزيفة <code>:visited</code> تستخدم للروابط التي زارها المستخدم، المثال أدناه سيجعل كل الروابط التي زارها المستخدم بلون بنفسجي غامق:</p>
<?php $text='<code=CSS> 
	
	a:visited {
		color: #660099;
	}

	

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>

<p><hr/><br/>درس صغير, لكن مهم .</p>




</div>
</body>
<html>