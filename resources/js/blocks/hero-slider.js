import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';

const initHeroSlider = () => {
  const sliders = document.querySelectorAll('.slider-hero');
  if (!sliders.length) return;

  sliders.forEach((slider) => {
    const slidesCount = slider.querySelectorAll('.swiper-slide').length;

    new Swiper(slider, {
      modules: [Navigation],
      loop: slidesCount > 1,
      slidesPerView: 1,
      navigation: {
        nextEl: slider.querySelector('.__next'),
        prevEl: slider.querySelector('.__prev'),
      },
    });
  });
};

initHeroSlider();
