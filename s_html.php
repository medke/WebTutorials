<?php
session_start();
$titre="الوسوم الأحادية";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">
<p>أهلا بعودتك,سنتعلم اليوم نوع جديد من الوسوم وهي الوسوم الأحادية ,الإختلاف الوحيد بينها و بين الوسوم الثنائية هو أن الوسوم الأحادية ليس لها بداية و نهاية فهي عبارة عن وسم وحيد.<br/></p>
<hr/>
<h2>الرجوع الى السطر</h2>
<p>سبق وأن وعدتك أنني سأريك تعليمة الى الرجوع الى السطر بدون غلق وسوم النص وفتحها من جديد.
</p>
<p>التعليمة <code dir="ltr">&lt;br/&gt;</code> تسمح لنا بالرجوع الى السطر لكن يجب  استعمالها داخل وسمي النص لأنها من الوسوم النصية.</p>
<?php $text='<code=xml>
	<p>i will go to the other ligne now <br/> oh the other ligne is very beatiful </p>
</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
	 	<p dir="ltr">i will go to the other ligne now <br/> oh the other ligne is very beatiful </p>
</div>
<h2>الصور</h2>
<p>آه الصور,ومن منا لايريد أن يرى صورا في موقعه</p>
<p>ألن يكون رائعاً إذا تمكنت من وضع صورة زيدان في موقعك  في منتصف صفحتك؟ --هدا مثال فقط --</p>
<?php $text='<code=xml>
	<img src="zidane.jpg" alt="zidane"/>
</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
	 	<img src="images/tuto/zidane.jpg" alt="zidane"/>
</div>
<p>كل ما تحتاج أن تفعله هو إخبار المتصفح بأنك تريد وضع صورة، (<code>img</code>) وموقعها (<code>src</code>, هو اختصار "source")، هل فهمت ذلك؟</p>
<p>لاحظ كيف أن عنصر <code>img</code> هو في نفسه وسم البداية والإغلاق، مثل <code dir="ltr">&lt;br /&gt;</code> لا يرتبط بنص معين.</p>
<p>"zidane.jpg" هو اسم ملف الصورة الذي تريد وضعها في صفحتك، و".jpg" هو نوع ملف الصورة، تماماً مثل اللاحقة ".htm" تزظهر أن الملف هو وثيقة HTML، ".jpg" تخبر المتصفح أن الملف هو صورة، هناك أنواع مختلفة من ملفات الصور التي يمكنك إضافتها لصفحتك:</p>
<ul>
		<li>GIF (Graphics Interchange Format)</li>
		<li>JPG / JPEG (Joint Photographic Experts Group)</li>
		<li>PNG (Portable Network Graphics) </li>
	</ul>
	<p><strong>صور GIF تستخدم عادة للرسومات، أما JPEG فتستخدم للصور الفوتوغرافية</strong>،هذا لسببين، الأول صور GIF يمكنها أن تحوي فقط 256 لوناً، بينما JPEG يمكنها أن تحوي ملايين الألوان، والسبب الثاني هو أن GIF هي صيغة ملف أفضل لضغط الصور البسيطة أما JPEG فهي أفضل للصور المعقدة التي تحوي تفاصيل كثيرة، وكلما زاد ضغط الصورة صغر حجمها، وهذا يعني أن صفحتك ستظهر بسرعة أكبر، وربما تعرف من خبرتك في المواقع أن الصفحات الثقيلة يمكنها أن تكون بطيئة بشكل كبير لدرجة تزعج الزائر.</p>
	<p>في الماضي كانتا صيغة الصورة GIF وJPEG الأكثر استخداماً في صفحات المواقع، مؤخراً صيغة الصور PNG بدأت تكتسب شهرة أكثر وأكثر على حساب صيغة GIF، <strong>صيغة PNG تحوي عدة طرق تجمع بين مميزات GIF وJPEG، حيث يمكنها أن تحوي ملايين الصور وتقوم بضغطها بشكل فعال</strong>.</p>
	<p>أما alt فهي الكلمة التي تظهر في حال تحميل الصفحة دون الصورة ,لنقص في سرعة الإنترنت ,ربما سبق وحصل لك هدا الموقف سترى كلمة في مكان الصورة .
وهي إجبارية في قانون w3c الجديد.</p>
<p>أما بالنسبة الى كيفية كتابة مكان الصورة في src فتخضع لنفس قانون الروابط</p>
<p>يمكنك طبعا وضع عنوان لصورة من النت.</p>
<?php $text='<code=xml>
	<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/Bill_Gates_2004_crop.jpg/220px-Bill_Gates_2004_crop.jpg" alt="zidane"/>
</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
	 	<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/4/40/Bill_Gates_2004_crop.jpg/220px-Bill_Gates_2004_crop.jpg" alt="zidane"/>
</div>
<p>صورة لـ BILL GATES مخترع Windows ومدير شــركة Microsoft<br/></p>
<hr/>
<p>الآن ننتقل الى الـCSS هدا  يعني أنك  على علم بالقواعد الأساسية لللـXHTML ,سنتعرف على اللغة الوصفيةCSS وهي أسهل بكثير منHTML والتي تسمح لنا بتنظيم و تلوين موقعنا.</p>

</div>
</body>
<html>