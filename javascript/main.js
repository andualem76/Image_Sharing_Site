$(document).ready(function(){

    // if the user clicks on the like button ...
    $('.like').on('click', function(){
      var image_id = $(this).data('id');
      $clicked_btn = $(this);
      if ($clicked_btn.hasClass('not_liked')) {
          action = 'like';
      } else if($clicked_btn.hasClass('liked')){
          action = 'unlike';
      }
   
      $.ajax({
          url: 'index.php',
          type: 'post',
          data: {
              'action': action,
              'image_id': image_id
          },


          success: function(data){
              res = JSON.parse(data);
              console.log(data)
            if (action == "like") {
                $clicked_btn.removeClass('not_liked');
                $clicked_btn.addClass('liked');
            } else if(action == "unlike") {
                $clicked_btn.removeClass('liked');
                $clicked_btn.addClass('not_liked');
            }

         
              $clicked_btn.siblings('span.no_likes').text(res.likes);
          
          }
      });	

      $.ajax({
        url: 'http://localhost/image_sharing_site/pages/catagories.php',
        type: 'post',
        data: {
            'action': action,
            'image_id': image_id
        },


        success: function(data){
            res = JSON.parse(data);
            console.log(data)
          if (action == "like") {
              $clicked_btn.removeClass('not_liked');
              $clicked_btn.addClass('liked');
          } else if(action == "unlike") {
              $clicked_btn.removeClass('liked');
              $clicked_btn.addClass('not_liked');
          }

       
            $clicked_btn.siblings('span.no_likes').text(res.likes);
        
        }
    });	

    $.ajax({
        url: 'http://localhost/image_sharing_site/pages/profile.php',
        type: 'post',
        data: {
            'action': action,
            'image_id': image_id
        },


        success: function(data){
            res = JSON.parse(data);
            console.log(data)
          if (action == "like") {
              $clicked_btn.removeClass('not_liked');
              $clicked_btn.addClass('liked');
          } else if(action == "unlike") {
              $clicked_btn.removeClass('liked');
              $clicked_btn.addClass('not_liked');
          }

       
            $clicked_btn.siblings('span.no_likes').text(res.likes);
        
        }
    });	

    });

});
navbar = document.querySelector(".catagories").querySelectorAll("a");
console.log(navbar);
navbar.forEach(element => {
    element.addEventListener("click", function(){
        navbar.forEach(nav=>nav.classList.remove("active"))
        this.classList.add("active")
        
    })
});
