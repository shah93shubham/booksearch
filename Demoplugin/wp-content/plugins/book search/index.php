<?php
/*
  Plugin Name: Book Search
  Plugin URI: http://goolge.com
  Description: Used for search the book from the library.
  Version: 1.0
  Author: Shubham Shah
  Author URI: http://google.com
 */
 
 //creates a book post type
 function create_book_post_type(){
	register_post_type('book',
			array(
				'labels'=> array(
								'name'=> __('Books'),
								'singular_name'=> __('Book'),
								'add_new'=> 'Add New',
								'description'=> __('Short Description'),
								'add_new_item'=> 'Add New Book',
								'edit'=> 'Edit',
								'edit_item'=>'Edit Book',
								'new_item'=> 'New Book',
								'search_items'=> 'Search Books',
								'view'=> 'View',
								'view_item'=> 'View Book',
								'not_found'=> 'No books found.',
								'not_found_in_trash'=> 'No books found in trash.'
							),
				'public'=> true,
				'has_archive'=> true,
				'taxanomies'=> array(''),
				'rewrite'=> array('slug'=> 'book'),
				'supports'=> array('title','editor')
			)
			
			);
}
add_action('init','create_book_post_type');


//this function create custom meta boxes for book
 function my_book(){
	add_meta_box('book_meta_box', 'Book Details', 'display_book_meta_box', 'book', 'normal', 'high');	
}
add_action('admin_init','my_book');
?>


<?php 
	//to dsiplay meta boxes in admin
	function display_book_meta_box($book){
	$book_price= intval(get_post_meta($book->ID,'book_author', true));
	$book_rating= intval(get_post_meta($book->ID, 'book_rating', true));
?>
	<table>
    	<tr>
        	<td>Price</td>
        	<td><input type="text" size="80" name="book_price" value="<?php echo $book_price;?>" /></td>
        
       
            <td>Rating</td>
            <td>
                <select name="book_rating">
                    <?php
                        for($rating=5; $rating >=1; $rating--){
                    ?>
                        <option value="<?php echo $rating; ?>" <?php echo selected( $rating, $book_rating ); ?>>
                        <?php echo $rating; ?> Stars <?php } ?>
                </select>
            </td>
    </tr>
    </table>
   
    
<?php } ?>


<?php 
	//hepls to add fields in book post
	function add_book_fields($book_id, $book){
	if($book-> post_type == 'book'){
		if(isset($_POST['book_price']) && $_POST['book_price'] != ''){
			update_post_meta($book_id, 'book_price', $_POST['book_price']);
		}
		if(isset($_POST['book_rating']) && $_POST['book_rating'] != ''){
			update_post_meta($book_id, 'book_rating', $_POST['book_rating']);
		}
	}
}
add_action('save_post', 'add_book_fields', 10, 2);

//creates custom taxonomy for author
function create_author_taxanomies(){
	register_taxonomy(
		'book_author',
		'book',
		array(
			'labels' => array(
				'name'=> 'Author',
				'add_new_item'=> 'Add New Author',
				'new_item_name'=> 'New Author' 
			),
			'show_ui'=> true,
			'show_tagcloud'=> false,
			'hierarchical'=> true,
			'show_admin_column'=> true
		)
	);
}
add_action('init', 'create_author_taxanomies',0);


//creates custom taxonomy for publisher
function create_publisher_taxanomies(){
	register_taxonomy(
		'book_publisher',
		'book',
		array(
			'labels' => array(
				'name'=> 'Publisher',
				'add_new_item'=> 'Add New Publisher',
				'new_item_name'=> 'New Publisher' 
			),
			'show_ui'=> true,
			'show_tagcloud'=> false,
			'hierarchical'=> true,
			'show_admin_column'=> true
		)
	);
}
add_action('init', 'create_publisher_taxanomies',0);

//Add admin columns to the book
function book_columns($columns){
	$columns['book_price']= 'Price';
	$columns['book_rating']= 'Rating';
	return $columns;
}
add_filter('manage_edit-book_columns', 'book_columns');

//Show data in admin columns of the book
function populate_columns($column){
	if( 'book_price' == $column ){
		$book_price = esc_html(get_post_meta(get_the_ID(), 'book_price', true));
		echo 'Rs. '.$book_price;
	}
	elseif( 'book_rating' == $column ){
		$book_rating = get_post_meta(get_the_ID(), 'book_rating', true);
		echo $book_rating . ' Stars';
	}
}
add_action('manage_posts_custom_column','populate_columns');

// create shortcode to list all books which come in blue
add_shortcode( 'list-book', 'book_listing_shortcode' );
function book_listing_shortcode( $atts ) {
    ob_start();
    $query = new WP_Query( array(
        'post_type' => 'book',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'title',
    ) );
    if ( $query->have_posts() ) { ?>
        <div class="book-listing">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
            <?php the_content();?>
            <div><?php the_meta(); ?></div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}
?>



