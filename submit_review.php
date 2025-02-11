<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dentist_name = $_POST['dentist_name'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    $db = new Database('reviews.db');
    $db->insertReview($dentist_name, $rating, $review_text);

    $reviews = $db->fetchReviews();
    echo json_encode(['reviews' => $reviews]);
}
