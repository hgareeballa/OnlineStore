<div id="main" class="">
<table id="dg" title="<?php echo $table_name;?>" class="easyui-datagrid"   
        url="<?php echo $geturl;?>"  
        toolbar="#toolbar"  
     data-options="  
                  rownumbers:true,  
                singleSelect:true,  
                autoRowHeight:false,  
                pagination:true,  
                pageSize:10,
                fitColumns:true">
    <thead>  
        <tr>  
            <?php
            foreach ($table_header as $k => $v) {                    
            echo "<th width='auto' field=$k>$v</th>"; 
            //<th field="id" width="50">ID</th> 
            }
            ?>            
        </tr>  
    </thead>  
</table>  
<div id="toolbar">  

 <button   class="btn btn-danger icon-trash" onclick="newUser('<?php echo $addurl;?>')"> Add</button>
 <button   class="btn btn-info icon-folder-open" onclick="editUser('<?php echo $updurl;?>')"> Edit</button>
 <button   class="btn btn-danger icon-trash" onclick="removeUser('<?php echo $delurl;?>')"> Delete</button>
 <button   class="btn icon-align-justify" onclick="refresh('#dg')"> Refresh</button>
 

</div> 


<script type="text/javascript" src="<?php echo base_url('mythings/myscript.js') ?>"></script>
<script type="text/javascript">
 $(function(){  
            $('#dg').datagrid({loadFilter:pagerFilter}).datagrid('loadData', getData());  
           // $('#dg').datagrid('load');
        });  
 </script>

</div>
  
<div id="myModal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"><?php echo $table_name; ?></h4>        
      </div>
      <div class="modal-body">
          <form id="fm" method="post">      
          <div class="fitem">  
            <?php
            foreach ($form_header as $k=>$v) {  
            echo "<label>$v</label>";                         
            echo "<input class='form-control ' name=$k type='text'>";              
            }
            ?>     
            
          </div>               
          </form>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="saveUser()">Save</button>
      </div>
    </div>
  </div>
</div>