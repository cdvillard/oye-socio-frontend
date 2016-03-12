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

		// print_r("This user's user ID is ".$user;Id);
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
}
