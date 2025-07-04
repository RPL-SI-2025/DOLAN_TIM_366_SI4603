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
        if (data.error === 'existing_rating_found') {
            // Show confirmation dialog menggunakan SweetAlert2
            Swal.fire({
                title: 'Edit Rating?',
                text: 'Anda sudah pernah memberikan rating. Ingin mengeditnya?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#6B21A8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Edit',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, open edit modal
                    editRating(data.existing_rating.id);
                }
                // If user cancels, do nothing
            });
        } else if (data.error) {
            console.error('Error:', data.error);
        } else {
            // No existing rating, show new rating modal
            document.getElementById('modalTitle').textContent = 'Rate & Review';
            document.getElementById('ratingForm').reset();
            document.getElementById('submitBtn').textContent = 'Submit';
            clearErrors();
            resetStarRating(); // Reset star display
            currentRatingId = null;
            
            // Show modal
            const modal = document.getElementById('ratingModal');
            modal.style.display = 'flex';
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    })
    .catch(error => {
        console.error('Error:', error);
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
            updateStarDisplay(data.rating.rating); // Update star display dengan rating yang ada
            currentRatingId = ratingId;
            const modal = document.getElementById('ratingModal');
            modal.style.display = 'flex';
            modal.classList.add('show');
            // Prevent body scroll when modal is open
            document.body.style.overflow = 'hidden';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred', 'error');
    });
}

function closeRatingModal() {
    const modal = document.getElementById('ratingModal');
    modal.style.display = 'none';
    modal.classList.remove('show');
    clearErrors();
    
    // Reset form dan current rating ID
    document.getElementById('ratingForm').reset();
    resetStarRating(); // Reset star display
    currentRatingId = null;
    
    // Enable body scroll when modal is closed
    document.body.style.overflow = '';
}

