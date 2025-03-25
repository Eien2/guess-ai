export function loggedHeader() {
  const signupLink = document.querySelector(".signup-link");
  signupLink.innerText = "Log Out";
  signupLink.classList.add("logout-link");
  signupLink.setAttribute("href", "/guess-ai/index.php");
  signupLink.classList.remove("signup-link");


  document.querySelector(".login-link").remove();

  const homeLink = document.querySelector(".home-link");
  homeLink.innerText = "Welcome Page";
  homeLink.classList.add("welcome-link");
  homeLink.setAttribute("href", "/guess-ai/expages/welcome.php");
  homeLink.classList.remove("home-link");

}
