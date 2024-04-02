<?php


add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if( is_category() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'post', 'movies');
    $query->set('post_type',$post_type);
    return $query;
    }
}

add_filter( 'show_admin_bar', '__return_false' );
add_action( 'wp_enqueue_scripts', 'beauty_scripts' );

add_action( 'init', function(){
	
	
	add_theme_support( 'post-thumbnails' );
	register_post_type( 'grammar', [
		'label'  => null,
		'labels' => [
			'name'               => 'Grammar', 
			'singular_name'      => 'Grammar', 
			'add_new'            => 'add rule', 
			'add_new_item'       => 'Добавление новый елемент', 
			'edit_item'          => 'Редактор', 
			'new_item'           => 'Новое элемент', 
			'view_item'          => 'Смотреть элемент', 
			'search_items'       => 'Искать элементы', 
			'not_found'          => 'Не найдено', 
			'not_found_in_trash' => 'Не найдено в корзине', 
			'parent_item_colon'  => 'не знаю че такое', 
			'menu_name'          => 'Grammar',
		],
		'public'              => false,
		'show_ui'             => true, 
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-car',
		'supports'            =>[],
		'taxonomies'          => array( 'category' ),

	] );

} );


function add_type_attribute($tag, $handle, $src) {
	
    if ( 'default-script' !== $handle ) {
        return $tag;
    }
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
	 return $tag;
}
add_filter('script_loader_tag', 'add_type_attribute' , 10, 3); 
function beauty_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri().'/assets/mvc/jquery.js', array(), null, true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'beauty-main-css', get_template_directory_uri().'/assets/style.css' ,'',null);

	wp_enqueue_style( 'default-style', get_stylesheet_uri());
	wp_enqueue_script( 'default-script', get_template_directory_uri().'/assets/mvc/Controller.js',array(), null,true );


}


add_action( 'rest_api_init', function(){
	register_rest_route( 'myplug/v2', '/words', array(
		'methods'  => 'GET',
		'callback' => 'myplug_get_words',
	) );
	register_rest_route( 'myplug/v2', '/grammar', array(
		'methods'  => 'GET',
		'callback' => 'myplug_get_grammar',
	) );
	register_rest_route( 'myplug/v2', '/question', array(
		'methods'  => 'GET',
		'callback' => 'myplug_get_question',
	) );
} );
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
function myplug_get_grammar( WP_REST_Request $request){
	$param = $request->get_param( 'id' );
	if($param){
	
		$posts = get_posts(array(
			'orderby'     => 'date',
			'order'       => 'DESC',
			'numberposts' => -1,
			'post_type'   => 'grammar',
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'terms' => $param, 
					'field' => 'term_id',
				)
			)
		)) ;
		
		foreach( $posts as $post ){
			$items[] = array(
				'id'      => $post->ID,
				'title'   => $post->post_title,
				'content'=>$post->post_content,
				'examples'=>CFS()->get( 'examples', $post->ID ),
				'img'=>CFS()->get( 'in_use', $post->ID )
			);
		
	
	}
	
	return $items;
}
	
}
function myplug_get_words( WP_REST_Request $request){
	$param = $request->get_param( 'id' );
	if($param){
		$p =get_post($param);
		return array(array('id'      => $p->ID,
		'title'   => $p->post_title,
		'content'=>$p->post_content));

	}
	else{
		$posts = get_posts( array (
			'post_status' => 'publish',
			'category'=>2
		) ) ;
		
		foreach( $posts as $post ){
			
			$items[] = array(
				'id'      => $post->ID,
				'title'   => $post->post_title,
				'content'=>$post->post_content,
			);
		}
	
		return $items;
	}
	
}
function myplug_get_question( WP_REST_Request $request){
	$param = $request->get_param( 'id' );
	if($param){
		$p =get_post($param);
		return array(array(
		'content'=>$p->post_content));

	}
	else{
		$posts = get_posts( array (
			'post_status' => 'publish',
			'category'=>2
		) ) ;
		
		foreach( $posts as $post ){
			
			$items[] = array(
				'id'      => $post->ID,
				'content'=>$post->post_content,
			);
		}
	
		return $items;
	}
	
}


?>
