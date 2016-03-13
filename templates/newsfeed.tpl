<h1>Newsfeed</h1>
<p>Últimos mensajes de tus amigos</p>

{space10}


	{foreach from=$newsFeed item=post}
		{space5}
		<div style="background:#f3f8fa; padding:1em; padding-bottom:0.5em; border-radius: 0.6em; border-left:thick solid #4ea0cb; font-family:Arial; font-size:0.9em;">
			<p style="float:right; font-size:1.5em">{$post->person}</p>
			<div style="width:5em; height:5em; background:gray; margin-bottom:1em;"></div>
			{$post->content}
			<hr style="margin-top:1em; border: solid 1px; border-color:#c9c9c9; color:#c9c9c9: background-color:#c9c9c9;">
			<div style="padding-bottom:0.5em; text-align:right">
					<a href="#" style="text-decoration:none">
							<p style="padding-right:1em; display:inline; color:green; font-size:1.2em;">+1</p>
					</a>
					<p style="padding-right:1em; display:inline; font-size: 1.2em; test-decoration:none;">{link href="oyesocio respuesta {$post->id} TU MENSAJE" body="Por favor remplace TU MENSAJE con lo que quiere decir en su respuesta" caption="Respuesta"}{space10}</p>
					</a>
			</div>
		</div>
		{space15}
{/foreach}

{space15}

<center>
	<p><small>You can use all the power of HTML and Smarty to generate this template.</small></p>
	{button href="AYUDA" caption="La ayuda de Apretaste"}
	{space15}
</center>

{space30}

<p>If you have any questions, please email me at salvi.pascual@gmail.com</p>
