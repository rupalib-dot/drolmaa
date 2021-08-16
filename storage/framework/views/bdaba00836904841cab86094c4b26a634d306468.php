<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
<script src="<?php echo e(asset('front_end/js/file-upload-with-preview.min.js')); ?>"></script>
<script src="<?php echo e(asset('front_end/js/common-script.js')); ?>"></script>
<script>
$(document).ready(function() {

    var myUpload = new FileUploadWithPreview('myUploader');
    // Swiper: Slider
    new Swiper('.swiper-container', {
        loop: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 2,
        paginationClickable: true,
        spaceBetween: 20,
        breakpoints: {
            1920: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            1028: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            480: {
                slidesPerView: 1,
                spaceBetween: 10
            }
        }
    });
});
</script>
<script>
function closeSearch() {
    document.getElementById('search-box').style.display = 'none';
}

function openSearch() {
    document.getElementById('search-box').style.display = 'block';
}
</script>
<script>
$(document).ready(function() {
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        //>=, not <=
        if (scroll >= 120) {
            //clearHeader, not clearheader - caps H
            $("#main-header").addClass("darkHeader");
        } else {
            $("#main-header").removeClass("darkHeader");
        }
    }); //missing );
});
</script>



<script>
function openPlan(btn, id) {

    var allPlancontent = document.getElementsByClassName('Plan-content');
    var allPlanbtn = document.getElementsByClassName('Plan-button');
    for (i = 0; i < allPlanbtn.length; i++) {
        allPlanbtn[i].classList.remove('active');
    }
    for (i = 0; i < allPlancontent.length; i++) {
        allPlancontent[i].classList.remove('active');
    }

    document.getElementById(btn).classList.add('active');
    document.getElementById(id).classList.add('active');
}
</script>

<script>
$('#adharbtn').click(function() {
    $("#adharinput").trigger('click');
})

$("#adharinput").change(function() {
  
    $('.customform-control').hide();
})
</script>
<script>
$('#panbtn').click(function() {
    $("#paninput").trigger('click');
})

$("#paninput").change(function() {
  
    $('.customform-control').hide();
})
</script>
<script>
$('#licencebtn').click(function() {
    $("#licenceinput").trigger('click');
})

$("#licenceinput").change(function() {
  
    $('.customform-control').hide();
})
</script>

<script>
$('#voterbtn').click(function() {
    $("#voterinput").trigger('click');
})

$("#voterinput").change(function() {
  
    $('.customform-control').hide();
})
</script>


</body>

</html><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/include/footer_bottom.blade.php ENDPATH**/ ?>