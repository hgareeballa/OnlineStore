  

<div id="main">

<div class="well">

   

    <h3><?php echo $table_name; ?></h3>

     <form id="saveform" method="post">      

        <div class="fitem">  

         <? foreach ($fields as $field): ?>

      

      

      	

      	<div class="controls">
      		<h3><?= $field['label'] ?></h3>
				<input 

               class="input-xlarge" 

               type="<?= $field['type'] ?>" 

               id="<?= $field['name'] ?>" 

               name="<?= $field['name'] ?>" 

               placeholder="<? if (!empty($field['default'])) echo $field['default']; ?>" 


            />           
          <span class="label label-danger">*</span>
			</div>      

   <? endforeach; ?>    
   <br>
          <textarea class="form-control" placeholder="الرسالة" name="feedback" rows="3"></textarea>            

        </div>               

    </form>  
    
    <button id="save" class="btn btn-primary" onclick="saveForm()">Send - ارسل</button>
    <div id="resultbox" class="alert alert-info"></div>
 <h1></h1>



</div>

</div>





<script type="text/javascript">

   $("#resultbox").hide();

   $("#main").hide();

   $("#main").fadeIn(2000);



function saveForm(){

	save_form_1("#saveform","#save","#resultbox","<?php echo $save_url ?>","<?php echo $rd_url ?>"); //"no_redirect" 	

        }


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
        $($resultbox).show();
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

}
</script>

