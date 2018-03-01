<?php
error_reporting(E_ALL);

require_once("../secure/blog_connect.php");

// create the querys
$post_query = $dbc->query ("SELECT * FROM post");
$post;
$post_2;
$cnt_query = $dbc->query ('SELECT COUNT(*) count FROM post');
$articles_amount;

if ($post_query && $cnt_query->num_rows) {
    // execute the query and put data into an array holding
    // array with fetched row
    $i = 0;
    while ($post = mysqli_fetch_array($post_query)) {
        $post_2[$i] = $post;
        $i ++;
    }

    $tmp = $cnt_query->fetch_object();
    $articles_amount = $tmp->count;
    
} else {
    echo "<style> body {padding: 10px !important;} main {display: none !important;} </style> 
<h3 style=\"color: grey; text-align: center !important;\"> Sorry, but the database connection is failing!
We are fixing this now. </h3>";
    mysqli_error($dbc);
}


// authorisate user

// show user interface

const FOUNDER = "Daniel Sierpiński";
const FOUNDED = "2018";
// detete this `if` after new year 2019
$year = date("Y");
if ($year == FOUNDED)
    $ownerSign = FOUNDER . " © " . FOUNDED;
else
    $ownerSign = FOUNDER . " © " . FOUNDED . "-" . $year;

?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> Str84word - Algorithms, Programming, C++ </title>
    <!-- CSS LINKS -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/mobile-post.css" />
    
  </head>
  
  <body>
    <main>
      <!-- MAIN HEADER -->
      <header class="top-bar">
	<nav class="main-nav-wrapper">
	  <div class="logo-wrapper">
	    <div onclick='link("index.php");' class="logo"></div>
	  </div>

	  <button onclick="generateArticles();"> Load Article Feed </button>
	  
	  <div class="claer"></div>
	</nav>
      </header>

      <div id="articles-feed" class="body-wrapper">
	<!-- ARTICLE DATA GENERATION -->
	
      </div>

      <!-- FOOTER -->
	<footer>
	  <?php echo $ownerSign; ?>
	</footer>
      
    </main>


    <!-- JAVASCRIPT -->
    <script type="text/javascript">
      function link(l) {
	  window.location.replace(l);
      }

      function generateArticles() {
	  <?php
      if ($articles_amount > 0) {
          echo "let n = $articles_amount;";
          for ($i = 0; $i < $articles_amount; $i++) {
              echo "
              let b$i = document.createElement(\"div\"),
		      t$i = document.createElement(\"header\"),
              c$i = document.createElement(\"article\"),
              h$i = document.createElement(\"h1\");
            
              c$i.innerHTML = ( \"" . addslashes($post_2[$i][1]) . "\" );
              c$i.className = (\"content\");
      
              h$i.innerHTML = ( \"" . addslashes($post_2[$i][0]) . "\" );
              t$i.appendChild(h$i);
              t$i.className = (\"title\");
      
              b$i.appendChild(t$i);
              b$i.appendChild(c$i);
              b$i.className = (\"box\");
      
              let parent$i = document.getElementById(\"articles-feed\");
      
              // append html element
              parent$i.insertBefore(b$i, parent$i.firstChild);
      ";
          }
      } else {
	  echo "console.log('no articles to be loadet')";
      }
            
      ?>
	  
      }
      
      function toggleNavPanel() {
	  let e = document.getElementById("toggle-nav-wrapper");
	  
	  if (e.style.display === "none") {
	      e.style.display = "block";
	  } else {
	      e.style.display = "none";
	  }
      }

    </script>

    
  </body>

</html>
