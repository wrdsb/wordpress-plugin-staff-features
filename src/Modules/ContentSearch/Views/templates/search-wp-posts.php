<?php
    use WRDSB\Staff\Modules\ContentSearch\Model\ContentSearch as ContentSearch;

    $search_query = $wp_query->query_vars['wp-posts-search']      ?? '*';
    $skip         = $wp_query->query_vars['wp-posts-search-skip'] ?? 0;
    $top          = 25;

    $search_params = [];
    $search_params['target_url'] = 'https://wrdsb-codex.search.windows.net/indexes/lamson-wp-posts/docs/search?api-version=2016-09-01';
    $search_params['api_key']    = WRDSB_CODEX_SEARCH_KEY;

    $search_params['count']   = true;
    $search_params['filter']  = "(site_domain eq 'www.wrdsb.ca') or (site_domain eq 'staff.wrdsb.ca')";
    $search_params['orderby'] = null;
    $search_params['search']  = $search_query;
    $search_params['select']  = '*';
    $search_params['skip']    = $skip;
    $search_params['top']     = $top;

    $search = new ContentSearch($search_params);
    $search->run();

    $results_floor = $skip + 1;
    $results_ceiling = min($skip + $top, $search->totalResults);

    $current_page_number = ($skip / $top) + 1;
    $total_pages         = ceil($search->totalResults / $top);

    $previous2_page_skip = ($current_page_number - 3) * $top;
    $previous1_page_skip = ($current_page_number - 2) * $top;
    $next1_page_skip     = ($current_page_number + 0) * $top;
    $next2_page_skip     = ($current_page_number + 1) * $top;
    $last_page_skip      = ($total_pages - 1) * $top;

    $base_page_link      = "/search/content/?wp-posts-search={$search_query}&wp-posts-search-skip=";
    $first_page_link     = $base_page_link. '0';
    $previous2_page_link = $base_page_link . $previous2_page_skip;
    $previous1_page_link = $base_page_link . $previous1_page_skip;
    $next1_page_link     = $base_page_link . $next1_page_skip;
    $next2_page_link     = $base_page_link . $next2_page_skip;
    $last_page_link      = $base_page_link . $last_page_skip;
?>

<?php get_header();?>

<div id="container">
    <div id="content" role="main">
        <h1>You searched for: <?php echo $search_query; ?></h1>
        <p><?php echo $search->totalResults; ?> total results.</p>
        <?php if ($total_pages > 1) { ?>
            <p>
                <?php if ($current_page_number > 1) { ?>
                    <a href="<?php echo $previous1_page_link; ?>">&lt;</a>&nbsp;&nbsp;&nbsp;
                <?php } ?>

                <?php if ($current_page_number > 1) { ?>
                    &nbsp;<a href="<?php echo $first_page_link; ?>">1</a>&nbsp;
                <?php } ?>

                <?php if ($current_page_number > 4) { ?>
                    &nbsp;...&nbsp;
                <?php } ?>

                <?php if ($current_page_number > 3) { ?>
                    &nbsp;<a href="<?php echo $previous2_page_link; ?>"><?php echo $current_page_number - 2; ?></a>&nbsp;
                <?php } ?>

                <?php if ($current_page_number > 2) { ?>
                    &nbsp;<a href="<?php echo $previous1_page_link; ?>"><?php echo $current_page_number - 1; ?></a>&nbsp;
                <?php } ?>

                &nbsp;<?php echo $current_page_number ?>&nbsp;

                <?php if ($current_page_number < $total_pages - 1) { ?>
                    &nbsp;<a href="<?php echo $next1_page_link; ?>"><?php echo $current_page_number + 1; ?></a>&nbsp;
                <?php } ?>

                <?php if ($current_page_number < $total_pages - 2) { ?>
                    &nbsp;<a href="<?php echo $next2_page_link; ?>"><?php echo $current_page_number + 2; ?></a>&nbsp;
                <?php } ?>

                <?php if ($current_page_number < $total_pages - 3) { ?>
                    &nbsp;...&nbsp;
                <?php } ?>

                <?php if ($current_page_number < $total_pages) { ?>
                    &nbsp;<a href="<?php echo $last_page_link; ?>"><?php echo $total_pages; ?></a>&nbsp;
                <?php } ?>

                <?php if ($current_page_number < $total_pages) { ?>
                    &nbsp;&nbsp;&nbsp;<a href="<?php echo $next1_page_link; ?>">&gt;</a>
                <?php } ?>
            </p>
        <?php } ?>

        <?php foreach ($search->results as $post) { ?>
            <?php
                $excerpt = wpautop($post->post_content);
                $excerpt = apply_filters('the_content', $excerpt);
                $excerpt = str_replace(']]>', ']]&gt;', $excerpt);
                $excerpt = substr($excerpt, strpos($excerpt, '<p>'), strpos($excerpt, '</p>') + 4);
                $excerpt = strip_tags($excerpt);
                if (strlen(preg_replace('/\s+/', '', $excerpt)) < 1) {
                    $excerpt = "[No content or summary provided.]";
                }
            ?>

            <div>
                <p>
                    <strong><a style="text-decoration:none" href="<?php echo $post->post_guid?>"><?php echo $post->post_title ?> | <?php echo $post->site_name; ?></strong></a>
                    <br><?php echo $excerpt; ?>
                    <br><small>Last updated <?php echo date("F j, Y", strtotime($post->post_modified)) .' at '. date("g:i a", strtotime($post->post_modified)); ?></small>
                </p>
            </div>
        <?php } ?>

        <?php if ($total_pages > 1) { ?>
            <p>
                <?php if ($current_page_number > 1) { ?>
                    <a href="<?php echo $previous1_page_link; ?>">&lt;</a>&nbsp;&nbsp;&nbsp;
                <?php } ?>

                <?php if ($current_page_number > 1) { ?>
                    &nbsp;<a href="<?php echo $first_page_link; ?>">1</a>&nbsp;
                <?php } ?>

                <?php if ($current_page_number > 4) { ?>
                    &nbsp;...&nbsp;
                <?php } ?>

                <?php if ($current_page_number > 3) { ?>
                    &nbsp;<a href="<?php echo $previous2_page_link; ?>"><?php echo $current_page_number - 2; ?></a>&nbsp;
                <?php } ?>

                <?php if ($current_page_number > 2) { ?>
                    &nbsp;<a href="<?php echo $previous1_page_link; ?>"><?php echo $current_page_number - 1; ?></a>&nbsp;
                <?php } ?>

                &nbsp;<?php echo $current_page_number ?>&nbsp;

                <?php if ($current_page_number < $total_pages - 1) { ?>
                    &nbsp;<a href="<?php echo $next1_page_link; ?>"><?php echo $current_page_number + 1; ?></a>&nbsp;
                <?php } ?>

                <?php if ($current_page_number < $total_pages - 2) { ?>
                    &nbsp;<a href="<?php echo $next2_page_link; ?>"><?php echo $current_page_number + 2; ?></a>&nbsp;
                <?php } ?>

                <?php if ($current_page_number < $total_pages - 3) { ?>
                    &nbsp;...&nbsp;
                <?php } ?>

                <?php if ($current_page_number < $total_pages) { ?>
                    &nbsp;<a href="<?php echo $last_page_link; ?>"><?php echo $total_pages; ?></a>&nbsp;
                <?php } ?>

                <?php if ($current_page_number < $total_pages) { ?>
                    &nbsp;&nbsp;&nbsp;<a href="<?php echo $next1_page_link; ?>">&gt;</a>
                <?php } ?>
            </p>
        <?php } ?>

    </div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
