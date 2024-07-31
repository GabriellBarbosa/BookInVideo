import debounce from './debounce.js';

export default class Slide {
  constructor(slide, wrapper) {
    this.slideElement = document.querySelector(slide);
    this.wrapperElement = document.querySelector(wrapper);

    this.pointerStartPosition = 0;
    this.slidePosition = 0;
    this.movement = 0;
   
    this.activeClass = 'active';
  
    this.indexes = {
      prev: undefined,
      active: undefined,
      next: undefined,
    }
  
    this.slides = [];
  
    this.isDragging = false;
  
    this.changeEvent = new Event('changeEvent');
  }

  init() {
    if (this.slideElement) {
      this.bindEvents();
      this.addResizeEvent();
      this.setSlides();
      this.changeSlide(0);
      this.addDraggingEvents();
    }
    return this;
  }

  bindEvents() {
    this.startDragging = this.startDragging.bind(this);
    this.updateMovement = this.updateMovement.bind(this);
    this.finishDragging = this.finishDragging.bind(this);
    this.activePrevSlide = this.activePrevSlide.bind(this);
    this.activeNextSlide = this.activeNextSlide.bind(this);
    this.changeSlideWhenMouseLeave = this.changeSlideWhenMouseLeave.bind(this);
    this.onResize = debounce(this.onResize.bind(this), 200);
  }

  addResizeEvent() {
    window.addEventListener('resize', this.onResize);
  }

  onResize() {
    setTimeout(() => {
      this.setSlides();
      this.changeSlide(this.indexes.active);
    }, 1000);
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

  addDraggingEvents() {
    this.wrapperElement.addEventListener('mousedown', this.startDragging);
    this.wrapperElement.addEventListener('touchstart', this.startDragging);
    this.wrapperElement.addEventListener('mouseup', this.finishDragging);
    this.wrapperElement.addEventListener('touchend', this.finishDragging);
    this.wrapperElement.addEventListener('mouseleave', this.changeSlideWhenMouseLeave);
  }

  changeSlideWhenMouseLeave() {
    if (this.isDragging) {
      this.addTransitionEffect();
      this.wrapperElement.removeEventListener('mousemove', this.updateMovement);
      this.changeSlide(this.indexes.active);
    }
  }

  startDragging(event) {
    this.isDragging = true;
    this.preventGrabImage(event);
    this.pointerStartPosition = this.getClientX(event);
    this.removeTransitionEffect();
    this.wrapperElement.addEventListener(this.getMoveEvent(event.type), this.updateMovement);
  }

  preventGrabImage(event) {
    if (event.type == 'mousedown') {
      event.preventDefault()
    }
  }

  getClientX(event) {
    if (event.type == 'mousedown') {
      return event.clientX;
    } else {
      return event.changedTouches[0].clientX;
    }
  }

  removeTransitionEffect() {
    this.slideElement.style.transition = '';
  }

  finishDragging(event) {
    this.isDragging = false;
    this.addTransitionEffect();
    this.wrapperElement.removeEventListener(this.getMoveEvent(event.type), this.updateMovement);
    this.changeSlideIfMoved();
    this.movement = 0;
  }

  addTransitionEffect() {
    this.slideElement.style.transition = 'transform .3s';
  }

  getMoveEvent(event) {
    if (event == 'mousedown' || event == 'mouseup') {
      return 'mousemove';
    } else {
      return 'touchmove';
    }
  }

  updateMovement(event) {
    this.movement = (this.pointerStartPosition - this.getCurrentPosition(event)) * 1.6;
  }

  getCurrentPosition(event) {
    if (event.type == 'mousemove') {
      return event.clientX;
    } else {
      return event.changedTouches[0].clientX;
    }
  }

  changeSlideIfMoved() {
    if (this.movement > 120 && this.indexes.next !== undefined) {
      this.activeNextSlide();
    } else if (this.movement < -120 && this.indexes.prev !== undefined) {
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
    this.slidePosition = this.slides[index].position;
    this.updateSlidesIndexes(index);
    this.updateSlidePosition(this.slidePosition);
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

  updateSlidePosition(position) {
    this.slideElement.style.transform = `translate3d(${position}px, 0, 0)`;
  }

  changeActiveClass() {
    this.slides.forEach(item => {
      item.element.classList.remove(this.activeClass);
    });
    this.slides[this.indexes.active].element.classList.add(this.activeClass);
  }
}