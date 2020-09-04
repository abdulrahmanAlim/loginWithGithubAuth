<?php
function goToAuthUrl()
{
	$client_id = "64f3aef91ab20d83d23f";
	$redirect_url = "http://localhost/Loginwithgithub2/callback.php";
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$url = 'https://github.com/login/oauth/authorize?client_id=' .$client_id. "&redirect_url=" .$redirect_url.	 
		"&scope=user";
		header("location: $url");
	}
}

function fetchData()
{
	$client_id = "64f3aef91ab20d83d23f";
	$redirect_url = "http://localhost/Loginwithgithub2/callback.php";
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if(isset($_GET['code'])) {
			$code = $_GET['code'];
			$post = http_build_query(array(
					'client_id' => $client_id,
					'redirect_url' => $redirect_url,
					'client_secret' => '61682b5eeda9a7670bcb77efb16e8054eb487dc2',
					'code' => $code,
			));
		}
		$access_data = file_get_contents("https://github.com/login/oauth/access_token?".$post);
		$exploded1 = explode('access_token=', $access_data);
		$exploded2 = explode('&scope=user', $exploded1[1]);
		$access_token = $exploded2[0];

		$opts = ['http' => [
						'method' => 'GET',
						'header' => ['User-Agent: PHP']
				]
		];
		$url = "https://api.github.com/user?access_token=$access_token";
		$context = stream_context_create($opts);
		$data = file_get_contents($url , false , $context);
		$user_data = json_decode($data, true);
		$username = $user_data['login'];

		$url1 = "https://api.github.com/user/emails?access_token=$access_token";
		$emails = file_get_contents($url1 , false , $context);
		$email = json_decode($emails, true);
		$userEmail = $email[0]['email'];

		$userPayLoad = [
			'username' => $username,
			'email' => $userEmail,
			'fetched from' => "github",
		];

		$_SESSION['payload'] = $userPayLoad;
		$_SESSION['user'] = $username;
		$_SESSION['email'] = $userEmail;
 
		return $userPayLoad; 



	}
	else {
		die('error from api');
	}


}

?>