<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru-ru" xml:lang="ru-ru">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Language" content="ru-ru" />
<meta http-equiv="imagetoolbar" content="no" />

<title>Центр администрирования</title>

	<meta http-equiv="X-UA-Compatible" content="IE=7" />

	<!--[if lte IE 6]>
		<script type="text/javascript" src="/js/ie6-fix.js"></script>
	<![endif]-->
	<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="/styles/ie.css" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="/styles/admin/main.css" />
	<script src="/js/admin/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="/js/admin/adminscript.js" type="text/javascript"></script>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	[[raw]]
	<script>
		//var rusChars = new   Array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ч','ц','ш','щ','э','ю','\я','ы','ъ','ь', ' ', '\'', '\"', '\#', '\$', '\%', '\&', '\*', '\,', '\:', '\;', '\<', '\>', '\?', '\[', '\]', '\^', '\{', '\}', '\|', '\!', '\@', '\(', '\)', '\-', '\=', '\+', '\/', '\\','«','»','.','№','–','%','`');
		//var transChars = new Array('a','b','v','g','d','e','jo','zh','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','ch','c','sh','csh','e','ju','ja','y','', '', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '','','','','','','','');
		var rusChars = new   Array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ч','ц','ш','щ','э','ю','я','ы','ъ','ь', ' ');
		var engChars = new   Array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','-','0','1','2','3','4','5','6','7','8','9');
		var transChars = new Array('a','b','v','g','d','e','jo','zh','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','ch','c','sh','csh','e','ju','ja','y','', '', '-');
		var from = "";
		 
		function isEnglish(ch){
			for(var i=0; i < engChars.length; i++){
				if(ch == engChars[i]) return ch;
			}
			return '';
		} 
		 
		function convert2EN(from_id,to_id)
		  {
		  from = document.getElementById(from_id).value;
		  from = from.toLowerCase();
		  var to = "";
		  var len = from.length;
		  var character, isRus;
		  for(var i=0; i < len; i++)
		    {
		    character = from.charAt(i,1);
		    isRus = false;
		    for(var j=0; j < rusChars.length; j++)
		      {
		      if(character == rusChars[j])
		        {
		        isRus = true;
		        break;
		        }
		      }
		    to += (isRus) ? transChars[j] : isEnglish(character);
		    }
		   //document.form1.Message.value = to;
		   document.getElementById(to_id).value = to;
		  }

	</script>
	[[endraw]]
	
	{xajax.printJavascript('/fmake/libs/xajax/')}
</head>
