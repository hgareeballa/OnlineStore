
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

 <button   class="btn icon-align-justify" onclick="refresh('#dg')"> Refresh</button>
 

</div> 



<script type="text/javascript">
 $(function(){  
           $('#dg').datagrid({loadFilter:pagerFilter}).datagrid('loadData', getData());  
           //$('#dg').datagrid('load');
        });  
 </script>

</div>