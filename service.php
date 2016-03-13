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

		//oldest comments first

		//foreach loop
		$postCommentArray = [];
		$commentArray = [];

		foreach ($posts as $post) {
			$postComments = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/comments/post/{$post->id}");
			// $posts = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/comments/post/1/");
			$postComments = json_decode($postComments);
			// $postCommentArray[$post->id] = array($post, $postComments);
			// append comment to commentArray
			array_unshift($commentArray, $postComments);
			// print_r($postCommentArray[$post->id]);
		}


		$profileInfo = array(
			"firstName" => $firstName,
			"lastName" => $lastName,
			"posts" => $orderedArray,
			"postCommentMap" => $postCommentArray,
			"comments" => $commentArray
		);

	//	create the response
		$response = new Response();
		$response->setResponseSubject("Perfil!");
		$response->createFromTemplate("profile.tpl", $profileInfo);
		return $response;
	}

	public function _newsfeed(Request $request)
	{
		$friends = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/friends/user/1/");
		$friends = json_decode($friends);
		$newsFeed = array();
		foreach ($friends as $friend) {
			$posts = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/posts/user/".$friend->friendId."/");
			array_push($newsFeed, json_decode($posts)[0]);
		}
		// print_r($newsFeed);
		// exit;
		usort($newsFeed, function($a, $b) {
			return $b->id - $a->id;
		});
		// print_r($newsFeed);
		// exit;
		$assocArray["newsFeed"] = $newsFeed;
		//	create the response
			$response = new Response();
			$response->setResponseSubject("Newsfeed");
			$response->createFromTemplate("newsfeed.tpl", $assocArray);
			return $response;
	}
}