function showAllRatings() {
    const destinationId = window.destinationId;
    
    const modal = document.getElementById('allRatingsModal');
    modal.style.display = 'flex';
    modal.classList.add('show');
    document.getElementById('loadingSpinner').style.display = 'block';
    document.getElementById('reviewsList').classList.add('hidden');
    document.getElementById('emptyState').classList.add('hidden');
    
    // Prevent body scroll when modal is open
    document.body.style.overflow = 'hidden';
    
    fetch(`/destinations/${destinationId}/ratings/all`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('allRatingsContainer');
        const reviewsList = document.getElementById('reviewsList');
        const emptyState = document.getElementById('emptyState');
        const loadingSpinner = document.getElementById('loadingSpinner');
        
        loadingSpinner.style.display = 'none';
        
        if (data.ratings.length === 0) {
            emptyState.classList.remove('hidden');
            reviewsList.classList.add('hidden');
        } else {
            reviewsList.classList.remove('hidden');
            emptyState.classList.add('hidden');
            reviewsList.innerHTML = '';
            
            data.ratings.forEach(rating => {
                const ratingElement = createRatingElement(rating);
                reviewsList.appendChild(ratingElement);
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('loadingSpinner').style.display = 'none';
        document.getElementById('emptyState').classList.remove('hidden');
        document.getElementById('emptyState').innerHTML = 
            '<p class="text-center text-red-500 py-8">Error loading reviews.</p>';
    });
}

function closeAllRatingsModal() {
    const modal = document.getElementById('allRatingsModal');
    modal.style.display = 'none';
    modal.classList.remove('show');
    
    // Enable body scroll when modal is closed
    document.body.style.overflow = '';
}

function createRatingElement(rating) {
    const div = document.createElement('div');
    div.className = 'bg-white rounded-lg shadow-md p-4 border border-gray-200 hover:shadow-lg transition-shadow review-item';
    
    const stars = Array.from({length: 5}, (_, i) => 
        `<svg class="w-5 h-5 ${i < rating.rating ? 'text-yellow-400 fill-current' : 'text-gray-300'}" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
        </svg>`
    ).join('');

    const currentUserId = window.currentUserId;
    const editButton = currentUserId && currentUserId == rating.user_id 
        ? `<button onclick="editRatingFromModal(${rating.id})" class="text-purple-600 hover:text-purple-800 font-medium transition-colors">Edit</button>`
        : '';

    div.innerHTML = `
        <div class="flex justify-between items-start mb-3">
            <div class="flex-1">
                <h4 class="font-bold text-gray-900 text-lg">${rating.user.name}</h4>
                <div class="flex items-center mt-1">
                    <div class="flex mr-2">${stars}</div>
                    <span class="text-gray-500 text-sm">${new Date(rating.created_at).toLocaleDateString()}</span>
                </div>
            </div>
            ${editButton}
        </div>
        <div class="bg-gray-50 p-3 rounded-lg">
            <p class="text-gray-700 leading-relaxed">${rating.feedback}</p>
        </div>
    `;
    
    return div;
}

// Function untuk edit dari dalam modal show all ratings
function editRatingFromModal(ratingId) {
    // Close the show all ratings modal first
    closeAllRatingsModal();
    
    // Then open edit modal
    setTimeout(() => {
        editRating(ratingId);
    }, 300); // Small delay to ensure modal is closed
}

// Function untuk update star display
function updateStarDisplay(rating) {
    const starButtons = document.querySelectorAll('.star-btn');
    const ratingText = document.getElementById('ratingText');
    
    const ratingLabels = {
        1: 'Poor',
        2: 'Fair', 
        3: 'Good',
        4: 'Very Good',
        5: 'Excellent'
    };

    // Update star colors
    starButtons.forEach((btn, index) => {
        if (index < rating) {
            btn.classList.remove('text-gray-300');
            btn.classList.add('text-yellow-400');
        } else {
            btn.classList.remove('text-yellow-400');
            btn.classList.add('text-gray-300');
        }
    });
    
    // Update rating text
    if (ratingText) {
        ratingText.textContent = ratingLabels[rating] || '';
    }
}

// Function untuk reset star display
function resetStarRating() {
    const starButtons = document.querySelectorAll('.star-btn');
    const ratingText = document.getElementById('ratingText');
    
    // Reset all stars to gray
    starButtons.forEach(btn => {
        btn.classList.remove('text-yellow-400');
        btn.classList.add('text-gray-300');
    });
    
    // Clear rating text
    if (ratingText) {
        ratingText.textContent = '';
    }
}

function clearErrors() {
    const ratingError = document.getElementById('ratingError');
    const feedbackError = document.getElementById('feedbackError');
    if (ratingError) ratingError.classList.add('hidden');
    if (feedbackError) feedbackError.classList.add('hidden');
}

function showFieldError(field, message) {
    const errorElement = document.getElementById(field + 'Error');
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.classList.remove('hidden');
    }
}

function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transform transition-all duration-300 ${
        type === 'error' 
            ? 'bg-gradient-to-r from-red-500 to-red-600 text-white' 
            : 'bg-gradient-to-r from-green-500 to-green-600 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                ${type === 'error' 
                    ? '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />'
                    : '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />'
                }
            </svg>
            <span class="font-medium">${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.add('translate-x-0');
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Form submission handler - HANYA SATU FUNCTION INI
document.addEventListener('DOMContentLoaded', function() {
    const ratingForm = document.getElementById('ratingForm');
    if (ratingForm) {
        ratingForm.addEventListener('submit', function(e) {
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

            // Client-side validation
            const rating = formData.get('rating');
            const feedback = formData.get('feedback');

            let hasErrors = false;

            if (!rating || rating === '') {
                showFieldError('rating', 'Please select a rating');
                hasErrors = true;
            }

            if (!feedback || feedback.trim() === '') {
                showFieldError('feedback', 'Please provide your feedback');
                hasErrors = true;
            }

            if (hasErrors) {
                return;
            }

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
                    // Handle success
                    const isUpdate = currentRatingId !== null;
                    if (data.success) {
                        showNotification(data.success, 'success');
                    } else if (isUpdate) {
                        showNotification('Rating berhasil diperbarui', 'success');
                    } else {
                        showNotification('Rating berhasil disimpan', 'success');
                    }
                    
                    closeRatingModal();
                    // Refresh the ratings section
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred', 'error');
            });
        });
    }
});