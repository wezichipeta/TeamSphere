document.addEventListener("DOMContentLoaded", function () {
    // Sample data (replace with actual data from backend)
    const userProfileData = {
        department: "IT",
        birthday: "1990-01-01",
        interests: ["Coding", "Gaming"],
        position: "Developer",
        gender: "Male",
        location: "City"
    };

    const friendListData = ["Friend1", "Friend2", "Friend3"];

    const taggedPostsData = [
        { user: "John", content: "Check out this camping site!", taggedFriends: ["Mary"] },
        { user: "Mary", content: "Just finished reading a great book!", taggedFriends: ["John"] }
    ];

    const messageListData = [
        { sender: "John", content: "Hi Mary, how are you?" },
        { sender: "Mary", content: "I'm good, thanks! How about you?" }
    ];

    // Display user profile
    displayUserProfile(userProfileData);

    // Display friend list
    displayFriendList(friendListData);

    // Display tagged posts
    displayTaggedPosts(taggedPostsData);

    // Display message list
    displayMessageList(messageListData);
});

function displayUserProfile(profileData) {
    const profileInfo = document.getElementById("profileInfo");
    profileInfo.innerHTML = `
        <p><strong>Department:</strong> ${profileData.department}</p>
        <p><strong>Birthday:</strong> ${profileData.birthday}</p>
        <p><strong>Interests:</strong> ${profileData.interests.join(", ")}</p>
        <p><strong>Position:</strong> ${profileData.position}</p>
        <p><strong>Gender:</strong> ${profileData.gender}</p>
        <p><strong>Location:</strong> ${profileData.location}</p>
    `;
}

function displayFriendList(friendList) {
    const friendListContainer = document.getElementById("friendList");
    friendListContainer.innerHTML = "<h3>Friends</h3>";
    friendList.forEach(friend => {
        friendListContainer.innerHTML += `<p>${friend}</p>`;
    });
}

function displayTaggedPosts(taggedPosts) {
    const taggedPostsContainer = document.getElementById("taggedPosts");
    taggedPostsContainer.innerHTML = "<h3>Tagged Posts</h3>";
    taggedPosts.forEach(post => {
        taggedPostsContainer.innerHTML += `
            <div>
                <p><strong>${post.user}:</strong> ${post.content}</p>
                <p><strong>Tagged Friends:</strong> ${post.taggedFriends.join(", ")}</p>
            </div>
        `;
    });
}

function displayMessageList(messageList) {
    const messageListContainer = document.getElementById("messageList");
    messageListContainer.innerHTML = "<h3>Messages</h3>";
    messageList.forEach(message => {
        messageListContainer.innerHTML += `<p><strong>${message.sender}:</strong> ${message.content}</p>`;
    });
}

function createEvent() {
    // Add logic to create an event
    alert("Event created!");
}

function recordBirthdayReaction() {
    // Add logic to record birthday reaction
    alert("Birthday reaction recorded!");
}

function createCompetition() {
    // Add logic to create a competition
    alert("Competition created!");
}

function giveKudos() {
    // Add logic to give kudos
    alert("Kudos given!");
}
