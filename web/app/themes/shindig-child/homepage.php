<?php
// Template Name: Home Page
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

		</header>

<?php
$member_group_terms = get_terms( 'schedule_day' );
$member_group_terms = array_reverse($member_group_terms);

    $member_group_terms = array_map(function($member_group_term) {
        try {
            $date = Carbon\Carbon::createFromFormat('Ymd', get_field('schedule_date', 'schedule_day_' . $member_group_term->term_id));
        } catch (InvalidArgumentException $e) {
            return null;
        }
        return (object) [
            'term' => $member_group_term,
            'date' => $date
        ];
    }, $member_group_terms);

    $member_group_terms = array_filter($member_group_terms);

$currentDay = \Carbon\Carbon::now()->subDay();

    $future_member_group_terms = array_filter($member_group_terms, function ($object) use ($currentDay) {
        return $object->date > $currentDay;
    });

    usort($future_member_group_terms, function ($a, $b) {
        if ($a->date === $b->date) return 0;
        return ($a->date > $b->date) ? 1 : -1;
    });

    $future_member_group_terms = array_slice($future_member_group_terms, 0, 3);
?>

<?php

$nextUp = $future_member_group_terms[0];

$member_group_query = new WP_Query( array(
    'post_type' => 'schedule',
    'posts_per_page' => '1',
    'tax_query' => array(
        array(
            'taxonomy' => 'schedule_day',
            'field' => 'slug',
            'terms' => array( $nextUp->term->slug ),
            'operator' => 'IN'
        )
    )
) );

while($member_group_query->have_posts()): $member_group_query->the_post();

?>
<div class="ngj-main-banner">
    <?php the_post_thumbnail('banner'); ?>
    <div class="ngj-main-banner-content">
        <h2><?php echo $nextUp->date->format('jS F Y'); ?></h2>
        <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
    </div>
</div>

<?php endwhile; ?>

<?php

$future = array_slice($future_member_group_terms, 1, 2);

foreach ($future as $term) :
    $member_group_query = new WP_Query( array(
        'post_type' => 'schedule',
        'posts_per_page' => '1',
        'tax_query' => array(
            array(
                'taxonomy' => 'schedule_day',
                'field' => 'slug',
                'terms' => array( $term->term->slug ),
                'operator' => 'IN'
            )
        )
    ) );

while($member_group_query->have_posts()): $member_group_query->the_post();

?>
<div class="ngj-secondary-banners">
    <div class="ngj-main-banner secondary-banner">
        <?php the_post_thumbnail('banner'); ?>
        <div class="ngj-main-banner-content">
            <h2><?php echo $nextUp->date->format('jS F Y'); ?></h2>
            <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
        </div>
    </div>

</div>

<?php

endwhile;

endforeach; ?>

<div class="clearfix"></div>

	<?php while(have_posts()): the_post(); ?>
	<?php if($post->post_content=="") : ?><?php else : ?>
	<div id="main">
		<div id="homepage-content-container">
		<div class="width-container">
			<?php the_content(); ?>
			<div class='clearfix'></div>
		</div><!-- close  .width-container -->
		</div>
	</div><!-- close  #main -->
	<?php endif; ?>
	<?php endwhile; ?>

<?php get_footer(); ?>