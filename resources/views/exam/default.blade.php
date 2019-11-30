<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
@include('exam.head')
<body>
<!--  Free CSS Templates from www.templatemo.com -->
<div id="templatemo_container">
    @include('exam.header')

    <div id="templatemo_content">
        @include('exam.left_content')
        {{--        @include('exam.right_content')--}}
        <div id="templatemo_content_right">
            @yield('content')
            <div class="cleaner_with_height">&nbsp;</div>
            <a href="subpage.html"><img src="{{ asset('img/templatemo_ads.jpg') }}" alt="ads"/></a>
        </div> <!-- end of content right -->

        <div class="cleaner_with_height">&nbsp;</div>
    </div> <!-- end of content -->

    @include('exam.footer')
</div><!-- end of container -->
<!-- templatemo 086 book store -->
<!--
Book Store Template
http://www.templatemo.com/preview/templatemo_086_book_store
-->

<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article-ckeditor');
</script>

</body>
</html>
