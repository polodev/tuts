---
title: custom-post-type-and-fields-watch-learn
layout: post
---

## example of custom post type
~~~bash
book 
  author
  isbn
  publisher
~~~

## Types custom fields and custom post types management plugin

~~~

Add custom fields  
===============
plural - Books , singular - book, slug - books

types
new group - book
  single line field - author
  single line field - year of publishing
  wysiwyg field - description
~~~

## showing in website 
wp-types.com/documentation
~~~html
<?php
$args = ['post_type' => 'books'];
$query = new WP_Query($args);
while($query->have_posts): $query->the_post();
 ?>
 <h2><?php the_title(); ?></h2>
 <ul>
  <li>author <?php echo types_render_field('author', ['raw' => true]) ; ?></li>
  <li>year <?php echo types_render_field('year', ['raw' => true]) ; ?></li>
  <li>isbn <?php echo types_render_field('isbn', ['raw' => true]) ; ?></li>
 </ul>
 <div>
 <?php echo types_render_field('description', ['raw' => false]); ?>
 </div>
 <?php endwhile; ?>
~~~

# custom post types - single page, archive, linking it together 




