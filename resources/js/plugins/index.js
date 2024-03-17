// Plugins
import { createPinia } from 'pinia'
import { routers } from '../routers'
import Toaster from '@meforma/vue-toaster'
import { useGlobalStore } from '../stores/global'
import { useAuthStore } from '../stores/auth'
import { useTeamMateStore } from '../stores/teammate'
import { useProjectStore } from '../stores/project'
import { useTaskStore } from '../stores/task'

const pinia = createPinia()

export function registerPlugins (app) {
  app
    .use(pinia)
    .use(routers)
    .use(Toaster)
    useGlobalStore()
    useAuthStore()
    useTeamMateStore()
    useProjectStore()
    useTaskStore()
}
