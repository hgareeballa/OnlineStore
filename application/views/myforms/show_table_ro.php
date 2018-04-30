<div class="">
<caption><h4>[<?php echo $tbl_header; ?>]</h4></caption>
<table 
id="mytable"
data-toggle="table" 
data-url="<?= $geturl ?>" 
data-cache="false" 
data-height="330"
data-search="true"
data-pagination="true" 
data-show-refresh="true" 
data-show-toggle="true"
data-show-columns="true"
data-sort-name="id" 
data-sort-order="desc"
data-sort-name="id">
    <thead>
        <tr>
        	 <? foreach ($fields as $f): ?>
        	 <th data-field="<?= $f['id'] ?>" data-sortable="true"><?= $f['name'] ?></th>
        	 <? endforeach; ?>   
        </tr>
    </thead>
</table>
</div>

<script type="text/javascript">
$('#mytable').bootstrapTable();
</script>



