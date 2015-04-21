<?php

include "geshi.php";
function zcode($texte)
{
//Smileys

$texte = str_replace(':D ', '<img src="./images/smileys/heureux.gif" title="heureux" alt="heureux" />', $texte);
$texte = str_replace(':lol: ', '<img src="./images/smileys/lol.gif" title="lol" alt="lol" />', $texte);
$texte = str_replace(':triste:', '<img src="./images/smileys/triste.gif" title="triste" alt="triste" />', $texte);
$texte = str_replace(':frime:', '<img src="./images/smileys/cool.gif" title="cool" alt="cool" />', $texte);
$texte = str_replace(':rire:', '<img src="./images/smileys/rire.gif" title="rire" alt="rire" />', $texte);
$texte = str_replace(':s', '<img src="./images/smileys/confus.gif" title="confus" alt="confus" />', $texte);
$texte = str_replace(':O', '<img src="./images/smileys/choc.gif" title="choc" alt="choc" />', $texte);
$texte = str_replace(':question:', '<img src="./images/smileys/question.gif" title="?" alt="?" />', $texte);
$texte = str_replace(':exclamation:', '<img src="./images/smileys/exclamation.gif" title="!" alt="!" />', $texte);


//image et url et email
$texte = preg_replace('/\[img\](.+?)\[\/img\]/', '<img src="$1" alt="Image membre" title="Image membre"/>', $texte);
$texte = preg_replace('/\[url\](.+?)\[\/url\]/', '<a href="$1" >$1</a>', $texte);
$texte = preg_replace('/\[mail\](.+?)\[\/mail\]/', '<a href="mailto:$1">$1</a>', $texte);
//Mise en forme du texte
//gras
$texte = preg_replace('`\[g\](.+)\[/g\]`isU', '<strong>$1</strong>', $texte); 
//italique
$texte = preg_replace('`\[i\](.+)\[/i\]`isU', '<em>$1</em>', $texte);
//souligné
$texte = preg_replace('`\[s\](.+)\[/s\]`isU', '<span style=" text-decoration: underline;">$1</span>', $texte);
//size
$texte = preg_replace('`\[size=(.+)](.+)\[/size]`isU', '<h$1> $2</h$1>', $texte);
//lien
//etc., etc.
$texte = preg_replace('`\[quote\](.+)\[/quote\]`isU', '<div id="quote">$1</div>', $texte);
$texte = preg_replace('`\[color=(.+)](.+)\[/color]`isU', '<span style="color: $1;">$2</span>', $texte);



$texte = preg_replace_callback("#&lt;code=(.+)&gt;(.*)&lt;/code&gt;#siU", create_function('$matches', 'return code($matches[2], $matches[1]);'), $texte);
$texte= nl2br($texte);   
mynl2br($texte);
return $texte;
}

function code($source, $language){
    
    $source = html_entity_decode($source);
    $code = new GeSHi($source, $language);
    $parse = $code->parse_code();
    $resultat = 'Code : '.$language.'<br /><div id="code" dir="ltr" >'.$parse.'</div>';
   
    return ($resultat);
 
}
function mynl2br($text) {
   return strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />'));
}

?>