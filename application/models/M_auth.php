<?php
 
 class M_auth extends CI_Model {
  
  private $table = "data_users";
  private $pk = "id_user"; 
  
  public function __construct()
  {
   parent::__construct();
   $this->load->database();

  }
  
  public function add_account($data)
  {
    
    $this->db->insert('data_users',$data);
      $id = $this->db->insert_id();
      return (isset($id)) ? $id : FALSE;
  }

  public function changeActiveState($key)
  {
  
   $data = array(
   'active' => 1
   );

   $this->db->where('md5(id_user)', $key);
   $this->db->update('data_users', $data);

   return true;
  }

   public function checkAdmin($username,$password) 
   {
        //$p = md5($password); echo $p; exit;
        $sql=$this->db->query("SELECT  * FROM data_users  WHERE email='" . $username . "' AND password='" . md5($password) . "' limit 1 ");
       // echo $sql; exit;
        return $sql;
    }

     public function checkEmail($email) 
   {

        $sql=$this->db->query("SELECT  * FROM data_users  WHERE email = '" . $email ."' limit 1");
       
        return $sql;
    }

   


   public function update($data, $id_user)
    {
        $this->db->where($this->pk, $id_user);
        $this->db->update($this->table, $data);
    }

   public function get_by_cookie($cookie)
    {
        $this->db->where('cookie', $cookie);
        return $this->db->get($this->table);
    }


  
 }
?>