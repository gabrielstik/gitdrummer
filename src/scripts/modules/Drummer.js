export default class Drummer {

  constructor(navigation) {
    const $drummer = document.querySelector('.drummer')
    const ctx = $drummer.getContext('2d')

    this.resize($drummer)

    this.colors = {
      background: '#fffdf3',
      bars: 'grey',
      current: 'red',
      kick: 'blue',
      snare: 'green',
      hihat: 'yellow',
    }
    this.sounds = []
    this.currentPosition = 0

    this.medias = {
      kick: 'assets/lib/808/kicks/808-Kicks03.wav',
      snare: 'assets/lib/808/snares/808-Clap03.wav',
      hihat: 'assets/lib/808/hihats/808-HiHats03.wav'
    }
    
    this.mediaPreload()
    this.events($drummer, navigation)
    this.render(ctx)
  }

  resize($drummer) {
    const update = () => {
      this.width = window.innerWidth
      this.height = window.innerHeight
      $drummer.width = this.width
      $drummer.height = this.height
    }
    update()
    
    window.addEventListener('resize', () => { update() })
  }

  mediaPreload() {
    for (const media in this.medias) {
      const audio = new Audio()
      audio.src = media
    }

  }

  events($drummer, navigation) {
    let isGrabbing = false

    window.addEventListener('mouseup', (e) => {
      isGrabbing = false
    })

    const $soundLabels = document.querySelectorAll('.inventory--sound')
    for (const $soundLabel of $soundLabels) {
      $soundLabel.addEventListener('mousedown', (e) => {
        for (const $label of $soundLabels) {
          $label.classList.remove('selected')
        }

        $soundLabel.classList.add('selected')
        this.selectedSound = $soundLabel.dataset.sound

        isGrabbing = true
        navigation.hideInventory()
        this.dropSound(e)
      })

      // C'EST PAS DU TOUT ÇA QU'IL FAUT FAIRE, IL FAUT CHOPPER LES COORDONNÉES DANS LE CANVAS 😅
      $soundLabel.addEventListener('mousemove', (e) => {
        if (isGrabbing) {
          this.sounds[this.sounds.length-1].x = e.clientX / this.width
          this.sounds[this.sounds.length-1].y = e.clientY / this.height
        }
      })
    }

    this.isPlaying = false
    const $playPause = document.querySelector('.settings--play-pause')
    $playPause.addEventListener('mousedown', () => {
      this.isPlaying == false ? this.isPlaying = true : this.isPlaying = false
    })

    const $export = document.querySelector('.settings--export')
    $export.addEventListener('mousedown', () => (
      this.export()
    ))
  }

  render(ctx) {
    const loop = () => {
      requestAnimationFrame(loop)

      this.clear(ctx)
      this.bars(ctx)
      this.inst(ctx)
      this.current(ctx)
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
  
  current(ctx, audio) {
    ctx.strokeStyle = this.colors.current

    ctx.beginPath()
    ctx.moveTo(this.currentPosition * this.width, 0)
    ctx.lineTo(this.currentPosition * this.width, this.height)
    ctx.stroke()
    ctx.closePath()

    if (this.isPlaying) this.currentPosition += .01
    if (this.currentPosition >= 1) {
      this.currentPosition = 0
      for (const sound of this.sounds) {
        sound.isPlayed = false
      }
    }

    for (const sound of this.sounds) {
      if (Math.round(sound.x * 100) == Math.round(this.currentPosition * 100)) {
        if (!sound.isPlayed) {
          const audio = new Audio()
          switch (sound.name) {
            case 'kick':
            audio.src = this.medias.kick
            break
            case 'snare':
            audio.src = this.medias.snare
            break
            case 'hihat':
            audio.src = this.medias.hihat
            break
          }
          audio.play()
          sound.isPlayed = true
        }
      }
    }
  }

  dropSound(e) {
    if (this.selectedSound) {
      const sound = {
        name: this.selectedSound,
        x: e.clientX / this.width,
        y: e.clientY / this.height,
        length: 1,
        isPlayed: false
      }
      this.sounds.push(sound)
    }
  }

  inst(ctx) {
    console.log(this.sounds)
    for (const sound of this.sounds) {
      switch (sound.name) {
        case 'kick':
        ctx.fillStyle = this.colors.kick
        break
        case 'snare':
        ctx.fillStyle = this.colors.snare
        break
        case 'hihat':
        ctx.fillStyle = this.colors.hihat
        break
      }
      ctx.fillRect(sound.x * this.width, sound.y * this.height - 25, sound.length * 100, 50)
    }
  }

  export() {
    const content = JSON.stringify(this.sounds)
    console.log(content)
  }
}