import { defineStore } from 'pinia'

export const useGlobalStore = defineStore('global', {
  state: () => {
    return {
      loading: {
        show: false,
        transition: 'fade',
        color: '#145A32',
        iconWidth: 45,
        iconHeight: 45,
      }
    }
  },
  getters: {
    getLoading (state) {
      return state.loading
    },
  },
  actions: {
    setGlobalLoading (payload) {
      this.loading.show = payload
    },
  }
})
