<?php
/**
 * acf-courses-post
 *
 * @package       ACFPOSt3
 * @author        ahmed wardany
 * @version       2
 *
 * @wordpress-plugin
 * Plugin Name:   acf-departments-post
 * Plugin URI:    http://yu2ahel.local/
 * Description:   acf-departments-post
 * Version:       1
 * Author:        Ahmed wardany
 * Author URI:    http://yu2ahel.local/
 * Text Domain:   acf-departments-post
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

function get_posts_departments() { 
  $featured_posts = get_field('departments');
  if( $featured_posts ){
      $html = '
      <style>
      .center {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
      }
      
      .center ul {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        list-style: none;
        width: 90%;
      }
      
      .center ul {
        margin-top: 5rem;
      }
      
      .center ul li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #fff;
        width: 90%;
        padding: 10px 100px;
        margin: 1rem 0px;
        border-radius: 20px;
        box-shadow: 0px 0px 20px #00000020;
        position: relative;
        transition: all .3s ease;
        background-color: #0e7888;
      }
      
      .center ul li:hover:before {
          content: "";
          display: flex;
          width: 8px;
          height: 100%;
          background-color: #FFBB1C;
          position: absolute;
          top: 0;
          left: 0;
          margin-left: -1.5rem;
          border-radius: 25px;
          box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.162);
      }
      
      .center ul li:hover {
          transform: translateX(15px);
      }
      
      .image {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
      }
      
      .image img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
      }
      
      .text-group {
        width: 40%;
      }
      
      /* Small Screens */
      @media only screen and (max-width: 576px) {
        .center ul li:hover {
          transform: none;
        }
        
        .date-group {
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
        }
      }
      
      /* Medium Screens */
      @media only screen and (max-width: 768px) {
        .center li {
          flex-direction: column;
        }
        
        .center li>div {
          margin: 1rem 0px;
        }
        
        .text-group {
          width: 80%;
          text-align: center;
        }
        
        .date-group{
          display: flex;
        }
        
        .date-group h4, p {
          margin: 0px .5rem;
        }
      }
      </style>
      <div class="center">
        <ul>';
       foreach( $featured_posts as $post ){
          $permalink = get_permalink( $post->ID );
          $title = get_the_title( $post->ID );
          // $img = get_post_thumbnail_id( $post->ID );
          $about =get_field( 'الوصف',$post->ID);
          $test = strip_tags($about);
          $first_100_chars = mb_substr($test, 0, 100);
          $html .= '<a href="'.$permalink.'" ><li>
          <div class="image">            
            <h4 style="color:#fff;" >'.$title.'</h4>
          </div>
          
          <div class="text-group">
          '.$first_100_chars.'
          </div>
          
        </li></a>';
          setup_postdata($post);
       } 
          wp_reset_postdata(); 
          $html .= "  </ul>
          </div>";
          echo $html;
      }
}
// register shortcode
add_shortcode('relatedDepartments', 'get_posts_departments');