<?php if(count(explode("iframe",$information['facebook']))>1):?><?=$information['facebook']?><?php else:?><iframe src="https://www.facebook.com/plugins/page.php?href=<?=urlencode($information['facebook'])?>&tabs=timeline&width=300&height=250&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe><?php endif?>