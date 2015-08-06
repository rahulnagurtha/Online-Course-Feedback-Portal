<?php

require_once('../config.php');
require_once(BASE_PATH.'/medoo.min.php');
require_once(BASE_PATH.'/login_handler.php');
require_once(BASE_PATH.'/components/nav.php');


  /*
  Login handling and permission check
   */
  $login = new loginHandler($config);
  if(!$login->is_logged_in()) {
    $login->redirect_login('Please login');

  }

  if($login->get_user_type() != 'admin') {
    $login->not_authorized_error();
  }



if(isset($_POST['code'])) {
  //process add course request
  
  //insert into courses
  $db = new medoo($config['db']);
  $courseid = $db->insert('courses',['code' => $_POST['code'], 'name' => $_POST['name'], 'instructor' => $_POST['instructor']]);

  //insert into student_course
  $extras = explode(',', $_POST['extra']);
  $extras = array_filter($extras, function($val) {return ($val!==''&&$val!=' ');});
  
  if(count($extras)) {
  for($i=0;$i<count($extras);$i++) {
    $res = $db->select('students', ['userid'], ['username' => trim($extras[$i])]);
    $extras[$i] = $res[0]['userid'];
  }
}
  
   $backs = explode(',', $_POST['backs']);
   $backs = array_filter($backs, function($val) {return ($val!==''&&$val!=' ');});
  if(count($backs)) {
  for($i=0;$i<count($backs);$i++) {
    $res = $db->select('students', ['userid'], ['username' => trim($backs[$i])]);
    $backs[$i] = $res[0]['userid'];
  }
  }





  //extras and backs now contains user ids
  $students = $extras;
  //adding all students of given class
  $res = $db->select('students', ['userid'], ['class' => $_POST['class']]);
  foreach($res as $stud) {
    if(!in_array($stud['userid'], $backs)) {
      $students[] = $stud['userid']; 
    }
  }

  //add course to all students in student_course linkage
  foreach($students as $student) {
    $db->insert('student_course', ['student' => $student, 'course' => $courseid, 'done' => 0]);
  }

  //when done redirect to course list
  header('Location: '.$config['url']['base_url'].$config['url']['admin_course_list']);



}

else {



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add course</title>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <!-- Bootstrap -->
    <link href="<?php echo $config['url']['base_url']; ?>/css/bootstrap.min.css" rel="stylesheet">

    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
  }

  .ui-widget {
    margin-bottom: 20px;
  }
  </style>
  <script src="<?php echo $config['url']['base_url']; ?>/js/jquery-2.1.1.min.js"></script>
  <script src="<?php echo $config['url']['base_url']; ?>/js/jquery-ui.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
  <script>
  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {
    $( "#combobox" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#combobox" ).toggle();
    });
  });
  </script>

  <?php
  $db = new medoo($config['db']);
  ?>

  <script>
  $(function() {
    var availableTags = [

    <?php 
      $results = $db->select('students', ['userid', 'username']);
      foreach($results as $result) { echo "'".$result['username']."',"; }
     ?>
    
    ];
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#tags, #backs" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            availableTags, extractLast( request.term ) ) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
      
  });
  </script>

  <script>
  $(function() {
    $("input[type=submit], input[type=text]").button();
  });
  </script>

  </head>
  <body>
  <div class="container">
  <?php $nav = new Nav($config, ['admin_dashboard','student_settings','logout'], __FILE__); ?>
   

    <div class="row">
    <div class="col-md-12" style="text-align: center;">
    <h1>Create new course</h1>
    </div>
    <br><br><br><Br>
    </div>
    <div class="row">

<div class="col-md-6 col-md-offset-3" style="text-align: center;">
<form action="addcourse.php" method="post">

<div class="row ui-widget">
  <label>Course Code:</label>
  <input type="text" name="code">
</div>

<div class="row ui-widget">
  <label>Course Name:</label>
  <input type="text" name="name">
</div>

<div class="row">
<div class="ui-widget">
  <label>Instructor: </label>
  <select id="combobox" name="instructor">
  <option value="">Select instructor</option>
  <?php 
    $results = $db->select('profs', ['userid','name']);
    foreach($results as $result) {
  ?>
    
    <option value="<?php echo $result['userid']; ?>"><?php echo $result['name']; ?></option>
    <?php } ?>
    
  </select>
</div>
</div>

<div class="row ui-widget">
  <label>Course class:</label>
  <select name="class">
  <option value="btech 13">Btech 2013</option>
  <option value="btech 14">BTech 2014</option>
    
  </select>
</div>

<div class="row ui-widget">
<label for="tags">Extra students: </label><br>
  <input id="tags" name="extra" size="50">

</div>

<div class="row ui-widget">
<label for="backs">Backloggers: </label><br>
  <input id="backs" name="backs" size="50">

</div>

<div class="row ui-widget">

  <input type="submit" value="Create course">

</div>

</form>

</div>

</div>
</div>

    
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $config['url']['base_url']; ?>/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
}
?>