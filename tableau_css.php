<?php
session_start();
$titre="الجداول و القــوائم";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
include("includes/mcode.php");

?>
<div id="cour">

<p>طبعا في درس ال html عن الجدول وعدتكم أننا سنتعلم رسم أو انشاء حدود للجداول و كدلك تلوينها, ها أنا دا أفي بوعدي ,درس بسيط أما بالنسبة للقوائم تقريبا ستجده نفس شئ  .</p>
<hr/>
<p>تدكير : في درس الـ html استطعنا أن نكتب جدول على هدا النحو</p>
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
<h2>حدود "border"</h2>
<p>كل ماعيك فعله هو انشاء اطار لكل خانة من خلال الخاصية Border<br/>قلنا أننا الخانات نرمز لهم بـ td  لاتقل لي أنك نسيت</p>
<?php $text='<code=CSS> 
	td {
  border: 2px solid black;
	}
	

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
  <table style="border-collapse:separate;">
	<th> الإسم</th>
	 <th>العمر</th>
	  <tr>
	  <td style="  border: 2px solid black;">مصطفى</td>
	  <td style="  border: 2px solid black;">19</td>
	  </tr>
	  <tr>
		<td style="  border: 2px solid black;">عمر</td>
		<td style="  border: 2px solid black;">28</td>
	  </tr>
	</table>
	</div>
	<p>سأشرح كل ما فعلته نفطة بنقطة, أول شئ قلنا أن الخانة هي td وهي التي سننشأ عليها حدود لدلك كتبناها,ثم طبعا السؤال المطروح  ماهده Border ؟ هي الخاصية التي من خلالها ننشأ الحدود أو الإطارات, هل تتدكرون الخاصية background قلنا أننا يمكن أن تكون لها أكثر من قيمة بشرط أن تكون وفق ترتيب معين نفس الشئ بالنسبة لـBorder<br/>المثال الأول و المثال الثاني متساويين , الفرق الوحيد هو أن المثال الأول أقصر وأسهل.(طبعا يمكنك استعمال الطريقة التي تجدها أسهل ) </p>
	<h4>المثال الأول</h4>
	<?php $text='<code=CSS> 
	
	td {
  border: 2px solid black;
	}
	

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>المثال الثاني</h4>
	<?php $text='<code=CSS> 
	td {
                border-width: 2px;
		border-style: solid;
		border-color: black;

	}
	

  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>يمكنك استعمال border على أي شئ (نص ,عنوان,قائمة , صورة.. ) سنتعملها الآن على الـ th  (عناوين الخانات)<br/>يمكنك الكتابة بهدا الشكل </p>
<?php $text='<code=CSS> 
	
	td {
           border: 2px solid black;
	}
	th {
           border: 2px solid black;
	}
	
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<p>أو بهدا الشكل نفس الشئ</p>
<?php $text='<code=CSS> 
	
	td ,th {
           border: 2px solid black;
	}
	
	
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
  <table style="border-collapse:separate;">
	<th style="  border: 2px solid black;"> الإسم</th>
	 <th style="  border: 2px solid black;">العمر</th>
	  <tr>
	  <td style="  border: 2px solid black;">مصطفى</td>
	  <td style="  border: 2px solid black;">19</td>
	  </tr>
	  <tr>
		<td style="  border: 2px solid black;">عمر</td>
		<td style="  border: 2px solid black;">28</td>
	  </tr>
	</table>
	</div>
