
<link href="http://bootswatch.com/yeti/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://www.jqueryscript.net/demo/jQuery-Plugin-For-Bootstrap-Based-Data-Table-Bootstrap-Data-Table/js/vendor/jquery.sortelements.js"></script>
<script src="http://www.jqueryscript.net/demo/jQuery-Plugin-For-Bootstrap-Based-Data-Table-Bootstrap-Data-Table/js/jquery.bdt.js"></script>


<link rel="stylesheet" type="text/css" href="//www.jeasyui.com/easyui/themes/metro/easyui.css">
<script type="text/javascript" src="//www.jeasyui.com/easyui/jquery.easyui.min.js"></script>


<div class="container" align="Center">

	<div id = "bootstrap-table" class="table table-striped table-hover">		

  <?php echo $results; ?>  

  	</div>

</div>


<script type="text/javascript">
	
$(document).ready( function () {
  $('#bootstrap-table').bdt();
});
</script>




<style>

table,td,th

{

border:1px solid black;
text-align: center;

}

table

{

width:100%;

}

th

{

height:50px;

}

td

{

padding:2px;

}

</style>

<script type="text/javascript">

 $(document).on('click', 'button.deleterow', function () { // <-- changes  
  $.messager.confirm('My Title', 'Are you confirm this?', function(r){
  if (r){
    //the_del_ajax_function($row);
    $(this).closest('tr').hide();
     return false;
  }
  });

     //alert("aa");
    // $(this).closest('tr').remove();
     
 });


function remove_($row){

 
}//function

function the_del_ajax_function($row){

$url="http://myraseed.com/cards/index.php/frontpage/delete/people";
var row = $row;
        $.post($url,{id:row},function(result){
                            if (result.success){
                                console.log("Delete Success ");                                                                
                            } else {

                                //alert (result.msg);
                                
                                console.log("Delete faile ");
                            }

                        },'json');                    

}// function




</script>