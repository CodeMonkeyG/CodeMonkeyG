<?php

$imageNumber = rand(1, 4);

?>
<!doctype>
<html>
<head>
<title>CodeMonkeyG.com | A place on the internet</title>
<meta name="author" content="Giovanni Lee"/>
<meta name="description" content="Click The Monkey"/>
<meta charset="utf-8"/>
<meta name="keywords" content="web,development,html,css,html,javascript,php"/>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
<meta property="og:title" content="CodeMonkeyG.com | A place on the internet"/>
<meta property="og:image" content="http://codemonkeyg.com/images/monkey_3.gif"/>
<meta property="og:description" content="Click The Monkey"/>
<meta property="og:url" content="http://codemonkeyg.com"/>
<meta name="twitter:title" content="CodeMonkeyG.com | A place on the internet" />
<meta name="twitter:description" content="Click The Monkey" />
<meta name="twitter:image" content="http://codemonkeyg.com/images/monkey_3.gif" />
<meta name="twitter:url"  content="http://codemonkeyg.com"/>
<link rel="author" href="https://linkedin.com/in/codemonkeyg"/>
</head>
<body>

	<style type="text/css">
		*{
			min-width: 100%;
			min-height: 100%;
			bottom: 0;
			left: 0;
			margin: auto;
			overflow: auto;
			position: fixed;
			right: 0;
			top: 0;
		}
		#confetti{
			height:1px;
			left:-100000px;
			min-width:auto;
			width:1px;
		}
	</style>
	<a href="/" title="Click The Monkey"><img src="/images/monkey_<?php echo $imageNumber; ?>.gif" alt="Click The Monkey" /></a>
	<img id="confetti" src="/images/confetti.gif" alt="hooray :|" />
	<script type="text/javascript" >
		var userInput = []
		var validCode = '38384040373937396665';
		var maxInputArrayLength = 10;
		var confetti = document.getElementById('confetti');
		var confettiSrc = confetti.getAttribute('src');
		var hornAudio = new Audio('sounds/noise.wav');

		window.addEventListener('keyup', function(e) {
			var strokedKey = e.keyCode || e.which || false;

			if (!strokedKey){
				return false;
			}

			userInput.push(strokedKey);

			if(userInput.length > maxInputArrayLength){
				userInput = userInput.slice(-maxInputArrayLength, userInput.length);
			}

			if(userInput.join('') === validCode){
				confetti.setAttribute('style', 'min-width:100%;left:0;top:0');
				confetti.setAttribute('src', confettiSrc);
				hornAudio.play();
				setTimeout(function(){
					confetti.removeAttribute('style')
				}, 13500);
			}

		}, true);
	</script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-69767850-1', 'auto');
		ga('send', 'pageview');
	</script>
</body>
</html>
