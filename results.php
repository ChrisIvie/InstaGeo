<?php
if (!empty($_GET['location'])){
  /**
   * Here we build the url we'll be using to access the google maps api
   */
  $maps_url = 'https://'.
  'maps.googleapis.com/'.
  'maps/api/geocode/json'.
  '?address=' . urlencode($_GET['location']);
  $maps_json = file_get_contents($maps_url);
  $maps_array = json_decode($maps_json, true);
  // Getting the latitude from the Google maps API
  $lat = $maps_array['results'][0]['geometry']['location']['lat'];
  // Getting the longitude from the Google maps API
  $lng = $maps_array['results'][0]['geometry']['location']['lng'];
  /**
   * Time to make our Instagram api request. We'll build the url using the
   * coordinate values returned by the google maps api
   */
  $instagram_url = 'https://'.
    'api.instagram.com/v1/media/search' .
    '?lat=' . $lat .
    '&lng=' . $lng .
    '&client_id=4173458cee254a64b15ba24f9e5a40fc'; //replace "CLIENT-ID"
  $instagram_json = file_get_contents($instagram_url);
  $instagram_array = json_decode($instagram_json, true);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <title>InstaGeoSearch</title>
        <!--Link to results style sheet-->
        <link rel="stylesheet" type="text/css" href="css/resultstyle.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <!--Google Analytics-->
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-65742139-1', 'auto');
          ga('send', 'pageview');

        </script>

  </head>
  <body>
  <center>
      <!--Just a normal form with a get method-->
    <form action="results.php" method="get">
        <!--Setting the placeholder to the previous search -->
      <input type="text" name="location" placeholder="<?php echo ($_GET['location']); ?>"/>
    </form>
    <br/>



    <div id="wrapper">
    <?php
    if(!empty($instagram_array)){
      foreach($instagram_array['data'] as $key=>$image){
        //Requesting image and making it clickable
        echo '<div id="box"> <div class="picture"> <a href='.$image['link'].'> <img src="'.$image['images']['standard_resolution']['url'].'"/></a></br></div>';
        //Requesting the username and making it clickable
        echo '<div class="username"> <a href=https://instagram.com/'.$image['user']['username'].'>'.$image['user']['username'].'</a></div>';
        //Getting the like count
        echo '<div class="likes">'.$image['likes']['count'].' Likes</div></div>';

      }
    }
    ?>



  </div>
  </center>
  </body>
</html>
