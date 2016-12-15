<?php
function isLogin()
{
	if(!isset($_SESSION['shopname'])||$_SESSION['shopname']=='')
	{
		return false;
	}
	else
	{
		return true;
	}
}
?>