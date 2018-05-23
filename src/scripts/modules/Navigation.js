export default class Navigation {

  constructor() {  
    this.events()
  }

  events() {
    this.$inventory = document.querySelector('.inventory')
    this.$inventory.addEventListener('mouseover', () => {
      this.showInventory()
    })
    this.$inventory.addEventListener('mouseout', () => {
      this.hideInventory()
    })
  }

  showInventory() {
    TweenMax.to(
      this.$inventory,
      .2,
      { x: '0%', ease: Power2.easeOut }
    )
  }

  hideInventory() {
    TweenMax.to(
      this.$inventory,
      .2,
      { x: '100%', ease: Power2.easeOut }
    )
  }
}