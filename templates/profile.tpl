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

<table border="1" style="width:100%; background-color: yellow; border: solid black 1px;">
{foreach $posts as $post}
    <tr><td>
    <b>{$post->content}</b> {link href="oyesocio respuesta {$post->id} TU MENSAJE" body="Por favor remplace TU MENSAJE con lo que quiere decir en su respuesta" caption="Respuesta"}{space10}
    {foreach $comments[$post@index] as $comment}
        {$comment->content}</br></br>
    {/foreach}
    </tr></td>
{/foreach}



</table>



{space30}
