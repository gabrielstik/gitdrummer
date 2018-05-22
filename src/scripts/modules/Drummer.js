import { request } from "http";

export default class Drummer {

  constructor() {
    const $drummer = document.querySelector('.drummer')
    const ctx = $drummer.getContext('2d')

    this.resize($drummer)

    this.colors = {
      background: '#fffdf3',
      bars: 'grey'
    }
    
    this.events()
    this.render(ctx)
  }

  resize($drummer) {
    const update = () => {
      this.width = window.innerWidth - 200
      this.height = window.innerHeight
      $drummer.width = this.width
      $drummer.height = this.height
    }
    update()
    
    window.addEventListener('resize', () => {
      update()
    })
  }

  events() {
    window.addEventListener('mousedown', (e) => {
      
    })

    window.addEventListener('mousemove', (e) => {
      
    })
  }

  render(ctx) {
    const loop = () => {
      requestAnimationFrame(loop)

      this.clear(ctx)
      this.bars(ctx)
    }
    loop()
  }

  clear(ctx) {
    ctx.fillStyle = this.colors.background
    ctx.fillRect(0, 0, this.width, this.height)
  }

  bars(ctx) {
    ctx.strokeStyle = this.colors.bars

    ctx.beginPath()
    ctx.moveTo(this.width / 4 * 1, 0)
    ctx.lineTo(this.width / 4 * 1, this.height)
    ctx.stroke()
    ctx.closePath()

    ctx.beginPath()
    ctx.moveTo(this.width / 4 * 2, 0)
    ctx.lineTo(this.width / 4 * 2, this.height)
    ctx.stroke()
    ctx.closePath()

    ctx.beginPath()
    ctx.moveTo(this.width / 4 * 3, 0)
    ctx.lineTo(this.width / 4 * 3, this.height)
    ctx.stroke()
    ctx.closePath()
  }
}