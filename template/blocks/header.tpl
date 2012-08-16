<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<title>{modul.title}</title>
	<meta name="description" content="[[if modul.description]]{modul.description}[[else]]{modul.title}[[endif]]" />
	<meta name="keywords" content="[[if modul.keywords]]{modul.keywords}[[else]]{modul.title}[[endif]]" />
	<link rel="stylesheet" type="text/css" href="/styles/main.css" />
        <link rel="stylesheet" type="text/css" href="/styles/south-street/jquery-ui-1.8.22.custom.css" />
        <link rel="stylesheet" type="text/css" href="/styles/colorbox.css" />
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
        <!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="/styles/ie.css" />
        <![endif]-->
        <!--[if lte IE 6]>
        <link rel="stylesheet" type="text/css" href="/styles/ie6.css" />
        <![endif]-->
	<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="/js/fieldFocus.js"></script>
	<script type="text/javascript" src="/js/scripts.js"></script>
        <script src="/js/popup.js"  type="text/javascript"></script>
        <script type="text/javascript" src="/js/jquery.ui.core.js"></script>
        <script type="text/javascript" src="/js/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="/js/jquery.ui.datepicker.js"></script>
        <script type="text/javascript" src="/js/jquery.ui.datepicker-ru.js"></script>
	<script type="text/javascript" src="/js/jquery.colorbox.js"></script>
	[[raw]]
	<script>
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "ru" ] );
	});
	</script>
	[[endraw]]
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	{xajax.printJavascript('/fmake/libs/xajax/')}
</head>