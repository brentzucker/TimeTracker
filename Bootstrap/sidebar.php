<?php

require_once(__DIR__.'/../include.php');
require_once(__DIR__.'/page_functions.php');

open_html("Home");

//Keep all content in the div #page-content-wrapper

echo<<<_END
<div id="page-content-wrapper"> 
                <div class="col-lg-12">
                    <h1>Home</h1>
                </div>
            </div>
        </div>
    </div>
    
</div>
_END;

close_html();

?>