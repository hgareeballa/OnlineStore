        var url;
        function newUser($url){
            //$('#dlg').dialog('open').dialog('setTitle','Add New');
            $('#myModal').modal('show')
            $('#fm').form('clear');
            url = $url;
        }
        function editUser($url){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                //$('#dlg').dialog('open').dialog('setTitle','Edit User');
                $('#myModal').modal('show')
                $('#fm').form('load',row);
                url = $url+'/'+row.id;
            }else{ slide("Notice","Please Select one Row to Edit!");}
        }
        function saveUser(){
            $('#fm').form('submit',{
                url: url,
                onSubmit: function(){
                    return $(this).form('validate');
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.success){
                       // $('#dlg').dialog('close');      // close the dialog
                        $('#dg').datagrid('reload');    // reload the user data
                         $.messager.show({
                            title: 'success',
                            msg: result.msg
                        });
                    } else {
                        $.messager.show({
                            title: 'Error',
                            msg: result.msg
                        });
                    }
                }
            });
        }
        function removeUser($url){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Confirm','Are you sure you want to remove row:['+row.id+']?',function(r){
                    if (r){
                        $.post($url,{id:row.id},function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                                 $.messager.show({
                            title: 'success',
                            msg: result.msg
                        });
                            } else {
                                $.messager.show({   // show error message
                                    title: 'Error',
                                    msg: result.msg
                                });
                            }
                        },'json');
                    }
                });
            }else{ slide("Notice","Please Select one Row to Delete!");}
        }


         function delall($url){
                $.messager.confirm('Confirm','Are you sure you want to remove all ?',function(r){
                    if (r){
                        $.post($url,function(result){
                            if (result.success){
                                $('#dg').datagrid('reload');    // reload the user data
                                 $.messager.show({
                            title: 'success',
                            msg: result.msg
                        });
                            } else {
                                $.messager.show({   // show error message
                                    title: 'Error',
                                    msg: result.msg
                                });
                            }
                        },'json');
                    }
                });
            }

         function cancelall(){
               $('#dg').datagrid('clearSelections');            
               $('#dg').edatagrid('cancelRow');   
              
            }

            function refresh($dg){                               
               //$('#dg').datagrid('clearSelections');                
               //$('#dg').edatagrid('cancelRow');   
               $($dg).datagrid('reload');    // reload the user data         
            }

          function getData(){  
            var rows = [];  
            for(var i=1; i<=800; i++){  
                var amount = Math.floor(Math.random()*1000);  
                var price = Math.floor(Math.random()*1000);  
                rows.push({  
                    inv: 'Inv No '+i,  
                    date: $.fn.datebox.defaults.formatter(new Date()),  
                    name: 'Name '+i,  
                    amount: amount,  
                    price: price,  
                    cost: amount*price,  
                    note: 'Note '+i  
                });  
            }  
            return rows;  
        }  
          
        function pagerFilter(data){  
            if (typeof data.length == 'number' && typeof data.splice == 'function'){    // is array  
                data = {  
                    total: data.length,  
                    rows: data  
                }  
            }  
            var dg = $(this);  
            var opts = dg.datagrid('options');  
            var pager = dg.datagrid('getPager');  
            pager.pagination({  
                onSelectPage:function(pageNum, pageSize){  
                    opts.pageNumber = pageNum;  
                    opts.pageSize = pageSize;  
                    pager.pagination('refresh',{  
                        pageNumber:pageNum,  
                        pageSize:pageSize  
                    });  
                    dg.datagrid('loadData',data);  
                }  
            });  
            if (!data.originalRows){  
                data.originalRows = (data.rows);  
            }  
            var start = (opts.pageNumber-1)*parseInt(opts.pageSize);  
            var end = start + parseInt(opts.pageSize);  
            data.rows = (data.originalRows.slice(start, end));  
            return data;  
        }  
          

          function show($t,$msg){  
            $.messager.show({  
                title:$t,  
                msg:$msg,  
                showType:'show'  
            });  
        }  
        function slide($t,$msg){  
            $.messager.show({  
                title:$t,  
                msg:$msg,  
                timeout:4000,  
                showType:'slide'  
            });  
        }  
        function fade($t,$msg){  
            $.messager.show({  
                title:$t,  
                msg:$msg,  
                timeout:4000,  
                showType:'fade'  
            });  
        }  

    $(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {          
          $('#dg').edatagrid('saveRow');

    }
});
    