<p><strong>المتعلم:</strong>جميل ,لكن لمادا الحدود منفصلة كيف نجمعها مع بعضها البعض.</p>
<p>لدلك سنستعمل border-collapse لها قيمتان <br/><strong>collapse</strong> يعني أن الحدود مجتمعة <br/><strong>separate</strong> الحدود منفصلة </p>
<?php $text='<code=CSS> 
	
	td ,th {
           border: 2px solid black;
	}
	table  {
	border-collapse:collapse;
	}
	
	
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
  <table>
	<th style="  border: 2px solid black;"> الإسم</th>
	 <th style="  border: 2px solid black;">العمر</th>
	  <tr>
	  <td style="  border: 2px solid black;">مصطفى</td>
	  <td style="  border: 2px solid black;">19</td>
	  </tr>
	  <tr>
		<td style="  border: 2px solid black;">عمر</td>
		<td style="  border: 2px solid black;">28</td>
	  </tr>
	</table>
	</div>
	<h2>تلوين الجدول</h2>
	<p>هدا العنوان تدكير فقط ,لأننا رأينا كل شئ عن الألون في الدرس الأول لدلك لن أطيل عليكم ,سنعطي مثال فقط.</p>
	<?php $text='<code=CSS> 
	
	td  {
           border: 2px solid black;
		   color:#cbd2d2;
		   background-color:#ff9d4f;
	}
	td  {
           border: 2px solid black;
		   color:#69a2ba;
		   background-color:#41a900;
	}
	table  {
	border-collapse:collapse;
	}
	
	
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
  <table>
	<th style="  border: 2px solid black;color:#304885;background-color:#ff9d4f;"> الإسم</th>
	 <th style="  border: 2px solid black;color:#304885;background-color:#ff9d4f;">العمر</th>
	  <tr>
	  <td style="  border: 2px solid black;color:#304885;background-color:#41a900;">مصطفى</td>
	  <td style="  border: 2px solid black;color:#304885;background-color:#41a900;">19</td>
	  </tr>
	  <tr>
		<td style="  border: 2px solid black;color:#304885;background-color:#41a900;">عمر</td>
		<td style="  border: 2px solid black;color:#304885;background-color:#41a900;">28</td>
	  </tr>
	</table>
	</div>
	<h2>خصائص القوائم</h2>
	<h4>تدكير</h4>
	<p>ادا كنت قد تابعت معنا درس الـ html فإننا استطعنا القيام بهدا  </p>
	<?php $text='<code=xml>
  <ul>

	  <li>list item 1</li>

	  <li>list item 2</li>

	</ul>
<ol>

	  <li>First list item</li>

	  <li>Second list item</li>

	</ol>

</code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
    <ul>

	  <li>list item </li>

	  <li>list item </li>

	</ul>
<ol>

	  <li>First list item</li>

	  <li>Second list item</li>

	</ol>
	</div>
	<p>ستتعلم الآن أنك قادر على تغيير تلك النقطة بالنسبة الى القوائم ul الى أي صورة أردتها , وأنك قادر على تغيير الأرقام بالنسبة الى ol الى أرقام رومانية(I, II, III, IV, V...) أو أحرف انخليزية ...الخ.</p>
	<p>سنستعمل الخاصية  " list-style-type" قيمها بالنسبة الى ul هي<br/><ul>

	  <li><strong>disc :</strong>  قرص أسود (كما في البداية)  </li>
      <li><strong>circle :</strong>  دائرة  </li>
	  <li><strong>square :</strong>  مربع  </li>
	  <li><strong>none :</strong>  فراغ  </li>
	</ul><br/>أما بالنسبة للـ ol قيم list-style-type هي:(سنرى بعض القيم المهمة فقط لأنه يوجد الكثير)  <ul>

	  <li><strong>decimal :</strong>  أعداد (1.2.3....) (كما في المثال)  </li>
	  <li><strong>decimal-leading-zero :</strong>  أعداد لكن برقمين (01,02,03,04.....)  </li>
      <li><strong>upper-roman :</strong>  أحرف رومانية كبيرة (I, II, III, IV, V...)  </li>
      <li><strong>upper-alpha :</strong>  أحرف إنخليزية كبيرة (A, B, C, D, E...)  </li>

	</ul><br/>مثال</p>
		<?php $text='<code=CSS> 
	
	ul  {
          list-style-type: circle;

	}
	ol  {
           list-style-type: upper-roman;

	}
	
	
	
  </code>
';
echo(zcode(stripslashes(htmlspecialchars($text))));?>
<h4>النتيجة</h4>
<div id="result">
    <ul style="list-style-type: circle;">

	  <li>list item </li>

	  <li>list item </li>

	</ul>
<ol style=" list-style-type: upper-roman;">

	  <li>First list item</li>
      <li>Second list item</li>
	  

	</ol>
	</div>
	<hr/>
	<p><br/>كما لاحظتم أنا أضع أمثلة صغيرة فقط ,لكي أشجعكم على التجربة و الممارسة , لأن في الأخير الإعلام الآلى ممارسة , لن أكون معكم ( لن أكون معك حيث تمكث, لن أنا معكم دائما إدا و اجهتكم مشكلة هناك منتدى خصيصا لحل مشاكلكم طبعا في الإعلام الآلي ) عندما تنشؤن موقعكم ,لدلك أظنكم لاحظتم أن مع مرور الدروس أترككم تستكشفون بمفردكم .</p>
</div>
</body>
<html>