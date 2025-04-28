import AuthService from './auth.service';

export default {
  // namespaced: true,
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')),
    loggedIn: !!localStorage.getItem('user')
  }),
  mutations: {
    SET_USER(state, user) {
      state.user = user;
      state.loggedIn = !!user;
    }
  },
  actions: {
    async login({ commit }, user) {
      try {
        const userData = await AuthService.login(user);
        commit('SET_USER', userData);
        return userData;
      } catch (error) {
        commit('SET_USER', null);
        throw error;
      }
    },
    logout({ commit }) {
      AuthService.logout();
      commit('SET_USER', null);
    },
    async register({ commit }, user) {
      try {
        await AuthService.register(user);
      } catch (error) {
        throw error;
      }
    }
  },
  getters: {
    currentUser: state => state.user,
    isLoggedIn: state => state.loggedIn
  }
};