<h1>Newsfeed</h1>
<p>Latest Posts from your friends</p>

{space10}

{foreach from=$newsFeed item=post}
<div>
	{$post->userId}: {$post->person}<br />
	{$post->content}
	{foreach from=$post->comments item=comment}
	<p>{$comment}</p>
	{/foreach}
</div>
{space10}
{/foreach}

{space15}

<center>
	<p><small>You can use all the power of HTML and Smarty to generate this template.</small></p>
	{button href="AYUDA" caption="La ayuda de Apretaste"}
	{space15}
</center>

{space30}

<p>If you have any questions, please email me at salvi.pascual@gmail.com</p>
