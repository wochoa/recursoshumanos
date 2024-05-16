import axios from 'axios';

const API_URL = import.meta.env.VITE_API_BASE_URL || '/api';
// const API_URL = 'http://localhost:8081/api';

class AuthService {
  login(user) {
    return axios
      .post(API_URL + '/auth/login', user)
      .then(response => {
        if (response.data.access_token) {
          localStorage.setItem('user', JSON.stringify(response.data));
        }
        // console.log(API_URL);
        return response.data;
      });
  }

  logout() {
    localStorage.removeItem('user');
  }

  register(user) {
    return axios.post(API_URL + 'register', {
      username: user.username,
      email: user.email,
      password: user.password
    });
  }
}

export default new AuthService();
