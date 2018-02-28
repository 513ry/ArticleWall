<?php
error_reporting(E_ALL);

require_once("../secure/blog_connect.php");

// create the querys
$post_query = $dbc->query ("SELECT * FROM post");
$post;
$cnt_query = $dbc->query ('SELECT COUNT(*) count FROM post');
$articles_amount;

if ($post_query && $cnt_query->num_rows) {
    $post = $post_query->fetch_object();

    print_r($post);

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
	    let n = <?php echo $articles_amount ?>;

	    if (n > 0) {
		for (let i = 0; i < n; i++) {		    
		    // create dom-module "box"
		    let b = document.createElement('div'),
			t = document.createElement('header'),
			c = document.createElement('article'),
			h = document.createElement('h1');

		    c.innerHTML = ("<?php echo addslashes($post->content); ?>");
		    c.className = ('content');
		    
		    h.innerHTML = ("<?php echo $post->title; ?>");
		    t.appendChild(h);
		    t.className = ('title');
		    
		    b.appendChild(t);
		    b.appendChild(c);
		    b.className = ('box');

		    let parent = document.getElementById('articles-feed');

		    // append html element
		    parent.insertBefore(b, parent.firstChild);
		}
	    } else {
		let parent = document.getElementById('articles-feed');
		let t = document.createTextNode('Oops.. articles feed is empty!');

		parent.appendChild(t);
	    }
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