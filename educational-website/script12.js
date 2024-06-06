document.getElementById('searchButton').addEventListener('click', function() {
    const query = document.getElementById('searchQuery').value;
    const apiUrl = `https://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=${query}&format=json&origin=*`;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            const resultsContainer = document.getElementById('results');
            resultsContainer.innerHTML = '';
            data.query.search.forEach(item => {
                const articleDiv = document.createElement('div');
                articleDiv.classList.add('article');
                articleDiv.innerHTML = `
                    <h3>${item.title}</h3>
                    <p>${item.snippet}</p>
                    <a href="https://en.wikipedia.org/?curid=${item.pageid}" target="_blank">Read more</a>
                `;
                resultsContainer.appendChild(articleDiv);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
