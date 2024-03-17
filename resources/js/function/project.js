export const create = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$post(_this.getApiRoutes.create, _this.getProjectData)
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

  export const index = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$get(_this.getApiRoutes.list, _this.getNameSearch)
    if (res.data?.success) {
      _this.setProjectList(res.data.data.data)
      _this.setPagination({current_page:res.data.data.current_page , last_page:res.data.data.last_page})
    }
    if (res.errors?.error) {
      _this.$error(res.errors?.error)
    }
    if (res.errors?.errors) {
      _this.errors = res.errors?.errors
    }
    _this.setGlobalLoading(false)
  }

