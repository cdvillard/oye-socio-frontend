{*
<!-- <h2>Amigos</h2>
<ul>
{foreach $friends as $friend}
    <li>{$friend}</li>
{/foreach}
</ul>
</ul> -->
*}

<font size="30px">Oye Socio! ⇝ Perfil</font>{space30}

<font color="red">
<b>{$firstName} {$lastName}</b>{space30}
</font>

<center><h2>Mensajes</h2></center>
{*

    <!-- <tr><td> -->
    <!-- {$post->content}{space10} -->


    <!-- another for loop for that assoc array object -->
    <!-- reply link -->
<!-- </td></tr> -->
*}


{foreach $posts as $post}
<div style="background:#bad7ff; padding:1em; padding-bottom:0.5em; border:5px;">

    <b>{$post->content}</b>
        <p style="text-align:right; padding-right:1em;">{link href="oyesocio respuesta {$post->id} TU MENSAJE" body="Por favor remplace TU MENSAJE con lo que quiere decir en su respuesta" caption="Respuesta"}{space10}</p>
    </div>
        {foreach $comments[$post@index] as $comment}
        <div style="background:#D9E9FF; padding:1em; margin-left:1em; border:1px;">{$comment->content}</div>
    {/foreach}

{/foreach}






{space30}
