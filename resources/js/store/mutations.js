export default {
    changecurrPage(state, data) { return state.currPage = data },

    UpdateBankVerified(state, data) { return state.user.bankVerified = data },

    UpdateUser(state, user) { return state.user = user },

    RefreshToken(state, token) { return state.token = token },

    statusLoading: (state) => { state.status = 'loading' },

    statusSuccess: (state, token) => { status = 'success' },

    statusError: (state) => { state.status = 'error' },
}