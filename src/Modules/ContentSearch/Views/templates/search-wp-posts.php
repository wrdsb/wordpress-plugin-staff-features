<?php
use WRDSB\Staff\Modules\ContentSearch\Model\ContentSearch as ContentSearch;

$visibility_groups =['staff.wrdsb.ca:members'];

$user_sites = get_blogs_of_user(get_current_user_id(), false);

foreach ($user_sites as $site) {
    $site_url = str_replace('http://', '', $site->siteurl);
    $site_url = str_replace('https://', '', $site_url);
    $site_url = str_replace('staff-dev.wrdsb.io', 'staff.wrdsb.ca', $site_url);

    $user_obj = new WP_User(get_current_user_id(), $site->userblog_id);

    if ($user_obj->roles[0] == 'administrator') {
        $visibility_group = $site_url.":admins";
    } else {
        $visibility_group = $site_url.":members";
    }
    array_push($visibility_groups, $visibility_group);
}
$visibility_groups_string = implode(", ", $visibility_groups);

$search_query = $wp_query->query_vars['wp-posts-search']      ?? '*';
$skip         = $wp_query->query_vars['wp-posts-search-skip'] ?? 0;
$top          = 25;

$default_sites_filter = "(site_domain eq 'www.wrdsb.ca') or (site_domain eq 'staff.wrdsb.ca')";
if ($wp_query->query_vars['search-filter-site-name']) {
    $sites_filter = "site_name eq '{$wp_query->query_vars['search-filter-site-name']}'";
    $sites_filter_param = $wp_query->query_vars['search-filter-site-name'];
} else {
    $sites_filter = $default_sites_filter;
    $sites_filter_param = false;
}
$visibility_filter = "visible_to/any(g:search.in(g, '{$visibility_groups_string}'))";
$search_filter = "( {$sites_filter} ) and ( {$visibility_filter} )";

$search_params = [];
$search_params['target_url'] = 'https://wrdsb-codex.search.windows.net/indexes/lamson-wp-posts/docs/search?api-version=2016-09-01';
$search_params['api_key']    = WRDSB_CODEX_SEARCH_KEY;

$search_params['count']   = true;
$search_params['filter']  = $search_filter;
$search_params['facets']  = ['site_name'];
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

if ($sites_filter_param) {
    $sites_filter_param = '&search-filter-site-name='.$sites_filter_param;
    
    $first_page_link     .= $sites_filter_param;
    $previous2_page_link .= $sites_filter_param;
    $previous1_page_link .= $sites_filter_param;
    $next1_page_link     .= $sites_filter_param;
    $next2_page_link     .= $sites_filter_param;
    $last_page_link      .= $sites_filter_param;
}
?>

<?php get_header(); ?>

<div class="container container-top">
    <?php
        get_template_part('partials/header', 'masthead');
        get_template_part('partials/header', 'navbar');
    ?>
    <div class="container container-breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo get_option('home'); ?>">Home</a>
            </li>
            <li>
                Search
            </li>
        </ol>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8 col-lg-8" role="main">
            <!-- CONTENT -->
            <h1>You searched for: <?php echo $search_query; ?></h1>
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
            <!-- CONTENT -->
        </div> <!-- end content area -->

        <div class="col-sm-4 col-lg-4" role="complementary">
            <strong><?php echo $search->totalResults; ?></strong> results visible to you on 
            <?php if ($sites_filter_param) { ?>
                <strong><?php echo urldecode($wp_query->query_vars['search-filter-site-name']); ?></strong>.

                <div class="sub-menu-heading">Filter Results</div>
                <p><a href="/search/content/?wp-posts-search=<?php echo $search_query; ?>">Include all sites</a></p>
            <?php } else { ?>
                <strong>all sites</strong>.

                <div class="sub-menu-heading">Filter Results</div>
                <?php foreach ($search->rawResponse->{'@search.facets'}->site_name as $facet) {
                    $filtered_link = $first_page_link . '&search-filter-site-name=' . urlencode($facet->value);
                    echo '<p><a href="'.$filtered_link.'">'. $facet->value .'</a> ('. $facet->count .')</p>';
                } ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer();
