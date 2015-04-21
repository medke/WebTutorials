<?php
class membreManager{
 private $db;
 private $error_m=' الأخطاء :<br/>';
     public function __construct($db)
	{
	     $this->db = $db ; 
	}
		
	public function getError(membre $membre)
	{
	         
         	 $pseudo_erreur1= NULL;
			 $pseudo_erreur2= NULL;
			 $mdp_erreur= NULL;
			 $email_erreur1= NULL;
			 $email_erreur2= NULL;
			 $email_erreur3= NULL;
			 $msn_erreur= NULL;
			 $signature_erreur= NULL;
			 $bio_erreur= NULL;
			 $avatar_erreur= NULL;
			 $avatar_erreur1= NULL;
			 $avatar_erreur2= NULL;
			 $avatar_erreur3= NULL;
			 $domains = NULL;


             //On récupère les variables
             $i = 0;
             $temps        = time(); 
             $pseudo       = $membre->getMembre_pseudo();
             $signature    = $membre->getMembre_signature();
           	 $bio          = $membre->getMembre_bio();
             $email        = $membre->getMembre_email();
             $msn          = $membre->getMembre_msn();
             $website      = $membre->getMembre_siteweb();
             $localisation = $membre->getMembre_localisation();
             $pass         = $membre->getMembre_mdp();
             $confirm      = $membre->getMembre_mdp_conf();
	
             //Vérification du pseudo
             $query=$this->db->prepare('SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_pseudo =:pseudo');
             $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
             $query->execute();
             $pseudo_free=($query->fetchColumn()==0)?1:0;
             $query->CloseCursor();
             if(!$pseudo_free)
            {
                   $pseudo_erreur1 = "الإسم المتعار الذي أدخلته مستعمل من طرف عضو آخر";
                   $i++;
            }

            if (strlen($pseudo) < 3 || strlen($pseudo) > 15)
            {
                   $pseudo_erreur2 = "خطأ في عدد الأحرف المستعملة في الإسم المستعار";
                   $i++;
            }

              //Vérification du mdp
            if ($pass != $confirm || empty($confirm) || empty($pass))
            {
                   $mdp_erreur = "كلمة السر و تأكيد كلمة السر لا تتطابقان أو أحدهما فارغ";
                   $i++;
            }
              //Vérification de l'adresse email

              //Il faut que l'adresse email n'ait jamais été utilisée
            $query=$this->db->prepare('SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_email =:mail');
            $query->bindValue(':mail',$email, PDO::PARAM_STR);
            $query->execute();
            $mail_free=($query->fetchColumn()==0)?1:0;
            $query->CloseCursor();
    
             if(!$mail_free)
            {
                 $email_erreur1 = "بريدك الإلكتروني مستعمل من طرف عضو آخر";
                 $i++;
            }
            //On vérifie la forme maintenant
            if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
            {
                 $email_erreur2 = "خطأ في البريد الإلكتروني";
                 $i++;
            }

            $domains = substr(strrchr($email, "@"), 1);
	        $result=checkdnsrr($domains);
            if($result){}else{
	             $i++; 
	             $email_erreur3 = "خطأ في البريد الإلكتروني MSN";
	         };


	

             //Vérification de la signature
            if (strlen($signature) > 200)
            {
                  $signature_erreur = "توقيعك طويل جدا";
                  $i++;
            }
	         //Vérification de la bio
	        if (strlen($bio) > 16000)
            {
                  $bio_erreur = "سيرتك طويلة جدا";
                   $i++;
            }
         if ($i==0)
        {
		     return true;
		}
		else
		{
		     $this->error_m =''.$this->error_m .'خطأ في التجيل لـ '.$i.'  سبب  <br/>'.
			 $pseudo_erreur1.'<br/>'.
			 $pseudo_erreur2.'<br/>'.
			 $mdp_erreur.'<br/>'.
			 $email_erreur1.'<br/>'.
			 $email_erreur2.'<br/>'.
			 $email_erreur3.'<br/>'.
			 $msn_erreur.'<br/>'.
			 $signature_erreur.'<br/>'.
			 $bio_erreur.'<br/>'.
			 $avatar_erreur.'<br/>'.
			 $avatar_erreur1.'<br/>'.
			 $avatar_erreur2.'<br/>'.
			 $avatar_erreur3;
			 return false;
		}
		

	
	}
	public function error_m()
	{    $erreur =' '.$this->error_m.'';
	     return $erreur;
	}
	public function addMembre(membre $membre)
	{
	     $query=$this->db->prepare('INSERT INTO forum_membres (membre_pseudo, membre_mdp, membre_email,             
         membre_msn, membre_siteweb, membre_avatar,
         membre_signature, membre_localisation, membre_inscrit,   
         membre_derniere_visite,membre_ip,membre_bio)
         VALUES (:pseudo, :pass, :email, :msn, :website, :nomavatar, :signature, :localisation, :temps, :temps,:ip,:bio)');
       	 $query->bindValue(':pseudo',      $membre->getMembre_pseudo()      , PDO::PARAM_STR);
	     $query->bindValue(':pass',        $membre->getMembre_mdp()         , PDO::PARAM_INT);
	     $query->bindValue(':email',       $membre->getMembre_email()       , PDO::PARAM_STR);
       	 $query->bindValue(':msn',         $membre->getMembre_msn()         , PDO::PARAM_STR);
     	 $query->bindValue(':website',     $membre->getMembre_siteweb()     , PDO::PARAM_STR);
     	 $query->bindValue(':nomavatar',   $membre->getMembre_avatar()        , PDO::PARAM_STR);
       	 $query->bindValue(':signature',   $membre->getMembre_signature()   , PDO::PARAM_STR);
    	 $query->bindValue(':localisation',$membre->getMembre_localisation(), PDO::PARAM_STR);
      	 $query->bindValue(':temps',       time()                           , PDO::PARAM_INT);
      	 $query->bindValue(':ip',          $membre->getMembre_ip()          , PDO::PARAM_STR);
     	 $query->bindValue(':bio',         $membre->getMembre_bio()         , PDO::PARAM_STR);
         $query->execute();
		 $query->CloseCursor();
		 $id =$this->db->lastInsertId();
		 return $id;
	
	}
    public function connect(membre $membre)
	{
	    $query=$this->db->prepare('SELECT membre_mdp, membre_id, membre_rang, membre_pseudo
        FROM forum_membres WHERE membre_pseudo = :pseudo');
        $query->bindValue(':pseudo',$membre->getMembre_pseudo(), PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
		$membre->id($data['membre_id']);
		$membre->membre_rang($data['membre_rang']) ;
		
		if ($data['membre_mdp'] == $membre->getMembre_mdp()) // Acces OK !
	    {    
		    if ($data['membre_rang'] == 0) //Le membre est banni
            {
                $this->error_m =''.$this->error_m.'<p>أنت مطرود ,ليس مسموح لك أن تدخل هدا الموقع</p>';
				return false;
            }
            else //Sinon c'est ok, on se connecte
            {
                 return true;
	        }
	    }
	    else // Acces pas OK !
	    {
	        $this->error_m = ''.$this->error_m.'<p>خطأ حصل أثناء إدخالك لمعلوماتك<br /> خطأ في كلمة السر أو الإسم المستعار</p>';
			return false;
	    }
	    $query->CloseCursor();
	}
	public function afficher_membre(membre $membre)
	{
         //On récupère les infos du membre
        $query=$this->db->prepare('SELECT membre_pseudo, membre_avatar,
        membre_email, membre_msn, membre_signature, membre_siteweb, membre_post,
        membre_inscrit, membre_localisation,membre_bio
        FROM forum_membres WHERE membre_id=:membre');
        $query->bindValue(':membre',$membre->getMembre_pseudo(), PDO::PARAM_INT);
        $query->execute();
        $data=$query->fetch();
		$membre->membre_pseudo($data["membre_pseudo"]);
		$membre->membre_avatar($data["membre_avatar"]);
 		$membre->membre_email($data["membre_email"]);
		$membre->membre_msn($data["membre_msn"]);
		$membre->membre_signature($data["membre_signature"]);
		$membre->membre_siteweb($data["membre_siteweb"]);	
		$membre->membre_post($data["membre_post"]);
		$membre->membre_inscrit($data["membre_inscrit"]);
		$membre->membre_localisation($data["membre_localisation"]);	
		$membre->membre_bio($data["membre_bio"]);	
		$query->CloseCursor();
	}
    public function info_membre(membre $membre)
	{
         //On récupère les infos du membre
        $query=$this->db->prepare('SELECT membre_pseudo, membre_email,
        membre_siteweb, membre_signature, membre_msn, membre_localisation,
        membre_avatar,membre_bio
        FROM forum_membres WHERE membre_id=:id');
        $query->bindValue(':id',$membre->getMembre_id(),PDO::PARAM_INT);
        $query->execute();
        $data=$query->fetch();
		$membre->membre_pseudo($data["membre_pseudo"]);
		$membre->membre_avatar($data["membre_avatar"]);
 		$membre->membre_email($data["membre_email"]);
		$membre->membre_msn($data["membre_msn"]);
		$membre->membre_signature($data["membre_signature"]);
		$membre->membre_siteweb($data["membre_siteweb"]);
		$membre->membre_localisation($data["membre_localisation"]);	
		$membre->membre_bio($data["membre_bio"]);	
		$query->CloseCursor();
	}
	public function modif_membre(membre $membre)
	{   $i=0;
	    $email_erreur1 = NULL;
        $email_erreur2 = NULL;
        $msn_erreur = NULL;
        $signature_erreur = NULL;
    	$bio_erreur= NULL;
		$mail =$membre->getMembre_email();
		$msn = $membre->getMembre_msn();
		$query=$this->db->prepare('SELECT membre_email FROM forum_membres WHERE membre_id =:id'); 
        $query->bindValue(':id',$membre->getMembre_id(),PDO::PARAM_INT);
        $query->execute();
        $data=$query->fetch();
		$email=$data['membre_email'];
		$query->CloseCursor();
		
            if (strtolower($email) != strtolower($mail))
            {
                 //Il faut que l'adresse email n'ait jamais été utilisée
                $query=$this->db->prepare('SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_email =:mail');
                $query->bindValue(':mail',$mail,PDO::PARAM_STR);
                $query->execute();
                $mail_free=($query->fetchColumn()==0)?1:0;
                $query->CloseCursor();
                   if(!$mail_free)
                    {
                        $email_erreur1 = "بريدك الإلكتروني مستعمل من طرف عضو آخر";
                        $i++;
                    }
					if (!preg_match("#^[a-z0-9A-Z._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail) || empty($mail) )
                    {
                        $email_erreur2 = "خطأ في البريد الإلكتروني";
                        $i++;
                    }
            }       
         //Vérification de l'adrese msn
        if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $msn) && !empty($msn))
        {
            $msn_erreur = "خطأ في البريد الإلكتروني MSN";
            $i++;
        }

         //Vérification de la signature
        if (strlen($membre->getMembre_signature()) > 200)
        {
            $signature_erreur = "توقيعك طويل جدا";
            $i++;
        }
		if (strlen($membre->getMembre_bio()) > 9000)
        {
                  $bio_erreur = "سيرتك طويلة جدا";
                   $i++;
        }
	    if ($i == 0) // Si $i est vide, il n'y a pas d'erreur
        {
			return true;
	    }
		else
		{
			return false;
			$this->error_m = ''.$this->error_m.' خطأ في التجيل لـ  '.$i.' سبب <br/>'.$email_erreur1.'<br/>'.$email_erreur2.'<br/>'.$msn_erreur.'<br/>'.$signature_erreur.'<br/>'.$bio_erreur;
			
		}
	
	
	}
	public function verif_avatar(array $file)
	{
	    $avatar_erreur= NULL;
	    $avatar_erreur1= NULL;
	    $avatar_erreur2= NULL;
		$avatar_erreur3= NULL;
	    

            //On définit les variables :
			$i=0;
            $maxsize = 30072; //Poid de l'image
            $maxwidth = 100; //Largeur de l'image
            $maxheight = 100; //Longueur de l'image
            //Liste des extensions valides
            $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' );
 
            if ($file['avatar']['error'] > 0)
            {
                $avatar_erreur = "خطأ في إرسال الصورة : ";
            }
            if ($file['avatar']['size'] > $maxsize)
            {
                $i++;
                $avatar_erreur1 = "حجم الملف كبير  :
                (<strong>".$file['avatar']['size']." Octets</strong>
                بالمقابل الحجم ألأأٌصى المسموح به <strong>".$maxsize." Octets</strong>)";
            }
 
            $image_sizes = getimagesize($file['avatar']['tmp_name']);
            if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
            {
                $i++;
                $avatar_erreur2 = "صورة كبيرة  :
                (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> و الحجم الأقصى المسموح به
                <strong>".$maxwidth."x".$maxheight."</strong>)";
            }
 
            $extension_upload = strtolower(substr(  strrchr($file['avatar']['name'], '.')  ,1));
            if (!in_array($extension_upload,$extensions_valides) )
            {
                $i++;
                $avatar_erreur3 = "خطأ في نوع الملف ,يرجى أن تتأكد أنك أدخلت صورة";
            }
		    if ($i == 0) // Si $i est vide, il n'y a pas d'erreur
            {
			     return true;
			}
			else
			{
			     $this->error_m = ' '.$this->error_m.'  خطأ في التجيل لـ '.$i.'سبب <br/>'.$avatar_erreur.'<br/>'.$avatar_erreur1.'<br/>'.$avatar_erreur2.'<br/>'.$avatar_erreur3;
			     return false;
				 
			}
	
	}
	public function update_avatar($nomavatar,$id) 
	{
	    $query=$this->db->prepare('UPDATE forum_membres
        SET membre_avatar = :avatar 
        WHERE membre_id = :id');
        $query->bindValue(':avatar',$nomavatar,PDO::PARAM_STR);
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();
	}
    public function del_avatar($id) 
	{
        $query=$this->db->prepare('UPDATE forum_membres
		SET membre_avatar=0 WHERE membre_id = :id');
        $query->bindValue(':id',$id,PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();
	}
	public function update_membre(membre $membre) 
	{
        $query=$this->db->prepare('UPDATE forum_membres
        SET   membre_email=:mail, membre_msn=:msn, membre_siteweb=:website,
        membre_signature=:sign, membre_localisation=:loc,membre_bio=:bio
        WHERE membre_id=:id');
        
        $query->bindValue(':mail',   $membre->getMembre_email()       ,PDO::PARAM_STR);
        $query->bindValue(':msn',    $membre->getMembre_email()       ,PDO::PARAM_STR);
        $query->bindValue(':website',$membre->getMembre_siteweb()     ,PDO::PARAM_STR);
        $query->bindValue(':sign',   $membre->getMembre_signature()   ,PDO::PARAM_STR);
		$query->bindValue(':bio',    $membre->getMembre_bio()         ,PDO::PARAM_STR);
        $query->bindValue(':loc',    $membre->getMembre_localisation(),PDO::PARAM_STR);
        $query->bindValue(':id',     $membre->getMembre_id()          ,PDO::PARAM_INT);
        $query->execute();
    
	
		 $query->CloseCursor();
	}	
	public function verif_mdp(membre $membre,$passan)
	{
	     $query=$this->db->prepare('SELECT membre_mdp
         FROM forum_membres WHERE membre_id=:id');
         $query->bindValue(':id',$membre->getMembre_id(),PDO::PARAM_INT);
         $query->execute();
         $data=$query->fetch();
		 $ancien=stripslashes(htmlspecialchars($data['membre_mdp']));
		 $query->CloseCursor();
		 $pass =$membre->getMembre_mdp();
         $confirm = $membre->getMembre_mdp_conf();
		 
		 $i=0;
		 $mdp_erreur1 = NULL;
		 $mdp_erreur2= NULL;
		 $mdp_erreur3 = NULL;
		 $passan = md5($passan);
		
		 if ($ancien!=$passan){
		 $i++;
		 $mdp_erreur1 = "كلمة السر القديمة و الجديدة غير متطابقتين";
		 }
		
	    if (empty($pass)){
		$mdp_erreur2 = "كلمة السر فارغة";
		$i++;
		}
		
		if ($pass!=$confirm){
		$mdp_erreur3 = "كلمة السر و تأكيد كلمة السر مختلفتان أو فارغتان";
		$i++;
		}
		if ($i == 0) // Si $i est vide, il n'y a pas d'erreur
        {
	         return true;
	    }
		else
		{
		     $this->error_m =''.$this->error_m.'  خطأ في التعديل لأـ'.$i.' سبب<br/>'.$mdp_erreur1.'<br/>'.$mdp_erreur2.'<br/>'.$mdp_erreur3;
		     return false;
		}
	}
	public function update_mdp(membre $membre) 
	{
		$query=$this->db->prepare('UPDATE forum_membres
        SET  membre_mdp = :mdp
        WHERE membre_id=:id');
        $query->bindValue(':mdp',$membre->getMembre_mdp(),PDO::PARAM_INT);
        $query->bindValue(':id',$membre->getMembre_id(),PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();
	}
	public function countMembre()
	{
	     $TotalDesMembres = $this->db->query('SELECT COUNT(*) FROM forum_membres')->fetchColumn();
		 
		 return $TotalDesMembres;
	}
	public function getDernier()
	{    $retour= array();
	     $query = $this->db->query('SELECT membre_pseudo, membre_id FROM forum_membres ORDER BY membre_id DESC LIMIT 0, 1');
         $data = $query->fetch();
         $retour['membre'] = stripslashes(htmlspecialchars($data['membre_pseudo']));
		 $retour['id']=$data['membre_id'];
		 return $retour;
		 $query->CloseCursor();
	
	}



}
?>