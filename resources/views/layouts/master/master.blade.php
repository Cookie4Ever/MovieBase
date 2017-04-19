
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="author" content="Jakub Skapski">
    <link rel="icon" href="../../favicon.ico">

    <title>MovieBase</title>

    <!-- Bootstrap core CSS -->
    <link href="/public/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/public/css/sweetalert.css" rel="stylesheet"/>
    <link href="/public/slick/slick.css" rel="stylesheet" />
    <link href="/public/slick/slick-theme.css" rel="stylesheet"/>
    <link href="/public/css/style.css" rel="stylesheet" />
    <link href="/public/css/simplePagination.css" rel="stylesheet" />
    <link href="/public/css/bootstrap-select.min.css" rel="stylesheet" />


</head>

<body>
<div class="site-wrapper">

    <div class="site-wrapper-inner">
        <div class="cover-container">
            @include('layouts.partials.nav')
        </div>

        <div class="cover-container container-fluid">
            @yield('page-content')
        </div>
    </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="/public/js/bootstrap.min.js"></script>
<script src="/public/js/sweetalert.min.js"></script>
<script src="/public/slick/slick.min.js"></script>
<script src="/public/js/jquery.simplePagination.js"></script>
<script src="/public/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
    @if( notify()->ready())

        swal
        ({
            title: "{{ notify()->message() }}",
            type: "{{ notify()->type() }}",
            @if( notify()->option('timer') )

                timer: "{{ notify()->option('timer') }}",
                showConfirmButton: false,

            @endif
        });

    @endif

</script>
<script type="text/javascript">
    $('.slick-carousel').slick({
        centerMode: false,
        centerPadding: '70px',
        slidesToShow: 5,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '80px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });

    var filtered = false;

    $('.js-filter').on('click', function(){
        if (filtered === false) {
            $('.filtering').slick('slickFilter',':even');
            $(this).text('Unfilter Slides');
            filtered = true;
        } else {
            $('.filtering').slick('slickUnfilter');
            $(this).text('Filter Slides');
            filtered = false;
        }
    });
</script>

<script type="text/javascript">
    $('.slick-carousel-person').slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    fade: false,
                    cssEase: null,
                    dots: false,
                    arrows: false,
                    centerMode: true,
                    centerPadding: '160px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    fade: false,
                    cssEase: 'none',
                    dots: false,
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });

    var filtered = false;

    $('.js-filter').on('click', function(){
        if (filtered === false) {
            $('.filtering').slick('slickFilter',':even');
            $(this).text('Unfilter Slides');
            filtered = true;
        } else {
            $('.filtering').slick('slickUnfilter');
            $(this).text('Filter Slides');
            filtered = false;
        }
    });
</script>

<script type="text/javascript">
    $(function () {
        $('[data-toggle="movie-overview"]').tooltip({container: 'body'})
    })
</script>

<script type="text/javascript">
    $('.dropdown-toggle').dropdown()
</script>

<script type="text/javascript">
    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>

<script type="text/javascript">
    $(function(){
        var hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');

        $('.nav-tabs a').click(function (e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop() || $('html').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
        });
    });
</script>

<script type="text/javascript">
    jQuery(function($) {
        var items = $(".content tbody tr");
        var numItems = items.length;
        var perPage = 15;

        items.slice(perPage).hide();

        $("#pagination").pagination({
            items: numItems,
            itemsOnPage: perPage,
            cssStyle: "light-theme",

            onPageClick: function(pageNumber) {

                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;

                items.hide()

                    .slice(showFrom, showTo).show();
            }
        });
    });
</script>

<script type="text/javascript">
    $(function()
    {
        $('#genreee').on('change', function (e) {
            $(this).closest('form').submit();
        });
    });

    $(function()
    {
        $('#genree').on('change', function (e) {
            $(this).closest('form').submit();
        });
    });
</script>



</body>
</html>
