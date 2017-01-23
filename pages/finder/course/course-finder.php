<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Learningspace – Course Finder</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.css" rel="stylesheet">

    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>



    <link href="../../../css/navbar-static-top.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    
    <!-- Learning Space Styles -->
    <link href="../../../style/learningspace.css" rel="stylesheet">

    <style>
    #region-main, .header-inner {
padding: 18px 20px;
-webkit-box-shadow: none;
-moz-box-shadow: none;
margin-bottom: 20px;
background: #fff;
border: 2px solid #ecedf0;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-box-shadow: none;
-moz-box-shadow: none;
margin-top: 42px;
font-family: "Roboto";
}

.pagination ul {
display: inline-block;
margin-bottom: 0;
margin-left: 0;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
-webkit-box-shadow: none;
-moz-box-shadow: none;
box-shadow: none;
}

#award-list li {
height: 70px;
list-style: none;
margin-left: 0;
margin-bottom: 0px;
padding-left: 0;
padding-right: 20px;
}

.pagination ul > li {
display: inline;

font-weight: bold;
}

.pagination ul > li > a{
  font-size: 14px ;
}

.pagination ul > .disabled > span, .pagination ul > .disabled > a, .pagination ul > .disabled > a:hover, .pagination ul > .disabled > a:focus{
  cursor: not-allowed;
}

@media (max-width: 979px){
#award-list li {
height: 70px;
list-style: none;
margin-left: 0;
margin-bottom: 0px;
padding-left: 0;
width: 100%;
padding-right: 20px;
}
}

    </style>

    <!--[if lt IE 9]>
<script src="../../dist/js/html5shiv.js"></script>
<![endif]-->

  <body>

<header role="banner" class="navbar navbar-fixed-top">
        <nav role="navigation" class="navbar-inner navbar-inverse">
            <div class="container-fluid">
                <a class="brand" href="/">Learning Space<?php //echo $SITE->shortname; ?></a>
             
          
            </div>
        </nav>
    </header>


    <div id="static-page-header">
      <div class="header-inner container-fluid">
        <div class="input-group filters">
          <input type="text" class="form-control form-search" placeholder="Search for courses...">
          <span class="input-group-addon glyphicon glyphicon-search"></span>
        </div>

        <div class="pagination">
        <ul class=" a-to-z">
          <li><a href="#">A</a></li>
          <li class="disabled"><a href="#">B</a></li>
          <li><a href="#">C</a></li>
          <li><a href="#">D</a></li>
          <li><a href="#">E</a></li>
          <li><a href="#">F</a></li>
          <li><a href="#">G</a></li>
          <li class="disabled"><a href="#">H</a></li>
          <li><a href="#">I</a></li>
          <li><a href="#">J</a></li>
          <li class="disabled"><a href="#">K</a></li>
          <li class="disabled"><a href="#">L</a></li>
          <li><a href="#">M</a></li>
          <li class="disabled"><a href="#">N</a></li>
          <li class="disabled"><a href="#">O</a></li>
          <li><a href="#">P</a></li>
          <li class="disabled"><a href="#">Q</a></li>
          <li><a href="#">R</a></li>
          <li><a href="#">S</a></li>
          <li><a href="#">T</a></li>
          <li class="disabled"><a href="#">U</a></li>
          <li class="disabled"><a href="#">V</a></li>
          <li class="disabled"><a href="#">W</a></li>
          <li class="disabled"><a href="#">X</a></li>
          <li class="disabled"><a href="#">Y</a></li>
          <li class="disabled"><a href="#">Z</a></li> 
        </ul>
      </div>

      <div class="pagination">
        <ul class=" a-to-z">
          
         
          <li class="info show-all"><a href="#">Show All</a></li>
        </ul>
      </div>
    </div>
      </div>

    <div id="region-main" class="container-fluid">

  
      <div class="alert-info alert none-found" style="display:none"><h3><strong>Oh dear!</strong> It appears that no courses were found... <a class="clear-form">Start over</a></h3></div>
      
      <div id="page-content" class="row-fluid">
        <div class="span12">
      <ul id="award-list" class="unlist ">
        <?php include ("courses.php"); ?>
      </ul>
    </div> <!-- /span12 -->
    </div> <!-- /row-fluid -->
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="placeholder.js"></script>
    
    <script>
      $(document).ready(function(){

        var awardListItem = $("#award-list > li")

        // When a user clicks on a-z filer
        $(".a-to-z").on("click", "li", function(){
            
          resetFilters();
          var selection = $(this);
          
          // Add "active" class to currently selected item
          selection.addClass("active");

          // reset the search field
          $('.filters .form-search').val("");

          // Hide all elements in award list
          awardListItem.hide();

          // get the letter that ws clicked
          var letterIndex = selection.find("a")
                                     .text()
                                     .toString();

          // find items in award list that have letter index of clicked letter
          $("#award-list").find("[data-letter-index='" + letterIndex + "']")
                          .each(function(){
            $(this).show();
          });

          if (selection.hasClass("disabled")){
            showNoneFoundMessage();
          } else if (selection.hasClass("show-all")){
            resetFilters();
          } else {
            hideNoneFoundMessage();
          }

        });

        // When a search has been entered to search field
        $(".filters").on("keyup", ".form-search", function(){
          
          resetFilters();

          // cache the value of search input, lowercased
          var search = $(this).val()
                              .toString()
                              .toLowerCase();
          
          // If there is no search entered into field
          if (search.length == 0) {

            // Show all awards in award list
            awardListItem.show();
            
            // Else if there is a search hide all elements in award list
            } else {
            awardListItem.hide();  
          }

          //hide none found error
          hideNoneFoundMessage();
            
          var awardList = "";

          // for each element in the award list
          awardListItem.each(function(){
                        
            var currentAwardListItem = $(this);

            // Get the award name, cast to lower case string
            awardName = currentAwardListItem.data("award-name")
                                            .toString()
                                            .toLowerCase();

            // add the award to award list
            awardList += awardName;

            // if the award name contains the search
            // show the item in the award list
            if (awardName.indexOf(search) != -1){
              currentAwardListItem.show();
            } 
          });

          // If the award list doesn't contain search, i.e. if the search returns nothing
          if (awardList.indexOf(search) === -1){
 
          // display the "none found" error message
          showNoneFoundMessage();
              
            // set award list to empty string
            awardList = "";  
          }
        
        });

        $(".clear-form").on("click", function(){
          resetFilters();
          $('.filters .form-search').val("");
        })

        // Display / Hide "none found" message
        var noneFoundMessage = $(".none-found");

        var showNoneFoundMessage = function(){
          noneFoundMessage.show();
        }

        var hideNoneFoundMessage = function(){
          noneFoundMessage.hide();
        }

        // Remove "active" class from currently selected item in a-z list
        var removeActiveSelection = function(){
          $(".a-to-z > li").removeClass("active");
        }

        var resetFilters = function(){
          awardListItem.show();
          removeActiveSelection();
          hideNoneFoundMessage();
        }

      // End Document ready
      });

    </script>
  </body>
</html>
