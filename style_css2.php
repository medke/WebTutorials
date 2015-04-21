<?php
session_start();
$titre="كل شئ عن النصوص";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">
<p>تنسيق وإضافة طراز إلى النصوص هي مسئلة أساسية لمصممي المواقع، في هذا الدرس ستأخذ مقدمة حول الأساليب العجيبة التي تقدمها CSS لتنسيق النص, حاول تدكر أكبر قدر ممكن لأنه من أهم الدروس و يمكن الرجوع إليه في أي وقت .</p>
<hr/>
<h2>محاذاة النص "text-align"</h2>
<p>خاصية <code>text-align</code> تشبه في HTML خاصية "align" التي كانت تستخدم في الماضي، النص يمكن محاذاته نحو اليسار "<strong>left</strong>" أو اليمين "<strong>right</strong>" أو في المنتصف "<strong>centred</strong>" وبالإضافة إلى ذلك القيمة  <strong>justify</strong> ستقوم بمحاذاة النص من الجانبين كما تفعل بعض الصحف والمجلات.</p>
<p>يكمنك أن ترى الفرق بينهم من خلال هده الأمثلة (إصغط على جرب المثال لكي تجرب المثال)<img alt="rire" src="images/smileys/rire.gif"/></p>
<h4>right</h4>
		<?php $text='<code=CSS> 
	p
	{
	text-align: right;
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css11.html">جرب المثال</a></h4>
<h4>justify</h4>
		<?php $text='<code=CSS> 
	p
	{
	text-align: justify;
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css13.html">جرب المثال</a></h4>
<h4>center</h4>
		<?php $text='<code=CSS> 
	p
	{
	text-align: center;
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css12.html">جرب المثال</a></h4>
<p>أنصحكم تجريب الثلاث أمثلة في آن واحد لرؤية الفرق جيدا</p>
<h2>نوع النص "font-family"</h2>
<p>لن أكثر الحديث على هدا العنوان لأنه كل ماعليك فعله هو اختيار الخط لكن هناك نقطة أريد أن أنبه لها بعد هدا المثال:</p>
		<?php $text='<code=CSS> 
	p
	{
	font-family:arial;
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css14.html">جرب المثال</a></h4>
<p>لكن فلنفرض أن متصفح زائر موقعك لايعرف نوع الخط Arial (نعم ,هناك فروق من متصفح الى آخر لدلك نصحتكم في أول الدرس بتحميل mozilla Firefox )سيظهر لك في الشاشة حروف تشبه :Ø³Ø£Ù„Ø© ÙˆÙ‚Øª Ùˆ Ù…Ù   طبعا و هدا ما لا أتمناه لكم .  </p>
<p><strong>المتعلم:</strong>ولكن لا يمكنني أن أعرف اي متصفح يستعمله الزائر ولا يمكنني أن أعرف كل متصفح مادا يقبل كخطوط تبدو مهمة شبه مستحيلة<img alt="!" src="images/smileys/triste.gif"/></p>
<p>ولدلك من المستحب كتابة 4 أنواع من الخطوط على الأقل ,ادا لم يعرف المتصفح النوع الأول ينتقل الى الثاني تلقائيا وادا لم يعرف الثاني ينتقل الى الثالث تلقائيا ..الخ ,وبعدها يمنكم النوم وأنتم على يقين أن كل متصفحين الزوار يمكنهم رؤية موقعك, الكتابة تكون بهدا الشكل (مثال) </p>
		<?php $text='<code=CSS> 
	p
	{
	font-family:arial,Verdana,Tahoma,sans-serif; 
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h2>حجم الخط "font-size"</h2>
<p>سأريكم طريقتين  لكي تغيير حجم الخط ,لكن يستحسن استخدام الطريقة الأولى</p>
<h4>الطريقة الأولى</h4>
<p>عن طريق النسبة المؤوية, 100% تمثل الحجم الحالي للخط , مثلا 87% يعنني أننا أنقصنا من حجم الخط بـ 13% , مثلا 120% يعني أننا زدنا من حجم الخط 20%  . مثال:</p>
		<?php $text='<code=CSS> 
	p
	{
	font-size:120%; 
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css15.html">جرب المثال</a></h4>
<p>أظن أن الفكرة و صلت , ادا كان الجواب  " لا  "   أدكر أنه يمكنك طرح المشكلة في المنتدى في القسم المخصص لها و سنحل المشكلة معا.</p>
<h4>الطريقة الثانية</h4>
<p>وهي تحديد الحجم بــالـبيكسال Pixel (وحدة قياس كالسنتيمتر), كالعادة بالمثال يتضح المقال.</p>
		<?php $text='<code=CSS> 
	p
	{
	font-size:16px; 
	}
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css16.html">جرب المثال</a></h4>
<p style="color:red;">لاحظ جيدا أنني لم أترك فراغ بين العدد و الوحدة px</p>
<h2>زخرفة النص "text-decoration"</h2>
<p>الخاصية <code>text-decoration</code> تمكنك من إضافة زخارف أو تأثيرات على النص، فمثلاً يمكنك أن تضيف سطراً أسفل النص، أو فوقه أو عليه، في المثال الآتي كل عناصر <code>&lt;h1&gt;</code> وضعنا أسفلها خطاً أما <code>&lt;h2&gt;</code> فهي العناوين التي فوقها خط و<code>&lt;h3&gt;</code> قمنا بوضع الخط عليها.</p>
		<?php $text='<code=CSS> 
	h1 {
		text-decoration: underline;
	}

	h2 {
		text-decoration: overline;
	}

	h3 {
		text-decoration: line-through;
	}
	

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4><a href="test/css17.html">جرب المثال</a></h4>
<hr/>
<p>القليل من الصبر أعلم أنك تتلقى كم كبير من المعلومات  ,لم يبقى إلا 3 دروس وتتعلم كيف تنشأ مظهر أو Design لموقعك .</p>
</div>
</body>
<html>