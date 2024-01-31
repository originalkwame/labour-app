<?php
require __DIR__ . '/includes/classes/session.php';

global $database, $session;
?>

<?php
include 'title.php';
include 'header.php';
?>

    <style media="screen">
    .container {
      width: 200px;
      height: 260px;
      position: relative;
     
      border: 1px solid #CCC;
      -webkit-perspective: 800px;
         -moz-perspective: 800px;
           -o-perspective: 800px;
              perspective: 800px;
    }

   #card {
      width: 100%;
      height: 100%;
      position: absolute;
      -webkit-transition: -webkit-transform 1s;
         -moz-transition: -moz-transform 1s;
           -o-transition: -o-transform 1s;
              transition: transform 1s;
      -webkit-transform-style: preserve-3d;
         -moz-transform-style: preserve-3d;
           -o-transform-style: preserve-3d;
              transform-style: preserve-3d;
    }

    #card.flipped {
      -webkit-transform: rotateY( 180deg );
         -moz-transform: rotateY( 180deg );
           -o-transform: rotateY( 180deg );
              transform: rotateY( 180deg );
    }

      #card figure {
      display: block;
      height: 100%;
      width: 100%;
      line-height: 260px;
      color: white;
      text-align: center;
      font-weight: bold;
      font-size: 140px;
      position: absolute;
      -webkit-backface-visibility: hidden;
         -moz-backface-visibility: hidden;
           -o-backface-visibility: hidden;
              backface-visibility: hidden;
    }

    #card .front {
      background: red;
    }

    #card .back {
      background: blue;
      -webkit-transform: rotateY( 180deg );
         -moz-transform: rotateY( 180deg );
           -o-transform: rotateY( 180deg );
              transform: rotateY( 180deg );
    }
  </style>

</head>
<body>


   <section class="container">
    <div id="card">
      <figure class="front">1</figure>
      <figure class="back">2</figure>
    </div>
  </section>

  <section id="options">
   
     <button class="flip">Flip 1</button>
  </section>





<script>


document.querySelector("#card").classList.toggle('.flipped');
</script>

</body>
</html>
