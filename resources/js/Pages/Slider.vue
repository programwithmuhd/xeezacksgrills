<template>
    <!-- <Carousel>
        <Slide v-for="slide in 10" :key="slide">
            <div class="carousel__item">
                <img src="/images/sliders/slide1.jpg" alt="" srcset="" height="200">
            </div>
        </Slide>
  
      <template #addons>
        <Navigation />
        <Pagination />
      </template>
    </Carousel> -->

    <!-- new slide -->
    <Carousel :items-to-show="1" :wrap-around="true">
      <Slide v-for="slide in 4" :key="slide">
          <div class="carousel__item">
              <img id="slider" :src="`images/sliders/slide${slide}.jpg`" alt="">
          </div>
      </Slide>

      <template #addons>
          <Navigation />
      </template>
    </Carousel>
  </template>
  
  <script>
  import { defineComponent } from 'vue'
  import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
  
  import 'vue3-carousel/dist/carousel.css'
  
  export default defineComponent({
    name: 'Basic',
    components: {
      Carousel,
      Slide,
      Pagination,
      Navigation,
    },
  })
  </script>
  
  <style>
  .carousel__item {
    max-height: 800px;
    width: 100%;
    background-color: var(--vc-clr-primary);
    color: var(--vc-clr-white);
    font-size: 20px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .carousel__slide {
    /* padding: 10px; */
  }
  
  .carousel__prev,
  .carousel__next {
    box-sizing: content-box;
    border: 5px solid white;
  }
  </style>