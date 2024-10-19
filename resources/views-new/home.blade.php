@extends('layouts.talent')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Play:wght@700&family=Russo+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&family=Play:wght@700&family=Russo+One&display=swap" rel="stylesheet">

<div class="home">
    <section class="s1 p-0 parallax mobile-height wow fadeIn" data-stellar-background-ratio="0.5" style="background-image: url(&quot;assets/images/homepage-5-slider-img-1.jpg&quot;);">
        <div class="opacity-extra-medium bg-extra-dark-gray"></div>
        <div class="container position-relative">
            <div class="slider-typography text-center">
                <div class="slider-text-middle-main">
                    <div class="slider-text-middle">
                        <h1 class="alt-font text-uppercase text-white font-weight-700 mb-2">FUTURE STARR</h1>
                        <h4 class="alt-font text-uppercase text-white font-weight-700 mb-2"> THE OFFICIAL <b>TALENT</b> MARKET PLACE</h4>

                        <span class="text-large text-very-light-gray font-weight-400 d-block mb-4">@lang('home.BANNERSUBTITLE')</span>
                        <div class="row justify-content-center">
                            <div class="col-7 mob-search">
                                <div class="bg-search-theme p-1">
                                    <div class="row justify-content-center">
                                        <div class="col">
                                         <label for="search-input">
                                            <i class="fa fa-search" aria-hidden="true">
                                            </i>
                                                <span class="sr-only">Search icons</span>
                                            </label>
                                              <input class="mb-0 bg-search-theme-light" name="name" id="search" placeholder="Search Talent" type="text" autocomplete="off">
                                               <ul class="search-results">

                                               </ul>
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
    <section class=" wow fadeIn bg-light-gray bg-light-cream">
        <div class="container">
            <div class="text-center mb-3 mb-sm-5">
                <p class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small">FEATURES</p>
                <h2 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100 extras">@lang('home.WHOCHOOSE')</h2><span class="d-block separator-line-horrizontal-medium-light2 bg-deep-pink mx-auto width-100px"></span></div>
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="p-4 h-100 bg-white box-shadow-m text-center">
                        <div class="shade-blue padding-35px-all display-inline-block border-radius-100 margin-40px-bottom xs-margin-30px-bottom bg-light-gray">
                            <svg viewBox="0 0 512 512" width="48px" xmlns="http://www.w3.org/2000/svg">
                                <path d="M361.801 177.594l66.841-89.629c2.669-3.579 3.091-8.359 1.088-12.351s-6.086-6.512-10.553-6.512H131.395V54.049c9.736-4.484 16.515-14.328 16.515-25.731C147.909 12.704 135.206 0 119.591 0S91.272 12.704 91.272 28.318c0 11.402 6.777 21.245 16.511 25.73V488.39H92.822c-6.519 0-11.805 5.285-11.805 11.805S86.303 512 92.822 512h53.537c6.519 0 11.805-5.285 11.805-11.805s-5.286-11.805-11.805-11.805h-14.965V285.645h287.354c4.464 0 8.546-2.518 10.549-6.508 2.003-3.989 1.585-8.768-1.081-12.348l-66.415-89.195zM119.591 35.387c-3.898 0-7.068-3.171-7.068-7.069-.001-3.897 3.17-7.068 7.068-7.068s7.069 3.171 7.069 7.068c0 3.898-3.172 7.069-7.069 7.069zm11.805 226.648v-39.211h37.623c6.52 0 11.805-5.285 11.805-11.805s-5.285-11.805-11.805-11.805h-37.623v-43.676h58.871c6.52 0 11.805-5.285 11.805-11.805s-5.285-11.805-11.805-11.805h-58.871V92.714h264.251l-58.033 77.819c-3.12 4.184-3.122 9.921-.005 14.109l57.63 77.394H131.396z"></path>
                            </svg>
                        </div><span class="alt-font text-extra-dark-gray font-weight-600 display-block mb-2 text-medium">@lang('home.TAKECONTROLTITLE')</span>
                        <p class="mb-0 text-blue">@lang('home.TAKECONTROLDESCRIPTION')</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="p-4 h-100 bg-white box-shadow-m text-center">
                        <div class="shade-red padding-35px-all display-inline-block border-radius-100 margin-40px-bottom xs-margin-30px-bottom bg-light-gray">
                            <svg viewBox="0 0 512 512" width="48px" xmlns="http://www.w3.org/2000/svg">
                                <path d="M457.602 54.355c-72.417-72.416-190.245-72.416-262.661 0-35.081 35.079-54.399 81.721-54.399 131.331 0 45.193 16.039 87.917 45.413 121.688l-22.119 22.119-22.542-22.542c-2.47-2.47-5.821-3.858-9.314-3.858-3.493 0-6.844 1.388-9.314 3.858L17.055 412.563C6.057 423.559 0 438.18 0 453.733c0 15.552 6.057 30.174 17.053 41.17 10.998 10.998 25.619 17.054 41.17 17.054 15.551 0 30.174-6.057 41.17-17.053l105.612-105.61c2.47-2.47 3.858-5.821 3.858-9.314 0-3.493-1.388-6.844-3.858-9.314l-22.542-22.542 22.126-22.126c34.793 30.215 78.234 45.331 121.682 45.331 47.561 0 95.123-18.104 131.331-54.311C492.68 281.938 512 235.298 512 185.688c0-49.613-19.318-96.254-54.398-131.333zM80.765 476.275c-6.021 6.021-14.026 9.337-22.542 9.337-8.515 0-16.521-3.317-22.542-9.338-6.02-6.02-9.337-14.026-9.337-22.54s3.317-16.521 9.338-22.542l58.934-58.934L139.7 417.34l-58.935 58.935zm77.565-77.564l-45.084-45.084 18.734-18.734 45.084 45.085-18.734 18.733zm280.643-100.323c-62.144 62.146-163.259 62.146-225.403 0-30.104-30.104-46.683-70.128-46.683-112.702s16.579-82.598 46.683-112.701c31.072-31.072 71.887-46.609 112.702-46.609 40.814 0 81.63 15.535 112.702 46.609 30.104 30.103 46.683 70.128 46.683 112.701s-16.58 82.598-46.684 112.702z"></path>
                                <path d="M417.234 94.721c-50.158-50.156-131.769-50.158-181.927 0-50.156 50.158-50.156 131.769.001 181.927 25.079 25.077 58.02 37.617 90.963 37.617s65.885-12.54 90.964-37.617v-.001c50.156-50.156 50.156-131.768-.001-181.926zM398.605 258.02c-39.886 39.886-104.783 39.886-144.669.001-39.886-39.886-39.886-104.784-.001-144.67 19.945-19.946 46.136-29.914 72.336-29.914 26.193 0 52.394 9.974 72.334 29.914 39.886 39.885 39.886 104.783 0 144.669z"></path>
                                <path d="M375.321 136.636c-27.048-27.045-71.053-27.045-98.1 0-5.144 5.144-5.144 13.484 0 18.63 5.144 5.144 13.484 5.144 18.63 0 16.772-16.774 44.068-16.774 60.842 0 2.573 2.573 5.943 3.858 9.314 3.858 3.371 0 6.743-1.286 9.314-3.858 5.144-5.144 5.144-13.485 0-18.63z"></path>
                            </svg>
                        </div><span class="alt-font text-extra-dark-gray font-weight-600 display-block mb-2 text-medium">@lang('home.EXPLORETALENT')</span>
                        <p class="mb-0 text-red">@lang('home.EXPLORETALENTDESCRIPTION')</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="p-4 h-100 bg-white box-shadow-m text-center">
                        <div class="shade-yellow padding-35px-all display-inline-block border-radius-100 margin-40px-bottom xs-margin-30px-bottom bg-light-gray">
                            <svg viewBox="0 0 512 512" width="48px" xmlns="http://www.w3.org/2000/svg">
                                <path d="M472.208 201.712c9.271-9.037 12.544-22.3 8.544-34.613-4.001-12.313-14.445-21.118-27.257-22.979l-112.03-16.279c-2.199-.319-4.1-1.7-5.084-3.694L286.28 22.632c-5.729-11.61-17.331-18.822-30.278-18.822s-24.549 7.212-30.278 18.822l-50.101 101.516c-.985 1.993-2.885 3.374-5.085 3.694L58.51 144.12c-12.812 1.861-23.255 10.666-27.257 22.979-4.002 12.313-.728 25.576 8.544 34.613l81.065 79.019c1.591 1.552 2.318 3.787 1.942 5.978l-19.137 111.576c-2.188 12.761 2.958 25.414 13.432 33.024 10.474 7.612 24.102 8.595 35.56 2.572l100.201-52.679c1.968-1.035 4.317-1.035 6.286 0l100.202 52.679c4.984 2.62 10.377 3.915 15.744 3.914 6.97 0 13.896-2.184 19.813-6.487 10.474-7.611 15.621-20.265 13.432-33.024L389.2 286.708c-.375-2.191.351-4.426 1.942-5.978l81.066-79.018zm-109.629 89.564l19.137 111.578c.64 3.734-1.665 5.863-2.686 6.604-1.022.74-3.76 2.277-7.112.513l-100.202-52.679c-4.919-2.585-10.315-3.879-15.712-3.879s-10.794 1.294-15.712 3.878l-100.201 52.678c-3.354 1.763-6.091.228-7.112-.513s-3.327-2.87-2.686-6.604l19.137-111.576c1.879-10.955-1.75-22.127-9.711-29.886l-81.065-79.019c-2.713-2.646-2.099-5.723-1.708-6.923.389-1.201 1.702-4.052 5.451-4.596l112.027-16.279c10.999-1.598 20.504-8.502 25.424-18.471l50.101-101.516c1.677-3.397 4.793-3.764 6.056-3.764 1.261 0 4.377.366 6.055 3.764v.001l50.101 101.516c4.919 9.969 14.423 16.873 25.422 18.471l112.029 16.279c3.749.544 5.061 3.395 5.451 4.596.39 1.201 1.005 4.279-1.709 6.923l-81.065 79.019c-7.96 7.758-11.589 18.93-9.71 29.885zM413.783 22.625c-6.036-4.384-14.481-3.046-18.865 2.988l-14.337 19.732c-4.384 6.034-3.047 14.481 2.988 18.865 2.399 1.741 5.176 2.58 7.928 2.58 4.177 0 8.295-1.931 10.937-5.567l14.337-19.732c4.384-6.035 3.047-14.482-2.988-18.866zM131.36 45.265l-14.337-19.732c-4.383-6.032-12.829-7.37-18.865-2.988-6.034 4.384-7.372 12.831-2.988 18.865l14.337 19.732c2.643 3.639 6.761 5.569 10.939 5.569 2.753 0 5.531-.839 7.927-2.581 6.034-4.383 7.372-12.83 2.987-18.865zM49.552 306.829c-2.305-7.093-9.924-10.976-17.019-8.671l-23.197 7.538c-7.095 2.305-10.976 9.926-8.671 17.019 1.854 5.709 7.149 9.337 12.842 9.337 1.383 0 2.79-.215 4.177-.666l23.197-7.538c7.094-2.305 10.976-9.924 8.671-17.019zM256.005 456.786c-7.459 0-13.506 6.047-13.506 13.506v24.392c0 7.459 6.047 13.506 13.506 13.506 7.459 0 13.506-6.047 13.506-13.506v-24.392c0-7.46-6.046-13.506-13.506-13.506zM502.664 305.715l-23.197-7.538c-7.092-2.303-14.714 1.577-17.019 8.672-2.305 7.095 1.576 14.714 8.671 17.019l23.197 7.538c1.387.45 2.793.664 4.176.664 5.694 0 10.989-3.629 12.843-9.337 2.305-7.094-1.577-14.713-8.671-17.018z"></path>
                            </svg>
                        </div><span class="alt-font text-extra-dark-gray font-weight-600 display-block mb-2 text-medium">@lang('home.EARNWAYTOSTARDOM')</span>
                        <p class="mb-0 text-yellow">@lang('home.EARNWAYTOSTARDOMDESCRIPTION')</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-sm-4 mb-lg-0">
                    <div class="p-4 h-100 bg-white box-shadow-m text-center">
                        <div class="shade-green padding-35px-all display-inline-block border-radius-100 margin-40px-bottom xs-margin-30px-bottom bg-light-gray">
                            <svg viewBox="0 0 511.999 511.999" width="48px" xmlns="http://www.w3.org/2000/svg">
                                <path d="M466.45 49.374c-7.065-8.308-17.368-13.071-28.267-13.071H402.41v-11.19C402.41 11.266 391.143 0 377.297 0H134.705c-13.848 0-25.112 11.266-25.112 25.112v11.19H73.816c-10.899 0-21.203 4.764-28.267 13.071-6.992 8.221-10.014 19.019-8.289 29.624 9.4 57.8 45.775 108.863 97.4 136.872 4.717 11.341 10.059 22.083 16.008 32.091 19.002 31.975 42.625 54.073 68.627 64.76 2.635 26.644-15.094 51.885-41.794 57.9-.057.013-.097.033-.153.046-5.211 1.245-9.09 5.921-9.09 11.513v54.363h-21.986c-19.602 0-35.549 15.947-35.549 35.549v28.058c0 6.545 5.305 11.85 11.85 11.85H390.56c6.545 0 11.85-5.305 11.85-11.85v-28.058c0-19.602-15.947-35.549-35.549-35.549h-21.988V382.18c0-5.603-3.893-10.286-9.118-11.52-.049-.012-.096-.028-.145-.04-26.902-6.055-44.664-31.55-41.752-58.394 25.548-10.86 48.757-32.761 67.479-64.264 5.949-10.009 11.29-20.752 16.008-32.095 51.622-28.01 87.995-79.072 97.395-136.87 1.725-10.605-1.297-21.402-8.29-29.623zM60.652 75.192c-.616-3.787.431-7.504 2.949-10.466C66.156 61.722 69.878 60 73.815 60h35.777v21.802c0 34.186 4.363 67.3 12.632 97.583-32.496-25.679-54.87-62.982-61.572-104.193zm306.209 385.051c6.534 0 11.85 5.316 11.85 11.85v16.208H134.422v-16.208c0-6.534 5.316-11.85 11.85-11.85h220.589zm-45.688-66.213v42.513H191.96V394.03h129.213zm-98.136-23.699c2.929-3.224 5.607-6.719 8.002-10.46 7.897-12.339 12.042-26.357 12.228-40.674 4.209.573 8.457.88 12.741.88 4.661 0 9.279-.358 13.852-1.036.27 19.239 7.758 37.45 20.349 51.289h-67.172zM378.709 81.803c0 58.379-13.406 113.089-37.747 154.049-23.192 39.03-53.364 60.525-84.956 60.525-31.597 0-61.771-21.494-84.966-60.523-24.342-40.961-37.748-95.671-37.748-154.049V25.112c0-.78.634-1.413 1.412-1.413h242.591c.78 0 1.414.634 1.414 1.413v56.691zm72.639-6.611c-6.702 41.208-29.074 78.51-61.569 104.191 8.268-30.283 12.631-63.395 12.631-97.58V60.001h35.773c3.938 0 7.66 1.723 10.214 4.726 2.518 2.961 3.566 6.678 2.951 10.465z"></path>
                                <path d="M327.941 121.658c-1.395-4.288-5.103-7.414-9.566-8.064l-35.758-5.196-15.991-32.402c-1.997-4.044-6.116-6.605-10.626-6.605-4.511 0-8.63 2.561-10.626 6.605l-15.991 32.402-35.758 5.196c-4.464.648-8.172 3.775-9.566 8.065-1.393 4.291-.231 8.999 2.999 12.148l25.875 25.221-6.109 35.613c-.763 4.446 1.064 8.938 4.714 11.59 3.648 2.651 8.487 3 12.479.902L256 190.32l31.982 16.813c1.734.911 3.627 1.36 5.512 1.36 2.456 0 4.902-.763 6.966-2.263 3.65-2.652 5.477-7.144 4.714-11.59l-6.109-35.613 25.875-25.221c3.232-3.148 4.394-7.857 3.001-12.148zm-49.877 24.747c-2.793 2.722-4.068 6.644-3.408 10.489l3.102 18.09-16.245-8.541c-1.725-.908-3.62-1.36-5.514-1.36-1.894 0-3.788.454-5.514 1.36l-16.245 8.541 3.102-18.09c.66-3.844-.615-7.766-3.408-10.489l-13.141-12.81 18.162-2.64c3.859-.56 7.196-2.985 8.922-6.482L256 108.015l8.122 16.458c1.727 3.497 5.062 5.921 8.922 6.482l18.162 2.64-13.142 12.81z"></path>
                            </svg>
                        </div><span class="alt-font text-extra-dark-gray font-weight-600 display-block mb-2 text-medium">@lang('home.GETREWARD')</span>
                        <p class="mb-0 text-green">@lang('home.GETREWARDDESCRIPTION')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="no-padding wow fadeIn bg-extra-dark-gray" id="services" style="visibility: visible;">
        <div class="container-fluid no-padding">
            <div class="row equalize sm-equalize-auto no-margin n-dark-sec">
                <div class="col-md-6 position-relative sm-height-auto xs-height-350px cover-background  wow slideInLeft" data--duration="900ms" style="background-image: url(&quot;assets/images/cinematic-portrait-of-handsome-young-woman (1).jpg&quot;); visibility: visible; animation-duration: 900ms;"></div>
                <div class="col-md-6 wow slideInRight" data--duration="900ms" style="visibility: visible; animation-duration: 900ms;">
                    <div class="text-center text-md-left py-4 py-sm-5 px-md-4 p-lg-5 m-lg-5">
                        <div class="mb-3 mb-sm-5">
                            <p class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small">@lang('home.DISCOVER')</p>
                             <h2 class="text-uppercase alt-font text-light-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Future Starr</h2><span class="d-block separator-line-horrizontal-medium-light2 bg-deep-pink mx-auto width-100px mr-md-auto ml-md-0"></span></div>
                            @lang('home.DISCOVERDESCRIPTION')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" wow fadeIn" style="visibility: visible;">
        <div class="container">
            <div class="row">
                <div class="d-md-none d-lg-block col-md-5 pr-sm-5 pr-lg-0 text-center  wow fadeIn" style="visibility: visible;">
                    <div class="display-table-cell vertical-align-middle"><img alt="LET'S GET STARTED!" class="img-fluid" src="assets/images/image-3.png"></div>
                </div>
                <div class="pl-lg-5 col-md-12 col-lg-7  wow fadeIn" data--delay="0.4s" style="visibility: visible; animation-delay: 0.4s;">
                    <div class="mb-3 mt-5 mt-md-0 mb-sm-5 text-center">
                      
                         <h2 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">@lang('home.LETSTART')</h2><span class="separator-line-horrizontal-medium-light2 bg-deep-pink d-block mx-auto width-100px"></span></div>
                    <div class="row">
                        <div class="col-12 margin-six-bottom md-margin-six-bottom xs-margin-ten-bottom  wow fadeInUp last-paragraph-no-margin" style="visibility: visible;">
                            <div class="feature-box-5 position-relative"><i class="icon-global text-medium-gray icon-medium"></i>
                                <div class="feature-content">
                                    <div class="text-extra-dark-gray margin-10px-bottom alt-font font-weight-600">@lang('home.HOWTOUSE')</div>
                                    <p class="color-black">@lang('home.HOWTOUSEDESCRIPTION')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 margin-six-bottom md-margin-six-bottom xs-margin-ten-bottom  wow fadeInUp last-paragraph-no-margin" data--delay="0.2s" style="visibility: visible; animation-delay: 0.2s;">
                            <div class="feature-box-5 position-relative"><i class="icon-video text-medium-gray icon-medium"></i>
                                <div class="feature-content">
                                    <div class="text-extra-dark-gray margin-10px-bottom alt-font font-weight-600">@lang('home.VISITEUPCOMINGTALENT')</div>
                                    <p class="color-black">@lang('home.VISITEUPCOMINGTALENTDESCRIPTION')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 margin-six-bottom md-margin-six-bottom xs-margin-ten-bottom  wow fadeInUp last-paragraph-no-margin" data--delay="0.4s" style="visibility: visible; animation-delay: 0.4s;">
                            <div class="feature-box-5 position-relative"><i class="icon-tools text-medium-gray icon-medium"></i>
                                <div class="feature-content">
                                    <div class="text-extra-dark-gray margin-10px-bottom alt-font font-weight-600">@lang('home.CREATEARTIST')</div>
                                    <p class="color-black">@lang('home.CREATEATRISATDESCRIPTION')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                      @if(Auth::check() && Auth::user()->role_id =='4')
                      <div class="text-center"><a class="btn btn-small btn-dark-gray" href="{{ route('seller.index') }}">Click here to create page</a></div>
                     @elseif(Auth::check() && Auth::user()->role_id =='3')
                      <div class="text-center"><a class="btn btn-small btn-dark-gray" href="javascript:void(0);" data-toggle="modal" data-target="#information_modal">Click here to create page</a></div>
                    @else
                    <div class="text-center"><a class="btn btn-small btn-dark-gray" href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">Click here to create page</a></div>
                  @endif
                </div>
            </div>
        </div>
    </section>
    <section class="no-padding  wow fadeIn xs-text-center" style="visibility: visible;">
        <div class="container-fluid no-padding">
            <div class="row no-gutters">
                <div class="d-none d-lg-block col-sm-4 col-xl-3 p-0 cover-background" style="background-image: url('assets/images/designer-working-online-K5B663T.jpg')">
                    <div class="sm-height-500px xs-height-350px"></div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 bg-white text-center text-md-left px-md-4 px-lg-5">
                    <div class="py-4">
                      
                        <h2 class="alt-font font-weight-700 text-extra-dark-gray text-uppercase">@lang('home.ABOUT')</h2><span class="d-block separator-line-horrizontal-medium-light2 bg-deep-pink mx-auto width-100px mb-3 mb-md-4 mr-md-auto ml-md-0"></span>
                        <p class="color-black">@lang('home.ABOUTDESCRIPTION')</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-6 cover-background p-0" style="background-image: url('assets/images/parallax-bg2.jpg')">
                    <div class="sm-height-auto xs-height-350px"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-extra-dark-gray  wow fadeIn" style="visibility: visible;">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 n-dark-sec">
                    <p class="alt-font margin-5px-bottom text-uppercase text-small text-medium-gray">EXPLORE</p>
                   <h2 class="text-uppercase alt-font text-white margin-10px-top margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">@lang('home.MARKETPLACE')</h2><span class="separator-line-horrizontal-medium-light2 bg-deep-pink d-block mx-auto width-100px mb-sm-5"></span>
                    <p class="mt-3 mb-sm-5">@lang('home.MARKETPLACEDESCRIPTION')</p>
                </div>
            </div>
            <div class="row">
                @if(!empty($catagories))
                  @foreach($catagories as $category)
                <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp  last-paragraph-no-margin">
                    <div class="h-100 blog-post blog-post-style1 xs-text-center bg-white">
                        <div class="blog-post-images overflow-hidden">
                            <a href="{{ route('search.index',$category->slug) }}">
                                <img alt="futurestarr marketplace" src="{{asset('assets/'.$category->catagory_image_path)}}"></a>
                        </div>
                        <div class="post-details p-3">
                            <p class="text-medium mb-0 text-black ovpasstitle">{{ $category->name }}</p>
                            <div class="separator-line-horrizontal-full bg-medium-light-gray my-2"></div>
                            <p class="width-90 xs-width-100 color-black">  
                                {!! Str::limit(strip_tags($category->catagory_desc), 200) !!} 
                            </p>
                        </div>
                    </div>
                </div>
               @endforeach
               @endif
            </div>
        </div>
    </section>
    <section class=" wow fadeIn hover-option4 blog-post-style3">
        <div class="container">
            <div class="text-center mb-5">
                <p class="alt-font margin-5px-bottom text-uppercase text-small text-medium-gray">NEWS</p>
             
                <h2 class="text-uppercase alt-font text-extra-dark-gray margin-10px-top margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Latest Blogs</h2><span class="separator-line-horrizontal-medium-light2 bg-deep-pink display-table margin-auto width-100px"></span></div>
            <div class="row">
            @if($blogs)
                @foreach($blogs as $blog)
                @php $slug = $blog->id.'/'.Str::slug($blog->title,'-'); @endphp
                <div class="grid-item col-md-4 margin-30px-bottom xs-text-center   wow fadeInUp">
                    <div class="blog-post bg-light-gray inner-match-height">
                        <div class="blog-post-images overflow-hidden position-relative">
                            <a href="{{ route('blog.detailed',[$blog->getBlogCatagories['slug'], $blog->slug]) }}" href="javascript:void(0);">
                              <img src="{{asset( !empty($blog->blog_img) && file_exists($blog->blog_img) ? $blog->blog_img:'assets/images/default-ad-banner.png')}}" alt="blog">
                                <div class="blog-hover-icon"><span class="text-extra-large font-weight-300">+</span></div>
                            </a>
                        </div>
                        <div class="post-details padding-40px-all sm-padding-20px-all"><a class="ovpasstitle alt-font post-title text-medium text-extra-dark-gray width-100 display-block md-width-100 margin-15px-bottom" href="{{ route('blog.detailed',[$blog->getBlogCatagories['slug'], $blog->slug]) }}"> {{ $blog->title }}...</a>
                            <div class="blog-content">
                               <p class="width-90 xs-width-100 color-black"> {!! Str::limit(strip_tags($blog->content), 100) !!} </p>
                            </div>
                            <div class="separator-line-horrizontal-full bg-medium-gray margin-20px-tb"></div>
                            <div class="author mt-auto"><span class="width-90 xs-width-100 color-black">By {{ $blog->author_first_name  }} {{ $blog->author_last_name  }}
                            <a class="text-medium-gray"  href="javascript:void(0);"></a>&nbsp;&nbsp;|&nbsp;&nbsp; {{date('M d, Y', strtotime($blog->date))}} </span></div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
        </div>
    </section>
