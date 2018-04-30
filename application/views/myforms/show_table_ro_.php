<div class="">
<caption><h2>[<?php echo $tbl_header; ?>]</h2></caption>
<table 
id="mytable"
data-toggle="table" 
data-url="<?= $geturl ?>" 
data-cache="false" 
data-height="400"
data-search="true"
data-pagination="true" 
data-show-refresh="true" 
data-sort-name="id">
    <thead>
        <tr>  
                        
             <? foreach ($fields as $f): ?>          
             <th data-field="<?= $f['id'] ?>" data-sortable="true" ><?= $f['name'] ?></th>
             <? endforeach; ?>   
             <th data-field="operate" data-align="center" data-formatter="operateFormatter" data-events="operateEvents">Operate</th>
        </tr>
    </thead>
</table>

</div>



<script type="text/javascript">
    /*
* bootstrap-table - v1.5.0 - 2014-12-12
* https://github.com/wenzhixin/bootstrap-table
* Copyright (c) 2014 zhixin wen
* Licensed MIT License
*/
!function(a){"use strict";var b=function(a){var b=arguments,c=!0,d=1;return a=a.replace(/%s/g,function(){var a=b[d++];return"undefined"==typeof a?(c=!1,""):a}),c?a:""},c=function(b,c,d,e){var f="";return a.each(b,function(a,b){return b[c]===e?(f=b[d],!1):!0}),f},d=function(b,c){var d=-1;return a.each(b,function(a,b){return b.field===c?(d=a,!1):!0}),d},e=function(){var b,c,d=a("<p/>").addClass("fixed-table-scroll-inner"),e=a("<div/>").addClass("fixed-table-scroll-outer");return e.append(d),a("body").append(e),b=d[0].offsetWidth,e.css("overflow","scroll"),c=d[0].offsetWidth,b==c&&(c=e[0].clientWidth),e.remove(),b-c},f=function(b,c,d,e){if("string"==typeof c){var f=c.split(".");f.length>1?(c=window,a.each(f,function(a,b){c=c[b]})):c=window[c]}return"object"==typeof c?c:"function"==typeof c?c.apply(b,d):e},g=function(a){return"string"==typeof a?a.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#039;"):a},h=function(b,c){this.options=c,this.$el=a(b),this.$el_=this.$el.clone(),this.timeoutId_=0,this.init()};h.DEFAULTS={classes:"table table-hover",height:void 0,undefinedText:"-",sortName:void 0,sortOrder:"asc",striped:!1,columns:[],data:[],method:"get",url:void 0,cache:!0,contentType:"application/json",dataType:"json",queryParams:function(a){return a},queryParamsType:"limit",responseHandler:function(a){return a},pagination:!1,sidePagination:"client",totalRows:0,pageNumber:1,pageSize:10,pageList:[10,25,50,100],search:!1,searchAlign:"right",selectItemName:"btSelectItem",showHeader:!0,showColumns:!1,showRefresh:!1,showToggle:!1,smartDisplay:!0,minimumCountColumns:1,idField:void 0,cardView:!1,clickToSelect:!1,singleSelect:!1,toolbar:void 0,toolbarAlign:"right",checkboxHeader:!0,sortable:!0,maintainSelected:!1,rowStyle:function(){return{}},rowAttributes:function(){return{}},onAll:function(){return!1},onClickRow:function(){return!1},onDblClickRow:function(){return!1},onSort:function(){return!1},onCheck:function(){return!1},onUncheck:function(){return!1},onCheckAll:function(){return!1},onUncheckAll:function(){return!1},onLoadSuccess:function(){return!1},onLoadError:function(){return!1},onColumnSwitch:function(){return!1},onPageChange:function(){return!1},onSearch:function(){return!1},onPreBody:function(){return!1},onPostBody:function(){return!1}},h.LOCALES=[],h.LOCALES["en-US"]={formatLoadingMessage:function(){return"Loading, please wait…"},formatRecordsPerPage:function(a){return b("%s records per page",a)},formatShowingRows:function(a,c,d){return b("Showing %s to %s of %s rows",a,c,d)},formatSearch:function(){return"Search"},formatNoMatches:function(){return"No matching records found"},formatRefresh:function(){return"Refresh"},formatToggle:function(){return"Toggle"},formatColumns:function(){return"Columns"}},a.extend(h.DEFAULTS,h.LOCALES["en-US"]),h.COLUMN_DEFAULTS={radio:!1,checkbox:!1,checkboxEnabled:!0,field:void 0,title:void 0,"class":void 0,align:void 0,halign:void 0,valign:void 0,width:void 0,sortable:!1,order:"asc",visible:!0,switchable:!0,clickToSelect:!0,formatter:void 0,events:void 0,sorter:void 0,cellStyle:void 0,searchable:!0},h.EVENTS={"all.bs.table":"onAll","click-row.bs.table":"onClickRow","dbl-click-row.bs.table":"onDblClickRow","sort.bs.table":"onSort","check.bs.table":"onCheck","uncheck.bs.table":"onUncheck","check-all.bs.table":"onCheckAll","uncheck-all.bs.table":"onUncheckAll","load-success.bs.table":"onLoadSuccess","load-error.bs.table":"onLoadError","column-switch.bs.table":"onColumnSwitch","page-change.bs.table":"onPageChange","search.bs.table":"onSearch","pre-body.bs.table":"onPreBody","post-body.bs.table":"onPostBody"},h.prototype.init=function(){this.initContainer(),this.initTable(),this.initHeader(),this.initData(),this.initToolbar(),this.initPagination(),this.initBody(),this.initServer()},h.prototype.initContainer=function(){this.$container=a(['<div class="bootstrap-table">','<div class="fixed-table-toolbar"></div>','<div class="fixed-table-container">','<div class="fixed-table-header"><table></table></div>','<div class="fixed-table-body">','<div class="fixed-table-loading">',this.options.formatLoadingMessage(),"</div>","</div>",'<div class="fixed-table-pagination"></div>',"</div>","</div>"].join("")),this.$container.insertAfter(this.$el),this.$container.find(".fixed-table-body").append(this.$el),this.$container.after('<div class="clearfix"></div>'),this.$loading=this.$container.find(".fixed-table-loading"),this.$el.addClass(this.options.classes),this.options.striped&&this.$el.addClass("table-striped")},h.prototype.initTable=function(){var b=this,c=[],d=[];this.$header=this.$el.find("thead"),this.$header.length||(this.$header=a("<thead></thead>").appendTo(this.$el)),this.$header.find("tr").length||this.$header.append("<tr></tr>"),this.$header.find("th").each(function(){var b=a.extend({},{title:a(this).html(),"class":a(this).attr("class")},a(this).data());c.push(b)}),this.options.columns=a.extend([],c,this.options.columns),a.each(this.options.columns,function(c,d){b.options.columns[c]=a.extend({},h.COLUMN_DEFAULTS,{field:c},d)}),this.options.data.length||(this.$el.find("tbody tr").each(function(){var c={};c._id=a(this).attr("id"),c._class=a(this).attr("class"),a(this).find("td").each(function(d){var e=b.options.columns[d].field;c[e]=a(this).html(),c["_"+e+"_id"]=a(this).attr("id"),c["_"+e+"_class"]=a(this).attr("class")}),d.push(c)}),this.options.data=d)},h.prototype.initHeader=function(){var c=this,d=[],e=[];this.header={fields:[],styles:[],classes:[],formatters:[],events:[],sorters:[],cellStyles:[],clickToSelects:[],searchables:[]},a.each(this.options.columns,function(a,f){{var g="",h="",i="",j="",k=b(' class="%s"',f["class"]);c.options.sortOrder||f.order}f.visible&&(h=b("text-align: %s; ",f.halign?f.halign:f.align),i=b("text-align: %s; ",f.align),j=b("vertical-align: %s; ",f.valign),j+=b("width: %spx; ",f.checkbox||f.radio?36:f.width),d.push(f),c.header.fields.push(f.field),c.header.styles.push(i+j),c.header.classes.push(k),c.header.formatters.push(f.formatter),c.header.events.push(f.events),c.header.sorters.push(f.sorter),c.header.cellStyles.push(f.cellStyle),c.header.clickToSelects.push(f.clickToSelect),c.header.searchables.push(f.searchable),e.push("<th",f.checkbox||f.radio?b(' class="bs-checkbox %s"',f["class"]||""):k,b(' style="%s"',h+j),">"),e.push(b('<div class="th-inner %s">',c.options.sortable&&f.sortable?"sortable":"")),g=f.title,c.options.sortName===f.field&&c.options.sortable&&f.sortable&&(g+=c.getCaretHtml()),f.checkbox&&(!c.options.singleSelect&&c.options.checkboxHeader&&(g='<input name="btSelectAll" type="checkbox" />'),c.header.stateField=f.field),f.radio&&(g="",c.header.stateField=f.field,c.options.singleSelect=!0),e.push(g),e.push("</div>"),e.push('<div class="fht-cell"></div>'),e.push("</th>"))}),this.$header.find("tr").html(e.join("")),this.$header.find("th").each(function(b){a(this).data(d[b])}),this.$container.off("click","th").on("click","th",function(b){c.options.sortable&&a(this).data().sortable&&c.onSort(b)}),!this.options.showHeader||this.options.cardView?(this.$header.hide(),this.$container.find(".fixed-table-header").hide(),this.$loading.css("top",0)):(this.$header.show(),this.$container.find(".fixed-table-header").show(),this.$loading.css("top","37px")),this.$selectAll=this.$header.find('[name="btSelectAll"]'),this.$container.off("click",'[name="btSelectAll"]').on("click",'[name="btSelectAll"]',function(){var b=a(this).prop("checked");c[b?"checkAll":"uncheckAll"]()})},h.prototype.initData=function(a,b){this.data=b?this.data.concat(a):a||this.options.data,this.options.data=this.data,"server"!==this.options.sidePagination&&this.initSort()},h.prototype.initSort=function(){var b=this,c=this.options.sortName,d="desc"===this.options.sortOrder?-1:1,e=a.inArray(this.options.sortName,this.header.fields);-1!==e&&this.data.sort(function(g,h){var i=g[c],j=h[c],k=f(b.header,b.header.sorters[e],[i,j]);return void 0!==k?d*k:(a.isNumeric(i)&&(i=parseFloat(i)),a.isNumeric(j)&&(j=parseFloat(j)),(void 0===i||null===i)&&(i=""),(void 0===i||null===j)&&(j=""),i===j?0:j>i?-1*d:d)})},h.prototype.onSort=function(b){var c=a(b.currentTarget),d=this.$header.find("th").eq(c.index());return this.$header.add(this.$header_).find("span.order").remove(),this.options.sortName===c.data("field")?this.options.sortOrder="asc"===this.options.sortOrder?"desc":"asc":(this.options.sortName=c.data("field"),this.options.sortOrder="asc"===c.data("order")?"desc":"asc"),this.trigger("sort",this.options.sortName,this.options.sortOrder),c.add(d).data("order",this.options.sortOrder).find(".th-inner").append(this.getCaretHtml()),"server"===this.options.sidePagination?void this.initServer():(this.initSort(),void this.initBody())},h.prototype.initToolbar=function(){var c,d,e=this,f=[],g=0,h=0;this.$toolbar=this.$container.find(".fixed-table-toolbar").html(""),"string"==typeof this.options.toolbar&&a('<div class="bars pull-left"></div>').appendTo(this.$toolbar).append(a(this.options.toolbar)),f=['<div class="columns columns-'+this.options.toolbarAlign+" btn-group pull-"+this.options.toolbarAlign+'">'],this.options.showRefresh&&f.push(b('<button class="btn btn-default" type="button" name="refresh" title="%s">',this.options.formatRefresh()),'<i class="glyphicon glyphicon-refresh icon-refresh"></i>',"</button>"),this.options.showToggle&&f.push(b('<button class="btn btn-default" type="button" name="toggle" title="%s">',this.options.formatToggle()),'<i class="glyphicon glyphicon glyphicon-list-alt icon-list-alt"></i>',"</button>"),this.options.showColumns&&(f.push(b('<div class="keep-open btn-group" title="%s">',this.options.formatColumns()),'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">','<i class="glyphicon glyphicon-th icon-th"></i>',' <span class="caret"></span>',"</button>",'<ul class="dropdown-menu" role="menu">'),a.each(this.options.columns,function(a,c){if(!c.radio&&!c.checkbox){var d=c.visible?' checked="checked"':"";c.switchable&&(f.push(b('<li><label><input type="checkbox" data-field="%s" value="%s"%s> %s</label></li>',c.field,a,d,c.title)),h++)}}),f.push("</ul>","</div>")),f.push("</div>"),f.length>2&&this.$toolbar.append(f.join("")),this.options.showRefresh&&this.$toolbar.find('button[name="refresh"]').off("click").on("click",a.proxy(this.refresh,this)),this.options.showToggle&&this.$toolbar.find('button[name="toggle"]').off("click").on("click",function(){e.options.cardView=!e.options.cardView,e.initHeader(),e.initBody()}),this.options.showColumns&&(c=this.$toolbar.find(".keep-open"),h<=this.options.minimumCountColumns&&c.find("input").prop("disabled",!0),c.find("li").off("click").on("click",function(a){a.stopImmediatePropagation()}),c.find("input").off("click").on("click",function(){var b=a(this);e.toggleColumn(b.val(),b.prop("checked"),!1),e.trigger("column-switch",a(this).data("field"),b.prop("checked"))})),this.options.search&&(f=[],f.push('<div class="pull-'+this.options.searchAlign+' search">',b('<input class="form-control" type="text" placeholder="%s">',this.options.formatSearch()),"</div>"),this.$toolbar.append(f.join("")),d=this.$toolbar.find(".search input"),d.off("keyup").on("keyup",function(a){clearTimeout(g),g=setTimeout(function(){e.onSearch(a)},500)}))},h.prototype.onSearch=function(b){var c=a.trim(a(b.currentTarget).val());a(b.currentTarget).val(c),c!==this.searchText&&(this.searchText=c,this.options.pageNumber=1,this.initSearch(),this.updatePagination(),this.trigger("search",c))},h.prototype.initSearch=function(){var b=this;if("server"!==this.options.sidePagination){var c=this.searchText&&this.searchText.toLowerCase(),d=a.isEmptyObject(this.filterColumns)?null:this.filterColumns;this.data=d?a.grep(this.options.data,function(a){for(var b in d)if(a[b]!==d[b])return!1;return!0}):this.options.data,this.data=c?a.grep(this.data,function(d,e){for(var g in d){g=a.isNumeric(g)?parseInt(g,10):g;var h=d[g];h=f(b.header,b.header.formatters[a.inArray(g,b.header.fields)],[h,d,e],h);var i=a.inArray(g,b.header.fields);if(-1!==i&&b.header.searchables[i]&&("string"==typeof h||"number"==typeof h)&&-1!==(h+"").toLowerCase().indexOf(c))return!0}return!1}):this.data}},h.prototype.initPagination=function(){if(this.$pagination=this.$container.find(".fixed-table-pagination"),this.options.pagination){var c,d,e,f,g,h,i,j,k,l=this,m=[],n=this.getData();"server"!==this.options.sidePagination&&(this.options.totalRows=n.length),this.totalPages=0,this.options.totalRows&&(this.totalPages=~~((this.options.totalRows-1)/this.options.pageSize)+1),this.totalPages>0&&this.options.pageNumber>this.totalPages&&(this.options.pageNumber=this.totalPages),this.pageFrom=(this.options.pageNumber-1)*this.options.pageSize+1,this.pageTo=this.options.pageNumber*this.options.pageSize,this.pageTo>this.options.totalRows&&(this.pageTo=this.options.totalRows),m.push('<div class="pull-left pagination-detail">','<span class="pagination-info">',this.options.formatShowingRows(this.pageFrom,this.pageTo,this.options.totalRows),"</span>"),m.push('<span class="page-list">');var o=['<span class="btn-group dropup">','<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">','<span class="page-size">',this.options.pageSize,"</span>",' <span class="caret"></span>',"</button>",'<ul class="dropdown-menu" role="menu">'],p=this.options.pageList;if("string"==typeof this.options.pageList){var q=this.options.pageList.slice(1,-1).replace(/ /g,"").split(",");p=[],a.each(q,function(a,b){p.push(+b)})}for(a.each(p,function(a,c){if(!l.options.smartDisplay||l.options.totalRows>=c||0===a){var d=c===l.options.pageSize?' class="active"':"";o.push(b('<li%s><a href="javascript:void(0)">%s</a></li>',d,c))}}),o.push("</ul></span>"),m.push(this.options.formatRecordsPerPage(o.join(""))),m.push("</span>"),m.push("</div>",'<div class="pull-right pagination">','<ul class="pagination">','<li class="page-first"><a href="javascript:void(0)">&lt;&lt;</a></li>','<li class="page-pre"><a href="javascript:void(0)">&lt;</a></li>'),this.totalPages<5?(d=1,e=this.totalPages):(d=this.options.pageNumber-2,e=d+4,1>d&&(d=1,e=5),e>this.totalPages&&(e=this.totalPages,d=e-4)),c=d;e>=c;c++)m.push('<li class="page-number'+(c===this.options.pageNumber?" active disabled":"")+'">','<a href="javascript:void(0)">',c,"</a>","</li>");m.push('<li class="page-next"><a href="javascript:void(0)">&gt;</a></li>','<li class="page-last"><a href="javascript:void(0)">&gt;&gt;</a></li>',"</ul>","</div>"),this.$pagination.html(m.join("")),f=this.$pagination.find(".page-list a"),g=this.$pagination.find(".page-first"),h=this.$pagination.find(".page-pre"),i=this.$pagination.find(".page-next"),j=this.$pagination.find(".page-last"),k=this.$pagination.find(".page-number"),this.options.pageNumber<=1&&(g.addClass("disabled"),h.addClass("disabled")),this.options.pageNumber>=this.totalPages&&(i.addClass("disabled"),j.addClass("disabled")),this.options.smartDisplay&&(this.totalPages<=1&&this.$pagination.find("div.pagination").hide(),(this.options.pageList.length<2||this.options.totalRows<=this.options.pageList[1])&&this.$pagination.find("span.page-list").hide(),this.$pagination[this.getData().length?"show":"hide"]()),f.off("click").on("click",a.proxy(this.onPageListChange,this)),g.off("click").on("click",a.proxy(this.onPageFirst,this)),h.off("click").on("click",a.proxy(this.onPagePre,this)),i.off("click").on("click",a.proxy(this.onPageNext,this)),j.off("click").on("click",a.proxy(this.onPageLast,this)),k.off("click").on("click",a.proxy(this.onPageNumber,this))}},h.prototype.updatePagination=function(b){b&&a(b.currentTarget).hasClass("disabled")||(this.options.maintainSelected||this.resetRows(),this.initPagination(),"server"===this.options.sidePagination?this.initServer():this.initBody(),this.trigger("page-change",this.options.pageSize,this.options.pageNumber))},h.prototype.onPageListChange=function(b){var c=a(b.currentTarget);c.parent().addClass("active").siblings().removeClass("active"),this.options.pageSize=+c.text(),this.$toolbar.find(".page-size").text(this.options.pageSize),this.updatePagination(b)},h.prototype.onPageFirst=function(a){this.options.pageNumber=1,this.updatePagination(a)},h.prototype.onPagePre=function(a){this.options.pageNumber--,this.updatePagination(a)},h.prototype.onPageNext=function(a){this.options.pageNumber++,this.updatePagination(a)},h.prototype.onPageLast=function(a){this.options.pageNumber=this.totalPages,this.updatePagination(a)},h.prototype.onPageNumber=function(b){this.options.pageNumber!==+a(b.currentTarget).text()&&(this.options.pageNumber=+a(b.currentTarget).text(),this.updatePagination(b))},h.prototype.initBody=function(d){var e=this,h=[],i=this.getData();this.trigger("pre-body",i),this.$body=this.$el.find("tbody"),this.$body.length||(this.$body=a("<tbody></tbody>").appendTo(this.$el)),"server"===this.options.sidePagination&&(i=this.data),this.options.pagination&&"server"!==this.options.sidePagination||(this.pageFrom=1,this.pageTo=i.length);for(var j=this.pageFrom-1;j<this.pageTo;j++){var k=i[j],l={},m=[],n={},o=[];if(l=f(this.options,this.options.rowStyle,[k,j],l),l&&l.css)for(var p in l.css)m.push(p+": "+l.css[p]);if(n=f(this.options,this.options.rowAttributes,[k,j],n))for(var p in n)o.push(b('%s="%s"',p,g(n[p])));h.push("<tr",b(" %s",o.join(" ")),b(' id="%s"',a.isArray(k)?void 0:k._id),b(' class="%s"',l.classes||(a.isArray(k)?void 0:k._class)),b(' data-index="%s"',j),">"),this.options.cardView&&h.push(b('<td colspan="%s">',this.header.fields.length)),a.each(this.header.fields,function(a,d){var g="",i=k[d],n="",o={},p="",q=e.header.classes[a];if(l=b('style="%s"',m.concat(e.header.styles[a]).join("; ")),i=f(e.header,e.header.formatters[a],[i,k,j],i),k["_"+d+"_id"]&&(p=b(' id="%s"',k["_"+d+"_id"])),k["_"+d+"_class"]&&(q=b(' class="%s"',k["_"+d+"_class"])),o=f(e.header,e.header.cellStyles[a],[i,k,j],o),o.classes&&(q=b(' class="%s"',o.classes)),o.css){m=[];for(var r in o.css)m.push(r+": "+o.css[r]);l=b('style="%s"',m.concat(e.header.styles[a]).join("; "))}if(e.options.columns[a].checkbox||e.options.columns[a].radio){if(e.options.cardView)return!0;n=e.options.columns[a].checkbox?"checkbox":n,n=e.options.columns[a].radio?"radio":n,g=['<td class="bs-checkbox">',"<input"+b(' data-index="%s"',j)+b(' name="%s"',e.options.selectItemName)+b(' type="%s"',n)+b(' value="%s"',k[e.options.idField])+b(' checked="%s"',i===!0||i&&i.checked?"checked":void 0)+b(' disabled="%s"',!e.options.columns[a].checkboxEnabled||i&&i.disabled?"disabled":void 0)+" />","</td>"].join("")}else i="undefined"==typeof i||null===i?e.options.undefinedText:i,g=e.options.cardView?['<div class="card-view">',e.options.showHeader?b('<span class="title" %s>%s</span>',l,c(e.options.columns,"field","title",d)):"",b('<span class="value">%s</span>',i),"</div>"].join(""):[b("<td%s %s %s>",p,q,l),i,"</td>"].join(""),e.options.cardView&&e.options.smartDisplay&&""===i&&(g="");h.push(g)}),this.options.cardView&&h.push("</td>"),h.push("</tr>")}h.length||h.push('<tr class="no-records-found">',b('<td colspan="%s">%s</td>',this.header.fields.length,this.options.formatNoMatches()),"</tr>"),this.$body.html(h.join("")),d||this.scrollTo(0),this.$body.find("> tr > td").off("click").on("click",function(){var c=a(this).parent();e.trigger("click-row",e.data[c.data("index")],c),e.options.clickToSelect&&e.header.clickToSelects[c.children().index(a(this))]&&c.find(b('[name="%s"]',e.options.selectItemName))[0].click()}),this.$body.find("tr").off("dblclick").on("dblclick",function(){e.trigger("dbl-click-row",e.data[a(this).data("index")],a(this))}),this.$selectItem=this.$body.find(b('[name="%s"]',this.options.selectItemName)),this.$selectItem.off("click").on("click",function(b){b.stopImmediatePropagation();var c=a(this).prop("checked"),d=e.data[a(this).data("index")];d[e.header.stateField]=c,e.trigger(c?"check":"uncheck",d),e.options.singleSelect&&(e.$selectItem.not(this).each(function(){e.data[a(this).data("index")][e.header.stateField]=!1}),e.$selectItem.filter(":checked").not(this).prop("checked",!1)),e.updateSelected()}),a.each(this.header.events,function(b,c){if(c){"string"==typeof c&&(c=f(null,c));for(var d in c)e.$body.find("tr").each(function(){var f=a(this),g=f.find(e.options.cardView?".card-view":"td").eq(b),h=d.indexOf(" "),i=d.substring(0,h),j=d.substring(h+1),k=c[d];g.find(j).off(i).on(i,function(a){var c=f.data("index"),d=e.data[c],g=d[e.header.fields[b]];k.apply(this,[a,g,d,c])})})}}),this.updateSelected(),this.resetView(),this.trigger("post-body")},h.prototype.initServer=function(b){var c=this,d={},e={pageSize:this.options.pageSize,pageNumber:this.options.pageNumber,searchText:this.searchText,sortName:this.options.sortName,sortOrder:this.options.sortOrder};this.options.url&&("limit"===this.options.queryParamsType&&(e={limit:e.pageSize,offset:e.pageSize*(e.pageNumber-1),search:e.searchText,sort:e.sortName,order:e.sortOrder}),d=f(this.options,this.options.queryParams,[e],d),d!==!1&&(b||this.$loading.show(),a.ajax({type:this.options.method,url:this.options.url,data:d,cache:this.options.cache,contentType:this.options.contentType,dataType:this.options.dataType,success:function(a){a=f(c.options,c.options.responseHandler,[a],a);var b=a;"server"===c.options.sidePagination&&(c.options.totalRows=a.total,b=a.rows),c.load(b),c.trigger("load-success",b)},error:function(a){c.trigger("load-error",a.status)},complete:function(){b||c.$loading.hide()}})))},h.prototype.getCaretHtml=function(){return['<span class="order'+("desc"===this.options.sortOrder?"":" dropup")+'">','<span class="caret" style="margin: 10px 5px;"></span>',"</span>"].join("")},h.prototype.updateSelected=function(){var b=this.$selectItem.filter(":enabled").length===this.$selectItem.filter(":enabled").filter(":checked").length;this.$selectAll.add(this.$selectAll_).prop("checked",b),this.$selectItem.each(function(){a(this).parents("tr")[a(this).prop("checked")?"addClass":"removeClass"]("selected")})},h.prototype.updateRows=function(b){var c=this;this.$selectItem.each(function(){c.data[a(this).data("index")][c.header.stateField]=b})},h.prototype.resetRows=function(){var b=this;a.each(this.data,function(a,c){b.$selectAll.prop("checked",!1),b.$selectItem.prop("checked",!1),c[b.header.stateField]=!1})},h.prototype.trigger=function(b){var c=Array.prototype.slice.call(arguments,1);b+=".bs.table",this.options[h.EVENTS[b]].apply(this.options,c),this.$el.trigger(a.Event(b),c),this.options.onAll(b,c),this.$el.trigger(a.Event("all.bs.table"),[b,c])},h.prototype.resetHeader=function(){var b=this,c=this.$container.find(".fixed-table-header"),d=this.$container.find(".fixed-table-body"),f=this.$el.width()>d.width()?e():0;return this.$el.is(":hidden")?(clearTimeout(this.timeoutId_),void(this.timeoutId_=setTimeout(a.proxy(this.resetHeader,this),100))):(this.$header_=this.$header.clone(!0,!0),this.$selectAll_=this.$header_.find('[name="btSelectAll"]'),void setTimeout(function(){c.css({height:"37px","border-bottom":"1px solid #dddddd","margin-right":f}).find("table").css("width",b.$el.css("width")).html("").attr("class",b.$el.attr("class")).append(b.$header_),b.$header.find("th").each(function(c){b.$header_.find("th").eq(c).data(a(this).data())}),b.$body.find("tr:first-child:not(.no-records-found) > *").each(function(c){b.$header_.find("div.fht-cell").eq(c).width(a(this).innerWidth())}),b.$el.css("margin-top",-b.$header.height()),d.off("scroll").on("scroll",function(){c.scrollLeft(a(this).scrollLeft())})}))},h.prototype.toggleColumn=function(a,c,d){if(-1!==a&&(this.options.columns[a].visible=c,this.initHeader(),this.initSearch(),this.initPagination(),this.initBody(),this.options.showColumns)){var e=this.$toolbar.find(".keep-open input").prop("disabled",!1);d&&e.filter(b('[value="%s"]',a)).prop("checked",c),e.filter(":checked").length<=this.options.minimumCountColumns&&e.filter(":checked").prop("disabled",!0)}},h.prototype.resetView=function(a){{var b=this;this.header}if(a&&a.height&&(this.options.height=a.height),this.$selectAll.prop("checked",this.$selectItem.length>0&&this.$selectItem.length===this.$selectItem.filter(":checked").length),this.options.height){var c=+this.$toolbar.children().outerHeight(!0),d=+this.$pagination.children().outerHeight(!0),e=this.options.height-c-d;this.$container.find(".fixed-table-container").css("height",e+"px")}return this.options.cardView?(b.$el.css("margin-top","0"),void b.$container.find(".fixed-table-container").css("padding-bottom","0")):(this.options.showHeader&&this.options.height&&this.resetHeader(),void(this.options.height&&this.options.showHeader&&this.$container.find(".fixed-table-container").css("padding-bottom","37px")))},h.prototype.getData=function(){return this.searchText||!a.isEmptyObject(this.filterColumns)?this.data:this.options.data},h.prototype.load=function(a){this.initData(a),this.initSearch(),this.initPagination(),this.initBody()},h.prototype.append=function(a){this.initData(a,!0),this.initSearch(),this.initPagination(),this.initBody(!0)},h.prototype.remove=function(b){var c,d,e=this.options.data.length;if(b.hasOwnProperty("field")&&b.hasOwnProperty("values")){for(c=e-1;c>=0;c--){if(d=this.options.data[c],!d.hasOwnProperty(b.field))return;-1!==a.inArray(d[b.field],b.values)&&this.options.data.splice(c,1)}e!==this.options.data.length&&(this.initSearch(),this.initPagination(),this.initBody(!0))}},h.prototype.updateRow=function(b){b.hasOwnProperty("index")&&b.hasOwnProperty("row")&&(a.extend(this.data[b.index],b.row),this.initBody(!0))},h.prototype.mergeCells=function(b){var c,d,e=b.index,f=a.inArray(b.field,this.header.fields),g=b.rowspan||1,h=b.colspan||1,i=this.$body.find("tr"),j=i.eq(e).find("td").eq(f);if(!(0>e||0>f||e>=this.data.length)){for(c=e;e+g>c;c++)for(d=f;f+h>d;d++)i.eq(c).find("td").eq(d).hide();j.attr("rowspan",g).attr("colspan",h).show()}},h.prototype.getSelections=function(){var b=this;return a.grep(this.data,function(a){return a[b.header.stateField]})},h.prototype.checkAll=function(){this.checkAll_(!0)},h.prototype.uncheckAll=function(){this.checkAll_(!1)},h.prototype.checkAll_=function(a){this.$selectItem.filter(":enabled").prop("checked",a),this.updateRows(a),this.updateSelected(),this.trigger(a?"check-all":"uncheck-all")},h.prototype.check=function(a){this.check_(!0,a)},h.prototype.uncheck=function(a){this.check_(!1,a)},h.prototype.check_=function(a,c){this.$selectItem.filter(b('[data-index="%s"]',c)).prop("checked",a),this.data[c][this.header.stateField]=a,this.updateSelected()},h.prototype.destroy=function(){this.$el.insertBefore(this.$container),a(this.options.toolbar).insertBefore(this.$el),this.$container.next().remove(),this.$container.remove(),this.$el.html(this.$el_.html()).attr("class",this.$el_.attr("class")||"")},h.prototype.showLoading=function(){this.$loading.show()},h.prototype.hideLoading=function(){this.$loading.hide()},h.prototype.refresh=function(a){a&&a.url&&(this.options.url=a.url,this.options.pageNumber=1),this.initServer(a&&a.silent)},h.prototype.showColumn=function(a){this.toggleColumn(d(this.options.columns,a),!0,!0)},h.prototype.hideColumn=function(a){this.toggleColumn(d(this.options.columns,a),!1,!0)},h.prototype.filterBy=function(b){this.filterColumns=a.isEmptyObject(b)?{}:b,this.options.pageNumber=1,this.initSearch(),this.updatePagination()},h.prototype.scrollTo=function(a){var b=this.$container.find(".fixed-table-body");"string"==typeof a&&(a="bottom"===a?b[0].scrollHeight:0),"number"==typeof a&&b.scrollTop(a)},h.prototype.prevPage=function(){this.options.pageNumber>1?this.options.pageNumber--:null,this.updatePagination()},h.prototype.nextPage=function(){this.options.pageNumber<this.options.pageSize?this.options.pageNumber++:null,this.updatePagination()};var i=["getSelections","getData","load","append","remove","updateRow","mergeCells","checkAll","uncheckAll","check","uncheck","refresh","resetView","destroy","showLoading","hideLoading","showColumn","hideColumn","filterBy","scrollTo","prevPage","nextPage"];a.fn.bootstrapTable=function(b,c){var d;return this.each(function(){var e=a(this),f=e.data("bootstrap.table"),g=a.extend({},h.DEFAULTS,e.data(),"object"==typeof b&&b);if("string"==typeof b){if(a.inArray(b,i)<0)throw"Unknown method: "+b;if(!f)return;d=f[b](c),"destroy"===b&&e.removeData("bootstrap.table")}f||e.data("bootstrap.table",f=new h(this,g))}),"undefined"==typeof d?this:d},a.fn.bootstrapTable.Constructor=h,a.fn.bootstrapTable.defaults=h.DEFAULTS,a.fn.bootstrapTable.columnDefaults=h.COLUMN_DEFAULTS,a.fn.bootstrapTable.locales=h.LOCALES,a.fn.bootstrapTable.methods=i,a(function(){a('[data-toggle="table"]').bootstrapTable()})}(jQuery);
</script>

<script>
var fm_upd_url = "";
var del_id="";
var ids="";

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
            $("#fm_result").html(""); 
            //alert('You click edit icon, row: ' + JSON.stringify(row));
            //console.log(value, row, index);
            var obj = jQuery.parseJSON(JSON.stringify(row));               
            fm_upd_url="<?= $updurl ?>/"+obj.id;
            //alert(fm_upd_url);
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
    };
</script>



<div id="mymodal" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Edit</h4>
      </div>
      <div class="modal-body">
        <form id="fm" method="post" novalidate>
            <? foreach ($fields as $f): ?>                       
                <div class="form-group">
                    <label class="control-label" for="focusedInput"><?= $f['name'] ?></label>
                    <input class="form-control" name="<?= $f['id'] ?>" type="text" value="">
                </div>
            <? endforeach; ?>   
        </form>
      </div>
      <div  align="center">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button  id="sub_btn" type="submit" class="btn btn-primary"  onclick="saveUser()">Save</button>
        <div id="fm_result" class="alert alert-dismissable alert-success"></div>
      </div>       
    </div>
  </div>
</div>


<div id="conmodal" class="modal">
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
        <button  id="sub_btn" type="submit" class="btn btn-primary"  onclick="deldata()">Delete</button>        
      </div>       
    </div>
  </div>
</div>


<script type="text/javascript">
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
        
        //$("#mytable").bootstrapTable('showLoading');
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
     $("#sub_btn").button('loading'); 
            $('#fm').form('submit',{
                url: fm_upd_url,
                onSubmit: function(){                                     
                },
                success: function(result){
                    var result = eval('('+result+')');
                    if (result.success){
                         console.log(result.msg); 
                         refresh_table();         
                         $("#sub_btn").button('reset'); 
                         $("#fm_result").html(result.msg);                
                    } else {
                        console.log(result.msg);
                        $("#fm_result").html(result.msg); 
                    }
                }

            });
        
        }//save User    



</script>