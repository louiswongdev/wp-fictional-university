<?php 
  get_header();

  while(have_posts()) {
    the_post(); ?>
    
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
          <p>NEEDS TO BE REPLACED LATER</p>
        </div>
      </div>  
    </div>

    <div class="container container--narrow page-section">

      <?php  
        // check if current page has a parent
        // $theParent will be > 0 if current page is a child page
        $theParent = wp_get_post_parent_id(get_the_ID());
        if ( $theParent ) { ?>
          <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
              <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent) ?>">
                <i class="fa fa-home" aria-hidden="true"></i> 
                  Back to <?php echo get_the_title($theParent); ?>
              </a> <span class="metabox__main"><?php the_title(); ?></span>
            </p>
          </div>
        <?php }
      ?>

      <?php 
      // check to see if page IS a parent
      $hasChildren = get_pages(array(
        'child_of' => get_the_ID()
      ));

      // only display sidebar menu links if current page has a parent page
      // or is a parent 
      if (1 < 2) { ?>      
        <div class="page-links">
          <h2 class="page-links__title">
            <a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a>
          </h2>
          <ul class="min-list">
            <?php 
              // if current page has a parent
              if ($theParent) {
                $findChildrenOf = $theParent;
              } else {
                // page is a parent. If we don't have this check, we'll return links
                // for root of site...which we don't want
                $findChildrenOf = get_the_ID();
              }

              wp_list_pages( array(
                'title_li' => NULL,
                'child_of' => $findChildrenOf,
                'sort_column' => 'menu_order',
              ) ) ?>
          </ul>
        </div>
      <?php } ?>

      <div class="generic-content">
        <?php the_content(); ?>
      </div>

    </div>


  <?php }


  get_footer();
?>