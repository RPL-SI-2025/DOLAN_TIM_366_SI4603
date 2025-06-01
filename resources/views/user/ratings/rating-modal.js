let currentRatingId = null;

function openRatingModal() {
    const destinationId = window.destinationId;
    
    // Check if user can create rating
    fetch(`/destinations/${destinationId}/ratings/create`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            showNotification(data.error, 'error');
            if (data.existing_rating) {
                editRating(data.existing_rating.id);
            }
        } else {
            document.getElementById('modalTitle').textContent = 'Rate & Review';
            document.getElementById('ratingForm').reset();
            document.getElementById('submitBtn').textContent = 'Submit';
            clearErrors();
            currentRatingId = null;
            document.getElementById('ratingModal').classList.add('show');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred', 'error');
    });
}

function editRating(ratingId) {
    fetch(`/ratings/${ratingId}/edit`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            showNotification(data.error, 'error');
        } else {
            document.getElementById('modalTitle').textContent = 'Edit Rating';
            document.getElementById('rating').value = data.rating.rating;
            document.getElementById('feedback').value = data.rating.feedback;
            document.getElementById('submitBtn').textContent = 'Update';
            clearErrors();
            currentRatingId = ratingId;
            document.getElementById('ratingModal').classList.add('show');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred', 'error');
    });
}

function closeRatingModal() {
    document.getElementById('ratingModal').classList.remove('show');
    clearErrors();
}

function showAllRatings() {
    const destinationId = window.destinationId;
    
    document.getElementById('allRatingsModal').classList.add('show');
    document.getElementById('loadingSpinner').style.display = 'block';
    
    fetch(`/destinations/${destinationId}/ratings/all`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('allRatingsContainer');
        document.getElementById('loadingSpinner').style.display = 'none';
        container.innerHTML = '';
        
        if (data.ratings.length === 0) {
            container.innerHTML = '<p class="text-center text-gray-500 py-8">No reviews available.</p>';
        } else {
            data.ratings.forEach(rating => {
                const ratingElement = createRatingElement(rating);
                container.appendChild(ratingElement);
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loadingSpinner').style.display = 'none';
        document.getElementById('allRatingsContainer').innerHTML = 
            '<p class="text-center text-red-500 py-8">Error loading reviews.</p>';
    });
}

function closeAllRatingsModal() {
    document.getElementById('allRatingsModal').classList.remove('show');
}

function createRatingElement(rating) {
    const div = document.createElement('div');
    div.className = 'border-b pb-4 mb-4';
    
    const stars = Array.from({length: 5}, (_, i) => 
        `<svg class="w-5 h-5 ${i < rating.rating ? 'text-yellow-400 fill-current' : 'text-gray-300'}" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>`
    ).join('');

    const currentUserId = window.currentUserId;
    const editButton = currentUserId && currentUserId == rating.user_id 
        ? `<button onclick="editRating(${rating.id})" class="text-purple-600 hover:text-purple-800">Edit</button>`
        : '';

    div.innerHTML = `
        <div class="flex justify-between items-start">
            <div>
                <h4 class="font-bold">${rating.user.name}</h4>
                <div class="flex items-center mt-1">
                    <div class="flex">${stars}</div>
                    <span class="text-gray-500 ml-2">${new Date(rating.created_at).toLocaleDateString()}</span>
                </div>
            </div>
            ${editButton}
        </div>
        <p class="mt-4 text-gray-700">${rating.feedback}</p>
    `;
    
    return div;
}

function clearErrors() {
    document.getElementById('ratingError').classList.add('hidden');
    document.getElementById('feedbackError').classList.add('hidden');
}

function showFieldError(field, message) {
    const errorElement = document.getElementById(field + 'Error');
    errorElement.textContent = message;
    errorElement.classList.remove('hidden');
}

function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
        type === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Form submission handler
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('ratingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const destinationId = window.destinationId;
        const formData = new FormData(this);
        const url = currentRatingId 
            ? `/ratings/${currentRatingId}` 
            : `/destinations/${destinationId}/ratings`;
        
        if (currentRatingId) {
            formData.append('_method', 'PUT');
        }

        // Clear previous errors
        clearErrors();

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.errors) {
                // Show validation errors
                Object.keys(data.errors).forEach(field => {
                    showFieldError(field, data.errors[field][0]);
                });
            } else if (data.error) {
                showNotification(data.error, 'error');
            } else {
                showNotification(data.success, 'success');
                closeRatingModal();
                // Refresh the ratings section
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred', 'error');
        });
    });
});