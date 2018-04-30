<?php if (!defined('BASEPATH')) die();
class Secure_data extends Main_Controller {


 public function show__(){
  $fields = array(        
        array('id' => "id",'name' => "ID"),
        array('id' => "mobile",'name' => "Mobile"),
        array('id' => "name",'name' => "name")
        );
  $this->show_table_rw("people","people Tables.",$fields);  
 }//


 public function show_table_ro($tbl,$tbl_h,$fields){
 $data['tbl_header'] = $tbl_h;
 $data['geturl'] = site_url('frontpage/get/'.$tbl);
 $data['fields'] = $fields;
 $this->load->view('myforms/show_table_ro_2',$data);
 //$this->output->cache(10);
 }//show


 public function show_table_rw($tbl,$tbl_h,$fields){
 $data['tbl_header'] = $tbl_h;
 $data['geturl'] = site_url('frontpage/get/'.$tbl);
 $data['delurl'] = site_url('frontpage/delete/'.$tbl);
 $data['updurl'] = site_url('frontpage/update/'.$tbl);
 $data['fields'] = $fields;
 $this->load->view('myforms/show_table_rw_2',$data);
 //$this->output->cache(10);
 }//show

//-----------------------------------------
	public function show_table(){

       //$this->load->view('include/header');  
     // $data['table_name'] = "Feedback";
      //$data['geturl'] = site_url('frontpage/get/people');
      //$data['addurl'] = site_url('frontpage/add/people');
      //$data['delurl'] = site_url('frontpage/delete/people');
      //$data['updurl'] = site_url('frontpage/update/people');
      
      
      //$this->load->view('myforms/show_data_2');
      //$this->load->view('include/footer');
		
      $this->load->library('table');
      $this->load->helper('html');

      $delurl= site_url('frontpage/delete/people');

      $q="select id,mobile,name, email from people";  
      //$amount=$this->get_amount($userid);

      $query = $this->db->query($q);
      
      //$query = $this->get('order_details');
      if ($query->num_rows()<=0) {
         $this->table->set_caption("Feedback.Empty <i class=''></i>");
         $this->table->add_row('');
      } else {      
          $this->table->set_caption("Feedback Details <i class=''></i>");
          $this->table->set_heading('ID', 'mobile','name','email','Action');
          foreach ($query->result() as $row)
          {
           $this->table->add_row(array($row->id,$row->mobile,$row->name,$row->email,"<button id='remove' class='deleterow' data-toggle='tooltip' title='Delete' class='btn btn-xs' value='$row->id'>[X]</button>"));
          }    
               
      }          
          

      $data['results'] = $this->table->generate();      
      //$this->load->view('include/header_lib');   
      $this->load->view('myforms/show_data_',$data);




		//$this->load->library('table');
		//$tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="mytable" align="center">' );
		//$this->table->set_template($tmpl);

		//$query = $this->db->query("SELECT * FROM nas");
		//echo $this->table->generate($query);

	}// table


	//--------------------------------------------------------------------


   public function welcome_page()
  {
  echo '<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Well done!</strong> Welcome to Myraseed Admin Page !.
  </div>';


  } // welcome page

  public function login_page()
  {
  echo "Welcome Page!";
  } // login page


