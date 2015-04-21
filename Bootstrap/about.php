<?php

require_once 'page_functions.php';

open_html("About");

echo<<<_END
    <div id="slideshow_container">  
	  <div class="slideshow">
	    <ul class="slideshow">
          <li class="show"><img width="940" height="250" src="images/main.png" alt="&quot;Georgia Rural Health Association&quot;" /></li>
          <li><img width="940" height="250" src="http://placehold.it/940x250" alt="&quot;Enter your caption here&quot;" /></li>
        </ul> 
	  </div> 	
	</div>	
    
	<div id="site_content">

	  <div class="sidebar_container">       
		<div class="sidebar">
          <div class="sidebar_item">
            <h2>The Association&#39;s mission includes</h2>
            <p>Promoting rural health as a distinct concern in Georgia 
			Serving as an advocate for rural health by promoting improved health status, healthcare systems, and health-related education for rural Georgians</p>

			<p>Encouraging the development of appropriate healthcare resources for residents of rural Georgia</p>
          </div>
        </div>   		
       </div>
	
	  <div id="content">
        <div class="content_item">
          <h2>About GRHA</h2>
			<p> Georgia Rural Health Association (GRHA) is the oldest state rural health association in the country. 
			Founded in 1981, this nonprofit network of healthcare providers, educators, and individuals is united in its 
			commitment to improve the health and healthcare services of rural Georgians. GRHA understands that the rural 
			areas in our state are unique and differ greatly from urban areas in our state. These rural communities, and 
			those who provide healthcare services to them, require educational programs and support tailored to their specific needs.</p>	
			<br />
			
			<h2>Rural Georgia Health Facts</h2>
			<p>Georgia has 108 rural counties. (click HERE for listing of rural counties in GA)</p>
			<ul>
				<li>Poverty rates for rural counties exceed those in urban counties by 58%.</li>
				<li>The rural counties have approximately half as many physicians and dramatic shortages of nurses, therapists, and nutritionists (per capita) as the metro counties.</li>
				<li>The crude death rate is higher in rural areas than the urban county rate. From Georgia Center for Rural Health and Research.</li>
				<li>Lower educational levels found in rural counties contribute to poverty and handicap the individual and family in making health decisions. </li>
			</ul>
			
		</div>
      </div>  
	</div>	
_END;
	
close_html();
	
?>
