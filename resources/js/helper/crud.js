import axios from 'axios'

const crud = {
  install (app) {
    app.config.globalProperties.$get = async (url, payload = [], withoutToken = false) => {
      const token = localStorage.getItem('token')
      let instance = withoutToken ? axios.create({
        baseURL: import.meta.env.VITE_APP_API_URL
      }) : axios.create({
        headers: {
          Authorization: `Bearer ${token}`,
        },
        baseURL: import.meta.env.VITE_APP_API_URL
      })
      let response = {
        'data': {},
        'errors': {},
      }
      await instance.get(url, { params: payload }).then(res => {
        response.data = res.data
      }).catch(err => {
        if(err.response.status === 401){
          localStorage.removeItem('token')
          localStorage.removeItem('profile')
          window.location  ='/'
        }
        response.errors = err.response.data
      })
      return response
    }

    app.config.globalProperties.$delete = async (url, withoutToken = false) => {
      const token = localStorage.getItem('token')
      let instance = withoutToken ? axios.create({
        baseURL: import.meta.env.VITE_APP_API_URL
      }) : axios.create({
        headers: {
          Authorization: `Bearer ${token}`,
        },
        baseURL: import.meta.env.VITE_APP_API_URL
      })
      let response = {
        'data': {},
        'errors': {},
        'error': {},
      }
      await instance.delete(url).then(res => {
        response.data = res.data
      }).catch(err => {
        if(err.response.status === 401){
          localStorage.removeItem('token')
          localStorage.removeItem('profile')
          window.location  ='/'
        }
        if (err.response.status === 422) {
          response.errors = err.response.data
        } else {
          response.error = err.response.data
        }
      })
      return response
    }

    app.config.globalProperties.$post = async (url, payload = {}, withoutToken = false) => {
      const token = localStorage.getItem('token')
      let instance = withoutToken ? axios.create({
        headers: {
          'Content-Type': 'multipart/form-data'
        },
        baseURL: import.meta.env.VITE_APP_API_URL
      }) : axios.create({
        headers: {
          Authorization: `Bearer ${token}`,
          'Content-Type': 'multipart/form-data'
        },
        baseURL: import.meta.env.VITE_APP_API_URL
      })
      let response = {
        'data': {},
        'errors': {},
      }

      await instance.post(url, payload).then(res => {
        response.data = res.data
      }).catch(err => {
        if(err.response.status === 401){
          localStorage.removeItem('token')
          localStorage.removeItem('profile')
          window.location  ='/'
        }
        response.errors = err.response.data
      })
      return response
    }
  }
}

export default crud

