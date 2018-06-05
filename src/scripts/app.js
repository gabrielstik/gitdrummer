import './vendor/modernizr'
import Navigation from './modules/Navigation'
import Drummer from './modules/Drummer'

if (document.querySelector('.drummer')) {
  const navigation = new Navigation()
  const drummer = new Drummer(navigation)
}