document.addEventListener("DOMContentLoaded", function () {
  // Fetch News for Homepage
  function fetchNews() {
    const newsContainer = document.getElementById("news-section");
    if (!newsContainer) return; // If the news section doesn't exist, stop execution

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_news.php", true);

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const newsData = JSON.parse(xhr.responseText);
        newsContainer.innerHTML = "";
        newsData.forEach((news) => {
          newsContainer.innerHTML += `<article>
                        <h4>${news.title}</h4>
                        <p>${news.content}</p>
                    </article>`;
        });
      }
    };

    xhr.send();
  }

  // Login AJAX
  const loginForm = document.querySelector("#loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const formData = new FormData(loginForm);
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "login_ajax.php", true);

      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);
          document.querySelector(".err").innerHTML = response.message;
          if (response.status === "success") {
            setTimeout(() => (window.location.href = "home.php"), 1000);
          }
        }
      };

      xhr.send(formData);
    });
  }

  // Signup Username Availability Check
  const firstnameInput = document.getElementById("firstname");
  const feedbackDiv = document.getElementById("greeting");
  if (firstnameInput && feedbackDiv) {
    firstnameInput.addEventListener("input", function () {
      const firstname = this.value.trim();
      if (firstname.length > 0) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "check_username.php", true);
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );

        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            feedbackDiv.innerHTML = response.message;
            feedbackDiv.style.color =
              response.status === "success" ? "green" : "red";
          }
        };

        xhr.send(`firstname=${encodeURIComponent(firstname)}`);
      } else {
        feedbackDiv.innerHTML = "";
      }
    });
  }

  // Call fetchNews only if the page contains a news section
  fetchNews();
});