</div>

<a class="scroll-top-arrow" href="javascript:void(0);"><i   class="ti-arrow-up"></i></a>

<!-- sell your talent modal -->
<div class="modal-ask-to-login" id="askToJoinAsSeller" role="dialog">
    <div class="modal-dialog">
        <form>
            <!-- Modal content-->
            <div class="modal-content ask-to-login">
                <div class="modal-body">
                    <br />
                    <h3 class="ask-register"> To use this feature please register as Seller. <br /> <small>By clicking Register, you will be logged out from your current account. </small></h3>
                    <!-- <i class="fa fa-circle-o-notch fa-spin"></i> -->
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">REGISTER</button>
                    <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end of sell your talent modal -->
<!-- buy your talent modal -->
<div class="modal-ask-to-login " id="askToJoinAsBuyer" role="dialog">
    <div class="modal-dialog">
        <form>
            <!-- Modal content-->
            <div class="ask-to-login">
                <div class="modal-body">
                    <br />
                    <h3 class="ask-register"> To use this feature please register as Buyer. <br /> <small>By clicking Register, you will be logged out from your current account. </small></h3>
                    <!-- <i class="fa fa-circle-o-notch fa-spin"></i> -->
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-danger" data-dismiss="modal" (click)="goToRegister()">REGISTER</button>
                    <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end of buy your talent modal -->
