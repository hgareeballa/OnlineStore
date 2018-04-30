
<div class="">
<caption><h4>[<?php echo $tbl_header; ?>]</h4></caption>
<div id="toolbar" class="btn-group">
    <button id="refreshbtn" type="button" class="btn btn-default">
        <i class="glyphicon glyphicon-refresh"></i>
    </button>
</div>
<table 
id="mytable"
data-toolbar="#toolbar"
data-toggle="table" 
data-url="" 
data-cache="false" 
data-height="400"
data-search="true"
data-pagination="true" 
data-show-toggle="true"
data-show-columns="true"
data-sort-name="id" 
data-sort-order="desc" 
data-sort-name="id"
style="font-size:12px;">
    <thead>
        <tr>          	     	
        	 <? foreach ($fields as $f): ?>        	 
        	 <th data-field="<?= $f['id'] ?>" data-sortable="true"><?= $f['name'] ?></th>
        	 <? endforeach; ?>   
        	 <th data-field="operate" data-align="center" data-formatter="operateFormatter" data-events="operateEvents">Operate</th>
        </tr>
    </thead>
</table>

</div>
<script>
var fm_upd_url = "";
var del_id="";
var ids="";
var update_id="";
var postData;

    function operateFormatter(value, row, index) {
        return [
            '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
                '<i class="glyphicon glyphicon-edit"></i>',
            '</a>',
            ' ',
            '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
                '<i class="glyphicon glyphicon-remove"></i>',
            '</a>'
        ].join('');
    }

    window.operateEvents = {
        'click .like': function (e, value, row, index) {
            alert('You click like icon, row: ' + JSON.stringify(row));
            console.log(value, row, index);
        },
        'click .edit': function (e, value, row, index) {
        	$('#fm_result').attr('class','');
        	$("#fm_result").html(""); 
            
            var obj = jQuery.parseJSON(JSON.stringify(row));                    	
            update_id= index;
           // alert (index);

     		fm_upd_url="<?= $updurl ?>/"+obj.id;

            $('#fm').form('load',row);
            $('#mymodal').modal('show');
        },
        'click .remove': function (e, value, row, index) {        	
            var obj = jQuery.parseJSON(JSON.stringify(row));
            del_id= obj.id;
            ids=  $.makeArray(del_id);
            
           	 $("#conmodal_body").html("Are You Sure, Delete :"+del_id+" !?");
           	 $('#conmodal').modal('show');           	              	        
        }//function
    };//window event



$('#mytable').bootstrapTable({                                            
                onDblClickRow: function (row) {
                   // console.log('Event: onDblClickRow, data: ' + JSON.stringify(row));
            $('#fm_result').attr('class','');
            $("#fm_result").html(""); 
            var obj = jQuery.parseJSON(JSON.stringify(row));                      
            //update_id= index;
            //alert (index);
            fm_upd_url="<?= $updurl ?>/"+obj.id;
            $('#fm').form('load',row);
            $('#mymodal').modal('show');
                },               
                onLoadSuccess: function (data) {
                    //console.log('Event: onLoadSuccess, data: ' + data);                   
                },
                onLoadError: function (status) {
                    alert("Please Click refresh Again");
                }
                
});//events 
      

		function remove_deleted_row(){				
				    $("#mytable").bootstrapTable('remove', {
                    field: 'id',
                    values: ids
                });              
		}//hide 

		function refresh_table(){
		 $("#mytable").bootstrapTable('refresh', {url: '<?= $geturl ?>'});
		}//regresh

		function deldata(){
		remove_deleted_row();
		$('#conmodal').modal('hide');

		var iid= del_id;	
		var url= "<?= $delurl ?>";
		
		   $.post(url,{id:iid},function(result){
		   		if (result.success){
		   			//refresh_table();
		   			console.log(result.msg);
		   		} else
		   		{
		   			//alert(result.msg);
		   			console.log(result.msg);
		   		}
		   	},'json');
		}//deldata
		 
     
function saveUser(){

$('#fm_result').attr('class','');
$("#fm_result").html(""); 

$("#sub_btn").button('loading');	
$("#fm").submit(function(e)
{
    postData = $(this).serializeArray();     
    var formURL = fm_upd_url;//$(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        success:function(data, textStatus, jqXHR) 
        {        		
            //data: return data from server  
            var obj = jQuery.parseJSON(data);          
            //refresh_table();         
			     $("#sub_btn").button('reset'); 
			     $('#fm_result').attr('class','alert alert-success');
			     $("#fm_result").html(obj.msg);                
           getJsond(gurl,gtbl);          
        },
        error: function(jqXHR, textStatus, errorThrown) 
        {
            //if fails   
          	$("#sub_btn").button('reset'); 
          	$('#fm_result').attr('class','alert alert-info');
			      $("#fm_result").html(textStatus);                
        }
    });
    e.preventDefault(); //STOP default action
    e.unbind(); //unbind. to stop multiple form submit.
  }); 

  $("#fm").submit(); //Submit  the FORM
  }// save User

  $( "#fm" ).keypress(function( event ) {
    if ( event.which == 13 ) {
     saveUser();  
    }  
  });

  $('#refreshbtn').click(function () {
                $("#mytable").bootstrapTable('refresh', {
                    url: '<?= $geturl ?>'
                });                
                getJsond(gurl,gtbl);
            });

</script>


<div id="mymodal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <div class="modal-body">
        <fieldset>        
          
          <legend>Edit</legend>

          <form id="fm" method="post">
          <? foreach ($fields as $f): ?>                     
                <div class="form-group">
                  <label class="col-lg-4 control-label"><?= $f['name'] ?></label>
                  <div class="col-lg-8">
                    <input type="text" value="" class="form-control" name="<?= $f['id'] ?>">
                  </div>
                </div>              
          <? endforeach; ?> 
        </form>
        
        <a></a>
              <div class="form-group">
                  <div class="col-lg-8 col-lg-offset-4">
                    <button class="btn btn-default" data-dismiss="modal" >Cancel</button>
                    <button id="sub_btn" type="submit" class="btn btn-primary" onclick="saveUser()">Submit/Save</button>
                    <div id="fm_result"></div>        
                  </div>

                </div>  
                
        </fieldset>
      
     
      </div>      
    </div>
  </div>
</div>

<div id="conmodal" class="modal">
<div id="conmodal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Confirm</h4>
      </div>
      <div class="modal-body" id="conmodal_body">
        
      </div>
      <div  class="modal-footer" align="center">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button  id="sub_btn"  class="btn btn-primary"  onclick="deldata()">Delete</button>        
      </div>       
    </div>
  </div>
</div>



<script type="text/javascript">
  $('#mymodal').on('hide.bs.modal', function (e) {
  // do something...
  load_mytable_data();
  });
</script>