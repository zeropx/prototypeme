<?php

/*
  Define the base location for stuff
*/

if (dirname($_SERVER['SCRIPT_NAME']) != "/") {
  $baseurl = dirname($_SERVER['SCRIPT_NAME']) . "/";
} else {
  $baseurl = dirname($_SERVER['SCRIPT_NAME']);
}

define('BASEURL', $baseurl);
define('BASE_PATH', realpath('.') . "/");
define('APP_PATH', BASE_PATH . 'app/');
define('CONTENT_PATH', BASE_PATH . 'pages/');
define('PARTIALS_PATH', BASE_PATH . "partials/");

// Misc config
define('DEFAULT_INDEX_PAGE', 'home');
/*

    Various functions below that make this work
*/

/**
 * Get url arguments,
 * I took this from Drupal..
 * @param string $index
 * @param string $path
 * @return array
 */
function arg($index = NULL, $path = NULL) {
  static $arguments;

  /*
    If the query hasn't been set for q, then return false.
  */
  if (!isset($_GET['q']))
  {
    return false;
  }

  if (!isset($path))
  {
    $path = $_GET['q'];
  }

  if (!isset($arguments[$path]))
  {
    $arguments[$path] = explode('/', $path);
    $arguments[$path] = str_replace("-", "_", $arguments[$path]);
  }

  if (!isset($index))
  {
    return $arguments[$path];
  }

  if (isset($arguments[$path][$index]))
  {
    return $arguments[$path][$index];
  }

}

/**
 * Get page based on arguments,
 * I feel this needs more work
 * the basic works so far.
 *
 * @param string $arg
 * @return void
 * @author Eric Casequin
 */
function get_page($arg = NULL)
{

  if (!isset($arg))
  {
    $arg = arg();

    if ($arg === FALSE) {
      $arg[0] = DEFAULT_INDEX_PAGE;
    }
    $file = CONTENT_PATH . get_file_path($arg);
    if ( file_exists($file) )
    {
      return get_content($file);
    }
    else
    {
      return get_content(CONTENT_PATH . "404.php");

    }
  }

}

/**
 * Get pat to the file based on arguments.
 * this is not sanitized yet and needs to be.
 *
 * @param string $arg
 * @return string
 * @author Eric Casequin
 */
function get_file_path($arg)
{
  // Should sanitize this
  return implode("/", $arg) . ".php";
}


/**
 * Get contents with variable passed to view.
 * this fucntion basically gets the file as an include into
 * a buffer and then sends buffer to variable.
 *
 * @param string $file
 * @param string $arg
 * @return string
 * @author Eric Casequin
 */
function get_content($file = NULL, $arg = array())
{

  ob_start();
  include $file;

  $buffered_content = ob_get_contents();
  ob_end_clean();

  return $buffered_content;
}


function partial($partial) {
  $partial_file = PARTIALS_PATH . $partial . ".php";
  if ( file_exists($partial_file) ) {
    include $partial_file;
  } else {
    print '<pre style="color: #333; background-color: #FEEBD2; border: 1px solid #E3D3BA; padding: 3px; margin-bottom: 3px; font-size: 10px; font-family: Monaco">';
    print 'PARTIAL NOT FOUND - ' . $partial_file;
    print "</pre>";
  }

}













// /**
// * Prototypeme
// * Moving stuff into a class later.
// * because it will be easier to pass values
// */
// class PrototypeMe
// {

//   function __construct()
//   {
//     $this->basepath = BASE_PATH;
//   }

//   /**
//    * Get url arguments,
//    * I took this from Drupal..
//    * @param string $index
//    * @param string $path
//    * @return array
//    */
//   function arg($index = NULL, $path = NULL) {
//     static $arguments;

//     /*
//       If the query hasn't been set for q, then return false.
//     */
//     if (!isset($_GET['q']))
//     {
//       return false;
//     }

//     if (!isset($path))
//     {
//       $path = $_GET['q'];
//     }

//     if (!isset($arguments[$path]))
//     {
//       $arguments[$path] = explode('/', $path);
//       $arguments[$path] = str_replace("-", "_", $arguments[$path]);
//     }

//     if (!isset($index))
//     {
//       return $arguments[$path];
//     }

//     if (isset($arguments[$path][$index]))
//     {
//       return $arguments[$path][$index];
//     }

//   }

//   /**
//    * Get page based on arguments,
//    * I feel this needs more work
//    * the basic works so far.
//    *
//    * @param string $arg
//    * @return void
//    * @author Eric Casequin
//    */
//   function get_page($arg = NULL)
//   {

//     if (!isset($arg))
//     {
//       $arg = arg();

//       if ($arg === FALSE) {
//         $arg[0] = DEFAULT_INDEX_PAGE;
//       }
//       $file = CONTENT_PATH . get_file_path($arg);
//       if ( file_exists($file) )
//       {
//         return get_content($file);
//       }
//       else
//       {
//         return get_content(CONTENT_PATH . "404.php");

//       }
//     }

//   }

//   /**
//    * Get pat to the file based on arguments.
//    * this is not sanitized yet and needs to be.
//    *
//    * @param string $arg
//    * @return string
//    * @author Eric Casequin
//    */
//   function get_file_path($arg)
//   {
//     // Should sanitize this
//     return implode("/", $arg) . ".php";
//   }


//   /**
//    * Get contents with variable passed to view.
//    * this fucntion basically gets the file as an include into
//    * a buffer and then sends buffer to variable.
//    *
//    * @param string $file
//    * @param string $arg
//    * @return string
//    * @author Eric Casequin
//    */
//   function get_content($file = NULL, $arg = array())
//   {

//     ob_start();
//     include $file;

//     $buffered_content = ob_get_contents();
//     ob_end_clean();

//     return $buffered_content;
//   }


//   /**
//    * Partials
//    * Retrieve a partial of content
//    *
//    * @param string $partial
//    * @author Eric Casequin
//    */
//   function partial($partial) {
//     $partial_file = PARTIALS_PATH . $partial . ".php";
//     if ( file_exists($partial_file) ) {
//       include $partial_file;
//     } else {
//       print '<pre style="color: #333; background-color: #FEEBD2; border: 1px solid #E3D3BA; padding: 3px; margin-bottom: 3px; font-size: 10px; font-family: Monaco">';
//       print 'PARTIAL NOT FOUND - ' . $partial_file;
//       print "</pre>";
//     }

//   }



// }

// $protoype = new PrototypeMe();












