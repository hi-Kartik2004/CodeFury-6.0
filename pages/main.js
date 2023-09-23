console.log("Js has been loaded");

//============ Navbar dropdown toggle =============
const financeLink = document.getElementById("finance-link");
const tradeLink = document.getElementById("trade-link");
const reportLink = document.getElementById("report-link");

const allDropDownLinks = document.querySelectorAll(".dropdown-link");
console.log(allDropDownLinks);

const allDropDowns = document.querySelectorAll(".dropdown");
console.log(allDropDowns);

for (let i = 0; i < allDropDownLinks.length; i++) {
  allDropDownLinks[i].addEventListener("click", (e) => {
    allDropDowns[i].classList.toggle("none");
    for (let j = 0; j < allDropDownLinks.length; j++) {
      if (j == i) {
      } else {
        allDropDowns[j].classList.add("none");
      }
    }
  });
}

// ============= mobile Nav ===========

const mobileNav = document.getElementById("mobile-nav");
const hamburger = document.getElementById("hamburger");

hamburger.addEventListener("click", () => {
  mobileNav.classList.toggle("none");
});

// =============== Handling url ==============

// console.log("Hi testing");
const url = window.location.href;
const baseUrl = url.split("?")[0]; // Get the base URL without the query string

if (!url.includes("?")) {
  const newUrl = `${baseUrl}?home=firstTime`;
  window.location.href = newUrl;
}

// ============= Handling remember me ============
function handleRememberMe() {
  const rememberMe = document.getElementById("remember-me");
  const checkbox = document.getElementById("checkbox");

  rememberMe.addEventListener("click", () => {
    checkbox.checked = !checkbox.checked;
  });
}

// =========== Handling error banner ==========
function HandleError() {
  const error = document.getElementById("error");
  const errorContent = error.innerHTML;
  console.log(error);
  if (errorContent == "" || errorContent == " ") {
    console.log("is empty");
    error.style.padding = "0";
  }
}

// ===================== Copy to clipboard ==============
function copyToClipboard() {
  console.log("copy to clipboard called.");
  const input = document.getElementById("affiliate-link");
  const text = input.value;

  navigator.clipboard
    .writeText(text)
    .then(() => {
      alert("Copied to clipboard!");
    })
    .catch((error) => {
      console.error("Failed to copy to clipboard:", error);
    });
}

// ======= Summariser =======

async function summariseUrl() {
  const summaryUrl = document.getElementById("summary-url");
  const summaryDiv = document.querySelector(".your__summary");
  const loadingIndicator = document.getElementById("loading");

  const url = `https://article-data-extraction-and-summarization.p.rapidapi.com/article?url=${summaryUrl.value}&summarize=false&summarize_language=auto`;

  const options = {
    method: "GET",
    headers: {
      "X-RapidAPI-Key": "05a1d027bcmsh4696fdb923bcd99p1b1584jsnc0eb4d43fc88",
      "X-RapidAPI-Host":
        "article-data-extraction-and-summarization.p.rapidapi.com",
    },
  };

  try {
    loadingIndicator.style.display = "block"; // Show loading indicator
    const response = await fetch(url, options);
    const result = await response.json();
    const summaryText = result.article.text;
    summaryDiv.textContent = summaryText;

    // Apply styles to summaryDiv after receiving the response
    summaryDiv.style.padding = "1rem";
    summaryDiv.style.borderRadius = "4px";
    summaryDiv.style.backgroundColor = "var(--gray-color)";
    summaryDiv.style.marginTop = "1rem";
  } catch (error) {
    console.error(error);
  } finally {
    loadingIndicator.style.display = "none"; // Hide loading indicator after API call
  }
}

try {
  const summariseBtn = document.getElementById("summarise-btn");
  summariseBtn.addEventListener("click", (e) => {
    e.preventDefault();
    summariseUrl();
  });
} catch (error) {
  console.log("Summarizer cannot be used!");
}

// ======== Get general Articles ========
// Function to toggle loading indicator

