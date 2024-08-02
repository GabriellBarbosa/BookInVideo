import debounce from './debounce.js';

export default class Slide {
  constructor(slideElement, wrapperElement) {
    this.slideElement = slideElement;
    this.wrapperElement = wrapperElement;

    this.slides = [];
    this.pointerStartPosition = 0;
    this.movement = 0;
    this.isDragging = false;
    this.changeEvent = new Event('changeEvent');
    this.activeClass = 'active';

    this.indexes = {
      prev: undefined,
      active: undefined,
      next: undefined
    }
  }

  init() {
    if (this.slideElement) {
      this.bindEvents();
      this.setSlides();
      this.changeSlide(0);
      this.addEvents();
    }
    return this;
  }

  bindEvents() {
    this.startDragging = this.startDragging.bind(this);
    this.finishDragging = this.finishDragging.bind(this);
    this.preventSlideChange = this.preventSlideChange.bind(this);
    this.repositioningSlides = debounce(this.repositioningSlides.bind(this), 200);
  }

  setSlides() {
    this.slides = [...this.slideElement.children].map((element) => {
      return { position: this.getSlidePosition(element),  element };
    });
  }

  getSlidePosition(slide) {
    const margin = (this.wrapperElement.offsetWidth - slide.offsetWidth) / 2;
    return -(slide.offsetLeft - margin);
  }

  addEvents() {
    window.addEventListener('resize', this.repositioningSlides);
    this.wrapperElement.addEventListener('mousedown', this.startDragging);
    this.wrapperElement.addEventListener('touchstart', this.startDragging);
    this.wrapperElement.addEventListener('mouseup', this.finishDragging);
    this.wrapperElement.addEventListener('touchend', this.finishDragging);
    this.wrapperElement.addEventListener('mouseleave', this.preventSlideChange);
  }

  repositioningSlides() {
    setTimeout(() => {
      this.setSlides();
      this.changeSlide(this.indexes.active);
    }, 1000);
  }

  preventSlideChange() {
    if (this.isDragging)
      this.changeSlide(this.indexes.active);
  }

  startDragging(event) {
    this.preventGrabImage(event);
    this.isDragging = true;
    this.pointerStartPosition = this.getClientX(event);
  }

  preventGrabImage(event) {
    if (event.type == 'mousedown')
      event.preventDefault();
  }

  finishDragging(event) {
    this.isDragging = false;
    this.movement = this.pointerStartPosition - this.getClientX(event);
    this.changeSlideIfConsiderablyMoved();
  }

  getClientX(event) {
    if (event.type == 'mousedown' || event.type == 'mouseup') {
      return event.clientX;
    } else {
      return event.changedTouches[0].clientX;
    }
  }

  changeSlideIfConsiderablyMoved() {
    if (this.movement > 80) {
      this.activeNextSlide();
    } else if (this.movement < -80) {
      this.activePrevSlide();
    } else {
      this.changeSlide(this.indexes.active);
    }
  }

  activeNextSlide() {
    if (this.indexes.next !== undefined)
      this.changeSlide(this.indexes.next);
  }

  activePrevSlide() {
    if (this.indexes.prev !== undefined)
      this.changeSlide(this.indexes.prev);
  }

  changeSlide(index) {
    this.updateSlidesIndexes(index);
    this.updateSlidePosition();
    this.changeActiveClass();
    this.wrapperElement.dispatchEvent(this.changeEvent);
  }

  updateSlidesIndexes(currentIndex) {
    this.indexes = {
      prev: this.getPrevIndex(currentIndex),
      active: currentIndex,
      next: this.getNextIndex(currentIndex),
    }
  }

  getPrevIndex(currentIndex) {
    return currentIndex > 0 ? currentIndex - 1 : undefined;
  }

  getNextIndex(currentIndex) {
    const last = this.slides.length - 1;
    return currentIndex < last ? currentIndex + 1 : undefined;
  }

  updateSlidePosition() {
    this.slideElement.style.transform = `translate3d(${this.slides[this.indexes.active].position}px, 0, 0)`;
  }

  changeActiveClass() {
    this.slides.forEach(item => {
      item.element.classList.remove(this.activeClass);
    });
    this.slides[this.indexes.active].element.classList.add(this.activeClass);
  }
}