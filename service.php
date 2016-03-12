<?php

// use Goutte\Client; // UNCOMMENT TO USE THE CRAWLER OR DELETE

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
		/* UNCOMMENT TO USE THE CRAWLER OR DELETE
		// create a new client
		$client = new Client();
		$guzzle = $client->getClient();
		$guzzle->setDefaultOption('verify', false);
		$client->setClient($guzzle);

		// create a crawler
		$crawler = $client->request('GET', "https://google.com");

		// search for result
		$result = $crawler->filter('.health-topic-boost-wrapper')->text();
		*/
		//POST statement



// further processing ....
// if ($server_output == "OK") { ... } else { ... }


		// // GET statement
		// $user = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/1");
		// $user = json_decode($user);
		// print_r("This user's email is ".$user);
		// exit;



		// create a json object to send to the template
		$responseContent = array(
			"var_one" => "hello",
			"var_two" => "world",
			"var_three" => 23
		);

		// create the response

		$response = new Response();

		// file_get_contents()
		// jsondecode
		// (print_r) to see results
		// call REST API to find email /api/users/{email or id}/ - GET
		// Request.subject, Request.email
		// Request.body
		// subject is easier because you don't have to get rid of signatures
		//
		// A very simple PHP example that sends a HTTP POST to a remote site
		//
		//after the

		$email = Request.email;

		$user = file_get_contents("http://45.79.199.31:2016/OyeSocio/api/users/{$email}");
		$user = json_decode($user);
		// print_r("This user's email is ".$user);
		$userId = ($userId);
		print_r("This user's user ID is ".$userId);



		if ($userId === 0) // user does not exist, create a curl to sign up user
		{
			$response->setResponseSubject("OyeSocio - Bienvenido");
			$response->createFromTemplate("signup.tpl", $responseContent);
			//- POST
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL,"http://45.79.199.31:2016/OyeSocio/api/users"); // which URL you'll go to
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "firstName=Yami&lastName=Medina&email=yamilethmedina1@gmail.com"); // parameters that will append to url


			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$server_output = curl_exec ($ch);


			curl_close ($ch);
			print_r($server_output);
			// exit;
		}
		else
		{
			// send back newsfeed based on id
			// /api/posts/user/{userid}/
			// function that looks at friends and shows all friends post
			// show in order of latest created posts? (time stamp for post)

			$response->setResponseSubject("OyeSocio - Tu Noticias");
			$response->createFromTemplate("newsfeed.tpl", $responseContent);
		// }
		$response->setResponseSubject("OyeSocio - Bienvenido");
		$response->createFromTemplate("signup.tpl", $responseContent);
		return $response;
	}


	// public function _escribir(Request $request)
	// {
	// 	$responseContent = array(
	// 		"var_one" => "salvi",
	// 		"var_two" => "el mio",
	// 		"var_three" => 45
	// 	);
	//
	// 	// create the response
	// 	$response = new Response();
	// 	$response->setResponseSubject("[RESPONSE_EMAIL_SUBJECT]");
	// 	$response->createFromTemplate("basic.tpl", $responseContent);
	// 	return $response;
	// }
}
