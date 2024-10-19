<?php
/** Adminer - Compact database management
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2007 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.7.9
*/function
adminer_errors($Bc,$Dc){return!!preg_match('~^(Trying to access array offset on value of type null|Undefined array key)~',$Dc);}error_reporting(6135);set_error_handler('adminer_errors',2);$bd=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($bd||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Ni=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Ni)$$X=$Ni;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$g;return$g;}function
adminer(){global$b;return$b;}function
version(){global$ia;return$ia;}function
idf_unescape($u){$te=substr($u,-1);return
str_replace($te.$te,$te,substr($u,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($xg,$bd=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($y,$X)=each($xg)){foreach($X
as$je=>$W){unset($xg[$y][$je]);if(is_array($W)){$xg[$y][stripslashes($je)]=$W;$xg[]=&$xg[$y][stripslashes($je)];}else$xg[$y][stripslashes($je)]=($bd?$W:stripslashes($W));}}}}function
bracket_escape($u,$Oa=false){static$zi=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($u,($Oa?array_flip($zi):$zi));}function
min_version($fj,$He="",$h=null){global$g;if(!$h)$h=$g;$sh=$h->server_info;if($He&&preg_match('~([\d.]+)-MariaDB~',$sh,$A)){$sh=$A[1];$fj=$He;}return(version_compare($sh,$fj)>=0);}function
charset($g){return(min_version("5.5.3",0,$g)?"utf8mb4":"utf8");}function
script($Ch,$yi="\n"){return"<script".nonce().">$Ch</script>$yi";}function
script_src($Si){return"<script src='".h($Si)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($B,$Y,$fb,$qe="",$yf="",$kb="",$re=""){$H="<input type='checkbox' name='$B' value='".h($Y)."'".($fb?" checked":"").($re?" aria-labelledby='$re'":"").">".($yf?script("qsl('input').onclick = function () { $yf };",""):"");return($qe!=""||$kb?"<label".($kb?" class='$kb'":"").">$H".h($qe)."</label>":$H);}function
optionlist($Df,$mh=null,$Xi=false){$H="";foreach($Df
as$je=>$W){$Ef=array($je=>$W);if(is_array($W)){$H.='<optgroup label="'.h($je).'">';$Ef=$W;}foreach($Ef
as$y=>$X)$H.='<option'.($Xi||is_string($y)?' value="'.h($y).'"':'').(($Xi||is_string($y)?(string)$y:$X)===$mh?' selected':'').'>'.h($X);if(is_array($W))$H.='</optgroup>';}return$H;}function
html_select($B,$Df,$Y="",$xf=true,$re=""){if($xf)return"<select name='".h($B)."'".($re?" aria-labelledby='$re'":"").">".optionlist($Df,$Y)."</select>".(is_string($xf)?script("qsl('select').onchange = function () { $xf };",""):"");$H="";foreach($Df
as$y=>$X)$H.="<label><input type='radio' name='".h($B)."' value='".h($y)."'".($y==$Y?" checked":"").">".h($X)."</label>";return$H;}function
select_input($Ja,$Df,$Y="",$xf="",$jg=""){$di=($Df?"select":"input");return"<$di$Ja".($Df?"><option value=''>$jg".optionlist($Df,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$jg'>").($xf?script("qsl('$di').onchange = $xf;",""):"");}function
confirm($Re="",$nh="qsl('input')"){return
script("$nh.onclick = function () { return confirm('".($Re?js_escape($Re):'Are you sure?')."'); };","");}function
print_fieldset($t,$ye,$ij=false){echo"<fieldset><legend>","<a href='#fieldset-$t'>$ye</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$t');",""),"</legend>","<div id='fieldset-$t'".($ij?"":" class='hidden'").">\n";}function
bold($Wa,$kb=""){return($Wa?" class='active $kb'":($kb?" class='$kb'":""));}function
odd($H=' class="odd"'){static$s=0;if(!$H)$s=-1;return($s++%2?$H:'');}function
js_escape($P){return
addcslashes($P,"\r\n'\\/");}function
json_row($y,$X=null){static$cd=true;if($cd)echo"{";if($y!=""){echo($cd?"":",")."\n\t\"".addcslashes($y,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$cd=false;}else{echo"\n}\n";$cd=true;}}function
ini_bool($Wd){$X=ini_get($Wd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$H;if($H===null)$H=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$H;}function
set_password($ej,$M,$V,$E){$_SESSION["pwds"][$ej][$M][$V]=($_COOKIE["adminer_key"]&&is_string($E)?array(encrypt_string($E,$_COOKIE["adminer_key"])):$E);}function
get_password(){$H=get_session("pwds");if(is_array($H))$H=($_COOKIE["adminer_key"]?decrypt_string($H[0],$_COOKIE["adminer_key"]):false);return$H;}function
q($P){global$g;return$g->quote($P);}function
get_vals($F,$e=0){global$g;$H=array();$G=$g->query($F);if(is_object($G)){while($I=$G->fetch_row())$H[]=$I[$e];}return$H;}function
get_key_vals($F,$h=null,$vh=true){global$g;if(!is_object($h))$h=$g;$H=array();$G=$h->query($F);if(is_object($G)){while($I=$G->fetch_row()){if($vh)$H[$I[0]]=$I[1];else$H[]=$I[0];}}return$H;}function
get_rows($F,$h=null,$n="<p class='error'>"){global$g;$yb=(is_object($h)?$h:$g);$H=array();$G=$yb->query($F);if(is_object($G)){while($I=$G->fetch_assoc())$H[]=$I;}elseif(!$G&&!is_object($h)&&$n&&defined("PAGE_HEADER"))echo$n.error()."\n";return$H;}function
unique_array($I,$w){foreach($w
as$v){if(preg_match("~PRIMARY|UNIQUE~",$v["type"])){$H=array();foreach($v["columns"]as$y){if(!isset($I[$y]))continue
2;$H[$y]=$I[$y];}return$H;}}}function
escape_key($y){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$y,$A))return$A[1].idf_escape(idf_unescape($A[2])).$A[3];return
idf_escape($y);}function
where($Z,$p=array()){global$g,$x;$H=array();foreach((array)$Z["where"]as$y=>$X){$y=bracket_escape($y,1);$e=escape_key($y);$H[]=$e.($x=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):($x=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($p[$y],q($X))));if($x=="sql"&&preg_match('~char|text~',$p[$y]["type"])&&preg_match("~[^ -@]~",$X))$H[]="$e = ".q($X)." COLLATE ".charset($g)."_bin";}foreach((array)$Z["null"]as$y)$H[]=escape_key($y)." IS NULL";return
implode(" AND ",$H);}function
where_check($X,$p=array()){parse_str($X,$db);remove_slashes(array(&$db));return
where($db,$p);}function
where_link($s,$e,$Y,$_f="="){return"&where%5B$s%5D%5Bcol%5D=".urlencode($e)."&where%5B$s%5D%5Bop%5D=".urlencode(($Y!==null?$_f:"IS NULL"))."&where%5B$s%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($f,$p,$K=array()){$H="";foreach($f
as$y=>$X){if($K&&!in_array(idf_escape($y),$K))continue;$Ga=convert_field($p[$y]);if($Ga)$H.=", $Ga AS ".idf_escape($y);}return$H;}function
cookie($B,$Y,$Ae=2592000){global$ba;return
header("Set-Cookie: $B=".urlencode($Y).($Ae?"; expires=".gmdate("D, d M Y H:i:s",time()+$Ae)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($ba?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($hd=false){$Wi=ini_bool("session.use_cookies");if(!$Wi||$hd){session_write_close();if($Wi&&@ini_set("session.use_cookies",false)===false)session_start();}}function&get_session($y){return$_SESSION[$y][DRIVER][SERVER][$_GET["username"]];}function
set_session($y,$X){$_SESSION[$y][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($ej,$M,$V,$l=null){global$jc;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($jc))."|username|".($l!==null?"db|":"").session_name()),$A);return"$A[1]?".(sid()?SID."&":"").($ej!="server"||$M!=""?urlencode($ej)."=".urlencode($M)."&":"")."username=".urlencode($V).($l!=""?"&db=".urlencode($l):"").($A[2]?"&$A[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($Ce,$Re=null){if($Re!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($Ce!==null?$Ce:$_SERVER["REQUEST_URI"]))][]=$Re;}if($Ce!==null){if($Ce=="")$Ce=".";header("Location: $Ce");exit;}}function
query_redirect($F,$Ce,$Re,$Ig=true,$Ic=true,$Tc=false,$li=""){global$g,$n,$b;if($Ic){$Kh=microtime(true);$Tc=!$g->query($F);$li=format_time($Kh);}$Fh="";if($F)$Fh=$b->messageQuery($F,$li,$Tc);if($Tc){$n=error().$Fh.script("messagesPrint();");return
false;}if($Ig)redirect($Ce,$Re.$Fh);return
true;}function
queries($F){global$g;static$Bg=array();static$Kh;if(!$Kh)$Kh=microtime(true);if($F===null)return
array(implode("\n",$Bg),format_time($Kh));$Bg[]=(preg_match('~;$~',$F)?"DELIMITER ;;\n$F;\nDELIMITER ":$F).";";return$g->query($F);}function
apply_queries($F,$S,$Ec='table'){foreach($S
as$Q){if(!queries("$F ".$Ec($Q)))return
false;}return
true;}function
queries_redirect($Ce,$Re,$Ig){list($Bg,$li)=queries(null);return
query_redirect($Bg,$Ce,$Re,$Ig,false,!$Ig,$li);}function
format_time($Kh){return
sprintf('%.3f s',max(0,microtime(true)-$Kh));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($Tf=""){return
substr(preg_replace("~(?<=[?&])($Tf".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
pagination($D,$Ob){return" ".($D==$Ob?$D+1:'<a href="'.h(remove_from_uri("page").($D?"&page=$D".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($D+1)."</a>");}function
get_file($y,$Wb=false){$Zc=$_FILES[$y];if(!$Zc)return
null;foreach($Zc
as$y=>$X)$Zc[$y]=(array)$X;$H='';foreach($Zc["error"]as$y=>$n){if($n)return$n;$B=$Zc["name"][$y];$ti=$Zc["tmp_name"][$y];$Db=file_get_contents($Wb&&preg_match('~\.gz$~',$B)?"compress.zlib://$ti":$ti);if($Wb){$Kh=substr($Db,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Kh,$Og))$Db=iconv("utf-16","utf-8",$Db);elseif($Kh=="\xEF\xBB\xBF")$Db=substr($Db,3);$H.=$Db."\n\n";}else$H.=$Db;}return$H;}function
upload_error($n){$Oe=($n==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($n?'Unable to upload a file.'.($Oe?" ".sprintf('Maximum allowed file size is %sB.',$Oe):""):'File does not exist.');}function
repeat_pattern($gg,$ze){return
str_repeat("$gg{0,65535}",$ze/65535)."$gg{0,".($ze%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($P,$ze=80,$Rh=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$ze).")($)?)u",$P,$A))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$ze).")($)?)",$P,$A);return
h($A[1]).$Rh.(isset($A[2])?"":"<i>â€¦</i>");}function
format_number($X){return
strtr(number_format($X,0,".",','),preg_split('~~u','0123456789',-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($xg,$Ld=array(),$pg=''){$H=false;foreach($xg
as$y=>$X){if(!in_array($y,$Ld)){if(is_array($X))hidden_fields($X,array(),$y);else{$H=true;echo'<input type="hidden" name="'.h($pg?$pg."[$y]":$y).'" value="'.h($X).'">';}}}return$H;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($Q,$Uc=false){$H=table_status($Q,$Uc);return($H?$H:array("Name"=>$Q));}function
column_foreign_keys($Q){global$b;$H=array();foreach($b->foreignKeys($Q)as$q){foreach($q["source"]as$X)$H[$X][]=$q;}return$H;}function
enum_input($T,$Ja,$o,$Y,$yc=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Je);$H=($yc!==null?"<label><input type='$T'$Ja value='$yc'".((is_array($Y)?in_array($yc,$Y):$Y===0)?" checked":"")."><i>".'empty'."</i></label>":"");foreach($Je[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$fb=(is_int($Y)?$Y==$s+1:(is_array($Y)?in_array($s+1,$Y):$Y===$X));$H.=" <label><input type='$T'$Ja value='".($s+1)."'".($fb?' checked':'').'>'.h($b->editVal($X,$o)).'</label>';}return$H;}function
input($o,$Y,$r){global$U,$b,$x;$B=h(bracket_escape($o["field"]));echo"<td class='function'>";if(is_array($Y)&&!$r){$Ea=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$Ea[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$Ea);$r="json";}$Sg=($x=="mssql"&&$o["auto_increment"]);if($Sg&&!$_POST["save"])$r=null;$qd=(isset($_GET["select"])||$Sg?array("orig"=>'original'):array())+$b->editFunctions($o);$Ja=" name='fields[$B]'";if($o["type"]=="enum")echo
h($qd[""])."<td>".$b->editInput($_GET["edit"],$o,$Ja,$Y);else{$_d=(in_array($r,$qd)||isset($qd[$r]));echo(count($qd)>1?"<select name='function[$B]'>".optionlist($qd,$r===null||$_d?$r:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($qd))).'<td>';$Yd=$b->editInput($_GET["edit"],$o,$Ja,$Y);if($Yd!="")echo$Yd;elseif(preg_match('~bool~',$o["type"]))echo"<input type='hidden'$Ja value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Ja value='1'>";elseif($o["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$o["length"],$Je);foreach($Je[1]as$s=>$X){$X=stripcslashes(str_replace("''","'",$X));$fb=(is_int($Y)?($Y>>$s)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$B][$s]' value='".(1<<$s)."'".($fb?' checked':'').">".h($b->editVal($X,$o)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$B'>";elseif(($ji=preg_match('~text|lob|memo~i',$o["type"]))||preg_match("~\n~",$Y)){if($ji&&$x!="sqlite")$Ja.=" cols='50' rows='12'";else{$J=min(12,substr_count($Y,"\n")+1);$Ja.=" cols='30' rows='$J'".($J==1?" style='height: 1.2em;'":"");}echo"<textarea$Ja>".h($Y).'</textarea>';}elseif($r=="json"||preg_match('~^jsonb?$~',$o["type"]))echo"<textarea$Ja cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Qe=(!preg_match('~int~',$o["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$o["length"],$A)?((preg_match("~binary~",$o["type"])?2:1)*$A[1]+($A[3]?1:0)+($A[2]&&!$o["unsigned"]?1:0)):($U[$o["type"]]?$U[$o["type"]]+($o["unsigned"]?0:1):0));if($x=='sql'&&min_version(5.6)&&preg_match('~time~',$o["type"]))$Qe+=7;echo"<input".((!$_d||$r==="")&&preg_match('~(?<!o)int(?!er)~',$o["type"])&&!preg_match('~\[\]~',$o["full_type"])?" type='number'":"")." value='".h($Y)."'".($Qe?" data-maxlength='$Qe'":"").(preg_match('~char|binary~',$o["type"])&&$Qe>20?" size='40'":"")."$Ja>";}echo$b->editHint($_GET["edit"],$o,$Y);$cd=0;foreach($qd
as$y=>$X){if($y===""||!$X)break;$cd++;}if($cd)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $cd), oninput: function () { this.onchange(); }});");}}function
process_input($o){global$b,$m;$u=bracket_escape($o["field"]);$r=$_POST["function"][$u];$Y=$_POST["fields"][$u];if($o["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($o["auto_increment"]&&$Y=="")return
null;if($r=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?idf_escape($o["field"]):false);if($r=="NULL")return"NULL";if($o["type"]=="set")return
array_sum((array)$Y);if($r=="json"){$r="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$o["type"])&&ini_bool("file_uploads")){$Zc=get_file("fields-$u");if(!is_string($Zc))return
false;return$m->quoteBinary($Zc);}return$b->processInput($o,$Y,$r);}function
fields_from_edit(){global$m;$H=array();foreach((array)$_POST["field_keys"]as$y=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$y];$_POST["fields"][$X]=$_POST["field_vals"][$y];}}foreach((array)$_POST["fields"]as$y=>$X){$B=bracket_escape($y,1);$H[$B]=array("field"=>$B,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($y==$m->primary),);}return$H;}function
search_tables(){global$b,$g;$_GET["where"][0]["val"]=$_POST["query"];$ph="<ul>\n";foreach(table_status('',true)as$Q=>$R){$B=$b->tableName($R);if(isset($R["Engine"])&&$B!=""&&(!$_POST["tables"]||in_array($Q,$_POST["tables"]))){$G=$g->query("SELECT".limit("1 FROM ".table($Q)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($Q),array())),1));if(!$G||$G->fetch_row()){$tg="<a href='".h(ME."select=".urlencode($Q)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$B</a>";echo"$ph<li>".($G?$tg:"<p class='error'>$tg: ".error())."\n";$ph="";}}}echo($ph?"<p class='message'>".'No tables.':"</ul>")."\n";}function
dump_headers($Id,$af=false){global$b;$H=$b->dumpHeaders($Id,$af);$Qf=$_POST["output"];if($Qf!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Id).".$H".($Qf!="file"&&preg_match('~^[0-9a-z]+$~',$Qf)?".$Qf":""));session_write_close();ob_flush();flush();return$H;}function
dump_csv($I){foreach($I
as$y=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$I[$y]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$I)."\r\n";}function
apply_sql_function($r,$e){return($r?($r=="unixepoch"?"DATETIME($e, '$r')":($r=="count distinct"?"COUNT(DISTINCT ":strtoupper("$r("))."$e)"):$e);}function
get_temp_dir(){$H=ini_get("upload_tmp_dir");if(!$H){if(function_exists('sys_get_temp_dir'))$H=sys_get_temp_dir();else{$ad=@tempnam("","");if(!$ad)return
false;$H=dirname($ad);unlink($ad);}}return$H;}function
file_open_lock($ad){$od=@fopen($ad,"r+");if(!$od){$od=@fopen($ad,"w");if(!$od)return;chmod($ad,0660);}flock($od,LOCK_EX);return$od;}function
file_write_unlock($od,$Qb){rewind($od);fwrite($od,$Qb);ftruncate($od,strlen($Qb));flock($od,LOCK_UN);fclose($od);}function
password_file($i){$ad=get_temp_dir()."/adminer.key";$H=@file_get_contents($ad);if($H||!$i)return$H;$od=@fopen($ad,"w");if($od){chmod($ad,0660);$H=rand_string();fwrite($od,$H);fclose($od);}return$H;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$_,$o,$ki){global$b;if(is_array($X)){$H="";foreach($X
as$je=>$W)$H.="<tr>".($X!=array_values($X)?"<th>".h($je):"")."<td>".select_value($W,$_,$o,$ki);return"<table cellspacing='0'>$H</table>";}if(!$_)$_=$b->selectLink($X,$o);if($_===null){if(is_mail($X))$_="mailto:$X";if(is_url($X))$_=$X;}$H=$b->editVal($X,$o);if($H!==null){if(!is_utf8($H))$H="\0";elseif($ki!=""&&is_shortable($o))$H=shorten_utf8($H,max(0,+$ki));else$H=h($H);}return$b->selectVal($H,$_,$o,$X);}function
is_mail($vc){$Ha='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$ic='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$gg="$Ha+(\\.$Ha+)*@($ic?\\.)+$ic";return
is_string($vc)&&preg_match("(^$gg(,\\s*$gg)*\$)i",$vc);}function
is_url($P){$ic='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($ic?\\.)+$ic(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$P);}function
is_shortable($o){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$o["type"]);}function
count_rows($Q,$Z,$ee,$td){global$x;$F=" FROM ".table($Q).($Z?" WHERE ".implode(" AND ",$Z):"");return($ee&&($x=="sql"||count($td)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$td).")$F":"SELECT COUNT(*)".($ee?" FROM (SELECT 1$F GROUP BY ".implode(", ",$td).") x":$F));}function
slow_query($F){global$b,$vi,$m;$l=$b->database();$mi=$b->queryTimeout();$_h=$m->slowQuery($F,$mi);if(!$_h&&support("kill")&&is_object($h=connect())&&($l==""||$h->select_db($l))){$oe=$h->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$oe,'&token=',$vi,'\');
}, ',1000*$mi,');
</script>
';}else$h=null;ob_flush();flush();$H=@get_key_vals(($_h?$_h:$F),$h,false);if($h){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$H;}function
get_token(){$Eg=rand(1,1e6);return($Eg^$_SESSION["token"]).":$Eg";}function
verify_token(){list($vi,$Eg)=explode(":",$_POST["token"]);return($Eg^$_SESSION["token"])==$vi;}function
lzw_decompress($Sa){$fc=256;$Ta=8;$mb=array();$Ug=0;$Vg=0;for($s=0;$s<strlen($Sa);$s++){$Ug=($Ug<<8)+ord($Sa[$s]);$Vg+=8;if($Vg>=$Ta){$Vg-=$Ta;$mb[]=$Ug>>$Vg;$Ug&=(1<<$Vg)-1;$fc++;if($fc>>$Ta)$Ta++;}}$ec=range("\0","\xFF");$H="";foreach($mb
as$s=>$lb){$uc=$ec[$lb];if(!isset($uc))$uc=$tj.$tj[0];$H.=$uc;if($s)$ec[]=$tj.$uc[0];$tj=$uc;}return$H;}function
on_help($sb,$xh=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $sb, $xh) }, onmouseout: helpMouseout});","");}function
edit_form($a,$p,$I,$Qi){global$b,$x,$vi,$n;$Wh=$b->tableName(table_status1($a,true));page_header(($Qi?'Edit':'Insert'),$n,array("select"=>array($a,$Wh)),$Wh);if($I===false)echo"<p class='error'>".'No rows.'."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$p)echo"<p class='error'>".'You have no privileges to update this table.'."\n";else{echo"<table cellspacing='0' class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($p
as$B=>$o){echo"<tr><th>".$b->fieldName($o);$Xb=$_GET["set"][bracket_escape($B)];if($Xb===null){$Xb=$o["default"];if($o["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Xb,$Og))$Xb=$Og[1];}$Y=($I!==null?($I[$B]!=""&&$x=="sql"&&preg_match("~enum|set~",$o["type"])?(is_array($I[$B])?array_sum($I[$B]):+$I[$B]):$I[$B]):(!$Qi&&$o["auto_increment"]?"":(isset($_GET["select"])?false:$Xb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$o);$r=($_POST["save"]?(string)$_POST["function"][$B]:($Qi&&preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(preg_match("~time~",$o["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$r="now";}input($o,$Y,$r);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($p){echo"<input type='submit' value='".'Save'."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Qi?'Save and continue edit':'Save and insert next')."' title='Ctrl+Shift+Enter'>\n",($Qi?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".'Saving'."â€¦', this); };"):"");}}echo($Qi?"<input type='submit' name='delete' value='".'Delete'."'>".confirm()."\n":($_POST||!$p?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$vi,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0„\0\n @\0´C„è\"\0`EãQ¸àÿ‡?ÀtvM'”JdÁd\\Œb0\0Ä\"™ÀfÓˆ¤îs5›ÏçÑAXPaJ“0„¥‘8„#RŠT©‘z`ˆ#.©ÇcíXÃşÈ€?À-\0¡Im? .«M¶€\0È¯(Ì‰ıÀ/(%Œ\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1Ì‡“ÙŒŞl7œ‡B1„4vb0˜Ífs‘¼ên2BÌÑ±Ù˜Şn:‡#(¼b.\rDc)ÈÈa7E„‘¤Âl¦Ã±”èi1Ìs˜´ç-4™‡fÓ	ÈÎi7†³¹¤Èt4…¦ÓyèZf4°i–AT«VVéf:Ï¦,:1¦Qİ¼ñb2`Ç#ş>:7Gï—1ÑØÒs°™L—XD*bv<ÜŒ#£e@Ö:4ç§!fo·Æt:<¥Üå’¾™oâÜ\niÃÅğ',é»a_¤:¹iï…´ÁBvø|Nû4.5Nfi¢vpĞh¸°l¨ê¡ÖšÜO¦‰î= £OFQĞÄk\$¥Óiõ™ÀÂd2Tã¡pàÊ6„‹ş‡¡-ØZ€ƒ Ş6½£€ğh:¬aÌ,£ëî2#8Ğ±#’˜6nâî†ñJˆ¢h«t…Œ±Šä4O42ô½okŞ¾*r ©€@p@†!Ä¾ÏÃôş?Ğ6À‰r[ğLÁğ‹:2Bˆj§!HbóÃPä=!1V‰\"ˆ²0…¿\nSÆÆÏD7ÃìDÚ›ÃC!†!›à¦GÊŒ§ È+’=tCæ©.C¤À:+ÈÊ=ªªº²¡±å%ªcí1MR/”EÈ’4„© 2°ä± ã`Â8(áÓ¹[WäÑ=‰ySb°=Ö-Ü¹BS+É¯ÈÜı¥ø@pL4Ydã„qŠøã¦ğê¢6£3Ä¬¯¸AcÜŒèÎ¨Œk‚[&>ö•¨ZÁpkm]—u-c:Ø¸ˆNtæÎ´pÒŒŠ8è=¿#˜á[.ğÜŞ¯~ mËy‡PPá|IÖ›ùÀìQª9v[–Q•„\n–Ùrô'g‡+áTÑ2…­VÁõzä4£8÷(	¾Ey*#j¬2]­•RÒÁ‘¥)ƒÀ[N­R\$Š<>:ó­>\$;–> Ì\r»„ÎHÍÃTÈ\nw¡N åwØ£¦ì<ïËGwàöö¹\\Yó_ Rt^Œ>\r}ŒÙS\rzé4=µ\nL”%Jã‹\",Z 8¸™i÷0u©?¨ûÑô¡s3#¨Ù‰ :ó¦ûã½–ÈŞE]xİÒs^8£K^É÷*0ÑŞwŞàÈŞ~ãö:íÑiØşv2w½ÿ±û^7ãò7£cİÑu+U%{PÜ*4Ì¼éLX./!¼‰1CÅßqx!H¹ãFdù­L¨¤¨Ä Ï`6ëè5®™f€¸Ä†¨=Høl ŒV1“›\0a2×;Ô6†àöş_Ù‡Ä\0&ôZÜS d)KE'’€nµ[X©³\0ZÉŠÔF[P‘Ş˜@àß!‰ñYÂ,`É\"Ú·Â0Ee9yF>ËÔ9bº–ŒæF5:üˆ”\0}Ä´Š‡(\$Ó‡ë€37Hö£è M¾A°²6R•ú{Mqİ7G ÚC™Cêm2¢(ŒCt>[ì-tÀ/&C›]êetGôÌ¬4@r>ÇÂå<šSq•/åú”QëhmšÀĞÆôãôLÀÜ#èôKË|®™„6fKPİ\r%tÔÓV=\" SH\$} ¸)w¡,W\0F³ªu@Øb¦9‚\rr°2Ã#¬DŒ”Xƒ³ÚyOIù>»…n†Ç¢%ãù'‹İ_Á€t\rÏ„zÄ\\1˜hl¼]Q5Mp6k†ĞÄqhÃ\$£H~Í|Òİ!*4ŒñòÛ`Sëı²S tíPP\\g±è7‡\n-Š:è¢ªp´•”ˆl‹B¦î”7Ó¨cƒ(wO0\\:•Ğw”Áp4ˆ“ò{TÚújO¤6HÃŠ¶rÕ¥q\n¦É%%¶y']\$‚”a‘ZÓ.fcÕq*-êFWºúk„zƒ°µj‘°lgáŒ:‡\$\"ŞN¼\r#ÉdâÃ‚ÂÿĞscá¬Ì „ƒ\"jª\rÀ¶–¦ˆÕ’¼Ph‹1/‚œDA) ²İ[ÀknÁp76ÁY´‰R{áM¤Pû°ò@\n-¸a·6şß[»zJH,–dl B£ho³ìò¬+‡#Dr^µ^µÙeš¼E½½– ÄœaP‰ôõJG£zàñtñ 2ÇXÙ¢´Á¿V¶×ßàŞÈ³‰ÑB_%K=E©¸bå¼¾ßÂ§kU(.!Ü®8¸œüÉI.@KÍxnş¬ü:ÃPó32«”míH		C*ì:vâTÅ\nR¹ƒ•µ‹0uÂíƒæîÒ§]Î¯˜Š”P/µJQd¥{L–Ş³:YÁ2b¼œT ñÊ3Ó4†—äcê¥V=¿†L4ÎĞrÄ!ßBğY³6Í­MeLŠªÜçœöùiÀoĞ9< G”¤Æ•Ğ™Mhm^¯UÛNÀŒ·òTr5HiM”/¬nƒí³T [-<__î3/Xr(<‡¯Š†®Éô“ÌuÒ–GNX20å\r\$^‡:'9è¶O…í;×k¼†µf –N'a¶”Ç­bÅ,ËV¤ô…«1µïHI!%6@úÏ\$ÒEGÚœ¬1(mUªå…rÕ½ïßå`¡ĞiN+Ãœñ)šœä0lØÒf0Ã½[UâøVÊè-:I^ ˜\$Øs«b\re‡‘ugÉhª~9Ûßˆb˜µôÂÈfä+0¬Ô hXrİ¬©!\$—e,±w+„÷ŒëŒ3†Ì_âA…kšù\nkÃrõÊ›cuWdYÿ\\×={.óÄ˜¢g»‰p8œt\rRZ¿vJ:²>ş£Y|+Å@À‡ƒÛCt\r€jt½6²ğ%Â?àôÇñ’>ù/¥ÍÇğÎ9F`×•äòv~K¤áöÑRĞW‹ğz‘êlmªwLÇ9Y•*q¬xÄzñèSe®İ›³è÷£~šDàÍá–÷x˜¾ëÉŸi7•2ÄøÑOİ»’û_{ñú53âút˜›_ŸõzÔ3ùd)‹C¯Â\$?KÓªP%ÏÏT&ş˜&\0P×NA^­~¢ƒ pÆ öÏœ“Ôõ\r\$ŞïĞÖìb*+D6ê¶¦ÏˆŞíJ\$(ÈolŞÍh&”ìKBS>¸‹ö;z¶¦xÅoz>íœÚoÄZğ\nÊ‹[Ïvõ‚ËÈœµ°2õOxÙVø0fû€ú¯Ş2BlÉbkĞ6ZkµhXcdê0*ÂKTâ¯H=­•Ï€‘p0ŠlVéõèâ\r¼Œ¥nm¦ï)((ô:#¦âòE‰Ü:C¨CàÚâ\r¨G\rÃ©0÷…iæÚ°ş:`Z1Q\n:€à\r\0àçÈq±°ü:`¿-ÈM#}1;èş¹‹q‘#|ñS€¾¢hl™DÄ\0fiDpëL ``™°çÑ0y€ß1…€ê\rñ=‘MQ\\¤³%oq–­\0Øñ£1¨21¬1°­ ¿±§Ñœbi:“í\r±/Ñ¢› `)šÄ0ù‘@¾Â›±ÃI1«NàCØàŠµñO±¢Zñã1±ïq1 òÑüà,å\rdIÇ¦väjí‚1 tÚBø“°â’0:…0ğğ“1 A2V„ñâ0 éñ%²fi3!&Q·Rc%Òq&w%Ñì\ràVÈ#Êø™Qw`‹% ¾„Òm*r…Òy&iß+r{*²»(rg(±#(2­(ğå)R@i›-  ˆ•1\"\0Û²Rêÿ.e.rëÄ,¡ry(2ªCàè²bì!BŞ3%Òµ,R¿1²Æ&èşt€äbèa\rL“³-3á Ö ó\0æóBp—1ñ94³O'R°3*²³=\$à[£^iI;/3i©5Ò&’}17²# Ñ¹8 ¿\"ß7Ñå8ñ9*Ò23™!ó!1\\\0Ï8“­rk9±;S…23¶àÚ“*Ó:q]5S<³Á#383İ#eÑ=¹>~9Sè³‘rÕ)€ŒT*aŸ@Ñ–ÙbesÙÔ£:-ó€éÇ*;, Ø™3!i´›‘LÒ²ğ#1 +nÀ «*²ã@³3i7´1©´_•F‘S;3ÏF±\rA¯é3õ>´x:ƒ \r³0ÎÔ@’-Ô/¬ÓwÓÛ7ñ„ÓS‘J3› ç.Fé\$O¤B’±—%4©+tÃ'góLq\rJt‡JôËM2\rôÍ7ñÆT@“£¾)â“£dÉ2€P>Î°€Fià²´ş\nr\0¸bçk(´D¶¿ãKQƒ¤´ã1ã\"2t”ôôºPè\rÃÀ,\$KCtò5ôö#ôú)¢áP#Pi.ÎU2µCæ~Ş\"ä");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:›ŒgCI¼Ü\n8œÅ3)°Ë7œ…†81ĞÊx:\nOg#)Ğêr7\n\"†è´`ø|2ÌgSi–H)N¦S‘ä§\r‡\"0¹Ä@ä)Ÿ`(\$s6O!ÓèœV/=Œ' T4æ=„˜iS˜6IO G#ÒX·VCÆs¡ Z1.Ğhp8,³[¦Häµ~Cz§Éå2¹l¾c3šÍés£‘ÙI†bâ4\néF8Tà†I˜İ©U*fz¹är0EÆÀØy¸ñfY.:æƒIŒÊ(Øc·áÎ‹!_l™í^·^(¶šN{S–“)rËqÁY“–lÙ¦3Š3Ú\n˜+G¥Óêyºí†Ëi¶ÂîxV3w³uhã^rØÀº´aÛ”ú¹cØè\r“¨ë(.ÂˆºChÒ<\r)èÑ£¡`æ7£íò43'm5Œ£È\nPÜ:2£P»ª‹q òÿÅC“}Ä«ˆúÊÁê38‹BØ0hR‰Èr(œ0¥¡b\\0ŒHr44ŒÁB!¡pÇ\$rZZË2Ü‰.Éƒ(\\5Ã|\nC(Î\"€P…ğø.ĞNÌRTÊÎ“Àæ>HN…8HPá\\¬7Jp~„Üû2%¡ĞOC¨1ã.ƒ§C8Î‡HÈò*ˆj°…á÷S(¹/¡ì¬6KUœÊ‡¡<2‰pOI„ôÕ`Ôäâ³ˆdOH Ş5-üÆ4ŒãpX25-Ò¢òÛˆ°z7£¸\"(°P \\32:]UÚèíâß…!]¸<·AÛÛ¤’ĞßiÚ°‹l\rÔ\0v²Î#J8«ÏwmíÉ¤¨<ŠÉ æü%m;p#ã`XDŒø÷iZøN0Œ•È9ø¨å Áè`…wJD¿¾2Ò9tŒ¢*øÎyìËNiIh\\9ÆÕèĞ:ƒ€æáxï­µyl*šÈˆÎæY Ü‡øê8’W³â?µŞ›3ÙğÊ!\"6å›n[¬Ê\r­*\$¶Æ§¾nzxÆ9\rì|*3×£pŞï»¶:(p\\;ÔËmz¢ü§9óĞÑÂŒü8N…Áj2½«Î\rÉHîH&Œ²(Ãz„Á7iÛk£ ‹Š¤‚c¤‹eòı§tœÌÌ2:SHóÈ Ã/)–xŞ@éåt‰ri9¥½õëœ8ÏÀËïyÒ·½°VÄ+^WÚ¦­¬kZæY—l·Ê£Œ4ÖÈÆ‹ª¶À¬‚ğ\\EÈ{î7\0¹p†€•D€„i”-TæşÚû0l°%=Á ĞËƒ9(„5ğ\n\n€n,4‡\0èa}Üƒ.°öRsï‚ª\02B\\Ûb1ŸS±\0003,ÔXPHJspåd“Kƒ CA!°2*WŸÔñÚ2\$ä+Âf^\n„1Œ´òzEƒ Iv¤\\äœ2É .*A°™”E(d±á°ÃbêÂÜ„Æ9‡‚â€ÁDh&­ª?ÄH°sQ˜2’x~nÃJ‹T2ù&ãàeRœ½™GÒQTwêİ‘»õPˆâã\\ )6¦ôâœÂòsh\\3¨\0R	À'\r+*;RğHà.“!Ñ[Í'~­%t< çpÜK#Â‘æ!ñlßÌğLeŒ³œÙ,ÄÀ®&á\$	Á½`”–CXš‰Ó†0Ö­å¼û³Ä:Méh	çÚœGäÑ!&3 D<!è23„Ã?h¤J©e Úğhá\r¡m•˜ğNi¸£´’†ÊNØHl7¡®v‚êWIå.´Á-Ó5Ö§ey\rEJ\ni*¼\$@ÚRU0,\$U¿E†¦ÔÔÂªu)@(tÎSJkáp!€~­‚àd`Ì>¯•\nÃ;#\rp9†jÉ¹Ü]&Nc(r€ˆ•TQUª½S·Ú\08n`«—y•b¤ÅLÜO5‚î,¤ò‘>‚†xââ±fä´’âØ+–\"ÑI€{kMÈ[\r%Æ[	¤eôaÔ1! èÿí³Ô®©F@«b)RŸ£72ˆî0¡\nW¨™±L²ÜœÒ®tdÕ+íÜ0wglø0n@òêÉ¢ÕiíM«ƒ\nA§M5nì\$E³×±NÛál©İŸ×ì%ª1 AÜûºú÷İkñrîiFB÷Ïùol,muNx-Í_ Ö¤C( fél\r1p[9x(i´BÒ–²ÛzQlüº8CÔ	´©XU Tb£İIİ`•p+V\0î‹Ñ;‹CbÎÀXñ+Ï’sïü]H÷Ò[ák‹x¬G*ô†]·awnú!Å6‚òâÛĞmSí¾“IŞÍKË~/Ó¥7ŞùeeNÉòªS«/;dåA†>}l~Ïê ¨%^´fçØ¢pÚœDEîÃa·‚t\nx=ÃkĞ„*dºêğT—ºüûj2ŸÉjœ\n‘ É ,˜e=‘†M84ôûÔa•j@îTÃsÔänf©İ\nî6ª\rdœ¼0ŞíôYŠ'%Ô“íŞ~	Ò¨†<ÖË–Aî‹–H¿G‚8ñ¿Îƒ\$z«ğ{¶»²u2*†àa–À>»(wŒK.bP‚{…ƒoı”Â´«zµ#ë2ö8=É8>ª¤³A,°e°À…+ìCè§xõ*ÃáÒ-b=m‡™Ÿ,‹a’Ãlzkï\$Wõ,mJiæÊ§á÷+‹èı0°[¯ÿ.RÊsKùÇäXçİZLËç2`Ì(ïCàvZ¡ÜİÀ¶è\$×¹,åD?H±ÖNxXôó)’îM¨‰\$ó,Í*\nÑ£\$<qÿÅŸh!¿¹S“âƒÀŸxsA!˜:´K¥Á}Á²“ù¬£œRşšA2k·Xp\n<÷ş¦ıëlì§Ù3¯ø¦È•VV¬}£g&Yİ!†+ó;<¸YÇóŸYE3r³Ùñ›Cío5¦Åù¢Õ³Ïkkş…ø°ÖÛ£«Ït÷’Uø…­)û[ıßÁî}ïØu´«lç¢:DŸø+Ï _oãäh140ÖáÊ0ø¯bäK˜ã¬’ öşé»lGª„#ªš©ê†¦©ì|Udæ¶IK«êÂ7à^ìà¸@º®O\0HÅğHiŠ6\r‡Û©Ü\\cg\0öãë2BÄ*eà\n€š	…zr!nWz& {H–ğ'\$X  w@Ò8ëDGr*ëÄİHå'p#Ä®€¦Ô\ndü€÷,ô¥—,ü;g~¯\0Ğ#€Ì²EÂ\rÖI`œî'ƒğ%EÒ. ]`ÊĞ›…î%&Ğîm°ı\râŞ%4S„vğ#\n fH\$%ë-Â#­ÆÑqBâíæ ÀÂQ-ôc2Š§‚&ÂÀÌ]à™ èqh\rñl]à®s ĞÑhä7±n#±‚‚Ú-àjE¯Frç¤l&dÀØÙåzìF6¸ˆÁ\" “|¿§¢s@ß±®åz)0rpÚ\0‚X\0¤Ùè|DL<!°ôo„*‡D¶{.B<Eª‹‹0nB(ï |\r\nì^©à h³!‚Öêr\$§’(^ª~èŞÂ/pq²ÌB¨ÅOšˆğú,\\µ¨#RRÎ%ëäÍdĞHjÄ`Â ô®Ì­ Vå bS’d§iE‚øïoh´r<i/k\$-Ÿ\$o”¼+ÆÅ‹ÎúlÒŞO³&evÆ’¼iÒjMPA'u'Î’( M(h/+«òWD¾So·.n·.ğn¸ìê(œ(\"­À§hö&p†¨/Ë/1DÌŠçjå¨¸EèŞ&â¦€,'l\$/.,Äd¨…‚W€bbO3óB³sH :J`!“.€ª‚‡Àû¥ ,FÀÑ7(‡ÈÔ¿³û1Šlås ÖÒ‘²—Å¢q¢X\rÀš®ƒ~Ré°±`®Òó®Y*ä:R¨ùrJ´·%LÏ+n¸\"ˆø\r¦ÎÍ‡H!qb¾2âLi±%ÓŞÎ¨Wj#9ÓÔObE.I:…6Á7\0Ë6+¤%°.È…Ş³a7E8VSå?(DG¨Ó³Bë%;ò¬ùÔ/<’´ú¥À\r ì´>ûMÀ°@¶¾€H DsĞ°Z[tH£Enx(ğŒ©R xñû@¯şGkjW”>ÌÂÚ#T/8®c8éQ0Ëè_ÔIIGII’!¥ğŠYEdËE´^tdéthÂ`DV!Cæ8¥\r­´Ÿb“3©!3â@Ù33N}âZBó3	Ï3ä30ÚÜM(ê>‚Ê}ä\\Ñtê‚f fŒËâI\r®€ó337 XÔ\"tdÎ,\nbtNO`Pâ;­Ü•Ò­ÀÔ¯\$\n‚ßäZÑ­5U5WUµ^hoıàætÙPM/5K4Ej³KQ&53GX“Xx)Ò<5D…\rûVô\nßr¢5bÜ€\\J\">§è1S\r[-¦ÊDuÀ\rÒâ§Ã)00óYõÈË¢·k{\nµÄ#µŞ\r³^·‹|èuÜ»Uå_nïU4ÉUŠ~YtÓ\rIšÃ@ä³™R ó3:ÒuePMSè0TµwW¯XÈòòD¨ò¤KOUÜà•‡;Uõ\n OYéYÍQ,M[\0÷_ªDšÍÈW ¾J*ì\rg(]à¨\r\"ZC‰©6uê+µYóˆY6Ã´0ªqõ(Ùó8}ó3AX3T h9j¶jàfõMtåPJbqMP5>ğÈø¶©Y‡k%&\\‚1d¢ØE4À µYnÊí\$<¥U]Ó‰1‰mbÖ¶^Òõš ê\"NVéßp¶ëpõ±eMÚŞ×WéÜ¢î\\ä)\n Ë\nf7\n×2´õr8‹—=Ek7tVš‡µ7P¦¶LÉía6òòv@'‚6iàïj&>±â;­ã`Òÿa	\0pÚ¨(µJÑë)«\\¿ªnûòÄ¬m\0¼¨2€ôeqJö­PôtŒë±fjüÂ\"[\0¨·†¢X,<\\Œî¶×â÷æ·+md†å~âàš…Ñs%o°´mn×),×„æÔ‡²\r4¶Â8\r±Î¸×mE‚H]‚¦˜üÖHW­M0Dïß€—å~Ë˜K˜îE}ø¸´à|fØ^“Ü×\r>Ô-z]2s‚xD˜d[s‡tS¢¶\0Qf-K`­¢‚tàØ„wT¯9€æZ€à	ø\nB£9 Nb–ã<ÚBşI5o×oJñpÀÏJNdåË\rhŞÃ2\"àxæHCàİ–:øı9Yn16Æôzr+z±ùş\\’÷•œôm Ş±T öò ÷@Y2lQ<2O+¥%“Í.Óƒhù0AŞñ¸ŠÃZ‹2R¦À1£Š/¯hH\r¨X…ÈaNB&§ ÄM@Ö[xŒ‡Ê®¥ê–â8&LÚVÍœvà±*šj¤ÛšGHåÈ\\Ù®	™²¶&sÛ\0Qš \\\"èb °	àÄ\rBs›Éw‚	ÙáBN`š7§Co(ÙÃà¨\nÃ¨“¨1š9Ì*E˜ ñS…ÓU0Uº tš'|”m™°Ş?h[¢\$.#É5	 å	p„àyBà@Rô]£…ê@|„§{™ÀÊP\0xô/¦ w¢%¤EsBd¿§šCUš~O×·àPà@Xâ]Ô…¨Z3¨¥1¦¥{©eLY‰¡ŒÚ¢\\’(*R` 	à¦\n…ŠàºÌQCFÈ*¹¹àéœ¬Úp†X|`N¨‚¾\$€[†‰’@ÍU¢àğ¦¶àZ¥`Zd\"\\\"…‚¢£)«‡Iˆ:ètšìoDæ\0[²¨à±‚-©“ gí³‰™®*`hu%£,€”¬ãIµ7Ä«²Hóµm¤6Ş}®ºNÖÍ³\$»MµUYf&1ùÀ›e]pz¥§ÚI¤Åm¶G/£ ºw Ü!•\\#5¥4I¥d¹EÂhq€å¦÷Ñ¬kçx|Úk¥qDšb…z?§º‰>úƒ¾:†“[èLÒÆ¬Z°Xš®:¹„·ÚÇjßw5	¶Y¾0 ©Â“­¯\$\0C¢†dSg¸ë‚ {@”\n`	ÀÃüC ¢·»Mºµâ»²# t}xÎN„÷º‡{ºÛ°)êûCƒÊFKZŞj™Â\0PFY”BäpFk–›0<Ú>ÊD<JE™šg\rõ.“2–ü8éU@*Î5fkªÌJDìÈÉ4•TDU76É/´è¯@·‚K+„ÃöJ®ºÃÂí@Ó=ŒÜWIOD³85MšNº\$Rô\0ø5¨\ràù_ğªœìEœñÏI«Ï³Nçl£Òåy\\ô‘ˆÇqU€ĞQû ª\n@’¨€ÛºÃpš¬¨PÛ±«7Ô½N\rıR{*qmİ\$\0R”×Ô“ŠÅåqĞÃˆ+U@ŞB¤çOf*†CË¬ºMCä`_ èüò½ËµNêæTâ5Ù¦C×»© ¸à\\WÃe&_XŒ_Øhå—ÂÆBœ3ÀŒÛ%ÜFW£û|™GŞ›'Å[¯Å‚À°ÙÕV Ğ#^\rç¦GR€¾˜€P±İFg¢ûî¯ÀYi û¥Çz\nâ¨Ş+ß^/“¨€‚¼¥½\\•6èßb¼dmh×â@qíÕAhÖ),J­×W–Çcm÷em]ÓeÏkZb0ßåşYñ]ymŠè‡fØe¹B;¹ÓêOÉÀwŸapDWûŒÉÜÓ{›\0˜À-2/bN¬sÖ½Ş¾Ra“Ï®h&qt\n\"ÕiöRmühzÏeø†àÜFS7µĞPPòä–¤âÜ:B§ˆâÕsm¶­Y düŞò7}3?*‚túòéÏlTÚ}˜~€„€ä=cı¬ÖŞÇ	Ú3…;T²LŞ5*	ñ~#µA•¾ƒ‘sx-7÷f5`Ø#\"NÓb÷¯G˜Ÿ‹õ@Üeü[ïø¤Ìs‘˜€¸-§˜M6§£qqš h€e5…\0Ò¢À±ú*àbøISÜÉÜFÎ®9}ıpÓ-øı`{ı±É–kP˜0T<„©Z9ä0<Õš\r­€;!Ãˆgº\r\nKÔ\n•‡\0Á°*½\nb7(À_¸@,îe2\rÀ]–K…+\0Éÿp C\\Ñ¢,0¬^îMĞ§šº©“@Š;X\r•ğ?\$\r‡j’+ö/´¬BöæP ½‰ù¨J{\"aÍ6˜ä‰œ¹|å£\n\0»à\\5“Ğ	156ÿ† .İ[ÂUØ¯\0dè²8Yç:!Ñ²‘=ºÀX.²uCªŠŒö!Sº¸‡o…pÓBİüÛ7¸­Å¯¡Rh­\\h‹E=úy:< :u³ó2µ80“si¦ŸTsBÛ@\$ Íé@Çu	ÈQº¦.ô‚T0M\\/ê€d+Æƒ\n‘¡=Ô°dŒÅëA¢¸¢)\r@@Âh3€–Ù8.eZa|.â7YkĞcÀ˜ñ–'D#‡¨Yò@Xq–=M¡ï44šB AM¤¯dU\"‹Hw4î(>‚¬8¨²ÃC¸?e_`ĞÅX:ÄA9Ã¸™ôp«GĞä‡Gy6½ÃF“Xr‰¡l÷1¡½Ø»B¢Ã…9Rz©õhB„{€™\0ëå^‚Ã-â0©%Dœ5F\"\"àÚÜÊÂ™úiÄ`ËÙnAf¨ \"tDZ\"_àV\$Ÿª!/…D€áš†ğ¿µ‹´ˆÙ¦¡Ì€F,25Éj›Tëá—y\0…N¼x\rçYl¦#‘ÆEq\nÍÈB2œ\nìà6·…Ä4Ó×”!/Â\nóƒ‰Q¸½*®;)bR¸Z0\0ÄCDoŒË48À•´µ‡Ğe‘\nã¦S%\\úPIk‡(0ÁŒu/™‹G²Æ¹ŠŒ¼\\Ë} 4Fp‘Gû_÷G?)gÈotº[vÖ\0°¸?bÀ;ªË`(•ÛŒà¶NS)\nãx=èĞ+@êÜ7ƒjú0—,ğ1Ã…z™“­>0ˆ‰GcğãL…VXôƒ±ÛğÊ%À…Á„Q+øéoÆFõÈéÜ¶Ğ>Q-ãc‘ÚÇl‰¡³¤wàÌz5G‘ê‚@(h‘cÓHõÇr?ˆšNbş@É¨öÇø°îlx3‹U`„rwª©ÔUÃÔôtØ8Ô=Àl#òõlÿä¨‰8¥E\"Œƒ˜™O6\n˜Â1e£`\\hKf—V/Ğ·PaYKçOÌı éàx‘	‰Oj„ór7¥F;´êB»‘ê£íÌ’‡¼>æĞ¦²V\rÄ–Ä|©'Jµz«¼š”#’PBä’Y5\0NC¤^\n~LrR’Ô[ÌŸRÃ¬ñgÀeZ\0x›^»i<Qã/)Ó%@Ê’™fB²HfÊ{%Pà\"\"½ø@ªş)ò’‘“DE(iM2‚S’*ƒyòSÁ\"âñÊeÌ’1Œ«×˜\n4`Ê©>¦Q*¦Üy°n”’¥TäuÔâä”Ñ~%+W²XK‹Œ£Q¡[Ê”àlPYy#DÙ¬D<«FLú³Õ@Á6']Æ‹‡û\rFÄ`±!•%\n0cĞôÀË©%c8WrpGƒ.TœDo¾UL2Ø*é|\$¬:çXt5ÆXYâIˆp#ñ ²^\nê„:‚#Dú@Ö1\r*ÈK7à@D\0¸C’C£xBhÉEnKè,1\"õ*y[á#!ó×™âÙ™©Ê°l_¢/€öxË\0àÉÚ5ĞZÇÿ4\0005JÆh\"2ˆŒ‡%Y…¦a®a1SûO4ˆÊ%niøšPŒàß´qî_Ê½6¤š•~ŠÈI\\¾š‘d‰údÑøŒ®—DÜÈ”€µ3g^ãü@^6Õ„îå_ÀHD·.ksL´Ô@ÂùÉˆæn­I¦ÄÑ~Ä\r“b @¸Ó€•Nt\0séÂ]:uğÎX€b@^°1\0½©¥2?èTÀó6dLNeÉ›+ê\0Ç:©Ğ²l¡ƒz6q=Ìºx“§çN6 ÜO,%@s›0\næ\\)ÒL<òCÊ|·¦P¶b¢˜¼ÎA>I‹…á\"	ŒÜ^K4ü‹gIXi@P…jE©&/1@æfÜ	ÔNáºx0coaß§Áª‰ó,C'Üy#6F@¡Ğ ‰H0Ç{z3t–|cXMJ.*BĞ)ZDQğå\0°ñ“T-v¥Xa*”İ,*Ã<bÁ•Ë#xÑ˜İd€PÆòKG8—Æ y“K	\\#=è)ígÈ‘hŒ&È8])½CÅ\nÃ´ñÀ9¼zˆW\\’gşM 7Šˆ!Ê•¡óÆŠ–¬,Åò9ñ²Š©©\$T\"£,Š¨%.F!Ëš A»-àé”ø¹-àg¨âŠ\0002R>KEˆ'ØUÙ_IĞ÷ì³9³Ë¼¡j(Q°@Ë@ò4/¬7ô˜“'J.â‡RT…\0]KS¹D‡–Ap5¼\rÂH0!ä›Â´e	d@RÒÒà¸´Ê9¢S©;7H‘BÀbxóJèÖ_viÑU`@ˆµÃSAM…¯XËÏGØXiÙÓU*¬Úö€ÊõûÍ'øİ:VòWJv£D¾ÿN'\$ìzh\$d_y§œ“Z]•™­óYÊ°³8Ø”ş¡æ]¨Pìœ*hÔÖ§e;€ºpeû¢\$kæw§ì*7N²DTx_ÔÔ§½Giô&PÿÔ†tÍ†¨bè\\EÆH\$iE\"cr½å0l‰?>ÁñŒ‘C(ŠW@3ÈÁ•22a´“IÁà¹Õ¡{¥B`ÜÚ³iÅ¸Go^6E\r¡ºG˜M¤p1iÙI¼¤Xª\00032ÇKü§Óôİzl&Ö†‰'ILÖ\\Î\"’7¤>¬j(>ãjôFG_âä& 10IÆA31=h q\0ÆFŠ«–„Ä·Šİ_ÂJªŒ„Ô³VÎ–º‡Ü†qÙÕš¢Ù	Âà(/¾dOC_sm§<g˜x\0’°\"ğ\n@EkH\0¡Jˆ­®8€(¬¨¯km[‰‘ì¿ÁS4ğ\nY40›«+L\nŠ¦À“‘ì#BÓ«bçÀ%RÖ–°µ×­‘ÀR:Æ<\$!Û¥r;œ…Ç	%|Ê¨á(€|«H‡\0àğ‘ÁĞŒ°…]ÂcÒ¡=0¯íZá¨\"\"=ÖX•˜)½fëNŸ6V}FÕÚ=[Éà§¢huô-ø±\0t¥åbW~ºõQ•ÕiJŠö—Lñ5×­q#kb İWn««ÍQøTƒ!ëÂeõncSÑ[+Ö´E¯<-‡–a]ÅƒˆìYbÓ\n\nJ~ä|JÉƒ8® ìLpŸ™Áæoñ €Nä©Ü¨…J.ùÅƒSÈ¡2c9Ãj©yŸ-`a\0Äö*ìÖˆ@\0+´ØmgÉÚ6°1¤ÔMe\0ªËQ ‰_„}!Iö’GL€f)ÃXño,“ShxÂ\0000\"hğ+L¥MÔÉ ªÑ˜±ÊZ	j—\0¶ µ/˜\$’¨>u*—Z9”îZå®eõ«+Jœ‰™¸tzÈËûÈşR¨KÔ¯ĞÑâDyŞÙqá0C—-f¢Åm‚¶¹ªBIí|’¹HB‰œsQlÀX°ƒ.İÅöÔ|¸cˆªÀ[–óZhZåÃl˜¨ÛxÂ@'µ ml²KrQ¶26½•]¯Ò·n§d[İöñ©‡dş€‘\"GJ9uòûBƒo“©Zß–Õa¥²n@Áªn°lW|*gX´\nn2åF¬|x`Dk›„uPP!Q\rr‹™`W/¹ŒŸ	1æ[-o,71bUs˜¢©çN¸7²ËÉÛGq¸.\\Q\"CCT\"æ‘à–ÄÒ*?u¨ts¶‰”°Ç]áÙ©Pz[¥[YFÏ¹¢›FD3¤\"–ºÇ]uÛ)wz­:#¶ÍİIiwŠêpÉ›»ñ{¯oÖ0nğ¶Û;Õâ\\éx¸°Ø\0q·måãíª&Ø~Âîî—”7²øÀ¹9[¤HéqdL•Oº2´v|B¯tæŠ\\Æ¤‰Hd¦ëâH‘\" òìN\n\0·©GÅgÎF ¸Fˆ}\"ì­&QEK¾‘{}\ryÇ¾˜r×›t›À„ï†7ÔNuÃ³[Aøgh;S¥.Ò ‚š±Â¥|yùÏ[Õ†_bòÈ¨¬!+RñèZXù@0NééşÁP€Şì%¡jD£Â¯z	şà—[øU\"¶{e’8ôŸ>”EL4JĞ½…0›¡¦è7 €´d·¬ ÀQ^`0`œ•¯]cğ<g@²hy8˜íp.ef\nóÎeh‡ƒaXÚÃømSßßjBÚ˜Q\"‡\rë×ÇK3†=>ÇªAX”[,,\"'<µ›–%¶a€«Ó´Ãµ.\$ñ\0ç%\0ásV¤îËp M\$¼@já×ğ>¤­}VeÄ\$@—Í„#§ªĞ(3:ø`‚UğšYÌ¶uæ¨ûˆÏâÎ@ÄV#E‰G/¸üXD\$ˆhµƒav–¼xS\"]k18a¯Ñ9dJROÓŠs‘`EJ°½§øUo³m{l¹B8¥ˆÁ(\n}ei±büø, ; N”ªÍ‡øQØ\\èÇ¸I5yR¼\$!>\\Ê‰ŒgÂuj*?n°MÓŞ²hİø\r%Á³àU(d€¦Nµd#}špA:¬¨ı•-\\èA»*Ä4€2I€®è\rÖ£»… 0h@\\ÔµÉÀ8ğ3‚rq]òùd8\"ğQ ŒÿîÆ™:cÆàyÇ4	Ïá‘šdaÂ€‡Î 6>UÛAÚÑ:½@˜2‹Ûÿ\$òeh2´ûF»§É™Ná+’ŒŸ\rşÔ€(îAr‚°d*ü\0[®#cjŠû´>!(SğÈéLˆeıTÉÆM	9\0W:™BDıø‚3JŒ¬Õ_@sÇárue‡ø¦ğ»ı¬ +º'B«É}\"B\"üz2î‹rël»xF[èLÙË²Ea9 Êcdb½¾^,ÔUC=/2»×ò¼øì/\$CÆ#Ú÷8¡}DÀÛ×6Ï`^;6B0U7ó·_=	,ª1âj1V[¨.	H9(1ï±Æ±ÒLz¢C¸	Ç\$.AÊfhã–«¾ÍàïDrY	ıHØe~o—r19æ—Ù…\\šß„P’)\"ÃQ¹´,ÑeòöL¾”w0Ï\0§—š–Ï;wìX³Ç¨‰çqo¹ï¾~Ÿ«öçø>9ô>}²òºdc¿\0åÊg¾¶fÎùq–&9—¹-ıJ#¤Š¸ª3^4m/Ì™¯\0\0006À¦n8£·>äˆ´.Ó—é’cph±ËÙù•››º_A@[‰•7«|9\$pMh >‰ŒÁ5°K¥úÃE=hşšAÒtŠ^âV×	©\"	c£B;¤öŞi…ÕQÒ t¬›òé@,\nØ)­óˆsÓ`Ÿ™°°;Ñ4´—‚„Ií£©‘íùèy€ -¤0yeÊ¨—U‚”Bî©v³¥3H™PÇGË5êï’s|·º\rğĞ\$0ãèò•ò1½©l3€é(*oF~PK´ª.ı,'·J/Ó²tğ‹d:š—n§\n©ğj†Y«zê(Æó’ü“w°İ Zì#ZÊ	Io•@1ÆÎ»\$ïò±¦=VWz•	nBøaú›A»µqª@™´I€p	@Ñ5Ó–lH{UºÜoXõ¿fğÓ¿\\zµ×.§š²,-\\Ú—^y n^Å×ÊBq·ş…¤zXã‰¡ƒ\$¨*J72ÕD4.†Õ…!¤M0¶óDëìFŠàóã G¡ÏLˆmØc*mïcI£å5ÉŒ»^—t¿ª’jlŒ7æ›¿S¶Q ¢.i’éÖÔh¨õLĞÚ±B6Ô„h˜&ïJ …l\\‰ğWeªcÎf%kj™Á ¦pÃR=Œäi’@.õ¥(ä2klHUW\"™o¥j½§’p!S5Æè­pL'`\0¤O *¦Q3XÂ“‰ŞlJ\08\n…\r·²¸*€añüë–¼ûr™`<¤&ÚXBhÖ8!xš®&äBht¥\$ÿ‡ş]Énß†éóÉcL€€[Æµ©d¸á<`œ®\0œ€¢Ï‚ŞawæO%;‘õBC»…Q’\rÌ­ÓìŒì€pŠ¤«ØPQ¶Z’¸úZÁAu=N&Ğia\nÑmK6I}Ñ×n	šÅt\nd)í®ĞÈ÷bpÎ€\"ğg'¦0œ7ÃuÈ&@â7å8X NÀxÄáö­ú\$BùßZB/¶M¯gB»i¦ÖÑ§¶\\âmƒmIÌÄ€Êç;5=#&4˜ÌçşPÕ‰½éğqí’A™ä›\\…,q¤cŞŸ\ncâB–‚¾×úw\0BgjD‹@;=0m“k®Ä\rÄ²‹`À¤'5¤•¶k-Œ{¢‰\0¯_›Muîøƒ2“Ò×†§»£Àqø‰¬ğ>)9ÈW\näd+…ÔÔ§ÀG\rıÃn4„‹äOØ:5ö†Ş8»1µ:Îš?¥‡(yGgWK\rİ7­²“—m5.œ‚eŒHÙhJ«Ak#»ÓL¶..›\\Î=ÕñUÙĞ„˜ƒÓ:Ğ>7ºW+^yD‚“œb­üG¡‘OZÍ4ïŠr(|xµÆıPr¸£,y©Ğ8qaÜ©O2µkªn˜Š#p2¾ûÇˆºØ”.¼£c’–U—c”öäëÅ‚jó\$ôí8Ä¬~š7ZR:ğ×†8­9Î¨w(a”L¤%­-,ÔÈì¿Œ#ôfƒ%8şÉ|Şc‡‘¬œÚ×%X‘WÂ\n}6’‘HìÿñæË¤¡#¹&J,'z“MüM…¢‰Œààº‘Ü†² ‘˜®/y6YQ¯‘ì¶ÚºdÓ™dÁŞóÏ:õãô£EƒŒp2gŸgÁ/î,ÒËäÚÕˆ'8ì^;´UWN…ÑÅŞÕ{ÉOCò…Ñ¤ô¢zÉiKX¢’Ú”NŒdG£RCJYõ’‘i²’×y#>zS²MUc£õƒ¨ûÿêRORÔ¾¡0)Ø0Êú]:=Ï™tƒ‘Áëé'\$™sÒrFöÙ67	=\$BÄÓ!qs	1\"ü¬vÆ÷%‘ŒI•l<Êb!Û®6(Cd-Ê^<H`~2¹KìÍzKİÙœ€Ô±­ÙÕy,qAá*º\0}‚İC¨pb€\\ÓSå5İßùÚ'(›áÓí|»Mëğ„ÀWÚÀ5;\$5µT|ºò;kõñÈtîñ@ò‘â;9³)½ò;i.Û;›·í_¥ê×ÌF¶=ñœDä¥M`HŞ“ƒ\0ˆ	 N @°%w‡ªdèPbğ\$H|kÆ[¾ÜdCI!:lÅü,§¨ı<÷”uòt”ô¼NeÏW^¡wè'6•ŒD¿áfıu ¬ihI÷Z:ŸÑ~ı÷Ï£r¾…ÈzÄ3õ+¯uoC·s2ÕbÆua”XğwWK£	HÔ¶27>âWÏÍİyÃ£¬İMëJ£rpT¼”Lğ‰|`f™…:ÊõšA²täŠd|i½³[wüèj„ŠW˜ 7‘¤£au‹© úëe ò•šA5­Q' Ê\0È 3‹Ò¾\$ÂçıŒ\rk)a; óæH=ù™Ö~óIGŠIæ°<ù´•\"ù¬ÉI1'è ™¢Gcm\0P\nïwèü#Í>Œ½ÛxB\"ñÒEm|…ù2Š\$}<3PYXgo£dß¶€<Ôş£¿qE\"`×úÈ4ág«8r£]\nˆ¡—õ:ø›qVbTì£Òm°•…9K&Ò“Ä¤ÃmÔ7)@¨ÀQz›ÃÓ=¢½ßµÅ±íŸH\nÔëö}Oçi}»\rÙ£.¢¹v‹®p¾JW&ßu×550	Ô5ÀîPËIŒÁ\n½Ûí¸³Ææ­{ \r²mš@ @ P  x‘4i4†+@\0,Í›\\–C1Óèª•LêÅÓ>n‚\0ÿãâ	 #‹ÇŞéÄÒ#@]/4JRœ IR²ïr¹< Ç¯òáj„?1Mvğ\n¼Zü`v\0aº-èb­Ïˆœ+ø©-ÂyA[|à7\rš’\$î€ÚóZÊ­RàtùŞ“¾¬ªÏıCErL	öÒrÓg«e R/„`¢J	7ä~“%Xoš4áµdi\"¦Qrº‡Iî:QDåò€¤ĞèQQM~\0Q¿ƒ)Ø©­*,i\0Ğ_(,½^â‘+c¯®ˆŒ&”Sñ›ù‘İ~oîpáàC€º¯ÑÚ©Äùô@áõgŒÖ€ïˆºˆBŞÉâA~sñÖ¤ò\0]šğ/­‘ûz†à˜Ãƒ(_õzF¾OÚ¿\\\r€vEÿéK0ÿ<?·üä?ßç€ÄP°§ç=È`šD…^’õ=ıŸÚŒv* ş|\n¿¥ı@ßóùà-ş¸\\?¶kùDi4şûş¯ù?ÊûÈ0àšl#{ı%\r3€F›ıÂ¿à< P<Èkï´4–ï¯š*@Óï¡}?Fü ÖÏŞ\0];÷êó?‚[\r:\0Øœd°ŠÛö¥NÀDş2È?\\úøÒh­ U´\0/Ö¢¶úûøª	?Q4–có2oëƒü5+è\r´ÀLƒå?Ô³ı®Nƒ(¯û„ ÚŒ(\0àƒ|À>À¤şñA[?[ü/É¿ÈÜí®;è]/é†\\„‘À}sşo³„`2ŸŠ­vh]0Í\0!PAXìJÊÀl<\rê/\"à(“ãDé \\T²vaöÁúR¦O¦˜¨.#óPE¹H#îCˆ*û)©>tkëÁØ\n¥Pª€.0E¾–©IH´\$µÚf%PŒ0]%ÌÉ»ˆXFA@4[şêµı\0‘	¦)P A¤M`ğhÁ¦\0ápd@ê¤é~êA@ıÀ¸A¡œkA¤\nËo@HôÖ¡r\nŒ\$ÓCÊC™;\0éğ-¢¾„û)ö8˜²ÏËÁø‡s5@/\0zÈC~ ‹¼ èeB^õ„œ†\"Pƒ\0X™ãK1®^{’\n€	!l²şø°Z¢¤¹QRÀ½„41‰jæZœäßŸÒã©‹Ã¡¯,gIñ‹º<Âåğ¦HOø»ƒfÔ\"îH,Råí¢®^âåèy ¨B`Ò‰ù¢ìš~àğ´óÚ´}åÛ–æ­ Ná©q‚:Á~îM>^k˜'\$ƒÊˆj¢\n\"	#;`Â’’`Pq€Ç¿\\\\+‚<•:›Øca`€\n¹‹dd\n˜@jn5•´ùğpˆ2ˆ’èpÃ@„0€Œ¿&0r·¶¸şü.HŒÂèh\ršwÈ´£ÊBù	@ğ¤¾|~ğ\r\0C\0„1à:CQ1\\pÓ‘…Y[òŸÏ(Ğ‘.RGåĞÂ0\"8¼PœÂ<%Ê<#ƒBX73¢â‚¤ö“é—Â5B‚	t(¶bøˆñ4<&\r„¶¥ƒŒáV\0G\n;­\\ ");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("v0œF£©ÌĞ==˜ÎFS	ĞÊ_6MÆ³˜èèr:™E‡CI´Êo:C„”Xc‚\ræØ„J(:=ŸE†¦a28¡xğ¸?Ä'ƒi°SANN‘ùğxs…NBáÌVl0›ŒçS	œËUl(D|Ò„çÊP¦À>šE†ã©¶yHchäÂ-3Eb“å ¸b½ßpEÁpÿ9.Š˜Ì~\n?Kb±iw|È`Ç÷d.¼x8EN¦ã!”Í2™‡3©ˆá\r‡ÑYÌèy6GFmY8o7\n\r³0¤÷\0DbcÓ!¾Q7Ğ¨d8‹Áì~‘¬N)ùEĞ³`ôNsßğ`ÆS)ĞOé—·ç/º<xÆ9o»ÔåµÁì3n«®2»!r¼:;ã+Â9ˆCÈ¨®‰Ã\n<ñ`Èó¯bè\\š?`†4\r#`È<¯BeãB#¤N Üã\r.D`¬«jê4ÿpéar°øã¢º÷>ò8Ó\$Éc ¾1Écœ ¡c êİê{n7ÀÃ¡ƒAğNÊRLi\r1À¾ø!£(æjÂ´®+Âê62ÀXÊ8+Êâàä.\rÍÎôƒÎ!x¼åƒhù'ãâˆ6Sğ\0RïÔôñOÒ\n¼…1(W0…ãœÇ7qœë:NÃE:68n+äÕ´5_(®s \rã”ê‰/m6PÔ@ÃEQàÄ9\n¨V-‹Áó\"¦.:åJÏ8weÎq½|Ø‡³XĞ]µİY XÁeåzWâü 7âûZ1íhQfÙãu£jÑ4Z{p\\AUËJ<õ†káÁ@¼ÉÃà@„}&„ˆL7U°wuYhÔ2¸È@ûu  Pà7ËA†hèÌò°Ş3Ã›êçXEÍ…Zˆ]­lá@MplvÂ)æ ÁÁHW‘‘Ôy>Y-øYŸè/«›ªÁî hC [*‹ûFã­#~†!Ğ`ô\r#0PïCË—f ·¶¡îÃ\\î›¶‡É^Ã%B<\\½fˆŞ±ÅáĞİã&/¦O‚ğL\\jF¨jZ£1«\\:Æ´>N¹¯XaFÃAÀ³²ğÃØÍf…h{\"s\n×64‡ÜøÒ…¼?Ä8Ü^p\"ë°ñÈ¸\\Úe(¸PƒNµìq[g¸Árÿ&Â}PhÊà¡ÀWÙí*Şír_sËP‡hà¼àĞ\nÛËÃomõ¿¥Ãê—Ó#§¡.Á\0@épdW ²\$Òº°QÛ½Tl0† ¾ÃHdHë)š‡ÛÙÀ)PÓÜØHgàıUş„ªBèe\r†t:‡Õ\0)\"Åtô,´œ’ÛÇ[(DøO\nR8!†Æ¬ÖšğÜlAüV…¨4 hà£Sq<à@}ÃëÊgK±]®àè]â=90°'€åâøwA<‚ƒĞÑaÁ~€òWšæƒD|A´††2ÓXÙU2àéyÅŠŠ=¡p)«\0P	˜s€µn…3îr„f\0¢F…·ºvÒÌG®ÁI@é%¤”Ÿ+Àö_I`¶ÌôÅ\r.ƒ N²ºËKI…[”Ê–SJò©¾aUf›Szûƒ«M§ô„%¬·\"Q|9€¨Bc§aÁq\0©8Ÿ#Ò<a„³:z1Ufª·>îZ¹l‰‰¹ÓÀe5#U@iUGÂ‚™©n¨%Ò°s¦„Ë;gxL´pPš?BçŒÊQ\\—b„ÿé¾’Q„=7:¸¯İ¡Qº\r:ƒtì¥:y(Å ×\nÛd)¹ĞÒ\nÁX; ‹ìêCaA¬\ráİñŸP¨GHù!¡ ¢@È9\n\nAl~H úªV\nsªÉÕ«Æ¯ÕbBr£ªö„’­²ßû3ƒ\rP¿%¢Ñ„\r}b/‰Î‘\$“5§PëCä\"wÌB_çÉUÕgAtë¤ô…å¤…é^QÄåUÉÄÖj™Áí Bvhì¡„4‡)¹ã+ª)<–j^<Lóà4U* õBg ëĞæè*nÊ–è-ÿÜõÓ	9O\$´‰Ø·zyM™3„\\9Üè˜.oŠ¶šÌë¸E(iåàœÄÓ7	tßšé-&¢\nj!\rÀyœyàD1gğÒö]«ÜyRÔ7\"ğæ§·ƒˆ~ÀíàÜ)TZ0E9MåYZtXe!İf†@ç{È¬yl	8‡;¦ƒR{„ë8‡Ä®ÁeØ+ULñ'‚F²1ıøæ8PE5-	Ğ_!Ô7…ó [2‰JËÁ;‡HR²éÇ¹€8pç—²İ‡@™£0,Õ®psK0\r¿4”¢\$sJ¾Ã4ÉDZ©ÕI¢™'\$cL”R–MpY&ü½Íiçz3GÍzÒšJ%ÁÌPÜ-„[É/xç³T¾{p¶§z‹CÖvµ¥Ó:ƒV'\\–’KJa¨ÃMƒ&º°£Ó¾\"à²eo^Q+h^âĞiTğ1ªORäl«,5[İ˜\$¹·)¬ôjLÆU`£SË`Z^ğ|€‡r½=Ğ÷nç™»–˜TU	1Hyk›Çt+\0váD¿\r	<œàÆ™ìñjG”­tÆ*3%k›YÜ²T*İ|\"CŠülhE§(È\rÃ8r‡×{Üñ0å²×şÙDÜ_Œ‡.6Ğ¸è;ãü‡„rBjƒO'Ûœ¥¥Ï>\$¤Ô`^6™Ì9‘#¸¨§æ4Xş¥mh8:êûc‹ş0ø×;Ø/Ô‰·¿¹Ø;ä\\'( î„tú'+™òı¯Ì·°^]­±NÑv¹ç#Ç,ëvğ×ÃOÏiÏ–©>·Ş<SïA\\€\\îµü!Ø3*tl`÷u\0p'è7…Pà9·bsœ{Àv®{·ü7ˆ\"{ÛÆrîaÖ(¿^æ¼İE÷úÿë¹gÒÜ/¡øUÄ9g¶î÷/ÈÔ`Ä\nL\n)À†‚(Aúağ\" çØ	Á&„PøÂ@O\nå¸«0†(M&©FJ'Ú! …0Š<ïHëîÂçÆù¥*Ì|ìÆ*çOZím*n/bî/ö®Ôˆ¹.ìâ©o\0ÎÊdnÎ)ùi:RÎëP2êmµ\0/vìOX÷ğøFÊ³ÏˆîŒè®\"ñ®êöî¸÷0õ0ö‚¬©í0bËĞgjğğ\$ñné0}°	î@ø=MÆ‚0nîPŸ/pæotì€÷°¨ğ.ÌÌ½g\0Ğ)o—\n0È÷‰\rF¶é€ b¾i¶Ão}\n°Ì¯…	NQ°'ğxòFaĞJîÎôLõéğĞàÆ\rÀÍ\r€Öö‘0Åñ'ğ¬Éd	oepİ°4DĞÜÊ¦q(~ÀÌ ê\r‚E°ÛprùQVFHœl£‚Kj¦¿äN&­j!ÍH`‚_bh\r1 ºn!ÍÉ­z™°¡ğ¥Í\\«¬\rŠíŠÃ`V_kÚÃ\"\\×‚'Vˆ«\0Ê¾`ACúÀ±Ï…¦VÆ`\r%¢’ÂÅì¦\rñâƒ‚k@NÀ°üBñíš™¯ ·!È\n’\0Z™6°\$d Œ,%à%laíH×\n‹#¢S\$!\$@¶İ2±„I\$r€{!±°J‡2HàZM\\ÉÇhb,‡'||cj~gĞr…`¼Ä¼º\$ºÄÂ+êA1ğœE€ÇÀÙ <ÊL¨Ñ\$âY%-FDªŠd€Lç„³ ª\n@’bVfè¾;2_(ëôLÄĞ¿Â²<%@Úœ,\"êdÄÀN‚erô\0æƒ`Ä¤Z€¾4Å'ld9-ò#`äóÅ–…à¶Öãj6ëÆ£ãv ¶àNÕÍf Ö@Ü†“&’B\$å¶(ğZ&„ßó278I à¿àP\rk\\§—2`¶\rdLb@Eöƒ2`P( B'ã€¶€º0²& ô{Â•“§:®ªdBå1ò^Ø‰*\r\0c<K|İ5sZ¾`ºÀÀO3ê5=@å5ÀC>@ÂW*	=\0N<g¿6s67Sm7u?	{<&LÂ.3~DÄê\rÅš¯x¹í),rîinÅ/ åO\0o{0kÎ]3>m‹”1\0”I@Ô9T34+Ô™@e”GFMCÉ\rE3ËEtm!Û#1ÁD @‚H(‘Ón ÃÆ<g,V`R]@úÂÇÉ3Cr7s~ÅGIói@\0vÂÓ5\rVß'¬ ¤ Î£PÀÔ\râ\$<bĞ%(‡Ddƒ‹PWÄîĞÌbØfO æx\0è} Üâ”lb &‰vj4µLS¼¨Ö´Ô¶5&dsF Mó4ÌÓ\".HËM0ó1uL³\"ÂÂ/J`ò{Çş§€ÊxÇYu*\"U.I53Q­3Qô»J„”g ’5…sàú&jÑŒ’Õu‚Ù­ĞªGQMTmGBƒtl-cù*±ş\rŠ«Z7Ôõó*hs/RUV·ğôªBŸNËˆ¸ÃóãêÔŠài¨Lk÷.©´Ätì é¾©…rYi”Õé-Sµƒ3Í\\šTëOM^­G>‘ZQjÔ‡™\"¤¬i”ÖMsSãS\$Ib	f²âÑuæ¦´™å:êSB|i¢ YÂ¦ƒà8	vÊ#é”Dª4`‡†.€Ë^óHÅM‰_Õ¼ŠuÀ™UÊz`ZJ	eçºİ@Ceíëa‰\"mób„6Ô¯JRÂÖ‘T?Ô£XMZÜÍĞ†ÍòpèÒ¶ªQv¯jÿjV¶{¶¼ÅCœ\rµÕ7‰TÊª úí5{Pö¿]’\rÓ?QàAAÀè‹’Í2ñ¾ “V)Ji£Ü-N99f–l JmÍò;u¨@‚<FşÑ ¾e†j€ÒÄ¦I‰<+CW@ğçÀ¿Z‘lÑ1É<2ÅiFı7`KG˜~L&+NàYtWHé£‘w	Ö•ƒòl€Òs'gÉãq+Lézbiz«ÆÊÅ¢Ğ.ĞŠÇzW²Ç ùzd•W¦Û÷¹(y)vİE4,\0Ô\"d¢¤\$Bã{²!)1U†5bp#Å}m=×È@ˆwÄ	P\0ä\rì¢·‘€`O|ëÆö	œÉüÅõûYôæJÕ‚öE×ÙOu_§\n`F`È}MÂ.#1á‚¬fì*´Õ¡µ§  ¿zàucû€—³ xfÓ8kZR¯s2Ê‚-†’§Z2­+Ê·¯(åsUõcDòÑ·Êì˜İX!àÍuø&-vPĞØ±\0'LïŒX øLÃ¹Œˆo	İô>¸ÕÓ\r@ÙPõ\rxF×üE€ÌÈ­ï%Àãì®ü=5NÖœƒ¸?„7ùNËÃ…©wŠ`ØhX«98 Ìø¯q¬£zãÏd%6Ì‚tÍ/…•˜ä¬ëLúÍl¾Ê,ÜKa•N~ÏÀÛìú,ÿ'íÇ€M\rf9£w˜!x÷x[ˆÏ‘ØG’8;„xA˜ù-IÌ&5\$–D\$ö¼³%…ØxÑ¬Á”ÈÂ´ÀÂŒ]›¤õ‡&o‰-39ÖLù½zü§y6¹;u¹zZ èÑ8ÿ_•Éx\0D?šX7†™«’y±OY.#3Ÿ8 ™Ç€˜e”Q¨=Ø€*˜™GŒwm ³Ú„Y‘ù ÀÚ]YOY¨F¨íšÙ)„z#\$eŠš)†/Œz?£z;™—Ù¬^ÛúFÒZg¤ù• Ì÷¥™§ƒš`^Úe¡­¦º#§“Øñ”©ú?œ¸e£€M£Ú3uÌåƒ0¹>Ê\"?Ÿö@×—Xv•\"ç”Œ¹¬¦*Ô¢\r6v~‡ÃOV~&×¨^gü šÄ‘Ù‡'Î€f6:-Z~¹šO6;zx²;&!Û+{9M³Ù³d¬ \r,9Öí°ä·WÂÆİ­:ê\rúÙœùã@ç‚+¢·]œÌ-[g™Û‡[s¶[iÙiÈq››y›éxé+“|7Í{7Ë|w³}„¢›£E–ûW°€Wk¸|JØ¶å‰xmˆ¸q xwyjŸ»˜#³˜e¼ø(²©‰¸ÀßÃ¾™†ò³ {èßÚ y“ »M»¸´@«æÉ‚“°Y(gÍš-ÿ©º©äí¡š¡ØJ(¥ü@ó…;…yÂ#S¼‡µY„Èp@Ï%èsúoŸ9;°ê¿ôõ¤¹+¯Ú	¥;«ÁúˆZNÙ¯Âº§„š k¼V§·u‰[ñ¼x…|q’¤ON?€ÉÕ	…`uœ¡6|­|X¹¤­—Ø³|Oìx!ë:¨œÏ—Y]–¬¹™c•¬À\r¹hÍ9nÎÁ¬¬ë€Ï8'—ù‚êà Æ\rS.1¿¢USÈ¸…¼X‰É+ËÉz]ÉµÊ¤?œ©ÊÀCË\r×Ë\\º­¹ø\$Ï`ùÌ)UÌ|Ë¤|Ñ¨x'ÕœØÌäÊ<àÌ™eÎ|êÍ³ç—â’Ìé—LïÏİMÎy€(Û§ĞlĞº¤O]{Ñ¾×FD®ÕÙ}¡yu‹ÑÄ’ß,XL\\ÆxÆÈ;U×ÉWt€vŸÄ\\OxWJ9È’×R5·WiMi[‡Kˆ€f(\0æ¾dÄšÒè¿©´\rìMÄáÈÙ7¿;ÈÃÆóÒñçÓ6‰KÊ¦Iª\rÄÜÃxv\r²V3ÕÛßÉ±.ÌàRùÂşÉá|Ÿá¾^2‰^0ß¾\$ QÍä[ã¿D÷áÜ£å>1'^X~t1\"6Lş›+ş¾Aàeá“æŞåI‘ç~Ÿåâ³â³@ßÕ­õpM>Óm<´ÒSKÊç-HÉÀ¼T76ÙSMfg¨=»ÅGPÊ°›PÖ\r¸é>Íö¾¡¥2Sb\$•C[Ø×ï(Ä)Ş%Q#G`uğ°ÇGwp\rkŞKe—zhjÓ“zi(ôèrO«óÄŞÓşØT=·7³òî~ÿ4\"ef›~íd™ôíVÿZ‰š÷U•-ëb'VµJ¹Z7ÛöÂ)T‘£8.<¿RMÿ\$‰ôÛØ'ßbyï\n5øƒİõ_àwñÎ°íUğ’`eiŞ¿J”b©gğuSÍë?Íå`öáì+¾Ïï Mïgè7`ùïí\0¢_Ô-ûŸõ_÷–?õF°\0“õ¸X‚å´’[²¯Jœ8&~D#Áö{P•Øô4Ü—½ù\"›\0ÌÀ€‹ı§ı@Ò“–¥\0F ?* ^ñï¹å¯wëĞ:ğ¾uàÏ3xKÍ^ów“¼¨ß¯‰y[Ô(æ–µ#¦/zr_”g·æ?¾\0?€1wMR&M¿†ù?¬St€T]İ´Gõ:I·à¢÷ˆ)‡©Bïˆ‹ vô§’½1ç<ôtÈâ6½:W{ÀŠôx:=Èî‘ƒŒŞšóø:Â!!\0x›Õ˜£÷q&áè0}z\"]ÄŞo•z¥™ÒjÃw×ßÊÚÁ6¸ÒJ¢PÛ[\\ }ûª`S™\0à¤qHMë/7B’€P°ÂÄ]FTã•8S5±/IÑ\rŒ\n îO¯0aQ\n >Ã2­j…;=Ú¬ÛdA=­p£VL)Xõ\nÂ¦`e\$˜TÆ¦QJÎk´7ª*Oë .‰ˆ…òÄ¡\röµš\$#pİWT>!ªªv|¿¢}ë× .%˜Á,;¨ê›å…­Úf*?«ç„˜ïô„\0¸ÄpD›¸! ¶õ#:MRcúèB/06©­®	7@\0V¹vg€ ØÄhZ\nR\"@®ÈF	‘Êä¼+Êš°EŸIŞ\n8&2ÒbXşPÄ¬€Í¤=h[§¥æ+ÕÊ‰\r:ÄÍFû\0:*åŞ\r}#úˆ!\"¤c;hÅ¦/0ƒ·Ş’òEj®íÁ‚Î]ñZ’ˆ‘—\0Ú@iW_–”®h›;ŒVRb°ÚP%!­ìb]SBšƒ’õUl	åâ³érˆÜ\rÀ-\0 À\"Q=ÀIhÒÍ€´	 F‘ùşLèÎFxR‚Ñ@œ\0*Æj5Œük\0Ï0'	@El€O˜ÚÆH CxÜ@\"G41Ä`Ï¼P(G91«\0„ğ\"f:QÊ¸@¨`'>7ÑÈädÀ¨ˆíÇR41ç>ÌrIHõGt\n€RH	ÀÄbÒ€¶71»ìfãh)Dª„8 B`À†°(V<Q§8c? 2€´€E4j\0œ9¼\r‚Íÿ@‹\0'FúDš¢,Å!ÓÿH=Ò* ˆEí(×ÆÆ?Ñª&xd_H÷Ç¢E²6Ä~£uÈßG\0RXıÀZ~P'U=Çß @èÏÈl+A­\n„h£IiÆ”ü±ŸPG€Z`\$ÈP‡ş‘À¤Ù.Ş;ÀEÀ\0‚}€ §¸Q±¤“äÓ%èÑÉjA’W’Ø¥\$»!ıÉ3r1‘ {Ó‰%i=IfK”!Œe\$àé8Ê0!üh#\\¹HF|Œi8tl\$ƒğÊlÀìläi*(ïG¸ñçL	 ß\$€—xØ.èq\"Wzs{8d`&ğWô©\0&E´¯Íì15jWäb¬öÄ‡ÊŞV©R„³™¿-#{\0ŠXi¤²Äg*÷š7ÒVF3‹`å¦©p@õÅ#7°	å†0€æ[Ò®–¬¸[øÃ©hË–\\áo{ÈáŞT­ÊÒ]²ï—Œ¼Å¦á‘€8l`f@—reh·¥\nÊŞW2Å*@\0€`K(©L•Ì·\0vTƒË\0åc'L¯ŠÀ:„” 0˜¼@L1×T0b¢àhşWÌ|\\É-èïÏDN‡ó€\ns3ÀÚ\"°€¥°`Ç¢ùè‚’2ªå€&¾ˆ\rœU+™^ÌèR‰eS‹n›i0ÙuËšb	J˜’€¹2s¹Ípƒs^n<¸¥òâ™±Fl°aØ\0¸š´\0’mA2›`|ØŸ6	‡¦nrÁ›¨\0DÙ¼Íì7Ë&mÜß§-)¸ÊÚ\\©ÆäİŒ\n=â¤–à;* ‚Şb„è“ˆÄT“‚y7cú|o /–Ôßß:‹ît¡P<ÙÀY: K¸&C´ì'G/Å@ÎàQ *›8çv’/‡À&¼üòWí6p.\0ªu3«ŒñBq:(eOPáp	”é§²üÙã\rœ‹á0(ac>ºNö|£º	“t¹Ó\n6vÀ_„îeİ;yÕÎè6fügQ;yúÎ²[Sø	äëgöÇ°èO’ud¡dH€Hğ= Z\ræ'ÚÊùqC*€) œîgÂÇEêO’€ \" ğ¨!kĞ('€`Ÿ\nkhTùÄ*ösˆÄ5R¤Eöa\n#Ö!1¡œ¿‰×\0¡;ÆÇSÂiÈ¼@(àl¦Á¸I× Ìv\rœnj~ØçŠ63¿ÎˆôI:h°ÔÂƒ\n.‰«2plÄ9Btâ0\$bº†p+”Ç€*‹tJ¢ğÌ¾s†JQ8;4P(ı†Ò§Ñ¶!’€.Ppk@©)6¶5ı”!µ(ø“\n+¦Ø{`=£¸H,É\\Ñ´€4ƒ\"[²Cø»º1“´Œ-èÌluoµä¸4•[™±â…EÊ%‡\"‹ôw] Ù(ã ÊTe¢)êK´A“E={ \n·`;?İôœ-ÀGŠ5I¡í­Ò.%Á¥²şéq%EŸ—ıs¢é©gFˆ¹s	‰¦¸ŠKºGÑøn4i/,­i0·uèx)73ŒSzgŒâÁV[¢¯hãDp'ÑL<TM¤äjP*oœâ‰´‘\nHÎÚÅ\n 4¨M-W÷NÊA/î†@¤8mH¢‚Rp€tp„V”=h*0ºÁ	¥1;\0uG‘ÊT6’@s™\0)ô6À–Æ£T\\…(\"èÅU,ò•C:‹¥5iÉKšl«ì‚Û§¡E*Œ\"êrà¦ÔÎ.@jRâJ–QîŒÕ/¨½L@ÓSZ”‘¥Põ)(jjJ¨««ªİL*ª¯Ä\0§ªÛ\r¢-ˆñQ*„QÚœgª9é~P@…ÕÔH³‘¬\n-e»\0êQw%^ ETø< 2Hş@Ş´îe¥\0ğ e#;öÖI‚T’l“¤İ+A+C*’YŒ¢ªh/øD\\ğ£!é¬š8“Â»3AĞ™ÄĞEğÍE¦/}0tµJ|™Àİ1Qm«Øn%(¬p´ë!\nÈÑÂ±UË)\rsEXú‚’5u%B- ´Àw]¡*•»E¢)<+¾¦qyV¸@°mFH òÔšBN#ı]ÃYQ1¸Ö:¯ìV#ù\$“æ şô<&ˆX„€¡úÿ…x« tš@]GğíÔ¶¥j)-@—qĞˆL\nc÷I°Y?qC´\ràv(@ØËX\0Ov£<¬Rå3X©µ¬Q¾Jä–Éü9Ö9ÈlxCuÄ«d±± vT²Zkl\rÓJíÀ\\o›&?”o6EĞq °³ªÉĞ\r–÷«'3úËÉª˜J´6ë'Y@È6ÉFZ50‡VÍT²yŠ¬˜C`\0äİVS!ıš‹&Û6”6ÉÑ³rD§f`ê›¨Jvqz„¬àF¿ ÂÂò´@è¸İµ…šÒ…Z.\$kXkJÚ\\ª\"Ë\"àÖi°ê«:ÓEÿµÎ\roXÁ\0>P–¥Pğmi]\0ªöö“µaV¨¸=¿ªÈI6¨´°ÎÓjK3ÚòÔZµQ¦m‰EÄèğbÓ0:Ÿ32ºV4N6³´à‘!÷lë^Ú¦Ù@hµhUĞ>:ú	˜ĞE›>jäèĞú0g´\\|¡Shâ7yÂŞ„\$•†,5aÄ—7&¡ë°:[WX4ÊØqÖ ‹ìJ¹Æä×‚Şc8!°H¸àØVD§Ä­+íDŠ:‘¡¥°9,DUa!±X\$‘ÕĞ¯ÀÚ‹GÁÜŒŠBŠt9-+oÛt”L÷£}Ä­õqK‹‘x6&¯¯%x”ÏtR¿–éğ\"ÕÏ€èR‚IWA`c÷°È}l6€Â~Ä*¸0vkıp«Ü6Àë›8z+¡qúXöäw*·EƒªIN›¶ªå¶ê*qPKFO\0İ,(Ğ€|œ•‘”°k *YF5”åå;“<6´@ØQU—\"×ğ\rbØOAXÃvè÷v¯)H®ôo`STÈpbj1+Å‹¢e²Á™ Ê€Qx8@¡‡ĞÈç5\\Q¦,Œ‡¸Ä‰NëİŞ˜b#Y½H¥¯p1›ÖÊøkB¨8NüoûX3,#UÚ©å'Ä\"†é”€ÂeeH#z›­q^rG[¸—:¿\r¸m‹ngòÜÌ·5½¥V]«ñ-(İWğ¿0âëÑ~kh\\˜„ZŠå`ïél°êÄÜk ‚oÊjõWĞ!€.¯hFŠÔå[tÖA‡wê¿e¥Mà««¡3!¬µÍæ°nK_SF˜j©¿ş-S‚[rœÌ€wä´ø0^Áh„fü-´­ı°?‚›ıXø5—/±©Š€ëëIY ÅV7²a€d ‡8°bq·µbƒn\n1YRÇvT±õ•,ƒ+!Øıü¶NÀT£î2IÃß·ÄÄ÷„ÇòØ‡õ©K`K\"ğ½ô£÷O)\nY­Ú4!}K¢^²êÂàD@á…÷naˆ\$@¦ ƒÆ\$AŠ”jÉËÇø\\‹D[=Ë	bHpùSOAG—ho!F@l„UËİ`Xn\$\\˜Íˆ_†¢Ë˜`¶âHBÅÕ]ª2ü«¢\"z0i1‹\\”ŞÇÂÔwù.…fyŞ»K)£îíÂ‡¸ pÀ0ä¸XÂS>1	*,]’à\r\"ÿ¹<cQ±ñ\$t‹„qœ.‹ü	<ğ¬ñ™+t,©]Lò!È{€güãX¤¶\$¤6v…˜ùÇ ¡š£%GÜHõ–ÄØœÈE ÒXÃÈ*Á‚0ÛŠ)q¡nCØ)I›ûà\"µåÚÅŞíˆ³¬`„KFçÁ’@ïd»5Œê»AÈÉp€{“\\äÓÀpÉ¾Nòrì'£S(+5®ĞŠ+ \"´Ä€£U0ÆiËÜ›úæ!nMˆùbrKÀğä6Ãº¡r–ì¥â¬|aüÊÀˆ@Æx|®²kaÍ9WR4\"?5Ê¬pıÛ“•ñk„rÄ˜«¸¨ıß’ğæ¼7Â—Hp†‹5YpW®¼ØG#ÏrÊ¶AWD+`¬ä=Ê\"ø}Ï@HÑ\\p°“Ğ€©ß‹Ì)C3Í!sO:)Ùè_F/\r4éÀç<A¦…\nn /Tæ3f7P1«6ÓÄÙıOYĞ»Ï²‡¢óqì×;ìØÀæaıXtS<ã¼9Ânws²x@1ÎxsÑ?¬ï3Å@¹…×54„®oÜÈƒ0»ŞĞïpR\0Øà¦„†Îù·óâyqßÕL&S^:ÙÒQğ>\\4OInƒZ“nçòvà3¸3ô+P¨…L(÷Ä”ğ…Àà.x \$àÂ«Cå‡éCnªAkçc:LÙ6¨ÍÂr³w›ÓÌh°½ÙÈnr³Zêã=è»=jÑ’˜³‡6}MŸGıu~3ùšÄbg4Åùôs6sóQé±#:¡3g~v3¼ó€¿<¡+Ï<ô³Òa}Ï§=Îe8£'n)ÓcCÇzÑ‰4L=hıŒ{i´±Jç^~çƒÓwg‹Dà»jLÓéÏ^šœÒÁ=6Î§NÓ”êÅÁ¢\\éÛDóÆÑN”†êEı?hÃ:SÂ*>„ô+¡uúhhÒ…´W›E1j†x²Ÿôí´ŠtÖ'Îtà[ îwS²¸ê·9š¯Tö®[«,ÕjÒv“òÕît£¬A#T™¸Ôæ‚9ìèj‹K-õÒŞ ³¿¨Yèi‹Qe?®£4ÓÓÁë_WzßÎéó‹@JkWYêhÎÖpu®­çj|z4×˜õ	èi˜ğm¢	àO5à\0>ç|ß9É×–«µè½ öëgVyÒÔu´»¨=}gs_ºãÔV¹sÕ®{çk¤@r×^—õÚ(İwÏ…øH'°İaì=i»ÖNÅ4µ¨‹ë_{Ï6ÇtÏ¨ÜöÏ—e [Ğh-¢“Ul?Jîƒ0O\0^ÛHlõ\0.±„Z‚’œ¼âÚxu€æğ\"<	 /7ÁŠ¨Ú û‹ïi:Ò\nÇ ¡´à;íÇ!À3ÚÈÀ_0`\0H`€Â2\0€ŒHò#h€[¶P<í¦†‘×¢g¶Ü§m@~ï(şÕ\0ßµkâY»vÚæâ#>¥ù„\nz\n˜@ÌQñ\n(àGİ\nöüà'kóš¦èº5“n”5Û¨Ø@_`Ğ‡_l€1Üşèwp¿Pî›w›ªŞ\0…cµĞoEl{Åİ¾é7“»¼¶o0ĞÛÂôIbÏên‹zÛÊŞÎï·›¼ ‹ç{Ç8øw=ëîŸ| /yê3aíß¼#xqŸÛØò¿»@ï÷kaà!ÿ\08dîmˆäR[wvÇ‹RGp8øŸ vñ\$Zü½¸mÈûtÜŞİÀ¥·½íôºÜû·Ç½Ôîûu€oİp÷`2ğãm|;#x»mñnç~;ËáVëE£ÂíØğÄü3OŸ\r¸,~o¿w[òáNêø}ºş ›clyá¾ñ¸OÄÍŞñ;…œ?á~ì€^j\"ñWz¼:ß'xWÂŞ.ñ	Áu’(¸ÅÃäq—‹<gâçv¿hWq¿‰\\;ßŸ8¡Ã)M\\³š5vÚ·x=h¦iºb-ÀŞ|bÎğàpyDĞ•Hh\rceà˜y7·p®îxşÜG€@D=ğ Öù§1Œÿ!4Ra\r¥9”!\0'ÊYŒŸ¥@>iS>æ€Ö¦Ÿo°óoòÎfsO 9 .íşéâ\"ĞF‚…ló20åğE!Qšá¦çËD9dÑBW4ƒ›\0û‚y`RoF>FÄa„‰0‘ùÊƒó0	À2ç<‚IÏP'\\ñçÈIÌ\0\$Ÿœ\n R aUĞ.‚sĞ„«æ\"ùš1Ğ†…eºYç ¢„Zêqœñ1 |Ç÷#¯G!±P’P\0|‰HÇFnp>Wü:¢`YP%”ÄâŸ\nÈa8‰ÃP>‘ÁÁè–™`]‘‹4œ`<Ğr\0ùÃ›ç¨û¡–z–4Ù‡¥Ë8€ùÎĞ4ó`mãh:¢Îª¬HDªãÀjÏ+p>*ä‹ÃÄê8äŸÕ 08—A¸È:€À»Ñ´]wêÃºùz>9\n+¯ççÍÀñØ:—°ii“PoG0°Öö1ş¬)ìŠZ°Ú–èn¤È’ì×eRÖ–Üí‡g£M¢à”ÀŒgs‰LC½rç8Ğ€!°†À‚Œ3R)Îú0³0Œôs¨IéJˆVPpK\n|9e[á•ÖÇË‘²’D0¡Õ àz4Ï‘ªo¥Ôéáèà´,N8nåØsµ#{è“·z3ğ>¸BSı\";Àe5VD0±¬š[\$7z0¬ºøÃËã=8ş	T 3÷»¨Q÷'R’±—’ØnÈ¼LĞyÅ‹ìö'£\0oäÛ,»‰\0:[}(’¢ƒ|×ú‡X†>xvqWá“?tBÒE1wG;ó!®İ‹5Î€|Ç0¯»JI@¯¨#¢ˆŞuÅ†Iáø\\p8Û!'‚]ß®šl-€låSßBØğ,Ó—·»ò]èñ¬1‡Ô•HöÿNÂ8%%¤	Å/;FGSôòôhé\\Ù„ÓcÔt²¡á2|ùWÚ\$tøÎ<ËhİOŠ¬+#¦BêaN1ùç{ØĞyÊwòš°2\\Z&)½d°b',XxmÃ~‚Hƒç@:d	>=-Ÿ¦lK¯ŒÜşJí€\0ŸÌÌó@€rÏ¥²@\"Œ(AÁñïªıZ¼7Åh>¥÷­½\\Íæú¨#>¬õø\0­ƒXrã—YøïYxÅæq=:šÔ¹ó\rlŠoæm‡gbööÀ¿À˜ï„D_àTx·C³ß0.Šôy€†R]Ú_İëÇZñÇ»WöIàëGÔï	MÉª(®É|@\0SO¬ÈsŞ {î£”ˆø@k}äFXSÛb8àå=¾È_ŠÔ”¹l²\0å=ÈgÁÊ{ HÿÉyGüÕáÛ sœ_şJ\$hkúF¼q„àŸ÷¢Éd4Ï‰ø»æÖ'ø½>vÏ¬ !_7ùVq­Ó@1zë¤uSe…õjKdyuëÛÂS©.‚2Œ\"¯{úÌKşØË?˜s·ä¬Ë¦h’ßRíd‚é`:y—ÙåûGÚ¾\nQéı·Ùßow’„'öïhS—î>ñ©¶‰LÖX}ğˆe·§¸G¾â­@9ıãíŸˆüWİ|íøÏ¹û@•_ˆ÷uZ=©‡,¸åÌ!}¥ŞÂ\0äI@ˆä#·¶\"±'ãY`¿Ò\\?Ìßpó·ê,Gú¯µı×œ_®±'åGúÿ²Ğ	ŸT†‚#ûoŸÍH\rş‡\"Êëúoã}§ò?¬şOé¼”7ç|'ÎÁ´=8³M±ñQ”yôaÈH€?±…ß®‡ ³ÿ\0ÿ±öbUdè67şÁ¾I Oöäïû\"-¤2_ÿ0\rõ?øÿ«–ÿ hO×¿¶t\0\0002°~şÂ° 4²¢ÌK,“Öoh¼Î	Pc£ƒ·z`@ÚÀ\"îœâŒàÇH; ,=Ì 'S‚.bËÇS„¾øàCc—ƒêìšŒ¡R,~ƒñXŠ@ '…œ8Z0„&í(np<pÈ£ğ32(ü«.@R3ºĞ@^\r¸+Ğ@ , öò\$	ÏŸ¸„E’ƒèt«B,²¯¤âª€Ê°h\r£><6]#ø¥ƒ;‚íC÷.Ò€¢ËĞ8»Pğ3ş°;@æªL,+>½‰p(#Ğ-†f1Äz°Áª,8»ß ÆÆPà:9ÀŒï·RğÛ³¯ƒ¹†)e\0Ú¢R²°!µ\nr{Æîe™ÒøÎGA@*ÛÊnDöŠ6Á»ğòóíN¸\rR™Ôø8QK²0»àé¢½®À>PN°Ü©IQ=r<á;&À°fÁNGJ;ğUAõÜ¦×A–P€&şõØã`©ÁüÀ€);‰ø!Ğs\0î£Áp†p\r‹¶à‹¾n(ø•@…%&	S²dY«ŞìïuCÚ,¥º8O˜#ÏÁ„óòoªšêRè¬v,€¯#è¯|7Ù\"Cp‰ƒ¡Bô`ìj¦X3«~ïŠ„RĞ@¤ÂvÂø¨£À9B#˜¹ @\nğ0—>Tíõá‘À-€5„ˆ/¡=è€ ¾‚İE¯—Ç\nç“Âˆd\"!‚;ŞÄp*n¬¼Z²\08/ŒjX°\r¨>F	PÏe>À•OŸ¢LÄ¯¡¬O0³\0Ù)kÀÂºã¦ƒ[	ÀÈÏ³Âêœ'L€Ù	Ãåñƒ‚é›1 1\0ø¡Cë 1Tº`©„¾ìRÊz¼Äš£îÒp®¢°ÁÜ¶ìÀ< .£>î¨5İ\0ä»¹>Ÿ BnËŠ<\"he•>ĞººÃ®£çsõ!ºHı{Ü‘!\rĞ\rÀ\"¬ä| ‰>Rš1dàö÷\"U@ÈD6ĞåÁ¢3£çğŸ>o\r³çá¿vL:K„2å+Æ0ì¾€>°È\0äí ®‚·Bé{!r*Hî¹§’y;®`8\0ÈËØ¯ô½dş³ûé\rÃ0ÿÍÀ2AşÀ£î¼?°õ+û\0ÛÃ…\0A¯ƒwSû‡lÁ²¿°\r[Ô¡ª6ôcoƒ=¶ü¼ˆ0§z/J+ê†ŒøW[·¬~C0‹ùeü30HQP÷DPY“}‡4#YDö…ºp)	º|û@¥&ã-À†/F˜	á‰T˜	­«„¦aH5‘#ƒëH.ƒA>Ğğ0;.¬­şY“Ä¡	Ã*ûD2 =3·	pBnuDw\n€!ÄzûCQ \0ØÌHQ4DË*ñ7\0‡JÄñ%Ä±puD (ôO=!°>®u,7»ù1†ãTM+—3ù1:\"P¸Ä÷”RQ?¿“üP°Š¼+ù11= ŒM\$ZÄ×lT7Å,Nq%E!ÌS±2Å&öŒU*>GDS&¼ªéó›ozh8881\\:ÑØZ0hŠÁÈT •C+#Ê±A%¤¤D!\0ØïòñÁXDAÀ3\0•!\\í#h¼ªí9bÏ‚T€!dª—ˆÏÄY‘j2ôSëÈÅÊ\nA+Í½¤šHÈwD`íŠ(AB*÷ª+%ÕEï¬X.Ë Bé#ºƒÈ¿Œ¸&ÙÄXe„EoŸ\"×è|©r¼ª8ÄW€2‘@8Daï|ƒ‚ø÷‘Š”Núhô¥ÊJ8[¬Û³öÂö®WzØ{Z\"L\0¶\0€È†8ØxŒÛ¶X@”À E£Íïë‘h;¿af˜¼1Âş;nÃÎhZ3¨E™Â«†0|¼ ì˜‘­öAà’£tB,~ôŠW£8^»Ç ×ƒ‚õ<2/	º8¢+´¨Û”‚O+ %P#Î®\n?»ß‰?½şeË”ÁO\\]Ò7(#û©DÛ¾(!c) NöˆºÑMF”E£#DXîgï)¾0Aª\0€:ÜrBÆ×``  ÚèQ’³H>!\rB‡¨\0€‰V%ce¡HFH×ñ¤m2€B¨2IêµÄÙë`#ú˜ØD>¬ø³n\n:LŒıÉ9CñÊ˜0ãë\0“x(Ş©(\nş€¦ºLÀ\"GŠ\n@éø`[Ãó€Š˜\ni'\0œğ)ˆù€‚¼y)&¤Ÿ(p\0€Nˆ	À\"€®N:8±é.\r!'4|×œ~¬ç§ÜÙÊ€ê´·\"…cúÇDlt‘Ó¨Ÿ0c«Å5kQQ×¨+‹ZGkê!F€„cÍ4ˆÓRx@ƒ&>z=¹\$(?óŸïÂ(\nì€¨>à	ëÒµ‚ÔéCqÛŒ¼Œt-}ÇG,tòGW ’xqÛHf«b\0\0zÕìƒÁT9zwĞ…¢Dmn'îccb H\0z…‰ñ3¹!¼€ÑÔÅ HóÚHz×€Iy\",ƒ- \0Û\"<†2ˆî Ğ'’#H`†d-µ#cljÄ`³­i(º_¤ÈdgÈíÇ‚*Ój\rª\0ò>Â 6¶ºà6É2ókjã·<ÚCq‘Ğ9àÄ†ÉI\r\$C’AI\$x\r’H¶È7Ê8 Ü€Z²pZrR£òà‚_²U\0äl\r‚®IRXi\0<²äÄÌr…~xÃS¬é%™Ò^“%j@^ÆôT3…3É€GH±z€ñ&\$˜(…Éq\0Œšf&8+Å\rÉ—%ì–2hCüx™¥ÕI½šlbÉ€’(hòSƒY&àBªÀŒ•’`”f•òxÉv n.L+ş›/\"=I 0«d¼\$4¨7rŒæ¼A£„õ(4 2gJ(D˜á=F„¡â´Èå(«‚û-'Ä òXGô29Z=˜’Ê,ÊÀr`);x\"Éä8;²–>û&…¡„ó',—@¢¤2Ãpl²—ä:0ÃlI¡¨\rrœJDˆÀúÊ»°±’hAÈz22pÎ`O2hˆ±8H‚´Ä„wt˜BF²Œg`7ÉÂä¥2{‘,Kl£ğ›Œß°%C%úomû€¾àÀ’´ƒ‘+X£íûÊ41ò¹¸\nÈ2pŠÒ	ZB!ò=VÆÜ¨èÈ€Ø+H6²ÃÊ*èª\0ækÕà—%<² øK',3ØrÄI ;¥ 8\0Z°+EÜ­Ò`Ğˆ²½Êã+l¯ÈÏËW+¨YÒµ-t­fËb¡Qò·Ë_-Ó€Ş…§+„· 95ŠLjJ.GÊ©,\\·òÔ….\$¯2ØJè\\„- À1ÿ-c¨²‚Ë‡.l·fŒxBqK°,d·èË€â8äA¹Ko-ô¸²îÃæ²°3KÆ¯r¾¸/|¬ÊËå/\\¸r¾Ëñ,¡HÏ¤¸!ğYÀ1¹0¤@­.Â„&|˜ÿËâ+ÀéJ\0ç0P3JÍ-ZQ³	»\r&„‘Ãá\nÒLÑ*ÀËŞj‘Ä‰|—ÒåËæ#Ô¾ª\"Ëº“AÊï/ä¹òû8)1#ï7\$\"È6\n>\nô¢Ã7L1à‹òh9Î\0B€Z»d˜#©b:\0+A¹¾©22ÁÓ'Ì•\nt ’ÄÌœÉOÄç2lÊ³.L¢”HC\0™é2 ó+L¢\\¼™r´Kk+¼¹³Ë³.êŒ’êº;(DÆ€¢Êù1s€ÕÌòdÏs9Ìú•¼ P4ÊìŒœÏó@‹.ìÄáAäÅnhJß1²3óKõ0„Ñ3J\$\0ìÒ2íLk3ãˆáQÍ;3”Ñn\0\0Ä,ÔsIÍ@Œûu/VAÅ1œµ³UMâ<ÆLe4DÖ2şÍV¢% ¨Ap\nÈ¬2ÉÍ35ØòĞA-´“TÍu5š3òÛ¹1+fL~ä\nô°ƒ	„õ->£° ÖÒ¡M—4XLóS†õdÙ²ÖÍŸ*\\Ú@Í¨€˜YÓk¤Š¤ÛSDM»5 Xf° ¬ªD³s¤äÀUs%	«Ì±p+Ké6ÄŞ/ÍÔüİ’ñ8XäŞ‚=K»6pHà†’ñ%è3ƒÍ«7lØI£K0ú¤ÉLíÎD»³uƒêõ`±½P\rüÙSOÍ™&(;³L@Œ£ÏˆN>Sü¸2€Ë8(ü³Ò`J®E°€r­F	2üåSE‰”M’†MÈá\$qÎE¶Ÿ\$ÔÃ£/I\$\\“ãáIDå\" †\nä±º½w.tÏS	€æ„Ñ’Pğò#\nWÆõ-\0CÒµÎ:jœRíÍ^Süí„Å8;dì`”£ò5ÔªaÊ–ÇôE¹+(XröMë;Œì3±;´•ó¼B,Œ˜*1&î“ÃÎË2XåS¼ˆõ)<Í ­L9;òRSN¼Ş£ÁgIs+ÜëÓ°Kƒ<¬ñsµLY-Z’:A<áÓÂOO*œõ2vÏW7¹¹+|ô €Ë»<TÖóÕ9 h’“²Ïy\$<ôÎ#Ï;ÔöÓá›v±\$öOé\0­ ¬,Hkòü-äõàÏš\rÜú²ŸÏ£;„”¹O•>ìù“·Ë7>´§3@O{.4öpO½?TübÃÏË.ë.~O…4ôÏSïÏì>1SS€Ï*4¶PÈ£ó>ü·ÁÏï3í\0ÒWÏ>´ô2å><ëóßP?4€Û@Œôt\nNÀÇùAŒxpÜû%=P@ÅÒCÏ@…RÇËŸ?x°ó\n˜´Œ0NòwĞO?ÕTJC@õÎ#„	.dş“·MêÌt¯&=¹\\ä4èÄAÈå:L“¥€í\$ÜéÒNƒ­:Œ’\rÎÉI'Å²–AÕráŒ;\r /€ñCôÈåBåÓ®Œi>LèŠ7:9¡¡€ö|©C\$ÊË)Ñù¡­¹z@´tlÇ:>€úCê\n²Bi0GÚ,\0±FD%p)o\0Š°©ƒ\n>ˆú`)QZIéKGÚ%M\0#\0DĞ ¦Q.Hà'\$ÍE\n «\$Ü%4IÑD°3o¢:LÀ\$£Îm ±ƒ0¨	ÔB£\\(«¨8üÃé€š…hÌ«D½ÔCÑsDX4TK€¦Œ{ö£xì`\n€,…¼\nE£ê:Òp\nÀ'€–> ê¡o\0¬“ıtIÆ` -\0‹D½À/€®KPú`/¤êøH×\$\n=‰€†>´U÷FP0£ëÈUG}4B\$?EıÛÑ%”T€WD} *©H0ûT„\0tõ´†‚ÂØ\"!o\0Eâ7±ïR.“€útfRFu!ÔDğ\nï\0‡F-4V€QHÅ%4„Ñ0uN\0ŸDõQRuEà	)ÍI\n &Q“m€)Çš’m ‰#\\˜“ÒD½À(\$Ì“x4€€WFM&ÔœR5Hå%qåÒ[F…+ÈùÑIF \nT«R3DºLÁo°Œ¼y4TQ/E´[Ñ<­t^ÒËFü )Qˆå+4°Q—IÕ#´½‰IF'TiÑªXÿÀ!Ñ±FĞ*ÔnRÊ>ª5ÔpÑÇKm+ÔsÇÜ û£ïÒáIåôŸREı+Ô©¤ÙM\0ûÀ(R°?+HÒ€¥Jí\"TÃDˆª\$˜Œà	4wQà}Tz\0‹Gµ8|ÒxçÍ©R¢õ6ÀRæ	4XR6\nµ4yÑmNôãQ÷NMà&RÓH&É2Q/ª7#èÒ›Ü{©'ÒÒ,|”’ÇÎ\n°	.·\0˜>Ô{Áo#1D…;ÀÂĞ?Uô‘Ò•Jò9€*€š¸j”ı€¯F’N¨ÒÑ‰Jõ #Ñ~%-?CôÇßL¨3Õ@EP´{`>QÆÈ”µÔ%Oí)4ïR%IŠ@Ôô%,\"ÕÓùIÕ<‘ëÓÏå\$Ô‰TP>Ğ\nµ\0QP5DÿÓkOFÕTYµ<ÁoıQ…=T‰\0¬“x	5©D¥,Â0?ÍiÎ?xş  ºmE}>Î|¤ÀŒÀ[Èç\0€•&RL€ú”H«S9•G›I›§1ä€–…M4V­HşoT-S)QãGÇF [ÃùTQRjN±ã#x]N(ÌU8\nuU\n?5,TmÔ?Ğÿ’Ü?€ş@ÂU\nµu-€‹Rê9ãğU/S \nU3­IEStQYJu.µQÒõF´o\$&ŒÀûi	ÜKPCó6Â>å5µG\0uR€ÿu)U'R¨0”Ğ€¡DuIU…J@	Ô÷:åV8*ÕRf%&µ\\¿RÈõMU9RøüfUAU[T°UQSe[¤µ\0KeZUa‚­UhúµmS<»®À,Rès¨`&Tj@ˆçGÇ!\\xô^£0>¨ş\0&ÀpÿÎ‚Q¿Q)T˜UåPs®@%\0ŸW€	`\$Ôò(1éQ?Õ\$CïQp\nµOÔJ¹ñX#ƒıV7Xu;Ö!YBî°ÓSåcşÑ+V£ÎÃñ#MUÕW•HÍUıR²Ç…U-+ôğVmY}\\õ€ÈOK¥Mƒì\$ÉSíeToV„ŒÍHTùÑ!!<{´RÓÍZA5œRÁ!=3U™¤(’{@*Ratz\0)QƒP5HØÒ“ÎÕ°­N5+•–ÏP[Ôí9óV%\"µ²ÖØ\n°ıñäG•SL•µÔò9”ùÇÌë•lÀ£ˆ‘\rVˆØ¤Í[•ouºUIY…R_T©Y­p5OÖ§\\q`«U×[ÕBu'Uw\\mRUÇÔ­\\Es5ÓK\\úƒïVÉ\\ÅS•{×AZ%Oõ¼\$Ü¥FµÔ¬>ı5E×WVm`õ€Wd]& \$ÑÎŒÅ•ÛÓ!R¥Z}Ô…]}v5À€§ZUgôÔQ^y` Ñ!^=F•áRÁ^¥vëUÅKex@+¤Şr5À#×@?=”uÎ“s •¤×¥YšNµsS!^c5ğ\$.“u`µÜ\0«XE~1ï9Ò…JóUZ¢@²#1_[­4JÒ2à\nà\$VI²4n»\0˜?ò4aªRç!U~)&ÓòB>t’RßIÕ0ÀÔ_EkTUSØœ|µıUk_Â8€&€›E°ü(â€˜?â@õ××JÒ5Ò½JU†BQT}HVÖ‘j€¤Qx\neÖVsU=ƒÔıV‘N¢4Õ²Ø—\\xèÒÖïR34İG¿D\":	KQş>˜[Õ\rÕY_å#!ª#][j<6Ø®X	¨ìÍc‰•Ø#KL}>`'\0¨5”XÑcU[\0õ(ÔÙÑWt|tô€R]pÀ/£]H2I€QO‹­1âS©Qj•Z€¨¸´Hº´m¨ÌÙ)dµ^SXCY\rtu@Jëpüµ%ÓÿM¸ø€¨óµ“Ö?ÙUQ°\nö=Råar:Ô¿Eí‘À¥-G€\0\$ÑÇd½“ö]Òmeh*ÃìQ‰Wt„öc€¡`•˜AªY=S\r®¯«	m-´‚¤=MwÖH£]Jå\"ä´Ä õş­fõ\"´{#9Teœ‰ÙÍMÔc¹ñNêI£òÙßD¥œõÙÜçUœ6ÙñgÑ2Ù×İ¶eƒa­L´€Q&&uTåX51Y >£óûSıÖŠQ#êIµ¥Õj\0ûœ£ÅW PÑş?ub5FUóLn¶)V5R¢@ãë\$!%o¶ÔPúÉ'€‰EµUÁÔP-†¶š¤Bp\nµF\$ŸS4…t±UF|{–qÖÈ“0û•ÎUmjsÎÃü€²øı\$´Ú›j…cëÚå¦Ö«€¿aZI5X€ƒj26®¤&>vÑ\n\r)2Õ_kîG¶®TJÚÁeQ-cîZñVM­Ö½£z>õ]•a¹c£Ëcìß`t„”HÚÑjİ6¹£+kŠM–\0Œ>Œ„€##3l=à'´¥^6Í\0¨Ã¨v¦Z9Se£€\"×ÊêbÎ¡ÔB>)•/TÁ=ö9\0ù`Pà\$\0¿]í/0Úª•«äµ½k-š6İÛ{küÖá[F\r|´SÑ¿J¥õMQ¿D=õ/ÈWX¢öœV—a¬'¶¹éa¨to€©lå†¶ĞXj}C@\"ÀKPÛÎÖÚom’3\0#HV”µ…v÷Ñ~“{µÖ?gx	n|[Ø?U¶äµ[rê½h¶ŞG¸`õ3#Gk%L£ê\0¿I`CùDŞê¸	 \"\0ˆŒÅ§¶°#cN«6ßÚ¹fÂÔzÛêº;Ñ¤ÃeeF–7Ù/N\r:ôâQñGÕ9	\$ÔóIøÕ¼ºß]£®TİØWGs«ÔdWõMÚIãèÑÙf’BcêÛ¤êõÂ÷!#cnu&(ŞSã_Õw£ùSfë&TšZ:…0CóSÙLN`Ü³Yj=·¶>Å²ÃñZ!=€rV]gû	Ó£rµ ËXlŒÉ-.¹UÄ'uJuJ\0ƒs­J¶'W%·¶­\\>?òBöëV­j4µÏJ}I/-ÒrRLºSè3\0,RgqÓ­ôÇTf>İ1Õï\0¥_•”Ç\\V8õ¡ZÛt…Ácè€†ú<^\\ùll´j\0¾˜şT¥]CİÔw×Î“zI¶ÙZwN…¶¶pVW…jv»Y¶>2Ó	o\$|U‡WÃL%{toX3_õ¶òR‰J5~6\"×ãZl}´`Ôkc­ÑîÛeR=^UÔ•¥1òÑ½w7eØdµİvÙb=á\0ùf €,³må)ÕéGpûÕ-Ó¼½)9Lı“š>|Ôë \"Ì@èû¤5§`†:›ô\0é,€ñt@ºÄxº“òlÃJÈ»b¨6 à…½‰İaŞA\0Ø»ARì[A»Ã0\$qo—AàÊSÒü@Ìø¬<@ÓyÄĞ\"as.âÎä÷V^„•è®¥^õ›…—œ\0ÜÈHÁ·[H@’bK—©Ş)zÀ\r·¨¤¤=éÁ^¿zˆB\0º¿’¤äNéo<Ì‡t<xî£\0Ú¬0*R ºI{¥í®´^æEµî·¸:{KÕ§1Eˆ0²ÓYº•›à/ÕÑcêÀ\"\0„ê¸4øÉF7'€†˜\nÕ0İÉ`U£Tù¤?MPÔÀÓlµÈ4ŒÓr(	´ÁZ¿|„€&†©t\"Iµ¿ÖÛL w+Òm}…§÷€Wi\r>ÖU__uÅ÷63ßy[¢8µT-÷ÙVÏ}¤xãô_~è%ø7Ùß{jMáo_šEù÷ØÓë~]ôP\$ßJõCaXGŠ9„\0007Åƒ5óA#á\0.‹Àä\rË´_Ö¢áÀßÚ%şáÀÀ\n€\r#<MÅxØJËù±|¸Ø2ğ\0¨–;oŒ^a+F€í¸Îç¬€LkúÁ;À_Ûİê#€¾M\\“¬€¤pr@ä“ÃµÆÔøÂşOR€¿ñ–~zÇûAÁNE°YÁO	(1N×‰ˆRø¨8Ø€C¼¦ë¨Én?O)ƒ¶1AçDo\0ä\r»Ç¢?àkJâî‘“„\"â,OFÈÌa…›ùª-bà6]PSø)Æ™ 5xCâ=@j°€ÇL”ÁèÈLî˜:\"èƒ»ÎŠ¤l#¢ÀéBèk£“ˆ›€ÖË@ •Nº:ê>ï|Bé9î	«Èî”:Nıñ\$èéS¥ CB:j6î—Şé•àÎ‰Jk”†uKğ_W›Í¢Ã˜I =@TvãÒ\n0^o…\\¿Ó ?/Á‡&uê.ŞØ_˜æ\r®î¥Cæì+Úøc†~±J¸b†6ÓüØe\0ÍyóÑ¡\0wxêhÁ8j%S›À–VH@N'\\Û¯‡ÆN¥`n\r‹ÒuŞn‰KèqUÃBé+í˜f>G‡°\r¸»ˆ=@G¤Åädç‚†\nã)¬ĞFOÅ hÊ·›†ÃˆfC‡É…X|˜‡I…]æğ3auyàUi^â9yÖ\no^rt\r8ÀÍ‡#óîØâN	VÈâY†;Êc*â%Và<›‰#Øh9r \rxcâv(\raŸá¨æ(xja¡`g¸0çVÌ¼°Œ¿Q†©x(ÇëƒÀglÕ°{—Ægh`sW<Kj°'¿;)°Gnq\$¨pæ+ÎÉŒ_ŠÉdø¶^& ¯Š˜DÂxà!bèvŞ!EjPV¤' ââÁ(”=ÏbÂ\rˆ\"–b¦İL¼\0€¿Ìbtá‚\n>J¬Ôã1;üù¼ÖîÛˆ¿4^s¨QÁp`Öfr`7‚ˆ«xª»E<lÑÏã	8sş¯'PT°øÖºæËƒ¸°z_ÊT[>Ğ€:Ïó`³1.î¾°;7ó@[ÑŞ>º6!¡*\$`²•\0À„æ`,€“øÇàİÁ@°àáå?Ìm˜>ƒ>\0êLCÇ¸ñˆR¸În™°/+½`;CŠ£Õø\0ê½*€<F“„ö+ëƒâ„q MŒÁş;1ºK\nÀ:b3j1™Ôl–:c>áYøhôìŞ¾#Ô;ã´Ü3Öº”8à5Ç:ï\\Şï¨\0XH·Â…¶«aş®¸™M1ä\\æL[YC…£vN’·\0+\0Ôät#ø\$¬ÆØØà!@*©l¦„	F»dhdİıùF›‘à&˜˜Æ˜fó¹)=˜¦0¡ 4…x\0004ED6KÍòä¢£±…”\0ònN¨];qº4sj-Ê=-8½ê†\0æsÇ¨ûˆ¹D§f5p4Œàé©Jè^Öí’'Ó”[úùH^·NR F˜Kw¼z¢Ò ÜĞE”º“ágF|!Èc©ôäo•dbÁêùxß\0ì-åà6ß,Eí„_†íê3uåp ÇÂ/åwz¨( ØexRaºH¼YùceŠš5ê9d\0ó–0@2@ÒÖYùfey–YÙcM×•ºhÙÃ•Ö[¹ez\rv\\0Áeƒ•ö\\¹cÊƒ†î[Ùue“—NY`•åÛ–Î]9hå§—~^Yqe±–¦]™qe_|6!Şóuï`fÕî™Jæ{è7¸ºM{¶YÙ‡©øj‚eÆÌC»¢S6\0DuasFL}º\$È‡à(å”Mb…ÈàÆ¤,0BuÎ¯…ì¥Ñ‚2ögxFÑ™{a¸n:i\rPjıeÏñ˜rÈrØÏGıBY ˆM+qïçiY”dË™é`0À,>6®foš0ù©†o™ó æXf¢äù\0ÀVİL!“«f…†láœ6 Å/ëæ£1eƒ•\0‰>kbfé\r˜!ïufò<%ä(rË›ùa&	ı™¨àY€Ş!¡Òñ–mBg=@ƒĞ\rç; \rŞ5phI 9bm›\$BYË‹ÿšÄgxç#‰@QEOÇæm9–®Ë0\"€ºç!t¨˜ê†Ë‰¸®Ğ‡çO* Ååÿ\0Âİ>%Ö\$éoîrN&s9¿f£4çù™gŠä~jMùf›wyèg›yí\\`X1y5xÿŒù^zï_,& kÑæ¢é|¡€À¦1xçÏA‘6ğ \nîoè”»Œ&xÙïgg™{r…?ç·›ü-°½…®|tä3±šˆÈÍ}gHgK¢9¿¿¨õJÀ<C C° 1„î9ş7‡g÷š‚ïh6!0Hâí›cdy´fÿ¡DA;ƒ‚9…Tæ¢ÿ®0¬Ä\0ÆpØàù†!‡ 6^ã.øSÂ²?ÆØ¦E(P­Îˆ .æÂ 5€ÄhŠéˆEPJv‰ .‹•¢+—\$ç5Œ>P+µ?~‰¡gŒ6\r³öh¢¼p«z(è†WÙÄ`Â•¨±\"y¯ñÏ:ĞFadÅ¬6:ù¡f˜Şi\0ì˜İØàA;áe¢°àì¬ç^ÊÖwf„ >yÍŠËõ`-\rŠÚ…á\0­hr\rÎr£8i\"_Ú	££¼9¡CI¹fXËˆ2¦‰š\"ÍÅ¢‰… øh¢L~Š\"ö…š%V•:!%Šxyèizyg„vxÚ]‚Æ}qgÄÃZiŒä|Œ`Ç+ _úgèòú†™Ù£¾úªÂÀÂè­6PA€Ê€\$¶=9¢ŒùàÍh‹¢|p’ ÿ¢ˆé˜íè!¢.ø!”ş¶üiç§^œøÚiË¢8zVCÌùöŒZ\"€æäØ(Ä¥›¹°9èU)û¥!DgU\0Ãjÿã¿?`Çğ4ãLTo@•B¤§úN†aš{Ãrç:\nÌŸ“E„»8Ã¦&=êE¨*Z:\n?˜¨g¢èÌŠ£‹h¢õ.•˜’ Nş5(ˆSƒhÑôi2Ö*c„fı@•“ÑŞ7¦œz\"áƒ|ÖúrP†.Ç€ÊL8T'¿¸k¢ˆß:(¹q2&œÆED±2~ÿ¿Ø±şœŒ¬Ã9ûÒÂv£©¼8ÿƒ©– @úé^X=X`ªqZºĞQ«Ö®`9jø5^ˆ¹å@ç«¸În¼qv±á¨3±ÚÇèŠ(I6ğªjšdT±ÚÂ\\Š ‚Ÿ3¢,™Ïhék¢3ú(ë3¬‘‘PÒu•VÏ|\0ï§†Uâk;¢ÌJQ¶ã é. Ú	:J\rŠ1ŸênìBI\r\0É¬h@˜¼?ÒN±\nsh—®å\"ë’ò;¦r~7O§\$ ú(ã5¤RÅèÆ	èÊ½jÂîšØFYF šÜ”£«~‰xŞ¾©f º\"ã†vÛ“ošëË¨ººÂº#ŒÜaÒèŠõ¶®P“„Ë<ãáh£-3éº/Gx®õ²nÇi@\"’G…?ó¤,ïZpÖxX`v¦4XÆõóàû„[ƒI¶œ7Ã¥Xc	îÅ!¡bç¢}ÚjŒ_¾¥9á5qti¦6f»’°¸İÙ5ÿûç FÆ¹ãiÑ±©pX'ø2¡rƒ„®0ÆÆºé§D,#GëU2€ÌØâIè\rl(£— €ì±£¦¨=ĞA¸a€ì©³-8›dbSşˆûõ4~‚ô—H;°Â­0à6Çbé{ª„ŞºRæèÃs3zë¯ÃÀüNğŞ„`ÆË†+ò¦­ 4<ø^aƒy°¬”	}r°Âây´õãáû¸kŒ&4@ˆÁ?~ÔäÅcE´ÂÈ­@ˆLS@€Œéz^qqN¦°</H‚j^sCâ`èæsbgGy¹¤Ö^\nÈNó\n:G¶N}¼c\nîÚÕí¤ +£†ï=†pÙ1º’NµTB[dÀÿ¶–š¶Ğ‹¢¾Ü¹ñ`³nÚoj;jÄ›whØõ€c9ƒ‚pÌ¡[y4«¨¶05œÍ‹NßÁ+Î¿·Ğ`Xdaáæ/zn*öPÀ‡êÁ¸#tíèµ¸~à9Wî	šVâò~=¸#Ùùn)¨î´î	2ÜÉ;…j:õ°Ják„C¸!>xîù5š£==¦2»—‚. ã|¿'¨îä[€Ì'—;üÚv½ù«–“¸„®÷ÎëÎ;:SA	º&Ğ[£me†êãn±ëúûªî™«Ëµ¦Ä•<Ÿº6ma‘=Y.ç¥ÀÅ:g¶ÔşÉè…€ù°Ğ;«Iß»xÅ[”éI¡J\0÷~ÂzaY®íºîüwT\\`–íV\nÆ~P)ézJ¾©æ½üñğQ@İà[¶{rÊ‰µDîB„v—ï|i-¹EæøKŒ;^n»{êó½å:Nh;–—Ú2Á¨Æ€pçÑ´6“úƒ»ç½˜9§9¡¥öÖXÂhQœ~—ÛÛiAŸ@D šj‡¥î}ÑozLV÷ïçÑ³~ù•	8B?â#F}F¾Td­ë»áĞe±ÃzcîçŸFÅÀŠg‚7Î—Ûêà€ 6ı#.EÂ£¼áÀÖÂ£¥ğS£.J3¥ö5»¯KÉ¥óJ™§¸;¤—„n5¾¾:ySï‘ÀCÛvoÕ½.˜{ñğ	d\\0ë?W\0!)ğ'šû¼èEgá;à+»\0üY Ntbp+À†cŒø“ş£\0©B=\"ùc†Tñ:Bœ±Á¤úcğïˆşîÆï¸P‘IÜÈD¸ÂV0ÊÇ!ROl‰O˜N~aFş|%Éßº³¸¬…ò)Où¿	Wìo´û‡Qğw¨È:ÙŸlé0h@:ƒ«ÀÖ…8îQ£&™[Ànç¹FïÛp,Ã¦å@‡ºJTöw°9½„(ş†œ<é{ÃÆO\rñ	¥àùÚ‚\$m…/HnP\$o^®U¡Ì\"»¿ã{Ä–…<.îç¡‹n¥q8\rÕ\0;³n£ÄŞÔÛğç¡Ÿˆ+ÎŞ³3¢¼n{ÃD\$7¬,Ez7\0…“l!{˜é8÷á¶xÒ‚°.s8‡PA¹FxÛrğÄÓôQÛ®€¹†1Ì…¸p+@ØdÔŞ9OP5¼lKÂ/¾‘·¾˜\\mæú¸Äs‡q» îvºQí/§ÿÜ	„!»¶åz¼7¾oœ¿EÇ†Ò:qàV 5˜?G¡HO®âO†\$ül¾š+â,òœ\r;ãç°¾¤’~ÎAÄéŒ³é{È`7|‡ÿÄ‚Äàër'‰°Ji\rc+¢|—#+<&Ò›¹<W,Ã>¢»^òPğ&nÂJhĞe‡%d¶æìèÏÜCƒi¶zXÃAÿ'DÍ>ÉÎˆ¡Ek£Ê¬@©Bòw(€.–¾\n99Aê¯hNæcîkN¾d`£ĞÂp`Âò°%2ö¦½3H†Ëb2&¨< 9¤R(òÀ‡táTH¬	àz‘Ö'œ× oòÀ‹>4?Ô\rZÌwÊÓ‚ä×4ƒ`ºÈĞ‡é†µ³N‡ñŸéÓ€î'-IõÈì†÷0(S¨rØw,ü¹ĞåËKÊrÍÌ'-2Hlo-ÁUòáËâ_’'W#'/üÉHÖŸ¤®j6“Ì‰¡¡ÉàÈ«¶\0é„<‘„ÚúŒj1¤E’QŒTÜT­ÆrÁBcmí16ãÍˆgÙ«:w6Í¯›h@1ÅI:¤ÃÁ’Éş2ópò’L/ÎÁŸÂwÿ:òÅ‘ÓÎøK<ğÌE<‚şJ­76Ó€s×.Ì²sZóß/\$÷AsEyÏœàrÚr:w?Õ‰”!Ï?³áêÇ™ĞZ“MÍ9»Õ\0ÏÁ1?ARÍ¦%Ğ7>ÖMÇARr}sé€ñr)\\t-8=³öÍËĞUıË,WOCsÕ†„Ğ#w½5®á¯ERlM*¯D³ç1ûÑ>]ÏÀgK¤²V¹\nÜ\\èÜÓsˆÜ‡8Í¹seÍ§9­soÎ~„ ìów4xàŒ†’ñf@×ĞÜD­ö9€‡ÎÊ6¬\0	@.©î²@´9\0ŠC;Kôy+ÓJğ“ÜÙ¥ƒÏu<\\û`òc{Ó‹¤E£>ÿyÁJ=lŒüïá/…-—7˜ş”ĞZ46¨uC5™‘PçÎ©´RVĞòæ¡ÜáĞıÊ³lVøÒaNxû`Õ´?UÛ7(HP“}jVØJëzNQJ÷S–¸±s-gQ!a¥VØ_SwRıOõ3am‡ZXwZÍo‰'İwa­‰ÖOØoZµ“õ!Ù[\n<ôZ€µO¥Ò¶'ÇÅOmo÷[×Óa=Qºä>‚:õTĞ\nµ¨ç\0Š=€ım×jú–ATÃRÅbu(ÈI×´è:å×\$v¾Wõ×µÃğuÅS¿\\V8Øçvç\\õ•×g!MĞ¶¦uÅÖ_µ&Öis¿\\CÿRVM¢]tXT7\\UoT×Øo_Ô¯İ›S?aÔlÈSØ-LutZGeÇÕái`	}XZ‹i}Q•yW[i­…TŠöYo¦ (ZE\\¨}nÙi—f–‘Ú‹ÙÏW×dÑ%Tıpu3uÍTıf5)vˆÛ]ÕUR3VEY]¥X¸\n·^½§VqS½Sı}XéiGf•Úv>­Sı‚v»JMQšvÚ•Š…ÔÙ\\•g]´QYE“Îİµ#1Vÿl5UØEK]ÕÉ\0³ØİSıU?\\ºBwS•UŠ7–´ÕmZ½V5\\õ¹WfıÂÕ§[¥eUrõ{G\\µıUµÚ,„Éö‘W…[]xö›V×j5mTïV×jİ~u7Ø\0ûV¦UµØ'tı°w?msİÕÔÉÛ5VİÃvİq}Ùöáİu-UqÕ]İ—c]ÚWİØõ]Tt:ífŠM”k¶“e]î¹[-p}^ÔI[©XDãéºåY¿V—dõÀıO]	seNõ£ÜßZ¯WYÚ[Õt…ÈV?ò3ŞÇµßM“öñİ™`Ğût^w£d²:qTL•@@>]Áj\rFİqvµİ-Lv´GKwiôLwIPMo”ùÇ¹Mgv½ÿø[§Uss¦~	èõ…w:BâA‘ŸÑNEù{ä!-ÔÃdıŸo\0´’}&Ş­hXÕÎA–5µ%Ù£fzLÖHÙ5d­” Y…_%…v´Ó™!mšÒ]Öë•ØÒÌ%üñßò€şå=B©>E [#^}öhYFÛa·ßÆ>{¡gS…¶ğp[ìF÷¦ÏDaë6næ´À¶x9«¥8LêIãˆ«N–a=ˆSÊ@úbPk¦.™áNòøHù”l\0ú†:àğè–îŠº2#çÎ˜;¼í®vøO}€9ik]	&®{õ‰ ø«ÕœÙ2|a—·&óãÔÇåÿŞQ½¥ª±ÌîÎç¨)ÉñµoÙ“Ç¸:é&.\0¶5q\0JĞL½é‚64hy€3®Ş¢«¹˜a®Şƒù‚Iz†ÁO‚—–ñ„æï®ˆ\"á¶yB»Ê³{ª3Æ%˜5r(mØÈàÂáÇx.7rÒb%Á‡ü^ e†M€»¢2®\0x—½!‰b}.®âY6\$qS”Ï\"^|xE…äÈøaãş‘¼À€ëXÇ¡5‚9†'T‚R	Ãc9ÄãèW¢1ßáÑAÎ”Pí¦ŸØh6'Şoò-àÖËpµ¾T(\nn\rËÅ“å1Ô„RïRUgÛéƒÈş™“çx¨•Pe#îé*¤âkT<Ÿ<>b;‹“\0™Á˜gL½.<k©ZváÌ„ø¯óz³¶Æ8~¬ğy7€Y¸ïÈêÜ7w¨áOdnÒ>¤<€ú›Eé3ˆ¦wS”Û†œ@¾¡ë® oôWÅ1…ñúñ¾Òº¿zã‰eíŞ½è±å1İˆz÷\0f=ØùcãŠ¤g¹Ÿ{éŞ>nŒp\0±ÍèÎ‘:Hé†BnŒ6FèÆB¯rçW=öãC>M.1~@3ºGí9‡8÷q<Sô|ûY•8QPâû`L[Öqzç˜Û«PÇíèNà<{_-Ù®¥dO¸ùd-îNB7ä4İîBùNÁí.Vº·ç9Æ¨Qø3º{IcP\$§»ºhû¾<R yy…ì?ŞòGÒş:n™ã€µôgÍÁœÿ;Ah!åÔşÁ&å»+>ğË€Û;MÁËŒŞ	ÍşşÃïÿ6SâîŠ·N¸ÚŒ=#ñëëñ³±`üTü#+ìnû;•·r,‚Ç½ğ¦ÏX|#ïÄ\rü# ïÃ?\nüD>¨|VüSñ¿ÂÚeÏ—~Jãm99…á¾\nsÆ{S|r],~ÿË¹ñøé¿ µqÏI?\"|wñ¦øÿ%|Œj‘\0rEò,kSnü¡íç¿øqÆ•Èd8B.ûñ‡1«Ñü³\"™ß/|Æ´€Øƒ]òüˆ¸­€·EüÏœèN²lüÌÕÆxÖËI°÷Ï Icó¿Å¸.|\$8D¹ŸF¨İÌ“…˜PÕKÆò€3ƒô\\j¾¥xUÏC/äã³Ò—¿A{¹ÀĞûşeüÚƒ€ÿÓæ×¶éÜ¾ÿŠÕôà\rpıU\nçÕŸWloÂ­Yâ{ÿô˜ã`]'Öşıs†Õ/|¼oïÿ×à3çÀrü}‹ö;Úÿ[ÊnÎ¹ûÿº—¿OíM7¯ÛÉß£Ø¼q¾µq(ÏĞ_lâqsN÷“yòûñÄçÕ;ŒiÀg¿t—‡ÅÎ:ÿıåÈëÕ™§qk‡¿íôá{÷Ÿß?zı¿÷ÏŞûêñMÈ—ßoıì'àj˜úïá†ãcøyñß„ıãøgß‡gkŒwÉâf8¼VcÔ7fAÌY‘³å+Kxñ…=gKAkşT,95rdã+ùGåÀºíÙ¯„…ñş[Òà%…AÅwæŸµú…½å7ùßåà¬…£%· {½míú8%_”şmú—qˆàVËË¨_ ş“%«!şEƒú¼iø~‘ù²h ú~»ŸCªß­~§ù¨%†„­µ—ç_¨şÙúåÿ·rLkD«yÌúŒğ~Ô?p1O!?¿®vÌ\\ïä±Pm©\"¸Ì<ûŒ¯ïŸÅúE©6… äEŸVğ³åÎñšzkîÇú¦9³zÉªßĞ~Ê/ìäÕº¬é!Q‹>ÿ O£åNmèğ3rˆç Fú˜l‘Òúe;¤Mãß·…ŸºÏ½_a ´!~C»¼f€úå¼b}3œ K¼føÜí. 	Ùä}.©ş»ƒDX	i5¿|úŒ?ğÀ=\0õ±?ï?»ø?£Ş@ˆÿÃ•£½fu~a^’Ønûáªy±Q;ï q¹ÌàŒş)€s’S½,\"G†\nu%ÊÇU­YïAKl\nÓëBØIÊ86VCcO\0Ö`}.x©ƒî„,-Ná‡@~ºèœTÿG›çü–'üÄdÛJƒ÷‚ŸÆy1ƒzl‡á½Ã¦f÷gõ·ùAB aõ!şŒM\\<ƒgÊƒız4Æ¿ìÜ@/³ŞCÜÃ‚ì@õ	¯Qq÷)¤ûxäÁ/Ã.7inD±#=Àœ *79cÂF²ËÑd2(¶ .ÀV€À3µ¿ùÚ\$g`ˆAá§‹rl|øm˜²¶b§‚/¯qE²›ÕÃ´!bU@œ¿9iâ;ppÊdííÛ×¤=ğ1ùy–x°x	™=€v=ø®(v±ï¬s_œ³BoòÉ‚ãÖ#àK\r nñîÈ\\—# Ûf˜PXĞu-3&«	½›J&,FÊ(9¶v´0Á&@khZòy¶gîCÔ‹€z Á”Ãã¦hi=¡s9TñÂ eT>gŒÂ3ëdŞtFûö2b&:¾ğ\0ĞP¡÷€B–š-¹QËº8~ÔLSÆMàˆ™Ú·cgĞÎğTh'òf(Ñ³Ğ\$¨.EŒ«§VLÀ°·œAıI¼ãÃßŒñ†¹¼râ¦ãêgÛ\rÜÙã0§¶œ‚ëTëÎ1P`1’dÔâôÕÄ\r¦4âÁÚ=6@FüÁ¼È F±Ìñœ=¿É‚6ÏA¾Â>åN¥AVß	èÙÚ(\$ÎA/¦·ØÚõ¦;¦­çÚ?¾gŒf^	¬\nè&ğKO³Æn„{]õĞgË›Î8åc¬ÒÑ„–²Ï·Şı³ÿ‚\nÈ7LĞŒ¶‚t:ÒÑ ³hF°VO\r³èJú)bƒ(\"OBÌm°	oØß\$]T„SHÎZ^½õKŒÿ©äwğ\\[A9('ÒÙ„cÛ‘â­Üàb0‚ØÙÄ K’à£åà²srB™x\nè*BaÆz6oƒ\ry&tX1p'›^ƒM·¹<âCg¹`Ì4Ã8GHõ“zd?gX›†.@,‹7wÃïÛ:+ƒTiUX16à“L¸Üs’:\ršLè6‡Á±ƒf—r\r`ãtà67~g°xˆgH9ãJÀ¿O=-\$ğ4?rÙª4½ƒ¨¡O›ûè:z¦§{ÈşD`ó¨‹Ğ21FŒÜµ£Ğ(DòMÓÊ;¥º½ñ&–¡ÍÌ©ÔÚ­¾ƒU>ÎI˜6‹™cİÄò›ß¸@\r/œ/¸¶Ô•ıó_HÀƒ\n7zë ¶ü€“œ‰7òaî É»[9D¢'ü„¿ì}Bÿ€O›R‡ôİŸ¸B#s“¼]z!(DÀ“Å@L^„ı	û³x£İ@oá¿u„OäïÁ¥D¸ÏÜ!e`\na³k>´0`á„€Ì-*™ ˆ8E‡Z6=fÌé%¡™İ×cã›°”K=£ò¤F‡\rÊ…ÂShèyNò[v*vá\rÁää@#ß¸í‰ªAh*ãL\$°À±AÀA\\”¢‚úÓ%Á*	ÄçpŠ\r*==8ì\$Wî\rƒ [±“Jx0yñÛZÃ+&YÙHA~A\n,\\(Öìp¤!F¶êÚ<6SØ&IP`6Xzü+í£dfŞ\r¾ÏJÂ£€ŞÌië•sã+Ò&5¼å/rE…À£M^\$R(R‘QÌÒEw3‰ôlH*m\0Bq¬aŒ¯rèêLB“ª¥Q¹z6~lËùB‰\rIÂ®GøæXÙ¸XVbs¡mB·Hª×ó™ócî_Kç\$pæ-:8„•Nj:ÂÑ…Œ¡-#¢Få	\0’aiBÆs\\)Î<.!Æİ\\ß‰N‹ÒbIw8§Í¹t…øPjWä¨`¶‚y\0ìİ&0˜i?¡ˆÃÒ”:«Ia)=’C†,a&ºM˜apÆƒ\$İI€IFcæ­ç\0!„ƒ˜YÄxa)~¯C1†PÒZL3T¸jİC\0yˆÒ¤`\\ÆWÂü\\t\$¤2µ\næ+a¤\0aKbèíÎ\n„˜]àC@‚º?I\rĞHãƒ®Ks%ÏN©ğ—áË^°ÏÔ9CL/š=%Û¨õhÉÆ:?&PşìEYÒ>5¢ín[GÙ’×%Vàá»*ôw<¥ù­ÕgJ¸]º*éwd®]ŞBŸ5^óÖ¢’OQ>%­s{½Ô…ç•«;ìWö³‰ÖzÂGi®ıÀ*»ùRnìÑG9ĞE°Š¢Ş,(u*°±Õ’Ã—€ŠXÕs«àRŒ¦¦:µ5ë;”æ)°R¶¦ÍNúŠÈvKØ(œR³İM¢œÇbğîÔé©_‡{ÕF<<3ª:%ºÙHVëYS\ná%L+{”o.>Z(´Qk¢ÖÂN«!Ãì,‰:rH}nRÒNkI		ª‡[ò´Ìë’Ó§gÎÎÖ¤;mYÒ³g™%ñ9V~-J_³ñg²­•©Ë\\–É®£Q\n®–!õt«\\UY-tZn¨¡d:Bµ°Ê½Ü*í]')t“²¥wÁù–É«[BUm*Úr4†Ø–Õ*yv¢¶ÁvZÀÕ¹+GHÎåZn°PÂÜ…|\nT¥ %#\\·AX\0}5b+wr«XwÜ²1uù×%Cg=I­òv`creË0`..<·êğh‰+ŒHÌ^\\j­yFòİ%Ê]¹BÊ\0ÉrÅ+€> %Zx¹š æ%C.ªÃìÄ`Vn­1KS¾¥Îk\rƒõçX|´õ[Ì;õ6H	U@©D:Ş»Mj	Î•ÛÊ?ıª]Ú¤Øˆb“A+ÔÅG£\0thxbşÆL`”ÅÀ64MŞ›ÄôŠY#ºhfD=e€Øw=´c˜+H…ñ¡¡:„.%ü^\$òDZrAzjÿfLl›7’o¬Œı°Û\0¨-äÜ³EdäŞ‰yz'V ­“Ó¯W´	Zö§K˜+°d(AÌfyŞP?‡xRš^hõ…¸'•æàA\0ˆ¯:p\r„d(V±ŒÜ½šdöt	SîFcHÈŸ¹]r¢rÊCHY	X_º/fƒŒİÍ½ 4 7eÚ6D³{,ÑèşêØ<<Z^´İj\"	éµ\n+Æ€M…Y9…’A‚(<Pl¤lp	“,>Ğ€¤{E9Ü&àGhšh{(ı±Agg8 (@ŞjTûnËg€Zã†ÙÅ°ÁJˆÁŠ³x¦˜Œü¼@ic¶àÕ‹ô(pƒ'oJ0MnÄ€í&Ê§³\r'\0Õ‘ø„\rqÑFè4½°Š)ı½cL˜§ş_ÀoJÚ}5ïÚc–o¨àà|6„m¾}Qª£á4QëÇb„·µ[úx«m( İ&µ@ä;Â+ò˜¥®ÚÅf|IÎàõ”RĞ48… {	`øè®çk`u»r`èWã¸±`\"´)fI\n©Ô;ò8ZjÍ‡–gğ~¡šAÎˆè!j¼Ä%ÄæT ÂE\\¯\r3E“j‚jê¢FXZ	âÏAyækH ØXdğgCQ“–±´áÎ€ş0ğd”ü²¨°ïû¡†út¨	œÇzkÀ`@\0001\0n”ŒøçH¸À\0€4\0g&.€\0Àú\0O(³ÈP@\r¢èEÄ\0l\0à°X» \râæEä‹Ç8Àx»¥›@ÅÔ‹Ö\0À¤^˜»±z@Eğ‹æ\0Ş.¤^¨¸Qq\"éÅà‹æYäÂD_p&âÿ€3\0mZ.Ppà\r€EÏ‹÷sˆñv\"éÅá‹ç0´`ø¿wâñÆ,óü¼_¼`\rcÅâŒö/Ô]x¸q‚€€3\0qÎ.p˜ÂqŠâğ\0002Œ_ì³i„ˆÄÑŠ¢âEÆ\0aŞ1äbÀÑwJ \0l\0Î1,`ˆº1y\0€9#?0T^ØÇq‘£\$F6Œ/\$d¨¸‘‚€FDŒyJ0b˜»\0	ªÆWŒ¾\0æ.œc¸Â‘{c EØ\0s†3l]@\rbùFŒ\"\0Â2ô`˜Á‘’\"ñ€7‹µÎ/à\0±š¢èÅÓa	^04e¨ºQ{c<ÅÑŒÉj/_˜ÁÑc\0001Œµ*28BAàã\0000ŒxÆ”iØ¾1˜£F50ljH¸‘™\"éFŒ30\\_ˆ¾q™\0ÆfŒ¡T³l_0Ñ‚£BEÄŒ#3ì]øÒñs€Æ½‹Ó†64_XÀ1–\0Æ½‹ñà™d`ø×`\r£SÆ_JMV/f€±­€1\0005I6tf€°ã4Fª‹Á¶34fà‘ ãF-‹ß’6Œd‘±\"÷€4k½„\$h¨Â± #EÅÌŒú\0Ö6¤_01—c@F‹áª/d]X×Q£#G\n‹÷†5¬g¹q‘ãEF\nŒm\\ÂDn˜Åq½£YFv1/4`øàq½ã€4=â8b×q|À\0004‹‰3ÄmXÁ1‹£e‘ö\0Åî.¬\\èàQ—cIÆ	·.7ü\\xÖ`\"íÆ\0i^3ğ(ç±’ÀÆ\"Ev4l_ÈÈq®Œ\$Fñ‹±àœoÈ¾ \r#UEä©^9ütˆÁ‘¹¢ïÆ.\0Ş3|rÈÄ1¿\0Æöù69l^x¹Ñ¼PF-]\n0ÔvˆâQy\"íG‹³2,sxÁQq#™F+Œ\0Ù/DiÈëq}£ÀÇ8[6,jø»\0cmÇo×N5¼ehàQv£«GL€H<T_ĞQ®£?FÉ‹É..\$føÛÑyãšE÷ŒC2Ül¨Û1s#ØEéŒD³lohÙÑ²£j ‹²Â8Ôe¸Å±ÔbğF!õÆ9Ü`xÓq¨£§–CÆ7ÄhxÕÙ£ÆÅ»ú7œ^xÍñğK<Çhƒø	,uØé±‘ãG)Ú;luàÀ#îEß¹ş<ükÛÑíbşÆÜ\0sR.¬w¸Ö±#zÆ~w’2|x(Ú÷âğ\0001'†:Üv‰\0001‘ã¢GæŒ¿¦?|`øò‘£‡ÆóÛ .2¨XÜÀ#“G¨8KÆ@<z¾1–£Æ¹\"9|jˆÒÑĞã	G¤/æ6ÜqˆŞÑö€GÁsÖ7ù/\0001‹büÇßí¶:|ƒ8ÚQÚ#~F»W‚4ég˜ÌÒ#<F\rµ š2üƒXÁQÌ#ÿFvkî7´xÒ1Ú#ÎÅÆ›¦@¬rhÜÑÀãêF”íZ;¬fÈårc¿y‹‘!\r	ä_xë1¿\"üH1Ï¶0TwèÙ²c\rF1 \n8dX»rãĞÆÔŒ§Ş2Dbèı±{d4HˆŒrA<~ÈÙ1±dBHI[J?¼¸ÅÒ£qÇ~kº0ÔtØØÒ#„F\r#0\\h¨î\r¤GÈí’EttØè‘íc7ÈUŒ¿!Ö=D_ˆèòcNÇ\0‘yÖ6aÙñë¤ Fgç!v1ÌqØÈ1ØãKÇ‡»â@äeè÷Ñ³cGoó\n/¬ŒøÆ²ãˆEã‹Á\"3t`©ñö#cHµ‚<ÜcøÓqâüFî%†?Tbè¹±°d)Ç‹© r0‚øÌñqc¿Eøã>3\$tyQÒ£…ÉE’Cl`9)¤VFHMJ7”føöÄ\$HHQ ;üri’7#F³-F¤HÆQ÷#\0G·!‚1ä^Èş&4¤vG&‘û7Ôgèà±ƒ\$\0G\rr/ÄdÙR¤(Æã‘s6@¤“Ù'RAãÇ¬›È”Œù&‘¢¤–Çg\0k z=´|HÙ±Éã‡ÅàŒÉ^J´]ÀÑsd¤Ç,\$’1”¨à<cqÇ¦’ŸêJœ_øÏÁbçGˆQvJ´¸Ø±ŞãH5Œ¢FôpÜÀIc¬È[‹‹Î@ÔrÈÏ¤vHå%ã¶3D”¨Çòc<I\$M.d—Ùr1c=F÷.4„cˆÕ2béG.Œ!¦L|{X×Ñ³£{I«NFôdx÷qscŞÆİ¿#şE¼a)‘Ñ#¹G”ƒJ¬m¹.‘û\$=Gh’AN=¬s‰ÑÅ¤EÍ‘GşG\\a1ò0¤ÛH¡‘ÁF.tg8ê‘Ã¤[Èòÿ¦Idn¸şò8ãF€‹ÙÖ.T’¨ûñ·€F3‘Eº6riq¸ãsF¼Ö6ÄxºrãÚÆL=nFTÒod Ç>-ª3ô|©2\$ı0„‘= â:‘xc’HËI\"NP\$b¸ÛQñ\$Fñ ®DÄ‚˜æÑïä}FêŒ%ª?äŸ(î£êÉG”3\$‚O\$^xÂ2T¢éÆñÕ0Œ¡ğR’‹Ì#ÈDŒ:„òE¤|i/2Œ£XGˆ’”’8¬•¹-ù\$HÉv¥Ö=dš‰ è¤Ç`’ù’:laxäÑú¢ğI¦¢:ì—XâRJ¤Òñ”ÒRÌmxê’J#\nGG“9!N¨ä{cIõ’Ó&æI¬ éR=£€I\rŒù&j:ä‘8ÃÒg#¸H‹á'3„_x¸²b¤H}”£>7ƒèèñŠcÌÇÙ\"&K<xØÊ2¡ãçH†‹¥\"6@dbèë±­e;É)Œ!–.Ä]ù/ò‘d—Êm*f6,v©—ÉªÊ‹£ªLäÉ(qµ£AI8”7d„9TtcôÊ’‚UL•XÈò%H¡”I*z:Ì|IXqsá¨ó-ÂBĞÅäq^(•R¼»aq(~eÑñ¯§ 9JèU‡+-eq*nTà­Ğ>¡\$ÕÑ«er’•Î±¡p\nÅÕ¼Ë\$es+îV£IšºÇb«øeq:ß#]•cc®7r\nÙf,gYø³TC²%Œñ	Ô}Ë\0–²©\\*ìEWPæaè:ÏE¥,&WòÆp)Å¦Ëxl²MáÂÄ3\0t\0¦/IipñD'\0	k\$T¤¬F‡¤]fºÍdMòÈ€K\$”¼ıH(@îÉ”‹»(–zµnWÒ¤Ù_ŠMİ”*º\0¦eÙlF™^H	W*B––ZPe½ÅÖ˜‡ÓR/dRÂ—RÊ…\0Ku£,yH)¶\"SÊXI'®¹Zƒ=çLøRå3åÄÒ\nÀ'š[kğ­Í6@;}R”íıI²ò³ô¬_é) wê‚[óÀ û\nß´n–ª¼ŒÊ“bBr¸l,\$vÖíÍİÔ°‡ˆÀÕH©à‡…\\¢‹Ùs*È ºå–.Qt’B…ºdˆb‘½—@ï?3¼S`a@¤Kª\\.«´à~Çfª)¬«¨ï,?|&Ó¶KÀ£…Z9.İX³+S‘â|ÀœØ\0PÊ¼¢ŒE“òçe‚/Ê\0VëÖ^KÄ\0\n-	:ËÉSØ²)×ªû0j‘9TX•åBğƒ½K\"åÅ¯±•Â²,2Æ'‡2ËåÖ˜P,¡xŠôàpÀĞáKê—ª´š›õ\"ÊD¢#TV²œD¿õ1ñAo;Ø•×/9TH%V`WJ<9˜¯aeÊ° K/V^/¨Q†¤Ø\nBñZ\"9íËÆXÒ¯M~\$°5„ŠßÚ\$0dè½I€U“Í³2¼^X\n¼*ãE7I\nV3«–…+ÎaŒÃIiÒÒNËKK˜g0’aŒ°„z*“V©º#bJyMÒ¦eõâZ– …V ¢`’ĞòĞU1ËC˜Ÿ.\rF²ª-jÎ&LU˜p§9s‚é¹Š+Q&1¨âRm¥ÕÓ±gZª²–	,.XryZì²°0¨ÏÜ3¬2˜A1©Ö‚’e‰Nû©¸˜ú²(?Al ŞÌ,Nèue²Ï\$|rùá_%²ñE05E}³\$¡Ü…X2«%ÚZªe €\n\";<9a¾hã¶¥àa]úÊì™8±à*éu¯åÁªL¥¦¶±dR¿ğ0«¸Áª+ŞQm.ü,Gù–«¦M®ï_±2åedBêÍİ¸,°S…2Á²>UÕêëÔ°»4vlë~e2©ò2¤eÄµËYg2nf’=Àş\$%óÌÙ–Ffaìµ)‹ê§å”ÌfTÆ¶áG¤Í×g2ºW,[™šíÊX>)tÊA]œº™R*º&Z·Å6j2|‘¥\0 °(©p	ê9× ÌùuÒªô?ôĞ`nåœ-lZnë!H9²çæzLğš¢9VLÏ¹yÒĞİ¢ZØJhR›‰g“EfL©UŠ²~`4ÍYˆçæx)\$B±QR#Ã•Sê”¥ËËõ,6i#ÀY¦“,;C±šr¬âiÙ&ÇXªû]èÍ\nw54­K‰x\n*&©Tš£îWüÓùŠ“¦©+SĞ»qNc·yóIWä¯Û\0W5cÔÒÉ«‹ğ&+š¶ğVrå)¬êÎ£Kgšª¾Ô?‰ µŠ“¥|«gR¦¯†hR´%Kë¹œ)Z#‹5ä,Öµ–k…æ¼»`šìl:à•LsC”[M‰UB©6ldÑÑ“J¦°ªŸ•ï1nl:ºù•j¦ËLß–¢\0®hã¶ *)¥p/®šŞ§5\\”<9´óV¦…/‹šŞ«®hTÇdjµårMbx\nˆ]R¹çWªR‰ MaUµ3=×µ`0³oÈË,Z™¬³lÀÅ}Èó¦m¨ì›”í²lôÎ´ÕmLåS6ê\\’tÎ™¹òºèL—îÉ\\Ï%‘J¶”ƒKå™ñ7oÑ©Ÿ¤ef€Mš£’oC»Y¡“væ…­NVÃ4=RÑ¢sJİÉÍö¬¶*hÔÕéhnäæ-m›é4‰ß4ày¤óHñMû›|îÊis¬U=ƒİÚÍA\$Ú­òi¹Ï™¾“…öÍ>–êîÊpâ¼pûóQfø«îšÀ§ªq,ÔÕ5sŠULùš£8}İ¬ÅÙª“Œ÷#ÃXH±ÙİìßI««î§¼9Uµ8íc:³I»îíf´ªĞ±7Òklä5}Ğ÷f¹LY•ğ¬áN2Ş°ó}&½	išê®ñc,åI¹3‹ÚÄRœ©6räØ‰Ì3b¦ûÍœÇ6>lXY¿ûfıLœ)+ÙS,Ù‰Ì*ùelÍô™U\"edæº\"ZçªÚ–6’ZDßE9°á%ÈÎ‚›Y9rmtãEĞó'.M²[4¬‚^„åÉ·ë;M»wÙ5…×Í9¸Òóa¬¦v+70lÍÉÓÓd%£Ì<œù3Š_<é•lN²¦Š(€v+7YRlÎ…Óª]‡.•Õ4©I³®)¼³=ÖƒN®Tš]Û¹'U^Ó?çS«¼½7¾XC®Å©Ó¨Õ1Íu¹9©E´ß™²kçL;œ¤NhÌìÀSİqNXk;1[„ÒõÓLgpVœBî1_¤á¥ÎÅgs¬ š;­RlîÕEˆ×ßNğTÇ8öw,îéÅs¯•1ÍPxrëŠq”ê‰ß3¦¬(ª;ñZÚı	yÓ¾'{O	_´¾êrï™ÈªMg|ÎIó92eLçÊó”f¼O\rYŠnkÜåuŠ™”SNÉv9Vkâ“	Ë3Ç§.Ì›v9zydæ)á“¦ÈNĞYì&s\$ìùÍjd'6Í”œQ<ÍVÜç)èeç+Ï›§:ÑØ¬êYjt¥¡Ãp‡u<±İÊ–Éß3¢]qM°Y:9XãµS³¾gI«Ã*¿mäÆÄCëùıv GßìÜR@ÀÖ¯¬jT—=¨:e ÛÀ(\0_Vn©,?p	3Ş'Î ™¸¨‘Ø™ïÒ\r¬†•¼ö|\"ŞiğºgT’nşPçš¤°\nÓ”åq,ÛSf¸.YĞµQ A¼A‡,ZÊÚeSå›˜sEÀì\rú‘v„T‹¬QŸZ©\"pó²IósëUAÏ›\0¾ëvZ¸}®rÙ¥KŸtféPäf9ç–®¸{¼¶^J€çßÏ‚Ÿ”¿šø©•\n0%«€NGÚ«*~lüD.»¦ÎKeŸ¹6¢[,Ô%ÀˆğOÕ˜É-†~ìµ•–óú¥j®ŸRO;úŒ@	Ë¨en›b_¾%sK¿Åœë‚ÃïYÿæºÎYÑ0ü¥ÃLËWª¦jrßÕóèÏ† ë©!BšÙñ”æ„Pv´£fwÚ«Éø€çãMÃR2´2€zŒ4rúh;Ò#M@…}…\0‰|ëã¨MÃ\0…=Ú=å¡àf-!Ÿ6pÊ g[P4‚´†ÌìóCÚ[5:–‚\rµCt¨ÍÃ u@ıÛº<éŸäif„ĞNu¼n[ñ!u8j{&9Ku FQlR“iÀ(ËC ÇAä®™s4ˆë\0Y Í;fƒB<Ô{”å˜¼R_Iš~š…6ô×|MWTAí]4÷e@J­eÉP|[ú¨–r5*Áÿ—OÎ íBt½)¤ê¯%Ğ-\0Pªjm	usá§}Ğ˜Ÿ“Bi^©Ú*¦zĞ0YK.ù`[¯Yû2íÖĞ«—|°XBÑÅÁÓÁ(?Ğ—±.\$“l¼’³,æÎX¶DçÍ\nêëjæ¡OD ->_<¼¥ÕÖ‡Ù\0š£ÙÕ¬¥Ásøh\\…¡•ea\\Ó\0Êöeä‘™Yµ`¼¥´7UØ\"e¡ÇCYTìñÙzt:V9P™_š³…a‚Ğ•FÔ;İ€\0MŸ¢´†…2“eúëHCéĞóZ‘?îVò¼åœ'×¬å‡ä³}c¾Yüaõè„¬åı?Qh8	ğ´0•Q‡CM`ºŸ«ó6æø,‹Ÿ¢J‘eZ¾Z\"G—Wª¡u†–u\rÕ>49èKı—ğI%L–¹ÍİV9Ïü˜İÖ‰´øZë{VEOÄX;©áÑÏĞoàagPÂ\$\n²RX@}!-Si€òRª¾¢qzÖ	öêITH.¡Ôí\nk\nïš \ndÏ®˜Tº‰²>Ğ\nîÂ– ­?£E…`²Ì5D+f’?#z³…IZü7T[¨€Qs#ùDˆŠ\$«ÕÏPù¢ìI†	û3¾×*¼:İ9YI²ãH‹³ÔH®¬X«0åDŠ!u7J¸–m® YB}Eª°Š³¿—ç®€¢òr”8Q•ù\n}'PõSâ²	Q±Ğõáú¨‘°\$§Å`RÇ)^áõ(O€P\0®aK½µõômè3¬Š\$H.„ùX„ëñÔç)ĞV®™`”­Ú9 ¨.®Y™‘18âÚeUÁ’`Xç9‚´	Œğäç\\Lcˆj°IE Né«ª¦6€W¡D¦XBØ	Z‹:”|Ï¤:	E-P-Ú&ÎÁè¿)ú†ğ§ˆ*ÓúÔlÀ)PÂuŒy|R°³Lhÿ.p¤§é_* QA †@ ·?,Æ§êYêÖ)t‚Ñ‡œ<íÁP*êåÜj’VuQş:2\0L¸?JëçèÑ,TPHL²ÁúE%–¬\0ª¢yP(YJZ¥î©úTHÅX\r	•Q4hOÒ;\\vVõ#åÀTWw‡ï\\`õOÒ¡Å«?ÒJR2³ò’=õFóâ]»ĞŸI5TMjIë9é,(Æ¤Dv|tÉ)ŠWy-¦]z¨Úe‚Œ‰a,pQ6\$ëI-g=%‘SÔW#íTP§Ü¤É)«T&]ŞÑõX15j†”B8„„æVÏÓ¥\nìem y“”h›*è¤ü»„°dç4Ï‚·bd!0¤gR”J\\Í ÖMtƒÀ1R\n\nïâxè¡èÜÁª.ö_¾üuò+Æ¼Ç;ı‹*4ˆÎ¸)]À\\¡lÜ(m\"ñƒQ†nTˆ(*\0¬`ğ1Hì@2	6hàêYÀcH_ÌÚÈfğ?°Ğa«–7=KKdeÂt÷HàÀ2\0/\0…62@b~Ë`·\0.”€\0¼vÙ) !~º€JPÄT—Á½ô½’–…µ¥óÂ—ÚOƒ{t¾¾\0005¦¾˜/à¯€\r©ƒÁJ^ğ½0Úa!¶)€8¦%KŞ˜PP4Åé~ÓH’˜á÷ĞÅô¼Üí\r+¦Lb˜¥/24)“Ó¦GKê™e0ŠeËé€S1¦B¨	-0jfÔÄéšS¦wLÎ™Äiêd …é Ó¦Lºš\r1ºhôÈ©œS ¦—MJJÊht¾)¨Ó+?L¶še5n”Óé|FHŒÉMN—õ5êjÔÉ©™SH“ÕL–—å4É=TØé´ÓD“ÕMnš½6Zm@I@S`¦)'ª™Õ7fòz©ŸSz¦x~OU1k”¿¤õSF¦ıMOU4ªpôÙ£2\0000¦ì¾7…6ŠkÑ#xSl§'Kâ7…7\nl”ÍãxSu§LR7…7šstßãxS}§GM7…8*qtÓ#xS†§OM\"7…8ªuôë)ÆÓ\0¿’š•9úr™)ËSr¦‰2šı; ôğ)ŞÓ7§Nj›m/Šxç©ÕÓ¿¦sNÚ:jy4¿©àSª§gO:1ı=\ncTö©§SÍ§•’œ•;ê{ñ¥©îSÈ§/ORH\r=ÊtTôéŠIİ§¥O˜¤\\zx4÷©Sò§‹MşŸ•>j|TıiºS¶‘³O†™¼š~ôĞ\$lÓú¨Oöš}tüÈÙ§ßOî˜¤šzÔû*%§]PPüšvU\"úÓİ§¯Kâ í@\noõjÓH¨;P¡>š1£éÿFd¨P.5BØ¸•ª\rÔ¨3œuB¹<µL#Ô<¨QPECÊu*\nÅÛ¨yPN¡´lª‚õ\r‹6Óó¨?Kú¢mBZi•jÓH¨›O2¢}1J‰µé›ÔM¨_Mş¢mDŠˆ€ê&ÔK¨ÇQ6¡­Fzv´ğ‹6Ó¹§éQjå;jµj)Ô*¨Ş¾£mEÊŒª9Fd¨ÅQv5eGØÉµd¤Ô„¨EM\0+åDêƒ\"j)SD©QÒ¤pZfµéÆ‚§mR&¢ıHŠ’U’Û%§{Rv0m0z”¥ä§ŸLÆ¥@ú”'ÖÔ©ER¶?eJ÷>é¸Ô¨İM’¥µIú•²ªYT¦ÛRõ/¥BÊ•.êUT»©YRÎ¡L:™jNÔ…©•Rš¡İLú˜5ji&,‰Oê¦mJDß5,ã9ÔÀ©­Q¦©Íè•1êhTf©›NÈ˜ÒÑŞ¥Q€'©Î7¾§Lih¸²\rcjÔŒ‘Sz§ušŸ\0nãÔº©g¶§Ø9Õ@cÕŒ\rT§%LÅÕAªfT­MT9uQ\nŸÕ)¢çU©µSº¨uD:“±—jˆU	©­Æ¨…PÚ–q‰*‚EÚªKSb¥l\\Ú¤µFª”ÔÅªGTz§gJ¤µHªSFª	\"©½Q:˜1‘ê›Õ©;†©½Rê¦µL*~EßªoTÒ¦\\z ‘„ª¥Õ:©­âª]Sê•±Ÿª¥ÕBª“U¨^J©uR*kEõª	ªıTêœQtê¯ÕR©g2ªıUj«µV\$ÅÕ_ª¹Sˆ³mPHÆU\\ª±TüŒ[UÊ«5JhÙµ\\ªµUpªÙ¢«•Vğ7a_*€Ó«¬=R‡>\0I*¼¥ô”V«íX:hU8jÉTæKZ’¬\\:ƒÕ)jÇT·«8˜±	åWZ³Ub’òJ8«R­=Y³UVU–«R¬¤\\:™Õ-jËÔÑ«iV.¦¥[z´±ÒªÂÇ-«{T²­ÅZªuoj×U»«3 ¡Í[ª±Õ>ªØÈ«E ­%\\º±µh#bÕ…‹©WZ®-\\º¸õCêæÕ«»W>¨­]Úºg4#¶ÕÀ«KTr®íZÊ¤wjãÕ\$«›z¬-Rj½õtjĞU*«ßWš¬tp\n¾4õ€ğ'–N•Mº´²ªxUş™X32[xò•+®“Ë\$B°US*½õqê›UÍªqXZ®}SÊÂÕxêÁÕ@¬-W\n5İXZ¨Õ…ªãÕJ«›U2±=\\úª‰ëF+«ñV‚0]XXÁUŒªìÖ0«¬-VJ¹²+Ö/«É‚±ÍZÊ®5sj¹ÖD«ŸUŞ²%bØÉµªÁÇ÷«V²%Yš^u@d¤Õ¢’“WĞæ„”šÅ²Rk&œŒñYR¬\\¤Å’RkÖY©cVÆO-\\š—	kdòÓáKoX²¥KÊÍ/ë9Ö]“ËVªO-U‰<µ™@İÉå¬¥VÎ³[Ÿõ›«6U¹­—Â=eŠÏµo«4Tİ­Yâ0eHÆÕ¤ª\rÊÍ9«¢•¬6à(ó®•+7ÎybÓrI §|Ä\0—:FzğÉè\n…§|ªœs<°R½%JÓËÔ]¦õFèµ3õ­Œ‰j¢Î£¹Y®µZ“¾^<5X·IJòÅM`×nO\\£B&¶r“õsÅçQˆuz¨¢x¼å¹è	¬Tˆ®¤VwÍJ5¸g	Ï?v¨qF4ï•9³Ó·»­Õ6ªzjùèÕ‡OV•¿\rÎuÊ=Â@Ê’fTÍšœğïöy´³	€Ö«pKaXU9šm²³…­\nekMo›Ã5\nhTŞ†ê¦¦…V ®¬v€‚ı:®Ñs®\\p>ÁÒLÓ:¦‹)ñ­O=nk}j¥Sõ«&·Ö®ª~µŠ¤y©àe”¬ÜšßZÖµñ)jØ®”t×VR¢Vµ½sµrÊ:+aÍo­‹,!TılŠUÏ•Ş*n­›5¾¶\\ğU÷dv+’M\\®)]B¶|ñJë´¦l;4˜¯5öpLÖùÓµØ¦7Liı[~bmtÉæSe€\"»°›Bº½v©´d“ç@Í§SÁ4)Ø’—Zï¼»\$)®ñ5ic!™µ´¢½ÎŒ–êî\\Rù*ßSD¦’Îw\$›9ætSÁ\ná”GfòPÔ›ÆîÊ¸´ßÚã*¦	KÍô­D·Vyû¹5ÍuÈ¦J×‘š\\šµC¹•\$“ÙW,¯M\\º»ôåÊæ5¬ëÓ–®k^•VÕsŠè5®k¡Ö»¯M^êµı{Àu°§Ï¤wFQàßJéHûgWN¡k8şºÍŠôÊ‰+¸»§˜¥1brÄíùË•ØëÓVÜX]dLçjí´YT™Îv®ç6–twyË•Şkò×ë­à«vx=…5àh»²ï½ô8—]ÊÁ‘ñË·x\"c|ĞufUÿƒşØ\0˜Ò§5ŞjÈ©}”PknÌšRl¾‰fÙªà+ò“ÑÛ£‚¢>c4Æ×W+TıDo®Òï ’Ç÷qî¯É€SX’¨İb}}Åhnµ&<Ï?™/3º”-Ã¡h†°©qn‰ı§	õpƒ%)SÉyP\r…ÛÍµÿm-Ïf5°Šº[€\\–=ÌTà}øy )ıç Ydç«Ø¤46#Y>¥3ÔŒ× šm©ú\n09h;²4˜°Â0‚Ã+ßae\nÈƒÄ°È!ÊÅüÑ)‘@ôx¢x}‡\$¦ÖßıAFŒúÃ‘²0Nö Rã	º°şÓ„èiÜ¥ü¬U¬?½¡—b5í!+×­\0G˜ıØw{¶îÓ¤—ïlI £)’w-4;p8ÂÎØ¤;@\r\n\r­…ÚN5Æ…F\\Ó¹hgPE il0¦ëX¦%’)\nˆØLkÈ^‚Æ2¢İ<5FØìd‰Iƒ<ñFÆj³bM¬d'á	¶Æ²D£âîBma²ĞÒö…ıOYñXgg¼8¥çZVØ%mf¬Ô%å€F¡-¥,É\nƒ‘ıaù¤FÇwfƒôs¹ç¬Ê0Gä¹‘ØZ²\n	1†;Jí–1Á\"iPñBÈy´C¬–Ìû²t—zÓ‰ãÑÖ;l‚4âÈÒ¡‚ƒJ‡”mLX²+lá˜ªõ{Â8¬\"â\nÌVÁÀšÄÛ(Ú\$Y\0íd\\İ†6›D9B´H±d%¦Óî–1ÛÁ˜6f Ñ\"ÊTJÖÚ`/²‡>ÊC=Äc“ì¨±¼²?e!ık*±3l~ƒÃÓiÿ«,×A‚z/dà¨¦MoìÅí´Ú²nÑ\"É½„ÍÂëÆzTr}eÙŒ{MÀaCÔ7‘fiTºõ—Ë/6W¢©P²ìÖÌ8†Fa`İì¾5³ó©¹M…f2V]œ['}cn4]h·íÖe«¦‹Z€Å§\r™‹2ÉÈ½XllGa`(­™—Û(‚ŠÄò\0èÄıšĞ_ölO˜ùf&fÄ1c8ìD{¼QæÜ	S6öp\0äYÂ˜æ¹˜™î\0\röq…3m&*fÎ;Ìpò6r^cŒÏ³¨—`Éµ&z€n^Ú±ù;DÈèSã¤oj^ã=¿L'g”5œ“Ä&ƒìä‡Ef&ñŞÏ|\nK 6?bX*¬.fÏˆEƒû–~&9Ù!˜çdŒk@‰v\"F¬Gšx\\é=ıEŠ7ïXP2[:Á¶\0ƒ×à¡ X~¦½7·ÍâX6†4²œÉ(Ã\";Bì\nŞıX×Ñhy¹Ì&›DÖˆÛZ¼l\nKC–‰íšŸ†pØ’Ä`mS®	2ĞU¢;Gà•‘8¶´{’Ñ-”±WBmì¸\$F€ø\ràl&B‡Y2\r´¨mAÅ‘°wÄZØ6ØRĞ’¿Ğ%d´ŒİÂÚ_²œTô5¦``BaĞÙG´ÕcáXKö\r¶˜\0­ØgN¼ù\\‘´¾;Nà¨àÄÚs^\nŒÌu§ä¿Ÿ­Ñ²VwzÄU F\"\0T-±,^’Î\0‹Îö—è2 /æ™ óÂÏàEW/\0Â¼ò–ÒÄ¾Ë4;\"ìK-NZš½ĞMcÎ»RVNeœZ¦wj–ÂŠ6ë¯a¶÷yÌˆÙç»‹KV®lN?±Ãjt2­–¶T/[íN¤û±j|0t% #°”€âÑ\0ôÓ`£ø5F<–´ƒ X@\nÓ¢Áí•ËZF\\-m›¼³cd2Äp5Gºv'Bß'¢7{kŠ*'LÜAªZ|I±k´\n-.C¢6¼«¹Çk•-¯×©SÚú°÷kÑ]¯Ë_\$…Ú+Gò× [^‡­­z]kÑÑ8›\\ö¿F|§¢?BˆØÁ^ÏB¨‰Ì|ñ™ë@Š­Â÷B¯¥zPéW/R?[!bB–á¹kÀ‰Ñ '	(ãe:xfàr‚7\r_íâq¶Maê\0#±ä7|éQ&\0É@)µô†À1òë®†LA[PtÀ\0œ™ı`‡6Õ\\e‘Ÿ¶zxÒÚSİ€vÕˆÏ€U:Ú±¿T¼Á‡ˆÏ—>fÛ\nq‹l€Å+K(|¶\\´Ñ G›UØ‹³Æ@(ğ*ÉiS%F¨\rR\$©•C¶¶LĞİÄö;ÉdµìÄ¼gë-\$m?ölhÊŠ3?PªY\0");}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo"GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0!„©ËíMñÌ*)¾oú¯) q•¡eˆµî#ÄòLË\0;";break;case"cross.gif":echo"GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0#„©Ëí#\naÖFo~yÃ._wa”á1ç±JîGÂL×6]\0\0;";break;case"up.gif":echo"GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0 „©ËíMQN\nï}ôa8ŠyšaÅ¶®\0Çò\0;";break;case"down.gif":echo"GIF89a\0\0\0001îîî\0\0€™™™\0\0\0!ù\0\0\0,\0\0\0\0\0\0 „©ËíMñÌ*)¾[Wş\\¢ÇL&ÙœÆ¶•\0Çò\0;";break;case"arrow.gif":echo"GIF89a\0\n\0€\0\0€€€ÿÿÿ!ù\0\0\0,\0\0\0\0\0\n\0\0‚i–±‹”ªÓ²Ş»\0\0;";break;}}exit;}if($_GET["script"]=="version"){$od=file_open_lock(get_temp_dir()."/adminer.version");if($od)file_write_unlock($od,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$g,$m,$jc,$rc,$Ac,$n,$qd,$wd,$ba,$Xd,$x,$ca,$se,$wf,$ig,$Oh,$Ad,$vi,$Ai,$U,$Pi,$ia;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$ba=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$Uf=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$ba);if(version_compare(PHP_VERSION,'5.2.0')>=0)$Uf[]=true;call_user_func_array('session_set_cookie_params',$Uf);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$bd);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);function
get_lang(){return'en';}function
lang($_i,$nf=null){if(is_array($_i)){$lg=($nf==1?0:1);$_i=$_i[$lg];}$_i=str_replace("%d","%s",$_i);$nf=format_number($nf);return
sprintf($_i,$nf);}if(extension_loaded('pdo')){class
Min_PDO{var$_result,$server_info,$affected_rows,$errno,$error,$pdo;function
__construct(){global$b;$lg=array_search("SQL",$b->operators);if($lg!==false)unset($b->operators[$lg]);}function
dsn($oc,$V,$E,$Df=array()){try{$this->pdo=new
PDO($oc,$V,$E,$Df);}catch(Exception$Gc){auth_error(h($Gc->getMessage()));}$this->pdo->setAttribute(3,1);$this->pdo->setAttribute(13,array('Min_PDOStatement'));$this->server_info=@$this->pdo->getAttribute(4);}function
quote($P){return$this->pdo->quote($P);}function
query($F,$Ji=false){$G=$this->pdo->query($F);$this->error="";if(!$G){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error='Unknown error.';return
false;}$this->store_result($G);return$G;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result($G=null){if(!$G){$G=$this->_result;if(!$G)return
false;}if($G->columnCount()){$G->num_rows=$G->rowCount();return$G;}$this->affected_rows=$G->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($F,$o=0){$G=$this->query($F);if(!$G)return
false;$I=$G->fetch();return$I[$o];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$I=(object)$this->getColumnMeta($this->_offset++);$I->orgtable=$I->table;$I->orgname=$I->name;$I->charsetnr=(in_array("blob",(array)$I->flags)?63:0);return$I;}}}$jc=array();class
Min_SQL{var$_conn;function
__construct($g){$this->_conn=$g;}function
select($Q,$K,$Z,$td,$Ff=array(),$z=1,$D=0,$tg=false){global$b,$x;$ee=(count($td)<count($K));$F=$b->selectQueryBuild($K,$Z,$td,$Ff,$z,$D);if(!$F)$F="SELECT".limit(($_GET["page"]!="last"&&$z!=""&&$td&&$ee&&$x=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$K)."\nFROM ".table($Q),($Z?"\nWHERE ".implode(" AND ",$Z):"").($td&&$ee?"\nGROUP BY ".implode(", ",$td):"").($Ff?"\nORDER BY ".implode(", ",$Ff):""),($z!=""?+$z:null),($D?$z*$D:0),"\n");$Kh=microtime(true);$H=$this->_conn->query($F);if($tg)echo$b->selectQuery($F,$Kh,!$H);return$H;}function
delete($Q,$Cg,$z=0){$F="FROM ".table($Q);return
queries("DELETE".($z?limit1($Q,$F,$Cg):" $F$Cg"));}function
update($Q,$N,$Cg,$z=0,$L="\n"){$cj=array();foreach($N
as$y=>$X)$cj[]="$y = $X";$F=table($Q)." SET$L".implode(",$L",$cj);return
queries("UPDATE".($z?limit1($Q,$F,$Cg,$L):" $F$Cg"));}function
insert($Q,$N){return
queries("INSERT INTO ".table($Q).($N?" (".implode(", ",array_keys($N)).")\nVALUES (".implode(", ",$N).")":" DEFAULT VALUES"));}function
insertUpdate($Q,$J,$rg){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($F,$mi){}function
convertSearch($u,$X,$o){return$u;}function
value($X,$o){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$o):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($fh){return
q($fh);}function
warnings(){return'';}function
tableHelp($B){}}$jc["sqlite"]="SQLite 3";$jc["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){$og=array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite");define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($ad){$this->_link=new
SQLite3($ad);$fj=$this->_link->version();$this->server_info=$fj["versionString"];}function
query($F){$G=@$this->_link->query($F);$this->error="";if(!$G){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($G->numColumns())return
new
Min_Result($G);$this->affected_rows=$this->_link->changes();return
true;}function
quote($P){return(is_utf8($P)?"'".$this->_link->escapeString($P)."'":"x'".reset(unpack('H*',$P))."'");}function
store_result(){return$this->_result;}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->_result->fetchArray();return$I[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$e=$this->_offset++;$T=$this->_result->columnType($e);return(object)array("name"=>$this->_result->columnName($e),"type"=>$T,"charsetnr"=>($T==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($ad){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($ad);}function
query($F,$Ji=false){$Xe=($Ji?"unbufferedQuery":"query");$G=@$this->_link->$Xe($F,SQLITE_BOTH,$n);$this->error="";if(!$G){$this->error=$n;return
false;}elseif($G===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($G);}function
quote($P){return"'".sqlite_escape_string($P)."'";}function
store_result(){return$this->_result;}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->_result->fetch();return$I[$o];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;if(method_exists($G,'numRows'))$this->num_rows=$G->numRows();}function
fetch_assoc(){$I=$this->_result->fetch(SQLITE_ASSOC);if(!$I)return
false;$H=array();foreach($I
as$y=>$X)$H[($y[0]=='"'?idf_unescape($y):$y)]=$X;return$H;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$B=$this->_result->fieldName($this->_offset++);$gg='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($gg\\.)?$gg\$~",$B,$A)){$Q=($A[3]!=""?$A[3]:idf_unescape($A[2]));$B=($A[5]!=""?$A[5]:idf_unescape($A[4]));}return(object)array("name"=>$B,"orgname"=>$B,"orgtable"=>$Q,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($ad){$this->dsn(DRIVER.":$ad","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($ad){if(is_readable($ad)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$ad)?$ad:dirname($_SERVER["SCRIPT_FILENAME"])."/$ad")." AS a")){parent::__construct($ad);$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return
true;}return
false;}function
multi_query($F){return$this->_result=$this->query($F);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$rg){$cj=array();foreach($J
as$N)$cj[]="(".implode(", ",$N).")";return
queries("REPLACE INTO ".table($Q)." (".implode(", ",array_keys(reset($J))).") VALUES\n".implode(",\n",$cj));}function
tableHelp($B){if($B=="sqlite_sequence")return"fileformat2.html#seqtab";if($B=="sqlite_master")return"fileformat2.html#$B";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;list(,,$E)=$b->credentials();if($E!="")return'Database does not support password.';return
new
Min_DB;}function
get_databases(){return
array();}function
limit($F,$Z,$z,$C=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($C?" OFFSET $C":""):"");}function
limit1($Q,$F,$Z,$L="\n"){global$g;return(preg_match('~^INTO~',$F)||$g->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($F,$Z,1,0,$L):" $F WHERE rowid = (SELECT rowid FROM ".table($Q).$Z.$L."LIMIT 1)");}function
db_collation($l,$pb){global$g;return$g->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($k){return
array();}function
table_status($B=""){global$g;$H=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($B!=""?"AND name = ".q($B):"ORDER BY name"))as$I){$I["Rows"]=$g->result("SELECT COUNT(*) FROM ".idf_escape($I["Name"]));$H[$I["Name"]]=$I;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$I)$H[$I["name"]]["Auto_increment"]=$I["seq"];return($B!=""?$H[$B]:$H);}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){global$g;return!$g->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($Q){global$g;$H=array();$rg="";foreach(get_rows("PRAGMA table_info(".table($Q).")")as$I){$B=$I["name"];$T=strtolower($I["type"]);$Xb=$I["dflt_value"];$H[$B]=array("field"=>$B,"type"=>(preg_match('~int~i',$T)?"integer":(preg_match('~char|clob|text~i',$T)?"text":(preg_match('~blob~i',$T)?"blob":(preg_match('~real|floa|doub~i',$T)?"real":"numeric")))),"full_type"=>$T,"default"=>(preg_match("~'(.*)'~",$Xb,$A)?str_replace("''","'",$A[1]):($Xb=="NULL"?null:$Xb)),"null"=>!$I["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$I["pk"],);if($I["pk"]){if($rg!="")$H[$rg]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$T))$H[$B]["auto_increment"]=true;$rg=$B;}}$Fh=$g->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Fh,$Je,PREG_SET_ORDER);foreach($Je
as$A){$B=str_replace('""','"',preg_replace('~^"|"$~','',$A[1]));if($H[$B])$H[$B]["collation"]=trim($A[3],"'");}return$H;}function
indexes($Q,$h=null){global$g;if(!is_object($h))$h=$g;$H=array();$Fh=$h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Fh,$A)){$H[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$A[1],$Je,PREG_SET_ORDER);foreach($Je
as$A){$H[""]["columns"][]=idf_unescape($A[2]).$A[4];$H[""]["descs"][]=(preg_match('~DESC~i',$A[5])?'1':null);}}if(!$H){foreach(fields($Q)as$B=>$o){if($o["primary"])$H[""]=array("type"=>"PRIMARY","columns"=>array($B),"lengths"=>array(),"descs"=>array(null));}}$Ih=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($Q),$h);foreach(get_rows("PRAGMA index_list(".table($Q).")",$h)as$I){$B=$I["name"];$v=array("type"=>($I["unique"]?"UNIQUE":"INDEX"));$v["lengths"]=array();$v["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($B).")",$h)as$eh){$v["columns"][]=$eh["name"];$v["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($B).' ON '.idf_escape($Q),'~').' \((.*)\)$~i',$Ih[$B],$Og)){preg_match_all('/("[^"]*+")+( DESC)?/',$Og[2],$Je);foreach($Je[2]as$y=>$X){if($X)$v["descs"][$y]='1';}}if(!$H[""]||$v["type"]!="UNIQUE"||$v["columns"]!=$H[""]["columns"]||$v["descs"]!=$H[""]["descs"]||!preg_match("~^sqlite_~",$B))$H[$B]=$v;}return$H;}function
foreign_keys($Q){$H=array();foreach(get_rows("PRAGMA foreign_key_list(".table($Q).")")as$I){$q=&$H[$I["id"]];if(!$q)$q=$I;$q["source"][]=$I["from"];$q["target"][]=$I["to"];}return$H;}function
view($B){global$g;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$g->result("SELECT sql FROM sqlite_master WHERE name = ".q($B))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
check_sqlite_name($B){global$g;$Qc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($Qc)\$~",$B)){$g->error=sprintf('Please use one of the extensions %s.',str_replace("|",", ",$Qc));return
false;}return
true;}function
create_database($l,$d){global$g;if(file_exists($l)){$g->error='File exists.';return
false;}if(!check_sqlite_name($l))return
false;try{$_=new
Min_SQLite($l);}catch(Exception$Gc){$g->error=$Gc->getMessage();return
false;}$_->query('PRAGMA encoding = "UTF-8"');$_->query('CREATE TABLE adminer (i)');$_->query('DROP TABLE adminer');return
true;}function
drop_databases($k){global$g;$g->__construct(":memory:");foreach($k
as$l){if(!@unlink($l)){$g->error='File exists.';return
false;}}return
true;}function
rename_database($B,$d){global$g;if(!check_sqlite_name($B))return
false;$g->__construct(":memory:");$g->error='File exists.';return@rename(DB,$B);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){global$g;$Vi=($Q==""||$id);foreach($p
as$o){if($o[0]!=""||!$o[1]||$o[2]){$Vi=true;break;}}$c=array();$Of=array();foreach($p
as$o){if($o[1]){$c[]=($Vi?$o[1]:"ADD ".implode($o[1]));if($o[0]!="")$Of[$o[0]]=$o[1][0];}}if(!$Vi){foreach($c
as$X){if(!queries("ALTER TABLE ".table($Q)." $X"))return
false;}if($Q!=$B&&!queries("ALTER TABLE ".table($Q)." RENAME TO ".table($B)))return
false;}elseif(!recreate_table($Q,$B,$c,$Of,$id,$Ma))return
false;if($Ma){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $Ma WHERE name = ".q($B));if(!$g->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($B).", $Ma)");queries("COMMIT");}return
true;}function
recreate_table($Q,$B,$p,$Of,$id,$Ma,$w=array()){global$g;if($Q!=""){if(!$p){foreach(fields($Q)as$y=>$o){if($w)$o["auto_increment"]=0;$p[]=process_field($o,$o);$Of[$y]=idf_escape($y);}}$sg=false;foreach($p
as$o){if($o[6])$sg=true;}$mc=array();foreach($w
as$y=>$X){if($X[2]=="DROP"){$mc[$X[1]]=true;unset($w[$y]);}}foreach(indexes($Q)as$me=>$v){$f=array();foreach($v["columns"]as$y=>$e){if(!$Of[$e])continue
2;$f[]=$Of[$e].($v["descs"][$y]?" DESC":"");}if(!$mc[$me]){if($v["type"]!="PRIMARY"||!$sg)$w[]=array($v["type"],$me,$f);}}foreach($w
as$y=>$X){if($X[0]=="PRIMARY"){unset($w[$y]);$id[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($Q)as$me=>$q){foreach($q["source"]as$y=>$e){if(!$Of[$e])continue
2;$q["source"][$y]=idf_unescape($Of[$e]);}if(!isset($id[" $me"]))$id[]=" ".format_foreign_key($q);}queries("BEGIN");}foreach($p
as$y=>$o)$p[$y]="  ".implode($o);$p=array_merge($p,array_filter($id));$gi=($Q==$B?"adminer_$B":$B);if(!queries("CREATE TABLE ".table($gi)." (\n".implode(",\n",$p)."\n)"))return
false;if($Q!=""){if($Of&&!queries("INSERT INTO ".table($gi)." (".implode(", ",$Of).") SELECT ".implode(", ",array_map('idf_escape',array_keys($Of)))." FROM ".table($Q)))return
false;$Gi=array();foreach(triggers($Q)as$Ei=>$ni){$Di=trigger($Ei);$Gi[]="CREATE TRIGGER ".idf_escape($Ei)." ".implode(" ",$ni)." ON ".table($B)."\n$Di[Statement]";}$Ma=$Ma?0:$g->result("SELECT seq FROM sqlite_sequence WHERE name = ".q($Q));if(!queries("DROP TABLE ".table($Q))||($Q==$B&&!queries("ALTER TABLE ".table($gi)." RENAME TO ".table($B)))||!alter_indexes($B,$w))return
false;if($Ma)queries("UPDATE sqlite_sequence SET seq = $Ma WHERE name = ".q($B));foreach($Gi
as$Di){if(!queries($Di))return
false;}queries("COMMIT");}return
true;}function
index_sql($Q,$T,$B,$f){return"CREATE $T ".($T!="INDEX"?"INDEX ":"").idf_escape($B!=""?$B:uniqid($Q."_"))." ON ".table($Q)." $f";}function
alter_indexes($Q,$c){foreach($c
as$rg){if($rg[0]=="PRIMARY")return
recreate_table($Q,$Q,array(),array(),array(),0,$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($Q,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($S){return
apply_queries("DELETE FROM",$S);}function
drop_views($hj){return
apply_queries("DROP VIEW",$hj);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
move_tables($S,$hj,$ei){return
false;}function
trigger($B){global$g;if($B=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$u='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$Fi=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$u\\s*(".implode("|",$Fi["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($u))?\\s+ON\\s*$u\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$g->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($B)),$A);$pf=$A[3];return
array("Timing"=>strtoupper($A[1]),"Event"=>strtoupper($A[2]).($pf?" OF":""),"Of"=>($pf[0]=='`'||$pf[0]=='"'?idf_unescape($pf):$pf),"Trigger"=>$B,"Statement"=>$A[4],);}function
triggers($Q){$H=array();$Fi=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q))as$I){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$Fi["Timing"]).')\s*(.*?)\s+ON\b~i',$I["sql"],$A);$H[$I["name"]]=array($A[1],$A[2]);}return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ROWID()");}function
explain($g,$F){return$g->query("EXPLAIN QUERY PLAN $F");}function
found_rows($R,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($ih){return
true;}function
create_sql($Q,$Ma,$Ph){global$g;$H=$g->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($Q));foreach(indexes($Q)as$B=>$v){if($B=='')continue;$H.=";\n\n".index_sql($Q,$v['type'],$B,"(".implode(", ",array_map('idf_escape',$v['columns'])).")");}return$H;}function
truncate_sql($Q){return"DELETE FROM ".table($Q);}function
use_sql($j){}function
trigger_sql($Q){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q)));}function
show_variables(){global$g;$H=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$y)$H[$y]=$g->result("PRAGMA $y");return$H;}function
show_status(){$H=array();foreach(get_vals("PRAGMA compile_options")as$Cf){list($y,$X)=explode("=",$Cf,2);$H[$y]=$X;}return$H;}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($Vc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$Vc);}$x="sqlite";$U=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);$Oh=array_keys($U);$Pi=array();$Af=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$qd=array("hex","length","lower","round","unixepoch","upper");$wd=array("avg","count","count distinct","group_concat","max","min","sum");$rc=array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",));}$jc["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){$og=array("PgSQL","PDO_PgSQL");define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($Bc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($M,$V,$E){global$b;$l=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($E,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$l!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$fj=pg_version($this->_link);$this->server_info=$fj["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($P){return"'".pg_escape_string($this->_link,$P)."'";}function
value($X,$o){return($o["type"]=="bytea"?pg_unescape_bytea($X):$X);}function
quoteBinary($P){return"'".pg_escape_bytea($this->_link,$P)."'";}function
select_db($j){global$b;if($j==$b->database())return$this->_database;$H=@pg_connect("$this->_string dbname='".addcslashes($j,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($H)$this->_link=$H;return$H;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($F,$Ji=false){$G=@pg_query($this->_link,$F);$this->error="";if(!$G){$this->error=pg_last_error($this->_link);$H=false;}elseif(!pg_num_fields($G)){$this->affected_rows=pg_affected_rows($G);$H=true;}else$H=new
Min_Result($G);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$H;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;return
pg_fetch_result($G->_result,0,$o);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($G){$this->_result=$G;$this->num_rows=pg_num_rows($G);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$e=$this->_offset++;$H=new
stdClass;if(function_exists('pg_field_table'))$H->orgtable=pg_field_table($this->_result,$e);$H->name=pg_field_name($this->_result,$e);$H->orgname=$H->name;$H->type=pg_field_type($this->_result,$e);$H->charsetnr=($H->type=="bytea"?63:0);return$H;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($M,$V,$E){global$b;$l=$b->database();$this->dsn("pgsql:host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' client_encoding=utf8 dbname='".($l!=""?addcslashes($l,"'\\"):"postgres")."'",$V,$E);return
true;}function
select_db($j){global$b;return($b->database()==$j);}function
quoteBinary($fh){return
q($fh);}function
query($F,$Ji=false){$H=parent::query($F,$Ji);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$H;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$rg){global$g;foreach($J
as$N){$Qi=array();$Z=array();foreach($N
as$y=>$X){$Qi[]="$y = $X";if(isset($rg[idf_unescape($y)]))$Z[]="$y = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Qi)." WHERE ".implode(" AND ",$Z))&&$g->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}function
slowQuery($F,$mi){$this->_conn->query("SET statement_timeout = ".(1000*$mi));$this->_conn->timeout=1000*$mi;return$F;}function
convertSearch($u,$X,$o){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$o["type"])?$u:"CAST($u AS text)");}function
quoteBinary($fh){return$this->_conn->quoteBinary($fh);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($B){$Be=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$_=$Be[$_GET["ns"]];if($_)return"$_-".str_replace("_","-",$B).".html";}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b,$U,$Oh;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2])){if(min_version(9,0,$g)){$g->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$g)){$Oh['Strings'][]="json";$U["json"]=4294967295;if(min_version(9.4,0,$g)){$Oh['Strings'][]="jsonb";$U["jsonb"]=4294967295;}}}return$g;}return$g->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($F,$Z,$z,$C=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($C?" OFFSET $C":""):"");}function
limit1($Q,$F,$Z,$L="\n"){return(preg_match('~^INTO~',$F)?limit($F,$Z,1,0,$L):" $F".(is_view(table_status1($Q))?$Z:" WHERE ctid = (SELECT ctid FROM ".table($Q).$Z.$L."LIMIT 1)"));}function
db_collation($l,$pb){global$g;return$g->result("SELECT datcollate FROM pg_database WHERE datname = ".q($l));}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT user");}function
tables_list(){$F="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$F.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$F.="
ORDER BY 1";return
get_key_vals($F);}function
count_tables($k){return
array();}function
table_status($B=""){$H=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", ".(min_version(12)?"''":"CASE WHEN c.relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f', 'p')
".($B!=""?"AND relname = ".q($B):"ORDER BY relname"))as$I)$H[$I["Name"]]=$I;return($B!=""?$H[$B]:$H);}function
is_view($R){return
in_array($R["Engine"],array("view","materialized view"));}function
fk_support($R){return
true;}function
fields($Q){$H=array();$Ca=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);$Jd=min_version(10)?'a.attidentity':'0';foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, pg_get_expr(d.adbin, d.adrelid) AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment, $Jd AS identity
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($Q)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$I){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$I["full_type"],$A);list(,$T,$ze,$I["length"],$wa,$Fa)=$A;$I["length"].=$Fa;$eb=$T.$wa;if(isset($Ca[$eb])){$I["type"]=$Ca[$eb];$I["full_type"]=$I["type"].$ze.$Fa;}else{$I["type"]=$T;$I["full_type"]=$I["type"].$ze.$wa.$Fa;}if(in_array($I['identity'],array('a','d')))$I['default']='GENERATED '.($I['identity']=='d'?'BY DEFAULT':'ALWAYS').' AS IDENTITY';$I["null"]=!$I["attnotnull"];$I["auto_increment"]=$I['identity']||preg_match('~^nextval\(~i',$I["default"]);$I["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^)]+(.*)~',$I["default"],$A))$I["default"]=($A[1]=="NULL"?null:(($A[1][0]=="'"?idf_unescape($A[1]):$A[1]).$A[2]));$H[$I["field"]]=$I;}return$H;}function
indexes($Q,$h=null){global$g;if(!is_object($h))$h=$g;$H=array();$Xh=$h->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($Q));$f=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Xh AND attnum > 0",$h);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption , (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Xh AND ci.oid = i.indexrelid",$h)as$I){$Pg=$I["relname"];$H[$Pg]["type"]=($I["indispartial"]?"INDEX":($I["indisprimary"]?"PRIMARY":($I["indisunique"]?"UNIQUE":"INDEX")));$H[$Pg]["columns"]=array();foreach(explode(" ",$I["indkey"])as$Td)$H[$Pg]["columns"][]=$f[$Td];$H[$Pg]["descs"]=array();foreach(explode(" ",$I["indoption"])as$Ud)$H[$Pg]["descs"][]=($Ud&1?'1':null);$H[$Pg]["lengths"]=array();}return$H;}function
foreign_keys($Q){global$wf;$H=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($Q)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$I){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$I['definition'],$A)){$I['source']=array_map('trim',explode(',',$A[1]));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$A[2],$Ie)){$I['ns']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Ie[2]));$I['table']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Ie[4]));}$I['target']=array_map('trim',explode(',',$A[3]));$I['on_delete']=(preg_match("~ON DELETE ($wf)~",$A[4],$Ie)?$Ie[1]:'NO ACTION');$I['on_update']=(preg_match("~ON UPDATE ($wf)~",$A[4],$Ie)?$Ie[1]:'NO ACTION');$H[$I['conname']]=$I;}}return$H;}function
constraints($Q){global$wf;$H=array();foreach(get_rows("SELECT conname, consrc
FROM pg_catalog.pg_constraint
INNER JOIN pg_catalog.pg_namespace ON pg_constraint.connamespace = pg_namespace.oid
INNER JOIN pg_catalog.pg_class ON pg_constraint.conrelid = pg_class.oid AND pg_constraint.connamespace = pg_class.relnamespace
WHERE pg_constraint.contype = 'c'
AND conrelid != 0 -- handle only CONSTRAINTs here, not TYPES
AND nspname = current_schema()
AND relname = ".q($Q)."
ORDER BY connamespace, conname")as$I)$H[$I['conname']]=$I['consrc'];return$H;}function
view($B){global$g;return
array("select"=>trim($g->result("SELECT pg_get_viewdef(".$g->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($B)).")")));}function
collations(){return
array();}function
information_schema($l){return($l=="information_schema");}function
error(){global$g;$H=h($g->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$H,$A))$H=$A[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($A[3]).'})(.*)~','\1<b>\2</b>',$A[2]).$A[4];return
nl_br($H);}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" ENCODING ".idf_escape($d):""));}function
drop_databases($k){global$g;$g->close();return
apply_queries("DROP DATABASE",$k,'idf_escape');}function
rename_database($B,$d){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($B));}function
auto_increment(){return(min_version(11)?" PRIMARY KEY":"");}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){$c=array();$Bg=array();if($Q!=""&&$Q!=$B)$Bg[]="ALTER TABLE ".table($Q)." RENAME TO ".table($B);foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c[]="DROP $e";else{$bj=$X[5];unset($X[5]);if(isset($X[6])&&$o[0]=="")$X[1]=($X[1]==" bigint"?" big":($X[1]==" smallint"?" small":" "))."serial";if($o[0]=="")$c[]=($Q!=""?"ADD ":"  ").implode($X);else{if($e!=$X[0])$Bg[]="ALTER TABLE ".table($B)." RENAME $e TO $X[0]";$c[]="ALTER $e TYPE$X[1]";if(!$X[6]){$c[]="ALTER $e ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $e ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($o[0]!=""||$bj!="")$Bg[]="COMMENT ON COLUMN ".table($B).".$X[0] IS ".($bj!=""?substr($bj,9):"''");}}$c=array_merge($c,$id);if($Q=="")array_unshift($Bg,"CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($Bg,"ALTER TABLE ".table($Q)."\n".implode(",\n",$c));if($Q!=""||$ub!="")$Bg[]="COMMENT ON TABLE ".table($B)." IS ".q($ub);if($Ma!=""){}foreach($Bg
as$F){if(!queries($F))return
false;}return
true;}function
alter_indexes($Q,$c){$i=array();$kc=array();$Bg=array();foreach($c
as$X){if($X[0]!="INDEX")$i[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$kc[]=idf_escape($X[1]);else$Bg[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($i)array_unshift($Bg,"ALTER TABLE ".table($Q).implode(",",$i));if($kc)array_unshift($Bg,"DROP INDEX ".implode(", ",$kc));foreach($Bg
as$F){if(!queries($F))return
false;}return
true;}function
truncate_tables($S){return
queries("TRUNCATE ".implode(", ",array_map('table',$S)));return
true;}function
drop_views($hj){return
drop_tables($hj);}function
drop_tables($S){foreach($S
as$Q){$O=table_status($Q);if(!queries("DROP ".strtoupper($O["Engine"])." ".table($Q)))return
false;}return
true;}function
move_tables($S,$hj,$ei){foreach(array_merge($S,$hj)as$Q){$O=table_status($Q);if(!queries("ALTER ".strtoupper($O["Engine"])." ".table($Q)." SET SCHEMA ".idf_escape($ei)))return
false;}return
true;}function
trigger($B,$Q=null){if($B=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");if($Q===null)$Q=$_GET['trigger'];$J=get_rows('SELECT t.trigger_name AS "Trigger", t.action_timing AS "Timing", (SELECT STRING_AGG(event_manipulation, \' OR \') FROM information_schema.triggers WHERE event_object_table = t.event_object_table AND trigger_name = t.trigger_name ) AS "Events", t.event_manipulation AS "Event", \'FOR EACH \' || t.action_orientation AS "Type", t.action_statement AS "Statement" FROM information_schema.triggers t WHERE t.event_object_table = '.q($Q).' AND t.trigger_name = '.q($B));return
reset($J);}function
triggers($Q){$H=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE event_object_table = ".q($Q))as$I)$H[$I["trigger_name"]]=array($I["action_timing"],$I["event_manipulation"]);return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($B,$T){$J=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($B));$H=$J[0];$H["returns"]=array("type"=>$H["type_udt_name"]);$H["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($B).'
ORDER BY ordinal_position');return$H;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($B,$I){$H=array();foreach($I["fields"]as$o)$H[]=$o["type"];return
idf_escape($B)."(".implode(", ",$H).")";}function
last_id(){return
0;}function
explain($g,$F){return$g->query("EXPLAIN $F");}function
found_rows($R,$Z){global$g;if(preg_match("~ rows=([0-9]+)~",$g->result("EXPLAIN SELECT * FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Og))return$Og[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$g;return$g->result("SELECT current_schema()");}function
set_schema($hh,$h=null){global$g,$U,$Oh;if(!$h)$h=$g;$H=$h->query("SET search_path TO ".idf_escape($hh));foreach(types()as$T){if(!isset($U[$T])){$U[$T]=0;$Oh['User types'][]=$T;}}return$H;}function
foreign_keys_sql($Q){$H="";$O=table_status($Q);$fd=foreign_keys($Q);ksort($fd);foreach($fd
as$ed=>$dd)$H.="ALTER TABLE ONLY ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." ADD CONSTRAINT ".idf_escape($ed)." $dd[definition] ".($dd['deferrable']?'DEFERRABLE':'NOT DEFERRABLE').";\n";return($H?"$H\n":$H);}function
create_sql($Q,$Ma,$Ph){global$g;$H='';$Xg=array();$rh=array();$O=table_status($Q);if(is_view($O)){$gj=view($Q);return
rtrim("CREATE VIEW ".idf_escape($Q)." AS $gj[select]",";");}$p=fields($Q);$w=indexes($Q);ksort($w);$Cb=constraints($Q);if(!$O||empty($p))return
false;$H="CREATE TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." (\n    ";foreach($p
as$Xc=>$o){$Xf=idf_escape($o['field']).' '.$o['full_type'].default_value($o).($o['attnotnull']?" NOT NULL":"");$Xg[]=$Xf;if(preg_match('~nextval\(\'([^\']+)\'\)~',$o['default'],$Je)){$qh=$Je[1];$Eh=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($qh):"SELECT * FROM $qh"));$rh[]=($Ph=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $qh;\n":"")."CREATE SEQUENCE $qh INCREMENT $Eh[increment_by] MINVALUE $Eh[min_value] MAXVALUE $Eh[max_value] START ".($Ma?$Eh['last_value']:1)." CACHE $Eh[cache_value];";}}if(!empty($rh))$H=implode("\n\n",$rh)."\n\n$H";foreach($w
as$Od=>$v){switch($v['type']){case'UNIQUE':$Xg[]="CONSTRAINT ".idf_escape($Od)." UNIQUE (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;case'PRIMARY':$Xg[]="CONSTRAINT ".idf_escape($Od)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$v['columns'])).")";break;}}foreach($Cb
as$zb=>$Ab)$Xg[]="CONSTRAINT ".idf_escape($zb)." CHECK $Ab";$H.=implode(",\n    ",$Xg)."\n) WITH (oids = ".($O['Oid']?'true':'false').");";foreach($w
as$Od=>$v){if($v['type']=='INDEX'){$f=array();foreach($v['columns']as$y=>$X)$f[]=idf_escape($X).($v['descs'][$y]?" DESC":"");$H.="\n\nCREATE INDEX ".idf_escape($Od)." ON ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." USING btree (".implode(', ',$f).");";}}if($O['Comment'])$H.="\n\nCOMMENT ON TABLE ".idf_escape($O['nspname']).".".idf_escape($O['Name'])." IS ".q($O['Comment']).";";foreach($p
as$Xc=>$o){if($o['comment'])$H.="\n\nCOMMENT ON COLUMN ".idf_escape($O['nspname']).".".idf_escape($O['Name']).".".idf_escape($Xc)." IS ".q($o['comment']).";";}return
rtrim($H,';');}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
trigger_sql($Q){$O=table_status($Q);$H="";foreach(triggers($Q)as$Ci=>$Bi){$Di=trigger($Ci,$O['Name']);$H.="\nCREATE TRIGGER ".idf_escape($Di['Trigger'])." $Di[Timing] $Di[Events] ON ".idf_escape($O["nspname"]).".".idf_escape($O['Name'])." $Di[Type] $Di[Statement];;\n";}return$H;}function
use_sql($j){return"\connect ".idf_escape($j);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($Vc){return
preg_match('~^(database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$Vc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$g;return$g->result("SHOW max_connections");}$x="pgsql";$U=array();$Oh=array();foreach(array('Numbers'=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),'Date and time'=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),'Strings'=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),'Binary'=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),'Network'=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),'Geometry'=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}$Pi=array();$Af=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$qd=array("char_length","lower","round","to_hex","to_timestamp","upper");$wd=array("avg","count","count distinct","max","min","sum");$rc=array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",));}$jc["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){$og=array("OCI8","PDO_OCI");define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_error($Bc,$n){if(ini_bool("html_errors"))$n=html_entity_decode(strip_tags($n));$n=preg_replace('~^[^:]*: ~','',$n);$this->error=$n;}function
connect($M,$V,$E){$this->_link=@oci_new_connect($V,$E,$M,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$n=oci_error();$this->error=$n["message"];return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){return
true;}function
query($F,$Ji=false){$G=oci_parse($this->_link,$F);$this->error="";if(!$G){$n=oci_error($this->_link);$this->errno=$n["code"];$this->error=$n["message"];return
false;}set_error_handler(array($this,'_error'));$H=@oci_execute($G);restore_error_handler();if($H){if(oci_num_fields($G))return
new
Min_Result($G);$this->affected_rows=oci_num_rows($G);}return$H;}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=1){$G=$this->query($F);if(!is_object($G)||!oci_fetch($G->_result))return
false;return
oci_result($G->_result,$o);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($G){$this->_result=$G;}function
_convert($I){foreach((array)$I
as$y=>$X){if(is_a($X,'OCI-Lob'))$I[$y]=$X->load();}return$I;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$e=$this->_offset++;$H=new
stdClass;$H->name=oci_field_name($this->_result,$e);$H->orgname=$H->name;$H->type=oci_field_type($this->_result,$e);$H->charsetnr=(preg_match("~raw|blob|bfile~",$H->type)?63:0);return$H;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";function
connect($M,$V,$E){$this->dsn("oci:dbname=//$M;charset=AL32UTF8",$V,$E);return
true;}function
select_db($j){return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces");}function
limit($F,$Z,$z,$C=0,$L=" "){return($C?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $F$Z) t WHERE rownum <= ".($z+$C).") WHERE rnum > $C":($z!==null?" * FROM (SELECT $F$Z) WHERE rownum <= ".($z+$C):" $F$Z"));}function
limit1($Q,$F,$Z,$L="\n"){return" $F$Z";}function
db_collation($l,$pb){global$g;return$g->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT USER FROM DUAL");}function
tables_list(){return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."
UNION SELECT view_name, 'view' FROM user_views
ORDER BY 1");}function
count_tables($k){return
array();}function
table_status($B=""){$H=array();$jh=q($B);foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q(DB).($B!=""?" AND table_name = $jh":"")."
UNION SELECT view_name, 'view', 0, 0 FROM user_views".($B!=""?" WHERE view_name = $jh":"")."
ORDER BY 1")as$I){if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){return
true;}function
fields($Q){$H=array();foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($Q)." ORDER BY column_id")as$I){$T=$I["DATA_TYPE"];$ze="$I[DATA_PRECISION],$I[DATA_SCALE]";if($ze==",")$ze=$I["DATA_LENGTH"];$H[$I["COLUMN_NAME"]]=array("field"=>$I["COLUMN_NAME"],"full_type"=>$T.($ze?"($ze)":""),"type"=>strtolower($T),"length"=>$ze,"default"=>$I["DATA_DEFAULT"],"null"=>($I["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$H;}function
indexes($Q,$h=null){$H=array();foreach(get_rows("SELECT uic.*, uc.constraint_type
FROM user_ind_columns uic
LEFT JOIN user_constraints uc ON uic.index_name = uc.constraint_name AND uic.table_name = uc.table_name
WHERE uic.table_name = ".q($Q)."
ORDER BY uc.constraint_type, uic.column_position",$h)as$I){$Od=$I["INDEX_NAME"];$H[$Od]["type"]=($I["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($I["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$H[$Od]["columns"][]=$I["COLUMN_NAME"];$H[$Od]["lengths"][]=($I["CHAR_LENGTH"]&&$I["CHAR_LENGTH"]!=$I["COLUMN_LENGTH"]?$I["CHAR_LENGTH"]:null);$H[$Od]["descs"][]=($I["DESCEND"]?'1':null);}return$H;}function
view($B){$J=get_rows('SELECT text "select" FROM user_views WHERE view_name = '.q($B));return
reset($J);}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
explain($g,$F){$g->query("EXPLAIN PLAN FOR $F");return$g->query("SELECT * FROM plan_table");}function
found_rows($R,$Z){}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){$c=$kc=array();foreach($p
as$o){$X=$o[1];if($X&&$o[0]!=""&&idf_escape($o[0])!=$X[0])queries("ALTER TABLE ".table($Q)." RENAME COLUMN ".idf_escape($o[0])." TO $X[0]");if($X)$c[]=($Q!=""?($o[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($Q!=""?")":"");else$kc[]=idf_escape($o[0]);}if($Q=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($Q)."\n".implode("\n",$c)))&&(!$kc||queries("ALTER TABLE ".table($Q)." DROP (".implode(", ",$kc).")"))&&($Q==$B||queries("ALTER TABLE ".table($Q)." RENAME TO ".table($B)));}function
foreign_keys($Q){$H=array();$F="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($Q);foreach(get_rows($F)as$I)$H[$I['NAME']]=array("db"=>$I['DEST_DB'],"table"=>$I['DEST_TABLE'],"source"=>array($I['SRC_COLUMN']),"target"=>array($I['DEST_COLUMN']),"on_delete"=>$I['ON_DELETE'],"on_update"=>null,);return$H;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($hj){return
apply_queries("DROP VIEW",$hj);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
last_id(){return
0;}function
schemas(){return
get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX'))");}function
get_schema(){global$g;return$g->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($ih,$h=null){global$g;if(!$h)$h=$g;return$h->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($ih));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$J=get_rows('SELECT * FROM v$instance');return
reset($J);}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($Vc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view|view_trigger)$~',$Vc);}$x="oracle";$U=array();$Oh=array();foreach(array('Numbers'=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),'Date and time'=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),'Strings'=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),'Binary'=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}$Pi=array();$Af=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$qd=array("length","lower","round","upper");$wd=array("avg","count","count distinct","max","min","sum");$rc=array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",));}$jc["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){$og=array("SQLSRV","MSSQL","PDO_DBLIB");define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$n){$this->errno=$n["code"];$this->error.="$n[message]\n";}$this->error=rtrim($this->error);}function
connect($M,$V,$E){global$b;$l=$b->database();$_b=array("UID"=>$V,"PWD"=>$E,"CharacterSet"=>"UTF-8");if($l!="")$_b["Database"]=$l;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$M),$_b);if($this->_link){$Vd=sqlsrv_server_info($this->_link);$this->server_info=$Vd['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($F,$Ji=false){$G=sqlsrv_query($this->_link,$F);$this->error="";if(!$G){$this->_get_error();return
false;}return$this->store_result($G);}function
multi_query($F){$this->_result=sqlsrv_query($this->_link,$F);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($G=null){if(!$G)$G=$this->_result;if(!$G)return
false;if(sqlsrv_field_metadata($G))return
new
Min_Result($G);$this->affected_rows=sqlsrv_rows_affected($G);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;$I=$G->fetch_row();return$I[$o];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($G){$this->_result=$G;}function
_convert($I){foreach((array)$I
as$y=>$X){if(is_a($X,'DateTime'))$I[$y]=$X->format("Y-m-d H:i:s");}return$I;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$o=$this->_fields[$this->_offset++];$H=new
stdClass;$H->name=$o["Name"];$H->orgname=$o["Name"];$H->type=($o["Type"]==1?254:0);return$H;}function
seek($C){for($s=0;$s<$C;$s++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($M,$V,$E){$this->_link=@mssql_connect($M,$V,$E);if($this->_link){$G=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($G){$I=$G->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$I[0]] $I[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){return
mssql_select_db($j);}function
query($F,$Ji=false){$G=@mssql_query($F,$this->_link);$this->error="";if(!$G){$this->error=mssql_get_last_message();return
false;}if($G===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($F,$o=0){$G=$this->query($F);if(!is_object($G))return
false;return
mssql_result($G->_result,0,$o);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($G){$this->_result=$G;$this->num_rows=mssql_num_rows($G);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$H=mssql_fetch_field($this->_result);$H->orgtable=$H->table;$H->orgname=$H->name;return$H;}function
seek($C){mssql_data_seek($this->_result,$C);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($M,$V,$E){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$E);return
true;}function
select_db($j){return$this->query("USE ".idf_escape($j));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$J,$rg){foreach($J
as$N){$Qi=array();$Z=array();foreach($N
as$y=>$X){$Qi[]="$y = $X";if(isset($rg[idf_unescape($y)]))$Z[]="$y = $X";}if(!queries("MERGE ".table($Q)." USING (VALUES(".implode(", ",$N).")) AS source (c".implode(", c",range(1,count($N))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Qi)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($u){return"[".str_replace("]","]]",$u)."]";}function
table($u){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($F,$Z,$z,$C=0,$L=" "){return($z!==null?" TOP (".($z+$C).")":"")." $F$Z";}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($l,$pb){global$g;return$g->result("SELECT collation_name FROM sys.databases WHERE name = ".q($l));}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($k){global$g;$H=array();foreach($k
as$l){$g->select_db($l);$H[$l]=$g->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$H;}function
table_status($B=""){$H=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment FROM sys.all_objects AS ao WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($B!=""?"AND name = ".q($B):"ORDER BY name"))as$I){if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]=="VIEW";}function
fk_support($R){return
true;}function
fields($Q){$wb=get_key_vals("SELECT objname, cast(value as varchar(max)) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($Q).", 'column', NULL)");$H=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($Q))as$I){$T=$I["type"];$ze=(preg_match("~char|binary~",$T)?$I["max_length"]:($T=="decimal"?"$I[precision],$I[scale]":""));$H[$I["name"]]=array("field"=>$I["name"],"full_type"=>$T.($ze?"($ze)":""),"type"=>$T,"length"=>$ze,"default"=>$I["default"],"null"=>$I["is_nullable"],"auto_increment"=>$I["is_identity"],"collation"=>$I["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$I["is_identity"],"comment"=>$wb[$I["name"]],);}return$H;}function
indexes($Q,$h=null){$H=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($Q),$h)as$I){$B=$I["name"];$H[$B]["type"]=($I["is_primary_key"]?"PRIMARY":($I["is_unique"]?"UNIQUE":"INDEX"));$H[$B]["lengths"]=array();$H[$B]["columns"][$I["key_ordinal"]]=$I["column_name"];$H[$B]["descs"][$I["key_ordinal"]]=($I["is_descending_key"]?'1':null);}return$H;}function
view($B){global$g;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$g->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($B))));}function
collations(){$H=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$d)$H[preg_replace('~_.*~','',$d)][]=$d;return$H;}function
information_schema($l){return
false;}function
error(){global$g;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$g->error)));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).(preg_match('~^[a-z0-9_]+$~i',$d)?" COLLATE $d":""));}function
drop_databases($k){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$k)));}function
rename_database($B,$d){if(preg_match('~^[a-z0-9_]+$~i',$d))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $d");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($B));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){$c=array();$wb=array();foreach($p
as$o){$e=idf_escape($o[0]);$X=$o[1];if(!$X)$c["DROP"][]=" COLUMN $e";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$wb[$o[0]]=$X[5];unset($X[5]);if($o[0]=="")$c["ADD"][]="\n  ".implode("",$X).($Q==""?substr($id[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($e!=$X[0])queries("EXEC sp_rename ".q(table($Q).".$e").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($Q=="")return
queries("CREATE TABLE ".table($B)." (".implode(",",(array)$c["ADD"])."\n)");if($Q!=$B)queries("EXEC sp_rename ".q(table($Q)).", ".q($B));if($id)$c[""]=$id;foreach($c
as$y=>$X){if(!queries("ALTER TABLE ".idf_escape($B)." $y".implode(",",$X)))return
false;}foreach($wb
as$y=>$X){$ub=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table',  @level1name = ".q($B).", @level2type = N'Column', @level2name = ".q($y));queries("EXEC sp_addextendedproperty @name = N'MS_Description', @value = ".$ub.", @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table',  @level1name = ".q($B).", @level2type = N'Column', @level2name = ".q($y));}return
true;}function
alter_indexes($Q,$c){$v=array();$kc=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$kc[]=idf_escape($X[1]);else$v[]=idf_escape($X[1])." ON ".table($Q);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q):"ALTER TABLE ".table($Q)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$v||queries("DROP INDEX ".implode(", ",$v)))&&(!$kc||queries("ALTER TABLE ".table($Q)." DROP ".implode(", ",$kc)));}function
last_id(){global$g;return$g->result("SELECT SCOPE_IDENTITY()");}function
explain($g,$F){$g->query("SET SHOWPLAN_ALL ON");$H=$g->query($F);$g->query("SET SHOWPLAN_ALL OFF");return$H;}function
found_rows($R,$Z){}function
foreign_keys($Q){$H=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($Q))as$I){$q=&$H[$I["FK_NAME"]];$q["db"]=$I["PKTABLE_QUALIFIER"];$q["table"]=$I["PKTABLE_NAME"];$q["source"][]=$I["FKCOLUMN_NAME"];$q["target"][]=$I["PKCOLUMN_NAME"];}return$H;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($hj){return
queries("DROP VIEW ".implode(", ",array_map('table',$hj)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$hj,$ei){return
apply_queries("ALTER SCHEMA ".idf_escape($ei)." TRANSFER",array_merge($S,$hj));}function
trigger($B){if($B=="")return
array();$J=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($B));$H=reset($J);if($H)$H["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$H["text"]);return$H;}function
triggers($Q){$H=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($Q))as$I)$H[$I["name"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$g;if($_GET["ns"]!="")return$_GET["ns"];return$g->result("SELECT SCHEMA_NAME()");}function
set_schema($hh){return
true;}function
use_sql($j){return"USE ".idf_escape($j);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
support($Vc){return
preg_match('~^(comment|columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$Vc);}$x="mssql";$U=array();$Oh=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),'Date and time'=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),'Strings'=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),'Binary'=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}$Pi=array();$Af=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$qd=array("len","lower","round","upper");$wd=array("avg","count","count distinct","max","min","sum");$rc=array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",));}$jc['firebird']='Firebird (alpha)';if(isset($_GET["firebird"])){$og=array("interbase");define("DRIVER","firebird");if(extension_loaded("interbase")){class
Min_DB{var$extension="Firebird",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($M,$V,$E){$this->_link=ibase_connect($M,$V,$E);if($this->_link){$Ti=explode(':',$M);$this->service_link=ibase_service_attach($Ti[0],$V,$E);$this->server_info=ibase_server_info($this->service_link,IBASE_SVC_SERVER_VERSION);}else{$this->errno=ibase_errcode();$this->error=ibase_errmsg();}return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($j){return($j=="domain");}function
query($F,$Ji=false){$G=ibase_query($F,$this->_link);if(!$G){$this->errno=ibase_errcode();$this->error=ibase_errmsg();return
false;}$this->error="";if($G===true){$this->affected_rows=ibase_affected_rows($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;$I=$G->fetch_row();return$I[$o];}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($G){$this->_result=$G;}function
fetch_assoc(){return
ibase_fetch_assoc($this->_result);}function
fetch_row(){return
ibase_fetch_row($this->_result);}function
fetch_field(){$o=ibase_field_info($this->_result,$this->_offset++);return(object)array('name'=>$o['name'],'orgname'=>$o['name'],'type'=>$o['type'],'charsetnr'=>$o['length'],);}function
__destruct(){ibase_free_result($this->_result);}}}class
Min_Driver
extends
Min_SQL{}function
idf_escape($u){return'"'.str_replace('"','""',$u).'"';}function
table($u){return
idf_escape($u);}function
connect(){global$b;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2]))return$g;return$g->error;}function
get_databases($gd){return
array("domain");}function
limit($F,$Z,$z,$C=0,$L=" "){$H='';$H.=($z!==null?$L."FIRST $z".($C?" SKIP $C":""):"");$H.=" $F$Z";return$H;}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($l,$pb){}function
engines(){return
array();}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
tables_list(){global$g;$F='SELECT RDB$RELATION_NAME FROM rdb$relations WHERE rdb$system_flag = 0';$G=ibase_query($g->_link,$F);$H=array();while($I=ibase_fetch_assoc($G))$H[$I['RDB$RELATION_NAME']]='table';ksort($H);return$H;}function
count_tables($k){return
array();}function
table_status($B="",$Uc=false){global$g;$H=array();$Qb=tables_list();foreach($Qb
as$v=>$X){$v=trim($v);$H[$v]=array('Name'=>$v,'Engine'=>'standard',);if($B==$v)return$H[$v];}return$H;}function
is_view($R){return
false;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"]);}function
fields($Q){global$g;$H=array();$F='SELECT r.RDB$FIELD_NAME AS field_name,
r.RDB$DESCRIPTION AS field_description,
r.RDB$DEFAULT_VALUE AS field_default_value,
r.RDB$NULL_FLAG AS field_not_null_constraint,
f.RDB$FIELD_LENGTH AS field_length,
f.RDB$FIELD_PRECISION AS field_precision,
f.RDB$FIELD_SCALE AS field_scale,
CASE f.RDB$FIELD_TYPE
WHEN 261 THEN \'BLOB\'
WHEN 14 THEN \'CHAR\'
WHEN 40 THEN \'CSTRING\'
WHEN 11 THEN \'D_FLOAT\'
WHEN 27 THEN \'DOUBLE\'
WHEN 10 THEN \'FLOAT\'
WHEN 16 THEN \'INT64\'
WHEN 8 THEN \'INTEGER\'
WHEN 9 THEN \'QUAD\'
WHEN 7 THEN \'SMALLINT\'
WHEN 12 THEN \'DATE\'
WHEN 13 THEN \'TIME\'
WHEN 35 THEN \'TIMESTAMP\'
WHEN 37 THEN \'VARCHAR\'
ELSE \'UNKNOWN\'
END AS field_type,
f.RDB$FIELD_SUB_TYPE AS field_subtype,
coll.RDB$COLLATION_NAME AS field_collation,
cset.RDB$CHARACTER_SET_NAME AS field_charset
FROM RDB$RELATION_FIELDS r
LEFT JOIN RDB$FIELDS f ON r.RDB$FIELD_SOURCE = f.RDB$FIELD_NAME
LEFT JOIN RDB$COLLATIONS coll ON f.RDB$COLLATION_ID = coll.RDB$COLLATION_ID
LEFT JOIN RDB$CHARACTER_SETS cset ON f.RDB$CHARACTER_SET_ID = cset.RDB$CHARACTER_SET_ID
WHERE r.RDB$RELATION_NAME = '.q($Q).'
ORDER BY r.RDB$FIELD_POSITION';$G=ibase_query($g->_link,$F);while($I=ibase_fetch_assoc($G))$H[trim($I['FIELD_NAME'])]=array("field"=>trim($I["FIELD_NAME"]),"full_type"=>trim($I["FIELD_TYPE"]),"type"=>trim($I["FIELD_SUB_TYPE"]),"default"=>trim($I['FIELD_DEFAULT_VALUE']),"null"=>(trim($I["FIELD_NOT_NULL_CONSTRAINT"])=="YES"),"auto_increment"=>'0',"collation"=>trim($I["FIELD_COLLATION"]),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"comment"=>trim($I["FIELD_DESCRIPTION"]),);return$H;}function
indexes($Q,$h=null){$H=array();return$H;}function
foreign_keys($Q){return
array();}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($hh){return
true;}function
support($Vc){return
preg_match("~^(columns|sql|status|table)$~",$Vc);}$x="firebird";$Af=array("=");$qd=array();$wd=array();$rc=array();}$jc["simpledb"]="SimpleDB";if(isset($_GET["simpledb"])){$og=array("SimpleXML + allow_url_fopen");define("DRIVER","simpledb");if(class_exists('SimpleXMLElement')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="SimpleXML",$server_info='2009-04-15',$error,$timeout,$next,$affected_rows,$_result;function
select_db($j){return($j=="domain");}function
query($F,$Ji=false){$Uf=array('SelectExpression'=>$F,'ConsistentRead'=>'true');if($this->next)$Uf['NextToken']=$this->next;$G=sdb_request_all('Select','Item',$Uf,$this->timeout);$this->timeout=0;if($G===false)return$G;if(preg_match('~^\s*SELECT\s+COUNT\(~i',$F)){$Sh=0;foreach($G
as$he)$Sh+=$he->Attribute->Value;$G=array((object)array('Attribute'=>array((object)array('Name'=>'Count','Value'=>$Sh,))));}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0;function
__construct($G){foreach($G
as$he){$I=array();if($he->Name!='')$I['itemName()']=(string)$he->Name;foreach($he->Attribute
as$Ia){$B=$this->_processValue($Ia->Name);$Y=$this->_processValue($Ia->Value);if(isset($I[$B])){$I[$B]=(array)$I[$B];$I[$B][]=$Y;}else$I[$B]=$Y;}$this->_rows[]=$I;foreach($I
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=count($this->_rows);}function
_processValue($uc){return(is_object($uc)&&$uc['encoding']=='base64'?base64_decode($uc):(string)$uc);}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$y=>$X)$H[$y]=$I[$y];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$ne=array_keys($this->_rows[0]);return(object)array('name'=>$ne[$this->_offset++]);}}}class
Min_Driver
extends
Min_SQL{public$rg="itemName()";function
_chunkRequest($Kd,$va,$Uf,$Kc=array()){global$g;foreach(array_chunk($Kd,25)as$ib){$Vf=$Uf;foreach($ib
as$s=>$t){$Vf["Item.$s.ItemName"]=$t;foreach($Kc
as$y=>$X)$Vf["Item.$s.$y"]=$X;}if(!sdb_request($va,$Vf))return
false;}$g->affected_rows=count($Kd);return
true;}function
_extractIds($Q,$Cg,$z){$H=array();if(preg_match_all("~itemName\(\) = (('[^']*+')+)~",$Cg,$Je))$H=array_map('idf_unescape',$Je[1]);else{foreach(sdb_request_all('Select','Item',array('SelectExpression'=>'SELECT itemName() FROM '.table($Q).$Cg.($z?" LIMIT 1":"")))as$he)$H[]=$he->Name;}return$H;}function
select($Q,$K,$Z,$td,$Ff=array(),$z=1,$D=0,$tg=false){global$g;$g->next=$_GET["next"];$H=parent::select($Q,$K,$Z,$td,$Ff,$z,$D,$tg);$g->next=0;return$H;}function
delete($Q,$Cg,$z=0){return$this->_chunkRequest($this->_extractIds($Q,$Cg,$z),'BatchDeleteAttributes',array('DomainName'=>$Q));}function
update($Q,$N,$Cg,$z=0,$L="\n"){$ac=array();$Zd=array();$s=0;$Kd=$this->_extractIds($Q,$Cg,$z);$t=idf_unescape($N["`itemName()`"]);unset($N["`itemName()`"]);foreach($N
as$y=>$X){$y=idf_unescape($y);if($X=="NULL"||($t!=""&&array($t)!=$Kd))$ac["Attribute.".count($ac).".Name"]=$y;if($X!="NULL"){foreach((array)$X
as$je=>$W){$Zd["Attribute.$s.Name"]=$y;$Zd["Attribute.$s.Value"]=(is_array($X)?$W:idf_unescape($W));if(!$je)$Zd["Attribute.$s.Replace"]="true";$s++;}}}$Uf=array('DomainName'=>$Q);return(!$Zd||$this->_chunkRequest(($t!=""?array($t):$Kd),'BatchPutAttributes',$Uf,$Zd))&&(!$ac||$this->_chunkRequest($Kd,'BatchDeleteAttributes',$Uf,$ac));}function
insert($Q,$N){$Uf=array("DomainName"=>$Q);$s=0;foreach($N
as$B=>$Y){if($Y!="NULL"){$B=idf_unescape($B);if($B=="itemName()")$Uf["ItemName"]=idf_unescape($Y);else{foreach((array)$Y
as$X){$Uf["Attribute.$s.Name"]=$B;$Uf["Attribute.$s.Value"]=(is_array($Y)?$X:idf_unescape($Y));$s++;}}}}return
sdb_request('PutAttributes',$Uf);}function
insertUpdate($Q,$J,$rg){foreach($J
as$N){if(!$this->update($Q,$N,"WHERE `itemName()` = ".q($N["`itemName()`"])))return
false;}return
true;}function
begin(){return
false;}function
commit(){return
false;}function
rollback(){return
false;}function
slowQuery($F,$mi){$this->_conn->timeout=$mi;return$F;}}function
connect(){global$b;list(,,$E)=$b->credentials();if($E!="")return'Database does not support password.';return
new
Min_DB;}function
support($Vc){return
preg_match('~sql~',$Vc);}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
get_databases(){return
array("domain");}function
collations(){return
array();}function
db_collation($l,$pb){}function
tables_list(){global$g;$H=array();foreach(sdb_request_all('ListDomains','DomainName')as$Q)$H[(string)$Q]='table';if($g->error&&defined("PAGE_HEADER"))echo"<p class='error'>".error()."\n";return$H;}function
table_status($B="",$Uc=false){$H=array();foreach(($B!=""?array($B=>true):tables_list())as$Q=>$T){$I=array("Name"=>$Q,"Auto_increment"=>"");if(!$Uc){$We=sdb_request('DomainMetadata',array('DomainName'=>$Q));if($We){foreach(array("Rows"=>"ItemCount","Data_length"=>"ItemNamesSizeBytes","Index_length"=>"AttributeValuesSizeBytes","Data_free"=>"AttributeNamesSizeBytes",)as$y=>$X)$I[$y]=(string)$We->$X;}}if($B!="")return$I;$H[$Q]=$I;}return$H;}function
explain($g,$F){}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($R){}function
indexes($Q,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("itemName()")),);}function
fields($Q){return
fields_from_edit();}function
foreign_keys($Q){return
array();}function
table($u){return
idf_escape($u);}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
limit($F,$Z,$z,$C=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z":"");}function
unconvert_field($o,$H){return$H;}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){return($Q==""&&sdb_request('CreateDomain',array('DomainName'=>$B)));}function
drop_tables($S){foreach($S
as$Q){if(!sdb_request('DeleteDomain',array('DomainName'=>$Q)))return
false;}return
true;}function
count_tables($k){foreach($k
as$l)return
array($l=>count(tables_list()));}function
found_rows($R,$Z){return($Z?null:$R["Rows"]);}function
last_id(){}function
hmac($Ba,$Qb,$y,$Gg=false){$Va=64;if(strlen($y)>$Va)$y=pack("H*",$Ba($y));$y=str_pad($y,$Va,"\0");$ke=$y^str_repeat("\x36",$Va);$le=$y^str_repeat("\x5C",$Va);$H=$Ba($le.pack("H*",$Ba($ke.$Qb)));if($Gg)$H=pack("H*",$H);return$H;}function
sdb_request($va,$Uf=array()){global$b,$g;list($Gd,$Uf['AWSAccessKeyId'],$kh)=$b->credentials();$Uf['Action']=$va;$Uf['Timestamp']=gmdate('Y-m-d\TH:i:s+00:00');$Uf['Version']='2009-04-15';$Uf['SignatureVersion']=2;$Uf['SignatureMethod']='HmacSHA1';ksort($Uf);$F='';foreach($Uf
as$y=>$X)$F.='&'.rawurlencode($y).'='.rawurlencode($X);$F=str_replace('%7E','~',substr($F,1));$F.="&Signature=".urlencode(base64_encode(hmac('sha1',"POST\n".preg_replace('~^https?://~','',$Gd)."\n/\n$F",$kh,true)));@ini_set('track_errors',1);$Zc=@file_get_contents((preg_match('~^https?://~',$Gd)?$Gd:"http://$Gd"),false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$F,'ignore_errors'=>1,))));if(!$Zc){$g->error=$php_errormsg;return
false;}libxml_use_internal_errors(true);$uj=simplexml_load_string($Zc);if(!$uj){$n=libxml_get_last_error();$g->error=$n->message;return
false;}if($uj->Errors){$n=$uj->Errors->Error;$g->error="$n->Message ($n->Code)";return
false;}$g->error='';$di=$va."Result";return($uj->$di?$uj->$di:true);}function
sdb_request_all($va,$di,$Uf=array(),$mi=0){$H=array();$Kh=($mi?microtime(true):0);$z=(preg_match('~LIMIT\s+(\d+)\s*$~i',$Uf['SelectExpression'],$A)?$A[1]:0);do{$uj=sdb_request($va,$Uf);if(!$uj)break;foreach($uj->$di
as$uc)$H[]=$uc;if($z&&count($H)>=$z){$_GET["next"]=$uj->NextToken;break;}if($mi&&microtime(true)-$Kh>$mi)return
false;$Uf['NextToken']=$uj->NextToken;if($z)$Uf['SelectExpression']=preg_replace('~\d+\s*$~',$z-count($H),$Uf['SelectExpression']);}while($uj->NextToken);return$H;}$x="simpledb";$Af=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","IS NOT NULL");$qd=array();$wd=array("count");$rc=array(array("json"));}$jc["mongo"]="MongoDB";if(isset($_GET["mongo"])){$og=array("mongo","mongodb");define("DRIVER","mongo");if(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Ri,$Df){$kb='MongoDB\Driver\Manager';return
new$kb($Ri,$Df);}function
query($F){return
false;}function
select_db($j){$this->_db_name=$j;return
true;}function
quote($P){return$P;}function
ping($_){$kb='MongoDB\Driver\Command';$_->executeCommand('admin',new$kb(array('ping'=>1)));}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($G){foreach($G
as$he){$I=array();foreach($he
as$y=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$y]=63;$I[$y]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'.strval($X).'")':(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->bin:(is_a($X,'MongoDB\BSON\Regex')?strval($X):(is_object($X)?json_encode($X,256):$X)))));}$this->_rows[]=$I;foreach($I
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=$G->count;}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$y=>$X)$H[$y]=$I[$y];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$ne=array_keys($this->_rows[0]);$B=$ne[$this->_offset++];return(object)array('name'=>$B,'charsetnr'=>$this->_charset[$B],);}}class
Min_Driver
extends
Min_SQL{public$rg="_id";function
select($Q,$K,$Z,$td,$Ff=array(),$z=1,$D=0,$tg=false){global$g;$K=($K==array("*")?array():array_fill_keys($K,1));if(count($K)&&!isset($K['_id']))$K['_id']=0;$Z=where_to_query($Z);$Bh=array();foreach($Ff
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Ib);$Bh[$X]=($Ib?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$z=$_GET['limit'];$z=min(200,max(1,(int)$z));$zh=$D*$z;$kb='MongoDB\Driver\Query';$F=new$kb($Z,array('projection'=>$K,'limit'=>$z,'skip'=>$zh,'sort'=>$Bh));$Wg=$g->_link->executeQuery("$g->_db_name.$Q",$F);return
new
Min_Result($Wg);}function
update($Q,$N,$Cg,$z=0,$L="\n"){global$g;$l=$g->_db_name;$Z=sql_query_where_parser($Cg);$kb='MongoDB\Driver\BulkWrite';$Za=new$kb(array());if(isset($N['_id']))unset($N['_id']);$Qg=array();foreach($N
as$y=>$Y){if($Y=='NULL'){$Qg[$y]=1;unset($N[$y]);}}$Qi=array('$set'=>$N);if(count($Qg))$Qi['$unset']=$Qg;$Za->update($Z,$Qi,array('upsert'=>false));$Wg=$g->_link->executeBulkWrite("$l.$Q",$Za);$g->affected_rows=$Wg->getModifiedCount();return
true;}function
delete($Q,$Cg,$z=0){global$g;$l=$g->_db_name;$Z=sql_query_where_parser($Cg);$kb='MongoDB\Driver\BulkWrite';$Za=new$kb(array());$Za->delete($Z,array('limit'=>$z));$Wg=$g->_link->executeBulkWrite("$l.$Q",$Za);$g->affected_rows=$Wg->getDeletedCount();return
true;}function
insert($Q,$N){global$g;$l=$g->_db_name;$kb='MongoDB\Driver\BulkWrite';$Za=new$kb(array());if(isset($N['_id'])&&empty($N['_id']))unset($N['_id']);$Za->insert($N);$Wg=$g->_link->executeBulkWrite("$l.$Q",$Za);$g->affected_rows=$Wg->getInsertedCount();return
true;}}function
get_databases($gd){global$g;$H=array();$kb='MongoDB\Driver\Command';$sb=new$kb(array('listDatabases'=>1));$Wg=$g->_link->executeCommand('admin',$sb);foreach($Wg
as$Vb){foreach($Vb->databases
as$l)$H[]=$l->name;}return$H;}function
count_tables($k){$H=array();return$H;}function
tables_list(){global$g;$kb='MongoDB\Driver\Command';$sb=new$kb(array('listCollections'=>1));$Wg=$g->_link->executeCommand($g->_db_name,$sb);$qb=array();foreach($Wg
as$G)$qb[$G->name]='table';return$qb;}function
drop_databases($k){return
false;}function
indexes($Q,$h=null){global$g;$H=array();$kb='MongoDB\Driver\Command';$sb=new$kb(array('listIndexes'=>$Q));$Wg=$g->_link->executeCommand($g->_db_name,$sb);foreach($Wg
as$v){$dc=array();$f=array();foreach(get_object_vars($v->key)as$e=>$T){$dc[]=($T==-1?'1':null);$f[]=$e;}$H[$v->name]=array("type"=>($v->name=="_id_"?"PRIMARY":(isset($v->unique)?"UNIQUE":"INDEX")),"columns"=>$f,"lengths"=>array(),"descs"=>$dc,);}return$H;}function
fields($Q){$p=fields_from_edit();if(!count($p)){global$m;$G=$m->select($Q,array("*"),null,null,array(),10);while($I=$G->fetch_assoc()){foreach($I
as$y=>$X){$I[$y]=null;$p[$y]=array("field"=>$y,"type"=>"string","null"=>($y!=$m->primary),"auto_increment"=>($y==$m->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}return$p;}function
found_rows($R,$Z){global$g;$Z=where_to_query($Z);$kb='MongoDB\Driver\Command';$sb=new$kb(array('count'=>$R['Name'],'query'=>$Z));$Wg=$g->_link->executeCommand($g->_db_name,$sb);$ui=$Wg->toArray();return$ui[0]->n;}function
sql_query_where_parser($Cg){$Cg=trim(preg_replace('/WHERE[\s]?[(]?\(?/','',$Cg));$Cg=preg_replace('/\)\)\)$/',')',$Cg);$rj=explode(' AND ',$Cg);$sj=explode(') OR (',$Cg);$Z=array();foreach($rj
as$pj)$Z[]=trim($pj);if(count($sj)==1)$sj=array();elseif(count($sj)>1)$Z=array();return
where_to_query($Z,$sj);}function
where_to_query($nj=array(),$oj=array()){global$b;$Qb=array();foreach(array('and'=>$nj,'or'=>$oj)as$T=>$Z){if(is_array($Z)){foreach($Z
as$Nc){list($nb,$zf,$X)=explode(" ",$Nc,3);if($nb=="_id"){$X=str_replace('MongoDB\BSON\ObjectID("',"",$X);$X=str_replace('")',"",$X);$kb='MongoDB\BSON\ObjectID';$X=new$kb($X);}if(!in_array($zf,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$zf,$A)){$X=(float)$X;$zf=$A[1];}elseif(preg_match('~^\(date\)(.+)~',$zf,$A)){$Sb=new
DateTime($X);$kb='MongoDB\BSON\UTCDatetime';$X=new$kb($Sb->getTimestamp()*1000);$zf=$A[1];}switch($zf){case'=':$zf='$eq';break;case'!=':$zf='$ne';break;case'>':$zf='$gt';break;case'<':$zf='$lt';break;case'>=':$zf='$gte';break;case'<=':$zf='$lte';break;case'regex':$zf='$regex';break;default:continue
2;}if($T=='and')$Qb['$and'][]=array($nb=>array($zf=>$X));elseif($T=='or')$Qb['$or'][]=array($nb=>array($zf=>$X));}}}return$Qb;}$Af=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}elseif(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Ri,$Df){return@new
MongoClient($Ri,$Df);}function
query($F){return
false;}function
select_db($j){try{$this->_db=$this->_link->selectDB($j);return
true;}catch(Exception$Gc){$this->error=$Gc->getMessage();return
false;}}function
quote($P){return$P;}function
ping($_){}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($G){foreach($G
as$he){$I=array();foreach($he
as$y=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$y]=63;$I[$y]=(is_a($X,'MongoId')?'ObjectId("'.strval($X).'")':(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?strval($X):(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$I;foreach($I
as$y=>$X){if(!isset($this->_rows[0][$y]))$this->_rows[0][$y]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);if(!$I)return$I;$H=array();foreach($this->_rows[0]as$y=>$X)$H[$y]=$I[$y];next($this->_rows);return$H;}function
fetch_row(){$H=$this->fetch_assoc();if(!$H)return$H;return
array_values($H);}function
fetch_field(){$ne=array_keys($this->_rows[0]);$B=$ne[$this->_offset++];return(object)array('name'=>$B,'charsetnr'=>$this->_charset[$B],);}}class
Min_Driver
extends
Min_SQL{public$rg="_id";function
select($Q,$K,$Z,$td,$Ff=array(),$z=1,$D=0,$tg=false){$K=($K==array("*")?array():array_fill_keys($K,true));$Bh=array();foreach($Ff
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Ib);$Bh[$X]=($Ib?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($Q)->find(array(),$K)->sort($Bh)->limit($z!=""?+$z:0)->skip($D*$z));}function
insert($Q,$N){try{$H=$this->_conn->_db->selectCollection($Q)->insert($N);$this->_conn->errno=$H['code'];$this->_conn->error=$H['err'];$this->_conn->last_id=$N['_id'];return!$H['err'];}catch(Exception$Gc){$this->_conn->error=$Gc->getMessage();return
false;}}}function
get_databases($gd){global$g;$H=array();$Vb=$g->_link->listDBs();foreach($Vb['databases']as$l)$H[]=$l['name'];return$H;}function
count_tables($k){global$g;$H=array();foreach($k
as$l)$H[$l]=count($g->_link->selectDB($l)->getCollectionNames(true));return$H;}function
tables_list(){global$g;return
array_fill_keys($g->_db->getCollectionNames(true),'table');}function
drop_databases($k){global$g;foreach($k
as$l){$Tg=$g->_link->selectDB($l)->drop();if(!$Tg['ok'])return
false;}return
true;}function
indexes($Q,$h=null){global$g;$H=array();foreach($g->_db->selectCollection($Q)->getIndexInfo()as$v){$dc=array();foreach($v["key"]as$e=>$T)$dc[]=($T==-1?'1':null);$H[$v["name"]]=array("type"=>($v["name"]=="_id_"?"PRIMARY":($v["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($v["key"]),"lengths"=>array(),"descs"=>$dc,);}return$H;}function
fields($Q){return
fields_from_edit();}function
found_rows($R,$Z){global$g;return$g->_db->selectCollection($_GET["select"])->count($Z);}$Af=array("=");}function
table($u){return$u;}function
idf_escape($u){return$u;}function
table_status($B="",$Uc=false){$H=array();foreach(tables_list()as$Q=>$T){$H[$Q]=array("Name"=>$Q);if($B==$Q)return$H[$Q];}return$H;}function
create_database($l,$d){return
true;}function
last_id(){global$g;return$g->last_id;}function
error(){global$g;return
h($g->error);}function
collations(){return
array();}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
connect(){global$b;$g=new
Min_DB;list($M,$V,$E)=$b->credentials();$Df=array();if($V.$E!=""){$Df["username"]=$V;$Df["password"]=$E;}$l=$b->database();if($l!="")$Df["db"]=$l;if(($La=getenv("MONGO_AUTH_SOURCE")))$Df["authSource"]=$La;try{$g->_link=$g->connect("mongodb://$M",$Df);if($E!=""){$Df["password"]="";try{$g->ping($g->connect("mongodb://$M",$Df));return'Database does not support password.';}catch(Exception$Gc){}}return$g;}catch(Exception$Gc){return$Gc->getMessage();}}function
alter_indexes($Q,$c){global$g;foreach($c
as$X){list($T,$B,$N)=$X;if($N=="DROP")$H=$g->_db->command(array("deleteIndexes"=>$Q,"index"=>$B));else{$f=array();foreach($N
as$e){$e=preg_replace('~ DESC$~','',$e,1,$Ib);$f[$e]=($Ib?-1:1);}$H=$g->_db->selectCollection($Q)->ensureIndex($f,array("unique"=>($T=="UNIQUE"),"name"=>$B,));}if($H['errmsg']){$g->error=$H['errmsg'];return
false;}}return
true;}function
support($Vc){return
preg_match("~database|indexes|descidx~",$Vc);}function
db_collation($l,$pb){}function
information_schema(){}function
is_view($R){}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
foreign_keys($Q){return
array();}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){global$g;if($Q==""){$g->_db->createCollection($B);return
true;}}function
drop_tables($S){global$g;foreach($S
as$Q){$Tg=$g->_db->selectCollection($Q)->drop();if(!$Tg['ok'])return
false;}return
true;}function
truncate_tables($S){global$g;foreach($S
as$Q){$Tg=$g->_db->selectCollection($Q)->remove();if(!$Tg['ok'])return
false;}return
true;}$x="mongo";$qd=array();$wd=array();$rc=array(array("json"));}$jc["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){$og=array("json + allow_url_fopen");define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url,$_db;function
rootQuery($eg,$Db=array(),$Xe='GET'){@ini_set('track_errors',1);$Zc=@file_get_contents("$this->_url/".ltrim($eg,'/'),false,stream_context_create(array('http'=>array('method'=>$Xe,'content'=>$Db===null?$Db:json_encode($Db),'header'=>'Content-Type: application/json','ignore_errors'=>1,))));if(!$Zc){$this->error=$php_errormsg;return$Zc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error='Invalid credentials.'." $http_response_header[0]";return
false;}$H=json_decode($Zc,true);if($H===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$Bb=get_defined_constants(true);foreach($Bb['json']as$B=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$B)){$this->error=$B;break;}}}}return$H;}function
query($eg,$Db=array(),$Xe='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($eg,'/'),$Db,$Xe);}function
connect($M,$V,$E){preg_match('~^(https?://)?(.*)~',$M,$A);$this->_url=($A[1]?$A[1]:"http://")."$V:$E@$A[2]";$H=$this->query('');if($H)$this->server_info=$H['version']['number'];return(bool)$H;}function
select_db($j){$this->_db=$j;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows;function
__construct($J){$this->num_rows=count($J);$this->_rows=$J;reset($this->_rows);}function
fetch_assoc(){$H=current($this->_rows);next($this->_rows);return$H;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($Q,$K,$Z,$td,$Ff=array(),$z=1,$D=0,$tg=false){global$b;$Qb=array();$F="$Q/_search";if($K!=array("*"))$Qb["fields"]=$K;if($Ff){$Bh=array();foreach($Ff
as$nb){$nb=preg_replace('~ DESC$~','',$nb,1,$Ib);$Bh[]=($Ib?array($nb=>"desc"):$nb);}$Qb["sort"]=$Bh;}if($z){$Qb["size"]=+$z;if($D)$Qb["from"]=($D*$z);}foreach($Z
as$X){list($nb,$zf,$X)=explode(" ",$X,3);if($nb=="_id")$Qb["query"]["ids"]["values"][]=$X;elseif($nb.$X!=""){$hi=array("term"=>array(($nb!=""?$nb:"_all")=>$X));if($zf=="=")$Qb["query"]["filtered"]["filter"]["and"][]=$hi;else$Qb["query"]["filtered"]["query"]["bool"]["must"][]=$hi;}}if($Qb["query"]&&!$Qb["query"]["filtered"]["query"]&&!$Qb["query"]["ids"])$Qb["query"]["filtered"]["query"]=array("match_all"=>array());$Kh=microtime(true);$jh=$this->_conn->query($F,$Qb);if($tg)echo$b->selectQuery("$F: ".json_encode($Qb),$Kh,!$jh);if(!$jh)return
false;$H=array();foreach($jh['hits']['hits']as$Fd){$I=array();if($K==array("*"))$I["_id"]=$Fd["_id"];$p=$Fd['_source'];if($K!=array("*")){$p=array();foreach($K
as$y)$p[$y]=$Fd['fields'][$y];}foreach($p
as$y=>$X){if($Qb["fields"])$X=$X[0];$I[$y]=(is_array($X)?json_encode($X):$X);}$H[]=$I;}return
new
Min_Result($H);}function
update($T,$Hg,$Cg,$z=0,$L="\n"){$cg=preg_split('~ *= *~',$Cg);if(count($cg)==2){$t=trim($cg[1]);$F="$T/$t";return$this->_conn->query($F,$Hg,'POST');}return
false;}function
insert($T,$Hg){$t="";$F="$T/$t";$Tg=$this->_conn->query($F,$Hg,'POST');$this->_conn->last_id=$Tg['_id'];return$Tg['created'];}function
delete($T,$Cg,$z=0){$Kd=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Kd[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$db){$cg=preg_split('~ *= *~',$db);if(count($cg)==2)$Kd[]=trim($cg[1]);}}$this->_conn->affected_rows=0;foreach($Kd
as$t){$F="{$T}/{$t}";$Tg=$this->_conn->query($F,'{}','DELETE');if(is_array($Tg)&&$Tg['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$g=new
Min_DB;list($M,$V,$E)=$b->credentials();if($E!=""&&$g->connect($M,$V,""))return'Database does not support password.';if($g->connect($M,$V,$E))return$g;return$g->error;}function
support($Vc){return
preg_match("~database|table|columns~",$Vc);}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
get_databases(){global$g;$H=$g->rootQuery('_aliases');if($H){$H=array_keys($H);sort($H,SORT_STRING);}return$H;}function
collations(){return
array();}function
db_collation($l,$pb){}function
engines(){return
array();}function
count_tables($k){global$g;$H=array();$G=$g->query('_stats');if($G&&$G['indices']){$Sd=$G['indices'];foreach($Sd
as$Rd=>$Lh){$Qd=$Lh['total']['indexing'];$H[$Rd]=$Qd['index_total'];}}return$H;}function
tables_list(){global$g;if(min_version(6))return
array('_doc'=>'table');$H=$g->query('_mapping');if($H)$H=array_fill_keys(array_keys($H[$g->_db]["mappings"]),'table');return$H;}function
table_status($B="",$Uc=false){global$g;$jh=$g->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$H=array();if($jh){$S=$jh["aggregations"]["count_by_type"]["buckets"];foreach($S
as$Q){$H[$Q["key"]]=array("Name"=>$Q["key"],"Engine"=>"table","Rows"=>$Q["doc_count"],);if($B!=""&&$B==$Q["key"])return$H[$B];}}return$H;}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($R){}function
indexes($Q,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($Q){global$g;$Fe=array();if(min_version(6)){$G=$g->query("_mapping");if($G)$Fe=$G[$g->_db]['mappings']['properties'];}else{$G=$g->query("$Q/_mapping");if($G){$Fe=$G[$Q]['properties'];if(!$Fe)$Fe=$G[$g->_db]['mappings'][$Q]['properties'];}}$H=array();if($Fe){foreach($Fe
as$B=>$o){$H[$B]=array("field"=>$B,"full_type"=>$o["type"],"type"=>$o["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($o["properties"]){unset($H[$B]["privileges"]["insert"]);unset($H[$B]["privileges"]["update"]);}}}return$H;}function
foreign_keys($Q){return
array();}function
table($u){return$u;}function
idf_escape($u){return$u;}function
convert_field($o){}function
unconvert_field($o,$H){return$H;}function
fk_support($R){}function
found_rows($R,$Z){return
null;}function
create_database($l){global$g;return$g->rootQuery(urlencode($l),null,'PUT');}function
drop_databases($k){global$g;return$g->rootQuery(urlencode(implode(',',$k)),array(),'DELETE');}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){global$g;$zg=array();foreach($p
as$Sc){$Xc=trim($Sc[1][0]);$Yc=trim($Sc[1][1]?$Sc[1][1]:"text");$zg[$Xc]=array('type'=>$Yc);}if(!empty($zg))$zg=array('properties'=>$zg);return$g->query("_mapping/{$B}",$zg,'PUT');}function
drop_tables($S){global$g;$H=true;foreach($S
as$Q)$H=$H&&$g->query(urlencode($Q),array(),'DELETE');return$H;}function
last_id(){global$g;return$g->last_id;}$x="elastic";$Af=array("=","query");$qd=array();$wd=array();$rc=array(array("json"));$U=array();$Oh=array();foreach(array('Numbers'=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),'Date and time'=>array("date"=>10),'Strings'=>array("string"=>65535,"text"=>65535),'Binary'=>array("binary"=>255),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}}$jc["clickhouse"]="ClickHouse (alpha)";if(isset($_GET["clickhouse"])){define("DRIVER","clickhouse");class
Min_DB{var$extension="JSON",$server_info,$errno,$_result,$error,$_url;var$_db='default';function
rootQuery($l,$F){@ini_set('track_errors',1);$Zc=@file_get_contents("$this->_url/?database=$l",false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$this->isQuerySelectLike($F)?"$F FORMAT JSONCompact":$F,'header'=>'Content-type: application/x-www-form-urlencoded','ignore_errors'=>1,))));if($Zc===false){$this->error=$php_errormsg;return$Zc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error='Invalid credentials.'." $http_response_header[0]";return
false;}$H=json_decode($Zc,true);if($H===null){if(!$this->isQuerySelectLike($F)&&$Zc==='')return
true;$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$Bb=get_defined_constants(true);foreach($Bb['json']as$B=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$B)){$this->error=$B;break;}}}}return
new
Min_Result($H);}function
isQuerySelectLike($F){return(bool)preg_match('~^(select|show)~i',$F);}function
query($F){return$this->rootQuery($this->_db,$F);}function
connect($M,$V,$E){preg_match('~^(https?://)?(.*)~',$M,$A);$this->_url=($A[1]?$A[1]:"http://")."$V:$E@$A[2]";$H=$this->query('SELECT 1');return(bool)$H;}function
select_db($j){$this->_db=$j;return
true;}function
quote($P){return"'".addcslashes($P,"\\'")."'";}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=0){$G=$this->query($F);return$G['data'];}}class
Min_Result{var$num_rows,$_rows,$columns,$meta,$_offset=0;function
__construct($G){$this->num_rows=$G['rows'];$this->_rows=$G['data'];$this->meta=$G['meta'];$this->columns=array_column($this->meta,'name');reset($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);next($this->_rows);return$I===false?false:array_combine($this->columns,$I);}function
fetch_row(){$I=current($this->_rows);next($this->_rows);return$I;}function
fetch_field(){$e=$this->_offset++;$H=new
stdClass;if($e<count($this->columns)){$H->name=$this->meta[$e]['name'];$H->orgname=$H->name;$H->type=$this->meta[$e]['type'];}return$H;}}class
Min_Driver
extends
Min_SQL{function
delete($Q,$Cg,$z=0){if($Cg==='')$Cg='WHERE 1=1';return
queries("ALTER TABLE ".table($Q)." DELETE $Cg");}function
update($Q,$N,$Cg,$z=0,$L="\n"){$cj=array();foreach($N
as$y=>$X)$cj[]="$y = $X";$F=$L.implode(",$L",$cj);return
queries("ALTER TABLE ".table($Q)." UPDATE $F$Cg");}}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
table($u){return
idf_escape($u);}function
explain($g,$F){return'';}function
found_rows($R,$Z){$J=get_vals("SELECT COUNT(*) FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):""));return
empty($J)?false:$J[0];}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){$c=$Ff=array();foreach($p
as$o){if($o[1][2]===" NULL")$o[1][1]=" Nullable({$o[1][1]})";elseif($o[1][2]===' NOT NULL')$o[1][2]='';if($o[1][3])$o[1][3]='';$c[]=($o[1]?($Q!=""?($o[0]!=""?"MODIFY COLUMN ":"ADD COLUMN "):" ").implode($o[1]):"DROP COLUMN ".idf_escape($o[0]));$Ff[]=$o[1][0];}$c=array_merge($c,$id);$O=($zc?" ENGINE ".$zc:"");if($Q=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)$O$ag".' ORDER BY ('.implode(',',$Ff).')');if($Q!=$B){$G=queries("RENAME TABLE ".table($Q)." TO ".table($B));if($c)$Q=$B;else
return$G;}if($O)$c[]=ltrim($O);return($c||$ag?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$ag):true);}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($hj){return
drop_tables($hj);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
connect(){global$b;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2]))return$g;return$g->error;}function
get_databases($gd){global$g;$G=get_rows('SHOW DATABASES');$H=array();foreach($G
as$I)$H[]=$I['name'];sort($H);return$H;}function
limit($F,$Z,$z,$C=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($C?", $C":""):"");}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($l,$pb){}function
engines(){return
array('MergeTree');}function
logged_user(){global$b;$Lb=$b->credentials();return$Lb[1];}function
tables_list(){$G=get_rows('SHOW TABLES');$H=array();foreach($G
as$I)$H[$I['name']]='table';ksort($H);return$H;}function
count_tables($k){return
array();}function
table_status($B="",$Uc=false){global$g;$H=array();$S=get_rows("SELECT name, engine FROM system.tables WHERE database = ".q($g->_db));foreach($S
as$Q){$H[$Q['name']]=array('Name'=>$Q['name'],'Engine'=>$Q['engine'],);if($B===$Q['name'])return$H[$Q['name']];}return$H;}function
is_view($R){return
false;}function
fk_support($R){return
false;}function
convert_field($o){}function
unconvert_field($o,$H){if(in_array($o['type'],array("Int8","Int16","Int32","Int64","UInt8","UInt16","UInt32","UInt64","Float32","Float64")))return"to$o[type]($H)";return$H;}function
fields($Q){$H=array();$G=get_rows("SELECT name, type, default_expression FROM system.columns WHERE ".idf_escape('table')." = ".q($Q));foreach($G
as$I){$T=trim($I['type']);$lf=strpos($T,'Nullable(')===0;$H[trim($I['name'])]=array("field"=>trim($I['name']),"full_type"=>$T,"type"=>$T,"default"=>trim($I['default_expression']),"null"=>$lf,"auto_increment"=>'0',"privileges"=>array("insert"=>1,"select"=>1,"update"=>0),);}return$H;}function
indexes($Q,$h=null){return
array();}function
foreign_keys($Q){return
array();}function
collations(){return
array();}function
information_schema($l){return
false;}function
error(){global$g;return
h($g->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($hh){return
true;}function
auto_increment(){return'';}function
last_id(){return
0;}function
support($Vc){return
preg_match("~^(columns|sql|status|table|drop_col)$~",$Vc);}$x="clickhouse";$U=array();$Oh=array();foreach(array('Numbers'=>array("Int8"=>3,"Int16"=>5,"Int32"=>10,"Int64"=>19,"UInt8"=>3,"UInt16"=>5,"UInt32"=>10,"UInt64"=>20,"Float32"=>7,"Float64"=>16,'Decimal'=>38,'Decimal32'=>9,'Decimal64'=>18,'Decimal128'=>38),'Date and time'=>array("Date"=>13,"DateTime"=>20),'Strings'=>array("String"=>0),'Binary'=>array("FixedString"=>0),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}$Pi=array();$Af=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$qd=array();$wd=array("avg","count","count distinct","max","min","sum");$rc=array();}$jc=array("server"=>"MySQL")+$jc;if(!defined("DRIVER")){$og=array("MySQLi","MySQL","PDO_MySQL");define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($M="",$V="",$E="",$j=null,$kg=null,$Ah=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Gd,$kg)=explode(":",$M,2);$Jh=$b->connectSsl();if($Jh)$this->ssl_set($Jh['key'],$Jh['cert'],$Jh['ca'],'','');$H=@$this->real_connect(($M!=""?$Gd:ini_get("mysqli.default_host")),($M.$V!=""?$V:ini_get("mysqli.default_user")),($M.$V.$E!=""?$E:ini_get("mysqli.default_pw")),$j,(is_numeric($kg)?$kg:ini_get("mysqli.default_port")),(!is_numeric($kg)?$kg:$Ah),($Jh?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$H;}function
set_charset($cb){if(parent::set_charset($cb))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $cb");}function
result($F,$o=0){$G=$this->query($F);if(!$G)return
false;$I=$G->fetch_array();return$I[$o];}function
quote($P){return"'".$this->escape_string($P)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($M,$V,$E){if(ini_bool("mysql.allow_local_infile")){$this->error=sprintf('Disable %s or enable %s or %s extensions.',"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($M!=""?$M:ini_get("mysql.default_host")),("$M$V"!=""?$V:ini_get("mysql.default_user")),("$M$V$E"!=""?$E:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($cb){if(function_exists('mysql_set_charset')){if(mysql_set_charset($cb,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $cb");}function
quote($P){return"'".mysql_real_escape_string($P,$this->_link)."'";}function
select_db($j){return
mysql_select_db($j,$this->_link);}function
query($F,$Ji=false){$G=@($Ji?mysql_unbuffered_query($F,$this->_link):mysql_query($F,$this->_link));$this->error="";if(!$G){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($G===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($G);}function
multi_query($F){return$this->_result=$this->query($F);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($F,$o=0){$G=$this->query($F);if(!$G||!$G->num_rows)return
false;return
mysql_result($G->_result,0,$o);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($G){$this->_result=$G;$this->num_rows=mysql_num_rows($G);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$H=mysql_fetch_field($this->_result,$this->_offset++);$H->orgtable=$H->table;$H->orgname=$H->name;$H->charsetnr=($H->blob?63:0);return$H;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($M,$V,$E){global$b;$Df=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$Jh=$b->connectSsl();if($Jh){if(!empty($Jh['key']))$Df[PDO::MYSQL_ATTR_SSL_KEY]=$Jh['key'];if(!empty($Jh['cert']))$Df[PDO::MYSQL_ATTR_SSL_CERT]=$Jh['cert'];if(!empty($Jh['ca']))$Df[PDO::MYSQL_ATTR_SSL_CA]=$Jh['ca'];}$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$E,$Df);return
true;}function
set_charset($cb){$this->query("SET NAMES $cb");}function
select_db($j){return$this->query("USE ".idf_escape($j));}function
query($F,$Ji=false){$this->pdo->setAttribute(1000,!$Ji);return
parent::query($F,$Ji);}}}class
Min_Driver
extends
Min_SQL{function
insert($Q,$N){return($N?parent::insert($Q,$N):queries("INSERT INTO ".table($Q)." ()\nVALUES ()"));}function
insertUpdate($Q,$J,$rg){$f=array_keys(reset($J));$pg="INSERT INTO ".table($Q)." (".implode(", ",$f).") VALUES\n";$cj=array();foreach($f
as$y)$cj[$y]="$y = VALUES($y)";$Rh="\nON DUPLICATE KEY UPDATE ".implode(", ",$cj);$cj=array();$ze=0;foreach($J
as$N){$Y="(".implode(", ",$N).")";if($cj&&(strlen($pg)+$ze+strlen($Y)+strlen($Rh)>1e6)){if(!queries($pg.implode(",\n",$cj).$Rh))return
false;$cj=array();$ze=0;}$cj[]=$Y;$ze+=strlen($Y)+2;}return
queries($pg.implode(",\n",$cj).$Rh);}function
slowQuery($F,$mi){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$mi FOR $F";elseif(preg_match('~^(SELECT\b)(.+)~is',$F,$A))return"$A[1] /*+ MAX_EXECUTION_TIME(".($mi*1000).") */ $A[2]";}}function
convertSearch($u,$X,$o){return(preg_match('~char|text|enum|set~',$o["type"])&&!preg_match("~^utf8~",$o["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($u USING ".charset($this->_conn).")":$u);}function
warnings(){$G=$this->_conn->query("SHOW WARNINGS");if($G&&$G->num_rows){ob_start();select($G);return
ob_get_clean();}}function
tableHelp($B){$Ge=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($Ge?"information-schema-$B-table/":str_replace("_","-",$B)."-table.html"));if(DB=="mysql")return($Ge?"mysql$B-table/":"system-database.html");}}function
idf_escape($u){return"`".str_replace("`","``",$u)."`";}function
table($u){return
idf_escape($u);}function
connect(){global$b,$U,$Oh;$g=new
Min_DB;$Lb=$b->credentials();if($g->connect($Lb[0],$Lb[1],$Lb[2])){$g->set_charset(charset($g));$g->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$g)){$Oh['Strings'][]="json";$U["json"]=4294967295;}return$g;}$H=$g->error;if(function_exists('iconv')&&!is_utf8($H)&&strlen($fh=iconv("windows-1250","utf-8",$H))>strlen($H))$H=$fh;return$H;}function
get_databases($gd){$H=get_session("dbs");if($H===null){$F=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$H=($gd?slow_query($F):get_vals($F));restart_session();set_session("dbs",$H);stop_session();}return$H;}function
limit($F,$Z,$z,$C=0,$L=" "){return" $F$Z".($z!==null?$L."LIMIT $z".($C?" OFFSET $C":""):"");}function
limit1($Q,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($l,$pb){global$g;$H=null;$i=$g->result("SHOW CREATE DATABASE ".idf_escape($l),1);if(preg_match('~ COLLATE ([^ ]+)~',$i,$A))$H=$A[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$i,$A))$H=$pb[$A[1]][-1];return$H;}function
engines(){$H=array();foreach(get_rows("SHOW ENGINES")as$I){if(preg_match("~YES|DEFAULT~",$I["Support"]))$H[]=$I["Engine"];}return$H;}function
logged_user(){global$g;return$g->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($k){$H=array();foreach($k
as$l)$H[$l]=count(get_vals("SHOW TABLES IN ".idf_escape($l)));return$H;}function
table_status($B="",$Uc=false){$H=array();foreach(get_rows($Uc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($B!=""?"AND TABLE_NAME = ".q($B):"ORDER BY Name"):"SHOW TABLE STATUS".($B!=""?" LIKE ".q(addcslashes($B,"%_\\")):""))as$I){if($I["Engine"]=="InnoDB")$I["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$I["Comment"]);if(!isset($I["Engine"]))$I["Comment"]="";if($B!="")return$I;$H[$I["Name"]]=$I;}return$H;}function
is_view($R){return$R["Engine"]===null;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"])||(preg_match('~NDB~i',$R["Engine"])&&min_version(5.6));}function
fields($Q){$H=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($Q))as$I){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$I["Type"],$A);$H[$I["Field"]]=array("field"=>$I["Field"],"full_type"=>$I["Type"],"type"=>$A[1],"length"=>$A[2],"unsigned"=>ltrim($A[3].$A[4]),"default"=>($I["Default"]!=""||preg_match("~char|set~",$A[1])?(preg_match('~text~',$A[1])?stripslashes(preg_replace("~^'(.*)'\$~",'\1',$I["Default"])):$I["Default"]):null),"null"=>($I["Null"]=="YES"),"auto_increment"=>($I["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$I["Extra"],$A)?$A[1]:""),"collation"=>$I["Collation"],"privileges"=>array_flip(preg_split('~, *~',$I["Privileges"])),"comment"=>$I["Comment"],"primary"=>($I["Key"]=="PRI"),"generated"=>preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$I["Extra"]),);}return$H;}function
indexes($Q,$h=null){$H=array();foreach(get_rows("SHOW INDEX FROM ".table($Q),$h)as$I){$B=$I["Key_name"];$H[$B]["type"]=($B=="PRIMARY"?"PRIMARY":($I["Index_type"]=="FULLTEXT"?"FULLTEXT":($I["Non_unique"]?($I["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$H[$B]["columns"][]=$I["Column_name"];$H[$B]["lengths"][]=($I["Index_type"]=="SPATIAL"?null:$I["Sub_part"]);$H[$B]["descs"][]=null;}return$H;}function
foreign_keys($Q){global$g,$wf;static$gg='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$H=array();$Jb=$g->result("SHOW CREATE TABLE ".table($Q),1);if($Jb){preg_match_all("~CONSTRAINT ($gg) FOREIGN KEY ?\\(((?:$gg,? ?)+)\\) REFERENCES ($gg)(?:\\.($gg))? \\(((?:$gg,? ?)+)\\)(?: ON DELETE ($wf))?(?: ON UPDATE ($wf))?~",$Jb,$Je,PREG_SET_ORDER);foreach($Je
as$A){preg_match_all("~$gg~",$A[2],$Ch);preg_match_all("~$gg~",$A[5],$ei);$H[idf_unescape($A[1])]=array("db"=>idf_unescape($A[4]!=""?$A[3]:$A[4]),"table"=>idf_unescape($A[4]!=""?$A[4]:$A[3]),"source"=>array_map('idf_unescape',$Ch[0]),"target"=>array_map('idf_unescape',$ei[0]),"on_delete"=>($A[6]?$A[6]:"RESTRICT"),"on_update"=>($A[7]?$A[7]:"RESTRICT"),);}}return$H;}function
view($B){global$g;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$g->result("SHOW CREATE VIEW ".table($B),1)));}function
collations(){$H=array();foreach(get_rows("SHOW COLLATION")as$I){if($I["Default"])$H[$I["Charset"]][-1]=$I["Collation"];else$H[$I["Charset"]][]=$I["Collation"];}ksort($H);foreach($H
as$y=>$X)asort($H[$y]);return$H;}function
information_schema($l){return(min_version(5)&&$l=="information_schema")||(min_version(5.5)&&$l=="performance_schema");}function
error(){global$g;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$g->error));}function
create_database($l,$d){return
queries("CREATE DATABASE ".idf_escape($l).($d?" COLLATE ".q($d):""));}function
drop_databases($k){$H=apply_queries("DROP DATABASE",$k,'idf_escape');restart_session();set_session("dbs",null);return$H;}function
rename_database($B,$d){$H=false;if(create_database($B,$d)){$Rg=array();foreach(tables_list()as$Q=>$T)$Rg[]=table($Q)." TO ".idf_escape($B).".".table($Q);$H=(!$Rg||queries("RENAME TABLE ".implode(", ",$Rg)));if($H)queries("DROP DATABASE ".idf_escape(DB));restart_session();set_session("dbs",null);}return$H;}function
auto_increment(){$Na=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$v){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$v["columns"],true)){$Na="";break;}if($v["type"]=="PRIMARY")$Na=" UNIQUE";}}return" AUTO_INCREMENT$Na";}function
alter_table($Q,$B,$p,$id,$ub,$zc,$d,$Ma,$ag){$c=array();foreach($p
as$o)$c[]=($o[1]?($Q!=""?($o[0]!=""?"CHANGE ".idf_escape($o[0]):"ADD"):" ")." ".implode($o[1]).($Q!=""?$o[2]:""):"DROP ".idf_escape($o[0]));$c=array_merge($c,$id);$O=($ub!==null?" COMMENT=".q($ub):"").($zc?" ENGINE=".q($zc):"").($d?" COLLATE ".q($d):"").($Ma!=""?" AUTO_INCREMENT=$Ma":"");if($Q=="")return
queries("CREATE TABLE ".table($B)." (\n".implode(",\n",$c)."\n)$O$ag");if($Q!=$B)$c[]="RENAME TO ".table($B);if($O)$c[]=ltrim($O);return($c||$ag?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$ag):true);}function
alter_indexes($Q,$c){foreach($c
as$y=>$X)$c[$y]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($Q).implode(",",$c));}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($hj){return
queries("DROP VIEW ".implode(", ",array_map('table',$hj)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$hj,$ei){$Rg=array();foreach(array_merge($S,$hj)as$Q)$Rg[]=table($Q)." TO ".idf_escape($ei).".".table($Q);return
queries("RENAME TABLE ".implode(", ",$Rg));}function
copy_tables($S,$hj,$ei){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($S
as$Q){$B=($ei==DB?table("copy_$Q"):idf_escape($ei).".".table($Q));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $B"))||!queries("CREATE TABLE $B LIKE ".table($Q))||!queries("INSERT INTO $B SELECT * FROM ".table($Q)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$I){$Di=$I["Trigger"];if(!queries("CREATE TRIGGER ".($ei==DB?idf_escape("copy_$Di"):idf_escape($ei).".".idf_escape($Di))." $I[Timing] $I[Event] ON $B FOR EACH ROW\n$I[Statement];"))return
false;}}foreach($hj
as$Q){$B=($ei==DB?table("copy_$Q"):idf_escape($ei).".".table($Q));$gj=view($Q);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $B"))||!queries("CREATE VIEW $B AS $gj[select]"))return
false;}return
true;}function
trigger($B){if($B=="")return
array();$J=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($B));return
reset($J);}function
triggers($Q){$H=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$I)$H[$I["Trigger"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($B,$T){global$g,$Ac,$Xd,$U;$Ca=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$Dh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$Ii="((".implode("|",array_merge(array_keys($U),$Ca)).")\\b(?:\\s*\\(((?:[^'\")]|$Ac)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$gg="$Dh*(".($T=="FUNCTION"?"":$Xd).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$Ii";$i=$g->result("SHOW CREATE $T ".idf_escape($B),2);preg_match("~\\(((?:$gg\\s*,?)*)\\)\\s*".($T=="FUNCTION"?"RETURNS\\s+$Ii\\s+":"")."(.*)~is",$i,$A);$p=array();preg_match_all("~$gg\\s*,?~is",$A[1],$Je,PREG_SET_ORDER);foreach($Je
as$Tf)$p[]=array("field"=>str_replace("``","`",$Tf[2]).$Tf[3],"type"=>strtolower($Tf[5]),"length"=>preg_replace_callback("~$Ac~s",'normalize_enum',$Tf[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Tf[8] $Tf[7]"))),"null"=>1,"full_type"=>$Tf[4],"inout"=>strtoupper($Tf[1]),"collation"=>strtolower($Tf[9]),);if($T!="FUNCTION")return
array("fields"=>$p,"definition"=>$A[11]);return
array("fields"=>$p,"returns"=>array("type"=>$A[12],"length"=>$A[13],"unsigned"=>$A[15],"collation"=>$A[16]),"definition"=>$A[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($B,$I){return
idf_escape($B);}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ID()");}function
explain($g,$F){return$g->query("EXPLAIN ".(min_version(5.1)?"PARTITIONS ":"").$F);}function
found_rows($R,$Z){return($Z||$R["Engine"]!="InnoDB"?null:$R["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($hh,$h=null){return
true;}function
create_sql($Q,$Ma,$Ph){global$g;$H=$g->result("SHOW CREATE TABLE ".table($Q),1);if(!$Ma)$H=preg_replace('~ AUTO_INCREMENT=\d+~','',$H);return$H;}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
use_sql($j){return"USE ".idf_escape($j);}function
trigger_sql($Q){$H="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")),null,"-- ")as$I)$H.="\nCREATE TRIGGER ".idf_escape($I["Trigger"])." $I[Timing] $I[Event] ON ".table($I["Table"])." FOR EACH ROW\n$I[Statement];;\n";return$H;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($o){if(preg_match("~binary~",$o["type"]))return"HEX(".idf_escape($o["field"]).")";if($o["type"]=="bit")return"BIN(".idf_escape($o["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($o["field"]).")";}function
unconvert_field($o,$H){if(preg_match("~binary~",$o["type"]))$H="UNHEX($H)";if($o["type"]=="bit")$H="CONV($H, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$o["type"]))$H=(min_version(8)?"ST_":"")."GeomFromText($H, SRID($o[field]))";return$H;}function
support($Vc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view")))."~",$Vc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$g;return$g->result("SELECT @@max_connections");}$x="sql";$U=array();$Oh=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),'Date and time'=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),'Strings'=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),'Lists'=>array("enum"=>65535,"set"=>64),'Binary'=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),'Geometry'=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$y=>$X){$U+=$X;$Oh[$y]=array_keys($X);}$Pi=array("unsigned","zerofill","unsigned zerofill");$Af=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$qd=array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper");$wd=array("avg","count","count distinct","group_concat","max","min","sum");$rc=array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",));}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ia="4.7.9";class
Adminer{var$operators;function
name(){return"<a href='https://www.adminer.org/'".target_blank()." id='h1'>Adminer</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($i=false){return
password_file($i);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($M){return
h($M);}function
database(){return
DB;}function
databases($gd=true){return
get_databases($gd);}function
schemas(){return
schemas();}function
queryTimeout(){return
2;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$H=array();$ad="adminer.css";if(file_exists($ad))$H[]="$ad?v=".crc32(file_get_contents($ad));return$H;}function
loginForm(){global$jc;echo"<table cellspacing='0' class='layout'>\n",$this->loginFormField('driver','<tr><th>'.'System'.'<td>',html_select("auth[driver]",$jc,DRIVER,"loginDriver(this);")."\n"),$this->loginFormField('server','<tr><th>'.'Server'.'<td>','<input name="auth[server]" value="'.h(SERVER).'" title="hostname[:port]" placeholder="localhost" autocapitalize="off">'."\n"),$this->loginFormField('username','<tr><th>'.'Username'.'<td>','<input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'.script("focus(qs('#username')); qs('#username').form['auth[driver]'].onchange();")),$this->loginFormField('password','<tr><th>'.'Password'.'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),$this->loginFormField('db','<tr><th>'.'Database'.'<td>','<input name="auth[db]" value="'.h($_GET["db"]).'" autocapitalize="off">'."\n"),"</table>\n","<p><input type='submit' value='".'Login'."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],'Permanent login')."\n";}function
loginFormField($B,$Cd,$Y){return$Cd.$Y;}function
login($De,$E){if($E=="")return
sprintf('Adminer does not support accessing a database without a password, <a href="https://www.adminer.org/en/password/"%s>more information</a>.',target_blank());return
true;}function
tableName($Vh){return
h($Vh["Name"]);}function
fieldName($o,$Ff=0){return'<span title="'.h($o["full_type"]).'">'.h($o["field"]).'</span>';}function
selectLinks($Vh,$N=""){global$x,$m;echo'<p class="links">';$Be=array("select"=>'Select data');if(support("table")||support("indexes"))$Be["table"]='Show structure';if(support("table")){if(is_view($Vh))$Be["view"]='Alter view';else$Be["create"]='Alter table';}if($N!==null)$Be["edit"]='New item';$B=$Vh["Name"];foreach($Be
as$y=>$X)echo" <a href='".h(ME)."$y=".urlencode($B).($y=="edit"?$N:"")."'".bold(isset($_GET[$y])).">$X</a>";echo
doc_link(array($x=>$m->tableHelp($B)),"?"),"\n";}function
foreignKeys($Q){return
foreign_keys($Q);}function
backwardKeys($Q,$Uh){return
array();}function
backwardKeysPrint($Pa,$I){}function
selectQuery($F,$Kh,$Tc=false){global$x,$m;$H="</p>\n";if(!$Tc&&($kj=$m->warnings())){$t="warnings";$H=", <a href='#$t'>".'Warnings'."</a>".script("qsl('a').onclick = partial(toggle, '$t');","")."$H<div id='$t' class='hidden'>\n$kj</div>\n";}return"<p><code class='jush-$x'>".h(str_replace("\n"," ",$F))."</code> <span class='time'>(".format_time($Kh).")</span>".(support("sql")?" <a href='".h(ME)."sql=".urlencode($F)."'>".'Edit'."</a>":"").$H;}function
sqlCommandQuery($F){return
shorten_utf8(trim($F),1000);}function
rowDescription($Q){return"";}function
rowDescriptions($J,$jd){return$J;}function
selectLink($X,$o){}function
selectVal($X,$_,$o,$Nf){$H=($X===null?"<i>NULL</i>":(preg_match("~char|binary|boolean~",$o["type"])&&!preg_match("~var~",$o["type"])?"<code>$X</code>":$X));if(preg_match('~blob|bytea|raw|file~',$o["type"])&&!is_utf8($X))$H="<i>".lang(array('%d byte','%d bytes'),strlen($Nf))."</i>";if(preg_match('~json~',$o["type"]))$H="<code class='jush-js'>$H</code>";return($_?"<a href='".h($_)."'".(is_url($_)?target_blank():"").">$H</a>":$H);}function
editVal($X,$o){return$X;}function
tableStructurePrint($p){echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap'>\n","<thead><tr><th>".'Column'."<td>".'Type'.(support("comment")?"<td>".'Comment':"")."</thead>\n";foreach($p
as$o){echo"<tr".odd()."><th>".h($o["field"]),"<td><span title='".h($o["collation"])."'>".h($o["full_type"])."</span>",($o["null"]?" <i>NULL</i>":""),($o["auto_increment"]?" <i>".'Auto Increment'."</i>":""),(isset($o["default"])?" <span title='".'Default value'."'>[<b>".h($o["default"])."</b>]</span>":""),(support("comment")?"<td>".h($o["comment"]):""),"\n";}echo"</table>\n","</div>\n";}function
tableIndexesPrint($w){echo"<table cellspacing='0'>\n";foreach($w
as$B=>$v){ksort($v["columns"]);$tg=array();foreach($v["columns"]as$y=>$X)$tg[]="<i>".h($X)."</i>".($v["lengths"][$y]?"(".$v["lengths"][$y].")":"").($v["descs"][$y]?" DESC":"");echo"<tr title='".h($B)."'><th>$v[type]<td>".implode(", ",$tg)."\n";}echo"</table>\n";}function
selectColumnsPrint($K,$f){global$qd,$wd;print_fieldset("select",'Select',$K);$s=0;$K[""]=array();foreach($K
as$y=>$X){$X=$_GET["columns"][$y];$e=select_input(" name='columns[$s][col]'",$f,$X["col"],($y!==""?"selectFieldChange":"selectAddRow"));echo"<div>".($qd||$wd?"<select name='columns[$s][fun]'>".optionlist(array(-1=>"")+array_filter(array('Functions'=>$qd,'Aggregation'=>$wd)),$X["fun"])."</select>".on_help("getTarget(event).value && getTarget(event).value.replace(/ |\$/, '(') + ')'",1).script("qsl('select').onchange = function () { helpClose();".($y!==""?"":" qsl('select, input', this.parentNode).onchange();")." };","")."($e)":$e)."</div>\n";$s++;}echo"</div></fieldset>\n";}function
selectSearchPrint($Z,$f,$w){print_fieldset("search",'Search',$Z);foreach($w
as$s=>$v){if($v["type"]=="FULLTEXT"){echo"<div>(<i>".implode("</i>, <i>",array_map('h',$v["columns"]))."</i>) AGAINST"," <input type='search' name='fulltext[$s]' value='".h($_GET["fulltext"][$s])."'>",script("qsl('input').oninput = selectFieldChange;",""),checkbox("boolean[$s]",1,isset($_GET["boolean"][$s]),"BOOL"),"</div>\n";}}$bb="this.parentNode.firstChild.onchange();";foreach(array_merge((array)$_GET["where"],array(array()))as$s=>$X){if(!$X||("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators))){echo"<div>".select_input(" name='where[$s][col]'",$f,$X["col"],($X?"selectFieldChange":"selectAddRow"),"(".'anywhere'.")"),html_select("where[$s][op]",$this->operators,$X["op"],$bb),"<input type='search' name='where[$s][val]' value='".h($X["val"])."'>",script("mixin(qsl('input'), {oninput: function () { $bb }, onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});",""),"</div>\n";}}echo"</div></fieldset>\n";}function
selectOrderPrint($Ff,$f,$w){print_fieldset("sort",'Sort',$Ff);$s=0;foreach((array)$_GET["order"]as$y=>$X){if($X!=""){echo"<div>".select_input(" name='order[$s]'",$f,$X,"selectFieldChange"),checkbox("desc[$s]",1,isset($_GET["desc"][$y]),'descending')."</div>\n";$s++;}}echo"<div>".select_input(" name='order[$s]'",$f,"","selectAddRow"),checkbox("desc[$s]",1,false,'descending')."</div>\n","</div></fieldset>\n";}function
selectLimitPrint($z){echo"<fieldset><legend>".'Limit'."</legend><div>";echo"<input type='number' name='limit' class='size' value='".h($z)."'>",script("qsl('input').oninput = selectFieldChange;",""),"</div></fieldset>\n";}function
selectLengthPrint($ki){if($ki!==null){echo"<fieldset><legend>".'Text length'."</legend><div>","<input type='number' name='text_length' class='size' value='".h($ki)."'>","</div></fieldset>\n";}}function
selectActionPrint($w){echo"<fieldset><legend>".'Action'."</legend><div>","<input type='submit' value='".'Select'."'>"," <span id='noindex' title='".'Full table scan'."'></span>","<script".nonce().">\n","var indexColumns = ";$f=array();foreach($w
as$v){$Pb=reset($v["columns"]);if($v["type"]!="FULLTEXT"&&$Pb)$f[$Pb]=1;}$f[""]=1;foreach($f
as$y=>$X)json_row($y);echo";\n","selectFieldChange.call(qs('#form')['select']);\n","</script>\n","</div></fieldset>\n";}function
selectCommandPrint(){return!information_schema(DB);}function
selectImportPrint(){return!information_schema(DB);}function
selectEmailPrint($wc,$f){}function
selectColumnsProcess($f,$w){global$qd,$wd;$K=array();$td=array();foreach((array)$_GET["columns"]as$y=>$X){if($X["fun"]=="count"||($X["col"]!=""&&(!$X["fun"]||in_array($X["fun"],$qd)||in_array($X["fun"],$wd)))){$K[$y]=apply_sql_function($X["fun"],($X["col"]!=""?idf_escape($X["col"]):"*"));if(!in_array($X["fun"],$wd))$td[]=$K[$y];}}return
array($K,$td);}function
selectSearchProcess($p,$w){global$g,$m;$H=array();foreach($w
as$s=>$v){if($v["type"]=="FULLTEXT"&&$_GET["fulltext"][$s]!="")$H[]="MATCH (".implode(", ",array_map('idf_escape',$v["columns"])).") AGAINST (".q($_GET["fulltext"][$s]).(isset($_GET["boolean"][$s])?" IN BOOLEAN MODE":"").")";}foreach((array)$_GET["where"]as$y=>$X){if("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators)){$pg="";$xb=" $X[op]";if(preg_match('~IN$~',$X["op"])){$Nd=process_length($X["val"]);$xb.=" ".($Nd!=""?$Nd:"(NULL)");}elseif($X["op"]=="SQL")$xb=" $X[val]";elseif($X["op"]=="LIKE %%")$xb=" LIKE ".$this->processInput($p[$X["col"]],"%$X[val]%");elseif($X["op"]=="ILIKE %%")$xb=" ILIKE ".$this->processInput($p[$X["col"]],"%$X[val]%");elseif($X["op"]=="FIND_IN_SET"){$pg="$X[op](".q($X["val"]).", ";$xb=")";}elseif(!preg_match('~NULL$~',$X["op"]))$xb.=" ".$this->processInput($p[$X["col"]],$X["val"]);if($X["col"]!="")$H[]=$pg.$m->convertSearch(idf_escape($X["col"]),$X,$p[$X["col"]]).$xb;else{$rb=array();foreach($p
as$B=>$o){if((preg_match('~^[-\d.'.(preg_match('~IN$~',$X["op"])?',':'').']+$~',$X["val"])||!preg_match('~'.number_type().'|bit~',$o["type"]))&&(!preg_match("~[\x80-\xFF]~",$X["val"])||preg_match('~char|text|enum|set~',$o["type"])))$rb[]=$pg.$m->convertSearch(idf_escape($B),$X,$o).$xb;}$H[]=($rb?"(".implode(" OR ",$rb).")":"1 = 0");}}}return$H;}function
selectOrderProcess($p,$w){$H=array();foreach((array)$_GET["order"]as$y=>$X){if($X!="")$H[]=(preg_match('~^((COUNT\(DISTINCT |[A-Z0-9_]+\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\)|COUNT\(\*\))$~',$X)?$X:idf_escape($X)).(isset($_GET["desc"][$y])?" DESC":"");}return$H;}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return(isset($_GET["text_length"])?$_GET["text_length"]:"100");}function
selectEmailProcess($Z,$jd){return
false;}function
selectQueryBuild($K,$Z,$td,$Ff,$z,$D){return"";}function
messageQuery($F,$li,$Tc=false){global$x,$m;restart_session();$Dd=&get_session("queries");if(!$Dd[$_GET["db"]])$Dd[$_GET["db"]]=array();if(strlen($F)>1e6)$F=preg_replace('~[\x80-\xFF]+$~','',substr($F,0,1e6))."\nâ€¦";$Dd[$_GET["db"]][]=array($F,time(),$li);$Hh="sql-".count($Dd[$_GET["db"]]);$H="<a href='#$Hh' class='toggle'>".'SQL command'."</a>\n";if(!$Tc&&($kj=$m->warnings())){$t="warnings-".count($Dd[$_GET["db"]]);$H="<a href='#$t' class='toggle'>".'Warnings'."</a>, $H<div id='$t' class='hidden'>\n$kj</div>\n";}return" <span class='time'>".@date("H:i:s")."</span>"." $H<div id='$Hh' class='hidden'><pre><code class='jush-$x'>".shorten_utf8($F,1000)."</code></pre>".($li?" <span class='time'>($li)</span>":'').(support("sql")?'<p><a href="'.h(str_replace("db=".urlencode(DB),"db=".urlencode($_GET["db"]),ME).'sql=&history='.(count($Dd[$_GET["db"]])-1)).'">'.'Edit'.'</a>':'').'</div>';}function
editFunctions($o){global$rc;$H=($o["null"]?"NULL/":"");foreach($rc
as$y=>$qd){if(!$y||(!isset($_GET["call"])&&(isset($_GET["select"])||where($_GET)))){foreach($qd
as$gg=>$X){if(!$gg||preg_match("~$gg~",$o["type"]))$H.="/$X";}if($y&&!preg_match('~set|blob|bytea|raw|file|bool~',$o["type"]))$H.="/SQL";}}if($o["auto_increment"]&&!isset($_GET["select"])&&!where($_GET))$H='Auto Increment';return
explode("/",$H);}function
editInput($Q,$o,$Ja,$Y){if($o["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Ja value='-1' checked><i>".'original'."</i></label> ":"").($o["null"]?"<label><input type='radio'$Ja value=''".($Y!==null||isset($_GET["select"])?"":" checked")."><i>NULL</i></label> ":"").enum_input("radio",$Ja,$o,$Y,0);return"";}function
editHint($Q,$o,$Y){return"";}function
processInput($o,$Y,$r=""){if($r=="SQL")return$Y;$B=$o["field"];$H=q($Y);if(preg_match('~^(now|getdate|uuid)$~',$r))$H="$r()";elseif(preg_match('~^current_(date|timestamp)$~',$r))$H=$r;elseif(preg_match('~^([+-]|\|\|)$~',$r))$H=idf_escape($B)." $r $H";elseif(preg_match('~^[+-] interval$~',$r))$H=idf_escape($B)." $r ".(preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+\$~i",$Y)?$Y:$H);elseif(preg_match('~^(addtime|subtime|concat)$~',$r))$H="$r(".idf_escape($B).", $H)";elseif(preg_match('~^(md5|sha1|password|encrypt)$~',$r))$H="$r($H)";return
unconvert_field($o,$H);}function
dumpOutput(){$H=array('text'=>'open','file'=>'save');if(function_exists('gzencode'))$H['gz']='gzip';return$H;}function
dumpFormat(){return
array('sql'=>'SQL','csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($l){}function
dumpTable($Q,$Ph,$ge=0){if($_POST["format"]!="sql"){echo"\xef\xbb\xbf";if($Ph)dump_csv(array_keys(fields($Q)));}else{if($ge==2){$p=array();foreach(fields($Q)as$B=>$o)$p[]=idf_escape($B)." $o[full_type]";$i="CREATE TABLE ".table($Q)." (".implode(", ",$p).")";}else$i=create_sql($Q,$_POST["auto_increment"],$Ph);set_utf8mb4($i);if($Ph&&$i){if($Ph=="DROP+CREATE"||$ge==1)echo"DROP ".($ge==2?"VIEW":"TABLE")." IF EXISTS ".table($Q).";\n";if($ge==1)$i=remove_definer($i);echo"$i;\n\n";}}}function
dumpData($Q,$Ph,$F){global$g,$x;$Le=($x=="sqlite"?0:1048576);if($Ph){if($_POST["format"]=="sql"){if($Ph=="TRUNCATE+INSERT")echo
truncate_sql($Q).";\n";$p=fields($Q);}$G=$g->query($F,1);if($G){$Zd="";$Ya="";$ne=array();$Rh="";$Wc=($Q!=''?'fetch_assoc':'fetch_row');while($I=$G->$Wc()){if(!$ne){$cj=array();foreach($I
as$X){$o=$G->fetch_field();$ne[]=$o->name;$y=idf_escape($o->name);$cj[]="$y = VALUES($y)";}$Rh=($Ph=="INSERT+UPDATE"?"\nON DUPLICATE KEY UPDATE ".implode(", ",$cj):"").";\n";}if($_POST["format"]!="sql"){if($Ph=="table"){dump_csv($ne);$Ph="INSERT";}dump_csv($I);}else{if(!$Zd)$Zd="INSERT INTO ".table($Q)." (".implode(", ",array_map('idf_escape',$ne)).") VALUES";foreach($I
as$y=>$X){$o=$p[$y];$I[$y]=($X!==null?unconvert_field($o,preg_match(number_type(),$o["type"])&&!preg_match('~\[~',$o["full_type"])&&is_numeric($X)?$X:q(($X===false?0:$X))):"NULL");}$fh=($Le?"\n":" ")."(".implode(",\t",$I).")";if(!$Ya)$Ya=$Zd.$fh;elseif(strlen($Ya)+4+strlen($fh)+strlen($Rh)<$Le)$Ya.=",$fh";else{echo$Ya.$Rh;$Ya=$Zd.$fh;}}}if($Ya)echo$Ya.$Rh;}elseif($_POST["format"]=="sql")echo"-- ".str_replace("\n"," ",$g->error)."\n";}}function
dumpFilename($Id){return
friendly_url($Id!=""?$Id:(SERVER!=""?SERVER:"localhost"));}function
dumpHeaders($Id,$af=false){$Qf=$_POST["output"];$Oc=(preg_match('~sql~',$_POST["format"])?"sql":($af?"tar":"csv"));header("Content-Type: ".($Qf=="gz"?"application/x-gzip":($Oc=="tar"?"application/x-tar":($Oc=="sql"||$Qf!="file"?"text/plain":"text/csv")."; charset=utf-8")));if($Qf=="gz")ob_start('ob_gzencode',1e6);return$Oc;}function
importServerPath(){return"adminer.sql";}function
homepage(){echo'<p class="links">'.($_GET["ns"]==""&&support("database")?'<a href="'.h(ME).'database=">'.'Alter database'."</a>\n":""),(support("scheme")?"<a href='".h(ME)."scheme='>".($_GET["ns"]!=""?'Alter schema':'Create schema')."</a>\n":""),($_GET["ns"]!==""?'<a href="'.h(ME).'schema=">'.'Database schema'."</a>\n":""),(support("privileges")?"<a href='".h(ME)."privileges='>".'Privileges'."</a>\n":"");return
true;}function
navigation($Ze){global$ia,$x,$jc,$g;echo'<h1>
',$this->name(),' <span class="version">',$ia,'</span>
<a href="https://www.adminer.org/#download"',target_blank(),' id="version">',(version_compare($ia,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Ze=="auth"){$Qf="";foreach((array)$_SESSION["pwds"]as$ej=>$th){foreach($th
as$M=>$Zi){foreach($Zi
as$V=>$E){if($E!==null){$Vb=$_SESSION["db"][$ej][$M][$V];foreach(($Vb?array_keys($Vb):array(""))as$l)$Qf.="<li><a href='".h(auth_url($ej,$M,$V,$l))."'>($jc[$ej]) ".h($V.($M!=""?"@".$this->serverName($M):"").($l!=""?" - $l":""))."</a>\n";}}}}if($Qf)echo"<ul id='logins'>\n$Qf</ul>\n".script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");}else{if($_GET["ns"]!==""&&!$Ze&&DB!=""){$g->select_db(DB);$S=table_status('',true);}echo
script_src(preg_replace("~\\?.*~","",ME)."?file=jush.js&version=4.7.9");if(support("sql")){echo'<script',nonce(),'>
';if($S){$Be=array();foreach($S
as$Q=>$T)$Be[]=preg_quote($Q,'/');echo"var jushLinks = { $x: [ '".js_escape(ME).(support("table")?"table=":"select=")."\$&', /\\b(".implode("|",$Be).")\\b/g ] };\n";foreach(array("bac","bra","sqlite_quo","mssql_bra")as$X)echo"jushLinks.$X = jushLinks.$x;\n";}$sh=$g->server_info;echo'bodyLoad(\'',(is_object($g)?preg_replace('~^(\d\.?\d).*~s','\1',$sh):""),'\'',(preg_match('~MariaDB~',$sh)?", true":""),');
</script>
';}$this->databasesPrint($Ze);if(DB==""||!$Ze){echo"<p class='links'>".(support("sql")?"<a href='".h(ME)."sql='".bold(isset($_GET["sql"])&&!isset($_GET["import"])).">".'SQL command'."</a>\n<a href='".h(ME)."import='".bold(isset($_GET["import"])).">".'Import'."</a>\n":"")."";if(support("dump"))echo"<a href='".h(ME)."dump=".urlencode(isset($_GET["table"])?$_GET["table"]:$_GET["select"])."' id='dump'".bold(isset($_GET["dump"])).">".'Export'."</a>\n";}if($_GET["ns"]!==""&&!$Ze&&DB!=""){echo'<a href="'.h(ME).'create="'.bold($_GET["create"]==="").">".'Create table'."</a>\n";if(!$S)echo"<p class='message'>".'No tables.'."\n";else$this->tablesPrint($S);}}}function
databasesPrint($Ze){global$b,$g;$k=$this->databases();if(DB&&$k&&!in_array(DB,$k))array_unshift($k,DB);echo'<form action="">
<p id="dbs">
';hidden_fields_get();$Tb=script("mixin(qsl('select'), {onmousedown: dbMouseDown, onchange: dbChange});");echo"<span title='".'database'."'>".'DB'."</span>: ".($k?"<select name='db'>".optionlist(array(""=>"")+$k,DB)."</select>$Tb":"<input name='db' value='".h(DB)."' autocapitalize='off'>\n"),"<input type='submit' value='".'Use'."'".($k?" class='hidden'":"").">\n";if($Ze!="db"&&DB!=""&&$g->select_db(DB)){if(support("scheme")){echo"<br>".'Schema'.": <select name='ns'>".optionlist(array(""=>"")+$b->schemas(),$_GET["ns"])."</select>$Tb";if($_GET["ns"]!="")set_schema($_GET["ns"]);}}foreach(array("import","sql","schema","dump","privileges")as$X){if(isset($_GET[$X])){echo"<input type='hidden' name='$X' value=''>";break;}}echo"</p></form>\n";}function
tablesPrint($S){echo"<ul id='tables'>".script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($S
as$Q=>$O){$B=$this->tableName($O);if($B!=""){echo'<li><a href="'.h(ME).'select='.urlencode($Q).'"'.bold($_GET["select"]==$Q||$_GET["edit"]==$Q,"select")." title='".'Select data'."'>".'select'."</a> ",(support("table")||support("indexes")?'<a href="'.h(ME).'table='.urlencode($Q).'"'.bold(in_array($Q,array($_GET["table"],$_GET["create"],$_GET["indexes"],$_GET["foreign"],$_GET["trigger"])),(is_view($O)?"view":"structure"))." title='".'Show structure'."'>$B</a>":"<span>$B</span>")."\n";}}echo"</ul>\n";}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);if($b->operators===null)$b->operators=$Af;function
page_header($oi,$n="",$Xa=array(),$pi=""){global$ca,$ia,$b,$jc,$x;page_headers();if(is_ajax()&&$n){page_messages($n);exit;}$qi=$oi.($pi!=""?": $pi":"");$ri=strip_tags($qi.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$ri,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.7.9"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.7.9");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.7.9"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.7.9"),'">
';foreach($b->css()as$Nb){echo'<link rel="stylesheet" type="text/css" href="',h($Nb),'">
';}}echo'
<body class="ltr nojs">
';$ad=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($ad)&&filemtime($ad)+86400>time()){$fj=unserialize(file_get_contents($ad));$_g="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($fj["version"],base64_decode($fj["signature"]),$_g)==1)$_COOKIE["adminer_version"]=$fj["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ia', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape('You are offline.'),'\';
var thousandsSeparator = \'',js_escape(','),'\';
</script>

<div id="help" class="jush-',$x,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Xa!==null){$_=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($_?$_:".").'">'.$jc[DRIVER].'</a> &raquo; ';$_=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$M=$b->serverName(SERVER);$M=($M!=""?$M:'Server');if($Xa===false)echo"$M\n";else{echo"<a href='".h($_)."' accesskey='1' title='Alt+Shift+1'>$M</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Xa)))echo'<a href="'.h($_."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Xa)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Xa
as$y=>$X){$cc=(is_array($X)?$X[1]:h($X));if($cc!="")echo"<a href='".h(ME."$y=").urlencode(is_array($X)?$X[0]:$X)."'>$cc</a> &raquo; ";}}echo"$oi\n";}}echo"<h2>$qi</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($n);$k=&get_session("dbs");if(DB!=""&&$k&&!in_array(DB,$k,true))$k=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$Mb){$Bd=array();foreach($Mb
as$y=>$X)$Bd[]="$y $X";header("Content-Security-Policy: ".implode("; ",$Bd));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$jf;if(!$jf)$jf=base64_encode(rand_string());return$jf;}function
page_messages($n){$Ri=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Ve=$_SESSION["messages"][$Ri];if($Ve){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Ve)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Ri]);}if($n)echo"<div class='error'>$n</div>\n";}function
page_footer($Ze=""){global$b,$vi;echo'</div>

';if($Ze!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="Logout" id="logout">
<input type="hidden" name="token" value="',$vi,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Ze);echo'</div>
',script("setupSubmitHighlight(document);");}function
int32($cf){while($cf>=2147483648)$cf-=4294967296;while($cf<=-2147483649)$cf+=4294967296;return(int)$cf;}function
long2str($W,$jj){$fh='';foreach($W
as$X)$fh.=pack('V',$X);if($jj)return
substr($fh,0,end($W));return$fh;}function
str2long($fh,$jj){$W=array_values(unpack('V*',str_pad($fh,4*ceil(strlen($fh)/4),"\0")));if($jj)$W[]=strlen($fh);return$W;}function
xxtea_mx($wj,$vj,$Sh,$je){return
int32((($wj>>5&0x7FFFFFF)^$vj<<2)+(($vj>>3&0x1FFFFFFF)^$wj<<4))^int32(($Sh^$vj)+($je^$wj));}function
encrypt_string($Nh,$y){if($Nh=="")return"";$y=array_values(unpack("V*",pack("H*",md5($y))));$W=str2long($Nh,true);$cf=count($W)-1;$wj=$W[$cf];$vj=$W[0];$Ag=floor(6+52/($cf+1));$Sh=0;while($Ag-->0){$Sh=int32($Sh+0x9E3779B9);$qc=$Sh>>2&3;for($Rf=0;$Rf<$cf;$Rf++){$vj=$W[$Rf+1];$bf=xxtea_mx($wj,$vj,$Sh,$y[$Rf&3^$qc]);$wj=int32($W[$Rf]+$bf);$W[$Rf]=$wj;}$vj=$W[0];$bf=xxtea_mx($wj,$vj,$Sh,$y[$Rf&3^$qc]);$wj=int32($W[$cf]+$bf);$W[$cf]=$wj;}return
long2str($W,false);}function
decrypt_string($Nh,$y){if($Nh=="")return"";if(!$y)return
false;$y=array_values(unpack("V*",pack("H*",md5($y))));$W=str2long($Nh,false);$cf=count($W)-1;$wj=$W[$cf];$vj=$W[0];$Ag=floor(6+52/($cf+1));$Sh=int32($Ag*0x9E3779B9);while($Sh){$qc=$Sh>>2&3;for($Rf=$cf;$Rf>0;$Rf--){$wj=$W[$Rf-1];$bf=xxtea_mx($wj,$vj,$Sh,$y[$Rf&3^$qc]);$vj=int32($W[$Rf]-$bf);$W[$Rf]=$vj;}$wj=$W[$cf];$bf=xxtea_mx($wj,$vj,$Sh,$y[$Rf&3^$qc]);$vj=int32($W[0]-$bf);$W[0]=$vj;$Sh=int32($Sh-0x9E3779B9);}return
long2str($W,true);}$g='';$Ad=$_SESSION["token"];if(!$Ad)$_SESSION["token"]=rand(1,1e6);$vi=get_token();$ig=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($y)=explode(":",$X);$ig[$y]=$X;}}function
add_invalid_login(){global$b;$od=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$od)return;$ce=unserialize(stream_get_contents($od));$li=time();if($ce){foreach($ce
as$de=>$X){if($X[0]<$li)unset($ce[$de]);}}$be=&$ce[$b->bruteForceKey()];if(!$be)$be=array($li+30*60,0);$be[1]++;file_write_unlock($od,serialize($ce));}function
check_invalid_login(){global$b;$ce=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$be=$ce[$b->bruteForceKey()];$if=($be[1]>29?$be[0]-time():0);if($if>0)auth_error(lang(array('Too many unsuccessful logins, try again in %d minute.','Too many unsuccessful logins, try again in %d minutes.'),ceil($if/60)));}$Ka=$_POST["auth"];if($Ka){session_regenerate_id();$ej=$Ka["driver"];$M=$Ka["server"];$V=$Ka["username"];$E=(string)$Ka["password"];$l=$Ka["db"];set_password($ej,$M,$V,$E);$_SESSION["db"][$ej][$M][$V][$l]=true;if($Ka["permanent"]){$y=base64_encode($ej)."-".base64_encode($M)."-".base64_encode($V)."-".base64_encode($l);$ug=$b->permanentLogin(true);$ig[$y]="$y:".base64_encode($ug?encrypt_string($E,$ug):"");cookie("adminer_permanent",implode(" ",$ig));}if(count($_POST)==1||DRIVER!=$ej||SERVER!=$M||$_GET["username"]!==$V||DB!=$l)redirect(auth_url($ej,$M,$V,$l));}elseif($_POST["logout"]&&(!$Ad||verify_token())){foreach(array("pwds","db","dbs","queries")as$y)set_session($y,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),'Logout successful.'.' '.'Thanks for using Adminer, consider <a href="https://www.adminer.org/en/donation/">donating</a>.');}elseif($ig&&!$_SESSION["pwds"]){session_regenerate_id();$ug=$b->permanentLogin();foreach($ig
as$y=>$X){list(,$jb)=explode(":",$X);list($ej,$M,$V,$l)=array_map('base64_decode',explode("-",$y));set_password($ej,$M,$V,decrypt_string(base64_decode($jb),$ug));$_SESSION["db"][$ej][$M][$V][$l]=true;}}function
unset_permanent(){global$ig;foreach($ig
as$y=>$X){list($ej,$M,$V,$l)=array_map('base64_decode',explode("-",$y));if($ej==DRIVER&&$M==SERVER&&$V==$_GET["username"]&&$l==DB)unset($ig[$y]);}cookie("adminer_permanent",implode(" ",$ig));}function
auth_error($n){global$b,$Ad;$uh=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$uh]||$_GET[$uh])&&!$Ad)$n='Session expired, please login again.';else{restart_session();add_invalid_login();$E=get_password();if($E!==null){if($E===false)$n.='<br>'.sprintf('Master password expired. <a href="https://www.adminer.org/en/extension/"%s>Implement</a> %s method to make it permanent.',target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$uh]&&$_GET[$uh]&&ini_bool("session.use_only_cookies"))$n='Session support must be enabled.';$Uf=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$Uf["lifetime"]);page_header('Login',$n,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".'The action will be performed after successful login with the same credentials.'."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header('No extension',sprintf('None of the supported PHP extensions (%s) are available.',implode(", ",$og)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])&&is_string(get_password())){list($Gd,$kg)=explode(":",SERVER,2);if(preg_match('~^\s*([-+]?\d+)~',$kg,$A)&&($A[1]<1024||$A[1]>65535))auth_error('Connecting to privileged ports is not allowed.');check_invalid_login();$g=connect();$m=new
Min_Driver($g);}$De=null;if(!is_object($g)||($De=$b->login($_GET["username"],get_password()))!==true){$n=(is_string($g)?h($g):(is_string($De)?$De:'Invalid credentials.'));auth_error($n.(preg_match('~^ | $~',get_password())?'<br>'.'There is a space in the input password which might be the cause.':''));}if($_POST["logout"]&&$Ad&&!verify_token()){page_header('Logout','Invalid CSRF token. Send the form again.');page_footer("db");exit;}if($Ka&&$_POST["token"])$_POST["token"]=$vi;$n='';if($_POST){if(!verify_token()){$Wd="max_input_vars";$Pe=ini_get($Wd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$y){$X=ini_get($y);if($X&&(!$Pe||$X<$Pe)){$Wd=$y;$Pe=$X;}}}$n=(!$_POST["token"]&&$Pe?sprintf('Maximum number of allowed fields exceeded. Please increase %s.',"'$Wd'"):'Invalid CSRF token. Send the form again.'.' '.'If you did not send this request from Adminer then close this page.');}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$n=sprintf('Too big POST data. Reduce the data or increase the %s configuration directive.',"'post_max_size'");if(isset($_GET["sql"]))$n.=' '.'You can upload a big SQL file via FTP and import it from server.';}function
select($G,$h=null,$If=array(),$z=0){global$x;$Be=array();$w=array();$f=array();$Ua=array();$U=array();$H=array();odd('');for($s=0;(!$z||$s<$z)&&($I=$G->fetch_row());$s++){if(!$s){echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap'>\n","<thead><tr>";for($ie=0;$ie<count($I);$ie++){$o=$G->fetch_field();$B=$o->name;$Hf=$o->orgtable;$Gf=$o->orgname;$H[$o->table]=$Hf;if($If&&$x=="sql")$Be[$ie]=($B=="table"?"table=":($B=="possible_keys"?"indexes=":null));elseif($Hf!=""){if(!isset($w[$Hf])){$w[$Hf]=array();foreach(indexes($Hf,$h)as$v){if($v["type"]=="PRIMARY"){$w[$Hf]=array_flip($v["columns"]);break;}}$f[$Hf]=$w[$Hf];}if(isset($f[$Hf][$Gf])){unset($f[$Hf][$Gf]);$w[$Hf][$Gf]=$ie;$Be[$ie]=$Hf;}}if($o->charsetnr==63)$Ua[$ie]=true;$U[$ie]=$o->type;echo"<th".($Hf!=""||$o->name!=$Gf?" title='".h(($Hf!=""?"$Hf.":"").$Gf)."'":"").">".h($B).($If?doc_link(array('sql'=>"explain-output.html#explain_".strtolower($B),'mariadb'=>"explain/#the-columns-in-explain-select",)):"");}echo"</thead>\n";}echo"<tr".odd().">";foreach($I
as$y=>$X){$_="";if(isset($Be[$y])&&!$f[$Be[$y]]){if($If&&$x=="sql"){$Q=$I[array_search("table=",$Be)];$_=ME.$Be[$y].urlencode($If[$Q]!=""?$If[$Q]:$Q);}else{$_=ME."edit=".urlencode($Be[$y]);foreach($w[$Be[$y]]as$nb=>$ie)$_.="&where".urlencode("[".bracket_escape($nb)."]")."=".urlencode($I[$ie]);}}elseif(is_url($X))$_=$X;if($X===null)$X="<i>NULL</i>";elseif($Ua[$y]&&!is_utf8($X))$X="<i>".lang(array('%d byte','%d bytes'),strlen($X))."</i>";else{$X=h($X);if($U[$y]==254)$X="<code>$X</code>";}if($_)$X="<a href='".h($_)."'".(is_url($_)?target_blank():'').">$X</a>";echo"<td>$X";}}echo($s?"</table>\n</div>":"<p class='message'>".'No rows.')."\n";return$H;}function
referencable_primary($oh){$H=array();foreach(table_status('',true)as$Wh=>$Q){if($Wh!=$oh&&fk_support($Q)){foreach(fields($Wh)as$o){if($o["primary"]){if($H[$Wh]){unset($H[$Wh]);break;}$H[$Wh]=$o;}}}}return$H;}function
adminer_settings(){parse_str($_COOKIE["adminer_settings"],$wh);return$wh;}function
adminer_setting($y){$wh=adminer_settings();return$wh[$y];}function
set_adminer_settings($wh){return
cookie("adminer_settings",http_build_query($wh+adminer_settings()));}function
textarea($B,$Y,$J=10,$rb=80){global$x;echo"<textarea name='$B' rows='$J' cols='$rb' class='sqlarea jush-$x' spellcheck='false' wrap='off'>";if(is_array($Y)){foreach($Y
as$X)echo
h($X[0])."\n\n\n";}else
echo
h($Y);echo"</textarea>";}function
edit_type($y,$o,$pb,$kd=array(),$Rc=array()){global$Oh,$U,$Pi,$wf;$T=$o["type"];echo'<td><select name="',h($y),'[type]" class="type" aria-labelledby="label-type">';if($T&&!isset($U[$T])&&!isset($kd[$T])&&!in_array($T,$Rc))$Rc[]=$T;if($kd)$Oh['Foreign keys']=$kd;echo
optionlist(array_merge($Rc,$Oh),$T),'</select><td><input name="',h($y),'[length]" value="',h($o["length"]),'" size="3"',(!$o["length"]&&preg_match('~var(char|binary)$~',$T)?" class='required'":"");echo' aria-labelledby="label-length"><td class="options">',"<select name='".h($y)."[collation]'".(preg_match('~(char|text|enum|set)$~',$T)?"":" class='hidden'").'><option value="">('.'collation'.')'.optionlist($pb,$o["collation"]).'</select>',($Pi?"<select name='".h($y)."[unsigned]'".(!$T||preg_match(number_type(),$T)?"":" class='hidden'").'><option>'.optionlist($Pi,$o["unsigned"]).'</select>':''),(isset($o['on_update'])?"<select name='".h($y)."[on_update]'".(preg_match('~timestamp|datetime~',$T)?"":" class='hidden'").'>'.optionlist(array(""=>"(".'ON UPDATE'.")","CURRENT_TIMESTAMP"),(preg_match('~^CURRENT_TIMESTAMP~i',$o["on_update"])?"CURRENT_TIMESTAMP":$o["on_update"])).'</select>':''),($kd?"<select name='".h($y)."[on_delete]'".(preg_match("~`~",$T)?"":" class='hidden'")."><option value=''>(".'ON DELETE'.")".optionlist(explode("|",$wf),$o["on_delete"])."</select> ":" ");}function
process_length($ze){global$Ac;return(preg_match("~^\\s*\\(?\\s*$Ac(?:\\s*,\\s*$Ac)*+\\s*\\)?\\s*\$~",$ze)&&preg_match_all("~$Ac~",$ze,$Je)?"(".implode(",",$Je[0]).")":preg_replace('~^[0-9].*~','(\0)',preg_replace('~[^-0-9,+()[\]]~','',$ze)));}function
process_type($o,$ob="COLLATE"){global$Pi;return" $o[type]".process_length($o["length"]).(preg_match(number_type(),$o["type"])&&in_array($o["unsigned"],$Pi)?" $o[unsigned]":"").(preg_match('~char|text|enum|set~',$o["type"])&&$o["collation"]?" $ob ".q($o["collation"]):"");}function
process_field($o,$Hi){return
array(idf_escape(trim($o["field"])),process_type($Hi),($o["null"]?" NULL":" NOT NULL"),default_value($o),(preg_match('~timestamp|datetime~',$o["type"])&&$o["on_update"]?" ON UPDATE $o[on_update]":""),(support("comment")&&$o["comment"]!=""?" COMMENT ".q($o["comment"]):""),($o["auto_increment"]?auto_increment():null),);}function
default_value($o){$Xb=$o["default"];return($Xb===null?"":" DEFAULT ".(preg_match('~char|binary|text|enum|set~',$o["type"])||preg_match('~^(?![a-z])~i',$Xb)?q($Xb):$Xb));}function
type_class($T){foreach(array('char'=>'text','date'=>'time|year','binary'=>'blob','enum'=>'set',)as$y=>$X){if(preg_match("~$y|$X~",$T))return" class='$y'";}}function
edit_fields($p,$pb,$T="TABLE",$kd=array()){global$Xd;$p=array_values($p);$Yb=(($_POST?$_POST["defaults"]:adminer_setting("defaults"))?"":" class='hidden'");$vb=(($_POST?$_POST["comments"]:adminer_setting("comments"))?"":" class='hidden'");echo'<thead><tr>
';if($T=="PROCEDURE"){echo'<td>';}echo'<th id="label-name">',($T=="TABLE"?'Column name':'Parameter name'),'<td id="label-type">Type<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;"></textarea>',script("qs('#enum-edit').onblur = editingLengthBlur;"),'<td id="label-length">Length
<td>','Options';if($T=="TABLE"){echo'<td id="label-null">NULL
<td><input type="radio" name="auto_increment_col" value=""><acronym id="label-ai" title="Auto Increment">AI</acronym>',doc_link(array('sql'=>"example-auto-increment.html",'mariadb'=>"auto_increment/",'sqlite'=>"autoinc.html",'pgsql'=>"datatype.html#DATATYPE-SERIAL",'mssql'=>"ms186775.aspx",)),'<td id="label-default"',$Yb,'>Default value
',(support("comment")?"<td id='label-comment'$vb>".'Comment':"");}echo'<td>',"<input type='image' class='icon' name='add[".(support("move_col")?0:count($p))."]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.9")."' alt='+' title='".'Add next'."'>".script("row_count = ".count($p).";"),'</thead>
<tbody>
',script("mixin(qsl('tbody'), {onclick: editingClick, onkeydown: editingKeydown, oninput: editingInput});");foreach($p
as$s=>$o){$s++;$Jf=$o[($_POST?"orig":"field")];$gc=(isset($_POST["add"][$s-1])||(isset($o["field"])&&!$_POST["drop_col"][$s]))&&(support("drop_col")||$Jf=="");echo'<tr',($gc?"":" style='display: none;'"),'>
',($T=="PROCEDURE"?"<td>".html_select("fields[$s][inout]",explode("|",$Xd),$o["inout"]):""),'<th>';if($gc){echo'<input name="fields[',$s,'][field]" value="',h($o["field"]),'" data-maxlength="64" autocapitalize="off" aria-labelledby="label-name">';}echo'<input type="hidden" name="fields[',$s,'][orig]" value="',h($Jf),'">';edit_type("fields[$s]",$o,$pb,$kd);if($T=="TABLE"){echo'<td>',checkbox("fields[$s][null]",1,$o["null"],"","","block","label-null"),'<td><label class="block"><input type="radio" name="auto_increment_col" value="',$s,'"';if($o["auto_increment"]){echo' checked';}echo' aria-labelledby="label-ai"></label><td',$Yb,'>',checkbox("fields[$s][has_default]",1,$o["has_default"],"","","","label-default"),'<input name="fields[',$s,'][default]" value="',h($o["default"]),'" aria-labelledby="label-default">',(support("comment")?"<td$vb><input name='fields[$s][comment]' value='".h($o["comment"])."' data-maxlength='".(min_version(5.5)?1024:255)."' aria-labelledby='label-comment'>":"");}echo"<td>",(support("move_col")?"<input type='image' class='icon' name='add[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.9")."' alt='+' title='".'Add next'."'> "."<input type='image' class='icon' name='up[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=up.gif&version=4.7.9")."' alt='â†‘' title='".'Move up'."'> "."<input type='image' class='icon' name='down[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=down.gif&version=4.7.9")."' alt='â†“' title='".'Move down'."'> ":""),($Jf==""||support("drop_col")?"<input type='image' class='icon' name='drop_col[$s]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.7.9")."' alt='x' title='".'Remove'."'>":"");}}function
process_fields(&$p){$C=0;if($_POST["up"]){$te=0;foreach($p
as$y=>$o){if(key($_POST["up"])==$y){unset($p[$y]);array_splice($p,$te,0,array($o));break;}if(isset($o["field"]))$te=$C;$C++;}}elseif($_POST["down"]){$md=false;foreach($p
as$y=>$o){if(isset($o["field"])&&$md){unset($p[key($_POST["down"])]);array_splice($p,$C,0,array($md));break;}if(key($_POST["down"])==$y)$md=$o;$C++;}}elseif($_POST["add"]){$p=array_values($p);array_splice($p,key($_POST["add"]),0,array(array()));}elseif(!$_POST["drop_col"])return
false;return
true;}function
normalize_enum($A){return"'".str_replace("'","''",addcslashes(stripcslashes(str_replace($A[0][0].$A[0][0],$A[0][0],substr($A[0],1,-1))),'\\'))."'";}function
grant($rd,$wg,$f,$vf){if(!$wg)return
true;if($wg==array("ALL PRIVILEGES","GRANT OPTION"))return($rd=="GRANT"?queries("$rd ALL PRIVILEGES$vf WITH GRANT OPTION"):queries("$rd ALL PRIVILEGES$vf")&&queries("$rd GRANT OPTION$vf"));return
queries("$rd ".preg_replace('~(GRANT OPTION)\([^)]*\)~','\1',implode("$f, ",$wg).$f).$vf);}function
drop_create($kc,$i,$lc,$ii,$nc,$Ce,$Ue,$Se,$Te,$sf,$ff){if($_POST["drop"])query_redirect($kc,$Ce,$Ue);elseif($sf=="")query_redirect($i,$Ce,$Te);elseif($sf!=$ff){$Kb=queries($i);queries_redirect($Ce,$Se,$Kb&&queries($kc));if($Kb)queries($lc);}else
queries_redirect($Ce,$Se,queries($ii)&&queries($nc)&&queries($kc)&&queries($i));}function
create_trigger($vf,$I){global$x;$ni=" $I[Timing] $I[Event]".($I["Event"]=="UPDATE OF"?" ".idf_escape($I["Of"]):"");return"CREATE TRIGGER ".idf_escape($I["Trigger"]).($x=="mssql"?$vf.$ni:$ni.$vf).rtrim(" $I[Type]\n$I[Statement]",";").";";}function
create_routine($bh,$I){global$Xd,$x;$N=array();$p=(array)$I["fields"];ksort($p);foreach($p
as$o){if($o["field"]!="")$N[]=(preg_match("~^($Xd)\$~",$o["inout"])?"$o[inout] ":"").idf_escape($o["field"]).process_type($o,"CHARACTER SET");}$Zb=rtrim("\n$I[definition]",";");return"CREATE $bh ".idf_escape(trim($I["name"]))." (".implode(", ",$N).")".(isset($_GET["function"])?" RETURNS".process_type($I["returns"],"CHARACTER SET"):"").($I["language"]?" LANGUAGE $I[language]":"").($x=="pgsql"?" AS ".q($Zb):"$Zb;");}function
remove_definer($F){return
preg_replace('~^([A-Z =]+) DEFINER=`'.preg_replace('~@(.*)~','`@`(%|\1)',logged_user()).'`~','\1',$F);}function
format_foreign_key($q){global$wf;$l=$q["db"];$kf=$q["ns"];return" FOREIGN KEY (".implode(", ",array_map('idf_escape',$q["source"])).") REFERENCES ".($l!=""&&$l!=$_GET["db"]?idf_escape($l).".":"").($kf!=""&&$kf!=$_GET["ns"]?idf_escape($kf).".":"").table($q["table"])." (".implode(", ",array_map('idf_escape',$q["target"])).")".(preg_match("~^($wf)\$~",$q["on_delete"])?" ON DELETE $q[on_delete]":"").(preg_match("~^($wf)\$~",$q["on_update"])?" ON UPDATE $q[on_update]":"");}function
tar_file($ad,$si){$H=pack("a100a8a8a8a12a12",$ad,644,0,0,decoct($si->size),decoct(time()));$hb=8*32;for($s=0;$s<strlen($H);$s++)$hb+=ord($H[$s]);$H.=sprintf("%06o",$hb)."\0 ";echo$H,str_repeat("\0",512-strlen($H));$si->send();echo
str_repeat("\0",511-($si->size+511)%512);}function
ini_bytes($Wd){$X=ini_get($Wd);switch(strtolower(substr($X,-1))){case'g':$X*=1024;case'm':$X*=1024;case'k':$X*=1024;}return$X;}function
doc_link($fg,$ji="<sup>?</sup>"){global$x,$g;$sh=$g->server_info;$fj=preg_replace('~^(\d\.?\d).*~s','\1',$sh);$Ui=array('sql'=>"https://dev.mysql.com/doc/refman/$fj/en/",'sqlite'=>"https://www.sqlite.org/",'pgsql'=>"https://www.postgresql.org/docs/$fj/",'mssql'=>"https://msdn.microsoft.com/library/",'oracle'=>"https://www.oracle.com/pls/topic/lookup?ctx=db".preg_replace('~^.* (\d+)\.(\d+)\.\d+\.\d+\.\d+.*~s','\1\2',$sh)."&id=",);if(preg_match('~MariaDB~',$sh)){$Ui['sql']="https://mariadb.com/kb/en/library/";$fg['sql']=(isset($fg['mariadb'])?$fg['mariadb']:str_replace(".html","/",$fg['sql']));}return($fg[$x]?"<a href='$Ui[$x]$fg[$x]'".target_blank().">$ji</a>":"");}function
ob_gzencode($P){return
gzencode($P);}function
db_size($l){global$g;if(!$g->select_db($l))return"?";$H=0;foreach(table_status()as$R)$H+=$R["Data_length"]+$R["Index_length"];return
format_number($H);}function
set_utf8mb4($i){global$g;static$N=false;if(!$N&&preg_match('~\butf8mb4~i',$i)){$N=true;echo"SET NAMES ".charset($g).";\n\n";}}function
connect_error(){global$b,$g,$vi,$n,$jc;if(DB!=""){header("HTTP/1.1 404 Not Found");page_header('Database'.": ".h(DB),'Invalid database.',true);}else{if($_POST["db"]&&!$n)queries_redirect(substr(ME,0,-1),'Databases have been dropped.',drop_databases($_POST["db"]));page_header('Select database',$n,false);echo"<p class='links'>\n";foreach(array('database'=>'Create database','privileges'=>'Privileges','processlist'=>'Process list','variables'=>'Variables','status'=>'Status',)as$y=>$X){if(support($y))echo"<a href='".h(ME)."$y='>$X</a>\n";}echo"<p>".sprintf('%s version: %s through PHP extension %s',$jc[DRIVER],"<b>".h($g->server_info)."</b>","<b>$g->extension</b>")."\n","<p>".sprintf('Logged as: %s',"<b>".h(logged_user())."</b>")."\n";$k=$b->databases();if($k){$ih=support("scheme");$pb=collations();echo"<form action='' method='post'>\n","<table cellspacing='0' class='checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),"<thead><tr>".(support("database")?"<td>":"")."<th>".'Database'." - <a href='".h(ME)."refresh=1'>".'Refresh'."</a>"."<td>".'Collation'."<td>".'Tables'."<td>".'Size'." - <a href='".h(ME)."dbsize=1'>".'Compute'."</a>".script("qsl('a').onclick = partial(ajaxSetHtml, '".js_escape(ME)."script=connect');","")."</thead>\n";$k=($_GET["dbsize"]?count_tables($k):array_flip($k));foreach($k
as$l=>$S){$ah=h(ME)."db=".urlencode($l);$t=h("Db-".$l);echo"<tr".odd().">".(support("database")?"<td>".checkbox("db[]",$l,in_array($l,(array)$_POST["db"]),"","","",$t):""),"<th><a href='$ah' id='$t'>".h($l)."</a>";$d=h(db_collation($l,$pb));echo"<td>".(support("database")?"<a href='$ah".($ih?"&amp;ns=":"")."&amp;database=' title='".'Alter database'."'>$d</a>":$d),"<td align='right'><a href='$ah&amp;schema=' id='tables-".h($l)."' title='".'Database schema'."'>".($_GET["dbsize"]?$S:"?")."</a>","<td align='right' id='size-".h($l)."'>".($_GET["dbsize"]?db_size($l):"?"),"\n";}echo"</table>\n",(support("database")?"<div class='footer'><div>\n"."<fieldset><legend>".'Selected'." <span id='selected'></span></legend><div>\n"."<input type='hidden' name='all' value=''>".script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^db/)); };")."<input type='submit' name='drop' value='".'Drop'."'>".confirm()."\n"."</div></fieldset>\n"."</div></div>\n":""),"<input type='hidden' name='token' value='$vi'>\n","</form>\n",script("tableCheck();");}}page_footer("db");}if(isset($_GET["status"]))$_GET["variables"]=$_GET["status"];if(isset($_GET["import"]))$_GET["sql"]=$_GET["import"];if(!(DB!=""?$g->select_db(DB):isset($_GET["sql"])||isset($_GET["dump"])||isset($_GET["database"])||isset($_GET["processlist"])||isset($_GET["privileges"])||isset($_GET["user"])||isset($_GET["variables"])||$_GET["script"]=="connect"||$_GET["script"]=="kill")){if(DB!=""||$_GET["refresh"]){restart_session();set_session("dbs",null);}connect_error();exit;}if(support("scheme")&&DB!=""&&$_GET["ns"]!==""){if(!isset($_GET["ns"]))redirect(preg_replace('~ns=[^&]*&~','',ME)."ns=".get_schema());if(!set_schema($_GET["ns"])){header("HTTP/1.1 404 Not Found");page_header('Schema'.": ".h($_GET["ns"]),'Invalid schema.',true);page_footer("ns");exit;}}$wf="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";class
TmpFile{var$handler;var$size;function
__construct(){$this->handler=tmpfile();}function
write($Eb){$this->size+=strlen($Eb);fwrite($this->handler,$Eb);}function
send(){fseek($this->handler,0);fpassthru($this->handler);fclose($this->handler);}}$Ac="'(?:''|[^'\\\\]|\\\\.)*'";$Xd="IN|OUT|INOUT";if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["callf"]))$_GET["call"]=$_GET["callf"];if(isset($_GET["function"]))$_GET["procedure"]=$_GET["function"];if(isset($_GET["download"])){$a=$_GET["download"];$p=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$K=array(idf_escape($_GET["field"]));$G=$m->select($a,$K,array(where($_GET,$p)),$K);$I=($G?$G->fetch_row():array());echo$m->value($I[0],$p[$_GET["field"]]);exit;}elseif(isset($_GET["table"])){$a=$_GET["table"];$p=fields($a);if(!$p)$n=error();$R=table_status1($a,true);$B=$b->tableName($R);page_header(($p&&is_view($R)?$R['Engine']=='materialized view'?'Materialized view':'View':'Table').": ".($B!=""?$B:h($a)),$n);$b->selectLinks($R);$ub=$R["Comment"];if($ub!="")echo"<p class='nowrap'>".'Comment'.": ".h($ub)."\n";if($p)$b->tableStructurePrint($p);if(!is_view($R)){if(support("indexes")){echo"<h3 id='indexes'>".'Indexes'."</h3>\n";$w=indexes($a);if($w)$b->tableIndexesPrint($w);echo'<p class="links"><a href="'.h(ME).'indexes='.urlencode($a).'">'.'Alter indexes'."</a>\n";}if(fk_support($R)){echo"<h3 id='foreign-keys'>".'Foreign keys'."</h3>\n";$kd=foreign_keys($a);if($kd){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Source'."<td>".'Target'."<td>".'ON DELETE'."<td>".'ON UPDATE'."<td></thead>\n";foreach($kd
as$B=>$q){echo"<tr title='".h($B)."'>","<th><i>".implode("</i>, <i>",array_map('h',$q["source"]))."</i>","<td><a href='".h($q["db"]!=""?preg_replace('~db=[^&]*~',"db=".urlencode($q["db"]),ME):($q["ns"]!=""?preg_replace('~ns=[^&]*~',"ns=".urlencode($q["ns"]),ME):ME))."table=".urlencode($q["table"])."'>".($q["db"]!=""?"<b>".h($q["db"])."</b>.":"").($q["ns"]!=""?"<b>".h($q["ns"])."</b>.":"").h($q["table"])."</a>","(<i>".implode("</i>, <i>",array_map('h',$q["target"]))."</i>)","<td>".h($q["on_delete"])."\n","<td>".h($q["on_update"])."\n",'<td><a href="'.h(ME.'foreign='.urlencode($a).'&name='.urlencode($B)).'">'.'Alter'.'</a>';}echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'foreign='.urlencode($a).'">'.'Add foreign key'."</a>\n";}}if(support(is_view($R)?"view_trigger":"trigger")){echo"<h3 id='triggers'>".'Triggers'."</h3>\n";$Gi=triggers($a);if($Gi){echo"<table cellspacing='0'>\n";foreach($Gi
as$y=>$X)echo"<tr valign='top'><td>".h($X[0])."<td>".h($X[1])."<th>".h($y)."<td><a href='".h(ME.'trigger='.urlencode($a).'&name='.urlencode($y))."'>".'Alter'."</a>\n";echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'trigger='.urlencode($a).'">'.'Add trigger'."</a>\n";}}elseif(isset($_GET["schema"])){page_header('Database schema',"",array(),h(DB.($_GET["ns"]?".$_GET[ns]":"")));$Yh=array();$Zh=array();$ea=($_GET["schema"]?$_GET["schema"]:$_COOKIE["adminer_schema-".str_replace(".","_",DB)]);preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~',$ea,$Je,PREG_SET_ORDER);foreach($Je
as$s=>$A){$Yh[$A[1]]=array($A[2],$A[3]);$Zh[]="\n\t'".js_escape($A[1])."': [ $A[2], $A[3] ]";}$wi=0;$Ra=-1;$hh=array();$Mg=array();$xe=array();foreach(table_status('',true)as$Q=>$R){if(is_view($R))continue;$lg=0;$hh[$Q]["fields"]=array();foreach(fields($Q)as$B=>$o){$lg+=1.25;$o["pos"]=$lg;$hh[$Q]["fields"][$B]=$o;}$hh[$Q]["pos"]=($Yh[$Q]?$Yh[$Q]:array($wi,0));foreach($b->foreignKeys($Q)as$X){if(!$X["db"]){$ve=$Ra;if($Yh[$Q][1]||$Yh[$X["table"]][1])$ve=min(floatval($Yh[$Q][1]),floatval($Yh[$X["table"]][1]))-1;else$Ra-=.1;while($xe[(string)$ve])$ve-=.0001;$hh[$Q]["references"][$X["table"]][(string)$ve]=array($X["source"],$X["target"]);$Mg[$X["table"]][$Q][(string)$ve]=$X["target"];$xe[(string)$ve]=true;}}$wi=max($wi,$hh[$Q]["pos"][0]+2.5+$lg);}echo'<div id="schema" style="height: ',$wi,'em;">
<script',nonce(),'>
qs(\'#schema\').onselectstart = function () { return false; };
var tablePos = {',implode(",",$Zh)."\n",'};
var em = qs(\'#schema\').offsetHeight / ',$wi,';
document.onmousemove = schemaMousemove;
document.onmouseup = partialArg(schemaMouseup, \'',js_escape(DB),'\');
</script>
';foreach($hh
as$B=>$Q){echo"<div class='table' style='top: ".$Q["pos"][0]."em; left: ".$Q["pos"][1]."em;'>",'<a href="'.h(ME).'table='.urlencode($B).'"><b>'.h($B)."</b></a>",script("qsl('div').onmousedown = schemaMousedown;");foreach($Q["fields"]as$o){$X='<span'.type_class($o["type"]).' title="'.h($o["full_type"].($o["null"]?" NULL":'')).'">'.h($o["field"]).'</span>';echo"<br>".($o["primary"]?"<i>$X</i>":$X);}foreach((array)$Q["references"]as$fi=>$Ng){foreach($Ng
as$ve=>$Jg){$we=$ve-$Yh[$B][1];$s=0;foreach($Jg[0]as$Ch)echo"\n<div class='references' title='".h($fi)."' id='refs$ve-".($s++)."' style='left: $we"."em; top: ".$Q["fields"][$Ch]["pos"]."em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: ".(-$we)."em;'></div></div>";}}foreach((array)$Mg[$B]as$fi=>$Ng){foreach($Ng
as$ve=>$f){$we=$ve-$Yh[$B][1];$s=0;foreach($f
as$ei)echo"\n<div class='references' title='".h($fi)."' id='refd$ve-".($s++)."' style='left: $we"."em; top: ".$Q["fields"][$ei]["pos"]."em; height: 1.25em; background: url(".h(preg_replace("~\\?.*~","",ME)."?file=arrow.gif) no-repeat right center;&version=4.7.9")."'><div style='height: .5em; border-bottom: 1px solid Gray; width: ".(-$we)."em;'></div></div>";}}echo"\n</div>\n";}foreach($hh
as$B=>$Q){foreach((array)$Q["references"]as$fi=>$Ng){foreach($Ng
as$ve=>$Jg){$Ye=$wi;$Ne=-10;foreach($Jg[0]as$y=>$Ch){$mg=$Q["pos"][0]+$Q["fields"][$Ch]["pos"];$ng=$hh[$fi]["pos"][0]+$hh[$fi]["fields"][$Jg[1][$y]]["pos"];$Ye=min($Ye,$mg,$ng);$Ne=max($Ne,$mg,$ng);}echo"<div class='references' id='refl$ve' style='left: $ve"."em; top: $Ye"."em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: ".($Ne-$Ye)."em;'></div></div>\n";}}}echo'</div>
<p class="links"><a href="',h(ME."schema=".urlencode($ea)),'" id="schema-link">Permanent link</a>
';}elseif(isset($_GET["dump"])){$a=$_GET["dump"];if($_POST&&!$n){$Hb="";foreach(array("output","format","db_style","routines","events","table_style","auto_increment","triggers","data_style")as$y)$Hb.="&$y=".urlencode($_POST[$y]);cookie("adminer_export",substr($Hb,1));$S=array_flip((array)$_POST["tables"])+array_flip((array)$_POST["data"]);$Oc=dump_headers((count($S)==1?key($S):DB),(DB==""||count($S)>1));$fe=preg_match('~sql~',$_POST["format"]);if($fe){echo"-- Adminer $ia ".$jc[DRIVER]." dump\n\n";if($x=="sql"){echo"SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
".($_POST["data_style"]?"SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
":"")."
";$g->query("SET time_zone = '+00:00'");$g->query("SET sql_mode = ''");}}$Ph=$_POST["db_style"];$k=array(DB);if(DB==""){$k=$_POST["databases"];if(is_string($k))$k=explode("\n",rtrim(str_replace("\r","",$k),"\n"));}foreach((array)$k
as$l){$b->dumpDatabase($l);if($g->select_db($l)){if($fe&&preg_match('~CREATE~',$Ph)&&($i=$g->result("SHOW CREATE DATABASE ".idf_escape($l),1))){set_utf8mb4($i);if($Ph=="DROP+CREATE")echo"DROP DATABASE IF EXISTS ".idf_escape($l).";\n";echo"$i;\n";}if($fe){if($Ph)echo
use_sql($l).";\n\n";$Pf="";if($_POST["routines"]){foreach(array("FUNCTION","PROCEDURE")as$bh){foreach(get_rows("SHOW $bh STATUS WHERE Db = ".q($l),null,"-- ")as$I){$i=remove_definer($g->result("SHOW CREATE $bh ".idf_escape($I["Name"]),2));set_utf8mb4($i);$Pf.=($Ph!='DROP+CREATE'?"DROP $bh IF EXISTS ".idf_escape($I["Name"]).";;\n":"")."$i;;\n\n";}}}if($_POST["events"]){foreach(get_rows("SHOW EVENTS",null,"-- ")as$I){$i=remove_definer($g->result("SHOW CREATE EVENT ".idf_escape($I["Name"]),3));set_utf8mb4($i);$Pf.=($Ph!='DROP+CREATE'?"DROP EVENT IF EXISTS ".idf_escape($I["Name"]).";;\n":"")."$i;;\n\n";}}if($Pf)echo"DELIMITER ;;\n\n$Pf"."DELIMITER ;\n\n";}if($_POST["table_style"]||$_POST["data_style"]){$hj=array();foreach(table_status('',true)as$B=>$R){$Q=(DB==""||in_array($B,(array)$_POST["tables"]));$Qb=(DB==""||in_array($B,(array)$_POST["data"]));if($Q||$Qb){if($Oc=="tar"){$si=new
TmpFile;ob_start(array($si,'write'),1e5);}$b->dumpTable($B,($Q?$_POST["table_style"]:""),(is_view($R)?2:0));if(is_view($R))$hj[]=$B;elseif($Qb){$p=fields($B);$b->dumpData($B,$_POST["data_style"],"SELECT *".convert_fields($p,$p)." FROM ".table($B));}if($fe&&$_POST["triggers"]&&$Q&&($Gi=trigger_sql($B)))echo"\nDELIMITER ;;\n$Gi\nDELIMITER ;\n";if($Oc=="tar"){ob_end_flush();tar_file((DB!=""?"":"$l/")."$B.csv",$si);}elseif($fe)echo"\n";}}if(function_exists('foreign_keys_sql')){foreach(table_status('',true)as$B=>$R){$Q=(DB==""||in_array($B,(array)$_POST["tables"]));if($Q&&!is_view($R))echo
foreign_keys_sql($B);}}foreach($hj
as$gj)$b->dumpTable($gj,$_POST["table_style"],1);if($Oc=="tar")echo
pack("x512");}}}if($fe)echo"-- ".$g->result("SELECT NOW()")."\n";exit;}page_header('Export',$n,($_GET["export"]!=""?array("table"=>$_GET["export"]):array()),h(DB));echo'
<form action="" method="post">
<table cellspacing="0" class="layout">
';$Ub=array('','USE','DROP+CREATE','CREATE');$ai=array('','DROP+CREATE','CREATE');$Rb=array('','TRUNCATE+INSERT','INSERT');if($x=="sql")$Rb[]='INSERT+UPDATE';parse_str($_COOKIE["adminer_export"],$I);if(!$I)$I=array("output"=>"text","format"=>"sql","db_style"=>(DB!=""?"":"CREATE"),"table_style"=>"DROP+CREATE","data_style"=>"INSERT");if(!isset($I["events"])){$I["routines"]=$I["events"]=($_GET["dump"]=="");$I["triggers"]=$I["table_style"];}echo"<tr><th>".'Output'."<td>".html_select("output",$b->dumpOutput(),$I["output"],0)."\n";echo"<tr><th>".'Format'."<td>".html_select("format",$b->dumpFormat(),$I["format"],0)."\n";echo($x=="sqlite"?"":"<tr><th>".'Database'."<td>".html_select('db_style',$Ub,$I["db_style"]).(support("routine")?checkbox("routines",1,$I["routines"],'Routines'):"").(support("event")?checkbox("events",1,$I["events"],'Events'):"")),"<tr><th>".'Tables'."<td>".html_select('table_style',$ai,$I["table_style"]).checkbox("auto_increment",1,$I["auto_increment"],'Auto Increment').(support("trigger")?checkbox("triggers",1,$I["triggers"],'Triggers'):""),"<tr><th>".'Data'."<td>".html_select('data_style',$Rb,$I["data_style"]),'</table>
<p><input type="submit" value="Export">
<input type="hidden" name="token" value="',$vi,'">

<table cellspacing="0">
',script("qsl('table').onclick = dumpClick;");$qg=array();if(DB!=""){$fb=($a!=""?"":" checked");echo"<thead><tr>","<th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'$fb>".'Tables'."</label>".script("qs('#check-tables').onclick = partial(formCheck, /^tables\\[/);",""),"<th style='text-align: right;'><label class='block'>".'Data'."<input type='checkbox' id='check-data'$fb></label>".script("qs('#check-data').onclick = partial(formCheck, /^data\\[/);",""),"</thead>\n";$hj="";$bi=tables_list();foreach($bi
as$B=>$T){$pg=preg_replace('~_.*~','',$B);$fb=($a==""||$a==(substr($a,-1)=="%"?"$pg%":$B));$tg="<tr><td>".checkbox("tables[]",$B,$fb,$B,"","block");if($T!==null&&!preg_match('~table~i',$T))$hj.="$tg\n";else
echo"$tg<td align='right'><label class='block'><span id='Rows-".h($B)."'></span>".checkbox("data[]",$B,$fb)."</label>\n";$qg[$pg]++;}echo$hj;if($bi)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}else{echo"<thead><tr><th style='text-align: left;'>","<label class='block'><input type='checkbox' id='check-databases'".($a==""?" checked":"").">".'Database'."</label>",script("qs('#check-databases').onclick = partial(formCheck, /^databases\\[/);",""),"</thead>\n";$k=$b->databases();if($k){foreach($k
as$l){if(!information_schema($l)){$pg=preg_replace('~_.*~','',$l);echo"<tr><td>".checkbox("databases[]",$l,$a==""||$a=="$pg%",$l,"","block")."\n";$qg[$pg]++;}}}else
echo"<tr><td><textarea name='databases' rows='10' cols='20'></textarea>";}echo'</table>
</form>
';$cd=true;foreach($qg
as$y=>$X){if($y!=""&&$X>1){echo($cd?"<p>":" ")."<a href='".h(ME)."dump=".urlencode("$y%")."'>".h($y)."</a>";$cd=false;}}}elseif(isset($_GET["privileges"])){page_header('Privileges');echo'<p class="links"><a href="'.h(ME).'user=">'.'Create user'."</a>";$G=$g->query("SELECT User, Host FROM mysql.".(DB==""?"user":"db WHERE ".q(DB)." LIKE Db")." ORDER BY Host, User");$rd=$G;if(!$G)$G=$g->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");echo"<form action=''><p>\n";hidden_fields_get();echo"<input type='hidden' name='db' value='".h(DB)."'>\n",($rd?"":"<input type='hidden' name='grant' value=''>\n"),"<table cellspacing='0'>\n","<thead><tr><th>".'Username'."<th>".'Server'."<th></thead>\n";while($I=$G->fetch_assoc())echo'<tr'.odd().'><td>'.h($I["User"])."<td>".h($I["Host"]).'<td><a href="'.h(ME.'user='.urlencode($I["User"]).'&host='.urlencode($I["Host"])).'">'.'Edit'."</a>\n";if(!$rd||DB!="")echo"<tr".odd()."><td><input name='user' autocapitalize='off'><td><input name='host' value='localhost' autocapitalize='off'><td><input type='submit' value='".'Edit'."'>\n";echo"</table>\n","</form>\n";}elseif(isset($_GET["sql"])){if(!$n&&$_POST["export"]){dump_headers("sql");$b->dumpTable("","");$b->dumpData("","table",$_POST["query"]);exit;}restart_session();$Ed=&get_session("queries");$Dd=&$Ed[DB];if(!$n&&$_POST["clear"]){$Dd=array();redirect(remove_from_uri("history"));}page_header((isset($_GET["import"])?'Import':'SQL command'),$n);if(!$n&&$_POST){$od=false;if(!isset($_GET["import"]))$F=$_POST["query"];elseif($_POST["webfile"]){$Gh=$b->importServerPath();$od=@fopen((file_exists($Gh)?$Gh:"compress.zlib://$Gh.gz"),"rb");$F=($od?fread($od,1e6):false);}else$F=get_file("sql_file",true);if(is_string($F)){if(function_exists('memory_get_usage'))@ini_set("memory_limit",max(ini_bytes("memory_limit"),2*strlen($F)+memory_get_usage()+8e6));if($F!=""&&strlen($F)<1e6){$Ag=$F.(preg_match("~;[ \t\r\n]*\$~",$F)?"":";");if(!$Dd||reset(end($Dd))!=$Ag){restart_session();$Dd[]=array($Ag,time());set_session("queries",$Ed);stop_session();}}$Dh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$bc=";";$C=0;$yc=true;$h=connect();if(is_object($h)&&DB!=""){$h->select_db(DB);if($_GET["ns"]!="")set_schema($_GET["ns"],$h);}$tb=0;$Cc=array();$Wf='[\'"'.($x=="sql"?'`#':($x=="sqlite"?'`[':($x=="mssql"?'[':''))).']|/\*|-- |$'.($x=="pgsql"?'|\$[^$]*\$':'');$xi=microtime(true);parse_str($_COOKIE["adminer_export"],$xa);$pc=$b->dumpFormat();unset($pc["sql"]);while($F!=""){if(!$C&&preg_match("~^$Dh*+DELIMITER\\s+(\\S+)~i",$F,$A)){$bc=$A[1];$F=substr($F,strlen($A[0]));}else{preg_match('('.preg_quote($bc)."\\s*|$Wf)",$F,$A,PREG_OFFSET_CAPTURE,$C);list($md,$lg)=$A[0];if(!$md&&$od&&!feof($od))$F.=fread($od,1e5);else{if(!$md&&rtrim($F)=="")break;$C=$lg+strlen($md);if($md&&rtrim($md)!=$bc){while(preg_match('('.($md=='/*'?'\*/':($md=='['?']':(preg_match('~^-- |^#~',$md)?"\n":preg_quote($md)."|\\\\."))).'|$)s',$F,$A,PREG_OFFSET_CAPTURE,$C)){$fh=$A[0][0];if(!$fh&&$od&&!feof($od))$F.=fread($od,1e5);else{$C=$A[0][1]+strlen($fh);if($fh[0]!="\\")break;}}}else{$yc=false;$Ag=substr($F,0,$lg);$tb++;$tg="<pre id='sql-$tb'><code class='jush-$x'>".$b->sqlCommandQuery($Ag)."</code></pre>\n";if($x=="sqlite"&&preg_match("~^$Dh*+ATTACH\\b~i",$Ag,$A)){echo$tg,"<p class='error'>".'ATTACH queries are not supported.'."\n";$Cc[]=" <a href='#sql-$tb'>$tb</a>";if($_POST["error_stops"])break;}else{if(!$_POST["only_errors"]){echo$tg;ob_flush();flush();}$Kh=microtime(true);if($g->multi_query($Ag)&&is_object($h)&&preg_match("~^$Dh*+USE\\b~i",$Ag))$h->query($Ag);do{$G=$g->store_result();if($g->error){echo($_POST["only_errors"]?$tg:""),"<p class='error'>".'Error in query'.($g->errno?" ($g->errno)":"").": ".error()."\n";$Cc[]=" <a href='#sql-$tb'>$tb</a>";if($_POST["error_stops"])break
2;}else{$li=" <span class='time'>(".format_time($Kh).")</span>".(strlen($Ag)<1000?" <a href='".h(ME)."sql=".urlencode(trim($Ag))."'>".'Edit'."</a>":"");$za=$g->affected_rows;$kj=($_POST["only_errors"]?"":$m->warnings());$lj="warnings-$tb";if($kj)$li.=", <a href='#$lj'>".'Warnings'."</a>".script("qsl('a').onclick = partial(toggle, '$lj');","");$Lc=null;$Mc="explain-$tb";if(is_object($G)){$z=$_POST["limit"];$If=select($G,$h,array(),$z);if(!$_POST["only_errors"]){echo"<form action='' method='post'>\n";$mf=$G->num_rows;echo"<p>".($mf?($z&&$mf>$z?sprintf('%d / ',$z):"").lang(array('%d row','%d rows'),$mf):""),$li;if($h&&preg_match("~^($Dh|\\()*+SELECT\\b~i",$Ag)&&($Lc=explain($h,$Ag)))echo", <a href='#$Mc'>Explain</a>".script("qsl('a').onclick = partial(toggle, '$Mc');","");$t="export-$tb";echo", <a href='#$t'>".'Export'."</a>".script("qsl('a').onclick = partial(toggle, '$t');","")."<span id='$t' class='hidden'>: ".html_select("output",$b->dumpOutput(),$xa["output"])." ".html_select("format",$pc,$xa["format"])."<input type='hidden' name='query' value='".h($Ag)."'>"." <input type='submit' name='export' value='".'Export'."'><input type='hidden' name='token' value='$vi'></span>\n"."</form>\n";}}else{if(preg_match("~^$Dh*+(CREATE|DROP|ALTER)$Dh++(DATABASE|SCHEMA)\\b~i",$Ag)){restart_session();set_session("dbs",null);stop_session();}if(!$_POST["only_errors"])echo"<p class='message' title='".h($g->info)."'>".lang(array('Query executed OK, %d row affected.','Query executed OK, %d rows affected.'),$za)."$li\n";}echo($kj?"<div id='$lj' class='hidden'>\n$kj</div>\n":"");if($Lc){echo"<div id='$Mc' class='hidden'>\n";select($Lc,$h,$If);echo"</div>\n";}}$Kh=microtime(true);}while($g->next_result());}$F=substr($F,$C);$C=0;}}}}if($yc)echo"<p class='message'>".'No commands to execute.'."\n";elseif($_POST["only_errors"]){echo"<p class='message'>".lang(array('%d query executed OK.','%d queries executed OK.'),$tb-count($Cc))," <span class='time'>(".format_time($xi).")</span>\n";}elseif($Cc&&$tb>1)echo"<p class='error'>".'Error in query'.": ".implode("",$Cc)."\n";}else
echo"<p class='error'>".upload_error($F)."\n";}echo'
<form action="" method="post" enctype="multipart/form-data" id="form">
';$Ic="<input type='submit' value='".'Execute'."' title='Ctrl+Enter'>";if(!isset($_GET["import"])){$Ag=$_GET["sql"];if($_POST)$Ag=$_POST["query"];elseif($_GET["history"]=="all")$Ag=$Dd;elseif($_GET["history"]!="")$Ag=$Dd[$_GET["history"]][0];echo"<p>";textarea("query",$Ag,20);echo
script(($_POST?"":"qs('textarea').focus();\n")."qs('#form').onsubmit = partial(sqlSubmit, qs('#form'), '".js_escape(remove_from_uri("sql|limit|error_stops|only_errors|history"))."');"),"<p>$Ic\n",'Limit rows'.": <input type='number' name='limit' class='size' value='".h($_POST?$_POST["limit"]:$_GET["limit"])."'>\n";}else{echo"<fieldset><legend>".'File upload'."</legend><div>";$xd=(extension_loaded("zlib")?"[.gz]":"");echo(ini_bool("file_uploads")?"SQL$xd (&lt; ".ini_get("upload_max_filesize")."B): <input type='file' name='sql_file[]' multiple>\n$Ic":'File uploads are disabled.'),"</div></fieldset>\n";$Md=$b->importServerPath();if($Md){echo"<fieldset><legend>".'From server'."</legend><div>",sprintf('Webserver file %s',"<code>".h($Md)."$xd</code>"),' <input type="submit" name="webfile" value="'.'Run file'.'">',"</div></fieldset>\n";}echo"<p>";}echo
checkbox("error_stops",1,($_POST?$_POST["error_stops"]:isset($_GET["import"])||$_GET["error_stops"]),'Stop on error')."\n",checkbox("only_errors",1,($_POST?$_POST["only_errors"]:isset($_GET["import"])||$_GET["only_errors"]),'Show only errors')."\n","<input type='hidden' name='token' value='$vi'>\n";if(!isset($_GET["import"])&&$Dd){print_fieldset("history",'History',$_GET["history"]!="");for($X=end($Dd);$X;$X=prev($Dd)){$y=key($Dd);list($Ag,$li,$tc)=$X;echo'<a href="'.h(ME."sql=&history=$y").'">'.'Edit'."</a>"." <span class='time' title='".@date('Y-m-d',$li)."'>".@date("H:i:s",$li)."</span>"." <code class='jush-$x'>".shorten_utf8(ltrim(str_replace("\n"," ",str_replace("\r","",preg_replace('~^(#|-- ).*~m','',$Ag)))),80,"</code>").($tc?" <span class='time'>($tc)</span>":"")."<br>\n";}echo"<input type='submit' name='clear' value='".'Clear'."'>\n","<a href='".h(ME."sql=&history=all")."'>".'Edit all'."</a>\n","</div></fieldset>\n";}echo'</form>
';}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$p=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$p):""):where($_GET,$p));$Qi=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($p
as$B=>$o){if(!isset($o["privileges"][$Qi?"update":"insert"])||$b->fieldName($o)==""||$o["generated"])unset($p[$B]);}if($_POST&&!$n&&!isset($_GET["select"])){$Ce=$_POST["referer"];if($_POST["insert"])$Ce=($Qi?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$Ce))$Ce=ME."select=".urlencode($a);$w=indexes($a);$Li=unique_array($_GET["where"],$w);$Dg="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($Ce,'Item has been deleted.',$m->delete($a,$Dg,!$Li));else{$N=array();foreach($p
as$B=>$o){$X=process_input($o);if($X!==false&&$X!==null)$N[idf_escape($B)]=$X;}if($Qi){if(!$N)redirect($Ce);queries_redirect($Ce,'Item has been updated.',$m->update($a,$N,$Dg,!$Li));if(is_ajax()){page_headers();page_messages($n);exit;}}else{$G=$m->insert($a,$N);$ue=($G?last_id():0);queries_redirect($Ce,sprintf('Item%s has been inserted.',($ue?" $ue":"")),$G);}}}$I=null;if($_POST["save"])$I=(array)$_POST["fields"];elseif($Z){$K=array();foreach($p
as$B=>$o){if(isset($o["privileges"]["select"])){$Ga=convert_field($o);if($_POST["clone"]&&$o["auto_increment"])$Ga="''";if($x=="sql"&&preg_match("~enum|set~",$o["type"]))$Ga="1*".idf_escape($B);$K[]=($Ga?"$Ga AS ":"").idf_escape($B);}}$I=array();if(!support("table"))$K=array("*");if($K){$G=$m->select($a,$K,array($Z),$K,array(),(isset($_GET["select"])?2:1));if(!$G)$n=error();else{$I=$G->fetch_assoc();if(!$I)$I=false;}if(isset($_GET["select"])&&(!$I||$G->fetch_assoc()))$I=null;}}if(!support("table")&&!$p){if(!$Z){$G=$m->select($a,array("*"),$Z,array("*"));$I=($G?$G->fetch_assoc():false);if(!$I)$I=array($m->primary=>"");}if($I){foreach($I
as$y=>$X){if(!$Z)$I[$y]=null;$p[$y]=array("field"=>$y,"null"=>($y!=$m->primary),"auto_increment"=>($y==$m->primary));}}}edit_form($a,$p,$I,$Qi);}elseif(isset($_GET["create"])){$a=$_GET["create"];$Yf=array();foreach(array('HASH','LINEAR HASH','KEY','LINEAR KEY','RANGE','LIST')as$y)$Yf[$y]=$y;$Lg=referencable_primary($a);$kd=array();foreach($Lg
as$Wh=>$o)$kd[str_replace("`","``",$Wh)."`".str_replace("`","``",$o["field"])]=$Wh;$Lf=array();$R=array();if($a!=""){$Lf=fields($a);$R=table_status($a);if(!$R)$n='No tables.';}$I=$_POST;$I["fields"]=(array)$I["fields"];if($I["auto_increment_col"])$I["fields"][$I["auto_increment_col"]]["auto_increment"]=true;if($_POST)set_adminer_settings(array("comments"=>$_POST["comments"],"defaults"=>$_POST["defaults"]));if($_POST&&!process_fields($I["fields"])&&!$n){if($_POST["drop"])queries_redirect(substr(ME,0,-1),'Table has been dropped.',drop_tables(array($a)));else{$p=array();$Da=array();$Vi=false;$id=array();$Kf=reset($Lf);$Aa=" FIRST";foreach($I["fields"]as$y=>$o){$q=$kd[$o["type"]];$Hi=($q!==null?$Lg[$q]:$o);if($o["field"]!=""){if(!$o["has_default"])$o["default"]=null;if($y==$I["auto_increment_col"])$o["auto_increment"]=true;$yg=process_field($o,$Hi);$Da[]=array($o["orig"],$yg,$Aa);if($yg!=process_field($Kf,$Kf)){$p[]=array($o["orig"],$yg,$Aa);if($o["orig"]!=""||$Aa)$Vi=true;}if($q!==null)$id[idf_escape($o["field"])]=($a!=""&&$x!="sqlite"?"ADD":" ").format_foreign_key(array('table'=>$kd[$o["type"]],'source'=>array($o["field"]),'target'=>array($Hi["field"]),'on_delete'=>$o["on_delete"],));$Aa=" AFTER ".idf_escape($o["field"]);}elseif($o["orig"]!=""){$Vi=true;$p[]=array($o["orig"]);}if($o["orig"]!=""){$Kf=next($Lf);if(!$Kf)$Aa="";}}$ag="";if($Yf[$I["partition_by"]]){$bg=array();if($I["partition_by"]=='RANGE'||$I["partition_by"]=='LIST'){foreach(array_filter($I["partition_names"])as$y=>$X){$Y=$I["partition_values"][$y];$bg[]="\n  PARTITION ".idf_escape($X)." VALUES ".($I["partition_by"]=='RANGE'?"LESS THAN":"IN").($Y!=""?" ($Y)":" MAXVALUE");}}$ag.="\nPARTITION BY $I[partition_by]($I[partition])".($bg?" (".implode(",",$bg)."\n)":($I["partitions"]?" PARTITIONS ".(+$I["partitions"]):""));}elseif(support("partitioning")&&preg_match("~partitioned~",$R["Create_options"]))$ag.="\nREMOVE PARTITIONING";$Re='Table has been altered.';if($a==""){cookie("adminer_engine",$I["Engine"]);$Re='Table has been created.';}$B=trim($I["name"]);queries_redirect(ME.(support("table")?"table=":"select=").urlencode($B),$Re,alter_table($a,$B,($x=="sqlite"&&($Vi||$id)?$Da:$p),$id,($I["Comment"]!=$R["Comment"]?$I["Comment"]:null),($I["Engine"]&&$I["Engine"]!=$R["Engine"]?$I["Engine"]:""),($I["Collation"]&&$I["Collation"]!=$R["Collation"]?$I["Collation"]:""),($I["Auto_increment"]!=""?number($I["Auto_increment"]):""),$ag));}}page_header(($a!=""?'Alter table':'Create table'),$n,array("table"=>$a),h($a));if(!$_POST){$I=array("Engine"=>$_COOKIE["adminer_engine"],"fields"=>array(array("field"=>"","type"=>(isset($U["int"])?"int":(isset($U["integer"])?"integer":"")),"on_update"=>"")),"partition_names"=>array(""),);if($a!=""){$I=$R;$I["name"]=$a;$I["fields"]=array();if(!$_GET["auto_increment"])$I["Auto_increment"]="";foreach($Lf
as$o){$o["has_default"]=isset($o["default"]);$I["fields"][]=$o;}if(support("partitioning")){$pd="FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = ".q(DB)." AND TABLE_NAME = ".q($a);$G=$g->query("SELECT PARTITION_METHOD, PARTITION_ORDINAL_POSITION, PARTITION_EXPRESSION $pd ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");list($I["partition_by"],$I["partitions"],$I["partition"])=$G->fetch_row();$bg=get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $pd AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");$bg[""]="";$I["partition_names"]=array_keys($bg);$I["partition_values"]=array_values($bg);}}}$pb=collations();$_c=engines();foreach($_c
as$zc){if(!strcasecmp($zc,$I["Engine"])){$I["Engine"]=$zc;break;}}echo'
<form action="" method="post" id="form">
<p>
';if(support("columns")||$a==""){echo'Table name: <input name="name" data-maxlength="64" value="',h($I["name"]),'" autocapitalize="off">
';if($a==""&&!$_POST)echo
script("focus(qs('#form')['name']);");echo($_c?"<select name='Engine'>".optionlist(array(""=>"(".'engine'.")")+$_c,$I["Engine"])."</select>".on_help("getTarget(event).value",1).script("qsl('select').onchange = helpClose;"):""),' ',($pb&&!preg_match("~sqlite|mssql~",$x)?html_select("Collation",array(""=>"(".'collation'.")")+$pb,$I["Collation"]):""),' <input type="submit" value="Save">
';}echo'
';if(support("columns")){echo'<div class="scrollable">
<table cellspacing="0" id="edit-fields" class="nowrap">
';edit_fields($I["fields"],$pb,"TABLE",$kd);echo'</table>
',script("editFields();"),'</div>
<p>
Auto Increment: <input type="number" name="Auto_increment" size="6" value="',h($I["Auto_increment"]),'">
',checkbox("defaults",1,($_POST?$_POST["defaults"]:adminer_setting("defaults")),'Default values',"columnShow(this.checked, 5)","jsonly"),(support("comment")?checkbox("comments",1,($_POST?$_POST["comments"]:adminer_setting("comments")),'Comment',"editingCommentsClick(this, true);","jsonly").' <input name="Comment" value="'.h($I["Comment"]).'" data-maxlength="'.(min_version(5.5)?2048:60).'">':''),'<p>
<input type="submit" value="Save">
';}echo'
';if($a!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$a));}if(support("partitioning")){$Zf=preg_match('~RANGE|LIST~',$I["partition_by"]);print_fieldset("partition",'Partition by',$I["partition_by"]);echo'<p>
',"<select name='partition_by'>".optionlist(array(""=>"")+$Yf,$I["partition_by"])."</select>".on_help("getTarget(event).value.replace(/./, 'PARTITION BY \$&')",1).script("qsl('select').onchange = partitionByChange;"),'(<input name="partition" value="',h($I["partition"]),'">)
Partitions: <input type="number" name="partitions" class="size',($Zf||!$I["partition_by"]?" hidden":""),'" value="',h($I["partitions"]),'">
<table cellspacing="0" id="partition-table"',($Zf?"":" class='hidden'"),'>
<thead><tr><th>Partition name<th>Values</thead>
';foreach($I["partition_names"]as$y=>$X){echo'<tr>','<td><input name="partition_names[]" value="'.h($X).'" autocapitalize="off">',($y==count($I["partition_names"])-1?script("qsl('input').oninput = partitionNameChange;"):''),'<td><input name="partition_values[]" value="'.h($I["partition_values"][$y]).'">';}echo'</table>
</div></fieldset>
';}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["indexes"])){$a=$_GET["indexes"];$Pd=array("PRIMARY","UNIQUE","INDEX");$R=table_status($a,true);if(preg_match('~MyISAM|M?aria'.(min_version(5.6,'10.0.5')?'|InnoDB':'').'~i',$R["Engine"]))$Pd[]="FULLTEXT";if(preg_match('~MyISAM|M?aria'.(min_version(5.7,'10.2.2')?'|InnoDB':'').'~i',$R["Engine"]))$Pd[]="SPATIAL";$w=indexes($a);$rg=array();if($x=="mongo"){$rg=$w["_id_"];unset($Pd[0]);unset($w["_id_"]);}$I=$_POST;if($_POST&&!$n&&!$_POST["add"]&&!$_POST["drop_col"]){$c=array();foreach($I["indexes"]as$v){$B=$v["name"];if(in_array($v["type"],$Pd)){$f=array();$_e=array();$dc=array();$N=array();ksort($v["columns"]);foreach($v["columns"]as$y=>$e){if($e!=""){$ze=$v["lengths"][$y];$cc=$v["descs"][$y];$N[]=idf_escape($e).($ze?"(".(+$ze).")":"").($cc?" DESC":"");$f[]=$e;$_e[]=($ze?$ze:null);$dc[]=$cc;}}if($f){$Jc=$w[$B];if($Jc){ksort($Jc["columns"]);ksort($Jc["lengths"]);ksort($Jc["descs"]);if($v["type"]==$Jc["type"]&&array_values($Jc["columns"])===$f&&(!$Jc["lengths"]||array_values($Jc["lengths"])===$_e)&&array_values($Jc["descs"])===$dc){unset($w[$B]);continue;}}$c[]=array($v["type"],$B,$N);}}}foreach($w
as$B=>$Jc)$c[]=array($Jc["type"],$B,"DROP");if(!$c)redirect(ME."table=".urlencode($a));queries_redirect(ME."table=".urlencode($a),'Indexes have been altered.',alter_indexes($a,$c));}page_header('Indexes',$n,array("table"=>$a),h($a));$p=array_keys(fields($a));if($_POST["add"]){foreach($I["indexes"]as$y=>$v){if($v["columns"][count($v["columns"])]!="")$I["indexes"][$y]["columns"][]="";}$v=end($I["indexes"]);if($v["type"]||array_filter($v["columns"],'strlen'))$I["indexes"][]=array("columns"=>array(1=>""));}if(!$I){foreach($w
as$y=>$v){$w[$y]["name"]=$y;$w[$y]["columns"][]="";}$w[]=array("columns"=>array(1=>""));$I["indexes"]=$w;}echo'
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
<thead><tr>
<th id="label-type">Index Type
<th><input type="submit" class="wayoff">Column (length)
<th id="label-name">Name
<th><noscript>',"<input type='image' class='icon' name='add[0]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.9")."' alt='+' title='".'Add next'."'>",'</noscript>
</thead>
';if($rg){echo"<tr><td>PRIMARY<td>";foreach($rg["columns"]as$y=>$e){echo
select_input(" disabled",$p,$e),"<label><input disabled type='checkbox'>".'descending'."</label> ";}echo"<td><td>\n";}$ie=1;foreach($I["indexes"]as$v){if(!$_POST["drop_col"]||$ie!=key($_POST["drop_col"])){echo"<tr><td>".html_select("indexes[$ie][type]",array(-1=>"")+$Pd,$v["type"],($ie==count($I["indexes"])?"indexesAddRow.call(this);":1),"label-type"),"<td>";ksort($v["columns"]);$s=1;foreach($v["columns"]as$y=>$e){echo"<span>".select_input(" name='indexes[$ie][columns][$s]' title='".'Column'."'",($p?array_combine($p,$p):$p),$e,"partial(".($s==count($v["columns"])?"indexesAddColumn":"indexesChangeColumn").", '".js_escape($x=="sql"?"":$_GET["indexes"]."_")."')"),($x=="sql"||$x=="mssql"?"<input type='number' name='indexes[$ie][lengths][$s]' class='size' value='".h($v["lengths"][$y])."' title='".'Length'."'>":""),(support("descidx")?checkbox("indexes[$ie][descs][$s]",1,$v["descs"][$y],'descending'):"")," </span>";$s++;}echo"<td><input name='indexes[$ie][name]' value='".h($v["name"])."' autocapitalize='off' aria-labelledby='label-name'>\n","<td><input type='image' class='icon' name='drop_col[$ie]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.7.9")."' alt='x' title='".'Remove'."'>".script("qsl('input').onclick = partial(editingRemoveRow, 'indexes\$1[type]');");}$ie++;}echo'</table>
</div>
<p>
<input type="submit" value="Save">
<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["database"])){$I=$_POST;if($_POST&&!$n&&!isset($_POST["add_x"])){$B=trim($I["name"]);if($_POST["drop"]){$_GET["db"]="";queries_redirect(remove_from_uri("db|database"),'Database has been dropped.',drop_databases(array(DB)));}elseif(DB!==$B){if(DB!=""){$_GET["db"]=$B;queries_redirect(preg_replace('~\bdb=[^&]*&~','',ME)."db=".urlencode($B),'Database has been renamed.',rename_database($B,$I["collation"]));}else{$k=explode("\n",str_replace("\r","",$B));$Qh=true;$te="";foreach($k
as$l){if(count($k)==1||$l!=""){if(!create_database($l,$I["collation"]))$Qh=false;$te=$l;}}restart_session();set_session("dbs",null);queries_redirect(ME."db=".urlencode($te),'Database has been created.',$Qh);}}else{if(!$I["collation"])redirect(substr(ME,0,-1));query_redirect("ALTER DATABASE ".idf_escape($B).(preg_match('~^[a-z0-9_]+$~i',$I["collation"])?" COLLATE $I[collation]":""),substr(ME,0,-1),'Database has been altered.');}}page_header(DB!=""?'Alter database':'Create database',$n,array(),h(DB));$pb=collations();$B=DB;if($_POST)$B=$I["name"];elseif(DB!="")$I["collation"]=db_collation(DB,$pb);elseif($x=="sql"){foreach(get_vals("SHOW GRANTS")as$rd){if(preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\.\*)?~',$rd,$A)&&$A[1]){$B=stripcslashes(idf_unescape("`$A[2]`"));break;}}}echo'
<form action="" method="post">
<p>
',($_POST["add_x"]||strpos($B,"\n")?'<textarea id="name" name="name" rows="10" cols="40">'.h($B).'</textarea><br>':'<input name="name" id="name" value="'.h($B).'" data-maxlength="64" autocapitalize="off">')."\n".($pb?html_select("collation",array(""=>"(".'collation'.")")+$pb,$I["collation"]).doc_link(array('sql'=>"charset-charsets.html",'mariadb'=>"supported-character-sets-and-collations/",'mssql'=>"ms187963.aspx",)):""),script("focus(qs('#name'));"),'<input type="submit" value="Save">
';if(DB!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',DB))."\n";elseif(!$_POST["add_x"]&&$_GET["db"]=="")echo"<input type='image' class='icon' name='add' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.9")."' alt='+' title='".'Add next'."'>\n";echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["scheme"])){$I=$_POST;if($_POST&&!$n){$_=preg_replace('~ns=[^&]*&~','',ME)."ns=";if($_POST["drop"])query_redirect("DROP SCHEMA ".idf_escape($_GET["ns"]),$_,'Schema has been dropped.');else{$B=trim($I["name"]);$_.=urlencode($B);if($_GET["ns"]=="")query_redirect("CREATE SCHEMA ".idf_escape($B),$_,'Schema has been created.');elseif($_GET["ns"]!=$B)query_redirect("ALTER SCHEMA ".idf_escape($_GET["ns"])." RENAME TO ".idf_escape($B),$_,'Schema has been altered.');else
redirect($_);}}page_header($_GET["ns"]!=""?'Alter schema':'Create schema',$n);if(!$I)$I["name"]=$_GET["ns"];echo'
<form action="" method="post">
<p><input name="name" id="name" value="',h($I["name"]),'" autocapitalize="off">
',script("focus(qs('#name'));"),'<input type="submit" value="Save">
';if($_GET["ns"]!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$_GET["ns"]))."\n";echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["call"])){$da=($_GET["name"]?$_GET["name"]:$_GET["call"]);page_header('Call'.": ".h($da),$n);$bh=routine($_GET["call"],(isset($_GET["callf"])?"FUNCTION":"PROCEDURE"));$Nd=array();$Pf=array();foreach($bh["fields"]as$s=>$o){if(substr($o["inout"],-3)=="OUT")$Pf[$s]="@".idf_escape($o["field"])." AS ".idf_escape($o["field"]);if(!$o["inout"]||substr($o["inout"],0,2)=="IN")$Nd[]=$s;}if(!$n&&$_POST){$ab=array();foreach($bh["fields"]as$y=>$o){if(in_array($y,$Nd)){$X=process_input($o);if($X===false)$X="''";if(isset($Pf[$y]))$g->query("SET @".idf_escape($o["field"])." = $X");}$ab[]=(isset($Pf[$y])?"@".idf_escape($o["field"]):$X);}$F=(isset($_GET["callf"])?"SELECT":"CALL")." ".table($da)."(".implode(", ",$ab).")";$Kh=microtime(true);$G=$g->multi_query($F);$za=$g->affected_rows;echo$b->selectQuery($F,$Kh,!$G);if(!$G)echo"<p class='error'>".error()."\n";else{$h=connect();if(is_object($h))$h->select_db(DB);do{$G=$g->store_result();if(is_object($G))select($G,$h);else
echo"<p class='message'>".lang(array('Routine has been called, %d row affected.','Routine has been called, %d rows affected.'),$za)." <span class='time'>".@date("H:i:s")."</span>\n";}while($g->next_result());if($Pf)select($g->query("SELECT ".implode(", ",$Pf)));}}echo'
<form action="" method="post">
';if($Nd){echo"<table cellspacing='0' class='layout'>\n";foreach($Nd
as$y){$o=$bh["fields"][$y];$B=$o["field"];echo"<tr><th>".$b->fieldName($o);$Y=$_POST["fields"][$B];if($Y!=""){if($o["type"]=="enum")$Y=+$Y;if($o["type"]=="set")$Y=array_sum($Y);}input($o,$Y,(string)$_POST["function"][$B]);echo"\n";}echo"</table>\n";}echo'<p>
<input type="submit" value="Call">
<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["foreign"])){$a=$_GET["foreign"];$B=$_GET["name"];$I=$_POST;if($_POST&&!$n&&!$_POST["add"]&&!$_POST["change"]&&!$_POST["change-js"]){$Re=($_POST["drop"]?'Foreign key has been dropped.':($B!=""?'Foreign key has been altered.':'Foreign key has been created.'));$Ce=ME."table=".urlencode($a);if(!$_POST["drop"]){$I["source"]=array_filter($I["source"],'strlen');ksort($I["source"]);$ei=array();foreach($I["source"]as$y=>$X)$ei[$y]=$I["target"][$y];$I["target"]=$ei;}if($x=="sqlite")queries_redirect($Ce,$Re,recreate_table($a,$a,array(),array(),array(" $B"=>($_POST["drop"]?"":" ".format_foreign_key($I)))));else{$c="ALTER TABLE ".table($a);$kc="\nDROP ".($x=="sql"?"FOREIGN KEY ":"CONSTRAINT ").idf_escape($B);if($_POST["drop"])query_redirect($c.$kc,$Ce,$Re);else{query_redirect($c.($B!=""?"$kc,":"")."\nADD".format_foreign_key($I),$Ce,$Re);$n='Source and target columns must have the same data type, there must be an index on the target columns and referenced data must exist.'."<br>$n";}}}page_header('Foreign key',$n,array("table"=>$a),h($a));if($_POST){ksort($I["source"]);if($_POST["add"])$I["source"][]="";elseif($_POST["change"]||$_POST["change-js"])$I["target"]=array();}elseif($B!=""){$kd=foreign_keys($a);$I=$kd[$B];$I["source"][]="";}else{$I["table"]=$a;$I["source"]=array("");}echo'
<form action="" method="post">
';$Ch=array_keys(fields($a));if($I["db"]!="")$g->select_db($I["db"]);if($I["ns"]!="")set_schema($I["ns"]);$Kg=array_keys(array_filter(table_status('',true),'fk_support'));$ei=array_keys(fields(in_array($I["table"],$Kg)?$I["table"]:reset($Kg)));$xf="this.form['change-js'].value = '1'; this.form.submit();";echo"<p>".'Target table'.": ".html_select("table",$Kg,$I["table"],$xf)."\n";if($x=="pgsql")echo'Schema'.": ".html_select("ns",$b->schemas(),$I["ns"]!=""?$I["ns"]:$_GET["ns"],$xf);elseif($x!="sqlite"){$Vb=array();foreach($b->databases()as$l){if(!information_schema($l))$Vb[]=$l;}echo'DB'.": ".html_select("db",$Vb,$I["db"]!=""?$I["db"]:$_GET["db"],$xf);}echo'<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="Change"></noscript>
<table cellspacing="0">
<thead><tr><th id="label-source">Source<th id="label-target">Target</thead>
';$ie=0;foreach($I["source"]as$y=>$X){echo"<tr>","<td>".html_select("source[".(+$y)."]",array(-1=>"")+$Ch,$X,($ie==count($I["source"])-1?"foreignAddRow.call(this);":1),"label-source"),"<td>".html_select("target[".(+$y)."]",$ei,$I["target"][$y],1,"label-target");$ie++;}echo'</table>
<p>
ON DELETE: ',html_select("on_delete",array(-1=>"")+explode("|",$wf),$I["on_delete"]),' ON UPDATE: ',html_select("on_update",array(-1=>"")+explode("|",$wf),$I["on_update"]),doc_link(array('sql'=>"innodb-foreign-key-constraints.html",'mariadb'=>"foreign-keys/",'pgsql'=>"sql-createtable.html#SQL-CREATETABLE-REFERENCES",'mssql'=>"ms174979.aspx",'oracle'=>"https://docs.oracle.com/cd/B19306_01/server.102/b14200/clauses002.htm#sthref2903",)),'<p>
<input type="submit" value="Save">
<noscript><p><input type="submit" name="add" value="Add column"></noscript>
';if($B!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$B));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["view"])){$a=$_GET["view"];$I=$_POST;$Mf="VIEW";if($x=="pgsql"&&$a!=""){$O=table_status($a);$Mf=strtoupper($O["Engine"]);}if($_POST&&!$n){$B=trim($I["name"]);$Ga=" AS\n$I[select]";$Ce=ME."table=".urlencode($B);$Re='View has been altered.';$T=($_POST["materialized"]?"MATERIALIZED VIEW":"VIEW");if(!$_POST["drop"]&&$a==$B&&$x!="sqlite"&&$T=="VIEW"&&$Mf=="VIEW")query_redirect(($x=="mssql"?"ALTER":"CREATE OR REPLACE")." VIEW ".table($B).$Ga,$Ce,$Re);else{$gi=$B."_adminer_".uniqid();drop_create("DROP $Mf ".table($a),"CREATE $T ".table($B).$Ga,"DROP $T ".table($B),"CREATE $T ".table($gi).$Ga,"DROP $T ".table($gi),($_POST["drop"]?substr(ME,0,-1):$Ce),'View has been dropped.',$Re,'View has been created.',$a,$B);}}if(!$_POST&&$a!=""){$I=view($a);$I["name"]=$a;$I["materialized"]=($Mf!="VIEW");if(!$n)$n=error();}page_header(($a!=""?'Alter view':'Create view'),$n,array("table"=>$a),h($a));echo'
<form action="" method="post">
<p>Name: <input name="name" value="',h($I["name"]),'" data-maxlength="64" autocapitalize="off">
',(support("materializedview")?" ".checkbox("materialized",1,$I["materialized"],'Materialized view'):""),'<p>';textarea("select",$I["select"]);echo'<p>
<input type="submit" value="Save">
';if($a!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$a));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["event"])){$aa=$_GET["event"];$ae=array("YEAR","QUARTER","MONTH","DAY","HOUR","MINUTE","WEEK","SECOND","YEAR_MONTH","DAY_HOUR","DAY_MINUTE","DAY_SECOND","HOUR_MINUTE","HOUR_SECOND","MINUTE_SECOND");$Mh=array("ENABLED"=>"ENABLE","DISABLED"=>"DISABLE","SLAVESIDE_DISABLED"=>"DISABLE ON SLAVE");$I=$_POST;if($_POST&&!$n){if($_POST["drop"])query_redirect("DROP EVENT ".idf_escape($aa),substr(ME,0,-1),'Event has been dropped.');elseif(in_array($I["INTERVAL_FIELD"],$ae)&&isset($Mh[$I["STATUS"]])){$gh="\nON SCHEDULE ".($I["INTERVAL_VALUE"]?"EVERY ".q($I["INTERVAL_VALUE"])." $I[INTERVAL_FIELD]".($I["STARTS"]?" STARTS ".q($I["STARTS"]):"").($I["ENDS"]?" ENDS ".q($I["ENDS"]):""):"AT ".q($I["STARTS"]))." ON COMPLETION".($I["ON_COMPLETION"]?"":" NOT")." PRESERVE";queries_redirect(substr(ME,0,-1),($aa!=""?'Event has been altered.':'Event has been created.'),queries(($aa!=""?"ALTER EVENT ".idf_escape($aa).$gh.($aa!=$I["EVENT_NAME"]?"\nRENAME TO ".idf_escape($I["EVENT_NAME"]):""):"CREATE EVENT ".idf_escape($I["EVENT_NAME"]).$gh)."\n".$Mh[$I["STATUS"]]." COMMENT ".q($I["EVENT_COMMENT"]).rtrim(" DO\n$I[EVENT_DEFINITION]",";").";"));}}page_header(($aa!=""?'Alter event'.": ".h($aa):'Create event'),$n);if(!$I&&$aa!=""){$J=get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = ".q(DB)." AND EVENT_NAME = ".q($aa));$I=reset($J);}echo'
<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Name<td><input name="EVENT_NAME" value="',h($I["EVENT_NAME"]),'" data-maxlength="64" autocapitalize="off">
<tr><th title="datetime">Start<td><input name="STARTS" value="',h("$I[EXECUTE_AT]$I[STARTS]"),'">
<tr><th title="datetime">End<td><input name="ENDS" value="',h($I["ENDS"]),'">
<tr><th>Every<td><input type="number" name="INTERVAL_VALUE" value="',h($I["INTERVAL_VALUE"]),'" class="size"> ',html_select("INTERVAL_FIELD",$ae,$I["INTERVAL_FIELD"]),'<tr><th>Status<td>',html_select("STATUS",$Mh,$I["STATUS"]),'<tr><th>Comment<td><input name="EVENT_COMMENT" value="',h($I["EVENT_COMMENT"]),'" data-maxlength="64">
<tr><th><td>',checkbox("ON_COMPLETION","PRESERVE",$I["ON_COMPLETION"]=="PRESERVE",'On completion preserve'),'</table>
<p>';textarea("EVENT_DEFINITION",$I["EVENT_DEFINITION"]);echo'<p>
<input type="submit" value="Save">
';if($aa!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$aa));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["procedure"])){$da=($_GET["name"]?$_GET["name"]:$_GET["procedure"]);$bh=(isset($_GET["function"])?"FUNCTION":"PROCEDURE");$I=$_POST;$I["fields"]=(array)$I["fields"];if($_POST&&!process_fields($I["fields"])&&!$n){$Jf=routine($_GET["procedure"],$bh);$gi="$I[name]_adminer_".uniqid();drop_create("DROP $bh ".routine_id($da,$Jf),create_routine($bh,$I),"DROP $bh ".routine_id($I["name"],$I),create_routine($bh,array("name"=>$gi)+$I),"DROP $bh ".routine_id($gi,$I),substr(ME,0,-1),'Routine has been dropped.','Routine has been altered.','Routine has been created.',$da,$I["name"]);}page_header(($da!=""?(isset($_GET["function"])?'Alter function':'Alter procedure').": ".h($da):(isset($_GET["function"])?'Create function':'Create procedure')),$n);if(!$_POST&&$da!=""){$I=routine($_GET["procedure"],$bh);$I["name"]=$da;}$pb=get_vals("SHOW CHARACTER SET");sort($pb);$ch=routine_languages();echo'
<form action="" method="post" id="form">
<p>Name: <input name="name" value="',h($I["name"]),'" data-maxlength="64" autocapitalize="off">
',($ch?'Language'.": ".html_select("language",$ch,$I["language"])."\n":""),'<input type="submit" value="Save">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
';edit_fields($I["fields"],$pb,$bh);if(isset($_GET["function"])){echo"<tr><td>".'Return type';edit_type("returns",$I["returns"],$pb,array(),($x=="pgsql"?array("void","trigger"):array()));}echo'</table>
',script("editFields();"),'</div>
<p>';textarea("definition",$I["definition"]);echo'<p>
<input type="submit" value="Save">
';if($da!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$da));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["sequence"])){$fa=$_GET["sequence"];$I=$_POST;if($_POST&&!$n){$_=substr(ME,0,-1);$B=trim($I["name"]);if($_POST["drop"])query_redirect("DROP SEQUENCE ".idf_escape($fa),$_,'Sequence has been dropped.');elseif($fa=="")query_redirect("CREATE SEQUENCE ".idf_escape($B),$_,'Sequence has been created.');elseif($fa!=$B)query_redirect("ALTER SEQUENCE ".idf_escape($fa)." RENAME TO ".idf_escape($B),$_,'Sequence has been altered.');else
redirect($_);}page_header($fa!=""?'Alter sequence'.": ".h($fa):'Create sequence',$n);if(!$I)$I["name"]=$fa;echo'
<form action="" method="post">
<p><input name="name" value="',h($I["name"]),'" autocapitalize="off">
<input type="submit" value="Save">
';if($fa!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$fa))."\n";echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["type"])){$ga=$_GET["type"];$I=$_POST;if($_POST&&!$n){$_=substr(ME,0,-1);if($_POST["drop"])query_redirect("DROP TYPE ".idf_escape($ga),$_,'Type has been dropped.');else
query_redirect("CREATE TYPE ".idf_escape(trim($I["name"]))." $I[as]",$_,'Type has been created.');}page_header($ga!=""?'Alter type'.": ".h($ga):'Create type',$n);if(!$I)$I["as"]="AS ";echo'
<form action="" method="post">
<p>
';if($ga!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$ga))."\n";else{echo"<input name='name' value='".h($I['name'])."' autocapitalize='off'>\n";textarea("as",$I["as"]);echo"<p><input type='submit' value='".'Save'."'>\n";}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["trigger"])){$a=$_GET["trigger"];$B=$_GET["name"];$Fi=trigger_options();$I=(array)trigger($B)+array("Trigger"=>$a."_bi");if($_POST){if(!$n&&in_array($_POST["Timing"],$Fi["Timing"])&&in_array($_POST["Event"],$Fi["Event"])&&in_array($_POST["Type"],$Fi["Type"])){$vf=" ON ".table($a);$kc="DROP TRIGGER ".idf_escape($B).($x=="pgsql"?$vf:"");$Ce=ME."table=".urlencode($a);if($_POST["drop"])query_redirect($kc,$Ce,'Trigger has been dropped.');else{if($B!="")queries($kc);queries_redirect($Ce,($B!=""?'Trigger has been altered.':'Trigger has been created.'),queries(create_trigger($vf,$_POST)));if($B!="")queries(create_trigger($vf,$I+array("Type"=>reset($Fi["Type"]))));}}$I=$_POST;}page_header(($B!=""?'Alter trigger'.": ".h($B):'Create trigger'),$n,array("table"=>$a));echo'
<form action="" method="post" id="form">
<table cellspacing="0" class="layout">
<tr><th>Time<td>',html_select("Timing",$Fi["Timing"],$I["Timing"],"triggerChange(/^".preg_quote($a,"/")."_[ba][iud]$/, '".js_escape($a)."', this.form);"),'<tr><th>Event<td>',html_select("Event",$Fi["Event"],$I["Event"],"this.form['Timing'].onchange();"),(in_array("UPDATE OF",$Fi["Event"])?" <input name='Of' value='".h($I["Of"])."' class='hidden'>":""),'<tr><th>Type<td>',html_select("Type",$Fi["Type"],$I["Type"]),'</table>
<p>Name: <input name="Trigger" value="',h($I["Trigger"]),'" data-maxlength="64" autocapitalize="off">
',script("qs('#form')['Timing'].onchange();"),'<p>';textarea("Statement",$I["Statement"]);echo'<p>
<input type="submit" value="Save">
';if($B!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$B));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["user"])){$ha=$_GET["user"];$wg=array(""=>array("All privileges"=>""));foreach(get_rows("SHOW PRIVILEGES")as$I){foreach(explode(",",($I["Privilege"]=="Grant option"?"":$I["Context"]))as$Fb)$wg[$Fb][$I["Privilege"]]=$I["Comment"];}$wg["Server Admin"]+=$wg["File access on server"];$wg["Databases"]["Create routine"]=$wg["Procedures"]["Create routine"];unset($wg["Procedures"]["Create routine"]);$wg["Columns"]=array();foreach(array("Select","Insert","Update","References")as$X)$wg["Columns"][$X]=$wg["Tables"][$X];unset($wg["Server Admin"]["Usage"]);foreach($wg["Tables"]as$y=>$X)unset($wg["Databases"][$y]);$ef=array();if($_POST){foreach($_POST["objects"]as$y=>$X)$ef[$X]=(array)$ef[$X]+(array)$_POST["grants"][$y];}$sd=array();$tf="";if(isset($_GET["host"])&&($G=$g->query("SHOW GRANTS FOR ".q($ha)."@".q($_GET["host"])))){while($I=$G->fetch_row()){if(preg_match('~GRANT (.*) ON (.*) TO ~',$I[0],$A)&&preg_match_all('~ *([^(,]*[^ ,(])( *\([^)]+\))?~',$A[1],$Je,PREG_SET_ORDER)){foreach($Je
as$X){if($X[1]!="USAGE")$sd["$A[2]$X[2]"][$X[1]]=true;if(preg_match('~ WITH GRANT OPTION~',$I[0]))$sd["$A[2]$X[2]"]["GRANT OPTION"]=true;}}if(preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~",$I[0],$A))$tf=$A[1];}}if($_POST&&!$n){$uf=(isset($_GET["host"])?q($ha)."@".q($_GET["host"]):"''");if($_POST["drop"])query_redirect("DROP USER $uf",ME."privileges=",'User has been dropped.');else{$gf=q($_POST["user"])."@".q($_POST["host"]);$dg=$_POST["pass"];if($dg!=''&&!$_POST["hashed"]&&!min_version(8)){$dg=$g->result("SELECT PASSWORD(".q($dg).")");$n=!$dg;}$Kb=false;if(!$n){if($uf!=$gf){$Kb=queries((min_version(5)?"CREATE USER":"GRANT USAGE ON *.* TO")." $gf IDENTIFIED BY ".(min_version(8)?"":"PASSWORD ").q($dg));$n=!$Kb;}elseif($dg!=$tf)queries("SET PASSWORD FOR $gf = ".q($dg));}if(!$n){$Yg=array();foreach($ef
as$of=>$rd){if(isset($_GET["grant"]))$rd=array_filter($rd);$rd=array_keys($rd);if(isset($_GET["grant"]))$Yg=array_diff(array_keys(array_filter($ef[$of],'strlen')),$rd);elseif($uf==$gf){$rf=array_keys((array)$sd[$of]);$Yg=array_diff($rf,$rd);$rd=array_diff($rd,$rf);unset($sd[$of]);}if(preg_match('~^(.+)\s*(\(.*\))?$~U',$of,$A)&&(!grant("REVOKE",$Yg,$A[2]," ON $A[1] FROM $gf")||!grant("GRANT",$rd,$A[2]," ON $A[1] TO $gf"))){$n=true;break;}}}if(!$n&&isset($_GET["host"])){if($uf!=$gf)queries("DROP USER $uf");elseif(!isset($_GET["grant"])){foreach($sd
as$of=>$Yg){if(preg_match('~^(.+)(\(.*\))?$~U',$of,$A))grant("REVOKE",array_keys($Yg),$A[2]," ON $A[1] FROM $gf");}}}queries_redirect(ME."privileges=",(isset($_GET["host"])?'User has been altered.':'User has been created.'),!$n);if($Kb)$g->query("DROP USER $gf");}}page_header((isset($_GET["host"])?'Username'.": ".h("$ha@$_GET[host]"):'Create user'),$n,array("privileges"=>array('','Privileges')));if($_POST){$I=$_POST;$sd=$ef;}else{$I=$_GET+array("host"=>$g->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)"));$I["pass"]=$tf;if($tf!="")$I["hashed"]=true;$sd[(DB==""||$sd?"":idf_escape(addcslashes(DB,"%_\\"))).".*"]=array();}echo'<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Server<td><input name="host" data-maxlength="60" value="',h($I["host"]),'" autocapitalize="off">
<tr><th>Username<td><input name="user" data-maxlength="80" value="',h($I["user"]),'" autocapitalize="off">
<tr><th>Password<td><input name="pass" id="pass" value="',h($I["pass"]),'" autocomplete="new-password">
';if(!$I["hashed"])echo
script("typePassword(qs('#pass'));");echo(min_version(8)?"":checkbox("hashed",1,$I["hashed"],'Hashed',"typePassword(this.form['pass'], this.checked);")),'</table>

';echo"<table cellspacing='0'>\n","<thead><tr><th colspan='2'>".'Privileges'.doc_link(array('sql'=>"grant.html#priv_level"));$s=0;foreach($sd
as$of=>$rd){echo'<th>'.($of!="*.*"?"<input name='objects[$s]' value='".h($of)."' size='10' autocapitalize='off'>":"<input type='hidden' name='objects[$s]' value='*.*' size='10'>*.*");$s++;}echo"</thead>\n";foreach(array(""=>"","Server Admin"=>'Server',"Databases"=>'Database',"Tables"=>'Table',"Columns"=>'Column',"Procedures"=>'Routine',)as$Fb=>$cc){foreach((array)$wg[$Fb]as$vg=>$ub){echo"<tr".odd()."><td".($cc?">$cc<td":" colspan='2'").' lang="en" title="'.h($ub).'">'.h($vg);$s=0;foreach($sd
as$of=>$rd){$B="'grants[$s][".h(strtoupper($vg))."]'";$Y=$rd[strtoupper($vg)];if($Fb=="Server Admin"&&$of!=(isset($sd["*.*"])?"*.*":".*"))echo"<td>";elseif(isset($_GET["grant"]))echo"<td><select name=$B><option><option value='1'".($Y?" selected":"").">".'Grant'."<option value='0'".($Y=="0"?" selected":"").">".'Revoke'."</select>";else{echo"<td align='center'><label class='block'>","<input type='checkbox' name=$B value='1'".($Y?" checked":"").($vg=="All privileges"?" id='grants-$s-all'>":">".($vg=="Grant option"?"":script("qsl('input').onclick = function () { if (this.checked) formUncheck('grants-$s-all'); };"))),"</label>";}$s++;}}}echo"</table>\n",'<p>
<input type="submit" value="Save">
';if(isset($_GET["host"])){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',"$ha@$_GET[host]"));}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
';}elseif(isset($_GET["processlist"])){if(support("kill")&&$_POST&&!$n){$pe=0;foreach((array)$_POST["kill"]as$X){if(kill_process($X))$pe++;}queries_redirect(ME."processlist=",lang(array('%d process has been killed.','%d processes have been killed.'),$pe),$pe||!$_POST["kill"]);}page_header('Process list',$n);echo'
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap checkable">
',script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});");$s=-1;foreach(process_list()as$s=>$I){if(!$s){echo"<thead><tr lang='en'>".(support("kill")?"<th>":"");foreach($I
as$y=>$X)echo"<th>$y".doc_link(array('sql'=>"show-processlist.html#processlist_".strtolower($y),'pgsql'=>"monitoring-stats.html#PG-STAT-ACTIVITY-VIEW",'oracle'=>"REFRN30223",));echo"</thead>\n";}echo"<tr".odd().">".(support("kill")?"<td>".checkbox("kill[]",$I[$x=="sql"?"Id":"pid"],0):"");foreach($I
as$y=>$X)echo"<td>".(($x=="sql"&&$y=="Info"&&preg_match("~Query|Killed~",$I["Command"])&&$X!="")||($x=="pgsql"&&$y=="current_query"&&$X!="<IDLE>")||($x=="oracle"&&$y=="sql_text"&&$X!="")?"<code class='jush-$x'>".shorten_utf8($X,100,"</code>").' <a href="'.h(ME.($I["db"]!=""?"db=".urlencode($I["db"])."&":"")."sql=".urlencode($X)).'">'.'Clone'.'</a>':h($X));echo"\n";}echo'</table>
</div>
<p>
';if(support("kill")){echo($s+1)."/".sprintf('%d in total',max_connections()),"<p><input type='submit' value='".'Kill'."'>\n";}echo'<input type="hidden" name="token" value="',$vi,'">
</form>
',script("tableCheck();");}elseif(isset($_GET["select"])){$a=$_GET["select"];$R=table_status1($a);$w=indexes($a);$p=fields($a);$kd=column_foreign_keys($a);$qf=$R["Oid"];parse_str($_COOKIE["adminer_import"],$ya);$Zg=array();$f=array();$ki=null;foreach($p
as$y=>$o){$B=$b->fieldName($o);if(isset($o["privileges"]["select"])&&$B!=""){$f[$y]=html_entity_decode(strip_tags($B),ENT_QUOTES);if(is_shortable($o))$ki=$b->selectLengthProcess();}$Zg+=$o["privileges"];}list($K,$td)=$b->selectColumnsProcess($f,$w);$ee=count($td)<count($K);$Z=$b->selectSearchProcess($p,$w);$Ff=$b->selectOrderProcess($p,$w);$z=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Mi=>$I){$Ga=convert_field($p[key($I)]);$K=array($Ga?$Ga:idf_escape(key($I)));$Z[]=where_check($Mi,$p);$H=$m->select($a,$K,$Z,$K);if($H)echo
reset($H->fetch_row());}exit;}$rg=$Oi=null;foreach($w
as$v){if($v["type"]=="PRIMARY"){$rg=array_flip($v["columns"]);$Oi=($K?$rg:array());foreach($Oi
as$y=>$X){if(in_array(idf_escape($y),$K))unset($Oi[$y]);}break;}}if($qf&&!$rg){$rg=$Oi=array($qf=>0);$w[]=array("type"=>"PRIMARY","columns"=>array($qf));}if($_POST&&!$n){$qj=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$gb=array();foreach($_POST["check"]as$db)$gb[]=where_check($db,$p);$qj[]="((".implode(") OR (",$gb)."))";}$qj=($qj?"\nWHERE ".implode(" AND ",$qj):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$pd=($K?implode(", ",$K):"*").convert_fields($f,$p,$K)."\nFROM ".table($a);$vd=($td&&$ee?"\nGROUP BY ".implode(", ",$td):"").($Ff?"\nORDER BY ".implode(", ",$Ff):"");if(!is_array($_POST["check"])||$rg)$F="SELECT $pd$qj$vd";else{$Ki=array();foreach($_POST["check"]as$X)$Ki[]="(SELECT".limit($pd,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p).$vd,1).")";$F=implode(" UNION ALL ",$Ki);}$b->dumpData($a,"table",$F);exit;}if(!$b->selectEmailProcess($Z,$kd)){if($_POST["save"]||$_POST["delete"]){$G=true;$za=0;$N=array();if(!$_POST["delete"]){foreach($f
as$B=>$X){$X=process_input($p[$B]);if($X!==null&&($_POST["clone"]||$X!==false))$N[idf_escape($B)]=($X!==false?$X:idf_escape($B));}}if($_POST["delete"]||$N){if($_POST["clone"])$F="INTO ".table($a)." (".implode(", ",array_keys($N)).")\nSELECT ".implode(", ",$N)."\nFROM ".table($a);if($_POST["all"]||($rg&&is_array($_POST["check"]))||$ee){$G=($_POST["delete"]?$m->delete($a,$qj):($_POST["clone"]?queries("INSERT $F$qj"):$m->update($a,$N,$qj)));$za=$g->affected_rows;}else{foreach((array)$_POST["check"]as$X){$mj="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$p);$G=($_POST["delete"]?$m->delete($a,$mj,1):($_POST["clone"]?queries("INSERT".limit1($a,$F,$mj)):$m->update($a,$N,$mj,1)));if(!$G)break;$za+=$g->affected_rows;}}}$Re=lang(array('%d item has been affected.','%d items have been affected.'),$za);if($_POST["clone"]&&$G&&$za==1){$ue=last_id();if($ue)$Re=sprintf('Item%s has been inserted.'," $ue");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Re,$G);if(!$_POST["delete"]){edit_form($a,$p,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$n='Ctrl+click on a value to modify it.';else{$G=true;$za=0;foreach($_POST["val"]as$Mi=>$I){$N=array();foreach($I
as$y=>$X){$y=bracket_escape($y,1);$N[idf_escape($y)]=(preg_match('~char|text~',$p[$y]["type"])||$X!=""?$b->processInput($p[$y],$X):"NULL");}$G=$m->update($a,$N," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Mi,$p),!$ee&&!$rg," ");if(!$G)break;$za+=$g->affected_rows;}queries_redirect(remove_from_uri(),lang(array('%d item has been affected.','%d items have been affected.'),$za),$G);}}elseif(!is_string($Zc=get_file("csv_file",true)))$n=upload_error($Zc);elseif(!preg_match('~~u',$Zc))$n='File must be in UTF-8 encoding.';else{cookie("adminer_import","output=".urlencode($ya["output"])."&format=".urlencode($_POST["separator"]));$G=true;$rb=array_keys($p);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$Zc,$Je);$za=count($Je[0]);$m->begin();$L=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$J=array();foreach($Je[0]as$y=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$L]*)$L~",$X.$L,$Ke);if(!$y&&!array_diff($Ke[1],$rb)){$rb=$Ke[1];$za--;}else{$N=array();foreach($Ke[1]as$s=>$nb)$N[idf_escape($rb[$s])]=($nb==""&&$p[$rb[$s]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$nb))));$J[]=$N;}}$G=(!$J||$m->insertUpdate($a,$J,$rg));if($G)$G=$m->commit();queries_redirect(remove_from_uri("page"),lang(array('%d row has been imported.','%d rows have been imported.'),$za),$G);$m->rollback();}}}$Wh=$b->tableName($R);if(is_ajax()){page_headers();ob_start();}else
page_header('Select'.": $Wh",$n);$N=null;if(isset($Zg["insert"])||!support("table")){$N="";foreach((array)$_GET["where"]as$X){if($kd[$X["col"]]&&count($kd[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$N.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($R,$N);if(!$f&&support("table"))echo"<p class='error'>".'Unable to select the table'.($p?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($K,$f);$b->selectSearchPrint($Z,$f,$w);$b->selectOrderPrint($Ff,$f,$w);$b->selectLimitPrint($z);$b->selectLengthPrint($ki);$b->selectActionPrint($w);echo"</form>\n";$D=$_GET["page"];if($D=="last"){$nd=$g->result(count_rows($a,$Z,$ee,$td));$D=floor(max(0,$nd-1)/$z);}$lh=$K;$ud=$td;if(!$lh){$lh[]="*";$Gb=convert_fields($f,$p,$K);if($Gb)$lh[]=substr($Gb,2);}foreach($K
as$y=>$X){$o=$p[idf_unescape($X)];if($o&&($Ga=convert_field($o)))$lh[$y]="$Ga AS $X";}if(!$ee&&$Oi){foreach($Oi
as$y=>$X){$lh[]=idf_escape($y);if($ud)$ud[]=idf_escape($y);}}$G=$m->select($a,$lh,$Z,$ud,$Ff,$z,$D,true);if(!$G)echo"<p class='error'>".error()."\n";else{if($x=="mssql"&&$D)$G->seek($z*$D);$xc=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$J=array();while($I=$G->fetch_assoc()){if($D&&$x=="oracle")unset($I["RNUM"]);$J[]=$I;}if($_GET["page"]!="last"&&$z!=""&&$td&&$ee&&$x=="sql")$nd=$g->result(" SELECT FOUND_ROWS()");if(!$J)echo"<p class='message'>".'No rows.'."\n";else{$Qa=$b->backwardKeys($a,$Wh);echo"<div class='scrollable'>","<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$td&&$K?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".'Modify'."</a>");$df=array();$qd=array();reset($K);$Fg=1;foreach($J[0]as$y=>$X){if(!isset($Oi[$y])){$X=$_GET["columns"][key($K)];$o=$p[$K?($X?$X["col"]:current($K)):$y];$B=($o?$b->fieldName($o,$Fg):($X["fun"]?"*":$y));if($B!=""){$Fg++;$df[$y]=$B;$e=idf_escape($y);$Hd=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($y);$cc="&desc%5B0%5D=1";echo"<th>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Hd.($Ff[0]==$e||$Ff[0]==$y||(!$Ff&&$ee&&$td[0]==$e)?$cc:'')).'">';echo
apply_sql_function($X["fun"],$B)."</a>";echo"<span class='column hidden'>","<a href='".h($Hd.$cc)."' title='".'descending'."' class='text'> â†“</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.'Search'.'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($y)."');");}echo"</span>";}$qd[$y]=$X["fun"];next($K);}}$_e=array();if($_GET["modify"]){foreach($J
as$I){foreach($I
as$y=>$X)$_e[$y]=max($_e[$y],min(40,strlen(utf8_decode($X))));}}echo($Qa?"<th>".'Relations':"")."</thead>\n";if(is_ajax()){if($z%2==1&&$D%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($J,$kd)as$cf=>$I){$Li=unique_array($J[$cf],$w);if(!$Li){$Li=array();foreach($J[$cf]as$y=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$y))$Li[$y]=$X;}}$Mi="";foreach($Li
as$y=>$X){if(($x=="sql"||$x=="pgsql")&&preg_match('~char|text|enum|set~',$p[$y]["type"])&&strlen($X)>64){$y=(strpos($y,'(')?$y:idf_escape($y));$y="MD5(".($x!='sql'||preg_match("~^utf8~",$p[$y]["collation"])?$y:"CONVERT($y USING ".charset($g).")").")";$X=md5($X);}$Mi.="&".($X!==null?urlencode("where[".bracket_escape($y)."]")."=".urlencode($X):"null%5B%5D=".urlencode($y));}echo"<tr".odd().">".(!$td&&$K?"":"<td>".checkbox("check[]",substr($Mi,1),in_array(substr($Mi,1),(array)$_POST["check"])).($ee||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Mi)."' class='edit'>".'edit'."</a>"));foreach($I
as$y=>$X){if(isset($df[$y])){$o=$p[$y];$X=$m->value($X,$o);if($X!=""&&(!isset($xc[$y])||$xc[$y]!=""))$xc[$y]=(is_mail($X)?$df[$y]:"");$_="";if(preg_match('~blob|bytea|raw|file~',$o["type"])&&$X!="")$_=ME.'download='.urlencode($a).'&field='.urlencode($y).$Mi;if(!$_&&$X!==null){foreach((array)$kd[$y]as$q){if(count($kd[$y])==1||end($q["source"])==$y){$_="";foreach($q["source"]as$s=>$Ch)$_.=where_link($s,$q["target"][$s],$J[$cf][$Ch]);$_=($q["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($q["db"]),ME):ME).'select='.urlencode($q["table"]).$_;if($q["ns"])$_=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($q["ns"]),$_);if(count($q["source"])==1)break;}}}if($y=="COUNT(*)"){$_=ME."select=".urlencode($a);$s=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Li))$_.=where_link($s++,$W["col"],$W["val"],$W["op"]);}foreach($Li
as$je=>$W)$_.=where_link($s++,$je,$W);}$X=select_value($X,$_,$o,$ki);$t=h("val[$Mi][".bracket_escape($y)."]");$Y=$_POST["val"][$Mi][bracket_escape($y)];$sc=!is_array($I[$y])&&is_utf8($X)&&$J[$cf][$y]==$I[$y]&&!$qd[$y];$ji=preg_match('~text|lob~',$o["type"]);echo"<td id='$t'";if(($_GET["modify"]&&$sc)||$Y!==null){$yd=h($Y!==null?$Y:$I[$y]);echo">".($ji?"<textarea name='$t' cols='30' rows='".(substr_count($I[$y],"\n")+1)."'>$yd</textarea>":"<input name='$t' value='$yd' size='$_e[$y]'>");}else{$Ee=strpos($X,"<i>â€¦</i>");echo" data-text='".($Ee?2:($ji?1:0))."'".($sc?"":" data-warning='".h('Use edit link to modify this value.')."'").">$X</td>";}}}if($Qa)echo"<td>";$b->backwardKeysPrint($Qa,$J[$cf]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($J||$D){$Hc=true;if($_GET["page"]!="last"){if($z==""||(count($J)<$z&&($J||!$D)))$nd=($D?$D*$z:0)+count($J);elseif($x!="sql"||!$ee){$nd=($ee?false:found_rows($R,$Z));if($nd<max(1e4,2*($D+1)*$z))$nd=reset(slow_query(count_rows($a,$Z,$ee,$td)));else$Hc=false;}}$Sf=($z!=""&&($nd===false||$nd>$z||$D));if($Sf){echo(($nd===false?count($J)+1:$nd-$D*$z)>$z?'<p><a href="'.h(remove_from_uri("page")."&page=".($D+1)).'" class="loadmore">'.'Load more data'.'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$z).", '".'Loading'."â€¦');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($J||$D){if($Sf){$Me=($nd===false?$D+(count($J)>=$z?2:1):floor(($nd-1)/$z));echo"<fieldset>";if($x!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".'Page'."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".'Page'."', '".($D+1)."')); return false; };"),pagination(0,$D).($D>5?" â€¦":"");for($s=max(1,$D-4);$s<min($Me,$D+5);$s++)echo
pagination($s,$D);if($Me>0){echo($D+5<$Me?" â€¦":""),($Hc&&$nd!==false?pagination($Me,$D):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Me'>".'last'."</a>");}}else{echo"<legend>".'Page'."</legend>",pagination(0,$D).($D>1?" â€¦":""),($D?pagination($D,$D):""),($Me>$D?pagination($D+1,$D).($Me>$D+1?" â€¦":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".'Whole result'."</legend>";$hc=($Hc?"":"~ ").$nd;echo
checkbox("all",1,0,($nd!==false?($Hc?"":"~ ").lang(array('%d row','%d rows'),$nd):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$hc' : checked); selectCount('selected2', this.checked || !checked ? '$hc' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>Modify</legend><div>
<input type="submit" value="Save"',($_GET["modify"]?'':' title="'.'Ctrl+click on a value to modify it.'.'"'),'>
</div></fieldset>
<fieldset><legend>Selected <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="Edit">
<input type="submit" name="clone" value="Clone">
<input type="submit" name="delete" value="Delete">',confirm(),'</div></fieldset>
';}$ld=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($ld['sql']);break;}}if($ld){print_fieldset("export",'Export'." <span id='selected2'></span>");$Qf=$b->dumpOutput();echo($Qf?html_select("output",$Qf,$ya["output"])." ":""),html_select("format",$ld,$ya["format"])," <input type='submit' name='export' value='".'Export'."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($xc,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".'Import'."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ya["format"],1);echo" <input type='submit' name='import' value='".'Import'."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$vi'>\n","</form>\n",(!$td&&$K?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["variables"])){$O=isset($_GET["status"]);page_header($O?'Status':'Variables');$dj=($O?show_status():show_variables());if(!$dj)echo"<p class='message'>".'No rows.'."\n";else{echo"<table cellspacing='0'>\n";foreach($dj
as$y=>$X){echo"<tr>","<th><code class='jush-".$x.($O?"status":"set")."'>".h($y)."</code>","<td>".h($X);}echo"</table>\n";}}elseif(isset($_GET["script"])){header("Content-Type: text/javascript; charset=utf-8");if($_GET["script"]=="db"){$Th=array("Data_length"=>0,"Index_length"=>0,"Data_free"=>0);foreach(table_status()as$B=>$R){json_row("Comment-$B",h($R["Comment"]));if(!is_view($R)){foreach(array("Engine","Collation")as$y)json_row("$y-$B",h($R[$y]));foreach($Th+array("Auto_increment"=>0,"Rows"=>0)as$y=>$X){if($R[$y]!=""){$X=format_number($R[$y]);json_row("$y-$B",($y=="Rows"&&$X&&$R["Engine"]==($Fh=="pgsql"?"table":"InnoDB")?"~ $X":$X));if(isset($Th[$y]))$Th[$y]+=($R["Engine"]!="InnoDB"||$y!="Data_free"?$R[$y]:0);}elseif(array_key_exists($y,$R))json_row("$y-$B");}}}foreach($Th
as$y=>$X)json_row("sum-$y",format_number($X));json_row("");}elseif($_GET["script"]=="kill")$g->query("KILL ".number($_POST["kill"]));else{foreach(count_tables($b->databases())as$l=>$X){json_row("tables-$l",$X);json_row("size-$l",db_size($l));}json_row("");}exit;}else{$ci=array_merge((array)$_POST["tables"],(array)$_POST["views"]);if($ci&&!$n&&!$_POST["search"]){$G=true;$Re="";if($x=="sql"&&$_POST["tables"]&&count($_POST["tables"])>1&&($_POST["drop"]||$_POST["truncate"]||$_POST["copy"]))queries("SET foreign_key_checks = 0");if($_POST["truncate"]){if($_POST["tables"])$G=truncate_tables($_POST["tables"]);$Re='Tables have been truncated.';}elseif($_POST["move"]){$G=move_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Re='Tables have been moved.';}elseif($_POST["copy"]){$G=copy_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Re='Tables have been copied.';}elseif($_POST["drop"]){if($_POST["views"])$G=drop_views($_POST["views"]);if($G&&$_POST["tables"])$G=drop_tables($_POST["tables"]);$Re='Tables have been dropped.';}elseif($x!="sql"){$G=($x=="sqlite"?queries("VACUUM"):apply_queries("VACUUM".($_POST["optimize"]?"":" ANALYZE"),$_POST["tables"]));$Re='Tables have been optimized.';}elseif(!$_POST["tables"])$Re='No tables.';elseif($G=queries(($_POST["optimize"]?"OPTIMIZE":($_POST["check"]?"CHECK":($_POST["repair"]?"REPAIR":"ANALYZE")))." TABLE ".implode(", ",array_map('idf_escape',$_POST["tables"])))){while($I=$G->fetch_assoc())$Re.="<b>".h($I["Table"])."</b>: ".h($I["Msg_text"])."<br>";}queries_redirect(substr(ME,0,-1),$Re,$G);}page_header(($_GET["ns"]==""?'Database'.": ".h(DB):'Schema'.": ".h($_GET["ns"])),$n,true);if($b->homepage()){if($_GET["ns"]!==""){echo"<h3 id='tables-views'>".'Tables and views'."</h3>\n";$bi=tables_list();if(!$bi)echo"<p class='message'>".'No tables.'."\n";else{echo"<form action='' method='post'>\n";if(support("table")){echo"<fieldset><legend>".'Search data in tables'." <span id='selected2'></span></legend><div>","<input type='search' name='query' value='".h($_POST["query"])."'>",script("qsl('input').onkeydown = partialArg(bodyKeydown, 'search');","")," <input type='submit' name='search' value='".'Search'."'>\n","</div></fieldset>\n";if($_POST["search"]&&$_POST["query"]!=""){$_GET["where"][0]["op"]="LIKE %%";search_tables();}}echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^(tables|views)\[/);",""),'<th>'.'Table','<td>'.'Engine'.doc_link(array('sql'=>'storage-engines.html')),'<td>'.'Collation'.doc_link(array('sql'=>'charset-charsets.html','mariadb'=>'supported-character-sets-and-collations/')),'<td>'.'Data Length'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-admin.html#FUNCTIONS-ADMIN-DBOBJECT','oracle'=>'REFRN20286')),'<td>'.'Index Length'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-admin.html#FUNCTIONS-ADMIN-DBOBJECT')),'<td>'.'Data Free'.doc_link(array('sql'=>'show-table-status.html')),'<td>'.'Auto Increment'.doc_link(array('sql'=>'example-auto-increment.html','mariadb'=>'auto_increment/')),'<td>'.'Rows'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'catalog-pg-class.html#CATALOG-PG-CLASS','oracle'=>'REFRN20286')),(support("comment")?'<td>'.'Comment'.doc_link(array('sql'=>'show-table-status.html','pgsql'=>'functions-info.html#FUNCTIONS-INFO-COMMENT-TABLE')):''),"</thead>\n";$S=0;foreach($bi
as$B=>$T){$gj=($T!==null&&!preg_match('~table~i',$T));$t=h("Table-".$B);echo'<tr'.odd().'><td>'.checkbox(($gj?"views[]":"tables[]"),$B,in_array($B,$ci,true),"","","",$t),'<th>'.(support("table")||support("indexes")?"<a href='".h(ME)."table=".urlencode($B)."' title='".'Show structure'."' id='$t'>".h($B).'</a>':h($B));if($gj){echo'<td colspan="6"><a href="'.h(ME)."view=".urlencode($B).'" title="'.'Alter view'.'">'.(preg_match('~materialized~i',$T)?'Materialized view':'View').'</a>','<td align="right"><a href="'.h(ME)."select=".urlencode($B).'" title="'.'Select data'.'">?</a>';}else{foreach(array("Engine"=>array(),"Collation"=>array(),"Data_length"=>array("create",'Alter table'),"Index_length"=>array("indexes",'Alter indexes'),"Data_free"=>array("edit",'New item'),"Auto_increment"=>array("auto_increment=1&create",'Alter table'),"Rows"=>array("select",'Select data'),)as$y=>$_){$t=" id='$y-".h($B)."'";echo($_?"<td align='right'>".(support("table")||$y=="Rows"||(support("indexes")&&$y!="Data_length")?"<a href='".h(ME."$_[0]=").urlencode($B)."'$t title='$_[1]'>?</a>":"<span$t>?</span>"):"<td id='$y-".h($B)."'>");}$S++;}echo(support("comment")?"<td id='Comment-".h($B)."'>":"");}echo"<tr><td><th>".sprintf('%d in total',count($bi)),"<td>".h($x=="sql"?$g->result("SELECT @@default_storage_engine"):""),"<td>".h(db_collation(DB,collations()));foreach(array("Data_length","Index_length","Data_free")as$y)echo"<td align='right' id='sum-$y'>";echo"</table>\n","</div>\n";if(!information_schema(DB)){echo"<div class='footer'><div>\n";$aj="<input type='submit' value='".'Vacuum'."'> ".on_help("'VACUUM'");$Bf="<input type='submit' name='optimize' value='".'Optimize'."'> ".on_help($x=="sql"?"'OPTIMIZE TABLE'":"'VACUUM OPTIMIZE'");echo"<fieldset><legend>".'Selected'." <span id='selected'></span></legend><div>".($x=="sqlite"?$aj:($x=="pgsql"?$aj.$Bf:($x=="sql"?"<input type='submit' value='".'Analyze'."'> ".on_help("'ANALYZE TABLE'").$Bf."<input type='submit' name='check' value='".'Check'."'> ".on_help("'CHECK TABLE'")."<input type='submit' name='repair' value='".'Repair'."'> ".on_help("'REPAIR TABLE'"):"")))."<input type='submit' name='truncate' value='".'Truncate'."'> ".on_help($x=="sqlite"?"'DELETE'":"'TRUNCATE".($x=="pgsql"?"'":" TABLE'")).confirm()."<input type='submit' name='drop' value='".'Drop'."'>".on_help("'DROP TABLE'").confirm()."\n";$k=(support("scheme")?$b->schemas():$b->databases());if(count($k)!=1&&$x!="sqlite"){$l=(isset($_POST["target"])?$_POST["target"]:(support("scheme")?$_GET["ns"]:DB));echo"<p>".'Move to other database'.": ",($k?html_select("target",$k,$l):'<input name="target" value="'.h($l).'" autocapitalize="off">')," <input type='submit' name='move' value='".'Move'."'>",(support("copy")?" <input type='submit' name='copy' value='".'Copy'."'> ".checkbox("overwrite",1,$_POST["overwrite"],'overwrite'):""),"\n";}echo"<input type='hidden' name='all' value=''>";echo
script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^(tables|views)\[/));".(support("table")?" selectCount('selected2', formChecked(this, /^tables\[/) || $S);":"")." }"),"<input type='hidden' name='token' value='$vi'>\n","</div></fieldset>\n","</div></div>\n";}echo"</form>\n",script("tableCheck();");}echo'<p class="links"><a href="'.h(ME).'create=">'.'Create table'."</a>\n",(support("view")?'<a href="'.h(ME).'view=">'.'Create view'."</a>\n":"");if(support("routine")){echo"<h3 id='routines'>".'Routines'."</h3>\n";$dh=routines();if($dh){echo"<table cellspacing='0'>\n",'<thead><tr><th>'.'Name'.'<td>'.'Type'.'<td>'.'Return type'."<td></thead>\n";odd('');foreach($dh
as$I){$B=($I["SPECIFIC_NAME"]==$I["ROUTINE_NAME"]?"":"&name=".urlencode($I["ROUTINE_NAME"]));echo'<tr'.odd().'>','<th><a href="'.h(ME.($I["ROUTINE_TYPE"]!="PROCEDURE"?'callf=':'call=').urlencode($I["SPECIFIC_NAME"]).$B).'">'.h($I["ROUTINE_NAME"]).'</a>','<td>'.h($I["ROUTINE_TYPE"]),'<td>'.h($I["DTD_IDENTIFIER"]),'<td><a href="'.h(ME.($I["ROUTINE_TYPE"]!="PROCEDURE"?'function=':'procedure=').urlencode($I["SPECIFIC_NAME"]).$B).'">'.'Alter'."</a>";}echo"</table>\n";}echo'<p class="links">'.(support("procedure")?'<a href="'.h(ME).'procedure=">'.'Create procedure'.'</a>':'').'<a href="'.h(ME).'function=">'.'Create function'."</a>\n";}if(support("sequence")){echo"<h3 id='sequences'>".'Sequences'."</h3>\n";$rh=get_vals("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = current_schema() ORDER BY sequence_name");if($rh){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."</thead>\n";odd('');foreach($rh
as$X)echo"<tr".odd()."><th><a href='".h(ME)."sequence=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."sequence='>".'Create sequence'."</a>\n";}if(support("type")){echo"<h3 id='user-types'>".'User types'."</h3>\n";$Yi=types();if($Yi){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."</thead>\n";odd('');foreach($Yi
as$X)echo"<tr".odd()."><th><a href='".h(ME)."type=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."type='>".'Create type'."</a>\n";}if(support("event")){echo"<h3 id='events'>".'Events'."</h3>\n";$J=get_rows("SHOW EVENTS");if($J){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."<td>".'Schedule'."<td>".'Start'."<td>".'End'."<td></thead>\n";foreach($J
as$I){echo"<tr>","<th>".h($I["Name"]),"<td>".($I["Execute at"]?'At given time'."<td>".$I["Execute at"]:'Every'." ".$I["Interval value"]." ".$I["Interval field"]."<td>$I[Starts]"),"<td>$I[Ends]",'<td><a href="'.h(ME).'event='.urlencode($I["Name"]).'">'.'Alter'.'</a>';}echo"</table>\n";$Fc=$g->result("SELECT @@event_scheduler");if($Fc&&$Fc!="ON")echo"<p class='error'><code class='jush-sqlset'>event_scheduler</code>: ".h($Fc)."\n";}echo'<p class="links"><a href="'.h(ME).'event=">'.'Create event'."</a>\n";}if($bi)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}}}page_footer();