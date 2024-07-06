document.addEventListener('DOMContentLoaded', () => {
    const addEventForm = document.getElementById('addEventForm');

    addEventForm.addEventListener('submit', (e) => {
        // No changes needed for form submission here
    });

    // Fetch and display events
    fetch('fetch_events.php')
        .then(response => response.json())
        .then(data => {
            const eventsContainer = document.querySelector('.events');
            data.forEach(event => {
                const eventCard = document.createElement('div');
                eventCard.classList.add('event-card');
                eventCard.innerHTML = `
                    <img src="${event.event_image}" alt="${event.event_name}">
                    <div class="event-info">
                        <h3>${event.event_name}</h3>
                        <p>${event.event_description}</p>
                        <p>${event.event_date}</p>
                    </div>
                `;
                eventsContainer.appendChild(eventCard);
            });
        });
});
