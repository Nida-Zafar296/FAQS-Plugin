document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('faq-search-input');
    const searchButton = document.getElementById('faq-search-button');
    
    // Select all FAQ items on the page
    const faqItems = document.querySelectorAll('.faq-item');

    // Add a click event listener to the search button
    searchButton.addEventListener('click', function() {
        // Retrieve the value from the search input and convert it to lowercase
        const searchTerm = searchInput.value.toLowerCase().trim();

        // Loop through each FAQ item to check for matches
        faqItems.forEach(function(item) {
            // Get the text of the question and answer, and convert to lowercase
            const question = item.querySelector('.faq-question').innerText.toLowerCase();
            const answer = item.querySelector('.faq-answer').innerText.toLowerCase();
            const categoriesElem = item.querySelector('.faq-categories');
            const tagsElem = item.querySelector('.faq-tags');
            
            // Check if the elements exist before accessing their innerText
            const categories = categoriesElem ? categoriesElem.innerText.toLowerCase() : '';
            const tags = tagsElem ? tagsElem.innerText.toLowerCase() : '';

            // Check if the search term is found in the question, answer, categories, or tags
            if (question.includes(searchTerm) || answer.includes(searchTerm) || categories.includes(searchTerm) || tags.includes(searchTerm)) {
                // If there's a match, display the FAQ item
                item.style.display = ''; // Reset to default display 
            } else {
                // If there's no match, hide the FAQ item
                item.style.display = 'none'; // Set display to none (hide item)
            }
        });
    });
});
