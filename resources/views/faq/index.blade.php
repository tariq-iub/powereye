@extends('layouts.client')

@section('content')
        <div class="mb-9">
            <div class="mx-n4 mx-lg-n6 mt-n5 position-relative mb-md-9" style="height:208px">
                <div class="bg-holder bg-card d-dark-none" style="background-image:url(../../assets/img/bg/bg-40.png);background-size:cover;"></div>
                <!--/.bg-holder-->
                <div class="bg-holder bg-card d-light-none" style="background-image:url(../../assets/img/bg/bg-dark-40.png);background-size:cover;"></div>
                <!--/.bg-holder-->
                <div class="faq-title-box position-relative bg-body-emphasis border border-translucent p-6 rounded-3 text-center mx-auto">
                    <h1>How can we help?</h1>
                    <p class="my-3">Search for the topic you need help with or <a href="#!">contact our support</a></p>
                    <div class="search-box w-100">
                        <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input search" type="search" aria-label="Search"><svg class="svg-inline--fa fa-magnifying-glass search-box-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magnifying-glass" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"></path></svg><!-- <span class="fas fa-search search-box-icon"></span> Font Awesome fontawesome.com --></form>
                    </div>
                </div>
            </div>
            <div class="row gx-xl-8 gx-xxl-11 gy-6 faq">
                <div class="col-md-6 col-xl-5 col-xxl-4">
                    <div class="faq-sidebar offcanvas offcanvas-start bg-body z-5 w-100" id="faq-offcanvas" data-bs-backdrop="false" data-vertical-category-offcanvas="data-vertical-category-offcanvas">
                        <ul class="faq-category-tab nav nav-tabs mb-10 mb-md-5 pb-3 pt-2 w-100 w-sm-75 w-md-100 mx-auto" role="tablist">
                            <li class="nav-item" role="presentation"><button class="nav-link fw-semibold me-3 fs-8" id="popular" type="button" data-bs-toggle="tab" data-category-filter="popular" aria-selected="false" tabindex="-1" role="tab">Popular Categories</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link fw-semibold fs-8 active" id="all" type="button" data-bs-toggle="tab" data-category-filter="all" aria-selected="true" role="tab">All Categories</button></li>
                        </ul>
                        <div class="faq-subcategory-tab nav nav-tabs w-sm-75 w-md-100 mx-auto mb-4" id="faq-subcategory-tab" style="width: 90%" role="tablist">
                            <div class="nav-item w-100 popular mb-3" role="presentation"><button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8 active" id="tab-sale-101" data-bs-toggle="tab" data-bs-target="#sale-101" type="button" role="tab" aria-selected="true" data-vertical-category-tab="data-vertical-category-tab"><svg class="svg-inline--fa fa-chart-pie category-icon text-body-secondary fs-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-pie" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M304 240V16.6c0-9 7-16.6 16-16.6C443.7 0 544 100.3 544 224c0 9-7.6 16-16.6 16H304zM32 272C32 150.7 122.1 50.3 239 34.3c9.2-1.3 17 6.1 17 15.4V288L412.5 444.5c6.7 6.7 6.2 17.7-1.5 23.1C371.8 495.6 323.8 512 272 512C139.5 512 32 404.6 32 272zm526.4 16c9.3 0 16.6 7.8 15.4 17c-7.7 55.9-34.6 105.6-73.9 142.3c-6 5.6-15.4 5.2-21.2-.7L320 288H558.4z"></path></svg><!-- <span class="category-icon text-body-secondary fs-6 fa-solid fa-chart-pie"></span> Font Awesome fontawesome.com --><span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">Sales</span><span class="d-block text-body fw-normal mb-0 fs-9">Answer the most frequently asked questions about your products &amp; services here.</span></button></div>
                            <div class="nav-item w-100  mb-3" role="presentation"><button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8" id="tab-delivery-101" data-bs-toggle="tab" data-bs-target="#delivery-101" type="button" role="tab" aria-selected="false" data-vertical-category-tab="data-vertical-category-tab" tabindex="-1"><svg class="svg-inline--fa fa-truck-fast category-icon text-body-secondary fs-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="truck-fast" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M112 0C85.5 0 64 21.5 64 48V96H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 272c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 48c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 240c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 208c8.8 0 16 7.2 16 16s-7.2 16-16 16H64V416c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H112zM544 237.3V256H416V160h50.7L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"></path></svg><!-- <span class="category-icon text-body-secondary fs-6 fa-solid fa-truck-fast"></span> Font Awesome fontawesome.com --><span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">Delivery</span><span class="d-block text-body fw-normal mb-0 fs-9">Answer each &amp; every question about your product and service delivery, maintain customers.</span></button></div>
                            <div class="nav-item w-100  mb-3" role="presentation"><button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8" id="tab-notification-101" data-bs-toggle="tab" data-bs-target="#notification-101" type="button" role="tab" aria-selected="false" data-vertical-category-tab="data-vertical-category-tab" tabindex="-1"><svg class="svg-inline--fa fa-bell category-icon text-body-secondary fs-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"></path></svg><!-- <span class="category-icon text-body-secondary fs-6 fa-solid fa-bell"></span> Font Awesome fontawesome.com --><span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">Notification</span><span class="d-block text-body fw-normal mb-0 fs-9">Check and get all the necessary notices on the same page and board. Learn the FAQs here.</span></button></div>
                            <div class="nav-item w-100  mb-3" role="presentation"><button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8" id="tab-order-101" data-bs-toggle="tab" data-bs-target="#order-101" type="button" role="tab" aria-selected="false" data-vertical-category-tab="data-vertical-category-tab" tabindex="-1"><svg class="svg-inline--fa fa-file-invoice-dollar category-icon text-body-secondary fs-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-invoice-dollar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5 .1 0 0 0 0c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16V422.2c-11.2-2.1-21.7-5.7-30.9-8.9l0 0 0 0c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5 .8 4.8 1.6 7.1 2.4l0 0 0 0 0 0c13.6 4.6 24.6 8.4 36.3 8.7c9.1 .3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5 0 0c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z"></path></svg><!-- <span class="category-icon text-body-secondary fs-6 fa-solid fa-file-invoice-dollar"></span> Font Awesome fontawesome.com --><span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">Order</span><span class="d-block text-body fw-normal mb-0 fs-9">Check and have all your product order FAQs answered here. </span></button></div>
                            <div class="nav-item w-100  mb-3" role="presentation"><button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8" id="tab-networking-101" data-bs-toggle="tab" data-bs-target="#networking-101" type="button" role="tab" aria-selected="false" data-vertical-category-tab="data-vertical-category-tab" tabindex="-1"><svg class="svg-inline--fa fa-circle-nodes category-icon text-body-secondary fs-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-nodes" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M418.4 157.9c35.3-8.3 61.6-40 61.6-77.9c0-44.2-35.8-80-80-80c-43.4 0-78.7 34.5-80 77.5L136.2 151.1C121.7 136.8 101.9 128 80 128c-44.2 0-80 35.8-80 80s35.8 80 80 80c12.2 0 23.8-2.7 34.1-7.6L259.7 407.8c-2.4 7.6-3.7 15.8-3.7 24.2c0 44.2 35.8 80 80 80s80-35.8 80-80c0-27.7-14-52.1-35.4-66.4l37.8-207.7zM156.3 232.2c2.2-6.9 3.5-14.2 3.7-21.7l183.8-73.5c3.6 3.5 7.4 6.7 11.6 9.5L317.6 354.1c-5.5 1.3-10.8 3.1-15.8 5.5L156.3 232.2z"></path></svg><!-- <span class="category-icon text-body-secondary fs-6 fa-solid fa-circle-nodes"></span> Font Awesome fontawesome.com --><span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">Networking</span><span class="d-block text-body fw-normal mb-0 fs-9">See and answer all the queries to help your clients and customers and build strong networking between your team and your clientele</span></button></div>
                            <div class="nav-item w-100 popular mb-3" role="presentation"><button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8" id="tab-customize-101" data-bs-toggle="tab" data-bs-target="#customize-101" type="button" role="tab" aria-selected="false" data-vertical-category-tab="data-vertical-category-tab" tabindex="-1"><svg class="svg-inline--fa fa-sliders category-icon text-body-secondary fs-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sliders" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M0 416c0 17.7 14.3 32 32 32l54.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 448c17.7 0 32-14.3 32-32s-14.3-32-32-32l-246.7 0c-12.3-28.3-40.5-48-73.3-48s-61 19.7-73.3 48L32 384c-17.7 0-32 14.3-32 32zm128 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM320 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm32-80c-32.8 0-61 19.7-73.3 48L32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l246.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48l54.7 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-54.7 0c-12.3-28.3-40.5-48-73.3-48zM192 128a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm73.3-64C253 35.7 224.8 16 192 16s-61 19.7-73.3 48L32 64C14.3 64 0 78.3 0 96s14.3 32 32 32l86.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 128c17.7 0 32-14.3 32-32s-14.3-32-32-32L265.3 64z"></path></svg><!-- <span class="category-icon text-body-secondary fs-6 fa-solid fa-sliders"></span> Font Awesome fontawesome.com --><span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">Customize</span><span class="d-block text-body fw-normal mb-0 fs-9">Answer customization related questions here for simple and easy assistance.</span></button></div>
                            <div class="nav-item w-100  mb-3" role="presentation"><button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8" id="tab-marketing-101" data-bs-toggle="tab" data-bs-target="#marketing-101" type="button" role="tab" aria-selected="false" data-vertical-category-tab="data-vertical-category-tab" tabindex="-1"><svg class="svg-inline--fa fa-bullhorn category-icon text-body-secondary fs-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bullhorn" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M480 32c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9L381.7 53c-48 48-113.1 75-181 75H192 160 64c-35.3 0-64 28.7-64 64v96c0 35.3 28.7 64 64 64l0 128c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32V352l8.7 0c67.9 0 133 27 181 75l43.6 43.6c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V300.4c18.6-8.8 32-32.5 32-60.4s-13.4-51.6-32-60.4V32zm-64 76.7V240 371.3C357.2 317.8 280.5 288 200.7 288H192V192h8.7c79.8 0 156.5-29.8 215.3-83.3z"></path></svg><!-- <span class="category-icon text-body-secondary fs-6 fa-solid fa-bullhorn"></span> Font Awesome fontawesome.com --><span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">Marketing</span><span class="d-block text-body fw-normal mb-0 fs-9">Get all the marketing related questions answered here.</span></button></div>
                            <div class="nav-item w-100  mb-3" role="presentation"><button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8" id="tab-our-vision-101" data-bs-toggle="tab" data-bs-target="#our-vision-101" type="button" role="tab" aria-selected="false" data-vertical-category-tab="data-vertical-category-tab" tabindex="-1"><svg class="svg-inline--fa fa-peace category-icon text-body-secondary fs-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="peace" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M224 445.3V323.5l-94.3 77.1c26.1 22.8 58.5 38.7 94.3 44.7zM89.2 351.1L224 240.8V66.7C133.2 81.9 64 160.9 64 256c0 34.6 9.2 67.1 25.2 95.1zm293.1 49.5L288 323.5V445.3c35.7-6 68.1-21.9 94.3-44.7zm40.6-49.5c16-28 25.2-60.5 25.2-95.1c0-95.1-69.2-174.1-160-189.3V240.8L422.8 351.1zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"></path></svg><!-- <span class="category-icon text-body-secondary fs-6 fa-solid fa-peace"></span> Font Awesome fontawesome.com --><span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">Our Vision</span><span class="d-block text-body fw-normal mb-0 fs-9">We provide web development solution in an economically efficient way. Learn further from these FAQs here</span></button></div>
                            <div class="nav-item w-100  mb-0" role="presentation"><button class="category nav-link btn bg-body-emphasis w-100 px-3 pt-4 pb-3 fs-8" id="tab-scheduling-101" data-bs-toggle="tab" data-bs-target="#scheduling-101" type="button" role="tab" aria-selected="false" data-vertical-category-tab="data-vertical-category-tab" tabindex="-1"><svg class="svg-inline--fa fa-calendar-xmark category-icon text-body-secondary fs-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar-xmark" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM305 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47z"></path></svg><!-- <span class="category-icon text-body-secondary fs-6 fa-solid fa-calendar-xmark"></span> Font Awesome fontawesome.com --><span class="d-block fs-6 fw-bolder lh-1 text-body mt-3 mb-2">Scheduling</span><span class="d-block text-body fw-normal mb-0 fs-9">See everything related to our scheduling from these FAQs below:</span></button></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-7 col-xxl-8 mt-md-11">
                    <div class="faq-subcategory-content tab-content">
                        <div class="empty-header d-none d-md-block"></div><button class="btn btn-link d-md-none my-6 fs-8 ps-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#faq-offcanvas"> <svg class="svg-inline--fa fa-chevron-left fs-9 me-2" data-fa-transform="up-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="" style="transform-origin: 0.3125em 0.375em;"><g transform="translate(160 256)"><g transform="translate(0, -64)  scale(1, 1)  rotate(0 0 0)"><path fill="currentColor" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" transform="translate(-160 -256)"></path></g></g></svg><!-- <span class="fa-solid fa-chevron-left fs-9 me-2" data-fa-transform="up-2"></span> Font Awesome fontawesome.com -->Categories</button>
                        <div class="tab-pane fade active show" id="sale-101" role="tabpanel" aria-labelledby="tab-sale-101">
                            <ul class="list-inline mb-0">
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How can I purchase your services?</h4>
                                        <p class="mb-0 text-body-tertiary">You can mail us at info@phoenix.template or go to our services page to directly choose and pay to buy the services we provide.</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How much do your service cost?</h4>
                                        <p class="mb-0 text-body-tertiary">Our services can be availed at a minimum cost. Please visit info.phoenix-tw.com to get insights into the better purchase plans.</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you offer any money-back guarantee?</h4>
                                        <p class="mb-0 text-body-tertiary">We offer refunds to customers who are eligible to get one under our terms and conditions, as well as our policies.</p>
                                    </div>
                                </li>
                            </ul>
                            <hr class="border-top">
                            <ul class="faq-list list-inline">
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you offer any customer service for your customers?</h4>
                                        <p class="mb-0 text-body-tertiary">We do. We have an enthusiastic team of customer service providers to help you resolve any relevant issues that might arise while using the services. Please contact support.phoenix.themewagon for further info</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you offer any demo/trial version of your services?</h4>
                                        <p class="mb-0 text-body-tertiary">No, we don’t avail any prebooking or trial option. You can contact our support team for further info. </p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">What currencies does Phoenix work with?</h4>
                                        <p class="mb-0 text-body-tertiary">We allow the return of all items within 30 days of your original order’s date. If you’re interested in returning your items, send us an email with your order number </p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How can I dropship with Phoenix?</h4>
                                        <p class="mb-0 text-body-tertiary">We allow the return of all items within 30 days of your original order’s date. If you’re interested in returning your items, send us an email with your o</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">What is Phoenix and how does it work?</h4>
                                        <p class="mb-0 text-body-tertiary">We allow the return of all items within 30 days of your original order’s date. I</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How much does Shopify cost?</h4>
                                        <p class="mb-0 text-body-tertiary">original order’s date. If you’re interested in returning your items, send us an email with your order numb</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="delivery-101" role="tabpanel" aria-labelledby="tab-delivery-101">
                            <ul class="list-inline mb-0">
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you avail any delivery tracking option?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes. You can track your order and shipment details through the purchase code that we send, and know the current status of your purchase</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">What happens if I’m not available to receive?</h4>
                                        <p class="mb-0 text-body-tertiary">Our delivery team will try to reach you if you’re not available, and you can choose to pick it up from our pick-up points</p>
                                    </div>
                                </li>
                            </ul>
                            <hr class="border-top">
                            <ul class="faq-list list-inline">
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">What are your policies regarding missing or damaged product?</h4>
                                        <p class="mb-0 text-body-tertiary">We replace or refund for the damaged products, if our delivery personnel make any mistake. Note that, any damage on your or seller’s end is irreversible. </p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you offer same-day or any express delivery option?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, you can select your delivery option from the given options, and you’ll get the service accordingly. </p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">What is the delivery cost?</h4>
                                        <p class="mb-0 text-body-tertiary">We have three different delivery options available for our customers. The costs hence differ, and you’ll get the details on info.phoenix.themewagon.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">What is the proximity of your shipment?</h4>
                                        <p class="mb-0 text-body-tertiary">For three different categories of delivery options, our shipping time varies. This is dependent on the category/delivery option you choose.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="notification-101" role="tabpanel" aria-labelledby="tab-notification-101">
                            <ul class="list-inline mb-0">
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you allow customized notification option?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, you can customize and select the topics that you want to be notified about and remove the ones you think are unnecessary. </p>
                                    </div>
                                </li>
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Are my notifications secure?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, we take data security seriously and all the information, including your notification types and other things, are protected and cannot be shared.</p>
                                    </div>
                                </li>
                            </ul>
                            <hr class="border-top">
                            <ul class="faq-list list-inline">
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you allow direct actions on your notification?</h4>
                                        <p class="mb-0 text-body-tertiary">Depending on the notification type, and your settings and privacy settings. Please remember, we do not allow open sharing of notifications.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you allow multi-device notification?</h4>
                                        <p class="mb-0 text-body-tertiary">Certainly! No need to worry about getting notified about anything as you can log in to multiple devices and get notified according to your preferred way.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you allow multi-language notification?</h4>
                                        <p class="mb-0 text-body-tertiary">We have a preselection checkbox to choose your preferred language to get notified in. You can always change the settings later.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I opt out anytime?</h4>
                                        <p class="mb-0 text-body-tertiary">You can opt out or modify the preferred notification option as you want to and opt out anytime.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="order-101" role="tabpanel" aria-labelledby="tab-order-101">
                            <ul class="list-inline mb-0">
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do offer wholesale order option?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, you can choose the desired product and select the order option to bulk, and you’re good to go.</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I change my order?</h4>
                                        <p class="mb-0 text-body-tertiary">If you’ve already clicked check out, then you’ll need to wait for the confirmation call before changing the order. We recommend deciding beforehand to avoid further hassles. </p>
                                    </div>
                                </li>
                            </ul>
                            <hr class="border-top">
                            <ul class="faq-list list-inline">
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you allow viewing the order history?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, you can see and manage your order history from the orders page that we have and keep your details personal.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you notify about the placed orders?</h4>
                                        <p class="mb-0 text-body-tertiary">You can palace personalize the notification option as you want to, and we’ll keep you updated accordingly about your orders and everything.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How do I track my orders?</h4>
                                        <p class="mb-0 text-body-tertiary">You can easily track all your currently placed orders with the ID number that we provided you. Please remember not to share the ID with any untrusted contact.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How do I know my order placement is confirmed?</h4>
                                        <p class="mb-0 text-body-tertiary">We’ll send an OTP (one time password) to verify and confirm the order, and you’ll be notified via your preferred notification method.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="networking-101" role="tabpanel" aria-labelledby="tab-networking-101">
                            <ul class="list-inline mb-0">
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">What are some best features for networking coming with this template?</h4>
                                        <p class="mb-0 text-body-tertiary">Some features included in this template are responsiveness &amp; compatibility, different contact form UIs, social pages and apps and many more. Explore and modify according to your wish and your resolution to grow!</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How can I utilize networking to gain insights into customer/client needs and preferences?</h4>
                                        <p class="mb-0 text-body-tertiary">We provide detailed data visualization dashboards that can help you gain the required data to analyze and act according to your needs so that you get to enhance your growth through networking.</p>
                                    </div>
                                </li>
                            </ul>
                            <hr class="border-top">
                            <ul class="faq-list list-inline">
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Are there any specific configuration process applied to use the networking of your site?</h4>
                                        <p class="mb-0 text-body-tertiary">No, you can just use it as is. Yet, we recommend adjusting the page as you need, so you get the optimized feed to see.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How can I use networking to generate leads and attract new customers or clients?</h4>
                                        <p class="mb-0 text-body-tertiary">By using the default dashboards that we avail with the theme, you can log all your data and monitor the networking of your site.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How can I effectively network with customers and clients?</h4>
                                        <p class="mb-0 text-body-tertiary">Use our social apps pages to build any networking site and see yourself grow with enhanced and better networking options.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">What graphs can I use to build strong relationships with customers and clients?</h4>
                                        <p class="mb-0 text-body-tertiary">We’ve added different data visualization charts with the template that can help you track your networking sites as well and help you in building a storing network. See the modules that came inclusive with the theme and you’ll get necessary insights.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="customize-101" role="tabpanel" aria-labelledby="tab-customize-101">
                            <ul class="list-inline mb-0">
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I customize the design as needed?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, you can just go to: settings&gt;site theme&gt;design&gt;change and customize according to your needs with easy filters and checkbox from the given ones. </p>
                                    </div>
                                </li>
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I personalize the contents as I need?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, we allow easy and simple customization of feed and notification. You can select category and get the customized result on your feed.</p>
                                    </div>
                                </li>
                            </ul>
                            <hr class="border-top">
                            <ul class="faq-list list-inline">
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I integrate third-party extensions or plugins into the e-commerce site template?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, we’ve already installed necessary plugins and covered the most of what you might need. Also, you can integrate any third-party plugin that you need with our easy documentation.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I customize the checkout process on the e-commerce site template?</h4>
                                        <p class="mb-0 text-body-tertiary">You can edit and choose custom modules or import any from the Bootstrap components and customize the design as you want to.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I use the customized design and maintain responsiveness?</h4>
                                        <p class="mb-0 text-body-tertiary">You can if you follow the documentation accordingly and modify the codebase without error.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Is it possible to change the color scheme of the site template?</h4>
                                        <p class="mb-0 text-body-tertiary">We provide the theme color scheme in the box. You can choose any from there or use any custom color as your needs.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="marketing-101" role="tabpanel" aria-labelledby="tab-marketing-101">
                            <ul class="list-inline mb-0">
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How is this theme going to help my marketing strategy?</h4>
                                        <p class="mb-0 text-body-tertiary">This template is SEO optimized and comes with built-in user-friendly dashboards that will help you track your leads, sales and help you get better insights into what you need to do for better growth.</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do I need any distinct plugin or software to use it?</h4>
                                        <p class="mb-0 text-body-tertiary">Certainly not, if you do not want to customize it totally. For full customization, please see our documentation.</p>
                                    </div>
                                </li>
                            </ul>
                            <hr class="border-top">
                            <ul class="faq-list list-inline">
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I use the template for multiple sites?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, we avail a multi-site option for this template. Please contact our support: support@phoenix.themewagon.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Do you avail necessary marketing support?</h4>
                                        <p class="mb-0 text-body-tertiary">We provide 24/7 technical support for the template and we cover related issues. Contact our helpline for further details.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I change the style and design while also maintaining site SEO?</h4>
                                        <p class="mb-0 text-body-tertiary">You certainly can, all our components are responsive and SEO optimized. Enjoy creating with Phoenix.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I customize the emails pages of the theme?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, our theme is totally customizable, and it will remain compatible and responsive even if you customize it. If you do not change or modify the codebase, there is nothing to worry about, since we provide 24/7 support for this theme.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="our-vision-101" role="tabpanel" aria-labelledby="tab-our-vision-101">
                            <ul class="list-inline mb-0">
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">What solutions do you offer?</h4>
                                        <p class="mb-0 text-body-tertiary">We take on-demand projects and will be available for contractual front-end development (React/Vue), back-end development (LaRavel/NodeJS), UX/UI design and search engine optimization (SEO).</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">What frameworks and technologies do you specialize in at our web development farm?</h4>
                                        <p class="mb-0 text-body-tertiary">Our efficient offers solutions including but not limited to HTML5, CSS3, JavaScript (such as React, Angular), PHP, Python, WordPress, Drupal, and Magento. We have experience working with various content management systems (CMS) and e-commerce platforms</p>
                                    </div>
                                </li>
                            </ul>
                            <hr class="border-top">
                            <ul class="faq-list list-inline">
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How do you ensure customer satisfaction?</h4>
                                        <p class="mb-0 text-body-tertiary">We achieve it by closely collaborating with our clients throughout the development process, actively seeking feedback, providing regular project updates, and ensuring that our solutions align with their business goals and objectives.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How does our web development provider ensure the security of websites and web applications?</h4>
                                        <p class="mb-0 text-body-tertiary">Security is a top priority for our web development provider. We implement industry best practices, such as secure coding techniques, data encryption, protection against common web vulnerabilities (e.g., Cross-Site Scripting, SQL injection), and user authentication mechanisms to ensure the confidentiality, integrity, and availability of your website or web application</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How can you get started with our web development providers services?</h4>
                                        <p class="mb-0 text-body-tertiary">Simply reach out to our team, and we will schedule an initial consultation to discuss your project requirements, goals, and timelines. We will provide you with a tailored proposal outlining the recommended services, deliverables, and pricing. Once we have your approval, we will embark on the journey of bringing your vision to life.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="scheduling-101" role="tabpanel" aria-labelledby="tab-scheduling-101">
                            <ul class="list-inline mb-0">
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I request changes to the project timeline after it has been finalized?</h4>
                                        <p class="mb-0 text-body-tertiary">If you require changes to the project timeline, please communicate with our team as early as possible. We will assess the feasibility of the requested changes and work with you to accommodate them if feasible.</p>
                                    </div>
                                </li>
                                <li class="d-flex gap-2 mb-6"><svg class="svg-inline--fa fa-star fs-8 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"></path></svg><!-- <span class="fa-solid fa-star fs-8 text-primary"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I track the progress of my project and stay updated on the schedule?</h4>
                                        <p class="mb-0 text-body-tertiary">Absolutely! We provide regular project updates, including progress reports and milestone achievements. We can set up a communication channel where you can track project progress and stay informed about the schedule throughout the development process.</p>
                                    </div>
                                </li>
                            </ul>
                            <hr class="border-top">
                            <ul class="faq-list list-inline">
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I request an expedited timeline for my project?</h4>
                                        <p class="mb-0 text-body-tertiary">If you have a specific deadline or require an expedited timeline for your project, please inform us during the initial discussions. We will evaluate the feasibility and provide you with a realistic timeline based on the projects complexity and our resource availability.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can I make changes to the project scope or requirements once the scheduling has been finalized?</h4>
                                        <p class="mb-0 text-body-tertiary">It’s recommended that you do not. Still, if you need to make changes to the project scope or requirements after scheduling, please communicate with our team as soon as possible. We will assess the impact of the changes on the schedule and provide you with revised timelines and any necessary adjustments.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">Can your web development provider handle multiple projects simultaneously?</h4>
                                        <p class="mb-0 text-body-tertiary">Yes, our web development provider is equipped to handle multiple projects simultaneously. We have a dedicated team of developers and project managers who excel at multitasking and prioritizing tasks. We strive to allocate resources effectively to ensure that each project receives the attention it requires.</p>
                                    </div>
                                </li>
                                <li class="d-flex mt-6"><svg class="svg-inline--fa fa-circle" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z"></path></svg><!-- <span class="fa-solid fa-circle"></span> Font Awesome fontawesome.com -->
                                    <div>
                                        <h4 class="mb-3 text-body-highlight">How far in advance should I contact your web development provider to schedule a project?</h4>
                                        <p class="mb-0 text-body-tertiary">We recommend reaching out to our web development provider as soon as you have a project in mind. Contacting us in advance allows us to allocate the necessary resources and plan our schedule accordingly. It also ensures that we can accommodate your project within your desired timeframe.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
