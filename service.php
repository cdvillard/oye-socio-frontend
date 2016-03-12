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
		$fullname = explode(" ", $request->query)
		$responseContent = array(
			"nombre" => $fullname[0],
			"apellido" => $fullname[1]
		);

		// create the response
		$response = new Response();
		$response->setResponseSubject("Gracias para registrarse!");
		$response->createFromTemplate("basic.tpl", $responseContent);
		return $response;
	}
}
