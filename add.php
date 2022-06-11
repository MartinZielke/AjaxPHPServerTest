<?php

header( 'Access-Control-Allow-Origin: http://127.0.0.1:5500' );
header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS' );
header( 'Access-Control-Allow-Headers: Content-Type, Authorization' );

if ( isset( $_POST['res'] ) ) {
	$res = $_POST['res'];
	// Convert $res to number
	$res = intval( $res );
	echo add( $res );
	// $style = "<style>body {
	// background-color: #f0f0f0;
	// }</style>";
	// echo $style;
	// }
}

$json = file_get_contents( 'php://input' );

$obj = json_decode( $json, true );
if ( isset( $obj['res'] ) ) {
	$res = $obj['res'];
	echo subtract( $res );
	// $style = "<style>body {
	// background-color: #0f0f0f;
	// }</style>";
	// echo json_encode($style);
}

if ( isset( $obj['text'] ) ) {
	require 'fpdf.php';

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont( 'Arial', 'B', 16 );
	$pdf->Cell( 40, 10, 'Hello World!' );
	$uuid = uniqid( '', true );
	$url  = "$uuid.pdf";
	$pdf->Output( 'D', $url );
	$text = $obj['text'];
	// Generate url
	// Use an UUID to make sure that nobody can guess the url
	// Generate uuid



	// Send json response
	header( 'Content-Type: application/json' );
	echo json_encode( array( 'url' => $url ) );
	// echo json_encode($text);
}


function add( $res ) {
	return $res + 1;
}

function subtract( $res ) {
	return $res - 1;
}

$price = 10;

if ( isset( $obj['inputValue'] ) ) {
	$inputValue = $obj['inputValue'];
	echo $inputValue * $price;
}

if ( isset( $_GET['city'] ) && ! empty( $_GET ) ) {
	echo json_encode( $_GET['city'] );
}

if ( isset( $_POST['postsubmit'] ) ) {
	echo 'HEJ' . $_POST['name'];
}

if ( isset( $_GET['name'] ) ) {
	echo 'HEJ ' . $_GET['name'];
}
