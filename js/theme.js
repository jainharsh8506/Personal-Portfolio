// Get a reference to the body element
var body = document.body;

// Function to toggle between 'light' and 'dark' classes
function toggleTheme() {
    body.classList.toggle('light');
    body.classList.toggle('dark');

    // Check the current theme class and save it to localStorage
    var currentTheme = body.classList.contains('light') ? 'light' : 'dark';
    localStorage.setItem('theme', currentTheme);
}

// Function to set the theme on page load
function setTheme() {
    // Check if the theme is saved in localStorage
    var savedTheme = localStorage.getItem('theme');

    // If a theme is saved, apply it to the body
    if (savedTheme === 'light') {
        body.classList.add('light');
    } else {
        body.classList.remove('light');
    }

    // Always toggle the 'dark' class based on the absence of 'light' class
    body.classList.toggle('dark', savedTheme !== 'light');
}

// Call the setTheme function on page load
document.addEventListener('DOMContentLoaded', setTheme);
