document.addEventListener("DOMContentLoaded", function() {
    // Fetch data for birthday celebrations
    fetch('get_birthday_data.php')
        .then(response => response.json())
        .then(data => {
            const birthdayList = document.getElementById('birthday-list');
            data.forEach(item => {
                const listItem = document.createElement('li');
                listItem.textContent = ${item.name} - ${item.birthday};
                birthdayList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Error fetching birthday data:', error));

    // Fetch data for competitions
    fetch('get_competition_data.php')
        .then(response => response.json())
        .then(data => {
            const competitionList = document.getElementById('competition-list');
            data.forEach(item => {
                const listItem = document.createElement('li');
                listItem.textContent = ${item.name} - ${item.duration};
                competitionList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Error fetching competition data:', error));

    // Fetch data for kudos
    fetch('get_kudos_data.php')
        .then(response => response.json())
        .then(data => {
            const kudosList = document.getElementById('kudos-list');
            data.forEach(item => {
                const listItem = document.createElement('li');
                listItem.textContent = ${item.sender} thanked ${item.recipient} - ${item.timestamp};
                kudosList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Error fetching kudos data:', error));
});