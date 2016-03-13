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
		// show news feed to existing users
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

	public function _escribir(Request $request)
	{
		$query = $request->query;
		// need fix for content with accents - replace accented chars
		$query = str_replace("á", "a", $query);
		$query = str_replace("é", "e", $query);
		$query = str_replace("í", "i", $query);
		$query = str_replace("ó", "o", $query);
		$query = str_replace("ú", "u", $query);
		$query = str_replace("ñ", "n", $query);
		$query = str_replace("ü", "u", $query);
		$query = str_replace("¡", "!", $query);
		$query = str_replace("¿", "?", $query);
		$query = str_replace("Á", "A", $query);
		$query = str_replace("É", "E", $query);
		$query = str_replace("Í", "I", $query);
		$query = str_replace("Ó", "O", $query);
		$query = str_replace("Ê", "E", $query);
		$query = str_replace("Ú", "U", $query);
		$query = str_replace("Ü", "U", $query);
		$query = str_replace("Ñ", "N", $query);

		// die("$postId - $content");
		// exit;
		$email = $request->email;

		$user = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/{$email}/");
		$user = json_decode($user);
		$userId = ($user->id);

		// save using the API
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://45.79.199.31:2016/OyeSocio/api/posts"); // which URL you'll go to
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "userId={$userId}&content={$query}"); // parameters that will append to url
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		// print_r($server_output);

		// create the response
		$response = new Response();
		$response->setResponseSubject("Que acaba de escribir un post!");
		$response->createFromText("Puede ver la publicación en su perfil.");
		return $response;


	}

	public function _respuesta(Request $request)
	{
		$query = explode(" ", $request->query);
		$postId = $query[0];
		unset($query[0]);
		$content = implode(" ", $query);
		// need fix for content with accents - replace accented chars
		$content = str_replace("á", "a", $content);
		$content = str_replace("é", "e", $content);
		$content = str_replace("í", "i", $content);
		$content = str_replace("ó", "o", $content);
		$content = str_replace("ú", "u", $content);
		$content = str_replace("ñ", "n", $content);
		$content = str_replace("ü", "u", $content);
		$content = str_replace("¡", "!", $content);
		$content = str_replace("¿", "?", $content);
		$content = str_replace("Á", "A", $content);
		$content = str_replace("É", "E", $content);
		$content = str_replace("Í", "I", $content);
		$content = str_replace("Ó", "O", $content);
		$content = str_replace("Ê", "E", $content);
		$content = str_replace("Ú", "U", $content);
		$content = str_replace("Ü", "U", $content);
		$content = str_replace("Ñ", "N", $content);
		// die("$postId - $content");
		// exit;
		$email = $request->email;

		$user = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/{$email}/");
		$user = json_decode($user);
		$userId = ($user->id);

		// save using the API
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://45.79.199.31:2016/OyeSocio/api/comments"); // which URL you'll go to
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "userId={$userId}&postId={$postId}&content={$content}"); // parameters that will append to url
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		// print_r($server_output);

		// create the response
		$response = new Response();
		$response->setResponseSubject("Su respuesta fue publicada!");
		$response->createFromText("Tu comentario ha sido publicado correctamente.");
		return $response;


	}

	public function _perfil(Request $request)
	{
		$email = $request->email;

		// $email = "test@test.com";


		$user = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/{$email}/");
		// $user = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/1/");
		$user = json_decode($user);
		$userId = ($user->id);

		$firstName = ($user->firstName);
		$lastName = ($user->lastName);

		// $posts = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/posts/user/1/");
		$posts = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/posts/user/{$userId}/");
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
		$commentList = [];
		$postComments = array();

		foreach ($posts as $post) {
			$postComments = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/comments/post/{$post->id}");
			// $posts = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/comments/post/1/");
			$postComments = json_decode($postComments);
			//foreach comment in $postComments
			$postCommentArray[$post->id] = array($post, $postComments);
			// append comment to commentArray
			array_unshift($commentList, $postComments);
			// print_r($postCommentArray[$post->id]);
		}
		// echo ($commentList);
		// exit;

		//Add names of comment authors to comment objects
		foreach ($commentList as $commentArray) {
			//Double foreach loops because each post as an array of comments)
			foreach($commentArray as $comment) {
				$commentAuthorData = json_decode(file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/{$comment->userId}"));
				$comment->author = $commentAuthorData->firstName." ".$commentAuthorData->lastName;
				// print_r($comment);
			}
			//Result in this scope available as $commentArray

			//array_push($postComments, $commentArray);

		}
		// print_r($postComments);
		// exit;
		//Result in this scope available as $commentList


		$profileInfo = array(
			"firstName" => $firstName,
			"lastName" => $lastName,
			"posts" => $orderedArray,
			"postCommentMap" => $postCommentArray,
			"comments" => $commentList['commentArray']
		);

	//	create the response
		$response = new Response();
		$response->setResponseSubject("Perfil!");
		$response->createFromTemplate("profile.tpl", $profileInfo);
		return $response;
	}

	public function _newsfeed(Request $request)
	{


		//USE THE FOLLOWING $email VARIABLE FOR LIVE PRODUCTION - Charles
		//$email = $request->email;
		//THIS $email VARIABLE IS EXACTLTY WHAT IT STATES: FOR TESTING - Charles
		$email = "test@test.com";

		$user = json_decode(file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/".$email."/"));

		$userId= $user->id;

		$friends = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/friends/user/".$userId."/");
		$friends = json_decode($friends);

		$newsFeed = array();

		foreach ($friends as $friend) {
			$posts = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/posts/user/".$friend->friendId."/");
			$postAuthorData = json_decode(file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/".$friend->friendId));
			$post = json_decode($posts)[0];
			$post->person = $postAuthorData->firstName." ".$postAuthorData->lastName;
			array_push($newsFeed, $post);
		}

		// BELOW is the original implementation for adding post authors' names to objects.
		// $postAuthors = array();
		//
		// foreach ($newsFeed as $post) {
		// 	$postAuthorData = json_decode(file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/".$post->userId));
		// 	$postAuthorName = $postAuthorData->firstName." ".$postAuthorData->lastName;
		// 	array_push($postAuthors, $postAuthorName);
		// }
		// print_r($postAuthors);
		// exit;

		// BELOW is the algorithm for adding comments to the post
						// //foreach loop
						// $postCommentArray = [];
						// $commentList = [];
						// $commentAuthors = array();
						//
						// foreach ($posts as $post) {
						// 	$postComments = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/comments/post/{$post->id}");
						// 	// $posts = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/comments/post/1/");
						// 	$postComments = json_decode($postComments);
						// 	//foreach comment in $postComments
						// 	$postCommentArray[$post->id] = array($post, $postComments);
						// 	// append comment to commentArray
						// 	array_unshift($commentList, $postComments);
						// 	// print_r($postCommentArray[$post->id]);
						// }
						// // echo ($commentList);
						// // exit;

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