  public function check_me($ps){
      if ($ps=="letmein200" || $ps=="1") {
        echo json_encode(array('sts'=>'true'));
      } else {
        echo json_encode(array('sts'=>'false'));
      }
  
  
  }// check me

  
  public function count_cards(){

  	$query = $this->db->query(
  			"SELECT 'TOTAL CARDS' as cc,count(*) as 'total' FROM cards
  			 union
  			 SELECT 'TOTAL FREE CARDS' as cc,count(*) as 'total' FROM cards where status='free'
  			 union
  			 SELECT 'HASSAN USED CARDS' as cc,count(*) as 'total' FROM cards WHERE h_h = 'hassan' and status ='used'
  			 union
  			 SELECT 'HAMID USED CARDS' as cc,count(*) as 'total'  FROM cards WHERE h_h = 'hamid' and status ='used'
  			 union
  			 SELECT 'SHARED USED CARDS' as cc,count(*) as 'total'  FROM cards WHERE h_h = 'shared' and status ='used'
			 "
  		); 


$ress= '<ul class="list-group">';
foreach ($query->result() as $row)
{    
  $ress .=
  '<li class="list-group-item">
    <span class="badge">'.$row->total.'</span>
    '.$row->cc.'
  </li>';
} 

$ress .= "</ul>";
echo $ress;


  } // counter


public function report1($y){
echo "<h3> Count of Sold Cards grouped by Month </h3><br>";
$query = $this->db->query("select count(*) as counter , MONTHNAME(date) as mo, year(date) as ye from cards where status<>'free' and year(date)=$y group by mo,ye order by ye desc;"); 

$ress= '<ul class="list-group">';
foreach ($query->result() as $row)
{
    //echo $row->counter;
    //echo $row->usedby;
  $ress .=
  '<li class="list-group-item">
    <span class="badge">'.$row->counter.'</span>
    '.$row->mo.'-'.$row->ye.'
  </li>';
} 

$ress .= "</ul>";
echo $ress;

} // counter1

public function report2(){
echo "<h3> Count of Sold Cards grouped by Emails </h3><br>";
//$query = $this->db->query("select count(*) as counter, usedby, max(DATE_FORMAT(date,'%m-%d-%Y')) as udate from cards where status<>'free' group by usedby order by 1 desc"); 
$query = $this->db->query("select count(*) as counter, usedby, max(DATE_FORMAT(date,'%m-%d-%Y')) as udate from cards where status<>'free' group by usedby order by 1 desc"); 

$ress= '<ul class="list-group">';
foreach ($query->result() as $row)
{
    //echo $row->counter;
    //echo $row->usedby;
  $ress .=
  '<li class="list-group-item">
    <span class="badge">'.$row->counter.'</span>        
    [Last Transaction]: '.$row->udate.' --- [By]:'.$row->usedby.'

  </li>';
} 

$ress .= "</ul>";
echo $ress;

} // counter2 



   public function add_offer_form(){
      //$this->load->view('include/header');      
      $data['table_name'] = "Numbers In Offer";
      $fields = array(
        //array('label' => 'Mobile Number','name' => 'mobile','type' => 'text','default' => '')
        array('label' => 'Mobile Number','name' => '<input type="text" class="form-control" size="25" name="mobile" maxlength="25">')
          );
      $data['fields'] = $fields;
      $data['save_url'] = site_url('secure_data/add_offer');
      $data['rd_url'] = "no_redirect";
      $this->load->view('myforms/form_new',$data);
      //$this->load->view('include/footer');
   } // add_card_form

   public function add_card_form(){
      //$this->load->view('include/header');      
      $data['table_name'] = "Cards";
      $fields = array(
        //array('label' => 'Card Number','name' => 'cardnumber','type' => 'text','default' => ''),
        //array('label' => 'Status','name' => 'status','type' => 'text','default' => 'free'),
        //array('label' => 'Owner','name' => 'h_h','type' => 'text','default' => 'shared'),
        array('label' => 'Card Number','name' => '<input type="text" class="form-control"  name="cardnumber" maxlength="15">'),
        array('label' => 'Status','name' => '<input type="text" class="form-control" name="status" value="free">'),
        array('label' => 'Owner','name' => '<input type="text" class="form-control" name="h_h" value="shared">')
        );
      $data['fields'] = $fields;
      $data['save_url'] = site_url('frontpage/add_card');
      $data['rd_url'] = "no_redirect";
      $this->load->view('myforms/form_new',$data);
      //$this->load->view('include/footer');
   } // add_card_form
   