<!-- ASK TO LOGIN -->
<div class="modal-ask-to-login " id="askToLogin" role="dialog">
    <div class="modal-dialog">
        <form>
            <!-- Modal content-->
            <div class="ask-to-login">
                <div class="modal-body">
                    <div class="form-group text-spinner">
                        <h3 class="deleteConfirmation">Please login to use this feature! </h3>
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<!-- this is for the registration new pop-up screen -->
<!-- Ask to join as Seller -->
    <!-- Modal -->
<div id="register_my_model" class="modal  modal-m pop" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header mob-cls">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5 text-center login-back">
                            <h4 class="mo-sign-awe">
                             Awe, looks like you have not</h4>
                            <h4 class="mo-sign-fr">signed up for Future Starr.</h4>
                            <p class="mo-now"><b>No worries, click the Register</b></p>
                            <p class="mo-now-fr"><b>button and sign up now for FREE!</b></p>
                            <!-- <button class="btn btn-danger btn-sm login-button" style="margin: 5% 0 0 21%;">REGISTER</button> -->
                            <a href="/register" class="btn btn-danger reg-mod"  (click)="model_toggle()">Register</a>
                        </div>
                        <div class="col-sm-7 text-center login-back-img">
                            <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
                            <p class="closer-data"></p>
                            <h3 class="closer-data"></h3>
                            <p class="closer-data"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<!------ Include the above in your HEAD tag ---------->
@endsection


