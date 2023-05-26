<?php
/**
 * acf-courses-post
 *
 * @package       ACFPOSt
 * @author        ahmed wardany
 * @version       1
 *
 * @wordpress-plugin
 * Plugin Name:   acf-courses-post
 * Plugin URI:    http://yu2ahel.local/
 * Description:   acf-courses-post
 * Version:       1
 * Author:        Ahmed wardany
 * Author URI:    http://yu2ahel.local/
 * Text Domain:   acf-courses-post
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

function get_posts_shortcode() { 
  $featured_posts = get_field('courses');
  if( $featured_posts ){
      $html = '
      <style>
      .ag-format-container {
        width: 1142px;
        margin: 0 auto;
      }
      
      .ag-courses_box {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
      
        padding: 50px 0;
      }
      .ag-courses_item {
        -ms-flex-preferred-size: calc(33.33333% - 30px);
        flex-basis: calc(33.33333% - 30px);
      
        margin: 0 15px 30px;
      
        overflow: hidden;
      
        border-radius: 28px;
      }
      .ag-courses-item_link {
        display: block;
        padding: 30px 20px;
        background-color: #F3FBFF;
      
        overflow: hidden;
      
        position: relative;
      }
      .ag-courses-item_link:hover,
      .ag-courses-item_link:hover .ag-courses-item_date {
        text-decoration: none;
        color: #FFF;
      }
      .ag-courses-item_link:hover .ag-courses-item_bg {
        -webkit-transform: scale(10);
        -ms-transform: scale(10);
        transform: scale(10);
      }
      .ag-courses-item_title {
        min-height: 87px;
        margin: 0 0 25px;
      
        overflow: hidden;
      
        font-weight: bold;
        font-size: 27px;
        color: #000;
        text-align: center;
        z-index: 2;
        position: relative;
      }
      .ag-courses-item_date-box {
        font-size: 16px;
        color: #000;
        z-index: 2;
        position: relative;
        height: 90px;
      }
      .ag-courses-item_date {
        font-weight: bold;
        color: #f9b234;
      
        -webkit-transition: color .5s ease;
        -o-transition: color .5s ease;
        transition: color .5s ease
      }
      .ag-courses-item_bg {
        height: 128px;
        width: 128px;
        background-color: #f9b234;
        z-index: 1;
        position: absolute;
        top: -75px;
        right: -75px;
      
        border-radius: 50%;
      
        -webkit-transition: all .5s ease;
        -o-transition: all .5s ease;
        transition: all .5s ease;
      }
      .ag-courses_item:nth-child(2n) .ag-courses-item_bg {
        background-color: #3ecd5e;
      }
      .ag-courses_item:nth-child(3n) .ag-courses-item_bg {
        background-color: #e44002;
      }
      .ag-courses_item:nth-child(4n) .ag-courses-item_bg {
        background-color: #952aff;
      }
      .ag-courses_item:nth-child(5n) .ag-courses-item_bg {
        background-color: #cd3e94;
      }
      .ag-courses_item:nth-child(6n) .ag-courses-item_bg {
        background-color: #4c49ea;
      }
      
      
      
      @media only screen and (max-width: 979px) {
        .ag-courses_item {
          -ms-flex-preferred-size: calc(50% - 30px);
          flex-basis: calc(50% - 30px);
        }
        .ag-courses-item_title {
          font-size: 24px;
        }
      }
      
      @media only screen and (max-width: 767px) {
        .ag-format-container {
          width: 96%;
        }
      
      }
      @media only screen and (max-width: 639px) {
        .ag-courses_item {
          -ms-flex-preferred-size: 100%;
          flex-basis: 100%;
        }
        .ag-courses-item_title {
          min-height: 72px;
          line-height: 1;
      
          font-size: 24px;
        }
        .ag-courses-item_link {
          padding: 22px 40px;
        }
        .ag-courses-item_date-box {
          font-size: 16px;
        }
      }
      </style>
      <div class="ag-format-container">
        <div class="ag-courses_box">';
       foreach( $featured_posts as $post ){
          $permalink = get_permalink( $post->ID );
          $title = get_the_title( $post->ID );
          $about =get_field( 'about_course',$post->ID);
          $test = strip_tags($about);
          $first_100_chars = mb_substr($test, 0, 100);
          // $featured_image_url = get_the_post_thumbnail_url($post->ID, 'full');
          $html .= '<div class="ag-courses_item">
          <a href="'.$permalink.'" class="ag-courses-item_link">
            <div class="ag-courses-item_bg"></div>
    
            <div class="ag-courses-item_title">
              '.$title.'
            </div>
    
            <div class="ag-courses-item_date-box">
              '.$first_100_chars.'
            </div>
          </a>
        </div>
        ';
          setup_postdata($post);
       } 
          wp_reset_postdata(); 
          $html .= "</div>";
          echo $html;
      }
}
// register shortcode
add_shortcode('relatedCourses', 'get_posts_shortcode');