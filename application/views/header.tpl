<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Eatryt Admin</title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href="{$BASEURL}css/sans.css" rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="{$BASEURL}css/bootstrap.min.css">
        <link rel="stylesheet" href="{$BASEURL}css/font-awesome.min.css">
        <link rel="stylesheet" href="{$BASEURL}css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{$BASEURL}css/dataTables.responsive.css">
        <link rel="stylesheet" href="{$BASEURL}css/jquery-ui.css">
        
        <script src="{$BASEURL}js/jquery-1.11.1.min.js" type="text/javascript"></script>
        <script src="{$BASEURL}js/jquery.knob.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                $(".knob").knob();
            });
            var webPath = "{$BASEURL}{$EXE}";
        </script>
        

        <link rel="stylesheet" type="text/css" href="{$BASEURL}css/theme.css">
        <link rel="stylesheet" type="text/css" href="{$BASEURL}css/premium.css">

    </head>
    <body class=" theme-blue" onload="common.onReponse('{$processName}','{$methodName}')">

    <!-- Demo page code -->
    {literal}
    <script type="text/javascript">
        $(function() {
            var match = document.cookie.match(new RegExp('color=([^;]+)'));
            if(match) var color = match[1];
            if(color) {
                $('body').removeClass(function (index, css) {
                    return (css.match (/\btheme-\S+/g) || []).join(' ')
                })
                $('body').addClass('theme-' + color);
            }

            $('[data-popover="true"]').popover({html: true});
            
        });
    </script>
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
            color: #fff;
        }
    </style>

    <script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
    </script>
    {/literal}
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  

    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
    <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
    <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
    <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> 

    <!--<![endif]--> 