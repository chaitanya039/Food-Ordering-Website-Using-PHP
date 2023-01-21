const navbar = document.querySelector('.navbar');
const menuBtn = document.querySelector('#menu-btn');
const closeBtn = document.querySelector('#close-btn');
const searchBtn = document.querySelector("#search-btn");
const searchForm = document.getElementById('search-form');

menuBtn.addEventListener('click' , () => {
    navbar.classList.toggle('active');
});

closeBtn.addEventListener('click', () => {
    navbar.classList.remove('active');
});

searchBtn.addEventListener('click', () => {
    searchForm.classList.toggle('active');
});


window.onscroll = () => {
    
    navbar.classList.remove('active');

    if (window.scrollY > 0) {
        document.querySelector('header').classList.add('active');
    }
    else
    {
        document.querySelector('header').classList.remove('active');
    }
}

window.onload = () => 
{
    if (window.scrollY > 0) {
        document.querySelector('header').classList.add('active');
    }
    else
    {
        document.querySelector('header').classList.remove('active');
    }
}

var swiper = new Swiper(".adv-slider", {
    loop: true,
    grabCursor : true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    spaceBetween: 20,
    breakpoints: {
      0 : {
        slidesPerView : 1
      },
      640: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 3,
      },
      1024: {
        slidesPerView: 4,
      },
    },
  });
