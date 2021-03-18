<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME_PAGE</title>
  <link rel="stylesheet" href="alux.min.css">
</head>

<body>

<div class="nav-wrap">

	  <div class="grid no-pad-menu">
	    <div class="nav-header">
	      <a href="#" class="logo">V-HYPE HYPERSTORE</a>
	      <div class="tog" data-target="menu-sub-2">
	        <span class="animate"></span>
	        <span class="span-middle animate"></span>
	        <span class="animate"></span>
	      </div>
        

        <!--<ul class="pri">
          <li><a href="http://localhost/cars/custlogin.php">Back</a></li>
        </ul>-->
        <style>
          .pri
          {
            position:relative;
            left:850%;
            top:-30%;
          }
        </style>


	    </div>
	    <nav class="nav-container" id="menu-sub-2">
	      
	    </nav>
	  </div>
	 </div>
	 <div class="clearfix"></div>

    <div class="container-siema">
      <div class="siema">
      <div class="siema__slide" style="background: url(back3.png) center center ;background-size: cover;">
        <div class="siema__filter"></div>
        <div class="siema__caption">
           <h1>V-HYPE</h1>
           <h2>Shopping made EASY</h2>
           <p></p>
           
        </div>
      </div>
      <div class="siema__slide" style="background: url(b1.png)center center;background-size: cover;">
        <div class="siema__filter"></div>
        <div class="siema__caption">
          <h3 class="huge">SELECT-->TRY-ON-->BUY</h3>
          <h2>Try the new best and shop the one that best suits you.</h2>
        </div>
      </div>
      <div class="siema__slide" style="background: url(back5.jpg)center center;background-size: cover;">
        <div class="siema__filter"></div>
        <div class="siema__caption">
          <h3 class="huge">Smart grocery store utility </h3>
          <h2>We help you with shopping</h2>
        </div>
      </div>
    </div>
    <div class="container-siema__prev"><div class="alux-arrow">prev</div></div>
    <div class="container-siema__next"><div class="alux-arrow">next</div></div>
  </div>



    
   
    <section class="grid mb-3" id="cards">

      <div class="col-50">
        <div class="card">
          <div class="tile filter" style="background: url(a5.png) center center; background-size: cover;">
            <div class="tile__text">
              <h3 class="mb-0">SHOP dresses and fashion accessories</h3>
              <h4 class="small">A virtual trial room</h4>
              <a class="button1 animate" href="http://localhost/cip/home.html">Click here</a>
            </div>
          </div>
          
        </div>
      </div>

      <div class="col-50">
        <div class="card">
          <div class="tile filter" style="background: url(gs.png) center center;background-size: cover;">
            <div class="tile__text">
              <h3 class="mb-0">A Grocery shopping utility</h3>
              <h4 class="small">Know what you see</h4>
               <a class="button2 animate" href="http://localhost/cip/gfirstpage.html">Click Here</a>
            </div>
          </div>
        </div>
      </div>
      


    </section>


  

<script src="js3/alux.min.js"></script>

<script>
var next = document.querySelector(".container-siema__next");
var prev = document.querySelector(".container-siema__prev");
var slideCount = document.querySelector(".siema").children.length - 1;

var mySiema = new Siema({
  loop: true,
});

prev.addEventListener("click", function () {
  return mySiema.prev();
});

next.addEventListener("click", function () {
  return mySiema.next();
});
</script>






</body>
</html>
