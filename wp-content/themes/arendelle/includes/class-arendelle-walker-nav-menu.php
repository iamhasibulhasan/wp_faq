<?php

class Arendelle_Walker_Nav_Menu extends Walker_Nav_Menu {

	public $megamenu_item_id;

	public function __construct() {
		$this->megamenu_item_id = 0;
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) { //ul
		$indent = str_repeat("\t", $depth);
		$submenu = ( $depth > 0 ) ? ' nav__dropdown-child-submenu' : '';
		$megamenu = ( 0 != $this->megamenu_item_id ) ? 'd-none' : '';

		$output .= "\n$indent<ul class=\"nav__dropdown-menu$submenu $megamenu depth_$depth\">\n";
	}

	function end_lvl( &$output, $depth = 0, $args = null ) {
		$output .= "</ul>";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$megamenu_activation = get_post_meta( $item->ID, 'arendelle_megamenu_activation', true );
		$megamenu_template = get_post_meta( $item->ID, 'arendelle_megamenu_template', true );
		$indent = ($depth) ? str_repeat("\t", $depth) : '';		

		$li_attributes = '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		$classes[] = ($args->walker->has_children) ? 'nav__dropdown' : '';
		$classes[] = ($megamenu_activation) ? 'nav__dropdown-megamenu' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		
		if ( array_search( 'nav__dropdown-megamenu', $classes ) ) {
			$this->megamenu_item_id = $item->ID;
		} else {
			$this->megamenu_item_id = 0;
		}

		if ( $depth && $args->walker->has_children ) {
			$classes[] = 'nav__dropdown-submenu';
		}

		$class_names = join( ' ', apply_filters( 'arendelle_nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'arendelle_nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';	

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$attributes .= ( $args->walker->has_children || $megamenu_template ) ? ' class="nav__item-dropdown" ' : '';

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'arendelle_nav_item_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( $args->walker->has_children || $megamenu_template ) ? '</a><button class="nav__dropdown-trigger" aria-expanded="false"><span class="screen-reader-text">' . esc_html__( 'Show sub menu', 'arendelle' ) . '</span><i class="arendelle-icon-chevron-down"></i></button>' : '</a>'; 
		$item_output .= $args->after;

		if ( $megamenu_activation && did_action( 'elementor/loaded' ) ) {
			$elementor = \Elementor\Plugin::instance();
			$item_output .= "<div class='nav__dropdown-menu nav__dropdown-menu-megamenu'>";
			$item_output .= $elementor->frontend->get_builder_content_for_display( $megamenu_template );
			$item_output .= "</div>";			
		}

		$output .= apply_filters( 'arendelle_walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}	

}