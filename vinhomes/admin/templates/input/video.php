<?php if ($url != ''): ?>
	<iframe width="120px" height="100px" src="<?=$url?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
<?php else: ?>
	<video width="150px" height="120px" controls>
	  <source src="<?=str_replace('//', '/', getBaseURL(true).$value['uri'])?>" type="video/mp4">
	</video>
<?php endif ?>