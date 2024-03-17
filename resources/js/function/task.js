export const projectList = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$get(_this.getApiRoutes.projectList)
    if (res.data?.success) {
        console.log(res.data);

      _this.setProjectList(res.data.data)
    }
    if (res.errors?.error) {
      _this.$error(res.errors?.error)
    }
    if (res.errors?.errors) {
      _this.errors = res.errors?.errors
    }
    _this.setGlobalLoading(false)
  }


  export const teamProjectList = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$get(_this.getApiRoutes.teamMateProjectList)
    if (res.data?.success) {
        console.log(res.data)
      _this.setProjectList(res.data.project)
    }
    if (res.errors?.error) {
      _this.$error(res.errors?.error)
    }
    if (res.errors?.errors) {
      _this.errors = res.errors?.errors
    }
    _this.setGlobalLoading(false)
  }

  export const teamMateList = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$get(_this.getApiRoutes.teamMateList)
    if (res.data?.success) {
      _this.setTeamMateList(res.data.teammate)
    }
    if (res.errors?.error) {
      _this.$error(res.errors?.error)
    }
    if (res.errors?.errors) {
      _this.errors = res.errors?.errors
    }
    _this.setGlobalLoading(false)
}

export const updateTaskStatus = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$post(`${_this.getApiRoutes.updateteamMatetaskStatus}${_this.singleTask.id}`, _this.getSingleTaskStatus)
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

export const create = async (_this) => {
    _this.setGlobalLoading(true)
    console.log(_this.getTaskData);
    const res = await _this.$post(_this.getApiRoutes.create, _this.getTaskData)
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
    const res = await _this.$get(_this.getApiRoutes.list , _this.getFilter)
    if (res.data?.success) {
      _this.setShowTaskList(res.data.data.data)
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

  export const assignTask = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$get(_this.getApiRoutes.teamMateTaskList , _this.getFilter)
    if (res.data?.success) {
      _this.setShowTaskList(res.data.data.data)
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

  export const updateAssignTeamMate = async (_this) => {
    _this.setGlobalLoading(true)
    const res = await _this.$post(`${_this.getApiRoutes.assignTeamMate}${_this.singleTask.id}`, _this.getSingleTask)
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

