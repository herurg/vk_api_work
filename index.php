<?php
header('Content-type: text/html; charset=utf-8');
$file = './people.txt';

// Пишем содержимое в файл,
// используя флаг FILE_APPEND flag для дописывания содержимого в конец файла
// и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время





$age=16;
$token='';
$city='';
$sex='';
$count=10;
$offset=0;
for ($age=16;$age<71;$age++)
{
	//for ($count=10;$count<1001;$count+=10)
	//{

		$query="https://api.vk.com/method/users.search?city=".$city."&sex=1&age_from=".$age."&age_to=".$age."&access_token=".$token."&count=1000";
		//$offset+=10;
		$search = file_get_contents($query);
		$search = json_decode($search);
		$sizzz=sizeof($search->response);
			for($j=0;$j<sizeof($search->response);$j++)
				{
					$uid=$search->response[$j]->uid;
					//echo "$uid<br>";
					$user_info="https://api.vk.com/method/users.get?uids=".$uid."&fields=bdate,contacts,connections&access_token=".$token;
					//echo "$user_info<br>";
					$user=file_get_contents($user_info);
					$user=json_decode($user);
					//var_dump($user);	
					$person = $user->response[0]->uid.";".$user->response[0]->first_name.";".$user->response[0]->last_name.";".$age.";".$user->response[0]->bdate.";".$user->response[0]->mobile_phone.";".$user->response[0]->home_phone.";".$user->response[0]->skype.";".$user->response[0]->instagram;
					//echo "$person";
					echo "$age   $j   $sizzz";
					file_put_contents($file, "\r\n".$person, FILE_APPEND | LOCK_EX);
				}


	//}
	

}

//$search = file_get_contents('https://api.vk.com/method/users.search?city=424&sex=1&age_from=15&age_to=15');
 //        $u_info = json_decode($u_info);





//https://oauth.vk.com/authorize?client_id=4597577&scope=friends,contacts&redirect_uri=http://localhost/index.//php&display=page&v=5.2.5&response_type=token 

?>