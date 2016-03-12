<?php


class OyeSocio extends Service
{
	/**
	 * Function executed when the service is called
	 *
	 * @param Request
	 * @return Response
	 * */
	public function _main(Request $request)
	{
		// create a json object to send to the template
		$responseContent = array(
			"var_one" => "hello",
			"var_two" => "world",
			"var_three" => 23
		);

		$response = new Response();
		$email = $request->email;

		$user = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/{$email}/");
		$user = json_decode($user);
		$userId = ($user->id);

		// print_r("This user's user ID is ".$userId);
		// exit;
		if ($userId === 0) {
			$response->setResponseSubject("Necesitamos saber su nombre");
			$response->createFromTemplate("signup.tpl", array());
		} else {
	//		$this->sendNewsFeed();
		}

		return $response;
	}

	public function _registrarse(Request $request)
	{
		$email = $request->email;
		// get the name
		$fullname = explode(" ", $request->query);
		$firstName = $fullname[0];
		$lastName = $fullname[1];

		// save using the API
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://45.79.199.31:2016/OyeSocio/api/users"); // which URL you'll go to
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "firstName={$firstName}&lastName={$lastName}&email={$email}"); // parameters that will append to url
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		// print_r($server_output);

		// create the response
		$response = new Response();
		$response->setResponseSubject("Gracias para registrarse!");
		$response->createFromText("El resgisto se ha realizado satisfactoriamente.");
		return $response;
	}

	public function _perfil(Request $request)
	{
		$email = $request->email;

		// $user = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/{$email}/");
		$user = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/1/");
		$user = json_decode($user);
		$userId = ($user->id);

		$firstName = ($user->firstName);
		$lastName = ($user->lastName);

		$posts = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/posts/user/1/");
		// $posts = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/posts/user/{$email}/");
		$posts = json_decode($posts);


		$orderedArray = array();
		// print_r($firstName);
		// exit;
		foreach ($posts as $post) {
		//    $postId = ($post->id);
			array_unshift($orderedArray, $post);

		}



		// associative array
		$profileInfo = [];
		$profileInfo["firstName"] = $firstName;
		$profileInfo["lastName"] = $lastName;
		$profileInfo["posts"] = $orderedArray;



		//oldest comments first

		$postCommentArray = [];

		//foreach loop
		foreach ($posts as $post) {
			$postComments = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/comments/post/"."{$post->id}");
			// $posts = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/comments/post/{$postId}/");
			$postComments = json_decode($postComments);
			$postCommentArray[$post] = $postComments;
		}
		$profileInfo["postCommmentMap"] = $postCommentArray;

		foreach($postCommentMap as $post => $comment) {
  			echo $comment.' is begin with ('.$post.')';
		}

	//	create the response
		$response = new Response();
		$response->setResponseSubject("Perfil!");
		$response->createFromTemplate("profile.tpl", $profileInfo);
		return $response;
	}
}
