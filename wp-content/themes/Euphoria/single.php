<?php get_header(); ?>
<div class="box-single">
  <section class="section" role="main">
	<div class="post-all col-sm-6"><!--post all-->
                    	<label>NOTÍCIAS</label>
                        
                        <?php query_posts('showposts=4&category_name=noticias');
						while(have_posts()) : the_post();
						?>
                      <section class="post col-sm-12" data-sr="move 50px enter right over 1s no reset">
                        <figure>
                            <?php the_post_thumbnail(); ?>
                         <figcaption>
                            <p><label><?php the_title(); ?></label><br>
                            <?php echo substr(get_the_excerpt(), 0,200); ?>
		            <a href="<?php the_permalink() ?>">Saiba mais</a>
                            </p>
                          </figcaption>
                        </figure>
                      </section><!--/Noticias-->
                      <?php endwhile; ?>
    </div><!--/post all-->
  </section><!-- .section -->
  </div><!--/box-single-->


<?php get_footer(); ?>