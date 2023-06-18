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
				<li v-for="announcement in announcements">
					<h3>{{announcement.title}}</h3>
					<p>{{announcement.announcement}}</p>
					<div class="category">{{announcement.category}}</div>
				</li>
			</ul>

			<h2>New Team Members</h2>
			<div v-for="newMember in team" :key="newMember.id">
				<h3>{{newMember.name}}</h3>
				<p class="lead">Starts: {{newMember.hire_date}}</p>
				<b>Favorite Song: {{newMember.favorite_song}}</b>
			</div>

			<h2>Team Birthdays & Anniversaries</h2>
			<div v-for="bday in birthdays" :key="bday.id">
				<h3>{{bday.name}}</h3>
				<p class="lead">Starts: {{bday.hire_date}}</p>
				<b>Favorite Song: {{bday.favorite_song}}</b>
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
