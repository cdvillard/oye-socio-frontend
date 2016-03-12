<!-- <h2>Amigos</h2>
<ul>
{foreach $friends as $friend}
    <li>{$friend}</li>
{/foreach}
</ul>


</ul> -->

<font color="red">
<b>{$firstName} {$lastName}</b>{space30}
</font>

<center><h2>Mensajes</h2></center>

<table border="1" style="width:100%; background-color: yellow; border: solid black 1px;">
{foreach $posts as $post}
    <tr><td>
    {$post->content}{space10}
    <!-- list of comments for each post -->
    {foreach $comments as $comment}
        {$postCommmentMap->content}<br />
        {$comment->userId}<br />
    {/foreach}

    <!-- another for loop for that assoc array object -->
    <!-- reply link -->
</td></tr>
{/foreach}

</table>

<!-- <p>{$posts[0]}</p> -->



{space30}

<p>If you have any questions, please email me at salvi.pascual@gmail.com</p>
