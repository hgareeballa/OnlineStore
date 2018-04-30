<?php if (!defined('BASEPATH')) die();
class Hassan091239818 extends Main_Controller {



	public function count_cards(){

	    $tr="";
	    $dt="";

	$query = $this->db->query("SELECT max(date) as 'total' FROM payments"); 
	foreach ($query->result() as $row)
	{ 
	   $dt=$row->total;
	}

	$query = $this->db->query("SELECT count(*) as 'total' FROM payments"); 
	foreach ($query->result() as $row)
	{ 
	   $tr=$row->total;
	}
	 echo json_encode(array('tr'=>$tr,'dt'=>$dt));
	} //count cards

	public function isit_here($mob){
	  //$mob = $_POST['mobile'];
      $data = array('mobile' => $mob,'counter' => '1000');
            
     
      $query = $this->db->query("select * from nas where mobile='$mob' and counter <='1'");      
      if ($query->num_rows() > 0) {
         //echo "Card already exists! ..";

	      	$x= $this->db->query("select counter from nas where mobile ='$mob' ")->row()->counter;
	      	$x = $x + 1;
	      	$data = array('mobile' => $mob,'counter' => $x);
	      	
     		$this->db->where('mobile', $mob);
			$this->db->update('nas', $data); 
      		echo json_encode(array('sts'=>'true'));

      } else {
         $this->db->insert('nas', $data);
         echo json_encode(array('sts'=>'false','msg'=>'You number is not registered for the discount, but we will get back to you.!'));
         //echo "Card successfuly Registered..!";         
      }
      
	}//is it listed

	  public function add_number_form(){
      //$this->load->view('include/public_header');      
      $data['table_name'] = "";
      $fields = array(
        array('label' => 'الرقم:','name' => 'mobile','type' => 'text','default' => 'رقم موبايل زين'),
        array('label' => 'الاسم:','name' => 'name','type' => 'text','default' => ''),        
        array('label' => 'الايميل:','name' => 'email','type' => 'text','default' => ''),        
        //array('label' => 'Feedback','name' => 'feedback','type' => 'textarea','default' => ''),  
        );
      $data['fields'] = $fields;
      $data['save_url'] = site_url('hassan091239818/add_number');
      $data['rd_url'] = "no_redirect";
      $this->load->view('myforms/form22',$data);
      //$this->load->view('include/footer');
   	}// add number 

	  public function add_number(){
		//        sleep(1);
		    $this->load->helper(array('form', 'url'));
		    $this->load->library('form_validation');		    
		    $this->form_validation->set_rules('mobile', 'Mobile Number', 'required|numeric');		    
		    //$this->form_validation->set_rules('name', 'Name', 'required');
		    $this->form_validation->set_message('required','الرجاء ادخال جميع البيانات !؟');
		   		 

		    if ($this->form_validation->run() == FALSE)
		    {
		      echo  validation_errors();
		    }
		    else
		    {
		      
		      $data = array('mobile' => $_POST['mobile'] ,'name' => $_POST['name'],'email' => $_POST['email'],'feedback' => $_POST['feedback']);
		      $this->db->insert('people', $data);		      
		      echo "Thank you, شكرا ليك";         		     
		      $this->sendemail("sudane@gmail.com,hamidbilo@gmail.com","Mobile: ".$_POST['mobile']."<br> Name:".$_POST['name']."<br> Email:".$_POST['email']."<br> Letter:".$_POST['feedback'].".");
		    } 
		    
		    
		    
  	}// add card


					public function username_check($str)
					{
					if ($str == '1')
					{
						$this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');
						return FALSE;
					}
					else
					{
						return TRUE;
					}
				}		    


   public function sendemail($to_mail,$msg){
            $this->load->library('email');
            $this->email->set_newline("\r\n"); /* for some reason it is needed */
            $this->email->from('support@myraseed.com', 'myRaseed.com');

            $this->email->to($to_mail);
            $this->email->subject('Feedback from a Customer');
            $this->email->message($msg);            
            if($this->email->send())
            {
            //$this->add2log("Email Sent to =".$to_mail." with MSG=".$msg); 
            }
            else
            {
            //$this->add2log("Email Sent Fail for=".$to_mail." >>>> EMAIL FAIL"); 
            }            
    echo "";        
   } // send email

}//control

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */