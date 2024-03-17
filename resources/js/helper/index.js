// Plugins
import crud from './crud'
import helper from './helper'
import toaster from './toaster'
import Loading from '../components/common/Loading.vue'


export function registerHelper (app) {
  app
    .use(crud)
    .use(helper)
    .use(toaster)
    .component('GlobalLoading', Loading)
}
