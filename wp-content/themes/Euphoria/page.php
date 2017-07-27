<?php get_header(); ?>

<?php
	if(have_posts()) : while(have_posts()) : the_post();
?>

  <section class="page-topo">
      <div class="content">
      <h3><?php the_title();?></h3><!--TITULO DA PAGINA-->
        <p>
		<?php the_content(); ?>
        </p>
       
      </div>

  </section>

<?php
	endwhile;
	else:
?>
<p>Nenhum post encontrado!</p>

<?php
	endif;
?>


<?php get_footer(); ?>