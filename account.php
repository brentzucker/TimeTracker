<?php

require_once 'page_functions.php';

html_header("My Account");

echo<<<_END

 <div id="accordion-1">
      <h3>Tab 1</h3>
   <div>
      <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
         sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
         Ut enim ad minim veniam, quis nostrud exercitation ullamco 
         laboris nisi ut aliquip ex ea commodo consequat. 
      </p>
   </div>
   <h3>Tab 2</h3>
   <div>
      <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
         sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
         Ut enim ad minim veniam, quis nostrud exercitation ullamco 
         laboris nisi ut aliquip ex ea commodo consequat.     
      </p>
   </div>
   <h3>Tab 3</h3>
   <div>
      <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
         sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
         Ut enim ad minim veniam, quis nostrud exercitation ullamco 
         laboris nisi ut aliquip ex ea commodo consequat.     
      </p>
      
   </div>
   </div>

_END;

html_footer();

?>
