<?php get_header(); ?> 
<div class="row"> 
	<div class="span8"> 
<<<<<<< HEAD
		<h1></h1> 
=======
		<h1>News</h1> 
>>>>>>> cc259aba2809bd9a42aedeef884438f8ec3851a9
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
		<h2>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2> 
		<p><em><?php the_time('l, F jS, Y'); ?></em></p> 
		<hr> <?php endwhile; else: ?> 
				<p><?php _e('Sorry, there are no posts.'); ?></p> 
			<?php endif; ?> 
	</div> 
	<div class="span4"> 
		<?php get_sidebar(); ?> 
	</div>
</div> 
<?php get_footer(); ?>
