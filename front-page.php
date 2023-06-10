<?php
/*
Template name: Page - Full Width
*/
get_header(); ?>

<?php do_action( 'flatsome_before_page' ); ?>


<div id="content" role="main" class="content-area">
	
		<!--START VUE APP-->
		<div id="app">
			<h1>{{title}}</h1>
			<p>{{description}}</p>
			<h2 v-if="newEmployee">New Employees: Please Review Our Latest Announcements</h2>
			<h2 v-else>Announcements:</h2>
			<ul>
				<li v-for="announcement in announcements">{{announcement}}</li>
			</ul>
			<h2>New Team Members</h2>
			<div v-for="team in newTeam" :key="team.id">
				<h3>{{team.name}}</h3>
				<p class="lead">Starts: {{team.startDate}}</p>
				<b>Favorite Song: {{team.favSong}}</b>
			</div>
		</div>

		<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
		<?php endwhile; // end of the loop. ?>
		
</div>

<!--MOUNT APPS-->
<script>
	const mountedApp = app.mount('#app');
</script>

<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
