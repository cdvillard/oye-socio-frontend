<font size="30px">Oye Socio! ⇝ Perfil</font>{space30}

<h2>
<b>{$firstName} {$lastName}</b>{space30}
</h2>

<center><h3>Mensajes</h3>
{*

    <!-- <tr><td> -->
    <!-- {$post->content}{space10} -->


    <!-- another for loop for that assoc array object -->
    <!-- reply link -->
<!-- </td></tr> -->
*}

{button href="oyesocio escribir TU MENSAJE" body="Por favor remplace TU MENSAJE con lo qué tienes en su mente!" caption="Escribir un mensaje"}{space30}
</center>


    {foreach from=$posts item=post}
    <!-- post order appearance needs to be reversed  -->
    <div style="background:#f3f8fa; padding:1em; padding-bottom:0.5em; border-radius: 0.6em; border-left:thick solid #4ea0cb; font-family:Arial; font-size:0.9em;">
        <p style="float:right; font-size:1.5em">{$firstName} {$lastName}</p>
        <div style="width:5em; height:5em; background:gray; margin-bottom:1em;"></div>
        <div style="padding:1em; padding-bottom:0.5em; border:5px;">


        <b>{$post->content}</b>
        <hr style="margin-top:1em; border: solid 1px; border-color:#c9c9c9; color:#c9c9c9: background-color:#c9c9c9;">
        <div style="padding-bottom:0.5em; text-align:right">
            <a href="#" style="text-decoration:none">
                <p style="padding-right:1em; display:inline; color:green; font-size:1.2em;">+1</p>
            </a>
            <p style="padding-right:1em; display:inline; font-size: 1.2em; test-decoration:none;">{link href="oyesocio respuesta {$post->id} TU MENSAJE" body="Por favor remplace TU MENSAJE con lo que quiere decir en su respuesta" caption="Respuesta"}{space10}</p>
            </a>
        </div>
        </div>
    </div>

        {foreach from=$post->comments item=comment}
        <div style="background: #f4f4f4; padding:1em; margin-left:2em; margin-top:0.5em; margin-bottom:0.5em; border-radius: 0.6em; border-left: solid darkgray; font-family:Arial; font-size:0.9em">

            <p style="float:right; font-size:1.2em">{$comment->author}</p>
            <div style="width:3em; height:3em; background:gray; margin-bottom:1em;"></div>
            {$comment->content}
            <hr style="margin-top:1em; border: solid 1px; border-color:#c9c9c9; color:#c9c9c9: background-color:#c9c9c9">
            <div style="padding-bottom:0.5em; text-align:right">
                <a href="#" style="text-decoration:none">
                    <p style="padding-right:1em; display:inline; color:green; font-size:1.2em">+1</p>
                </a>


            </div>
        </div>
        {/foreach}


  {/foreach}

{space30}