     public function send_card_form(){
      //$this->load->view('include/header');      
      $data['table_name'] = "Send Card Manually";
      $fields = array(
        //array('label' => 'Email','name' => 'email','type' => 'text','default' => ''),
        //array('label' => 'Card pin#','name' => 'cardnumber','type' => 'text','default' => ''),
        array('label' => 'Email','name' => '<input type="text" class="form-control" name="email">'),
        array('label' => 'Card pin #','name' => '<input type="text" class="form-control"  name="cardnumber" maxlength="15">')
        );
      $data['fields'] = $fields;
      $data['save_url'] = site_url('frontpage/send_card');
      $data['rd_url'] = "no_redirect";
      $this->load->view('myforms/form_new',$data);
      //$this->load->view('include/footer');
   } // send_card_form

    public function show_my_card_via_paypal_id(){
      //$this->load->view('include/header');      
      $data['table_name'] = "Enter Your Paypal [Transaction ID] from Email!";
      $fields = array(
        array('label' => '','name' => 'txn_id','type' => 'text','default' => ''),
        );
      $data['fields'] = $fields;
      $data['save_url'] = site_url('secure_data/getmy_card');
      $data['rd_url'] = "no_redirect";
      $this->load->view('myforms/getcardform',$data);
      //$this->load->view('include/footer');
   } // send_card_form

 public function index(){
      //$this->load->view('include/header');      
      $data['table_name'] = "Enter Your Paypal [Transaction ID] from Email!";
      $fields = array(
        array('label' => '','name' => 'txn_id','type' => 'text','default' => ''),
        );
      $data['fields'] = $fields;
      $data['save_url'] = site_url('secure_data/getmy_card');
      $data['rd_url'] = "no_redirect";
      $this->load->view('myforms/getcardform',$data);
      //$this->load->view('include/footer');
   } // send_card_form


    public function getmy_card(){
//        sleep(1);

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('txn_id', 'Paypal Transaction #', 'required');
    
    if ($this->form_validation->run() == FALSE)
    {
      echo  validation_errors();
    }
    else
    {
      $txn_id = $_POST['txn_id'];

       $query = $this->db->query("select cardnumber from ipn_table where txn_id='$txn_id'");      
      if ($query->num_rows() > 0) {

        	$cardnumber = $query->row('cardnumber');
         echo "Your Zain Card #: <b> <h2>".substr($cardnumber, 0, 5)."-".substr($cardnumber, 5, 5)."-".substr($cardnumber, 10, 5);         
         log_message('error', "MYCARD SERVICE:$cardnumber");
      } else {

         echo "We Did not Find this Paypal Transaction ID, Kindly Check again after 3 min!";   
         log_message('error', "MYCARD SERVICE FAIL .....................");      
      }
      
    }  
  } // get card ard


