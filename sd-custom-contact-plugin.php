<?php
/*
*@package sd custom contact plugin
*/
/*
Plugin Name: SD Contact Plugin
Plugin URI: http://sample-website.atsnx.com
Description: This is a custom plugin for contact page
Version: 1.0
Author: Shreya Deolankar
*/

//for security purpose
/*if(!defined('ABSPATH')){
	die;
}*/

defined('ABSPATH') or die('You have no persmission to access this file!!');


function sd_custom_contact_form()
{
	$form = '';
	$form .= '<form method="post" action="http://sdportfolio.atsnx.com/wp/thank-you/">';
	$form .= 'Name : <input type="text" class="input padding-16" name="full_name" required placeholder= "Enter your name">';
	$form .= '<br></br>';
	$form .= 'Email : <input type="text" class="input padding-16" name="email_address" required placeholder="Enter your email">';
	$form .= '<br></br>';
	$form .= 'Phone: <input type="text" class="input padding-16" name="phone_number" placeholder="Enter your phone number">';
	$form .= '<br></br>';
	$form .= 'Message: <textarea name="feedback" class="input padding-16" required placeholder="Please leave your message.."></textarea>';
	$form .= '<br></br>';
	$form .= '<input class="button black padding-small" type="submit" name="sd_submit_form" value="Submit">';
	$form .= '</form>';

	return $form;
}

add_shortcode('sd_custom_contact_form','sd_custom_contact_form');

function sd_convert_html(){
	return 'text/html';
}

function sd_submit_form(){
	if(array_key_exists('sd_submit_form', $_POST)){
		$to = "shreya_deolankar@yahoo.co.in";
		$subject = "Word Press Site Feedback";
		$body = '';
		$body .= 'Name: '.$_POST["full_name"]. '<br />';
		$body .= 'Email: '.$_POST["email_address"]. '<br />';
		$body .= 'Phone Number: '.$_POST["phone_number"]. '<br />';
		$body .= 'Feedback: '.$_POST["feedback"]. '<br />';

		add_filter('wp_mail_content_type','sd_convert_html');

		wp_mail($to,$subject,$body);

		remove_filter('wp_mail_content_type','sd_convert_html');
	}
}

add_action('wp_head','sd_submit_form');
