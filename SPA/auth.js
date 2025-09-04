// Authentication functions
document.addEventListener('DOMContentLoaded', function() {
    checkAuth();
});

// Check if user is logged in
function checkAuth() {
    const userData = localStorage.getItem('currentUser');
    if (userData) {
        const currentUser = JSON.parse(userData);
        updateUserProfile(currentUser);
    }
}

// Update user profile display
function updateUserProfile(user) {
    if (user) {
        document.getElementById('username-display').textContent = user.name;
        document.getElementById('points-display').textContent = user.points || 0;
        
        if (user.image) {
            document.getElementById('profile-image').src = user.image;
        } else {
            document.getElementById('profile-image').src = '';
            document.getElementById('profile-image').parentElement.textContent = user.name.charAt(0);
        }
        
        document.getElementById('auth-buttons').innerHTML = `
            <a href="home.html" class="btn btn-outline" onclick="logout()">Logout</a>
        `;
    }
}

// Logout function
function logout() {
    localStorage.removeItem('currentUser');
    alert('Logged out successfully');
    window.location.reload();
}