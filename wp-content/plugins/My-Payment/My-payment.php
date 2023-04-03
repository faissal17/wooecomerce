<?php

/**
 * Plugin Name: My Payment Plugin
 * Plugin URI: http://example.com
 * Description: A payment plugin for WordPress
 * Version: 1.0
 * Author: Faissal
 * Author URI: http://example.com
**/

function insert(){

    
    global $wpdb;

$table_name = 'wp_mypayment'; // Replace 'my_custom_table' with the name of your table.

$data = array(
    'person' => $_POST['person'],
    'card-number' => $_POST['card-number'],
    'expire' => $_POST['expire'],
    'cvv' => $_POST['cvv'],
);

// print_r($data);

$wpdb->insert( $table_name, $data );
}



if(isset($_POST["submit"])){
    process_payment();
}

add_action('admin_menu','add_menu');

add_shortcode('faissal','my_payment_form');

function add_menu(){
    add_menu_page(
        'paySafe',
        'MyPayment',
        'manage_options',
        'safe',
        'add_plugin_function',
        'dashicons-buddicons-pm',
        10
    );
}

function add_plugin_function(){};
// Plugin code goes here

function process_payment() {
    // Get the payment data from the form

    if(isset($_POST['person'])) $persone_name = $_POST['person'];
    if(isset($_POST['card-number'])) $card = $_POST['card-number'];
    if(isset($_POST['expire'])) $expire = $_POST['expire'];
    if(isset($_POST['cvv'])) $cvv = $_POST['cvv'];
    
    // Process the payment and display a confirmation message
    if(empty($card) || empty($expire) || empty($cvv) || empty($persone_name)){
        echo 'fill all the required inputs';
    }
    else {
        insert();
        echo 'payment seccuses';
    }
}


function my_payment_form() {

    $string = "<form action='' method='POST'>
    <div class='container p-0'>
        <div class='card px-4'>
            <p class='h8 py-3'>Payment Details</p>
            <div class='row gx-3'>
                <div class='col-12'>
                    <div class='d-flex flex-column'>
                        <label for='person'>Persone name</label>
                        <input class='form-control mb-3' type='text' placeholder='Name' name='person'>
                    </div>
                </div>
                <div class='col-12'>
                    <div class='d-flex flex-column'>
                    <label for='card-number'>Card Number</label>
                        <input class='form-control mb-3' type='number' placeholder='1234 5678 435678' name='card-number'>
                    </div>
                </div>
                <div class='col-6'>
                    <div class='d-flex flex-column'>
                     <label for='expire'>expire</label>
                        <input class='form-control mb-3' type='number' placeholder='MM/YYYY' name='expire'>
                    </div>
                </div>
                <div class='col-6'>
                    <div class='d-flex flex-column'>
                    <label for='cvv'>CVV</label>
                        <input class='form-control mb-3 pt-2 ' type='number' placeholder='***' name='cvv'>
                    </div>
                </div>
                <div class='col-12'>
                    <button type='submit' name='submit' class='btn btn-primary mb-3'>
                    <span class='ps-3'>Pay</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </form>";

    return $string;
   
}
?>
<style>
 @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #0C4160;

    padding: 30px 10px;
}

.card {
    max-width: 500px;
    margin: auto;
    color: black;
    border-radius: 20 px;
}

p {
    margin: 0px;
}

.container .h8 {
    font-size: 30px;
    font-weight: 800;
    text-align: center;
}

.btn.btn-primary {
    width: 100%;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 15px;
    background-image: linear-gradient(to right, #77A1D3 0%, #79CBCA 51%, #77A1D3 100%);
    border: none;
    transition: 0.5s;
    background-size: 200% auto;

}


.btn.btn.btn-primary:hover {
    background-position: right center;
    color: #fff;
    text-decoration: none;
}

.form-control {
    color: white;
    background-color: #223C60;
    border: 2px solid transparent;
    height: 60px;
    padding-left: 20px;
    vertical-align: middle;
}

.text {
    font-size: 14px;
    font-weight: 600;
}

::placeholder {
    font-size: 14px;
    font-weight: 600;
}
</style>