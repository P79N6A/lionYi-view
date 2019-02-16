
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta author="JerryChen">
    <title>{{<$title|default:'Bear小熊表单'>}}-后台管理-powerby-bear小熊</title>
    <meta name="keywords" content="{{<$title|default:'Bear小熊表单'>}}-后台管理-powerby-bear小熊">
    <meta name="description" content="{{<$title|default:'Bear小熊表单'>}}-后台管理-powerby-bear小熊">

    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="/static/admin/bear/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="{{<$static_host>}}fontico/css/font-awesome.min.css"  media="all">
    <link href="/static/admin/bear/css/animate.min.css" rel="stylesheet">
    <!-- <link href="/static/admin/bear/css/font-awesome.min.css?v=4.4.0" rel="stylesheet"> -->
    <link href="/static/admin/bear/plus/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
   
    <!-- <base target="_blank"> -->
     {{<*开关*>}}
    {{<if isset($_form_types['switch'])>}}
        <link href="/static/admin/bear/plus/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
    {{</if>}}
     {{<*时间*>}}
    {{<if isset($_form_types['date'])>}}
        <link href="/static/admin/bear/plus/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    {{</if>}}
    {{<*下拉*>}}
    {{<if isset($_form_types['select'])>}}
        <link href="/static/admin/bear/plus/chosen/chosen.css" rel="stylesheet">
    {{</if>}}


     <link href="/static/admin/bear/css/style.min.css?v=4.0.0" rel="stylesheet">
    <link rel="stylesheet" href="/static/admin/bear/css/bear.css"  media="all">
    <script src="/static/admin/bear/js/jquery-2.2.4.min.js"></script>

      <!--  <script type="text/javascript" src="http://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/js/bootstrap-select.js"></script>    
    <link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/css/bootstrap-select.css">    
     -->
  

</head>


