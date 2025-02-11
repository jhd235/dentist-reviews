<?php
// Create a connection to the SQLite database
class Database {
    private $pdo;

    public function __construct($db_file) {
        $this->pdo = new PDO('sqlite:' . $db_file);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->createTable();
    }

    private function createTable() {
        $query = "CREATE TABLE IF NOT EXISTS reviews (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            dentist_name TEXT NOT NULL,
            rating INTEGER NOT NULL,
            review_text TEXT NOT NULL
        )";
        $this->pdo->exec($query);
    }

    public function insertReview($dentist_name, $rating, $review_text) {
        $query = "INSERT INTO reviews (dentist_name, rating, review_text) VALUES (:dentist_name, :rating, :review_text)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':dentist_name', $dentist_name);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':review_text', $review_text);
        $stmt->execute();
    }

    public function fetchReviews() {
        $query = "SELECT dentist_name, rating, review_text FROM reviews";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
