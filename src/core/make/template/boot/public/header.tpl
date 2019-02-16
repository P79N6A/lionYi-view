{{<include file='./_meta.tpl'>}}


<script type="text/javascript">
  var bearConfig = {
            changeSortUrl        : ''//排序处理的URL
            ,upload_url          : '/sys/post/upload'//附件上传URL
            ,header_url          : "{{<$_header['url']>}}"//当前URL地址
            ,header_url_param    : "{{<$_header['param']>}}"//当前GET参数
            ,ueditor_toolbars    : [
                                'fullscreen', 'source', '|', 'undo', 'redo', '|',
                                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                'directionalityltr', 'directionalityrtl', 'indent', '|',
                                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                                'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
                                'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
                                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                                'print', 'preview', 'searchreplace', 'drafts', 'help'
                            ]//百度编辑器的按钮
            ,ueditor_upload      : ''//百度编辑器上传地址/sys/post/upload?type=ueditor
  };
</script>

 <div class="row">
<div class="col-sm-12">
<div class="ibox float-e-margins">
    {{<if !$hideTop>}}
    <div class="ibox-title">
        <h5>{{<$title|default:'Bear小熊表单'>}}</h5>
        <div class="ibox-tools">
            <a class="dropdown-toggle" data-toggle="dropdown" alt='设置显示字段' href="table_basic.html#">
               <i class="fa fa-cogs" aria-hidden="true"></i>
            </a>
             <a onclick="window.history.go(-1)"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                <a onclick="window.location.reload()" href="javascript:;"  alt='刷新'><i class="fa fa-refresh" aria-hidden="true"></i></a>
                <a href="" alt='导出csv'><i class="fa fa-download" aria-hidden="true"></i></a>
                <a onclick="window.history.go(1)"><cite><i class="fa fa-arrow-right" aria-hidden="true"></i></cite></a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="table_basic.html#">选项1</a>
                </li>
                <li><a href="table_basic.html#">选项2</a>
                </li>
            </ul>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    {{</if>}}
    <div class="ibox-content">
      <div class="col-sm-12"> 
       