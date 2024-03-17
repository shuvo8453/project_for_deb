export const create = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$post(_this.getApiRoutes.create, _this.getTeamMateData)
    if (res.data?.success) {
      _this.setErrors()
      _this.clearForm()
      _this.$success(res.data.message)
    }
    if (res.errors?.error) {
      _this.$error(res.errors?.error)
    }
    if (res.errors?.errors) {
      _this.errors = res.errors?.errors
    }
    _this.setGlobalLoading(false)
  }
