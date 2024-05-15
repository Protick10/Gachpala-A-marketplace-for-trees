<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
  <head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GachPala</title>

    <link rel="shortcut icon" href="images/Logo.svg" type="image/x-icon">

    <!-- 
        tailwind and daisyUI link
     -->
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 
        tailwind colors
     -->
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              Primary: "#006838",
              Primary_Light: "#62A73B",
              Primary_BG: "#E6F5DD",
              Black: "#121212",
            },
          },
        },
      };
    </script>

    <!-- 
        google font
       -->
       <link rel="preconnect" href="https://fonts.googleapis.com">
       <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
       <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <!-- 
        css connection
     -->
    <link rel="stylesheet" href="styles/landing-page.css" />

    <!-- 
        inner styles
     -->
    <style>
      .inter-font {
        font-family: "Inter", sans-serif;
      }
      .playfare-font{
        font-family: "Playfair Display", serif;
      }
    </style>
  </head>

  <body>
    <!-- 
        header section
     -->
    <header>
      <!-- 
            navbar
        -->
      <nav class="inter-font text-base font-semibold">
        <div
          class="flex items-center justify-between max-w-[1280px] px-8 mx-auto"
        >
          <ul class="flex space-x-8">
            <li><a href="">Home</a></li>
            <li><a href="">Shop</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="">Contact Us</a></li>
          </ul>

          <div class="my-3">
            <img src="images/Logo.svg" alt="" />
          </div>

          <div class="flex space-x-3 items-center ml-12">
            <a href="">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
              >
                <path
                  d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                  stroke="#121212"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </a>
            <a href="" class="ml-1">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
              >
                <path
                  d="M1 1H5L7.68 14.39C7.77144 14.8504 8.02191 15.264 8.38755 15.5583C8.75318 15.8526 9.2107 16.009 9.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6M10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21ZM21 21C21 21.5523 20.5523 22 20 22C19.4477 22 19 21.5523 19 21C19 20.4477 19.4477 20 20 20C20.5523 20 21 20.4477 21 21Z"
                  stroke="#121212"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
            </a>
            <button class="py-3 px-5">Log In</button>
            <button class="bg-Primary text-white py-3 px-5 rounded-lg">
              Sign Up
            </button>
          </div>
        </div>
      </nav>

      <hr class="border-gray-100">
      
      
      <!-- 
        header hero
       -->
      <div class="mx-auto max-w-[1280px] px-8 flex justify-between items-center inter-font">
        <div class="max-w-[592px] space-y-8">
          <h3 class="playfare-font text-6xl font-normal">Make your life</h3>
          <h1 class="playfare-font text-8xl font-bold text-Primary">GREEN</h1>
          <p class="text-xl">Lorem ipsum dolor sit amet consectetur. Arcu orci amet ac sit nibh eget gravida tempor. Id tempor condimentum duis eleifend ut. Feugiat nunc.</p>
          <button class="bg-Primary py-4 px-7 font-bold text-lg text-white rounded-lg">SHOP NOW</button>
          <button class="py-4 px-7 font-bold text-lg text-Primary">EXPLORE PLANTS <img class="inline" src="images/arrow-right.svg" alt=""> </button>
        </div>

        <div>
            <img src="images/HERO IMAGE.png" alt="">
        </div>
      </div>
    </header>

    <!-- 
        main section
     -->
    <main>

            <!-- //featured section -->

            
            <?php
              include('feature.php');
            ?>
            <!-- <section class="featured">
              <h2 class="playfare-font">Featured</h2>
              <div class="featurecard">
                <div class="card">
                  <img src="images/image 8.png" alt="">
                  <div class="np">
                    <h3 class="inter-font">Peperomia Ginny</h3>
                    <p>&#2547; 250</p>
                  </div>
                  <div class="atc">
                    <button><img src="images/shopping-cart.svg" alt=""> Add to Cart</button>
                    <div class="atcimg">
                      <img src="images/heart.svg" alt="">
                    </div>
      
                  </div>
                </div>
      
                <div class="card">
                  <img src="images/image 8.png" alt="">
                  <div class="np">
                    <h3>Peperomia Ginny</h3>
                    <p>&#2547; 250</p>
                  </div>
                  <div class="atc">
                    <button><img src="images/shopping-cart.svg" alt=""> Add to Cart</button>
                    <div class="atcimg">
                      <img src="images/heart.svg" alt="">
                    </div>
      
                  </div>
                </div>
      
                <div class="card">
                  <img src="images/image 8.png" alt="">
                  <div class="np">
                    <h3>Peperomia Ginny</h3>
                    <p>&#2547; 250</p>
                  </div>
                  <div class="atc">
                    <button><img src="images/shopping-cart.svg" alt=""> Add to Cart</button>
                    <div class="atcimg">
                      <img src="images/heart.svg" alt="">
                    </div>
                    
      
                  </div>
                </div>
      
                <div class="vap">
                  <p>VIEW ALL PLANTS</p>
                  <img src="images/arrow-right-circle.png" alt="">
                </div>
      
      
              </div>
      
            </section> -->
    <!-- 
        plants you will love
     -->

     <section class="mt-20 playfare-font  max-w-[1280px] mx-auto px-8">
        <div class="">
            <h3 class="text-center text-4xl mb-16 font-bold">Plants You Will Love</h3>
            <div class="grid grid-cols-4 gap-8">
                <div>
                    <img src="images/Rectangle 7.png" alt="">
                    <h6 class="text-2xl font-normal text-center my-3">House Plants <img class="inline ml-3" src="images/arrow-right-white.svg" alt=""></h6>
                </div>
                <div>
                    <img src="images/Rectangle 8.png" alt="">
                    <h6 class="text-2xl font-normal text-center my-3">House Plants <img class="inline ml-3" src="images/arrow-right-white.svg" alt=""></h6>
                </div>
                <div>
                    <img src="images/Rectangle 9.png" alt="">
                    <h6 class="text-2xl font-normal text-center my-3">House Plants <img class="inline ml-3" src="images/arrow-right-white.svg" alt=""></h6>
                </div>
                <div>
                    <img src="images/Rectangle 10.png" alt="">
                    <h6 class="text-2xl font-normal text-center my-3">House Plants <img class="inline ml-3" src="images/arrow-right-white.svg" alt=""></h6>
                </div>
                <div>
                    <img src="images/Rectangle 11.png" alt="">
                    <h6 class="text-2xl font-normal text-center my-3">House Plants <img class="inline ml-3" src="images/arrow-right-white.svg" alt=""></h6>
                </div>
                <div>
                    <img src="images/Rectangle 7.png" alt="">
                    <h6 class="text-2xl font-normal text-center my-3">House Plants <img class="inline ml-3" src="images/arrow-right-white.svg" alt=""></h6>
                </div>
                <div>
                    <img src="images/Rectangle 7.png" alt="">
                    <h6 class="text-2xl font-normal text-center my-3">House Plants <img class="inline ml-3" src="images/arrow-right-white.svg" alt=""></h6>
                </div>
                <div>
                    <img src="images/Rectangle 7.png" alt="">
                    <h6 class="text-2xl font-normal text-center my-3">House Plants <img class="inline ml-3" src="images/arrow-right-white.svg" alt=""></h6>
                </div>
            </div>
        </div>
     </section>



     <!-- 
        About US
      -->
      <section class="playfare-font bg-Primary_BG mt-20">
        <div class="py-20 max-w-[1280px] mx-auto text-center">
            <h3 class="text-4xl font-bold mb-3">About Us</h3>
            <p class="text-[#8F8F8F] inter-font">Order now and appreciate the beauty of nature</p>

            <div class="flex mt-16">
                <div class="my-4 flex flex-col justify-center items-center space-y-6">
                    <img src="images/Group 1.svg" alt="" class="w-[96px]">
                    <h3 class="text-lg font-bold">Large Assortment</h3>
                    <p class="text-[#8F8F8F] inter-font">we offer many different types of products with fewer variations in each category.</p>
                </div>
                <div class="my-4 flex flex-col justify-center items-center space-y-6">
                    <img src="images/Group 2.svg" alt="" class="w-[96px]">
                    <h3 class="text-lg font-bold">Large Assortment</h3>
                    <p class="text-[#8F8F8F] inter-font">we offer many different types of products with fewer variations in each category.</p>
                </div>
                <div class="my-4 flex flex-col justify-center items-center space-y-6">
                    <img src="images/Group 3.svg" alt="" class="w-[96px]">
                    <h3 class="text-lg font-bold">Large Assortment</h3>
                    <p class="text-[#8F8F8F] inter-font">we offer many different types of products with fewer variations in each category.</p>
                </div>
            </div>
        </div>
      </section>

    </main>

    <!-- 
        footer section
     -->
     <footer>
      <div class="social">
        <img src="images/youtube.svg" alt="">
        <img src="images/facebook.svg" alt="">
        <img src="images/insta.svg" alt="">
        <img src="images/linkedin.svg" alt="">
        <img src="images/tiktok.svg" alt="">
      </div>

      <img src="images/logo2.svg" alt="">

      <div class="txtfoot">
        <p>© 2024 GachPala. All rights reserved</p>
      </div>
    </footer>
  </body>
</html>
