<nav class="navbar navbar-expand-lg bg-body-tertiary py-3" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/blog">MyBlogWebsite</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/blog">All Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/general.php">General</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/finance.php">Finance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/sports.php">Sports</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/politics.php">Politics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/education.php">Education</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category/jokes.php">Jokes</a>
        </li>
      </ul>
      <div class="d-flex align-items-center justify-content-center gap">
        <div><a class="nav-link" href="<?php echo $_SESSION['user'] ?? null ? "logout.php" : "register.php" ?>"><?php echo $_SESSION['user'] ?? null ? "Logout" : "Login/Register" ?></a></div>
        <div><span class="pr-3"><?php  echo $_SESSION['user'] ?? null ? $_SESSION['user']['username'] : 'Guest' ?></span><i class="fa-solid fa-user"></i></div>
      </div>
    </div>
  </div>
</nav>
<marquee class="bg-warning" width="100%" direction="left" height="fit-content" scrollamount=15>
I own no right to content published on this website. This website is only temporarily live to serve as portfolio/sample website. All content and data will be deleted immediately the site is offline. Thank you, your feedbacks are most appreciated.
</marquee>