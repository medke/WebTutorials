<?php
class Forum
{
  private $cat_id,
          $cat_nom,
		  $cat_ordre,
		  $forum_id,
		  $forum_cat_id,
		  $forum_name,
		  $forum_desc,
		  $forum_ordre,
		  $forum_last_post_id,
		  $forum_topic,
		  $forum_post,
		  $auth_view ,
		  $auth_post ,
		  $auth_topic ,
		  $auth_annonce,
		  $auth_modo;
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
			    case 'cat_id':
				case 'cat_ordre':
				case 'forum_id':
				case 'forum_cat_id':
				case 'forum_ordre':
			    case 'forum_last_post_id':
				case 'forum_topic':
				case 'forum_post':
				case 'auth_view':
				case 'auth_post':		
				case 'auth_topic':
				case 'auth_annonce':
				case 'auth_modo':				
				     $this->$key =(int) $val;
					 break;
				case 'cat_nom':
				case 'forum_name':
				case 'forum_desc':
				     $this->$key =(string) $val;
					 break;				 
			
			}
		}
	
	}
	public function forum_id($id)
	{
	    $this->forum_id = $id;
	}
	public function getForum_id()
	{
	    return $this->forum_id;
	}
	public function forum_name($id)
	{
	    $this->forum_name = $id;
	}
	public function getForum_name()
	{
	    return  $this->forum_name;
	}
	public function forum_topic($id)
	{
	    $this->forum_topic = $id;
	}
	public function getForum_topic()
	{
	    return $this->forum_topic;
	}
	public function auth_view($id)
	{
	    $this->auth_view = $id;
	}
	public function getAuth_view()
	{
	    return $this->auth_view;
	}	
	public function auth_topic($id)
	{
	    $this->auth_topic = $id;
	}
	public function getAuth_topic()
	{
	    return $this->auth_topic;
	}	
	
}

?>