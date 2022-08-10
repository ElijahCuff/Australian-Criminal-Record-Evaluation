<?php
include("search.php");
$results = $output;
$listed_results = "";
foreach($results as $info)
{
  $name = $info['name'];
  $type = $info['type'];
  if($type == "cr")
   { $type = "Criminal"; }
if($type == "cr")
   { $type = "Civil"; }

  $records = $info['count'];
  $listed_results .= '<tr><td class="body-item mbr-fonts-style display-7">'.$name.'</td><td class="body-item mbr-fonts-style display-7">'.$records.'</td><td class="body-item mbr-fonts-style display-7">'.$type.'</td></tr>';
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/poop.png.png-128x128.png" type="image/x-icon">
  <meta name="description" content="">
  <title>Results</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/datatables/data-tables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>
  <section class="mbr-section content5 cid-te48REz4y8" id="content5-6">

    

    

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                
                
                
                <div class="mbr-section-btn align-center"><a class="btn btn-primary display-7" href="lookup.html"><span class="mbri-search mbr-iconfont mbr-iconfont-btn"></span>SEARCH AGAIN</a></div>
            </div>
        </div>
    </div>
</section>

<section class="section-table cid-te4bp7ZAwq" id="table1-7">

  
  
  <div class="container container-table">
      <h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">Results</h2>
      <h3 class="mbr-section-subtitle mbr-fonts-style align-center pb-5 mbr-light display-7">"<em>Refine results by searching for a middle name</em>"</h3>
      <div class="table-wrapper">
        <div class="container">
          <div class="row search">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="dataTables_filter">
                  <label class="searchInfo mbr-fonts-style display-7">Search:</label>
                  <input class="form-control input-sm" disabled="">
                </div>
            </div>
          </div>
        </div>

        <div class="container scroll">
          <table class="table isSearch" cellspacing="0">
            <thead>
              <tr class="table-heads ">
                  
                  
                  
                  
              <th class="head-item mbr-fonts-style display-7">
                      NAME</th><th class="head-item mbr-fonts-style display-7">RECORDS</th><th class="head-item mbr-fonts-style display-7">COURT</th></tr>
            </thead>

            <tbody>
              
              
              
              <?php echo $listed_results; ?>

</tbody>
          </table>
        </div>
        <div class="container table-info-container">
          <div class="row info">
            <div class="col-md-6">
              <div class="dataTables_info mbr-fonts-style display-7">
                <span class="infoBefore">Showing</span>
                <span class="inactive infoRows"></span>
                <span class="infoAfter">entries</span>
                <span class="infoFilteredBefore">(filtered from</span>
                <span class="inactive infoRows"></span>
                <span class="infoFilteredAfter"> total entries)</span>
              </div>
            </div>
            <div class="col-md-6"></div>
          </div>
        </div>
      </div>
    </div>
</section>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/cookies-alert-plugin/cookies-alert-core.js"></script>
  <script src="assets/cookies-alert-plugin/cookies-alert-script.js"></script>
  <script src="assets/datatables/jquery.data-tables.min.js"></script>
  <script src="assets/datatables/data-tables.bootstrap4.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
  
<input name="cookieData" type="hidden" data-cookie-colorText='#424a4d' data-cookie-colorBg='rgba(234, 239, 241, 0.99)' data-cookie-colorButton='#ffffff' data-cookie-colorLink='#424a4d' data-cookie-underlineLink='true' data-cookie-text="We use cookies to give you the best experience.">
  </body>
</html>