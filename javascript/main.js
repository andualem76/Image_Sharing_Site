navbar = document.querySelector(".catagories").querySelectorAll("a");
console.log(navbar);
navbar.forEach(element => {
    element.addEventListener("click", function(){
        navbar.forEach(nav=>nav.classList.remove("active"))
        this.classList.add("active")
    })
});

likes = document.querySelector(".big").querySelectorAll(".like");
console.log(likes);
likes.forEach(element => {
    element.addEventListener("click", function(){
        this.classList.toggle("liked")

    })
});

