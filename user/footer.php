 <!-- Footer Section -->
 <footer id="footer">
        <ul class="flex s-center w-80 m-auto my-2 res">
            <li><a href="#home" class="poppinss">Home</a></li>
            <li><a href="#signup" class="poppinss">Sign up</a></li>
            <li><a href="#signin" class="poppinss">Sign In</a></li>
            <li><a href="#courses" class="poppinss">Courses</a></li>
            <li><a href="#about" class="poppinss">About</a></li>
        </ul>
        <ul class="flex s-center w-80 font-awesome ">
            <a href="https://in.linkedin.com/" target="_blank">
                <li><i class="fa-brands fa-linkedin-in"></i></li>
            </a>
            <a href="https://github.com/" target="_blank">
                <li><i class="fa-brands fa-github"></i></li>
            </a>
            <a href="https://www.instagram.com/" target="_blank">
                <li><i class="fa-brands fa-instagram"></i></li>
            </a>
            <a href="https://www.youtube.com/" target="_blank">
                <li><i class="fa-brands fa-youtube"></i></li>
            </a>
        </ul>
        <p class="t-center my-2 poppins">&copy; All Rights Reserved - <span class="cpy-white poppins">Yukti</span></p>
    
    </footer>

    <div id="scroll-top" onclick="scrolltop()">
        <span><i class="fa-solid fa-arrow-up"></i></span>
    </div>

</body>

<script src="myjs/script.js"></script>

<script>
    // Get references to the buttons
    const viewButton = document.getElementById('viewButton');
    const saveButton = document.getElementById('saveButton');

    // Function to open the videoplayer.html page
    viewButton.addEventListener('click', function () {
        window.open('videoplayer.html', '_blank');
    });

    // Function to toggle the text of the "Save" button
    let isSaved = false;
    saveButton.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default behavior of the anchor element
        isSaved = !isSaved;
        saveButton.textContent = isSaved ? 'Saved' : 'Save';
    });
</script>



</body>
</html>