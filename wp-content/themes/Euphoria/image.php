<?php get_header(); ?>

  <section class="section-wide" role="main">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article class="article" <?php post_class(); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">

      <header class="post-header">
        <h2 class="post-title"><?php the_title(); ?></h2>
      </header>

      <article class="post-content">

        <img src="<?php echo wp_get_attachment_url( $post->ID ); ?>" alt="<?php the_title(); ?>" class="aligncenter" />

        <article class="attachment-caption"><?php the_excerpt(); ?></article>

        <article class="attachment-desc"><?php the_content(); ?></article>

      </article><!-- .post-content -->

    </article><!-- .article -->

    <?php endwhile; endif; ?>

  </section><!-- .section -->

<?php get_footer(); ?>