<?php if (!defined('BASEPATH')) die();
class Frontpage extends Main_Controller {

public function index(){
     echo "Welcome to myRaseed.com!";
}// Index
   

//------------Make Payment---------------------------------------------
   
public function make_payment(){    
   $_POST['permalink'] ="asxk";
   //$_POST['email'] = "";
   $_POST['test'] = "true";
   $_POST['price'] = "10";
   $_POST['offer_code']="";
 
  //tariqelamin77@hotmail.com. 
  //hassantayeb@hotmail.com
    $this->add2log(">>>>>>>>>>>>>>>>>>>>>>>NEW TRANSACTION <<<<<<<<<<<<<<<<<<<<<<<<<<<<"); 
   $this->add2log("Operation Started for: ".$_POST['email']); 
   $this->add2log("Operation permalink: ".$_POST['permalink']);
   $this->add2log("Operation price: ".$_POST['price']);

    $data = array(
   'permalink' => $_POST['permalink'] ,
   'email' => $_POST['email'],
   'price' => $_POST['price'],
   'offer_code'=> $_POST['offer_code'],
   'test' => $_POST['test']
    );
    $this->db->insert('payments', $data);
    $query = $this->db->query("SELECT cardnumber FROM  cards WHERE id = ( SELECT MIN(id) FROM cards WHERE STATUS =  'free' )");
    $cardnumber="";
    if ($query->num_rows() > 0)
      {        
   $row = $query->row(); 
   $cardnumber=$row->cardnumber;
    
     $data = array('status' => 'used','usedby' => $_POST['email']);
     $this->db->where('cardnumber', $cardnumber);
     $this->db->update('cards', $data); 

     $this->add2log("Free CARD Found for : ".$_POST['email']. " Card number=".$cardnumber." and the card updated in DB"); 
     //$this->sendemail($_POST['email'],"Your Card PIN Number is: ".$cardnumber);
     $this->sendemail($_POST['email'],"Your Card PIN Number is: ".substr($cardnumber, 0, 5)."-".substr($cardnumber, 5, 5)."-".substr($cardnumber, 10, 5));

      } else{
    $this->add2log("NO.CARD Found for : ".$_POST['email']." >>>>>ERROR"); 
     
    $cardnumber="NO FREE CARD Available , we will get back to you soon by phone";
    $this->sendemail($_POST['email'],"Your card pin number is:".$cardnumber);
      }         
   } // MAKE PAYMENT ---- MAN

   public function sendemail($to_mail,$msg){
            $this->load->library('email');
            $this->email->set_newline("\r\n"); /* for some reason it is needed */
            $this->email->from('support@myraseed.com', 'myRaseed.com');

            $this->email->to($to_mail);
            $this->email->subject('Your Zain Card 50SDG Serial');
            //$this->email->message("<br><h1><b>".$msg."<br><br> <a href='http://myraseed.com'> <img src='http://myraseed.com/img/myRaseed.png' alt='www.mRaseed.com' width='500' height=''> <br> <a href='http://myRaseed.com'>www.myRaseed.com</a>");

            $this->email->message("<br><h1><b>".$msg);
            if($this->email->send())
            {
            $this->add2log("PASS: Email=".$to_mail." MSG=".$msg); 
            log_message('error', "PASS: EMAIL");
            }
            else
            {
            $this->add2log("FAIL: Email=".$to_mail." >>>>EMAIL FAIL");             
            log_message('error', "FAIL: EMAIL");
            }
   }// send email


  //---------------------------------------------------------
      
         public function free_card_status(){
          $to_mail_1="sudane@gmail.com, hamidbilo@gmail.com";
          $query = $this->db->query("SELECT count(*) as 'count' FROM  cards WHERE status = 'free' " );
          $row = $query->row(); 
          $msg="Number of Remaining free Cards is :".$row->count;
    
            $this->load->library('email');
            $this->email->set_newline("\r\n"); /* for some reason it is needed */
            $this->email->from('support@myraseed.com', 'Cards Status');

            $this->email->to($to_mail_1);
            $this->email->subject('Card Status');
            $this->email->message('<h1><b>'.$msg);
            if($this->email->send())
            {
			echo "OK Email sent";
            }
            else
            {
			echo "not OK Email was not sent";
            }
   }// SEND CARD STATUS 
   
   
   public function make_payment_paypal($email){    
   $_POST['permalink'] ="paypal";
   $_POST['email'] = $email;
   $_POST['test'] = "true";
   $_POST['price'] = "10";
   $_POST['offer_code']="";
 
  //tariqelamin77@hotmail.com. 
  //hassantayeb@hotmail.com
   
  //$this->add2log("NEW TRANSACTION paypal For: ".$_POST['email']); 


   //$this->add2log("Operation Started for: ".$_POST['email']); 

//  $this->add2log("Operation permalink: ".$_POST['permalink']);
//  $this->add2log("Operation price: ".$_POST['price']);


    $data = array(
   'permalink' => $_POST['permalink'] ,
   'email' => $_POST['email'],
   'price' => $_POST['price'],
   'offer_code'=> $_POST['offer_code'],
   'test' => $_POST['test']
    );

    $this->db->insert('payments', $data);
    $query = $this->db->query("SELECT cardnumber FROM  cards WHERE id = ( SELECT MIN(id) FROM cards WHERE STATUS =  'free' )");
    $cardnumber="";
    if ($query->num_rows() > 0)
      {        
   $row = $query->row(); 
   $cardnumber=$row->cardnumber;
    
     $data = array('status' => 'used','usedby' => $_POST['email']);
     $this->db->where('cardnumber', $cardnumber);
     $this->db->update('cards', $data); 

     //$this->add2log("Free CARD Found for : ".$_POST['email']. " Card number=".$cardnumber." and the card updated in DB"); 
     //$this->sendemail($_POST['email'],"Your card pin number is:".$cardnumber);
     $this->sendemail($_POST['email'],"Your Card PIN Number is: ".substr($cardnumber, 0, 5)."-".substr($cardnumber, 5, 5)."-".substr($cardnumber, 10, 5));
	   $this->ipn_table($cardnumber);
     $this->sendgmail($_POST['email'],substr($cardnumber, 0, 5)."-".substr($cardnumber, 5, 5)."-".substr($cardnumber, 10, 5));

      } else{
    $this->add2log("NO.CARD Found for : ".$_POST['email']." >>>>>ERROR");
    $cardnumber="NO FREE CARD Available , we will get back to you soon by phone";
    $this->sendemail($_POST['email'],"Your card pin number is:".$cardnumber);
      }         
   }// MAKE PAYMENT PAYPAL
   
 
  public function sendgmail($email,$pin){    
      // create a new cURL resource
      $ch = curl_init();
      // set URL and other appropriate options
      //curl_setopt($ch, CURLOPT_URL, "http://hassan.16mb.com/testapp/index.php/sendemail/sendm/$email/$pin/");
      curl_setopt($ch, CURLOPT_URL, "http://myRaseed.com/sendgmail/index.php/sendemail/sendm/$email/$pin/");
      curl_setopt($ch, CURLOPT_HEADER, 0);
      // grab URL and pass it to the browser
      curl_exec($ch);
      // close cURL resource, and free up system resources
      curl_close($ch);
      echo "Done";  
       
  }// get page


 public function send_card_via_email($email,$cardnumber){    
    $this->add2log("NEW Manual TRANSACTION For:".$email); 
    $this->sendemail($email,"Your Card PIN Number is: ".substr($cardnumber, 0, 5)."-".substr($cardnumber, 5, 5)."-".substr($cardnumber, 10, 5));            
    $this->sendgmail($email,substr($cardnumber, 0, 5)."-".substr($cardnumber, 5, 5)."-".substr($cardnumber, 10, 5));            
   } // SEND CARD MANUALLUY EMAIL
     
public function paypal(){
        //$this->add2log("------new-Operation Started Paypal------");
        // check whether the payment_status is Completed
        // check that txn_id has not been previously processed
        // check that receiver_email is your PayPal email
        // check that payment_amount/payment_currency are correct
        // process payment and mark item as paid.

        // assign posted variables to local variables
        //$item_name = $_POST['item_name'];
        //$item_number = $_POST['item_number'];
        $payment_status = $_POST['payment_status'];
        //$payment_amount = $_POST['mc_gross'];
        //$payment_currency = $_POST['mc_currency'];
        $txn_id = $_POST['txn_id'];
        //$receiver_email = $_POST['receiver_email'];
        $payer_email = $_POST['payer_email'];      


if ($payment_status=="Completed") {          
       if ($this->isit_here($txn_id)) {
	         
           $this->make_payment_paypal($payer_email); 
          // $this->ipn_table();
           log_message('error', "Payment Operation Completed for:$payer_email");
      } else {
    	   //$this->add2log("Operation Dublication for:$txn_id"); 		
    	   //$this->sendemail($payer_email," Check Your Email Inbox, or Spam Folder Please !");
         log_message('error', "Double Transaction for:$payer_email");
    	   $this->sendemail("sudane@gmail.com","Duplication Operation for: $payer_email");    	   
      }      
}      
 
} // paypal

public function isit_here($txn){	  
	$x = true;
      $query = $this->db->query("select txn_id from ipn_table where txn_id='$txn'");      
      if ($query->num_rows() > 0) {        
      	$x=false;
      } else {         
      }      
 return $x;
}//is it listed

public function paypal_test(){

		$this->add2log("------TESTING PAYPAL------");
        $payment_status = "Completed";//$_POST['payment_status'];
        $txn_id = "71F8379173578560E";//$_POST['txn_id'];
        $payer_email = "Sudane@gmail.com";//$_POST['payer_email'];      
        
		if ($payment_status=="Completed") {          
		       if ($this->isit_here($txn_id)) {
			       //$this->make_payment_paypal($payer_email); 
		         $this->ipn_table();
		         echo "True";
		      } else {
		      	echo "false";
		    	 $this->add2log("Operation Dublication for:$txn_id"); 		
		      }      
		}      
 
} // paypal test


public function paypal_man($email){
$this->add2log("------new-Manual-Operation Started ------");
//$payer_email = "sabbboha@hotmail.com";
          
       if ($payer_email<>"") {
	$this->make_payment_paypal($payer_email); 
	echo "Check Log OP completed !";
      } else {
     echo " No Mail found ?? ";
        $this->add2log("No Email Found !!"); 		
      }      
      
 
} // paypal man




public function t_com(){
echo "Transaction completed !";
echo "<br>";
echo "Transaction Status :".$_POST['decision'];  
echo "Card Number: [not ready yet]";

}


public function response_page(){
echo "Response Page for Transaction #".$_POST['transaction_id'];
echo "<br>";
echo "payment Status=".$_POST['decision'];  
echo "<br>";
echo "auth_amount=".$_POST['auth_amount'];
echo "<br>";
echo "req_bill_to_email=".$_POST['req_bill_to_email'];
echo "<br>";
echo "req_bill_to_phone=".$_POST['req_bill_to_phone'];  
echo "<br>";
echo "req_currency=".$_POST['req_currency'];  
echo "<br>";
echo "reason_code=".$_POST['reason_code'];  
  
echo "<br>";
echo "merchant_secure_data1:".$_POST['req_merchant_secure_data1'];
echo "<br>";
echo "merchant_secure_data2:".$_POST['req_merchant_secure_data2'];


echo " You Card Number is=XXXXXXX"; 

} // response page


public function ipn_table($cardnumber){
  
     //$_POST['txn_id'] = "123123123";

      $data = array(
      'txn_id' => $_POST['txn_id'],
      'cardnumber' => $cardnumber,
      'txn_type' => $_POST['txn_type'],
      'residence_country' => $_POST['residence_country'],
      'receiver_email' => $_POST['receiver_email'],
      'receipt_id' => $_POST['receipt_id'],
      'address_country' => $_POST['address_country'],
      'address_city' => $_POST['address_city'],
      'address_country_code' => $_POST['address_country_code'],
      'address_name' => $_POST['address_name'],
      'contact_phone' => $_POST['contact_phone'],
      'first_name' => $_POST['first_name'],
      'last_name' => $_POST['last_name'],
      'payer_email' => $_POST['payer_email'],
      'payer_id' => $_POST['payer_id'],
      'auth_amount' => $_POST['auth_amount'],
      'auth_id' => $_POST['auth_id'],
      'auth_status' => $_POST['auth_status'],
      'mc_currency' => $_POST['mc_currency'],
      'payer_status' => $_POST['payer_status'],
      'payment_date' => $_POST['payment_date'],
      'payment_fee' => $_POST['payment_fee'],
      'payment_status' => $_POST['payment_status'],
      'payment_type' => $_POST['payment_type'],
      'quantity' => $_POST['quantity'],
      'auction_buyer_id' => $_POST['auction_buyer_id']
        );
  
      if (isset($_POST['txn_id'])) {
        $this->db->insert('ipn_table', $data);
        //$this->add2log(">>>>>>>>>>>> ADD IPN Table >>>>>>>>>>>>");    
        log_message('error', "PASS: >>>>>>>>>>>>>>>>>>>>> IPN TABLE UPDATED");
      } else {        
        //$this->add2log("errors:  IPN Table >>>>>>>>>>>>");    
        log_message('error', "FAIL: >>>>>>>>>>>>>>>>>>>>> IPN TABLE FAILED");
      }
            
  }// ipn_table

//-----------------------------------------------------------------------------------------------------------------------------------------------

public function add_card(){
	//        sleep(1);
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('cardnumber', 'Card Number', 'required|exact_length[15]|integer');
    $this->form_validation->set_rules('status', 'Status', 'required');
    

    if ($this->form_validation->run() == FALSE)
    {
      echo  validation_errors();
    }
    else
    {
      $data = array('cardnumber' => $_POST['cardnumber'] ,'status' => 'free','h_h'=>$_POST['h_h']);
      $data22 = array('cardnumber' => $_POST['cardnumber']);

      $card = $_POST['cardnumber'];      
      
      $query = $this->db->query("select * from cards where cardnumber='$card'");      
      if ($query->num_rows() > 0) {
         echo "Card already exists! ..";
      } else {
         $this->db->insert('cards', $data);
         $this->db->insert('cards_uploaded', $data22);
         echo "Card successfuly Registered..!";         
      }
    }  
}// Add Card .. !

public function send_card(){
  //        sleep(1);
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	$this->form_validation->set_rules('cardnumber', 'Card#', 'required');
    

    if ($this->form_validation->run() == FALSE)
    {
      echo  validation_errors();
    }
    else
    {
    	$this->send_card_via_email($_POST['email'],$_POST['cardnumber']); 
      //$x=$_POST['email'];
      //log_message('error', "Manual Email Send to:$x");
    	echo "Card successfuly Sent..!"; 
    }  
  } // Send Card

 public function add2log($t)
 {
   $data = array('transactions' => $t);
   $this->db->insert('op_log', $data);
 }// add to Log
  
//-----------------------------------------------------------------------
  public function get($tablename){ 
  $this->db->order_by("id", "desc");    
    $result = $this->db->get($tablename)->result();
    echo json_encode($result); 
  }// GET 
  
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

  } // ADD

 
  public function delete($tablename){
        $result = $this->db->delete($tablename, array("id"=>$_POST['id']));
      if ($result){
        echo json_encode(array('success'=>true,'msg'=>'Deleted'));        
      } else {
        echo json_encode(array('msg'=>'Some errors occured.'));
          }

  }// DELETE

  public function update($tablename,$id){
     $result = $this->db->update($tablename, $_POST, array("id"=>$id));         
      if ($result){
        echo json_encode(array('success'=>true,'msg'=>'Updated'));        
      } else {
        echo json_encode(array('msg'=>'Some errors occured.'));
          }

      }// UPDATED

  public function delall($tablename){
    $result = $this->db->empty_table($tablename);
    if ($result){
        echo json_encode(array('success'=>true,'msg'=>'cleared'));        
      } else {
        echo json_encode(array('msg'=>'Some errors occured.'));
          }

      }// DEL ALL


} // front page

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */