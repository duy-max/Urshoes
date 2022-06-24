const sliderImgs = $$('.slider-imgs img');
const sliderDots = $$('.slider-dot');

var x = 0;
var slide = () => {
    let a = x;
    sliderImgs.forEach((sliderImg, index) => {
        sliderImg.style.left = -a*100 + '%';
        
        if (a == 0) {
            $('.slider-dot.slider-dot--active').classList.remove('slider-dot--active');
            sliderDots[index].classList.add('slider-dot--active');
        }
        
        if (index == sliderImgs.length - 1) {
            (x < sliderImgs.length - 1) ? x++ : x = 0;
        }
        a--;
        console.log(sliderImg.style.left, a, index)
    })
}

slide();

sliderDots.forEach((sliderDot, index) => {
    sliderDot.onclick = () => {
        x = index;
        slide();
    }
})

setInterval(slide, 3000);