async function getGeneralArticles() {
  const requestQuery = "Mental Health";
  const url = `https://bing-news-search1.p.rapidapi.com/news/search?q=${requestQuery}&freshness=Day&textFormat=Raw&safeSearch=Off`;
  const options = {
    method: "GET",
    headers: {
      "X-BingApis-SDK": "true",
      "X-RapidAPI-Key": "05a1d027bcmsh4696fdb923bcd99p1b1584jsnc0eb4d43fc88",
      "X-RapidAPI-Host": "bing-news-search1.p.rapidapi.com",
    },
  };

  try {
    const response = await fetch(url, options);
    const result = await response.json();

    const popularSummaries = document.querySelector(".popular__summaries");

    result.value.forEach((article) => {
      const articleDiv = document.createElement("div");
      articleDiv.classList.add("popular__summary");

      const heading = document.createElement("h4");
      heading.textContent = article.name;
      articleDiv.appendChild(heading);

      const description = document.createElement("p");
      description.textContent = article.description;
      articleDiv.appendChild(description);

      const link = document.createElement("a");
      link.textContent = "Complete Read";
      link.href = article.url;
      link.classList.add("read-link"); // Add a class to the anchor
      articleDiv.appendChild(link);

      popularSummaries.appendChild(articleDiv);
    });

    console.log(result);
  } catch (error) {
    console.error(error);
  }
}

// Check for the "articles" query parameter
const urlParams1 = new URLSearchParams(window.location.search);
const articlesParam1 = urlParams1.get("articles");
if (articlesParam1 === "all") {
  getGeneralArticles();
}

// =========== Get yogo Articles ==============
async function getYogaArticles() {
  const requestQuery = "Yoga & Fitness";
  const url = `https://bing-news-search1.p.rapidapi.com/news/search?q=${requestQuery}&freshness=Day&textFormat=Raw&safeSearch=Off`;
  const options = {
    method: "GET",
    headers: {
      "X-BingApis-SDK": "true",
      "X-RapidAPI-Key": "05a1d027bcmsh4696fdb923bcd99p1b1584jsnc0eb4d43fc88",
      "X-RapidAPI-Host": "bing-news-search1.p.rapidapi.com",
    },
  };

  try {
    const response = await fetch(url, options);
    const result = await response.json();

    const popularSummaries = document.querySelector(".popular__summaries");

    result.value.forEach((article) => {
      const articleDiv = document.createElement("div");
      articleDiv.classList.add("popular__summary");

      const heading = document.createElement("h4");
      heading.textContent = article.name;
      articleDiv.appendChild(heading);

      const description = document.createElement("p");
      description.textContent = article.description;
      articleDiv.appendChild(description);

      const link = document.createElement("a");
      link.textContent = "Complete Read";
      link.href = article.url;
      link.classList.add("read-link");
      articleDiv.appendChild(link);
      articleDiv.classList.add("summary__card");

      popularSummaries.appendChild(articleDiv);
    });
  } catch (error) {
    console.error(error);
  }
}

// Check for the "articles" query parameter
const urlParams = new URLSearchParams(window.location.search);
const articlesParam = urlParams.get("articles");
if (articlesParam === "yoga") {
  getYogaArticles();
}

// ======== Show add post ==========
function showAddPost() {
  const form = document.getElementById("post-form");
  const btn = document.querySelector(".green__btn");

  form.classList.toggle("none");

  if (form.classList.contains("none")) {
    btn.innerText = "Add";
  } else {
    btn.innerText = "Hide Form";
  }
}

// ====== Handle comments =======

function closeAllComments() {
  const commentBtn = document.querySelectorAll(".comment-btn");
  const commentForm = document.querySelectorAll(".comments");
  console.log(commentBtn);

  for (let i = 0; i < commentBtn.length; i++) {
    closeAllComments();
    commentBtn[i].addEventListener("click", () => {
      commentForm[i].classList.add("none");
    });
  }
}

function handleComments() {
  const commentBtn = document.querySelectorAll(".comment-btn");
  const commentForm = document.querySelectorAll(".comments");

  for (let i = 0; i < commentBtn.length; i++) {
    commentBtn[i].addEventListener("click", () => {
      commentForm[i].classList.toggle("none");
    });
  }
}

try {
  document.addEventListener("DOMContentLoaded", () => {
    handleComments();
  });
} catch (err) {
  console.log("Comments cannot be used!");
}

try {
  HandleError();
} catch (error) {
  console.log("Handle error cannot be used!");
}

try {
  const copyButton = document.getElementById("copy-btn");
  copyButton.addEventListener("click", copyToClipboard);
} catch (error) {
  console.log("Copy button cannot be used!");
}

try {
  handleRememberMe();
} catch (error) {
  console.log("Remember me cannot be used!");
}
