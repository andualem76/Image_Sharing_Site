const btn = document.querySelector("like");

 
        // Add an event listener for
        // a click to the button
        btn.addEventListener("click", function (e) {
 
            // Add the required class
            btn.classList.add("liked");
        });