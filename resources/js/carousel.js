const swiperWrapper = document.querySelector(".swiper-wrapper");
const swiperControlsContainer = document.querySelector(".swiper-control");
const swiperControls = ["previous", "next"];
const slides = document.querySelectorAll(".swiper-slide");

class ReviewCarousel {
    constructor(container, slides, controls) {
        this.container = container;
        this.controls = controls;
        this.slideArray = [...slides];
    }

    updateReviews() {
        this.slideArray.forEach((el) => {
            el.classList.remove(
                "item-1",
                "item-2",
                "item-3",
                "item-4",
                "item-5"
            );
        });
        this.slideArray.slice(0, 5).forEach((el, i) => {
            el.classList.add(`item-${i + 1}`);
        });
    }

    setCurrentState(direction) {
        if (direction.className === "swiper-control-previous") {
            this.slideArray.unshift(this.slideArray.pop());
        } else {
            this.slideArray.push(this.slideArray.shift());
        }
        this.updateReviews();
    }

    setControls() {
        this.controls.forEach((control) => {
            const btn = document.createElement("button");
            btn.className = `swiper-control-${control}`;
            btn.innerText = control === "previous" ? "назад" : "вперёд";

            swiperControlsContainer.appendChild(btn);
        });
    }

    useControls() {
        const triggers = [...swiperControlsContainer.childNodes];
        triggers.forEach((control) => {
            control.addEventListener("click", (e) => {
                e.preventDefault();
                this.setCurrentState(control);
            });
        });
    }
}

const reviewCarousel = new ReviewCarousel(
    swiperWrapper,
    slides,
    swiperControls
);
reviewCarousel.setControls();
reviewCarousel.useControls();
