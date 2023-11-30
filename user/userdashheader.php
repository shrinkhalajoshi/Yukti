<?php
include("withoutsearch.php");
?>
<!-- Home Section -->
<section id="home" class="flex s-around sw-80 m-auto">
        <div class="home-left flex items-center">
            <div class="home-content">
                <h6 class="poppinss">Yukti</h6>
                <h1 class="t-white">An online Learning Platform</h1>
                <h4 class="poppinss">Explore your Creativity with courses in Nepali</h4>
                <form action="usersearch.php" method="post">
                    <input type="text" placeholder="Search..." name="keyword"class="search-input">
                    <button type="submit" name="usersearchhere" class="search-btn"><i class="fa-solid fa-search"></i></button>
                </form>
            </div>
        </div>
       
    </section>