@extends('pwa.layouts.app')

@section('style-pwa')

@endsection

@section('content-pwa')
<section id="homescreen">
    <div class="home-first-sec mt-32">
        <div class="container">
            <div class="home-first-sec-wrap">
                <h1>Hey, {{ Auth::user()->name }}</h1>
                <p class="mt-8">Find a course you want to learn</p>	
            </div>
            <div class="serachbar-homepage2 mt-24">
                <div class="input-group search-page-searchbar ">
                    <span class="input-group-text search-iconn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.9395 1.9313C5.98074 1.9313 1.94141 5.97063 1.94141 10.9294C1.94141 15.8881 5.98074 19.9353 10.9395 19.9353C13.0575 19.9353 15.0054 19.193 16.5449 17.9606L20.293 21.7067C20.4821 21.888 20.7347 21.988 20.9967 21.9854C21.2587 21.9827 21.5093 21.8775 21.6947 21.6924C21.8801 21.5073 21.9856 21.2569 21.9886 20.9949C21.9917 20.7329 21.892 20.4802 21.7109 20.2908L17.9629 16.5427C19.1963 15.0008 19.9395 13.0498 19.9395 10.9294C19.9395 5.97063 15.8982 1.9313 10.9395 1.9313ZM10.9395 3.93134C14.8173 3.93134 17.9375 7.05153 17.9375 10.9294C17.9375 14.8072 14.8173 17.9352 10.9395 17.9352C7.06162 17.9352 3.94141 14.8072 3.94141 10.9294C3.94141 7.05153 7.06162 3.93134 10.9395 3.93134Z" fill="black"></path>
                        </svg>
                    </span>
                    <input type="search" placeholder="Search Here" class="form-control search-text-result" id="search-input">
                </div>
                <button class="close-btn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_210_244" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                            <rect width="24" height="24" fill="white"/>
                        </mask>
                        <g mask="url(#mask0_210_244)">
                            <path d="M14 8C15.1046 8 16 7.10457 16 6C16 4.89543 15.1046 4 14 4C12.8954 4 12 4.89543 12 6C12 7.10457 12.8954 8 14 8Z" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 6H12" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 6H20" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 14C9.10457 14 10 13.1046 10 12C10 10.8954 9.10457 10 8 10C6.89543 10 6 10.8954 6 12C6 13.1046 6.89543 14 8 14Z" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 12H6" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 12H20" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17 20C18.1046 20 19 19.1046 19 18C19 16.8954 18.1046 16 17 16C15.8954 16 15 16.8954 15 18C15 19.1046 15.8954 20 17 20Z" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 18H15" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 18H20" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="home-category mt-32">
        <div class="home-category-wrap container">
            <div class="homescreen-second-wrapper-top">
                <div class="categories-first">
                    <h2 class="home1-txt3">📙 Categories</h2>
                </div>
                <div class="view-all-second">
                    <a href="category-screen.html"><p class="see-all-txt">See all<span><img src="assets-pwa/svg/right-arrow.svg" alt="right-arrow"></span></p></a>
                </div>
            </div>
        </div>
        <div class="categories-slider mt-16">
            <div class="categories-content single-course">
                <div>
                    <img src="assets-pwa/images/homescreen/category1.png" alt="category-img" class="w-100">
                </div>
                <div class="categories-title">
                    <h3 class="category-txt1">Business</h3>
                    <p class="category-txt2">120 Courses</p>
                </div>
            </div>
            <div class="categories-content single-course">
                <div>
                    <img src="assets-pwa/images/homescreen/category2.png" alt="category-img" class="w-100">
                </div>
                <div class="categories-title">
                    <h3 class="category-txt1">Science</h3>
                    <p class="category-txt2">266 Courses</p>
                </div>
            </div>
            <div class="categories-content single-course">
                <div>
                    <img src="assets-pwa/images/homescreen/category3.png" alt="category-img" class="w-100">
                </div>
                <div class="categories-title">
                    <h3 class="category-txt1">UI/UX Design</h3>
                    <p class="category-txt2">144 Courses</p>
                </div>
            </div>
        </div>
    </div>
    <div class="home-offer-sec mt-32">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide carousel slide-shop-now2" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active show-now2-custom-btn" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="show-now2-custom-btn" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="show-now2-custom-btn" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="shop-now2-sec">
                            <div class="offer-details">
                                <div class="offer-details-wrap">
                                    <div class="offer-price">
                                        <p>40% OFF</p>
                                        <h2 class="mt-12">Today’s Special</h2>
                                    </div>
                                    <div class="home1-shop-now-btn">
                                        <p>USE CODE G40</p>	
                                    </div>
                                </div>
                                <div class="discount-txt mt-16"><p>Get a discount for every course order!<br>Only valid for today!</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="shop-now2-sec">
                            <div class="offer-details">
                                <div class="offer-details-wrap">
                                    <div class="offer-price">
                                        <p>40% OFF</p>
                                        <h2 class="mt-12">Today’s Special</h2>
                                    </div>
                                    <div class="home1-shop-now-btn">
                                        <p>USE CODE G40</p>	
                                    </div>
                                </div>
                                <div class="discount-txt mt-16"><p>Get a discount for every course order!<br>Only valid for today!</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="shop-now2-sec">
                            <div class="offer-details">
                                <div class="offer-details-wrap">
                                    <div class="offer-price">
                                        <p>40% OFF</p>
                                        <h2 class="mt-12">Today’s Special</h2>
                                    </div>
                                    <div class="home1-shop-now-btn">
                                        <p>USE CODE G40</p>	
                                    </div>
                                </div>
                                <div class="discount-txt mt-16"><p>Get a discount for every course order!<br>
                                Only valid for today!</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-trending-course mt-32">
        <div class="homescreen-second-wrapper-top container">
            <div class="categories-first">
                <h2 class="home1-txt3">🔥 Trending Courses</h2>
            </div>
            <div class="view-all-second">
                <a href="trending-course.html"><p class="see-all-txt">See all<span><img src="assets-pwa/svg/right-arrow.svg" alt="right-arrow"></span></p></a>
            </div>
        </div>
        <div class="trending-course-bottom-wrap mt-16">
            <div class="trending-course-details single-course">
                <div class="trending-course-details">
                    <div class="trending-course-img">
                        <img src="assets-pwa/images/trending-course/course1.png" alt="course-img" class="w-100">
                        <div class="trending-bookmark">
                            <a href="javascript:void(0);" class="item-bookmark active" tabindex="0">
                                <img src="assets-pwa/svg/black-bookmark.svg" alt="bookmark-icon">
                            </a>
                        </div>
                        <div class="trending-name">
                            <p>Design</p>
                        </div>
                    </div>
                    <div class="trending-course-bottom mt-12">
                        <div>
                            <p class="trending-txt1">Create & Design a Modern 3D House in...</p>
                        </div>
                        <div class="trending-course-price">
                            <div>
                                <span class="trending-txt2">$180.00</span>
                                <span class="trending-txt3">$210.00</span>
                            </div>
                            <div>
                                <span class="trending-txt4"><img src="assets-pwa/images/single-courses/orange-fill-star.svg" alt="star-img"></span>
                                <span class="trending-txt5">5.0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="trending-course-details single-course">
                <div class="trending-course-details">
                    <div class="trending-course-img">
                        <img src="assets-pwa/images/trending-course/course2.png" alt="course-img" class="w-100">
                        <div class="trending-bookmark">
                            <a href="javascript:void(0);" class="item-bookmark active" tabindex="0">
                                <img src="assets-pwa/svg/black-bookmark.svg" alt="bookmark-icon">
                            </a>
                        </div>
                        <div class="trending-name">
                            <p>Development</p>
                        </div>
                    </div>
                    <div class="trending-course-bottom mt-12">
                        <div>
                            <p class="trending-txt1">Learning Python For Data Analy...</p>
                        </div>
                        <div class="trending-course-price">
                            <div>
                                <span class="trending-txt2">$150.00</span>
                                <span class="trending-txt3">$210.00</span>
                            </div>
                            <div>
                                <span class="trending-txt4"><img src="assets-pwa/images/single-courses/orange-fill-star.svg" alt="star-img"></span>
                                <span class="trending-txt5">5.0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-mentor mt-32">
        <div class="home-category-wrap container">
            <div class="homescreen-second-wrapper-top">
                <div class="categories-first">
                    <h2 class="home1-txt3">👨‍🏫 Top Mentors</h2>
                </div>
                <div class="view-all-second">
                    <a href="mentor-screen.html"><p class="see-all-txt">See all<span><img src="assets-pwa/svg/right-arrow.svg" alt="right-arrow"></span></p></a>
                </div>
            </div>
        </div>
        <div class="home-mentor-bottom mt-16">
            <div class="home-mentor-sec-wrap redirect-mentor">
                <div class="home-mentor-sec">
                    <div><img src="assets-pwa/images/homescreen/mentor1.png" alt="mentor-img"></div>
                </div>
                <div class="home-mentor-name"><p>Jacob</p></div>
            </div>
            <div class="home-mentor-sec-wrap redirect-mentor">
                <div class="home-mentor-sec">
                    <div><img src="assets-pwa/images/homescreen/mentor2.png" alt="mentor-img"></div>
                </div>
                <div class="home-mentor-name"><p>Claire</p></div>
            </div>
            <div class="home-mentor-sec-wrap redirect-mentor">
                <div class="home-mentor-sec">
                    <div><img src="assets-pwa/images/homescreen/mentor3.png" alt="mentor-img"></div>
                </div>
                <div class="home-mentor-name"><p>Priscilla</p></div>
            </div>
            <div class="home-mentor-sec-wrap redirect-mentor">
                <div class="home-mentor-sec">
                    <div><img src="assets-pwa/images/homescreen/mentor4.png" alt="mentor-img"></div>
                </div>
                <div class="home-mentor-name"><p>Wade</p></div>
            </div>
        </div>
    </div>
    <div class="home-release mt-32">
        <div class="home-category-wrap container">
            <div class="homescreen-second-wrapper-top">
                <div class="categories-first">
                    <h2 class="home1-txt3">🙌 New Release</h2>
                </div>
                <div class="view-all-second">
                    <a href="new-release-course.html"><p class="see-all-txt">See all<span><img src="assets-pwa/svg/right-arrow.svg" alt="right-arrow"></span></p></a>
                </div>
            </div>
        </div>
        <div class="home-release-bottom-sec mt-16">
            <div class="new-courses-sec">
                <div class="new-courses single-course">
                    <img src="assets-pwa/images/homescreen/release1.png" alt="course-img">
                    <div class="trending-bookmark">
                        <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                            <img src="assets-pwa/svg/black-bookmark.svg" alt="bookmark-icon">
                        </a>
                    </div>
                    <div class="new-courses-txt">
                        <p>Business</p>
                    </div>
                </div>
                <div class="trending-course-bottom single-course mt-12">
                    <div>
                        <p class="new-courses-txt1">Master Your Mindset & Brain: Framestorm Your...</p>
                    </div>
                    <div class="trending-course-price">
                        <div>
                            <span class="new-courses-txt3">$210.00</span>
                        </div>
                        <div>
                            <span class="new-courses-txt4"><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></span>
                            <span class="new-courses-txt5">3h 20m</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new-courses-sec">
                <div class="new-courses single-course">
                    <img src="assets-pwa/images/homescreen/release2.png" alt="course-img">
                    <div class="trending-bookmark">
                        <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                            <img src="assets-pwa/svg/black-bookmark.svg" alt="bookmark-icon">
                        </a>
                    </div>
                    <div class="new-courses-txt">
                        <p>Game Design</p>
                    </div>
                </div>
                <div class="trending-course-bottom single-course mt-12">
                    <div>
                        <p class="new-courses-txt1">Introduction to Game Localization</p>
                    </div>
                    <div class="trending-course-price">
                        <div>
                            <span class="new-courses-txt3">$65.00</span>
                        </div>
                        <div>
                            <span class="new-courses-txt4"><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></span>
                            <span class="new-courses-txt5">1h 30m</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new-courses-sec">
                <div class="new-courses single-course">
                    <img src="assets-pwa/images/homescreen/release3.png" alt="course-img">
                    <div class="trending-bookmark">
                        <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                            <img src="assets-pwa/svg/black-bookmark.svg" alt="bookmark-icon">
                        </a>
                    </div>
                    <div class="new-courses-txt">
                        <p>Development</p>
                    </div>
                </div>
                <div class="trending-course-bottom single-course mt-12">
                    <div>
                        <p class="new-courses-txt1">The Complete 2023 Fullstack Web Develope...</p>
                    </div>
                    <div class="trending-course-price">
                        <div>
                            <span class="new-courses-txt3">$210.00</span>
                        </div>
                        <div>
                            <span class="new-courses-txt4"><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></span>
                            <span class="new-courses-txt5">3h 20m</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-course mt-32">
        <div class="home-course-wrapper-top">
            <div class="container">
                <div class="categories-first">
                    <h2 class="home1-txt3">🧿 All Courses</h2>
                </div>
            </div>
        </div>
        <div class="home-course-wrapper-bottom mt-16">
            <div class="home-course-wrapper-bottom-full">
                <ul class="nav nav-pills" id="homepage1-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active custom-home1-tab-btn" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab"  aria-selected="true">🔥All</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link custom-home1-tab-btn" id="pills-clothes-tab" data-bs-toggle="pill" data-bs-target="#pills-clothes" type="button" role="tab"  aria-selected="false">💡3D Design</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link custom-home1-tab-btn" id="pills-electronics-tab" data-bs-toggle="pill" data-bs-target="#pills-electronics" type="button" role="tab"  aria-selected="false">💰Business</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link custom-home1-tab-btn" id="pills-cosmetics-tab" data-bs-toggle="pill" data-bs-target="#pills-cosmetics" type="button" role="tab"  aria-selected="false">📢Marketing</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane show active" id="pills-all" role="tabpanel"  tabindex="0">
                        <div class="container">
                            <div class="result-found-bottom-wrap mt-16 single-course">
                                <div class="result-img-sec">
                                    <img src="assets-pwa/images/homescreen/course3.png" alt="course-img">
                                </div>
                                <div class="result-content-sec">
                                    <h1 class="d-none">Search</h1>
                                    <div class="result-content-sec-wrap">
                                        <div class="content-first">
                                            <div class="result-bottom-txt">
                                                <p>Life Style</p>
                                            </div>
                                            <div class="result-bookmark">
                                                <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                                                    <img src="assets-pwa/images/single-courses/bookmark-unfill.svg" alt="bookmark-icon">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="content-second mt-12">
                                            <h2>Make-up for Beginners: learn doing make-up like a Pro</h2>
                                        </div>
                                        <div class="content-third mt-12">
                                            <div><p class="result-price">$210.00</p></div>
                                            <div class="result-time-sec">
                                                <div><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></div>
                                                <div class="result-time">6h 40m</div>
                                            </div>
                                        </div>
                                        <div class="content-fourth">
                                            <div class="result-rating-sec">
                                                <div class="result-rating-sec-img">
                                                    <img src="assets-pwa/images/result-found/orange-star.svg" alt="star-img">
                                                </div>
                                                <div class="result-rating-txt">4.8 (6.5k ratings) | 2.7k students</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="result-found-bottom-wrap mt-16 single-course ">
                                <div class="result-img-sec">
                                    <img src="assets-pwa/images/homescreen/course4.png" alt="course-img">
                                </div>
                                <div class="result-content-sec">
                                    <h1 class="d-none">Search</h1>
                                    <div class="result-content-sec-wrap">
                                        <div class="content-first">
                                            <div class="result-bottom-txt">
                                                <p>Music</p>
                                            </div>
                                            <div class="result-bookmark">
                                                <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                                                    <img src="assets-pwa/images/single-courses/bookmark-unfill.svg" alt="bookmark-icon">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="content-second mt-12">
                                            <h2>Acoustic Guitar and Electric Guitar Lessons: Getting Started</h2>
                                        </div>
                                        <div class="content-third mt-12">
                                            <div><p class="result-price">$170.00</p></div>
                                            <div class="result-time-sec">
                                                <div><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></div>
                                                <div class="result-time">3h 30m</div>
                                            </div>
                                        </div>
                                        <div class="content-fourth">
                                            <div class="result-rating-sec">
                                                <div class="result-rating-sec-img">
                                                    <img src="assets-pwa/images/result-found/orange-star.svg" alt="star-img">
                                                </div>
                                                <div class="result-rating-txt">4.3 (3.7k ratings) | 104.2k students</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="result-found-bottom-wrap mt-16 single-course">
                                <div class="result-img-sec">
                                    <img src="assets-pwa/images/homescreen/course5.png" alt="course-img">
                                </div>
                                <div class="result-content-sec">
                                    <h1 class="d-none">Search</h1>
                                    <div class="result-content-sec-wrap">
                                        <div class="content-first">
                                            <div class="result-bottom-txt">
                                                <p>Photography</p>
                                            </div>
                                            <div class="result-bookmark">
                                                <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                                                    <img src="assets-pwa/images/single-courses/bookmark-unfill.svg" alt="bookmark-icon">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="content-second mt-12">
                                            <h2>Night Photography: You Can Shoot Stunning Night Photos</h2>
                                        </div>
                                        <div class="content-third mt-12">
                                            <div><p class="result-price">$210.00</p></div>
                                            <div class="result-time-sec">
                                                <div><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></div>
                                                <div class="result-time">6h 40m</div>
                                            </div>
                                        </div>
                                        <div class="content-fourth">
                                            <div class="result-rating-sec">
                                                <div class="result-rating-sec-img">
                                                    <img src="assets-pwa/images/result-found/orange-star.svg" alt="star-img">
                                                </div>
                                                <div class="result-rating-txt">4.6 (2.1k ratings) | 86.7k students</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="result-found-bottom-wrap mt-16 single-course">
                                <div class="result-img-sec">
                                    <img src="assets-pwa/images/homescreen/course6.png" alt="course-img">
                                </div>
                                <div class="result-content-sec">
                                    <h1 class="d-none">Search</h1>
                                    <div class="result-content-sec-wrap">
                                        <div class="content-first">
                                            <div class="result-bottom-txt">
                                                <p>Design</p>
                                            </div>
                                            <div class="result-bookmark">
                                                <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                                                    <img src="assets-pwa/images/single-courses/bookmark-unfill.svg" alt="bookmark-icon">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="content-second mt-12">
                                            <h2>Learn Figma - UI/UX Design Essential Training</h2>
                                        </div>
                                        <div class="content-third mt-12">
                                            <div><p class="result-price">$140.00</p></div>
                                            <div class="result-time-sec">
                                                <div><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></div>
                                                <div class="result-time">3h 20m</div>
                                            </div>
                                        </div>
                                        <div class="content-fourth">
                                            <div class="result-rating-sec">
                                                <div class="result-rating-sec-img">
                                                    <img src="assets-pwa/images/result-found/orange-star.svg" alt="star-img">
                                                </div>
                                                <div class="result-rating-txt">4.8 (12.5k ratings) | 52.9k students</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="result-found-bottom-wrap mt-16 single-course">
                                <div class="result-img-sec">
                                    <img src="assets-pwa/images/homescreen/course7.png" alt="course-img">
                                </div>
                                <div class="result-content-sec">
                                    <h1 class="d-none">Search</h1>
                                    <div class="result-content-sec-wrap">
                                        <div class="content-first">
                                            <div class="result-bottom-txt">
                                                <p>Marketing</p>
                                            </div>
                                            <div class="result-bookmark">
                                                <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                                                    <img src="assets-pwa/images/single-courses/bookmark-unfill.svg" alt="bookmark-icon">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="content-second mt-12">
                                            <h2>YouTube SEO: How to Rank #1 on YouTube</h2>
                                        </div>
                                        <div class="content-third mt-12">
                                            <div><p class="result-price">$99.00</p></div>
                                            <div class="result-time-sec">
                                                <div><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></div>
                                                <div class="result-time">6h 40m</div>
                                            </div>
                                        </div>
                                        <div class="content-fourth">
                                            <div class="result-rating-sec">
                                                <div class="result-rating-sec-img">
                                                    <img src="assets-pwa/images/result-found/orange-star.svg" alt="star-img">
                                                </div>
                                                <div class="result-rating-txt">4.9 (1.2k ratings) | 5.3k students</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="pills-clothes" role="tabpanel" tabindex="0">
                        <div class="container">
                            <div class="result-found-bottom-wrap mt-16 single-course">
                                <div class="result-img-sec">
                                    <img src="assets-pwa/images/homescreen/course6.png" alt="course-img">
                                </div>
                                <div class="result-content-sec">
                                    <h1 class="d-none">Search</h1>
                                    <div class="result-content-sec-wrap">
                                        <div class="content-first">
                                            <div class="result-bottom-txt">
                                                <p>Design</p>
                                            </div>
                                            <div class="result-bookmark">
                                                <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                                                    <img src="assets-pwa/images/single-courses/bookmark-unfill.svg" alt="bookmark-icon">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="content-second mt-12">
                                            <h2>Learn Figma - UI/UX Design Essential Training</h2>
                                        </div>
                                        <div class="content-third mt-12">
                                            <div><p class="result-price">$140.00</p></div>
                                            <div class="result-time-sec">
                                                <div><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></div>
                                                <div class="result-time">3h 20m</div>
                                            </div>
                                        </div>
                                        <div class="content-fourth">
                                            <div class="result-rating-sec">
                                                <div class="result-rating-sec-img">
                                                    <img src="assets-pwa/images/result-found/orange-star.svg" alt="star-img">
                                                </div>
                                                <div class="result-rating-txt">4.8 (12.5k ratings) | 52.9k students</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="pills-electronics" role="tabpanel" tabindex="0">
                        <div class="container">
                            <div class="result-found-bottom-wrap mt-16 single-course">
                                <div class="result-img-sec">
                                    <img src="assets-pwa/images/homescreen/course4.png" alt="course-img">
                                </div>
                                <div class="result-content-sec">
                                    <h1 class="d-none">Search</h1>
                                    <div class="result-content-sec-wrap">
                                        <div class="content-first">
                                            <div class="result-bottom-txt">
                                                <p>Music</p>
                                            </div>
                                            <div class="result-bookmark">
                                                <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                                                    <img src="assets-pwa/images/single-courses/bookmark-unfill.svg" alt="bookmark-icon">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="content-second mt-12">
                                            <h2>Acoustic Guitar and Electric Guitar Lessons: Getting Started</h2>
                                        </div>
                                        <div class="content-third mt-12">
                                            <div><p class="result-price">$170.00</p></div>
                                            <div class="result-time-sec">
                                                <div><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></div>
                                                <div class="result-time">3h 30m</div>
                                            </div>
                                        </div>
                                        <div class="content-fourth">
                                            <div class="result-rating-sec">
                                                <div class="result-rating-sec-img">
                                                    <img src="assets-pwa/images/result-found/orange-star.svg" alt="star-img">
                                                </div>
                                                <div class="result-rating-txt">4.3 (3.7k ratings) | 104.2k students</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="pills-cosmetics" role="tabpanel" tabindex="0">
                        <div class="container">
                            <div class="result-found-bottom-wrap mt-16 single-course">
                                <div class="result-img-sec">
                                    <img src="assets-pwa/images/homescreen/course7.png" alt="course-img">
                                </div>
                                <div class="result-content-sec">
                                    <h1 class="d-none">Search</h1>
                                    <div class="result-content-sec-wrap">
                                        <div class="content-first">
                                            <div class="result-bottom-txt">
                                                <p>Marketing</p>
                                            </div>
                                            <div class="result-bookmark">
                                                <a href="javascript:void(0);" class="item-bookmark" tabindex="0">
                                                    <img src="assets-pwa/images/single-courses/bookmark-unfill.svg" alt="bookmark-icon">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="content-second mt-12">
                                            <h2>YouTube SEO: How to Rank #1 on YouTube</h2>
                                        </div>
                                        <div class="content-third mt-12">
                                            <div><p class="result-price">$99.00</p></div>
                                            <div class="result-time-sec">
                                                <div><img src="assets-pwa/images/result-found/grey-time-icon.svg" alt="time-icon"></div>
                                                <div class="result-time">6h 40m</div>
                                            </div>
                                        </div>
                                        <div class="content-fourth">
                                            <div class="result-rating-sec">
                                                <div class="result-rating-sec-img">
                                                    <img src="assets-pwa/images/result-found/orange-star.svg" alt="star-img">
                                                </div>
                                                <div class="result-rating-txt">4.9 (1.2k ratings) | 5.3k students</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script-pwa')
  
@endsection
