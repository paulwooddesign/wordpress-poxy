<?php //- Pagination // http://goo.gl/njhZ
function poxy_pagination($pages = '', $range = 2) {
     $showitems = ($range * 2)+1;
     
     global $paged;
     if(empty($paged)) $paged = 1;
     
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }
     
     if(1 != $pages)
     {
         echo "<div class='pagination clearfix'><div class='wrap'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<figure><a class='delta' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></figure>";
         
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='delta current'>".$i."</span>":"<a class='delta' href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }
         
         if ($paged < $pages && $showitems < $pages) echo "<a class='delta' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a class='delta' href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div></div>\n";
     }
}
 ?><?php $num_pages = $wp_query->max_num_pages; if($num_pages > 1) : ?><section class="pagination"><div class="sw"><div class="cw"><?php poxy_pagination(); ?></div></div></section><?php endif; ?>