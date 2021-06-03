<?php

function md_send_email( $to, $subject, $message ) {

    $template = '<html>
    <head>

    </head>
    <body>
    <style>
    html,body{font-size:14px; font-family:Arial; background:#f6f6f6;}
    a{color:#333333;}
    </style>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
    <table width="650" style="border:1px solid #dadada; width:650px; margin:0 auto; background:#fff; margin:20px auto;" cellspacing="0"  cellpadding="0">
    <tr>
    <td style="padding:20px 40px; background:#f1f1f1; color:#fff; text-align:center;">
    <img src="' . get_option( 'header_logo' ) . '" height="63" style="height:63px; width:auto;"/>
    </td>
    </tr>
    <tr>
    <td style="padding:20px 40px; font-size:14px; color:#555555;">
    ' . $message . '
    </td>
    </tr>
    <tr>
    <td style="padding:20px; color:#333; background:#f1f1f1; text-align:center; font-size:12px">
    <h4>' . get_bloginfo( 'name' ) . '</h4>
    <p><b><a href="' . home_url() . '">' . home_url() . '</a></b></p>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>

    </body>
    </html>';

    return wp_mail( $to, $subject, $template, [ 'Content-Type: text/html; charset=UTF-8' ] );
}

// add_action( 'wp_mail_failed', 'onMailError', 10, 1 );
// function onMailError( $wp_error ) {
// 	echo "<pre>";
// 	print_r($wp_error);
//     echo "</pre>";
//     // return $wp_error;
// }    