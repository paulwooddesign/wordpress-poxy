<?php /**
 * Chimera template for displaying the blog page
 *
 * @package WordPress
 * @subpackage Chimera
 * @since Chimera 1.0
 */
  ?><?php get_template_part( 'part-header' ); ?><?php if (have_posts()): ?><?php while (have_posts()): ?><?php the_post(); ?><section class="article2"><div class="sw"><div class="cw"><div class="poxa12 poxb12 poxc11 poxd11 poxe11"><?php the_content(); ?><script type="text/javascript">var disqus_shortname = 'chimeralighting';
(function () {
  var s = document.createElement('script'); s.async = true;
  s.type = 'text/javascript';
  s.src = '//' + disqus_shortname + '.disqus.com/count.js';
  (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
  }());
  </script><div id="disqus_thread"></div><script type="text/javascript">var disqus_shortname = 'chimeralighting';

/* * * DON'T EDIT BELOW THIS LINE * * */
(function() {
  var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
  dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
  (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
  })();
  </script><noscript>Please enable JavaScript to view the<a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript><a href="http://disqus.com" class="dsq-brlink">comments powered by<span class="logo-disqus">Disqus</span></a></div><div class="rel qoxya14a_14 qoxyb14b_14 poxc11c_14 poxd11d_14 poxe11e_14"><div class="wrap"><div class="poxap11 poxbp11 poxc12 poxd12 poxe11"><h3 class="txa-4 txb-4 txc-4 txd-4 txe-1">Recent Posts</h3><p>A Unique Perspective on the Golden Globes</p><p>A Unique Perspective on the Golden Globes</p><p>A Unique Perspective on the Golden Globes</p><p>A Unique Perspective on the Golden Globes</p><p>A Unique Perspective on the Golden Globes</p><p>A Unique Perspective on the Golden Globes</p></div><div class="rel poxyap11a_p11 poxybp11b_undefined poxyc12c_undefined poxyd12d_undefined poxye11e_undefined"><h3 class="txa-4 mb2-a txb-4 txc-4 txd-4 txe-1">Twitter Feed</h3><a href="https://twitter.com/ChimeraLighting" data-widget-id="466400885237501952" class="mt2 twitter-timeline">Tweets by @ChimeraLighting</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

</script></div></div></div></div></div></section><?php endwhile; ?><?php endif; ?>