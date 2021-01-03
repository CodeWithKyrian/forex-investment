export default {
    loadUser: ({ commit }) => {
        return new Promise((resolve, reject) => {
            axios.get('/api/get_user')
                .then(res => {
                    commit("UpdateUser", res.data.user)
                    resolve()
                })
                .catch(err => {
                    commit("RefreshToken", null)
                    delete axios.defaults.headers.common['Authorization']
                    localStorage.removeItem('user-token')
                    reject(err)
                })
        })
    },
    login: ({ commit, dispatch }, user) => {
        return new Promise((resolve, reject) => {
            commit("statusLoading")
            axios.post('/api/login', {
                    email: user.email,
                    password: user.password
                })
                .then(res => {
                    if (res.data.success == true) {
                        const token = res.data.data.token
                        localStorage.setItem('user-token', token)
                        commit("statusSuccess")
                        commit("RefreshToken", token)
                        resolve(res)
                    } else {
                        delete axios.defaults.headers.common['Authorization']
                        localStorage.removeItem('user-token')
                        commit("statusError")
                        commit("RefreshToken", null)
                        reject(res.data.data.error)
                    }
                })
                .catch(err => {
                    reject(err)
                })
        })
    },
    logout: ({ commit }) => {
        localStorage.removeItem('user-token')
        commit("RefreshToken", null)
        delete axios.defaults.headers.common['Authorization']
    }
}