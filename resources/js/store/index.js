import mutations from './mutations'
import actions from './actions';


export default {
    state: {
        currPage: "home",
        user: {},
        token: localStorage.getItem('user-token') || '',
        status: ''
    },
    getters: {
        getCurrPage: state => state.currPage,

        getUser: state => state.user,

        isAuthenticated: state => !!state.token,

        getToken: state => state.token,

        authStatus: state => state.status,
    },
    mutations,
    actions
}