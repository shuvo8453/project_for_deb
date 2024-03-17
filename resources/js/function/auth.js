export const login = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$post(_this.getApiRoutes.login, _this.getLoginData)
    if (res.data?.success) {
      _this.authToken(res.data.access_token)
      _this.setProfile(res.data.profile)
      _this.setErrors()
      _this.clearLogin()
      _this.$success(res.data.message)
      _this.$router.push({ name: 'dashboard' })
    }
    if (res.errors?.error) {
      _this.$error(res.errors?.error)
    }
    if (res.errors?.errors) {
      _this.errors = res.errors?.errors
    }
    _this.setGlobalLoading(false)
  }


  export const registation = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$post(_this.getApiRoutes.registation, _this.getRegData)
    if (res.data?.success) {
      _this.authToken(res.data.access_token)
      _this.setProfile(res.data.profile)
      _this.setErrors()
      _this.clearReg()
      _this.$success(res.data.message)
      _this.$router.push({ name: 'dashboard' })
    }
    if (res.errors?.error) {
      _this.$error(res.errors?.error)
    }
    if (res.errors?.errors) {
      _this.errors = res.errors?.errors
    }
    _this.setGlobalLoading(false)
  }

  export const logout = async (_this) => {
    const res = await _this.$get(_this.getApiRoutes.logout)
    if (res.data?.success) {
      _this.$success(res.data.message)
      _this.logoutFromState()
      _this.removeProfile()
      _this.$router.push({ name: 'login' })
    }
    if (res.errors?.error) {
      _this.$error(res.errors?.error)
    }
  }
