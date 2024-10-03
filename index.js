document.getElementById('detectorForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    const link = document.getElementById('link').value;
    const email = document.getElementById('email').value;

    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define what happens on successful data submission
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Parse the JSON response from PHP
            const response = JSON.parse(xhr.responseText);
            displayResults(response); // Call a function to display results
        } else {
            console.error('Error in request:', xhr.statusText);
        }
    };

    // Define what happens in case of error
    xhr.onerror = function() {
        console.error('Request failed');
    };

    // Send the request with link and email data
    xhr.send(`link=${encodeURIComponent(link)}&email=${encodeURIComponent(email)}`);
});

// Function to display results
function displayResults(response) {
    const resultContainer = document.createElement('div');
    
    // Check for malicious link
    if (response.isMaliciousLink) {
        resultContainer.innerHTML += "<p style='color: red;'>This link is malicious.</p>";
    } else {
        resultContainer.innerHTML += "<p style='color: green;'>This link is safe.</p>";
    }

    // Check for malicious email
    if (response.isMaliciousEmail) {
        resultContainer.innerHTML += "<p style='color: red;'>This email is malicious.</p>";
    } else {
        resultContainer.innerHTML += "<p style='color: green;'>This email is safe.</p>";
    }

    // Clear previous results and append new results
    const previousResults = document.querySelector('div'); // Select existing result container
    if (previousResults) {
        previousResults.remove(); // Remove it if exists
    }
    document.body.appendChild(resultContainer); // Append new results
}