  public function add_card(){
//        sleep(1);
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('cardnumber', 'Card Number', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');
    

    if ($this->form_validation->run() == FALSE)
    {
      echo  validation_errors();
    }
    else
    {
      $data = array('cardnumber' => $_POST['cardnumber'] ,'status' => 'free','h_h'=>$_POST['h_h']);
      $card = $_POST['cardnumber'];      
      
      $query = $this->db->query("select * from cards where cardnumber='$card'");      
      if ($query->num_rows() > 0) {
         echo "Card already exists! ..";
      } else {
         $this->db->insert('cards', $data);
         echo "Card successfuly Registered..!";         
      }
    }  
  } // add_card

  public function add_offer(){
//        sleep(1);
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('mobile', 'Mobile Number', 'required');
    

    if ($this->form_validation->run() == FALSE)
    {
      echo  validation_errors();
    }
    else
    {
      $data = array('mobile' => $_POST['mobile']);
      $mob = $_POST['mobile'];      
      
      $query = $this->db->query("select * from nas where mobile='$mob'");      
      if ($query->num_rows() > 0) {
         echo "Number already exists! ..";
      } else {
         $this->db->insert('nas', $data);
         echo "Mobile successfuly Registered..!";         
      }
    }  
  } // add_card

  public function send_card(){
//        sleep(1);
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    

    if ($this->form_validation->run() == FALSE)
    {
      echo  validation_errors();
    }
    else
    {
    	$this->make_payment_paypal_man($_POST['email']); 
    	echo "Card successfuly Sent..!"; 
    }  
  } // send card



    public function show_ro($tbl,$fields)
    {    
     $data['table_name'] = $tbl;   
     $data['geturl'] = site_url('frontpage/get_/'.$tbl);
     $data['addurl'] = site_url('frontpage/add/'.$tbl);
     $data['delurl'] = site_url('frontpage/delete/'.$tbl);
     $data['updurl'] = site_url('frontpage/update/'.$tbl);
     $data['table_header']= $fields;     
     $this->load->view('myforms/grid_view_ro',$data);
     //$this->show_table_ro($tbl,$tbl,$fields); 
    }//Show_ function

    public function show_ipn()
   {
       $fields = array(        
        array('id' => "id",'name' => "id"),
        array('id' => "txn_id",'name' => "txn_id"),  
        array('id' => "cardnumber",'name' => "cardnumber"),        
        array('id' => "payment_fee",'name' => "payment_fee"),
        array('id' => "residence_country",'name' => "residence_country"),
        array('id' => "payer_email",'name' => "payer_email"),        
        array('id' => "payment_date",'name' => "payment_date"),
        array('id' => "payment_status",'name' => "payment_status"),      
        );
       $this->show_table_rw("ipn_table","IPN Table",$fields);       
   } //show_IPN

    public function show_payments()
   {
        $fields = array(        
        array('id' => "id",'name' => "ID"),
        array('id' => "permalink",'name' => "Permalink"),
        array('id' => "email",'name' => "Email"),
        array('id' => "price",'name' => "Price"),
        array('id' => "date",'name' => "Date")
        );
       $this->show_table_rw("payments","Payments",$fields);   

   } //show_payment

       public function show_feedback()
   {

        $fields = array(        
        array('id' => "id",'name' => "ID"),
        array('id' => "mobile",'name' => "Mobile"),
        array('id' => "name",'name' => "Name"),
        array('id' => "email",'name' => "Email"),
        array('id' => "feedback",'name' => "Feedback"),
        array('id' => "RecordDate",'name' => "Date")
        );
       $this->show_table_rw("people","FeedBack",$fields);  
   } // show feedback

      public function show_offer()
   {
      $fields = array(        
        array('id' => "id",'name' => "ID"),
        array('id' => "mobile",'name' => "Mobile"),
        array('id' => "counter",'name' => "Counter"),
        array('id' => "login_date",'name' => "Date")        
        );
       $this->show_table_rw("nas","Show Registerd Numbers",$fields);  

   } // show offer

    public function show_cards()
   {
   
     /*
      $data['table_name'] = "Cards";
      $data['geturl'] = site_url('frontpage/get/cards');
      $data['addurl'] = site_url('frontpage/add/cards');
      $data['delurl'] = site_url('frontpage/delete/cards');
      $data['updurl'] = site_url('frontpage/update/cards');
      $data['table_header'] = array("id"=>"Card ID","cardnumber"=>"Card Number","status"=>"Status","usedby"=>"Used By","date"=>"UpdateDate","h_h"=>"Owner");      
      $data['form_header'] = array("cardnumber"=>"Card Number","status"=>"Status","usedby"=>"Used By","h_h"=>"Owner");      
      
      $this->load->view('myforms/grid_view',$data);
    */

      $fields = array(        
        array('id' => "id",'name' => "ID"),
        array('id' => "cardnumber",'name' => "Card Number"),
        array('id' => "status",'name' => "Status"),
        array('id' => "usedby",'name' => "Used By"),
        array('id' => "date",'name' => "Date"),
        array('id' => "h_h",'name' => "Owner")
        );
       $this->show_table_rw("cards","Cards list",$fields);  

   } //show_ cards

   public function show_logs()
   {
     /* //$this->load->view('include/header');  
      $data['table_name'] = "Logs";
      $data['geturl'] = site_url('frontpage/get/op_log');
      $data['addurl'] = site_url('frontpage/add/op_log');
      $data['delurl'] = site_url('frontpage/delete/op_log');
      $data['updurl'] = site_url('frontpage/update/op_log');
      $data['table_header'] = array("id"=>"ID","transactions"=>"Transaction","date"=>"Date");      
      $data['form_header'] = array("transactions"=>"Transaction");      
      
      $this->load->view('myforms/grid_view_ro',$data);
      //$this->load->view('include/footer');
      */
        $fields = array(        
        array('id' => "id",'name' => "ID"),
        array('id' => "transactions",'name' => "Description"),
        array('id' => "date",'name' => "Date")
        );
       $this->show_table_rw("op_log","LOGS",$fields);  
     
      
   }  // show_logs

       public function show_cards_uploaded()
   {
       $fields = array(        
        array('id' => "id",'name' => "id"),
        array('id' => "cardnumber",'name' => "cardnumber"),        
        array('id' => "date",'name' => "date"),      
        );
       $this->show_table_rw("cards_uploaded","Uploaded Cards Table",$fields);       
   } //show_IPN

   public function add2log($t){
   $data = array('transactions' => $t);
    $this->db->insert('op_log', $data);
   } // add 2 log
  


   public function showd(){
      $this->load->library('table');   
      $query = $this->db->query("SELECT * from op_log");
      //$result = $this->db->get($tablename)->result();
      echo json_encode($query); 
   } // showd
//---------------------------------------------------------------------


//-----------------------------------------------------------------------
  public function get($tablename){ 
  $this->db->order_by("id", "desc");    
    $result = $this->db->get($tablename)->result();
    echo json_encode($result); 
  }
  public function add($tablename){
        $result = $this->db->insert($tablename, $_POST);
      if ($result)
      {
        echo json_encode(array('success'=>true,'msg'=>'Added'));
      } 
      else 
      {
        echo json_encode(array('msg'=>'Some errors occured.'));
      }

  } // get

 
  public function delete($tablename){
        $result = $this->db->delete($tablename, array("id"=>$_POST['id']));
      if ($result){
        echo json_encode(array('success'=>true,'msg'=>'Deleted'));        
      } else {
        echo json_encode(array('msg'=>'Some errors occured.'));
          }

  } // del

  public function update($tablename,$id){
     $result = $this->db->update($tablename, $_POST, array("id"=>$id));         
      if ($result){
        echo json_encode(array('success'=>true,'msg'=>'Updated'));        
      } else {
        echo json_encode(array('msg'=>'Some errors occured.'));
          }

      } // update

  public function delall($tablename){
    $result = $this->db->empty_table($tablename);
    if ($result){
        echo json_encode(array('success'=>true,'msg'=>'cleared'));        
      } else {
        echo json_encode(array('msg'=>'Some errors occured.'));
          }

      } //delall

      //------------Make Payment---------------------------------------------
   
   
   public function sendemail($to_mail,$msg){
            $this->load->library('email');
            $this->email->set_newline("\r\n"); /* for some reason it is needed */
            $this->email->from('support@myraseed.com', 'myRaseed.com');

            $this->email->to($to_mail);
            $this->email->subject('Your Zain Card 50SDG Serial');
            $this->email->message($msg);
            if($this->email->send())
            {
            $this->add2log("Email Sent to =".$to_mail." with MSG=".$msg); 
            }
            else
            {
            $this->add2log("Email Sent Fail for=".$to_mail." >>>> EMAIL FAIL"); 
            }
   } // send email

      //---------------------------------------------------------
      
         public function sendemail_card_status_(){
         $to_mail_1="sudane@gmail.com, hamidbilo@gmail.com";
          $query = $this->db->query("SELECT count(*) as 'count' FROM  cards WHERE status = 'free' " );
          $row = $query->row(); 
          $msg="Number of Remaining free Cards is :".$row->count;
    
            $this->load->library('email');
            $this->email->set_newline("\r\n"); /* for some reason it is needed */
            $this->email->from('support@myraseed.com', 'Cards Status');

            $this->email->to($to_mail_1);
            $this->email->subject('Card Status');
            $this->email->message($msg);
            if($this->email->send())
            {
			echo "OK";
            }
            else
            {
			echo "not OK";
            }
   } // sendmail_card_status
   
 


} // end class

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */