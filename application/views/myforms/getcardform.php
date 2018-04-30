



   

    
    <fieldset>                          
    
          <form id="saveform" method="post">
          <? foreach ($fields as $f): ?>                     
                <div class="form-group">               
                  <label dir="rtl"><h3>ادخل رقم عملية الدفع الموجود داخل الايميل المرسل من Paypal للحصول علي الكرت مباشرة :</h3></label>
                  
                  <div class="">
                    <input type="<?= $f['name'] ?>" class="form-control" id="<?= $f['name'] ?>" name="<?= $f['name'] ?>" value="<? if (!empty($f['default'])) echo $f['default']; ?>" placeholder="Transaction ID">
                  </div>
                </div>              
          <? endforeach; ?> 
        </form>
        
        <a>.</a>
              <div class="form-group">
                  <div class="">                    
                    <button dir="rtl" id="save" class="btn btn-primary" onclick="saveForm()">Get The Card</button>
                    <br>
                    <a>.</a>
                    <div id="resultbox" class="alert alert-info"></div>       
                  </div>

                </div>  
                
        </fieldset>
 <h1></h1>



<script type="text/javascript">
   $("#resultbox").hide();
function saveForm(){
	save_form_1("#saveform","#save","#resultbox","<?php echo $save_url ?>","<?php echo $rd_url ?>"); //"no_redirect" 	
    //load_all_json();   

}//save form


</script>


<script type="text/javascript">
function save_form_1($formid,$button_id,$resultbox,$url,$rd_url){

  $($resultbox).hide();

   $.ajax({

      url: $url,

      type: 'POST',

      data: $($formid).serialize(),

      beforeSend : function(){        

       $($button_id).button('loading');      

      },

      complete: function(){         

        $($button_id).button('reset');           

      },

      error: function($errorThrown){   
      
      $($resultbox).html("Java Script errorThrown !");  
      $($button_id).button('reset');      

      },

      success: function(msg) {                   
          $($button_id).button('reset');    
          $($resultbox).show();
          $($resultbox).html(msg); 
          
      }

   });

return false;

}//function


$( "#saveform" ).keypress(function( event ) {
  if ( event.which == 13 ) {
   saveForm();  
   return false;
  }  
});

</script>
