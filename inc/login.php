<?php
//
// PAGE LOGIN
//
function login_enqueue_scripts(){
echo '
<div></div>
<style type="text/css" media="screen">
body{ background:#333333 !important; }
.background-cover{
background:#333333;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
position:fixed;
top:0;
left:0;
z-index:10;
overflow: hidden;
width: 100%;
height:100%;
}
#login{ z-index:9999; position:relative; }
.login form { box-shadow: 0px 0px 0px 0px !important; }
.login h1 a {
background:url("'.get_bloginfo('stylesheet_directory').'/assets/images/svg/volant-seminaire-logo-xl.svg") no-repeat center top !important;
background-size: 100% !important;
height:260px !important;
max-height:260px !important;
max-width:260px !important;
width: 260px !important;
}
input.button-primary, button.button-primary, a.button-primary{
border-radius: 3px !important;
background:#FFFFFF;
border:none !important;
font-weight:normal !important;
text-shadow:none !important;
}
.wp-core-ui .button-primary{
	background:#000000 !important;
	border-color:#000000 !important;
	box-shadow:none !important;
}
.wp-core-ui .button-primary:hover{
	background:#FF4E00 !important;
	border-color:#FF4E00 !important;
}
.login .message{
	border-left: 4px solid #A5D1FF !important;
}
.button:active, .submit input:active, .button-secondary:active {
background:#FF4E00 !important;
text-shadow: none !important;
}
.login #nav a, .login #backtoblog a {
color:#fff !important;
text-shadow: none !important;
}
.login #nav a:hover, .login #backtoblog a:hover{
color:#FFFFFF !important;
text-shadow: none !important;
}
.login #nav, .login #backtoblog{
text-shadow: none !important;
}
#nav{
	display:none;
}
</style>
';
}
add_action( 'login_enqueue_scripts', 'login_enqueue_scripts' );