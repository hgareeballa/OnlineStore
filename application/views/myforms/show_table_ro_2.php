<div class="">
<caption><h4>[<?php echo $tbl_header; ?>]</h4></caption>
<div id="toolbar" class="btn-group">
    <button id="refresh" type="button" class="btn btn-default">
        <i class="glyphicon glyphicon-refresh"></i>
    </button>
</div>
<table 
id="mytable"
data-toolbar="#toolbar"
data-toggle="table" 
data-url="" 
data-cache="false" 
data-height="330"
data-search="true"
data-pagination="true"
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
$('#refresh').click(function () {
                $("#mytable").bootstrapTable('refresh', {
                    url: '<?= $geturl ?>'
                });
               // load_all_json();
               getJsond(gurl,gtbl);
            });
</script>



