import { request } from "http";

export default class Drummer {

  constructor() {
    const $drummer = document.querySelector('.drummer')
    const ctx = $drummer.getContext('2d')

    this.resize($drummer)

    this.colors = {
      background: '#fffdf3',
      bars: 'grey',
      kick: 'blue',
    }
    this.sounds = []
    
    this.events($drummer)
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
    
    window.addEventListener('resize', () => { update() })
  }

  events($drummer) {
    $drummer.addEventListener('mousedown', (e) => {
      if (this.selectedSound) {
        const sound = {
          name: this.selectedSound,
          x: event.clientX / this.width,
          y: event.clientY / this.height,
          length: 1
        }
        this.sounds.push(sound)
      }
    })

    $drummer.addEventListener('mousemove', (e) => {
      
    })

    const $soundLabels = document.querySelectorAll('.inventory--sound-label')
    for (const $soundLabel of $soundLabels) {
      $soundLabel.addEventListener('mousedown', () => {
        for (const $label of $soundLabels) {
          $label.classList.remove('selected')
        }
        $soundLabel.classList.add('selected')
        this.selectedSound = $soundLabel.dataset.sound
      })
    }
  }

  render(ctx) {
    const loop = () => {
      requestAnimationFrame(loop)

      this.clear(ctx)
      this.bars(ctx)
      this.inst(ctx)
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

  inst(ctx) {
    for (const sound of this.sounds) {
      ctx.fillStyle = this.colors.kick
      ctx.fillRect(sound.x * this.width - 200, sound.y * this.height - 25, sound.length * 100, 50)
    }
  }
}