<?php

require_once(__DIR__.'/../include.php');
require_once(__DIR__.'/page_functions.php');

open_html("Home");

//Keep all content in the div #page-content-wrapper

echo<<<_END
<div id="page-content-wrapper"> 

    <div class="container-fluid">
            <div class="row">
            <a href="#menu-toggle" class="glyphicon glyphicon-menu-hamburger" id="menu-toggle">Menu</a>
                <div class="col-lg-12">
                    <h1>Simple Sidebar</h1>
                    <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                    <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                </div>
            </div>
        </div>
    </div>
    
</div>
_END;

close_html();

?>