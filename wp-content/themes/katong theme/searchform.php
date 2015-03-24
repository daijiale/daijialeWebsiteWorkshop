<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="widget searchForm">
        <input type="text" name="s" placeholder="<?php _e('search the site', 'blogo'); ?>" />
        <input type="submit" name="submit" value="" />
        <div class="clear"></div>
    </div>
</form>