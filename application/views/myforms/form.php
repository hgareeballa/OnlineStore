

<div id="main" class="">

<div class="">

   

    <h3><?php echo $table_name; ?></h3>
    <fieldset>                          

          <form id="saveform" method="post">
          <? foreach ($fields as $f): ?>                     
                <div class="form-group">
                  <label class="col-lg-3 control-label"><?= $f['label'] ?></label>
                  <div class="col-lg-9">
                    <input type="<?= $f['name'] ?>" class="form-control" id="<?= $f['name'] ?>" name="<?= $f['name'] ?>" value="<? if (!empty($f['default'])) echo $f['default']; ?>">
                  </div>
                </div>              
          <? endforeach; ?> 
        </form>
        
        <a>.</a>
              <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">
                    <button class="btn" class="btn btn-default" data-dismiss="modal" aria-hidden="true" onclick="formClose()">Close</button>
                    <button id="save" class="btn btn-primary" onclick="saveForm()">Submit/Save</button>
                    <br>
                    <a>.</a>
                    <div id="resultbox" class="alert alert-info"></div>       
                  </div>

                </div>  
                
        </fieldset>
 <h1></h1>


</div>

</div>





<script type="text/javascript">

   $("#resultbox").hide();

function saveForm(){

	save_form_1("#saveform","#save","#resultbox","<?php echo $save_url ?>","<?php echo $rd_url ?>"); //"no_redirect" 	
  //load_all_json();   

}//save form

function formClose(){
go_to("welcome_page");
}//form close


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
        getJsond(gurl,gtbl);   

      },

      error: function($errorThrown){   
      
      $($resultbox).html("Java Script errorThrown !");  

      $($button_id).button('reset');      

      },

      success: function(msg) {                   
          $($button_id).button('reset');    
          $($resultbox).show();
          $($resultbox).html(msg);  

          if ($rd_url=="no_redirect") {

          } else{

                  if (msg=="success") {

                      window.location.href=$rd_url;

                    } else{

                      $($resultbox).show();
                      $($resultbox).html(msg);   

                    };   

          };                    

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
