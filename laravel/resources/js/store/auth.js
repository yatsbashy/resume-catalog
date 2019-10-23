import { OK } from '../util';

const state = {
  user: null,
  apiStatus: null
};

const getters = {
  isLoggedIn: state => !!state.user,
  username: state => (state.user ? state.user.name : '')
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setApiStatus(state, status) {
    state.apiStatus = status;
  }
};

const actions = {
  async register(context, data) {
    const response = await axios.post('/api/register', data);
    context.commit('setUser', response.data);
  },
  async login(context, data) {
    // apiStatus をリセット
    context.commit('setApiStatus', null);

    // API 呼び出し
    const response = await axios
      .post('/api/login', data)
      .catch(err => err.response || err);

    // 成功
    if (response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', response.data);
      return false;
    }
    // 失敗
    context.commit('setApiStatus', false);
    context.commit('error/setCode', response.status, { root: true });
  },
  async logout(context) {
    await axios.post('/api/logout');
    context.commit('setUser', null);
  },
  async currentUser(context) {
    const response = await axios.get('/api/user');
    context.commit('setUser', response.data || null);
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
};
