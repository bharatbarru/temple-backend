$(function () {
    $(".home-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 10000,
        arrows: false,
        dots: true,
        infinite: false,
        speed: 1500,
        fade: false,
        cssEase: "linear",
        
    });
   
    $(".five-items").slick({
      centerMode: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 5000,
      arrows: false,
      dots: false,
      infinite: true,
      speed: 1500,
      fade: false,
      cssEase: "linear",
        responsive: [
            {
              breakpoint: 768,
              settings: {
            
                slidesToShow: 2,
              }
            },
            {
              breakpoint: 480,
              settings: {
             
                slidesToShow: 1,
              }
            }
          ]
    });


    $(".menu-items-list").slick({
   
     
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 300,
      arrows: true,
      dots: false,
      infinite: false,
      speed: 300,
      variableWidth: true,
      fade: false,
      cssEase: "linear",
        responsive: [
            {
              breakpoint: 768,
              settings: {
            
                slidesToShow: 2,
              }
            },
            {
              breakpoint: 480,
              settings: {
             
                slidesToShow: 1,
              }
            }
          ]
    });

   
    });


