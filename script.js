document.addEventListener('DOMContentLoaded', function() {
    const reviewForm = document.getElementById('review-form');
    const reviewsPlaceholder = document.getElementById('reviews-placeholder');

    reviewForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(reviewForm);

        fetch('submit_review.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            reviewsPlaceholder.innerHTML = '';
            data.reviews.forEach(review => {
                const reviewElement = document.createElement('div');
                reviewElement.classList.add('review');
                reviewElement.innerHTML = `
                    <h3>${review.dentist_name}</h3>
                    <p>Rating: ${review.rating}</p>
                    <p>${review.review_text}</p>
                `;
                reviewsPlaceholder.appendChild(reviewElement);
            });
        })
        .catch(error => console.error('Error:', error));
    });
});
