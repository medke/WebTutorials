<?php

class cour {

private $id,
        $titre,
		$intro,
		$conclusion,
		$hauteur,
		$time_creation,
		$time_update,
		$type,
		$lge,
		$icone;
		
		public function __construct(array $donnes)
	    {
	    $this->hydrate($donnes);
	    }
		public function hydrate(array $donnes)
	{       
	     foreach($donnes as $key=>$val)
		{
		    switch($key)
			{
			    case 'id':
				case 'time_creation':
				case 'time_update':
				     $this->$key =(int) $val;
					 break;
				case 'titre':
				case 'intro':
				case 'conclusion':
				case 'hauteur':
				case 'type':
				case 'lge':
				case 'icone':
				     $this->$key =(string) stripslashes($val);
					 break;				 
			
			}
		}
	
	}
		
		
        
	   public function titre()
	   {
          return $this->titre;	   
	   }
	   public function intro()
	   {
          return $this->intro;	   
	   }
	   public function conclusion()
	   {
          return $this->conclusion;	   
	   }
	   public function hauteur()
	   {
          return $this->hauteur;	   
	   }
	   public function type()
	   {
          return $this->type;	   
	   }
	   public function lge()
	   {
          return $this->lge;	   
	   }
	   	   public function time_update()
	   {
          return $this->time_update;	   
	   }
	   
	   public function id()
	   {
          return $this->id;	   
	   }
	   public function setid($id)
	   {
	      $this->id =$id;
	   }
	   public function affichage(array $donnes,cour $cour)
	   {   
	        date_default_timezone_set('UTC');
	        $retour= '<h2>قائمة الدروس</h2><table><tr> <th>صورة</th>   <th>   عنوان   </th><th>    نوع   </th><th>   لغة البرجة    </th><th>   تاريخ الإنشاء   </th><th>  تاريخ آخر تعديل</th> <th></th><th></th><th></th><th></th><th></th>  </tr>';
			            if(!empty($donnes)) {
						 foreach($donnes as $key=>$val)
			            {   
				             
                             
						    if(!empty($val['icone'])){
			                $retour= ''.$retour. '<tr>
							<td><img src="./images/icone/'.htmlspecialchars($val['icone']).'" alt="membre  " /></td>';}
							else{
							$retour= ''.$retour. '<tr>
							<td><img src="./images/icone/icone3.png" alt="membre  " /></td>';
							}
							$retour= ''.$retour. '
							<td>  <strong>'.$val['titre'].'</strong>  </td>
							<td>  '.$val['type'].'  </td><td>  '.$val['lge'].'  </td>
							<td>  '.date('H\hi \l\e d/M/Y',$val['time_creation']).'  </td>
							<td>  '.date('H\hi \l\e d/M/Y',$val['time_update']).'  </td>
							';
							if($val['valid']==0){
							$retour= ''.$retour. '<td><a href="index_cour.php?vde='.$val['id'].'&h='.$cour->hauteur().'">-- تثبيث --</a></td>';
							}else{
							$retour= ''.$retour. '<td><a href="index_cour.php?dvde='.$val['id'].'&h='.$cour->hauteur().'">-- تعطيل --</a></td>';
							}
							$retour= ''.$retour. '<td> <a href="index_cour.php?t='.$val['id'].'&h='.$cour->hauteur().'"> تعديل--  </a> </td>
							<td> <a href="index_cour.php?e='.$val['id'].'&h='.$cour->hauteur().'"> كتابة </a> </td>
							<td ><a id="bbb" href="index_cour.php?s='.$val['id'].'&h='.$cour->hauteur().'" > --حذف </a></td>
							<td><a href="index_cour.php?v='.$val['id'].'&h='.$cour->hauteur().'"> --عرض-- </a></td></tr>';
                            
			            }
						$retour=''.$retour. '</table><p><a href="./index_cour.php">رجوع إلى صفحة الدروس</a></p>';
						 }else{
						  $retour='<p><a href="./index_cour.php">رجوع إلى صفحة الدروس </a></p>';
						 }
			 return $retour;			 
	   
	   }


}

?>