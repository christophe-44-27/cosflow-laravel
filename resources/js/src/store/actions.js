import axios from "../axios-auth";
import router from "../router";

const actions = {

    // ////////////////////////////////////////////
    // SIDEBAR & UI UX
    // ////////////////////////////////////////////

    updateSidebarWidth({ commit }, width) {
      commit('UPDATE_SIDEBAR_WIDTH', width);
    },
    updateI18nLocale({ commit }, locale) {
      commit('UPDATE_I18N_LOCALE', locale);
    },
    toggleContentOverlay({ commit }) {
      commit('TOGGLE_CONTENT_OVERLAY');
    },
    updateTheme({ commit }, val) {
      commit('UPDATE_THEME', val);
    },
    updateUserRole({ commit }, val) {
      commit('UPDATE_USER_ROLE', val);
    },
    updateWindowWidth({ commit }, width) {
      commit('UPDATE_WINDOW_WIDTH', width);
    },


    // ////////////////////////////////////////////
    // COMPONENT
    // ////////////////////////////////////////////

    // VxAutoSuggest
    updateStarredPage({ commit }, payload) {
      commit('UPDATE_STARRED_PAGE', payload)
    },

    //  The Navbar
    arrangeStarredPagesLimited({ commit }, list) {
      commit('ARRANGE_STARRED_PAGES_LIMITED', list)
    },
    arrangeStarredPagesMore({ commit }, list) {
      commit('ARRANGE_STARRED_PAGES_MORE', list)
    },

    signup ({commit}, authData){
        axios.post('register', {
            name: authData.name,
            email: authData.email,
            password: authData.password,
            client_id: 2,
            client_secret: 'v3tuy07vKj8Z3frDIuXUbQNpm42YuIoOv11LBXFn',
            grant_type: 'password'
        })
            .then(res => console.log(res))
            .catch(error => console.log(error))
    },
    login ({commit}, authData){
        axios.post('oauth/token', {
            username: authData.username,
            password: authData.password,
            client_id: 2,
            client_secret: 'v3tuy07vKj8Z3frDIuXUbQNpm42YuIoOv11LBXFn',
            grant_type: 'password'
        })
            .then(response => {
                localStorage.setItem('accessToken', response.data.access_token);
                commit('loginStop', null);
                commit('updateAccessToken', response.data.access_token);
                router.push('/');
            })
            .catch(error => {
                commit('loginStop', error.response.data.error);
                commit('updateAccessToken', null);
            })
    },
    fetchUserInformations({commit}) {
        axios.post('user/profile')
            .then(response => {
                commit('UPDATE_USER_INFORMATIONS', response.data.user);
            })
    },
    logout({ commit }) {
        localStorage.removeItem('accessToken');
        commit('logout');
        router.push('/login');
    }
}

export default actions
