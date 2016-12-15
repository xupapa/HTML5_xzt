<?php
function isLogin() {
	if (!isset($_SESSION['username']) || $_SESSION['username'] == '') {
		return false;
	}
	return true;
}

function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
  if(function_exists("mb_substr")) {
   if($suffix)
  {
     if($str==mb_substr($str, $start, $length, $charset)) 
     {
      return mb_substr($str, $start, $length, $charset); 
     }
     else
     {
      return mb_substr($str, $start, $length, $charset)."..."; 
     } 
 }
    else
 {
   return mb_substr($str, $start, $length, $charset);
  }
  }
  elseif(function_exists('iconv_substr')) {
   if($suffix)
  {
     if($str==iconv_substr($str,$start,$length,$charset)) 
     {
      return iconv_substr($str,$start,$length,$charset); 
     }
     else
     {
      return iconv_substr($str,$start,$length,$charset)."..."; 
     } 
   }
    else
 {
   return iconv_substr($str,$start,$length,$charset);
  }
  }
  $re['utf-8']  = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
  $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
  $re['gbk']  = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
  $re['big5']  = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
  preg_match_all($re[$charset], $str, $match);
  $slice = join("",array_slice($match[0], $start, $length));
  if($suffix) return $slice."...";
  return $slice;
}