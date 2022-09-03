
// Gallery-image 

document.querySelectorAll('.container-image img').forEach(image =>{
    image.onclick = () =>{
        document.querySelector('.container-image__popup').style.display = 'block';
        document.querySelector('.container-image__popup img').src = image.getAttribute('src')
    }  
});

document.querySelector('.container-image__popup span').onclick = () =>{
    document.querySelector('.container-image__popup').style.display = 'none';
};

// var swiper = new Swiper(".mySwiper", {
//     slidesPerView: 3,
//     spaceBetween: 30,
//     slidesPerGroup: 3,
//     loop: true,
//     loopFillGroupWithBlank: true,
//     pagination: {
//         el: ".swiper-pagination",
//         clickable: true,
//     },
//     navigation: {
//         nextEl: ".swiper-button-next",
//         prevEl: ".swiper-button-prev",
//     },
// });

// Sticky-bar

window.onscroll = function(){
    stickyHeader()
};

function stickyHeader(){
    var header = document.getElementById("header-area");
    var sticky = header.offsetTop;

    if(window.pageYOffset > sticky){
        header.classList.add("sticky");
    }else{
        header.classList.remove("sticky");
    }
}

// window.addEventListener("scroll", function(){
//     var header = document.querySelector("header");
//     header.classList.toggle("sticky", window.scrollY > 0);
// });

// Search btn
var search_Click = document.getElementById("search-active");
search_Click.addEventListener("click", function(){
    var search_Inside = document.getElementById("main-search-active");
    search_Inside.classList.toggle("inside");
});

function search_Close(){
    var search_Inside = document.getElementById("main-search-active");
    search_Inside.classList.toggle("inside");
}


// Sort function
function upDateSort(){
    var SortBy = document.getElementById('SortBy');
    var Value = SortBy.options[SortBy.selectedIndex].value;
    let url = "index.php?f=product&file=allitem";
    
    window.location.href = url + "&SortBy=" + Value;
}

upDateSort();

function upDateLimit(){
    var Limit = document.getElementById('Limit');
    var Value = Limit.options[Limit.selectedIndex].value;
    let url = "index.php?f=product&file=allitem";
    
    window.location.href = url + "&Limit=" + Value;
}

upDateLimit();

function upDateSortMain(){
    var SortBy = document.getElementById('SortBy');
    var Value = SortBy.options[SortBy.selectedIndex].value;
    let url = "index.php?f=product&file=main&id=";
    var id = document.getElementById('id').value;
    
    window.location.href = url + id + "&SortBy=" + Value;
}

upDateSortMain();

function upDateLimitMain(){
    var Limit = document.getElementById('Limit');
    var Value = Limit.options[Limit.selectedIndex].value;
    let url = "index.php?f=product&file=main&id=";
    var id = document.getElementById('id').value;
    
    window.location.href = url + id + "&Limit=" + Value;
}

upDateLimitMain();

function nextPage(){
    var page = document.getElementById('page').value;
    var id = document.getElementById('id').value;
    let url = "index.php?f=product&file=main&id=";
    var Limit = document.getElementById('Limit');
    var SortBy = document.getElementById('SortBy');
    if(Sort != "ASC"){
        window.location.href = url + id + "&page=" + page + "&SortBy=" + SortBy;
        if(Limit != 9){
            window.location.href = url + id + "&page=" + page + "&SortBy=" + SortBy + "&Limit=" + Limit;
        }
    }
    if(Limit != 9){
        window.location.href = url + id + "&page=" + page + "&Limit=" + Limit;
    }
    window.location.href = url + id + "&page=" + page;
}

nextPage();

